<?php
/**
 * 商户列表
**/
include("../includes/common.php");
$title='商户列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include 'nav.php';
?>
 
  <div class="container" style="padding-top:70px;">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">添加商户</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=add_submit" method="POST">
<div class="form-group">
<label>结算方式:</label><br><select class="form-control" name="settle_id">
'.($conf['stype_1']?'<option value="1">支付宝</option>':null).'
'.($conf['stype_2']?'<option value="2">微信</option>':null).'
'.($conf['stype_3']?'<option value="3">QQ钱包</option>':null).'
'.($conf['stype_4']?'<option value="4">银行卡</option>':null).'
</select>
</div>
<div class="form-group">
<label>结算账号:</label><br>
<input type="text" class="form-control" name="account" value="" required>
</div>
<div class="form-group">
<label>结算账号姓名:</label><br>
<input type="text" class="form-control" name="username" value="" required>
</div>
<div class="form-group">
<label>网站域名:</label><br>
<input type="text" class="form-control" name="url" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="email" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>ＱＱ:</label><br>
<input type="text" class="form-control" name="qq" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>自定义分成比例:</label><br>
<input type="text" class="form-control" name="rate" value="" placeholder="填写百分数，例如98.5">
</div>
<div class="form-group">
<label>是否结算:</label><br><select class="form-control" name="type"><option value="1">1_是</option><option value="2">2_否</option></select>
</div>
<div class="form-group">
<label>是否激活:</label><br><select class="form-control" name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-default btn-block"
value="确定添加"></form>';
echo '<br/><a href="./ulist.php">>>返回商户列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=$_GET['id'];
$row=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">修改商户信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>结算方式:</label><br><select class="form-control" name="settle_id" default="'.$row['settle_id'].'">
'.($conf['stype_1']?'<option value="1">支付宝</option>':null).'
'.($conf['stype_2']?'<option value="2">微信</option>':null).'
'.($conf['stype_3']?'<option value="3">QQ钱包</option>':null).'
'.($conf['stype_4']?'<option value="4">银行卡</option>':null).'
</select>
</div>
<div class="form-group">
<label>结算账号:</label><br>
<input type="text" class="form-control" name="account" value="'.$row['account'].'" required>
</div>
<div class="form-group">
<label>结算账号姓名:</label><br>
<input type="text" class="form-control" name="username" value="'.$row['username'].'" required>
</div>
<div class="form-group">
<label>商户余额:</label><br>
<input type="text" class="form-control" name="money" value="'.$row['money'].'" required>
</div>
<div class="form-group">
<label>网站域名:</label><br>
<input type="text" class="form-control" name="url" value="'.$row['url'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="email" value="'.$row['email'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>ＱＱ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>QQ分成比例:</label><br>
<input type="text" class="form-control" name="qqrate" value="'.$row['qqrate'].'" placeholder="填写百分数，例如98.5">
</div>
<div class="form-group">
<label>微信分成比例:</label><br>
<input type="text" class="form-control" name="wxrate" value="'.$row['wxrate'].'" placeholder="填写百分数，例如98.5">
</div>
<div class="form-group">
<label>支付宝分成比例:</label><br>
<input type="text" class="form-control" name="alirate" value="'.$row['alirate'].'" placeholder="填写百分数，例如98.5">
</div>
<div class="form-group">
<label>是否结算:</label><br><select class="form-control" name="type" default="'.$row['type'].'"><option value="1">1_是</option><option value="2">2_否</option></select>
</div>
<div class="form-group">
<label>是否激活:</label><br><select class="form-control" name="active" default="'.$row['active'].'"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<div class="form-group">
<label>是否重置密钥？</label><br><select class="form-control" name="resetkey"><option value="0">0_否</option><option value="1">1_是</option></select>
</div>
<input type="submit" class="btn btn-default btn-block" value="确定修改"></form>
';
echo '<br/><a href="./ulist.php">>>返回商户列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>';
}
elseif($my=='add_submit')
{
$settle_id=$_POST['settle_id'];
$account=$_POST['account'];
$username=$_POST['username'];
$money='0.00';
$url=$_POST['url'];
$email=$_POST['email'];
$qq=$_POST['qq'];
$type=$_POST['type'];
$qqrate=$_POST['qqrate'];
$wxrate=$_POST['wxrate'];
$alirate=$_POST['alirate'];
$active=$_POST['active'];
if($account==NULL or $username==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
$key = random(32);
$sds=$DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `addtime`, `type`, `settle_id`, `email`, `qq`, `qqrate`, `wxrate`, `alirate`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '{$money}', '{$url}', '{$date}', '{$type}', '{$settle_id}', '{$email}', '{$qq}', '{$qqrate}', '{$wxrate}', '{$alirate}', '{$active}')");
$pid=$DB->lastInsertId();
if($sds){
	showmsg('添加商户成功！商户ID：'.$pid.'<br/>密钥：'.$key.'<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else
	showmsg('添加商户失败！<br/>错误信息：'.$DB->errorCode(),4);
}
}
elseif($my=='edit_submit')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if(!$rows)
	showmsg('当前记录不存在！',3);
$settle_id=$_POST['settle_id'];
$account=$_POST['account'];
$username=$_POST['username'];
$money=$_POST['money'];
$url=$_POST['url'];
$email=$_POST['email'];
$qq=$_POST['qq'];
$type=$_POST['type'];
$qqrate=$_POST['qqrate'];
$wxrate=$_POST['wxrate'];
$alirate=$_POST['alirate'];
$active=$_POST['active'];
if($account==NULL or $username==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
$sql="update `pay_user` set `account` ='{$account}',`username` ='{$username}',`money` ='{$money}',`url` ='{$url}',`type` ='$type',`settle_id` ='$settle_id',`email` ='$email',`qq` ='$qq',`qqrate` ='$qqrate',`wxrate` ='$wxrate',`alirate` ='$alirate',`active` ='$active' where `id`='$id'";
if($_POST['resetkey']==1){
	$key = random(32);
	$sqs=$DB->exec("update `pay_user` set `key` ='{$key}' where `id`='$id'");
}
if($DB->exec($sql)||$sqs)
	showmsg('修改商户信息成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('修改商户信息失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='banalipay')
{
$sqs=$DB->exec("update `pay_user` set `alipay` ='1'");
  if($DB->exec($sql)||$sqs){
  showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='banwxpay')
{
$sqs=$DB->exec("update `pay_user` set `wxpay` ='1'");
  if($DB->exec($sql)||$sqs){
  showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='banqqpay')
{
$sqs=$DB->exec("update `pay_user` set `qqpay` ='1'");
  if($DB->exec($sql)||$sqs){
  showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='dbanalipay')
{
$sqs=$DB->exec("update `pay_user` set `alipay` ='2'");
  if($DB->exec($sql)||$sqs){
  showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='dbanwxpay')
{
$sqs=$DB->exec("update `pay_user` set `wxpay` ='2'");
  if($DB->exec($sql)||$sqs){
  showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='dbanqqpay')
{
$sqs=$DB->exec("update `pay_user` set `qqpay` ='2'");
  if($DB->exec($sql)||$sqs){
  showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}else{
  showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='alipay')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `alipay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='alipay_n')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `alipay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='wxpay')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `wxpay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='wxpay_n')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `wxpay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='qqpay')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `qqpay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('开启成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('开启失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='qqpay_n')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
showmsg('当前记录不存在！',3);
}else{
	$sqs=$DB->exec("update `pay_user` set `qqpay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	showmsg('关闭成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('关闭失败！'.$DB->errorCode(),4);
}
}
elseif ($my=='jk')
{
echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">商户加款</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=jk_submit" method="POST">
<div class="form-group">
<label>商户ID:</label><br>
<input type="text" class="form-control" name="id" value="" required>
</div>
<div class="form-group">
<label>加款余额:</label><br>
<input type="text" class="form-control" name="money" value="" required>
</div>
<div class="form-group">
<label>费率分成:</label><br>
<input type="text" class="form-control" name="fl" value="" required>
</div>
<input type="submit" class="btn btn-default btn-block"
value="确定加款"></form>';
echo '<br/><a href="./ulist.php">>>返回商户列表</a>';
echo '</div></div>';
}
elseif($my=='jk_submit')
{
$id=$_POST['id'];
$money=$_POST['money'];
$fl=$_POST['fl'];
if($id==NULL or $money==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
}else{
$addmoney=round($money*$fl/100,2);
$DB->query("update pay_user set money=money+{$addmoney} where id='{$id}'");
	showmsg('商户加款成功！商户ID：'.$id.'<br/>加款金额：'.$addmoney.'<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
}
}
elseif($my=='delete')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if(!$rows)
	showmsg('当前记录不存在！',3);
$urls=explode(',',$rows['url']);
$sql="DELETE FROM pay_user WHERE id='$id'";
if($DB->exec($sql))
	showmsg('删除商户成功！<br/><br/><a href="./ulist.php">>>返回商户列表</a>',1);
else
	showmsg('删除商户失败！'.$DB->errorCode(),4);
}
else
{

echo '<div class="text-center"><div class="alert alert-defauit"><form action="ulist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="id">商户号</option><option value="key">密钥</option><option value="account">结算账号</option><option value="username">结算姓名</option><option value="url">域名</option><option value="qq">QQ</option><option value="phone">手机号码</option><option value="email">邮箱</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>&nbsp;<a href="./ulist.php?my=add" class="btn btn-success">添加商户</a>&nbsp;<a href="./plist.php" class="btn btn-default">合作者商户管理</a>&nbsp;<a href="./ulist.php?my=jk" class="btn btn-default">商户加款</a>
</form></die></div>';

if($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from pay_user WHERE{$sql}")->rowCount();
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 个商户</div></di></div>';
}else{
	$numrows=$DB->query("SELECT * from pay_user WHERE 1")->rowCount();
	$sql=" 1";
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">共有 <b>'.$numrows.'</b> 个商户</div></div></div>';
}
echo $con;
?>
<?php
$alipay=$DB->query("select * from pay_user where id='1000' limit 1")->fetch();
$wxipay=$DB->query("select * from pay_user where id='1000' limit 1")->fetch();
$qqpay=$DB->query("select * from pay_user where id='1000' limit 1")->fetch();
if($alipay['alipay']==1){
	echo '<a href="./ulist.php?my=dbanalipay" class="btn btn-danger">一键关闭支付宝接口</a>&nbsp;';
}else{
	echo '<a href="./ulist.php?my=banalipay" class="btn btn-success">一键开启支付宝接口</a>&nbsp;';
}
if($alipay['wxpay']==1){
	echo '<a href="./ulist.php?my=dbanwxpay" class="btn btn-danger">一键关闭微信接口</a>&nbsp;';
}else{
	echo '<a href="./ulist.php?my=banwxpay" class="btn btn-success">一键开启微信接口</a>&nbsp;';
}
if($alipay['qqpay']==1){
	echo '<a href="./ulist.php?my=dbanqqpay" class="btn btn-danger">一键关闭QQ接口</a>&nbsp;';
}else{
	echo '<a href="./ulist.php?my=banqqpay" class="btn btn-success">一键开启QQ接口</a>&nbsp;';
}
?>
<br/>
<br/>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
          	<tr>          
          		<th>ID</th>
          		<th>推广者</th>
          		<th>密钥</th>
          		<th>余额</th>
              <th>姓名</th>
          		<th>用户QQ</th>
          		<th>结算账号</th>
          		<th>支付宝</th>
		  <th>微信</th>
		  <th>QQ</th>
              <th>域名</th>
          		<th>添加时间</th>
          		<th>状态</th>
          		<th>操作</th>           
          	</tr>
          </thead>
          <tbody>
<?php
$pagesize=10;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM pay_user WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr>

<td><a class="btn btn-xs btn-info" title="推广来源'.$res['tid'].'">'.$res['id'].'</a></td>
<td>'.$res['tid'].'</td>
<td>'.$res['key'].'</td>
<td>'.$res['money'].'</td>
<td>'.$res['username'].'</td>
<td>'.$res['qq'].'</td>
<td>'.($res['settle_id']==2?'<a class="btn btn-xs btn-default">WX</a>:':null).($res['settle_id']==3?'<a class="btn btn-xs btn-default">QQ</a>:':null).$res['account'].'</td>
<td>'.($res['alipay']==1?'<a href="./ulist.php?my=alipay_n&id='.$res['id'].'" class="btn btn-xs btn-info">当前:正常</a>':null).($res['alipay']==2?'<a href="./ulist.php?my=alipay&id='.$res['id'].'" class="btn btn-xs btn-danger">当前:关闭</a>':null).'</td>
<td>'.($res['wxpay']==1?'<a href="./ulist.php?my=wxpay_n&id='.$res['id'].'" class="btn btn-xs btn-info">当前:正常</a>':null).($res['wxpay']==2?'<a href="./ulist.php?my=wxpay&id='.$res['id'].'" class="btn btn-xs btn-danger">当前:关闭</a>':null).'</td>
<td>'.($res['qqpay']==1?'<a href="./ulist.php?my=qqpay_n&id='.$res['id'].'" class="btn btn-xs btn-info">当前:正常</a>':null).($res['qqpay']==2?'<a href="./ulist.php?my=qqpay&id='.$res['id'].'" class="btn btn-xs btn-danger">当前:关闭</a>':null).'</td>
<td>'.$res['url'].'</td>
<td>'.$res['addtime'].'</td>
<td>'.($res['active']==1?'<a class="btn btn-xs btn-success">正常</a>':'<a class="btn btn-xs btn-danger">封禁</a>').'</td>
<td><a href="./ulist.php?my=edit&id='.$res['id'].'" class="btn btn-xs btn-info">编辑</a>&nbsp;<a href="./ulist.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此商户吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="ulist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="ulist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="ulist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="ulist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
</div>