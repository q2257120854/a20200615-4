<?php
/**
 * 系统设置
**/
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<div class="container" style="padding-top:70px;">
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php


if(isset($_POST['submit'])) {
	foreach ($_POST as $k => $value) {
		if($k=='pwd')continue;
		$value=daddslashes($value);
		$DB->query("insert into moyu_config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
	}
	$pwd=daddslashes($_POST['pwd']);
	if(!empty($pwd))$DB->query("update `moyu_config` set `v` ='{$pwd}' where `k`='admin_pwd'");
	showmsg('修改成功！',1);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">系统配置</h3></div>
<div class="panel-body">
  <form action="./set.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称</label>
	  <div class="col-sm-10"><input type="text" name="title" value="<?php echo $conf['title']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">关键字</label>
	  <div class="col-sm-10"><input type="text" name="keywords" value="<?php echo $conf['keywords']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站描述</label>
	  <div class="col-sm-10"><input type="text" name="description" value="<?php echo $conf['description']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站长ＱＱ</label>
	  <div class="col-sm-10"><input type="text" name="zzqq" value="<?php echo $conf['zzqq']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页公告</label>
	  <div class="col-sm-10"><input type="text" name="modal" value="<?php echo $conf['modal']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP发件箱</label>
	  <div class="col-sm-10"><input type="text" name="smtpmail" value="<?php echo $conf['smtpmail']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP服务器</label>
	  <div class="col-sm-10"><input type="text" name="smtpfwq" value="<?php echo $conf['smtpfwq']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP端口</label>
	  <div class="col-sm-10"><input type="text" name="smtpdk" value="<?php echo $conf['smtpdk']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP账号</label>
	  <div class="col-sm-10"><input type="text" name="smtpuser" value="<?php echo $conf['smtpuser']; ?>" class="form-control"/></div>
	</div><br/>		
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP密钥</label>
	  <div class="col-sm-10"><input type="text" name="smtppass" value="<?php echo $conf['smtppass']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
		<label class="col-sm-2 control-label">防腾讯检测</label>
		<div class="col-sm-10">
			<select class="form-control" id="txprotect" name="txprotect">
				<option value="1" <?php if($conf['txprotect']==1) echo "selected"; ?> >开启</option>
				<option value="2" <?php if($conf['txprotect']==2) echo "selected"; ?>>关闭</option>
			</select>
		</div>
	</div><br/>
		<div class="form-group">
		<label class="col-sm-2 control-label">QQ跳转</label>
		<div class="col-sm-10">
			<select class="form-control" id="qqtz" name="qqtz">
				<option value="1" <?php if($conf['qqtz']==1) echo "selected"; ?> >开启</option>
				<option value="2" <?php if($conf['qqtz']==2) echo "selected"; ?>>关闭</option>
			</select>
			<font style="color: green;">QQ点击网址跳转到默认浏览器打开</font>
		</div>		
	</div><br/>	
		<div class="form-group">
	  <label class="col-sm-2 control-label">密码重置</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
<?php
}?>
</div>
</div>