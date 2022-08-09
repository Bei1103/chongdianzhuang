<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Verify_Page extends WebPage {


    function main() {

        global $_W, $_GPC;

        if ($_W['ispost']) {

            $verifytype = intval($_GPC['verifytype']);
            $verifycode = trim($_GPC['verifycode']);

            if($verifytype==2)
            {
                if (empty($verifycode)) {
                    show_json(0, '请填写核销码');
                }

                $verifygood = pdo_fetch('select *  from ' . tablename('vending_machine_verifygoods') . " where uniacid=:uniacid and  verifycode=:verifycode  limit 1 ", array(':uniacid' => $_W['uniacid'], ':verifycode' => $verifycode));
                if (empty($verifygood)) {
                    show_json(0, '未查询到记次时商品或核销码已过期,请核对核销码');
                }

                if(intval($verifygood['codeinvalidtime'])<time())
                {
                    show_json(0, '核销码已失效，请联系用户刷新页面获取最新核销码!');
                }

                show_json(1, array('url' => webUrl('store/verify/verifygoods',array("verifycode"=>$verifycode))));
            }

            show_json(0);
        }

        include $this->template();
    }

    function verifygoods() {
        global $_W, $_GPC;

        $verifycode = trim($_GPC['verifycode']);
        if (empty($verifycode)) {
            $this->message('未查询到记次时商品或核销码已失效,请核对核销码!', '', 'error');
        }

        $verifygood = pdo_fetch('select vg.*,g.id as goodsid ,g.title,g.subtitle,g.thumb  from ' . tablename('vending_machine_verifygoods') . '   vg
		 inner join ' . tablename('vending_machine_order_goods') . ' og on vg.ordergoodsid = og.id
		 inner join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		 where   vg.verifycode=:verifycode and vg.uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'],':verifycode' => $verifycode));


        if (empty($verifygood)) {
            $this->message('未查询到记次时商品或核销码已失效,请核对核销码!', '', 'error');
        }

        if(intval($verifygood['codeinvalidtime'])<time())
        {
            $this->message('核销码已失效，请联系用户刷新页面获取最新核销码!', '', 'error');
        }

        if(!empty($verifygood['limitnum']))
        {
            $verifygoodlogs = pdo_fetchall('select *  from ' . tablename('vending_machine_verifygoods_log') . '    where verifygoodsid =:id  ', array(':id' => $verifygood['id']));
            $verifynum = 0;
            foreach($verifygoodlogs as $verifygoodlog)
            {
                $verifynum +=intval($verifygoodlog['verifynum']);
            }

            $lastverifys = intval($verifygood['limitnum']) - $verifynum;
        }

        $termofvalidity = date('Y-m-d',  intval($verifygood['starttime']) +  $verifygood['limitdays']*86400  );

        if (!empty($verifygood['storeid'])) {
            $store = pdo_fetch('select * from ' . tablename('vending_machine_store') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $verifygood['storeid'], ':uniacid' => $_W['uniacid']));
        }




        include $this->template();
    }


    function log() {

        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        $condition = ' vg.uniacid = :uniacid';
        $params = array(':uniacid' => $_W['uniacid']);

        $searchfield = strtolower(trim($_GPC['searchfield']));
        $keyword = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($keyword)) {
            if ($searchfield == 'ordersn') {
                $condition.=' and o.ordersn like :keyword';
            } else if ($searchfield == 'verifyid') {
                $condition.=' and vg.id like :keyword';
            }else if ($searchfield == 'store') {
                $condition.=' and s.storename like :keyword';
            }else if ($searchfield == 'goodtitle') {
                $condition.=' and g.title like :keyword';
            }

            $params[':keyword'] = "%{$keyword}%";
        }

        if (!empty($_GPC['verifydate']['start']) && !empty($_GPC['verifydate']['end'])) {
            $verifystarttime = strtotime($_GPC['verifydate']['start']);
            $verifyendtime = strtotime($_GPC['verifydate']['end']);

            $condition .= " AND vgl.verifydate >= :verifystarttime AND vgl.verifydate <= :verifyendtime ";
            $params[':verifystarttime'] = $verifystarttime;
            $params[':verifyendtime'] = $verifyendtime;
        }

        if (!empty($_GPC['buydate']['start']) && !empty($_GPC['buydate']['end'])) {
            $buystarttime = strtotime($_GPC['buydate']['start']);
            $buyendtime = strtotime($_GPC['buydate']['end']);

            $condition .= " AND o.paytime >= :buystarttime AND o.paytime <= :buyendtime ";
            $params[':buystarttime'] = $buystarttime;
            $params[':buyendtime'] = $buyendtime;
        }

        $sql = 'select vg.*,g.id as goodsid ,g.title,g.verifytype,g.thumb,o.ordersn,vgl.verifydate,vgl.verifynum,vgl.verifygoodsid,o.paytime,s.storename,sa.salername,vgl.remarks,o.openid,o.carrier,o.price  from ' . tablename('vending_machine_verifygoods_log') . '   vgl
		 left join ' . tablename('vending_machine_verifygoods') . ' vg on vg.id = vgl.verifygoodsid
		 left join ' . tablename('vending_machine_store') . ' s  on s.id = vgl.storeid
		 left join ' . tablename('vending_machine_saler') . ' sa  on sa.id = vgl.salerid
		 left join ' . tablename('vending_machine_order_goods') . ' og on vg.ordergoodsid = og.id
		 left join ' . tablename('vending_machine_order') . ' o on o.id = og.orderid
		 left join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		 where  1 and  '.$condition.' ORDER BY vgl.verifydate DESC ';

        if (empty($_GPC['export'])) {
            $sql.=' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
        }

        $list = pdo_fetchall($sql, $params);


        foreach($list as &$rom)
        {
            $member = m("member")->getMember($rom['openid']);
            $carriers  = iunserializer($rom['carrier']);
            $sumsql = pdo_fetchcolumn(' SELECT SUM(verifynum) FROM ' . tablename('vending_machine_verifygoods_log').' WHERE verifygoodsid = '.$rom['verifygoodsid'].' AND uniacid = '.$_W['uniacid'].' AND verifydate <= '.$rom['verifydate']);
            $rom['sumverify'] = $rom['limitnum'] - $sumsql;
            if(is_array($carriers)){
                $rom['username'] =$carriers['carrier_realname'];
                $rom['mobile'] =$carriers['carrier_mobile'];
            }else{
                $rom['username'] =$member['username'];
                $rom['mobile'] =$member['mobile'];
            }
        }

        unset($rom);


        $total = pdo_fetchcolumn('select  COUNT(*)   from ' . tablename('vending_machine_verifygoods_log') . '   vgl
		 left join ' . tablename('vending_machine_verifygoods') . ' vg on vg.id = vgl.verifygoodsid
		 left join ' . tablename('vending_machine_store') . ' s  on s.id = vgl.storeid
		 left join ' . tablename('vending_machine_saler') . ' sa  on sa.id = vgl.salerid
		 left join ' . tablename('vending_machine_order_goods') . ' og on vg.ordergoodsid = og.id
		 left join ' . tablename('vending_machine_order') . ' o on o.id = og.orderid
		 left join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		  where  1 and  '.$condition.' ORDER BY vgl.verifydate DESC ', $params);
        $pager = pagination2($total, $pindex, $psize);


        //导出Excel
        set_time_limit(0);
        if ($_GPC['export'] == 1) {
            plog('groups.order.export', "导出订单");

            $columns = array(
                array('title' => '记次时商品信息', 'field' => 'title', 'width' => 34),
                array('title' => '订单号', 'field' => 'ordersn', 'width' => 32),
                array('title' => '订单金额', 'field' => 'price', 'width' => 32),
                array('title' => '总次数', 'field' => 'limitnum', 'width' => 32),
                array('title' => '核销次数', 'field' => 'verifynum', 'width' => 32),
                array('title' => '剩余次数', 'field' => 'sumverify', 'width' => 32),
                array('title' => '核销时间', 'field' => 'verifydate', 'width' => 22),
                array('title' => '购买时间', 'field' => 'paytime', 'width' =>20),
                array('title' => '购买人', 'field' => 'username', 'width' => 15),
                array('title' => '手机号', 'field' => 'mobile', 'width' => 15),
                array('title' => '核销人', 'field' => 'salername', 'width' => 12),
                array('title' => '核销门店', 'field' => 'storename', 'width' => 20),
                array('title' => '备注信息', 'field' => 'remarks', 'width' => 45)
            );
            $exportlist = array();

            foreach ($list as $key => $value) {
                $r =array();
                $r['title'] =$value['title'];
                $r['ordersn'] =$value['ordersn'];
                $r['verifynum'] =$value['verifynum'];
                
                $r['verifydate'] =date('Y-m-d H:i:s',$value['verifydate']);
                $r['paytime'] =date('Y-m-d H:i:s',$value['paytime']);
                $carriers  = iunserializer($value['carrier']);

                if(is_array($carriers)){
                    $r['username'] =$carriers['carrier_realname'];
                    $r['mobile'] =$carriers['carrier_mobile'];
                }else{
                    $r['username'] =$value['username'];
                    $r['mobile'] =$value['mobile'];
                }

                $r['salername'] =$value['salername'];
                $r['storename'] =$value['storename'];
                $r['remarks'] =$value['remarks'];
                $r['limitnum'] = $value['limitnum'];
                $r['price'] = $value['price'];
                $r['sumverify'] = $value['sumverify'];

                $exportlist[] = $r;
            }
            unset($r);
            m('excel')->export($exportlist, array(
                "title" => "核销订单-" . date('Y-m-d-H-i', time()),
                "columns" => $columns
            ));
        }


        include $this->template();
    }

}
