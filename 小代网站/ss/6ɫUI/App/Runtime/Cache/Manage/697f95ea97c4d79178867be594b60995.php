<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
<link rel="stylesheet" href="__PUBLIC__/Manage/css/bootstrap.css">
<link rel="stylesheet" href="__PUBLIC__/Manage/fonts/web-icons/web-icons.css">
<link rel="stylesheet" href="__PUBLIC__/Manage/fonts/font-awesome/font-awesome.css">
<script src="__PUBLIC__/Manage/js/jquery.js"></script>
<script src="__PUBLIC__/Manage/js/jquery.form.js"></script>
<script src="__PUBLIC__/Manage/js/bootstrap.js"></script>
<script src="__PUBLIC__/Manage/js/layer/layer.js"></script>
<script src="__PUBLIC__/Manage/js/cvphp.js"></script>
		<title><?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>贷款系统</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/site.css">
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/login.css">
	</head>
	<body class="page-login layout-full page-dark">
		<div class="page height-full">
			<div class="page-content height-full">
				<div class="page-brand-info vertical-align animation-slide-left hidden-xs">
					<div class="page-brand vertical-align-middle">
						<div class="brand">
							<img class="brand-img" src="<?php echo ((C("siteLogo"))?(C("siteLogo")):''); ?>"height="50">
						</div>
						<h2 class="hidden-sm"><?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>贷款管理系统</h2>
						<ul class="list-icons hidden-sm">
							<li>
								<i class="wb-check" aria-hidden="true"></i> <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>小额贷款系统</li>
							<li><i class="wb-check" aria-hidden="true"></i> <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> 最大程度上帮助企业节省时间成本和费用开支</li>
							<li><i class="wb-check" aria-hidden="true"></i> <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> 小额贷款系统 紧贴业务特性，涵盖了大量的常用组件和基础功能，最大程度上帮助企业节省时间成本和费用开支。
							</li>
						</ul>
					<p>
			<p style="text-align: center;">

					</div>

			</div>
				<div class="page-login-main animation-fade">
					<div class="vertical-align">
						<div class="vertical-align-middle">
							<div class="brand visible-xs text-center">
								<img class="brand-img" src="__PUBLIC__/Manage/images/logo.svg" height="50">
							</div>
							<h3 class="hidden-xs"><?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> 贷款管理系统</h3>
							<form class="login-form" method="post">
								<div class="form-group">
									<label class="sr-only" for="username">用户名</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名">
								</div>
								<div class="form-group">
									<label class="sr-only" for="password">密码</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
								</div>
								<div class="form-group">
									<label class="sr-only" for="password">验证码</label>
									<div class="input-group">
										<input type="text" class="form-control" name="captcha" id="captcha-input" placeholder="请输入验证码">
										<a class="input-group-addon padding-0 reload-vify" href="javascript:;">
											<img src="<?php echo U('Index/captcha');?>" id="captcha-img" height="40">
										</a>
									</div>
								</div>
								<button type="button" class="btn btn-primary btn-block margin-top-30">立即登录</button>
								<p style="text-align: center;">
    <span style="color: rgb(165, 165, 165);"><strong><span style="font-size: 20px;"><br/></span></strong></span>
</p>

							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</body>
	<script>
		$(function(){
			$("#captcha-img").on('click',function(){
    			$("#captcha-input").val('');
    			var imgUrl = "<?php echo U('Index/captcha',array('t','randTime'));?>";
    			imgUrl = imgUrl.replace(/randTime/,Date.parse(new Date()));
    			$("#captcha-img").attr('src',imgUrl);
    			$("#captcha-input").focus();
			});
			$("button").on('click',function(){
				cvphp.submit($("form"),function(data){
					if(data.status!=1){
						layer.msg(data.info);
					}else{
						window.location.href = "<?php echo U('Index/index');?>";
					}
				});
			});
		});
	</script>
</html>