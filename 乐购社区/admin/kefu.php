<?php 
$title='客服管理';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kefu';
check_qx($site_qx,'客服管理');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'kefu where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','kefu.php');
	}else{
		alert_back('删除失败！');
	}
}

 

if(isset($_POST['客服'])){
	 null_back($_POST['k_name'],'请输入客服名称');
	 null_back($_POST['k_qq'],'请输入客服QQ');
   	non_numeric_back($_POST['k_order'],'排序必须是数字');
	
	
	$_data['name'] = $_POST['k_name'];
	$_data['qq'] = $_POST['k_qq'];
 	$_data['k_order'] = $_POST['k_order'];
	$_data['date'] = $sj;
	$_data['zid'] = $zhu_id;
	$_data['fid'] = 0;
  	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'kefu ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('添加客服成功!','kefu.php');
	}else{
		alert_back('添加失败!');
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
    


<div class="wrapper preload">
 
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
  <div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
   <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       平台客服 - <a href="#" data-toggle="modal" data-target="#modal-buyPE"
                                    class="btn-xs btn-danger">添加</a>
                    </div>
                        <div class="panel-body">
   <div class="list-group-item bg-grey" style="overflow: hidden;">
                    
                    </div>
                 <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>排序</th>
                                <th>客服名称</th>
                                <th>客服QQ</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
									$sql = 'select * from '.flag.'kefu where zid = '.$zhu_id.' and fid = 0  order by k_order desc , ID desc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $c_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
                                <td><span class="badge badge-info">
                                  <?=$row['k_order']?>
                                </a></td>
                                <td><a class="badge badge-success"> <?=$row['name']?></a></td>
                                <td><span class="badge badge-primary"><?=$row['qq']?></a></td>
                                <td><span class="badge bg-gradient-yellow"><?=$row['date']?></td>
                                <td><a  href="kefu_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-warning">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要删除吗?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-info">删除</a></td>
                              </tr>
                              <? }?>
                             
                            </tbody>
                        </table>
                      </DIV>
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
                          
                          
                          
                          
                          
                          
                          
<div class="modal fade primary" id="modal-buyPE">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>平台客服</h4></div>
            </div>    
               <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="k_name" placeholder="输入客服名称">
                            </div>
                        </div>
                        
                        
                           <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">QQ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="k_qq" placeholder="输入客服QQ">
                            </div>
                        </div>
                        
                            <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-10">
                                <input name="k_order" type="text" class="form-control" placeholder="请输入客服排序" value="0">
                            </div>
                        </div>
                        
                          
                           
                </div>
                <div class="modal-footer">
                
                  <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">关闭</button>
                                     <input name="客服"  type="submit"  class="an-btn an-btn-success" id="客服" value="增加">
                        </div>
                    </div>
               </form>
        </div>
    </div>
</div>
  

 
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
   <? include('footer.php');
?>
