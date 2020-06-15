<?
  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'order';


if($_POST['提交']=='提交'){
 if ($_POST['ozt']!=7) 
{	$_data['zt'] = $_POST['zt']; }
	$_data['desc'] = $_POST['o_memo'];
	 
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}

if($_POST['提交']=='立即退款'){
 	$_data['zt'] = 7;
   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].'  and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
	
	$_data1['hyid'] = $_POST['hid'];
	$_data1['hyname'] = $_POST['hyname'];
 	$_data1['xf_qje'] = get_member_point($_POST['hid']);
 	$_data1['xf_je'] = $_POST['o_price'];
 	$_data1['xf_hje'] = get_member_point($_POST['hid'])+$_POST['o_price'];
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_lx'] =1;  
  	$_data1['xf_qk'] =$_POST['oid'].'订单退款';  
  	$_data1['zid'] =$zhu_id;  

   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	
	
    $_data2['point'] = get_member_point($_POST['hid'])+$_POST['o_price'];
    $str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'user set '.arrtoupdate($_data2).' where id = '.$_POST['hid'].' and zid ='.$zhu_id.'';
    mysql_query($sql2);
	
 
		alert_href('退款成功!','');
	}else{
		alert_back('退款失败!');
	}
}



if($_POST['提交']=='受理补单'){
 	$_data['zt'] = 5;
   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid ='.$zhu_id.' ';
	if(mysql_query($sql)){
 		alert_href('受理成功!','');
	}else{
		alert_back('受理失败!');
	}
}

if($_POST['提交']=='补单完成'){
 	$_data['zt'] = 6;
 	$_data['desc'] = $_POST['o_memo'];
    $str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid ='.$zhu_id.'';
	if(mysql_query($sql)){
 		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}
if($_POST['提交']=='开始处理'){
 	$_data['zt'] = 1;
   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid ='.$zhu_id.' ';
	if(mysql_query($sql)){
 		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}
if($_POST['提交']=='订单异常'){
	
	 null_back($_POST['o_memo'],'请输入异常反馈');
	
 	$_data['zt'] = 4;
 	$_data['desc'] = $_POST['o_memo'];

   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid ='.$zhu_id.' ';
	if(mysql_query($sql)){
 		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}




 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>

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
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'order where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form method="post" id="form">
    <input name="hid" type="hidden" value="<?=$row['hyid']?>">
    <input name="hyname" type="hidden" value="<?=$row['hyname']?>">
    <input name="o_price" type="hidden" value="<?=$row['price']?>">
    <input name="ozt" type="hidden" value="<?=$row['zt']?>">

 
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="smart-widget-header"><?=$row['dingdanhao']?>[编号:<?=$row['ID']?>]-订单处理</div>
                        <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        商品信息
                    </div>
                        <div class="smart-widget-body">
                            <div class="form-horizontal">

                                    <div class="form-group">
                                  <label class="col-lg-3 control-label">订单号</label>
                                    <div class="col-lg-8">
                             <input name="oid" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['dingdanhao']?>">

                                  </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">商品信息</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['sname']?>(<?=$row['sid']?>)">

                                  </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">用户信息</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['hyname']?>编号:<?=$row['hyid']?>">

                                  </div>
                                </div>


                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">下单内容</label>
                                    <div class="col-lg-8">
                                      <textarea name="s_name" readonly class="form-control" id="s_name" placeholder=""><?  if ($row['key1']!='') {echo $row['keyname1'].":".$row['key1']; } ?>
									  <?  if ($row['key2']!='') {echo $row['keyname2'].":".$row['key2']; } ?>
									  <?  if ($row['key3']!='') {echo $row['keyname3'].":".$row['key3']; } ?>
									  <?  if ($row['key4']!='') {echo $row['keyname4'].":".$row['key4']; } ?></textarea>

                                    </div>
                                </div>
                                
                                
                                       
                                   
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">初始数量</label>
                                    <div class="col-lg-8">
                             <input name="csnum" type="text" class="form-control" id="" placeholder=""    value="<?=$row['csnum']?>" />

                                  </div>
                                </div>
                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">下单数量</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['num']?>" />

                                  </div>
                                </div>


   <div class="form-group">
                                  <label class="col-lg-3 control-label">当前数量</label>
                                    <div class="col-lg-8">
                             <input name="dqnum" type="text" class="form-control" id="" placeholder=""    value="<?=$row['dqnum']?>" />

                                  </div>
                                </div>

                                <div class="form-group">
                                <label class="col-lg-3 control-label">下单余额</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input name="je" type="text" disabled="" class="form-control" id="je" value="<?=$row['price']?>">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                                
                                
                                    
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">下单时间</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['date']?>">

                                  </div>
                                </div>
   
                              
                                
                                  <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">订单状态</label>
                                        <div class="col-lg-8">
                                            <select   disabled  name="zt" class="form-control" id="zt" v-model="apiType">
                              <option  <? if ($row['zt']==0) {echo "selected";}?>   value="0">等待中</option>
                              <option  <? if ($row['zt']==1) {echo "selected";}?>   value="1">进行中</option>
                               <option  <? if ($row['zt']==4) {echo "selected";}?>   value="3">已退单</option>

                               <option  <? if ($row['zt']==4) {echo "selected";}?>   value="4">异常中</option>
                               <option  <? if ($row['zt']==8) {echo "selected";}?>   value="8">待补单</option>
                              <option  <? if ($row['zt']==5) {echo "selected";}?>   value="5">补单中</option>
                              <option  <? if ($row['zt']==6) {echo "selected";}?>   value="6">已完成</option>
                              <option  <? if ($row['zt']==9) {echo "selected";}?>   value="9">退款中</option>
                              <option  <? if ($row['zt']==7) {echo "selected";}?>   value="7">已退款</option>
 
 
                                             </select>
                                    </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">备注</label>
                                    <div class="col-lg-8">
                     <textarea name="o_memo" class="form-control" id="s_name" placeholder=""><?=$row['desc']?></textarea>

                                    </div>
                                </div> 
                                </div> 
                            </div>
                        </div>     
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                         
                    <? if ($row['zt'] == 0) {  ?>
                         <input name="提交"  onclick="return confirm('您确定要开始处理该订单?')" type="submit"  class="btn btn-success" id="提交" value="开始处理">
						 <? }?>


                    <? if ($row['zt'] == 5) {  ?>
                         <input name="提交"  onclick="return confirm('您确定要已完成补单?')" type="submit"  class="btn btn-success" id="提交" value="补单完成">
						 <? }?>



                    <? if ($row['zt'] == 8) {  ?>
                         <input name="提交"  onclick="return confirm('您确定要受理补单?')" type="submit"  class="btn btn-success" id="提交" value="受理补单">
						 <? }?>
                         

                    <? if ($row['zt'] == 0 or $row['zt'] == 1) {  ?>
                         <input name="提交"  onclick="return confirm('您确定该订单异常?')" type="submit"  class="btn btn-success" id="提交" value="订单异常">
						 <? }?>
                         
                    <? if ($row['zt'] != 7) {  ?>
                         <input name="提交"  onclick="return confirm('您确定要退款?')" type="submit"  class="btn btn-success" id="提交" value="立即退款">
						 <? }?>
                    
                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="提交">



</div>
                </div>
            </div>
        </div>
    </form>
 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->
</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
