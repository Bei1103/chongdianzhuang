<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class List_Page extends WebPage {
    
    protected  function orderData($status, $st,$index){

        global $_W,$_GPC;


        /*
         * 插入代码
         * pdo_insert('vending_machine_cd_order',$data);
         *
         * $data  里面放要存入数据库的数据数组
         * */

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        if ($_GPC['export'] == 1) {
            $pindex = max(1, intval($index));
            $psize = 200;
        }

        $condition = " uniacid = :uniacid and deleted=0 ";
        $paras = array(':uniacid' => $_W['uniacid']);

        if ($status !== '') {

            if ($status == '-1') {
                $statuscondition = " AND o.status=-1 and (o.refundtime=0 or o.refundstate=3)";
                $priceStatus = " AND status=-1 and (refundtime=0 or refundstate=3)";
            } else if ($status == '4') {
                $statuscondition = " AND ((o.refundstate>0 and o.refundid<>0 and o.refundtime=0) or (o.refundstate>0 and o.refundtime=0 and o.refundstate=3))";
                $priceStatus = " AND (refundstate>0 and refundid<>0 or (o.refundtime=0 and o.refundstate=3))";
            } else if ($status == '5') {
                $statuscondition = " AND o.refundtime<>0";
                $priceStatus = " AND refundtime<>0";
            } else if ($status=='1'){
                $statuscondition = " AND ( o.status = 1 or (o.status=0 and o.paytype=3) )";
                $priceStatus = " AND ( status = 1 or (status=0 and paytype=3) )";
            } else if($status=='0'){
                $statuscondition = " AND o.status = 0 and o.paytype<>3";
                $priceStatus = " AND status = 0 and paytype<>3";
            }else if($status=='2'){
                $statuscondition = " AND ( o.status = 2 or (o.status=1 and o.sendtype>0) )";
                $priceStatus = " AND (  status = 2 or (status=1 and sendtype>0) )";
            }else {
                $statuscondition = " AND o.status = ".intval($status);
                $priceStatus = " AND o.status = ".intval($status);
            }
        }


        $sql = "select * from " . tablename('vending_machine_cd_order') . " where $condition ORDER BY createtime DESC  ";

        $sql.="LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        $list = pdo_fetchall($sql, $paras);
        $total = pdo_fetchcolumn("select count(*) from " . tablename('vending_machine_cd_order') . " where $condition ORDER BY createtime DESC  ", $paras);
        foreach($list as &$val){
            $val['member'] = m("member")->getMember($val['openid']);
        }

        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');
        include $this->template('chongdianzhuang/order/list');
    }

    function main() {
        global $_W,$_GPC;
        $orderData = $this->orderData('',__FUNCTION__,1);
    }

    function status0(){
        global $_W, $_GPC;
        $orderData = $this->orderData(0,__FUNCTION__,1);
    }

    function status1(){
        global $_W, $_GPC;
        $orderData = $this->orderData(1,__FUNCTION__,1);
    }

    function status2(){
        global $_W, $_GPC;
        $orderData = $this->orderData(2,__FUNCTION__,1);
    }

    function status3(){
        global $_W, $_GPC;
        $orderData = $this->orderData(3,__FUNCTION__,1);
    }


    function status4(){
        global $_W, $_GPC;
        $orderData = $this->orderData(4,__FUNCTION__,1);
    }

    function status5(){
        global $_W, $_GPC;
        $orderData = $this->orderData(5,__FUNCTION__,1);
    }




    function status_1(){
        global $_W, $_GPC;
        $orderData = $this->orderData(-1,__FUNCTION__,1);
    }

    public function ajaxgettotals()
    {
        global $_GPC;
        $merch = intval($_GPC['merch']);
        $totals = m('order')->getTotals($merch);
        $result = empty($totals) ? array() : $totals;
        show_json(1,$result);
    }

    public function updateChildOrderPay(){
        global $_W;

        $params = array();
        $params[':uniacid'] = $_W['uniacid'];

        $sql = "select id,parentid from " . tablename('vending_machine_order') . " where parentid>0 and status>0 and paytype=0 and uniacid=:uniacid";
        $list = pdo_fetchall($sql, $params);

        if (!empty($list)) {
            foreach($list as $k => $v) {
                $params[':orderid'] = $v['parentid'];
                $sql1 = "select paytype from " . tablename('vending_machine_order') . " where id=:orderid and status>0 and paytype>0 and uniacid=:uniacid";
                $item = pdo_fetch($sql1, $params);
                if ($item['paytype'] > 0) {
                    pdo_update('vending_machine_order', array('paytype' => $item['paytype']), array('id' => $v['id']));
                }

            }

        }
    }

    /**
     * 获取订单的维权状态
     * @param string $refund_type_text
     * @param $refund_status
     * author 洋葱
     * @return string
     */
    private function order_refund_status($refund_type_text = '',$refund_status){
        if($refund_status === false || empty($refund_type_text)){
            return $refund_type_text;
        }
        $status_text = '';
        switch ($refund_status) {
            case -2:
                $status_text = '客户取消'.$refund_type_text;
                break;
            case -1:
                $status_text = '已拒绝'.$refund_type_text;
                break;
            case 0:
                $status_text = '等待商家处理申请';
                break;
            case 1:
                $status_text = $refund_type_text.'完成';
                break;
            case 3:
                $status_text = '等待客户退回物品';
                break;
            case 4:
                $status_text = '客户退回物品，等待商家重新发货';
                break;
            case 5:
                $status_text = '等待客户收货';
                break;
            default:
                $status_text = $refund_type_text;
                break;
        }
        return $status_text;
    }

}
