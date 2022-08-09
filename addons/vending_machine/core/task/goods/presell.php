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
    $goods = pdo_fetchall("select id,title,ispresell,presellover,presellovertime,presellstart,preselltimestart,presellend,preselltimeend from ".tablename('vending_machine_goods')." where uniacid = ".$_W['uniacid']." and ispresell > 0 and deleted = 0 ");
    if(!empty($goods)){
        foreach ($goods as $key => $value){
            //预售到期下架
            if($value['ispresell']==1 && $value['presellover']==0 && $value['presellend'] == 1){
                if($value['preselltimeend'] < time()) {
                    $value['status'] = 0;
                    pdo_update('vending_machine_goods', array('status' => $value['status']), array('id' => $value['id']));
                    plog('goods.edit', "自动修改商品状态 ID: {$value['id']}<br/>商品名称: {$value['title']}<br/> 状态:" . '预售自动下架');
                }
            }else if($value['ispresell']==1 && $value['presellover']==1 && $value['presellend'] == 1){
                //预售到期转为正常销售
                $time = ($value['presellover'] * 86400000);
                if(($value['preselltimeend']+$time)<time()){
                    $value['status'] = 0;
                    pdo_update('vending_machine_goods', array('ispresell' => $value['status']), array('id' => $value['id']));
                    plog('goods.edit', "自动修改商品状态 ID: {$value['id']}<br/>商品名称: {$value['title']}<br/> 状态:" . '预售结束');
                }
            }
        }
    }

}




