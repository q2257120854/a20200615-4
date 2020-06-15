<?php
include("../includes/common.php");
$title='用户登录';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<title>登录-<?php echo $conf['title'] ?></title>
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<link rel="stylesheet" href="../assets/static/user_style/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/static/user_style/css/plugins.css">
<link rel="stylesheet" href="../assets/static/user_style/css/main.css">
<link rel="stylesheet" href="../assets/static/user_style/css/themes.css">
<link rel="shortcut icon" href="../assets/static/logo.png">
<script src="../assets/static/user_style/js/vendor/modernizr-2.8.3.min.js"></script>
<i class="fa fa-cloud"></i> <span class="sidebar-nav-mini-hide"><?php echo $conf['title'] ?></span>
<link href="../assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../assets/js/sweetalert.min.js"></script>
</head>
<body>
<img src="../assets/static/user_style/img/placeholders/layout/lock_full_bg.jpg" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
<div id="login-container">
<h1 class="h2 text-light text-center push-top-bottom animation-pullDown">
<i class="fa fa-cloud text-light-op"></i> <strong><?php echo $conf['title'] ?></strong>
</h1>

<div class="block animation-fadeInQuick">
<div class="block-title">
<div class="block-options pull-right">
<a href="./reg.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="新用户注册"><i class="fa fa-plus-circle"></i></a>
</div>
<h2>用户登录</h2>
</div>

<form action="./login.php" method="POST" role="form" class="form-horizontal">

<div class="form-group">
<label for="login-user" class="col-xs-12">用户名</label>
<div class="col-xs-12">
<input type="text" name="user" class="form-control" placeholder="user" required/>
</div>
</div>


<div class="form-group">
<label for="login-password" class="col-xs-12">密码</label>
<div class="col-xs-12">
<input type="password" name="pass" class="form-control" placeholder="pass" required/>
</div>
</div>

<div class="form-group form-actions">
<div class="col-xs-8">
<label class="csscheckbox csscheckbox-primary">
<input type="checkbox" id="login-remember-me" name="remember" checked><span></span>
<small>记住我?</small>
</label>
</div>
<div class="col-xs-4 text-right">
<button type="submit" name="submit" class="btn btn-effect-ripple btn-sm btn-success">登 录</button>
</div>
</div>
</form>
<?php
if(!empty($_POST['user']) && !empty($_POST['pass'])){
   $user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
    $rs=$DB->query("select * from moyu_dl where dl_user = '{$user}'");
    //
    if($res = $DB->fetch($rs)){
        if($pass == $res['dl_pwd']){
            $_SESSION['user'] = $user;
            $_SESSION['islogin'] = 1;
            $_SESSION['qq'] = $res['dl_qq'];
            $_SESSION['zt'] = $res['dl_sta'];
            echo "<script type='text/javascript'>swal({title:'登录成功',text:'代理登入成功！',type:'success'},function(isConfirm){if(isConfirm){history.go(-1)}else{return false;}});</script>";
            
        }else{
            echo "<script type='text/javascript'>swal({title:'温馨提示',text:'密码错误！',type:'error'},function(isConfirm){if(isConfirm){history.go(-1)}else{return false;}});</script>";
        }
    }else{
echo "<script type='text/javascript'>swal({title:'温馨提示',text:'该代理用户不存在！',type:'error'},function(isConfirm){if(isConfirm){window.location.href='./login.php'}else{return false;}});</script>";
    }
}elseif(isset($_GET['logout'])){$_SESSION['islogin'] = 0;
    echo "<script type='text/javascript'>swal({title:'登录成功',text:'您已成功注销本次登入！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='./login.php'}else{return false;}});</script>";
}elseif($_SESSION['islogin']==1){
    echo "<script type='text/javascript'>swal({title:'登录成功',text:'您已登入！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='./index.php'}else{return false;}});</script>";
}
?>
<hr>
<div class="push text-center">- JM -</div>
<div class="row push">
<div class="col-xs-6">
<a href="./reg.php" class="btn btn-effect-ripple btn-sm btn-info btn-block"><i class="fa fa-plus-circle"></i> 注册账号</a>
</div>
<div class="col-xs-6">
<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf["zzqq"] ?>&site=qq&menu=yes" class="btn btn-effect-ripple btn-sm btn-info btn-block"><i class="fa fa-qq"></i> 联系客服</a>
</div>
</div>

</div>
<footer class="text-muted text-center animation-pullUp">
<small><span>2015 - 2018</span> &copy; <a href="/" target="_blank"><?php echo $conf['title'] ?></a></small>
</footer>
</div>

<script src="../assets/static/user_style/js/vendor/jquery-2.2.0.min.js"></script>
<script src="../assets/static/user_style/js/vendor/bootstrap.min.js"></script>
<script src="../assets/static/user_style/js/plugins.js"></script>
<script src="../assets/static/user_style/js/app.js"></script>

<script src="../assets/static/user_style/js/postAndMore.js"></script>
<script src="../assets/static/layer/layer.js"></script>
</body>
</html>