<?php defined('IN_IA') or exit('Access Denied');?></div>
<div class="container-fluid footer text-center" role="footer">	
	<div class="friend-link">
		<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>
			<a href="http://www.ychao.cn">微信开发</a>
			<a href="http://www.ychao.cn">商城应用</a>
			<a href="http://www.ychao.cn">移动商城</a>
			<a href="http://www.ychao.cn">联系客服</a>
		<?php  } else { ?>
			<?php  echo $_W['setting']['copyright']['footerright'];?>
		<?php  } ?>
	</div>
	<div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.ychao.cn"><b>易微</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2018 <a href="http://www.ychao.cn">www.ychao.cn</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div>
	<?php  if(!empty($_W['setting']['copyright']['icp'])) { ?>
	<div>备案号：<a href="http://www.miitbeian.gov.cn" target="_blank"><?php  echo $_W['setting']['copyright']['icp'];?></a></div><?php  } ?>
</div>
</div>

</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>

</body>
</html>