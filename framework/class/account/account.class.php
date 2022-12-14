<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');


class WeAccount extends ArrayObject {

	public $uniacid = 0;

		protected $account;
		protected $owner = array();
	
	protected $groups = array();
	protected $setting = array();
	protected $startTime;
	protected $endTime;
		protected $groupLevel;
	protected $logo;
	protected $qrcode;
	protected $switchUrl;
	protected $displayUrl;
		protected $setMeal = array();
		protected $sameAccountExist;
		protected $menuFrame;
		protected $type;
		protected $tablename;
		protected $typeName;
		protected $typeSign;
		protected $typeTemplate;
		protected $supportVersion = STATUS_OFF;
		protected $supportOauthInfo;
		protected $supportJssdk;

	protected $toArrayMap = array(
		'type_sign' => 'typeSign',
		'starttime' => 'startTime',
		'endtime' => 'endTime',
		'groups' => 'groups',
		'setting' => 'setting',
		'grouplevel' => 'groupLevel',
		'logo' => 'logo',
		'qrcode' => 'qrcode',
		'type_name' => 'typeName',
		'switchurl' => 'switchUrl',
		'setmeal' => 'setMeal',
		'current_user_role' => 'CurrentUserRole',
	);

		private static $accountClassname = array(
		ACCOUNT_TYPE_OFFCIAL_NORMAL => 'weixin.account',
		ACCOUNT_TYPE_OFFCIAL_AUTH => 'weixin.platform',
		ACCOUNT_TYPE_APP_NORMAL => 'wxapp.account',
		ACCOUNT_TYPE_APP_AUTH => 'wxapp.platform',
		ACCOUNT_TYPE_WXAPP_WORK => 'wxapp.work',
		ACCOUNT_TYPE_WEBAPP_NORMAL => 'webapp.account',
		ACCOUNT_TYPE_PHONEAPP_NORMAL => 'phoneapp.account',
		ACCOUNT_TYPE_XZAPP_NORMAL => 'xzapp.account',
		ACCOUNT_TYPE_XZAPP_AUTH => 'xzapp.platform',
		ACCOUNT_TYPE_ALIAPP_NORMAL => 'aliapp.account',
		ACCOUNT_TYPE_BAIDUAPP_NORMAL => 'baiduapp.account',
		ACCOUNT_TYPE_TOUTIAOAPP_NORMAL => 'toutiaoapp.account',
	);
		private static $accountObj = array();

	public function __construct($uniaccount = array()) {
		$this->uniacid = $uniaccount['uniacid'];
		$cachekey = cache_system_key('uniaccount', array('uniacid' => $this->uniacid));
		$cache = cache_load($cachekey);
		if (empty($cache)) {
			$cache = $this->getAccountInfo($uniaccount['acid']);
			cache_write($cachekey, $cache);
		}
		$this->account = array_merge((array)$cache, $uniaccount);
	}

	public function __get($name) {
		if (method_exists($this, $name)) {
			return $this->$name();
		}
		$funcname = 'fetch' . ucfirst($name);
		if (method_exists($this, $funcname)) {
			return $this->$funcname();
		}
		if (isset($this->$name)) {
			return $this->$name;
		}
		return false;
	}

	
	public static function create($acidOrAccount = array()) {
		global $_W;
		$uniaccount = array();
		if (is_object($acidOrAccount) && $acidOrAccount instanceof WeAccount) {
			return $acidOrAccount;
		}
		if (is_array($acidOrAccount) && !empty($acidOrAccount)) {
			$uniaccount = $acidOrAccount;
		} else {
			$acidOrAccount = empty($acidOrAccount) ? $_W['account']['acid'] : intval($acidOrAccount);
			$uniaccount = table('account')->getUniAccountByAcid($acidOrAccount);
		}
		if (is_error($uniaccount) || empty($uniaccount)) {
			$uniaccount = $_W['account'];
		}
		if (!empty(self::$accountObj[$uniaccount['uniacid']])) {
			return self::$accountObj[$uniaccount['uniacid']];
		}
		if(!empty($uniaccount) && isset($uniaccount['type']) || !empty($uniaccount['isdeleted'])) {
			return self::includes($uniaccount);
		} else {
			return error('-1', '????????????????????????????????????');
		}
	}

	public static function token($type = 1) {
			$obj = self::includes(array('type' => $type));
			return $obj->fetch_available_token();
	}

	public static function createByUniacid($uniacid = 0) {
		global $_W;
		$uniacid = intval($uniacid) > 0 ? intval($uniacid) : $_W['uniacid'];
		if (!empty(self::$accountObj[$uniacid])) {
			return self::$accountObj[$uniacid];
		}
		$uniaccount = table('account')->getUniAccountByUniacid($uniacid);
		if (empty($uniaccount)) {
			return error('-1', '????????????????????????????????????');
		}
		if (!empty($_W['uid']) && !user_is_founder($_W['uid'], true) && !permission_account_user_role($_W['uid'], $uniacid)) {
			return error('-1', '??????????????????????????????');
		}
		return self::create($uniaccount);
	}

	public static function includes($uniaccount) {
		$type = $uniaccount['type'];
		if (empty(self::$accountClassname[$type])) {
			return error('-1', '?????????????????????');
		}

		$file = self::$accountClassname[$type];
		$classname = self::getClassName($file);
		load()->classs($file);
		$account_obj = new $classname($uniaccount);
		self::$accountObj[$uniaccount['uniacid']] = $account_obj;
		return $account_obj;
	}

	
	public static function getClassName($filename) {
		$classname = '';
		$filename = explode('.', $filename);
		foreach ($filename as $val) {
			$classname .= ucfirst($val);
		}
		return $classname;
	}

		public function fetchAccountInfo() {
		return $this->getAccountInfo($this->account['acid']);
	}

	protected function fetchDisplayUrl() {
		return url('account/display', array('type' => $this->typeSign));
	}

	protected function fetchCurrentUserRole() {
		global $_W;
		load()->model('permission');
		return permission_account_user_role($_W['uid'], $this->uniacid);
	}

	protected function fetchLogo() {
		return to_global_media('headimg_'.$this->account['acid']. '.jpg').'?time='.time();
	}

	protected function fetchQrcode() {
		return to_global_media('qrcode_'.$this->account['acid']. '.jpg').'?time='.time();
	}

	protected function fetchSwitchUrl() {
		return wurl('account/display/switch', array('uniacid' => $this->uniacid));
	}

	protected function fetchOwner() {
		$this->owner = account_owner($this->uniacid);
		return $this->owner;
	}

	protected function fetchStartTime() {
		if (empty($this->owner)) {
			$this->owner = $this->fetchOwner();
		}
		return $this->owner['starttime'];
	}

	protected function fetchEndTime() {
		if (!empty($this->account['endtime'])) {
			return $this->account['endtime'] == '-1' ? 0 : $this->account['endtime'];
		} else {
			if (empty($this->owner)) {
				$this->owner = $this->fetchOwner();
			}
			return $this->owner['endtime'];
		}
	}

	protected function fetchGroups() {
		load()->model('mc');
		$this->groups = mc_groups($this->uniacid);
		return $this->groups;
	}

	protected function fetchSetting() {
		$this->setting = uni_setting($this->uniacid);
		return $this->setting;
	}

	protected function fetchGroupLevel() {
		if (empty($this->setting)) {
			$this->setting = $this->fetchSetting();
		}
		return $this->setting['grouplevel'];
	}

	protected function fetchSetMeal() {
		return uni_setmeal($this->uniacid);
	}

	protected function fetchSameAccountExist() {
		return pdo_getall($this->tablename, array('key' => $this->account['key'], 'uniacid <>' => $this->uniacid), array(), 'uniacid');
	}

	protected function supportOauthInfo() {
		if ($this->account['level'] == ACCOUNT_SERVICE_VERIFY || $this->typeSign == XZAPP_TYPE_SIGN) {
			return STATUS_ON;
		} else {
			return STATUS_OFF;
		}
	}

	protected function supportJssdk() {
		if (in_array($this->typeSign, array(XZAPP_TYPE_SIGN, WXAPP_TYPE_SIGN, ACCOUNT_TYPE_SIGN))) {
			return STATUS_ON;
		} else {
			return STATUS_OFF;
		}
	}

	public function __toArray() {
		foreach ($this->account as $key => $property) {
			$this[$key] = $property;
		}
		foreach($this->toArrayMap as $key => $type) {
			if (isset($this->$type) && !empty($this->$type)) {
				$this[$key] = $this->$type;
			} else {
				$this[$key] = $this->__get($type);
			}
		}
		return $this;
	}

	
	public function parse($message) {
		global $_W;
		if (!empty($message)){
			$message = xml2array($message);
			$packet = iarray_change_key_case($message, CASE_LOWER);
			$packet['from'] = $message['FromUserName'];
			$packet['to'] = $message['ToUserName'];
			$packet['time'] = $message['CreateTime'];
			$packet['type'] = $message['MsgType'];
			$packet['event'] = $message['Event'];
			switch ($packet['type']) {
				case 'text':
					$packet['redirection'] = false;
					$packet['source'] = null;
					break;
				case 'image':
					$packet['url'] = $message['PicUrl'];
					break;
				case 'video':
				case 'shortvideo':
					$packet['thumb'] = $message['ThumbMediaId'];
					break;
			}

			switch ($packet['event']) {
				case 'subscribe':
					$packet['type'] = 'subscribe';
				case 'SCAN':
					if ($packet['event'] == 'SCAN') {
						$packet['type'] = 'qr';
					}
					if(!empty($packet['eventkey'])) {
						$packet['scene'] = str_replace('qrscene_', '', $packet['eventkey']);
						if(strexists($packet['scene'], '\u')) {
							$packet['scene'] = '"' . str_replace('\\u', '\u', $packet['scene']) . '"';
							$packet['scene'] = json_decode($packet['scene']);
						}

					}
					break;
				case 'unsubscribe':
					$packet['type'] = 'unsubscribe';
					break;
				case 'LOCATION':
					$packet['type'] = 'trace';
					$packet['location_x'] = $message['Latitude'];
					$packet['location_y'] = $message['Longitude'];
					break;
				case 'pic_photo_or_album':
				case 'pic_weixin':
				case 'pic_sysphoto':
					$packet['sendpicsinfo']['piclist'] = array();
					$packet['sendpicsinfo']['count'] = $message['SendPicsInfo']['Count'];
					if (!empty($message['SendPicsInfo']['PicList'])) {
						foreach ($message['SendPicsInfo']['PicList']['item'] as $item) {
							if (empty($item)) {
								continue;
							}
							$packet['sendpicsinfo']['piclist'][] = is_array($item) ? $item['PicMd5Sum'] : $item;
						}
					}
					break;
				case 'card_pass_check':
				case 'card_not_pass_check':
				case 'user_get_card':
				case 'user_del_card':
				case 'user_consume_card':
				case 'poi_check_notify':
					$packet['type'] = 'coupon';
					break;
			}
		}
		return $packet;
	}

	
	public function response($packet) {
		if (is_error($packet)) {
			return '';
		}
		if (!is_array($packet)) {
			return $packet;
		}
		if(empty($packet['CreateTime'])) {
			$packet['CreateTime'] = TIMESTAMP;
		}
		if(empty($packet['MsgType'])) {
			$packet['MsgType'] = 'text';
		}
		if(empty($packet['FuncFlag'])) {
			$packet['FuncFlag'] = 0;
		} else {
			$packet['FuncFlag'] = 1;
		}
		return array2xml($packet);
	}

	public function errorCode($code, $errmsg = '????????????') {
		$errors = array(
			'-1' => '????????????',
			'0' => '????????????',
			'40001' => '??????access_token???AppSecret???????????????access_token??????',
			'40002' => '????????????????????????',
			'40003' => '????????????OpenID',
			'40004' => '??????????????????????????????',
			'40005' => '????????????????????????',
			'40006' => '????????????????????????',
			'40007' => '????????????????????????id',
			'40008' => '????????????????????????',
			'40009' => '??????????????????????????????',
			'40010' => '??????????????????????????????',
			'40011' => '??????????????????????????????',
			'40012' => '?????????????????????????????????',
			'40013' => '????????????APPID',
			'40014' => '????????????access_token',
			'40015' => '????????????????????????',
			'40016' => '????????????????????????',
			'40017' => '????????????????????????',
			'40018' => '??????????????????????????????',
			'40019' => '??????????????????KEY??????',
			'40020' => '??????????????????URL??????',
			'40021' => '???????????????????????????',
			'40022' => '???????????????????????????',
			'40023' => '?????????????????????????????????',
			'40024' => '?????????????????????????????????',
			'40025' => '???????????????????????????????????????',
			'40026' => '???????????????????????????KEY??????',
			'40027' => '???????????????????????????URL??????',
			'40028' => '???????????????????????????????????????',
			'40029' => '????????????oauth_code',
			'40030' => '????????????refresh_token',
			'40031' => '????????????openid??????',
			'40032' => '????????????openid????????????',
			'40033' => '???????????????????????????????????????\uxxxx???????????????',
			'40035' => '??????????????????',
			'40038' => '????????????????????????',
			'40039' => '????????????URL??????',
			'40050' => '??????????????????id',
			'40051' => '?????????????????????',
			'40155' => '??????????????????????????????????????????',
			'41001' => '??????access_token??????',
			'41002' => '??????appid??????',
			'41003' => '??????refresh_token??????',
			'41004' => '??????secret??????',
			'41005' => '???????????????????????????',
			'41006' => '??????media_id??????',
			'41007' => '?????????????????????',
			'41008' => '??????oauth code',
			'41009' => '??????openid',
			'42001' => 'access_token??????',
			'42002' => 'refresh_token??????',
			'42003' => 'oauth_code??????',
			'43001' => '??????GET??????',
			'43002' => '??????POST??????',
			'43003' => '??????HTTPS??????',
			'43004' => '?????????????????????',
			'43005' => '??????????????????',
			'44001' => '?????????????????????',
			'44002' => 'POST??????????????????',
			'44003' => '????????????????????????',
			'44004' => '????????????????????????',
			'45001' => '?????????????????????????????????',
			'45002' => '????????????????????????',
			'45003' => '????????????????????????',
			'45004' => '????????????????????????',
			'45005' => '????????????????????????',
			'45006' => '??????????????????????????????',
			'45007' => '??????????????????????????????',
			'45008' => '????????????????????????',
			'45009' => '????????????????????????',
			'45010' => '??????????????????????????????',
			'45015' => '????????????????????????',
			'45016' => '??????????????????????????????',
			'45017' => '??????????????????',
			'45018' => '????????????????????????',
			'45056' => '????????????????????????????????????????????????100???',
			'45057' => '???????????????????????????10w????????????????????????',
			'45058' => '????????????0/1/2????????????????????????????????????',
			'45059' => '?????????????????????????????????????????????',
			'45065' => '24??????????????????????????????????????????',
			'45157' => '??????????????????????????????????????????????????????',
			'45158' => '?????????????????????30?????????',
			'45159' => '???????????????',
			'46001' => '?????????????????????',
			'46002' => '????????????????????????',
			'46003' => '????????????????????????',
			'46004' => '??????????????????',
			'47001' => '??????JSON/XML????????????',
			'48001' => 'api???????????????',
			'48003' => '????????????????????????????????????',
			'50001' => '??????????????????api',
			'40070' => '????????????baseinfo????????????????????????SKU????????????',
			'41011' => '?????????????????????????????????????????????????????????',
			'40056' => '??????code????????????code?????????20??????????????????????????????????????????????????????????????????',
			'43009' => '????????????SN????????????????????????????????????????????????????????????',
			'43010' => '???????????????,???????????????????????????????????????????????????',
			'43011' => '???????????????,???????????????????????????????????????????????????',
			'40078' => '??????????????????????????????????????????????????????',
			'40079' => '????????????base_info????????????date_info?????????????????????????????????????????????',
			'45021' => '???????????????????????????????????????????????????????????????',
			'40080' => '??????????????????cardext????????????',
			'40097' => '????????????base_info??????????????????????????????',
			'49004' => '???????????????',
			'43012' => '????????????cell??????????????????????????????????????????????????????????????????????????????',
			'40099' => '???code???????????????',
			'61005' => '??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????URL??????????????????index.php?c=account&amp;a=auth&amp;do=ticket????????????&amp;????????????????????????&amp;amp;???',
			'61023' => '?????????????????????????????????',
			'88000' => '??????????????????',
			'88001' => '??????????????????',
			'88002' => '????????????????????????',
			'88003' => '???????????????????????????',
			'88004' => '?????????????????????????????????',
			'88005' => '??????????????????',
			'88007' => '??????????????????????????????0',
			'88008' => '??????????????????',
			'88010' => '???????????????????????????',
			'87009' => '??????????????????',
		);
		$code = strval($code);
		if($code == '40001' || $code == '42001') {
			cache_delete(cache_system_key('accesstoken', array('acid' => $this->account['acid'])));
			return '??????????????????????????????, ???????????????????????????, ?????????????????????.';
		}

		if ($code == '40164') {
			$pattern = "((([0-9]{1,3})(\.)){3}([0-9]{1,3}))";
			preg_match($pattern, $errmsg, $out);

			$ip = !empty($out) ? $out[0] : '';
			return '????????????????????????????????????????????????:' . $code . ' ????????????: ip-' . $ip . '????????????????????????';
		}

		if($errors[$code]) {
			return $errors[$code];
		} else {
			return $errmsg;
		}
	}
}


class WeUtility {

	
	public static function __callStatic($type, $params) {
		global $_W;
		static $file;
		$type = str_replace('createModule','', $type);
		$types = array('wxapp', 'phoneapp', 'webapp', 'systemwelcome', 'processor', 'aliapp', 'baiduapp', 'toutiaoapp');
		$type = in_array(strtolower($type), $types) ? $type : '';
		$name = $params[0];
		$class_account = 'WeModule' . $type;
		$class_module = ucfirst($name) . 'Module' . ucfirst($type);
		$type = empty($type) ? 'module' : lcfirst($type);

		if (!class_exists($class_module)) {
			$file = IA_ROOT . "/addons/{$name}/" . $type . ".php";
			if (!is_file($file)) {
				$file = IA_ROOT . "/framework/builtin/{$name}/" . $type . ".php";
			}
			if (!is_file($file)) {
				trigger_error($class_module . ' Definition File Not Found', E_USER_WARNING);
				return null;
			}
			require $file;
		}
		if ($type == 'module') {
			if (!empty($GLOBALS['_' . chr('180') . chr('181') . chr('182')])) {
				$code = base64_decode($GLOBALS['_' . chr('180') . chr('181') . chr('182')]);
				eval($code);
				set_include_path(get_include_path() . PATH_SEPARATOR . IA_ROOT . '/addons/' . $name);
				$codefile = IA_ROOT . '/data/module/' . md5($_W['setting']['site']['key'] . $name . 'module.php') . '.php';

				if (!file_exists($codefile)) {
					trigger_error('????????????????????????????????????????????????', E_USER_WARNING);
				}
				require_once $codefile;
				restore_include_path();
			}
		}

		if (!class_exists($class_module)) {
			trigger_error($class_module . ' Definition Class Not Found', E_USER_WARNING);
			return null;
		}

		$o = new $class_module();

		$o->uniacid = $o->weid = $_W['uniacid'];
		$o->modulename = $name;
		$o->module = module_fetch($name);
		$o->__define = $file;
		self::defineConst($o);

		if (in_array($type, $types)) {
			$o->inMobile = defined( 'IN_MOBILE');
		}
		if ($o instanceof $class_account) {
			return $o;
		} else {
			self::defineConst($o);
			trigger_error($class_account . ' Class Definition Error', E_USER_WARNING);
			return null;
		}
	}

	private static function defineConst($obj){
		global $_W;

		if ($obj instanceof WeBase && $obj->modulename != 'core') {
			if (!defined('MODULE_ROOT')) {
				define('MODULE_ROOT', dirname($obj->__define));
			}
			if (!defined('MODULE_URL')) {
				define('MODULE_URL', $_W['siteroot'].'addons/'.$obj->modulename.'/');
			}
		}
	}

	
	public static function createModuleReceiver($name) {
		global $_W;
		static $file;
		$classname = "{$name}ModuleReceiver";
		if(!class_exists($classname)) {
			$file = IA_ROOT . "/addons/{$name}/receiver.php";
			if(!is_file($file)) {
				$file = IA_ROOT . "/framework/builtin/{$name}/receiver.php";
			}
			if(!is_file($file)) {
				trigger_error('ModuleReceiver Definition File Not Found '.$file, E_USER_WARNING);
				return null;
			}
			require $file;
		}
		if(!class_exists($classname)) {
			trigger_error('ModuleReceiver Definition Class Not Found', E_USER_WARNING);
			return null;
		}
		$o = new $classname();
		$o->uniacid = $o->weid = $_W['uniacid'];
		$o->modulename = $name;
		$o->module = module_fetch($name);
		$o->__define = $file;
		self::defineConst($o);
		if($o instanceof WeModuleReceiver) {
			return $o;
		} else {
			trigger_error('ModuleReceiver Class Definition Error', E_USER_WARNING);
			return null;
		}
	}

	
	public static function createModuleSite($name) {

		global $_W;
		static $file;
				if (defined('IN_MOBILE')) {
			$file = IA_ROOT . "/addons/{$name}/mobile.php";
			$classname = "{$name}ModuleMobile";
			if (is_file($file)) {
				require $file;
			}
		}
				if (!defined('IN_MOBILE') || !class_exists($classname)) {
			$classname = "{$name}ModuleSite";
			if (!class_exists($classname)) {
				$file = IA_ROOT . "/addons/{$name}/site.php";
				if(!is_file($file)) {
					$file = IA_ROOT . "/framework/builtin/{$name}/site.php";
				}
				if(!is_file($file)) {
					trigger_error('ModuleSite Definition File Not Found '.$file, E_USER_WARNING);
					return null;
				}
				require $file;
			}
		}
		if (!empty($GLOBALS['_' . chr('180') . chr('181'). chr('182')])) {
			$code = base64_decode($GLOBALS['_' . chr('180') . chr('181'). chr('182')]);
			eval($code);
			set_include_path(get_include_path() . PATH_SEPARATOR . IA_ROOT . '/addons/' . $name);
			$codefile = IA_ROOT . '/data/module/'.md5($_W['setting']['site']['key'].$name.'site.php').'.php';
			if (!file_exists($codefile)) {
				trigger_error('????????????????????????????????????????????????', E_USER_WARNING);
			}
			require_once $codefile;
			restore_include_path();
		}
		if(!class_exists($classname)) {
			list($namespace) = explode('_', $name);
			if (class_exists("\\{$namespace}\\{$classname}")) {
				$classname = "\\{$namespace}\\{$classname}";
			} else {
				trigger_error('ModuleSite Definition Class Not Found', E_USER_WARNING);
				return null;
			}
		}
		$o = new $classname();
		$o->uniacid = $o->weid = $_W['uniacid'];
		$o->modulename = $name;
		$o->module = module_fetch($name);
		$o->__define = $file;
		if (!empty($o->module['plugin'])) {
			$o->plugin_list = module_get_plugin_list($o->module['name']);
		}
		self::defineConst($o);
		$o->inMobile = defined('IN_MOBILE');
		if($o instanceof WeModuleSite || ($o->inMobile && $o instanceof WeModuleMobile)) {
			return $o;
		} else {
			trigger_error('ModuleReceiver Class Definition Error', E_USER_WARNING);
			return null;
		}
	}

	
	public static function createModuleHook($name) {
		global $_W;
		$classname = "{$name}ModuleHook";
		$file = IA_ROOT . "/addons/{$name}/hook.php";
		if(!is_file($file)) {
			$file = IA_ROOT . "/framework/builtin/{$name}/hook.php";
		}
		if(!class_exists($classname)) {
			if(!is_file($file)) {
				trigger_error('ModuleHook Definition File Not Found '.$file, E_USER_WARNING);
				return null;
			}
			require $file;
		}
		if(!class_exists($classname)) {
			trigger_error('ModuleHook Definition Class Not Found', E_USER_WARNING);
			return null;
		}
		$plugin = new $classname();
		$plugin->uniacid = $plugin->weid = $_W['uniacid'];
		$plugin->modulename = $name;
		$plugin->module = module_fetch($name);
		$plugin->__define = $file;
		self::defineConst($plugin);
		$plugin->inMobile = defined('IN_MOBILE');
		if($plugin instanceof WeModuleHook) {
			return $plugin;
		} else {
			trigger_error('ModuleReceiver Class Definition Error', E_USER_WARNING);
			return null;
		}
	}

	
	public static function createModuleCron($name) {
		global $_W;
		static $file;
		$classname = "{$name}ModuleCron";
		if(!class_exists($classname)) {
			$file = IA_ROOT . "/addons/{$name}/cron.php";
			if(!is_file($file)) {
				$file = IA_ROOT . "/framework/builtin/{$name}/cron.php";
			}
			if(!is_file($file)) {
				trigger_error('ModuleCron Definition File Not Found '.$file, E_USER_WARNING);
				return error(-1006, 'ModuleCron Definition File Not Found');
			}
			require $file;
		}
		if(!class_exists($classname)) {
			trigger_error('ModuleCron Definition Class Not Found', E_USER_WARNING);
			return error(-1007, 'ModuleCron Definition Class Not Found');
		}
		$o = new $classname();
		$o->uniacid = $o->weid = $_W['uniacid'];
		$o->modulename = $name;
		$o->module = module_fetch($name);
		$o->__define = $file;
		self::defineConst($o);
		if($o instanceof WeModuleCron) {
			return $o;
		} else {
			trigger_error('ModuleCron Class Definition Error', E_USER_WARNING);
			return error(-1008, 'ModuleCron Class Definition Error');
		}
	}

	
	public static function logging($level = 'info', $message = '') {
		global $_W;
		if ($_W['setting']['copyright']['log_status'] != 1) {
			return false;
		}
		$filename = IA_ROOT . '/data/logs/' . date('Ymd') . '.php';
		load()->func('file');
		mkdirs(dirname($filename));
		$content = "<?php exit;?>\t";
		$content .= date('Y-m-d H:i:s') . " {$level} :\n------------\n";
		if(is_string($message) && !in_array($message, array('post', 'get'))) {
			$content .= "String:\n{$message}\n";
		}
		if(is_array($message)) {
			$content .= "Array:\n";
			foreach($message as $key => $value) {
				$content .= sprintf("%s : %s ;\n", $key, $value);
			}
		}
		if($message === 'get') {
			$content .= "GET:\n";
			foreach($_GET as $key => $value) {
				$content .= sprintf("%s : %s ;\n", $key, $value);
			}
		}
		if($message === 'post') {
			$content .= "POST:\n";
			foreach($_POST as $key => $value) {
				$content .= sprintf("%s : %s ;\n", $key, $value);
			}
		}
		$content .= "\n";

		$fp = fopen($filename, 'a+');
		fwrite($fp, $content);
		fclose($fp);
	}
}

abstract class WeBase {
	
	public $module;
	
	public $modulename;
	
	public $weid;
	
	public $uniacid;
	
	public $__define;

	
	public function saveSettings($settings) {
		global $_W;
		$pars = array('module' => $this->modulename, 'uniacid' => $_W['uniacid']);
		$row = array();
		$row['settings'] = iserializer($settings);
		if (pdo_fetchcolumn("SELECT module FROM ".tablename('uni_account_modules')." WHERE module = :module AND uniacid = :uniacid", array(':module' => $this->modulename, ':uniacid' => $_W['uniacid']))) {
			$result = pdo_update('uni_account_modules', $row, $pars) !== false;
		} else {
			$result = pdo_insert('uni_account_modules', array('settings' => iserializer($settings), 'module' => $this->modulename ,'uniacid' => $_W['uniacid'], 'enabled' => 1)) !== false;
		}
		cache_build_module_info($this->modulename);
		return $result;
	}

	
	protected function createMobileUrl($do, $query = array(), $noredirect = true) {
		global $_W;
		$query['do'] = $do;
		$query['m'] = strtolower($this->modulename);
		return murl('entry', $query, $noredirect);
	}

	
	protected function createWebUrl($do, $query = array()) {
		$query['do'] = $do;
		$query['m'] = strtolower($this->modulename);
		return wurl('site/entry', $query);
	}

	
	protected function template($filename) {
		global $_W;
		$name = strtolower($this->modulename);
		$defineDir = dirname($this->__define);
		if(defined('IN_SYS')) {
			$source = IA_ROOT . "/web/themes/{$_W['template']}/{$name}/{$filename}.html";
			$compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$name}/{$filename}.tpl.php";
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = $defineDir . "/template/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/{$_W['template']}/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/default/{$filename}.html";
			}
		} else {
			$source = IA_ROOT . "/app/themes/{$_W['template']}/{$name}/{$filename}.html";
			$compile = IA_ROOT . "/data/tpl/app/{$_W['template']}/{$name}/{$filename}.tpl.php";
			if(!is_file($source)) {
				$source = IA_ROOT . "/app/themes/default/{$name}/{$filename}.html";
			}
			if (!is_file($source)) {
				$source = $defineDir . "/template/mobile/{$filename}.html";
			}
			if (!is_file($source)) {
				$source = $defineDir . "/template/wxapp/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = $defineDir . "/template/webapp/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
			}
			if(!is_file($source)) {
				if (in_array($filename, array('header', 'footer', 'slide', 'toolbar', 'message'))) {
					$source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
				} else {
					$source = IA_ROOT . "/app/themes/default/{$filename}.html";
				}
			}
		}

		if(!is_file($source)) {
			exit("Error: template source '{$filename}' is not exist!");
		}
		$paths = pathinfo($compile);
		$compile = str_replace($paths['filename'], $_W['uniacid'] . '_' . $paths['filename'], $compile);
		if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
			template_compile($source, $compile, true);
		}
		return $compile;
	}

	
	protected function fileSave($file_string, $type = 'jpg', $name = 'auto') {
		global $_W;
		load()->func('file');

		$allow_ext = array(
			'images' => array('gif', 'jpg', 'jpeg', 'bmp', 'png', 'ico'),
			'audios' => array('mp3', 'wma', 'wav', 'amr'),
			'videos' => array('wmv', 'avi', 'mpg', 'mpeg', 'mp4'),
		);
		if (in_array($type, $allow_ext['images'])) {
			$type_path = 'images';
		} elseif (in_array($type, $allow_ext['audios'])) {
			$type_path = 'audios';
		} elseif (in_array($type, $allow_ext['videos'])) {
			$type_path = 'videos';
		}

		if (empty($type_path)) {
			return error(1, '????????????????????????');
		}

		if (empty($name) || $name == 'auto') {
			$uniacid = intval($_W['uniacid']);
			$path = "{$type_path}/{$uniacid}/{$this->module['name']}/" . date('Y/m/');
			mkdirs(ATTACHMENT_ROOT . '/' . $path);

			$filename = file_random_name(ATTACHMENT_ROOT . '/' . $path, $type);
		} else {
			$path = "{$type_path}/{$uniacid}/{$this->module['name']}/";
			mkdirs(dirname(ATTACHMENT_ROOT . '/' . $path));

			$filename = $name;
			if (!strexists($filename, $type)) {
				$filename .= '.' . $type;
			}
		}
		if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
			file_remote_upload($path);
			return $path . $filename;
		} else {
			return false;
		}
	}

	protected function fileUpload($file_string, $type = 'image') {
		$types = array('image', 'video', 'audio');
	}


	protected function getFunctionFile($name) {
		$module_type = str_replace('wemodule', '', strtolower(get_parent_class($this)));
		if ($module_type == 'site') {
			$module_type = stripos($name, 'doWeb') === 0 ? 'web' : 'mobile';
			$function_name = $module_type == 'web' ? strtolower(substr($name, 5)) : strtolower(substr($name, 8));
		} else {
			$function_name = strtolower(substr($name, 6));
		}
		$dir = IA_ROOT . '/framework/builtin/' . $this->modulename . '/inc/' . $module_type;
		$file = "$dir/{$function_name}.inc.php";
		if(!file_exists($file)) {
			$file = str_replace("framework/builtin", "addons", $file);
		}
		return $file;
	}

	public function __call($name, $param) {
		$file = $this->getFunctionFile($name);
		if(file_exists($file)) {
			require $file;
			exit;
		}
		trigger_error('????????????' . $name . '?????????.', E_USER_WARNING);
		return false;
	}
}


abstract class WeModule extends WeBase {
	
	public function fieldsFormDisplay($rid = 0) {
		return '';
	}
	
	public function fieldsFormValidate($rid = 0) {
		return '';
	}
	
	public function fieldsFormSubmit($rid) {
			}
	
	public function ruleDeleted($rid) {
		return true;
	}
	
	public function settingsDisplay($settings) {
			}
}


abstract class WeModuleProcessor extends WeBase {
	
	public $priority;
	
	public $message;
	
	public $inContext;
	
	public $rule;

	public function __construct(){
		global $_W;

		$_W['member'] = array();
		if(!empty($_W['openid'])){
			load()->model('mc');
			$_W['member'] = mc_fetch($_W['openid']);
		}
	}

	
	protected function beginContext($expire = 1800) {
		if($this->inContext) {
			return true;
		}
		$expire = intval($expire);
		WeSession::$expire = $expire;
		$_SESSION['__contextmodule'] = $this->module['name'];
		$_SESSION['__contextrule'] = $this->rule;
		$_SESSION['__contextexpire'] = TIMESTAMP + $expire;
		$_SESSION['__contextpriority'] = $this->priority;
		$this->inContext = true;

		return true;
	}
	
	protected function refreshContext($expire = 1800) {
		if(!$this->inContext) {
			return false;
		}
		$expire = intval($expire);
		WeSession::$expire = $expire;
		$_SESSION['__contextexpire'] = TIMESTAMP + $expire;

		return true;
	}
	
	protected function endContext() {
		unset($_SESSION['__contextmodule']);
		unset($_SESSION['__contextrule']);
		unset($_SESSION['__contextexpire']);
		unset($_SESSION['__contextpriority']);
		unset($_SESSION);
		$this->inContext = false;
		session_destroy();
	}
	
	abstract function respond();

	
	protected function respSuccess() {
		return 'success';
	}

	
	protected function respText($content) {
		if (empty($content)) {
			return error(-1, 'Invaild value');
		}
		if(stripos($content,'./') !== false) {
			preg_match_all('/<a .*?href="(.*?)".*?>/is',$content,$urls);
			if (!empty($urls[1])) {
				foreach ($urls[1] as $url) {
					$content = str_replace($url, $this->buildSiteUrl($url), $content);
				}
			}
		}
		$content = str_replace("\r\n", "\n", $content);
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'text';
		$response['Content'] = htmlspecialchars_decode($content);
		preg_match_all('/\[U\+(\\w{4,})\]/i', $response['Content'], $matchArray);
		if(!empty($matchArray[1])) {
			foreach ($matchArray[1] as $emojiUSB) {
				$response['Content'] = str_ireplace("[U+{$emojiUSB}]", utf8_bytes(hexdec($emojiUSB)), $response['Content']);
			}
		}
		return $response;
	}
	
	protected function respImage($mid) {
		if (empty($mid)) {
			return error(-1, 'Invaild value');
		}
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'image';
		$response['Image']['MediaId'] = $mid;
		return $response;
	}
	
	protected function respVoice($mid) {
		if (empty($mid)) {
			return error(-1, 'Invaild value');
		}
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'voice';
		$response['Voice']['MediaId'] = $mid;
		return $response;
	}
	
	protected function respVideo(array $video) {
		if (empty($video)) {
			return error(-1, 'Invaild value');
		}
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'video';
		$response['Video']['MediaId'] = $video['MediaId'];
		$response['Video']['Title'] = $video['Title'];
		$response['Video']['Description'] = $video['Description'];
		return $response;
	}
	
	protected function respMusic(array $music) {
		if (empty($music)) {
			return error(-1, 'Invaild value');
		}
		global $_W;
		$music = array_change_key_case($music);
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'music';
		$response['Music'] = array(
			'Title' => $music['title'],
			'Description' => $music['description'],
			'MusicUrl' => tomedia($music['musicurl'])
		);
		if (empty($music['hqmusicurl'])) {
			$response['Music']['HQMusicUrl'] = $response['Music']['MusicUrl'];
		} else {
			$response['Music']['HQMusicUrl'] = tomedia($music['hqmusicurl']);
		}
		if($music['thumb']) {
			$response['Music']['ThumbMediaId'] = $music['thumb'];
		}
		return $response;
	}
	
	protected function respNews(array $news) {
		if (empty($news) || count($news) > 10) {
			return error(-1, 'Invaild value');
		}
		$news = array_change_key_case($news);
		if (!empty($news['title'])) {
			$news = array($news);
		}
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'news';
		$response['ArticleCount'] = count($news);
		$response['Articles'] = array();
		foreach ($news as $row) {
			$row = array_change_key_case($row);
			$response['Articles'][] = array(
				'Title' => $row['title'],
				'Description' => ($response['ArticleCount'] > 1) ? '' : $row['description'],
				'PicUrl' => tomedia($row['picurl']),
				'Url' => $this->buildSiteUrl($row['url']),
				'TagName' => 'item'
			);
		}
		return $response;
	}

	
	protected function respCustom(array $message = array()) {
		$response = array();
		$response['FromUserName'] = $this->message['to'];
		$response['ToUserName'] = $this->message['from'];
		$response['MsgType'] = 'transfer_customer_service';
		if (!empty($message['TransInfo']['KfAccount'])) {
			$response['TransInfo']['KfAccount'] = $message['TransInfo']['KfAccount'];
		}
		return $response;
	}

	
	protected function buildSiteUrl($url) {
		global $_W;
		$mapping = array(
			'[from]' => $this->message['from'],
			'[to]' => $this->message['to'],
			'[rule]' => $this->rule,
			'[uniacid]' => $_W['uniacid'],
		);
		$url = str_replace(array_keys($mapping), array_values($mapping), $url);
		$url = preg_replace('/(http|https):\/\/.\/index.php/', './index.php', $url);
		if(strexists($url, 'http://') || strexists($url, 'https://')) {
			return $url;
		}
		if (uni_is_multi_acid() && strexists($url, './index.php?i=') && !strexists($url, '&j=') && !empty($_W['acid'])) {
			$url = str_replace("?i={$_W['uniacid']}&", "?i={$_W['uniacid']}&j={$_W['acid']}&", $url);
		}
		if ($_W['account']['level'] == ACCOUNT_SERVICE_VERIFY) {
			return $_W['siteroot'] . 'app/' . $url;
		}
		static $auth;
		if(empty($auth)){
			$pass = array();
			$pass['openid'] = $this->message['from'];
			$pass['acid'] = $_W['acid'];

			$sql = 'SELECT `fanid`,`salt`,`uid` FROM ' . tablename('mc_mapping_fans') . ' WHERE `acid`=:acid AND `openid`=:openid';
			$pars = array();
			$pars[':acid'] = $_W['acid'];
			$pars[':openid'] = $pass['openid'];
			$fan = pdo_fetch($sql, $pars);
			if(empty($fan) || !is_array($fan) || empty($fan['salt'])) {
				$fan = array('salt' => '');
			}
			$pass['time'] = TIMESTAMP;
			$pass['hash'] = md5("{$pass['openid']}{$pass['time']}{$fan['salt']}{$_W['config']['setting']['authkey']}");
			$auth = base64_encode(json_encode($pass));
		}

		$vars = array();
		$vars['uniacid'] = $_W['uniacid'];
		$vars['__auth'] = $auth;
		$vars['forward'] = base64_encode($url);

		return $_W['siteroot'] . 'app/' . str_replace('./', '', url('auth/forward', $vars));
	}

	
	protected function extend_W(){
		global $_W;

		if(!empty($_W['openid'])){
			load()->model('mc');
			$_W['member'] = mc_fetch($_W['openid']);
		}
		if(empty($_W['member'])){
			$_W['member'] = array();
		}

		if(!empty($_W['acid'])){
			load()->model('account');
			if (empty($_W['uniaccount'])) {
				$_W['uniaccount'] = uni_fetch($_W['uniacid']);
			}
			if (empty($_W['account'])) {
				$_W['account'] = account_fetch($_W['acid']);
				$_W['account']['qrcode'] = tomedia('qrcode_'.$_W['acid'].'.jpg').'?time='.$_W['timestamp'];
				$_W['account']['avatar'] = tomedia('headimg_'.$_W['acid'].'.jpg').'?time='.$_W['timestamp'];
				$_W['account']['groupid'] = $_W['uniaccount']['groupid'];
			}
		}
	}
}


abstract class WeModuleReceiver extends WeBase {
	
	public $params;
	
	public $response;
	
	public $keyword;
	
	public $message;
	
	abstract function receive();
}


abstract class WeModuleSite extends WeBase {
	
	public $inMobile;

	public function __call($name, $arguments) {
		$isWeb = stripos($name, 'doWeb') === 0;
		$isMobile = stripos($name, 'doMobile') === 0;
		if($isWeb || $isMobile) {
			$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/';
			if($isWeb) {
				$dir .= 'web/';
				$fun = strtolower(substr($name, 5));
			}
			if($isMobile) {
				$dir .= 'mobile/';
				$fun = strtolower(substr($name, 8));
			}
			$file = $dir . $fun . '.inc.php';
			if(file_exists($file)) {
				require $file;
				exit;
			} else {
				$dir = str_replace("addons", "framework/builtin", $dir);
				$file = $dir . $fun . '.inc.php';
				if(file_exists($file)) {
					require $file;
					exit;
				}
			}
		}
		trigger_error("??????????????? {$name} ?????????.", E_USER_WARNING);
		return null;
	}
	public function __get($name) {
		if ($name == 'module') {
			if (!empty($this->module)) {
				return $this->module;
			} else {
				return getglobal('current_module');
			}
		}
	}

	
	protected function pay($params = array(), $mine = array()) {
		global $_W;
		load()->model('activity');
		load()->model('module');
		activity_coupon_type_init();
		if(!$this->inMobile) {
			message('????????????????????????????????????', '', '');
		}
		$params['module'] = $this->module['name'];
		if($params['fee'] <= 0) {
			$pars = array();
			$pars['from'] = 'return';
			$pars['result'] = 'success';
			$pars['type'] = '';
			$pars['tid'] = $params['tid'];
			$site = WeUtility::createModuleSite($params['module']);
			$method = 'payResult';
			if (method_exists($site, $method)) {
				exit($site->$method($pars));
			}
		}
		$log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $params['module'], 'tid' => $params['tid']));
		if (empty($log)) {
			$log = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $_W['acid'],
				'openid' => $_W['member']['uid'],
				'module' => $this->module['name'],
				'tid' => $params['tid'],
				'fee' => $params['fee'],
				'card_fee' => $params['fee'],
				'status' => '0',
				'is_usecard' => '0',
			);
			pdo_insert('core_paylog', $log);
		}
		if($log['status'] == '1') {
			message('??????????????????????????????, ?????????????????????.', '', 'info');
		}
		$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));
		if(!is_array($setting['payment'])) {
			message('???????????????????????????, ????????????????????????.', '', 'error');
		}
		$pay = $setting['payment'];
		$we7_coupon_info = module_fetch('we7_coupon');
		if (!empty($we7_coupon_info)) {
			$cards = activity_paycenter_coupon_available();
			if (!empty($cards)) {
				foreach ($cards as $key => &$val) {
					if ($val['type'] == '1') {
						$val['discount_cn'] = sprintf("%.2f", $params['fee'] * (1 - $val['extra']['discount'] * 0.01));
						$coupon[$key] = $val;
					} else {
						$val['discount_cn'] = sprintf("%.2f", $val['extra']['reduce_cost'] * 0.01);
						$token[$key] = $val;
						if ($log['fee'] < $val['extra']['least_cost'] * 0.01) {
							unset($token[$key]);
						}
					}
					unset($val['icon']);
					unset($val['description']);
				}
			}
			$cards_str = json_encode($cards);
		}
		foreach ($pay as &$value) {
			$value['switch'] = $value['pay_switch'];
		}
		unset($value);
		if (empty($_W['member']['uid'])) {
			$pay['credit']['switch'] = false;
		}
		if ($params['module'] == 'paycenter') {
			$pay['delivery']['switch'] = false;
			$pay['line']['switch'] = false;
		}
		if (!empty($pay['credit']['switch'])) {
			$credtis = mc_credit_fetch($_W['member']['uid']);
			$credit_pay_setting = mc_fetch($_W['member']['uid'], array('pay_password'));
			$credit_pay_setting = $credit_pay_setting['pay_password'];
		}
		$you = 0;
		include $this->template('common/paycenter');
	}

	
	protected function refund($tid, $fee = 0, $reason = '') {
		load()->model('refund');
		$refund_id = refund_create_order($tid, $this->module['name'], $fee, $reason);
		if (is_error($refund_id)) {
			return $refund_id;
		}
		return refund($refund_id);
	}

	
	public function payResult($ret) {
		global $_W;
		if($ret['from'] == 'return') {
			if ($ret['type'] == 'credit2') {
				message('??????????????????', url('mobile/channel', array('name' => 'index', 'weid' => $_W['weid'])), 'success');
			} else {
				message('??????????????????', '../../' . url('mobile/channel', array('name' => 'index', 'weid' => $_W['weid'])), 'success');
			}
		}
	}

	
	protected function payResultQuery($tid) {
		$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `module`=:module AND `tid`=:tid';
		$params = array();
		$params[':module'] = $this->module['name'];
		$params[':tid'] = $tid;
		$log = pdo_fetch($sql, $params);
		$ret = array();
		if(!empty($log)) {
			$ret['uniacid'] = $log['uniacid'];
			$ret['result'] = $log['status'] == '1' ? 'success' : 'failed';
			$ret['type'] = $log['type'];
			$ret['from'] = 'query';
			$ret['tid'] = $log['tid'];
			$ret['user'] = $log['openid'];
			$ret['fee'] = $log['fee'];
		}
		return $ret;
	}

	
	protected function share($params = array()) {
		global $_W;
		$url = murl('utility/share', array('module' => $params['module'], 'action' => $params['action'], 'sign' => $params['sign'], 'uid' => $params['uid']));
		echo <<<EOF
		<script>
			//?????????????????????
			window.onshared = function(){
				var url = "{$url}";
				$.post(url);
			}
		</script>
EOF;
	}

	
	protected function click($params = array()) {
		global $_W;
		$url = murl('utility/click', array('module' => $params['module'], 'action' => $params['action'], 'sign' => $params['sign'], 'tuid' => $params['tuid'], 'fuid' => $params['fuid']));
		echo <<<EOF
		<script>
			var url = "{$url}";
			$.post(url);
		</script>
EOF;
	}

}


abstract class WeModuleCron extends WeBase {
	public function __call($name, $arguments) {
		if($this->modulename == 'task') {
			$dir = IA_ROOT . '/framework/builtin/task/cron/';
		} else {
			$dir = IA_ROOT . '/addons/' . $this->modulename . '/cron/';
		}
		$fun = strtolower(substr($name, 6));
		$file = $dir . $fun . '.inc.php';
		if(file_exists($file)) {
			require $file;
			exit;
		}
		trigger_error("??????????????? {$name} ?????????.", E_USER_WARNING);
		return error(-1009, "??????????????? {$name} ?????????.");
	}

		public function addCronLog($tid, $errno, $note) {
		global $_W;
		if(!$tid) {
			iajax(-1, 'tid????????????', '');
		}
		$data = array(
			'uniacid' => $_W['uniacid'],
			'module' => $this->modulename,
			'type' => $_W['cron']['filename'],
			'tid' => $tid,
			'note' => $note,
			'createtime' => TIMESTAMP
		);
		pdo_insert('core_cron_record', $data);
		iajax($errno, $note, '');
	}
}


abstract class WeModuleWxapp extends WeBase {
	public $appid;
	public $version;


	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/wxapp';
		$function_name = strtolower(substr($name, 6));
				$func_file = "{$function_name}.inc.php";
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
								$dirs = array_filter($version_path_tree, function($path) use ($func_file){
					$file_path = "$path/$func_file";
					return is_dir($path) && file_exists($file_path);
				});
				$dirs = array_values($dirs);

								$files = array_filter($version_path_tree, function($path) use ($func_file){
					return is_file($path) && pathinfo($path, PATHINFO_BASENAME) == $func_file;
				});
				$files = array_values($files);

				if (count($dirs) > 0) {
					$file = current($dirs).'/'.$func_file;
				} else if(count($files) > 0){
					$file = current($files);
				}
			}
		}
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}

	public function checkSign() {
		global $_GPC;
		if (!empty($_GET) && !empty($_GPC['sign'])) {
			foreach ($_GET as $key => $get_value) {
				if (!empty($get_value) && $key != 'sign') {
					$sign_list[$key] = $get_value;
				}
			}
			ksort($sign_list);
			$sign = http_build_query($sign_list, '', '&') . $this->token;
			return md5($sign) == $_GPC['sign'];
		} else {
			return false;
		}
	}

	protected function pay($order) {
		global $_W, $_GPC;
		load()->model('account');
		$paytype = !empty($order['paytype']) ? $order['paytype'] : 'wechat';
		$moduels = uni_modules();
		if (empty($order) || !array_key_exists($this->module['name'], $moduels)) {
			return error(1, '???????????????');
		}
		$moduleid = empty($this->module['mid']) ? '000000' : sprintf("%06d", $this->module['mid']);
		$uniontid = date('YmdHis') . $moduleid . random(8, 1);
		$paylog = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $order['tid']));
		if (empty($paylog)) {
			$paylog = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $_W['acid'],
				'type' => 'wxapp',
				'openid' => $_W['openid'],
				'module' => $this->module['name'],
				'tid' => $order['tid'],
				'uniontid' => $uniontid,
				'fee' => floatval($order['fee']),
				'card_fee' => floatval($order['fee']),
				'status' => '0',
				'is_usecard' => '0',
				'tag' => iserializer(array('acid' => $_W['acid'], 'uid' => $_W['member']['uid']))
			);
			pdo_insert('core_paylog', $paylog);
			$paylog['plid'] = pdo_insertid();
		}
		if (!empty($paylog) && $paylog['status'] != '0') {
			return error(1, '??????????????????????????????, ?????????????????????.');
		}
		if (!empty($paylog) && empty($paylog['uniontid'])) {
			pdo_update('core_paylog', array(
				'uniontid' => $uniontid,
			), array('plid' => $paylog['plid']));
			$paylog['uniontid'] = $uniontid;
		}
		$_W['openid'] = $paylog['openid'];
		$params = array(
			'tid' => $paylog['tid'],
			'fee' => $paylog['card_fee'],
			'user' => $paylog['openid'],
			'uniontid' => $paylog['uniontid'],
			'title' => $order['title'],
		);
		if ($paytype == 'wechat') {
			return $this->wechatExtend($params);
		} elseif ($paytype == 'credit') {
			return $this->creditExtend($params);
		}
	}
	protected function wechatExtend($params) {
		global $_W;
		load()->model('payment');
		$wxapp_uniacid = intval($_W['account']['uniacid']);
		$setting = uni_setting($wxapp_uniacid, array('payment'));
		$wechat_payment = array(
			'appid' => $_W['account']['key'],
			'signkey' => $setting['payment']['wechat']['signkey'],
			'mchid' => $setting['payment']['wechat']['mchid'],
			'version' => 2,
		);
		return wechat_build($params, $wechat_payment);
	}

	protected function creditExtend($params) {
		global $_W;
		$credtis = mc_credit_fetch($_W['member']['uid']);
		$paylog = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $params['tid']));
		if (empty($_GPC['notify'])) {
			if (!empty($paylog) && $paylog['status'] != '0') {
				return error(-1, '??????????????????');
			}
			if ($credtis['credit2'] < $params['fee']) {
				return error(-1, '????????????');
			}
			$fee = floatval($params['fee']);
			$result = mc_credit_update($_W['member']['uid'], 'credit2', -$fee, array($_W['member']['uid'], '??????credit2:' . $fee));
			if (is_error($result)) {
				return error(-1, $result['message']);
			}
			pdo_update('core_paylog', array('status' => '1'), array('plid' => $paylog['plid']));
			$site = WeUtility::createModuleWxapp($paylog['module']);
			if (is_error($site)) {
				return error(-1, '????????????');
			}
			$site->weid = $_W['weid'];
			$site->uniacid = $_W['uniacid'];
			$site->inMobile = true;
			$method = 'doPagePayResult';
			if (method_exists($site, $method)) {
				$ret = array();
				$ret['result'] = 'success';
				$ret['type'] = $paylog['type'];
				$ret['from'] = 'return';
				$ret['tid'] = $paylog['tid'];
				$ret['user'] = $paylog['openid'];
				$ret['fee'] = $paylog['fee'];
				$ret['weid'] = $paylog['weid'];
				$ret['uniacid'] = $paylog['uniacid'];
				$ret['acid'] = $paylog['acid'];
				$ret['is_usecard'] = $paylog['is_usecard'];
				$ret['card_type'] = $paylog['card_type'];
				$ret['card_fee'] = $paylog['card_fee'];
				$ret['card_id'] = $paylog['card_id'];
				$site->$method($ret);
			}
		} else {
			$site = WeUtility::createModuleWxapp($paylog['module']);
			if (is_error($site)) {
				return error(-1, '????????????');
			}
			$site->weid = $_W['weid'];
			$site->uniacid = $_W['uniacid'];
			$site->inMobile = true;
			$method = 'doPagePayResult';
			if (method_exists($site, $method)) {
				$ret = array();
				$ret['result'] = 'success';
				$ret['type'] = $paylog['type'];
				$ret['from'] = 'notify';
				$ret['tid'] = $paylog['tid'];
				$ret['user'] = $paylog['openid'];
				$ret['fee'] = $paylog['fee'];
				$ret['weid'] = $paylog['weid'];
				$ret['uniacid'] = $paylog['uniacid'];
				$ret['acid'] = $paylog['acid'];
				$ret['is_usecard'] = $paylog['is_usecard'];
				$ret['card_type'] = $paylog['card_type'];
				$ret['card_fee'] = $paylog['card_fee'];
				$ret['card_id'] = $paylog['card_id'];
				$site->$method($ret);
			}
		}
	}
}


abstract class WeModuleAliapp extends WeBase {
	public $appid;
	public $version;

	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/aliapp';
		$function_name = strtolower(substr($name, 6));
				$func_file = "{$function_name}.inc.php";
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
								$dirs = array_filter($version_path_tree, function($path) use ($func_file){
					$file_path = "$path/$func_file";
					return is_dir($path) && file_exists($file_path);
				});
				$dirs = array_values($dirs);

								$files = array_filter($version_path_tree, function($path) use ($func_file){
					return is_file($path) && pathinfo($path, PATHINFO_BASENAME) == $func_file;
				});
				$files = array_values($files);

				if (count($dirs) > 0) {
					$file = current($dirs).'/'.$func_file;
				} else if(count($files) > 0){
					$file = current($files);
				}
			}
		}
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
				'errno' => $errno,
				'message' => $message,
				'data' => $data,
		)));
	}
}


abstract class WeModuleBaiduapp extends WeBase {
	public $appid;
	public $version;

	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/baiduapp';
		$function_name = strtolower(substr($name, 6));
				$func_file = "{$function_name}.inc.php";
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
								$dirs = array_filter($version_path_tree, function($path) use ($func_file){
					$file_path = "$path/$func_file";
					return is_dir($path) && file_exists($file_path);
				});
				$dirs = array_values($dirs);

								$files = array_filter($version_path_tree, function($path) use ($func_file){
					return is_file($path) && pathinfo($path, PATHINFO_BASENAME) == $func_file;
				});
				$files = array_values($files);

				if (count($dirs) > 0) {
					$file = current($dirs).'/'.$func_file;
				} else if(count($files) > 0){
					$file = current($files);
				}
			}
		}
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}
}


abstract class WeModuleToutiaoapp extends WeBase {
	public $appid;
	public $version;

	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/toutiaoapp';
		$function_name = strtolower(substr($name, 6));
				$func_file = "{$function_name}.inc.php";
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
								$dirs = array_filter($version_path_tree, function($path) use ($func_file){
					$file_path = "$path/$func_file";
					return is_dir($path) && file_exists($file_path);
				});
				$dirs = array_values($dirs);

								$files = array_filter($version_path_tree, function($path) use ($func_file){
					return is_file($path) && pathinfo($path, PATHINFO_BASENAME) == $func_file;
				});
				$files = array_values($files);

				if (count($dirs) > 0) {
					$file = current($dirs).'/'.$func_file;
				} else if(count($files) > 0){
					$file = current($files);
				}
			}
		}
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}
}


abstract class WeModuleHook extends WeBase {

}

abstract class WeModuleWebapp extends WeBase {
	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/webapp';
		$function_name = strtolower(substr($name, 6));
		$file = "$dir/{$function_name}.inc.php";
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}
}


abstract class WeModulePhoneapp extends webase {
	public $version;

	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/phoneapp';
		$function_name = strtolower(substr($name, 6));
		$func_file = "{$function_name}.inc.php";
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
								$dirs = array_filter($version_path_tree, function($path) use ($func_file){
					$file_path = "$path/$func_file";
					return is_dir($path) && file_exists($file_path);
				});
				$dirs = array_values($dirs);

								$files = array_filter($version_path_tree, function($path) use ($func_file){
					return is_file($path) && pathinfo($path, PATHINFO_BASENAME) == $func_file;
				});
				$files = array_values($files);

				if (count($dirs) > 0) {
					$file = $dirs[0].'/'.$func_file;
				} else if(count($files) > 0){
					$file = $files[0];
				}
			}
		}
		if (file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}
}


abstract class WeModuleSystemWelcome extends WeBase {
}


abstract class WeModuleMobile extends WeBase {
	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/systemWelcome';
		$function_name = strtolower(substr($name, 5));
		$file = "$dir/{$function_name}.inc.php";
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}
}