<?php
include_once('../system/inc.php');
include './check.php';
require_once('../data/member.php'); 
function curl_get($url)
{
	$ch = curl_init($url);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1");
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
} 
if ($member_name !='')
  { 	header('location: /app/user.php?gid=/'.$_GET['id']); }
header("Content-type:text/html;charset=utf-8");//字符编码设置  
$xiaoyewl_act=$_GET['act'];
switch ($xiaoyewl_act) {
?>
<? case 'login':?>
 <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">  
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
<title>会员登录</title>
</head>
<body>
<div id="vue">
    <header class="aui-bar aui-bar-nav" id="aui-header">
        <div class="aui-pull-left aui-btn">
            <span class="aui-iconfont aui-icon-left"   onClick="javascript:history.back()"></span>
        </div>
        <div class="aui-title" onclick="window.location='/'">会员登录</div>
        <div class="aui-pull-right aui-btn">
            <a class="link"  href="?id=&act=reg"   >注册</a>        </div>
    </header>        <section class="aui-content aui-margin-b-10"  >
       
        <div class="aui-text-center" style="color: orange">
            <div style="margin: 1.68rem auto;font-size: 1.3rem;font-weight: bold;width: 80%;"  >
               
            </div>
        </div>
        
   
        <section class="aui-content aui-margin-t-15">
            <form id="form-login">
                                            <input type="hidden" name="laiyuan" id="" placeholder="" value="App"><input type="hidden" name="act" id="act" value="login">

                <ul class="aui-list aui-form-list">
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-label aui-border-r color-orange">
                                用户名
                            </div>
                            <div class="aui-list-item-input aui-padded-l-10">
                                <input type="text" name="m_name" id="m_name" placeholder="输入用户名">
                            </div>
                            <div class="aui-list-item-label-icon"  >
                                <i class="aui-iconfont aui-icon-close"></i>
                            </div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-label aui-border-r color-orange">
                                密码
                            </div>
                            <div class="aui-list-item-input aui-padded-l-10">
                                <input type="password" name="m_password" id="m_password" placeholder="输入用户密码">
                            </div>
                            <div class="aui-list-item-label-icon" @click="clear('login','password')">
                                <i class="aui-iconfont aui-icon-close"></i>
                            </div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <label><input class="aui-checkbox" type="checkbox" name="remember" checked="">
                                记住密码 </label>
                        </div>
                    </li>
                </ul>
            </form>
        </section>
        <section class="aui-content-padded">
            <div class="aui-btn aui-btn-block aui-btn-info aui-btn-sm" @click="login">登录</div>
        </section>
     <section class="aui-content-padded login-third">
            <p class="aui-font-size-12 aui-text-center aui-margin-b-15">第三方账号登录</p>
            <div class="aui-grid" style="background: none;">
                <div class="aui-row">
                    <div class="aui-col-xs-3"></div>
                    <div class="aui-col-xs-3" onclick="window.location.href = '/qqLogin/?act=app'">
                        <i class="aui-iconfont aui-icon-qq"></i>
                    </div>
                    <div class="aui-col-xs-3">
                        <i class="aui-iconfont aui-icon-wechat" onclick="alert('暂不支持微信登录')"></i>
                    </div>
                    <div class="aui-col-xs-3"></div>
                </div>
            </div>
        </section> 
        <section class="aui-content-padded aui-text-center">
            <a     href="/app/domain_win.php">切换社区</a>
        </section>
    </section>
        </div>
</body>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/popper.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
 
   new Vue({
    el: '#vue',
    data: {
      act: 'login',
      loginType: 'user',
     },
     methods: {
 	 
      login: function () {
         var vm = this;
        this.$post('/post/login.php?act=login', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
                              
				     <?php if($_GET['gid']==0 or !isset($_GET['gid'])) { 
				     	if(isset($_GET['my'])){?> 
				     	window.location.href = 'my.php'; 
				     	<?php }else{ ?> 
				     	window.location.href = 'home.php';
				     <?php } }elseif(isset($_GET['gid']))     { ?>   
				     window.location.href = 'user.php?gid=<?=$_GET['gid']?>';
				  				     <?php }else{ ?>     
			window.location.href = 'my.php';	  				     <?php } ?>   
				     
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
</html>
<? break;?>
<? case 'reg':?>
 <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
<title>会员注册</title>
</head>
<body>
<div id="vue">
    <header class="aui-bar aui-bar-nav" id="aui-header">
        <div class="aui-pull-left aui-btn">
            <span class="aui-iconfont aui-icon-left"   onClick="javascript:history.back()"></span>
        </div>
        <div class="aui-title" onclick="window.location='/'">会员注册</div>
        <div class="aui-pull-right aui-btn">
<a class="link"  href="?act=login&gid=<?=$GET['gid']?>"   >登录</a>        </div>
    </header>            <section class="aui-content aui-margin-b-10"  >
        <div class="aui-text-center" style="color: orange">
            <div style="margin: 1.68rem auto;font-size: 1.3rem;font-weight: bold;width: 80%;"  >
              
            </div>
        </div>
        <form id="form-reg"><input type="hidden" name="act" id="act" value="reg">
            <section class="aui-content aui-margin-t-15">
                <ul class="aui-list aui-form-list">
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-label aui-border-r color-orange">
                                用户名
                            </div>
                            <div class="aui-list-item-input aui-padded-l-10">
                                <input type="text" name="m_name" id="m_name" placeholder="输入用户名">
                            </div>
                            <div class="aui-list-item-label-icon" @click="clear('reg','user')">
                                <i class="aui-iconfont aui-icon-close"></i>
                            </div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-label aui-border-r color-orange">
                                密码
                            </div>
                            <div class="aui-list-item-input aui-padded-l-10">
                                <input type="password" name="m_password" id="m_password" placeholder="输入用户密码">
                            </div>
                            <div class="aui-list-item-label-icon" @click="clear('reg','password')">
                                <i class="aui-iconfont aui-icon-close"></i>
                            </div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-label aui-border-r color-orange">
                                联系QQ
                            </div>
                            <div class="aui-list-item-input aui-padded-l-10">
                                <input type="number" name="m_qq" id="m_qq" placeholder="输入你的QQ号码">
                            </div>
                            <div class="aui-list-item-label-icon" @click="clear('reg','qq')">
                                <i class="aui-iconfont aui-icon-close"></i>
                            </div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-input" style="width: auto;">
                                <input type="text" name="m_key" id="m_key" placeholder="输入验证码">
                            </div>
                            <div class="aui-list-item-label aui-margin-r-15" style="width: 6rem;">

<img title="点击刷新" src="/system/verifycode.php" align="absbottom" onClick="this.src='/system/verifycode.php?'+Math.random();"></img>

                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </form>
        <section class="aui-content-padded">
            <div class="aui-btn aui-btn-block aui-btn-info aui-btn-sm" @click="reg">免费注册</div>
        </section>
		<section class="aui-content-padded aui-text-center">
            <a     href="/app/domain_win.php">切换社区</a>
        </section>
    </section>
    </div>
</body>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/popper.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
 
   new Vue({
    el: '#vue',
    data: {
      act: 'login',
      loginType: 'user',
     },
     methods: {
 	 
      login: function () {
         var vm = this;
        this.$post('/post/login.php?act=login', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
               <?php if($_GET['id']==0) { 
				     	if(isset($_GET['my'])){?> window.location.href = 'my.php'; 
				     	<?php }else{ ?> 
				     	window.location.href = 'home.php';
				    				     <?php } }elseif(!empty($_GET['id']))     { ?>    window.location.href = 'user.php?gid=/<?=$_GET['id']?>';
				  				     <?php }else{ ?>     
			window.location.href = 'my.php';	  				     <?php } ?>   
				     
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
</html>
<? break;?>
<?php
case 'out':
 $_SESSION['member_name'] ='';
  { header('Location:/app/login.php?act=login&my=0');}
break;
?>
<?
}
?>