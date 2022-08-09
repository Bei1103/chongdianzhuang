<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
	.fui-according-header{
		font-size: .7rem;
	}
	.fui-according-header .text{
		color: #666666;
		font-size: .65rem;
		text-align: right;
	}
	.fui-cell-group.recharge{
		padding:.6rem 0 ;
	}
	.fui-cell-group.recharge .fui-cell{
		padding:0;
		font-size: .6rem;
		height:1rem;
		line-height:1rem;
	}
	.fui-cell-group.recharge .fui-cell .fui-cell-text{
		color: #666;
	}
	.fui-cell-group.recharge .fui-cell:before{display: none}
	.fui-cell-group.recharge:before{
		content: " ";
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		height: 1px;
		border-top: 1px solid #ebebeb;
		color: #D9D9D9;
		-webkit-transform-origin: 0 0;
		-ms-transform-origin: 0 0;
		transform-origin: 0 0;
		-webkit-transform: scaleY(0.5);
		-ms-transform: scaleY(0.5);
		transform: scaleY(0.5);
	}
	.fui-according.expanded .fui-according-header .text{
		filter:alpha(opacity=0);
		-moz-opacity:0;
		-khtml-opacity: 0;
		opacity: 0;
	}
	.fui-cell-group .fui-cell .fui-cell-icon {
		width: auto;
		margin-right: .75rem;
	}
	.fui-cell-group .fui-cell .fui-cell-icon img {
		width: 1.7rem;
		height: 1.7rem;
	}
	.fui-cell-info .title {
		position: relative;
		font-size: 0.7rem;
		color: #000;
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		height: 1rem;
		line-height: 1rem;
	}
	.fui-cell.applyradio{
		display: none;
		height: 3.25rem;padding: .4rem .6rem;
	}
	.fui-cell.applyradio .fui-cell-info{
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 100%;
		-webkit-box-orient: vertical;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		-webkit-justify-content: space-around;
		justify-content: space-around;
	}
</style>
<link rel="stylesheet" type="text/css" href="../addons/vending_machine/template/mobile/default/static/css/coupon-new.css?v=2017030302">
<div class='fui-page fui-page-current'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">账户充值</div>
		<div class="fui-header-right">&nbsp;</div>
	</div>

	<?php  if(strlen($_GPC['id']) > 0) { ?>
	<input type="hidden" id="payid" value="<?php  echo $_GPC['id'];?>">
	<?php  } ?>
	<div class='fui-content navbar' >
		<input type="hidden" id="logid" value="<?php  echo $logid;?>" />
		<input type="hidden" id="couponid" value="" />
		<?php  if($wechat['success'] || $payinfo['wechat'] || ($alipay['success'] && !is_h5app()) || $payinfo['alipay']) { ?>

			<?php  if(!empty($acts)) { ?>
			<div class='fui-cell-group'>
				<div class='fui-<?php  if(count($acts)>1) { ?>according<?php  } ?> '>
					<div class='fui-according-header' style="color: #666;">充值活动
						<div class="text">
							充值满 <span class='text-danger'><?php  echo $acts[0]['enough'];?></span> 元立即送 <span class='text-danger'><?php  echo $acts[0]['give'];?></span> 元
						</div>
						<?php  if(count($acts)>1) { ?><span class="remark"></span><?php  } ?>
					</div>
					<?php  if(count($acts)>1) { ?>
					<div class='fui-according-content'>
						<div class='content-block' style="padding: 0 0.6rem;">
							<div class="fui-cell-group recharge" style="margin-top: 0;">
								<?php  if(is_array($acts)) { foreach($acts as $key => $enough) { ?>
								<div class="fui-cell" style="">
									<div class="fui-cell-text">充值满 <span class='text-danger'><?php  echo $enough['enough'];?></span> 元立即送 <span class='text-danger'><?php  echo $enough['give'];?></span> 元</div>
								</div>
								<?php  } } ?>
							</div>
						</div>
					</div>
					<?php  } ?>
				</div>
			</div>
			<?php  } ?>
			<div class='fui-cell-group'>
				<div class='fui-cell'>
					<div class='fui-cell-label'>当前<?php  echo $_W['shopset']['trade']['moneytext'];?></div>
					<div class='fui-cell-info c000'>￥<?php  echo number_format($credit,2)?></div>
				</div>
				<div class='fui-cell'>
					<div class='fui-cell-label'>充值金额</div>
					<div class='fui-cell-info c000'style="    display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-box-align: center;-webkit-align-items: center;-ms-flex-align: center;align-items: center;">￥<input type='number' class='fui-input' id='money' value="<?php  echo $_GPC['money'];?>"></div>
				</div>
			</div>
			<div class='fui-cell-group'>
				<?php  if(com('coupon')) { ?>
				<div class='fui-cell' id='coupondiv' style='display:none'>
					<div class='fui-cell-label' style='width:auto'>优惠券</div>
					<div class='fui-cell-info'></div>
					<div class='fui-cell-remark'>
						<div class='badge' style='display:none'>0</div>
						<span class='text'>无可用</span>
					</div>
				</div>
				<?php  } ?>
			</div>
			<a id='btn-next' class='btn btn-danger block disabled mtop' style="margin-top: 0.5rem">下一步</a>
			<div class='fui-cell-group'>
				<?php  if($wechat['success'] || $payinfo['wechat']) { ?>
					<div class="fui-cell applyradio" id='btn-wechat1'>
						<div class="fui-cell-icon"><img src="<?php echo VENDING_MACHINE_STATIC;?>images/wxcz.png" alt=""></div>
						<div class="fui-cell-info" style="height: 100%">
							<div class="title">微信充值</div>
							<div class="subtitle" style="color: #999999;font-size: .65rem">微信安全支付</div>
						</div>
						<div class="fui-cell-remark noremark"><input name="1" type="radio" class="fui-radio fui-radio-danger" id="applytype2" data-type="0" checked="cheched"></div>
					</div>
				<?php  } ?>

				<?php  if(($alipay['success'] && !is_h5app()) || $payinfo['alipay']) { ?>
					<div class="fui-cell applyradio " id="btn-alipay1">
						<div class="fui-cell-icon"><img src="<?php echo VENDING_MACHINE_STATIC;?>images/zfb.png" alt=""></div>
						<div class="fui-cell-info" style="height: 100%">
							<div class="title">支付宝充值</div>
							<div class="subtitle" style="color: #999999;font-size: .65rem">支付宝安全支付</div>
						</div>
						<div class="fui-cell-remark noremark"><input name="1" type="radio" class="fui-radio fui-radio-danger" id="applytype" data-type="0"></div></label >
					</div>
				<?php  } ?>
			</div>

			<?php  if($wechat['success'] || $payinfo['wechat']) { ?>
				<a id='btn-wechat' class='btn btn-danger block mtop btn-pay ' style='display:none'>确认支付</a>
			<?php  } ?>
			<?php  if(($alipay['success'] && !is_h5app()) || $payinfo['alipay']) { ?>
				<a id='btn-alipay' class='btn btn-danger mtop  block btn-pay'  style='display:none'>确认支付</a>
			<?php  } ?>
		<?php  } else { ?>
			<div class='fui-content-inner'>
				<div class='content-empty'>
					<img src="<?php echo VENDING_MACHINE_STATIC;?>images/nomeb.png" style="width: 6rem;margin-bottom: .5rem;"><br/>
					<p style="color: #999;font-size: .75rem">充值系统正在维护中！</p><br/>
					<a href="<?php  echo mobileUrl()?>" class='btn btn-sm btn-danger-o external' style="border-radius: 100px;height: 1.9rem;line-height:1.9rem;width:  7rem;font-size: .75rem">去首页逛逛吧   </a>
				</div>
			</div>
		<?php  } ?>
	</div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH)) : (include template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH));?>
	<script language='javascript'>
        require(['biz/member/recharge'], function (modal) {
        	let payid = $('#payid').val();
            modal.init(
            		{
						minimumcharge: <?php  echo $minimumcharge?>,
						wechat: <?php  echo intval($wechat['success'])?>,
			alipay:<?php  echo intval($alipay['success'])?>,
			payid:payid
            		});
        });
	</script>
	<script>
        $(function(){
            $(".applyradio").click(function(){
                $(this).find(".fui-radio").prop("checked","true");
                var id =$(this).attr("id");
                if(id=="btn-alipay1"){
                    $("#btn-alipay").show();
                    $("#btn-wechat").hide();
                }else if(id=="btn-wechat1"){
                    $("#btn-wechat").show();
                    $("#btn-alipay").hide();
                }
            })
        })
	</script>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>