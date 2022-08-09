<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Selecturl_Page extends WebPage {

    function main() {
        global $_W, $_GPC;

        $full = intval($_GPC['full']);
        $storeid = intval($_W['storeid']);

        $syscate = m('common')->getSysset('category');
        if($syscate['level']>0){
            $categorys = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_category') . " WHERE uniacid=:uniacid  ORDER BY parentid ASC, displayorder DESC", array(':uniacid'=>$_W['uniacid']));
        }

        // 获取商品组列表
        $goodsgroup = pdo_fetchall('SELECT * FROM '. tablename('vending_machine_newstore_goodsgroup'). ' WHERE uniacid=:uniacid', array(':uniacid'=>$_W['uniacid']));

        $diypage = p('diypage')->getPageList('allpage');

//        dump($diypage);die();



        include $this->template();
    }

    function query(){
        global $_W, $_GPC;

        $type = trim($_GPC['type']);
        $kw = trim($_GPC['kw']);
        $full = intval($_GPC['full']);

        if(!empty($kw) && !empty($type)){

            if($type=='good'){
                $list = pdo_fetchall("SELECT id,title,productprice,marketprice,thumb,sales,unit,minprice FROM " . tablename('vending_machine_goods') . " WHERE merchid=:merchid and uniacid= :uniacid and status=:status and deleted=0 AND title LIKE :title ", array(':title' => "%{$kw}%", ':merchid'=>intval($_W['merchid']),':uniacid' => $_W['uniacid'], ':status' => '1'));
                $list = set_medias($list, 'thumb');
            }
            elseif($type=='coupon'){
                $list = pdo_fetchall("select id,couponname,coupontype from " . tablename('vending_machine_coupon') . ' where couponname LIKE :title and uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':title' => "%{$kw}%"));
            }

        }

        include $this->template('store/diypage/selecturl_tpl');
    }

}
