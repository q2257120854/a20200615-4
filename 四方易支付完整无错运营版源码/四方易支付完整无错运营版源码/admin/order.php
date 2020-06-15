<?php
include "../includes/common.php";
$title = '订单列表';
include './head.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
include 'nav.php';
?>
  
  <div class="container" style="padding-top:70px;">
<?php 
$my = isset($_GET['my']) ? $_GET['my'] : null;
echo '<div class="text-center"><div class="alert alert-defauit"><form action="order.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="trade_no">订单号</option><option value="out_trade_no">商户订单号</option><option value="pid">商户号</option><option value="name">商品名称</option><option value="money">金额</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>
</form></div></div>';
if ($my == 'search') {
    if ($_GET['column'] == 'name') {
        $sql = " `{$_GET['column']}` like '%{$_GET['value']}%'";
    } else {
        $sql = " `{$_GET['column']}`='{$_GET['value']}'";
    }
    $numrows = $DB->query("SELECT count(*) from pay_order WHERE{$sql}")->fetchColumn();
    $con = '<div class="text-center"><div class="panel panel-default"><div class="panel-heading">包含 ' . $_GET['value'] . ' 的共有 <b>' . $numrows . '</b> 条订单</div></di></div>';
    $link = '&my=search&column=' . $_GET['column'] . '&value=' . $_GET['value'];
} else {
    $numrows = $DB->query("SELECT count(*) from pay_order WHERE 1")->fetchColumn();
    $sql = " 1";
    $con = '<div class="text-center"><div class="panel panel-default"><div class="panel-heading">共有 <b>' . $numrows . '</b> 条订单</div></div></div>';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
		  <tr>
		  <th>ID</th>
		  <th>订单号</th>
		  <th>商户订单号</th>
		  <th>网站</th>
		  <th>名称</th>
		  <th>金额</th>		  
		  <th>方式</th>
		  <th>创建时间</th>
		  <th>结束时间</th>		  
		  <th>状态</th>
		  </tr>
		  </thead>
          <tbody>
<?php 
$pagesize = 10;
$pages = intval($numrows / $pagesize);
if ($numrows % $pagesize) {
    $pages++;
}
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}
$offset = $pagesize * ($page - 1);
$rs = $DB->query("SELECT * FROM pay_order WHERE{$sql} order by trade_no desc limit {$offset},{$pagesize}");
while ($res = $rs->fetch()) {
    $url = creat_callback($res);
    $domain = !empty($res['domain']) ? $res['domain'] : getdomain($res['notify_url']);
    echo '
	<tr>
	<td>' . $res['pid'] . '</td>	
	<td><a class="btn btn-xs btn-info" href="' . $url['notify'] . '" title="支付通知" target="_blank" rel="noreferrer">' . $res['trade_no'] . '</a></td>
	<td>' . $res['out_trade_no'] . '</td>
	<td>' . getdomain($res['notify_url']) . '</td>
	<td>' . $res['name'] . '</td>
	<td>' . $res['money'] . '</td>	
	<td>' . $res['type'] . '</td>
	<td>' . $res['addtime'] . '</td>
	<td>' . $res['endtime'] . '</td>	
	<td>' . ($res['status'] == 1 ? '<a class="btn btn-xs btn-success">已完成</a>' : '<a class="btn btn-xs btn-danger">未完成</a>') . '</td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php 
echo '<ul class="pagination">';
$first = 1;
$prev = $page - 1;
$next = $page + 1;
$last = $pages;
if ($page > 1) {
    echo '<li><a href="order.php?page=' . $first . $link . '">首页</a></li>';
    echo '<li><a href="order.php?page=' . $prev . $link . '">&laquo;</a></li>';
} else {
    echo '<li class="disabled"><a>首页</a></li>';
    echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i = 1; $i < $page; $i++) {
    echo '<li><a href="order.php?page=' . $i . $link . '">' . $i . '</a></li>';
}
echo '<li class="disabled"><a>' . $page . '</a></li>';
if ($pages >= 10) {
    $s = 10;
} else {
    $s = $pages;
}
for ($i = $page + 1; $i <= $s; $i++) {
    echo '<li><a href="order.php?page=' . $i . $link . '">' . $i . '</a></li>';
}
echo '';
if ($page < $pages) {
    echo '<li><a href="order.php?page=' . $next . $link . '">&raquo;</a></li>';
    echo '<li><a href="order.php?page=' . $last . $link . '">尾页</a></li>';
} else {
    echo '<li class="disabled"><a>&raquo;</a></li>';
    echo '<li class="disabled"><a>尾页</a></li>';
}
echo '</ul>';
?>
    </div>
  </div>