<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'order1';
 

  //订单统计
	 function get_forder1($t0,$t1,$t2)
{
	$result = mysql_query('select    count(*) as sl  from '.flag.'order where sid = '.$t0.'  and zid = '.$t1.'  and fid  ='.$t2.' order by  ID DESC ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl'];
	} else {
		return '0';
	}
}

   //订单统计按状态
	 function get_forder11($t0,$t1,$t2,$t3)
{
	$result = mysql_query('select    count(*) as sl  from '.flag.'order where sid = '.$t0.' and zt ='.$t1.'  and zid ='.$t2.'  and fid ='.$t3.'   order by  ID DESC ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl'];
	} else {
		return '0';
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>订单统计</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="panel-heading bg-gradient-vine">
                    订单统计
                    <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="widget-refresh-option load-data-btn">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    
                       
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 
                              <div class="form-group">
                              <select class="form-control" name="s_cid">
                              <option value="">所有分类</option>
                                 <?php
					 
						$result = mysql_query('select * from '.flag.'fshop_channel where zt = 1  and zid ='.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    <? if ($_GET['s_cid'] == $row['sid']) {echo "selected";}?>    value="<?=$row['sid']?>"><?=$row['name']?></option>
                                                <? }?>
                                
                               > </select></div>  
                               
                              <div class="form-group"><input type="text" name="key" placeholder="商品名称" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品名称</th>
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
					 if ($_GET['s_cid']==''  and  $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'fshop  where zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc , ID desc';}
  							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                              <tr>
                                <td><a href="/login-<?=$row['sid']?>.html" target="_blank"><?=get_shop($row['sid'],'name')?></A></td>
                                <td><a href="order.php?sid=<?=$row['sid']?>" class="btn-xs bg-purple"><?=get_forder1($row['sid'],$zhu_id,$fen_id)?></a></td>

                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=0" class="btn-xs btn-info"><?=get_forder11($row['sid'],0,$zhu_id,$fen_id)?></a></td>

                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=1" class="btn-xs btn-info"><?=get_forder11($row['sid'],1,$zhu_id,$fen_id)?></a></td>
                                
                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=4" class="btn-xs btn-info"><?=get_forder11($row['sid'],4,$zhu_id,$fen_id)?></a></td>
                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=8" class="btn-xs btn-info">
                                  <?=get_forder11($row['sid'],8,$zhu_id,$fen_id)?>
                                </a></td>
                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=5" class="btn-xs btn-info"><?=get_forder11($row['sid'],5,$zhu_id,$fen_id)?></a></td>
                               <td><a href="order.php?sid=<?=$row['sid']?>&zt=6" class="btn-xs btn-info"><?=get_forder11($row['sid'],6,$zhu_id,$fen_id)?></a></td>
                               <td><a href="order.php?sid=<?=$row['sid']?>&zt=9" class="btn-xs btn-info">
                                 <?=get_forder11($row['sid'],9,$zhu_id,$fen_id)?>
                               </a></td>
                                <td><a href="order.php?sid=<?=$row['sid']?>&zt=7" class="btn-xs btn-info"><?=get_forder11($row['sid'],7,$zhu_id,$fen_id)?></a></td>
                     
                                                                                                         
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
   



        </div>
    </div><!-- /main-container -->

 <? include('footer.php');
?>
</div><!-- /wrapper -->

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
