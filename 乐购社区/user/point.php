<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'point';

 
 

 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>资金明细</title>
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
            <div class="smart-widget widget-green">
                <div class="panel-heading bg-gradient-vine">
                    资金明细                    <span class="smart-widget-option">

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
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                            <div class="form-group">
                                <select name="lx"   class="form-control" id="lx">
                                    <option  <? if ($_GET['lx'] == "") {echo "selected";}?> value="">所有</option>
                                     <option  <? if ($_GET['lx']==1) {echo "selected";}?> value="1">增加</option>
                                    <option  <? if ($_GET['lx']== "0") {echo "selected";}?> value="0">扣除</option>
 
                              </select>
                            </div>
                          
 
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                                <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            
                             </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>消费前余额</th>
                            <th>消费金额</th>
                            <th>消费后金额</th>
                              <th>消费项目</th>
                            <th>消费类型</th>
                          <th>消费时间</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if ( $_GET['lx']!='' and    $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl where   zid ='.$zhu_id.'  and   lx ="'.$_GET['lx'].'"  and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"   and fid = '.$fen_id.'      order by ID desc , ID desc';}

//只搜索						 
  if ( $_GET['lx']=='' and    $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl where   zid ='.$zhu_id.'  and    date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"      and fid = '.$fen_id.'   order by ID desc , ID desc';}

//只类型						 
  if ( $_GET['lx']!='' and    $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl where    zid ='.$zhu_id.'  and   lx ="'.$_GET['lx'].'"    and fid = '.$fen_id.'   order by ID desc , ID desc';}

   			 //无条件状态
  elseif ($_GET['lx']=='' and   $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl  where   zid ='.$zhu_id.'   and fid = '.$fen_id.'  order by ID desc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                            <td><?=get_xiaoshu($row['qje'],6)?></td>
                            <td><?=get_xiaoshu($row['je'],6)?></td>
                            <td><?=get_xiaoshu($row['hje'],6)?></td>
                                                        <td><?=$row['desc']?></td>

                             <td><? if ($row['lx']==1){echo ' <a    class="btn-xs btn-primary" >增加</a>';}?>
							<? if ($row['lx']==0){echo ' <a    class="btn-xs btn-info">扣除</a>';}?></td>
                             
                                                       <td><?=$row['date']?></td>
 
                            </td>
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
 

        </div>   </div>   </div>   </div>
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
