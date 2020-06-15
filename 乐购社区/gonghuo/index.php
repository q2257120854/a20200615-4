<?
include('../system/inc.php');
if ($_POST['act']=='login')
{
	
null_back($_POST['name'],'请输入用户名');	
null_back($_POST['pwd'],'请输入用户密码');	
 gonghuologin($_POST['name'],$_POST['pwd'],$zhu_id);
}

?>

 <!DOCTYPE html>
 <html class="no-focus" lang="en">
<head>
<meta charset="utf-8">
  <title><?=$site_name?> - 供货商登录</title>
       <link rel="shortcut icon" href="<?=$site_ico?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="assets/style/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/style/font-awesome_4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" id="css-main" href="assets/style/bootstrap/css/login.css">
</head>
<body>
<div class="content overflow-hidden">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<div class="block block-themed animated fadeIn block-rounded">
				<div class="block-content block-content-full block-content-narrow">
					<div class="text-center push-20-t push-50">
						<a href="#">
						<img src="assets/style/login-logo.png" style="width: 60px;height: 60px;">
						<h2 class="brand-text font-size-18" style="font-size:25px">供货商登陆</h2>
						</a>
					</div>
					<form class="form-horizontal push-20-t push-20" action="" method="post"  id="subform" name="subform"><input name="act" type="hidden" value="login">
<div id="particles-js">
						<div id="login-error" class="login-error">
							<span class="icon-error"></span>
							<span id="login-error-text" class="notice-descript"></span>
						</div>
						<div id="login_user">
						 
							<div class="form-material input-group floating">
								<input class="form-control"   placeholder="供货商登录帐号" name="name"  type="text" tabindex="1"/></label>
								 
								<span class="input-group-addon">
								<i class="fa fa-user">
								</i>
								</span>
							</div>
							<div class="form-material input-group floating push-30-t">
								<input class="form-control"  placeholder="供货商登录密码" type="password" name="pwd"  tabindex="2"/>
								 
								<span class="input-group-addon">
								<i class="fa fa-key fa-fw">
								</i>
								</span>
							</div>
						
							</div>
							<div class="form-group">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<input class="btn btn-lg btn-block btn-success" ame="submit" onclick="document.getElementById('subform').submit();return false" value="确认登陆"/>

								</div>
							</div>
							<div class="one-key">
							</div>
					 
					</form>
				</div>
			</div>
		</div>
	</div>