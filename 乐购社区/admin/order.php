<?php 
$title='订单统计';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'order';

if($_GET['act']=='tk'){
 	$_data['zt'] = 7;
   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].'  and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
	
	$_data1['hyid'] = $_GET['hid'];
	$_data1['hyname'] = $_GET['hyname'];
 	$_data1['xf_qje'] = get_member_point($_GET['hid']);
 	$_data1['xf_je'] = $_GET['o_price'];
 	$_data1['xf_hje'] = get_member_point($_GET['hid'])+$_GET['o_price'];
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_lx'] =1;  
  	$_data1['xf_qk'] =$_GET['o_id'].'订单退款';  
  	$_data1['zid'] =$zhu_id;  

   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	
	
    $_data2['point'] = get_member_point($_GET['hid'])+$_GET['o_price'];
	$sql2 = 'update '.flag.'user set '.arrtoupdate($_data2).' where id = '.$_GET['hid'].' and zid ='.$zhu_id.'';
    mysql_query($sql2);
	
 
		alert_href('退款成功!','?');
	}else{
		alert_back('退款失败!');
	}
}

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'order where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','order.php');
	}else{
		alert_back('删除失败！');
	}
}



if($_POST['act'] =='pl' and $_POST['提交'] =='进行中'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个订单,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str="update ".flag."order   set zt=1   where ID in ($id) and zid = ".$zhu_id."";
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
}
}



if($_POST['act'] =='pl' and $_POST['提交'] =='补单中'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个订单,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str="update ".flag."order   set zt=5   where ID in ($id) and zid = ".$zhu_id."";
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
}
}


if($_POST['act'] =='pl' and $_POST['提交'] =='已完成'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个订单,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str="update ".flag."order   set zt=6   where ID in ($id) and zid = ".$zhu_id."";
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
}
}

if($_POST['act'] =='pl' and $_POST['提交'] =='异常中'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个订单,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str="update ".flag."order   set zt=4   where ID in ($id) and zid = ".$zhu_id."";
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
}
}


if($_POST['act'] =='pl' and $_POST['提交'] =='已退单'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择一个订单,才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str="update ".flag."order   set zt=3   where ID in ($id) and zid = ".$zhu_id."";
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
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
                        订单统计
                    </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                            <div class="form-group">
                                <select name="zt"   class="form-control" id="zt">
                                    <option  <? if ($_GET['zt']) {echo 'selected="selected"';}?> value="">所有</option>
                                     <option  <? if ($_GET['zt'] == '0' ) {echo "selected";}?>  value="0">等待中</option>
                                    <option  <? if ($_GET['zt']==1) {echo "selected";}?> value="1">进行中</option>
                                      <option  <? if ($_GET['zt']==4) {echo "selected";}?> value="4">异常中</option>
                                    <option  <? if ($_GET['zt']==2) {echo "selected";}?> value="8">待补单</option>
                                    <option  <? if ($_GET['zt']==5) {echo "selected";}?> value="5">补单中</option>
                                    <option  <? if ($_GET['zt']==6) {echo "selected";}?> value="6">已完成</option>
                                    <option  <? if ($_GET['zt']==9) {echo "selected";}?> value="9">退款中</option>

                                    <option  <? if ($_GET['zt']==7) {echo "selected";}?> value="7">已退款</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <select name="hid"   class="form-control" id="hid">
                                    <option  <? if ($_GET['hid']=='') {echo "selected";}?> value="">所有会员</option>
                                       <?php
					 
						$result = mysql_query('select * from '.flag.'user where zid = '.$zhu_id.'  order by ID asc ,ID asc');
						while($row = mysql_fetch_array($result)){
						?>
                                     <option  <? if ($_GET['hid']==$row['ID']) {echo "selected";}?> value="<?=$row['ID']?>"><?=$row['name']?></option>
                                     <? }?>
                              </select>
                            </div>
                            
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
                            <th>订单号</th>
                            <th>商品信息</th>
                            <th>用户信息</th>
                             <th>下单内容</th>
                             <th>初始数量</th>
                            <th>下单数量</th>
                            <th>当前数量</th>
                            <th>下单金额</th>
                            <th>下单时间</th>
                            <th>对接状态</th>
                            <th>订单状态</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//无任何条件搜索 
 if ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'order  where zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看状态+会员+商品+时间+搜索
elseif ($_GET['zt']!='' and $_GET['hid']!=''  and   $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']!=''   )	 
{	  $sql = 'select * from '.flag.'order  where zt = '.$_GET['zt'].' and  hyid = '.$_GET['hid'].'  and  sid = '.$_GET['sid'].'    and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"  and  dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //只看状态+会员+商品+时间
elseif ($_GET['zt']!='' and $_GET['hid']!=''  and   $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'order  where zt = '.$_GET['zt'].' and  hyid = '.$_GET['hid'].'  and  sid = '.$_GET['sid'].'    and  date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.'     order by ID desc , ID desc';}

 //只看状态+会员+商品
elseif ($_GET['zt']!='' and $_GET['hid']!=''  and   $_GET['sid']!='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'order  where zt = '.$_GET['zt'].' and  hyid = '.$_GET['hid'].'  and  sid = '.$_GET['sid'].'     and zid = '.$zhu_id.'    order by ID desc , ID desc';}
  
//只看状态+会员
elseif ($_GET['zt']!='' and $_GET['hid']!=''  and   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{	  $sql = 'select * from '.flag.'order  where zt = '.$_GET['zt'].' and  hyid = '.$_GET['hid'].'   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

//只看状态+商品
elseif ($_GET['zt']!='' and $_GET['hid']==''  and   $_GET['sid']!='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where zt = '.$_GET['zt'].' and  sid = '.$_GET['sid'].'    and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 
//只看时间
elseif ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']=='' and     $_GET['date1']!='' and  $_GET['date2']!=''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where   date >= "'.$_GET['date1'].'"   and  date <= "'.$_GET['date2'].'"    and zid = '.$zhu_id.'  order by ID desc , ID desc';}

//只看单一时间
elseif ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']=='' and     $_GET['date1']!='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where   date >= "'.$_GET['date1'].'"   and zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看单一时间+商品
elseif ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']!='' and     $_GET['date1']!='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where   date >= "'.$_GET['date1'].'"  and sid='.$_GET['sid'].'    and zid = '.$zhu_id.'   order by ID desc , ID desc';}

//只看状态
elseif ($_GET['zt']!='' and $_GET['hid']==''  and   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where    zt = '.$_GET['zt'].'   and zid = '.$zhu_id.'     order by ID desc , ID desc';}

//只看会员
elseif ($_GET['zt']=='' and $_GET['hid']!=''  and   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where    hyid = '.$_GET['hid'].'    and zid = '.$zhu_id.'    order by ID desc , ID desc';}


//只看商品
elseif ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']!='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']==''   )	 
{ $sql = 'select * from '.flag.'order  where    sid = '.$_GET['sid'].'   and zid = '.$zhu_id.'    order by ID desc , ID desc';}

//只搜索
elseif ($_GET['zt']=='' and $_GET['hid']==''  and   $_GET['sid']=='' and     $_GET['date1']=='' and  $_GET['date2']==''    and  $_GET['key']!=''   )	 
{ $sql = 'select * from '.flag.'order  where    dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'      order by ID desc , ID desc';}


 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $dingdanhao=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['dingdanhao']);

 							?>
                          <tr>
                            <td><input type="checkbox" name="id[]" value="<?=$row['ID']?>" style="background:none; border:none;">&nbsp;</td>
                            <td><?=$row['zid'];?> &nbsp;</td>
                            <td><?=$dingdanhao?></td>
                            <td><?=$row['sname']?></td>
                            <td><?=$row['hyname']?>[编号:<?=$row['hyid']?>]</td>
                            <td>
                   <?  if ($row['key1']!='') {echo $row['keyname1'].":".$row['key1']."<br>"; } ?>
                   <?  if ($row['key2']!='') {echo $row['keyname2'].":".$row['key2']."<br>"; } ?>
                   <?  if ($row['key3']!='') {echo $row['keyname3'].":".$row['key3']."<br>"; } ?>
                   <?  if ($row['key4']!='') {echo $row['keyname4'].":".$row['key4']."<br>"; } ?>

                            </td>
                            <td><?=$row['csnum']?></td>
                            <td><?=$row['num']?></td>
                            <td><?=$row['dqnum']?></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['date']?></td>
                            <td>
							    
 
 <?=$row['duijiezt']?>&nbsp;</td>
                               <td>
							   
                         
							<? if ($row['zt'] ==0) {echo "<font color='red'>等待中</font>"; }?>
                              <? if ($row['zt'] ==1) {echo "<font color='green'>进行中</font>"; }?>
                              <? if ($row['zt'] ==2) {echo "<font color='blue'>退单中</font>"; }?>
                              <? if ($row['zt'] ==3) {echo "<font color='blue'>已退单</font>"; }?>
                              <? if ($row['zt'] ==4) {echo "<font color='pink'>异常中</font>"; }?>
 
                              <? if ($row['zt'] ==5) {echo "<font color='blue'>补单中</font>"; }?>
                              <? if ($row['zt'] ==6) {echo "<font color='blue'>已完成</font>"; }?>
                              <? if ($row['zt'] ==7) {echo "<font color='red'>已退款</font>"; }?>
                             <? if ($row['zt'] ==8) {echo "<font color='orange'>待补单</font>"; }?>
                               <? if ($row['zt'] ==9) {echo "<font color='black'>退款中</font>"; }?>
                             
                               
                               
                               </td>
 

                            <td>  
                             
                             <? if ($row['zt']!=7){?>  <a  class="btn-xs btn-warning"  href="javascript:if(confirm('确定要为该订单退款吗?'))location='?act=tk&id=<?=$row['ID']?>&hid=<?=$row['hyid']?>&hyname=<?=$row['hyname']?>&o_price=<?=$row['price']?>&o_id=<?=$row['dingdanhao']?>'"     >退款</a><? }?>
                         
                <a class="btn-xs btn-info"  href="order_edit.php?id=<?=$row['ID']?>" >备注</a>

         <? if (get_shopduijie($row['sid'])!='0' and $row['duijiezt']!='') { echo "  <a    href='order_duijie.php?sid=".$row['sid']."&pingtai=".get_shopduijie($row['sid'])."&dingdanhao=".$row['dingdanhao']."'  class='btn-xs btn-primary' >重新对接</a>";  }
 ?>
 
 
                                 </td>
</td>
                          </tr>
                         
                          <? }?>
                            <tr>
                            <td colspan="14" align="left">     
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr  align="left">
    <td width="48%" align="left">
      <span   onClick="selectBox('reverse')"   class="btn btn-warning purple">选择项</span>
     <input name="提交" class="btn btn-info purple"  type="submit" value="进行中">
     <input name="提交" class="btn btn-info purple"  type="submit" value="补单中">
   <input name="提交" class="btn btn-success purple"  type="submit" value="已完成">
   <input name="提交" class="btn btn-warning purple"  type="submit" value="已退单">
   <input name="提交" class="btn btn-warning purple"  type="submit" value="异常中">
   </td>
 
  
   
    <td width="22%"  align="left"   style="display:none"><input name="提交"  class="btn btn-purple purple"  type="submit" value="批量修改"></td>
    <td width="40%">   </td>
 
   </tr>
</table>
                          </td>
                          </tr>
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
 <!-- /main-container -->

 <? include('footer.php');
?>
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


//获取商品对接
	 function get_shopduijie($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		if($row['duijie']!=-1){
		return $row['duijie'];
		}else{return '0';}
	} else {
		return '0';
	}
}

 ?> 
 <? include_once('footer.php');
?></body>
</html>
