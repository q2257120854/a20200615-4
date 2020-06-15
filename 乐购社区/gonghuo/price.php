<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'price';
check_qx($site_qx,'商品管理');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'price where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','price.php');
	}else{
		alert_back('删除失败！');
	}
}

 

if(isset($_POST['提交'])){
	 null_back($_POST['name'],'请输入模板名称');
  	non_numeric_back($_POST['p1'],'请输入'.$site_level1_name.'加价');
  	non_numeric_back($_POST['p2'],'请输入'.$site_level2_name.'加价');
  	non_numeric_back($_POST['p3'],'请输入'.$site_level3_name.'加价');
  	non_numeric_back($_POST['p4'],'请输入'.$site_level4_name.'加价');
  	non_numeric_back($_POST['p5'],'请输入'.$site_level5_name.'加价');
	
	
	$_data['p_name'] = $_POST['name'];
	$_data['p_level1'] = $_POST['p1'];
 	$_data['p_level2'] = $_POST['p2'];
 	$_data['p_level3'] = $_POST['p3'];
 	$_data['p_level4'] = $_POST['p4'];
 	$_data['p_level5'] = $_POST['p5'];
 	$_data['zid'] = $zhu_id;
 	$_data['fid'] = 0;
	$_data['p_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'price ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('新增成功!','price.php');
	}else{
		alert_back('新增失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/common/md5.min.js"></script>
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
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        加价模板列表
                    </div>
                     <div class="panel-body">
                   
                      <form id="search_form" name="search_form" role="form" class="form-inline">
                      
                      
                             <a class="btn btn-default purple" data-toggle="modal"
                           data-target="#modal-add"><i class="fa fa-plus"></i> 新增</a> 
                           <input type="text" disabled="disabled" class="hidden">  <div class="form-group"><input type="text" placeholder="加价模板名称"  name='key' class="form-control"></div> <a onClick="document:search_form.submit();"   class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>
                    </div>
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>模板名称</th>
                                <th><?=$site_level1_name?></th>
                                <th><?=$site_level2_name?></th>
                                <th><?=$site_level3_name?></th>
                                <th><?=$site_level4_name?></th>
                                <th><?=$site_level5_name?></th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['key']!='')
						 {  $sql = 'select * from '.flag.'price where p_name like "%'.$_GET['key'].'%"  and   zid = '.$zhu_id.' and fid = 0  order by ID desc , ID desc';}

 						 else
						 {  $sql = 'select * from '.flag.'price where  zid = '.$zhu_id.' and fid = 0  order by ID desc , ID desc';}
 							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $p_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['p_name']);
						 
 							?>
                              <tr>
                                <td><a   class="btn-xs btn-info"><?=$p_name?></a></td>
                                <td><a  class="btn-xs btn-primary"><?=get_xiaoshu($row['p_level1'],6)?></a></td>
                                <td><a  class="btn-xs btn-primary"><?=get_xiaoshu($row['p_level2'],6)?></a></td>
                                <td><a  class="btn-xs btn-primary"><?=get_xiaoshu($row['p_level3'],6)?></a></td>
                                <td><a  class="btn-xs btn-primary"><?=get_xiaoshu($row['p_level4'],6)?></a></td>
                                <td><a  class="btn-xs btn-primary"><?=get_xiaoshu($row['p_level5'],6)?></a></td>
                                <td><?=$row['p_date']?></td>
                                <td><a  href="price_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要删除该定价吗?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-warning">删除</a></td>
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

    <div class="modal" id="modal-sort">
        <div class="modal-dialog"></div>
    </div>
     <div id="modal-add" class="modal in"  ><div class="modal-dialog"><div class="modal-content animated flipInX"><div class="modal-header"><button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button> <div class="modal-title"><h4><span>新增</span>加价模板</h4></div></div> <div class="modal-body"><form id="addForm" method="post" class="form-horizontal"><div class="alert alert-success">此加价模板列表，是在你的拿货价格基础上进行加价！</div> <!----> <div class="form-group"><label class="col-sm-3 control-label no-padding-right">模板名称</label>
       <div class="col-sm-9"><input type="text" name="name" placeholder="输入模板名称" class="form-control"></div>
       </div> 
       
      
     <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level1_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon"></span> 
     <input type="text" name="p1" placeholder="输入加价价格(元)" class="form-control">
     </div>
     </div>
     </div> 
       <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level2_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon"></span> 
     <input type="text" name="p2" placeholder="输入加价价格(元)" class="form-control">
     </div>
     </div>
     </div> 
     
         <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level3_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon"></span> 
     <input type="text" name="p3" placeholder="输入加价价格(元)" class="form-control">
     </div>
     </div>
     </div> 
     
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level4_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon"></span> 
     <input type="text" name="p4" placeholder="输入加价价格(元)" class="form-control">
     </div>
     </div>
     </div> 
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level5_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon"></span> 
     <input type="text" name="p5" placeholder="输入加价价格(元)" class="form-control">
     </div>
     </div>
     </div>     
     
     
  
     
     
      </div><div class="modal-footer"><button type="button" data-dismiss="modal" class="btn btn-white">关闭</button>
     
     <input name="提交" type="submit"  class="btn btn-primary" value="添加">  </div></div></div></div>
   



        </div></form>
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
?><? include('password.php');?> </body>
</html>
