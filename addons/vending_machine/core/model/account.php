<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Account_Model {


	public function checkLogin(){

		global $_W,$_GPC;

		if(empty($_W['openid'])) {

			$openid = $this->checkOpenid();
			if(!empty($openid)){
				return $openid;
			}

			$url = urlencode(base64_encode($_SERVER['QUERY_STRING']));
			$loginurl = mobileUrl('account/login', array('mid' => $_GPC['mid'], 'backurl'=>$_W['isajax']?"":$url));

			if($_W['isajax']){
				show_json(0, array('url'=>$loginurl, 'message'=>'请先登录!'));
			}

			header('location: ' . $loginurl);
			exit;
		}
	}

	public function checkOpenid(){
		global $_W,$_GPC;

		$key = '__vending_machine_member_session_' . $_W['uniacid'];


		if (isset($_GPC[$key])) {
			$session = json_decode(base64_decode($_GPC[$key]), true);
			if (is_array($session)) {
				$member = m('member')->getMember($session['openid']);
				if (is_array($member) && $session['vending_machine_member_hash'] == md5($member['pwd'] . $member['salt'])) {
					$GLOBALS['_W']['vending_machine_member_hash'] = md5($member['pwd'] . $member['salt']);
					$GLOBALS['_W']['vending_machine_member'] = $member;
					return $member['openid'];
				} else {
					isetcookie($key, false, -100);
				}
			}
		}
	}

	public function setLogin($member) {
		global $_W;

		if(!is_array($member)){
			$member = m('member')->getMember($member);
		}
		if(!empty($member)){
			$member['vending_machine_member_hash'] = md5($member['pwd'].$member['salt']);
			$key = '__vending_machine_member_session_'.$_W['uniacid'];
			$cookie = base64_encode( json_encode($member) );
			isetcookie($key, $cookie,30 * 86400);
		}
	}

	public function getSalt(){
		$salt = random(16);
		while(1)  {
			$count = pdo_fetchcolumn('select count(*) from '.tablename('vending_machine_member').' where salt=:salt limit 1',array(':salt'=>$salt));
			if($count<=0){
				break;
			}
			$salt = random(16);
		}
		return $salt;
	}

    public function uni_accounts($uniacid = 0) {
        global $_W;
        $uniacid = empty($uniacid) ? $_W['uniacid'] : intval($uniacid);
        $account_info = pdo_get('account', array('uniacid' => $uniacid));
        if (!empty($account_info)) {
            $account_tablename = uni_account_type($account_info['type']);
            $account_tablename = $account_tablename['table_name'];
            $accounts = pdo_fetchall("SELECT w.*, a.type, a.isconnect FROM " . tablename('account') . " a INNER JOIN " . tablename($account_tablename) . " w USING(acid) WHERE a.uniacid = :uniacid AND a.isdeleted <> 1 ORDER BY a.acid ASC", array(':uniacid' => $uniacid), 'acid');
        }
        return !empty($accounts) ? $accounts : array();
    }

}
