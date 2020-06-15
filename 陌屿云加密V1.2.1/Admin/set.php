<?php
include("../includes/common.php");
//官方群 414628263

$title='系统管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
echo'
<main class="lyear-layout-content">
<div class="container-fluid">';

$mod=isset($_GET['mod'])?$_GET["mod"]:NULL;
if($mod=="site_n" && $_POST["do"] == "submit"){
	if($_POST['title'] == NULL && $_POST['qq'] == NULL){
		exit("<script type='text/javascript'>layer.alert('必填项不能为空！',{icon:5},function(){history.go(-1)});</script>");
    }
    saveSetting('title',$_POST['title']);
    saveSetting('qq',$_POST['qq']);
    saveSetting('keywords',$_POST['keywords']);
    saveSetting('description',$_POST['description']);
    saveSetting('sizekb',$_POST['sizekb']);
    saveSetting('gg',$_POST['gg']);
    saveSetting('repair',$_POST['repair']);
	$ad=$CACHE->clear();
	if($ad)
		exit("<script type='text/javascript'>layer.alert('修改成功',{icon:6},function(){window.location.href='./set.php?mod=site'});</script>");
	else
		exit("<script type='text/javascript'>layer.alert('修改失败".$DB->error()."',{icon:5},function(){window.location.href='./set.php?mod=site'});</script>");
}elseif($mod=="site"){
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站网站</h4>
</div>
<div class="card-body">
<form action="./set.php?mod=site_n" method="post" class="form-horizontal" role="form">
<input type="hidden" name="do" value="submit">

<div class="input-group">
<span class="input-group-addon">网站标题</span>
<input type="text" name="title" class="form-control" placeholder="网站主要标题" value="<?=$conf['title']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">站长ＱＱ</span>
<input type="text" name="qq" class="form-control" placeholder="网站站长QQ号" value="<?=$conf['qq']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站词字</span>
<input type="text" name="keywords" class="form-control" value="<?=$conf['keywords']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站信息</span>
<input type="text" name="description" class="form-control" value="<?=$conf['description']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">文件限制</span>
<input type="text" name="sizekb" class="form-control" placeholder="前台加密文件大小限制" value="<?=$conf['sizekb']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站公告</span>
<textarea class="form-control" name="gg" placeholder="全站公告信息" rows="4"><?php echo htmlspecialchars($conf['gg']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">全站维护(后台不维护)</span>
<select name="repair" class="form-control" default="<?=$conf['repair']?>">
<option value="1">关闭</option><option value="0">开启</option>
</select>
</div><br/>

<div class="form-group">
<div class="col-sm-12"><button class="btn btn-primary form-control" type="submit">确认保存</button></div>
</div>

</form>
</div>
</div>
<?php
}elseif($mod=="check_n" && $_POST["do"] == "submit"){
	saveSetting('content',$_POST['content']);
	saveSetting('switch',$_POST['switch']);
	saveSetting('ipauth',$_POST['ipauth']);
	saveSetting('addblock',$_POST['addblock']);
	saveSetting('uplog',$_POST['uplog']);
	saveSetting('update',$_POST['update']);
	saveSetting('ver',$_POST['ver']);
	saveSetting('version',$_POST['version']);
	saveSetting('authfile',$_POST['authfile']);
	$ad=$CACHE->clear();
	if($ad)
		exit("<script type='text/javascript'>layer.alert('修改成功',{icon:6},function(){window.location.href='./set.php?mod=check'});</script>");
	else
		exit("<script type='text/javascript'>layer.alert('修改失败".$DB->error()."',{icon:5},function(){window.location.href='./set.php?mod=check'});</script>");
}elseif($mod=="check"){
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>授权配置</h4>
</div>
<div class="card-body">
<form action="./set.php?mod=check_n" method="post" class="form-horizontal" role="form">
<input type="hidden" name="do" value="submit">

<div class="input-group">
<span class="input-group-addon">盗版站点信息</span>
<input type="text" name="content" class="form-control" value="<?=$conf['content']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">开启验证授权</span>
<select name="switch" class="form-control" default="<?=$conf['switch']?>">
<option value="1">开启</option><option value="0">关闭</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">同时验证ＩＰ</span>
<select name="ipauth" class="form-control" default="<?=$conf['ipauth']?>">
<option value="1">开启</option><option value="0">关闭</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">记录盗版域名</span>
<select name="addblock" class="form-control" default="<?=$conf['addblock']?>">
<option value="1">开启</option><option value="0">关闭</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">更新提示信息</span>
<textarea class="form-control" name="uplog" rows="4"><?php echo htmlspecialchars($conf['uplog']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">是否开启更新</span>
<select name="update" class="form-control" default="<?=$conf['update']?>">
<option value="1">开启</option><option value="0">关闭</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">最新版本序号(显示用)</span>
<input type="text" name="ver" class="form-control" placeholder="比如：V1.01等于1001版本" value="<?=$conf['ver']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">最新版本序号(判断用)</span>
<input type="text" name="version" class="form-control" placeholder="比如：1001等于1.0.1版本" value="<?=$conf['version']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站授权码位置</span>
<input type="text" name="authfile" class="form-control" value="<?=$conf['authfile']?>">
</div><br/>

<div class="form-group">
<div class="col-sm-12"><button class="btn btn-primary form-control" type="submit">确认保存</button></div>
</div>

</form>
</div>
</div>
<?php	
}
?>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>