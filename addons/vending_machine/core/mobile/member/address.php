<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Address_Page extends MobileLoginPage {

    function main() {
        global $_W, $_GPC, $_S;

        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);
        $address_street = intval($area_set['address_street']);

        $pindex = intval($_GPC['page']);
        $psize = 20;

        $condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
        $params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']);
        $sql = 'SELECT COUNT(*) FROM ' . tablename('vending_machine_member_address') . " where 1 $condition";
        $total = pdo_fetchcolumn($sql, $params);
        $sql = 'SELECT * FROM ' . tablename('vending_machine_member_address') . ' where 1 ' . $condition . ' ORDER BY `id` DESC';

        if ($pindex != 0) {
            $sql .= 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
        }

        $list = pdo_fetchall($sql, $params);
        include $this->template();
    }

    function post() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);

        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);
        $address_street = intval($area_set['address_street']);

        $is_from_wx = $_GPC['is_from_wx'];
        if($is_from_wx){
            $wx_province = $_GPC['province'];
            $wx_city = $_GPC['city'];
            $wx_area = $_GPC['area'];
            $wx_address = $_GPC['address'];
            $wx_name = $_GPC['realname'];
            $wx_mobile = $_GPC['mobile'];
            $wx_address_info = array(
                'province'  => $wx_province,
                'city'  => $wx_city,
                'area'  => $wx_area,
                'address'  => $wx_address,
                'realname'  => $wx_name,
                'mobile'  => $wx_mobile,
            );
        }

        if(!empty($id) || !empty($wx_address_info)){
            if(empty($wx_address_info)){
                $address = pdo_fetch('select * from ' . tablename('vending_machine_member_address') . ' where id=:id and openid=:openid and uniacid=:uniacid limit 1 ', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
            }else{
                $address = $wx_address_info;
            }

            //????????????code???????????????
            if(empty($address['datavalue'])){
                //???????????????????????????code
                $provinceName=$address['province'];
                $citysName=$address['city'];
                $countyName=$address['area'];

                //??????code
                $province_code=0;
                $citys_code=0;
                $county_code=0;

                $path = VENDING_MACHINE_PATH."static/js/dist/area/AreaNew.xml";
                $xml = file_get_contents($path);
                $array = xml2array($xml);

                $newArr = array();
                if(is_array($array['province']))
                {
                    foreach ($array['province'] as $i=>$v)
                    {
                        if($i>0)
                        {
                            if($v['@attributes']['name']==$provinceName && !is_null($provinceName) && $provinceName!="")
                            {
                                $province_code = $v['@attributes']['code'];
                                if(is_array($v['city']))
                                {
                                    if(!isset($v['city'][0])){
                                        $v['city'] = array(0=>$v['city']);
                                    }
                                    foreach ($v['city'] as $ii=>$vv)
                                    {
                                        if($vv['@attributes']['name']==$citysName && !is_null($citysName) && $citysName!="")
                                        {
                                            $citys_code= $vv['@attributes']['code'];
                                            if(is_array($vv['county']))
                                            {
                                                if(!isset($vv['county'][0]))
                                                {
                                                    $vv['county'] = array(0=>$vv['county']);
                                                }
                                                foreach ($vv['county'] as $iii=>$vvv)
                                                {
                                                    if($vvv['@attributes']['name']==$countyName && !is_null($countyName) && $countyName!="")
                                                    {
                                                        $county_code= $vvv['@attributes']['code'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if($province_code!=0 &&$citys_code!=0&&$county_code!=0){
                    $address['datavalue']=$province_code." ".$citys_code." ".$county_code;
                    if(empty($wx_address_info)){
                        pdo_update('vending_machine_member_address', $address, array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
                    }
                }
            }

            //        $address_street = 1;
            //        $new_area = 0;

            $show_data = 1;
            if((!empty($new_area) && empty($address['datavalue'])) || (empty($new_area) && !empty($address['datavalue']))) {
                $show_data = 0;
            }
        }
        include $this->template();
    }

    function setdefault() {

        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $data = pdo_fetch('select id from ' . tablename('vending_machine_member_address') . ' where id=:id and deleted=0 and uniacid=:uniacid limit 1', array(
            ':uniacid' => $_W['uniacid'],
            ':id' => $id
        ));
        if (empty($data)) {
            show_json(0, '???????????????');
        }
        pdo_update('vending_machine_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
        pdo_update('vending_machine_member_address', array('isdefault' => 1), array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
        show_json(1);
    }

    /**
     * ???????????????????????????,??????????????????
     *
     * @author ????????? <yanchengtian0536@163.com>
     * @date 2018/8/8
     * @param $string mobile ??????unicode?????????????????????
     * @return string
     */
    private function extractNumber($string)
    {
        $string = preg_replace('# #', '', $string);
        preg_match('/\d{11}/', $string, $result);
        return (string)$result[0];
    }

    function submit() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $data = $_GPC['addressdata'];
        $data['mobile'] = $this->extractNumber($data['mobile']); //???????????????????????????
        $areas = explode(' ', $data['areas']);
        $data['province'] = $areas[0];
        $data['city'] = $areas[1];
        $data['area'] = $areas[2];

        $data['street'] = trim($data['street']);
        $data['datavalue'] = trim($data['datavalue']);
        $data['streetdatavalue'] = trim($data['streetdatavalue']);

        $post = $data;
        $post['id'] = $id;
        $post['is_from_wx'] = $_GPC['is_from_wx'];
        if($this->is_repeated_address($post)){
            return show_json(0, '????????????????????????');
        }
        if(empty($data['mobile'])){
            return show_json(0, '??????????????????');
        }

        $area_set = m('util')->get_area_config_set();
        if($area_set['new_area'] && $area_set['address_street'] && empty($data['street'])){
            return show_json(0, '?????????????????????');
        }
        // ????????????
        $isdefault = intval($data['isdefault']);
        unset($data['isdefault']);

        unset($data['areas']);
        $data['openid'] = $_W['openid'];
        $data['uniacid'] = $_W['uniacid'];
        if (empty($id)) {
            $addresscount = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('vending_machine_member_address') . ' where openid=:openid and deleted=0 and `uniacid` = :uniacid ', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
            if ($addresscount <= 0) {
                $data['isdefault'] = 1;
            }
            pdo_insert('vending_machine_member_address', $data);
            $id = pdo_insertid();
        } else {
            //??????????????????????????????-???????????????
            $data['lng']='';
            $data['lat']='';
            pdo_update('vending_machine_member_address', $data, array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
        }

        // ??????????????????
        if(!empty($isdefault)){
            pdo_update('vending_machine_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
            pdo_update('vending_machine_member_address', array('isdefault' => 1), array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
        }

        show_json(1, array('addressid' => $id));
    }

    function delete() {
        global $_W, $_GPC;

        $id = intval($_GPC['id']);
        $data = pdo_fetch('select id,isdefault from ' . tablename('vending_machine_member_address') . ' where  id=:id and openid=:openid and deleted=0 and uniacid=:uniacid  limit 1', array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $_W['openid'],
            ':id' => $id
        ));
        if (empty($data)) {
            show_json(0, '???????????????');
        }
        pdo_update('vending_machine_member_address', array('deleted' => 1), array('id' => $id));

        //????????????????????????
        if ($data['isdefault'] == 1) {
            //??????????????????????????????????????????
            pdo_update('vending_machine_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'id' => $id));
            $data2 = pdo_fetch('select id from ' . tablename('vending_machine_member_address') . ' where openid=:openid and deleted=0 and uniacid=:uniacid order by id desc limit 1', array(
                ':uniacid' => $_W['uniacid'],
                ':openid' => $_W['openid']
            ));
            if (!empty($data2)) {
                pdo_update('vending_machine_member_address', array('isdefault' => 1), array('uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'id' => $data2['id']));
                show_json(1, array('defaultid' => $data2['id']));
            }
        }
        show_json(1);
    }

    function selector() {
        global $_W, $_GPC;
        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);
        $address_street = intval($area_set['address_street']);

        $condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
        $params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']);

        $sql = 'SELECT * FROM ' . tablename('vending_machine_member_address') . ' where 1 ' . $condition . ' ORDER BY isdefault desc, id DESC ';
        $list = pdo_fetchall($sql, $params);
        include $this->template();
        exit;
    }


    function getselector() {
        global $_W, $_GPC;

        $condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
        $params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']);

        $keywords = $_GPC['keywords'];
        if (!empty($keywords)) {
            $condition .= ' AND (`realname` LIKE :keywords OR `mobile` LIKE :keywords OR `province` LIKE :keywords OR `city` LIKE :keywords OR `area` LIKE :keywords OR `address` LIKE :keywords OR `street` LIKE :keywords)';
            $params[':keywords'] = '%' . trim($keywords) . '%';
        }

        $sql = 'SELECT *  FROM ' . tablename('vending_machine_member_address') . ' where 1 ' . $condition . ' ORDER BY isdefault desc, id DESC ';
        $list = pdo_fetchall($sql, $params);

        foreach($list as &$item)
        {
            $item['editurl']=mobileUrl('member/address/post',array('id'=>$item['id']));

        }

        unset($item);


        if(count($list)>0)
        {
            show_json(1,array("list"=>$list));
        }else
        {
            show_json(0);
        }
    }

    /**
     * ??????????????????????????????
     * @param $post
     * author ??????
     * @return bool
     */
    private function is_repeated_address($post){
        global $_W;
        if(empty($post['is_from_wx']) || $post['id']){
            return false;
        }
        if(empty($post['province']) || empty($post['city']) || empty($post['area'])){
            return false;
        }
        $condition = 'uniacid=:uniacid and openid=:openid and realname=:realname and mobile=:mobile and mobile=:mobile and province=:province and city=:city and area=:area and address=:address and deleted=0';
        $params = [
            ':uniacid' => $_W['uniacid'],
            ':openid' => $_W['openid'],
            ':realname' => $post['realname'],
            ':mobile' => $post['mobile'],
            ':province' => $post['province'],
            ':city' => $post['city'],
            ':area' => $post['area'],
            ':address' => $post['address'],
        ];
        $address = pdo_fetch("SELECT id FROM " . tablename('vending_machine_member_address') . " where {$condition} limit 1",$params);
        if($address){
            return true;
        }
        return false;
    }
}
