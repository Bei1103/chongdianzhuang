<?php

if(!defined('IN_IA')) {
     exit('Access Denied');
}

class Index_Page extends WebPage {
    
    function main(){
        global $_W, $_GPC;

        if(empty($_W['shopversion'])){
            header("location:".webUrl('shop'));
            exit;
        }

        $shop_data = m('common')->getSysset('shop');
        //多商户
        $merch_plugin = p('merch');
        $merch_data = m('common')->getPluginset('merch');
        if ($merch_plugin && $merch_data['is_openmerch']) {
            $is_openmerch = 1;
        } else {
            $is_openmerch = 0;
        }

        $hascommission =false;
        if(p('commission')){
            $hascommission =  intval($_W['shopset']['commission']['level'])>0;
        }

        $ordercol = 6;
        if(cv('goods') && cv('order')){
            $ordercol = 6;
        }
        elseif(cv('goods') && !cv('order')) {
            $ordercol = 12;
        }
        elseif(cv('order') && !cv('goods')) {
            $ordercol = 12;
        }else{
            $ordercol = 0;
        }
        $pluginnum = m('plugin')->getCount();
        $no_left = true;

        plog('shop', "访问后台");

        include $this->template();
    }

    public function searchlist() {
        global $_W, $_GPC;

        $return_arr = array();
        $menu = m('system')->getSubMenus(true, true);
        $keyword = trim($_GPC['keyword']);

        if(empty($keyword) || empty($menu)){
            show_json(1, array('menu'=>$return_arr));
        }

        foreach ($menu as $index=>$item){
            if(strexists($item['title'], $keyword) || strexists($item['desc'], $keyword) || strexists($item['keywords'], $keyword) || strexists($item['topsubtitle'], $keyword)){
                if( cv($item['route'])){
                    $return_arr[] = $item;
                }
            }
        }

        show_json(1, array('menu'=>$return_arr));
    }

    public function search() {
        global $_W, $_GPC;

        $keyword = trim($_GPC['keyword']);

        $list = array();
        $history = $_GPC['history_search'];
        if(empty($history)){
            $history = array();
        }else{
            $history = htmlspecialchars_decode($history);
            $history = json_decode($history, true);
        }

        if(!empty($keyword)){
            $submenu = m('system')->getSubMenus(true, true);
            if(!empty($submenu)){
                foreach ($submenu as $index=>$submenu_item){
                    $top= $submenu_item['top'];
                    if(strexists($submenu_item['title'], $keyword) || strexists($submenu_item['desc'], $keyword) || strexists($submenu_item['keywords'], $keyword) || strexists($submenu_item['topsubtitle'], $keyword)){
                        if(cv($submenu_item['route'])){
                            if(!is_array($list[$top])){
                                $title = !empty($submenu_item['topsubtitle'])?$submenu_item['topsubtitle']:$submenu_item['title'];
                                if(strexists($title, $keyword)){
                                    $title = str_replace($keyword, "<b>{$keyword}</b>", $title);
                                }
                                $list[$top] = array(
                                    'title'=>$title,
                                    'items'=>array()
                                );
                            }
                            if(strexists($submenu_item['title'], $keyword)){
                                $submenu_item['title'] = str_replace($keyword, "<b>{$keyword}</b>", $submenu_item['title']);
                            }
                            if(strexists($submenu_item['desc'], $keyword)){
                                $submenu_item['desc'] = str_replace($keyword, "<b>{$keyword}</b>", $submenu_item['desc']);
                            }
                            $list[$top]['items'][] = $submenu_item;
                        }
                    }
                }
            }

            // 特殊路由處理
            array_walk($list['shop']['items'], function (&$v) {
                if ($v['url'] == 'http://slf.clubmall.cn/web/index.php?c=site&a=entry&m=vending_machine&do=web&r=shop.diypage') {
                    $v['url'] = 'http://slf.clubmall.cn/web/index.php?c=site&a=entry&m=vending_machine&do=web&r=diypage';
                }
            });

            // 处理历史
            if(empty($history)){
                $history_new = array($keyword);
            }else{
                $history_new = $history;
                foreach ($history_new as $index=>$key){
                    if($key==$keyword){
                        unset($history_new[$index]);
                    }
                }
                $history_new = array_merge(array($keyword), $history_new);
                $history_new = array_slice($history_new,0,20);
            }
            isetcookie('history_search', json_encode($history_new), 7 * 86400);
            $history = $history_new;
        }

        include $this->template();
    }

    public function clearhistory() {
        global $_W, $_GPC;
        if($_W['ispost']){
            $type = intval($_GPC['type']);
            if(empty($type)){
                isetcookie('history_url', '', -7 * 86400);
            }else{
                isetcookie('history_search', '', -7 * 86400);
            }
        }
        show_json(1);
    }

    public function switchversion(){
        global $_W, $_GPC;


        // 获取目标地址
        $route = trim($_GPC['route']);
        $id = intval($_GPC['id']);

        $set = pdo_fetch('SELECT * FROM '. tablename('vending_machine_version'). ' WHERE uid=:uid AND `type`=0', array(
            ':uid'=>$_W['uid']
        ));

        $data = array(
            'version' => !empty($_W['shopversion'])? 0: 1
        );

        if(empty($set)){
            $data['uid'] = $_W['uid'];
            pdo_insert('vending_machine_version', $data);
        }else{
            pdo_update('vending_machine_version', $data, array(
                'id'=>$set['id']
            ));
        }

        $params = array();
        if(!empty($id)){
            $params['id'] = $id;
        }

        load()->model('cache');
        cache_build_template();

        // 切换完重定向至目标页面
        header('location: '. webUrl($route, $params));
        exit;
    }
}