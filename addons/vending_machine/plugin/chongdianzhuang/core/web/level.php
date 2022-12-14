<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Level_Page extends PluginWebPage {

    function main() {
        global $_W, $_GPC;

        $set = $_W['shopset']['chongdianzhuang'];
        $leveltype = intval($set['leveltype']);
        
        //默认的
        $default = array(
            'id' => 'default',
            "levelname" => empty($set['levelname']) ? '默认等级' : $set['levelname'],
            'bonus1' => $set['bonus1'],
            'bonus2' => $set['bonus2'],
            'bonus3' => $set['bonus3']
        );
        $others = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_chongdianzhuang_level') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id asc");
        $list = array_merge(array($default), $others);
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
		
        $set = $_W['shopset']['chongdianzhuang'];
        $leveltype = intval($set['leveltype']);

        $id = trim($_GPC['id']);
        if ($id == 'default') {
            //默认的
            $level = array(
                'id' => 'default',
                "levelname" => empty($set['levelname']) ? '默认等级' : $set['levelname'],
                'bonus1' => $set['bonus1'],
                'bonus2' => $set['bonus2'],
                'bonus3' => $set['bonus3']
            );
        } else {
            $level = pdo_fetch("SELECT * FROM " . tablename('vending_machine_chongdianzhuang_level') . " WHERE id=:id and uniacid=:uniacid limit 1", array(':id' => intval($id), ':uniacid' => $_W['uniacid']));
        }

        if ($_W['ispost']) {

            $data = array(
                'uniacid' => $_W['uniacid'],
                'levelname' => trim($_GPC['levelname']),
                'bonus1' => trim(trim($_GPC['bonus1']),'%'),
                'bonus2' => trim(trim($_GPC['bonus2']),'%'),
                'bonus3' => trim(trim($_GPC['bonus3']),'%'),
                'ordermoney' => $_GPC['ordermoney'],
                'ordercount' => intval($_GPC['ordercount']),
                'bonusmoney' => trim($_GPC['bonusmoney'],'%'),
                'downcount' => intval($_GPC['downcount']),
                'commissionmoney' => trim($_GPC['commissionmoney'],'%'),
            );

            if (!empty($id)) {
                if ($id == 'default') {
                    $updatecontent = "<br/>等级名称: {$set['levelname']}->{$data['levelname']}"
                        . "<br/>省级分红比例: {$level['bonus1']}->{$data['bonus1']}"
                        . "<br/>市级红比例: {$level['bonus2']}->{$data['bonus2']}"
                        . "<br/>区级分红比例: {$level['bonus3']}->{$data['bonus3']}";
                    $set['levelname'] = $data['levelname'];
                    $set['bonus1'] = $data['bonus1'];
                    $set['bonus2'] = $data['bonus2'];
                    $set['bonus3'] = $data['bonus3'];
                    $this->updateSet($set);
                    plog('chongdianzhuang.level.edit', "修改代理商默认等级" . $updatecontent);
                } else {

                    $updatecontent = "<br/>等级名称: {$level['levelname']}->{$data['levelname']}"
                            . "<br/>省级分红比例: {$level['bonus1']}->{$data['bonus1']}"
                        . "<br/>市级红比例: {$level['bonus2']}->{$data['bonus2']}"
                        . "<br/>区级分红比例: {$level['bonus3']}->{$data['bonus3']}";
                    pdo_update('vending_machine_chongdianzhuang_level', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
                    plog('chongdianzhuang.level.edit', "修改代理商等级 ID: {$id}" . $updatecontent);
                }
            } else {
                pdo_insert('vending_machine_chongdianzhuang_level', $data);
                $id = pdo_insertid();
                plog('chongdianzhuang.level.add', "添加代理商等级 ID: {$id}");
            }
            show_json(1, array('url' => webUrl('chongdianzhuang/level')));
        }
        include $this->template();
    }

    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,levelname FROM " . tablename('vending_machine_chongdianzhuang_level') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_delete('vending_machine_chongdianzhuang_level', array('id' => $item['id']));
            plog('chongdianzhuang.level.delete', "删除代理商等级 ID: {$id} 等级名称: {$item['levelname']}");
        }
        show_json(1);
    }

}
