<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}
require_once IA_ROOT. '/addons/vending_machine/version.php';
require_once IA_ROOT. '/addons/vending_machine/defines.php';
require_once VENDING_MACHINE_INC.'functions.php';
require_once VENDING_MACHINE_INC.'processor.php';
require_once VENDING_MACHINE_INC.'plugin_model.php';
require_once VENDING_MACHINE_INC.'com_model.php';
class Vending_machineModuleProcessor extends Processor {
     
    public function respond() {
        return parent::respond();  
    }
    
}
