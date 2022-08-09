<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_Page extends WebPage {
    function main($type=''){
        global $_W, $_GPC;

        $where='uniacid = :uniacid';
        $param=array(':uniacid'=>$_W['uniacid']);
        if($type=='pre'){
            $where.=" and is_reg=0";
        }else{
            $where.=" and is_reg=1";
        }

        $name=trim($_GPC['name']);
        if($name!=''){
            $where.=" and (name like :name or imei like :name)";
            $param[':name']="%".$name."%";
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $limit=" limit " . ($pindex - 1) * $psize . ',' . $psize;

        $list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device') . " WHERE ".$where.$limit,$param);

        include $this->template('device');
    }
    function pre(){
        $this->main('pre');
    }

    function remote(){
        global $_W, $_GPC;
        $where='uniacid = :uniacid';
        $param=array(':uniacid'=>$_W['uniacid']);
        $online=intval($_GPC['online']);
        if(!empty($online)){
            $where.=' and online = :online';
            $param[':online']=$online;
        }
        $name=trim($_GPC['name']);
        if(!empty($name)){
            $where.=' and (locate(:name,name)>0 or locate(:name,imei)>0)';
            $param[':name']=$name;
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $limit=" limit " . ($pindex - 1) * $psize . ',' . $psize;

        $list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_remote') . " WHERE ".$where.$limit,$param);

        include $this->template();
    }

    /**
     * 拉取远端仓库
     */
    function sync_remote_device(){
        global $_W;

        $res=com('websocket')->web_send(array('action'=>'sync_remote_device'));
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        if(!empty($res)){
            foreach ($res as $v){
                if(empty($v['imei'])){
                    continue;
                }
                $device=pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_remote') . " WHERE imei=:imei and uniacid = :uniacid",array(':uniacid'=>$_W['uniacid'],':imei'=>$v['imei']));
                if(!empty($device)){
                    $update=array();
                    $device['name']!=$v['address']?$update['name']=$v['address']:'';
                    $device['online']!=$v['onLine']?$update['online']=$v['onLine']:'';
                    if(!empty($update)){
                        pdo_update('vending_machine_device_remote',$update,array('id'=>$device['id']));
                    }
                }else{
                    pdo_insert('vending_machine_device_remote',array('name'=>$v['address'],'imei'=>$v['imei'],'online'=>intval($v['onLine']),'uniacid'=>$_W['uniacid']));
                }
            }
        }
        show_json(1);
    }

    function add() {
        $this->post();
    }
    function edit() {
        $this->post();
    }
    function post() {
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if(!empty($id)){
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if($_W['ispost']){
            $data=array(
                'uniacid'=>$_W['uniacid'],
                'name'=>trim($_GPC['name']),
                'imei'=>trim($_GPC['imei']),
                'channel'=>trim($_GPC['channel']),
                'province'=>strpos($_GPC['province'],'请选择')===false?trim($_GPC['province']):'',
                'city'=>strpos($_GPC['city'],'请选择')===false?trim($_GPC['city']):'',
                'area'=>strpos($_GPC['area'],'请选择')===false?trim($_GPC['area']):'',
                'address'=>trim($_GPC['address']),
                'enabled'=>intval($_GPC['enabled'])?1:0,
            );

            if (!$device){
                if ($data['channel']) $data['is_reg'] = 1;
            }

            if(empty($data['name'])){
                show_json(0,'设备名称不能为空');
            }
            if(empty($data['imei'])){
                show_json(0,'设备序号不能为空');
            }
            if (strlen($data['imei']) != 15){
                show_json(0,'设备序号不正确');
            }

            if(!empty($device)){
                pdo_update('vending_machine_device',$data,array('id'=>$device['id']));
                show_json(1);
            }else{
                $data['createtime']=time();
                pdo_insert('vending_machine_device',$data);
                $id = pdo_insertid();
            }
            show_json(1,array('url'=>webUrl('device/edit', array('id' => $id,'type'=>'pre'))));
        }

        include $this->template();
    }

    function delete(){
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if(!empty($id)){
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($device)){
            show_json(0,'设备不存在!');
        }
        pdo_delete('vending_machine_device_lock',array('device_id'=>$device['id'],'uniacid'=>$_W['uniacid']));
        pdo_delete('vending_machine_device_scales',array('device_id'=>$device['id'],'uniacid'=>$_W['uniacid']));
        pdo_delete('vending_machine_device',array('id'=>$device['id'],'uniacid'=>$_W['uniacid']));
        show_json(1);
    }

    /**
     * 注册到远端仓库
     */
    function reg(){
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if(!empty($id)){
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($device)){
            show_json(0,'设备不存在!');
        }

        $res=com('websocket')->web_send(array('action'=>'add_remote_device','imei'=>$device['imei'],'address'=>$device['name']));
        if(is_error($res)){
            if($res['message']!='设备已被绑定'){
                show_json(0,$res['message']);
            }
        }
        pdo_update('vending_machine_device',array('is_reg'=>1),array('id'=>$device['id']));
        show_json(1);
    }

    function detail(){
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if(!empty($id)){
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($device)){
            show_json(0,'设备不存在!');
        }
        include $this->template();
    }

    /**
     * 设备门锁列表
     */
    function lock_list(){
        global $_W, $_GPC;

        $device_id=intval($_GPC['device_id']);
        $where=' uniacid=:uniacid and device_id=:device_id ';
        $param=array(':device_id'=>$device_id,':uniacid'=>$_W['uniacid']);

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $limit=" limit " . ($pindex - 1) * $psize . ',' . $psize;

        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $device_id,':uniacid'=>$_W['uniacid']));

        $list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE ".$where.$limit,$param);

        $action=array('0'=>'空闲','1'=>'购物','2'=>'补货','3'=>'维护','4'=>'禁用',);

        include $this->template();
    }

    /**
     * 同步设备的门锁信息
     */
    function sync_lock(){
        global $_GPC;
        $res=m('device')->synclock($_GPC['id']);
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        show_json(1);

    }

    /**
     * 锁开关
     */
    function set_lock(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $status= intval($_GPC['status']);
        if(!empty($id)){
            $lock= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($lock)){
            show_json(0,'门锁不存在!');
        }
        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['device_id'],':uniacid'=>$_W['uniacid']));
        if(empty($device)){
            show_json(0,'设备不存在!');
        }
        $res=com('websocket')->web_send(array('action'=>'set_remote_lock','imei'=>$device['imei'],'senid'=>$lock['senid'],'status'=>$status));
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        pdo_update('vending_machine_device_lock',array('action'=>2),array('id'=>$lock['id']));
        show_json(1);
    }

    /**
     * 锁信息编辑
     */
    function edit_lock(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $lock= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($lock)){
            show_json(0,'门锁不存在!');
        }
        pdo_update('vending_machine_device_lock',array($_GPC['type']=>$_GPC['value']),array('id'=>$lock['id']));
        show_json(1);
    }

    /**
     * 删除门锁
     */
    function delete_lock(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $lock= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($lock)){
            show_json(0,'门锁不存在!');
        }
        pdo_update('vending_machine_device_scales',array('lock_id'=>0),array('lock_id'=>$lock['id']));
        pdo_delete('vending_machine_device_lock',array('id'=>$lock['id']));
        show_json(1);
    }

    /**
     * 重力传感器列表
     */
    function scales_list(){
        global $_W, $_GPC;

        $device_id=intval($_GPC['device_id']);
        $where=' uniacid=:uniacid and device_id=:device_id ';
        $param=array(':device_id'=>$device_id,':uniacid'=>$_W['uniacid']);

        $lock_id=intval($_GPC['lock_id']);
        if(!empty($lock_id)){
            $where.=" and lock_id=:lock_id";
            $param[':lock_id']=$lock_id;
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $limit=" limit " . ($pindex - 1) * $psize . ',' . $psize;

        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $device_id,':uniacid'=>$_W['uniacid']));

        $list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE ".$where.$limit,$param);
        foreach ($list as &$row){
            $row['goodsname']=pdo_fetchcolumn("SELECT title FROM " . tablename('vending_machine_goods') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $row['goodsid'],':uniacid'=>$_W['uniacid']));
        }
        unset($row);

        $lock_list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE uniacid = :uniacid and device_id=:device_id",array(':uniacid'=>$_W['uniacid'],':device_id'=>$device['id']),'id');

        $action=array('0'=>'空闲','1'=>'购物','2'=>'补货','3'=>'维护','4'=>'禁用',);

        include $this->template();
    }

    /**
     * 传感器信息编辑
     */
    function edit_scales(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            $this->message('传感器不存在!');
        }

        $lock_list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE uniacid = :uniacid and device_id=:device_id",array(':uniacid'=>$_W['uniacid'],':device_id'=>$scales['device_id']),'id');

        if($_W['ispost']){
            $title=trim($_GPC['title']);
            $level=intval($_GPC['level']);
            $goodsid=intval($_GPC['goodsid']);
            $lock_id=intval($_GPC['lock_id']);
            if(empty($title)){
                show_json(0,'屏显不能为空!');
            }
            if(empty($level)){
                show_json(0,'层数不能为空!');
            }
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $scales['device_id'],':uniacid'=>$_W['uniacid']));
            if(empty($device)){
                show_json(0,'设备不存在!');
            }
            if($title!=$scales['title']){
                $res=com('websocket')->web_send(array('action'=>'set_remote_lcd','imei'=>$device['imei'],'senid'=>$scales['senid'],'value'=>$_GPC['value'],));
                if(is_error($res)){
                    show_json(0,$res['message']);
                }
            }
            pdo_update('vending_machine_device_scales',array('title'=>$title,'level'=>$level,'goodsid'=>$goodsid,'lock_id'=>$lock_id),array('id'=>$scales['id']));
            show_json(1);
        }
        if(!empty($scales['goodsid'])){
            $goods=pdo_fetch("select * from ".tablename('vending_machine_goods')." where id=:id and uniacid = :uniacid",array(':id'=>$scales['goodsid'],':uniacid'=>$_W['uniacid']));
        }

        include $this->template();
    }


    /**
     * 传感器信息编辑
     */
    function update_scales(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }

        if($_GPC['type']=='title'){
            if(empty($_GPC['value'])){
                show_json(0,'屏显不能为空!');
            }
            $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $scales['device_id'],':uniacid'=>$_W['uniacid']));
            if(empty($device)){
                show_json(0,'设备不存在!');
            }

            $res=com('websocket')->web_send(array('action'=>'set_remote_lcd','imei'=>$device['imei'],'senid'=>$scales['senid'],'value'=>$_GPC['value'],));
            if(is_error($res)){
                show_json(0,$res['message']);
            }
        }

        pdo_update('vending_machine_device_scales',array($_GPC['type']=>$_GPC['value']),array('id'=>$scales['id']));
        show_json(1);
    }

    /**
     * 删除传感器
     */
    function delete_scales(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }
        pdo_delete('vending_machine_device_scales',array('id'=>$scales['id']));
        show_json(1);
    }


    /**
     * 获取重力值
     */
    function get_gravity(){
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
        $res=com('websocket')->web_send(array('action'=>'get_remote_gravity','imei'=>$device['imei'],'senid'=>$scales['senid']));
        if(is_error($res)){
            show_json(0,$res['message']);
        }
        show_json(1);
    }

    /**
     * 设置去皮重力值
     */
    function init_gravity(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }
        pdo_update('vending_machine_device_scales',array('gravity_init'=>$scales['gravity_now']),array('id'=>$scales['id']));
        show_json(1);
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

    /**
     * 绑定门锁
     */
    function bind_lock(){
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
        if($_W['ispost']){
            if(empty($_GPC['lock_id'])){
                show_json(0,'请选择要绑定的门锁!');
            }
            pdo_update('vending_machine_device_scales',array('lock_id'=>intval($_GPC['lock_id'])),array('id'=>$scales['id']));
            show_json(1);
        }

        $lock_list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE uniacid = :uniacid and device_id=:device_id",array(':uniacid'=>$_W['uniacid'],':device_id'=>$device['id']));

        include $this->template();
    }

    /**
     * 绑定商品
     */
    function bind_goods(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            $scales= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_scales') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id,':uniacid'=>$_W['uniacid']));
        }
        if(empty($scales)){
            show_json(0,'传感器不存在!');
        }

        if($_W['ispost']){
            if(empty($_GPC['goodsid'])){
                show_json(0,'请选择要绑定的商品!');
            }
            pdo_update('vending_machine_device_scales',array('goodsid'=>intval($_GPC['goodsid'])),array('id'=>$scales['id']));
            show_json(1);
        }

        $lock_list=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE uniacid = :uniacid and device_id=:device_id",array(':uniacid'=>$_W['uniacid'],':device_id'=>$scales['device_id']));

        include $this->template();
    }

    function local_ws_status(){
        $local_ws=com('websocket')->check_status();
        show_json($local_ws?1:0);
    }

}