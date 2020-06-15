<?php
/**
 * 登录
**/
$is_defend=true;
include("../includes/common.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$user}' limit 1")->fetch();
	if($user==$userrow['id'] && $pass==$userrow['key']) {
		if($user_id=$_SESSION['Oauth_alipay_uid']){
			$DB->exec("update `pay_user` set `alipay_uid` ='$user_id' where `id`='$user'");
			unset($_SESSION['Oauth_alipay_uid']);
		}
		if($qq_openid=$_SESSION['Oauth_qq_uid']){
			$DB->exec("update `pay_user` set `qq_uid` ='$qq_openid' where `id`='$user'");
			unset($_SESSION['Oauth_qq_uid']);
		}
		$city=get_ip_city($clientip);
		$DB->query("insert into `panel_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','登录用户中心','".$date."','".$city."','".$clientip."')");
		$session=md5($user.$pass.$password_hash);
		$expiretime=time()+604800;
		$token=authcode("{$user}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登录用户中心成功！');window.location.href='./';</script>");
	}else {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("user_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>登录 | <?php echo $conf['web_name']?></title>
    <!-- Favicon-->
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="./" title="" target="_blank"><?php echo $conf['web_name']?></a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link btn btn-white btn-round" href="reg.php">注册</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="post" action="login.php">
                    <div class="header">
                        <div class="logo-container">
                            <img src="assets/images/logo.svg" alt="">
                        </div>
                        <h5>Log in</h5>
                    </div>
                    <div class="content">                                                
                        <div class="input-group input-lg">
                            <input type="text" name="user" value="<?php echo @$_GET['user']?>" class="form-control" placeholder="ID" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group input-lg">
                            <input type="password" name="pass" value="<?php echo @$_GET['pass']?>" placeholder="KEY" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                      </div>
<label class="i-checks">
  <input type="checkbox" ng-model="agree" checked required><i></i> 同意<a href="agreement.html" target="_blank"> 我们的条款。</a>
</label>
<br>
                    <div class="footer text-center">
                    	<h5><p class="link">其他方式登陆：<a href="oauth.php" ui-sref="access.signup"  <?php echo isset($_GET['connect'])||$conf['quicklogin']!=1?'hide':null;?>"><img src="../assets/icon/alipay.ico" width="28px">支付宝快捷登录</a>
<a href="connect.php" ui-sref="access.signup" <?php echo isset($_GET['connect'])||$conf['quicklogin']!=2?'hide':null;?>"><img src="../assets/icon/qqpay.ico" width="28px">ＱＱ快捷登录</a>
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block " ng-click="login()" ng-disabled='form.$invalid'>立即登入</button>
                        <h5><a href="findpwd.php" class="link">忘记账户?</a></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>Designed by <a href="#" target="_blank"><?php echo $conf['web_name']?></a></span>
            </div>
        </div>
    </footer>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
//=============================================================================
$('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
}).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
});
</script>
</body>
</html>