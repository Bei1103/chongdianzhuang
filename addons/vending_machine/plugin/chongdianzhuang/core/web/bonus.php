<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Bonus_Page extends PluginWebPage
{

    function status0()
    {
        global $_W,$_GPC;
        $device_num = $_GPC['device_num'];
        //删除
        if($_GPC['ac'] == 'del'){
            $_GPC['id'] || show_message("ID缺失！","","error");
            pdo_delete("vending_machine_xc_charge", array("id"=>intval($_GPC['id'])));
        }
        $port_count = 10;
        $where = "port_count= $port_count";
        $param = array();
        if ($device_num){
            $where .= ' and `device_num`=:device_num';
            $param[':device_num'] = $device_num;
        }
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_charge = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);


        include $this->template();
    }

    function status1()
    {
        global $_W,$_GPC;
        $device_num = $_GPC['device_num'];
        $port_count = 2;
        $where = "port_count= $port_count";
        $param = array();
        if ($device_num){
            $where .= ' and `device_num`=:device_num';
            $param[':device_num'] = $device_num;
        }
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_charge = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);

        //删除
        if($_GPC['ac'] == 'del'){
            $_GPC['id'] || show_message("ID缺失！","","error");
            pdo_delete("vending_machine_xc_product", array("id"=>intval($_GPC['id'])));
        }
        include $this->template();
    }
    function status2()
    {
        global $_W,$_GPC;
        $device_num = $_GPC['device_num'];
        $port_count = 1;
        $where = "port_count= $port_count";
        $param = array();
        if ($device_num){
            $where .= ' and `device_num`=:device_num';
            $param[':device_num'] = $device_num;
        }
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_charge = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_charge') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);

        //删除
        if($_GPC['ac'] == 'del'){
            $_GPC['id'] || show_message("ID缺失！","","error");
            pdo_delete("vending_machine_xc_product", array("id"=>intval($_GPC['id'])));
        }
        include $this->template();
    }
    function status5(){
        global $_W,$_GPC;
        $wheres = "";
        $param = array();
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        //今日订单总数
        $start_c_time = date("Y-m-d",time())." 00:00:00"; //一天开始
        $finish_c_time = date("Y-m-d",time())." 23:59:59"; //一天结束
        $stor_start_time  = strtotime($start_c_time); //开始时间戳
        $stor_finish_time  = strtotime($finish_c_time); //结束时间戳
        $xc_paylog = pdo_fetchall("select * from " . tablename('vending_machine_xc_paylog') . " WHERE ".'times between '.$stor_start_time.' and '.$stor_finish_time.'.'.$wheres." ORDER BY id DESC LIMIT {$limit},15",$param);
        $count_pay = $xc_paylog[''];
        include $this->template();
    }
    function status6(){
        include $this->template();
    }
    function status7(){
        include $this->template();
    }
    function status8(){
        global $_W,$_GPC;
//        $xc_product = pdo_fetchall("select * from " . tablename('vending_machine_xc_product') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        //删除
        if($_GPC['ac'] == 'del'){
            $_GPC['id'] || show_message("ID缺失！","","error");
            pdo_delete("vending_machine_xc_product", array("id"=>intval($_GPC['id'])));
//            show_message("删除成功！",WebUrl('chongdianzhuang.bonus.status8'),"success");
        }
        $product_num = $_GPC['product_num'];
        $where = 1;
        $param = array();
        if ($product_num){
            $where .= ' and `product_num`=:product_num';
            $param[':product_num'] = $product_num;
        }
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_product = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_product') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_product') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);



        include $this->template();
    }
    function status9(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_product = pdo_fetchall('select * from'.tablename('vending_machine_xc_product').'where id=:id',array(':id'=>$id));
        if ($xc_product['product_num']!=$_GPC['product_num']){
//        $add['product_num']= $_GPC['product_num'];
            $add = array(
                'product_num' => $_GPC['product_num'],
                'product_type' => $_GPC['product_type']
            );
        $xc_product = pdo_insert('vending_machine_xc_product',$add);
            if (!empty($xc_product)) {
                $xc_product = pdo_insertid();
                message('添加设备库存成功，ID为' . $xc_product);
            }
        }
        include $this->template();

    }
    function status10(){
        include $this->template();
    }
    function status11(){
        include $this->template();
    }
    function status12(){
        global $_W,$_GPC;
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_agent", array("id" => intval($_GPC['id'])));
        }
        $ture_name = $_GPC['true_name'];
        $agent_mobile = $_GPC['agent_mobile'];
        $where = 1;
        $param = array();
        if ($ture_name){
            $where .= ' and `true_name`=:true_name';
            $param[':true_name'] = $ture_name;
        }

        if ($agent_mobile){
            $where .= ' and `agent_mobile`=:agent_mobile';
            $param[':agent_mobile'] = $agent_mobile;
        }

        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_agent = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_agent') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_agent') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);



//        $xc_agent = pdo_fetchall("select * from " . tablename('vending_machine_xc_agent') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        include $this->template();
    }
    function status13(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
//        $xc_agent = pdo_fetchall("select * from " . tablename('vending_machine_xc_agent') . "   ORDER BY id DESC  ", array(':id'=>$_W['id']));

        $xc_agent = pdo_fetchall('select * from'.tablename('vending_machine_xc_agent').'where id=:id',array(':id'=>$id));
//                print_r($xc_agent);
//        die();
        //添加
        if ($xc_agent['agent_name']!=$_GPC['agent_name']){
        $agent_data = array(
            'id' => $_GPC['id'],
          'agent_name'  => $_GPC['agent_name'],
            'true_name' => $_GPC['true_name'],
            'agent_mobile' => $_GPC['agent_mobile'],
            'agent_pwd' =>$_GPC['agent_pwd']
        );

        $xc_agent = pdo_insert('vending_machine_xc_agent',$agent_data);  }
        if (!empty($xc_agent)) {
            $xc_agent = pdo_insertid();
            message('添加用户成功，ID为' . $xc_agent);
        }
        include $this->template('chongdianzhuang/bonus/status13');
    }
//    function  add13(){
//        global $_W,$_GPC;
//        //添加
//        $agent_data = array(
//            'id' => $_GPC['id'],
//            'agent_name'  => $_GPC['agent_name'],
//            'true_name' => $_GPC['true_name'],
//            'agent_mobile' => $_GPC['agent_mobile'],
//            'agent_pwd' =>$_GPC['agent_pwd']
//        );
//        $xc_agent = pdo_insert('vending_machine_xc_agent',$agent_data);
//        if (!empty($xc_agent)) {
//            $xc_agent = pdo_insertid();
//            message('添加用户成功，ID为' . $xc_agent);
//        }
//        include $this->template('chongdianzhuang/bonus/status13');
//    }
    function status14(){
        global $_W,$_GPC;
        $xc_group = pdo_fetchall("select * from " . tablename('vending_machine_xc_group') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_group", array("id" => intval($_GPC['id'])));
        }
        //分页
        $where = 1;
        $param = array();
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*5;
        $xc_group= pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_group') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_group') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);
        $xc_group = pdo_fetchall("select * from " . tablename('vending_machine_xc_group') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        include $this->template();
    }
    function status15(){
        global $_W,$_GPC;
        $nickname = $_GPC['nickname'];
        $mobile = $_GPC['mobile'];
        $openid = $_GPC['openid'];
        $where = 1;
        //搜索
        if ($nickname){
            $where .= ' and `nickname`=:nickname';
            $param[':nickname'] = $nickname;
        }
        if ($mobile){
            $where .= ' and `nmobile`=:mobile';
            $param[':mobile'] = $mobile;
        }
        if ($openid){
            $where .= ' and `openid`=:openid';
            $param[':openid'] = $openid;
        }
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_user", array("id" => intval($_GPC['id'])));
        }

//        $xc_user = pdo_fetchall("select * from " . tablename('vending_machine_xc_user') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_user = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_user') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_user') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);
        include $this->template();
    }
    function status16(){
        global $_W,$_GPC;
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_goods_cate", array("id" => intval($_GPC['id'])));
        }
        $xc_goods = pdo_fetchall("select * from " . tablename('vending_machine_xc_goods_cate') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));

        include $this->template();
    }
    function status17(){
        global $_W,$_GPC;
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_goods", array("id" => intval($_GPC['id'])));
        }
        $xc_good = pdo_fetchall("select * from " . tablename('vending_machine_xc_goods') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));

        include $this->template();
    }
    function status18(){
        include $this->template();
    }
    function status20(){
        global $_W,$_GPC;

        $openid = $_GPC['openid'];
        $where = 1;

        //搜索

        if ($openid){
            $where .= ' and `openid`=:openid';
            $param[':openid'] = $openid;
        }
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_cd_order", array("id" => intval($_GPC['id'])));
        }
//        $param = array();
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_order = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_cd_order') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
//        $xc_order = pdo_fetchall("select * from " . tablename('vending_machine_cd_order') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_cd_order') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);


        include $this->template();
    }
    function status22(){
        global $_W,$_GPC;
        $device = $_GPC['device'];
        $order_id = $_GPC['order_id'];
        $where = 1;
        //搜索

        if ($device){
            $where .= ' and `device`=:device';
            $param[':device'] = $device;
        }
        if ($order_id){
            $where .= ' and `order_id `=:order_id';
            $param[':order_id'] = $order_id;
        }
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_p = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_paylog') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_paylog') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);
        include $this->template();
    }
    function status23(){
        global $_W,$_GPC;
        $where = 1;
        $param = array();
        $page = max(intval($_GPC['page']),1);
        $limit = ($page-1)*15;
        $xc_cash = pdo_fetchall("SELECT * FROM" . tablename('vending_machine_xc_cash') . " WHERE ".$where." ORDER BY id DESC LIMIT {$limit},15",$param);
        $total = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('vending_machine_xc_cash') . " WHERE ".$where,$param);
        $pager = pagination($total,$page);
        include $this->template();
    }

    //设备管理
    //1.功率设置
    function charge_power(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $first_power =$_GPC['first_power'];
        $second_power = $_GPC['second_power'];
        $third_power = $_GPC['third_power'];
        $max_power = $_GPC['max_power'];
        $auto_power = $_GPC['auto_power'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        //编辑
        if ($xc_detail['$first_power'] != $first_power){
            $d = array(
                '$first_power' => $first_power,
                'second_power' => $second_power,
                'third_power' => $third_power,
                'max_power' => $max_power,
                'auto_power ' => $auto_power
            );
            $result=pdo_update('vending_machine_xc_charge',$d,array('id'=>$id));
        }
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
}
    //2.计费设置
    function charge_billing(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $data = $_GPC['wechat_limit'];
        $secondary_ic_limit = $_GPC['secondary_ic_limit'];
        $prepaid_ic_limit = $_GPC['prepaid_ic_limit'];
        $coin_limit = $_GPC['coin_limit'];
        $linear_power_standard = $_GPC['linear_power_standard'];
        $fixed_time_standard = $_GPC['fixed_time_standard'];
        $auto_stop_amount = $_GPC['auto_stop_amount'];
        $linear_power_pay_explain = $_GPC['linear_power_pay_explain'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        //编辑
        if ($xc_detail['wechat_limit'] != $data){
            $d = array(
                'wechat_limit' => $data,
                'secondary_ic_limit' => $secondary_ic_limit,
                'prepaid_ic_limit' => $prepaid_ic_limit,
                'coin_limit' => $coin_limit,
                'linear_power_standard ' => $linear_power_standard,
                'fixed_time_standard' => $fixed_time_standard,
                'auto_stop_amount' => $auto_stop_amount,
                'linear_power_pay_explain' => $linear_power_pay_explain
            );
            $result=pdo_update('vending_machine_xc_charge',$d,array('id'=>$id));
        }
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //3.时间设置
    function charge_time(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //4.电源设置
    function charge_check(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //5.烟感设置
    //6.退费设置
    function charge_refund(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //7.充电时间设置
    function charge_longest(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //8.悬浮设置
    function charge_float_time(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    //9.端口设置
    function charge_initialize(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_detail = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }

    function store(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $data = $_GPC['title'];
//        $title = $_GPC['title'];
        $cname = $_GPC['cname'];
        $tel = $_GPC['tel'];
        $agent_mobile = $_GPC['agent_mobile'];
        $true_name = $_GPC['true_name'];
        $wxappid = $_GPC['wxappid'];
        $wxappsecret = $_GPC['wxappsecret'];
        $mchid = $_GPC['mchid'];
        $wxkey = $_GPC['wxkey'];
        $agent_pwd = $_GPC['agent_pwd'];
        $api_url = $_GPC['api_url'];
//        print_r($title);
//        die();
        $xc_agent = pdo_fetchall('select * from'.tablename('vending_machine_xc_agent').'where id=:id',array(':id'=>$id));
//        print_r($xc_agent);
//        die();
        //编辑
        if ($xc_agent['title'] != $data){
            $d = array(
                'title' => $data,
                'cname' => $cname,
                'tel' => $tel,
                'agent_mobile' => $agent_mobile,
                'true_name' => $true_name,
                'wxappid ' => $wxappid ,
                'wxappsecret' => $wxappsecret,
                'mchid' => $mchid,
                'wxkey' => $wxkey,
                'agent_pwd' => $agent_pwd,
                'api_url' => $api_url

            );
            $title=pdo_update('vending_machine_xc_agent',$d,array('id'=>$id));
        }
        $xc_agent = pdo_fetchall('select * from'.tablename('vending_machine_xc_agent').'where id=:id',array(':id'=>$id));
        include $this->template();

    }

    function user_details(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_group = pdo_fetchall('select * from'.tablename('vending_machine_xc_group').'where id=:id',array(':id'=>$id));
        if ($xc_group['commission']!=$_GPC['commission']){
                $s = array(
                    'commission' => $_GPC['commission'],
                    'name' => $_GPC['name']
                );
                $count = pdo_update('vending_machine_xc_group',$s,array('id'=>$id));
        }
        $xc_group = pdo_fetchall('select * from'.tablename('vending_machine_xc_group').'where id=:id',array(':id'=>$id));
        include $this->template();
    }

    function add(){
        global $_W,$_GPC;
        $device_data = array(
            'device_num' => $_GPC['device_num'],
            'device_type' => $_GPC['device_type'],
            'port_count' => $_GPC['port_count'],
//            'coordinate' => $_GPC['coordinate'],
            'latitude' => $_GPC['latitude'],
            'longitude' => $_GPC['longitude'],
            'notice' => $_GPC['notice'],
        );
//        console.log($_GPC);
        //添加设备
        $result = pdo_insert('vending_machine_xc_charge', $device_data);
        if (!empty($result)) {
            $device_num = pdo_insertid();
            message('添加用户成功，ID为' . $device_num);
        }
    }
    function device(){

        include $this->template('chongdianzhuang/bonus/device');
    }
    function detail(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
//        print_r($id);
//        die();
//        $xc_detail = pdo_fetch("select * from " . tablename('vending_machine_xc_charge') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $xc_detail1 = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
//        $device_num =$xc_detail['device_num'];
//                    $detail_data = array(
//              'device_num' =>$_GPC['device_num'],
//              'port_count' =>$xc_detail['port_count'],
//                        'id'=>$_GPC['id']
//            );
//        print_r($detail_data);
//        print_r($_GPC['id']);
//        print_r($xc_detail1);
//        die();
        $login = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/login',['id'=>$id]),2);
        $url = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/detail',['id'=>$id]),2);
        include $this->template('chongdianzhuang/bonus/detail');
    }
//    function user(){
//        global $_W,$_GPC;
//        $id = $_GPC['id'];
//        $xc_detail = pdo_fetch("select * from " . tablename('vending_machine_xc_agent') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
//        $xc_detail1 = pdo_fetchall('select * from'.tablename('vending_machine_xc_agent').'where id=:id',array(':id'=>$id));
//
//        include $this->template('chongdianzhuang/bonus/user');
//    }
    function user_add(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
//        $xc_group = pdo_fetchall("select * from " . tablename('vending_machine_xc_group') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
//        $xc_group1 = pdo_fetch("select * from " . tablename('vending_machine_xc_group') .'where id=:id',array(':id'=>$id));
        $xc_group = pdo_fetchall('select * from'.tablename('vending_machine_xc_group').'where id=:id',array(':id'=>$id));
        //添加
        if ($xc_group['commission']!=$_GPC['commission']){
        $group_data = array(
            'name' => $_GPC['name'],
            'commission'  => $_GPC['commission'],

        );
        $xc_group1 = pdo_insert('vending_machine_xc_group',$group_data);

        }
        $xc_group = pdo_fetchall('select * from'.tablename('vending_machine_xc_group').'where id=:id',array(':id'=>$id));
        if (!empty($xc_group1)) {
            message('添加成功');
        }
        include $this->template();
    }
    function userinfo(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
//        print_r($id);
//        die();
        $xc_user = pdo_fetchall('select * from'.tablename('vending_machine_xc_user').'where id=:id',array(':id'=>$id));
//        print_r($xc_user);
//        die();
//       $xc_user = pdo_fetchall("select * from " . tablename('vending_machine_xc_user') .'where unicid=:uniacid LIMIT 1', array(':uniacid'=>$_W['uniacid'],':id'=>$_W['id']));
        include $this->template('chongdianzhuang/bonus/userinfo');
    }
    function user_edit(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $ss = $_GPC['money'];
//        print_r($_GPC['money']);
//        die();
        $xc_user = pdo_fetchall('select * from'.tablename('vending_machine_xc_user').'where id=:id',array(':id'=>$id));
        //更新余额
        if($xc_user['money'] != $ss){
            $s=array(
                'money'=>$ss
            );

            $momey=pdo_update('vending_machine_xc_user',$s,array('id'=>$id));
        }

        $xc_user = pdo_fetchall('select * from'.tablename('vending_machine_xc_user').'where id=:id',array(':id'=>$id));
        if (!empty($momey)) {
            message('修改成功');
        }
        include $this->template();
    }
    function good_sort_add(){
        global $_W,$_GPC;
        //添加
        $id = $_GPC['id'];
        $xc_good = pdo_fetchall('select * from'.tablename('vending_machine_xc_goods_cate').'where id=:id',array(':id'=>$id));
        if($xc_good['tname'] !=$_GPC['tname']){
            $good_data = array(
                'tname' => $_GPC['tname'],

            );
            $xc_good = pdo_insert('vending_machine_xc_goods_cate',$good_data);
        }

        include $this->template();
    }
    function good_edit(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_goods_cate = pdo_fetchall('select * from'.tablename('vending_machine_xc_goods_cate').'where id=:id',array(':id'=>$id));
        if ($xc_goods_cate['tname'] != $_GPC['tname']){
            $s = array(
                'tname' => $_GPC['tname']
            );
            $tname = pdo_update('vending_machine_xc_goods_cate',$s,array('id'=>$id));
        }
        $xc_goods_cate = pdo_fetchall('select * from'.tablename('vending_machine_xc_goods_cate').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    function goodsadd(){
        global $_GPC,$_W;

        $xc_good = pdo_fetchall("select * from " . tablename('vending_machine_xc_goods') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        //添加
        if($_W['ispost'] && $xc_good['title']!=$_GPC['title']){
            $title = $_GPC['title'];
            $tid = $_GPC['tid'];
            $price = $_GPC['price'];
            $integral = $_GPC['integral'];
            $nums = $_GPC['nums'];
            $pic_str = $_GPC['pic_str'];
            $overview = $_GPC['overview'];
            $description = $_GPC['description'];
            $goods_data = array(
                'aid' =>  $_GPC['Id'],
                'title' => $_GPC['title'],
                'tid' => $_GPC['tid'],
                'price' => $_GPC['price'],
                'integral' => $_GPC['integral'],
                'nums' => $_GPC['nums'],
                'pic_str' => $_GPC['pic_str'],
                'overview' => $_GPC['overview'],
                'description' => $_GPC['description'],
            );
            $xc_goods = pdo_insert('vending_machine_xc_goods',$goods_data);
            show_message("添加成功！", "", "success");
        }
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_xc_goods", array("id" => intval($_GPC['id'])));
        }
        include $this->template('chongdianzhuang/bonus/goodsadd');
    }
    function goodcheck(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        if($_W['ispost']){
            $goods_data = array(
                'aid' =>  $_GPC['Id'],
                'title' => $_GPC['title'],
                'tid' => $_GPC['tid'],
                'price' => $_GPC['price'],
                'integral' => $_GPC['integral'],
                'nums' => $_GPC['nums'],
                'pic_str' => $_GPC['pic_str'],
                'overview' => $_GPC['overview'],
                'description' => $_GPC['description'],
            );
            pdo_update('vending_machine_xc_goods',$goods_data,['id'=>$id]);
            show_message("更新成功！", "", "success");
        }
        $xc_goods = pdo_fetchall('select * from'.tablename('vending_machine_xc_goods').'where id=:id',array(':id'=>$id));

        include $this->template();
    }
    function slide(){
        include $this->template();
    }
    function pay_info(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_paylog = pdo_fetchall('select * from'.tablename('vending_machine_xc_paylog').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    function gps(){
        include $this->template();
    }
    //设备管理页面详情device
    function get_area(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_charge = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    function get_edit(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
//        $data = $_GPC['device_num'];
        $port_count = $_GPC['port_count'];
        $device_type = $_GPC['device_type'];
        $notice = $_GPC['notice'];
        $data = $_GPC['true_commission'];
        $xc_charge = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
            //编辑
        if ($xc_charge['true_commission'] != $data){
            $d = array(
//                'device_num' => $data,
                'port_count' => $port_count,
                'device_type' => $device_type,
                'notice ' => $notice ,
                'true_commission' => $data,
            );
            $device_num=pdo_update('vending_machine_xc_charge',$d,array('id'=>$id));
        }
        $xc_charge = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        include $this->template();
    }
    function get_qrcode(){
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $xc_charge = pdo_fetchall('select * from'.tablename('vending_machine_xc_charge').'where id=:id',array(':id'=>$id));
        $url = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/detail',['id'=>$id]),2);
        include $this->template();
    }
}
