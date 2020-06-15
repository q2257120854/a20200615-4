<?php
/**
 * 添加站点
**/
include("../includes/common.php");
$title='添加站点';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if(isset($_POST['qq']) && isset($_POST['url'])){
$qq=daddslashes($_POST['qq']);
$url=daddslashes($_POST['url']);
$row=$DB->get_row("SELECT * FROM auth_site WHERE uid='{$qq}' limit 1");
if($row=='')exit("<script language='javascript'>alert('授权平台不存在该QQ！');history.go(-1);</script>");
if($row['active']==0)exit("<script language='javascript'>alert('此QQ的授权已被封禁！');history.go(-1);</script>");
$url_arr=explode(',',$url);
$re='';
foreach($url_arr as $val) {
	$row1=$DB->get_row("SELECT * FROM auth_site WHERE url='{$val}' limit 1");
	if($row1!='')continue;
	$sql="insert into `auth_site` (`uid`,`url`,`date`,`authcode`,`active`,`sign`,`daili`) values ('".$qq."','".trim($val)."','".$date."','".$row['authcode']."','1','".$row['sign']."','".$daili_id."')";
	$DB->query($sql);
	$re.=$val.',';
}
if($re){
$city=get_ip_city($clientip);
$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','添加站点','".$date."','".$city."','".$qq."|".$re."')");
exit("<script language='javascript'>alert('{$re}添加成功！');history.go(-1);</script>");
}else
exit("<script language='javascript'>alert('添加失败，可能域名已存在！');history.go(-1);</script>");
} ?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>添加授权（已购买者）</h4>
</div>
<div class="card-body">
<form action="./addsite.php" method="post" class="form-horizontal" role="form">
<div class="input-group">
<span class="input-group-addon">授权ＱＱ</span>
<input type="text" name="qq" value="<?=@$_POST['qq']?>" class="form-control" onkeyup="value=value.replace(/[^1234567890]+/g,'')" maxlength="10" placeholder="已经授权过的QQ" autocomplete="off" required/>
</div><br/>
<div class="input-group">
<span class="input-group-addon">授权域名</span>
<input type="text" name="url" value="<?=@$_POST['url']?>" class="form-control" onkeyup="checkURL();" placeholder="比如：www.baidu.com" autocomplete="off" required/>
</div><br/>
<div class="form-group"></div>
<button type="submit" class="btn btn-primary btn-block">添加授权</button>
</div>
</form>
</div>
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