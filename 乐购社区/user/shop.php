<?php

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shop';


 
if($_POST['提交'] =='设置加价模板'){
  if(empty($_POST['id']) and $_POST['fw']==0){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id=$_POST['id'];
   if($_POST['fw']==1){
   $result121 = mysql_query('select * from '.flag.'shop where zid = '.$zhu_id.' and zt = 1');
		while($row121 = mysql_fetch_array($result121)){
		$id=$row121['ID'];
		$result111 = mysql_query('select * from '.flag.'shop where id = '.$id.' and zid = '.$zhu_id.' ');
		$row111 = mysql_fetch_array($result111);
		if($_POST['s_pid']==-1)$_POST['s_pid']=$row111['pid'];
 	$_data['sid'] = $id;
	$_data['zid'] = $zhu_id;
 	$_data['fid'] = $fen_id;
 	$_data['cid'] = $row111['cid'];
 	$_data['pid'] = $_POST['s_pid'];
  	$str = arrtoinsert($_data);
	$result1 = mysql_query('select * from '.flag.'fshop where sid = '.$id.' and zid = '.$zhu_id.' and fid = '.$fen_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
			$pid =$row1['pid'];			
					}
		if ($pid=='')
	{  	$sql = 'insert into '.flag.'fshop ('.$str[0].') values ('.$str[1].')'; }
	else
	{  $sql = 'update '.flag.'fshop set '.arrtoupdate($_data).' where sid = '.$id.' and zid = '.$zhu_id.' and fid = '.$fen_id.''; }
	if(mysql_query($sql)){
		//alert_href('商品定价成功!','shop.php');
	}else{
		die($sql);
		alert_back('定价失败!');
	}
		}
   }else{
   foreach($id as $id){
	   $result111 = mysql_query('select * from '.flag.'shop where id = '.$id.' and zid = '.$zhu_id.' ');
		$row111 = mysql_fetch_array($result111);
		if($_POST['s_pid']==-1)$_POST['s_pid']=$row111['pid'];
 	$_data['sid'] = $id;
	$_data['zid'] = $zhu_id;
 	$_data['fid'] = $fen_id;
 	$_data['cid'] = $row111['cid'];
 	$_data['pid'] = $_POST['s_pid'];
  	$str = arrtoinsert($_data);
	$result1 = mysql_query('select * from '.flag.'fshop where sid = '.$id.' and zid = '.$zhu_id.' and fid = '.$fen_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
			$pid =$row1['pid'];			
					}
		if ($pid=='')
	{  	$sql = 'insert into '.flag.'fshop ('.$str[0].') values ('.$str[1].')'; }
	else
	{  $sql = 'update '.flag.'fshop set '.arrtoupdate($_data).' where sid = '.$id.' and zid = '.$zhu_id.' and fid = '.$fen_id.''; }
	if(mysql_query($sql)){
		//alert_href('商品定价成功!','shop.php');
	}else{
		die($sql);
		alert_back('定价失败!');
	}
	/*$sql = 'update '.flag.'fshop set '.arrtoupdate($_data).' where sid = '.$id.' and zid = '.$zhu_id.' and fid = '.$fen_id.'';
	mysql_query($sql);
	*/
	//die($sql);
	}
}
}}
 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>商品列表</title>
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
                    商品列表
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
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 
                    <div class="form-group">
                              <select class="form-control" name="s_cid">
                              <option value="">所有分类</option>
                                 <?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and zid ='.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    <? if ($_GET['s_cid'] == $row['ID']) {echo "selected";}?>    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                
                               > </select></div>  
                               <div class="form-group"><select class="form-control" name="s_zt">
                              <option <? if ($_GET['s_zt'] =='') {echo "selected";}?>   value="">所有</option>
                               <option  <? if ($_GET['s_zt'] == 1) {echo "selected";}?>  value="1">启用</option> 
                               <option  <? if ($_GET['s_zt'] =='0') {echo "selected";}?> value="0">禁用</option>
                               
                               </select></div> 
                              <div class="form-group"><input type="text" name="key" placeholder="商品名称" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
<div class="list-group-item bg-grey" style="overflow: hidden;"><div class="form-group">
<form action="" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr  align="left">
    <td width="48%" align="left">
<SCRIPT LANGUAGE="JavaScript">
function ck(b)
{
var input = document.getElementsByTagName("input");
for (var i=0;i<input.length ;i++ )
{
if(input[i].type=="checkbox")
input[i].checked = b;
}
}
</SCRIPT>
     <input type="button" onclick="ck(true)" value="全选"><input type="button" onclick="ck(false)" value="取消全选">
     <select class="form-control" v-model="apiType"  name="fw">                                                <option    value="0">选中商品</option><option    value="1">所有商品</option> </select>  
     <select class="form-control" v-model="apiType"  name="s_pid">                                                <option    value="">请选择加价模板</option><option    value="-1">系统默认加价</option>                                            <?php
						$result = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.'  and fid = '.$fen_id.' order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option  <? if($row1['pid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['p_name']?></option>                                                <? }?>                                            </select>                                   
     <input name="提交" class="btn btn-warning purple"  type="submit" value="设置加价模板">
   </td>
   </tr>
</table></div></div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                    <input name="act" type="hidden" value="pl">
                            <thead>
                            <tr>
							<th>选择</th>
                                <th>ID</th>
                                <th>排序</th>
                                <th>下单模板</th>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>拿货价</th>
                                <th>定价模板</th>
                                <th>商品状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key']!=''   )
								{	$sql = 'select * from '.flag.'shop  where  s_cid = '.$_GET['s_cid'].'  and  s_zt = '.$_GET['s_zt'].'  and   s_name like "%'.$_GET['key'].'%" order by sorder desc , ID desc';}
						  

 						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'  and  zid = '.$zhu_id.' order by sorder desc , ID desc';}

  						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   zt = '.$_GET['s_zt'].'  and   name like "%'.$_GET['key'].'%"  and  zid = '.$zhu_id.'   order by sorder desc , ID desc';}


  						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']==''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   cid = '.$_GET['s_cid'].'  and   name like "%'.$_GET['key'].'%"   order by sorder desc , ID desc';}

 
						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'   and  zid = '.$zhu_id.'   order by sorder desc , ID desc';}

						  
						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] !=''   )
								{	$sql = 'select * from '.flag.'shop  where   name like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.'  order by sorder desc , ID desc';}


						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where zid = '.$zhu_id.'   order by sorder desc , ID desc';}

 					 

								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $s_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
							  <td><input type="checkbox" name="id[]" value="<?=$row['ID']?>" style="background:none; border:none;"></td>
                                <td><?=$row['ID']?></td>
                                <td><a  class="btn-xs btn-primary"><?=$row['sorder']?></a></td>
                                <td><?=get_moban($row['xid'])?>&nbsp;</td>
                                <td><a href="/login/<?=$row['ID']?>" target="_blank"><?=$s_name?></A></td>
                                <td><?=get_shop_channel($row['cid'])?></td>
                                <td>
								<? if($row['jj']==0) {//固定金额
if ($dqbanben == 1) {
    echo $row['fprice1'];
}
if ($dqbanben == 2) {
    echo $row['fprice2'];
}
if ($dqbanben == 3) {
    echo $row['fprice3'];
}
}elseif($row['jj']==1) {//倍数
if ($dqbanben == 1) {
    $jg = $row['price']*$row['fprice1'];
}
if ($dqbanben == 2) {
    $jg = $row['price']*$row['fprice2'];
}
if ($dqbanben == 3) {
    $jg = $row['price']*$row['fprice3'];
}
echo get_xiaoshu($jg, 6);
}?>
 (<?=$row['unit']?>)</td>
                                <td>
                                 <?=get_price(get_fshop($row['ID'],'pid',$fen_id),$fen_id,$zhu_id);
					?>&nbsp;</td>
                                <td><i class="<? if ($row['zt']==1){echo "fa fa-unlock text-success";} else {echo "fa fa-lock text-danger";}?>" title="<? if ($row['zt']==1){echo "启用中";} else {echo "禁用中";}?>"></i></td>
                                <td>          
                                   <a    href="shop_dingjia.php?id=<?=$row['ID']?>" class="btn-xs btn-primary" >定价</a>
                               
                              
                                 
                                 </td>
                              </tr>
                              <? }?>
                             
                            </tbody>
                        </table>
						
</form>
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
<!-- /main-container -->

 <? include('footer.php');
?>
<!-- /wrapper -->

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
