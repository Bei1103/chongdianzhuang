<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Detail_Page extends MobilePage
{

    public function main(){
        global $_W,$_GPC;
        $openid =$_W['openid'];
        $uniacid = $_W['uniacid'];
        $id = intval($_GPC['id']);
        $rank = intval($_GPC['rank']);



        include $this->template();
    }
}
