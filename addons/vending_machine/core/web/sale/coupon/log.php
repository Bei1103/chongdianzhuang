<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Log_Page extends ComWebPage {

    public function __construct($_com = 'coupon')
    {
        parent::__construct($_com);
    }

    function main() {
        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' d.uniacid = :uniacid and d.merchid=0';
        $params = array(':uniacid' => $_W['uniacid']);
        $couponid = intval($_GPC['couponid']);

        if (!empty($couponid)) {
            $coupon = pdo_fetch('select * from ' . tablename('vending_machine_coupon') . ' where id=:id and uniacid=:uniacid and merchid=0 limit 1', array(':id' => $couponid, ':uniacid' => $_W['uniacid']));
            $condition .= " AND c.id=" . intval($couponid);
        }
        $searchfield = strtolower(trim($_GPC['searchfield']));
        $keyword = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($keyword)) {
            if ($searchfield == 'member') {
                $condition.=' and ( m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
            } else if ($searchfield == 'coupon') {
                $condition.=' and c.couponname like :keyword';
            }
            $params[':keyword'] = "%{$keyword}%";
        }

        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (empty($starttime1) || empty($endtime1)) {
            $starttime1 = strtotime('-1 month');
            $endtime1 = time();
        }
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);


            $condition .= " AND d.gettime >= :starttime AND d.gettime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
        if (!empty($_GPC['time1']['start']) && !empty($_GPC['time1']['end'])) {
            $starttime1 = strtotime($_GPC['time1']['start']);
            $endtime1 = strtotime($_GPC['time1']['end']);

            $condition .= " AND d.usetime >= :starttime1 AND d.usetime <= :endtime1 ";
            $params[':starttime1'] = $starttime1;
            $params[':endtime1'] = $endtime1;
        }
        if ($_GPC['type'] != '') {
            $condition .= ' AND c.coupontype = :coupontype';
            $params[':coupontype'] = intval($_GPC['type']);
        }
        if ($_GPC['used'] != '') {
            $condition .= ' AND d.used =' . intval($_GPC['used']);
        }
        if ($_GPC['gettype'] != '') {
            $condition .= ' AND d.gettype = :gettype';
            $params[':gettype'] = intval($_GPC['gettype']);
        }

        $sql = 'SELECT d.*, c.coupontype,c.couponname,m.nickname,m.avatar,m.realname,m.mobile FROM ' . tablename('vending_machine_coupon_data') . " d "
            . " left join " . tablename('vending_machine_coupon') . " c on d.couponid = c.id "
            . " left join " . tablename('vending_machine_member') . " m on m.openid = d.openid and m.uniacid = d.uniacid "
            . " where  1 and {$condition} ORDER BY gettime DESC";
        if (empty($_GPC['export'])) {
            $sql.=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);
        foreach ($list as &$row) {

            $couponstr = "??????";
            if ($row['coupontype'] == 1) {
                $couponstr = "??????";
            }
            $row['couponstr'] = $couponstr;
            if ($row['gettype'] == 0) {
                $row['gettypestr'] = "????????????";
            } else if ($row['gettype'] == 1) {
                $row['gettypestr'] = "????????????";
            } else if ($row['gettype'] == 2) {
                $row['gettypestr'] = "????????????";
            } else if ($row['gettype'] == 3) {
                $row['gettypestr'] = "????????????";
            } else if ($row['gettype'] == 4) {
                $row['gettypestr'] = "????????????";
            } else if ($row['gettype'] == 5) {
                $row['gettypestr'] = "????????????";
            }else if ($row['gettype'] == 6) {
                $row['gettypestr'] = "????????????";
            }else if ($row['gettype'] == 7) {
                $row['gettypestr'] = "????????????";
            }else if ($row['gettype'] == 8) {
                $row['gettypestr'] = "????????????";
            }else if ($row['gettype'] == 9) {
                $row['gettypestr'] = "???????????????";
            }else if ($row['gettype'] == 10) {
                $row['gettypestr'] = "???????????????????????????";
            }else if ($row['gettype'] == 11) {
                $row['gettypestr'] = "????????????????????????";
            }else if ($row['gettype'] == 12) {
                $row['gettypestr'] = "????????????????????????";
            }else if ($row['gettype'] == 13) {
                $row['gettypestr'] = "???????????????";
            }else if ($row['gettype'] == 14) {
                $row['gettypestr'] = "????????????";
            }else if ($row['gettype'] == 15) {
                $row['gettypestr'] = "????????????";
            }
        }
        unset($row);
        if ($_GPC['export'] == 1) {
            ca('sale.coupon.log.export');

            foreach ($list as &$row) {

                $row['gettime'] = date('Y-m-d H:i', $row['gettime']);
                if (!empty($row['usetime'])) {
                    $row['usetime'] = date('Y-m-d H:i', $row['usetime']);
                } else {
                    $row['usetime'] = "---";
                }
            }
            $columns = array(
                array('title' => 'ID', 'field' => 'id', 'width' => 12),
                array('title' => '?????????', 'field' => 'couponname', 'width' => 24),
                array('title' => '??????', 'field' => 'couponstr', 'width' => 12),
                array('title' => '????????????', 'field' => 'nickname', 'width' => 12),
                array('title' => '??????', 'field' => 'realname', 'width' => 12),
                array('title' => '?????????', 'field' => 'mobile', 'width' => 12),
                array('title' => 'openid', 'field' => 'openid', 'width' => 24),
                array('title' => '????????????', 'field' => 'gettypestr', 'width' => 12),
                array('title' => '????????????', 'field' => 'gettime', 'width' => 12),
                array('title' => '????????????', 'field' => 'usetime', 'width' => 12),
                array('title' => '????????????', 'field' => 'ordersn', 'width' => 12)
            );
            m('excel')->export($list, array(
                "title" => "???????????????-" . date('Y-m-d-H-i', time()),
                "columns" => $columns
            ));
            plog('sale.coupon.log.export', '???????????????????????????');
        }
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('vending_machine_coupon_data') . " d "
            . " left join " . tablename('vending_machine_coupon') . " c on d.couponid = c.id "
            . " left join " . tablename('vending_machine_member') . " m on m.openid = d.openid and m.uniacid = d.uniacid "
            . "where 1 and {$condition}", $params);
        $pager = pagination2($total, $pindex, $psize);
        include $this->template();
    }

}
