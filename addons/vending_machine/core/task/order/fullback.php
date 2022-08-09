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
    $logs = pdo_fetchall("select id,`day`,fullbackday,openid,priceevery,price,fullbacktime,goodsid,optionid from ".tablename('vending_machine_fullback_log')." where uniacid = ".$_W['uniacid']." and isfullback = 0 and (fullbacktime =0 or fullbacktime < ".strtotime('-1 days').") and fullbackday < day ");
    $today = strtotime(date("Y-m-d"),time());
    foreach ($logs as $key => $value){
        if(($value['day']-$value['fullbackday'])>1){
            $count = floor((time()-$value['fullbacktime'])/86400);//天数

            if($count>=1){
                // 如果一直没有执行在执行的时候直接到了完成的时间的话
                if($value['day']-$value['fullbackday']<=$count){
                    $count  = $value['day']-$value['fullbackday'];
                    $value['priceevery'] = $value['price']-$value['priceevery']*$value['fullbackday'];
                    $result = m('member')->setCredit($value['openid'], 'credit2', $value['priceevery'], array('0', $_W['shopset']['shop']['name'] . '全返余额' . $value['priceevery']));
                    pdo_update('vending_machine_fullback_log', array('fullbackday'=>$value['day'],'fullbacktime'=>$today,'isfullback'=>1), array('id' => $value['id']));
                }else{
                    $value['priceevery'] = $value['priceevery'] * $count;
                    $value['fullbackday'] = $value['fullbackday'] + $count;
                    $result = m('member')->setCredit($value['openid'], 'credit2', $value['priceevery'], array('0', $_W['shopset']['shop']['name'] . '全返余额' . $value['priceevery']));
                    pdo_update('vending_machine_fullback_log', array('fullbackday'=>$value['fullbackday'],'fullbacktime'=>$today), array('id' => $value['id']));
                }
            }
        }elseif(($value['day']-$value['fullbackday'])==1){
            $count = 1;
            $value['priceevery'] = $value['price']-$value['priceevery']*$value['fullbackday'];
            $result = m('member')->setCredit($value['openid'], 'credit2', $value['priceevery'], array('0', $_W['shopset']['shop']['name'] . '全返余额' . $value['priceevery']));
            pdo_update('vending_machine_fullback_log', array('fullbackday'=>$value['day'],'fullbacktime'=>time(),'isfullback'=>1), array('id' => $value['id']));
        }

        if($count>1){
            for ($i = 1; $i <= $count-1; $i++) {
                $logdata = array();
                $logdata['uniacid'] =  $_W['uniacid'];
                $logdata['fullback_time'] = $value['fullbacktime']+(86400*$i);
                $logdata['logid'] = $value['id'];
                $logdata['price'] = 0;
                $logdata['goodsid'] = $value['goodsid'];
                $logdata['optionid'] = $value['optionid'];
                $logdata['day'] = 0;
                pdo_insert('vending_machine_fullback_log_map',$logdata);
            }
        }
        $logdata = array();
        $logdata['uniacid'] =  $_W['uniacid'];
        $logdata['fullback_time'] = $today;
        $logdata['logid'] = $value['id'];
        $logdata['price'] = $value['priceevery'];
        $logdata['goodsid'] = $value['goodsid'];
        $logdata['optionid'] = $value['optionid'];
        $logdata['day'] = $count;
        pdo_insert('vending_machine_fullback_log_map',$logdata);
    }

}




