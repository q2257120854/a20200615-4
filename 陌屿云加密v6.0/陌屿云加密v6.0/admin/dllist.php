<?php
/**
 * 代理列表
**/
include("../includes/common.php");
$title='代理列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

function chkSta($sta){
    if($sta == 1){
        return "<font STYLE='color:green;'>正常</font>";
    }elseif($sta == 0){
        return "<font STYLE='color:red;'>未激活</font>";
    }elseif($sta == -1){
        return "<font STYLE='color:red;'>冻结</font>";
    }else{
        return "<font STYLE='color:red;'>未知</font>";
    }
}
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加代理</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./dllist.php?my=add_submit" method="POST">
<div class="form-group">
<label>代理账号:</label><br>
<input type="text" class="form-control" name="user" value="" required>
<font color="green">请确保信息正确！</font>
</div>
<div class="form-group">
<label>代理密码:</label><br>
<input type="text" class="form-control" name="pass" value="" required>
<font color="green">请确保信息正确！</font>
</div>
<div class="form-group">
<label>代理QQ:</label><br>
<input type="text"  class="form-control" name="qq" value=""  required>
</div>
<div class="form-group">
<label>代理余额:</label><br>
<input type="text" class="form-control" name="money" value=""  required>
<font color="green">余额为数值，可以是小数！</font>
</div>
<div class="form-group">
<label>状态(级别):</label><br>
<select class="form-control" id="sta" name="sta">
 <option value="1" selected>正常</option>
	<option value="0" >未激活</option>
	<option value="-1" >冻结</option>
</select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>';
echo '<br/><a href="./dllist.php">>>返回代理列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=$_GET['id'];
$row=$DB->get_row("select * from moyu_dl where id='$id' limit 1");
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改代理信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./dllist.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>代理账号:</label><br>
<input type="text" class="form-control" name="user" value="'.$row['dl_user'].'" required>
<font color="green">请确保信息正确！</font>
</div>
<div class="form-group">
<label>代理密码:</label><br>
<input type="text" class="form-control" name="pass" value="'.$row['dl_pwd'].'" required>
<font color="green">请确保信息正确！</font>
</div>
<div class="form-group">
<label>代理QQ:</label><br>
<input type="text"  class="form-control" name="qq" value="'.$row['dl_qq'].'"  required>
</div>
<div class="form-group">
<label>代理余额:</label><br>
<input type="text" class="form-control" name="money" value="'.$row['dl_money'].'"  required>
<font color="green">余额为数值，可以是小数！</font>
    </div>
<div class="form-group">
<label>状态(级别):</label><br>
<select class="form-control" id="sta" name="sta">
<option value="1" selected>正常</option>
	<option value="0" >未激活</option>
	<option value="-1" >冻结</option>
</select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./dllist.php">>>返回代理列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
}
elseif($my=='add_submit')
{

$user=$_POST['user'];
$rows=$DB->get_row("select * from moyu_dl where dl_user='$user' limit 1");
if($rows){
    showmsg('当前用户名已存在！',3);
    exit();
}
$pass=$_POST['pass'];
$qq=$_POST['qq'];
$money=$_POST['money'];
$sta=$_POST['sta'];
if($user==NULL or $pass==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
if($DB->query("insert into `moyu_dl` values(null,'{$user}','{$pass}','{$qq}',{$money},$sta)")){
	showmsg('添加代理成功！<br/><br/><a href="./dllist.php">>>返回代理列表</a>',1);
}else
	showmsg('添加代理失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=$_GET['id'];
$rows=$DB->get_row("select * from moyu_dl where id='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$user=$_POST['user'];
$pass=$_POST['pass'];
$qq=$_POST['qq'];
$money=$_POST['money'];
$sta=$_POST['sta'];

if($user==NULL or $pass==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
if($DB->query("update moyu_dl set dl_user='$user',dl_pwd = '$pass',dl_qq='$qq',dl_money='$money',dl_sta='$sta' where id='{$id}'"))
	showmsg('修改成功！<br/><br/><a href="./dllist.php">>>返回代理列表</a>',1);
else
	showmsg('修改失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=$_GET['id'];
$sql="DELETE FROM moyu_dl WHERE id='$id'";
if($DB->query($sql))
	showmsg('删除代理成功！<br/><br/><a href="./list.php">>>返回代理管理</a>',1);
else
	showmsg('删除代理失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from moyu_dl");
$ondate=$DB->count("select count(*) from moyu_dl where dl_sta <=0");
echo '<div class="alert alert-info">系统共有'.$numrows.'位代理，其中未开通的有'.$ondate.'位<br/>
<a href="./dllist.php?my=add" class="btn btn-primary">添加代理</a>';
echo '</div>';

echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>用户名</th><th>密码</th><th>QQ</th><th>余额</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
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

$rs=$DB->query("SELECT * FROM moyu_dl WHERE 1 order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['dl_user'].'</td><td>'.$res['dl_pwd'].'</td><td>'.$res['dl_qq'].'</td><td>'.$res['dl_money'].'</td><td>'.chkSta($res['dl_sta']).'</td><td><a href="./dllist.php?my=edit&id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./dllist.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此账号吗？\');">删除</a></td></tr>';
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
echo '<li><a href="dllist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="dllist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="dllist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="dllist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="dllist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="dllist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页

}
?>