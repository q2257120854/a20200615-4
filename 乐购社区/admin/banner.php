<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'banner';

 
if($_GET['act'] =='del'){
	
	$sql = 'delete from '.flag.'banner where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','banner.php');
	}else{
		alert_back('删除失败！');
	}
}

if ($_POST['提交']=='增加')
{
	

	 null_back($_POST['name'],'请输入幻灯片标题');
	 null_back($_POST['url'],'请输入幻灯片链接');
	 null_back($_POST['pic'],'请上传幻灯片图片');
     null_back($_POST['border'],'排序必须是数字');
	
	$_data['name'] = $_POST['name'];
	$_data['url'] = $_POST['url'];
	$_data['pic'] = $_POST['pic'];
	$_data['border'] = $_POST['border'];
      $_data['zid'] = $zhu_id;
      $_data['fid'] = 0;

 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'banner ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('添加成功!','');
	}else{
		alert_href('添加失败!','');
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
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-green"> 幻灯片配置 - <a href="#" data-toggle="modal" data-target="#modal-add"
                                    class="btn-xs btn-danger">添加</a></div>
 <form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                             <div class="list-group-item bg-grey" style="overflow: hidden;">
                  
                                </form>     </div>
         <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>ID</th>
                            <th>排序</th>
                            <th>标题</th>
                            <th>图片</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
//无任何条件搜索 
	  $sql = 'select * from '.flag.'banner   where zid = '.$zhu_id.'  and fid = 0  order by border desc , ID desc';
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){ 
 							?>
                          <tr>
                            <td><span class="badge badge-info">
                              <?=$row['ID']?>
                            </a></td>
                             <td><a class="badge badge-success"> <?=$row['border']?></td>
                            <td><a  href="<?=$row['url']?>" target="_blank"><span class="badge badge-primary"><?=$row['name']?></a></td>
                            <td><a  href="<?=$row['pic']?>" target="_blank">查看</a></td>
                            <td>             
           <a  href="banner_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-warning">修改</a>
              
            <a  href="javascript:if(confirm('确定要删除吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-info" >删除</a></td>
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
                    <div class="modal-title"><h4>新增幻灯</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="Xiaoyewl_Form" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">标题</label>
                            <div class="col-sm-10">
                              <input name="name" type="text" class="form-control" id="name" placeholder="幻灯片标题" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">链接</label>
                            <div class="col-sm-10">
                              <input name="url" type="text" class="form-control" id="url" placeholder="幻灯片链接" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                                      <label class="col-sm-2 control-label no-padding-right">图片</label>
                     <div class="col-sm-10">
 <input name="pic" id="pic" type="text"     class="form-control" placeholder="请选择上传图片地址">
                                             
                                            
                                           
                                              </div>
                                        </div>
                                        
                        
                      <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-10">
                              <input name="border" type="text" class="form-control" id="border" placeholder="请输入排序" value="0">
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
