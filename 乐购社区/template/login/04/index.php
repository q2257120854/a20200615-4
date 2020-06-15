<?
if($loginms=='true' and $_SESSION!=''){
	header('location: /');
}
if ($_SESSION['member_name']!='')
	{
	header('location: /index/home/order/id/'.$_GET['id'].'.html');
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="MZ9Ke8VIFb649QrGQKHX8oOCEaD4HkKtSZUYWqg2">
    <title>会员登录 - <?=$site_name?></title>
    <meta name="keywords" content="乐购云社区系统,<?=$site_name?>,<?=$site_key?>,乐购社区,乐购云,亿乐3.0,乐购,社区系统,刷会员,自助下单系统"/>
    <meta name="description" content="乐购社区系统，专注于自助下单系统的平台，值得您的信赖,<?=$site_des?>"/>
    <link href="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/common/css/style.css?v=1.1">
    <link rel="shortcut icon" href="https://s2.ax1x.com/2019/01/23/kAjoTA.png"/>
</head>
<body>
<a href="/" class="show-xs limit web_name"><?=$site_name?></a>
<div id="vue" class="login_page">
    <div class="login_content">
        <div class="hidden-xs">
            <a class="web_name limit" href="/"><?=$site_name?></a>
            <div class="login_img"></div>
        </div>
        <div style="flex: auto" v-if="act=='login'">
            <form action="#" id="form-login">
                <input type="hidden" name="type" v-model="loginType">
                                    <div class="login_name">用户登录</div>
                                <div v-if="loginType=='card'" v-cloak>
                    <input type="text" name="card" placeholder="输入商品卡密" class="input username">
                    <input type="password" name="pass" placeholder="输入卡密密码,没有则不填写" class="input password mt30">
                </div>
                <div v-else>
                                        <input type="text"  name="m_name" id="m_name" placeholder="输入用户名" class="input username">
                    <input type="password" name="m_password" id="m_password"placeholder="输入用户密码" class="input password mt30">
                    <div class="mt30" style="font-size: 12px;color:rgba(153,153,153,1);">
                        <input type="checkbox">
                        <span>记住密码</span>
                        <span style="float: right">
                        <a>忘记密码？</a>
                    </span>
                    </div>
                </div>
            </form>
                            <div class="login_btn mt30" @click="login">登 录</div>
                <div v-if="loginType=='user'">
                    <div class="mt30" style="font-size:14px;color:rgba(153,153,153,1);text-align: center">
                        没有账号？<a style="color: #9C32F6" @click="act='reg'">立即注册</a>
                    </div>
                    <div class="mt30" style="position: relative">
                        <hr>
                        <div class="hr">第三方登录</div>
                        <a href="/qqLogin" class="third_btn mt30" style="margin: 0 auto"></a>
                    </div>
                </div>
                    </div>
        <div style="flex: auto" v-else>
            <form action="#" id="form-reg">
                                <div class="login_name">新用户注册</div>
                <input type="text"  name="m_name" id="m_name" placeholder="输入用户名" class="input username">
                <input type="password" name="m_password" id="m_password"placeholder="输入用户密码" class="input password mt30">
                <input type="password" id="m_qq" name="m_qq" oninput="value=value.replace(/[^\d]/g,'')" placeholder="输入联系QQ"
                       class="input password mt30">
                <div class="mt30" >
                    <input type="text"  name="m_key" id="m_key" placeholder="输入验证码" class="input code">
                    <img title="点击刷新" src="/system/verifycode.php"onClick="this.src='/system/verifycode.php?'+Math.random();" id="code" style="margin-top: 10px;float: right;height: 40px;width: 100px">
                </div>
            </form>
            <div class="login_btn mt30" @click="reg">免费注册</div>
            <div v-if="loginType=='user'">
                <div class="mt30" style="font-size:14px;color:rgba(153,153,153,1);text-align: center">
                    已有账号？<a style="color: #9C32F6" @click="act='login'">马上登录</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    版权所有 © 2017-2019 <?=$site_name?>
</div>
<script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
    new Vue({
        el: '#vue',
        data: {
            act: 'login',
            loginType: 'user'
        },
        methods: {
            login: function () {
         var vm = this;
        this.$post('/post/login.php?act=login', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
            } else {
                
                layer.alert(data.message);
         
            }
          });
      },
	       kmlogin: function () {
         var vm = this;
        this.$post('/post/login.php?act=kmlogin', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
            } else {
                
                layer.alert(data.message);
         
            }
          });
      },
	   
         reg: function () {
        var vm = this;
        this.$post('/post/login.php?act=reg', new FormData(document.getElementById("form-reg")))
          .then(function (data) {
            $("#code").click();
            if (data.code == 0) {
              vm.act = 'login';
              layer.alert('恭喜你，注册成功。马上登录！');
            } 
               else {
                layer.alert(data.message);
             }
          });
      }
    },
        mounted: function () {
            var vm = this;
            document.onkeyup = function (e) {
                var code = parseInt(e.charCode || e.keyCode);
                if (code == 13) {
                    vm.act == 'login' ? vm.login() : vm.reg();
                }
            }
        }
    });
</script>
</body>
</html>
