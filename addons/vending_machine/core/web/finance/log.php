<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Log_Page extends WebPage {

    protected function main($type=0) {
        global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        $condition = ' and log.uniacid=:uniacid and log.type=:type and log.money<>0';
        $condition1 = '';
        $params = array(':uniacid' => $_W['uniacid'], ':type' => $type);
        $total_params = array(':uniacid'=>$_W['uniacid']);
        if (!empty($_GPC['keyword'])) {
            $_GPC['keyword'] = trim($_GPC['keyword']);

            if ($_GPC['searchfield'] == 'logno') {
                $condition .= ' and log.logno like :keyword';
            } else if ($_GPC['searchfield'] == 'member') {
                $condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
            }

            $params[':keyword'] = '%' . $_GPC['keyword'] . '%';
            $total_params[':keyword'] = '%' . $_GPC['keyword'] . '%';
        }

//        print_r($condition1);die();
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }else{
            if (empty($starttime) || empty($endtime)) {
                $starttime = strtotime('-12 month');
                $endtime = time();
                $params[':starttime'] = $starttime;
                $params[':endtime'] = $endtime;
            }
        }
        $condition .= " AND log.createtime >= :starttime AND log.createtime <= :endtime ";
        if (!empty($_GPC['level'])) {
            $condition1.=' and m.level=' . intval($_GPC['level']);
        }
        if (!empty($_GPC['groupid'])) {
            $condition1.=' and m.groupid=' . intval($_GPC['groupid']);
        }
        $member_sql = '';
        
        if (!empty($_GPC['rechargetype'])) {
            $_GPC['rechargetype'] = trim($_GPC['rechargetype']);

            if ($_GPC['rechargetype'] == 'system1') {
                $condition .= " AND log.rechargetype='system' and log.money<0";
            } else {
                $condition .= " AND log.rechargetype=:rechargetype";
                $params[':rechargetype'] = $_GPC['rechargetype'];
            }
        }

        if ($_GPC['status'] != '') {
            $condition.=' and log.status=' . intval($_GPC['status']);
        }

//        $sql = "select log.id,m.id as mid, g.realname,m.avatar,m.weixin,log.logno,log.type,log.status,log.rechargetype,log.sendmoney,m.nickname,m.mobile,g.groupname,log.money,log.createtime,l.levelname,log.realmoney,log.deductionmoney,log.charge,log.remark,log.alipay,log.bankname,log.bankcard,log.realname as applyrealname,log.applytype from " . tablename('vending_machine_member_log') . " log "
//            . " left join " . tablename('vending_machine_member') . " m on m.openid=log.openid"
//            . " left join " . tablename('vending_machine_member_group') . " g on m.groupid=g.id"
//            . " left join " . tablename('vending_machine_member_level') . " l on m.level =l.id"
//            . " where 1 {$condition} ORDER BY log.createtime DESC ";

//        $sql = "select log.id,log.openid,log.logno,log.type,log.status,log.rechargetype,log.sendmoney,log.money,log.createtime,log.realmoney,log.deductionmoney,log.charge,log.remark,log.alipay,log.bankname,log.bankcard,log.realname as applyrealname,log.applytype from " . tablename('vending_machine_member_log') . " log "
//            . " where 1 {$condition} {$member_sql} ORDER BY log.createtime DESC ";

        $sql = "select log.id,log.openid,log.logno,log.type,log.status,log.rechargetype,log.sendmoney,log.money,log.createtime,log.realmoney,log.deductionmoney,log.charge,log.remark,log.alipay,log.bankname,log.bankcard,log.realname as applyrealname,log.applytype,m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile,g.groupname,l.levelname from " . tablename('vending_machine_member_log') . " log "
            ." left join ".tablename('vending_machine_member')." m on m.openid = log.openid "
            ." left join ".tablename('vending_machine_member_group')." g on g.id = m.groupid "
            ." left join ".tablename('vending_machine_member_level')." l on l.id = m.level "
            . " where 1 {$condition} {$condition1} GROUP BY log.id ORDER BY log.createtime DESC ";

//        print_r($sql);die();

        if (empty($_GPC['export'])) {
            $sql.="LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        }

        $list = pdo_fetchall($sql, $params);

        $apply_type = array(0 => '????????????', 2 => '?????????', 3 => '?????????');

        $openids = array();
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]['typestr'] = $apply_type[$value['applytype']];
                //?????????????????????
                $list[$key]['bankcard'] = $list[$key]['bankcard']."\t";
                if ($value['deductionmoney'] == 0) {
                    $list[$key]['realmoney'] = $value['money'];
                }
                if (!strexists($value['openid'],'sns_wa_')) {
                    array_push($openids,$value['openid']);
                }else{
                    array_push($openids,substr($value['openid'],7));
                }
            }
            $openids = array_filter($openids);
            $members_sql = "select id as mid, realname,avatar,weixin,nickname,mobile,openid,openid_wa from " . tablename('vending_machine_member') . " m where uniacid=:uniacid and (openid IN ('".implode("','",array_unique($openids))."') OR openid_wa IN ('".implode("','",array_unique($openids))."'))";
            $members = pdo_fetchall($members_sql,array(':uniacid'=>$_W['uniacid']),'openid');
            
            $rs = array();
            if (!empty($members)) {
                foreach ($members as $key => &$row) {
                    if (!empty($row['openid_wa'])) {
                        $rs['sns_wa_'.$row['openid_wa']] = $row;
                    } else {
                        $rs[] = $row;
                    }
                }
            }

            $member_openids = array_keys($members);
            foreach ($list as $key => $value)
            {
                if (in_array($list[$key]['openid'],$member_openids))
                {
                    $list[$key] = array_merge($list[$key],$members[$list[$key]['openid']]);
                }
                else
                {
                    $list[$key] = array_merge($list[$key],isset($rs[$list[$key]['openid']])?$rs[$list[$key]['openid']]:array());
                }
            }
        }

        //??????Excel
        if ($_GPC['export'] == 1) {
            if ($_GPC['type'] == 1) {
                plog('finance.log.withdraw.export', "??????????????????");
            } else {
                plog('finance.log.recharge.export', "??????????????????");
            }

            foreach ($list as &$row) {
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
                $row['groupname'] = empty($row['groupname']) ? '?????????' : $row['groupname'];
                $row['levelname'] = empty($row['levelname']) ? '????????????' : $row['levelname'];
                $row['typestr'] = $apply_type[$row['applytype']];

                if ($row['status'] == 0) {
                    if ($row['type'] == 0) {
                        $row['status'] = "?????????";
                    } else {
                        $row['status'] = "?????????";
                    }
                } else if ($row['status'] == 1) {
                    if ($row['type'] == 0) {
                        $row['status'] = "????????????";
                    } else {
                        $row['status'] = "??????";
                    }
                } else if ($row['status'] == -1) {
                    if ($row['type'] == 0) {
                        $row['status'] = "";
                    } else {
                        $row['status'] = "??????";
                    }
                }
                if ($row['rechargetype'] == 'system') {
                    $row['rechargetype'] = "??????";
                } else if ($row['rechargetype'] == 'wechat') {
                    $row['rechargetype'] = "??????";
                } else if ($row['rechargetype'] == 'alipay') {
                    $row['rechargetype'] = "?????????";
                }
            }
            unset($row);


            $columns = array();

            $columns[] = array('title' => '??????', 'field' => 'nickname', 'width' => 12);
            $columns[] = array('title' => '??????', 'field' => 'realname', 'width' => 12);
            $columns[] = array('title' => '?????????', 'field' => 'mobile', 'width' => 12);
            $columns[] = array('title' => '????????????', 'field' => 'levelname', 'width' => 12);
            $columns[] = array('title' => '????????????', 'field' => 'groupname', 'width' => 12);
            $columns[] = array('title' => (empty($type) ? "????????????" : "????????????"), 'field' => 'money', 'width' => 12);
            if (!empty($type)) {
                $columns[] = array('title' => '????????????', 'field' => 'realmoney', 'width' => 12);
                $columns[] = array('title' => '???????????????', 'field' => 'deductionmoney', 'width' => 12);

                $columns[] = array('title' => '????????????', 'field' => 'typestr', 'width' => 12);
                $columns[] = array('title' => '????????????', 'field' => 'applyrealname', 'width' => 24);
                $columns[] = array('title' => '?????????', 'field' => 'alipay', 'width' => 24);
                $columns[] = array('title' => '??????', 'field' => 'bankname', 'width' => 24);
                $columns[] = array('title' => '????????????', 'field' => 'bankcard', 'width' => 24);
                $columns[] = array('title' => '????????????', 'field' => 'applytime', 'width' => 24);


            }
            $columns[] = array('title' => (empty($type) ? "????????????" : "??????????????????"), 'field' => 'createtime', 'width' => 12);

            if (empty($type)) {
                $columns[] = array('title' => "????????????", 'field' => 'rechargetype', 'width' => 12);
            }
            $columns[] = array('title' => "??????", 'field' => 'remark', 'width' => 24);
            m('excel')->export($list, array(
                "title" => (empty($type) ? "??????????????????-" : "??????????????????") . date('Y-m-d-H-i', time()),
                "columns" => $columns
            ));
        }

        if ($condition1 != '')
        {
            $condition_member = pdo_fetchall("SELECT openid FROM ".tablename('vending_machine_member')."m WHERE m.uniacid = :uniacid {$condition1}", $total_params);
            
            $condition_member2 = pdo_fetchall("SELECT CONCAT('sns_wa_',openid_wa) FROM ".tablename('vending_machine_member')." m WHERE m.uniacid = :uniacid {$condition1}", $total_params);
            $condition_member = array_column($condition_member, 'openid');
            $condition_member2 = array_column($condition_member2, 'openid');
            $member_sql = " and (openid IN ('".implode("','",array_unique($condition_member))."') OR openid IN ('".implode("','",array_unique($condition_member2))."'))";
            unset($params[':keyword']);
        }
        
        $total = pdo_fetchcolumn("select count(*) from " . tablename('vending_machine_member_log') . " log "
            . " where 1 {$condition} {$member_sql}", $params);
       
        $pager = pagination2($total, $pindex, $psize);
        $groups = m('member')->getGroups();
        $levels = m('member')->getLevels();
        include $this->template();
    }

    function refund($tid=0, $fee = 0, $reason = '') {
        global $_W, $_GPC;
        $set = $_W['shopset']['shop'];
        $id = intval($_GPC['id']);
        $log = pdo_fetch('select * from ' . tablename('vending_machine_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
            ':id' => $id, ':uniacid' => $_W['uniacid']
        ));
        if (empty($log)) {
            show_json(0, '???????????????!');
        }
        if (!empty($log['type'])) {
            show_json(0, '???????????????!');
        }
        if ($log['rechargetype'] == 'system') {
            show_json(0, '????????????????????????!');
        }
        $current_credit = m('member')->getCredit($log['openid'], 'credit2');
        if ($log['money'] > $current_credit) {
            show_json(0, '?????????????????????????????????????????????!');
        }

        $out_refund_no = 'RR' . substr($log['logno'], 2); //????????????

        if ($log['rechargetype'] == 'wechat') {

            if ($log['apppay']==2){
                //??????????????????????????????????????????
                $result = m('finance')->wxapp_refund($log['openid'], $log['logno'], $out_refund_no, $log['money'] * 100, $log['money'] * 100, !empty($log['apppay']) ? true : false);
            }else{
                if (empty($log['isborrow'])) {
                    $result = m('finance')->refund($log['openid'], $log['logno'], $out_refund_no, $log['money'] * 100, $log['money'] * 100, !empty($log['apppay']) ? true : false);
                } else {
                    $result = m('finance')->refundBorrow($log['openid'], $log['logno'], $out_refund_no, $log['money'] * 100, $log['money'] * 100);
                }
            }
        }elseif ($log['rechargetype']=='alipay') {
            $sec = m('common')->getSec();
            $sec =iunserializer($sec['sec']);
            if(!empty($log['apppay'])){
                if(!empty($sec['app_alipay']['private_key_rsa2'])){
                    $sign_type = 'RSA2';
                    $privatekey=$sec['app_alipay']['private_key_rsa2'];
                }else{
                    $sign_type = 'RSA';
                    $privatekey=$sec['app_alipay']['private_key'];
                }
                // new & app
                if(empty($privatekey) || empty($sec['app_alipay']['appid'])){
                    show_json(0,'???????????????????????????????????????APPID??????!');
                }
                $params = array('out_trade_no' => $log['logno'],'refund_amount'=>$log['money'],'refund_reason' => "??????????????????: {$log['money']}??? ?????????: " . $log['logno'].'/'.$out_refund_no);
                $config = array('app_id' => $sec['app_alipay']['appid'], 'privatekey' => $privatekey, 'publickey' => "", 'alipublickey' => "",'sign_type'=>$sign_type);
                $result = m('finance')->newAlipayRefund($params, $config);
            }else if(!empty($sec['alipay_pay'])){
                //?????????????????????
                if(empty($sec['alipay_pay']['private_key']) || empty($sec['alipay_pay']['appid'])){
                    show_json(0,'???????????????????????????????????????APPID??????!');
                }

                if($sec['alipay_pay']['alipay_sign_type'] == 1){
                    $sign_type = 'RSA2';
                }else{
                    $sign_type = 'RSA';
                }
                $params = array('out_request_no'=>time(),'out_trade_no' => $log['logno'],'refund_amount'=>$log['money'],'refund_reason' => "??????????????????: {$log['money']}??? ?????????: " . $log['logno'].'/'.$out_refund_no);
                $config = array('app_id' => $sec['alipay_pay']['appid'], 'privatekey' => $sec['alipay_pay']['private_key'], 'publickey' => "", 'alipublickey' => "",'sign_type'=>$sign_type);
                $result = m('finance')->newAlipayRefund($params, $config);
            }else{
                // old
                if (empty($log['transid'])){
                    show_json(0,'????????? ????????????????????????????????????!');
                }
                $setting = uni_setting($_W['uniacid'], array('payment'));
                if (!is_array($setting['payment'])) {
                    return error(1, '????????????????????????');
                }
                $alipay_config = $setting['payment']['alipay'];
                $batch_no_money = $log['money']*100;
                $batch_no = date('Ymd').'RC'.$log['id'].'MONEY'.$batch_no_money;
                $res = m('finance')->AlipayRefund(array(
                    'trade_no'=> $log['transid'],
                    'refund_price'=> $log['money'],
                    'refund_reason'=> "??????????????????: {$log['money']}??? ?????????: " . $log['logno'].'/'.$out_refund_no,
                ),$batch_no,$alipay_config);

                if (is_error($res)) show_json(0,$res['message']);
                show_json(1,array('url'=>$res));
            }
        } else {
            $result = m('finance')->pay($log['openid'], 1, $log['money'] * 100, $out_refund_no, $set['name'] . '????????????');
        }
        if (is_error($result)) {
            show_json(0, $result['message']);
        }

        pdo_update('vending_machine_member_log', array('status' => 3), array('id' => $id, 'uniacid' => $_W['uniacid']));

        //???????????? ??????+?????????
        $refundmoney = $log['money'] + $log['gives'];
        m('member')->setCredit($log['openid'], 'credit2', -$refundmoney, array(0, $set['name'] . '????????????'));

        //??????????????????????????????
        $money = com_run('sale::getCredit1',$log['openid'],(float)$log['money'],21,2,1);
        if($money>0) {
            m('notice')->sendMemberPointChange($log['openid'], $money, 1);
        }

        //????????????
        m('notice')->sendMemberLogMessage($log['id']);
        $member = m('member')->getMember($log['openid']);
        plog('finance.log.refund', "???????????? ID: {$log['id']} ??????: {$log['money']} <br/>????????????:  ID: {$member['id']} / {$member['openid']}/{$member['nickname']}/{$member['realname']}/{$member['mobile']}");

        show_json(1, array('url' => referer()));
    }

    function wechat() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $log = pdo_fetch('select * from ' . tablename('vending_machine_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
            ':id' => $id, ':uniacid' => $_W['uniacid']
        ));
        if (empty($log)) {
            show_json(0, '???????????????!');
        }

        if ($log['deductionmoney'] == 0) {
            $realmoney = $log['money'];
        } else {
            $realmoney = $log['realmoney'];
        }

        $set_name = $_W['shopset']['shop']['name'];
        $account_name = $_W['account']['name'];
        $shop_name = empty($account_name)?$set_name:$account_name;
        $desc = $shop_name . '????????????';
        $data = m('common')->getSysset('pay');
        if (!empty($data['paytype']['withdraw'])){
            if(strpos($log['openid'],'sns_wa_')===false){
                $result = m('finance')->payRedPack($log['openid'], $realmoney * 100, $log['logno'],$log, $desc,$data['paytype']);
                pdo_update('vending_machine_member_log',array(
                    'sendmoney'=>$result['sendmoney'],
                    'senddata'=>json_encode($result['senddata']),
                ),array('id'=>$log['id']));

                if ($result['sendmoney'] == $realmoney){
                    $result = true;
                }else{
                    $result = $result['error'];
                }
            }else{
                show_json(0,"?????????????????????,????????????????????????????????????????????????!");
            }
        }else{
            $result = m('finance')->pay($log['openid'], 1, $realmoney * 100, $log['logno'], $desc);
        }

        if (is_error($result)) {
            show_json(0, array('message' => $result['message']));
        }
        pdo_update('vending_machine_member_log', array('status' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));

        //????????????
        m('notice')->sendMemberLogMessage($log['id']);
        $member = m('member')->getMember($log['openid']);
        plog('finance.log.wechat', "???????????? ID: {$log['id']} ??????: ?????? ????????????: {$log['money']} ,????????????: {$realmoney} ,??????????????? : {$log['deductionmoney']}<br/>????????????:  ID: {$member['id']} / {$member['openid']}/{$member['nickname']}/{$member['realname']}/{$member['mobile']}");
        show_json(1);
    }

    function alipay() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $log = pdo_fetch('select * from ' . tablename('vending_machine_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
            ':id' => $id, ':uniacid' => $_W['uniacid']
        ));
        if (empty($log)) {
            show_json(0, '???????????????!');
        }

        if ($log['deductionmoney'] == 0) {
            $realmoeny = $log['money'];
        } else {
            $realmoeny = $log['realmoney'];
        }

        $set = $_W['shopset']['shop'];
        $sec = m('common')->getSec();
        $sec = iunserializer($sec['sec']);
        if (!empty($sec['alipay_pay']['open'])){
            //???????????????????????????
            if($sec['alipay_pay']['sign_type'] == 1){
                $batch_no_money = $realmoeny*100;
                $batch_no = 'D'.date('YmdHis').'RW'.$log['id'].'MONEY'.$batch_no_money;
                //??????????????????
                $single_res = m('finance')->singleAliPay(array(
                    'account'=>$log['alipay'],
                    'name'=>$log['realname'],
                    'money'=>$realmoeny
                ),$batch_no,$sec['alipay_pay'], $log['title']);
                if($single_res['errno'] == '-1'){
                    show_json(0,$single_res['message']);
                }

                //???????????????????????????????????????
                $order_id = $single_res['order_id'];
                $query_res = m('finance')->querySingleAliPay($sec['alipay_pay'],$order_id,$batch_no);
                if($query_res['errno'] == '-1'){
                    show_json(0,$query_res['message']);
                }

                //???????????????????????????
                pdo_update('vending_machine_member_log', array('status' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));

                //????????????
                m('notice')->sendMemberLogMessage($log['id']);
                $member = m('member')->getMember($log['openid']);
                plog('finance.log.alipay', "???????????? ID: {$log['id']} ??????: ????????? ????????????: {$log['money']} ,????????????: {$realmoney} ,??????????????? : {$log['deductionmoney']}<br/>????????????:  ID: {$member['id']} / {$member['openid']}/{$member['nickname']}/{$member['realname']}/{$member['mobile']}");
                show_json(1);
            }else{
                //??????????????????
                $batch_no_money = $realmoeny*100;
                $batch_no = 'D'.date('Ymd').'RW'.$log['id'].'MONEY'.$batch_no_money;

                $res = m('finance')->AliPay(array(
                    'account'=>$log['alipay'],
                    'name'=>$log['realname'],
                    'money'=>$realmoeny
                ),$batch_no,$sec['alipay_pay'], $log['title']);

                if (is_error($res)) show_json(0,$res['message']);

                show_json(1,array('url'=>$res));
            }
        }
        show_json(0,'?????????,???????????????!');
    }

    function manual() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $log = pdo_fetch('select * from ' . tablename('vending_machine_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
            ':id' => $id, ':uniacid' => $_W['uniacid']
        ));
        if (empty($log)) {
            show_json(0, '???????????????!');
        }
        $member = m('member')->getMember($log['openid']);
        pdo_update('vending_machine_member_log', array('status' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));
        //????????????
        m('notice')->sendMemberLogMessage($log['id']);
        plog('finance.log.manual', "???????????? ??????: ?????? ID: {$log['id']} <br/>????????????: ID: {$member['id']} / {$member['openid']}/{$member['nickname']}/{$member['realname']}/{$member['mobile']}");
        show_json(1);
    }

    function refuse() {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $log = pdo_fetch('select * from ' . tablename('vending_machine_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
            ':id' => $id, ':uniacid' => $_W['uniacid']
        ));
        if (empty($log)) {
            show_json(0, '???????????????!');
        }

        if ($log['status']==-1) {
            show_json(0, '????????????????????????!');
        }

        pdo_update('vending_machine_member_log', array('status' => -1), array('id' => $id, 'uniacid' => $_W['uniacid']));
        if ($log['money'] > 0) {
            //????????????????????????
            m('member')->setCredit($log['openid'], 'credit2', $log['money'], array(0, '??????????????????'));
        }

        $member=pdo_fetchall('SELECT * FROM '.tablename('vending_machine_member').' WHERE uniacid =:uniacid AND openid=:openid',array(':uniacid' => $_W['uniacid'],':openid'=>$log['openid']));
        //????????????
        m('notice')->sendMemberLogMessage($log['id']);
        plog('finance.log.refuse', "????????????????????? ID: {$log['id']} ??????: {$log['money']} <br/>????????????:  ID: {$member['id']} / {$member['openid']}/{$member['nickname']}/{$member['realname']}/{$member['mobile']}");
        show_json(1);
    }

    function recharge()
    {
        $this->main(0);
    }

    function withdraw()
    {
        $this->main(1);
    }

}
