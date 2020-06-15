<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='结算记录';
include './head.php';
?>
<?php

$numrows=$DB->query("SELECT * from pay_settle WHERE pid={$pid}")->rowCount();
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

$list=$DB->query("SELECT * FROM pay_settle WHERE pid={$pid} order by id desc limit $offset,$pagesize")->fetchAll();

?>
 <section class="content profile-page">
	<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2><?php echo $conf['web_name']?>
                <small>Welcome to Oreo</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i>主页</a></li>
                    <li class="breadcrumb-item active">结算查询</li>
                </ul>                
            </div>
        </div>
    </div>
				<div class="card">
                    <div class="header">
                        <h2><strong><trans><?php echo $conf['web_name']?></trans></strong> 结算列表&nbsp;(<?php echo $numrows?>)</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead><tr><th>ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th><th>状态</th></tr></thead>
                            <tbody>
                                <?php
foreach($list as $res){
	echo '<tr><td>'.$res['id'].'</td><td>'.$res['account'].'</td><td>￥ <b>'.$res['money'].'</b></td><td>￥ <b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td><td>'.($res['status']==1?'<a class="btn btn-success btn-xs">已完成</a>':'<a class="btn btn-danger btn-xs">未完成</a>').'</td></tr>';
}
?>
                            </tbody>
                        </table>
                    </div>
                
<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate">
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="paginate_button page-item active">
<a href="order.php?page='.$first.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="1" tabindex="0" class="page-link">首页</a>
</li>';
echo '<li class="paginate_button page-item "><a href="order.php?page='.$prev.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="2" tabindex="0" class="page-link">&laquo;</a></li>';
} else {
echo '<li class="paginate_button page-item "><a aria-controls="DataTables_Table_1" data-dt-idx="3" tabindex="0" class="page-link">首页</a></li>';
echo '<li class="paginate_button page-item "><a aria-controls="DataTables_Table_1" data-dt-idx="4" tabindex="0" class="page-link">&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="paginate_button page-item "><a href="order.php?page='.$i.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0" class="page-link">'.$i .'</a></li>';
echo '<li class="paginate_button page-item "><a aria-controls="DataTables_Table_1" data-dt-idx="6" tabindex="0" class="page-link">'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li class="paginate_button page-item "><a href="order.php?page='.$i.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0" class="page-link">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="paginate_button page-item "><a href="order.php?page='.$next.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0" class="page-link">&raquo;</a></li>';
echo '<li class="paginate_button page-item "><a href="order.php?page='.$last.$link.'" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0" class="page-link">尾页</a></li>';
} else {
echo '<li class="paginate_button page-item "><a aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0" class="page-link">&raquo;</a></li>';
echo '<li class="paginate_button page-item next" id="DataTables_Table_1_next"><a aria-controls="DataTables_Table_1" data-dt-idx="7" tabindex="0" class="page-link"><trans>尾页</trans></a></li>';
}
echo'</ul>';
?>
</div>
</div>



<?php include 'foot.php';?>