<?php

error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/vending_machine/defines.php';
require '../../../../../addons/vending_machine/core/inc/functions.php';
global $_W, $_GPC;

ignore_user_abort(); //忽略关闭浏览器
set_time_limit(0); //永远执行

$cycel = m('common')->getSysset('cycelbuy',$_GPC['uniacid']);

$_W['uniacid'] = $_GPC['uniacid'];
$terminal = empty($cycel['terminal']) ? 3 : $cycel['terminal'];

$order = pdo_fetchall("select id,openid,deductcredit2,price,address,ordersn,isparent,deductcredit,deductprice,status,isparent,isverify,`virtual`,`virtual_info`,createtime,cycelbuy_periodic from " . tablename('vending_machine_order') . " where uniacid={$_W['uniacid']}  and paytype<>3   and status=2 and iscycelbuy = 1");
if(!empty($order)){
    foreach($order as $k => $v){
        $cycelbuy_periodic = explode(',',$v['cycelbuy_periodic']);
        $cycel = pdo_fetchall('select * from ' .tablename('vending_machine_cycelbuy_periods'). ' where  orderid = '.$v['id'].' and status = 0 and uniacid = '.$_W['uniacid'].' order by receipttime asc limit 1');
        $cycelsn = explode('_',$cycel[0]['cycelsn']);
        $num = $cycelsn[1];
        $v['num'] = $num;
        if($cycelbuy_periodic[1] == 0 && $cycelbuy_periodic[0] < 3 ){
            $days = time() + 86400 * $cycelbuy_periodic[0];
            if($days >= $cycel['receipttime']){
                p('cycelbuy') -> sendMessage(null,$v,'TM_CYCELBUY_SELLER_SEND');
            }
        }else{
            $days = time() + 86400 * $terminals;
            if($days >= $cycel['receipttime']){
                p('cycelbuy') ->  sendMessage(null,$v,'TM_CYCELBUY_SELLER_SEND');
            }
        }
    }
}





