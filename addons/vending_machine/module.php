<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}
require_once IA_ROOT . '/addons/vending_machine/version.php';
require_once IA_ROOT . '/addons/vending_machine/defines.php';
require_once VENDING_MACHINE_INC . 'functions.php';
class Vending_machineModule extends WeModule {

     	public function welcomeDisplay() {
		header('location: '.webUrl());
		exit;
	}
}
