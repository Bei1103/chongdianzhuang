  <?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Postertool_Page extends WebPage {

	function main() {
        global $_W, $_GPC;
		include $this->template();
	}

    function clear()
	{
	    global $_W,$_GPC;
        load()->func('file');
        @rmdirs(IA_ROOT . "/addons/vending_machine/data/poster/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . "/addons/vending_machine/data/qrcode/" . $_W['uniacid']);
        $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account_wechats') . " WHERE `uniacid`=:uniacid LIMIT 1", array(':uniacid' => $_W['uniacid']));
        pdo_update('vending_machine_poster_qr', array('mediaid' => ''), array('acid' => $acid));
        plog('poster.clear', "清除海报缓存");

        @rmdirs(IA_ROOT . "/addons/vending_machine/data/goodscode/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . "/addons/vending_machine/data/poster_wxapp/commission/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . "/addons/vending_machine/data/poster_wxapp/goods/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . "/addons/vending_machine/data/postera/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . " /addons/vending_machine/data/task/poster/" . $_W['uniacid']);
        @rmdirs(IA_ROOT . " /addons/vending_machine/data/upload/exchange/" . $_W['uniacid']);


		show_json(1);
	}


}
