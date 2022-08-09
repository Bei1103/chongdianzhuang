<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Datatransfer_Page extends WebPage {

	function main() {

		global $_W, $_GPC;

		$item = pdo_fetch("select dt.*,w.name from ".tablename('vending_machine_datatransfer')." dt left join ".tablename('account_wechats')." w on w.uniacid = dt.touniacid where dt.fromuniacid =:uniacid limit 1" ,array(":uniacid"=>$_W['uniacid']));

		$senduniacid = $_GPC['acid'];
		$isopen = $_GPC['isopen'];
		if ($_W['ispost']) {
			if(!empty($isopen))
			{
				pdo_delete('vending_machine_datatransfer',array('fromuniacid'=>$_W['uniacid']));
				show_json(1, array('url' => referer()));
			}
			$data = array(
				'fromuniacid'=>$_W['uniacid'],
				'touniacid'=>$senduniacid,
				'status'=>1
			);
			pdo_insert('vending_machine_datatransfer',$data);

			$tables = array(
				'vending_machine_category', 				//商品分类表1
				'vending_machine_carrier',               	//自提点表1
				'vending_machine_adv',                    	//幻灯片表1
				'vending_machine_feedback',              	//反馈表1	2
				'vending_machine_form',                  	//表单表1
				'vending_machine_form_category',        	//表单分类表1
				'vending_machine_gift',                  	//赠品表1
				'vending_machine_goods',                 	//商品表1
				'vending_machine_goods_comment',    		//商品评论表1
				'vending_machine_goods_group',        		//商品组表1
				'vending_machine_goods_label',            //商品标签表1
				'vending_machine_goods_labelstyle',    	//v2 商品标签风格表1
				'vending_machine_goods_option',        	//商品规格表 *ERP1
				'vending_machine_goods_param',        		//商品参数表1
				'vending_machine_goods_spec',            	//商品规格表1
				'vending_machine_goods_spec_item',    	//商品规格项目表1

				//用户对应表
				//'vending_machine_member',						//用户表 12
				'vending_machine_member_address',    			//用户地址表	12
				'vending_machine_member_printer',        		//打印配置	1
				'vending_machine_member_printer_template',  //打印模板	1
				'vending_machine_member_group',
				'vending_machine_member_level',

				'vending_machine_member_log',					//用户表
				'mc_credits_record',						//微擎积分余额记录
				//'mc_credits_recharge',					//??


				//人人分销
				'vending_machine_commission_apply',            //提现申请表1 mid
				'vending_machine_commission_bank',            //提现银行表1
				'vending_machine_commission_level',            //分销分级表	1
				'vending_machine_commission_log',               //分销日志表	1 mid
				'vending_machine_commission_rank',            //分销排行设置表	1
				'vending_machine_commission_repurchase',		//分销回购表	1	2
				'vending_machine_commission_shop',            //我的小店表	1


				'vending_machine_order',                       //订单表			1	2
				'vending_machine_order_comment',            	//订单评论表	1	2
				'vending_machine_order_goods',                //订单商品表		1
				'vending_machine_order_peerpay',                //订单代付信息	1
				'vending_machine_order_peerpay_payinfo',    //订单代付付款信息	1
				'vending_machine_order_refund',                //订单退货表		1
			);



			foreach ($tables as $table) {
				pdo_update($table, array("uniacid" => $senduniacid), array("uniacid" => $_W['uniacid']));
			}

			show_json(1, array('url' => referer()));
		}

		include $this->template();
	}
}
