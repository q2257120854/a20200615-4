<?php
/*
陌屿<2763994904@qq.com>
陌屿代码加密系统
官方QQ群：42103442
*/
error_reporting(0);
include("../includes/common.php");
$title='后台管理';
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
      <h1>后台管理</h3>
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
          <button class="btn btn-block btn-primary"  type="submit" id="submit" name="submit">立即登录</button>
        </div>
      </form>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href=""><?php echo $conf["title"] ?></a>. All right reserved</p>
      </footer>
</form>
<?php
if(isset($_POST['user']) && isset($_POST['pass'])){
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
$pass=md5($pass);
if($user==$conf['admin_user'] && $pass==$conf['admin_pass']) {
$session=md5($user.$pass.$password_hash);
$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
setcookie("admin_token", $token, time() + 604800);
echo "<script type='text/javascript'>layer.alert('您已成功登入！',{icon:6,closeBtn:0},function(){window.location.href='./'});</script>";
}else{
echo "<script type='text/javascript'>layer.alert('账号或者密码不正确！',{icon:5,closeBtn:0},function(){history.go(-1)});</script>";
}
}elseif(isset($_GET['logout'])){
setcookie("admin_token", $token, time() - 604800);
echo "<script type='text/javascript'>layer.alert('你已注销成功本次登录！',{icon:6,closeBtn:0},function(){window.location.href='./login.php'});</script>";
}elseif($islogin==1){
echo "<script type='text/javascript'>layer.alert('您已登录！',{icon:6,closeBtn:0},function(){window.location.href='./'});</script>";
}
?>
    </div>
  </div>
</div>
<script src="../assets/layui/layui.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
</body>
</html>