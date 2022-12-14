<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Manage_Page extends SystemPage {

	function main() {
		global $_W, $_GPC;

		$wechatid = intval($_GPC['wechatid']);
		if (!empty($wechatid) && $wechatid != -1) {
			$copyrights = pdo_fetch('select * from ' . tablename('vending_machine_system_copyright') . " where uniacid={$wechatid} and ismanage=1 limit 1");
		}
		if (empty($copyrights)) {
			$copyrights = pdo_fetch('select * from ' . tablename('vending_machine_system_copyright') . " where uniacid=-1 and ismanage=1 limit 1");
		}

		if ($_W['ispost']) {

            if (strpos($_GPC['logo'], 'http') == false || strpos($_GPC['logo'], 'https') == false) {
                $_GPC['logo'] = tomedia($_GPC['logo']);
            }

			$condition = "";
			$acid = 0;
			$where = array();
			$sets = pdo_fetchall('select uniacid from ' . tablename('vending_machine_sysset'));
			$post = htmlspecialchars_decode($_GPC['copyright']);
			foreach ($sets as $set) {
				$uniacid = $set['uniacid'];
				if ($wechatid == $uniacid || $wechatid == -1) {
					$cs = pdo_fetch('select * from ' . tablename('vending_machine_system_copyright') . " where uniacid=:uniacid and ismanage=1  limit 1", array(':uniacid' => $uniacid));
					if (empty($cs)) {
						pdo_insert('vending_machine_system_copyright', array('uniacid' => $uniacid, 'copyright' => $post, 'logo' => $_GPC['logo'] ,'title'=>$_GPC['title'], 'ismanage' => 1));
					} else {
						pdo_update('vending_machine_system_copyright', array('copyright' => $post, 'logo' => $_GPC['logo'],'title'=>$_GPC['title']), array('uniacid' => $uniacid, 'ismanage' => 1));
					}
				}
			}
			if ($wechatid == -1) {
				$global_copyrights = pdo_fetch('select * from ' . tablename('vending_machine_system_copyright') . " where uniacid=-1 and ismanage=1 limit 1");
				if (empty($global_copyrights['id'])) {
					pdo_insert('vending_machine_system_copyright', array('uniacid' => -1, 'copyright' => $post, 'logo' => $_GPC['logo'],'title'=>$_GPC['title'], 'ismanage' => 1));
				} else {
					pdo_update('vending_machine_system_copyright', array('copyright' => $post, 'ismanage' => 1, 'logo' => $_GPC['logo'],'title'=>$_GPC['title']), array('uniacid' => -1, 'ismanage' => 1));
				}
			}

			$copyrights = pdo_fetchall('select *  from ' . tablename('vending_machine_system_copyright'));
			m('cache')->set('systemcopyright', $copyrights, 'global');
			show_json(1);
		}
		$wechats = m('common')->getWechats();
		$wechats = array_filter($wechats);
		include $this->template();
	}

}
