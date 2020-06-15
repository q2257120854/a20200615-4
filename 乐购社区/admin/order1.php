<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'order1';
 

 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>订单统计</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="assets/style/font-awesome_4.6.3/css/font-awesome.min.css?" rel="stylesheet">

    <!-- ionicons -->
    <link href="assets/style/css/ionicons.min.css?" rel="stylesheet">

    <!-- Morris -->
    <link href="assets/style/css/morris.css?" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="assets/style/css/datepicker.css?" rel="stylesheet"/>

    <!-- Animate -->
    <link href="assets/style/css/animate.min.css?" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="assets/style/css/owl.carousel.min.css?" rel="stylesheet">
    <link href="assets/style/css/owl.theme.default.min.css?" rel="stylesheet">

    <!-- Simplify -->
    <link href="assets/style/css/simplify.min.css?" rel="stylesheet">
    <link href="assets/common/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css?"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/common/toastr/toastr.min.css?">
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
?>
        <div class="an-content-body" style="padding: 8px" id="pjax-container">
       <div id="vue">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-vine">订单统计</a>
               </ul>
               </div>
                     <div class="panel-body">
                  <div class="list-group-item bg-grey" style="overflow: hidden;">

<form id="subform" name="subform" class="form-inline"  method="get">
 
                           
                            <input type="text" class="hidden" disabled>
                                                <div class="form-group">
                              <select class="form-control" name="s_cid">
                              <option value="">所有分类</option>
                                 <?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and zid ='.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    <? if ($_GET['s_cid'] == $row['ID']) {echo "selected";}?>    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                
                               > </select></div>  
                               
                              <div class="form-group"><input type="text" name="key" placeholder="商品名称" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    <div>
                         <form action="" method="post" >
                    		 
                       <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                                  <tr>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>总订单</th>
                                <th>等待中</th>
                                <th>进行中</th>
                                <th>异常中</th>
                                <th>待补单</th>
                                <th>补单中</th>
                                <th>已完成</th>
                                <th>退款中</th>
                                <th>已退款</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['s_cid']!=''  and $_GET['key']!=''   )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and   name like "%'.$_GET['key'].'%" and  zid = '.$zhu_id.'    order by sorder desc , ID desc';}
						  

 						 elseif ($_GET['s_cid']!=''   and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zid = '.$zhu_id.'    order by sorder desc , ID desc';}

 						 elseif ($_GET['s_cid']==''   and $_GET['key']!=''  )
								{	$sql = 'select * from '.flag.'shop  where   name like "%'.$_GET['key'].'%"    and  zid = '.$zhu_id.'   order by sorder desc , ID desc';}

  						  

						 elseif ($_GET['s_cid']==''  and  $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where zid = '.$zhu_id.'   order by sorder desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $s_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
                                <td><a href="/login-<?=$row['ID']?>.html" target="_blank"><span class="badge badge-info"><?=$s_name?></A></td>
                                <td><span class="badge badge-success"><?=get_shop_channel($row['cid'])?></td>
                                <td><a href="order.php?sid=<?=$row['ID']?>" class="badge "><?=get_order1($row['ID'],$zhu_id)?></a></td>

                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=0" class="badge badge-primary"><?=get_order11($row['ID'],0,$zhu_id)?></a></td>

                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=1" class="badge badge-warning"><?=get_order11($row['ID'],1,$zhu_id)?></a></td>
                                
                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=4" class="badge bg-gradient-yellow"><?=get_order11($row['ID'],4,$zhu_id)?></a></td>
                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=8" class="badge badge-info">
                                  <?=get_order11($row['ID'],8,$zhu_id)?>
                                </a></td>
                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=5" class="badge badge-success"><?=get_order11($row['ID'],5,$zhu_id)?></a></td>
                               <td><a href="order.php?sid=<?=$row['ID']?>&zt=6" class="badge badge-primary"><?=get_order11($row['ID'],6,$zhu_id)?></a></td>
                               <td><a href="order.php?sid=<?=$row['ID']?>&zt=9" class="badge badge-warning">
                                 <?=get_order11($row['ID'],9,$zhu_id)?>
                               </a></td>
                                <td><a href="order.php?sid=<?=$row['ID']?>&zt=7" class="badge bg-gradient-yellow"><?=get_order11($row['ID'],7,$zhu_id)?></a></td>
                     
                                                                                                         
                              </tr>
                              <? }?>
                             
                            </tbody>
                        </table>
                      </div> 
                  <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> </div> </div>  
                       
                       
                    </div>
                    <div class="smart-widget-footer text-center">
                        <pagination ref="pagination" :total="total" :current_page="search.page"
                                    :page_size="search.pageSize"
                                    @page-phange="pageChange"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modal-sort">
        <div class="modal-dialog"></div>
    </div>
    <div class="modal" id="modal-add">
        <div class="modal-dialog"></div>
    </div>


 <? include('footer.php');
?>


<?  include('password.php');?>
 
  <? 
				  function xiaoyewl_pape($t0, $t1, $t2, $t3) {
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
	$page_start = $page_current - $page_len;
	if ($page_start <= 0) {
		$page_start = 1;
		$page_end = $page_start + $page_end;
	}
	$page_end = $page_current + $page_len;
	if ($page_end > $page_sum) {
		$page_end = $page_sum;
	}
	$page_link = $_SERVER['REQUEST_URI'];
	$tmp_arr = parse_url($page_link);
	if (isset($tmp_arr['query'])){
		$url = $tmp_arr['path'];
		$query = $tmp_arr['query'];
		parse_str($query, $arr);
		unset($arr[$page_parameter]);
		if (count($arr) != 0){
			$page_link = $url.'?'.http_build_query($arr).'&';
		}else{
			$page_link = $url.'?';
		}
	}else{
		$page_link = $page_link.'?';
	}
	$page_back = '';
	$page_home = '';
	$page_list = '';
	$page_last = '';
	$page_next = '';
	$tmp = '';
	if ($page_current > $page_len + 1) {
		$page_home = ' <li class="disabled page-item"><a class="page-link" href="'.$page_link.$page_parameter.'=1" title="首页">首页</a></li>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<li class="page-item"><a class="page-link" href="'.$page_link.$page_parameter.'='.($page_current - 1).'" title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$page_sum.'"  class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="'.$page_link.$page_parameter.'='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


?> 
 </body>
</html>
