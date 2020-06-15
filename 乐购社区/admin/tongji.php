<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'tongji';
 

	 function get_czje($t0,$t1)
{
	$result = mysql_query('select    sum(je) as sl  from '.flag.'czjl where hyid = '.$t0.'  and zt =1 and zid = '.$t1.'    order by  ID DESC ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl'];
	} else {
		return '0';
	}
}


	 function get_tdczje($t0,$t1)
{
	$result = mysql_query('select    sum(je) as sl  from '.flag.'czjl where  hyid = '.$t0.'  and day(date)= day(now())      and zt =1   and zid = '.$zhu_id.'  order by  ID DESC ');
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
          <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       用户余额
                    </div>
                     <div class="panel-body">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 
                            
                              <div class="form-group"><input type="text" name="key" placeholder="用户名" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>总金额</th>
                                <th>今日销售额</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
					 if (  $_GET['key']!=''  )
								{	$sql = 'select * from '.flag.'user  where  name like "%'.$_GET['key'].'%"  and  zid = '.$zhu_id.'  order by s_order desc , ID desc';}

 						 

						 elseif ($_GET['s_cid']==''  and  $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'user where zid = '.$zhu_id.'    order by ID desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $m_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
                                <td><span class="badge badge-info"><?=$m_name?></td>
                                <td>
                                <a href="czjl.php?hyname=<?=$row['name']?>" class="badge badge-primary" se_prerender_url="complete"> 
                                <?=get_xiaoshu(get_czje($row['ID'],$zhu_id),2);?></a></td>

                                <td><a href="czjl.php?hyname=<?=$row['name']?>&date1=<?=date('Y-m-d H:i:s',strtotime('+1 day'));?>" class="badge badge-warning">
                                
                                <?=get_xiaoshu(get_tdczje($row['ID'],$zhu_id),2);?></a></td>

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
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" ><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>新增分组</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="c_name" placeholder="输入分类名称">
                            </div>
                        </div>
                        
                            <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-10">
                                <input name="c_order" type="text" class="form-control" placeholder="请输入分类排序" value="0">
                            </div>
                        </div>
                        
                          
                            <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">状态</label>
                            <div class="col-sm-10">

<select name="c_zt" class="form-control"><option value="1">启用</option> <option value="0">禁用</option> </select>
                            </div>
                        </div>
              
                </div>
                <div class="modal-footer">
                
                  <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                                     <input name="分类"  type="submit"  class="btn btn-primary" id="分类" value="增加">

                </div>
                       </form>
            </div>
            
            
        </div>
    </div>
   



        </div>
    </div><!-- /main-container -->

 <? include('footer.php');
?>
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
