<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'notice';
check_qx($site_qx,'公告管理');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'notice where id = '.$_GET['id'].' and zid = '.$zhu_id.' and fid = '.$fen_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','notice.php');
	}else{
		alert_back('删除失败！');
	}
}

 

  

if(isset($_POST['提交'])){
	 null_back($_POST['n_content'],'请输入公告内容');
 
   	non_numeric_back($_POST['norder'],'排序必须是数字');
	
	
	$_data['content'] = $_POST['n_content'];
	$_data['norder'] = $_POST['norder'];
      $_data['date'] = $sj;
      $_data['zid'] = $zhu_id;
      $_data['fid'] = $fen_id;

 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'notice ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('发布成功!','notice.php');
	}else{
		alert_back('发布失败!');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>公告列表</title>
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
                    公告列表                    <span class="smart-widget-option">

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
                    
                       
 <form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                             <div class="list-group-item bg-grey" style="overflow: hidden;">
                        <a class="btn btn-default purple" data-toggle="modal"
                           data-target="#modal-add"><i class="fa fa-plus"></i> 新增</a>
                 

                            <div class="form-group"></div>
                            
                                     <div class="form-group"></div>
                          
 
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                                <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            
                  </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            
                                                             <div class="form-group"><input type="text"  name="key" placeholder="公告内容" class="form-control"></div>



                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                  </form>                    </div>
                    
                    
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>排序</th>
                            <th>公告内容</th>
                            <th>发布时间</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//无任何条件搜索 
 if (  $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'notice   where zid = '.$zhu_id.'   and fid = '.$fen_id.'      order by norder desc , ID desc';}
//时间+搜索
elseif (   $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'notice  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and  n_content like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'   and fid = '.$fen_id.'      order by norder desc , ID desc';}

 //只看时间
elseif (   $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'notice  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.'   and fid = '.$fen_id.'       order by norder desc , ID desc';}


 //只看搜索
elseif (   $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'notice  where content like "%'.$_GET['key'].'%"    and zid = '.$zhu_id.'    and fid = '.$fen_id.'    order by norder desc , ID desc';}

 

 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $content=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['content']);

 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                             <td> <?=$row['norder']?></td>
                            <td><?=$content?></td>
                            <td><?=$row['date']?></td>
                            <td>             
                            
                                                      <a  href="notice_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
              
                               <a  href="javascript:if(confirm('确定要删除该公告吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-primary" >删除</a></td>
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
                    <div class="modal-title"><h4>发布公告</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">公告内容</label>
                            <div class="col-sm-10">
                              <textarea name="n_content" class="form-control" id="n_content" placeholder="请输入公告内容"></textarea>
                            </div>
                        </div>
                        
                      <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-10">
                              <input name="norder" type="text" class="form-control" id="norder" placeholder="请输入排序" value="0">
                            </div>
                      </div>
                      <div class="modal-footer">
                
                  <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <input name="提交"  type="submit"  class="btn btn-primary" id="" value="增加">

                </div>
              </form>
            </div>
            
            
        </div>
    </div>
    </div>
    <!-- /main-container -->

 <? include('footer.php');
?><!-- /wrapper -->

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
