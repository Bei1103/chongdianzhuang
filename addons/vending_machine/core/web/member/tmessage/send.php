<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Send_Page extends WebPage
{

	function main() {

		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		if (!empty($id)) {
			$send = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_member_message_template') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		$list = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_member_level') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY level asc");
		$list2 = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_member_group') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id asc");
		$list3 = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_commission_level') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id asc");
		include $this->template();
	}

	function fetch() {
		global $_W, $_GPC;

		if (!cv('member.tmessage.send')) {
			show_json(0, '您没有权限!');
		}
        $id = intval($_GPC['id']);
		if (!empty($id)) {
			$send = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_member_message_template') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		if (empty($send)) {
			show_json(0, '未找到群发模板!');
		}
		$class1 = $_GPC['class1']; //1:openid 2:level 3:class 4:all
		$value1 = $_GPC['value1'];
		$tpid1 = $_GPC['tpid'];
		pdo_update('vending_machine_member_message_template', array('sendtimes' => $send['sendtimes'] + 1), array('id' => $id));

		$typestr = "指定 OPENID";
		if ($class1 == 1) {
			$openids = explode(",", trim($value1));
			$arr = array();
			foreach ($openids as $oid) {
				$arr[] = "'" . $oid . "'";
			}
			$typestr = "指定 OPENID";

			$member = pdo_fetchall("SELECT openid FROM " . tablename('vending_machine_member') . " WHERE openid in (" . implode(",", $arr) . ") and uniacid= {$_W['uniacid']}", array(), 'openid');
		} elseif ($class1 == 2) {
			$where = '';
			if ($value1 != '') {
				$where.= " and level =" . intval($value1);
			}
			$member = pdo_fetchall("SELECT openid FROM " . tablename('vending_machine_member') . " WHERE uniacid = '{$_W['uniacid']}'" . $where, array(), 'openid');
			if (!empty($value1)) {
				$levelname = pdo_fetchcolumn('select levelname from ' . tablename('vending_machine_member_level') . ' where id=:id limit 1', array(':id' => $value1));
			} else {
				$levelname = "全部等级";
			}
			$typestr = "等级-{$levelname}";
		} elseif ($class1 == 3) {
			$where = '';
			if ($value1 != '') {
				$where.= " and groupid =" . intval($value1);
			}
			$member = pdo_fetchall("SELECT openid FROM " . tablename('vending_machine_member') . " WHERE uniacid = '{$_W['uniacid']}'" . $where, array(), 'openid');
			if (!empty($value1)) {
				$groupname = pdo_fetchcolumn('select groupname from ' . tablename('vending_machine_member_group') . ' where id=:id limit 1', array(':id' => $value1));
			} else {
				$groupname = "全部分组";
			}
			$typestr = "分组-{$groupname}";
		} elseif ($class1 == 4) {
			$member = pdo_fetchall("SELECT openid FROM " . tablename('vending_machine_member') . " WHERE uniacid = '{$_W['uniacid']}'", array(), 'openid');
			$typestr = "全部会员";
		} elseif ($class1 == 5) {
			$where = '';
			if ($value1 != '') {
				$where.= " and agentlevel =" . intval($value1);
			}
			$member = pdo_fetchall("SELECT openid FROM " . tablename('vending_machine_member') . " WHERE uniacid = '{$_W['uniacid']}' and isagent=1 and status=1 " . $where, array(), 'openid');

			if (!empty($value1)) {
				$levelname = pdo_fetchcolumn('select levelname from ' . tablename('vending_machine_commission_level') . ' where id=:id limit 1', array(':id' => $value1));
			} else {
				$levelname = "全部分销商";
			}
			$typestr = "分销商-{$levelname}";
		}
		if (count($member) <= 0) {
			show_json(0, '未找到任何会员, 无法进行群发!');
		}
		plog('member.tmessage.send', "会员群发 模板ID: {$id} 方式: {$typestr} 人数: " . count($member));
		show_json(1, array('openids' => array_keys($member)));
	}

	function sendmessage() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$openid = trim($_GPC['openid']);
		$template = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_member_message_template') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));

		if (empty($template)) {
			die(json_encode(array('result' => 0, 'mesage' => '未指定群发模板!', 'openid' => $openid)));
		}
		if (empty($template['template_id'])) {
			die(json_encode(array('result' => 0, 'mesage' => '未指定群发模板ID!', 'openid' => $openid)));
		}
		if (empty($openid)) {
			die(json_encode(array('result' => 0, 'mesage' => '未指定openid!', 'openid' => $openid)));
		}
		$data = iunserializer($template['data']);
		if (!is_array($data)) {
			die(json_encode(array('result' => 0, 'mesage' => '模板有错误!', 'openid' => $openid)));
		}
		$msg = array(
			'first' => array('value' => $template['first'], 'color' => $template['firstcolor']),
			'remark' => array('value' => $template['remark'], 'color' => $template['remarkcolor'])
		);
		for ($i = 0; $i < count($data); $i++) {
			$msg[$data[$i]['keywords']] = array('value' => $data[$i]['value'], 'color' => $data[$i]['color']);
		}
		$result = m('message')->sendTplNotice($openid, $template['template_id'], $msg, $template['url']);
		if (is_error($result)) {
			die(json_encode(array('result' => 0, 'message' => $result['message'], 'openid' => $openid)));
		}
		pdo_update('vending_machine_member_message_template', array('sendcount' => $template['sendcount'] + 1), array('id' => $id));
		die(json_encode(array('result' => 1)));
	}

}
