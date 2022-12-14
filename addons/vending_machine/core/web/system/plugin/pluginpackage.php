<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Pluginpackage_Page extends SystemPage {

    function main() {
        global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));

        $psize = 20;
        $condition = "";
        $params = array();

        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition.=' and gp.text like :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        if ($_GPC['state'] != '') {
            $condition.=' and gp.state=' . intval($_GPC['state']);
        }

        $list = pdo_fetchall("SELECT gp.*,p.identity,p.category,p.version,p.author,p.status,p.name FROM " . tablename('vending_machine_system_plugingrant_package') . " as gp
                left join ".tablename('vending_machine_plugin')." as p on p.id = gp.pluginid
                WHERE 1 {$condition} ORDER BY gp.displayorder,gp.id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
        foreach ($list as $key => $value){
            $list[$key]['data'] = unserialize($value['data']);
            /*$plugin = array();
            $plugin = pdo_fetchall('select * from ' . tablename('vending_machine_plugin') . ' where id in ('.trim($value['pluginid']).') ');
            foreach ($plugin as $k => &$row){
                $list[$key]['title'] .= $row['name'].";";
            }*/
            unset($row);
        }
        $total = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename('vending_machine_system_plugingrant_package') . " as gp
                left join ".tablename('vending_machine_plugin')." as p on p.id = gp.pluginid
                WHERE 1 {$condition} ", $params);
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
        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_system_plugingrant_package') . " WHERE id =:id limit 1", array(':id' => $id));

        if ($_W['ispost']) {

            $data = array(
                'displayorder' => intval($_GPC['displayorder']),
                'text' => trim($_GPC['pluginid_text']),
                'thumb' => save_media($_GPC['thumb']),
                'desc' => trim($_GPC['desc']),
                'rec' => intval($_GPC['rec']),
                'pluginid' => is_array($_GPC['pluginid']) ? implode(',', $_GPC['pluginid']) : 0,
                'state' => intval($_GPC['state']),
                'content' => m('common')->html_images($_GPC['content'])
            );
            if(count($_GPC['pluginid'])>4){
                show_json(0,"?????????????????????4????????????");
            }

            $dates = array();
            $datearray = is_array($_GPC['date']) ? $_GPC['date'] : array();
            foreach ($datearray as $key => $value) {
                $date = floatval($value);
                if ($date >= 0) {
                    $dates[] = array(
                        'date' => floatval($_GPC['date'][$key]),
                        'price' => floatval($_GPC['price'][$key])
                    );
                }
            }
            $data['data'] = serialize($dates);

            if (!empty($id)) {
                pdo_update('vending_machine_system_plugingrant_package', $data, array('id' => $id));
            } else {
                pdo_insert('vending_machine_system_plugingrant_package', $data);
                $id = pdo_insertid();
            }
            show_json(1, array('url' => webUrl('system/plugin/pluginpackage/edit',array('id'=>$id))));
        }
        $pluginData = unserialize($item['data']);
        if(!empty($item)){
            $plugin = array();
            $plugin = pdo_fetchall('select * from ' . tablename('vending_machine_plugin') . ' where id in ('.trim($item['pluginid']).') ');
            foreach ($plugin as $key => &$value){
                $value['title'] = $value['name'];
                $item['title'] .= $value['name'].";";
            }
            unset($value);
        }
        include $this->template();
    }
    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,text FROM " . tablename('vending_machine_system_plugingrant_package') . " WHERE id in( $id ) ");

        foreach ($items as $item) {
            pdo_delete('vending_machine_system_plugingrant_package', array('id' => $item['id']));
            plog('system.plugin.pluginpackage.delete', "??????????????????<br/>ID: {$item['id']}<br/>????????????: {$item['text']}");
        }
        show_json(1, array('url' => referer()));
    }
    function property() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $type = trim($_GPC['type']);

        $value = intval($_GPC['value']);
        if (in_array($type, array('state', 'rec', 'displayorder'))) {

            pdo_update("vending_machine_system_plugingrant_package", array($type => $value), array("id" => $id));
            $statusstr = "";
            if ($type == 'rec') {
                $typestr = "??????";
                $statusstr = $value == 1 ? '????????????' : '??????';
            } else if ($type == 'state') {
                $typestr = "??????";
                $statusstr = $value == 1 ? '??????' : '??????';
            } else if ($type == 'displayorder') {
                $typestr = "??????";
                $statusstr = "?????? {$value}";
            }
            plog('system.plugin.pluginpackage.edit', "????????????????????????{$typestr}??????   ID: {$id} {$statusstr} ");
        }
        show_json(1);
    }

    function query() {
        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 8;
        $kwd = trim($_GPC['keyword']);
        $params = array();

        $condition = " and deprecated=0 and status=1 ";
        if (!empty($kwd)) {
            $condition.=" AND name LIKE :keyword ";
            $params[':keyword'] = "%{$kwd}%";
        }
        $pluginid = '';
        $grantPlugin = array();
        $grantPlugin = pdo_fetchall("select pluginid from ".tablename('vending_machine_system_plugingrant_package')." where 1 ");
        foreach ($grantPlugin as $key => $valeu){
            $pluginid .= $valeu['pluginid'].",";
        }
        $pluginid = substr($pluginid,0,strlen($pluginid)-1);
        if(!empty($pluginid)){
            $condition .= " and id not in (".$pluginid.") ";
        }

        $plugins = pdo_fetchall('select id,`name` as title,thumb,`desc` from ' . tablename('vending_machine_plugin') . ' where 1 '.$condition.' order by displayorder asc LIMIT '. ($pindex - 1) * $psize . ',' . $psize,$params);

        $total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('vending_machine_plugin') . " WHERE 1 ".$condition." ", $params);
        $pager = pagination2($total, $pindex, $psize,'',array('before' => 5, 'after' => 4, 'ajaxcallback'=>'select_page', 'callbackfuncname'=>'select_page'));

        include $this->template();
    }

}

