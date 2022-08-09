<?php

error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/vending_machine/defines.php';
require '../../../../../addons/vending_machine/core/inc/functions.php';
global $_W, $_GPC;

ignore_user_abort(); //忽略关闭浏览器
set_time_limit(0); //永远执行

$sets = pdo_fetchall('select uniacid from ' . tablename('vending_machine_sysset'));
foreach ($sets as $set) {

    $_W['uniacid'] = $set['uniacid'];
    if (empty($_W['uniacid'])) {
        continue;
    }
    $trade = m('common')->getSysset('trade', $_W['uniacid']);

    $goods = pdo_fetchall("select id,statustimestart,statustimeend from ".tablename('vending_machine_goods')." where uniacid = ".$_W['uniacid']." and isstatustime > 0 and deleted = 0 ");

    foreach ($goods as $key => $value){
        if($value['statustimestart'] < time() && $value['statustimeend'] > time()){
            $value['status'] = 1;
        }else{
            $value['status'] = 0;
        }
        pdo_update('vending_machine_goods', array('status'=>$value['status']), array('id' => $value['id']));
    }

}




