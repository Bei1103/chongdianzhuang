<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Wholesalepicker_Page extends MobilePage {

    function main()
    {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        $action = trim($_GPC['action']);

        $cremind = false;

        //商品
        $goods = pdo_fetch('select id,thumb,title,marketprice,total,maxbuy,minbuy,unit,hasoption,showtotal,diyformid,diyformtype,diyfields,isdiscount,presellprice,
                isdiscount_time,isdiscount_time_start,isdiscount_discounts, needfollow, followtip, followurl, `type`,intervalfloor,intervalprice, isverify, maxprice, minprice, merchsale,ispresell,preselltimeend,unite_total,threen
                from ' . tablename('vending_machine_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if (empty($goods)) {
            show_json(0);
        }
            $intervalprice = iunserializer($goods['intervalprice']);

        $goods['minprice']=0;
        $goods['maxprice']=0;

        if($goods['intervalfloor']>0)
        {
            $goods['intervalprice1']=$intervalprice[0]['intervalprice'];
            $goods['intervalnum1']=$intervalprice[0]['intervalnum'];
            $goods['maxprice']=$intervalprice[0]['intervalprice'];
        }
        if($goods['intervalfloor']>1)
        {
            $goods['intervalprice2']=$intervalprice[1]['intervalprice'];
            $goods['intervalnum2']=$intervalprice[1]['intervalnum'];
            $goods['minprice']=$intervalprice[1]['intervalprice'];
        }
        if($goods['intervalfloor']>2)
        {
            $goods['intervalprice3']=$intervalprice[2]['intervalprice'];
            $goods['intervalnum3']=$intervalprice[2]['intervalnum'];
            $goods['minprice']=$intervalprice[2]['intervalprice'];
        }

        $goods['thistime'] = time();
        $goods = set_medias($goods, 'thumb');

        $openid = $_W['openid'];

        //验证是否关注
        if (is_weixin()) {
            $follow = m("user")->followed($openid);
            if (!empty($goods['needfollow']) && !$follow) {
                $followtip = empty($goods['followtip']) ? "如果您想要购买此商品，需要您关注我们的公众号，点击【确定】关注后再来购买吧~" : $goods['followtip'];
                $followurl = empty($goods['followurl']) ? $_W['shopset']['share']['followurl'] : $goods['followurl'];
                $followqrcode = $_W['shopset']['share']['followqrcode'];
                $followqrcode = tomedia($followqrcode);
                show_json(2, array('followtip' => $followtip, 'followurl' => $followurl,'followqrcode' => $followqrcode));
            }
        }

        $member = m('member')->getMember($_W['openid']);

        //  验证是否登录
        if(empty($openid)){
            show_json(4);
        }

        //  验证
        if(!empty($_W['shopset']['wap']['open']) && !empty($_W['shopset']['wap']['mustbind']) && empty($member['mobileverify'])){
            show_json(3);
        }

        //规格设置
        $specs =false;
        $options = false;
        if (!empty($goods) && $goods['hasoption']) {
            //获取第一个规格作为第一项的内容
            $specs1 = pdo_fetch('select *  from ' . tablename('vending_machine_goods_spec') . ' where goodsid=:goodsid and uniacid=:uniacid order by displayorder asc limit 1', array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));
            if(!empty($specs1))
            {
                $hasoption=1;
                $spec1items= pdo_fetchall('select *  from '.tablename('vending_machine_goods_spec_item')." where specid=:specid and `show`=1 order by displayorder asc",array(':specid'=>$specs1['id']));
                if (!empty($spec1items))
                {
                    foreach ($spec1items  as &$v)
                    {
                        $v['thumb'] = tomedia($v['thumb']);
                    }

                    unset($v);
                }
            }

            $specs2 = pdo_fetch('select *  from ' . tablename('vending_machine_goods_spec') . ' where goodsid=:goodsid and uniacid=:uniacid order by displayorder asc limit 1,1', array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));
            if(!empty($specs2))
            {
                $hasoption=2;
                $spec2items= pdo_fetchall('select *  from '.tablename('vending_machine_goods_spec_item')." where specid=:specid and `show`=1 order by displayorder asc",array(':specid'=>$specs2['id']));
                if (!empty($spec2items))
                {
                    foreach ($spec2items  as &$v)
                    {
                        $v['thumb'] = tomedia($v['thumb']);
                    }
                    unset($v);
                }
            }

            $optionlist = pdo_fetchall('select *  from ' . tablename('vending_machine_goods_option') . ' where goodsid=:goodsid and uniacid=:uniacid order by displayorder asc', array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));
            $options =array();
            foreach($optionlist as $option)
            {
                $key =$option['specs'];
                if(strstr($key,'_'))
                {
                    $keys=explode('_',$key);
                    sort($keys);
                    $key=implode('_',$keys);
                }
                $options[$key] =$option;
            }
        }else
        {
            $hasoption=0;
        }

        if (!empty($options) && !empty($goods['unite_total'])) {
            foreach($options as &$option){
                $option['stock'] = $goods['total'];
            }
        }

        //自定义表单
        $diyformhtml = "";
        $diyform_plugin = p('diyform');
        if($diyform_plugin){
            $fields = false;

            if($goods['diyformtype'] == 1){

                //模板
                if(!empty($goods['diyformid'])){
                    $diyformid = $goods['diyformid'];
                    $formInfo = $diyform_plugin->getDiyformInfo($diyformid);
                    $fields = $formInfo['fields'];
                }
            } else if($goods['diyformtype'] == 2){
                //自定义
                $diyformid = 0;
                $fields = iunserializer($goods['diyfields']);
                if(empty($fields)){
                    $fields = false;
                }
            }

            if(!empty($fields)){
                ob_start();
                $inPicker = true;

                $openid = $_W['openid'];
                $member = m('member')->getMember($openid);
                $f_data = $diyform_plugin->getLastData(3, 0, $diyformid, $id, $fields, $member);

                $flag = 0;
                if (!empty($f_data)) {
                    foreach ($f_data as $k => $v) {
                        if (!empty($v)) {
                            $flag = 1;
                            break;
                        }
                    }
                }

                if (empty($flag)) {
                    $f_data = $diyform_plugin->getLastCartData($id);
                }

                $area_set = m('util')->get_area_config_set();
                $new_area = intval($area_set['new_area']);
                $address_street = intval($area_set['address_street']);

                include $this->template('diyform/formfields');
                $diyformhtml = ob_get_contents();
                ob_clean();
            }
        }

        //是否可以加入购物车
        $goods['canAddCart'] = true;


        show_json(1, array(
            'goods' => $goods,
            'spec1items' => $spec1items,
            'spec2items' => $spec2items,
            'options' => $options,
            'diyformhtml'=>$diyformhtml,
            'hasoption'=>$hasoption
        ));
    }

}
