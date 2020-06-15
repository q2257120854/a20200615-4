<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='订单记录';
include './head.php';
?>
<?php
function do_callback($data){
	global $DB,$userrow;
	if($data['status']>=1)$trade_status='TRADE_SUCCESS';
	else $trade_status='TRADE_FAIL';
	$array=array('pid'=>$data['pid'],'trade_no'=>$data['trade_no'],'out_trade_no'=>$data['out_trade_no'],'type'=>$data['type'],'name'=>$data['name'],'money'=>$data['money'],'trade_status'=>$trade_status);
	$arg=argSort(paraFilter($array));
	$prestr=createLinkstring($arg);
	$urlstr=createLinkstringUrlencode($arg);
	$sign=md5Sign($prestr, $userrow['key']);
	if(strpos($data['notify_url'],'?'))
		$url=$data['notify_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	else
		$url=$data['notify_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	return $url;
}

if(!empty($_GET['type']) && !empty($_GET['kw'])) {
	$kw=daddslashes($_GET['kw']);
	if($_GET['type']==1)$sql=" and trade_no='$kw'";
	elseif($_GET['type']==2)$sql=" and out_trade_no='$kw'";
	elseif($_GET['type']==3)$sql=" and name='$kw'";
	elseif($_GET['type']==4)$sql=" and money='$kw'";
	elseif($_GET['type']==5)$sql=" and type='$kw'";
	else $sql="";
	$link='&type='.$_GET['type'].'&kw='.$_GET['kw'];
}else{
	$sql="";
	$link='';
}
$numrows=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}{$sql}")->fetchColumn();
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

$list=$DB->query("SELECT * FROM pay_order WHERE pid={$pid}{$sql} order by trade_no desc limit $offset,$pagesize")->fetchAll();

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
                    <li class="breadcrumb-item active">订单查询</li>
                </ul>                
            </div>
        </div>
    </div>  
	<div class="card">
        <div class="header">
            <h2> <strong><trans><?php echo $conf['web_name']?></trans></strong><trans> 订单记录&nbsp;(<?php echo $numrows?>)</trans></h2>
                    </div>
                    	  <div class="row wrapper">
	    <div class="col-sm-5 m-b-xs">
	      <form action="order.php" method="GET" class="form-inline">
	        <div class="form-group">
			<select class="form-control show-tick" tabindex="-98" name="type">
			  <option value="1">交易号</option>
			  <option value="2">商户订单号</option>
			  <option value="3">商品名称</option>
			  <option value="4">商品金额</option>
			  <option value="5">支付方式</option>
			</select>
		    </div>
			<div class="form-group">
			  <input type="text" class="input-sm form-control" name="kw" placeholder="搜索内容">
			</div>
			 <div class="form-group">
				<button class="btn btn-primary btn-round" type="submit">搜索</button>
			 </div>
		  </form>
		</div>
      </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
            <tr>
                <th>交易号</th>
                <th>商户订单号</th>
                <th>商品名称</th>
                <th>商品金额</th>
                <th>支付方式</th>
                <th>创建时间</th>
                <th>完成时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
          </thead>
                            <tbody>
<?php
foreach($list as $res){
    echo '<tr>
    <td>'.$res['trade_no'].'</td>
    <td>'.$res['out_trade_no'].'</td>
    <td>'.$res['name'].'</td>
    <td>'.$res['money'].'</td>
    <td>'.$res['type'].'</td>
    <td>'.$res['addtime'].'</td>
    <td>'.$res['endtime'].'</td>
    <td>'.($res['status']==1?'<a class="btn btn-success btn-xs">已完成</a>':'<a class="btn btn-danger btn-xs">未完成</a>').'</td>
    <td><a href="'.do_callback($res).'" target="_blank" rel="noreferrer" class="btn btn-info btn-xs">重新通知</a></td></tr>';
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