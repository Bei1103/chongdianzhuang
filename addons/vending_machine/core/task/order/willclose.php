<?php
error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/vending_machine/defines.php';
require '../../../../../addons/vending_machine/core/inc/functions.php';
global $_W, $_GPC;

ignore_user_abort(); //忽略关闭浏览器
set_time_limit(0); //永远执行

$uniacids = m('cache')->get('willcloseuniacid','global');

if(empty($uniacids))
{
    return;
}

foreach ($uniacids as $uniacid) {
    if (empty($uniacid)) {
        continue;
    }


    //客服消息
    //m('message')->sendTexts('odHZUwd3v46HmldLoihhD6NwuNBY', '111111');

    $_W['uniacid'] = $uniacid;
    $trade = m('common')->getSysset('trade', $_W['uniacid']);
    $days = intval($trade['closeorder']);
    $minute = intval($trade['willcloseorder']);

    if ($days <= 0) {
        //不自动关闭订单
        exit;
    }

    //默认30分钟发送
    if($minute==0)
    {
        $minute=30;
    }
    $minute*=60;

    $daytimes = 86400 * $days;
    $orders = pdo_fetchall("select id,openid,deductcredit2,ordersn,isparent,deductcredit,deductprice from " . tablename('vending_machine_order') . " where  uniacid={$_W['uniacid']} and status=0 and paytype<>3 and willcancelmessage <>1 and createtime + {$daytimes}- {$minute}<=unix_timestamp() ");

    foreach ($orders as $o) {
        /*echo ('--xxx--');
        echo ($o['id']);*/
        $onew = pdo_fetch('select id,status  from ' . tablename('vending_machine_order') . " where id=:id and status=0 and paytype<>3  and createtime + {$daytimes}- {$minute} <=unix_timestamp()  limit 1", array(':id' => $o['id']));
        if(!empty($onew) && $onew['status']==0){
            m('notice')->sendOrderWillCancelMessage($onew['id'],$daytimes);
        }
    }
}



