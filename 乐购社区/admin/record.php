<?php 
$title='对接记录';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'duijiejl';

 


 
 

 
 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" language="javascript">
    function selectBox(selectType){
    var checkboxis = document.getElementsByName("id[]");
    if(selectType == "reverse"){
      for (var i=0; i<checkboxis.length; i++){
        checkboxis[i].checked = !checkboxis[i].checked;
      }
    }
    else if(selectType == "all")
    {
      for (var i=0; i<checkboxis.length; i++){
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
    </style>
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
  <div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        对接记录
                    </div>
                     <div class="panel-body">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                          
                            
                                     <div class="form-group">
                                <select name="sid"   class="form-control" id="sid">
                                    <option  <? if ($_GET['sid']=='') {echo "selected";}?> value="">所有商品</option>
                                       <?php
					 
						$result = mysql_query('select * from '.flag.'shop where zid = '.$zhu_id.'  order by ID asc ,ID asc');
						while($row = mysql_fetch_array($result)){
						?>
                                     <option  <? if ($_GET['sid']==$row['ID']) {echo "selected";}?> value="<?=$row['ID']?>"><?=$row['name']?></option>
                                     <? }?>
                                 </select>
                            </div>
                          
 
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                                 <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                    </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            
                                                             <div class="form-group"><input type="text"  name="key" placeholder="订单号" class="form-control"></div>



                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i class="fa fa-search"></i> 搜索</a>
                    </form>                    </div>
                    
                    
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    <form action="" method="post" >
                    <input name="act" type="hidden" value="pl">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>对接平台</th>
                            <th>商品编号</th>
                            <th>对接商品编号</th>
                            <th>订单号</th>
                             <th>对接订单号</th>
                             <th>金额</th>
                             <th>对接金额</th>
                             <th>时间</th>
                             <th>备注</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//无任何条件搜索 
 if (   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'duijiejl  where zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看状态+会员+商品+时间+搜索
elseif (  $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'duijiejl  where   sid = '.$_GET['sid'].'    and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and  dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //只看状态+会员+商品+时间
elseif (   $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'duijiejl  where    and  sid = '.$_GET['sid'].'    and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.'     order by ID desc , ID desc';}

 //只看状态+会员+商品
elseif (  $_GET['sid']!='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'duijiejl  where   sid = '.$_GET['sid'].'     and zid = '.$zhu_id.'    order by ID desc , ID desc';}
  
//只看状态+会员
elseif (   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'duijiejl  where zt = '.$_GET['zt'].' and  hyid = '.$_GET['hid'].'   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 
 
//只看时间
elseif (   $_GET['sid']=='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'duijiejl  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"    and zid = '.$zhu_id.'  order by ID desc , ID desc';}

//只看单一时间
elseif ( $_GET['sid']=='' and     $_GET['date1']!='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'duijiejl  where   date >= "'.$_GET['date1'].'"   and zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看单一时间+商品
elseif (   $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'duijiejl  where   date >= "'.$_GET['date1'].'"  and sid='.$_GET['sid'].'    and zid = '.$zhu_id.'   order by ID desc , ID desc';}

 //只看商品
elseif (   $_GET['sid']!='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'duijiejl  where    sid = '.$_GET['sid'].'   and zid = '.$zhu_id.'    order by ID desc , ID desc';}

//只搜索
elseif ( $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']!=''   )	 
{ $sql = 'select * from '.flag.'duijiejl  where    dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'  or  ddingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'       order by ID desc , ID desc';}


 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $dingdanhao=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['dingdanhao']);

 							?>
                          <tr>
                            <td><?=get_duijie('name',$row['pingtai'])?>(<?=get_duijie('url',$row['pingtai'])?>)</td>
                             <td><span class="badge badge-info"><?=$row['sid']?></td>
                            <td><a class="badge badge-success"> <?=$row['dsid']?></td>
                            <td><span class="badge bg-gradient-yellow"><?=$row['dingdanhao']?></td>
                            <td><span class="badge badge-primary"><?=$row['ddingdanhao']?></td>
                            <td> <span class="badge badge-warning"><?=$row['je']?></td>
                            <td> <span class="badge badge-success"><?=$row['dje']?></td>
                            <td><span class="badge bg-gradient-yellow"><?=$row['date']?></td>
                            <td> <span class="badge badge-info"><?=$row['desc']?></td></td>
                          </tr>
                         
                          <? }?>
                            <tr>
                          
                      
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


//获取商品状态反馈
	 function get_shopzt($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['duijiecgzt'];
	} else {
		return '0';
	}
}
?> 
 <? include_once('footer.php');
?></body>
</html>
