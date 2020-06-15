<?php
/*
Auat：陌屿
QQ：2763994904
Grup：777824195
Name：陌屿云加密系统
*/
include("../includes/common.php");
$title='修改密码';
include './head.php';
?>
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css"/>
<script src="../assets/js/sweetalert.min.js"></script>
<?php
if(!empty($_POST['user']) && !empty($_POST['qq']) && !empty($_POST['pass'])){
    $pass=daddslashes($_POST['pass']);
    $user= daddslashes($_POST['user']);
    $DB->query("update moyu_dl set dl_pwd = '{$pass}' where dl_user = '{$user}'");  
  echo "<script type='text/javascript'>swal({title:'登录成功',text:'修改密码成功，请重新登陆！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='./login.php?logout'}else{return false;}});</script>";
}
?>
    <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">账号信息修改</h3></div>
<div class="panel-body">
  <form action="./set.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户名</label>
	  <div class="col-sm-10"><input type="text" name="user" readonly value="<?php echo $_SESSION['user']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">QQ</label>
	  <div class="col-sm-10"><input type="text" name="qq" readonly  value="<?php echo $_SESSION['qq']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">密码</label>
	  <div class="col-sm-10"><input type="password" name="pass" value="" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
</div>
</div>
<?php
include './foot.php';
?>