<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="http://hovertree.com/texiao/mobile/5/hovertreebottom.css" media="all">
    <style>
        body,div,ol,ul,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,p,form,fieldset,legend,input{ margin:0; padding:0;}
        html {  width: 100%; font-family: 'Heiti SC', 'Microsoft YaHei'; font-size: 100px; outline: 0; -webkit-text-size-adjust:none;}
        body {  width:100%; margin: 0; -webkit-user-select: none; position: relative; background-color:#efeff4;}

        .font-face2{
            font-family: my-font;
            color: green;
        }
        a:hover,a:link,a:visited,a{ color:inherit; text-decoration:none;}
        ul,li{list-style:none}
        #_centent{ padding-bottom:0.8rem;;}
        header{ position:relative; width: 7.5rem; height: 0.84rem;  border-bottom:1px solid #d4d4d8; background-color: #fff;}
        .rt-bk{ position:absolute; top:0.27rem; left:0.15rem; float:left;}
        .rt-bk p{ float:left; font-size:0.24rem;}
        .bk{display: block; margin:0.045rem 0.25rem 0 0; float:left; width: 0.15rem; height: 0.24rem; background: url(../img/rt-bk.png) no-repeat; background-size: 0.15rem 0.24rem;}
        .top-name{ text-align:center; font-size:0.34rem; line-height:0.84rem;}
        .head{ position:relative; width:7.5rem; height:2.2rem; margin-top:0.29rem; background:url(../img/%E7%BB%84%2025.png) no-repeat; background-size:7.5rem 2.2rem;}
        .head-img{ position:absolute; top:0.35rem; left:0.62rem; width:1.43rem; height:1.43rem; padding:0.04rem; border-radius:1rem; background-color:#fff;}
        .head-img img{ width:1.43rem; height:1.43rem;}
        .head-dsb{ position:absolute; top:0.85rem; left:2.78rem;}
        .head-dsb p{ font-size:0.28rem; color:#fff;}
        .dsb-id{ margin-top:0.08rem;}
        .nav{ width:7.5rem; height:0.72rem; margin-top:0.26rem; background-color:#fff;}
        .nav ul li{ position:relative; float:left; width:2.48rem; height:0.55rem; font-size:0.3rem; margin-top:0.085rem; line-height:0.55rem; text-align:center;}
        .nav ul li p{ position:absolute; left:1.2rem; width:0.7rem;}
        .pt-line{ border-left:1px solid #dddddd; border-right:1px solid #dddddd; }
        .idt{ display:block; position:absolute; top:0.11rem; left:0.68rem; float:left; width:0.28rem; height:0.36rem; background:url(../img/indent.png) no-repeat; background-size:0.28rem 0.36rem;}
        .clt{ display:block; position:absolute; top:0.11rem; left:0.68rem; float:left; width:0.39rem; height:0.35rem; background:url(../img/clt.png) no-repeat; background-size:0.39rem 0.35rem;}
        .rcm{ display:block; position:absolute; top:0.11rem; left:0.68rem; float:left; width:0.37rem; height:0.35rem; background:url(../img/rcm.png) no-repeat; background-size:0.37rem 0.35rem;}
        .ps-lt{ width:7.5rem; height:100%; background-color:#fff;}
        .lt-dsb{ position:relative; 7.35rem; height:0.66rem; line-height:0.66rem; margin-left:0.15rem; border-bottom:1px solid #e5e5e5;}
        .lt-dsb p{ margin-left:0.2rem; font-size:0.24rem; color:#838383;}
        .arr-right{ display:block; position:absolute; top:0.21rem; right:0.25rem; width:0.14rem; height:0.24rem; background:url(../img/arr-right.png) no-repeat; background-size:0.14rem 0.24rem;}
        .check-on{ display:block; position:absolute; top:0.11rem; right:0.25rem; width:0.85rem; height:0.58rem; background:url(../img/on.png) no-repeat; background-size:0.85rem 0.58rem;}
        .check-off{ display:block; position:absolute; top:0.11rem; right:0.25rem; width:0.85rem; height:0.58rem; background:url(../img/off.png) no-repeat; background-size:0.85rem 0.58rem;}
        .cl-bb{ border:none;}
        .mt-1{ margin-top:0.23rem;}
        .mt-2{ margin-top:0.38rem;}
        .mt-3{ margin-top:0.29rem;}
        .jg{ margin-bottom:0.8rem;}
        footer{ position:fixed;bottom:0px;left:0px; margin-top:0.2rem; width:7.5rem; height:0.99rem; background:url(../img/projection.png) repeat-x; padding-top:0.2rem; font-size:0.24rem;}
        .mune{ float:left; margin-left:0.54rem; width:1.2rem; height:0.7rem; text-align:center;}
        .mune p{ font-size:0.22rem; color:#656565;}
        .mune img{ width:0.5rem; height:0.5rem;}

    </style>
</head>

<body>

<div id="_centent">
    <header>

        <div class="top-name"><p>个人中心</p></div>
    </header>

    <div class="head">
        <div class="head-img">
            <img src="img/head-img.png" >
        </div>
        <div class="head-dsb">
<!--            <a class="setbtn" href="<?php  echo mobileUrl('/member/info')?>" data-nocache='true'><i class="icon icon-shezhi"></i></a>-->
            <p class="dsb-name"><?php  echo $openid; ?></p>
<!--            <p class="dsb-id"><?php   echo $xc_p['order_id']; ?></p>-->
        </div>
    </div>

    <div class="nav">
        <ul>
            <li>
                <i class="idt"></i>
                <p><a href="<?php  echo $order;?>">订单</a></p>
            </li>
<!--            <li class="pt-line">-->
<!--                <i class="clt"></i>-->
<!--                <p>收藏</p>-->
<!--            </li>-->
<!--            <li>-->
<!--                <i class="rcm"></i>-->
<!--                <p>推荐</p>-->
<!--            </li>-->
        </ul>
    </div>


    <section class="mt-2">
        <div class="ps-lt">
            <div class="lt-dsb cl-bb">
                <p>声音推送通知</p>
                <i class="check-on"></i>
            </div>
        </div>
    </section>



    <div class="jg"></div>
</div>
<div class="hovertreebottom">
    <nav>
        <div id="hovertreebottom_ul">
            <ul class="box">
<!--                <li>-->
<!--                    <a href="<?php  echo $login;?>" class=""><span>注册/登录</span></a>-->
<!--                    &lt;!&ndash;                    <dl>&ndash;&gt;-->
<!--                    &lt;!&ndash;                        <dd><a href="http://hovertree.com"><span>首页</span></a></dd>&ndash;&gt;-->
<!--                    &lt;!&ndash;                        <dd><a href="http://hovertree.com/texiao/"><span>特效</span></a></dd>&ndash;&gt;-->
<!--                    &lt;!&ndash;                        <dd><a href="http://hovertree.com/menu/aspnet/"><span>ASP.NET</span></a></dd>&ndash;&gt;-->
<!--                    &lt;!&ndash;                        <dd><a href="http://hovertree.com/down/"><span>源码下载</span></a></dd>&ndash;&gt;-->
<!--                    &lt;!&ndash;                        <dd><a href="http://hovertree.com/hvtart/bjae/j0x9ww3x.htm"><span>原文</span></a></dd>&ndash;&gt;-->
<!--                    &lt;!&ndash;                    </dl>&ndash;&gt;-->
<!--                </li>-->
                <li>
                    <a href="<?php  echo $url;?>" class=""><span>支付</span></a>
                    <!--                    <dl>-->
                    <!--                        <dd><a href="http://keleyi.com"><span>首页</span></a></dd>-->
                    <!--                        <dd><a href="http://keleyi.com/a/bjad/5vw5k0au.htm"><span>CSS3旋转</span></a></dd>-->
                    <!--                        <dd><a href="http://tool.keleyi.com/"><span>工具</span></a></dd>-->
                    <!--                        <dd><a href="http://keleyi.com/menu/jquery/"><span>jQuery</span></a></dd>-->
                    <!--                    </dl>-->
                </li>
                <li>
                    <a href="<?php  echo $person;?>" class="on"><span>个人中心</span></a>
                    <!--                    <dl>-->
                    <!--                        <dd><a href="http://m.hovertree.com/"><span>谜语</span></a></dd>-->
                    <!--                        <dd><a href="http://m.hovertree.com/yzdd/bjae/a8rbum7w.htm"><span>看图回答</span></a></dd>-->
                    <!--                        <dd><a href="http://m.hovertree.com/miyu/bjae/m81a842g.htm"><span>何问起（猜字）</span></a></dd>-->
                    <!--                        <dd><a href="http://hovertree.com/menu/sqlserver/"><span>Sql Server</span></a></dd>-->
                    <!--                    </dl>-->
                </li>

            </ul>
        </div>
    </nav>
    <div id="hovertreebottom_masklayer" class="masklayer_div on">&nbsp;</div>
</div>
<script src="http://hovertree.com/texiao/mobile/5/hovertreebottom.js"></script>
<script type="text/javascript">
    hovertreebottom.bindClick(document.getElementById("hovertreebottom_ul").querySelectorAll("li>a"), document.getElementById("hovertreebottom_masklayer"));
</script>

<script>
    (function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $('.check-on').click(function(){
        $(this).toggleClass('check-off');
    })
</script>
</body>
</html>
