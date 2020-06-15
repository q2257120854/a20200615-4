<?php 
$title='订单对接';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
check_qx($site_qx,'商品对接');
$nav = 'order';


//订单号查询
			$result1 = mysql_query('select * from  '.flag.'order where dingdanhao = "'.$_GET['dingdanhao'].'" and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
				 $oid=$row['ID'];

				 $num=$row['num'];
				 $shopid=$row['sid'];
				 $okeyname1=$row['keyname1'];
				 $okeyname2=$row['keyname2'];
				 $okeyname3=$row['keyname3'];
				 $okeyname4=$row['keyname4'];

				 $okey1=$row['key1'];
				 $okey2=$row['key2'];
				 $okey3=$row['key3'];
				 $okey4=$row['key4'];
 
	 }



//商品查询
			$result1 = mysql_query('select * from  '.flag.'shop where ID = '.$shopid.' and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
		 
				 $duijiesid=$row['duijiesid'];
				 $duijiefs=$row['duijiefs'];
				 $duijiesqlx=$row['duijiesqlx'];
 				 $duijiekey1=$row['duijiekey1'];
				 $duijiekey2=$row['duijiekey2'];
				 $duijiekey3=$row['duijiekey3'];
				 $duijiekey4=$row['duijiekey4'];
				 $canshu=$row['canshu'];
				 $canshu=explode('|',$canshu);
				 $canshu1=$canshu[0];
				 $canshu2=$canshu[1];
				 $canshu3=$canshu[2];
				 $canshu4=$canshu[3];
				 $key1=$row['duijiekey1'];
				 $key2=$row['duijiekey2'];
				 $key3=$row['duijiekey3'];
				 $key4=$row['duijiekey4'];
 
 
	 }


 //对接账户查询
			$result1 = mysql_query('select * from  '.flag.'duijie where id = '.$_GET['pingtai'].' and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
				 $pingtai=$row['pingtai'];
				 $loginname=$row['loginname'];
				 $loginpassword=$row['loginpassword'];
				 $pingtaiurl=$row['url'];
			 }
//亿乐
 if ($pingtai==2) 
 { 
$numname='number';
$sidname='goodsid'; 
$apiurl = 'http://'.$pingtaiurl.'/api/web/getGoodsList.html';
$params = array( );
$paramsString = http_build_query($params);
$content = @file_get_contents($apiurl);
$result = json_decode($content,true);
 $arr = json_decode($content,true);
$data = call_user_func_array('array_merge_recursive',$arr['list']);
//key为a的项所有值
$sid =$data['goodsid'];  //商品ID
$sname =$data['name']; //商品标题
$modelid =$data['modelid'];//模板ID
$goods_type_title =$data['goods_type_title'];//商品类型
$image_url =$data['image_url'];//商品图片
}

//玖伍
 if ($pingtai==3) {
$numname='need_num_0';
$numname='num';
$sidname='goods_id'; 
 
$apiurl = 'http://'.$pingtaiurl.'/index.php?m=home&c=api&a=get_goods_lists';
$params = array( );
$paramsString = http_build_query($params);
$content = @file_get_contents($apiurl);
$result = json_decode($content,true);
 $arr = json_decode($content,true);
$data = call_user_func_array('array_merge_recursive',$arr['goods_rows']);
//key为a的项所有值
$sid =$data['id'];  //商品ID
$sname =$data['title']; //商品标题
$goods_type =$data['goods_type'];//社区类型
$goods_type_title =$data['goods_type_title'];//商品类型
$unit =$data['unit'];//商品单位
} 
 
 
 
 //亿乐3.0
 if ($pingtai==4) 
 { 
$numname='num';
$sidname='gid'; 
 $time=strtotime('now');
 
 $params0 =  array(
  'api_token' => $loginname, 
  'timestamp' => $time,
 );
$key0 = $loginpassword;
$sign0 = getSign($params0, $key0);
  
  $post_data1 = array(
  'api_token' => $loginname, 
  'timestamp' => $time,
  'sign' => $sign0,  
 );
 
   
   $yileshoplist=  yilepost('http://'.$pingtaiurl.'.api.94sq.cn/api/goods/list', $post_data1);
   $list=getyileshop($yileshoplist);
   
}

//聚梦
if ($pingtai == 5) {
	$numname='num';
    $time = strtotime('now');
    $params0 = array('username' => $loginname, 'time' => $time);
    $key0 = $loginpassword;
    $sign0 = getSign($params0, $key0);
    $post_data1 = array('username' => $loginname, 'time' => $time, 'sign' => $sign0);
	$post_data1 = http_build_query($post_data1 , '' , '&');
    $yileshoplist = getCurl('http://' . $pingtaiurl . '.api.jumsq.com/Api/UserApi/GoodsList.html', $post_data1);
    $list = getjmshop($yileshoplist);
    $query = json_decode($yileshoplist, true);
    if ($query['status'] != 1) {
        $message = $query['content'];
    } else {
        $message = '请选择商品';
    }
}
 
//同系统查询主站ID

if ($pingtai==1)
{
 			$result1 = mysql_query('select * from  '.flag.'zhuzhan_domain where name = "'.$pingtaiurl.'" ');
			 if ($row = mysql_fetch_array($result1)){
				 $zhuzhanid=$row['zid'];
 	 }
	 }
 	
if($_POST['提交']=='重新对接'){
 	null_back($_POST[$numname],'请输入对接数量');
if ($okeyname1!='')
{  	null_back($_POST[$duijiekey1],'请输入'.$okeyname1.''); }	
if ($okeyname2!='')
{  	null_back($_POST[$duijiekey2],'请输入'.$okeyname2.''); }	
if ($okeyname3!='')
{  	null_back($_POST[$duijiekey3],'请输入'.$okeyname3.''); }	
if ($okeyname4!='')
{  	null_back($_POST[$duijiekey4],'请输入'.$okeyname4.''); }	
if ($pingtai==1) //主站对接
{ include('zhu.php');}	
if ($pingtai==2) //亿乐对接
{ include('yile.php');}	
if ($pingtai==3) //玖伍对接
{ include('jiuwu.php');}	

if ($pingtai==4) //玖伍对接
{ include('yile3.php');}	
if ($pingtai==5) //玖伍对接
{ include('jumeng.php');}	

	if ($duijiefanhuizt!='') {
	
    $_data2['duijiezt'] = $duijiefanhuizt;
	$sql2 = 'update '.flag.'order set '.arrtoupdate($_data2).' where id = '.$oid.' and zid ='.$zhu_id.'';
   if  ( mysql_query($sql2))
	{  alert_href('重新对接成功!','order.php?zt=&hid=&sid=&date1=&date2=&key='.$_GET['dingdanhao'].'');}
	else
	
	{  alert_href('对接失败!','');}
	}
	
	else
	
	{  alert_href('对接失败:返回状态失败!','');}
  }
  
 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?=$site_ico?>"/>
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
 
 
 					<?php
					$resultshop = mysql_query('select * from  '.flag.'shop where id = '.$shopid.' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($resultshop)){
					?>
      <form method="post" id="form" method="post">
         <div id="vue-page">
    <div class="row">
        <div class="col-lg-6">
                   <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
订单号:<?=$_GET['dingdanhao']?>                         </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
                         <div class="smart-widget-body">
                            <div class="form-horizontal">
                                 <div class="form-group" >
                                        <label class="col-lg-3 control-label">当前商品</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <select class="form-control"  name="sid"  style="width:278px" >
    <?php
 						$result1 = mysql_query('select * from '.flag.'shop where ID = '.$shopid.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>                         
                              <option    value="<?=$row1['ID']?>"><?=$row1['name']?> </option>
  
				 <? }?>
                 
                  </select>
		 
                                           
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">对接账户</label>
                                    <div class="col-lg-8">
                          <select name="duijie"   class="form-control"   >
             <?php
					 
						$result1 = mysql_query('select * from '.flag.'duijie where zid = '.$zhu_id.'   and  ID = '.$_GET['pingtai'].'   order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                   <option       <? if ($_GET['pingtai']==$row1['ID']){echo "selected";}?> value="?id=<?=$_GET['id']?>&pingtai=<?=$row1['ID']?>"  ><?=$row1['name']?></option>
                                                   <? }?>                                  
                                                                  
                                                                                     </select>
                                    </div>
                                </div>
                                 
                           <? if ($_GET['pingtai']!='') {?>
                                   <? if ($pingtai==1) { ?>
                                         <div class="form-group" >
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <select class="form-control"  name="sid"  style="width:278px" >
    <?php
 						$result1 = mysql_query('select * from '.flag.'shop where zid = '.$zhuzhanid.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>                         
                              <option  <? if($row['duijiesid']== $row1['ID'] ) {echo "selected";}?>  value="<?=$row1['ID']?>"><?=$row1['name']?> </option>
  
				 <? }?>
                 
                  </select>
		 
                                           
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <? }?>
                                  <? if ($pingtai==2) { ?>
                                 <!-- 亿乐--> 
                                <div  >
                                     <div class="form-group" v-if="apiKind==='kyx'|| apiKind==='ksw' || apiKind==='klg'">
                                     </div>
                                    <div class="form-group" v-else>
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                                <select    id="sid"  class="form-control"  onchange="aa()"   name="sid" >
<?php
 						 for ($i = 0; $i < sizeof($sid); $i++) {  
						  if ($api_status[$i] ==1)
   							?>
                  <option  <? if($row['duijiesid']== $sid[$i] ) {echo "selected";}?>   data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"> <?=$sname[$i]?></option>
   
				 <? }?>
                           </select>                                       
                                         </div>
                                    </div>
                                    <? }?>
									                        <?php if ($pingtai==4) { ?>
                        <!-- 亿乐3.0-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接商品</label>
                            <div class="col-lg-8">
                                <select id="sid" class="form-control" onchange="ylshopcanshu()" name="sid">
                                    <option data-id=""><?=$message?>
                                    </option>
                                    <?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php }?>
						                        <?php if ($pingtai==5) { ?>
                        <!--聚梦-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接商品</label>
                            <div class="col-lg-8">
                                <select id="sid" class="form-control" onchange="jmshopcanshu()" name="sid">
                                    <option data-id=""><?=$message?>
                                    </option>
                                    <?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php }?>
                                  
                                  
                                  <? if ($pingtai==3) { ?>
<!-- 玖伍-->
                                          <div class="form-group" >
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <select    id="sid"  class="form-control"  onchange="aa()"   name="sid" >
                                               
			 	<?php
						
						 for ($i = 0; $i < sizeof($sid); $i++) {  
						  if ($api_status[$i] ==1)
 { $zt = '<font  class="status4">完成</FONT>';}
						 
 							?>
                         
                              <option   <? if($row['duijiesid']== $sid[$i] ) {echo "selected";}?>   data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"> <?=$sname[$i]?> ID:<?=$sid[$i]?> 类型=<?=$goods_type[$i]?> </option>
                            
 
				 <? }?>
                 
                  </select>
		 
                                           
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group"  >
                                        <label class="col-lg-3 control-label">社区类型</label>
                                        <div class="col-lg-8">
                           <input name="sqlx"   id="sqlx"  value="<?=$row['duijiesqlx']?>"  placeholder="请输入社区类型" class="form-control"  type="text">
                                         </div>
                                    </div>
                                    
                                      <div class="form-group"  >
                                        <label class="col-lg-3 control-label">支付方式</label>
                                        <div class="col-lg-8">
                                            <select  name="fs" class="form-control" >
                                                <option  <? if ($row['duijiefs']==1) {echo "selected";}?> value="1">现金</option>
                                                <option  <? if ($row['duijiefs']==0) {echo "selected";}?>  value="0">卡密</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <? }?>
                                 
                      
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label">对接数量</label>
                                        <div class="col-lg-8">
                                         <input name="<?=$numname?>"  class="form-control"   value="<?=$num?>" type="text">
                                        </div>
                                    </div>
<? if ($okeyname1!=''){?>

                       
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label"><?=$okeyname1?></label>
                                        <div class="col-lg-8">
                                         <input name="<?=$duijiekey1?>"  class="form-control"   value="<?=$okey1?>" type="text">
                                        </div>
                                  </div>


<? }?>

<? if ($okeyname2!=''){?>

                       
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label"><?=$okeyname2?></label>
                                        <div class="col-lg-8">
                                         <input name="<?=$duijiekey2?>"  class="form-control"   value="<?=$okey2?>" type="text">
                                        </div>
                                  </div>


<? }?>


<? if ($okeyname3!=''){?>

                       
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label"><?=$okeyname3?></label>
                                        <div class="col-lg-8">
                                         <input name="<?=$duijiekey3?>"  class="form-control"   value="<?=$okey3?>" type="text">
                                        </div>
                                  </div>


<? }?>


<? if ($okeyname4!=''){?>

                       
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label"><?=$okeyname4?></label>
                                        <div class="col-lg-8">
                                         <input name="<?=$duijiekey4?>"  class="form-control"   value="<?=$okey1?>" type="text">
                                        </div>
                                  </div>


<? }?>
                                    
                                     
 <? }?>
 
                   </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right"  >
                        <div class="btn-group">
                          <input name="按钮" onclick="javascript:history.back(-1);" type="button" class="btn btn-success" id="提交" value="返回">
          <input name="提交"  class="btn btn-info"   type="submit"   id="提交" value="重新对接">

                      </div>
                    </div>
                </div>
            </div>
 </div>
        
    </form>
 
 
 <? }?>
</div>
 
 <? include_once('footer.php');
?>
  </body>
</html>
