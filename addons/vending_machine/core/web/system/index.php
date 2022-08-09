<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_Page extends SystemPage {

	 
	function main() {
		header("Location:".webUrl('system/plugin'));
		exit;
		include $this->template();
	}
}
