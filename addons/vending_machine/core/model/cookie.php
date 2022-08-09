<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Cookie_Model {
	
	private $prefix;
	public function __construct() {
		global $_W;
		$this->prefix = VENDING_MACHINE_PREFIX . '_cookie_'. $_W['uniacid'] . '_' ;
	}
	function set($key ,$value) {
		setcookie($this->prefix.$key, iserializer($value),time() + 3600 * 24 * 365);
	}
	function get($key){
		if(!isset($_COOKIE[$this->prefix.$key])){
			return false;
		}
		return iunserializer($_COOKIE[$this->prefix.$key]);
	}
	
}
