<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Saler_Page extends ComWebPage {

    public function __construct($_com='verify')
    {
        parent::__construct($_com);
    }
    
    function main() {

        global $_W, $_GPC;

        $condition = " s.uniacid = :uniacid";
        $params = array(':uniacid' => $_W['uniacid']);


        if ($_GPC['status'] != '') {
            $condition .= " and s.status = :status";
            $params[':status'] = $_GPC['status'];
        }

        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .=" and ( s.salername like :keyword or m.realname like :keyword or m.mobile like :keyword or m.nickname like :keyword)";
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }

        $sql = "SELECT s.*,m.nickname,m.avatar,m.mobile,m.realname,store.storename FROM " . tablename('vending_machine_saler') . "  s "
            . " left join " . tablename('vending_machine_member') . " m on s.openid=m.openid and m.uniacid = s.uniacid "
            . " left join " . tablename('vending_machine_store') . " store on store.id=s.storeid "
            . " WHERE {$condition} ORDER BY id asc";

        $list = pdo_fetchall($sql, $params);




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

        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_saler') . " WHERE id =:id and uniacid=:uniacid limit 1", array(':uniacid' => $_W['uniacid'], ':id' => $id));
        if (!empty($item)) {
            $saler = m('member')->getMember($item['openid']);
            $store = pdo_fetch("SELECT * FROM " . tablename('vending_machine_store') . " WHERE id =:id and uniacid=:uniacid limit 1", array(':uniacid' => $_W['uniacid'], ':id' => $item['storeid']));
        }
        if ($_W['ispost']) {
            $data = array(
                'uniacid' => $_W['uniacid'],
                'storeid' => intval($_GPC['storeid']),
                'openid' => trim($_GPC['openid']),
                'status' => intval($_GPC['status']),
                'salername' => trim($_GPC['salername'])
            );
            $m = m('member')->getMember($data['openid']);
            if (!empty($id)) {
                pdo_update('vending_machine_saler', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
                plog('shop.verify.saler.edit', "???????????? ID: {$id} <br/>????????????: ID: {$m['id']} / {$m['openid']}/{$m['nickname']}/{$m['realname']}/{$m['mobile']} ");
            } else {
                $scount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('vending_machine_saler') . " WHERE openid =:openid and uniacid=:uniacid limit 1", array(':uniacid' => $_W['uniacid'], ':openid' => $data['openid']));
                if ($scount > 0) {
                    show_json(0, '????????????????????????????????????????????????');
                }
                pdo_insert('vending_machine_saler', $data);
                $id = pdo_insertid();
                plog('shop.verify.saler.add', "???????????? ID: {$id}  <br/>????????????: ID: {$m['id']} / {$m['openid']}/{$m['nickname']}/{$m['realname']}/{$m['mobile']} ");
            }
            show_json(1, array('url' => webUrl('shop/verify/saler')));
        }
        include $this->template();
    }

    function delete() {
        global $_W, $_GPC;


        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,salername FROM " . tablename('vending_machine_saler') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_delete('vending_machine_saler', array('id' => $item['id']));
            plog('shop.verify.saler.delete', "???????????? ID: {$item['id']} ????????????: {$item['salername']} ");
        }
        show_json(1, array('url' => referer()));
    }

    function status() {
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,salername FROM " . tablename('vending_machine_saler') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_update('vending_machine_saler', array('status' => intval($_GPC['status'])), array('id' => $item['id']));
            plog('shop.verify.saler.edit', "??????????????????<br/>ID: {$item['id']}<br/>????????????: {$item['salername']}<br/>??????: " . $_GPC['status'] == 1 ? '??????' : '??????');
        }
        show_json(1, array('url' => referer()));
    }

    function query() {
        global $_W, $_GPC;

        $kwd = trim($_GPC['keyword']);
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $condition = " and s.uniacid=:uniacid";
        if (!empty($kwd)) {
            $condition.=" AND ( m.nickname LIKE :keyword or m.realname LIKE :keyword or m.mobile LIKE :keyword or store.storename like :keyword )";
            $params[':keyword'] = "%{$kwd}%";
        }
        $ds = pdo_fetchall("SELECT s.*,m.nickname,m.avatar,m.openid,m.mobile,m.realname,store.storename FROM " . tablename('vending_machine_saler') . "  s "
                . " left join " . tablename('vending_machine_member') . " m on s.openid=m.openid "
                . " left join " . tablename('vending_machine_store') . " store on store.id=s.storeid "
                . " WHERE 1 {$condition} ORDER BY id asc", $params);
        include $this->template();
        exit;
    }

}
