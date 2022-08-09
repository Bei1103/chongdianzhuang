<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style type="text/css">
    * {
        margin: 0px;
    }

    #content {
        /*margin: 50px auto;*/
        width: 100%;
        height: 100%;
        border: 1px transparent solid;
        background-color: #21D4FD;
        background-image: linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
        background-image: -webkit-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
        background-image: -moz-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
        background-image: -o-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
    }

    #box {
        margin: 100px auto 50px;
        width: 340px;
        height: 400px;
        background-color: #fff;
        text-align: center;
        border-radius: 15px;
        border: 2px #fff solid;
        box-shadow: 10px 10px 5px #000000;
    }

    .title {
        line-height: 58px;
        margin-top: 20px;
        font-size: 36px;
        color: #000;
        height: 58px;
    }

    #box:hover {
        border: 2px #fff solid;
    }

    .input {
        margin-top: 20px;
    }

    input {
        margin-top: 5px;
        outline-style: none;
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 13px 14px;
        width: 70%;
        font-size: 14px;
        font-weight: 700;
        font-family: "Microsoft soft";
    }

    button {
        margin-top: 20px;
        border: none;
        color: #000;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 15px;
        background-color: #CCCCCC;
    }
    button:hover{
        background-color: #B721FF;
        color: #fff;
    }
</style>

<div id="content">
    <div id="box">
        <div class="title">Login</div>
        <div class="input">
            <input type="text" id="username" value="" placeholder="用户名" />
            <br>
            <input type="password" id="password" placeholder="密码" />
            <br>
            <input type="password" id="password1" placeholder="再次输入" />
            <br>
            <button type="button" onclick="getuser()">登录</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getuser() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var password1 = document.getElementById("password1").value;
        testing(username, password,password1)
        //alert("username:"+username+"\n"+"password:"+password);
    }

    function testing(username, password, password1) {
        var tmp = username && password;
        if (tmp == "") {
            alert("请填写完整信息");
            return 0;
        }
        if (username.length < 6 || username.length > 16) {
            alert("用户名长度为：6-16位")
            return 0;
        }
        if (password<6 || password1<6)
        {
            alert("密码长度错误");
        }else if(password == password1){
            alert("username:" + username + "\n" + "password:" + password);
            window.location.href="<?php  echo $url;?>";
        }else{
            alert("两次输入的密码不一样");
        }
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>