<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Recycled_Page extends ComWebPage {

    public function __construct($_com='virtual')
    {
        parent::__construct($_com);
    }

    function main() {

        global $_W, $_GPC;

        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pindex = max(1, intval($page));
        $psize = 12;
        $kw = empty($_GPC['keyword']) ? "" : $_GPC['keyword'];
        $items = pdo_fetchall('SELECT * FROM ' . tablename('vending_machine_virtual_type') . ' WHERE uniacid=:uniacid and merchid=0 and title like :name and recycled = 1 order by id desc limit ' . ($pindex - 1) * $psize . ',' . $psize, array(':name' => "%{$kw}%", ':uniacid' => $_W['uniacid']));
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('vending_machine_virtual_type') . " WHERE uniacid=:uniacid and merchid=0 and title like :name and recycled = 1 order by id desc ", array(':uniacid' => $_W['uniacid'], ':name' => "%{$kw}%"));
        $pager = pagination2($total, $pindex, $psize);
        $category = pdo_fetchall('select * from '.tablename('vending_machine_virtual_category').' where uniacid=:uniacid and merchid=0 order by id desc',array(':uniacid'=>$_W['uniacid']),'id');
        include $this->template();
    }


    function delete() {

        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $types = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_virtual_type') . " WHERE id in( $id ) and merchid=0 AND uniacid=" . $_W['uniacid']);
        foreach ($types as $type) {
            pdo_delete('vending_machine_virtual_type', array('id' => $type['id']));
            pdo_delete('vending_machine_virtual_data', array('typeid' => $type['id']));
            plog('virtual.temp.delete', "删除模板 ID: {$type['id']}");
        }
        show_json(1, array('url' => webUrl('goods/virtual')));
    }

    function recover(){
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $types = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_virtual_type') . " WHERE id in( $id ) and merchid=0 AND uniacid=" . $_W['uniacid']);
        foreach ($types as $type) {
            pdo_update('vending_machine_virtual_type', array('recycled'=> 0),array('id' => $type['id']));
            //pdo_delete('vending_machine_virtual_data', array('typeid' => $type['id']));
            plog('virtual.recycled.recover', "模板移出回收站 ID: {$type['id']}");
        }
        show_json(1, array('url' => webUrl('goods/virtual/recycled')));
    }

}
