<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Page_Page extends MobilePage {

    function main() {
        global $_W, $_GPC;
        $openid = $_W['openid'];
        $uniacd = $_W['uniacid'];
        $merchid = 0;

        //多商户
        $merch_plugin = p('merch');

        $saler = pdo_fetch('select * from ' . tablename('vending_machine_saler') . ' where openid=:openid and uniacid=:uniacid limit 1', array(
            ':uniacid' => $_W['uniacid'], ':openid' => $openid
        ));

        if (empty($saler) && $merch_plugin) {
            $saler = pdo_fetch('select * from ' . tablename('vending_machine_merch_saler') . ' where openid=:openid and uniacid=:uniacid limit 1', array(
                ':uniacid' => $_W['uniacid'], ':openid' => $openid
            ));
        }

        if (empty($saler)) {
            $this->message('您无核销权限!',"close");
        } else {
            $merchid = $saler['merchid'];
        }

        if(empty($saler['storeid'])){
            $this->message('您不属于任何门店，无法进行核销!',"close");
        }

        $member = m('member')->getMember($saler['openid']);
        $store = false;
        if (!empty($saler['storeid'])) {
            if ($merchid > 0) {
                $store = pdo_fetch('select * from ' . tablename('vending_machine_merch_store') . ' where id=:id and uniacid=:uniacid and merchid = :merchid limit 1', array(':id' => $saler['storeid'], ':uniacid' => $_W['uniacid'], ':merchid' => $merchid));

            } else {
                $store = pdo_fetch('select * from ' . tablename('vending_machine_store') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $saler['storeid'], ':uniacid' => $_W['uniacid']));
            }
        }

        include $this->template();
    }

    function search() {

        global $_W, $_GPC;

        $verifycode = trim($_GPC['verifycode']);
        if (empty($verifycode)) {
            show_json(0, '请填写核销码或自提码');
        }


        if( strlen($verifycode)==9 && substr($verifycode,0,1)=='8'){
            //记次核销码
            $verifygood=m('verifygoods')->search($verifycode);
            if(is_error($verifygood)){
                show_json(0,  $verifygood['message']);
            }
            show_json(1, array('verifygoodid' => $verifygood['id'],'verifycode'=>$verifycode, 'isverifygoods'=>1));


        }else {

            //普通订单
            $orderid = pdo_fetchcolumn('select id from ' . tablename('vending_machine_order') . " where uniacid=:uniacid and ( verifycode=:verifycode or verifycodes like :verifycodes ) limit 1 ", array(':uniacid' => $_W['uniacid'], ':verifycode' => $verifycode, ':verifycodes' => "%|{$verifycode}|%"));

            if (empty($orderid)) {
                show_json(0, '未查询到订单,请核对');
            }

            $allow = com('verify')->allow($orderid);
            if (is_error($allow)) {
                show_json(0, $allow['message']);
            }
            extract($allow);

            $verifyinfo = iunserializer($order['verifyinfo']);
            if ($order['verifytype'] == 2) {
                //如果是多码核销,选择的码选中，其他取消选择
                foreach ($verifyinfo as &$v) {
                    unset($v['select']);
                    if ($v['verifycode'] == $verifycode) {
                        if( $v['verified']){
                            show_json(0, '此消费码已经使用!');
                        }
                        $v['select'] = 1;
                    }
                }
                unset($v);
                pdo_update('vending_machine_order', array('verifyinfo' => iserializer($verifyinfo)), array('id' => $orderid));
            }

            show_json(1, array('orderid' => $orderid, 'istrade' => intval($order['istrade']),'isverifygoods'=>0));

        }


    }

    function complete() {
        global $_W, $_GPC;
        $openid = $_W['openid'];
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);
        $times = intval($_GPC['times']);
        com('verify')->verify($orderid, $times);
        show_json(1);
    }

}
