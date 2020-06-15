<?php
/**
 * 结算列表
**/
include("../includes/common.php");
$title='结算列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include 'nav.php';
?>
  
  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php

function display_type($type){
	if($type==1)
		return '支付宝';
	elseif($type==2)
		return '微信';
	elseif($type==3)
		return 'QQ钱包';
	elseif($type==4)
		return '银行卡';
	else
		return 1;
}

$my=isset($_GET['my'])?$_GET['my']:null;

echo '<div class="text-center"><div class="alert alert-defauit"><form action="slist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="pid">商户号</option><option value="type">结算方式</option><option value="account">结算账号</option><option value="username">姓名</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>
</form></div></div>';

if($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from pay_settle WHERE{$sql}")->rowCount();
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 条订单</div></div></div>';
}else{
	$numrows=$DB->query("SELECT * from pay_settle WHERE 1")->rowCount();
	$sql=" 1";
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">共有 <b>'.$numrows.'</b> 条订单</div></div></div>';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>商户号</th>
              <th>结算方式</th>
              <th>姓名</th>
              <th>结算账号</th>
              <th>结算金额</th>
              <th>手续费</th>
              <th>结算时间</th>
              <th>状态</th>
            </tr>
          </thead>
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

$rs=$DB->query("SELECT * FROM pay_settle WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '
<tr>
<td><b>'.$res['id'].'</b></td>
<td>'.$res['pid'].'</td>
<td>'.display_type($res['type']).'</td>
<td>'.$res['username'].'</td>
<td>'.$res['account'].'</td>
<td>'.$res['money'].'</td>
<td>'.$res['fee'].'</td>
<td>'.$res['time'].'</td>
<td>'.($res['status']==1?'<a class="btn btn-xs btn-success">已完成</a>':'<a class="btn btn-xs btn-danger">未完成</a>').'</td></tr>';
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
echo '<li><a href="slist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="slist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="slist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$sss=$page+10;else $sss=$pages;
for ($i=$page+1;$i<=$sss;$i++)
echo '<li><a href="slist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="slist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="slist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>