<?php 
$title='用户列表';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'member';


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'user where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','member.php');
	}else{
		alert_back('删除失败！');
	}
}

 

 

 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?=$site_ico?>"/>
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
          <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        用户列表
                    </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 
                            
                      <div class="form-group"><input   style="width:250px" type="text" name="key" placeholder="用户名称/用户编号/用户QQ" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>平台编号</th>
                                <th>编号</th>
                                <th>用户名</th>
                                <th>余额</th>
                                <th>QQ</th>
                                <th>等级</th>
                                <th>供货权限</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
  if (  $_GET['key'] !=''   )
					 {	$sql = 'select * from '.flag.'user  where   name like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.' or  ID like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'   or  qq like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.'   order by ID desc , ID desc';}


						 else
								{	$sql = 'select * from '.flag.'user  where zid = '.$zhu_id.'    order by ID desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $m_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 $m_qq=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['qq']);
						 $m_id=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['ID']);
						 
 							?>
                              <tr>
                                <td><span class="badge badge-info"><?=$row['fid']?></td>
                                <td><a class="badge badge-success"> <?=$m_id?></td>
                                <td><span class="badge badge-primary"><?=$m_name?></a></td>
                                <td><span class="badge badge-warning"><?=$row['point']?></a></td>
                                <td><a ><span class='badge '><?=$m_qq?></a></td>
                                <td><span class='badge bg-gradient-yellow'>
                                  <? if ($row['level']==1){echo $site_level1_name;}?>
                                  <? if ($row['level']==2){echo $site_level2_name;}?>
                                    <? if ($row['level']==3){echo $site_level3_name;}?>
                                    <? if ($row['level']==4){echo $site_level4_name;}?>
                                    <? if ($row['level']==5){echo $site_level5_name;}?>
                                </td>
                                <td>
                                     <? if ($row['gh']==1){echo '<span class="badge badge-success"  >开通</span>';}else{echo '<span class="badge badge-warning" >关闭</span>';}?>
                                    
                                    </td>
                                <td>
                                
                                  <a class="btn-xs btn-warning"   href="jiakuan.php?id=<?=$row['ID']?>" >加款</a>
                                    <a class="btn-xs btn-success"  href="jilu.php?id=<?=$row['ID']?>">余额明细</a>

<a  href="member_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要会员:<?=$row['m_name']?>吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-warning" >删除</a></td>
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

 


 <!-- /wrapper -->


 
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


?> <? include_once( 'footer.php'); ?>
 </body>
</html>
