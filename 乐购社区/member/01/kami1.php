 <? $nav='pay';?>

<? if (strpos($site_qx,'批量下单') !==false) {
      include('plpost1.php');
}
if ($_POST['提交']=='确认下单'){
	
if ($key1 != '')	
{	 null_back($_POST[$key1],'请输入'.$keyname1.''); }
  
 if ($key2 != '')	
{	 null_back($_POST[$key2],'请输入'.$keyname2.''); }
  
 if ($key3 != '')	
{	 null_back($_POST[$key3],'请输入'.$keyname3.''); }
  
 if ($key4 != '')	
{	 null_back($_POST[$key4],'请输入'.$keyname4.''); }
  
 
  

  null_back($_POST['num'],'请输入下单数量');
if ($_POST['num']< $s_dnum)
{         alert_href('下单失败:数量不能低于'.$s_dnum.'!',''); }  

if ($_POST['num']> $s_gnum)
{         alert_href('下单失败:数量不能高于'.$s_gnum.'!',''); }  
  
$pay_price =$_POST['num']; //实际购买价格 
//下单份数
$xiadan_fenshu = $_POST['num']/$s_dnum; //实际份数 


if ($km_dianshu < $xiadan_fenshu)
{ 		alert_href('下单失败:您的点数'.$km_dianshu.'点不足下'.$xiadan_fenshu.'份!',''); }		 
	else
	
{ 		
    $xfhje = $km_dianshu-$xiadan_fenshu;
    $_data['dianshu'] = $xfhje; 
   //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'kmuser set '.arrtoupdate($_data).' where id = '.$km_id.'';
	if(mysql_query($sql)){
   
    $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

	if ($pingtai == 1)
	{require_once('duijie/zhu.php');}
	if ( $pingtai == 2)
	{require_once('duijie/yile.php');}
	if ( $pingtai == 3)
	{require_once('duijie/95.php');}
	
	
    //订单记录
	$_data2['dingdanhao'] = $danhao;
	$_data2['sid'] = $_GET['id'];
 	$_data2['sname'] = $s_name;
 	$_data2['hyid'] = $km_id;
 	$_data2['hyname'] = $km_kahao;
	
if ($keyname1!=''){	$_data2['keyname1'] = $keyname1; }
if ($keyname2!=''){	$_data2['keyname2'] =$keyname2; }
if ($keyname3!=''){	$_data2['keyname3'] = $keyname3; }
if ($keyname4!=''){	$_data2['keyname4'] = $keyname4; }


 	$_data2['key1'] = $_POST[$key1];
 	$_data2['key2'] = $_POST[$key2];
 	$_data2['key3'] = $_POST[$key3];
 	$_data2['key4'] = $_POST[$key4];


  
	
 	$_data2['csnum'] =  0;
 	$_data2['num'] =  $_POST['num'];
 	$_data2['dqnum'] = 0;
	
 	$_data2['price'] =  $pay_price;
 	$_data2['zt'] = get_shopzt($_GET['id']);
 	$_data2['duijiezt'] =  $s_duijiezt;
    $_data2['date'] =$sj;   
    $_data2['zid'] =$zhu_id;   
if ($zhu=='true')
{   $_data2['fid'] =0;  }
else
{   $_data2['fid'] =$fen_id;  }
 
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'insert into '.flag.'order ('.$str2[0].') values ('.$str2[1].')';
    mysql_query($sql2);	
  
 	
	   alert_href('下单成功!','');
	}
	else
	{   alert_href('下单失败!','');  }
}


 
 }
 
 
 //申请补单
 
 if($_GET['act']=='bd'){
	
  	$_data['zt'] = 8;
    	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['oid'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
 		alert_href('申请成功,等待处理!','/index/home/order/id/'.$_GET['id'].'.html');
	}else{
		alert_back('申请补单失败!');
	}
}


 //申请退款
 
 if($_GET['act']=='tk'){
	
  	$_data['zt'] = 9;
    	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'order set '.arrtoupdate($_data).' where id = '.$_GET['oid'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
 		alert_href('申请成功,等待处理!','/index/home/order/id/'.$_GET['id'].'.html');
	}else{
		alert_back('申请退款失败!');
	}
}

 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <title><?=$s_name?>-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>" type="image/x-icon" />
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
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
    <script>
function sum() {
	var n1 = document.getElementById("czje").value;
	var n2 = document.getElementById("sxf").value;
 
	document.getElementById("payInput").value = parseInt(n1)+parseInt(n1)*(parseInt(n2)/100);
}
</script>
     <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
     </script>
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

  <div class="an-content-body" style="padding: 8px" id="pjax-container">
                            <div class="row">
            <div class="an-helper-block">
                <div class="an-small-doc-blcok success"><?=$s_content?></div>
            </div>
        </div>
        <div id="vue">
                    <div class="row" id="order-row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-yellow"><?=$s_name?>        </div>
                        <div class="panel-body">
                            <div class="list-group">
                        <div class="list-group-item">类型：<?=$name?></div>

                    
                        <div class="list-group-item">卡号：<?=$km_kahao?></div>
                      
                        <div class="list-group-item">
                            点数：<span id=""><?=get_xiaoshu($km_dianshu,0)?></span> 点
                            <span class="pull-right">
                                 <a class="btn btn-xs btn-info"   data-toggle="modal"
                                          data-target="#modal-power">充值</a>
                            </span>
                        </div>
                        
                        <div class="list-group-item list-group-item-success">
                            价格：<span id="">1</span> 点 / <?=$s_unit?>                        </div>
                    
                  </div>
                        </div>
                    </div>
                </div>
     <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-blue">
                            单个购买
             </div>
                        <div class="panel-body">
                    <form class="form-horizontal" id="orderForm" method="post">
                    <? if ($key1!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="text"  name="<?=$key1?>"      placeholder="输入你的<?=$keyname1?>"  >
     </div>
      <? }?> 
      
       <? if ($key2!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="text"  name="<?=$key2?>"      placeholder="输入你的<?=$keyname2?>"  >
     </div>
      <? }?> 
      
      
       <? if ($key3!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="text"  name="<?=$key3?>"      placeholder="输入你的<?=$keyname3?>"  >
     </div>
      <? }?> 
      
       <? if ($key4!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="text"  name="<?=$key4?>"      placeholder="输入你的<?=$keyname4?>"  >
     </div>
      <? }?> 
              

 
</script>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="num" type="number" class="form-control"
                                       onchange="$('#orderRmb').val(('<?=$s_price?>'*this.value).toFixed(6));"
                                       placeholder="输入下单数量(<?=$s_dnum?>-<?=$s_gnum?>)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                      <span class="input-group-text">需要</span>
                                    <input class="form-control" value="0" id="orderRmb" disabled>
                                        <span class="input-group-text">点</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                            <input name="提交"  type="submit"  class="btn btn-success btn-block order_btn" id="提交" value="确认下单">
                                
                                   

                          </div>
                        </div>
                    </form>
                                </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-blue">
                            批量下单
                        </div>
                        <div class="panel-body">
                            <div class="an-small-doc-blcok info">
                               批量格式：下单数量----<? if ($keyname1!=''){echo $keyname1.'----' ;}?><? if ($keyname2!=''){echo $keyname2.'----' ;}?><? if ($keyname3!=''){echo $keyname3.'----' ;}?><? if ($keyname4!=''){echo $keyname4.'' ;}?> PS:一行一条订单
                            </div>            
                        <div class="form-group">
                            <div class="col-xs-12">
                              <textarea name="neirong" rows="5" class="form-control"   <? if (strpos($site_qx,'批量下单') ==false) { echo "disabled"; }?>   ></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="button"
                                        class="btn btn-purple btn-block order_btn"
                                        data-form="plOrderForm">
                                    确认下单                                </button>
 </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
 <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-vine">
                            订单列表
                    </div>
                    <div class="list-group-item bg-grey" style="overflow: hidden;">
                      <form id="subform" name="subform"  method="post"    action="" class="form-inline"   >
                        <input name="id" type="hidden" value="<?=$_GET['id']?>">
                            <input type="text" class="hidden" disabled>
                         
                            <select class="form-control" onChange="MM_jumpMenu('parent',this,0)">
                                     <?php
					 
						$result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.'  order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option   <? if ($_GET['id']==$row['ID']) {echo "selected";}?>   value="/index/home/order/id/<?=$row['ID']?>.html"><?=$row['name']?></option>
                                                <? }?> 
                                    
                                     
                          </select>
                          
                            <div class="form-group">
                                <select name="zt"   class="form-control" id="zt">
                                    <option  <? if ($_POST['zt']) {echo 'selected="selected"';}?> value="">所有</option>
                                  <option  <? if ($_POST['zt'] == '0' ) {echo "selected";}?>  value="0">等待中</option>
                                    <option  <? if ($_POST['zt']=='1') {echo "selected";}?> value="1">进行中</option>
                                      <option  <? if ($_POST['zt']=='4') {echo "selected";}?> value="4">异常中</option>
                                    <option  <? if ($_POST['zt']=='8') {echo "selected";}?> value="8">待补单</option>
                                    <option  <? if ($_POST['zt']=='5') {echo "selected";}?> value="5">补单中</option>
                                  <option  <? if ($_POST['zt']=='6') {echo "selected";}?> value="6">已完成</option>
                                    <option  <? if ($_POST['zt']=='9') {echo "selected";}?> value="9">退款中</option>
                                    <option  <? if ($_POST['zt']=='7') {echo "selected";}?> value="7">已退款</option>

                              </select>
                            </div>
                            <script type="text/javascript" src="/js/adddate.js" ></script> 

                            <div class="form-group">
                                 <input type="text"  value="<?=$_POST['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_POST['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>订单号</th>
                            <? if ($key1 != '') {?>
                            <th><?=$keyname1?></th>
                            <? }?>
                            <? if ($key2 != '') {?>
                            <th><?=$keyname2?></th>
                            <? }?>
                            <? if ($key3 != '') {?>
                            <th><?=$keyname3?></th>
                            <? }?>
                            <? if ($key4 != '') {?>
                            <th><?=$keyname4?></th>
                            <? }?>
                             <th>初始数量</th>
                                                     
 
                            <th>下单数量</th>
                            <th>当前数量</th>
                            <th>下单金额</th>
                             <th>下单时间</th>
                            <th>订单状态</th>
                            <th>备注</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
						  
if ($zhu=='true')						  
	{					  
//无任何条件搜索 
 if ($_POST['zt']==''  and    $_POST['date1']=='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_GET['id'].'   and zid = '.$zhu_id.' order by ID desc , ID desc';}
//只看状态
elseif ($_POST['zt']!=''  and    $_POST['date1']=='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and zt = '.$_POST['zt'].' and zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看时间
elseif ($_POST['zt']==''  and    $_POST['date1']!='' and  $_POST['date2']!=''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and date >= "'.$_POST['date1'].'" and  date <= "'.$_POST['date2'].'"  and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //只看单个时间
elseif ($_POST['zt']==''  and    $_POST['date1']!='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and date <= "'.$_POST['date1'].'"   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //看全部条件
elseif ($_POST['zt']!=''  and    $_POST['date1']!='' and  $_POST['date2']!=''      )	 
{	  $sql = 'select * from  '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'   and zt = '.$_POST['zt'].'   and date >= "'.$_POST['date1'].'"   and date <= "'.$_POST['date2'].'"   and zid = '.$zhu_id.' order by ID desc , ID desc';}

 
}
else

	{					  
//无任何条件搜索 
 if ($_POST['zt']==''  and    $_POST['date1']=='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_GET['id'].'   and zid = '.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}
//只看状态
elseif ($_POST['zt']!=''  and    $_POST['date1']=='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and zt = '.$_POST['zt'].' and zid = '.$zhu_id.'   and fid = '.$fen_id.'  order by ID desc , ID desc';}
//只看时间
elseif ($_POST['zt']==''  and    $_POST['date1']!='' and  $_POST['date2']!=''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and date >= "'.$_POST['date1'].'" and  date <= "'.$_POST['date2'].'"  and zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc , ID desc';}

 //只看单个时间
elseif ($_POST['zt']==''  and    $_POST['date1']!='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'  and date <= "'.$_POST['date1'].'"   and zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc , ID desc';}

 //看全部条件
elseif ($_POST['zt']!=''  and    $_POST['date1']!='' and  $_POST['date2']!=''      )	 
{	  $sql = 'select * from  '.flag.'order where hyid = '.$km_id.' and hyname = "'.$km_kahao.'" and sid ='.$_POST['id'].'   and zt = '.$_POST['zt'].'   and date >= "'.$_POST['date1'].'"   and date <= "'.$_POST['date2'].'"   and zid = '.$zhu_id.' and fid = '.$fen_id.' order by ID desc , ID desc';}

 
}



 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $dingdanhao=str_replace($_POST['key'],"<font color=red> ".$_POST['key']."</font>",$row['dingdanhao']);

 							?>
                          <tr>
                            <td><?=$dingdanhao?></td>

                            <? if ($key1 !='') {?>
                            <td> <?=$row['key1']?></td>
                            <? }?>
                            <? if ($key2 !='') {?>
                            <td> <?=$row['key2']?></td>
                            <? }?>
                            <? if ($key3 !='') {?>
                            <td> <?=$row['key3']?></td>
                            <? }?>
                            <? if ($key4 !='') {?>
                            <td> <?=$row['key4']?></td>
                            <? }?>

                            <td><? if ($row['csnum']==0){echo "--";} else {echo $row['csnum'];}?></td>
                                                     
                            <td><?=$row['num']?></td>
                            <td><? if ($row['dqnum']==0){echo "--";} else {echo $row['dqnum'];}?></td>
                            <td><?=get_xiaoshu($row['price'],2)?></td>
  
                            <td><?=$row['date']?></td>
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
                            <td><?=$row['desc']?>&nbsp;</td>
                            <td> 
                         <? if ($s_tk==1 and $row['zt']!= 9 and $row['zt']!= 7){?>
                           <a class="btn-xs btn-info"    href="javascript:if(confirm('您确定要申请退款?'))location='/member/index.php?act=tk&id=<?=$_GET['id']?>&oid=<?=$row['ID']?>'"  >申请退款</a>
                             <? }?>

                         <? if ($s_bd==1 and $row['zt'] != 8 and $row['zt'] != 5 and $row['zt'] != 9 and $row['zt'] != 7){?>
                             <a  href="javascript:if(confirm('确定要申请补单?'))location='/member/index.php?act=bd&id=<?=$_GET['id']?>&oid=<?=$row['ID']?>'"  class="btn-xs btn-primary" >申请补单</a>
                             <? }?>
                             </td>
                            </td>
                          </tr>
                          <? }?>
                        </tbody>
                      </table>
                      <div class="smart-widget-footer text-center">
                        <nav class="text-center">
                          <ul class="pagination" style="display: -webkit-inline-box;">
                            <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>
                          </ul>
                        </nav>
                      </div>
                  </div>
                     </div>
                      </div>
                       </div>
                        </div>
                         </div>
                          </div> </div>
                   
             
      
          
                <?
				 if ($_POST['确定']=='提交')  
		  {
		  null_back($_POST['card'],'请输入充值卡');

   
 	  $sel="select * from ".flag."kami where kahao = '".$_POST['card']."'  and zt =0   and zid = ".$zhu_id."   ";
  $sl=@mysql_query($sel);
  $s=@mysql_fetch_array($sl);
  if (is_array($s)){
  
 
	$sql1 = 'update '.flag.'kami set zt=1,hyid=0,hyname="'.$km_kahao.'",cdate="'.$sj.'" where ID = '.$s['ID'].' and  zid = '.$zhu_id.'  ';
	 mysql_query($sql1);
	 
  //增加点数
     $_data['dianshu'] = $km_dianshu+$s['point']; 
     //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'kmuser set '.arrtoupdate($_data).' where id = '.$km_id.' and  zid = '.$zhu_id.' ';
	 mysql_query($sql);
	 
	  
 
  
	alert_href('充值成功','');  		
		  }
  
  else
  {
	     echo "<script language=\"javascript\"> alert ('充值失败:卡密不正确或已被充值!');</script>";
   }
				
				
				  }
				
				?>
                
          <div class="modal" id="modal-power">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>点数充值</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="powerForm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">请输入充值卡</label>
                        <div class="col-lg-8">
                            <input name="card" type="text" class="form-control"  placeholder="请输入充值卡">
                        </div>
                    </div>
           
            </div>
            <div class="modal-footer">
 
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
<input name="确定"   class="btn btn-primary"  type="submit" value="提交">
             </div>
                   </form>
        </div>
    </div>
</div>



    
   
 <!-- /main-container -->

 <? require_once('m_footer.php');?>
 
 


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
		$page_back = '<li class="page-item"><a class="page-link" href="/index/home/order/id/'.$_GET['id'].'-'.($page_current - 1).'.html"  title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a href="/index/home/order/id/'.$_GET['id'].'-'.($i).'.html" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="/index/home/order/id/'.$_GET['id'].'-'.($page_sum).'.html" class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="/index/home/order/id/'.$_GET['id'].'-'.($page_current + 1).'.html" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


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
</body>
</html>
