<?
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'gongdan';
//删除工单
if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'gongdan where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','gongdan.php');
	}else{
		alert_back('删除失败！');
	}
}
//一键删除
if($_POST['提交'] =='一键删除'){
 	if ($_SESSION['zid']!=$zhu_id)
{die ('非法操作');};
   $id= implode(",",$_POST['id']);
 	null_back($_POST['id'],'请选择要删除的商品');
	
	yijianshanchug($id,$zhu_id);
}
function yijianshanchug($t0,$t1)
{
	$sql = 'delete from '.flag.'gongdan where id = '.$t0.' and zid ='.$t1.'';
	if(mysql_query($sql)){
		alert_href('一键删除成功!','');
	}else{
		alert_href('一键删除失败！','');
	}
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>工单管理 - <?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" language="javascript">
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
</script>	
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
		
		
    </style>
    
</head>

<div class="wrapper preload">
<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                    工单系统
                </div>
                <div class="smart-widget-inner">
                  <div class="smart-widget-hidden-section">
                    </div>
                  <form  action="" method="post">					
                  <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                            <thead>
                            <tr>
							<th width="39"  onClick="selectBox('reverse')">选</th>
                              <th>id</th>
                                <th>工单标题</th>
                                <th>提交时间</th>
                                <th>操作</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
								$sql = 'select * from '.flag.'gongdan  where zid = '.$zhu_id.' order by id asc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $c_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                          <tr>
						  <td><input type="checkbox" name="id[]" value="<?=$row['id']?>" style="background:none; border:none;"></td>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="badge badge-info">
                              <?=$row['id']?>
                            </a></td>
							<td> <a class="badge badge-success"><?=$row['name']?></td>
                            <td><span class="badge bg-gradient-yellow"><?=$row['date']?></td>
                            <td>
							<? if($row['zhuangtai'] == 0){?>
							<a href="gongdan_edit.php?id=<?=$row['id']?>" class="btn-xs btn-danger">等待处理</a>
							<?}else{?>
							<a href="gongdan_edit.php?id=<?=$row['id']?>" class="btn-xs btn-success" >处理完成</a> 
							<?}?>
							<a href="javascript:if(confirm('确定删除id<?=$row['id']?>这个工单吗?'))location='?act=del&id=<?=$row['id']?>'" class="btn-xs btn-warning">删除</a>
							</td>
                          </tr>
                          <? }?>
                                  <tr align="left">
                                <td colspan="10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="5%"><input  onClick="selectBox('reverse')"  name="提交2" class="btn btn-success purple"  type="button" value="全选"></td>
                                    <td width="10%" align="left">
                                    <input name="提交" class="btn btn-danner purple"  id="dingjia_btn"  type="submit"  value="一键删除">								
                                     </td>
                                    <td width="80%"> </td>
                                  </tr>
                                </table></td>
                              </tr>						  
                        </tbody>
						</form>
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
    <!-- /main-container -->

 <? include('footer.php');
?>
 

<?  include('password.php');?>
<!-- /wrapper -->


 
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
