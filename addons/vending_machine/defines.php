<?php

if(!defined('IN_IA')) {
     exit('Access Denied');
}
define('VENDING_MACHINE_DEBUG', true);
!defined('VENDING_MACHINE_PATH') && define('VENDING_MACHINE_PATH',IA_ROOT.'/addons/vending_machine/');
!defined('VENDING_MACHINE_CORE') && define('VENDING_MACHINE_CORE', VENDING_MACHINE_PATH .'core/');
!defined('VENDING_MACHINE_DATA') && define('VENDING_MACHINE_DATA', VENDING_MACHINE_PATH .'data/');
!defined('VENDING_MACHINE_VENDOR') && define('VENDING_MACHINE_VENDOR', VENDING_MACHINE_PATH .'vendor/');
!defined('VENDING_MACHINE_CORE_WEB') && define('VENDING_MACHINE_CORE_WEB', VENDING_MACHINE_CORE .'web/');
!defined('VENDING_MACHINE_CORE_MOBILE') && define('VENDING_MACHINE_CORE_MOBILE', VENDING_MACHINE_CORE .'mobile/');
!defined('VENDING_MACHINE_CORE_SYSTEM') && define('VENDING_MACHINE_CORE_SYSTEM', VENDING_MACHINE_CORE .'system/');
!defined('VENDING_MACHINE_PLUGIN') && define('VENDING_MACHINE_PLUGIN',VENDING_MACHINE_PATH.'plugin/');
!defined('VENDING_MACHINE_PROCESSOR') && define('VENDING_MACHINE_PROCESSOR',VENDING_MACHINE_CORE.'processor/');
!defined('VENDING_MACHINE_INC') && define('VENDING_MACHINE_INC', VENDING_MACHINE_CORE.'inc/');
!defined('VENDING_MACHINE_URL') && define('VENDING_MACHINE_URL',$_W['siteroot'].'addons/vending_machine/');
!defined('VENDING_MACHINE_TASK_URL') && define('VENDING_MACHINE_TASK_URL',$_W['siteroot'].'addons/vending_machine/core/task/');
!defined('VENDING_MACHINE_LOCAL') && define('VENDING_MACHINE_LOCAL','../addons/vending_machine/');
!defined('VENDING_MACHINE_STATIC') && define('VENDING_MACHINE_STATIC', VENDING_MACHINE_URL.'static/');
!defined('VENDING_MACHINE_PREFIX') && define('VENDING_MACHINE_PREFIX','vending_machine_');
!defined('VENDING_MACHINE_AUTH_URL') && define('VENDING_MACHINE_AUTH_URL','http://127.0.0.1');
!defined('VENDING_MACHINE_AUTH_WXAPP') && define('VENDING_MACHINE_AUTH_WXAPP','https://127.0.0.1/');
!defined('VENDING_MACHINE_NEW_AUTH_URL') && define('VENDING_MACHINE_NEW_AUTH_URL','http://127.0.0.1');
define('VENDING_MACHINE_PLACEHOLDER','../addons/vending_machine/static/images/placeholder.png');