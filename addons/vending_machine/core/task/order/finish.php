<?php
//自动完成

error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/vending_machine/defines.php';
require '../../../../../addons/vending_machine/core/inc/functions.php';
require '../../../../../addons/vending_machine/core/inc/plugin_model.php';
global $_W, $_GPC;

ignore_user_abort(); //忽略关闭浏览器
set_time_limit(0); //永远执行

$sets = pdo_fetchall('select uniacid from ' . tablename('vending_machine_sysset'));
foreach ($sets as $set) {

    $_W['uniacid'] = $set['uniacid'];
    if (empty($_W['uniacid'])) {
        continue;
    }

    $p = p('commission');
    $pcoupon = com('coupon');

    $orders = pdo_fetchall("select * from " . tablename('vending_machine_order') . " where uniacid={$_W['uniacid']} and status = 1 and createtime>=".strtotime('20210101 00:00:00'), array(), 'id');
    print_r($orders);

    if (!empty($orders)) {
        foreach ($orders as $orderid => $order) {
            
            $time = time();
            pdo_update('vending_machine_order', array('status' => 3, 'finishtime' => time()), array('id' => $order['id']));

            //多商户父订单跳过
            if ($order['isparent'] == 1) {
                continue;
            }
            //会员升级
            m('member')->upgradeLevel($order['openid'], $orderid);
            //余额赠送
            m('order')->setGiveBalance($orderid, 1);
            //模板消息
            m('notice')->sendOrderMessage($orderid);
            //商品全返
            //m('order')->fullback($orderid);
            //处理积分
            m('order')->setStocksAndCredits($orderid, 3);
            //优惠券返利
            if ($pcoupon) {
                if (!empty($order['couponid'])) {
                    $pcoupon->backConsumeCoupon($order['id']); //用券送券
                }
                //发送赠送优惠券
                $pcoupon->sendcouponsbytask($order['id']); //订单完成购物送券
            }
            //分销检测
            if ($p) {
                $p->checkOrderFinish($orderid);
            }
            //抽奖
            if(p('lottery') && $order['merchid'] == 0){
                //type 1:消费 2:签到 3:任务 4:其他
                $res = p('lottery')->getLottery($order['openid'],1,array('money'=>$order['price'],'paytype'=>2));
                if($res){
                    p('lottery')->getLotteryList($order['openid'],array('lottery_id'=>$res));
                }
            }
        }
    }
}

