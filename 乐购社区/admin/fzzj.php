<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fzzj';

 
 

 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
  <div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
                      <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        分站资金明细
                    </div>
                     <div class="panel-body">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                       
                            <div class="form-group">
                                <select name="fid"   class="form-control" id="fid">
                                    <option  <? if ($_GET['fid'] == "") {echo "selected";}?> value="">所有</option>
                                     <?php
					 
						$result = mysql_query('select * from '.flag.'fenzhan  order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option  <? if($_GET['fid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
 
                              </select>
                            </div>
                            
                            
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
                            <th>站点编号</th>
                            <th>消费前余额</th>
                            <th>消费金额</th>
                            <th>消费后余额</th>
                              <th>详细</th>
                            <th>动作</th>
                          <th>消费时间</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if ( $_GET['fid']!='' and  $_GET['lx']!='' and    $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl
 where    fid='.$_GET['fid'].'  and   lx ="'.$_GET['lx'].'"  and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"  and zid = '.$zhu_id.'      order by ID desc , ID desc';}


//分站+类型						 
  elseif ( $_GET['fid']!='' and  $_GET['lx']!='' and    $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl   where    fid='.$_GET['fid'].'  and   lx ="'.$_GET['lx'].'"   and zid = '.$zhu_id.'       order by ID desc , ID desc';}

//分站+时间						 
  elseif ( $_GET['fid']!='' and  $_GET['lx']=='' and    $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl  where    fid='.$_GET['fid'].' and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"    and  zid = '.$zhu_id.'      order by ID desc , ID desc';}

//只搜索						 
  elseif ( $_GET['fid']=='' and   $_GET['lx']=='' and    $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl  where    date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'" and zid = '.$zhu_id.'        order by ID desc , ID desc';}

//只类型						 
  elseif (  $_GET['fid']=='' and  $_GET['lx']!='' and    $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl where       lx ="'.$_GET['lx'].'"  and zid = '.$zhu_id.'     order by ID desc , ID desc';}


//只看分站						 
  elseif (  $_GET['fid']!='' and  $_GET['lx']=='' and    $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhanpricejl where       fid ='.$_GET['fid'].'   and zid = '.$zhu_id.'     order by ID desc , ID desc';}


   			 //无条件状态
  elseif (  $_GET['fid']=='' and  $_GET['lx']=='' and   $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from  '.flag.'fenzhanpricejl  where zid = '.$zhu_id.'  order by ID desc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                            <td><?=$row['fid']?></td>
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
 
</div><!-- /wrapper -->


 
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
 <? include_once('footer.php');
?></body>
</html>
