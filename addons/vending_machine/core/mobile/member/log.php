<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Log_Page extends MobileLoginPage {

    function main() {
        global $_W, $_GPC;
        $_GPC['type'] = intval($_GPC['type']);
        include $this->template();
    }
    function get_list(){
        global $_W, $_GPC;
        $type = intval($_GPC['type']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;
        $apply_type = array(0 => '微信钱包', 2 => '支付宝', 3 => '银行卡');

        $condition = " and openid=:openid and uniacid=:uniacid and type=:type";
        $params = array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $_W['openid'],
            ':type' => intval($_GPC['type'])
        );
        $uidinfo = M('member')->getInfo($_W['openid']);
        $uid = $uidinfo['uid'];
        //$credit_condition = " and r.uniacid=".$_W['uniacid']." and r.credittype='credit2' and r.uid = ".$uid." and r.num > 0 order by r.createtime desc LIMIT ";
        $credit_condition = " and r.uniacid=".$_W['uniacid']." and r.credittype='credit2' and r.uid = ".$uid." and r.num > 0 and remark not like '%充值%' order by r.createtime desc LIMIT ";
        if($uid>0){
            $r = pdo_fetchall("select m.uid,m.mobile,m.nickname,r.remark title,r.num money,r.createtime from " . tablename("vending_machine_member_credit_record") . "r left join ".tablename('vending_machine_member')." m on m.uid = r.uid where 1 " . $credit_condition . ($pindex - 1) * $psize . ',' . $psize );
            foreach($r as &$item) {
                $item['createtime'] = date("Y-m-d H:i:s", $item['createtime']);
                // 交易类型
                $item['rechargetype'] = 'credit';
            }
            unset($item);
        }
        $list = pdo_fetchall("select * from " . tablename('vending_machine_member_log') . " where 1 {$condition} order by createtime desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize , $params);
        $total = pdo_fetchcolumn('select count(*) from ' . tablename('vending_machine_member_log') . " where 1 {$condition}", $params);
        foreach ($list as &$row) {
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            $row['typestr'] = $apply_type[$row['applytype']];
        }
        unset($row);
        if(is_array($r)){
            $list = array_merge($r, $list);
        }
        show_json(1,array('list'=>$list,'total'=>$total,'pagesize'=>$psize));
    }

}
