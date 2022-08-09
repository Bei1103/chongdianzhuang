<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Selecticon_Page extends WebPage {
	 
	function main() {
		global $_W, $_GPC;

		include $this->template();
	}
}
