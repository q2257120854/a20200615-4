<?php 
$title='平台短信';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'message';
check_qx($site_qx,'平台短信');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'message where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','message.php');
	}else{
		alert_back('删除失败！');
	}
}
  

if(isset($_POST['提交'])){
	 null_back($_POST['n_content'],'请输入公告内容');
 
   	non_numeric_back($_POST['norder'],'排序必须是数字');
	
	
	$_data['content'] = $_POST['n_content'];
	$_data['norder'] = $_POST['norder'];
  	$_data['name'] = $_POST['n_name'];
      $_data['date'] = $sj;
      $_data['zid'] = $zhu_id;
      $_data['fid'] = 0;

 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'message ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('发布成功!','message.php');
	}else{
		alert_back('发布失败!');
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
            
<div id="vue-page">
    <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        平台短信- <a href="#" data-toggle="modal" data-target="#modal-add"
                                    class="btn-xs btn-danger">添加</a>
                    </div>
                     <div class="panel-body">
 <form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                             <div class="list-group-item bg-grey" style="overflow: hidden;">
                       
                 

                            <div class="form-group"></div>
                            
                                     <div class="form-group"></div>
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                                <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            
                  </div>
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            
                                                             <div class="form-group"><input type="text"  name="key" placeholder="短信内容" class="form-control"></div>

                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                  </form>                    </div>                    
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>排序</th>
                            <th>短信标题</th>
                            <th>短信内容</th>
                            <th>发布时间</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//无任何条件搜索 
 if (  $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'message   where zid = '.$zhu_id.'  order by norder desc , ID desc';}
//时间+搜索
elseif (   $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'message  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and  n_content like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'  order by norder desc , ID desc';}

 //只看时间
elseif (   $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'message  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.'    order by norder desc , ID desc';}


 //只看搜索
elseif (   $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'message  where content like "%'.$_GET['key'].'%"    and zid = '.$zhu_id.'  order by norder desc , ID desc';}

 

 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $content=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['content']);

 							?>
                          <tr>
                            <td><span class="badge badge-info">
                              <?=$row['ID']?>
                            </a></td>
                             <td> <a class="badge badge-success"> <?=$row['norder']?></td>
                                                                                     <td><span class="badge badge-warning"> <?=$row['name']?></td>
                            <td><span class="badge badge-primary"><?=$content?></td>
                            <td><span class="badge bg-gradient-yellow"><?=$row['date']?></td>
                            <td>             
                            
                                                      <a  href="message_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-warning">修改</a>
              
                               <a  href="javascript:if(confirm('确定要删除该公告吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-info" >删除</a></td>
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
                    <div class="modal-title"><h4>发布短信</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addForm" method="post">
                      
                      
                             <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">短信标题</label>
                            <div class="col-sm-10">
                              <textarea name="n_name" class="form-control" id="n_name" placeholder="请输入短信标题"></textarea>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">短信内容</label>
                            <div class="col-sm-10">
                              <textarea name="n_content" class="form-control" id="n_content" placeholder="请输入短信内容"></textarea>
                            </div>
                        </div>
                        
                      <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-10">
                              <input name="norder" type="text" class="form-control" id="norder" placeholder="请输入排序"  >
                            </div>
                      </div>
                      <div class="modal-footer">
                
                  <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">关闭</button>
                        <input name="提交"  type="submit"  class="an-btn an-btn-success" id="" value="增加">

                </div>
              </form>
            </div>
            
            
        </div>
    </div>
    </div>
    <!-- /main-container -->

 <? include('footer.php');
?><!-- /wrapper -->


 
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
