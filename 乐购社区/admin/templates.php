<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'templates';


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'moban where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功！','templates.php');
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
                    <div class="panel-heading bg-gradient-yellow">
                        下单模板
                    </div>
                    <div class="table-search-header">
                        <div class="form-inline">
                    </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 <a href="templates_add.php" class="btn btn-default purple"><i class="fa fa-plus"></i>
                              新增</a> 
  
                              <div class="form-group"><input type="text" name="key" placeholder="模板名称" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>模板名称</th>
                                <th>名称1</th>
                                <th>参数1</th>
                                <th>名称2</th>
                                <th>参数2</th>
                                <th>名称3</th>
                                <th>参数3</th>
                                <th>名称4</th>
                                <th>参数4</th>
								<th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
					 if (  $_GET['key'] !=''   )
								{	$sql = 'select * from '.flag.'moban  where   name like "%'.$_GET['key'].'%"   order by ID desc , ID desc';}


						 else 
								{	$sql = 'select * from '.flag.'moban    order by ID desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $x_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
                                <td><?=$row['ID']?></td>
                                <td><a  class="btn-xs btn-primary"><?=$x_name?></a></td>
                                <td><?=$row['keyname1']?></td>
                                <td><?=$row['key1']?></td>
                                <td><?=$row['keyname2']?></td>
                                <td><?=$row['key2']?></td>
                                <td><?=$row['keyname3']?></td>
                                <td><?=$row['key3']?></td>
                                <td><?=$row['keyname4']?></td>
                                <td><?=$row['key4']?></td>
								<td><?php if($row['zid']==$zhu_id){?>
								<a   href="templates_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
								<a   href="?act=del&id=<?=$row['ID']?>" onclick="return confirm('确定要删除?')"  class="btn-xs btn-warning"><i class="iconfont"></i></a><?php }?>
								</td>
              
                                
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
?><? include('password.php');?> </body>
</html>
