<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Goods_Page extends WebPage {

    function main() {
        global $_W, $_GPC;
		
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' and og.uniacid=:uniacid and o.status>=1';
        $params = array(':uniacid' => $_W['uniacid']);
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }

        if (!empty($_GPC['datetime'])) {
            $starttime = strtotime($_GPC['datetime']['start']);
            $endtime = strtotime($_GPC['datetime']['end']);

            if (!empty($starttime)) {
                $condition .= " AND o.createtime >= :starttime";
                $params[':starttime'] = $starttime;
            }

            if (!empty($endtime)) {
                $condition .= " AND o.createtime <= :endtime ";
                $params[':endtime'] = $endtime;
            }
        }

        if (!empty($_GPC['title'])) {
            $_GPC['title'] = trim($_GPC['title']);
            $condition.=" and g.title like :title";
            $params[':title'] = "%{$_GPC['title']}%";
        }
        $orderby = !isset($_GPC['orderby']) ? 'og.price' : ( empty($_GPC['orderby']) ? 'og.price' : 'og.total');

        $sql = "select og.price,og.total,o.createtime,o.ordersn,g.title,g.thumb,g.goodssn,op.goodssn as optiongoodssn,op.title as optiontitle from " . tablename('vending_machine_order_goods') . ' og '
            . " left join " . tablename('vending_machine_order') . " o on o.id = og.orderid "
            . " left join " . tablename('vending_machine_goods') . " g on g.id = og.goodsid "
            . " left join " . tablename('vending_machine_goods_option') . " op on op.id = og.optionid "
            . " where 1 {$condition} order by {$orderby} desc ";
        if (empty($_GPC['export'])) {
            $sql.="LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);
        foreach ($list as &$row) {
            if (!empty($row['optiongoodssn'])) {
                $row['goodssn'] = $row['optiongoodssn'];
            }
        }
        unset($row);
        $total = pdo_fetchcolumn("select  count(*) from " . tablename('vending_machine_order_goods') . ' og '
            . " left join " . tablename('vending_machine_order') . " o on o.id = og.orderid "
            . " left join " . tablename('vending_machine_goods') . " g on g.id = og.goodsid "
            . " where 1 {$condition}", $params);
        $pager = pagination2($total, $pindex, $psize);

//??????Excel
        if ($_GPC['export'] == 1) {

            ca('statistics.goods.export');

            $list[] = array('data' => '????????????', 'count' => $total);
            foreach ($list as &$row) {
//                $row['gtitle'] = $row['title'];
//                if (!empty($row['optiontitle'])) {
//                    $row['gtitle'] .= " " . $row['optiontitle'];
//                }

                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            }
            unset($row);

            m('excel')->export($list, array(
                "title" => "??????????????????-" . date('Y-m-d-H-i', time()),
                "columns" => array(
                    array('title' => '?????????', 'field' => 'ordersn', 'width' => 24),
                    array('title' => '????????????', 'field' => 'title', 'width' => 48),
                    array('title' => '????????????', 'field' => 'optiontitle', 'width' => 24),
                    array('title' => '????????????', 'field' => 'goodssn', 'width' => 12),
                    array('title' => '??????', 'field' => 'total', 'width' => 12),
                    array('title' => '??????', 'field' => 'price', 'width' => 12),
                    array('title' => '????????????', 'field' => 'createtime', 'width' => 24)
                )
            ));
			
			plog('statistics.goods.export', '????????????????????????');
			
        }
        load()->func('tpl');
        include $this->template('statistics/goods');
    }

}
