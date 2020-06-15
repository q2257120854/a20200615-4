<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'supshop';
check_qx($site_qx,'商品管理');

if($_GET['act'] =='sh'){
	$sql = 'update   '.flag.'shop  set zt= '.$_GET['zt'].' where id = '.$_GET['id'].' and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('操作成功!','?');
	}else{
		alert_back('操作失败！');
	}
}


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'shop where id = '.$_GET['id'].' and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','?');
	}else{
		alert_back('删除失败！');
	}
}
if($_GET['wh']){
 $_data['zt'] = $_GET['zt'];
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$_GET['wh'].'';
	if(mysql_query($sql)){
		alert_href('维护成功!','?');
}else{echo $sql; exit;}
	}

if($_POST['act'] =='pl' and $_POST['提交'] =='一键删除'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= $_POST['id'];
   $_data['zt'] = '1';
   echo "<script language=\'javascript\'>if(confirm('确实要删除吗?')</script>";
   foreach($id as $id){
  	$str = arrtoinsert($_data);
	$sql = 'delete from '.flag.'shop where id = '.$id.' and zid ='.$zhu_id.'';
	mysql_query($sql);
	}
}
}
  if($_POST['act'] =='pl' and $_POST['提交'] =='测试按钮'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
exit('ok');
	}
}
 
 if($_POST['act'] =='pl' and $_POST['提交'] =='一键上架'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= $_POST['id'];
   $_data['zt'] = '1';
   foreach($id as $id){
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$id.'';
	mysql_query($sql);
	}
}
}

   if($_POST['act'] =='pl' and $_POST['提交'] =='一键下架'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= $_POST['id'];
   foreach($id as $id){
   $_data['zt'] = '0';
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$id.'';
	mysql_query($sql);
	}
}
}

 
if($_POST['act'] =='pl' and $_POST['提交'] =='设置加价模板'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= $_POST['id'];
   foreach($id as $id){
   $_data['pid'] = $_POST['s_pid'];
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$id.' and zid = '.$zhu_id.'';
	mysql_query($sql);
	}
}
}

if($_POST['act'] =='pl' and $_POST['提交'] =='设置分类'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个商品,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= $_POST['id'];
	foreach($id as $id){
   $_data['cid'] = $_POST['s_cid'];
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$id.' and zid = '.$zhu_id.'';
 mysql_query($sql);
	}
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
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
                   <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       商品列表
                    </div>
                     <div class="panel-body">
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 <a href="shop_add.php" class="btn btn-default purple"><i class="fa fa-plus"></i>
                              新增</a> 
                              <div class="form-group">
                              <select class="form-control" name="s_cid">
                              <option value="">所有分类</option>
                                 <?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and zid ='.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    <?php if ($_GET['s_cid'] == $row['ID']) {echo "selected";}?>    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <?php }?>
                                
                               > </select></div>  
                               <div class="form-group"><select class="form-control" name="s_zt">
                              <option <?php if ($_GET['s_zt'] =='') {echo "selected";}?>   value="">所有</option>
                               <option  <?php if ($_GET['s_zt'] == 1) {echo "selected";}?>  value="1">启用</option> 
                               <option  <?php if ($_GET['s_zt'] =='0') {echo "selected";}?> value="0">禁用</option>
                               
                               </select></div> 
                              <div class="form-group"><input type="text" name="key" placeholder="商品名称" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>                    <form action="" method="post" >
                    
                    					<div class="list-group-item bg-grey" style="overflow: hidden;"><div class="form-group">
										<span class="an-custom-checkbox danger btn btn-primary" style="margin: 0;line-height: 14px;">
			<input type="checkbox" id="checkboxAll" onclick="selectBox('reverse')">
			<label for="checkboxAll">全选</label>
			</span>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="14%">
			<select name="s_cid" id="s_cid" class="form-control" style="width:160PX">
				<option value="">请选择分类</option>
				<?php
						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1 and zid = '.$zhu_id.'  order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
	<option <?php if($row1['cid']==$row['ID']) {echo "selected";}?> value="<?=$row['ID']?>
	"><?=$row['name']?>
	</option>
<?php }?>
			</select>
		</td><td>&nbsp;</td>
		<td width="15%">
			<select name="s_pid" id="s_pid" class="form-control" style="width:160PX">
				<option value="">请选择定价模板</option>
				<?php
						$result = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = 0 order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
	<option <?php if($row1['pid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>
	"><?=$row['p_name']?>
	</option>
<?php }?>
			</select>
		</td>
	</tr>
	<tr align="left">
		<td colspan="4" align="left">
			<div align="left">
				    
  <script language="JavaScript"> 
    function selectBox(selectType){
    var checkboxis = document.getElementsByName("id[]");
    if(selectType == "reverse"){
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = !checkboxis[i].checked;
      }
    }
    else if(selectType == "all")
    {
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = true;
      }
    }
   }  
function del() {
var msg = "您真的确定要删除吗？\n请确认！";
if (confirm(msg)==true){
return true;
}else{
return false;
}
}
function ck(b)
{
var input = document.getElementsByTagName("input");
for (var i=0;i<input.length ;i++ )
{
if(input[i].type=="checkbox")
input[i].checked = b;
}
}
</script>
     <input name="提交" class="btn btn-info purple"  type="submit" value="设置分类">
     <input name="提交" class="btn btn-warning purple"  type="submit" value="设置加价模板">
   <input name="提交" class="btn btn-success purple"  type="submit" value="一键上架">
   <input name="提交" class="btn btn-info purple"  type="submit" value="一键下架">
  <input name="提交" class="btn btn-warning purple"  type="submit" value="一键删除" onclick="javascript:return del();">
  <!--<input name="提交" onclick="javascript:return del();" class="btn btn-warning purple"  type="submit" value="测试按钮">-->
			</div>
		</td>
	</tr>
	</table>
</div></div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    <input name="act" type="hidden" value="pl">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                            <th>选择</th>
                            <th>供应商</th>
                                <th>ID</th>
                                <th>排序</th>
                                <th>下单模板</th>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>商品价格</th>
                                <th>商品状态</th>
                                <th>对接状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key']!=''   )
								{	$sql = 'select * from '.flag.'shop  where  s_cid = '.$_GET['s_cid'].'  and  s_zt = '.$_GET['s_zt'].'  and   s_name like "%'.$_GET['key'].'%"  and supid >0  order by sorder desc , ID desc';}
						  

 						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'  and  zid = '.$zhu_id.' order by sorder desc , ID desc';}

  						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']!=''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   zt = '.$_GET['s_zt'].'  and   name like "%'.$_GET['key'].'%"  and  zid = '.$zhu_id.' and supid >0    order by sorder desc , ID desc';}


  						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']==''  and $_GET['key']==''  )
								{	$sql = 'select * from '.flag.'shop  where   cid = '.$_GET['s_cid'].'  and   name like "%'.$_GET['key'].'%"  and supid >0   order by sorder desc , ID desc';}

 
						 elseif ($_GET['s_cid']!='' and $_GET['s_zt']!='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where  cid = '.$_GET['s_cid'].'  and  zt = '.$_GET['s_zt'].'   and  zid = '.$zhu_id.' and supid >0     order by sorder desc , ID desc';}

						  
						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] !=''   )
								{	$sql = 'select * from '.flag.'shop  where   name like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.'   and supid >0  order by sorder desc , ID desc';}


						 elseif ($_GET['s_cid']=='' and $_GET['s_zt']=='' and $_GET['key'] ==''   )
								{	$sql = 'select * from '.flag.'shop  where zid = '.$zhu_id.' and supid >0    order by sorder desc , ID desc';}

 					 
							
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
                              <td><input type="checkbox" name="id[]" value="<?=$row['ID']?>" style="background:none; border:none;"></td>
                              <td>ID:<?=$row['supid']?></td>
                                <td><?=$row['ID']?></td>
                                <td><a  class="btn-xs btn-primary"><?=$row['sorder']?></a></td>
                                <td><?php
if ($row['xid']==0){echo '发卡';}else{    echo get_moban($row['xid']);}?>&nbsp;</td>
                                <td><a href="/login/<?=$row['ID']?>" target="_blank"><?=$s_name?></A></td>
                                <td><?=get_shop_channel($row['cid'])?></td>
                                <td><?=$row['price']?>(<?=$row['unit']?>)</td>
                                <td><span class="badge badge-success"><?php if ($row['zt']==1){echo "启用中</span>";} else {echo "禁用中</span>";}?></td>
                                <td><span class="badge badge-success"><?php if ($row['duijie']!=0){echo "启用中</span>";} else {echo "禁用中</span>";}?></td>
                                <td>          
                               
						     <a  href="?act=sh&id=<?=$row['ID']?>&zt=1" class="btn-xs btn-success">通过</a>
									       <a  href="?act=sh&id=<?=$row['ID']?>&zt=2" class="btn-xs btn-danger">拒绝</a>
							   
                            
                               
                      
                               
                              </td>
                              </tr>
                              <?php }?>
                             
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
   



     
    
 <?php include('footer.php');
?>
<!-- /wrapper -->


 
  <?php 
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
<?php  include('password.php');?>
 <?php include_once('footer.php');
?><?php include('password.php');?> </body>
</html>
