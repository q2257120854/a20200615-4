<?php
/**
 * 获取密码
**/
$mod='blank';
include("../includes/common.php");
$title='获取密码';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$url = $_GET['url'];

$row=$DB->get_row("SELECT * FROM auth_site WHERE url='$url' limit 1");
if($row['active'] != 1){}else exit("<script language='javascript'>alert('此站点位于正版列表内！');history.go(-1);</script>");

$db=$DB->get_row("SELECT * FROM auth_block WHERE url='$url' limit 1");
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>获取密码</h4>
</div>
<div class="card-body">
<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>站点网址：</b> <?=$url?></a></li>
<li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>入库时间：</b><?=$db['date']?> </li>
</li>
</ul>
</div>
</div>
<script>
function checkURL()
{
	var url;
	url = document.auth.url.value;

	if (url.indexOf(" ")>=0){
		url = url.replace(/ /g,"");
		document.auth.url.value = url;
	}
	if (url.toLowerCase().indexOf("http://")==0){
		url = url.slice(7);
		document.auth.url.value = url;
	}
	if (url.toLowerCase().indexOf("https://")==0){
		url = url.slice(8);
		document.auth.url.value = url;
	}
	if (url.slice(url.length-1)=="/"){
		url = url.slice(0,url.length-1);
		document.auth.url.value = url;
	}
}
</script>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>操作信息</h4>
</div>
<div class="card-body">
<form action="./getpwd.php" method="GET" class="form-horizontal" role="form" name="auth">
<div class="input-group">
<span class="input-group-addon">网址</span>
<input type="text" name="url" onkeyup="checkURL();" value="<?=$url?>" class="form-control" autocomplete="off" required/>
</div><br/>
<div class="input-group">
<span class="input-group-addon">方式</span>
<select class="form-control" name="m">
<option value="1">获取密码</option>
</select>
</div><br/>
<div class="form-group">
<div class="col-sm-12"><input type="submit" value="获取密码" class="btn btn-info form-control"/></div>
</div>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>