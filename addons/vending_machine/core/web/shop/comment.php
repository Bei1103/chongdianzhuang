<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Comment_Page extends WebPage {

    function main() {

        global $_W,$_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = " and c.uniacid=:uniacid and c.deleted=0 and g.merchid=0";
        $params = array(':uniacid' => $_W['uniacid']);

        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition.=' and ( o.ordersn like :keyword or g.title like :keyword)';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $condition .= " AND c.createtime >= :starttime AND c.createtime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }

        if ($_GPC['fade'] != '') {
            if (empty($_GPC['fade'])) {
                $condition .= " AND c.openid=''";
            } else {
                $condition .= " AND c.openid<>''";
            }
        }

        if ($_GPC['replystatus'] != '') {
            if (empty($_GPC['replystatus'])) {
                $condition .= " AND c.reply_content=''";
            } else {
                $condition .= " AND c.append_content='' and c.append_reply_content=''";
            }
        }


        $list = pdo_fetchall("SELECT  c.*, o.ordersn,g.title,g.thumb FROM " . tablename('vending_machine_order_comment') . " c  "
            . " left join " . tablename('vending_machine_goods') . " g on c.goodsid = g.id  "
            . " left join " . tablename('vending_machine_order') . " o on c.orderid = o.id  "
            . " WHERE 1 {$condition} ORDER BY createtime desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);

        $total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('vending_machine_order_comment') . " c  "
            . " left join " . tablename('vending_machine_goods') . " g on c.goodsid = g.id  "
            . " left join " . tablename('vending_machine_order') . " o on c.orderid = o.id  "
            . " WHERE 1 {$condition} ", $params);
        $pager = pagination2($total, $pindex, $psize);
        include $this->template();
    }

    function delete() {
        global $_W, $_GPC;


        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id FROM " . tablename('vending_machine_order_comment') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_update('vending_machine_order_comment', array('deleted' => 1), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
            $goods = pdo_fetch('select id,thumb,title from ' . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $item['goodsid'], ':uniacid' => $_W['uniacid']));
            plog('shop.comment.delete', "???????????? ID: {$id} ??????ID: {$goods['id']} ????????????: {$goods['title']}");
        }
        show_json(1, array('url' => referer()));
    }

    function add(){
        $this->virtual();
    }

    function edit(){
        $this->virtual();
    }

    protected function virtual() {

        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order_comment') . " WHERE id =:id and uniacid=:uniacid limit 1 ", array(':id' => $id, ':uniacid' => $_W['uniacid']));

        $goodsid = intval($_GPC['goodsid']);


        if ($_W['ispost']) {

            if (empty($goodsid)) {
                show_json(0, array('message' => '???????????????????????????'));
            }
            $goods = set_medias(pdo_fetch('select id,thumb,title from ' . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $goodsid, ':uniacid' => $_W['uniacid'])), 'thumb');
            if (empty($goods)) {
                show_json(0, array('message' => '???????????????????????????'));
            }

            $createtime = strtotime($_GPC['createtime']);
            if(empty($createtime) || $createtime>time()){
                $createtime = time();
            }

            $data = array(
                'uniacid' => $_W['uniacid'],
                'level' => intval($_GPC['level']),
                'goodsid' => intval($_GPC['goodsid']),
                'nickname' => trim($_GPC['nickname']),
                'headimgurl' => trim($_GPC['headimgurl']),
                'content' => $_GPC['content'],
                'images' => is_array($_GPC['images']) ? iserializer($_GPC['images']) : iserializer(array()),
                'reply_content' => $_GPC['reply_content'],
                'reply_images' => is_array($_GPC['reply_images']) ? iserializer($_GPC['reply_images']) : iserializer(array()),
                'append_content' => $_GPC['append_content'],
                'append_images' => is_array($_GPC['append_images']) ? iserializer($_GPC['append_images']) : iserializer(array()),
                'append_reply_content' => $_GPC['append_reply_content'],
                'append_reply_images' => is_array($_GPC['append_reply_images']) ? iserializer($_GPC['append_reply_images']) : iserializer(array()),
                'createtime' => $createtime
            );
            if (empty($data['nickname'])) {
                $data['nickname'] = pdo_fetchcolumn('select nickname from ' . tablename('mc_members') . " where nickname<>'' order by rand() limit 1");
            }
            if (empty($data['headimgurl'])) {
                $data['headimgurl'] = pdo_fetchcolumn('select avatar from ' . tablename('mc_members') . " where avatar<>'' order by rand() limit 1");
            }
            if (!empty($id)) {
                pdo_update('vending_machine_order_comment', $data, array('id' => $id));
                plog('shop.comment.edit', "???????????????????????? ID: {$id} ??????ID: {$goods['id']} ????????????: {$goods['title']}");
            } else {
                pdo_insert('vending_machine_order_comment', $data);
                $id = pdo_insertid();
                plog('shop.comment.add', "?????????????????? ID: {$id} ??????ID: {$goods['id']} ????????????: {$goods['title']}");
            }

            show_json(1, array('url' => webUrl('shop/comment')));
        }


        if (empty($goodsid)) {
            $goodsid = intval($item['goodsid']);
        }


        $goods = pdo_fetch('select id,thumb,title from ' . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $goodsid, ':uniacid' => $_W['uniacid']));

        include $this->template('shop/comment/virtual');
    }

    function post() {
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        $type = intval($_GPC['type']);

        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order_comment') . " WHERE id =:id and uniacid=:uniacid limit 1 ", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        $goods = pdo_fetch('select id,thumb,title from ' . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $item['goodsid'], ':uniacid' => $_W['uniacid']));
        $order = pdo_fetch('select id,ordersn from ' . tablename('vending_machine_order') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $item['orderid'], ':uniacid' => $_W['uniacid']));

        if ($_W['ispost']) {

            if($type == 0) {
                //??????
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'reply_content' => $_GPC['reply_content'],
                    'reply_images' => is_array($_GPC['reply_images']) ? iserializer(m('common')->array_images($_GPC['reply_images'])) : iserializer(array()),
                    'append_reply_content' => $_GPC['append_reply_content'],
                    'append_reply_images' => is_array($_GPC['append_reply_images']) ? iserializer($_GPC['append_reply_images']) : iserializer(array()),
                );
                pdo_update('vending_machine_order_comment', $data, array('id' => $id));
                plog('shop.comment.post', "?????????????????? ID: {$id} ??????ID: {$goods['id']} ????????????: {$goods['title']}");
            } else {
                //??????
                $checked = intval($_GPC['checked']);

                $change_data = array();
                $change_data['checked'] = $checked;

                if (!empty($item['append_content'])) {
                    $replychecked = intval($_GPC['replychecked']);
                    $change_data['replychecked'] = $replychecked;
                }
                $checked_array = array(0 => '????????????', 1 => '?????????', 2 => '???????????????');
                pdo_update('vending_machine_order_comment', $change_data, array('id' => $id));

                $log_msg = "??????????????????{$checked_array[$checked]}";
                if (!empty($item['append_content'])) {
                    $log_msg .= " ????????????{$checked_array[$checked]}";
                }
                $log_msg .= " ID: {$id} ??????ID: {$goods['id']} ????????????: {$goods['title']}";

                plog('shop.comment.post', $log_msg);
            }

            show_json(1, array('url' => webUrl('shop/comment')));
        }

        include $this->template();
    }

}
