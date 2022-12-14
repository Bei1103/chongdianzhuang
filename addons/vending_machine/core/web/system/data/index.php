<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_Page extends SystemPage {

	function main() {
		global $_W, $_GPC;

		if ($_W['ispost']) {
			$wechatid = intval($_GPC['wechatid']);
			$condition = "";
			$acid = 0;
			$where = array();
			if ($wechatid != -1) {
				$condition = ' and uniacid=' . $wechatid;
				$where = array('uniacid' => $wechatid);
				$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account_wechats') . " WHERE `uniacid`=:uniacid LIMIT 1", array(':uniacid' => $wechatid));
			}

			load()->func('file');
			if (is_array($_GPC['shop'])) {
				foreach ($_GPC['shop'] as $data) {
					if ($data == 'goods') {
						pdo_query('delete from  ' . tablename('vending_machine_goods') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_goods_option') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_goods_param') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_goods_spec') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_goods_spec_item') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_goods_comment') . " where 1 {$condition}");
						if (pdo_tableexists('vending_machine_goods_comment')) {
							pdo_query('delete from  ' . tablename('vending_machine_goods_comment') . " where 1 {$condition}");
						}
					} else if ($data == 'category') {
						pdo_query('delete from  ' . tablename('vending_machine_category') . " where 1 {$condition}");
					} else if ($data == 'dispatch') {
						pdo_query('delete from  ' . tablename('vending_machine_dispatch') . " where 1 {$condition}");
					} else if ($data == 'adv') {
						pdo_query('delete from  ' . tablename('vending_machine_adv') . " where 1 {$condition}");
					} else if ($data == 'notice') {
						pdo_query('delete from   ' . tablename('vending_machine_notice') . " where 1 {$condition}");
					} else if ($data == 'level') {
						pdo_query('delete from   ' . tablename('vending_machine_member_level') . " where 1 {$condition}");
					} else if ($data == 'group') {
						pdo_query('delete from   ' . tablename('vending_machine_member_group') . " where 1 {$condition}");
					} else if ($data == 'member') {
						pdo_query('delete from  ' . tablename('vending_machine_member') . " where 1 {$condition}");
						pdo_query('delete from   ' . tablename('vending_machine_member_address') . " where 1 {$condition}");
						pdo_query('delete from   ' . tablename('vending_machine_member_cart') . " where 1 {$condition}");
						pdo_query('delete from   ' . tablename('vending_machine_member_history') . " where 1 {$condition}");
						pdo_query('delete from   ' . tablename('vending_machine_member_favorite') . " where 1 {$condition}");
						pdo_query('delete from   ' . tablename('vending_machine_member_log') . " where 1 {$condition}");
					} else if ($data == 'order') {
						pdo_query('delete from  ' . tablename('vending_machine_order') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_order_goods') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_order_refund') . " where 1 {$condition}");
						if (pdo_tableexists('vending_machine_order_comment')) {
							pdo_query('delete from  ' . tablename('vending_machine_order_comment') . " where 1 {$condition}");
						}
					} else if ($data == 'memberlevel') {
						pdo_query('update ' . tablename('vending_machine_member') . " set level=0 where 1 {$condition}");
					} else if ($data == 'membergroup') {
						pdo_query('update ' . tablename('vending_machine_member') . " set groupid=0 where 1 {$condition}");
					} else if ($data == 'membercredit1') {
						/*if ($wechatid != -1) {
							$members = pdo_fetchall('select id,uid,openid,uniacid from ' . tablename('vending_machine_member') . ' where uniacid=:uniacid and credit1 > 0 ', array(':uniacid' => $wechatid));
						} else {
							$members = pdo_fetchall('select id,uid,openid,uniacid from ' . tablename('vending_machine_member').' where credit1 > 0 ');
						}
						foreach ($members as $m) {
							$mm = m('member')->getMember($m['openid']);
							if (!empty($mm['uid'])) {
                                pdo_update('mc_members', array('credit1' => 0), array('uid' => $mm['uid']));
							}
						}
                        if ($wechatid != -1) {
                            pdo_update('vending_machine_member', array('credit1' => 0), array('uniacid' => $wechatid));
                        } else {
                            pdo_update('vending_machine_member', array('credit1' => 0));
                        }*/
                        if ($wechatid != -1) {
                            //??????????????????????????????????????????
                            pdo_update('vending_machine_member', array('credit1' => 0), array('uniacid' => $wechatid));
                            //????????????uid???????????????
                            pdo_query('UPDATE '.tablename('mc_members')." SET credit1 = 0 WHERE uid IN (SELECT uid FROM ".tablename('vending_machine_member')." where uniacid = {$wechatid})");
                        }else{
                            //???????????????????????????
                            pdo_update('vending_machine_member', array('credit1' => 0));
                            //????????????uid???????????????
                            pdo_query('UPDATE '.tablename('mc_members')." SET credit1 = 0 WHERE uid IN (SELECT uid FROM ".tablename('vending_machine_member')." where uniacid = {$wechatid})");
                        }
					} else if ($data == 'membercredit2') {
//                        if ($wechatid != -1) {
//                            $members = pdo_fetchall('select id,uid,openid,uniacid from ' . tablename('vending_machine_member') . ' where uniacid=:uniacid ', array(':uniacid' => $wechatid));
//                        } else {
//                            $members = pdo_fetchall('select id,uid,openid,uniacid from ' . tablename('vending_machine_member'));
//                        }
//                        foreach ($members as $m) {
//                            $mm = m('member')->getMember($m['openid']);
//                            if (empty($mm['uid'])) {
//                                pdo_update('vending_machine_member', array('credit2' => 0), array('id' => $mm['id']));
//                            } else {
//                                pdo_update('mc_members', array('credit2' => 0), array('uid' => $mm['uid']));
//                            }
//                        }
							if ($wechatid != -1) {
							    //??????????????????????????????????????????
								pdo_update('vending_machine_member', array('credit2' => 0), array('uniacid' => $wechatid));
								//????????????uid???????????????
                                pdo_query('UPDATE '.tablename('mc_members')." SET credit2 = 0 WHERE uid IN (SELECT uid FROM ".tablename('vending_machine_member')." where uniacid = {$wechatid})");
							}else{
                                //???????????????????????????
                                pdo_update('vending_machine_member', array('credit2' => 0));
                                //????????????uid???????????????
                                pdo_query('UPDATE '.tablename('mc_members')." SET credit2 = 0 WHERE uid IN (SELECT uid FROM ".tablename('vending_machine_member')." where uniacid = {$wechatid})");
                            }
					}
				}
			}

			if (is_array($_GPC['commission'])) {
				foreach ($_GPC['commission'] as $data) {
					if ($data == 'agent') {
						pdo_query('update ' . tablename('vending_machine_member') . " set isagent=0,status=0,agenttime=0 where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_commission_shop') . " where 1 {$condition}");
					} else if ($data == 'relation') {
						pdo_query('update ' . tablename('vending_machine_member') . " set agentid=0 where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_commission_clickcount') . " where 1 {$condition}");
					} else if ($data == 'dispatch') {
						pdo_query('delete from  ' . tablename('vending_machine_dispatch') . " where 1 {$condition}");
					} else if ($data == 'agentlevel') {
						pdo_query('update ' . tablename('vending_machine_member') . " set agentlevel=0 where 1 {$condition}");
					} else if ($data == 'level') {
						pdo_query('delete from  ' . tablename('vending_machine_commission_level') . " where 1 {$condition}");
					} else if ($data == 'apply') {
						pdo_query('delete from  ' . tablename('vending_machine_commission_apply') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_commission_log') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['poster'])) {
				foreach ($_GPC['poster'] as $data) {
					if ($data == 'cache' || $data == 'poster') {
						if ($wechatid == -1) {
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/poster");
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/qrcode");
							pdo_update('vending_machine_poster_qr', array('mediaid' => ''));
						} else {
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/poster/" . $wechatid);
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/qrcode/" . $wechatid);
							pdo_update('vending_machine_poster_qr', array('mediaid' => ''), array('acid' => $acid));
						}
					} else if ($data == 'poster') {
						pdo_query('delete from  ' . tablename('vending_machine_poster') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_poster_qr') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_poster_log') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_poster_scan') . " where 1 {$condition}");
					} else if ($data == 'log') {
						pdo_query('delete from  ' . tablename('vending_machine_poster_log') . " where 1 {$condition}");
					} else if ($data == 'scan') {
						pdo_query('delete from  ' . tablename('vending_machine_poster_scan') . " where 1 {$condition}");
					}
				}
			}
			if (is_array($_GPC['verify'])) {
				foreach ($_GPC['verify'] as $data) {
					if ($data == 'store') {
						pdo_query('delete from  ' . tablename('vending_machine_store') . " where 1 {$condition}");
					} else if ($data == 'saler') {
						pdo_query('delete from  ' . tablename('vending_machine_saler') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['perm'])) {
				foreach ($_GPC['perm'] as $data) {
					if ($data == 'role') {
						pdo_query('delete from  ' . tablename('vending_machine_perm_role') . " where 1 {$condition}");
					} else if ($data == 'user') {
						pdo_query('delete from  ' . tablename('vending_machine_perm_user') . " where 1 {$condition}");
					} else if ($data == 'log') {
						pdo_query('delete from  ' . tablename('vending_machine_perm_log') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['creditshop'])) {
				foreach ($_GPC['creditshop'] as $data) {
					if ($data == 'goods') {
						pdo_query('delete from  ' . tablename('vending_machine_creditshop_goods') . " where 1 {$condition}");
					} else if ($data == 'category') {
						pdo_query('delete from  ' . tablename('vending_machine_creditshop_category') . " where 1 {$condition}");
					} else if ($data == 'adv') {
						pdo_query('delete from  ' . tablename('vending_machine_creditshop_adv') . " where 1 {$condition}");
					} else if ($data == 'log') {
						pdo_query('delete from  ' . tablename('vending_machine_creditshop_log') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['virtual'])) {
				foreach ($_GPC['virtual'] as $data) {
					if ($data == 'template') {
						pdo_query('delete from  ' . tablename('vending_machine_virtual_type') . " where 1 {$condition}");
					} else if ($data == 'category') {
						pdo_query('delete from  ' . tablename('vending_machine_virtual_category') . " where 1 {$condition}");
					} else if ($data == 'data') {
						pdo_query('delete from  ' . tablename('vending_machine_virtual_data') . " where 1 {$condition}");
					}
				}
			}
			if (is_array($_GPC['designer'])) {
				foreach ($_GPC['designer'] as $data) {
					if ($data == 'page') {
						pdo_query('delete from  ' . tablename('vending_machine_designer') . " where 1 {$condition}");
					} else if ($data == 'menu') {
						pdo_query('delete from  ' . tablename('vending_machine_designer_menu') . " where 1 {$condition}");
					}
				}
			}
			if (is_array($_GPC['article'])) {
				foreach ($_GPC['article'] as $data) {
					if ($data == 'article') {

						$articles = pdo_fetchall('select * from ' . tablename('vending_machine_article') . " where uniacid=:uniacid ", array(':uniacid' => $wechatid));
						foreach ($articles as $article) {
							//???????????????????????????
							$keyword = pdo_fetch("SELECT * FROM " . tablename('rule_keyword') . " WHERE content=:content and module=:module and uniacid=:uniacid limit 1 ", array(':content' => $article['article_keyword'], ':module' => 'vending_shop', ':uniacid' => $wechatid));
							if (!empty($keyword)) {
								pdo_delete('rule_keyword', array('id' => $keyword['id']));
								pdo_delete('rule', array('id' => $keyword['rid']));
							}
						}
						pdo_query('delete from  ' . tablename('vending_machine_article') . " where 1 {$condition}");
					} else if ($data == 'category') {
						pdo_query('delete from  ' . tablename('vending_machine_article_category') . " where 1 {$condition}");
					} else if ($data == 'share') {
						pdo_query('delete from  ' . tablename('vending_machine_article_share') . " where 1 {$condition}");
					} else if ($data == 'log') {
						pdo_query('update ' . tablename('vending_machine_article') . " set article_readnum=0,article_likenum=0 where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_article_log') . " where 1 {$condition}");
					} else if ($data == 'report') {
						pdo_query('delete from  ' . tablename('vending_machine_article_report') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['coupon'])) {
				foreach ($_GPC['coupon'] as $data) {
					if ($data == 'coupon') {
						pdo_query('delete from  ' . tablename('vending_machine_coupon') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_coupon_data') . " where 1 {$condition}");
					} else if ($data == 'category') {
						pdo_query('delete from  ' . tablename('vending_machine_coupon_category') . " where 1 {$condition}");
					} else if ($data == 'data') {
						pdo_query('delete from  ' . tablename('vending_machine_coupon_data') . " where 1 {$condition}");
					}
				}
			}

			if (is_array($_GPC['postera'])) {
				foreach ($_GPC['postera'] as $data) {
					if ($data == 'cache' || $data == 'poster') {
						if ($wechatid == -1) {
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/postera");
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/qrcode");
							pdo_update('vending_machine_postera_qr', array('mediaid' => ''));
						} else {
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/postera/" . $wechatid);
							@rmdirs(IA_ROOT . "/addons/vending_machine/data/qrcode/" . $wechatid);
							pdo_update('vending_machine_postera_qr', array('mediaid' => ''), array('acid' => $acid));
						}
					} else if ($data == 'poster') {
						pdo_query('delete from  ' . tablename('vending_machine_postera') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_postera_qr') . " where 1 {$condition}");
						pdo_query('delete from  ' . tablename('vending_machine_postera_log') . " where 1 {$condition}");
					} else if ($data == 'log') {
						pdo_query('delete from  ' . tablename('vending_machine_poster_log') . " where 1 {$condition}");
					}
				}
			}
			show_json(1);
		}
		$wechats = m('common')->getWechats();
		load()->func('tpl');
		include $this->template();
	}

}
