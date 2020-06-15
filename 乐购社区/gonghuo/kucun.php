<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kucun';
//check_qx($site_qx,'卡密管理');

if ($_POST['act']=='pldel')
{
 if(empty($_POST['id'])){
    echo"<script>alert('必须选择一个ID,才可以删除!');history.back(-1);</script>";
    exit;
  }else{
/*如果要获取全部数值则使用下面代码*/ 
   $id= implode(",",$_POST['id']);
   $str='DELETE FROM '.flag.'shopkm where id in ('.$id.') and zid = '.$zhu_id.'  ';
   mysql_query($str);
  echo "<script>alert('删除成功！');window.location.href='';</script>";
}

}


 
 if($_GET['act'] =='del1'){
	$sql = 'delete from '.flag.'shopkm where ID = '.$_GET['id'].' and zid = '.$zhu_id.'   ';
	if(mysql_query($sql)){
 

		alert_href('删除成功!','kucun.php');
	}else{
		alert_back('删除失败！');
	}
}





if(isset($_POST['提交'])){
	 null_back($_POST['kamicontent'],'请输入卡密内容');
 
 
 
 $array=$_POST['kamicontent'];
$array=explode("\n", $array); 
$s=[];
foreach($array as $v){
        if($v!=''){
                $v=explode('----',$v);
                if(isset($v[1])){
                        $s[]='("'.$v[0].'","'.$v[1].'")';
			 $kahao[]=$v[0];   
			 $desc[]=$v[1];  
			                 }
        }
}
 
   for ($i = 0; $i < sizeof($s); $i++) {  
    //插入卡密
     $_data['sid'] = $_POST['sid'];
	$_data['zt'] =0;
	$_data['kahao'] = $kahao[$i];
 	$_data['kami'] =$kami[$i];
 	$_data['desc'] =$desc[$i];
 	$_data['date'] = $sj;
 	$_data['zid'] = $zhu_id;
 
  	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'shopkm ('.$str[0].') values ('.$str[1].')';
mysql_query($sql);
	 
 	     }

		 alert_href('成功插入'.sizeof($s).'条卡密!','');

 
  	 
 
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>商品卡密库存</title>
<?
 include('header.php');
  include('left.php');
?><body class="overflow-hidden" data-pjax>
<div class="wrapper preload">    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="smart-widget-header">
                    商品卡密
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
                      <form id="search_form" class="form-inline" method="get" role="form">
                            <input type="text" class="hidden" disabled>
                            <a data-toggle="modal" data-target="#modal-createKm" class="btn btn-danger purple">添加库存</a>
                          
                          
                                                  <div class="form-group">

                           <select name="sid" class="form-control">
                                             <option     <? if ($_GET['sid']==""){echo "selected";}?>     value="">所有</option>

<?
					    $result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.'  order by sorder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                  <option   <? if ($_GET['sid']==$row['ID']){echo "selected";}?>    value="<?=$row['ID']?>"><?=$row['name']?>(<?=$row['ID']?>)</option>
                                                <? }?>?>               
                              </select>

  </div>
  
                                                  <div class="form-group">

                           <select  class="form-control"  name="zt">
                           <option   <? if ($_GET['zt']==""){echo "selected";}?>     value="">所有</option>
                           <option   <? if ($_GET['zt']=="0"){echo "selected";}?>     value="0">正常</option>
                           <option   <? if ($_GET['zt']==1){echo "selected";}?>    value="1">已售</option>
                         </select>

  </div>

                        <div class="form-group">
                                <input type="text"  name="key" class="form-control" v-model="search.s" placeholder="输入要搜索的卡密">
                            </div>
                            <a class="btn btn-default purple"   onclick="document.getElementById('search_form').submit();return false"   ><i
                                    class="fa fa-search"></i> 搜索</a>
                            <div class="form-group" style="margin-left: 20px;">
                                 
                              <a class="btn btn-warning"    onclick="document.getElementById('subform').submit();return false"><i class="fa fa-trash"></i>批量删除</a>

                                                            </div>
                        </form>
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    <form action="" method="post"  name="subform" id="subform">
                    <input name="act" type="hidden" value="pldel">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 80px;">
                                    <div class="checkbox inline-block" style="margin: 0 auto;">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="checkboxAll" class="checkbox-purple"
                                                 onClick="selectBox('reverse')"  >
                                            <label for="checkboxAll"></label>
                                        </div>
                                        <div class="inline-block vertical-top">
                                            全选
                                        </div>
                                    </div>
                                </th>
                                                                <th>商品名称</th>
                                <th>卡密内容</th>
                                <th>状态</th>
                                <th>购买人</th>
                                <th>购买时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="kmList">
                            
                            	<?php

					if ($_GET['sid']!='' && $_GET['zt']!='' && $_GET['key']!='' )	
					{$sql = 'select * from '.flag.'shopkm  where   sid = '.$_GET['sid'].'  and  zt = '.$_GET['zt'].'  and   kahao like "%'.$_GET['key'].'%"  and zid ='.$zhu_id.'   order by id desc , id desc';}


					elseif ($_GET['sid']!='' && $_GET['zt']!='' && $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'shopkm  where   sid = '.$_GET['sid'].'  and  zt = '.$_GET['zt'].'    and zid ='.$zhu_id.'   order by id desc , id desc';}


					elseif ($_GET['sid']!='' && $_GET['zt']=='' && $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'shopkm  where   sid = '.$_GET['sid'].'     and zid ='.$zhu_id.'   order by id desc , id desc';}

					elseif ($_GET['sid']=='' && $_GET['zt']!='' && $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'shopkm  where   zt = '.$_GET['zt'].'     and zid ='.$zhu_id.'   order by id desc , id desc';}


					elseif ($_GET['sid']=='' && $_GET['zt']=='' && $_GET['key']!='' )	
					{$sql = 'select * from '.flag.'shopkm  where  kahao like "%'.$_GET['key'].'%"  and zid ='.$zhu_id.'   order by id desc , id desc';}

 					else
					
					{ 	$sql = 'select * from '.flag.'shopkm  where zid ='.$zhu_id.'    order by id desc , id desc';}
									$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								 
							while($row= mysql_fetch_array($result)){
						
						 $key=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['kahao']);
  							?>
                            <tr v-for="record in list">
                                <td>
                                    <div class="checkbox inline-block" style="margin: 0 auto;">
                                        <div class="custom-checkbox">
                                       
              <input type="checkbox" name="id[]" value="<?=$row['ID']?>"  >
                         <label :for="'select_'+record.kid"></label>
                                        </div>
                                    </div>
                                </td>
                          <td><?=get_shop($row['sid'],"name")?>（<?=$row['sid']?>）
</td>
                                <td><?=$key?></td>
                                <td><? if($row['zt']==0){echo "<font color='green'>正常</font>";} ?><? if($row['zt']==1){echo "<font color='red'>已售</font>";} ?></td>
                                <td><?=$row['hyname']?>[<?=$row['hyid']?>]</td>
                                <td><?=$row['pdate']?></td>
                                <td>
                                    <a class="btn-xs btn-warning"   href="?act=del1&id=<?=$row['ID']?>"  onclick="Javascript:return confirm('您确定要删除所选卡密吗');"  ><i
                                            class="fa fa-trash">删除</i></a>
                                </td>
                            </tr>
                            <? }?>
                            </tbody>
                            
                        </table>
                        </form>
                          <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> 
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
    <div class="modal" id="modal-createKm">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>卡密生成</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form" method="post">
                       
       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">绑定商品</label>
                            <div class="col-sm-10">
                              <select name="sid" class="form-control">
<?
					    $result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.'  order by sorder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                  <option     value="<?=$row['ID']?>"><?=$row['name']?>(<?=$row['ID']?>)</option>
                                                <? }?>?>               
                              </select>
                            </div>
                      </div>
                        
                        
                                               
       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">卡密内容</label>
                            <div class="col-sm-10">
                             <textarea name="kamicontent" class="form-control"    style="height:150PX"  rows="3"
                                           placeholder="请输入卡密内容"></textarea>
                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning"
                                                                                             onclick="$('#form textarea[name=\'kamicontent\']').val($('#form textarea[name=\'kamicontent\']').val()+'卡密信息----备注\n');">插入格式</a>
  </div>
                            </div>
                      </div>
                        
               


 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <input name="提交" class="btn btn-primary"  type="submit" value="插入">
                 </div> </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-kmList">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>成功生成以下卡密</h4></div>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class="list-group-item" v-for="km in kmList">{{ km }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" @click="exportKm(kmIds)">导出</button>
                </div>
            </div>
        </div>
    </div>
</div></div></div>

 

 <? include('footer.php');
?>
 

  
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
