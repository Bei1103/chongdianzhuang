<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Sendtask_Page extends ComWebPage {

    public function __construct($_com = 'coupon')
    {
        parent::__construct($_com);
    }

    function main() {
        global $_W, $_GPC;
        $uniacid = intval($_W['uniacid']);

        $data = m('common')->getPluginset('coupon');

        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;
        $condition = " and cs.uniacid=:uniacid";
        $params = array(':uniacid' => $uniacid);

        $sendtasks = pdo_fetchall("SELECT cs.*, c.couponname, c.thumb FROM ".tablename('vending_machine_coupon_sendtasks')."  cs left  join  ".tablename('vending_machine_coupon') ."  c on cs.couponid =c.id
                    WHERE 1 ".$condition."  order by enough LIMIT ". ($pindex - 1) * $psize . ',' . $psize,$params);

        $total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('vending_machine_coupon_sendtasks') . " cs WHERE 1 ".$condition." ", $params);
        $pager = pagination2($total, $pindex, $psize);

		include $this->template();
    }



    function opentask() {

        $data = m('common')->getPluginset('coupon');
        $data['isopensendtask']=1;
        m('common')->updatePluginset(array('coupon'=>$data));

        header('location: ' . webUrl('sale.coupon.sendtask'));
    }

    function closetask() {


        $data = m('common')->getPluginset('coupon');
        $data['isopensendtask']=0;
        m('common')->updatePluginset(array('coupon'=>$data));

        header('location: ' . webUrl('sale.coupon.sendtask'));
    }


    function add() {
        $this->post();
    }

    function edit() {
        $this->post();
    }

    protected function post() {
        global $_W, $_GPC;
        $uniacid = intval($_W['uniacid']);
        $id = intval($_GPC['id']);

        if (!empty($id)) {
            $item = pdo_fetch("SELECT *  FROM " . tablename('vending_machine_coupon_sendtasks') . " WHERE uniacid = " . $uniacid . " and id =" . $id);
            $item = set_medias($item, array('thumb'));
            if(!empty($item['couponid']))
            {
                $coupon = pdo_fetch("SELECT id,couponname as title , thumb  FROM ".tablename('vending_machine_coupon')." WHERE uniacid = ".$uniacid." and id =".$item['couponid']);
            }
        }


        if ($_W['ispost']){

            if(intval($_GPC['sendnum'])<1)
            {
                show_json(0,'????????????????????????1');
            }
            if(intval($_GPC['sendnum'])>50)
            {
                show_json(0,'????????????????????????50');
            }

            if(intval($_GPC['num'])<0)
            {
                show_json(0,'????????????????????????0');
            }

            if(intval($_GPC['sendpoint'])==0)
            {
                show_json(0,'?????????????????????');
            }

            $data = array(
                'uniacid' => $uniacid,
                'enough' => floatval($_GPC['enough']),
                'couponid' => intval($_GPC['couponid']),
                'starttime' => strtotime($_GPC['sendtime']['start']),
                'endtime' => strtotime($_GPC['sendtime']['end'])+86399,
                'sendnum' => intval($_GPC['sendnum']),
                'num' => intval($_GPC['num']),
                'sendpoint' => intval($_GPC['sendpoint']),
                'status' => intval($_GPC['status'])
            );

            if (!empty($id)) {
                pdo_update('vending_machine_coupon_sendtasks', $data, array('id' => $id));
                plog('coupon.sendtask.edit', "??????????????????????????? ID: {$id}");
            } else {
                pdo_insert('vending_machine_coupon_sendtasks', $data);
                $id = pdo_insertid();
                plog('coupon.sendtask.add', "??????????????????????????? ID: {$id}");
            }

            show_json(1, array("url" => webUrl('sale.coupon.sendtask')));
        }

        if(empty($item['starttime'])){
            $item['starttime'] = time();
        }

        if(empty($item['endtime'])){
            $item['endtime'] = time()+60*60*24*7;
        }

        include $this->template();
    }


    function delete(){
        global $_W, $_GPC;

        $id = intval($_GPC['id']);

        $item = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_coupon_sendtasks') . " WHERE id  = :id  and uniacid=:uniacid ", array(":id"=>$id ,":uniacid"=>$_W['uniacid']));

        if(!empty($item)){
            pdo_delete('vending_machine_coupon_sendtasks', array('id' => $id, 'uniacid'=>$_W['uniacid']));
        }

        show_json(1);
    }


}
