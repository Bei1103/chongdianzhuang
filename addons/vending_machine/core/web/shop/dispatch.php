<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Dispatch_Page extends WebPage {

    function main() {

        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = " and uniacid=:uniacid and merchid=0";
        $params = array(':uniacid' => $_W['uniacid']);
        if ($_GPC['enabled'] != '') {
            $condition.=' and enabled=' . intval($_GPC['enabled']);
        }
        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition.=' and dispatchname  like :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        $list = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_dispatch') . " WHERE 1 {$condition}  ORDER BY displayorder DESC limit " . ($pindex - 1) * $psize . ',' . $psize, $params);
        $total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('vending_machine_dispatch') . " WHERE 1 {$condition}", $params);
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

        if ($_W['ispost']) {
            //ιιεΊε
            $areas = array();
            $randoms = $_GPC['random'];
            if (is_array($randoms)) {
                foreach ($randoms as $random) {
                    $citys = trim($_GPC['citys'][$random]);
                    if (empty($citys)) {
                        continue;
                    }
                    if ($_GPC['firstnum'][$random] < 1) {
                        $_GPC['firstnum'][$random] = 1;
                    }
                    if ($_GPC['secondnum'][$random] < 1) {
                        $_GPC['secondnum'][$random] = 1;
                    }
                    $areas[] = array(
                        'citys' => $_GPC['citys'][$random],
                        'citys_code' => $_GPC['citys_code'][$random],
                        'firstprice' => $_GPC['firstprice'][$random],
                        'firstweight' => max(0,$_GPC['firstweight'][$random]),
                        'secondprice' => $_GPC['secondprice'][$random],
                        'secondweight' => $_GPC['secondweight'][$random]<=0?1000:$_GPC['secondweight'][$random],
                        'firstnumprice' => $_GPC['firstnumprice'][$random],
                        'firstnum' => $_GPC['firstnum'][$random],
                        'secondnumprice' => $_GPC['secondnumprice'][$random],
                        'secondnum' => $_GPC['secondnum'][$random],
                        'freeprice' => $_GPC['freeprice'][$random]
                    );
                }
            }

            $_GPC['default_firstnum'] = trim($_GPC['default_firstnum']);
            if ($_GPC['default_firstnum'] < 1) {
                $_GPC['default_firstnum'] = 1;
            }
            $_GPC['default_secondnum'] = trim($_GPC['default_secondnum']);
            if ($_GPC['default_secondnum'] < 1) {
                $_GPC['default_secondnum'] = 1;
            }
            $data = array(
                'uniacid' => $_W['uniacid'],
                'merchid' => 0,
                'displayorder' => intval($_GPC['displayorder']),
                'dispatchtype' => intval($_GPC['dispatchtype']),
                'isdefault' => intval($_GPC['isdefault']),
                'dispatchname' => trim($_GPC['dispatchname']),
                'express' => trim($_GPC['express']),
                'calculatetype' => trim($_GPC['calculatetype']),
                'firstprice' => trim($_GPC['default_firstprice']),
                'firstweight' => trim(max(0,$_GPC['default_firstweight'])),
                'secondprice' => trim($_GPC['default_secondprice']),
                'secondweight' => intval($_GPC['default_secondweight']) <=0 ? 1000:trim($_GPC['default_secondweight']),
                'firstnumprice' => trim($_GPC['default_firstnumprice']),
                'firstnum' => $_GPC['default_firstnum'],
                'secondnumprice' => trim($_GPC['default_secondnumprice']),
                'secondnum' => $_GPC['default_secondnum'],
                'freeprice' => $_GPC['default_freeprice'],
                'areas' => iserializer($areas),
                'nodispatchareas' => !empty($_GPC['nodispatchareas']) ? iserializer($_GPC['nodispatchareas']) : '',
                'nodispatchareas_code' => !empty($_GPC['nodispatchareas_code']) ? iserializer($_GPC['nodispatchareas_code']) : '',
                'isdispatcharea' => intval($_GPC['isdispatcharea']),
                'enabled' => intval($_GPC['enabled'])
            );

            if ($data['isdefault']) {
                pdo_update('vending_machine_dispatch', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'merchid' => 0));
            }

            if (!empty($id)) {
                plog('shop.dispatch.edit', "δΏ?ζΉιιζΉεΌ ID: {$id}");
                pdo_update('vending_machine_dispatch', $data, array('id' => $id));
            } else {
                pdo_insert('vending_machine_dispatch', $data);
                $id = pdo_insertid();
                plog('shop.dispatch.add', "ζ·»ε ιιζΉεΌ ID: {$id}");
            }

            show_json(1, array('url' => webUrl('shop/dispatch', array('op' => 'display'))));
        }
        //δΏ?ζΉ
        $dispatch = pdo_fetch("SELECT * FROM " . tablename('vending_machine_dispatch') . " WHERE id = '$id' and merchid=0 and uniacid = '{$_W['uniacid']}'");
        if (!empty($dispatch)) {
            $dispatch_areas = unserialize($dispatch['areas']);
            $dispatch_carriers = unserialize($dispatch['carriers']);
            $dispatch_nodispatchareas = unserialize($dispatch['nodispatchareas']);
            $dispatch_nodispatchareas_code = unserialize($dispatch['nodispatchareas_code']);
        }

        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);

        $areas = m('common')->getAreas();

        $express_list = m('express')->getExpressList();

        include $this->template();
    }

    function delete() {

        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,dispatchname FROM " . tablename('vending_machine_dispatch') . " WHERE id in( $id ) AND merchid=0 AND uniacid=" . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_delete('vending_machine_dispatch', array('id' => $item['id']));
            plog('shop.dispatch.delete', "ε ι€ιιζΉεΌ ID: {$item['id']} ζ ι’: {$item['dispatchname']} ");
        }
        show_json(1, array('url' => referer()));
    }

    function enabled() {

        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,dispatchname FROM " . tablename('vending_machine_dispatch') . " WHERE id in( $id ) AND merchid=0 AND uniacid=" . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_update('vending_machine_dispatch', array('enabled' => intval($_GPC['enabled'])), array('id' => $item['id']));
            plog('shop.dispatch.edit', "δΏ?ζΉιιζΉεΌηΆζ<br/>ID: {$item['id']}<br/>ζ ι’: {$item['dispatchname']}<br/>ηΆζ: " . $_GPC['enabled'] == 1 ? 'ζΎη€Ί' : 'ιθ');
        }
        show_json(1, array('url' => referer()));
    }

    function setdefault() {

        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        if ($_GPC['isdefault'] == 1) {
            pdo_update('vending_machine_dispatch', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'merchid' => 0));
        }
        $items = pdo_fetchall("SELECT id,dispatchname FROM " . tablename('vending_machine_dispatch') . " WHERE id in( $id ) AND merchid=0 AND uniacid=" . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_update('vending_machine_dispatch', array('isdefault' => intval($_GPC['isdefault'])), array('id' => $item['id']));
            plog('shop.dispatch.edit', "θ?ΎδΈΊι»θ?€ιιζΉεΌ<br/>ID: {$item['id']}<br/>ζ ι’: {$item['dispatchname']}<br/>ηΆζ: " . $_GPC['isdefault'] == 1 ? 'ζ―' : 'ε¦');
        }
        show_json(1, array('url' => referer()));
    }
function displayorder() {

		global $_W, $_GPC;
		$id = intval($_GPC['id']);

		$displayorder = intval($_GPC['value']);
		$item = pdo_fetchall("SELECT id,dispatchname FROM " . tablename('vending_machine_dispatch') . " WHERE id in( $id ) AND merchid=0 AND uniacid=" . $_W['uniacid']);

		if (!empty($item)) {
			pdo_update('vending_machine_dispatch', array('displayorder' => $displayorder), array('id' => $id));
			plog('shop.dispatch.edit', "δΏ?ζΉιιζΉεΌζεΊ ID: {$item['id']} ζ ι’: {$item['dispatchname']} ζεΊ: {$displayorder} ");
		}
		show_json(1);
	}

    function tpl() {
        global $_W, $_GPC;
        $random = random(16);

        ob_start();
        include $this->template('shop/dispatch/tpl');
        $contents = ob_get_contents();
        ob_clean();
        die(json_encode(array(
            'random' => $random,
            'html' => $contents
        )));
    }

}
