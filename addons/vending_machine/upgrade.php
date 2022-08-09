<?php
if(!defined('IN_IA')){
    exit('Access Denied');
}

$upgradesql = '';

if (!pdo_fieldexists('vending_machine_device','channel')){
    $upgradesql .= "ALTER TABLE `ims_vending_machine_device` ADD `channel` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '设备频道' AFTER `version`;";
}

if (!empty($upgradesql)){
    pdo_query($upgradesql);
}