<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Label_Page extends WebPage {

    function main() {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $params[':uniacid'] = $uniacid;
        $condition = '';

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        if ($_GPC['enabled'] != '') {
            $condition.=' and status=' . intval($_GPC['enabled']);
        }
        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .=' and label like :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        $label = pdo_fetchall("SELECT id,uniacid,label,labelname,status,displayorder FROM " . tablename('vending_machine_goods_label') . "
                WHERE uniacid=:uniacid ".$condition." order by id limit " . ($pindex - 1) * $psize . ',' . $psize, $params);

        $total = pdo_fetchcolumn("SELECT count(1) FROM " . tablename('vending_machine_goods_label') . " WHERE uniacid=:uniacid {$condition}", $params);
        $pager = pagination2($total, $pindex, $psize);

		include $this->template();
    }
    function add() {
        $this->post();
    }
    function edit() {
        $this->post();
    }
    protected function post() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $uniacid = intval($_W['uniacid']);
        if(!empty($id)) {
            $item = pdo_fetch("SELECT id,uniacid,label,labelname,status,displayorder FROM " . tablename('vending_machine_goods_label') . "
                    WHERE id=:id and uniacid=:uniacid limit 1 ", array(':id'=>$id, ':uniacid'=>$uniacid));
            if(json_decode($item['labelname'],true)){
                $labelname = json_decode($item['labelname'],true);
            }else{
                $labelname = unserialize($item['labelname']);
            }

        }
        if($_W['ispost']) {
            if(empty($_GPC['labelname'])){
                $_GPC['labelname'] = array();
            }
            $data = array(
                'label' =>trim($_GPC['label']),
                'labelname' =>serialize(array_filter($_GPC['labelname'])),
                'status' =>intval($_GPC['status']),
                'displayorder' => intval($_GPC['displayorder'])
            );
            if(!empty($item)) {
                pdo_update('vending_machine_goods_label', $data, array('id' => $item['id']));
                plog('goods.label.edit', "??????????????? ID: {$id}");
            }else{
                $data['uniacid'] = $uniacid;
                pdo_insert('vending_machine_goods_label', $data);
                $id = pdo_insertid();
                plog('goods.label.add', "??????????????? ID: {$id}");
            }
            show_json(1,array('url'=>webUrl('goods/label/edit', array('id'=>$id))));
        }

        include $this->template();
    }
    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,label FROM " . tablename('vending_machine_goods_label') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        if(empty($item)){
            $item = array();
        }
        foreach ($items as $item) {
            pdo_delete('vending_machine_goods_label', array('id' => $item['id']));
            plog('goods.edit', "?????????????????????????????????<br/>ID: {$item['id']}<br/>???????????????: {$item['label']}");
        }
        show_json(1, array('url' => referer()));
    }
    function status() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,label FROM " . tablename('vending_machine_goods_label') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        if(empty($item)){
            $item = array();
        }
        foreach ($items as $item) {
            pdo_update('vending_machine_goods_label', array('status' => intval($_GPC['status'])), array('id' => $item['id']));
            plog('goods.label.edit', "?????????????????????<br/>ID: {$item['id']}<br/>???????????????: {$item['label']}<br/>??????: " . $_GPC['status'] == 1 ? '??????' : '??????');
        }
        show_json(1, array('url' => referer()));
    }
    function query(){
        global $_W, $_GPC;
        $kwd = trim($_GPC['keyword']);

        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $condition=" and uniacid=:uniacid and status = 1 ";
        if (!empty($kwd)) {
            $condition.=" AND label LIKE :keywords ";
            $params[':keywords'] = "%{$kwd}%";
        }

        $labels = pdo_fetchall('SELECT id,label,labelname FROM ' . tablename('vending_machine_goods_label') . " WHERE 1 {$condition} order by id desc", $params);
        if(empty($labels)){
            $labels = array();
        }
        foreach($labels as $key => $value){
            if(json_decode($value['labelname'],true)){
                $labels[$key]['labelname'] = json_decode($value['labelname'],true);
            }else{
                $labels[$key]['labelname'] = unserialize($value['labelname']);
            }

        }
        include $this->template();
    }
    function labelfile(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if(empty($id)){
            show_json(0,'?????????????????????????????????????????????');
        }
        $params = array(
            ':uniacid' => $_W['uniacid'],
            ':id' => $id,
            ':status' => 1
        );
        $condition = " and id = :id and uniacid=:uniacid and status = :status ";

        $labels = pdo_fetch('SELECT id,label,labelname FROM ' . tablename('vending_machine_goods_label') . " WHERE 1 {$condition} order by id desc", $params);
        if(empty($labels)){
            $labels = array();
            show_json(0,'?????????????????????????????????????????????');
        }
        if(json_decode($labels['labelname'],true)){
            $labels['labelname'] = json_decode($labels['labelname'],true);
        }else{
            $labels['labelname'] = unserialize($labels['labelname']);
        }

        show_json(1,array('label'=>$labels['labelname']));
    }
    function style(){
        global $_W, $_GPC;
        $uniacid = intval($_W['uniacid']);
        $style = pdo_fetch("SELECT id,uniacid,style FROM " . tablename('vending_machine_goods_labelstyle') . " WHERE uniacid=" . $uniacid);
        if($_W['ispost']) {
            $data['style'] = intval($_GPC['style']);

            if(!empty($style)) {
                pdo_update('vending_machine_goods_labelstyle', $data, array('uniacid' => $uniacid));
                plog('goods.labelstyle.edit', "?????????????????????");
            }else{
                $data['uniacid'] = $uniacid;
                pdo_insert('vending_machine_goods_labelstyle', $data);
                $id = pdo_insertid();
                plog('goods.labelstyle.add', "?????????????????????");
            }

            show_json(1,array('url'=>webUrl('goods/label/style')));
        }
        include $this->template();
    }
}
