<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_Page extends WebPage {

    function main() {

        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        $paras = array(':uniacid' => $_W['uniacid']);
        $condition = " uniacid = :uniacid";

        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .= " AND (storename LIKE '%{$_GPC['keyword']}%' OR address LIKE '%{$_GPC['keyword']}%' OR tel LIKE '%{$_GPC['keyword']}%')";
        }

        if (!empty($_GPC['type'])) {
            $type = intval($_GPC['type']);
            $condition .= " AND type = :type";
            $paras[':type'] = $type;
        }


        $sql = "SELECT * FROM " . tablename('vending_machine_store') . " WHERE $condition ORDER BY displayorder desc,id desc";
        $sql.=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;

        $sql_count = "SELECT count(1) FROM " . tablename('vending_machine_store') . " WHERE $condition";

        $total = pdo_fetchcolumn($sql_count, $paras);
        $pager = pagination2($total, $pindex, $psize);

        $list = pdo_fetchall($sql, $paras);

        foreach ($list as &$row) {
            $row['salercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('vending_machine_saler') . ' where storeid=:storeid limit 1', array(':storeid' => $row['id']));
        }
        unset($row);

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

//        print_r($_GPC);die();

        $id = intval($_GPC['id']);

        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);
        $address_street = intval($area_set['address_street']);

        if ($_W['ispost']) {

            if(!empty($_GPC['perms']))
            {
                $perms=implode(',',$_GPC['perms']);
            }else
            {
                $perms="";
            }



              if(empty($_GPC['logo'])){
                  show_json(0, "??????LOGO????????????");
              }

            if(empty($_GPC['map']['lng'])||empty($_GPC['map']['lat'])){
                show_json(0, "????????????????????????");
            }

            if(empty($_GPC['address'])){
                show_json(0, "????????????????????????");
            }else if (mb_strlen($_GPC['address'],'UTF-8')>30 ){
                show_json(0, "????????????????????????30?????????");
            }


            $label='';
            if(!empty($_GPC['lab']))
            {
                //?????????????????????????????????
                if( count($_GPC['lab'] )>8)
                {
                    show_json(0, "??????????????????8???");
                }

                foreach ($_GPC['lab']  as $lab){
                    if ( mb_strlen($lab,'UTF-8')>20){
                        show_json(0, "????????????????????????20?????????");
                    }
                    if(strlen(trim($lab))<=0){
                        show_json(0, "??????????????????");
                    }
                }
                //?????????????????????????????????
                $label=implode(',',$_GPC['lab']);
            }

            $tag='';
            if(!empty($_GPC['tag']))
            {
                if( count($_GPC['tag'] )>3){
                    show_json(0, "??????????????????3???");
                }

                //?????????????????????????????????
                foreach ($_GPC['tag']  as $tg){
                    if (mb_strlen($tg,'UTF-8')>3){
                        show_json(0, "????????????????????????3?????????");
                    }
                    if(strlen(trim($tg))<=0){
                        show_json(0, "??????????????????");
                    }
                }
                //?????????????????????????????????
                $tag=implode(',',$_GPC['tag']);
            }

            $cates='';
            if(!empty($_GPC['cates']))
            {
                if( count($_GPC['cates'] )>3){
                    show_json(0, "????????????????????????3???");
                }

                //?????????????????????????????????
                $cates=implode(',',$_GPC['cates']);
            }

            if(empty($_GPC['tel']) || strlen(trim($_GPC['tel']))<=0)
            {
                show_json(0, "????????????????????????");
            }else{

                if(strlen($_GPC['tel'])>20){
                    show_json(0, "????????????????????????20?????????");
                }
            }

            if(!empty($_GPC['saletime']))
            {
                if(strlen($_GPC['saletime'])>20){
                    show_json(0, "????????????????????????20?????????");
                }
            }


            $data = array(
                'uniacid' => $_W['uniacid'],
                'storename' => trim($_GPC['storename']),
                'address' => trim($_GPC['address']),
                'province' => trim($_GPC['province']),
                'city' => trim($_GPC['city']),
                'area' => trim($_GPC['area']),
                'provincecode' => trim($_GPC['chose_province_code']),
                'citycode' => trim($_GPC['chose_city_code']),
                'areacode' => trim($_GPC['chose_area_code']),
                'tel' => trim($_GPC['tel']),
                'lng' => $_GPC['map']['lng'],
                'lat' => $_GPC['map']['lat'],
                'type' => intval($_GPC['type']),
                'realname' => trim($_GPC['realname']),
                'mobile' => trim($_GPC['mobile']),
                'label' =>  $label,
                'tag' =>  $tag,
                'fetchtime' => trim($_GPC['fetchtime']),
                'saletime' => trim($_GPC['saletime']),
                'logo' => save_media($_GPC['logo']),
                'desc' => trim($_GPC['desc']),
                'opensend' => intval($_GPC['opensend']),
                'status'=>intval($_GPC['status']),
                'cates' =>  $cates,
                'perms' => $perms
            );


            if(P('newstore')) {
                $data['storegroupid']=intval($_GPC['storegroupid']);
            }
            $data['order_printer'] = is_array($_GPC['order_printer']) ? implode(',',$_GPC['order_printer']) : '';
            $data['order_template'] = intval($_GPC['order_template']);
            $data['ordertype'] = is_array($_GPC['ordertype']) ? implode(',',$_GPC['ordertype']) : '';
            if (!empty($id)) {
                pdo_update('vending_machine_store', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
                plog('shop.verify.store.edit', "???????????? ID: {$id}");
            } else {
                pdo_insert('vending_machine_store', $data);
                $id = pdo_insertid();
                plog('shop.verify.store.add', "???????????? ID: {$id}");
            }
            show_json(1, array('url' => webUrl('store')));
        }

        if(p('newstore'))
        {
            //????????????
            $storegroup=pdo_fetchall("SELECT * FROM " . tablename('vending_machine_newstore_storegroup') . " WHERE  uniacid=:uniacid  ", array(':uniacid' => $_W['uniacid']));

            //????????????
            $category = pdo_fetchall("SELECT *FROM ".tablename('vending_machine_newstore_category')." WHERE uniacid = :uniacid",array(':uniacid'=>$_W['uniacid']));
        }

        $item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_store') . " WHERE id =:id and uniacid=:uniacid limit 1", array(':uniacid' => $_W['uniacid'], ':id' => $id));

        $perms=explode(',',$item['perms']);

        if ($printer = com('printer')){
            $item = $printer->getStorePrinterSet($item);
            $order_printer_array = $item['order_printer'];
            $ordertype = $item['ordertype'];
            $order_template = pdo_fetchall('SELECT * FROM ' . tablename('vending_machine_member_printer_template') . ' WHERE uniacid=:uniacid AND merchid=0', array(':uniacid' => $_W['uniacid']));
        }
        $label=explode(',',$item['label']);
        $tag=explode(',',$item['tag']);
        $cates=explode(',',$item['cates']);



//        dump($category);die();

        include $this->template();
        
    }

    function delete() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,storename FROM " . tablename('vending_machine_store') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_delete('vending_machine_store', array('id' => $item['id']));
            plog('shop.verify.store.delete', "???????????? ID: {$item['id']} ????????????: {$item['storename']} ");
        }
        show_json(1, array('url' => referer()));
    }

	function displayorder() {

		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$displayorder = intval($_GPC['value']);
		$item = pdo_fetchall("SELECT id,storename FROM " . tablename('vending_machine_store') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);
		if (!empty($item)) {
			pdo_update('vending_machine_store', array('displayorder' => $displayorder), array('id' => $id));
			plog('shop.verify.store.edit', "?????????????????? ID: {$item['id']} ????????????: {$item['storename']} ??????: {$displayorder} ");
		}
 		show_json(1);
	}

    function status() {
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }
        $items = pdo_fetchall("SELECT id,storename FROM " . tablename('vending_machine_store') . " WHERE id in( $id ) AND uniacid=" . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_update('vending_machine_store', array('status' => intval($_GPC['status'])), array('id' => $item['id']));
            plog('shop.verify.store.edit', "??????????????????<br/>ID: {$item['id']}<br/>????????????: {$item['storename']}<br/>??????: " . $_GPC['status'] == 1 ? '??????' : '??????');
        }
        show_json(1, array('url' => referer()));
    }

    function query() {
        global $_W, $_GPC;
        $kwd = trim($_GPC['keyword']);
        $limittype = empty($_GPC['limittype'])?0:intval($_GPC['limittype']);
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $condition = " and uniacid=:uniacid  and status=1 ";
        if($limittype==0){
            $condition .= "  and type in (1,2,3) ";
        }

        if (!empty($kwd)) {
            $condition.=" AND `storename` LIKE :keyword";
            $params[':keyword'] = "%{$kwd}%";
        }
        $ds = pdo_fetchall('SELECT id,storename FROM ' . tablename('vending_machine_store') . " WHERE 1 {$condition} order by id asc", $params);

        if ($_GPC['suggest']) {
            die(json_encode(array('value' => $ds)));
        }

//        print_r($params);die();

        include $this->template('shop/verify/store/query');
        exit;
    }

    function querygoods(){
        global $_W, $_GPC;
        $kwd = trim($_GPC['keyword']);
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $condition=" and uniacid=:uniacid and deleted = 0 and `type` in (1,5,30)  and merchid =0";
        if (!empty($kwd)) {
            $condition.=" AND `title` LIKE :keyword";
            $params[':keyword'] = "%{$kwd}%";
        }
        $ds = pdo_fetchall('SELECT id,title,thumb FROM ' . tablename('vending_machine_goods') . " WHERE 1 {$condition} order by createtime desc", $params);

        $ds = set_medias($ds,array('thumb','share_icon'));
        if($_GPC['suggest']){
            die(json_encode(array('value'=>$ds)));
        }
        include $this->template();
    }

}
