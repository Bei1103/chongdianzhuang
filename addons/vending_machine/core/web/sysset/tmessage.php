<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Tmessage_Page extends WebPage
{

	function main() {
		global $_W, $_GPC;

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = " and uniacid=:uniacid";
		$params = array(':uniacid' => $_W['uniacid']);

		if (!empty($_GPC['keyword'])) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition.=' and title  like :keyword';
			$params[':keyword'] = "%{$_GPC['keyword']}%";
		}

		$list = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_member_message_template') . " WHERE 1 {$condition}  ORDER BY id asc limit " . ($pindex - 1) * $psize . ',' . $psize, $params);
		$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('vending_machine_member_message_template') . " WHERE 1 {$condition}", $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}

	function add() {
		$this->post();
	}

	function edit() {
		$this->post();
	}

	protected function post() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);

		$typegroup = pdo_fetchall('SELECT `typegroup`,groupname   FROM ' . tablename('vending_machine_member_message_template_type').' group by `typegroup` order by id ');
		$templatetypes = pdo_fetchall('SELECT id,`name`,`typegroup`,typecode   FROM ' . tablename('vending_machine_member_message_template_type'));
		$type_json =@json_encode($templatetypes);

		if (!empty($_GPC['id'])) {
			$list = pdo_fetch('SELECT *  FROM ' . tablename('vending_machine_member_message_template') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $_GPC['id'], ':uniacid' => $_W['uniacid']));
			$types = pdo_fetch('SELECT *  FROM ' . tablename('vending_machine_member_message_template_type') . ' WHERE typecode=:typecode ', array(':typecode' => $list['typecode']));

			$data = iunserializer($list['data']);
		}

		$templatetypes2 =array();
		foreach($templatetypes as $temp )
		{
			if(!empty($types)&&$types['typegroup']==$temp['typegroup'])
			{
				$templatetypes2[] = $temp;
			}else if(empty($types)&&$temp['typegroup']=='sys')
			{
				$templatetypes2[] = $temp;
			}
		}

		$templatetypes  = $templatetypes2;


		if ($_W['ispost']) {

			$id = $_GPC['id'];
			$keywords = $_GPC['tp_kw'];
			$value = $_GPC['tp_value'];
			$color = $_GPC['tp_color'];
			if (!empty($keywords)) {
				$data = array();
				foreach ($keywords as $key => $val) {
					$data[] = array('keywords' => $keywords[$key], 'value' => $value[$key], 'color' => $color[$key]);
				}
			}
			$insert = array(
				'title' => $_GPC['title'],
				'typecode' => trim($_GPC['typecode']),
				'messagetype'=> $_GPC['messagetype'],
				'template_id' => trim($_GPC['tp_template_id']),
				'first' => trim($_GPC['tp_first']),
				'firstcolor' => trim($_GPC['firstcolor']),
				'data' => iserializer($data),
				'remark' => trim($_GPC['tp_remark']),
				'remarkcolor' => trim($_GPC['remarkcolor']),
				'send_desc'=> $_GPC['send_desc'],
				'uniacid' => $_W['uniacid']
			);

			if (empty($id)) {
				pdo_insert('vending_machine_member_message_template', $insert);
				$id = pdo_insertid();
				plog('sysset.tmessage.delete', "?????????????????? ID: {$id} ??????: {$insert['title']} ");
			} else {
				pdo_update('vending_machine_member_message_template', $insert, array('id' => $id));
				plog('sysset.tmessage.delete', "?????????????????? ID: {$id} ??????: {$insert['title']} ");
			}
			show_json(1, array('url' => webUrl('sysset/tmessage')));
		}
		include $this->template();
	}

	function delete() {
		global $_W, $_GPC;

		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
		}
		$items = pdo_fetchall("SELECT id,title FROM " . tablename('vending_machine_member_message_template') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
		foreach ($items as $item) {
			pdo_delete('vending_machine_member_message_template', array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			plog('sysset.tmessage.delete', "?????????????????? ID: {$item['id']} ??????: {$item['title']} ");
		}
		show_json(1, array('url' => referer()));
	}

	function query() {
		global $_W, $_GPC;
		$kwd = trim($_GPC['keyword']);
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$condition = " and uniacid=:uniacid";
		if (!empty($kwd)) {
			$condition.=" AND `title` LIKE :keyword";
			$params[':keyword'] = "%{$kwd}%";
		}
		$ds = pdo_fetchall('SELECT id,title FROM ' . tablename('vending_machine_member_message_template') . " WHERE 1 {$condition} order by id asc", $params);
		if ($_GPC['suggest']) {
			die(json_encode(array('value' => $ds)));
		}
		include $this->template();
	}


	function tpl(){
		global $_W,$_GPC;
		$kw = $_GPC['kw'];
		$tpkw = $_GPC['tpkw'];
		include $this->template();
	}

	//?????????????????????????????????ID???????????????????????????
	function gettemplateid() {
		global $_W, $_GPC;
		load()->func('communication');

		$bb = "{\"template_id_short\":\"" . $_GPC['templateidshort'] ."\"}";
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=" . $token;
		$c =ihttp_request($url,$bb);

		$result = @json_decode($c['content'], true);
		if (!is_array($result)) {
			show_json(0);
		}

		if (!empty($result['errcode'])) {
			show_json(0, $result['errmsg']);
		}
		show_json(1,$result);
	}

	//????????????????????????
	function gettemplatelist() {
		global $_W, $_GPC;
		load()->func('communication');

		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = "https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=" . $token;
		$c =ihttp_request($url);

		$result = @json_decode($c['content'], true);
		if (!is_array($result)) {
			show_json(0);
		}

		if (!empty($result['errcode'])) {
			show_json(0, $result['errmsg']);
		}
		foreach($result['template_list']  as $key => &$value){
			preg_match_all("{{(.)*?}}",$value['content'],$matches);
			foreach($matches[0] as &$v){
				$v = str_replace(array('{','}','.DATA'),'',$v);
			}
			unset($v);
			$value['contents'] = $matches[0];
			$result['template_list'][$key]['content'] = str_replace(array("\n\n","\n"),"<br />",$value['content']);
		}
		unset($value);

		show_json(1,$result);
	}


	//???????????????????????????
	function deltemplatebyid() {
		global $_W, $_GPC;
		load()->func('communication');

		$bb = "{\"template_id\":\"" . $_GPC['template_id'] ."\"}";

		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = "https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=" . $token;
		$c =ihttp_request($url,$bb);

		$result = @json_decode($c['content'], true);
		if (!is_array($result)) {
			show_json(0);
		}

		if (!empty($result['errcode'])) {
			show_json(0, $result['errmsg']);
		}
		show_json(1,$result);
	}


}
