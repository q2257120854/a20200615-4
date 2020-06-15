<?php
function SqlArray($result){
	$foodsPic=array();
	while($row=mysql_fetch_array($result)){
		$foodsPic[]=$row;
	}
	return $foodsPic;
}
require_once('../system/inc.php');
require_once('../system/safe.php');
require_once('admin_config.php');


 $act=$_POST['提交'];
  $username=$_POST['userName'];
 $password=$_POST['passWord'];
if ($act=='确认登陆') 
{
//账号密码判断
	if ($username == '')
	{ 		alert_href('请输入用户名!',''); }  
	elseif ($password == '')
	{ 		alert_href('请输入用户密码!',''); }
	//登陆部分
	$result = mysql_query('select * from '.flag.'admin  where  a_name = "'.$username.'"  ');
	$row = SqlArray($result);
	if(!$row){
		alert_href('登录账户不正确!',''); 
	}
	if(md5($password) != $row[0]['a_password']){
		alert_href('登录密码不正确!','');
	}else
{ 
$_SESSION['admin_check2'] =$username;
 header("Location: admin_index.php"); 
 }
 

}

?>
 
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台登录</title>
<meta http-equiv=Content-Type content=text/html;charset=utf-8 />
<meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2018/css/style.css" />
<script type="text/javascript" src="file/main/2018/js/jquery.js"></script>
<!-- 必要元素 结束 -->

<!-- 表单元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<!-- 表单验证元素 结束 -->

<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
<!-- 弹窗元素 结束 -->

<!-- 加密元素 开始 -->
<script type="text/javascript" src="file/main/js/util/RSA.js"></script>  
<script type="text/javascript" src="file/main/js/util/BigInt.js"></script>  
<script type="text/javascript" src="file/main/js/util/Barrett.js"></script>
<!-- 加密元素 结束 -->

<!-- 最后运行元素 开始 -->
 <!-- 最后运行元素 结束 -->
</head>
<body>
<!-- 第1步 -->
<div id="step1" style="display: block;">
	<div class="login-box box">
	  	<form method="post" name="loginForm"   class="lg-fm">
	  		<input type="hidden" name="passWordRsa" id="passWordRsa"/>
	      	<input type="hidden" name="verifyCode" id="verifyCode"/>
	      	<input type="hidden" name="sendVerifyCode" id="sendVerifyCode" value="0"/>
	      	<input type="hidden" name="checkType" id="checkType" value="1"/>
	      	
     		<a href="javascript:void(0);" class="top-logo"><img src="file/main/2018/images/logo.png" alt=""/></a>
     		<div id="login-error" class="login-error">
			    <span class="icon-error"></span>
			    <span id="login-error-text" class="notice-descript"></span>
			</div>
      	  <div id="login_user">
		   		<label><input class="lg-input" id="userName" name="userName" type="text" placeholder="请输入账号" tabindex="1"/></label>
		   		<input class="lg-input" type="password" id="password" name="passWord" placeholder="请输入密码" tabindex="2"/>
	      	</div>
			<input class="lg-input lg-btn" type="submit" id="提交" name="提交" value="确认登陆"/>
		  <div class="one-key"></div>
     	</form>
	</div>
 
</div>

   </body>
    
</html>
