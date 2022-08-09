<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Quickget_Page extends MobileLoginPage {

    public function main(){
        global $_W, $_GPC;


        $id = intval($_GPC['id']);

        $openid= $_W['openid'];
        $member = m('member')->getMember($openid);
        if(empty($member))
        {
            header('location: ' . mobileUrl());die;
        }
        $time = time();

        $coupon = pdo_fetch('select * from ' . tablename('vending_machine_coupon') . ' where  1 and uniacid=:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'],':id' => $id));
        
        $gettotal = pdo_fetchcolumn('select count(*) from ' . tablename('vending_machine_coupon_data') . ' where couponid=:couponid and uniacid=:uniacid limit 1', array(':couponid' => $id, ':uniacid' => $_W['uniacid']));
        $left_count = $coupon['total'] -  $gettotal;
        $left_count = intval($left_count);


        if ((empty($coupon)||empty($coupon['quickget']) || $left_count<=0) && $coupon['total'] != -1) {
            
            header('location: ' . mobileUrl());die;
            
        }


        //增加优惠券日志
        $couponlog = array(
            'uniacid' => $_W['uniacid'],
            'openid' => $member['openid'],
            'logno' => m('common')->createNO('coupon_log', 'logno', 'CC'),
            'couponid' => $id,
            'status' => 1,
            'paystatus' => -1,
            'creditstatus' => -1,
            'createtime' => time(),
            'getfrom' => 8
        );
        pdo_insert('vending_machine_coupon_log', $couponlog);

        //增加用户优惠券
        $data = array(
            'uniacid' => $_W['uniacid'],
            'openid' => $member['openid'],
            'couponid' => $id,
            'gettype' => 8,
            'gettime' => time()
        );
        pdo_insert('vending_machine_coupon_data', $data);
        $id = pdo_insertid();

        header('location: ' . mobileUrl('sale/coupon/my/showcoupons2',array("id"=>$id)));

    }
}
