<?php
/**
 * 登录
**/
include("../includes/common.php");
$title="管理后台";
if(isset($_POST['user']) && isset($_POST['pass'])){
	if(!$_SESSION['pass_error'])$_SESSION['pass_error']=0;
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$row = $DB->get_row("SELECT * FROM auth_daili WHERE user='$user' limit 1");
	if($_SESSION['pass_error']>5) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif($row['user']=='') {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif ($pass != $row['pass']) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif ($row['active']==0) {
		@header('Content-Type: text/html; charset=UTF-8');
		//exit("<script language='javascript'>alert('您的授权平台账号已被封禁！');history.go(-1);</script>");
		sysmsg("<h3>您的平台账号违规使用被禁封</p>有问题联系站长QQ：2763994904</h3>");
	}elseif($row['user']==$user && $row['pass']==$pass){
		$citylist=explode(',',$row['citylist']);
		$city=get_ip_city($clientip);
		if($row['citylist'] && !in_array($city,$citylist)){
			$DB->query("update auth_daili set active='0' where uid='{$row['uid']}'");
			$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','异常登陆','".$date."','".$city."','IP:".$clientip."')");
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('系统检测到您有异常登录，账号已封禁！');history.go(-1);</script>");
		}
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("auth_token2", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		$city=get_ip_city($clientip);
		$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','登陆平台','".$date."','".$city."','IP:".$clientip."')");
		exit("<script language='javascript'>alert('登陆授权平台成功！');window.location.href='./';</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("auth_token2", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogins==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
if($conf['repair']==0){
	sysmsg("<h3>授权站更新维护中</h3></br><h3>源码不影响使用站点维护</h3></br><h3>授权站恢复静等通知谢谢合作</h3></br><h3>如果您有如何疑问请联系QQ <a href='http://wpa.qq.com/msgrd?v=3&uin=2763994904&site=qq&menu=yes'> 2763994904 </a><h3>");
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $conf["title"] ?> - <?php echo $title ?></title>
<link rel="icon" href="../assets/LightYear/favicon.ico" type="image/ico">
<meta name="keywords" content="<?php echo $conf["title"] ?>,代码保护专家,高效快捷保护你的代码安全。"/>
<meta name="description" content="<?php echo $conf["title"] ?>,虚拟主机,服务器都可以安全运行。！"/>
<meta name="author" content="yinqi">
<link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.lyear-wrapper {
    position: relative;
}
.lyear-login {
    display: flex !important;
    min-height: 100vh;
    align-items: center !important;
    justify-content: center !important;
}
.login-center {
    background: #fff;
    min-width: 38.25rem;
    padding: 2.14286em 3.57143em;
    border-radius: 5px;
    margin: 2.85714em 0;
}
.login-header {
    margin-bottom: 1.5rem !important;
}
.login-center .has-feedback.feedback-left .form-control {
    padding-left: 38px;
    padding-right: 12px;
}
.login-center .has-feedback.feedback-left .form-control-feedback {
    left: 0;
    right: auto;
    width: 38px;
    height: 38px;
    line-height: 38px;
    z-index: 4;
    color: #dcdcdc;
}
.login-center .has-feedback.feedback-left.row .form-control-feedback {
    left: 15px;
}
</style>
</head>
  
<body>
<div class="row lyear-wrapper">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
      <h1>管理登陆</h3>
      </div>
       <form action="./login.php" method="POST" role="form" class="form-horizontal">
        <div class="form-group has-feedback feedback-left">
          <input type="text" name="user" value="<?php echo @$_POST['user']?>" placeholder="请输入用户名称" class="form-control"/>
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" name="pass" placeholder="请输入用户密码" class="form-control"/>
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left row">
          <button class="btn btn-block btn-primary"  type="submit">立即登录</button>
        </div>
      </form>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href=""><?php echo $conf["title"] ?></a></p>
      </footer>
</form>
    </div>
  </div>
</div>
<script src="../assets/layui/layui.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
</body>
</html>