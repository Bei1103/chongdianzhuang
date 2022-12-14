<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2016/3/23
 * Time: 10:27
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Companycategory_Page extends SystemPage {

    function main() {
        global $_W,$_GPC;
        if (!empty($_GPC['catid'])) {

            foreach ($_GPC['catid'] as $k => $v) {

                $data = array(
                    'name' => trim($_GPC['catname'][$k]),
                    'displayorder' => $k,
                    'status' => intval($_GPC['status'][$k]),
                );
                if (empty($v)) {
                    pdo_insert('vending_machine_system_company_category', $data);
                    $insert_id = pdo_insertid();
                    plog('system.category.add', "添加分类 ID: {$insert_id}");
                } else {
                    pdo_update('vending_machine_system_company_category', $data, array('id' => $v));
                    plog('system.category.edit', "修改分类 ID: {$v}");
                }
            }
            plog('system.category.edit', '批量修改分类');
            show_json(1);
        }
        $list = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_system_company_category') . " ORDER BY displayorder asc");
        include $this->template();
    }

    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $item = pdo_fetch("SELECT id,name FROM " . tablename('vending_machine_system_company_category') . " WHERE id = :id",array(':id'=>$id));
        if (!empty($item)) {
            pdo_delete('vending_machine_system_company_category', array('id' => $id));
            plog('system.category.delete', "删除分类 ID: {$id} 标题: {$item['name']} ");
        }
        show_json(1);
    }
}