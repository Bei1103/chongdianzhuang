<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}
require VENDING_MACHINE_PLUGIN . 'chongdianzhuang/core/page_login_mobile.php';

class Bonus_Page extends chongdianzhuangMobileLoginPage
{

    function main()
    {
        global $_W, $_GPC;
        $status = intval($_GPC['status']);
        $bonus = $this->model->getBonus($_W['openid'], array('ok', 'lock', 'total'));
        include $this->template();
    }
    //网页后端
    //支付
    public function detail()
    {
        global $_W,$_GPC;
        $id = intval($_GPC['id']);
        $uniacid = $_W['uniacid'];
        $openid =$_W['openid'];

        $rank = intval($_GPC['rank']);
        $detail = pdo_get('vending_machine_xc_charge',array('id'=>$id));
        $ports = explode(",", $detail['port_status']);

//        $login = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/login',['id'=>$id]),2);
        $person = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/person',['id'=>$id]),2);


        $post_port = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang.bonus.detail'),2);
        $post_money = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang.bonus.detail'),2);
        $paytype = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang.bonus.detail'),2);
        $order =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/order',['id'=>$id]),2);
        $wxpay_limit=1;

        $fee = $_GPC['fee'];


if($_W['ispost']){
    //添加去订单
    $device_data = array(
        'por' => $_GPC['port'],
        //金额 ,时间  都是这里
        'money' => $_GPC['fee'],
        'paytype' => $_GPC['pay_type'],
        'openid' => $_W['openid']
    );

    $result = pdo_insert('vending_machine_cd_order', $device_data);


}
$openid =$_W['openid'];
        include $this->template();
    }
    //个人
    public function person()
    {
        global $_W,$_GPC;
        $openid =$_W['openid'];
        $id = intval($_GPC['id']);
        //订单分类
//        $openid = $_GPC['openid'];
        $where = 1;
        if ($openid){
            $where .= ' and `openid`=:openid';
            $param[':openid'] = $openid;
        }
//        $xc_charge = pdo_fetchall("select * from " . tablename('vending_machine_xc_charge') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
//        $xc_p = pdo_fetch("select * from " . tablename('vending_machine_xc_paylog') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
//        $xc_p= pdo_fetch("SELECT * FROM " . tablename('vending_machine_member') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        $url = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/detail',['id'=>$id]),2);
        $person = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/person',['id'=>$id]),2);
        $order =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/order',['id'=>$id]),2);
        include $this->template();
    }
    //订单
    public function order()
    {
        global $_W,$_GPC;
        $id = intval($_GPC['id']);
        //删除
        if($_GPC['ac'] == 'del') {
            $_GPC['id'] || show_message("ID缺失！", "", "error");
            pdo_delete("vending_machine_cd_order", array("id" => intval($_GPC['id'])));
        }

        $xc_p = pdo_fetchall("select * from " . tablename('vending_machine_cd_order') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
//        $xc_p = pdo_fetch("select * from " . tablename('vending_machine_xc_paylog') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $url = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/detail',['id'=>$id]),2);
        $person = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/person',['id'=>$id]),2);
        $order =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/order',['id'=>$id]),2);
        $orderover =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderover',['id'=>$id]),2);
        $orderno =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderno',['id'=>$id]),2);
        include $this->template();
    }
    //订单-已付款
    public function orderover()
    {
        global $_W,$_GPC;
        $id = intval($_GPC['id']);
        $xc_p = pdo_fetch("select * from " . tablename('vending_machine_xc_paylog') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $person = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/person',['id'=>$id]),2);
        $order =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/order',['id'=>$id]),2);
        $orderover =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderover',['id'=>$id]),2);
        $orderno =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderno',['id'=>$id]),2);
        include $this->template();
    }
    //订单-未付款
    public function orderno()
    {
        global $_W,$_GPC;
        $id = intval($_GPC['id']);
        $xc_p = pdo_fetch("select * from " . tablename('vending_machine_xc_paylog') . "   ORDER BY id DESC  ", array(':uniacid'=>$_W['uniacid']));
        $person = $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/person',['id'=>$id]),2);
        $order =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/order',['id'=>$id]),2);
        $orderover =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderover',['id'=>$id]),2);
        $orderno =  $_W['siteroot']."app/".substr(mobileUrl('chongdianzhuang/bonus/orderno',['id'=>$id]),2);
        include $this->template();
    }




    function get_list()
    {

        global $_W, $_GPC;
        $member = m('member')->getMember($_W['openid']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        $condition = " and b.openid=:openid and b.uniacid=:uniacid";
        $params = array(
            ':openid' => $_W['openid'],
            ':uniacid' => $_W['uniacid']
        );
        $status = trim($_GPC['status']);
        if ($status == 1) {
            $condition .= ' and b.status=1';
        } elseif ($status == 2) {
            $condition .= ' and (b.status=-1 or b.status=0)';
        }
        
        $sql = "select b.*,m.aagenttype  from " . tablename('vending_machine_chongdianzhuang_billp') . " b "
              ." left join ".tablename('vending_machine_member')." m on b.uniacid=m.uniacid and m.openid = b.openid "
              ." where 1 {$condition} order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        foreach($list as &$row){
            $row['paymoney'] = round( $row['paymoney1'] +$row['paymoney2'] + $row['paymoney3'] ,2);
        }
        unset($row);

        $total = pdo_fetchcolumn("select count(*)  from " . tablename('vending_machine_chongdianzhuang_billp') . " b "
              ." left join ".tablename('vending_machine_member')." m on b.uniacid=m.uniacid and m.openid = b.openid "
              ." where 1 {$condition} limit 1", $params);
        show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize));

    }

}
