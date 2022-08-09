<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class chongdianzhuangMobileLoginPage extends PluginMobileLoginPage {

	public function __construct() {
		parent::__construct();
		
		global $_W, $_GPC;
	}
	public function footerMenus($diymenuid = NULL, $p = NULL, $texts=array()) {
		global $_W, $_GPC;
		include $this->template('chongdianzhuang/_menu');
	}

}
