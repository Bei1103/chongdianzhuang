<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html lang="zh">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Document</title>

  <style type="text/css">
    html {

      font-size: 100px;

    }

    body,
    a,
    ul,
    li {

      padding: 0;

      margin: 0;

      list-style: none;

      text-decoration: none;

    }

    body {

      /*width: 100%;*/

      background: rgb(240, 240, 240);

      font-family: PingFangSC-Regular;

    }

    div {

      box-sizing: border-box;

    }

    .header {

      position: fixed;

      left: 0;

      top: 0;

      width: 100%;

      z-index: 10;

    }

    .head {

      font-size: 0.16rem;

      height: 0.44rem;

      background: #26A69A;

      color: white;

      text-align: center;

      line-height: 0.44rem;

    }

    .head>a {

      color: white;

      float: left;

      margin-left: 0.12rem;

    }

    .nav {

      height: 0.44rem;

      background: white;

      font-size: 0.12rem;

      line-height: 0.44rem;

      padding-left: 0.28rem;


    }



    .nav>ul>li {

      float: left;

      margin: 0px 0.15rem;


    }

    .content {

      margin-top: 1rem;

    }

    .cell1 {

      height: 1.59rem;

      background: white;

      font-size: 0.12rem;

      margin-top: 0.13rem;

    }

    .title {

      height: 0.22rem;

      border-bottom: 1px solid #D8D8D8;

      padding-left: 0.12rem;

      padding-right: 0.12rem;

    }

    .title>span {

      float: right;

      font-size: 0.09rem;

      color: #A4A3A3;

    }

    .cell {

      height: 0.96rem;

      background: white;

      border-bottom: 1px solid #D8D8D8;

      padding: 0.12rem 0;

    }

    .cell>.img {

      width: 1.27rem;

      height: 0.72rem;

      float: left;

      margin-left: 0.12rem;

    }

    /*.content{
overflow: scroll;
}*/

    .cell>.text {

      width: 2.12rem;

      margin-right: 0.12rem;

      float: right
    }

    .cell>.text>span {

      display: block;

    }

    .cell .intro {

      font-size: 0.1rem;

      color: #A4A3A3;

    }

    .cell .spay {

      font-size: 0.09rem;

      color: #A4A3A3;


    }

    .cell .pay {

      color: #26A69A;

      font-size: 0.1rem;

    }

    .footer {

      height: 0.32rem;

      padding: 0.1rem;

      text-align: center;

    }

    .footer>.btn {

      float: right;

    }

    .option {

      width: 0.65rem;

      border: 1px solid #26A69A;

      border-radius: 2px;

      float: left;

      margin-left: 0.07rem;

    }
  </style>


</head>

<body>

<div class="wrap">
  <div class="header">
    <div class="head">
      <a href="<?php  echo $person;?>">??????</a>
      ????????????
    </div>
    <div class="nav">
      <ul style="text-align: center">
        <li><a href="<?php  echo $order;?>">??????</a></li>
        <li><a href="<?php  echo $orderover;?>">?????????</a></li>
        <li><a href="<?php  echo $orderno;?>">?????????</a></li>
      </ul>
    </div>
  </div>
  <div class="content">
    <div class="cell1">
      <div class="title">
        <span>????????????</span>
      </div>
      <div class="cell">
        <div class="text">
          <div class="brand">????????????</div>
          <span class="intro">???????????????<?php  echo date("Y-m-d H:i:s", $xc_p['times']); ?></span>
          <span class="spay">??????????????????<?php   echo $xc_p['fee']; ?></span>
          <span class="pay">??????????????????<?php   echo $xc_p['amount_fee']; ?></span>
        </div>
        <div class="img"><img src="img/cdz.jpg"width="100" height="70"/></div>
      </div>

      <div class="footer">
        <div class="btn">
          <div class="option">????????????</div>
        </div>
      </div>
    </div>
  </div>



</div>

</div>

<script>




  autoSize();



  window.onresize = function () {

    autoSize();



  }



  function autoSize() {

    // ?????????????????????????????????????????????w???

    var w = document.documentElement.clientWidth;

    // ????????????html font-size??????

    var size = w * 100 / 375;

    // ????????????????????????html??????

    var html = document.querySelector('html');

    // ????????????????????????

    html.style.fontSize = size + 'px';

  }

</script>

</body>

</html>