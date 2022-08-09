<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Cart_Page extends MobileLoginPage
{
    function main()
    {
        global $_W, $_GPC;
        //$open_redis = function_exists('redis') && !is_error(redis());
        //判断锁id
        $lock_id=intval($_SESSION['lock_id']);
        if(empty($lock_id)){
            $this->message('请先扫码开锁，再进行购物',mobileUrl(''),'error');
        }
        $lock = pdo_fetch("SELECT * FROM " . tablename('vending_machine_device_lock') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock_id, ':uniacid' => $_W['uniacid']));
        if(empty($lock['orderid'])){// 无绑定订单
            $this->message('请先扫码开锁，再进行购物',mobileUrl(''),'error');
        }
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid", array(':id' => $lock['orderid'], ':uniacid' => $_W['uniacid']));
        if($order['openid']==$_W['openid']&&$order['status']==0&&(!empty($order['payscore_order_id'])||!empty($order['agreement_no']))&&$lock['status_l']!=1){//已绑订单 未开锁
            header("Location: ".mobileUrl('machine/open',array('id'=>$lock['id'])));
            exit();
        }

        if($order['openid']!=$_W['openid']||$order['status']!=0||empty($order['payscore_order_id'])&&empty($order['agreement_no'])){//非本用户订单 订单非正常 未绑定支付分或支付宝
            $this->message('请先扫码开锁，再进行购物',mobileUrl(''),'error');
        }
        if($lock['status_l']!=1){//未开锁 无绑定订单
            $this->message('请先扫码开锁，再进行购物',mobileUrl(''),'error');
        }
        $order_goods = pdo_fetchall("select og.*,g.isdiscount,g.isdiscount_time,g.isdiscount_time_start,g.isdiscount_discounts,g.thumb,g.merchsale,g.buyagain,g.buyagain_islong,g.buyagain_condition, g.buyagain_sale,g.isnodiscount,g.discounts,g.deduct,g.manydeduct,g.deduct2,g.manydeduct2,g.cates from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where og.orderid=:orderid and og.uniacid=:uniacid and og.totalprice>0", array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));

        /*$order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid", array(':id' =>2, ':uniacid' => $_W['uniacid']));

        $order_goods = pdo_fetchall("select og.*,g.isdiscount,g.isdiscount_time,g.isdiscount_time_start,g.isdiscount_discounts,g.thumb,g.merchsale,g.buyagain,g.buyagain_islong,g.buyagain_condition, g.buyagain_sale,g.isnodiscount,g.discounts,g.deduct,g.manydeduct,g.deduct2,g.manydeduct2,g.cates from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));*/

        $merch_array=[];
        foreach ($order_goods as &$g){
            //$totalprice+=round($g['totalprice'],2);
            //是否有促销
            if ($g['isdiscount'] == 1 && $g['isdiscount_time']>= time()&& $g['isdiscount_time_start'] <= time()) {

            }else{
                $g['isdiscount'] =0;
            }

            //多商户商品
            if ($g['merchid'] > 0) {
                $merchid = $g['merchid'];
                $merch_array[$merchid]['goods'][] = $g['goodsid'];
            }
        }
        unset($g);

        //可用优惠券(减掉秒杀的商品及总价)
        $couponcount = com_run('coupon::consumeCouponCount', $_W['openid'], $order['goodsprice'], $merch_array, $order_goods);
        //可用优惠券列表
        //$couponlist = com_run('coupon::getAvailableCoupons',0, $realprice, $merch_array, $order_goods);
        if($order['couponid']>0){
            $coupon=pdo_fetch('select * from ' . tablename('vending_machine_coupon') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $order['couponid'], ':uniacid' => $_W['uniacid']));
        }

        //积分余额抵扣
        $sale_credit=self::check_sale_credit($order,$order_goods);

        $img_pre=str_replace('images/1/2020/10/UoDe8ou4YRBDodlp6CWbzLd9lLOdc2.png','',tomedia('images/1/2020/10/UoDe8ou4YRBDodlp6CWbzLd9lLOdc2.png'));

        include $this->template();
    }

    //使用优惠券
    function use_coupon(){
        global $_W, $_GPC;
        $id=intval($_GPC['id']);
        //$contype=intval($_GPC['contype']);
        $coupon_data=pdo_fetch('select * from ' . tablename('vending_machine_coupon_data') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($coupon_data)){
            show_json(0,'优惠券不存在');
        }
        $coupon=pdo_fetch('select * from ' . tablename('vending_machine_coupon') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $coupon_data['couponid'], ':uniacid' => $_W['uniacid']));
        if(empty($coupon)){
            show_json(0,'优惠券不存在');
        }

        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在!');
        }
        $order_goods = pdo_fetchall("select og.*,g.isdiscount,g.isdiscount_time,g.isdiscount_time_start,g.isdiscount_discounts,g.thumb,g.merchsale,g.buyagain,g.buyagain_islong,g.buyagain_condition, g.buyagain_sale,g.isnodiscount,g.discounts,g.deduct,g.manydeduct,g.deduct2,g.manydeduct2,g.cates from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));
        $coupons=com('coupon')->checkcouponlimit(array($coupon),$order_goods);
        if(empty($coupons)||count($coupons)==0||$coupon['enough']>0&&$coupon['enough']>$order['goodsprice']){
            show_json(0,'优惠券未满足使用条件');
        }

        $goods = array();
        $merchid=$coupon['merchid'];
        $coupongoodprice=0;//参与优惠券优惠的商品总价
        $couponprice=0;//优惠券折扣
        foreach ($order_goods as $g) {

            if (empty($g)) {
                continue;
            }

            if ($g['merchid'] != $merchid) {
                continue;
            }

            if($coupon['limitdiscounttype']==1&&$g['isdiscountprice']>0||$coupon['limitdiscounttype']==2&&$g['discountprice']>0||$coupon['limitdiscounttype']==3&&$g['isdiscountprice']>0&&$g['discountprice']>0){//不与促销优惠同时使用 会员折扣
                continue;
            }

            $cates = explode(',', $g['cates']);
            $limitcateids = explode(',', $coupon['limitgoodcateids']);
            $limitgoodids = explode(',', $coupon['limitgoodids']);

            $pass = 0;

            if ($coupon['limitgoodcatetype'] == 0 && $coupon['limitgoodtype'] == 0) {
                $pass = 1;
            }

            if ($coupon['limitgoodcatetype'] == 1) {
                $result = array_intersect($cates, $limitcateids);
                if (count($result) > 0) {
                    $pass = 1;
                }
            }

            if ($coupon['limitgoodtype'] == 1) {
                $isin = in_array($g['goodsid'], $limitgoodids);
                if ($isin) {
                    $pass = 1;
                }
            }
            if ($pass == 1) {
                $goods[] = $g;
                $coupongoodprice+=$g['totalprice'];
            }
        }

        if(($coupon['enough'] > 0 && $coupon['enough'] > $coupongoodprice||$coupongoodprice==0) )
        {
            show_json(0,'优惠券未满足使用条件！');
        }

        if ($coupon['deduct'] > 0 && $coupon['backtype'] == 0 && $coupongoodprice > 0) {
            $couponprice =$coupon['deduct'];
            if ($coupon['deduct'] > $coupongoodprice) {
                $couponprice = $coupongoodprice;
            }

        } else if ($coupon['discount'] > 0 && $coupon['backtype'] == 1) {
            $couponprice = $coupongoodprice * (1 - $coupon['discount'] / 10);
            if ($couponprice > $coupongoodprice) {
                $couponprice = $coupongoodprice;
            }
        }

        if($coupon['backtype'] != 2&&$couponprice<=0){
            show_json(0,'优惠券未满足使用条件!');
        }

        $update=array();
        $update['contype']=$order['contype']=2;
        $update['couponid']=$order['couponid']=$coupon_data['id'];
        $update['couponmerchid']=$order['couponmerchid']=$coupon['merchid'];
        $update['couponprice']=$order['couponprice']=round($couponprice,2);
        $update['coupongoodprice']=$order['coupongoodprice']=round($coupongoodprice,2);
        $update['price']=$order['price']=round($order['goodsprice']-$update['couponprice'],2);
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        //重新计算满立减
        $order=self::check_sale_enough($order);
        //重新计算积分余额抵扣
        $order['deductprice']=$order['deductcredit']=$order['deductcredit2']=0;
        $sale_credit=self::check_sale_credit($order,$order_goods,true);

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }

    //取消优惠券
    function cancel_coupon(){
        global $_W, $_GPC;

        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在');
        }

        $update=array();
        $update['contype']=$order['contype']=0;
        $update['couponid']=$order['couponid']=0;
        $update['couponmerchid']=$order['couponmerchid']=0;
        $update['couponprice']=$order['couponprice']=0;
        $update['coupongoodprice']=$order['coupongoodprice']=0;
        $update['price']=$order['price']=$order['goodsprice'];

        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        //重新计算满立减
        $order=self::check_sale_enough($order);
        //重新计算积分余额抵扣
        $order['deductprice']=$order['deductcredit']=$order['deductcredit2']=0;
        $sale_credit=self::check_sale_credit($order,[],true);

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }

    //检查营销 满立减
    function check_sale_enough($order){
        global $_W, $_GPC;
        //营销
        $realprice=$order['goodsprice']-$order['couponprice'];
        //判断商户营销
        if(!empty($order['merchid'])) {
            $merch_set = pdo_fetch('select sets from ' . tablename('vending_machine_merch_user') . ' where uniacid=:uniacid and id=:id limit 1 ', array(':uniacid' => $order['uniacid'], ':id' => $order['merchid']));
            $allset = unserialize($merch_set['sets']);
            $saleset = $allset['sale'];
        }else {
            $set = pdo_fetch("select * from " . tablename('vending_machine_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $order['uniacid']));
            $plugins_set = unserialize($set['plugins']);
            $saleset = $plugins_set['sale'];
        }
        //满立减
        $deductenough_price=0;//满多少
        $deductenough=0;//减多少
        if ($realprice >= floatval($saleset['enoughmoney']) && floatval($saleset['enoughdeduct']) > 0) {
            $deductenough_price = floatval($saleset['enoughmoney']);
            $deductenough = floatval($saleset['enoughdeduct']);
        }
        foreach ($saleset['enoughs'] as $e) {
            if ($realprice >= floatval($e['enough']) && floatval($e['give']) > 0&&floatval($e['enough'])>=$deductenough_price&&floatval($e['give'])>=$deductenough) {
                $deductenough_price = floatval($e['enough']);
                $deductenough = floatval($e['give']);
            }
        }
        $realprice=max($realprice-$deductenough,0);
        $update=array();
        $update['deductenough']=$order['deductenough']=round($deductenough,2);
        $update['deductenough_price']=$order['deductenough_price']=round($deductenough_price,2);
        $update['price']=$order['price']=round($realprice,2);
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        return $order;
    }

    //检查积分抵扣 余额抵扣
    function check_sale_credit($order=[],$order_goods=[],$reset=false){
        global $_W, $_GPC;
        if(empty($order)){
            return ;
        }

        $open_redis = function_exists('redis') && !is_error(redis());

        //初始化
        if($reset) {
            $order['deductprice']=$order['deductcredit']=$order['deductcredit2']=0;
            $order['price']=$order['goodsprice']-$order['couponprice']-$order['deductenough']-$order['deductprice']-$order['deductcredit2'];

            pdo_update('vending_machine_order', array(
                'deductprice' => 0,//积分抵扣的钱
                'deductcredit' => 0,//抵扣需要扣除的积分
                'deductcredit2' => 0,//余额抵扣的钱
                'price'=>$order['price'],
            ), array('id' => $order['id']));
        }

        $deductprice = $order['price']; //积分最多可抵扣
        $deductprice2 = $order['price']; //余额最多可抵扣
        $deductcredit = 0; //抵扣需要扣除的积分
        $deductmoney = 0; //积分抵扣的钱
        $deductcredit2 = 0; //余额抵扣的钱
        $realprice=$order['goodsprice']-$order['couponprice']-$order['deductenough'];//减去优惠券 满立减
        $realprice=round($realprice,2);

        /*if(empty($order_goods)){
            $order_goods = pdo_fetchall("select og.*,g.isdiscount,g.isdiscount_time,g.isdiscount_time_start,g.isdiscount_discounts,g.thumb,g.merchid,g.merchsale,g.buyagain,g.buyagain_islong,g.buyagain_condition, g.buyagain_sale,g.isnodiscount,g.discounts,g.deduct,g.manydeduct,g.deduct2,g.manydeduct2,g.cates from " . tablename('vending_machine_order_goods') . " og "
                . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
                . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));
        }
        foreach ($order_goods as &$g){
            //积分余额抵扣
            if ($open_redis) {
                $g['ggprice']=$g['realprice'];
                if ($g['deduct'] > $g['ggprice']) {
                    $g['deduct'] = $g['ggprice'];
                }
                //积分抵扣
                if ($g['manydeduct']) {
                    if($g['fee_type']==0){//计件
                        $deductprice += $g['deduct'] * $g['total'];
                    }elseif($g['fee_type']==1){//称重
                        $deductprice += $g['deduct']*abs($g['weight'])/$g['weight_unit'];
                    }
                } else {
                    $deductprice += $g['deduct'];
                }

                //余额抵扣限额
                $deccredit2 = 0;        //可抵扣的余额
                if ($g['deduct2'] == 0) {
                    //全额抵扣
                    $deccredit2 = $g['ggprice'];
                } else if ($g['deduct2'] > 0) {
                    $deccredit2 = $g['deduct2'];
                }

                if ($g['manydeduct2']) {
                    if($g['fee_type']==0){//计件
                        $deccredit2=$deccredit2 * $g['total'];
                    }elseif($g['fee_type']==1){//称重
                        $deccredit2= $deccredit2*abs($g['weight'])/$g['weight_unit'];
                    }
                }

                $deductprice2 += $deccredit2;
            }
        }*/
        //判断营销设置
        $set = pdo_fetch("select * from " . tablename('vending_machine_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $order['uniacid']));
        $plugins_set = unserialize($set['plugins']);
        $saleset = $plugins_set['sale'];

        if (!empty($saleset)&&$open_redis) {
            if (!empty($saleset['creditdeduct'])) {
                $member=m('member')->getMember($order['openid']);
                $credit = $member['credit1'];
                if ($credit > 0) {
                    $credit = floor($credit);
                }
                $pcredit = intval($saleset['credit']); //积分比例
                $pmoney = round(floatval($saleset['money']), 2); //抵扣比例
                if ($pcredit > 0 && $pmoney > 0) {
                    if ($credit % $pcredit == 0) {
                        $deductmoney = round(intval($credit / $pcredit) * $pmoney, 2);
                    } else {
                        $deductmoney = round((intval($credit / $pcredit) + 1) * $pmoney, 2);
                    }
                }

                if ($deductmoney > $deductprice) {
                    $deductmoney = $deductprice;
                }
                //如果已经使用余额抵扣
                $realprice1=$realprice;
                if($order['deductcredit2']>0){
                    $realprice1=$realprice-$order['deductcredit2'];
                }

                if ($deductmoney > $realprice1) {  //减掉秒杀的金额再抵扣
                    $deductmoney = $realprice1;
                }

                if ($pmoney * $pcredit != 0) {
                    $deductcredit = ceil($deductmoney / $pmoney * $pcredit);
                }
            }


            if (!empty($saleset['moneydeduct'])) {

                $deductcredit2 = m('member')->getCredit($order['openid'], 'credit2');
                //如果已使用积分抵扣
                $realprice2=$realprice;
                if($order['deductprice']>0){
                    $realprice2=$realprice-$order['deductprice'];
                }

                if ($deductcredit2 > $realprice2) {  //减掉秒杀的金额再抵扣
                    $deductcredit2 = $realprice2;
                }
                if ($deductcredit2 > $deductprice2) {
                    $deductcredit2 = $deductprice2;
                }

            }
        }

        return array('deductprice'=>$deductmoney,'deductcredit'=>$deductcredit,'deductcredit2'=>$deductcredit2);
    }

    //使用积分
    function use_credit(){
        global $_W, $_GPC;
        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在');
        }

        $order['deductprice']=$order['deductcredit']=0;
        $sale_credit=self::check_sale_credit($order,[]);
        if($sale_credit['deductprice']<=0){
            show_json(0,'可用积分为0');
        }

        //开始使用
        $update=[];
        $update['deductprice']=$order['deductprice']=$sale_credit['deductprice'];
        $update['deductcredit']=$order['deductcredit']=$sale_credit['deductcredit'];
        $update['price']=$order['goodsprice']-$order['couponprice']-$order['deductenough']-$order['deductprice']-$order['deductcredit2'];
        $update['price']=$update['price']<0?0:round($update['price'],2);
        $order['price']=$update['price'];
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        //使用积分后可用余额
        if($order['deductcredit2']==0&&$sale_credit['deductcredit2']>$order['price']){
            $sale_credit['deductcredit2']=$order['price'];
        }

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }

    //取消使用积分
    function cancel_credit(){
        global $_W, $_GPC;
        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在');
        }

        $update=[];
        $update['deductprice']=$order['deductprice']=0;
        $update['deductcredit']=$order['deductcredit']=0;
        $update['price']=$order['goodsprice']-$order['couponprice']-$order['deductenough']-$order['deductprice']-$order['deductcredit2'];
        $update['price']=$update['price']<0?0:round($update['price'],2);
        $order['price']=$update['price'];
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        $sale_credit=self::check_sale_credit($order,[]);

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }

    //使用余额
    function use_credit2(){
        global $_W, $_GPC;
        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在');
        }

        $order['deductcredit2']=0;
        $sale_credit=self::check_sale_credit($order,[]);
        if($sale_credit['deductcredit2']<=0){
            show_json(0,'可用余额为0');
        }

        //开始使用
        $update=[];
        $update['deductcredit2']=$order['deductcredit2']=$sale_credit['deductcredit2'];
        $update['price']=$order['goodsprice']-$order['couponprice']-$order['deductenough']-$order['deductprice']-$order['deductcredit2'];
        $update['price']=$update['price']<0?0:round($update['price'],2);
        $order['price']=$update['price'];
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        //使用余额后可用积分
        if($order['deductprice']==0&&$sale_credit['deductprice']>$order['price']){
            $sale_credit['deductprice']=$order['price'];
        }

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }

    //取消使用余额
    function cancel_credit2(){
        global $_W, $_GPC;
        $orderid=intval($_GPC['orderid']);
        $order = pdo_fetch("SELECT * FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid = :uniacid and openid=:openid", array(':id' =>$orderid, ':uniacid' => $_W['uniacid'],':openid'=>$_W['openid']));
        if(empty($order)){
            show_json(0,'订单不存在');
        }

        $update=[];
        $update['deductcredit2']=$order['deductcredit2']=0;
        $update['price']=$order['goodsprice']-$order['couponprice']-$order['deductenough']-$order['deductprice']-$order['deductcredit2'];
        $update['price']=$update['price']<0?0:round($update['price'],2);
        $order['price']=$update['price'];
        pdo_update('vending_machine_order',$update,array('id'=>$order['id']));

        $sale_credit=self::check_sale_credit($order,[]);

        show_json(1,array('order'=>$order,'sale_credit'=>$sale_credit));
    }
}