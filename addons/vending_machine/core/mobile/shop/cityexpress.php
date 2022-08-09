<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Cityexpress_Page extends MobilePage {


    function  map(){
        global $_W, $_GPC;

        $cityexpress = pdo_fetch("SELECT * FROM " . tablename('vending_machine_city_express') . " WHERE uniacid=:uniacid AND merchid=:merchid",array(":uniacid"=>$_W['uniacid'],":merchid"=>0));
        $address = m('common')->getSysset('contact');//获取商城地址
        $shop = m('common')->getSysset('shop');//获取商城名称和log


        if(!empty($address)){
            $cityexpress['address']=$address['province'].$address['city'].$address['address'];
        }

        if(!empty($shop)){
            $cityexpress['name']=$shop['name'];
            $cityexpress['logo']=$shop['logo'];
        }


        include $this->template();
    }



}
