<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Goods_rank_Page extends WebPage {

    function main() {
        global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();

        $condition = " and og.uniacid={$_W['uniacid']} ";
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!empty($_GPC['datetime'])) {
            $starttime = strtotime($_GPC['datetime']['start']);
            $endtime = strtotime($_GPC['datetime']['end']);

            if (!empty($starttime)) {
                $condition .= " AND o.createtime >= {$starttime}";
            }

            if (!empty($endtime)) {
                $condition .= " AND o.createtime <= {$endtime} ";
            }

        }

        $condition1 = ' and g.uniacid=:uniacid';
        $params1 = array(':uniacid' => $_W['uniacid']);
        if (!empty($_GPC['title'])) {
            $_GPC['title'] = trim($_GPC['title']);
            $condition1.=" and g.title like :title";
            $params1[':title'] = "%{$_GPC['title']}%";
        }
        if (!empty($_GPC['cate'])) {
            $_GPC['cate'] = intval($_GPC['cate']);
            $condition1 .= " AND FIND_IN_SET({$_GPC['cate']},cates)<>0 ";
        }
        if(!empty($_GPC['group']) && !empty($_GPC['goodsids'])){
            $_GPC['group'] = intval($_GPC['group']);
            $_GPC['goodsids'] = intval($_GPC['goodsids']);
            $condition1 .= " AND g.id in (".$_GPC['goodsids'].")";
        }

        $orderby = !isset($_GPC['orderby']) ? 'ordercount' : (empty($_GPC['orderby']) ? 'money' : 'ordercount');

        $sql = "SELECT g.id,g.title,g.thumb,g.status,g.checked, g.total,g.deleted,g.type,g.merchid,sum( og.total ) ordercount,";
        $sql .= "sum( og.price ) money,count( re.id ) refundcount,ifnull( sum( re.price ), 0 ) refundprice ";
        $sql .= "FROM " . tablename('vending_machine_order_goods') . " og ";
        $sql .= "LEFT JOIN ".tablename('vending_machine_order')." o ON og.orderid = o.id  ";
        $sql .= "LEFT JOIN ".tablename('vending_machine_order_refund')." re ON og.orderid = re.orderid AND re.STATUS = 1 ";
        $sql .= "LEFT JOIN ".tablename('vending_machine_goods')." g ON g.id = og.goodsid ";
        $sql .= "WHERE 1 {$condition1} {$condition} AND og.uniacid = {$_W['uniacid']} and (o.status>=1 or o.refundid > 0) ";
        $sql .= "group by g.id,g.title,g.thumb,g.status,g.checked, g.total,g.deleted,g.type,g.merchid ";
        $sql .= "order by {$orderby} desc ";

        $total_list = pdo_fetchall($sql, $params1);

        if (empty($_GPC['export'])) {
            $sql.="LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params1);

        $total = count($total_list);

        $pager = pagination2($total, $pindex, $psize);
        foreach ($list as &$row) {
            if (intval($row['status']) > 0 && intval($row['checked']) == 0 && intval($row['total']) > 0 && intval($row['deleted']) == 0) {
                $row['goodsstatus'] = '?????????';
            } else if ($row['status'] > 0 && $row['total'] <= 0 && $row['deleted'] == 0 && $row['type'] != 30) {
                $row['goodsstatus'] = '?????????';
            } else if (($row['status'] == 0 || $row['checked'] == 1) && $row['deleted'] == 0) {
                $row['goodsstatus'] = '?????????';
            } else if ($row['deleted'] == 1) {
                $row['goodsstatus'] = '?????????';
            } else if ($row['deleted'] == 0 && $row['merchid'] > 0 && $row['checked'] == 1) {
                $row['goodsstatus'] = '?????????';
            }

        }
        unset($row);
//??????Excel
        if ($_GPC['export'] == 1) {

            ca('statistics.goods_rank.export');

            $list[] = array('data' => '??????????????????', 'count' => $total);
            foreach ($list as &$row) {
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            }
            unset($row);

            m('excel')->export($list, array(
                "title" => "??????????????????-" . date('Y-m-d-H-i', time()),
                "columns" => array(
                    array('title' => '????????????', 'field' => 'title', 'width' => 36),
                    array('title' => '?????????', 'field' => 'ordercount', 'width' => 12),
                    array('title' => '???????????????', 'field' => 'refundcount', 'width' => 12),
                    array('title' => '?????????', 'field' => 'money', 'width' => 12),
                    array('title' => '????????????', 'field' => 'refundprice', 'width' => 12)
                )
            ));

            plog('statistics.goods_rank.export', '????????????????????????');

        }
        $categorys = m('shop')->getFullCategory(true);
        $category = array();
        foreach($categorys as $cate){
            $category[$cate['id']] = $cate;
        }
        $con = " and uniacid=:uniacid and merchid=0";
        $params_g = array(':uniacid' => $_W['uniacid']);
        $groups = pdo_fetchall("SELECT id,name,goodsids FROM " . tablename('vending_machine_goods_group') . " WHERE 1 {$con}  ORDER BY id DESC", $params_g);

        load()->func('tpl');
        include $this->template('statistics/goods_rank');
    }

}
