<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/vending_machine/template/account/default2/style.css?v=2.0.0">
<style type="text/css">
    .header {background-image: url("<?php echo empty($set['wap']['bg'])?'../addons/vending_machine/template/account/default2/bg.jpg':tomedia($set['wap']['bg'])?>"); background-repeat: no-repeat}
    .btn {background: <?php  if(!empty($set['wap']['color'])) { ?><?php  echo $set['wap']['color'];?><?php  } else { ?>#fea119<?php  } ?>;}
    .text a {color: <?php  if(!empty($set['wap']['color'])) { ?><?php  echo $set['wap']['color'];?><?php  } else { ?>#fea119<?php  } ?>;}
    .header .logo {box-shadow: <?php  if(!empty($set['wap']['color'])) { ?><?php  echo $set['wap']['color'];?><?php  } else { ?>#fea119<?php  } ?> 0px 1px 8px;}
    .agreement {
        position: fixed;
        bottom: 20px;
        width: 100%;
    }
    .agreement p{
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
    }
    .agreement p a {
        color: #0066cc;
        cursor: pointer;
    }
</style>
<div class="fui-page">
    <?php  if(is_h5app()) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"> </a>
        </div>
        <div class="title"><?php  if(empty($type)) { ?>用户注册<?php  } else { ?>找回密码<?php  } ?></div>
        <div class="fui-header-right" data-nomenu="true"></div>
    </div>
    <?php  } ?>
    <div class="fui-content">
        <div class="header">
            <div class="logo">
                <img src="<?php  echo tomedia($set['shop']['logo'])?>" />
            </div>
        </div>
        <div class="acc-input-group">
            <div class="acc-input">
                <div class="title">11位手机号</div>
                <div class="input">
                    <input type="tel" class="input-inner" value="<?php  echo trim($_GPC['mobile'])?>" placeholder="请输入手机号码" name="mobile" id="mobile" maxlength="11" />
                </div>
            </div>
            <?php  if(!empty($set['wap']['smsimgcode'])) { ?>
                <div class="acc-input">
                    <div class="title">图形验证码</div>
                    <div class="input">
                        <input type="tel" class="input-inner" value="" placeholder="请输入图形验证码" name="verifycode2" id="verifycode2" maxlength="4" />
                        <div class="remark">
                            <img src="../web/index.php?c=utility&a=code&r=<?php  echo time()?>" style="width: 3.5rem; height: 1.5rem; vertical-align: middle;" id="btnCode2">
                        </div>
                    </div>
                </div>
            <?php  } ?>
            <div class="acc-input" style="display:none">
                <div class="title">短信验证码</div>
                <div class="input">
                    <input type="tel" class="input-inner" value="12345" placeholder="请输入5位短信验证码" name="verifycode" id="verifycode" maxlength="5" />
                    <a class="remark" href="javascript:;" id="btnCode">获取验证码</a>
                </div>
            </div>
            <div class="acc-input">
                <div class="title">登录密码</div>
                <div class="input">
                    <input type="password" class="input-inner" value="" placeholder="请输入密码" name="pwd" id="pwd" maxlength="20" />
                </div>
            </div>
            <div class="acc-input">
                <div class="title">重复登录密码</div>
                <div class="input">
                    <input type="password" class="input-inner" value="" placeholder="请重复密码" name="pwd1" id="pwd1" maxlength="20" />
                </div>
            </div>
        </div>

        <div class="btn" id="btnSubmit"><?php  if(empty($type)) { ?>立即注册<?php  } else { ?>立即找回<?php  } ?></div>
        <div class="text">
            <p>已有帐号? <a href="<?php  echo $set['wap']['loginurl'];?>">立即登录</a></p>
        </div>

        <?php  if(empty($type)) { ?>
        <?php  if(is_h5app()) { ?>
        <?php  if($set['wap']['agr']) { ?>
        <div class="agreement">
            <p><input type="checkbox" class="agree" value="1" checked name="agree[]"> 登录注册代表同意 <a href="<?php  echo mobileUrl('account/agr')?>" id="useragr">《用户协议与隐私政策》</a></p>
        </div>
        <?php  } ?>
        <?php  } ?>
        <?php  } ?>

        <script language='javascript'>
            require(['biz/member/account'], function (modal) {
                modal.initRf({backurl:'<?php  echo $_GPC['backurl'];?>', type: <?php  echo intval($type)?>, endtime: <?php  echo intval($endtime)?>, imgcode: <?php  echo intval($set['wap']['smsimgcode'])?>});
            });
        </script>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>