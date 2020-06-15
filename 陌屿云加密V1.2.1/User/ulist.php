<?php
/**
 * 代理管理
**/
include("../includes/common.php");
$title='代理管理';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel">搜索代理</h4>
</div>
<div class="modal-body">
<form action="ulist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入用户名或QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<?php
if($udata['per_tj']==1) {
		exit("<script type='text/javascript'>layer.alert('您的账号没有权限使用该功能！',{icon:5,closeBtn:0},function(){window.location.href='./index.php'});</script>");
	exit;
}
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='add')
{ 
echo '
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>添加用户</h4>
</div>
<div class="card-body">
<form action="./ulist.php?my=add_submit" method="POST">
<div class="form-group">
<label for="exampleInputName1">用户名</label>
<input type="text" name="user" value="" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleInputEmail3">密码</label>
<input type="text"name="pwd" value="" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleInputEmail3">QQ</label>
<input type="text"name="qq" value="" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleSelectGender">授权状态</label>
<select class="form-control" name="active">
<option value="1">1_激活</option>
<option value="0">0_封禁</option>
</select>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">确定添加</button>
</div>
</form>
</div>
</div>';
echo '<a href="./ulist.php">>返回代理列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=intval($_GET['id']);
$row=$DB->get_row("select * from auth_daili where uid='$id' limit 1");
if(!$row)exit("<script language='javascript'>alert('该平台不存在这个用户！');window.location.href='ulist.php';</script>");
if($id==1 && $udata['uid']==1)exit("<script type='text/javascript'>layer.alert('您无法修改自己的账号！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
if($row['boss'] != $daili_name || !$row['boss'])exit("<script type='text/javascript'>layer.alert('只能修改自己添加的用户！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
if($udata['per_tj']==0){
if($id==$udata['uid']){
exit("<script type='text/javascript'>layer.alert('您无法修改自己的账号！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
}
if($row['per_tj']==0){
if($udata['uid']){
exit("<script type='text/javascript'>layer.alert('不能修改同权限！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
}
}
}
echo '
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>修改用户</h4>
</div>
<div class="card-body">
<form action="./ulist.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label for="exampleInputName1">用户名</label>
<input type="text" name="user" value="'.$row['user'].'" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleInputEmail3">密码</label>
<input type="text"name="pwd" value="'.$row['pass'].'" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleInputEmail3">QQ</label>
<input type="text"name="qq" value="'.$row['qq'].'" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleInputEmail3">常用登陆地</label>
<input type="text"name="citylist" value="'.$row['citylist'].'" class="form-control" placeholder="">
</div>
<div class="form-group">
<label for="exampleSelectGender">授权状态</label>
<select name="active" class="form-control" default="'.$row['active'].'">
<option value="1">1_激活</option>
<option value="0">0_封禁</option>
</select></div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">确定修改</button>
</div>
</form>
</div>
</div>';
echo '<a href="./ulist.php">>返回代理列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$qq=$_POST['qq'];
$active=$_POST['active'];
if($user==NULL or $pwd==NULL or$qq==NULL or $active==NULL){
exit("<script type='text/javascript'>layer.alert('保存错误,请确保每项都不为空！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php?my=add'});</script>");
} else {
$rows=$DB->get_row("select * from auth_daili where user='$user' limit 1");
if($rows)
exit("<script type='text/javascript'>layer.alert('用户名已存在！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php?my=add'});</script>");
$sql="insert into `auth_daili` (`user`,`pass`,`qq`,`active`,`boss`) values ('".$user."','".$pwd."','".$qq."','".$active."','".$daili_name."')";
if($DB->query($sql)){
$city=get_ip_city($clientip);
$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$daili_name."','新添用户','".$date."','".$city."','用户名：".$user." 密码：".$pwd." QQ：".$qq."')");
exit("<script type='text/javascript'>layer.alert('添加代理成功！',{icon:6,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
}else
showmsg('添加代理失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from auth_daili where uid='$id' limit 1");
if(!$rows)
showmsg('当前记录不存在！',3);
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$qq=$_POST['qq'];
$citylist=$_POST['citylist'];
$active=$_POST['active'];
if($user==NULL or $pwd==NULL or $active==NULL){
exit("<script type='text/javascript'>layer.alert('保存错误,请确保每项都不为空！',{icon:5,closeBtn:0},function(){window.location.href='./ulist.php?my=add'});</script>");
} else {
$city=get_ip_city($clientip);
$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$daili_name."','新添用户','".$date."','".$city."','用户名：".$user." 密码：".$pwd." QQ：".$qq."')");
if($DB->query("update auth_daili set user='$user',pass='$pwd',qq='$qq',citylist='$citylist',active='$active' where uid='{$id}'"))
exit("<script type='text/javascript'>layer.alert('修改代理成功！',{icon:6,closeBtn:0},function(){window.location.href='./ulist.php'});</script>");
else
	showmsg('修改代理失败！'.$DB->error(),4);
}
}
elseif($my=='loalimu')
{
$id=intval($_GET['id']);
$sql="DELETE FROM auth_daili WHERE uid='$id'";
	$row=$DB->get_row("SELECT * FROM auth_daili where uid='$id' limit 1");
	if(!$row){
 exit("<script language='javascript'>alert('当前ＩＤ不存在！');window.location.href='ulist.php';</script>");
	}elseif($row['per_tj']==1 && $udata['per_tj']==1 || $row['per_tj']==0 && $udata['per_tj']==0){
 exit("<script language='javascript'>alert('不能删除同权限账号！');window.location.href='ulist.php';</script>");
	}
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./ulist.php">>>返回代理列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from auth_daili");
if(isset($_GET['id'])){
	$sql = " uid={$_GET['id']}";
}elseif(isset($_GET['kw'])){
	$sql = " user='{$_GET['kw']}' or qq='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个代理用户<br/><a href="./ulist.php?my=add" class="btn btn-primary">添加用户</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户列表</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>UID</th>
<th>用户名</th>
<th>用户QQ</th>    
<th>上次登入</th>    
<th>用户权限</th>    
<th>用户状态</th>    
<th>状态操作</th>
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

$rs=$DB->query("SELECT * FROM auth_daili WHERE{$sql} order by uid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{

if($res['per_tj']==0){
	if($udata['per_tj']==0 || $udata['uid']==$res['uid']){
		$type="<span class='label label-warning'>合作商</span>";
	}else{
		$type="无权限查看";
	}
}elseif($res['per_tj']==1){
	$type="<span class='label label-info'>授权商</span>";
}

if($res['active']==0){
	$active="<span style='color:#FF0000;'>封禁</span>";
}elseif($res['active']==1){
	$active="<span style='color:#008000;'>正常</span>";
}
echo '

<tr>
<td>
'.$res['uid'].'
</td>
<td>
'.$res['user'].'
</td>
<td>
'.$res['qq'].'
</td>
<td>
'.$res['last'].'
</td>
<td>
'.$type.'
</td>
<td>'.$active.'
</td>
<td>
<a href="./ulist.php?my=edit&id='.$res['uid'].'" data-toggle="tooltip" class="btn btn-effect-ripple btn-xs btn-info">编辑</a> 

</td>
<td>
 </div>
</td>
</tr>
';
}
?>
</tbody>
</table>
</div>
<center>
<?php
echo'<ul class="pagination">';
$s = ceil($numrows/ $pagesize);
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$s;
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
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="ulist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="ulist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
</center>
</div>
</div>
<?php
}
?>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>