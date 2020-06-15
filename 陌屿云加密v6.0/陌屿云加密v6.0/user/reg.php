<?php
include("../includes/common.php");
$title='用户注册';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<title>注册 - <?php echo $conf['title'] ?></title>
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<link rel="stylesheet" href="../assets/static/user_style/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/static/user_style/css/plugins.css">
<link rel="stylesheet" href="../assets/static/user_style/css/main.css">
<link rel="stylesheet" href="../assets/static/user_style/css/themes.css">
<link rel="shortcut icon" href="../assets/static/logo.png">
<script src="../assets/static/user_style/js/vendor/modernizr-2.8.3.min.js"></script>
<link href="../assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../assets/js/sweetalert.min.js"></script>
</head>
<body>
<script type="text/javascript">
var childWindow;
function toQzoneLogin()
{
childWindow = window.location.href="./social.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1";
} 
function closeChildWindow()
{
childWindow.close();
}
</script>
<img src="../assets/static/user_style/img/placeholders/layout/lock_full_bg.jpg" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
<div id="login-container">
<h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
<i class="fa fa-cloud"></i> <strong><?php echo $conf['title'] ?></strong>
</h1>
<div class="block animation-fadeInQuickInv">
<div class="block-title">
<div class="block-options pull-right">
<a href="./login.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="返回登录"><i class="fa fa-user"></i></a>
</div>
<h2>用户注册</h2>
</div>

<form action="./reg.php" method="POST" role="form" class="form-horizontal">

<div class="form-group">
<div class="col-xs-12">
<input type="text" name="user" class="form-control" maxlength="16" placeholder="输入登录用户名"/>
</div></div>
			
<div class="form-group">
<div class="col-xs-12">
<input type="password" name="pass" class="form-control" maxlength="16" placeholder="输入6~16位登录密码"/>
</div></div>

<div class="form-group">
<div class="col-xs-12">
<input type="text" name="qq" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="10" placeholder="输入您的联系QQ号"/>
</div></div>


<div class="input-group">
<input type="text" class="form-control input-lg" name="code" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="4" placeholder="输入验证码" autocomplete="off" required>
<span class="input-group-addon" style="padding: 0">
<img src="./code.php?r=<?php echo time();?>"height="43"onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
</span>
</div><br/>

<div class="form-group form-actions">
<div class="col-xs-6">
<label class="csscheckbox csscheckbox-primary" data-toggle="tooltip" title="同意协议">
<input type="checkbox" id="register-terms" name="register-terms" checked>
<span></span>
</label>
<a href="#modal-terms" data-toggle="modal">
<small>用户协议</small>
</a>
</div>
<div class="col-xs-6 text-right">
<button type="submit" name="submit" class="btn btn-effect-ripple btn-info">注 册</button>
<?php
if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['qq'])){
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
$qq = daddslashes($_POST['qq']);
$code=daddslashes($_POST['code']);
if(!$code || strtolower($_SESSION['mulin_code'])!=strtolower($code)){
echo "<script type='text/javascript'>swal({title:'温馨提示',text:'验证码错误',type:'error'},function(isConfirm){if(isConfirm){window.location.href='./reg.php'}else{return false;}});</script>";
exit();
}elseif($user==NULL or $pass==NULL or $qq==NULL){
echo "<script type='text/javascript'>swal({title:'注册失败',text:'请确保每项都不为空！',type:'error'},function(isConfirm){if(isConfirm){window.location.href='./reg.php'}else{return false;}});</script>";
exit();
}else
    $rs=$DB->query("select * from moyu_dl where dl_user = '{$user}'");
    //
    if($res = $DB->fetch($rs)){
        echo "<script type='text/javascript'>swal({title:'温馨提示',text:'该用户名已存在！',type:'error'},function(isConfirm){if(isConfirm){history.go(-1)}else{return false;}});</script>";
    }else{
        $DB->query("insert into moyu_dl values(null,'{$user}','{$pass}','{$qq}',0,0)");
        echo "<script type='text/javascript'>swal({title:'注册成功',text:'注册成功！请联系站长购买开通！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='./login.php'}else{return false;}});</script>";
    }
}elseif($_SESSION['islogin']==1){
  echo "<script type='text/javascript'>swal({title:'登录成功',text:'您已登入！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='./'}else{return false;}});</script>";
}
?>
</div>
</div>
</form>

<hr>
<div class="push text-center">- JM -</div>
<div class="row push">
<div class="col-xs-6">
<a href="./login.php" class="btn btn-effect-ripple btn-sm btn-info btn-block"><i class="fa fa-user"></i> 返回登录</a>
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
<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title text-center"><strong>用户注册协议</strong></h3>
</div>
<div class="modal-body">
<h4 class="page-header">1. <strong>须知</strong></h4>

<p>陌屿云加密系统，注册没有加密额度。如需购买额度请联系ＱＱ：<?php echo $conf['zzqq'] ?></p>
<center>
<span style="color:#0000FF;"><p>★★★★★★★★★★★★★★★★★★★★★★★★</p></span>
<p><b>陌屿云加密系统源码版权【陌屿】</b><br />
<p><b>2015 - 2018 © 陌屿网络</b></p>
<span style="color:#0000FF;"><p>★★★★★★★★★★★★★★★★★★★★★★★★</p></span>
</center>
</div>
<div class="modal-footer">
<div class="text-center">
<button type="button" class="btn btn-effect-ripple btn-sm btn-primary" data-dismiss="modal">我明白了!</button>
</div>
</div>
</div>
</div>
</div>

<script src="../assets/static/user_style/js/vendor/jquery-2.2.0.min.js"></script>
<script src="../assets/static/user_style/js/vendor/bootstrap.min.js"></script>
<script src="../assets/static/user_style/js/plugins.js"></script>
<script src="../assets/static/user_style/js/app.js"></script>
<script src="../assets/static/user_style/js/pages/readyRegister.js"></script>
<script src="../assets/static/user_style/js/postAndMore.js"></script>
<script src="../assets/static/layer/layer.js"></script>

</body>
</html>