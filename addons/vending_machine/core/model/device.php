<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

if(!defined('IA_ROOT')){
    define('IA_ROOT', str_replace(array('\\','/addons/vending_machine/core'), ['/',''], dirname(dirname(__FILE__))));
}

if (!defined('VENDING_MACHINE_PATH')){
    require_once IA_ROOT . '/addons/vending_machine/version.php';
    require_once IA_ROOT . '/addons/vending_machine/defines.php';
}

class Device_Model
{

    //定义数据表
    public $tables = array(
        'device' => 'vending_machine_device',
        'cardreader'=>'vending_machine_device_cardreader',
        'lock'=>'vending_machine_device_lock',
        'remote'=>'vending_machine_device_remote',
        'scales'=>'vending_machine_device_scales'
    );

    //定义通道
    public $channels = array(
        'laravel'=>'485总线'
    );

    /**
     * 根据ID获取设备
     * @param int|array $id 设备ID
     * @param string $column 查询字段
     * @return boolean|array
     * */
    public function getone($id,$column='id'){
        if (is_array($id)) return $id;
        global $_W;
        $query = "SELECT * FROM " . tablename($this->tables['device']) . " WHERE `{$column}` = :id and uniacid = :uniacid";
        if(function_exists('pdo_fetch')){
            return pdo_fetch($query, array(':id' => intval($id),':uniacid'=>$_W['uniacid']));
        }
        return pdo_fetch2($query,array(':id' => intval($id),':uniacid'=>$_W['uniacid']));
    }

    /***
     * 根据IMEI获取设备
     * @param string $imei 设备IMEI
     * @return boolean|array
     */
    public function getbyimei($imei){
        return $this->getone($imei,'imei');
    }

    /**
     * 根据不同设备通道执行通讯指令
     * @param string $channel 通讯频道
     * @param string $command 通讯指令
     * @param mixed|array $params 通讯参数
     * @return mixed
    */
    public function ChannelPush($channel, $command, $params=array()){
        if (!isset($this->channels[$channel])) return error(-1,'无效的通讯频道');
        $channelname = ucfirst($channel).'_Channel';
        if (!class_exists($channelname)){
            $channelpath = VENDING_MACHINE_CORE ."channel/{$channel}.chn.php";
            if (!file_exists($channelpath)) return error(-1,'该通道暂未完善');
            require_once $channelpath;
        }
        $ChannelClass = new $channelname;
        $method = 'do'.$command;
        if (!method_exists($ChannelClass,$method)) return error(-1,"该通道不支持{$command}方法");
        return $ChannelClass->$method($params);
    }

    /**
     * 根据不同设备通讯频道处理接收到的数据
     * @param string $channel 通讯频道
     * @param string $listener 监听内容
     * @param mixed|array $params 接收到的数据
     * @return mixed
     * */
    public function ChannelReceive($channel, $listener, $params=array()){
        if (!isset($this->channels[$channel])) return error(-1,'无效的通讯频道');
        $channelname = ucfirst($channel).'_Channel';
        if (!class_exists($channelname)){
            $channelpath = VENDING_MACHINE_CORE ."channel/{$channel}.chn.php";
            if (!file_exists($channelpath)) return error(-1,'该通道暂未完善');
            require_once $channelpath;
        }
        $ChannelClass = new $channelname;
        $method = 'on'.$listener;
        if (!method_exists($ChannelClass,$method)) return error(-1,"该通道未监听{$listener}方法");
        return $ChannelClass->$method($params);
    }

    /**
     * 接收到设备的传感器数据
     * @param array|int $device 设备(可直接传设备ID)
     * @param int $type 传感器类型（2门锁，3货道，5读卡器）
     * @param array $data 接收到的数据
     * @return boolean
    */
    public function receivesensor($device, $type=2, $data=array()){
        $device = $this->getone($device);
        if (!$device) return false;
        //如果该设备指定了通讯频道，则需要调用对应的通讯频道处理接收到的数据
        if ($device['channel']){
            $sensors = array('','','lock','shelve','','cardreader');
            return $this->ChannelReceive($device['channel'],'sensor'.$sensors[$type],$data);
        }
        //如果未指定通讯频道，则使用默认方式处理接收到的数据
        $tables = array('','','lock','scales','','cardreader');
        if (!$tables[$type] || empty($data)) return false;
        //根据 $type 判断对应的数据表
        $tablename = $this->tables[$tables[$type]];
        global $_W;
        foreach ($data as $key=>$senid){
            //查询对应的数据表是否已有传感器
            $sensor_exists = pdo_fetchcolumn2("select count(*) from " . tablename($tablename) . " where device_id=:device_id and senid=:senid and uniacid=:uniacid", array(':device_id' => $device['id'], ':senid' => $senid, ':uniacid' => $_W['uniacid']));
            if (!$sensor_exists){
                //没有则插入
                pdo_insert2($tablename, array('senid' => $senid, 'device_id' => $device['id'], 'uniacid' => $_W['uniacid']));
            }
        }
        return true;
    }

    /**
     * 同步设备的门锁信息
     * @param int $id 设备ID
     * @return boolean|mixed
    */
    public function synclock($id){
        //获取设备
        $device = $this->getone($id);
        if (!$device) return error(-1,'设备不存在!');
        //如果该设备指定了通讯频道，则需要调用对应的通讯频道向设备发送信息
        if ($device['channel']) return $this->ChannelPush($device['channel'],'synclock',$device);
        //如果未指定通讯频道，则使用默认方式向设备发信息
        return com('websocket')->web_send(array('action'=>'sync_remote_lock','imei'=>$device['imei']));
    }

    /**
     * 设置去皮重力值
     * @param int $id 设备id
     * @return mixed
     */
    function init_gravity($id){
        global $_W;
        $device = $this->getone($id);
        if(!$device) return error(-1,'重力值不存在!');
        if ($device['scales']) return $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }
        pdo_update('vending_machine_device_scales',array('gravity_init'=>$scales['gravity_now']),array('id'=>$scales['id']));
        return res;
    }


    /**
     * 设置系数
     */
    function set_coefficient(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }
        if(empty($scales['gravity_now'])){
            show_json(0,'请先获取当前重力值!');
        }
        if(empty($scales['gravity_init'])){
            show_json(0,'请先设置去皮重力值!');
        }
        if($_W['ispost']){
            $coefficient=floatval($_GPC['coefficient']);
            pdo_update('vending_machine_device_scales',array('coefficient'=>$coefficient),array('id'=>$scales['id']));
            show_json(1);
        }

        include $this->template();
    }


    /**
     * 获取灵敏度
     */
    function get_sensitivity(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }
        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $scales['device_id'],':uniacid'=>$_W['uniacid']));
        if(empty($device)){
            show_json(0,'设备不存在!');
        }
        $res=com('websocket')->web_send(array('action'=>'get_remote_sensitivity','imei'=>$device['imei'],'senid'=>$scales['senid']));
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        $res=com('websocket')->web_send(array('action'=>'get_remote_sensitivity_time','imei'=>$device['imei'],'senid'=>$scales['senid']));
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        show_json(1);
    }


}