<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Order_Model
{

    /*
     * εεε¨θΏ
     * */
    function fullback($orderid)
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $order_goods = pdo_fetchall("select o.openid,og.optionid,og.goodsid,og.price,og.total from " . tablename("vending_machine_order_goods") . " as og
                    left join " . tablename('vending_machine_order') . " as o on og.orderid = o.id
                    where og.uniacid = " . $uniacid . " and og.orderid = " . $orderid . " ");
        /*$order = pdo_fetch('select o.id,o.ordersn,o.openid,og.optionid,og.goodsid,og.price from ' . tablename('vending_machine_order') . ' as o
                left join '.tablename('vending_machine_order_goods').' as og on og.orderid = o.id
                where  o.id=:id and o.uniacid=:uniacid limit 1', array(':uniacid' => $uniacid, ':id' => $orderid));*/
        foreach ($order_goods as $key => $value) {
            if ($value['optionid'] > 0) {
                $goods = pdo_fetch("select g.hasoption,g.id,go.goodsid,go.isfullback from " . tablename('vending_machine_goods') . ' as g
                left join ' . tablename('vending_machine_goods_option') . ' as go on go.goodsid = :id and go.id = ' . $value['optionid'] . '
                 where g.id=:id and g.uniacid=:uniacid limit 1'
                    , array(':id' => $value['goodsid'], ':uniacid' => $uniacid));
            } else {
                $goods = pdo_fetch("select * from " . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1'
                    , array(':id' => $value['goodsid'], ':uniacid' => $uniacid));
            }
            if ($goods['isfullback'] > 0) {
                $fullbackgoods = pdo_fetch("SELECT id,minallfullbackallprice,maxallfullbackallprice,minallfullbackallratio,maxallfullbackallratio,`day`,
                          fullbackprice,fullbackratio,status,hasoption,marketprice,`type`,startday
                          FROM " . tablename('vending_machine_fullback_goods') . " WHERE uniacid = " . $uniacid . " and status=1 and goodsid = " . $value['goodsid'] . " limit 1");
                //return $fullbackgoods;
                $condition = '';
                if (!empty($fullbackgoods) && $goods['hasoption'] && $value['optionid'] > 0) {
                    $option = pdo_fetch('select id,title,allfullbackprice,allfullbackratio,fullbackprice,fullbackratio,`day` from ' . tablename('vending_machine_goods_option') . ' 
                        where id=:id and goodsid=:goodsid and uniacid=:uniacid and isfullback = 1 limit 1',
                        array(':uniacid' => $uniacid, ':goodsid' => $value['goodsid'], ':id' => $value['optionid']));
                    if (!empty($option)) {
                        $fullbackgoods['minallfullbackallprice'] = $option['allfullbackprice'];
                        $fullbackgoods['minallfullbackallratio'] = $option['allfullbackratio'];
                        $fullbackgoods['fullbackprice'] = $option['fullbackprice'];
                        $fullbackgoods['fullbackratio'] = $option['fullbackratio'];
                        $fullbackgoods['day'] = $option['day'];
                        $fullbackgoods['optionid'] = $option['id'];
                        $condition .= 'optionid=:optionid and ';
                    }
                }
                //return $order;
                if (!empty($fullbackgoods)) {
                    $fullbackgoods['startday'] = $fullbackgoods['startday'] - 1;
                    $data = array(
                        'uniacid' => $uniacid,
                        'orderid' => $orderid,
                        'openid' => $value['openid'],
                        'day' => $fullbackgoods['day'],
                        'fullbacktime' => strtotime('+' . $fullbackgoods['startday'] . ' days'),
                        'goodsid' => $value['goodsid'],
                        'createtime' => time()
                    );
                    $condition .= 'uniacid=:uniacid AND openid =:openid AND orderid=:orderid AND goodsid=:goodsid';
                    $params = array(':uniacid' => $uniacid, ':openid' => $data['openid'], ':orderid' => $orderid, ':goodsid' => $data['goodsid']);
                    if (!empty($option)) {
                        $data['optionid'] = $fullbackgoods['optionid'];
                        $params[':optionid'] = $option['id'];
                    }
                    if ($fullbackgoods['type'] > 0) {
                        $data['price'] = $value['price'] * $fullbackgoods['minallfullbackallratio'] / 100;
                        $data['priceevery'] = $value['price'] * $fullbackgoods['fullbackratio'] / 100;
                    } else {
                        $data['price'] = $value['total'] * $fullbackgoods['minallfullbackallprice'];
                        $data['priceevery'] = $value['total'] * $fullbackgoods['fullbackprice'];
                    }
                    $has_record = pdo_fetch("select id from " . tablename('vending_machine_fullback_log') . " where {$condition}", $params);
                    //ι²ζ­’ιε€θ?°ε½ζ°ζ?
                    if (empty($has_record)) {
                        pdo_insert('vending_machine_fullback_log', $data);
                    }
                }
            }

        }
    }

    /*
     * εζ­’ε¨θΏοΌθΏθΏδ½ι’
     * */
    function fullbackstop($orderid)
    {
        global $_W, $_S;
        $uniacid = $_W['uniacid'];
        $shopset = $_S['shop'];

        $fullback_log = pdo_fetch("select * from " . tablename('vending_machine_fullback_log') . " where uniacid = " . $uniacid . " and orderid = " . $orderid . " ");

        /*$credit = 0;
        if($fullback_log['fullbackday']==$fullback_log['day']){
            $credit = $fullback_log['price'];
        }else{
            $credit = $fullback_log['priceevery'] * $fullback_log['fullbackday'];
        }*/
        /*if($credit>0){
            m('member')->setCredit($fullback_log['openid'], 'credit2', -$credit, array(0, $shopset['name'] . "ιζ¬Ύζ£ι€ε¨θΏδ½ι’: {$credit} "));
        }*/
        pdo_update('vending_machine_fullback_log', array('isfullback' => 1), array('id' => $fullback_log['id'], 'uniacid' => $uniacid));

    }

    /**
     * ζ―δ»ζε
     * @param type $params
     * @global type $_W
     */
    public function payResult($params)
    {

        global $_W;

        $fee = intval($params['fee']);
        $data = array('status' => $params['result'] == 'success' ? 1 : 0);

        $ordersn_tid = $params['tid'];
        $ordersn = rtrim($ordersn_tid, 'TR');
        $redis = redis();
        $cacheKey = $ordersn . $_W['uniacid'];

        if (is_error($redis)) {
            $ret = cache_load($cacheKey);
            if ($ret) {
                cache_delete($cacheKey);
                return false;
            }
            cache_write($cacheKey, 123);
        } else {
            $ret = $redis->get($cacheKey);
            if (empty($ret) || is_null($ret)) {
                $redis->setex($cacheKey, 120, 1);
            } else {
                $redis->del($cacheKey);
                return false;
            }
        }


        $order = pdo_fetch('select id,uniacid,ordersn, price,openid,dispatchtype,addressid,carrier,status,isverify,deductcredit2,`virtual`,isvirtual,couponid,isvirtualsend,isparent,paytype,merchid,agentid,createtime,buyagainprice,istrade,tradestatus,iscycelbuy from ' . tablename('vending_machine_order') . ' where  ordersn=:ordersn and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':ordersn' => $ordersn));
        $plugincoupon = com('coupon');
        if ($plugincoupon) {
            $plugincoupon->useConsumeCoupon($order['id']);
        }
        //ε¦ζθ?’εηΆζδΈΊε·²δ»ζ¬Ύ
        if ($order['status'] >= 1) {
            return true;
        }

        $orderid = $order['id'];
        $ispeerpay = $this->checkpeerpay($orderid);

        if (!empty($ispeerpay)) {
            $peerpay_info = (float)pdo_fetchcolumn("select SUM(price) price from " . tablename('vending_machine_order_peerpay_payinfo') . ' where pid=:pid limit 1', array(':pid' => $ispeerpay['id']));
            if ($peerpay_info < $ispeerpay['peerpay_realprice']) {
                return;
            }
            pdo_update('vending_machine_order', array('status' => 0), array('id' => $order['id']));
            $order['status'] = 0;
            $result = pdo_update('vending_machine_order_peerpay', array('status' => 1), array('id' => $ispeerpay['id']));

            $params['type'] = 'peerpay';
        }


        if ($params['from'] == 'return') {

            //η§ζ
            $seckill_result = plugin_run('seckill::setOrderPay', $order['id']);

            if ($seckill_result == 'refund') {
                return 'seckill_refund';
            }

            $address = false;
            if (empty($order['dispatchtype'])) {
                $address = pdo_fetch('select realname,mobile,address from ' . tablename('vending_machine_member_address') . ' where id=:id limit 1', array(':id' => $order['addressid']));
            }

            $carrier = false;
            if ($order['dispatchtype'] == 1 || $order['isvirtual'] == 1) {
                $carrier = unserialize($order['carrier']);
            }

            //εε»Ίθ?°ζ¬‘ζΆεεθ?°ε½
            m('verifygoods')->createverifygoods($order['id']);

            if ($params['type'] == 'cash') {

                if ($order['isparent'] == 1) {
                    $change_data = array();
                    $change_data['merchshow'] = 1;

                    //θ?’εηΆζ
                    pdo_update('vending_machine_order', $change_data, array('id' => $order['id']));

                    //ε€ηε­θ?’εηΆζ
                    $this->setChildOrderPayResult($order, 0, 0);

                    //ε°η₯¨ζε°
                    $merchSql = 'SELECT id,merchid FROM ' . tablename('vending_machine_order') . ' WHERE uniacid = ' . intval($order['uniacid']) . ' AND parentid = ' . intval($order['id']);
                    $merchData = pdo_fetchall($merchSql);
                    foreach ($merchData as $mk => $mv) {
                        //ζε°ζΊζε°
                        file_put_contents(VENDING_MACHINE_DATA . 'print1.json',1111);
                        com_run('printer::sendOrderMessage', $mv['id']);
                    }
                } else {
                    //ζε°ζΊζε°
                    file_put_contents(VENDING_MACHINE_DATA . 'print1.json',1111);
                    com_run('printer::sendOrderMessage', $order['id']);
                }
                return true;
            } else {
                if ($order['istrade'] == 0) {
                    if ($order['status'] == 0) {
                        if (!empty($order['virtual']) && com('virtual')) {
                            return com('virtual')->pay($order, $ispeerpay);
                        } else if ($order['isvirtualsend']) {
                            return $this->payVirtualSend($order['id'], $ispeerpay);
                        } else {

                            $isonlyverifygoods = $this->checkisonlyverifygoods($order['id']);


                            $time = time();
                            $change_data = array();

                            if ($isonlyverifygoods) {
                                $change_data['status'] = 2;
                            } else {
                                $change_data['status'] = 1;
                            }
                            $change_data['paytime'] = $time;

                            if ($order['isparent'] == 1) {
                                $change_data['merchshow'] = 1;
                            }

                            //θ?’εηΆζ
                            pdo_update('vending_machine_order', $change_data, array('id' => $order['id']));

                            if ($order['iscycelbuy'] == 1) {
                                if (p('cycelbuy')) {
                                    p('cycelbuy')->cycelbuy_periodic($order['id']);
                                }

                            }
                            if ($order['isparent'] == 1) {
                                //ε€ηε­θ?’εηΆζ
                                $this->setChildOrderPayResult($order, $time, 1);
                            }

                            //ε€ηδ½ι’ζ΅ζ£,δΈεζΆδ½ι’ζ΅ζ£ε·²η»ζ£ι€,θΏιζ ιεζ§θ‘
                            /*if ($order['deductcredit2'] > 0) {
                                $shopset = m('common')->getSysset('shop');
                                m('member')->setCredit($order['openid'], 'credit2', -$order['deductcredit2'], array(0, $shopset['name'] . "δ½ι’ζ΅ζ£: {$order['deductcredit2']} θ?’εε·: " . $order['ordersn']));
                            }*/

                            //ε€ηη§―εδΈεΊε­
                            $this->setStocksAndCredits($orderid, 1);

                            //ειθ΅ ιδΌζ εΈ
                            if (com('coupon')) {
                                com('coupon')->sendcouponsbytask($order['id']); //θ?’εζ―δ»
                                com('coupon')->backConsumeCoupon($order['id']); //θ?’εζ―δ»
                            }


                            //ε¦ζζζεθ?’εεειζεεηθ?’ειη₯
                            if ($order['isparent'] == 1) {
                                $child_list = $this->getChildOrder($order['id']);

                                foreach ($child_list as $k => $v) {
//                                    if (!empty($v['merchid'])) {
                                    //ζ¨‘ζΏζΆζ―
                                    m('notice')->sendOrderMessage($v['id']);
                                }
//                                }
                            } else {
                                //ζ¨‘ζΏζΆζ―
                                m('notice')->sendOrderMessage($order['id']);
                            }

                            if ($order['isparent'] == 1) {
                                $merchSql = 'SELECT id,merchid FROM ' . tablename('vending_machine_order') . ' WHERE uniacid = ' . intval($order['uniacid']) . ' AND parentid = ' . intval($order['id']);
                                $merchData = pdo_fetchall($merchSql);
                                foreach ($merchData as $mk => $mv) {
                                    //ζε°ζΊζε°
                                    com_run('printer::sendOrderMessage', $mv['id']);
                                }
                            } else {
                                //ζε°ζΊζε°
                                com_run('printer::sendOrderMessage', $order['id']);
                            }


                            //ειε
                            if (p('commission')) {
                                p('commission')->checkOrderPay($order['id']);
                            }


                            $this->afterPayResult($order, $ispeerpay);
                        }
                    }
                } else {
                    $time = time();
                    $change_data = array();
                    $count_ordersn = $this->countOrdersn($ordersn_tid);

                    if ($order['status'] == 0 && $count_ordersn == 1) {
                        $change_data['status'] = 1;
                        $change_data['tradestatus'] = 1;
                        $change_data['paytime'] = $time;
                    } else if ($order['status'] == 1 && $order['tradestatus'] == 1 && $count_ordersn == 2) {
                        $change_data['tradestatus'] = 2;
                        $change_data['tradepaytime'] = $time;
                    }

                    //θ?’εηΆζ
                    pdo_update('vending_machine_order', $change_data, array('id' => $order['id']));
                    if ($order['status'] == 0 && $count_ordersn == 1) {
                        //ζ¨‘ζΏζΆζ―
                        m('notice')->sendOrderMessage($order['id']);
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * ε­θ?’εζ―δ»ζε
     * @param type $order
     * @param type $time
     * @global type $_W
     */
    function setChildOrderPayResult($order, $time, $type)
    {

        global $_W;

        $orderid = $order['id'];
        $list = $this->getChildOrder($orderid);

        if (!empty($list)) {
            $change_data = array();
            if ($type == 1) {
                $change_data['status'] = 1;
                $change_data['paytime'] = $time;
            }
            $change_data['merchshow'] = 0;

            foreach ($list as $k => $v) {
                //θ?’εηΆζ
                if ($v['status'] == 0) {
                    pdo_update('vending_machine_order', $change_data, array('id' => $v['id']));
                }
            }
        }
    }

    /**
     * θ?Ύη½?θ?’εζ―δ»ζΉεΌ
     * @param type $orderid
     * @param type $paytype
     * @global type $_W
     */

    function setOrderPayType($orderid, $paytype, $ordersn = '')
    {

        global $_W;


        $count_ordersn = 1;
        $change_data = array();

        if (!empty($ordersn)) {
            $count_ordersn = $this->countOrdersn($ordersn);
        }

        if ($count_ordersn == 2) {
            $change_data['tradepaytype'] = $paytype;
        } else {
            $change_data['paytype'] = $paytype;
        }

        pdo_update('vending_machine_order', $change_data, array('id' => $orderid));
        $peerpay = pdo_fetch('select id from ' . tablename('vending_machine_order_peerpay') . ' where orderid=:orderid and uniacid=:uniacid', array('orderid' => $orderid, 'uniacid' => $_W['uniacid']));
        if (!empty($orderid)) {
            pdo_update('vending_machine_order', array('paytype' => $paytype), array('parentid' => $orderid));
            pdo_update('vending_machine_order_peerpay_payinfo', array('paytype' => $paytype), array('pid' => $peerpay['id'], 'openid' => $_W['openid']));
        }
    }

    /**
     * θ·εε­θ?’ε
     * @param type $orderid
     * @global type $_W
     */
    function getChildOrder($orderid)
    {

        global $_W;

        $list = pdo_fetchall('select id,ordersn,status,finishtime,couponid,merchid  from ' . tablename('vending_machine_order') . ' where  parentid=:parentid and uniacid=:uniacid', array(':parentid' => $orderid, ':uniacid' => $_W['uniacid']));
        return $list;
    }


    /**
     * θζεεθͺε¨εθ΄§
     * @param int $orderid
     * @return bool?
     */
    function payVirtualSend($orderid = 0, $ispeerpay = false)
    {

        global $_W, $_GPC;

        $order = pdo_fetch('select id,uniacid,ordersn, price,openid,dispatchtype,addressid,carrier,status,isverify,deductcredit2,`virtual`,isvirtual,couponid,isvirtualsend,isparent,paytype,merchid,agentid,createtime,buyagainprice,istrade,tradestatus,iscycelbuy, wxapp_allow_subscribe from ' . tablename('vending_machine_order') . ' where  id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $orderid));
        $order_goods = pdo_fetch("select g.virtualsend,g.virtualsendcontent from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where og.orderid=:orderid and og.uniacid=:uniacid limit 1", array(':uniacid' => $order['uniacid'], ':orderid' => $orderid));
        $time = time();
        //θͺε¨ε?ζ
        pdo_update('vending_machine_order', array('virtualsend_info' => $order_goods['virtualsendcontent'], 'status' => '3', 'paytime' => $time, 'sendtime' => $time, 'finishtime' => $time), array('id' => $orderid));


        //ε€ηδ½ι’ζ΅ζ£,δΈεζΆδ½ι’ζ΅ζ£ε·²η»ζ£ι€,θΏιζ ιεζ§θ‘
        /*if ($order['deductcredit2'] > 0) {
            $shopset = m('common')->getSysset('shop');
            m('member')->setCredit($order['openid'], 'credit2', -$order['deductcredit2'], array(0, $shopset['name'] . "δ½ι’ζ΅ζ£: {$order['deductcredit2']} θ?’εε·: " . $order['ordersn']));
        }*/
        //εεε¨θΏ
        $this->fullback($order['id']);
        //ε€ηεΊε­
        $this->setStocksAndCredits($orderid, 1);

        //ε€ηη§―ε
        $this->setStocksAndCredits($orderid, 3);

        //δΌεεηΊ§
        m('member')->upgradeLevel($order['openid'], $order['id']);

        //δ½ι’θ΅ ι
        $this->setGiveBalance($orderid, 1);

        //ειθ΅ ιδΌζ εΈ
        if (com('coupon')) {
            com('coupon')->sendcouponsbytask($order['id']); //θ?’εζ―δ»
        }

        //δΌζ εΈθΏε©
        if (com('coupon') && !empty($order['couponid'])) {
            com('coupon')->backConsumeCoupon($order['id']); //θ?’εζ―δ»
        }
        //ζ¨‘ζΏζΆζ―
        m('notice')->sendOrderMessage($orderid);

        // ε°η¨εΊθ?’ιζΆζ―
        if (!empty($order['wxapp_allow_subscribe'])) {
            $template = explode(',', $order['wxapp_allow_subscribe']);
            if (in_array('autosend', $template)) {
                $msgdata = array();
                $msgdata['ordersn'] = $order['ordersn'];

                $goods = pdo_fetchall("select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,og.optionname as optiontitle,g.isverify,g.storeids, og.realprice from " . tablename('vending_machine_order_goods') . " og "
                    . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
                    . " where og.orderid=:orderid ", array(':orderid' => $orderid));
                $title = '';
                foreach ($goods as $og) {
                    if (!empty($title)) {
                        $title .= "\n";
                    }
                    $title .= $og['title'];
                    if (!empty($og['optiontitle'])) {
                        $title .= "(" . $og['optiontitle'] . ')';
                    }
                    $title .= ' ζ°ι:' . $og['total'] . ' ζ»δ»·: ' . $og['realprice'];
                }
                $msgdata['title'] = $title;
                $msgdata['time'] = date('YεΉ΄mζdζ₯ H:i:s');
                $msgdata['remark'] = 'ζ¨ηθ?’εε·²εθ΄§';
                $msgdata['page'] = '/pages/order/detail/index?id=' . $orderid;
                if (p('app')) {
                    if (strexists('sns_wa', $order['openid'])) {
                        $openid = $order['openid'];
                    } else {
                        $openid = pdo_fetchcolumn("select openid_wa from " . tablename('vending_machine_member') . " where openid='{$order['openid']}'");
                    }
                    p('app')->sendSubscribeMessage($openid, $msgdata, 'autosend');
                }
            }
        }

        //ζε°ζΊζε°
        com_run('printer::sendOrderMessage', $orderid);

        //ειε
        if (p('commission')) {
            //δ»ζ¬Ύε
            p('commission')->checkOrderPay($order['id']);
            //θͺε¨ε?ζε
            p('commission')->checkOrderFinish($order['id']);
        }


        $this->afterPayResult($order, $ispeerpay);

        return true;
    }


    //δ»»ε‘δΈ­εΏ&ζΈΈζη³»η»θ?’εε€η
    function afterPayResult($order, $ispeerpay = false)
    {

        if (p('task')) {

            //δ½ι’ζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit2'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductcredit2']);
            }
            //η§―εζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductprice']);
            }

            if ($order['agentid']) {
                p('task')->checkTaskReward('commission_order', 1);//ειθ?’ε
            }
            p('task')->checkTaskReward('cost_total', $order['price']);
            p('task')->checkTaskReward('cost_enough', $order['price']);
            p('task')->checkTaskReward('cost_count', 1);
            $goodslist = pdo_fetchall("SELECT goodsid FROM " . tablename('vending_machine_order_goods') . " WHERE orderid = :orderid AND uniacid = :uniacid", array(':orderid' => $order['id'], ':uniacid' => $order['uniacid']));
            foreach ($goodslist as $item) {
                p('task')->checkTaskReward('cost_goods' . $item['goodsid'], 1, $order['openid']);
            }

            //δ½ι’ζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit2'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductcredit2']);
            }
            //η§―εζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductprice']);
            }

            //θ?’εζ»‘ι’
//            p('task')->checkTaskProgress($order['price'],'order_full','',$order['openid']);//??θΏδΈͺιθ¦η§»ε¨ε°η‘?θ?€ζΆθ΄§
            p('task')->checkTaskProgress($order['price'], 'order_all', '', $order['openid']);
            //θ΄­δΉ°ζε?εε
            $goodslist = pdo_fetchall("SELECT goodsid FROM " . tablename('vending_machine_order_goods') . " WHERE orderid = :orderid AND uniacid = :uniacid", array(':orderid' => $order['id'], ':uniacid' => $order['uniacid']));
            foreach ($goodslist as $item) {
                p('task')->checkTaskProgress(1, 'goods', 0, $order['openid'], $item['goodsid']);
            }
            //ι¦ζ¬‘θ΄­η©
            if (pdo_fetchcolumn("select count(*) from " . tablename('vending_machine_order') . " where openid = '{$order['openid']}' and uniacid = {$order['uniacid']}") == 1) {
                p('task')->checkTaskProgress(1, 'order_first', '', $order['openid']);
            }
        }

        //ζ½ε₯ζ¨‘ε
        if (p('lottery') && empty($ispeerpay)) {
            //δ½ι’ζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit2'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductcredit2']);
            }
            //η§―εζ΅ζ£ε ε₯ιι’θ?‘η?
            if ($order['deductcredit'] > 0) {
                $order['price'] = floatval($order['price']) + floatval($order['deductprice']);
            }

            //type 1:ζΆθ΄Ή 2:η­Ύε° 3:δ»»ε‘ 4:εΆδ»
            $res = p('lottery')->getLottery($order['openid'], 1, array('money' => $order['price'], 'paytype' => 1));
            if ($order['isvirtualsend']) {
                $afterorder = p('lottery')->getLottery($order['openid'], 1, array('money' => $order['price'], 'paytype' => 2));
                if ($afterorder) {
                    //ειζ¨‘ηζΆζ―
                    p('lottery')->getLotteryList($order['openid'], array('lottery_id' => $afterorder));
                }
            }

            if ($res) {
                //ειζ¨‘ηζΆζ―
                p('lottery')->getLotteryList($order['openid'], array('lottery_id' => $res));
            }

        }
    }


    /**
     * θ?‘η?θ?’εδΈ­εεη΄―θ?‘θ΅ ιηη§―ε
     * @param type $order
     */
    function getGoodsCredit($goods)
    {
        global $_W;

        $credits = 0;

        foreach ($goods as $g) {
            //η§―εη΄―θ?‘
            $gcredit = trim($g['credit']);
            if (!empty($gcredit)) {
                if (strexists($gcredit, '%')) {
                    //ζζ―δΎθ?‘η?
                    $credits += intval(floatval(str_replace('%', '', $gcredit)) / 100 * $g['realprice']);
                } else {
                    //ζεΊε?εΌθ?‘η?
                    $credits += intval($g['credit']) * $g['total'];
                }
            }
        }
        return $credits;
    }


    /**
     * θΏθΏζ΅ζ£ηδ½ι’
     * @param type $order
     */
    function setDeductCredit2($order)
    {
        global $_W;

        if ($order['deductcredit2'] > 0) {
            m('member')->setCredit($order['openid'], 'credit2', $order['deductcredit2'], array('0', $_W['shopset']['shop']['name'] . "θ΄­η©θΏθΏζ΅ζ£δ½ι’ δ½ι’: {$order['deductcredit2']} θ?’εε·: {$order['ordersn']}"));
        }
    }


    /**
     * ε€ηθ΅ ιδ½ι’ζε΅
     * @param type $orderid
     * @param type $type 1 θ?’εε?ζ 2 ε?ε
     */
    function setGiveBalance($orderid = '', $type = 0, $status = 0)
    {
        global $_W;
        $order = pdo_fetch('select id,ordersn,price,openid,dispatchtype,addressid,carrier,status from ' . tablename('vending_machine_order') . ' where id=:id limit 1', array(':id' => $orderid));
        $goods = pdo_fetchall("select og.goodsid,og.total,g.totalcnf,og.realprice,g.money,og.optionid,g.total as goodstotal,og.optionid,g.sales,g.salesreal from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));

        $balance = 0;

        foreach ($goods as $g) {
            //δ½ι’η΄―θ?‘
            $gbalance = trim($g['money']);
            if (!empty($gbalance)) {
                if (strexists($gbalance, '%')) {
                    //ζζ―δΎθ?‘η?
                    $balance += round(floatval(str_replace('%', '', $gbalance)) / 100 * $g['realprice'], 2);
                } else {
                    //ζεΊε?εΌθ?‘η?
                    $balance += round($g['money'], 2) * $g['total'];
                }
            }
        }

        //η¨ζ·δ½ι’
        if ($balance > 0) {
            $shopset = m('common')->getSysset('shop');

            if ($type == 1) {
                //θ?’εε?ζθ΅ ιδ½ι’
                if ($order['status'] == 3) {
                    m('member')->setCredit($order['openid'], 'credit2', $balance, array(0, $shopset['name'] . 'θ΄­η©θ΅ ιδ½ι’ θ?’εε·: ' . $order['ordersn']));
                }
            } elseif ($type == 2 && $status == 3) {
                // ε·²ε?ζηθ?’εζ£ι€θ΅ ιιι’ 2018-08-27 zhurunfeng δΏ?ζΉ
                //θ?’εε?ε,ζ£ι€θ΅ ιηδ½ι’
                if ($order['status'] >= 1) {
                    m('member')->setCredit($order['openid'], 'credit2', -$balance, array(0, $shopset['name'] . 'θ΄­η©εζΆθ?’εζ£ι€θ΅ ιδ½ι’ θ?’εε·: ' . $order['ordersn']));
                }
            }
        }
    }


    /**
     * //ε€ηθ?’εεΊε­εη¨ζ·η§―εζε΅(θ΅ ιη§―ε)
     * @param type $orderid
     * @param type $type 0 δΈε 1 ζ―δ» 2 εζΆ 3 η‘?θ?€ζΆθ΄§
     * @param $flag $flag δ»£θ‘¨ζ―δΈζ―ζ§θ‘ε’ε η§―εηζΉεΌ,ε¦ζζθ―»εεη¦»δΌε―Όθ΄θ?’εηΆζθΏζͺζΉεε°±θΏζ₯δΊ
     */
    function setStocksAndCredits($orderid = '', $type = 0, $flag = false)
    {
        global $_W;

        $tempflag = false;
        $order = pdo_fetch('select id,ordersn,price,openid,dispatchtype,addressid,carrier,status,isparent,paytype,isnewstore,storeid,istrade,status from ' . tablename('vending_machine_order') . ' where id=:id limit 1', array(':id' => $orderid));

        if (!empty($order['istrade'])) {
            return;
        }

        if (empty($order['isnewstore'])) {
            $newstoreid = 0;
        } else {
            $newstoreid = intval($order['storeid']);
        }

        $param = array();
        $param[':uniacid'] = $_W['uniacid'];

        if ($order['isparent'] == 1) {
            $condition = " og.parentorderid=:parentorderid";
            $param[':parentorderid'] = $orderid;
        } else {
            $condition = " og.orderid=:orderid";
            $param[':orderid'] = $orderid;
        }

        $goods = pdo_fetchall("select og.goodsid,og.seckill,og.total,g.totalcnf,og.realprice,g.credit,og.optionid,g.total as goodstotal,og.optionid,g.sales,g.salesreal,g.type from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where $condition and og.uniacid=:uniacid ", $param);

        $credits = 0;
        foreach ($goods as $g) {


            if ($newstoreid > 0) {
                $store_goods = m('store')->getStoreGoodsInfo($g['goodsid'], $newstoreid);
                if (empty($store_goods)) {
                    return;
                }
                $g['goodstotal'] = $store_goods['stotal'];
            } else {
                $goods_item = pdo_fetch("select total as goodstotal from" . tablename('vending_machine_goods') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $g['goodsid'], ':uniacid' => $_W['uniacid']));
                $g['goodstotal'] = $goods_item['goodstotal'];
            }

            $stocktype = 0; //0 δΈθ?Ύη½?εΊε­ζε΅ -1 εε° 1 ε’ε 
            if ($type == 0) {
                //ε¦ζζ―δΈε
                if ($g['totalcnf'] == 0) {
                    //ε°εΊε­
                    $stocktype = -1;
                }
            } else if ($type == 1) {
                if ($g['totalcnf'] == 1) {
                    //ε°εΊε­
                    $stocktype = -1;
                }
            } else if ($type == 2) {
                //εζΆθ?’ε
                if ($order['status'] >= 1) {
                    //ε¦ζε·²δ»ζ¬Ύ
                    if ($g['totalcnf'] != 2) {
                        //ε εΊε­
                        $stocktype = 1;
                    }
                } else {
                    //ζͺδ»ζ¬ΎοΌεΉΆδΈζ―δΈεεεΊε­
                    if ($g['totalcnf'] == 0) {
                        //ε εΊε­
                        $stocktype = 1;
                    }
                }
            }
            if (!empty($stocktype)) {
                $data = m('common')->getSysset('trade');
                if (!empty($data['stockwarn'])) {
                    $stockwarn = intval($data['stockwarn']);
                } else {
                    $stockwarn = 5;
                }

                if (!empty($g['optionid'])) {
                    //εε°θ§ζ ΌεΊε­
                    $option = m('goods')->getOption($g['goodsid'], $g['optionid']);

                    if ($newstoreid > 0) {
                        $store_goods_option = m('store')->getOneStoreGoodsOption($g['optionid'], $g['goodsid'], $newstoreid);

                        if (empty($store_goods_option)) {
                            return;
                        }
                        $option['stock'] = $store_goods_option['stock'];
                    }


                    if (!empty($option) && $option['stock'] != -1) {
                        $stock = -1;
                        if ($stocktype == 1) {
                            //ε’ε εΊε­
                            $stock = $option['stock'] + $g['total'];
                        } else if ($stocktype == -1) {
                            //εε°εΊε­
                            $stock = $option['stock'] - $g['total'];
                            $stock <= 0 && $stock = 0;


                            if ($stockwarn >= $stock && $newstoreid == 0) {
                                m('notice')->sendStockWarnMessage($g['goodsid'], $g['optionid']);
                            }

                        }
                        if ($stock != -1) {

                            if ($newstoreid > 0) {
                                pdo_update('vending_machine_newstore_goods_option', array('stock' => $stock), array('uniacid' => $_W['uniacid'], 'goodsid' => $g['goodsid'], 'id' => $store_goods_option['id']));
                            } else {
                                pdo_update('vending_machine_goods_option', array('stock' => $stock), array('uniacid' => $_W['uniacid'], 'goodsid' => $g['goodsid'], 'id' => $g['optionid']));
                            }
                        }
                    }
                }
                if (((!empty($g['goodstotal']) && $stocktype == -1) || $stocktype == 1) && $g['goodstotal'] != -1) {
                    //εε°εεζ»εΊε­
                    $totalstock = -1;
                    if ($stocktype == 1) {
                        //ε’ε εΊε­
                        $totalstock = $g['goodstotal'] + $g['total'];
                    } else if ($stocktype == -1) {
                        //εε°εΊε­
                        $totalstock = $g['goodstotal'] - $g['total'];
                        $totalstock <= 0 && $totalstock = 0;


                        if ($stockwarn >= $totalstock && $newstoreid == 0) {
                            m('notice')->sendStockWarnMessage($g['goodsid'], 0);
                        }
                    }
                    if ($totalstock != -1) {

                        if ($newstoreid > 0) {
                            pdo_update('vending_machine_newstore_goods', array('stotal' => $totalstock), array('uniacid' => $_W['uniacid'], 'id' => $store_goods['id']));
                        } else {
                            pdo_update('vending_machine_goods', array('total' => $totalstock), array('uniacid' => $_W['uniacid'], 'id' => $g['goodsid']));
                        }
                    }
                }
            }
            $dogcredit = 1;
            $isgoodsdata = m('common')->getPluginset('sale');
            $isgoodspoint = iunserializer($isgoodsdata['credit1']);
            if (!empty($isgoodspoint['isgoodspoint']) && $isgoodspoint['isgoodspoint'] == 1) {
                //η§―εη΄―θ?‘
                $gcredit = trim($g['credit']);
                //ε€ζ­εεη§―εθ?Ύη½?δΈΊη©ΊθΏζ―0,ε¦ζζ―0,θ₯ιη§―εδΉδΈθ΅°
                if ($gcredit === 0) {
                    $dogcredit = 0;
                }
                //η§ζδΈιη§―ε
                if ($g['seckill'] != 1) {
                    if (!empty($gcredit)) {
                        $tempflag = true;
                        if (strexists($gcredit, '%')) {
                            //ζζ―δΎθ?‘η?
                            $credits += intval(floatval(str_replace('%', '', $gcredit)) / 100 * $g['realprice']);
                        } else {
                            //ζεΊε?εΌθ?‘η?
                            $credits += intval($g['credit']) * $g['total'];
                        }
                    }
                }

            }

            if ($type == 0) {
                //θζιιεͺθ¦ζ―ζδΈε°±ε  || ε¦ζζ―δ»ζ¬ΎεεΊε­,εδ»ζ¬Ύζε ιι
//                if ($g['totalcnf'] != 1) {
//                    pdo_update('vending_machine_goods', array('sales' => $g['sales'] + $g['total']), array('uniacid' => $_W['uniacid'], 'id' => $g['goodsid']));
//                }
            } elseif ($type == 1) {
                //ηε?ιιδ»ζ¬Ύζε 
                if ($order['status'] >= 1) {
//                    if ($g['totalcnf'] != 1) {
//                        pdo_update('vending_machine_goods', array('sales' => $g['sales'] + $g['total']), array('uniacid' => $_W['uniacid'], 'id' => $g['goodsid']));
//                    }
                    //ε?ιιι
                    $salesreal = pdo_fetchcolumn('select ifnull(sum(total),0) from ' . tablename('vending_machine_order_goods') . ' og '
                        . ' left join ' . tablename('vending_machine_order') . ' o on o.id = og.orderid '
                        . ' where og.goodsid=:goodsid and o.status>=1 and o.uniacid=:uniacid limit 1', array(':goodsid' => $g['goodsid'], ':uniacid' => $_W['uniacid']));
                    pdo_update('vending_machine_goods', array('salesreal' => $salesreal), array('id' => $g['goodsid']));

                    //ζ―δ»ζε,ε¦ζεεθ?Ύη½?δΊιη§―εθ₯ιζ΄»ε¨,εε’ε δΈζ‘θ?°ε½
                    $table_flag = pdo_tableexists('vending_machine_order_buysend');
                    if ($credits > 0 && $table_flag) {
                        $send_data = array(
                            'uniacid' => $_W['uniacid'],
                            'orderid' => $orderid,
                            'openid' => $order['openid'],
                            'credit' => $credits,
                            'createtime' => TIMESTAMP,
                        );
                        $send_record = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_order_buysend') . ' WHERE orderid = :orderid AND uniacid = :uniacid AND openid = :openid', array(':orderid' => $orderid, ':uniacid' => $_W['uniacid'], ':openid' => $order['openid']));
                        if ($send_record) {
                            pdo_update('vending_machine_order_buysend', $send_data, array('id' => $send_record['id']));
                        } else {
                            pdo_insert('vending_machine_order_buysend', $send_data);
                        }
                    }
                }
            }
        }
        //η¨ζ·η§―ε
        $table_flag = pdo_tableexists('vending_machine_order_buysend');
        if ($table_flag) {
            $send_record = pdo_fetch('SELECT * FROM ' . tablename('vending_machine_order_buysend') . ' WHERE orderid = :orderid AND uniacid = :uniacid AND openid = :openid', array(':orderid' => $orderid, ':uniacid' => $_W['uniacid'], ':openid' => $order['openid']));
            if ($send_record && ($send_record['credit'] > 0)) $credits = $send_record['credit'];
        }

        if ($credits > 0) {
            $shopset = m('common')->getSysset('shop');
            if ($type == 3) {
                if ($order['status'] == 3 || $flag == true) {
                    //ζ―δ»ε’ε η§―ε
                    m('member')->setCredit($order['openid'], 'credit1', $credits, array(0, $shopset['name'] . 'θ΄­η©η§―ε θ?’εε·: ' . $order['ordersn']));
                    m('notice')->sendMemberPointChange($order['openid'], $credits, 0, 3);
                }
            } elseif ($type == 2) {
                //εε°η§―εοΌεͺζθ?’εε?ζζεε°
                if ($order['status'] == 3) {
                    m('member')->setCredit($order['openid'], 'credit1', -$credits, array(0, $shopset['name'] . 'θ΄­η©εζΆθ?’εζ£ι€η§―ε θ?’εε·: ' . $order['ordersn']));
                    m('notice')->sendMemberPointChange($order['openid'], $credits, 1, 3);
                }
            }
        } else if ($tempflag == false) {
            //η§―εζ΄»ε¨θ?’ειη§―ε
            if ($type == 3) {
                if ($order['status'] == 3 && $dogcredit == 1) {
                    //ζ―δ»ε’ε η§―ε
                    $money = com_run('sale::getCredit1', $order['openid'], (float)$order['price'], $order['paytype'], 1);
                    if ($money > 0) {
                        m('notice')->sendMemberPointChange($order['openid'], $money, 0, 3);
                    }
                }
            } elseif ($type == 2) {
                //εε°η§―εοΌεͺζδ»ζ¬ΎδΊζεε°
                if ($order['status'] == 3) {
                    $money = com_run('sale::getCredit1', $order['openid'], (float)$order['price'], $order['paytype'], 1, 1);
                    if ($money > 0) {
                        m('notice')->sendMemberPointChange($order['openid'], $money, 1, 3);
                    }
                }
            }
        }

    }

    function getTotals($merch = 0)
    {
        global $_W;

        $paras = array(':uniacid' => $_W['uniacid']);
        $merch = intval($merch);
        $condition = ' and isparent=0';
        if ($merch < 0) {
            $condition .= ' and merchid=0';
        }
        $totals['all'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0 and deleted=0", $paras);
        $totals['status_1'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0 and status=-1 and refundtime=0 and deleted=0", $paras);
        $totals['status0'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0  and status=0 and paytype<>3 and deleted=0", $paras);
        $totals['status1'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0  and ( status=1 or ( status=0 and paytype=3) ) and deleted=0", $paras);
        $totals['status2'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0  and ( status=2 or (status=0 and createtime<=".(time()-60*30).") ) and deleted=0", $paras);
        $totals['status3'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0  and status=3 and deleted=0", $paras);
        $totals['status4'] = pdo_fetchcolumn(
            'SELECT COUNT(1)FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0  and ((refundstate>0 and refundid<>0 and refundtime=0) or (refundtime=0 and refundstate=3)) and deleted=0", $paras);
        $totals['status5'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('vending_machine_order') . ""
            . " WHERE uniacid = :uniacid {$condition} and ismr=0 and refundtime<>0 and deleted=0", $paras);

        return $totals;
    }

    function getFormartDiscountPrice($isd, $gprice, $gtotal = 1)
    {
        $price = $gprice;
        if (!empty($isd)) {
            if (strexists($isd, '%')) {
                //δΏιζζ£
                $dd = floatval(str_replace('%', '', $isd));

                if ($dd > 0 && $dd < 100) {
                    $price = round($dd / 100 * $gprice, 2);
                }
            } else if (floatval($isd) > 0) {
                //δΏιδ»·ζ Ό
                $price = round(floatval($isd * $gtotal), 2);
            }
        }
        return $price;
    }


    //θ·εΎdεεθ―¦η»δΏι
    function getGoodsDiscounts($goods, $isdiscount_discounts, $levelid, $options = array())
    {

        $key = empty($levelid) ? 'default' : 'level' . $levelid;
        $prices = array();

        if (empty($goods['merchsale'])) {
            if (!empty($isdiscount_discounts[$key])) {
                foreach ($isdiscount_discounts[$key] as $k => $v) {
                    $k = substr($k, 6);
                    $op_marketprice = m('goods')->getOptionPirce($goods['id'], $k);
                    $gprice = $this->getFormartDiscountPrice($v, $op_marketprice);
                    $prices[] = $gprice;
                    if (!empty($options)) {
                        foreach ($options as $key => $value) {
                            if ($value['id'] == $k) {
                                $options[$key]['marketprice'] = $gprice;
                            }
                        }
                    }
                }
            }
        } else {
            if (!empty($isdiscount_discounts['merch'])) {
                foreach ($isdiscount_discounts['merch'] as $k => $v) {
                    $k = substr($k, 6);
                    $op_marketprice = m('goods')->getOptionPirce($goods['id'], $k);
                    $gprice = $this->getFormartDiscountPrice($v, $op_marketprice);
                    $prices[] = $gprice;
                    if (!empty($options)) {
                        foreach ($options as $key => $value) {
                            if ($value['id'] == $k) {
                                $options[$key]['marketprice'] = $gprice;
                            }
                        }
                    }
                }
            }
        }

        $data = array();
        $data['prices'] = $prices;
        $data['options'] = $options;

        return $data;
    }

    //θ·εΎdεεδΏιζδΌεζζ£δ»·ζ Ό
    function getGoodsDiscountPrice($g, $level, $type = 0, $memberCardId = 0)
    {
        global $_W;
        // ζ―ε¦ζ₯ζδΌεε‘
        $hasMemberCard = (boolean)$memberCardId;
        // ζ―ε¦δΊ«εζζ£
        $hasMemberDeduct = true;
        // ε¨ζ₯ζδΌεε‘ζδ»ΆηζΆεεε€ζ­
        if (p('membercard')) {
            $membercardSettings = p('membercard')->getMemberCard($memberCardId);
            // ζ­€ε€ε€ζ­δΈε―ε»,ε δΈΊδΌε­ε¨ζ²‘ζζδΌεε‘ζδ»Άδ½ζ―ζ²‘ζδΌεε‘ηη¨ζ·θ’«θ――ε€,εΊη°δΈδΊ«εζζ£ηι?ι’
            if ($hasMemberCard) {
                // discount = 0 δΈεΌε―ζδΈζ 1 - εΌε―ζδΈζ, ι£δΉεεηδΏιεδΌεζζ£ζ―ε¦εΌε―δΉθ¦θ·θ?Ύη½?δΈθ΄
                $hasMemberDeduct = (boolean)$membercardSettings['discount'];
            }
        }

        // ε€ζ­δΌεη­ηΊ§ηΆζ
        if (!empty($level['id'])) {
            $level = pdo_fetch('select * from ' . tablename('vending_machine_member_level') . ' where id=:id and uniacid=:uniacid and enabled=1 limit 1', array(':id' => $level['id'], ':uniacid' => $_W['uniacid']));
            $level = empty($level) ? array() : $level;
        }

        //εεεδ»·
        if ($type == 0) {
            $total = $g['total'];
        } else {
            $total = 1;
        }

        $gprice = $g['marketprice'] * $total;

        if (empty($g['buyagain_islong'])) {
            $gprice = $g['marketprice'] * $total;
        }
        //ιε€θ΄­δΉ°θ΄­δΉ°ζ―ε¦δΊ«εεΆδ»ζζ£
        $buyagain_sale = true;
        $buyagainprice = 0;
        $canbuyagain = false;

        if (empty($g['is_task_goods'])) {
            if (floatval($g['buyagain']) > 0) {
                //η¬¬δΈζ¬‘εδΉ°δΈθ₯ΏδΊ«εδΌζ 
                if (m('goods')->canBuyAgain($g)) {
                    $canbuyagain = true;
                    if (empty($g['buyagain_sale'])) {
                        $buyagain_sale = false;
                    }
                }
            }
        }


        //ζδΊ€ηδ»·ζ Ό
        $price = $gprice;
        $price1 = $gprice;
        $price2 = $gprice;

        //δ»»ε‘ζ΄»ε¨η©ε
        $taskdiscountprice = 0; //δ»»ε‘ζ΄»ε¨ζζ£
        $lotterydiscountprice = 0; //ζΈΈζζ΄»ε¨ζζ£
        if (!empty($g['is_task_goods'])) {
            $buyagain_sale = false;
            $price = $g['task_goods']['marketprice'] * $total;

            if ($gprice > $price) {
                $d_price = abs($gprice - $price);

                if ($g['is_task_goods'] == 1) {
                    $taskdiscountprice = $d_price;
                } else if ($g['is_task_goods'] == 2) {
                    $lotterydiscountprice = $d_price;
                }
            }
        }

        $discountprice = 0; //δΌεζζ£
        $isdiscountprice = 0; //δΏιζζ£
        $isd = false;
        @$isdiscount_discounts = json_decode($g['isdiscount_discounts'], true);

        //ε€ζ­ζη»δ»·ζ Όδ»₯εͺη§δΌζ θ?‘η? 0 ζ δΌζ ,1 δΏιδΌζ , 2 δΌεζζ£
        $discounttype = 0;
        //ε€ζ­ζ―ε¦ζδΏιζζ£
        $isCdiscount = 0;
        //ε€ζ­ζ―ε¦ζδΌεζζ£
        $isHdiscount = 0;

        //ζ―ε¦ζδΏι
        if ($g['isdiscount'] == 1 && $g['isdiscount_time'] >= time() && $g['isdiscount_time_start'] < time() && $buyagain_sale && $hasMemberDeduct) {

            if (is_array($isdiscount_discounts)) {
                $key = !empty($level['id']) ? 'level' . $level['id'] : 'default';
                if (!isset($isdiscount_discounts['type']) || empty($isdiscount_discounts['type'])) {
                    //η»δΈ
                    if (empty($g['merchsale'])) {
                        $isd = trim($isdiscount_discounts[$key]['option0']);
                        if (!empty($isd)) {
                            $price1 = $this->getFormartDiscountPrice($isd, $gprice, $total);
                        }
                    } else {
                        $isd = trim($isdiscount_discounts['merch']['option0']);
                        if (!empty($isd)) {
                            $price1 = $this->getFormartDiscountPrice($isd, $gprice, $total);
                        }
                    }
                } else {
                    //θ―¦η»δΏι
                    if (empty($g['merchsale'])) {
                        $isd = trim($isdiscount_discounts[$key]['option' . $g['optionid']]);
                        if (!empty($isd)) {
                            $price1 = $this->getFormartDiscountPrice($isd, $gprice, $total);
                        }
                    } else {
                        $isd = trim($isdiscount_discounts['merch']['option' . $g['optionid']]);
                        if (!empty($isd)) {
                            $price1 = $this->getFormartDiscountPrice($isd, $gprice, $total);
                        }
                    }
                }
            }

            //ε€ζ­δΏιδ»·ζ―ε¦δ½δΊεδ»·
            if ($price1 >= $gprice) {
                $isdiscountprice = 0;
                $isCdiscount = 0;
            } else {
                $isdiscountprice = abs($price1 - $gprice);
                $isCdiscount = 1;
            }

        }


        if (empty($g['isnodiscount']) && $buyagain_sale && $hasMemberDeduct) {
            //εδΈδΌεζζ£
            $discounts = json_decode($g['discounts'], true);

            //ε¦ζζ―ε€εζ·εεοΌεΉΆδΈδΌεη­ηΊ§ζζ£δΈΊη©Ίηζε΅δΈοΌζ¨‘ζη©ΊηεεδΌεη­ηΊ§ζζ£ζ°ζ?οΌδ»₯δΎΏθ?‘η?ζζ£
            if (empty($g['discounts']) && $g['merchid'] > 0) {
                $g['discounts'] = array(
                    'type' => '0',
                    'default' => '',
                    'default_pay' => ''
                );
                if (!empty($level)) {
                    $g['discounts']['level' . $level['id']] = '';
                    $g['discounts']['level' . $level['id'] . '_pay'] = '';
                }
                $discounts = $g['discounts'];
            }

            if (is_array($discounts)) {

                $key = !empty($level['id']) ? 'level' . $level['id'] : 'default';
                if (!isset($discounts['type']) || empty($discounts['type'])) {
                    //η»δΈζζ£
                    if (!empty($discounts[$key])) {
                        $dd = floatval($discounts[$key]); //θ?Ύη½?ηδΌεζζ£
                        if ($dd > 0 && $dd < 10) {
                            $price2 = round($dd / 10 * $gprice, 2);
                        }
                    } else {
                        $dd = floatval($discounts[$key . '_pay'] * $total); //θ?Ύη½?ηδΌεζζ£
                        $md = floatval($level['discount']); //δΌεη­ηΊ§ζζ£
                        if (!empty($dd)) {
                            $price2 = round($dd, 2);
                        } else if ($md > 0 && $md < 10) {
                            $price2 = round($md / 10 * $gprice, 2);
                        }
                    }
                } else {
                    //θ―¦η»ζζ£

                    $isd = trim($discounts[$key]['option' . $g['optionid']]);
                    if (!empty($isd)) {
                        $price2 = $this->getFormartDiscountPrice($isd, $gprice, $total);
                    }
                }
            }

            //ε€ζ­δΏιδ»·ζ―ε¦δ½δΊεδ»·
            if ($price2 >= $gprice) {
                $discountprice = 0;
                $isHdiscount = 0;
            } else {
                $discountprice = abs($price2 - $gprice);
                $isHdiscount = 1;
            }
        }

        if ($isCdiscount == 1) {
            $price = $price1;
            $discounttype = 1;
        } else if ($isHdiscount == 1) {
            $price = $price2;
            $discounttype = 2;
        }


        //εΉ³εδ»·ζ Ό
        $unitprice = round($price / $total, 2);
        //δ½Ώη¨δΏιηεεδ»·ζ Ό
        $isdiscountunitprice = round($isdiscountprice / $total, 2);
        //δ½Ώη¨δΌεζζ£ηεεδ»·ζ Ό
        $discountunitprice = round($discountprice / $total, 2);

        if ($canbuyagain) {
            if (empty($g['buyagain_islong'])) {
                $buyagainprice = $unitprice * (10 - $g['buyagain']) / 10;
            } else {
                $buyagainprice = $price * (10 - $g['buyagain']) / 10;
            }
        }

        $price = $price - $buyagainprice;

        return array(
            'unitprice' => $unitprice,
            'price' => $price,
            'taskdiscountprice' => $taskdiscountprice,
            'lotterydiscountprice' => $lotterydiscountprice,
            'discounttype' => $discounttype,
            'isdiscountprice' => $isdiscountprice,
            'discountprice' => $discountprice,
            'isdiscountunitprice' => $isdiscountunitprice,
            'discountunitprice' => $discountunitprice,
            'price0' => $gprice,
            'price1' => $price1,
            'price2' => $price2,
            'buyagainprice' => $buyagainprice
        );
    }

    //θ?‘η?ε­θ?’εδΈ­ηηΈε³θ΄Ήη¨
    function getChildOrderPrice(&$order, &$goods, &$dispatch_array, $merch_array, $sale_plugin, $discountprice_array, $orderid = 0)
    {
        global $_GPC;
        $tmp_goods = $goods;
        //ζ―εζ’δΈ­εΏθ?’ε
        $is_exchange = (p('exchange') && $_SESSION['exchange']);
        if ($is_exchange) {
            foreach ($dispatch_array['dispatch_merch'] as &$dispatch_merch) {
                $dispatch_merch = 0;
            }
            unset($dispatch_merch);
            $postage = $_SESSION['exchange_postage_info'];
            $exchangepriceset = (array)$_SESSION['exchangepriceset'];
            foreach ($goods as $gk => $one_goods) {
                $goods[$gk]['ggprice'] = 0;
                $tmp_goods[$gk]['marketprice'] = 0;
            }
            foreach ($exchangepriceset as $pset) {
                foreach ($goods as $gk => &$one_goods) {
                    if ($one_goods['ggprice'] == 0 && ($one_goods['optionid'] == $pset[0] || $one_goods['goodsid'] == $pset[0])) {
                        $one_goods['ggprice'] += $pset[2];
                        $tmp_goods[$gk]['marketprice'] += $pset[2];
                        break;
                    }
                }
                unset($one_goods);
            }
        }
        $totalprice = $order['price'];             //ζ»δ»·
        $goodsprice = $order['goodsprice'];       //εεζ»δ»·
        $grprice = $order['grprice'];             //εεε?ιζ»δ»·

        $deductprice = $order['deductprice'];     //ζ΅ζ£ηι±
        $deductcredit = $order['deductcredit'];   //ζ΅ζ£ιθ¦ζ£ι€ηη§―ε
        $deductcredit2 = $order['deductcredit2']; //ε―ζ΅ζ£ηδ½ι’

        $deductenough = $order['deductenough'];   //ζ»‘ι’ε
        //$couponprice = $order['couponprice'];     //δΌζ εΈδ»·ζ Ό

        $is_deduct = 0;        //ζ―ε¦θΏθ‘η§―εζ΅ζ£ηθ?‘η?
        $is_deduct2 = 0;       //ζ―ε¦θΏθ‘δ½ι’ζ΅ζ£ηθ?‘η?
        $deduct_total = 0;     //θ?‘η?εεδΈ­ε―ζ΅ζ£ηζ»η§―ε
        $deduct2_total = 0;    //θ?‘η?εεδΈ­ε―ζ΅ζ£ηζ»δ½ι’

        $ch_order = array();

        if ($sale_plugin) {
            //η§―εζ΅ζ£
            if (!empty($_GPC['deduct'])) {
                $is_deduct = 1;
            }

            //δ½ι’ζ΅ζ£
            if (!empty($_GPC['deduct2'])) {
                $is_deduct2 = 1;
            }
        }
        foreach ($goods as $gk => &$g) {
            $merchid = $g['merchid'];

            $ch_order[$merchid]['goods'][] = $g['goodsid'];
            $ch_order[$merchid]['grprice'] += $g['ggprice'];
            $ch_order[$merchid]['goodsprice'] += $tmp_goods[$gk]['marketprice'] * $g['total'];
//            $g['proportion'] = round($g['ggprice'] / $grprice, 2);
            $ch_order[$merchid]['couponprice'] = $discountprice_array[$merchid]['deduct'];

            if ($is_deduct == 1) {
                //η§―εζ΅ζ£
                if ($g['manydeduct']) {
                    $deduct = $g['deduct'] * $g['total'];
                } else {
                    $deduct = $g['deduct'];
                }


                if ($g['seckillinfo'] && $g['seckillinfo']['status'] == 0) {
                    //η§ζδΈζ΅ζ£
                } else {
                    $deduct_total += $deduct;
                    $ch_order[$merchid]['deducttotal'] += $deduct;
                }

            }

            if ($is_deduct2 == 1) {
                //δ½ι’ζ΅ζ£
                if ($g['deduct2'] == 0) {
                    //ε¨ι’ζ΅ζ£
                    $deduct2 = $g['ggprice'];
                } else if ($g['deduct2'] > 0) {

                    //ζε€ζ΅ζ£
                    if ($g['deduct2'] > $g['ggprice']) {
                        $deduct2 = $g['ggprice'];
                    } else {
                        $deduct2 = $g['deduct2'];
                    }
                }

                if ($g['seckillinfo'] && $g['seckillinfo']['status'] == 0) {
                    //η§ζδΈζ΅ζ£
                } else {
                    $ch_order[$merchid]['deduct2total'] += $deduct2;
                    $deduct2_total += $deduct2;
                }
                $deduct2 = 0;
            }
        }

        unset($g);

        foreach ($ch_order as $k => $v) {

            if ($is_deduct == 1) {
                //θ?‘η?θ―¦η»η§―εζ΅ζ£
                if ($deduct_total > 0) {
                    $n = $v['deducttotal'] / $deduct_total;
                    $deduct_credit = ceil(round($deductcredit * $n, 2));
                    $deduct_money = round($deductprice * $n, 2);
                    $ch_order[$k]['deductcredit'] = $deduct_credit;
                    $ch_order[$k]['deductprice'] = $deduct_money;
                }
            }

            if ($is_deduct2 == 1) {
                //θ?‘η?θ―¦η»δ½ι’ζ΅ζ£
                if ($deduct2_total > 0) {
                    $n = $v['deduct2total'] / $deduct2_total;
                    $deduct_credit2 = round($deductcredit2 * $n, 2);
                    $ch_order[$k]['deductcredit2'] = $deduct_credit2;
                }
            }

            //ε­θ?’εεεδ»·ζ Όε ζ»θ?’εηζ―δΎ
            $op = $grprice == 0 ? 0 : round($v['grprice'] / $grprice, 2);
            $ch_order[$k]['op'] = $op;

            if ($deductenough > 0) {
                //θ?‘η?ζ»‘ειι’
                $deduct_enough = round($deductenough * $op, 2);
                $ch_order[$k]['deductenough'] = $deduct_enough;
            }

        }

        if ($is_exchange) {//εζ’δΈ­εΏ
            if (is_array($postage)) {//ζδ»Άθ?‘η?θΏθ΄Ή
                foreach ($ch_order as $mid => $ch) {
                    $flip = array_flip(array_flip($ch['goods']));
                    foreach ($flip as $gid) {
                        $dispatch_array['dispatch_merch'][$mid] += $postage[$gid];
                    }
                }
            } else {//ζεθ?‘η?θΏθ΄Ή
                $old_dispatch_price = $order['dispatchprice'];
                $order['dispatchprice'] = $_SESSION['exchangepostage'] = $postage * count($dispatch_array['dispatch_merch']);
                pdo_update('vending_machine_order', array('dispatchprice' => $order['dispatchprice'],
                    'price' => ($order['price'] + $order['dispatchprice'] - $old_dispatch_price)), array('id' => $orderid));
                foreach ($dispatch_array['dispatch_merch'] as &$dispatch_merch) {
                    $dispatch_merch = $postage;
                }
                unset($dispatch_merch);
            }
        }

        foreach ($ch_order as $k => $v) {
            $merchid = $k;
            $price = $v['grprice'] - $v['deductprice'] - $v['deductcredit2'] - $v['deductenough'] - $v['couponprice'] + $dispatch_array['dispatch_merch'][$merchid];

            //ε€εζ·ζ»‘ι’ε
            if ($merchid > 0) {
                $merchdeductenough = $merch_array[$merchid]['enoughdeduct'];
                if ($merchdeductenough > 0) {
                    $price -= $merchdeductenough;
                    $ch_order[$merchid]['merchdeductenough'] = $merchdeductenough;
                }
            }
            $ch_order[$merchid]['price'] = $price;
        }

        return $ch_order;

    }

    //θ?‘η?θ?’εδΈ­ε€εζ·ζ»‘ι’ε
    function getMerchEnough($merch_array)
    {
        $merch_enough_total = 0;

        $merch_saleset = array();

        foreach ($merch_array as $key => $value) {
            $merchid = $key;
            if ($merchid > 0) {
                $enoughs = $value['enoughs'];

                if (!empty($enoughs)) {
                    $ggprice = $value['ggprice'];

                    foreach ($enoughs as $e) {
                        if ($ggprice >= floatval($e['enough']) && floatval($e['money']) > 0) {
                            $merch_array[$merchid]['showenough'] = 1;
                            $merch_array[$merchid]['enoughmoney'] = $e['enough'];
                            $merch_array[$merchid]['enoughdeduct'] = $e['money'];

                            $merch_saleset['merch_showenough'] = 1;
                            $merch_saleset['merch_enoughmoney'] += $e['enough'];
                            $merch_saleset['merch_enoughdeduct'] += $e['money'];

                            $merch_enough_total += floatval($e['money']);
                            break;
                        }
                    }
                }
            }
        }

        $data = array();
        $data['merch_array'] = $merch_array;
        $data['merch_enough_total'] = $merch_enough_total;
        $data['merch_saleset'] = $merch_saleset;

        return $data;
    }


    //ιͺθ―ζ―ε¦ζ―ζεειι
    function validate_city_express($address)
    {
        global $_W;

        $city_express_data = array(
            'state' => 0,//ζ―ε¦ζ―ζεειι
            'enabled' => 0,//ζ―ε¦εΌε―εειι
            'price' => 0,//εειιηθΏθ΄Ή
            'is_dispatch' => 1,//θΆεΊεεθε΄εζ―ε¦δ½Ώη¨εΏ«ι
        );

        $city_express = pdo_fetch("SELECT * FROM " . tablename('vending_machine_city_express') . " WHERE uniacid=:uniacid and merchid=0 limit 1", array(':uniacid' => $_W['uniacid']));
        //ζ²‘θ?Ύη½?εειιζθη¦η¨ζΆ
        if (!empty($city_express['enabled'])) {
            $city_express_data['enabled'] = 1;
            $city_express_data['is_dispatch'] = $city_express['is_dispatch'];//θΆεΊεεθε΄εζ―ε¦δΈθ½δΈε
            $city_express_data['is_sum'] = $city_express['is_sum'];//ε€δ»ΆεεζΆζ―ε¦η΄―ε 
            //ζι»θ?€ε°εζΆζ Ήζ?ε°ειθ§£ζη»ηΊ¬εΊ¦οΌε¦εδΈζ―ζ
            if (!empty($address)) {

//                if(empty($address['lng']) || empty($address['lat'])){
                //ζ²‘ζεζ ζΆη¨δΌεε°εε°ηιθ§£ζ
                $data = m('util')->geocode($address['province'] . $address['city'] . $address['area'] . $address['street'] . $address['address'], $city_express['geo_key']);
                if ($data['status'] == 1 && $data['count'] > 0) {
                    $location = explode(',', $data['geocodes'][0]['location']);
                    $addres = $address;
                    $addres['lng'] = $location[0];
                    $addres['lat'] = $location[1];
                    pdo_update('vending_machine_member_address', $addres, array('id' => $addres['id'], 'uniacid' => $_W['uniacid']));
                    $city_express_data = $this->compute_express_price($city_express, $location[0], $location[1]);
                }
//                }else{
//                   ε¦εη΄ζ₯η¨εζ 
//                    $city_express_data=$this->compute_express_price($city_express,$address['lng'],$address['lat']);
//                }
            }
        }

        return $city_express_data;
    }

    //θ?‘η?εειιδ»·ζ Ό
    function compute_express_price($city_express, $lng, $lat)
    {
        $city_express_data = array(
            'state' => 0,//ζ―ε¦ζ―ζεειι
            'enabled' => 1,//ζ―ε¦εΌε―εειι
            'price' => 0,//εειιηθΏθ΄Ή
            'is_dispatch' => $city_express['is_dispatch'],//θΆεΊεεθε΄εζ―ε¦δΈθ½δΈε
            'is_sum' => $city_express['is_sum']//ε€δ»ΆεεζΆζ―ε¦η΄―ε 
        );
        //θ?‘η?δΈ€η»εζ ηθ·η¦»
        $distance = m('util')->GetDistance($city_express['lat'], $city_express['lng'], $lat, $lng);
        //ζ²‘ζθΆεΊθε΄
        if ($distance < $city_express['range']) {
            $city_express_data['state'] = 1;
            //θ΅·ζ­₯θε΄ε
            if ($distance <= ($city_express['start_km'] * 1000)) {
                $city_express_data['price'] = round($city_express['start_fee'], 2);
            }
            //R1θε΄ε,θΆεΊθ΅·ζ­₯θε΄ε€ε°ε¬ιε,ζ―ε’ε 1ε¬ιε€ε°ι±
            if ($distance > ($city_express['start_km'] * 1000) && $distance <= ($city_express['start_km'] * 1000) + ($city_express['pre_km'] * 1000)) {
                $km = $distance - intval($city_express['start_km'] * 1000);//ε?ιθΆεΊθ΅·ζ­₯θε΄ηε¬ιζ°
                $city_express_data['price'] = round($city_express['start_fee'] + ($city_express['pre_km_fee'] * ceil($km / 1000)), 2);
            }
            //R2θε΄ε,θΆεΊε€ε°ε¬ιοΌεΊε?δ»·ζ Όε€ε°ι±
            if ($distance >= ($city_express['fixed_km'] * 1000)) {
                $city_express_data['price'] = round($city_express['fixed_fee'], 2);
            }
        }

        return $city_express_data;
    }

    //θ?‘η?θ?’εεεζ»θΏθ΄Ή
    function getOrderDispatchPrice($goods, $member, $address, $saleset = false, $merch_array, $t, $loop = 0)
    {
        global $_W;
        global $_GPC;

        $area_set = m('util')->get_area_config_set();
        $new_area = intval($area_set['new_area']);

        $realprice = 0;
        $dispatch_price = 0;
        $dispatch_array = array();
        $dispatch_merch = array();
        $total_array = array();
        $totalprice_array = array();
        $nodispatch_array = array();
        $goods_num = count($goods);

        $seckill_payprice = 0;  //η§ζηιι’
        $seckill_dispatchprice = 0; //η§ζηι?θ΄Ή

        $user_city = '';
        $user_city_code = '';

        if (empty($new_area)) {
            if (!empty($address)) {
                $user_city = $user_city_code = $address['city'];
            } else if (!empty($member['city'])) {

                if (!strexists($member['city'], 'εΈ')) {
                    $member['city'] = $member['city'] . 'εΈ';
                }
                $user_city = $user_city_code = $member['city'];
            }
        } else {
            if (!empty($address)) {
                $user_city = $address['city'] . $address['area'];
                $user_city_code = $address['datavalue'];
            }
        }

        $is_merchid = 0;//ζ―ε¦ζε€εζ·εε
        foreach ($goods as $g) {
            $realprice += $g['ggprice'];
            $dispatch_merch[$g['merchid']] = 0;
            $total_array[$g['goodsid']] += $g['total'];
            $totalprice_array[$g['goodsid']] += $g['ggprice'];
            if (!empty($g['merchid'])) {
                $is_merchid = 1;
            }
        }

        $city_express_data['state'] = 0;//ζ―ε¦ζ―ζεειι0δΈΊδΈζ―ζ
        $city_express_data['enabled'] = 0;//ζ―ε¦εΌε―εειι0δΈΊζͺεΌε―
        $city_express_data['is_dispatch'] = 1;//θΆεΊεεθε΄εζ―ε¦δ½Ώη¨εΏ«ι
        //ε€ζ­ζ―ε¦ζ―ζεειιοΌε€εζ·θ?’εδΈθθ
        if ($is_merchid == 0) {
            $city_express_data = $this->validate_city_express($address);
        }
        $goods_dispatch = array();
        foreach ($goods as $g) {
            //η§ζ
            $seckillinfo = plugin_run('seckill::getSeckill', $g['goodsid'], $g['optionid'], true, $_W['openid']);

            if ($seckillinfo && $seckillinfo['status'] == 0) {
                $seckill_payprice += $g['ggprice'];
            }

            //δΈιιηΆζ 0ιι 1δΈιι
            $isnodispatch = 0;

            //ζ―ε¦ει?
            $sendfree = false;
            $merchid = $g['merchid'];

            if ($g['type'] == 5) {
                $sendfree = true;
            }

            if (!empty($g['issendfree'])) { //ζ¬θΊ«ει?
                $sendfree = true;

            } else {

                if ($seckillinfo && $seckillinfo['status'] == 0) {
                    //η§ζδΈεδΈζ»‘δ»Άει?
                } else {

                    if ($total_array[$g['goodsid']] >= $g['ednum'] && $g['ednum'] > 0) { //εεζ»‘δ»Άει?

                        if (empty($new_area)) {
                            $gareas = explode(";", $g['edareas']);
                        } else {
                            $gareas = explode(";", $g['edareas_code']);
                        }

                        if (empty($gareas)) {
                            $sendfree = true;
                        } else {
                            if (!empty($address)) {
                                if (!in_array($user_city_code, $gareas)) {
                                    $sendfree = true;
                                }
                            } else if (!empty($member['city'])) {
                                if (!in_array($member['city'], $gareas)) {
                                    $sendfree = true;
                                }
                            } else {
                                $sendfree = true;
                            }
                        }
                    }
                }


                if ($seckillinfo && $seckillinfo['status'] == 0) {
                    //η§ζδΈεδΈζ»‘ι’ει?
                } else {
                    if ($totalprice_array[$g['goodsid']] >= floatval($g['edmoney']) && floatval($g['edmoney']) > 0) { //εεζ»‘ι’ει?

                        if (empty($new_area)) {
                            $gareas = explode(";", $g['edareas']);
                        } else {
                            $gareas = explode(";", $g['edareas_code']);
                        }

                        if (empty($gareas)) {
                            $sendfree = true;
                        } else {
                            if (!empty($address)) {
                                if (!in_array($user_city_code, $gareas)) {
                                    $sendfree = true;
                                }
                            } else if (!empty($member['city'])) {
                                if (!in_array($member['city'], $gareas)) {
                                    $sendfree = true;
                                }
                            } else {
                                $sendfree = true;
                            }
                        }
                    }
                }

            }


            //θ―»εεΏ«ιδΏ‘ζ―
            if ($g['dispatchtype'] == 1) {
                //δ½Ώη¨η»δΈι?θ΄Ή
                //δΈζ―ζεειι
                if ($city_express_data['state'] == 0 && $city_express_data['is_dispatch'] == 1) {

                    $flag = false;
                    $retarr = $this->filterGoods($saleset, $realprice, $seckill_payprice, $goods, $user_city_code, $new_area);
                    foreach ($retarr as $v) {
                        if (in_array($g["goodsid"], $v)) {
                            $flag = true;
                            break;
                        }
                    }
                    if ($flag) {
                        continue;
                    }
                    //ζ―ε¦θ?Ύη½?δΊδΈιιεεΈ
                    if (!empty($user_city)) {
                        if (empty($new_area)) {
                            $citys = m('dispatch')->getAllNoDispatchAreas();
                        } else {
                            $citys = m('dispatch')->getAllNoDispatchAreas('', 1);
                        }

                        if (!empty($citys)) {
                            if (in_array($user_city_code, $citys) && !empty($citys)) {
                                //ε¦ζζ­€ζ‘εε«δΈιιεεΈ
                                $isnodispatch = 1;

                                $has_goodsid = 0;
                                if (!empty($nodispatch_array['goodid'])) {
                                    if (in_array($g['goodsid'], $nodispatch_array['goodid'])) {
                                        $has_goodsid = 1;
                                    }
                                }

                                if ($has_goodsid == 0) {
                                    $nodispatch_array['goodid'][] = $g['goodsid'];
                                    $nodispatch_array['title'][] = $g['title'];
                                    $nodispatch_array['city'] = $user_city;
                                }
                            }
                        }
                    }

                    if ($g['dispatchprice'] > 0 && !$sendfree && $isnodispatch == 0) {
                        //εΊε?θΏθ΄ΉδΈη΄―θ?‘
                        $dispatch_merch[$merchid] += $g['dispatchprice'];
                        if ($seckillinfo && $seckillinfo['status'] == 0) {
                            $goods_dispatch[$g['goodsid']] = $g['dispatchprice'];
                            $seckill_dispatchprice += $g['dispatchprice'];
                        } else {
                            $goods_dispatch[$g['goodsid']] = $g['dispatchprice'];
                            $dispatch_price += $g['dispatchprice'];
                        }
                    }

                    //ζ―ζεειι
                } else {

                    if ($city_express_data['state'] == 1) {
                        if ($g['dispatchprice'] > 0 && !$sendfree) {
                            //ε€δ»ΆεεζΆζ―ε¦η΄―ε 
                            if ($city_express_data['is_sum'] == 1) {
                                $goods_dispatch[$g['goodsid']] = $g['dispatchprice'];
                                $dispatch_price += $g['dispatchprice'];
                            } else {
                                //δΈη΄―ε ζΆοΌεθΏθ΄Ήζε€§εΌ
                                if ($dispatch_price < $g['dispatchprice']) {
                                    $dispatch_price = $g['dispatchprice'];
                                }
                            }
                        }
                    } else {
                        $nodispatch_array['goodid'][] = $g['goodsid'];
                        $nodispatch_array['title'][] = $g['title'];
                        $nodispatch_array['city'] = $user_city;
                    }
                }

            } else if ($g['dispatchtype'] == 0) {
                //δ½Ώη¨εΏ«ιζ¨‘ζΏ

                //δΈζ―ζεειι
                if ($city_express_data['state'] == 0 && $city_express_data['is_dispatch'] == 1) {
                    if (empty($g['dispatchid'])) {
                        //ι»θ?€εΏ«ι
                        $dispatch_data = m('dispatch')->getDefaultDispatch($merchid);
                    } else {
                        $dispatch_data = m('dispatch')->getOneDispatch($g['dispatchid']);
                    }

                    if (empty($dispatch_data)) {
                        //ζζ°ηδΈζ‘εΏ«ιδΏ‘ζ―
                        $dispatch_data = m('dispatch')->getNewDispatch($merchid);
                    }

                    //ζ―ε¦θ?Ύη½?δΊδΈιιεεΈ
                    if (!empty($dispatch_data)) {
                        $isnoarea = 0;

                        $dkey = $dispatch_data['id'];
                        $isdispatcharea = intval($dispatch_data['isdispatcharea']);

//                    print_r($isdispatcharea);exit;

                        if (!empty($user_city)) {

                            if (empty($isdispatcharea)) {
                                if (empty($new_area)) {
                                    $citys = m('dispatch')->getAllNoDispatchAreas($dispatch_data['nodispatchareas']);
                                } else {
                                    $citys = m('dispatch')->getAllNoDispatchAreas($dispatch_data['nodispatchareas_code'], 1);
                                }

                                if (!empty($citys)) {
                                    if (in_array($user_city_code, $citys)) {
                                        //ε¦ζζ­€ζ‘εε«δΈιιεεΈ
                                        $isnoarea = 1;
                                    }
                                }
                            } else {
                                if (empty($new_area)) {
                                    $citys = m('dispatch')->getAllNoDispatchAreas();
                                } else {
                                    $citys = m('dispatch')->getAllNoDispatchAreas('', 1);
                                }

                                if (!empty($citys)) {
                                    if (in_array($user_city_code, $citys)) {
                                        //ε¦ζζ­€ζ‘εε«ε¨ε±δΈιιεεΈ
                                        $isnoarea = 1;
                                    }
                                }

                                if (empty($isnoarea)) {
                                    $isnoarea = m('dispatch')->checkOnlyDispatchAreas($user_city_code, $dispatch_data);
                                }
                            }

                            if (!empty($isnoarea)) {
                                //εε«δΈιιεεΈ
                                $isnodispatch = 1;

                                $has_goodsid = 0;
                                if (!empty($nodispatch_array['goodid'])) {
                                    if (in_array($g['goodsid'], $nodispatch_array['goodid'])) {
                                        $has_goodsid = 1;
                                    }
                                }
                                if ($has_goodsid == 0) {
                                    $nodispatch_array['goodid'][] = $g['goodsid'];
                                    $nodispatch_array['title'][] = $g['title'];
                                    $nodispatch_array['city'] = $user_city;
                                }
                            }
                        }

                        if (!$sendfree && $isnodispatch == 0) {
                            //modify by wangguigang
                            $flag = false;
                            $retarr = $this->filterGoods($saleset, $realprice, $seckill_payprice, $goods, $user_city_code, $new_area);
                            foreach ($retarr as $v) {
                                if (in_array($g["goodsid"], $v)) {
                                    $flag = true;
                                    break;
                                }
                            }
                            if ($flag) {
                                continue;
                            }

                            //ιιεΊε
                            $areas = unserialize($dispatch_data['areas']);
                            if ($dispatch_data['calculatetype'] == 1) {
                                //ζδ»Άθ?‘θ΄Ή
                                $param = $g['total'];
                            } else {
                                //ζιιθ?‘θ΄Ή
                                $param = $g['weight'] * $g['total'];
                            }
                            if (array_key_exists($dkey, $dispatch_array)) {
                                $dispatch_array[$dkey]['param'] += $param;
                            } else {
                                $dispatch_array[$dkey]['data'] = $dispatch_data;
                                $dispatch_array[$dkey]['param'] = $param;
                            }
                            if ($seckillinfo && $seckillinfo['status'] == 0) {
                                if (array_key_exists($dkey, $dispatch_array)) {
                                    $dispatch_array[$dkey]['seckillnums'] += $param;
                                } else {
                                    $dispatch_array[$dkey]['seckillnums'] = $param;
                                }
                            }
                            $dispatch_array[$dkey]['goodsid'] = $g['goodsid'];
                        }
                    }
                    //ζ―ζεειι
                } else {
                    if ($city_express_data['state'] == 1) {
                        if (!$sendfree) {
                            //ε€δ»ΆεεζΆζ―ε¦η΄―ε 
                            if ($city_express_data['is_sum'] == 1) {
                                $goods_dispatch[$g['goodsid']] = ($city_express_data['price'] * $g['total']);
                                $dispatch_price += ($city_express_data['price'] * $g['total']);
                            } else {
                                //δΈη΄―ε ζΆοΌεθΏθ΄Ήζε€§εΌ
                                if ($dispatch_price < $city_express_data['price']) {
                                    $dispatch_price = $city_express_data['price'];
                                }
                            }
                        }
                    } else {
                        $nodispatch_array['goodid'][] = $g['goodsid'];
                        $nodispatch_array['title'][] = $g['title'];
                        $nodispatch_array['city'] = $user_city;
                    }
                }
            }
        }

        //ζεζ―θΎζ¨‘ηεΏ«ιεεεθΏθ΄Ήεζε€§εΌοΌδ½Ώη¨εΏ«ιζ¨‘ηηζΆεζζ―θΎ
        if ($city_express_data['state'] == 1 && $g['dispatchtype'] == 0) {
            //δΈη΄―ε ζΆοΌεθΏθ΄Ήζε€§εΌ
            if ($city_express_data['is_sum'] == 0 && $dispatch_price < $city_express_data['price']) {
                $dispatch_price = $city_express_data['price'];
            }
        }

        if (!empty($dispatch_array)) {

            $dispatch_info = array();

            foreach ($dispatch_array as $k => $v) {
                $dispatch_data = $dispatch_array[$k]['data'];
                $param = $dispatch_array[$k]['param'];
                $areas = unserialize($dispatch_data['areas']);

                if (!empty($address)) {
                    //η¨ζ·ζι»θ?€ε°ε
                    $dprice = m('dispatch')->getCityDispatchPrice($areas, $address, $param, $dispatch_data);
                    //θ·εε½εε°εε¨εͺδΈδΈͺθΏθ΄ΉεΊι΄  auth: sunchao
                    $freeprice = m('dispatch')->getCityfreepricePrice($areas, $address);
                    if ($freeprice > 0) {
                        $dispatch_data['freeprice'] = $freeprice;
                    }
                }
//                else if (!empty($member['city'])) {
//                    //θ?Ύη½?δΊεεΈιθ¦ε€ζ­εΊεθ?Ύη½?
//                    $dprice = m('dispatch')->getCityDispatchPrice($areas, $member, $param, $dispatch_data);
//                }
                else {
                    //ε¦ζδΌεθΏζͺθ?Ύη½?εεΈ οΌι»θ?€ι?θ΄Ή
                    $dprice = m('dispatch')->getDispatchPrice($param, $dispatch_data);
                }
                $goods_dispatch[$v['goodsid']] = $dprice;

                $merchid = $dispatch_data['merchid'];
                $dispatch_merch[$merchid] += $dprice;

                if ($v['seckillnums'] > 0) {
                    $seckill_dispatchprice += $dprice;
                } else {
                    $dispatch_price += $dprice;
                }
                $dispatch_info[$dispatch_data['id']]['price'] += $dprice;
                $dispatch_info[$dispatch_data['id']]['freeprice'] = intval($dispatch_data['freeprice']);
            }
            if (!empty($dispatch_info)) {
                foreach ($dispatch_info as $k => $v) {
                    if ($v['freeprice'] > 0 && $v['price'] >= $v['freeprice']) {
                        $dispatch_price -= $v['price'];
                    }
                }
                if ($dispatch_price < 0) {
                    $dispatch_price = 0;
                }
            }
        }
        //ε€ζ­ε€εζ·ζ―ε¦ζ»‘ι’ει?
        if (!empty($merch_array)) {

            foreach ($merch_array as $key => $value) {
                $merchid = $key;

                if ($merchid > 0) {
                    $merchset = $value['set'];
                    if (!empty($merchset['enoughfree'])) {
                        if (floatval($merchset['enoughorder']) <= 0) {
                            $dispatch_price = $dispatch_price - $dispatch_merch[$merchid];
                            $dispatch_merch[$merchid] = 0;
                        } else {
                            if ($merch_array[$merchid]['ggprice'] >= floatval($merchset['enoughorder'])) {
                                //θ?’εε€§δΊθ?Ύε?ηει?ιι’
                                if (empty($merchset['enoughareas'])) {
                                    //ε¦ζδΈιεΆεΊεοΌει?
                                    $dispatch_price = $dispatch_price - $dispatch_merch[$merchid];
                                    $dispatch_merch[$merchid] = 0;
                                } else {
                                    //ε¦ζιεΆεΊε
                                    $areas = explode(";", $merchset['enoughareas']);
                                    if (!empty($address)) {
                                        if (!in_array($address['city'], $areas)) {
                                            $dispatch_price = $dispatch_price - $dispatch_merch[$merchid];
                                            $dispatch_merch[$merchid] = 0;
                                        }
                                    } else if (!empty($member['city'])) {
                                        //θ?Ύη½?δΊεεΈιθ¦ε€ζ­εΊεθ?Ύη½?
                                        if (!in_array($member['city'], $areas)) {
                                            $dispatch_price = $dispatch_price - $dispatch_merch[$merchid];
                                            $dispatch_merch[$merchid] = 0;
                                        }
                                    } else if (empty($member['city'])) {
                                        //ε¦ζδΌεθΏζͺθ?Ύη½?εεΈ οΌι»θ?€ι?θ΄Ή
                                        $dispatch_price = $dispatch_price - $dispatch_merch[$merchid];
                                        $dispatch_merch[$merchid] = 0;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($dispatch_price == 0) {
            foreach ($dispatch_merch as &$dm) {
                $dm = 0;
            }
            unset($dm);
        }

        if (!empty($nodispatch_array) && !empty($address)) {
            $nodispatch = 'εεβ ';
            foreach ($nodispatch_array['title'] as $k => $v) {
                $nodispatch .= $v . ',';
            }
            $nodispatch = trim($nodispatch, ',');
            $nodispatch .= ' βδΈζ―ζιιε°' . $nodispatch_array['city'];
            $nodispatch_array['nodispatch'] = $nodispatch;
            $nodispatch_array['isnodispatch'] = 1;
        }


        $data = array();
        $data['dispatch_price'] = $dispatch_price + $seckill_dispatchprice;
        $data['dispatch_merch'] = $dispatch_merch;
        $data['nodispatch_array'] = $nodispatch_array;
        $data['seckill_dispatch_price'] = $seckill_dispatchprice;
        $data['city_express_state'] = $city_express_data['state'];
        $data['goods_dispatch'] = $goods_dispatch;

        return $data;
    }

    //η­ιδΈεε ζ»‘ι’ι?ηεε
    function filterGoods($saleset, $realprice, $seckill_payprice, $goods, $user_city_code, $new_area)
    {
        $new_goods = array();
        //θ₯ιε?ζ»‘ι’ει?
        if ($saleset) {

            if (!empty($saleset['enoughfree'])) {

                //ζ―ε¦ζ»‘θΆ³θ₯ιε?ζ»‘ι’ει?
                $saleset_free = 0;


                if (floatval($saleset['enoughorder']) <= 0) {
                    $saleset_free = 1;
                } else {

                    if ($realprice - $seckill_payprice >= floatval($saleset['enoughorder'])) {
                        //θ?’εε€§δΊθ?Ύε?ηει?ιι’
                        if (empty($saleset['enoughareas'])) {
                            //ε¦ζδΈιεΆεΊεοΌει?
                            $saleset_free = 1;
                        } else {
                            //ε¦ζιεΆεΊε
                            if (empty($new_area)) {
                                $areas = explode(";", trim($saleset['enoughareas'], ";"));
                            } else {
                                $areas = explode(";", trim($saleset['enoughareas_code'], ";"));
                            }
                            if (!empty($user_city_code)) {
                                if (!in_array($user_city_code, $areas)) {
                                    $saleset_free = 1;
                                }
                            }


                        }
                    }
                }
                if ($saleset_free == 1) {
                    $is_nofree = 0;
                    if (!empty($saleset['goodsids'])) {
                        foreach ($goods as $k => $v) {
                            if (!in_array($v['goodsid'], $saleset['goodsids'])) {
                                $new_goods[$k] = $goods[$k];
                                unset($goods[$k]);
                            } else {
                                $is_nofree = 1;
                            }
                        }
                    } else {
                        $new_goods = $goods;
                    }

                }
            }
        }
        return $new_goods;

    }

    //δΏ?ζΉζ»θ?’εηδ»·ζ Ό
    function changeParentOrderPrice($parent_order)
    {
        global $_W;

        $id = $parent_order['id'];
        $item = pdo_fetch("SELECT price,ordersn2,dispatchprice,changedispatchprice FROM " . tablename('vending_machine_order') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));

        if (!empty($item)) {
            $orderupdate = array();
            $orderupdate['price'] = $item['price'] + $parent_order['price_change'];
            $orderupdate['ordersn2'] = $item['ordersn2'] + 1;

            $orderupdate['dispatchprice'] = $item['dispatchprice'] + $parent_order['dispatch_change'];
            $orderupdate['changedispatchprice'] = $item['changedispatchprice'] + $parent_order['dispatch_change'];

            if (!empty($orderupdate)) {
                pdo_update('vending_machine_order', $orderupdate, array('id' => $id, 'uniacid' => $_W['uniacid']));
            }
        }
    }

    //θ?‘η?θ?’εδΈ­ηδ½£ι
    function getOrderCommission($orderid, $agentid = 0)
    {
        global $_W;

        if (empty($agentid)) {
            $item = pdo_fetch('select agentid from ' . tablename('vending_machine_order') . ' where id=:id and uniacid=:uniacid Limit 1', array('id' => $orderid, ':uniacid' => $_W['uniacid']));
            if (!empty($item)) {
                $agentid = $item['agentid'];
            }
        }

        $level = 0;
        $pc = p('commission');
        if ($pc) {
            $pset = $pc->getSet();
            $level = intval($pset['level']);
        }

        $commission1 = 0;
        $commission2 = 0;
        $commission3 = 0;
        $m1 = false;
        $m2 = false;
        $m3 = false;
        if (!empty($level)) {
            if (!empty($agentid)) {
                $m1 = m('member')->getMember($agentid);
                if (!empty($m1['agentid'])) {
                    $m2 = m('member')->getMember($m1['agentid']);
                    if (!empty($m2['agentid'])) {
                        $m3 = m('member')->getMember($m2['agentid']);
                    }
                }
            }
        }

        //θ?’εεε
        $order_goods = pdo_fetchall('select g.id,g.title,g.thumb,g.goodssn,og.goodssn as option_goodssn, g.productsn,og.productsn as option_productsn, og.total,og.price,og.optionname as optiontitle, og.realprice,og.changeprice,og.oldprice,og.commission1,og.commission2,og.commission3,og.commissions,og.diyformdata,og.diyformfields from ' . tablename('vending_machine_order_goods') . ' og '
            . ' left join ' . tablename('vending_machine_goods') . ' g on g.id=og.goodsid '
            . ' where og.uniacid=:uniacid and og.orderid=:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));

        foreach ($order_goods as &$og) {

            if (!empty($level) && !empty($agentid)) {
                $commissions = iunserializer($og['commissions']);
                if (!empty($m1)) {
                    if (is_array($commissions)) {
                        $commission1 += isset($commissions['level1']) ? floatval($commissions['level1']) : 0;
                    } else {
                        $c1 = iunserializer($og['commission1']);
                        $l1 = $pc->getLevel($m1['openid']);
                        $commission1 += isset($c1['level' . $l1['id']]) ? $c1['level' . $l1['id']] : $c1['default'];
                    }
                }
                if (!empty($m2)) {
                    if (is_array($commissions)) {
                        $commission2 += isset($commissions['level2']) ? floatval($commissions['level2']) : 0;
                    } else {
                        $c2 = iunserializer($og['commission2']);
                        $l2 = $pc->getLevel($m2['openid']);
                        $commission2 += isset($c2['level' . $l2['id']]) ? $c2['level' . $l2['id']] : $c2['default'];
                    }
                }
                if (!empty($m3)) {
                    if (is_array($commissions)) {
                        $commission3 += isset($commissions['level3']) ? floatval($commissions['level3']) : 0;
                    } else {
                        $c3 = iunserializer($og['commission3']);
                        $l3 = $pc->getLevel($m3['openid']);
                        $commission3 += isset($c3['level' . $l3['id']]) ? $c3['level' . $l3['id']] : $c3['default'];
                    }
                }
            }
        }
        unset($og);

        $commission = $commission1 + $commission2 + $commission3;

        return $commission;
    }


    //ζ£ζ₯θ?’εδΈ­ζ―ε¦ζδΈζΆεε
    function checkOrderGoods($orderid)
    {

        global $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_W['openid'];
        $member = m('member')->getMember($openid);

        $flag = 0;
        $msg = 'θ?’εδΈ­ηεε' . '<br/>';
        $uniacid = $_W['uniacid'];
        $ispeerpay = m('order')->checkpeerpay($orderid);//ζ£ζ₯ζ―ε¦ζ―δ»£δ»θ?’ε

        $item = pdo_fetch("select * from " . tablename('vending_machine_order') . "  where  id = :id and uniacid=:uniacid limit 1", array(":id" => $orderid, ":uniacid" => $uniacid));

        if ((empty($order['isnewstore']) || empty($order['storeid'])) && empty($order['istrade'])) {

            $order_goods = pdo_fetchall('select og.id,g.title, og.goodsid,og.optionid,g.total as stock,og.total as buycount,g.status,g.deleted,g.maxbuy,g.usermaxbuy,g.istime,g.timestart,g.timeend,g.buylevels,g.buygroups,g.totalcnf,og.seckill from  ' . tablename('vending_machine_order_goods') . ' og '
                . ' left join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id '
                . ' where og.orderid=:orderid and og.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));


            foreach ($order_goods as $data) {
                if (empty($data['status']) || !empty($data['deleted'])) {
                    $flag = 1;
                    $msg .= $data['title'] . '<br/> ε·²δΈζΆ,δΈθ½δ»ζ¬Ύ!!';
                }

                $unit = empty($data['unit']) ? 'δ»Ά' : $data['unit'];
                $seckillinfo = plugin_run("seckill::getSeckill", $data['goodsid'], $data['optionid'], true, $_W['openid']);
                if ($seckillinfo && $seckillinfo['status'] == 0 || !empty($ispeerpay)) {
                    //ε¦ζζ―η§ζοΌδΈε€ζ­δ»»δ½ζ‘δ»Ά//δ»£δ»θ?’εδΉδΈε€ζ­
                } else {
                    if ($data['totalcnf'] == 1) {
                        if (!empty($data['optionid'])) {
                            $option = pdo_fetch('select id,title,marketprice,goodssn,productsn,stock,`virtual` from ' . tablename('vending_machine_goods_option') . ' where id=:id and goodsid=:goodsid and uniacid=:uniacid  limit 1', array(':uniacid' => $uniacid, ':goodsid' => $data['goodsid'], ':id' => $data['optionid']));
                            if (!empty($option)) {
                                if ($option['stock'] != -1) {
                                    if (empty($option['stock'])) {
                                        $flag = 1;
                                        $msg .= $data['title'] . "<br/>" . $option['title'] . " εΊε­δΈθΆ³!";
                                    }
                                }
                            }
                        } else {
                            if ($data['stock'] != -1) {
                                if (empty($data['stock'])) {
                                    $flag = 1;
                                    $msg .= $data['title'] . "<br/>εΊε­δΈθΆ³!";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if (p('newstore')) {
                $sql = "select g.id,g.title,ng.gstatus,g.deleted"
                    . " from " . tablename('vending_machine_order_goods') . " og left join  " . tablename('vending_machine_goods') . " g  on g.id=og.goodsid and g.uniacid=og.uniacid"
                    . " inner join " . tablename('vending_machine_newstore_goods') . " ng on ng.goodsid = g.id AND ng.storeid=" . $item['storeid']
                    . " where og.orderid=:orderid and og.uniacid=:uniacid";
                $list = pdo_fetchall($sql, array(':uniacid' => $uniacid, ':orderid' => $orderid));

                if (!empty($list)) {
                    foreach ($list as $k => $v) {
                        if (empty($v['gstatus']) || !empty($v['deleted'])) {
                            $flag = 1;
                            $msg .= $v['title'] . '<br/>';
                        }
                    }
                    if ($flag == 1) {
                        $msg .= 'ε·²δΈζΆ,δΈθ½δ»ζ¬Ύ!';
                    }
                }
            } else {
                $flag = 1;
                $msg .= 'ι¨εΊζ­δΈ,δΈθ½δ»ζ¬Ύ!';
            }

        }


        $data = array();
        $data['flag'] = $flag;
        $data['msg'] = $msg;

        return $data;
    }

    public function checkpeerpay($orderid)
    {//ζ₯θ―’ζ―ε¦ζ―δ»£δ»θ?’ε,ε¦ζδΈζ―θΏεfalse,ε¦ζζ―θΏεδ»£δ»θ?’εεε?Ή
        global $_W;
        $sql = "SELECT p.*,o.openid FROM " . tablename('vending_machine_order_peerpay') . " AS p JOIN " . tablename('vending_machine_order') . " AS o ON p.orderid = o.id WHERE p.orderid = :orderid AND p.uniacid = :uniacid AND (p.status = 0 OR p.status=1) AND o.status >= 0 LIMIT 1";
        $query = pdo_fetch($sql, array(':orderid' => $orderid, ':uniacid' => $_W['uniacid']));
        return $query;
    }

    public function peerStatus($param)
    {
        global $_W;
        if (!empty($param['tid'])) {
            $sql = "SELECT id FROM " . tablename('vending_machine_order_peerpay_payinfo') . " WHERE tid = :tid";
            $id = pdo_fetchcolumn($sql, array(':tid' => $param['tid']));
            if ($id) return $id;
        }
        pdo_insert('vending_machine_order_peerpay_payinfo', $param);
        $insterid = pdo_insertid();
        if ($insterid) {
            return $insterid;
        } else {
            return false;
        }
    }

    //ζ₯θ―’θ?’εθ?°ζ¬‘ζΆεεζ―ε¦ε―δ»₯ι’εζ Έιε‘
    public function getVerifyCardNumByOrderid($orderid)
    {
        global $_W;
        $num = pdo_fetchcolumn('select SUM(og.total)  from ' . tablename('vending_machine_order_goods') . ' og
		 inner join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		 where og.uniacid=:uniacid  and og.orderid =:orderid and g.cardid>0', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));

        return $num;
    }

    //ε€ζ­ζ―ε¦ζ―ηΊ―θ?°ζ¬‘ζΆεεθ?’ε
    public function checkisonlyverifygoods($orderid)
    {
        global $_W;
        $num = pdo_fetchcolumn('select COUNT(1)  from ' . tablename('vending_machine_order_goods') . ' og
		 inner join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		 where og.uniacid=:uniacid  and og.orderid =:orderid and g.type<>5', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));


        $num = intval($num);
        if ($num > 0) {
            return false;
        } else {
            $num2 = pdo_fetchcolumn('select COUNT(1)  from ' . tablename('vending_machine_order_goods') . ' og
             inner join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
             where og.uniacid=:uniacid  and og.orderid =:orderid and g.type=5', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
            $num2 = intval($num2);

            if ($num2 > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    //ε€ζ­ζ―ε¦εε«θ?°ζ¬‘ζΆεε
    public function checkhaveverifygoods($orderid)
    {
        global $_W;
        $num = pdo_fetchcolumn('select COUNT(1)  from ' . tablename('vending_machine_order_goods') . ' og
		 inner join ' . tablename('vending_machine_goods') . ' g on og.goodsid = g.id
		 where og.uniacid=:uniacid  and og.orderid =:orderid and g.type=5', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));

        $num = intval($num);
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ε€ζ­θ?’εζ―ε¦εε«ε­ε¨ζ Έιθ?°ε½ηθ?°ζ¬‘ζΆεε
    public function checkhaveverifygoodlog($orderid)
    {
        global $_W;
        $num = pdo_fetchcolumn('select COUNT(1)  from ' . tablename('vending_machine_verifygoods_log') . ' vl
		 inner join ' . tablename('vending_machine_verifygoods') . ' v on vl.verifygoodsid = v.id
		 where v.uniacid=:uniacid  and v.orderid =:orderid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));

        $num = intval($num);
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function countOrdersn($ordersn, $str = "TR")
    {
        global $_W;

        $count = intval(substr_count($ordersn, $str));
        return $count;
    }

    /**
     * θ·εθ?’εηθζε‘ε―δΏ‘ζ―
     * @param array $order
     * @return bool
     */
    public function getOrderVirtual($order = array())
    {
        global $_W;

        if (empty($order)) {
            return false;
        }

        if (empty($order['virtual_info'])) {
            return $order['virtual_str'];
        }

        $ordervirtual = array();
        $virtual_type = pdo_fetch('select fields from ' . tablename('vending_machine_virtual_type') . ' where id=:id and uniacid=:uniacid and merchid = :merchid limit 1 ', array(':id' => $order['virtual'], ':uniacid' => $_W['uniacid'], ':merchid' => $order['merchid']));
        if (!empty($virtual_type)) {
            $virtual_type = iunserializer($virtual_type['fields']);
            $virtual_info = ltrim($order['virtual_info'], '[');
            $virtual_info = rtrim($virtual_info, ']');
            $virtual_info = explode(',', $virtual_info);

            if (!empty($virtual_info)) {
                foreach ($virtual_info as $index => $virtualinfo) {
                    $virtual_temp = iunserializer($virtualinfo);
                    if (!empty($virtual_temp)) {
                        foreach ($virtual_temp as $k => $v) {
                            $ordervirtual[$index][] = array(
                                'key' => $virtual_type[$k],
                                'value' => $v,
                                'field' => $k
                            );
                        }
                        unset($k, $v);
                    }
                }
                unset($index, $virtualinfo);
            }
        }

        return $ordervirtual;
    }

    //////////////////////////////////////θΎΎθΎΎζ₯ε£ηΈε³

    /**
     * η­Ύεηζsignature
     */
    public function dada_sign($data, $app_secret)
    {
        //1.εεΊζεΊ
        ksort($data);
        //2.ε­η¬¦δΈ²ζΌζ₯
        $args = "";
        foreach ($data as $key => $value) {
            $args .= $key . $value;
        }
        $args = $app_secret . $args . $app_secret;//θΎΎθΎΎεΌεθapp_secret
        //3.MD5η­Ύε,θ½¬δΈΊε€§ε
        $sign = strtoupper(md5($args));
        return $sign;
    }


    /**
     * ζι θ―·ζ±ζ°ζ?
     * data:δΈε‘εζ°οΌjsonε­η¬¦δΈ²
     */
    public function dada_bulidRequestParams($data, $app_key, $source_id, $app_secret)
    {
        $requestParams = array();
        $requestParams['app_key'] = $app_key;//θΎΎθΎΎεΌεθapp_key
        $requestParams['source_id'] = $source_id;//εζ·ID
        $requestParams['body'] = json_encode($data);
        $requestParams['format'] = 'json';
        $requestParams['v'] = '1.0';
        $requestParams['timestamp'] = time();
        $requestParams['signature'] = $this->dada_sign($requestParams, $app_secret);
        return $requestParams;
    }

    /**
     * θ·εθΎΎθΎΎηιιεεΈδΏ‘ζ―
     */
    public function getdadacity()
    {
        //ζ΅θ―ζ₯ε£ε°ε
//        $url = 'http://newopen.qa.imdada.cn/api/cityCode/list';
        //ζ­£εΌζ₯ε£ε°ε
        $url = 'http://newopen.imdada.cn/api/cityCode/list';
        $app_key = '';
        $source_id = '73753'; // ζ΅θ―η;
        $app_secret = '';
        $reqParams = $this->dada_bulidRequestParams('', $app_key, $source_id, $app_secret);
        load()->func('communication');
        $resp = ihttp_request($url, json_encode($reqParams), array('Content-Type' => 'application/json'));
        $ret = @json_decode($resp['content'], true);
        return $ret;
    }


    public function dada_send($order)
    {
        global $_W;

        //ζ΅θ―ζ₯ε£ε°ε
//        $url = 'http://newopen.qa.imdada.cn/api/order/addOrder';
        //ζ­£εΌζ₯ε£ε°ε
        $url = 'http://newopen.imdada.cn/api/order/addOrder';

        $cityexpress = pdo_fetch("SELECT * FROM " . tablename('vending_machine_city_express') . " WHERE uniacid=:uniacid AND merchid=:merchid", array(":uniacid" => $_W['uniacid'], ":merchid" => 0));
        if (!empty($cityexpress)) {
            $config = unserialize($cityexpress['config']);

            //ε¦ζζ―θΎΎθΎΎ
            if ($cityexpress['express_type'] == 1) {
                $app_key = $config['app_key'];
                $app_secret = $config['app_secret'];
                $source_id = $config['source_id'];
                $shop_no = $config['shop_no'];
                $city_code = $config['city_code'];
                $receiver = unserialize($order['address']);

                $location_data = m('util')->geocode($receiver['province'] . $receiver['city'] . $receiver['area'] . $receiver['address'], $cityexpress['geo_key']);
                if ($location_data['status'] == 1 && $location_data['count'] > 0) {
                    $location = explode(',', $location_data['geocodes'][0]['location']);

                    $data = array(
                        'shop_no' => $shop_no,//ι¨εΊηΌε·οΌι¨εΊεε»Ίεε―ε¨ι¨εΊεθ‘¨εει‘΅ζ₯η
                        'city_code' => $city_code,//θ?’εζε¨εεΈηcode

                        'origin_id' => $order['ordersn'],//	η¬¬δΈζΉθ?’εID
                        'info' => $order['remark'],//θ?’εε€ζ³¨
                        'cargo_price' => $order['price'],//θ?’ειι’
                        'receiver_name' => $receiver['realname'],//ζΆθ΄§δΊΊε§ε
                        'receiver_address' => $receiver['province'] . $receiver['city'] . $receiver['area'] . $receiver['address'],//ζΆθ΄§δΊΊε°ε
                        'receiver_phone' => $receiver['mobile'],//ζΆθ΄§δΊΊζζΊε·οΌζζΊε·εεΊ§ζΊε·εΏε‘«δΈι‘ΉοΌ
                        'receiver_lng' => $location[0],//ζΆθ΄§δΊΊε°εη»εΊ¦οΌι«εΎ·εζ η³»οΌ
                        'receiver_lat' => $location[1],//ζΆθ΄§δΊΊε°εη»΄εΊ¦οΌι«εΎ·εζ η³»οΌ

                        'is_prepay' => 0,//ζ―ε¦ιθ¦ε«δ» 1:ζ― 0:ε¦ (ε«δ»θ?’ειι’οΌιθΏθ΄Ή)
                        'expected_fetch_time' => time() + 600,//ζζεθ΄§ζΆι΄
                        'callback' => 'http://newopen.imdada.cn/inner/api/order/status/notify'
                    );

                    $reqParams = $this->dada_bulidRequestParams($data, $app_key, $source_id, $app_secret);

                    load()->func('communication');
                    $resp = ihttp_request($url, json_encode($reqParams), array('Content-Type' => 'application/json'));
                    $ret = @json_decode($resp['content'], true);
                    if ($ret['code'] == 0) {
                        return array('state' => 1, 'result' => 'εθ΄§ζε');
                    } else {
                        return array('state' => 0, 'result' => $ret['msg']);
                    }

                } else {
                    //ε°ηιθ§£ζεΊιοΌδΈζ―ζεειι
                    return array('state' => 0, 'result' => 'θ·εζΆδ»ΆδΊΊεζ ε€±θ΄₯οΌθ―·ζ£ζ₯ζΆδ»ΆδΊΊε°ε');
                }
            } else {
                //εε?Άθͺθ‘ιι
                return array('state' => 1, 'result' => 'εθ΄§ζε');
            }
        }
    }

    /**
     * //ζ£ζ΅δΊ§εηεΊε­
     * @param type $orderid
     * @param type $type 0 δΈε 1 ζ―δ»
     */
    function CheckoodsStock($orderid = '', $type = 0, $flg = true)
    {
        global $_W;

        if (!$flg) {
            //ε¦ζζ―δ»ζ¬ΎεεΊε­ηθ―ε¨θ?’ειθΎΉζ―δ»ηζΆεδΌζ£ζ΅,ε°±δΌε―Όθ΄ιε€ε ζ¬‘ε°±ζη€Ίζ²‘εΊε­δΊ
            return true;
        }

        $order = pdo_fetch('select id,ordersn,price,openid,dispatchtype,addressid,carrier,status,isparent,paytype,isnewstore,storeid,istrade,status from ' . tablename('vending_machine_order') . ' where id=:id limit 1', array(':id' => $orderid));

        if (!empty($order['istrade'])) {
            return false;
        }

        if (empty($order['isnewstore'])) {
            $newstoreid = 0;
        } else {
            $newstoreid = intval($order['storeid']);
        }

        $param = array();
        $param[':uniacid'] = $_W['uniacid'];

        if ($order['isparent'] == 1) {
            $condition = " og.parentorderid=:parentorderid";
            $param[':parentorderid'] = $orderid;
        } else {
            $condition = " og.orderid=:orderid";
            $param[':orderid'] = $orderid;
        }

        $goods = pdo_fetchall("select og.goodsid,og.total,g.totalcnf,og.realprice,g.credit,og.optionid,g.total as goodstotal,og.optionid,g.sales,g.salesreal,g.type from " . tablename('vending_machine_order_goods') . " og "
            . " left join " . tablename('vending_machine_goods') . " g on g.id=og.goodsid "
            . " where $condition and og.uniacid=:uniacid ", $param);

        if (!empty($goods)) {
            foreach ($goods as $g) {
                if ($newstoreid > 0) {
                    $store_goods = m('store')->getStoreGoodsInfo($g['goodsid'], $newstoreid);
                    if (empty($store_goods)) {
                        return;
                    }
                    $g['goodstotal'] = $store_goods['stotal'];
                } else {
                    $goods_item = pdo_fetch("select total as goodstotal from" . tablename('vending_machine_goods') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $g['goodsid'], ':uniacid' => $_W['uniacid']));
                    $g['goodstotal'] = $goods_item['goodstotal'];
                }

                $stocktype = 0; //0 δΈθ?Ύη½?εΊε­ζε΅ -1 εε° 1 ε’ε 
                if ($type == 0) {
                    //ε¦ζζ―δΈε
                    if ($g['totalcnf'] == 0) {
                        //ε°εΊε­
                        $stocktype = -1;
                    }
                } else if ($type == 1) {
                    if ($g['totalcnf'] == 1) {
                        //ε°εΊε­
                        $stocktype = -1;
                    }
                }

                if (!empty($stocktype)) {
                    $data = m('common')->getSysset('trade');
                    if (!empty($data['stockwarn'])) {
                        $stockwarn = intval($data['stockwarn']);
                    } else {
                        $stockwarn = 5;
                    }

                    if (!empty($g['optionid'])) {
                        //εε°θ§ζ ΌεΊε­
                        $option = m('goods')->getOption($g['goodsid'], $g['optionid']);

                        if ($newstoreid > 0) {
                            $store_goods_option = m('store')->getOneStoreGoodsOption($g['optionid'], $g['goodsid'], $newstoreid);

                            if (empty($store_goods_option)) {
                                return;
                            }
                            $option['stock'] = $store_goods_option['stock'];
                        }


                        if (!empty($option) && $option['stock'] != -1) {
                            if ($stocktype == -1 && $type == 0) {
                                //                                radisε€ζ­εΉΆε
                                $open_redis = function_exists('redis') && !is_error(redis());
                                if ($open_redis) {
                                    $redis_key = "{$_W['uniacid']}_goods_order_option_stock_{$option['id']}";
                                    $redis = redis();
                                    //ε€ζ­ζ―ε¦ζθΏδΈͺδΊ§εε―ΉεΊηθ?°ε½
                                    if ($redis->setnx($redis_key, $option['stock'])) {
                                        $totalstock = $option['stock'];
                                        $newstock = $totalstock - $g['total'];
                                        //ε€ζ­ε½εδΊ§εθ΄­δΉ°δΉεηεΊε­
                                        if ($newstock < 0) {
                                            $redis->delete($redis_key);
                                            return false;
                                        } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        } else {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        }
                                    } else {
                                        //η΄ζ₯θ·εδΊ§εεΊε­
                                        $totalstock = $redis->get($redis_key);
                                        if ($option['stock'] > 0 && $totalstock == 0) {
                                            $totalstock = $option['stock'];
                                        }
                                        $newstock = $totalstock - $g['total'];
                                        if ($newstock < 0) {
                                            $redis->delete($redis_key);
                                            return false;
                                        } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        } else {
//                                        ζ΄ζ°
                                            $redis->set($redis_key, $newstock);
                                        }
                                    }
                                } else {
                                    return true;
                                }
                            } else if ($stocktype == -1 && $type == 1) {
//                                radisε€ζ­εΉΆε
                                $open_redis = function_exists('redis') && !is_error(redis());
                                if ($open_redis) {
                                    $redis_key = "{$_W['uniacid']}_goods_order_option_stock_{$option['id']}";
                                    $redis = redis();
                                    //ε€ζ­ζ―ε¦ζθΏδΈͺδΊ§εε―ΉεΊηθ?°ε½
                                    if ($redis->setnx($redis_key, $option['stock'])) {
                                        $totalstock = $option['stock'];
                                        $newstock = $totalstock - $g['total'];
                                        //ε€ζ­ε½εδΊ§εθ΄­δΉ°δΉεηεΊε­
                                        if ($newstock < 0) {
                                            $redis->delete($redis_key);
                                            return false;
                                        } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        } else {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        }
                                    } else {
                                        //η΄ζ₯θ·εδΊ§εεΊε­
                                        $totalstock = $redis->get($redis_key);
                                        if ($option['stock'] > 0 && $totalstock == 0) {
                                            $totalstock = $option['stock'];
                                        }
                                        $newstock = $totalstock - $g['total'];
                                        if ($newstock < 0) {
                                            $redis->delete($redis_key);
                                            return false;
                                            return false;
                                        } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                            $redis->set($redis_key, $newstock);
                                        } else {
//                                        ζ΄ζ°
                                            $redis->set($redis_key, $newstock);
                                        }
                                    }
                                } else {
                                    return true;
                                }
                            }
                        }
                    }

                    if (!empty($g['goodstotal']) && $g['goodstotal'] != -1) {
                        //εε°εεζ»εΊε­
                        if ($stocktype == -1 && $type == 0) {
                            //radisε€ζ­εΉΆε
                            $open_redis = function_exists('redis') && !is_error(redis());
                            if ($open_redis) {
                                $redis_key = "{$_W['uniacid']}_goods_order_stock_{$g['goodsid']}";
                                $redis = redis();

                                //ε€ζ­ζ―ε¦ζθΏδΈͺδΊ§εε―ΉεΊηθ?°ε½
                                if ($redis->setnx($redis_key, $g['goodstotal'])) {
                                    $totalstock = $g['goodstotal'];
                                    $newstock = $totalstock - $g['total'];
                                    //ε€ζ­ε½εδΊ§εθ΄­δΉ°δΉεηεΊε­
                                    if ($newstock < 0) {
                                        $redis->delete($redis_key);
                                        return false;
                                    } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                        $redis->set($redis_key, $newstock);
                                    } else {
                                        $redis->set($redis_key, $newstock);
                                    }
                                } else {
                                    //η΄ζ₯θ·εδΊ§εεΊε­
                                    $totalstock = $redis->get($redis_key);
                                    if ($g['goodstotal'] > 0 && $totalstock == 0) {
                                        $totalstock = $g['goodstotal'];
                                    }
                                    $newstock = $totalstock - $g['total'];
                                    if ($newstock < 0) {
                                        $redis->delete($redis_key);
                                        return false;
                                    } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                        $redis->set($redis_key, $newstock);
                                    } else {
//                                        ζ΄ζ°
                                        $redis->set($redis_key, $newstock);
                                    }
                                }
                            } else {
                                return true;
                            }
                        } else if ($stocktype == -1 && $type == 1) {
//                            radisε€ζ­εΉΆε
                            $open_redis = function_exists('redis') && !is_error(redis());
                            if ($open_redis) {
                                $redis_key = "{$_W['uniacid']}_goods_order_stock_{$g['goodsid']}";
                                $redis = redis();
                                //ε€ζ­ζ―ε¦ζθΏδΈͺδΊ§εε―ΉεΊηθ?°ε½
                                if ($redis->setnx($redis_key, $g['goodstotal'])) {
                                    $totalstock = $g['goodstotal'];
                                    $newstock = $totalstock - $g['total'];
                                    //ε€ζ­ε½εδΊ§εθ΄­δΉ°δΉεηεΊε­
                                    if ($newstock < 0) {
                                        $redis->delete($redis_key);
                                        return false;
                                    } elseif ($newstock == 0) {
                                        $redis->set($redis_key, $newstock);
                                    } else {
//                                        ζ΄ζ°εΊε­
                                        $redis->set($redis_key, $newstock);
                                    }
                                } else {
                                    //η΄ζ₯θ·εδΊ§εεΊε­
                                    $totalstock = $redis->get($redis_key);
                                    if ($g['goodstotal'] > 0 && $totalstock == 0) {
                                        $totalstock = $g['goodstotal'];
                                    }
                                    $newstock = $totalstock - $g['total'];
                                    if ($newstock < 0) {
                                        $redis->delete($redis_key);
                                        return false;
                                    } elseif ($newstock == 0) {
//                                        ζ΄ζ°εΊε­
                                        $redis->set($redis_key, $newstock);
                                    } else {
//                                        ζ΄ζ°
                                        $redis->set($redis_key, $newstock);
                                    }
                                }
                            } else {
                                return true;
                            }

                        }
                    } else if ($g['goodstotal'] == 0) {
                        $totalstock = 0;
                        $totalstock = $g['goodstotal'] - $g['total'];
                        if ($totalstock < 0) {
                            return false;
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

}