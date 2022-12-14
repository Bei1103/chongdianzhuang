<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Plugingrant_Page extends SystemPage {

	function main() {
		global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));

        $psize = 20;
        $condition = " and gl.type = 'system' and gl.deleted = 0";
        $params = array();

        /*时间搜索*/
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $condition .= " AND gl.createtime >= :starttime AND gl.createtime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
        /*关键词搜索*/
        $searchfield = strtolower(trim($_GPC['searchfield']));
        $keyword = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($keyword)) {
            if ($searchfield == 'uniacid') {
                $condition.=' and w.name like :keyword ';
            }elseif ($searchfield == 'plugin') {
                $condition.=' and p.name like :keyword ';
            }
            $params[':keyword'] = "%{$keyword}%";
        }

        $list = pdo_fetchall("SELECT gl.*,w.name as wname,p.name as pname,p.thumb,p.iscom,p.identity FROM " . tablename('vending_machine_system_plugingrant_log') . " as gl
                    left join ".tablename('account_wechats')." as w on w.uniacid = gl.uniacid
                    left join ".tablename('vending_machine_plugin')." as p on p.id = gl.pluginid
			        WHERE 1 {$condition} ORDER BY gl.id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);


        $total = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename('vending_machine_system_plugingrant_log') . " as gl
                    left join ".tablename('account_wechats')." as w on w.uniacid = gl.uniacid
                    left join ".tablename('vending_machine_plugin')." as p on p.id = gl.pluginid
			        WHERE 1 {$condition} ", $params);
        $pager = pagination2($total, $pindex, $psize);

		include $this->template();
	}

	/*
	 * 授权
	 * */
	function grant(){
        global $_W, $_GPC;
        $id = intval($_GPC['id']);

        if(p('grant')){
            p('grant')->pluginGrant($id);
        }
        show_json(1, array('url' => webUrl('system/plugin/plugingrant')));
    }

	function add() {
		$this->post();
	}

	function edit() {
		$this->post();
	}

	protected function post() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch("SELECT * FROM " . tablename('vending_machine_system_plugingrant_log') . " WHERE id =:id limit 1", array(':id' => $id));

		if ($_W['ispost']) {
            $acid = pdo_fetch("SELECT acid,uniacid FROM " . tablename('account_wechats') . " WHERE acid=:acid limit 1", array(':acid' => intval($_GPC['uniacid'])));
            //file_put_contents(__DIR__."/a.json", $acid);
			$data = array(
				'type' => 'system',
				'uniacid' => intval($acid['uniacid']),
				'month' => intval($_GPC['month']),
				'createtime' => time(),
				'isperm' => intval($_GPC['isperm'])
			);
			if(empty($data['uniacid'])){
                show_json(0, '请选择公众号');
            }
            //show_json(0, $_GPC['pluginid']);
            $pluginid = is_array($_GPC['pluginid']) ? implode(',', $_GPC['pluginid']) : 0;
            if(strlen($pluginid)<=0){
                show_json(0, '请选择应用');
            }
            if($data['month']<0){
                show_json(0, '请输入正确的使用时长');
            }
            $pluginid = explode(",",$pluginid);
            foreach ($pluginid as $value) {
                $plugin = pdo_fetch("select `identity` from " . tablename('vending_machine_plugin') . " where id = " . $value . " ");
                $data['identity'] = $plugin['identity'];
                $data['pluginid'] = $value;
                //show_json(0, $data);
                if ($data['isperm'] > 0) {
                    $lastitem = pdo_fetch("SELECT MAX(permendtime) as permendtime,permlasttime FROM " . tablename('vending_machine_system_plugingrant_log') . "
                            WHERE uniacid = " . $data['uniacid'] . " and pluginid = " . $value . " and isperm = 1 limit 1");
                    if (!empty($lastitem) && $lastitem['permendtime'] > 0) {
                        $data['permendtime'] = strtotime("+" . $data['month'] . " month", $lastitem['permendtime']);
                        $data['permlasttime'] = $lastitem['permendtime'];
                    } else {
                        $data['permendtime'] = strtotime("+" . $data['month'] . " month");
                    }
                }
                pdo_insert('vending_machine_system_plugingrant_log', $data);
            }

			show_json(1, array('url' => webUrl('system/plugin/plugingrant')));
		}
        if(!empty($item) && $item['pluginid']>0){
            $plugin = pdo_fetch('select * from ' . tablename('vending_machine_plugin') . ' where id = '.$item['pluginid'].' ');
            $item['title'] = $plugin['title'] = $plugin['name'];
        }
        if(!empty($item) && $item['uniacid']>0){
            $account = pdo_fetch('select * from ' . tablename('account_wechats') . ' where acid = '.$item['uniacid'].' ');
            $account['title'] = $account['name'];
        }
		include $this->template();
	}

	function delete() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch("SELECT id FROM " . tablename('vending_machine_system_plugingrant_log') . " WHERE id = '$id'");
		if (empty($item)) {
			message('抱歉，权限设置不存在或是已经被删除！', webUrl('system/plugin/plugingrant', array('op' => 'display')), 'error');
		}

		$log = pdo_fetch("select * from " . tablename('vending_machine_system_plugingrant_log') . "where id = :id", array(':id'    => $id));
        $currentTime = time();
        $isForever = $log['month'] == 0;

        
        // 插件不到期不允许删除
        if ($currentTime < $log['permendtime'] || $isForever) {
            show_json(0, array(
                'url' => referer(),
                'message' => '不允许删除未到期授权应用'
            ));
        }

		// 标记为已删除
        pdo_update('vending_machine_system_plugingrant_log', array('deleted'=>'1'), array('id'  => $id));
		show_json(1, array(
		    'url' => webUrl('system/plugin/plugingrant'),
            'message'=> '删除成功'
        ));
	}

	function queryplugin() {
        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 8;
        $kwd = trim($_GPC['keyword']);
        $params = array();

        $condition = " and deprecated=0 and status=1 ";
        if (!empty($kwd)) {
            $condition.=" AND name LIKE :keyword ";
            $params[':keyword'] = "%{$kwd}%";
        }
        /*$pluginid = '';
        $grantPlugin = array();
        $grantPlugin = pdo_fetchall("select pluginid from ".tablename('vending_machine_system_plugingrant_plugin')." where 1 ");
        foreach ($grantPlugin as $key => $valeu){
            $pluginid .= $valeu['pluginid'].",";
        }
        $pluginid = substr($pluginid,0,strlen($pluginid)-1);
        if(!empty($pluginid)){
            $condition .= " and id not in (".$pluginid.") ";
        }*/

        $plugins = pdo_fetchall('select id,`name` as title,thumb,`desc` from ' . tablename('vending_machine_plugin') . ' where 1 '.$condition.' order by displayorder asc LIMIT '. ($pindex - 1) * $psize . ',' . $psize,$params);

        $total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('vending_machine_plugin') . " WHERE 1 ".$condition." ", $params);
        $pager = pagination2($total, $pindex, $psize,'',array('before' => 5, 'after' => 4, 'ajaxcallback'=>'select_page', 'callbackfuncname'=>'select_page'));

        include $this->template();
	}

    function query() {
        global $_W, $_GPC;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;
        $kwd = trim($_GPC['keyword']);
        $params = array();

        $condition = " ";
        if (!empty($kwd)) {
            $condition.=" AND acc.isdeleted=0 AND ( a.name LIKE :keyword or u.username like :keyword)";
            $params[':keyword'] = "%{$kwd}%";
        }
        $ds = pdo_fetchall('SELECT distinct a.acid, a.name FROM ' . tablename('account_wechats') . " a  "
            . " left join " . tablename('uni_account') . " ac on ac.uniacid = a.uniacid "
            . " left join " . tablename('account') . " acc on acc.uniacid = ac.uniacid "
            . " left join " . tablename('uni_account_users') . " uac on uac.uniacid = ac.uniacid"
            . " left join " . tablename('users') . " u on u.uid = uac.uid "
            . " WHERE 1 {$condition} order by a.acid desc LIMIT ". ($pindex - 1) * $psize . "," . $psize, $params);

        $total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('account_wechats') . "  a  "
            . " left join " . tablename('uni_account') . " ac on ac.uniacid = a.uniacid "
            . " left join " . tablename('account') . " acc on acc.uniacid = ac.uniacid "
            . " left join " . tablename('uni_account_users') . " uac on uac.uniacid = ac.uniacid"
            . " left join " . tablename('users') . " u on u.uid = uac.uid "
            . " WHERE 1 ".$condition." ", $params);
        $pager = pagination2($total, $pindex, $psize,'',array('before' => 5, 'after' => 4, 'ajaxcallback'=>'select_page', 'callbackfuncname'=>'select_page'));
        include $this->template();
    }


}

