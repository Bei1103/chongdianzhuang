<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Coms_Page extends SystemPage {

	function main() {
	
		global $_W,$_GPC;
		if ($_W['ispost']) {
			if (!empty($_GPC['name'])) {
				foreach ($_GPC['name'] as $id => $name) {
					pdo_update('vending_machine_plugin', array(
						'status' => $_GPC['status'][$id],
                        'thumb' => $_GPC['thumb'][$id],
						'name' => $_GPC['name'][$id],
						), array('id' => $id));
				}
				//缓存
				m('plugin')->refreshCache(1);

				show_json(1);
			}
		}
		$condition = " and iscom=1 and deprecated=0";
		if (!empty($_GPC['keyword'])) {
			$condition.=" and identity like :keyword or name like :keyword";
			$params[':keyword'] = "%{$_GPC['keyword']}";
		}

		$list = pdo_fetchall('select * from ' . tablename('vending_machine_plugin') . " where 1 {$condition} order by displayorder asc", $params);
		$total = count($list);
		include $this->template();
		exit;
	}

}
