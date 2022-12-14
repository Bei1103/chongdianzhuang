<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_Page extends WebPage {

	function main() {
		global $_W,$_GPC;
//		删除多余的插件信息
        $plugins =  pdo_fetchall('SELECT count(*) as num,`identity` FROM ' . tablename('vending_machine_plugin') . "where 1 GROUP BY `identity`" );
        if(!empty($plugins)){
            foreach($plugins as $value){
                if($value['num']>1){
                     $name  = pdo_getall('vending_machine_plugin',array('identity'=>$value['identity']));
                     unset($name[0]);
                     foreach($name as $pl){
                        pdo_delete('vending_machine_plugin',array('id'=>$pl['id']));
                    }
                }
            }
        }


		$category = m('plugin')->getList(1);

		$wxapp_array = array(
		    'commission',
            'creditshop',
            'diyform',
            'bargain',
            'quick',
            'cycelbuy',
            'seckill',
            'groups',
            'dividend',
            'membercard',
            'friendcoupon',
            'goodscircle',
            'merch',
            'wxlive'
        );
        $apps = false;
        if ($_W['role'] == 'founder' || empty($_W['role'])) {
            $apps = true;
        }
        $filename = "../addons/vending_machine/core/model/grant.php";
        if(file_exists($filename)){
            $setting = pdo_fetch("select * from ".tablename('vending_machine_system_grant_setting')." where id = 1 limit 1 ");
            $permPlugin = false;
            if($setting['condition_type']==0){
                $permPlugin = true;
            }elseif($setting['condition_type']==1){
                $total = m("goods")->getTotals();
                if($total['sale'] >= $setting['total']){
                    $permPlugin = true;
                }
            }elseif($setting['condition_type']==2){
                $price = pdo_fetch("select sum(price) as price from ".tablename('vending_machine_order')." where uniacid = ".$_W['uniacid']." and status = 3 ");
                if($price['price'] >= $setting['price']){
                    $permPlugin = true;
                }
            }elseif($setting['condition_type']==3){
                $time = floor((time()-$_W['user']['joindate']) / 86400);
                if($time >= $setting['day']){
                    $permPlugin = true;
                }
            }
        } 
        if(p("grant")){
            $pluginsetting = pdo_fetch("select adv from ".tablename('vending_machine_system_plugingrant_setting')." where 1 = 1 limit 1 ");
        }
		include $this->template();
	}
}