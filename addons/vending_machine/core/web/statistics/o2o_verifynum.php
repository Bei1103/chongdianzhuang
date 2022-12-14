<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class O2o_verifynum_Page extends WebPage {


    function main() {
        global $_W, $_GPC;

        //年份
        $years = array();
        $current_year = date('Y');
        $year = empty($_GPC['year']) ? $current_year : $_GPC['year'];
        for ($i = $current_year - 10; $i <= $current_year; $i++) {
            $years[] = array('data' => $i, 'selected' => ($i == $year));
        }
        //月份
        $months = array();
        $current_month = date('m');
        $month = $_GPC['month'];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = array('data' => $i, 'selected' => ($i == $month));
        }

        $day = intval($_GPC['day']);

        $params = array();

        if (!empty($year)) {

            $times ="00:00:00";
            $timee ="23:59:59";
            $yearst =  $year;
            $yearen =$year;
            if(empty($month))
            {
                $yearst =  $year;
                $yearen =$year+1;

                $monthst = 1;
                $monthen = 1;
                $days =1;
                $daye=1;
                $times ="00:00:00";
                $timee ="00:00:00";
            }else{
                $monthst = $month;
                $monthen = $month;

                if(empty($day))
                {
                    if($month<12)
                    {
                        $monthst = $month;
                        $monthen = $month+1;
                    }else
                    {
                        $monthst = 12;
                        $monthen = 1;
                        $yearen =$year+1;
                    }

                    $days = 1;
                    $daye = 1;

                    $times ="00:00:00";
                    $timee ="00:00:00";

                }else
                {
                    $days = $day;
                    $daye = $day;
                }
            }
            $starttime = strtotime("{$yearst}-{$monthst}-{$days} {$times}");
            $endtime = strtotime("{$yearen}-{$monthen}-{$daye} {$timee}");

            $btime ="{$yearst}/{$monthst}/{$days}";
            $etime ="{$yearen}/{$monthen}/{$daye}";


            $condition = "  and paytime >:stime and paytime < :etime";
            $params[':stime']=$starttime;
            $params[':etime']=$endtime;
        }

        $_GPC['keyword'] = trim($_GPC['keyword']);
        if (!empty($_GPC['keyword'])) {
            $condition2 =" and s.storename like :keyword";
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params[':uniacid']=$_W['uniacid'];


        $sql  = "SELECT  s.id, s.storename,ifnull(a.num,0) as num  from  " . tablename('vending_machine_store') . "   s left join    (SELECT  verifystoreid,count(*) as num from    " . tablename('vending_machine_order') . "  where uniacid=:uniacid  {$condition}  and isnewstore=1 GROUP BY verifystoreid) a on s.id =a.verifystoreid    where s.uniacid=:uniacid and s.`status`=1 {$condition2}  order by a.num desc";

        if(empty($_GPC['export'])){
            $sql.=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }

        $list = pdo_fetchall($sql, $params);


        $total = pdo_fetchcolumn("select  count(1) from " . tablename('vending_machine_store') ." where uniacid=:uniacid ", array(':uniacid'=>$_W['uniacid']));
        $pager = pagination($total, $pindex, $psize);




        //导出Excel
        if ($_GPC['export']==1) {

            // ca('statistics.member_cost.export');

            m('excel')->export($list, array(
                "title" => "会员消费排行报告-".date('Y-m-d-H-i',time()),
                "columns" => array(
                    array('title' => '门店id', 'field' => 'id', 'width' => 12),
                    array('title' => '门店名称', 'field' => 'storename', 'width' => 12),
                    array('title' => '核销订单数量', 'field' => 'num', 'width' => 12)
                )
            ));

            plog('statistics.member_cost.export','导出会员消费排行');

        }
        load()->func('tpl');


        include $this->template();
    }

}
