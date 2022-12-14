<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Recommand_Page extends WebPage {

	function main() {

		global $_W, $_GPC;

		
		if ($_W['ispost']) {
			$shop = $_W['shopset']['shop'];
			$shop['indexrecommands'] = $_GPC['goodsid'];
			m('common')->updateSysset(array('shop' => $shop));
			plog('shop.recommand', '修改首页推荐商品设置');
			show_json(1);
		}
		
		$goodsids = isset($_W['shopset']['shop']['indexrecommands'])?implode(",",$_W['shopset']['shop']['indexrecommands']):'';
		$goods = false;
		if(!empty($goodsids)){
			$goods = pdo_fetchall('select id,title,thumb from '.tablename('vending_machine_goods')." where id in ({$goodsids}) and status=1 and deleted=0 and uniacid={$_W['uniacid']} order by instr('{$goodsids}',id)");
		}
		$goodsstyle = $_W['shopset']['shop']['goodsstyle'];
					
		include $this->template();
	}
	
	function setstyle(){
		global $_W, $_GPC;
		$shop = $_W['shopset']['shop'];
		$shop['goodsstyle'] = intval($_GPC['goodsstyle']);
		m('common')->updateSysset(array('shop' => $shop));
		plog('shop.recommand', '修改手机端商品组样式');
		show_json(1);
	}

}
