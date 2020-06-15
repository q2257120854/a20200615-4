<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'tx';
if ($_POST['提交']=='提现')
 
{
	$rmb=$_POST['rmb'];
	$sxf=$rmb*($site_txsxf/100);
	$txzje=$rmb+$sxf;
  	   	non_numeric_back($_POST['rmb'],'请输入提现金额');
  	   	null_back($_POST['txzh'],'请输入提现账号');
  	   	null_back($_POST['txxm'],'请输入提现姓名');


if ($rmb<100)
{ 		alert_href('提现失败:提现金额不得低于100元请充值!',''); }
		
elseif ($rmb > $site_point)

{ 		alert_href('提现失败:您的余额不足提现'.$rmb.'元请充值!',''); }

elseif ($txzje > $site_point)

{ 		alert_href('提现'.$rmb.'元,手续费'.$sxf.'元。可提现站长余额不足'.$txzje.'元',''); }

else
//提现成功
{
			//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['fid'] = $fen_id;
	$_data1['qje'] = $site_point;
	$_data1['je'] = $txzje;
 	$_data1['hje'] = $site_point-$txzje;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '余额提现:'.$rmb.'元,手续费:'.$sxf.'元';
 	$_data1['lx'] = 0; //0=减
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'fenzhanpricejl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);


			//提现记录
	$_data2['zid'] = $zhu_id;
	$_data2['fid'] = $fen_id;
 	$_data2['je'] = $rmb;
 	$_data2['sxf'] = $sxf;
 	$_data2['txfs'] = $_POST['txfs'];
 	$_data2['txxm'] = $_POST['txxm'];
 	$_data2['txzh'] = $_POST['txzh'];
 	$_data2['sxf'] = $sxf;
 	$_data2['date'] = $sj;
 	$_data2['zt'] = 0;
 
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'insert into '.flag.'fenzhantx ('.$str2[0].') values ('.$str2[1].')';
    mysql_query($sql2);

	//扣除余额
 	$_data3['point'] = $site_point-$txzje;
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'update '.flag.'fenzhan set '.arrtoupdate($_data3).' where id = '.$fen_id.'';
     mysql_query($sql3);

 
		alert_href('提现成功!','');


}

}
 
 

 

 ?> 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>资金提现</title>
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
            <div class="smart-widget widget-green">
                <div class="panel-heading bg-gradient-vine">
                    资金提现                    <span class="smart-widget-option">

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
                  
                  
                   <div class="list-group-item list-group-item-danger"><i class="fa fa-volume-up"></i>
                                                我的提现账号信息：最多可提现:<?=$site_point-$site_point*($site_txsxf/100)?>元 手续费：<?=$site_txsxf?>%                    </div>
  <div style="height:10px"></div>


<form id="subform" name="subform" class="form-inline"  method="get">
  <a class="btn btn-default purple" data-toggle="modal"
                           data-target="#modal-tx"><i class="fa fa-plus"></i> 申请提现</a>
                           
                            <input type="text" class="hidden" disabled>
                 
                             <div class="form-group">
                                <select name="zt"   class="form-control" id="">
                                    <option  <? if ($_GET['zt'] == "") {echo "selected";}?> value="">所有</option>
                                     <option  <? if ($_GET['zt']=="0") {echo "selected";}?> value="0">等待中</option>
                                    <option  <? if ($_GET['zt']== "2") {echo "selected";}?> value="2">异常中</option>
                                    <option  <? if ($_GET['zt']== "1") {echo "selected";}?> value="1">已转账</option>
                                    <option  <? if ($_GET['zt']== "3") {echo "selected";}?> value="3">已驳回</option>
 
                              </select>
                            </div>
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                              <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择提现时间">
                            
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
                            <th>收款方式</th>
                            <th>收款账号</th>
                            <th>收款姓名</th>
                            <th>提现金额</th>
                            <th>手续费</th>
                            <th>申请时间</th>
                            <th>处理时间</th>
                              <th>状态</th>
                            <th>备注</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where   zid='.$zhu_id.'   and zt ='.$_GET['zt'].'       and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"    and fid = '.$fen_id.'    order by ID desc , ID desc';}


//只看时间						 
  elseif (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']=='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where   zid='.$zhu_id.'         and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"      and fid = '.$fen_id.'   order by ID desc , ID desc';}

//只看状态						 
  elseif (     $_GET['date1']=='' and  $_GET['date2']==''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where   zid='.$zhu_id.'   and zt ='.$_GET['zt'].'    and fid = '.$fen_id.'     order by ID desc , ID desc';}

 
   			 //无条件状态
  elseif (   $_GET['date1']=='' and  $_GET['date2']=='' and  $_GET['zt']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhantx  where   zid='.$zhu_id.'  and fid = '.$fen_id.'   order by ID desc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                            <td><?=$row['txfs']?>&nbsp;</td>
                            <td><?=$row['txzh']?>&nbsp;</td>
                            <td><?=$row['txxm']?>&nbsp;</td>
                            <td><?=get_xiaoshu($row['je'],2)?></td>
                            <td><?=get_xiaoshu($row['sxf'],2)?>元</td>
                            <td><?=$row['date']?></td>
                            <td><?=$row['cdate']?></td>
                            <td><? if ($row['zt']==0) {echo "<span class='text-info'>等待中</span>";}?>
                            <? if ($row['zt']==1) {echo "<span class='text-success'>已转账</span>";}?>
                            <? if ($row['zt']==2) {echo "<span class='text-warning'>异  常</span>";}?>
                            <? if ($row['zt']==3) {echo "<span class='text-info'>已驳回</span>";}?>
                            
                            
                            </td>

                             <td> <?=$row['desc']?></td>
                             
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
</div>

  <div class="modal" id="modal-tx">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>申请提现</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="txForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">提现金额</label>
                            <div class="col-sm-10">
                                <input value="100" name="rmb" type="number" class="form-control"
                                       placeholder="输入要提现金额，最低100元">
                                <pre>提现手续费：提现金额的<?=$site_txsxf?>%</pre>
                            </div>
                        </div>
                        
                        
                                    <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">提现方式</label>
                            <div class="col-sm-10">
                            <select  class="form-control"  name="txfs">
                              <option value="支付宝">支付宝</option>
                              <option value="微信支付">微信支付</option>
                              <option value="QQ支付">QQ支付</option>
                            </select>
                               </div>
                        </div>
                        
                        
                           <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">提现账号</label>
                            <div class="col-sm-10">
                              <input value="" name="txzh" type="text" class="form-control"
                                       placeholder="请输入提现账号">
                               </div>
                        </div>
                        
                           <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">提现姓名</label>
                            <div class="col-sm-10">
                              <input value="" name="txxm" type="text" class="form-control"
                                       placeholder="请输入提现姓名">
                               </div>
                        </div>
                        
                        
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                     <input name="提交"  value="提现" class="btn btn-primary" type="submit">
                </div>
            </div></form>
            
        </div>
    </div>

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
