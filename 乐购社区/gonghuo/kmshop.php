<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kmshop';
check_qx($site_qx,'自动发货');


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'shop where id = '.$_GET['id'].' and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','shop.php');
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
    <script src="assets/common/md5.min.js"></script>
     <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

   
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
                    自动发货商品
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
                    <div class="smart-widget-hidden-section">
                        
                    </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 <a href="shop_add.php?xid=0" class="btn btn-default purple"><i class="fa fa-plus"></i>
                              新增</a> 
                              <div class="form-group"></div>  
                               <div class="form-group"><select class="form-control" name="s_zt">
                              <option <? if ($_GET['s_zt'] =='') {echo "selected";}?>   value="">所有</option>
                               <option  <? if ($_GET['s_zt'] == 1) {echo "selected";}?>  value="1">启用</option> 
                               <option  <? if ($_GET['s_zt'] =='0') {echo "selected";}?> value="0">禁用</option>
                               
                               </select></div> 
                              <div class="form-group"><input type="text" name="key" placeholder="商品名称" class="form-control"></div>
                              
                               <a onClick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>排序</th>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>商品价格</th>
                                <th>商品状态</th>
                                <th>商品库存</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key']!=''   )
								{	$sql = 'select * from '.flag.'shop  where  s_cid = '.$_GET['s_cid'].'  and  s_zt = '.$_GET['s_zt'].'  and   s_name like "%'.$_GET['key'].'%"  and xid = 0 order by sorder desc , ID desc';}
						  

 						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'  and  zid = '.$zhu_id.'  and xid = 0 order by sorder desc , ID desc';}

  						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   zt = '.$_GET['s_zt'].'  and   name like "%'.$_GET['key'].'%"  and  zid = '.$zhu_id.'   and xid = 0  order by sorder desc , ID desc';}


  						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']==''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   cid = '.$_GET['s_cid'].'  and   name like "%'.$_GET['key'].'%"   and xid = 0  order by sorder desc , ID desc';}

 
						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'   and  zid = '.$zhu_id.'   and xid = 0  order by sorder desc , ID desc';}

						  
						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] !=''   )
								{	$sql = 'select * from '.flag.'shop  where   name like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.' and xid = 0  order by sorder desc , ID desc';}


						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where zid = '.$zhu_id.'  and xid = 0   order by sorder desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $s_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 if ($row['duijie']==0)
						 { $pingtaiurl=''; }
						 else
						 { $pingtaiurl='&pingtai='.$row['duijie'].''; }
 							?>
                            
                              <tr>
                                <td><?=$row['ID']?></td>
                                <td><a  class="btn-xs btn-primary"><?=$row['sorder']?></a></td>
                                <td><a href="/login/<?=$row['ID']?>" target="_blank"><?=$s_name?></A></td>
                                <td><?=get_shop_channel($row['cid'])?></td>
                                <td><?=$row['price']?>(<?=$row['unit']?>)</td>
                                <td><span class="badge badge-success"><? if ($row['zt']==1){echo "启用中</span>";} else {echo "禁用中</span>";}?></td>
                                <td>
                                <?=get_kmshop($row['ID'],$zhu_id)?>
                                </td>
                                <td><a    href="kami_add.php?id=<?=$row['ID']?>" class="btn-xs btn-primary" >添加卡密</a>
                                <a  href="shop_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要删除吗?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-warning">删除</a></td>
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
