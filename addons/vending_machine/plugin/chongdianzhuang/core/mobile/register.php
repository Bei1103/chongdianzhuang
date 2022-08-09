<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

require VENDING_MACHINE_PLUGIN . 'chongdianzhuang/core/page_login_mobile.php';

class Register_Page extends chongdianzhuangMobileLoginPage {

	function main() {

		global $_W, $_GPC;
		$openid = $_W['openid'];

		$set = set_medias($this->set, 'regbg');
		$member = m('member')->getMember($openid);

		if ($member['isaagent'] == 1 && $member['aagentstatus'] == 1) {
			 header("location: " . mobileUrl('chongdianzhuang'));
			exit;
		}

		if ($member['agentblack'] || $member['aagentblack']) {
			include $this->template();
			exit;
		}

        $apply_set = array();
        $apply_set['open_protocol'] = $set['open_protocol'];
        if (empty($set['applytitle'])) {
            $apply_set['applytitle'] = '区域代理申请协议';
        } else {
            $apply_set['applytitle'] = $set['applytitle'];
        }

		//自定义表单
		$template_flag = 0;
		$diyform_plugin = p('diyform');
		if ($diyform_plugin) {
			$set_config = $diyform_plugin->getSet();
			$chongdianzhuang_diyform_open = $set_config['chongdianzhuang_diyform_open'];
			if ($chongdianzhuang_diyform_open == 1) {
				$template_flag = 1;
				$diyform_id = $set_config['chongdianzhuang_diyform'];
				if (!empty($diyform_id)) {
					$formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
					$fields = $formInfo['fields'];
					$diyform_data = iunserializer($member['diyaagentdata']);
					$f_data = $diyform_plugin->getDiyformData($diyform_data, $fields, $member);
				}
			}
		}

		if ($_W['ispost']) {
			if ($set['become']!='1') {
				show_json(0, '未开启' . $set['texts']['agent'] . "注册!");
			}
			if ($template_flag == 1) {

				$memberdata = $_GPC['memberdata'];
				$insert_data = $diyform_plugin->getInsertData($fields, $memberdata);
				$data = $insert_data['data'];
				$m_data = $insert_data['m_data'];
				$mc_data = $insert_data['mc_data'];

				$m_data['diyaagentid'] = $diyform_id;
				$m_data['diyaagentfields'] = iserializer($fields);
				$m_data['diyaagentdata'] = $data;

				$m_data['isaagent'] = 1;
				$m_data['aagentstatus'] = 0;
				$m_data['aagenttime'] = 0;

                unset($m_data['credit1'], $m_data['credit2']);
				pdo_update('vending_machine_member', $m_data,  array('id' => $member['id']));

				if (!empty($member['uid'])) {
					if (!empty($mc_data)) {
						unset($mc_data['credit1'], $mc_data['credit2']);
						m('member')->mc_update($member['uid'], $mc_data);
					}
				}
			} else {

				$province = trim( str_replace(' ','', $_GPC['province']));
				$provinces = !empty($province)? iserializer(array( $province )):iserializer(array());

				$city = trim( str_replace(' ','', $_GPC['city']));
				$citys = !empty($city)? iserializer(array( str_replace(' ','',$city)  )):iserializer(array());

				$area = trim( str_replace(' ','', $_GPC['area']));
				$areas = !empty($area )? iserializer(array( $area  )):iserializer(array());

				$data = array(
					'isaagent' => 1,
					'aagentstatus' => 0,
					'realname' => trim($_GPC['realname']),
					'mobile' => trim($_GPC['mobile']),
					'weixin' => trim($_GPC['weixin']),
					'aagenttime' => 0,
					'aagenttype'=>intval($_GPC['aagenttype']),
					'aagentprovinces'=>$provinces,
					'aagentcitys'=>$citys,
					'aagentareas'=>$areas
				);

				pdo_update('vending_machine_member',$data, array('id' => $member['id']));

				if (!empty($member['uid'])) {
					//更新会员
					m('member')->mc_update($member['uid'], array('realname' => $data['realname'], 'mobile' => $data['mobile']));
				}
			}
			show_json(1);
		}

		include $this->template();
	}

}
