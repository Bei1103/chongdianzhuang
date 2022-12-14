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

class Guestbook_Page extends SystemPage {

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
                    pdo_insert('vending_machine_system_guestbook', $data);
                    $insert_id = pdo_insertid();
                    plog('system.guestbook.add', "添加分类 ID: {$insert_id}");
                } else {
                    pdo_update('vending_machine_system_guestbook', $data, array('id' => $v));
                    plog('system.guestbook.edit', "修改分类 ID: {$v}");
                }
            }
            plog('system.guestbook.edit', '批量修改分类');
            show_json(1);
        }
        $list = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_system_guestbook') . " ORDER BY id desc");
        include $this->template();
    }

    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $item = pdo_fetch("SELECT id,title FROM " . tablename('vending_machine_system_guestbook') . " WHERE id = :id",array(':id'=>$id));
        if (!empty($item)) {
            pdo_delete('vending_machine_system_guestbook', array('id' => $id));
            plog('system.guestbook.delete', "删除留言 ID: {$id} 标题: {$item['title']} ");
        }
        show_json(1);
    }

    function view() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_system_guestbook') . " WHERE id = :id",array(':id'=>$id));
        include $this->template();
    }
}