<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'czjl';


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'czjl where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('删除成功!','czjl.php');
	}else{
		alert_back('删除失败！');
	}
}

 

 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>充值记录</title>
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
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="panel-heading bg-gradient-vine">
                    在线充值记录

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
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                            
                            
                              <div class="form-group">
                                <select name="zt" class="form-control">
                                    <option <? if ($_GET['zt']==""){echo "selected";}?>  value="">所有</option>
                                    <option <? if ($_GET['zt']=="0"){echo "selected";}?> value="0">待支付</option>
                                    <option<? if ($_GET['zt']=="1"){echo "selected";}?>   value="1">已支付</option>
                                </select>
                            </div>



                        
 
 
 
                            
                              <div class="form-group">
                                <input type="text" class="form-control"  name="qk" placeholder="订单号">
                            </div>
                                                         <div class="form-group">
                                <input type="text" class="form-control"  name="hyname" placeholder="用户名">
                            </div>
                             
                                                           <div class="form-group">
                                <input type="text" class="form-control"  name="jyh" placeholder="交易号">
                            </div> 
                                           <BR>
                             


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
                            <th>订单号</th>
                            <th>用户信息</th>
                            <th>金额</th>
                            <th>手续费</th>
                            <th>状态</th>
                            <th>交易号</th>
                            <th>支付时间</th>
                            <th>生成时间</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if ( $_GET['zt']!='' and   $_GET['qk']!='' and  $_GET['hyname']!='' and  $_GET['fid']!=''  and  $_GET['jyh']!=''  and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_GET['zt'].'  and  dingdanhao='.$_GET['qk'].' and   hyname ="'.$_GET['hyname'].'"     and jiaoyihao ='.$_GET['jyh'].'  and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"   and  zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}


//只看状态						 
  if ( $_GET['zt']!='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_GET['zt'].'   and  zid ='.$zhu_id.' and fid = '.$fen_id.'   order by ID desc , ID desc';}

//只看订单号						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']!='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl where   dingdanhao like "%'.$_GET['qk'].'%"   and  zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}


//只看用户						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']=='' and  $_GET['hyname']!='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl where   hyname like "%'.$_GET['hyname'].'%"    and  zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}

 
 
 
 

//只看交易号						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']!=''  and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl where   jiaoyihao like "%'.$_GET['jyh'].'%"   and  zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}


  //只看时间						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'czjl where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and   zid ='.$zhu_id.' and fid = '.$fen_id.'    order by ID desc , ID desc';}


  //只看时间和状态						 
  elseif ( $_GET['zt']!='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']!='' and  $_GET['date2']!=''  )	 
{	  $sql = 'select * from '.flag.'czjl where zt='.$_GET['zt'].'   and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and    zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}


  //单个时间						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']!='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl where    date <= "'.$_GET['date1'].'"   and  zid ='.$zhu_id.' and fid = '.$fen_id.'    order by ID desc , ID desc';}


  //空						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']=='' and  $_GET['hyname']=='' and  $_GET['fid']==''  and  $_GET['jyh']==''  and  $_GET['date1']=='' and  $_GET['date2']==''  )	 
{	  $sql = 'select * from '.flag.'czjl  where zid ='.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}
    			 
  								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['dingdanhao']?>
                            </a></td>
                            <td><?=$row['hyname']?>[编号:<?=$row['hyid']?>]</td>
                            <td><?=$row['je']?></td>
                            <td><?=$row['sxf']?></td>
                            <td><? if ($row['zt']==0) {echo "<span class='text-info'>待支付</span>";}?><? if ($row['zt']==1) {echo "<span class='text-success'>已支付</span>";}?></td>
                            <td><?=$row['jiaoyihao']?></td>
                            <td><?=$row['pdate']?></td>
                            <td><?=$row['date']?></td>
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
