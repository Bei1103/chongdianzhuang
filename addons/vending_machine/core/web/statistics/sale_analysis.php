<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Sale_analysis_Page extends WebPage {

	function main() {
		global $_W, $_GPC;

		function sale_analysis_count($sql) {
			$c = pdo_fetchcolumn($sql);
			return intval($c);
		}

//会员数
		$member_count = sale_analysis_count("SELECT count(*) FROM " . tablename('vending_machine_member') . "   WHERE uniacid = '{$_W['uniacid']}' ");

//订单总金额
		$orderprice = sale_analysis_count("SELECT sum(price) FROM " . tablename('vending_machine_order') . " WHERE status>=1 and uniacid = '{$_W['uniacid']}' ");

//订单总数
		$ordercount = sale_analysis_count("SELECT count(*) FROM " . tablename('vending_machine_order') . " WHERE status>=1 and uniacid = '{$_W['uniacid']}' ");

//商品总浏览量
		$viewcount = sale_analysis_count("SELECT sum(viewcount) FROM " . tablename('vending_machine_goods') . " WHERE uniacid = '{$_W['uniacid']}' ");

//消费过的会员数
		$member_buycount = sale_analysis_count("select count(*) from " . tablename('vending_machine_member') . " where uniacid={$_W['uniacid']} and  openid in ( SELECT distinct openid from " . tablename('vending_machine_order') . "   WHERE uniacid = '{$_W['uniacid']}' and status>=1 )");

		include $this->template('statistics/sale_analysis');
	}

}
