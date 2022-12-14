<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Order_Page extends WebPage {

    function main() {
        global $_W, $_GPC;
        ini_set("memory_limit","5000M");
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' and o.uniacid=:uniacid and o.status>=1';
        $params = array(':uniacid' => $_W['uniacid']);
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!empty($_GPC['datetime']['start']) && !empty($_GPC['datetime']['end'])) {
            $starttime = strtotime($_GPC['datetime']['start']);
            $endtime = strtotime($_GPC['datetime']['end']);

            $condition .= " AND o.createtime >= :starttime AND o.createtime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
        $searchfield = strtolower(trim($_GPC['searchfield']));
        $_GPC['keyword'] = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($_GPC['keyword'])) {
            if ($searchfield == 'ordersn') {
                $condition.=" and o.ordersn like :keyword";
            } else if ($searchfield == 'member') {
                $condition.=" and ( m.realname like :keyword or m.mobile like :keyword)";
            } else if ($searchfield == 'address') {
                $condition.=" and a.realname like :keyword";
            }
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }

        $condition .= " and o.deleted = 0 group by o.id";

        $field = "o.id,o.createtime,o.ordersn,o.paytype,o.price,o.goodsprice,o.dispatchprice,o.discountprice,o.deductprice,o.deductcredit2,o.deductenough,o.couponprice,o.changeprice,a.realname as addressname,m.realname";
        $sql = "select {$field} from " . tablename('vending_machine_order') . ' o '
            . " left join " . tablename('vending_machine_member') . " m on o.openid = m.openid "
            . " left join " . tablename('vending_machine_member_address') . " a on a.id = o.addressid "
            . " where 1 {$condition} ";

        if (empty($_GPC['export'])) {
            $sql.="LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);
        $totalmoney = 0;
        foreach ($list as &$row) {
            $row['ordersn'] = $row['ordersn'] . " ";
            $row['goods'] = pdo_fetchall("SELECT g.thumb,og.price,og.total,og.realprice,g.title,og.optionname from " . tablename('vending_machine_order_goods') . " og"
                . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid  "
                . " where og.uniacid = :uniacid and og.orderid=:orderid order by og.createtime  desc ", array(':uniacid' => $_W['uniacid'], ':orderid' => $row['id']));
            $totalmoney+=$row['price'];
            if ($_GPC['export'] == 1){
                if ($row['paytype'] == 1) {
                    $row['paytype'] = '????????????';
                } else if ($row['paytype'] == 11) {
                    $row['paytype'] = '????????????';
                } else if ($row['paytype'] == 21) {
                    $row['paytype'] = '????????????';
                } else if ($row['paytype'] == 22) {
                    $row['paytype'] = '???????????????';
                } else if ($row['paytype'] == 23) {
                    $row['paytype'] = '????????????';
                } else if ($row['paytype'] == 3) {
                    $row['paytype'] = '????????????';
                }
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            }
        }
        unset($row);

        $totalcount = $total = pdo_fetchall("select o.id from " . tablename('vending_machine_order') . ' o '
            . " left join " . tablename('vending_machine_member') . " m on o.openid = m.openid "
            . " left join " . tablename('vending_machine_member_address') . " a on a.id = o.addressid "
            . " where 1 {$condition}", $params);
        $totalcount = $total = count($total);
        $pager = pagination2($total, $pindex, $psize);


//??????Excel
        if ($_GPC['export'] == 1) {

            ca('statistics.order.export');
            
            $list[] = array('data' => '????????????', 'count' => $totalcount);
            $list[] = array('data' => '????????????', 'count' => $totalmoney);

            m('excel')->export($list, array(
                "title" => "????????????-" . date('Y-m-d-H-i', time()),
                "columns" => array(
                    array('title' => '?????????', 'field' => 'ordersn', 'width' => 24),
                    array('title' => '?????????', 'field' => 'price', 'width' => 12),
                    array('title' => '????????????', 'field' => 'goodsprice', 'width' => 12),
                    array('title' => '??????', 'field' => 'dispatchprice', 'width' => 12),
                    array('title' => '????????????', 'field' => 'paytype', 'width' => 12),
                    array('title' => '?????????', 'field' => 'realname', 'width' => 12),
                    array('title' => '?????????', 'field' => 'addressname', 'width' => 12),
                    array('title' => '????????????', 'field' => 'createtime', 'width' => 24)
                )
            ));
			
			plog('statistics.order.export', '??????????????????');
			
        }
        load()->func('tpl');
        include $this->template('statistics/order');
    }

}
