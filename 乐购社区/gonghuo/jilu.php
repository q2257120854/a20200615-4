<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'jilu';


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'xfjl where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功！','jilu.php');
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
        <div class="col-lg-12">
                          <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        余额明细
                    </div>
                     <div class="panel-body">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                            
                            <div class="form-group">
                                <select name="id"   class="form-control" id="xf_qk">
                                    <option  <? if ($_GET['id']=='') {echo "selected";}?> value="">所有会员</option>
                                       <?php
					 
						$result = mysql_query('select * from '.flag.'user where zid ='.$zhu_id.'  order by ID asc ,ID asc');
						while($row = mysql_fetch_array($result)){
						?>
                                     <option  <? if ($_GET['id']==$row['ID']) {echo "selected";}?> value="<?=$row['ID']?>"><?=$row['name']?></option>
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
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>平台编号</th>
                            <th>消费前余额</th>
                            <th>消费金额</th>
                            <th>消费后余额</th>
                            <th>消费时间</th>
                            <th>动作</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if ( $_GET['id']!='' and   $_GET['xf_qk']!='' and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'xfjl where   hyid ="'.$_GET['id'].'"   and xf_qk ="'.$_GET['xf_qk'].'"  and  xf_date >= "'.$_GET['date1'].'"   and  xf_date <= "'.$_GET['date2'].'" and  zid = '.$zhu_id.'    order by ID desc , ID desc';}
  //只看类型和时间
elseif ( $_GET['id']!='' and   $_GET['xf_qk']=='' and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'xfjl where   hyid ="'.$_GET['id'].'"  and  zid = '.$zhu_id.'    order by ID desc , ID desc';}

//只看会员和类型
elseif ( $_GET['id']!='' and   $_GET['xf_qk']!='' and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'xfjl where   hyid ="'.$_GET['id'].'"   and xf_qk ="'.$_GET['xf_qk'].'"  and  zid = '.$zhu_id.'   order by ID desc , ID desc';}

//只看类型
 
elseif ( $_GET['id']=='' and   $_GET['xf_qk']!='' and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'xfjl where   xf_qk ="'.$_GET['xf_qk'].'"   and  zid = '.$zhu_id.'    order by ID desc , ID desc';}


elseif ( $_GET['id']!='' and   $_GET['xf_qk']=='' and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'xfjl where   hyid ="'.$_GET['id'].'"    and  xf_date >= "'.$_GET['date1'].'"   and  xf_date <= "'.$_GET['date2'].'"   and  zid = '.$zhu_id.'   order by ID desc , ID desc';}
elseif ( $_GET['id']=='' and   $_GET['xf_qk']!='' and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'xfjl where    xf_qk ="'.$_GET['xf_qk'].'"  and  xf_date >= "'.$_GET['date1'].'"   and  xf_date <= "'.$_GET['date2'].'"   and  zid = '.$zhu_id.'  order by ID desc , ID desc';}
  			 
  elseif ($_GET['id']=='' and $_GET['xf_qk']=='' and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'xfjl  where zid = '.$zhu_id.'   order by ID desc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                            <td><?=$row['fid'];?> &nbsp;</td>
                            <td><?=$row['xf_qje']?></td>
                            <td><?=$row['xf_je']?></td>
                            <td><?=$row['xf_hje']?></td>
                            <td><?=$row['xf_date']?></td>
                            <td><?=$row['xf_qk']?></td>
                            <td>                                 <a  href="javascript:if(confirm('确定要删除该记录吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-primary" >删除</a></td>
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
 

        </div>   </div>   </div>   </div>
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


?> <?  include('password.php');?>
 <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
