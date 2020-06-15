<?php
/**
 * 源码加密
**/
include("../includes/common.php");
$title='批量混淆加密';
include './head.php';
?>
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css"/>
<script src="../assets/js/sweetalert.min.js"></script>
<?php
if($_GET['my']=='') {
@$jmrun=file_get_contents('./jmrun.txt');
if(file_exists('./jmrun.txt'))$zt='<font color=green>已完成</font><br>'.$jmrun;else $zt='<font color=red>未完成</font>';
?>
      <div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">加密信息</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
上次加密状态：<?php echo $zt; ?><br>
<br><font color=pink>( 在使用本功能之前，请您耐心读完下面的内容 )</font><br>
<font color=pink>( 批量加密必须使用电脑运行，否则加密不了 )</font><br>
<font color=pink>( 上传文件完后会自动解压到文件夹 )</font><br>
<font color=pink>( 然后等待提示下载点击下载就OK了 )</font><br></pre>
        </li>
          </ul>
      </div>
 <div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">文件上传</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
<form action="./jiami.php?my=up" method="post"
enctype="multipart/form-data">
<label for="file">选择压缩文件(zip):</label>
<input type="file" name="file" id="file" />
<br/>
<input type="submit" name="submit" class="btn btn-round btn-success" value="上传文件" />
</form>
</div>
</div>
<?php
/*
Auat：陌屿
QQ：2763994904
Grup：777824195
Name：陌屿云加密系统
*/
}else if($_GET['my']=='do') {
$starttime = explode(' ',microtime());?> 
<div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">上传信息</h3>
</div>
<ul class="list-group">
<li class="list-group-item">
<font color=pink>加密进行中！请立刻关闭本页面</font><br>
<font color=pink>本站会宕机，请稍后回来查看加密进度</font><br>
<br>
</pre>
<a href='./jiami.php' class="btn btn-primary form-control"/ >返回加密</a></div>
<?php
echo'<div class="container" style="padding-top:1000000px;">';
echo'<div class="col-xs-111111 col-sm-111111 col-lg-146446468 center-block" style="float: none;">';
?>
<?php
echo '<br>完整包：<br>';
require_once('../includes/moyu/encipher.php'); //函数目录
$dir1 =  './instali/moyujm'; //加密的文件目录
$encipher = new Encipher($dir1,$dir1);
$encipher->advancedEncryption = true;
$encipher->encode();
$endtime = explode(' ',microtime());
$thistime = $endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]);
$thistime = round($thistime,3);
echo "<br>本次加密耗时：".$thistime." 秒。";
file_put_contents('jmrun.txt', "<br>本次加密耗时：".$thistime." 秒。");	
echo "<script type='text/javascript'>swal({title:'加密耗时',text:'".$thistime." 秒点击下载 已加密文件！',type:'success'},function(isConfirm){if(isConfirm){window.location.href='download.php?my=jm'}else{return false;}});</script>";
?>
<?php require_once('./dabao.php'); }?>
<?php
if($_GET['my']=='up') { 
$ra=$DB->query("select * from moyu_dl where dl_user = '{$_SESSION['user']}'");
$row = $DB->fetch($ra);
$jiage=1;
if($row['dl_money'] <= 0)
exit("<script language='javascript'>alert('您的余额不足，请联系管理员充值！！');history.go(-1);</script>");
$deduct="update moyu_dl set dl_money=dl_money-5 where dl_user = '{$_SESSION['user']}'";
$DB->query($deduct);
?>      
<div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">上传信息</h3>
</div>
<ul class="list-group">
<li class="list-group-item">
<font color=pink>上传成功！</font><br>
<font color=pink>上传的文件已经自动命名成功！</font><br>
<br>
</pre>
<a href='./jiami.php?my=do' class="btn btn-primary form-control"/>执行加密程式</a><br>
<br><a href='./jiami.php' class="btn btn-primary form-control"/ >返回加密</a></div>
<?php 
copy($_FILES['file']['tmp_name'],'./instali/update/myjm.zip');//上传文件的目录
?>
<?php require_once('./jieya.php'); }?>
<?php include './foot.php'; ?>