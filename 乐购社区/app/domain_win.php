<?php 
include('../system/inc.php');
include './check.php';
$act=$_GET['act'];
if($act=='home' and $_SESSION['url']!='' and !empty($_SESSION['url'])){
	$url='http://'.$_SESSION['url'].'/app/home.php';
	#jump2($url,0);
    #fh('http://'.$_SESSION['url'].'/app/home.php',1);
	header('location: http://'.$_SESSION['url'].'/app/home.php');
	exit; 
}elseif($act=='notice' and $_SESSION['url']!='' and !empty($_SESSION['url'])){
	$url='http://'.$_SESSION['url'].'/app/notice.php';
	jump2($url,1);
    #fh('http://'.$_SESSION['url'].'/app/notice.php'',1);
	header('location: http://'.$_SESSION['url'].'/app/notice.php');
	exit;
}elseif($act=='my' and $_SESSION['url']!='' and !empty($_SESSION['url'])){
	$url='http://'.$_SESSION['url'].'/app/my.php';
	jump2($url,1);
    #fh('http://'.$_SESSION['url'].'/app/my.php',1);
	header('location: http://'.$_SESSION['url'].'/app/my.php');
	exit;
}
function jump2($siteurl,$way=0){
if($way==0){
header('location: '.$siteurl);
exit; 
}else{
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="robots" content="noindex, nofollow"><meta name="viewport" content="width=device-width,initial-scale=1"><title>时空云防红</title><style type="text/css">body{margin:0;width:100%;height:100%}iframe{margin:0;width:100%;height:100%;border:0}</style></head><body><iframe src="<?=$siteurl?>"></iframe></body></html>
<?php
exit;
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>设置网址</title>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
    <style>
        body, html {
            height: 100%;
        }

        body {
            background: url("http://static.xiaoyewl.net/app/image/bg-1.jpg");
            background-size: cover;
        }

        .input {
            border-bottom: 1px solid black !important;
            text-align: center;
            padding: 0 10px !important;
            width: 80% !important;
            margin: 0 auto !important;
            font-size: 1.2rem;
            font-weight: 400;
        }
    </style>
</head>
<body>
<div class="aui-text-center" style="color: #b5ffff" id="page">
    <div style="padding-top: 4rem"><form class="login100-form" name="form-login" id="form-login">
        <input type="text" placeholder="输入社区域名" class="input" id="domain" name="domain">
        <a onclick="login()" class="aui-btn aui-btn-success" style="margin-top: 1rem" value="进入社区"><?php if($act==''){ ?>切换社区<?php }else{ ?>进入社区<?php } ?></a></form>    </div>
    <div style="position: fixed;bottom:8rem;width: 100%" v-if="show">
        <img src="http://assests.skywl.cc/app/image/logo.png" style="width: 48px;height: 48px;margin: 0 auto">
    </div>
</div>
</body>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script>
function tc(msg) {
	 layer.open({
    content: msg
    ,btn: '我知道了'
  });
}
 function login()
{
                    var vm = this;
                    var domain = $("#domain").val();
                    if (domain.length < 6) {
                        tc('请输入正确的社区域名');
                    } else {
                        var vm = this;
          this.$post('ajax_login.php', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.status === 0) 
			{
			 <?php if($act==''){ ?>tc('切换成功，长按底部按钮刷新');<?php }else{ ?>window.location.href = data.message;<?php } ?>
				        } 
						else {
                 tc(data.message);
            }
          });
                    }
}
</script>
</html>