<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .feed-activity-list {
        width: 100%;
        overflow: hidden;
    }

    .feed-element {
        float: left;
        width: 320px;
        height: 120px;
        margin-left: 15px;
        margin-bottom: 20px;
        border: 1px solid #efefef;
        padding: 20px;
    }

    .feed-element::after {
        display: none
    }

    .feed-element .title {
        font-size: 14px;
        height: 24px;
        line-height: 20px;
        vertical-align: bottom;
        color: #333;
        font-weight: bold;
        margin-left: 10px;
    }

    .feed-element img.img-circle,
    .dropdown-messages-box img.img-circle {
        float: left;
        width: 60px;
        height: 60px;
        border-radius: 4px;
    }

    .media-body {
        margin-top: 3px;
        height: 65px;
    }

    .text-muted {
        margin-left: 10px;
        width: 200px;
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .authorization{
        width: 95%;
        height:20px;
        color: #999;
        line-height: 24px;
        border-top: 1px solid #efefef;
    }
</style>
<div class="page-header">

        <div class="pull-right">
            <div class="input-group" style="width:400px;">
                <span class="input-group-addon">搜索</span>
                <input type="text" class="form-control" id="name" placeholder="输入应用名称进行快速搜索"/>

            </div>
        </div>
 
    当前位置：<span class="text-primary">我的应用</span>
</div>

<div class="page-content">
    <div class='panel panel-default' style='border:none;'>
        <?php  if(p('grant') || $_W['role'] == 'founder') { ?>
        <?php  if(!empty($pluginsetting['adv'])) { ?>
        <a href="<?php  echo webUrl('plugingrant')?>">
            <img src="<?php  echo tomedia($pluginsetting['adv'])?>" width="100%" alt="应用授权中心">
        </a>
        <?php  } ?>
        <?php  } ?>
        <?php  if(is_array($category)) { foreach($category as $ck => $cv) { ?>
        <?php  if(count($cv['plugins'])<=0) { ?><?php  continue;?><?php  } ?>

<!--        分类-->
        <div class="panel-heading" style='background:none;border:none;'>
            <?php  echo $cv['name'];?>
        </div>


        <div class="feed-activity-list">
            <?php  if(is_array($cv['plugins'])) { foreach($cv['plugins'] as $plugin) { ?>
            <?php  if(com_perm_check_plugin($plugin['identity']) && cv($plugin['identity'])) { ?>
<!--            图片-->
            <a class="feed-element" href="<?php  echo webUrl($plugin['identity'])?>" data-name="<?php  echo $plugin['name'];?>">
						<span class="pull-left">
							<img src="<?php  echo tomedia($plugin['thumb'])?>" class="img-circle" alt="image"
                                 onerror="this.src='../addons/vending_machine/static/images/yingyong.png'">
						</span>
<!--                模块名字-->
                <div class="media-body ">
                    <span class="title">
                        <span class="fl"><?php  echo $plugin['name'];?></span>
                         <?php  if(in_array($plugin['identity'],$wxapp_array)) { ?>
                        <img  src="<?php  echo tomedia('../addons/vending_machine/static/images/xcx.png')?>" alt="" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" data-content="已支持小程序" style="font-size: 12px;color: #00c952;margin-left:5px"><?php  } ?>
                    </span>
                    <small class="text-muted"><?php  echo $plugin['desc'];?></small>

                </div>
                <?php  if($_W['role'] != 'founder' && $plugin['isgrant']>0) { ?>
                <div class="authorization">
                    <Script Language="JavaScript">
                        /*Begin*/
                        var timedate = new Date(<?php  echo $plugin['permendtime'];?> * 1000);
                        var times = "研究生考试";
                        var now = new Date();
                        var date = timedate.getTime() - now.getTime();
                        var time = Math.floor(date / (1000 * 60 * 60 * 24));
                        if (time >= 0) {
                            if (time <= 30) {
                                document.write("授权剩余：<span style='font-size:12px;padding:2px 5px;display:inline-block;border-radius: 3px;'>" + time + "天</span>");
                            } else {
                                document.write("授权剩余：<span style='font-size:12px;padding:2px 5px;display:inline-block;border-radius: 3px;'>" + time + "天</span>");
                            }
                        } else {
                            document.write("授权已过期");
                        }
                        ;
                        /*End*/
                    </Script>
                </div>
                    <?php  } else if($_W['role'] != 'founder' && $plugin['isplugingrant']>0) { ?>
                <div class="authorization">
                    <script type="text/javascript">
                        var timedate = new Date(<?php  echo $plugin['permendtime'];?> * 1000);
                        var month = <?php  echo $plugin['month'];?>;
                        var isperm = <?php  echo $plugin['isperm'];?>;
                        var now = new Date();
                        var date = timedate.getTime() - now.getTime();
                        var time = Math.floor(date / (1000 * 60 * 60 * 24 * 30));
                        if (month == 0) {
                            if (isperm == 0) {
                                document.write("授权已过期");
                            }
                        } else {
                            if (time >= 0) {
                                if (time <= 1) {
                                    document.write("授权剩余：<span style='font-size:12px;padding:2px 5px;display:inline-block;border-radius: 3px;'>" + 1 + "个月</span>");
                                } else {
                                    document.write("授权剩余：<span style='font-size:12px;padding:2px 5px;display:inline-block;border-radius: 3px;'>" + time + "个月</span>");
                                }
                            }
                        }
                        ;
                    </script>
                </div>
                    <?php  } ?>

            </a>

            <?php  } ?>
            <?php  } } ?>
        </div>
        <?php  } } ?>
    </div>
</div>
<script>
    $(function(){
        $('#name').bind('input propertychange',function(){
            var name = $.trim( $('#name').val() );
            if( name==''){

                $('.feed-activity-list').prev('.panel-heading').show();
                $('.feed-element').show();
            }else{

                $('.feed-activity-list').prev('.panel-heading').hide();
                $('.feed-element').hide();

                $('.feed-element').each(function(){

                    if($(this).data('name').indexOf( name )!=-1){
                        $(this).show().closest('.feed-activity-list').prev('.panel-heading').show();
                    }
                });
            }

        })
    })
    $(document).ready(function () {
        $('.feed-activity-list,.plugin_tabs').each(function () {
            if ($(this).children().length <= 0) {
                $(this).prev().remove();
                $(this).remove();
            }
        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>