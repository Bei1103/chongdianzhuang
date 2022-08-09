<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Open_Page extends MobileLoginPage
{
    function main()
    {

        global $_W, $_GPC;

        if(is_alipay()||empty($_GPC['openid'])&&is_h5app()&&(!empty($_GPC['alipay_user_id'])||!empty($_GPC['user_id']))){
            $this->alipay();
            exit();
        }

        $payscore = p('payscore');
        //测试
        if($_GPC['ordersn']){
            $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE ordersn = :ordersn and uniacid = :uniacid", array(':ordersn' => $_GPC['ordersn'], ':uniacid' => $_W['uniacid']));
            if($order['merchid']>0){
                $merch_user=pdo_fetch("SELECT * FROM " . tablename('vending_machine_merch_user') . " WHERE id = :id and uniacid = :uniacid and status=1", array(':id' => $order['merchid'],':uniacid'=>$_W['uniacid']));
            }
            $res=$payscore->serviceorder_cancel(array('out_order_no'=>trim($order['ordersn']),'reason'=>'用户取消','sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));
            print_r($res);
            exit();
        }
        if($_GPC['query']){
            $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE ordersn = :ordersn and uniacid = :uniacid", array(':ordersn' => $_GPC['query'], ':uniacid' => $_W['uniacid']));
            if($order['merchid']>0){
                $merch_user=pdo_fetch("SELECT * FROM " . tablename('vending_machine_merch_user') . " WHERE id = :id and uniacid = :uniacid and status=1", array(':id' => $order['merchid'],':uniacid'=>$_W['uniacid']));
            }
            $res=$payscore->serviceorder_query(array('out_order_no'=>trim($order['ordersn']),'sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));
            print_r($res);
            exit();
        }
        if($_GPC['pay']){
            $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE ordersn = :ordersn and uniacid = :uniacid", array(':ordersn' => $_GPC['pay'], ':uniacid' => $_W['uniacid']));
            $order_goods = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_order_goods') . " WHERE uniacid = :uniacid and orderid=:orderid and totalprice>0", array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));
            $post_payments = array();
            foreach ($order_goods as $goods) {
                $goods['title'] = mb_substr($goods['id'] . '-' . $goods['title'], 0, 20,'utf-8');
                $description = '￥' . round($goods['price'], 2) . '/' . $goods['unit'];
                $count = $goods['total'];
                if ($goods['fee_type'] == 1) {//称重
                    $description .= '，重量：' . abs($goods['weight']) . '克';
                    $count = 1;
                }
                $post_payments[] = array('name' => $goods['title'], 'amount' => round($goods['totalprice'] * 100), 'description' => $description, 'count' => intval($count));
            }
            //完结并扣款支付分订单
            if($order['merchid']>0){
                $merch_user=pdo_fetch("SELECT * FROM " . tablename('vending_machine_merch_user') . " WHERE id = :id and uniacid = :uniacid and status=1", array(':id' =>$order['merchid'],':uniacid'=>$_W['uniacid']));
            }
            print_r(array('out_order_no' => $order['ordersn'], 'post_payments' => $post_payments, 'total_amount' => round($order['price'] * 100),'sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));

            $res = p('payscore')->serviceorder_complete(array('out_order_no' => $order['ordersn'], 'post_payments' => $post_payments, 'total_amount' => round($order['price'] * 100),'sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));
            print_r($res);
            exit();
        }
        if($_GPC['old']){
            $orderinfo=$payscore->smartretail_orders_query(array('out_order_no'=>$_GPC['old']));
            $has_payscore = $payscore->smartretail_orders_complete(array('out_order_no'=>$_GPC['old'],'finish_type'=>1,'total_amount'=>0,'finish_ticket'=>$orderinfo['finish_ticket'],'cancel_reason'=>'用户取消订单'));
            print_r($has_payscore);
            exit();
        }
        //测试end

        //检查锁状态
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $this->message('参数错误!',"javascript:core.scan();",'error');
        }

        $lock = pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if(empty($lock)){
            show_json(0,'门锁不存在!',"javascript:core.scan();",'error');
        }
        if($lock['disabled']==1){
            $this->message('设备已禁用!',"javascript:core.scan();",'error');
        }

        if ($lock['action'] == 2&&$lock['status_l'] == 1) {
            $this->message('设备补货中!',"javascript:core.scan();",'error');
        } elseif ($lock['action'] == 1&&$lock['status_l'] == 1) {
            $this->message('设备占用中!',"javascript:core.scan();",'error');
        }

        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['device_id'],':uniacid'=>$_W['uniacid']));
        if(empty($device)){
            $this->message('设备不存在!',"javascript:core.scan();",'error');
        }

        if($device['online']!=1){
            $this->message('设备已离线!',"javascript:core.scan();",'error');
        }


        if($device['merchid']>0){
            $merch_user=pdo_fetch("SELECT * FROM " . tablename('vending_machine_merch_user') . " WHERE id = :id and uniacid = :uniacid and status=1", array(':id' => $device['merchid'],':uniacid'=>$_W['uniacid']));
        }

        //检查支付分授权
        $is_app=false;
        if(!empty(trim($_GPC['openid']))&&is_h5app()){
            $is_app=true;
            if(intval($_GPC['type'])==1){
                $has_payscore=$payscore->check_permissions(array('openid'=>trim($_GPC['openid']),'sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']),$is_app);
                if (!$has_payscore){
                    $this->message('支付分未授权!',"",'error');
                }
            }
        }else {
            $has_payscore = $payscore->check_permissions(array('sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));
        }

        if (!$has_payscore) {//未授权
            //list(, $payment) = m('common')->public_build();
            $res= $payscore->permissions(array('sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']));
            if(is_error($res)||empty($res['apply_permissions_token'])){
                $this->message('获取预授权token失败 '.$res['message'],"javascript:core.scan();",'error');
            }
            $apply_permissions_token=$res['apply_permissions_token'];
        } else {//已授权

            if (!empty($lock['orderid'])) {
                $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['orderid'], ':uniacid' => $_W['uniacid']));
                if(!empty($order)&&$order['status'] == 0){//需要判断的只有进行中的订单
                    if($order['openid'] == $_W['openid']){//是当前用户
                        if($lock['status_l'] == 1&&!empty($order['payscore_order_id'])){//已开锁
                            $_SESSION['lock_id']=$lock['id'];
                            header("Location: " . mobileUrl('member/cart'));
                            return;
                        }
                        if($lock['status_l'] == 0&&!empty($order['payscore_order_id'])){//未开锁
                            include $this->template();
                            exit();
                        }
                    }else{//非当前用户，订单未结束
                        $this->message('设备占用中!',"javascript:core.scan();",'error');
                    }
                }
            }


            $ordersn = m('common')->createNO('order', 'ordersn', 'SH');

            //创建支付分订单
            $send_data=array('out_order_no'=>$ordersn,'time_range'=>array('start_time'=>date('YmdHis',time()+5),'end_time'=>date('YmdHis',time()+60*30)),'risk_fund'=>array('name'=>'ESTIMATE_ORDER_COST','amount'=>20000),'location'=>array('start_location'=>$device['name'].'-'.$lock['name']),'service_introduction'=>!empty($_W['shopset']['shop']['name'])?$_W['shopset']['shop']['name']:'自动售货机','need_user_confirm'=>false,'openid'=>$_W['openid'],'attach'=>"{$_W['uniacid']}",'sub_mchid'=>$merch_user['sub_mchid'],'service_id'=>$merch_user['service_id']);
            $res=$payscore->serviceorder($send_data,$is_app);
            if(is_error($res)||empty($res['order_id'])){
                $this->message('创建支付分订单错误!'.$res['message'],"javascript:core.scan();",'error');
            }
            //创建订单
            pdo_insert('vending_machine_order',array('ordersn'=>$ordersn,'openid'=>$_W['openid'],'createtime'=>time(),'device_id'=>$device['id'],'uniacid'=>$_W['uniacid'],'paytype'=>21,'payscore_order_id'=>strval($res['order_id']),'merchid'=>intval($device['merchid']),'ismerch'=>$device['merchid']>0?1:0,'apppay'=>$is_app?1:0));
            $orderid=pdo_insertid();
            if(!$orderid){
                $this->message('创建订单失败!',"javascript:core.scan();",'error');
            }
            pdo_update('vending_machine_device_lock',array('orderid'=>$orderid,'action'=>1),array('id'=>$lock['id']));
            //pdo_update('vending_machine_order',array('payscore_order_id'=>$res,'action'=>1),array('id'=>$orderid));
            $_SESSION['lock_id']=$lock['id'];
            //开锁
            //$res=com('websocket')->app_send(array('action'=>'set_remote_lock','imei'=>$device['imei'],'senid'=>$lock['senid'],'status'=>1));
            /*if(is_error($res)){
                $this->message($res['message']);
            }*/
            //header("Location: " . mobileUrl('member/cart'));
            //return;
        }

        include $this->template();
    }

    function alipay()
    {

        global $_W, $_GPC;

        //签约回调
        if(!empty($_GPC['alipay_user_id'])&&!empty($_GPC['agreement_no'])&&!empty($_GPC['external_logon_id'])&&$_GPC['status']=='NORMAL'){
            pdo_update('vending_machine_member',array('agreement_no'=>$_GPC['agreement_no']),array('alipay_user_id'=>$_GPC['alipay_user_id'],'id'=>$_GPC['external_logon_id']));
        }

        //检查锁状态
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $this->message('参数错误!',"javascript:core.scan();",'error');
        }

        $lock = pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if(empty($lock)){
            $this->message('门锁不存在!',"javascript:core.scan();",'error');
        }
        if($lock['disabled']==1){
            $this->message('设备已禁用!',"javascript:core.scan();",'error');
        }

        if ($lock['action'] == 2&&$lock['status_l'] == 1) {
            $this->message('设备补货中!',"javascript:core.scan();",'error');
        } elseif ($lock['action'] == 1&&$lock['status_l'] == 1) {
            $this->message('设备占用中!',"javascript:core.scan();",'error');
        }

        $device= pdo_fetch("SELECT * FROM " . tablename('vending_machine_device') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['device_id'],':uniacid'=>$_W['uniacid']));
        if(empty($device)){
            $this->message('设备不存在!',"javascript:core.scan();",'error');
        }

        if($device['online']!=1){
            $this->message('设备已离线!',"javascript:core.scan();",'error');
        }


        if($device['merchid']>0){
            $merch_user=pdo_fetch("SELECT * FROM " . tablename('vending_machine_merch_user') . " WHERE id = :id and uniacid = :uniacid and status=1", array(':id' => $device['merchid'],':uniacid'=>$_W['uniacid']));
        }

        //检查支付宝授权
        $alipayclient=p('alipay');
        $member=m('member')->getMember($_W['openid']);

        if($_GPC['unsign']){//手动解约
            $res=$alipayclient->unsign(array('alipay_user_id'=>$member['alipay_user_id'],'agreement_no'=>$member['agreement_no']));
            var_dump($res);
            exit();
        }

        //测试支付
        /*if($_GPC['ordersn']){
            $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE ordersn = :ordersn and uniacid = :uniacid", array(':ordersn' =>$_GPC['ordersn'], ':uniacid' =>$_W['uniacid']));
            $order_goods = pdo_fetchall("SELECT * FROM " . tablename('vending_machine_order_goods') . " WHERE uniacid = :uniacid and orderid=:orderid and totalprice>0", array(':orderid' => $order['id'], ':uniacid' =>$_W['uniacid']));
            //print_r($order_goods);
            $goods_detail=array();
            foreach ($order_goods as $goods) {
                $goods['title'] = mb_substr($goods['id'] . '-' . $goods['title'], 0, 256, 'utf-8');
                $description = '￥' . round($goods['price'], 2) . '/' . $goods['unit'];
                $count = $goods['total'];
                if ($goods['fee_type'] == 1) {//称重
                    $description .= '，重量：' . abs($goods['weight']) . '克';
                    $count = 1;
                }
                $goods_detail[] = array('goods_id' => $goods['goodsid'],'goods_name' => $goods['title'],'quantity' => $count,'price' => round($goods['price'], 2),'body' => $description);
            }
            $alipayclient = p('alipay');
            $res=$alipayclient->pay(array(
                'subject' => '充电桩:'.$device['name'],
                'out_trade_no' => $order['ordersn'],
                'total_amount' => round($order['price'],2),
                'buyer_id' => $member['alipay_user_id'],
                'goods_detail' =>$goods_detail,
                'agreement_no' =>$member['agreement_no'],
            ));
            print_r($res);
            exit();
        }*/

        $is_app=false;
        $has_sign=false;

            if(!empty($member['agreement_no'])&&!empty($member['alipay_user_id'])) {
                $has_sign = $alipayclient->check_sign(array('alipay_user_id'=>$member['alipay_user_id'],'agreement_no'=>$member['agreement_no']));
                if(!$has_sign){//解约
                    $alipayclient->unsign(array('alipay_user_id'=>$member['alipay_user_id'],'agreement_no'=>$member['agreement_no']));
                }
            }


        //print_r($_GPC);
        if (!$has_sign) {//未授权
            $return_url = mobileUrl('machine/open',array('id'=>$_GPC['id']),true);

            $res=$alipayclient->sign(array('out_device_id'=>$device['imei'],'return_url'=>$return_url,'external_logon_id'=>$member['id']));
            if(is_error($res)||empty($res)){
                $this->message('构造签约参数失败',"javascript:core.scan();",'error');
            }
            echo '<!doctype html><html><head><meta charset="utf-8"></head><body><div style="display: none">'.$res.'</div></div></body></html>';
            exit();
        } else {//已授权

            if (!empty($lock['orderid'])) {
                $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['orderid'], ':uniacid' => $_W['uniacid']));
                if(!empty($order)&&$order['status'] == 0){//需要判断的只有进行中的订单
                    if($order['openid'] == $_W['openid']){//是当前用户
                        if($lock['status_l'] == 1&&!empty($order['payscore_order_id'])){//已开锁
                            $_SESSION['lock_id']=$lock['id'];
                            header("Location: " . mobileUrl('member/cart'));
                            return;
                        }
                        if($lock['status_l'] == 0&&!empty($order['payscore_order_id'])){//未开锁
                            include $this->template();
                            exit();
                        }
                    }else{//非当前用户，订单未结束
                        $this->message('设备占用中!',"javascript:core.scan();",'error');
                    }
                }
            }


            $ordersn = m('common')->createNO('order', 'ordersn', 'SH');

            //创建支付宝订单
            /*$send_data=array('out_trade_no'=>$ordersn,'subject'=>'充电桩:'.$device['name'],'total_amount'=>0.01,'buyer_id'=>$member['alipay_user_id']);
            $res=$alipayclient->create($send_data);
            if(is_error($res)||empty($res['order_id'])){
                $this->message('创建支付分订单错误!'.$res['message'],"javascript:core.scan();",'error');
            }
            exit();*/
            //创建订单
            pdo_insert('vending_machine_order',array('ordersn'=>$ordersn,'openid'=>$_W['openid'],'createtime'=>time(),'device_id'=>$device['id'],'uniacid'=>$_W['uniacid'],'paytype'=>22,'agreement_no'=>strval($member['agreement_no']),'merchid'=>intval($device['merchid']),'ismerch'=>$device['merchid']>0?1:0,'apppay'=>$is_app?1:0));
            $orderid=pdo_insertid();
            if(!$orderid){
                $this->message('创建订单失败!',"javascript:core.scan();",'error');
            }
            pdo_update('vending_machine_device_lock',array('orderid'=>$orderid,'action'=>1),array('id'=>$lock['id']));
            //pdo_update('vending_machine_order',array('payscore_order_id'=>$res,'action'=>1),array('id'=>$orderid));
            $_SESSION['lock_id']=$lock['id'];
            //开锁
            //$res=com('websocket')->app_send(array('action'=>'set_remote_lock','imei'=>$device['imei'],'senid'=>$lock['senid'],'status'=>1));
            /*if(is_error($res)){
                $this->message($res['message']);
            }*/
            //header("Location: " . mobileUrl('member/cart'));
            //return;
        }

        include $this->template();
    }
}