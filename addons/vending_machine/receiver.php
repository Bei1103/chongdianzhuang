<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}
require_once IA_ROOT. '/addons/vending_machine/version.php';
require_once IA_ROOT. '/addons/vending_machine/defines.php';
require_once VENDING_MACHINE_INC.'functions.php';
require_once VENDING_MACHINE_INC.'receiver.php';
class Vending_machineModuleReceiver extends Receiver {
	public function receive() {
		parent::receive();
	}
}