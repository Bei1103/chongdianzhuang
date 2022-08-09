<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Express_Model {

    /**
     * 获取快递列表
     */
    function getExpressList() {
        global $_W;

        $sql = 'select * from ' . tablename('vending_machine_express') . ' where status=1 order by displayorder desc,id asc';
        $data = pdo_fetchall($sql);

        return $data;
    } 
}
