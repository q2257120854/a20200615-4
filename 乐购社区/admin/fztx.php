<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fztx';


if($_GET['act'] =='del'){
	$sql = 'delete from '.DATA_NAME.'.'.flag.'fenzhan where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
 

		alert_href('删除成功!','fenzhan.php');
	}else{
		alert_back('删除失败！');
	}
}

 
if ($_POST['分站'] =='购买')
{
	
	if ($_POST['fid']==1)
	{
		$fxfprice =$_POST['peie']*$site_fpoint;
		$yedu = $site_fed;
		}
	elseif ($_POST['fid']==2)
	{$fxfprice =$_POST['peie']*$site_fpoint2;
			$yedu = $site_fed2;
}
	elseif ($_POST['fid']==2)
	{$fxfprice =$_POST['peie']*$site_fpoint3;
			$yedu = $site_fed3;
}	
	
	   	non_numeric_back($_POST['peie'],'请输入购买个数');
		
 		
if ($site_point < $fxfprice)

{ 		alert_href('购买失败:您的余额不足支付'.$fxfprice.'元请充值!',''); }

else
{
	
 if ($_POST['fid']==1)	
 {	$_data['w_fed'] =$site_fed+$_POST['peie']  ;}
 elseif ($_POST['fid']==2)	
 {	$_data['w_fed2'] =$site_fed2+$_POST['peie']  ;}
 elseif ($_POST['fid']==3)	
 {	$_data['w_fed3'] =$site_fed3+$_POST['peie']  ;} 
  
  	$str = arrtoinsert($_data);
	$sql = 'update '.ADATA_NAME.".".flag.'web set '.arrtoupdate($_data).' where id = '.$a_id.'';
	if(mysql_query($sql)){
		//余额记录
	$_data1['xf_zid'] = $a_id;
	$_data1['xf_qje'] = $site_point;
	$_data1['xf_je'] = $fxfprice;
 	$_data1['xf_hje'] = $site_point-$fxfprice;
 	$_data1['xf_date'] = $sj;
 	$_data1['xf_qk'] = '购买'.get_fenzhanname($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data1['xf_lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.ADATA_NAME.".".flag.'point ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);


		//额度记录
	$_data3['e_zid'] = $a_id;
 	{$_data3['e_qsl'] = $yedu;}		
	$_data3['e_sl'] = $_POST['peie'];
 	$_data3['e_hsl'] = $yedu+$_POST['peie'];
 	$_data3['e_date'] = $sj;
 	$_data3['e_qk'] = '购买'.get_fenzhanname($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data3['e_lx'] = 1; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.ADATA_NAME.".".flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	
	//扣除余额
 	$_data2['w_point'] = $site_point-$fxfprice;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.ADATA_NAME.".".flag.'web set '.arrtoupdate($_data2).' where id = '.$a_id.'';
     mysql_query($sql2);

 
		alert_href('购买成功!','');
	}else{
		alert_back('购买失败!');
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
                        分站提现管理
                    </div>
                     <div class="panel-body">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                            <div class="form-group">
                                <select name="zt"   class="form-control" id="xf_lx">
                               <option  <? if ($_GET['zt'] == "") {echo "selected";}?> value="">所有</option>
                                     <option  <? if ($_GET['zt']=="0") {echo "selected";}?> value="0">等待中</option>
                                    <option  <? if ($_GET['zt']== "2") {echo "selected";}?> value="2">异常中</option>
                                    <option  <? if ($_GET['zt']== "1") {echo "selected";}?> value="1">已转账</option>
                                    <option  <? if ($_GET['zt']== "3") {echo "selected";}?> value="3">已驳回</option>
 
                              </select>
                            </div>
                          
 
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                                <input type="text"  value=""  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            
                             </div>
                            到
                            <div class="form-group">
                                <input type="text" value="" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>                    </div>
                    
       </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>分站信息</th>
                                <th>提现金额</th>
                                <th>手续费</th>
                                <th>收款方式</th>
                                <th>收款账号</th>
                                <th>收款姓名</th>
                                <th>提现时间</th>
                                <th>状态</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
//所有条件						 
  if (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where     zt ='.$_GET['zt'].'       and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"     and  zid = '.$zhu_id.'     order by ID desc , ID desc';}


//只看时间						 
  elseif (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']=='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where             date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"    and  zid = '.$zhu_id.'      order by ID desc , ID desc';}

//只看状态						 
  elseif (     $_GET['date1']=='' and  $_GET['date2']==''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'fenzhantx where      zt ='.$_GET['zt'].'     and  zid = '.$zhu_id.'    order by ID desc , ID desc';}

 
   			 //无条件状态
  elseif (   $_GET['date1']=='' and  $_GET['date2']=='' and  $_GET['zt']==''  )	 
{	  $sql = 'select * from '.flag.'fenzhantx    where zid = '.$zhu_id.'     order by ID desc , ID desc';}
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $f_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['f_name']);
						 $f_qq=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['f_qq']);
						 $f_id=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['ID']);
						 $f_url=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['f_url']);
						 
 							?>
                              <tr>
                                <td><?=get_fenzhan('name',$row['fid'])?>(<?=$row['fid']?>)</td>
                                <td><a   ><?=$row['je']?> </a></td>
                                <td><a   ><?=$row['sxf']?> </a></td>
                                <td><a   ><?=$row['txfs']?></a></td>
                                <td><a   ><?=$row['txzh']?></a></td>
                                <td><a   ><?=$row['txxm']?></a></td>
                                <td><?=$row['date']?>&nbsp;</td>
                                <td><? if ($row['zt']==0){echo "<font  color='red'  >待处理</font>";}?>
                    <? if ($row['zt']==1){echo "<font color='green' >已转账</font>";}?>
                    <? if ($row['zt']==2){echo "<font color='#999999' >异常</font>";}?>
                    <? if ($row['zt']==3){echo "<font  color='blue' >已驳回</font>";}?></td>
                                <td><?=$row['desc']?></td>
                                <td>
                                 
                                                                      
                                                                      
<a  href="tx_chuli.php?id=<?=$row['ID']?>" class="btn-xs btn-info">去处理</a>
                                          
 
                                 <a  href="javascript:if(confirm('确实要删除吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-primary" >删除</a></td>
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
        <div class="modal-dialog"></div>
    </div>
   



        </div>
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


?> 
 <? include_once('footer.php');
?></body>
</html>
