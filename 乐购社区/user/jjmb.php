<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'jjmb';
if($_GET['id']){
$result = mysql_query('select * from '.flag.'price where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
							while($row= mysql_fetch_array($result)){
						
						 $p_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['p_name']); 

	$_data['p_name'] = $p_name;
	$_data['p_level1'] = $row['p_level1'];
 	$_data['p_level2'] = $row['p_level2'];
 	$_data['p_level3'] = $row['p_level3'];
 	$_data['p_level4'] = $row['p_level4'];
 	$_data['p_level5'] = $row['p_level5'];
	$_data['kind'] = $row['kind'];
 	$_data['zid'] = $zhu_id;
 	$_data['fid'] = $fen_id;
	$_data['p_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'price ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('新增成功!','price.php');
	}else{
		alert_back('新增失败!');
	}
}
}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>复制加价模板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
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
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="panel-heading bg-gradient-vine">
                    加价模板列表
                    <span class="smart-widget-option">
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
                   
                      <form id="search_form" name="search_form" role="form" class="form-inline">
                      
                      
                             
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
								<th>加价方式</th>
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
                                <td><a  class="btn-xs btn-primary">+<?=$row['p_level1']?></a></td>
                                <td><a  class="btn-xs btn-primary">+<?=$row['p_level2']?></a></td>
                                <td><a  class="btn-xs btn-primary">+<?=$row['p_level3']?></a></td>
                                <td><a  class="btn-xs btn-primary">+<?=$row['p_level4']?></a></td>
                                <td><a  class="btn-xs btn-primary">+<?=$row['p_level5']?></a></td>
								<td><?php if($row['kind']==0){echo '固定单价';} else { echo '百分比'; }?></td>
                                <td><?=$row['p_date']?></td>
                                <td><a  href="jjmb.php?id=<?=$row['ID']?>" class="btn-xs btn-info">复制</a>
                                
                                 </td>
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

   <!-- /main-container -->

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
