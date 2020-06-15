<?php
include("../includes/common.php");
$title='登陆记录';
include './head.php';
include 'nav.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<?php
if($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from panel_log WHERE{$sql}")->rowCount();
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 个商户登陆记录</div></div></div>';
	$link='&my=search&column='.$_GET['column'].'&value='.$_GET['value'];
}else{
	$numrows=$DB->query("SELECT * from panel_log WHERE 1")->rowCount();
	$sql=" 1";
	$con='<div class="text-center"><div class="panel panel-default"><div class="panel-heading">共有 <b>'.$numrows.'</b> 个商户登陆记录</div></div></div>';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">LoginID</th>
              <th class="text-center">operation</th>
              <th class="text-center">time</th>
              <th class="text-center">place</th>
              <th class="text-center">IP</th>
            </tr>
          </thead>
          <tbody>
<?php
$pagesize=20;
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

$rs=$DB->query("SELECT * FROM panel_log WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr><td class="text-center"><b>'.$res['id'].'</b></td><td class="text-center">'.$res['uid'].'</td><td class="text-center">'.$res['type'].'</td><td class="text-center">'.$res['date'].'</td><td class="text-center">'.$res['city'].'</td><td class="text-center">'.$res['data'].'</td></td></tr>';
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
echo '<li><a href="dlog.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="dlog.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="dlog.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="dlog.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="dlog.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="dlog.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页

?>
    </div>
  </div>