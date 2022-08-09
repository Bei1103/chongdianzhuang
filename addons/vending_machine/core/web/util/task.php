<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Task_Page extends WebPage {

	function main() {
		  $this->runTasks();
	}
	
}
