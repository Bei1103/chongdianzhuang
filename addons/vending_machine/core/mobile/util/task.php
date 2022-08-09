<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Task_Page extends MobilePage {

	function main() {
		  $this->runTasks();
	}
	
}
