<? $nav='pay';?>

<? 
if (strpos($site_qx,'批量下单') !==false) {
      include('plpost.php');
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
  
$pay_price = $s_price*$_POST['num']; //实际购买价格 

if ($member_point < $pay_price)
{ 		alert_href('下单失败:您的余额'.$member_point.'元不足以支付'.$pay_price.'元!',''); }		 
	else
	
{ 		
    $xfhje = $member_point-$pay_price;
    $_data['point'] = $xfhje; 
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$member_id.'';
	if(mysql_query($sql)){
    //消费记录
	
	$_data1['hyid'] = $member_id;
	$_data1['hyname'] = $member_name;
 	$_data1['xf_qje'] = $member_point;
 	$_data1['xf_je'] = $pay_price;
 	$_data1['xf_hje'] = $xfhje;
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_qk'] ='购买商品:'.$s_name.'';  
  	$_data1['xf_lx'] =0; //0扣除 -增加  
  	$_data1['zid'] =$zhu_id; //  
if ($zhu=='true')
{   $_data1['fid'] =0;  }
else
{   $_data1['fid'] =$fen_id;  }
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);
 
$danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

	if ($pingtai == 1)
	{require_once('duijie/zhu.php');}
	if ( $pingtai == 2)
	{require_once('duijie/yile.php');}
	if ( $pingtai == 3)
	{require_once('duijie/95.php');}
if ( $pingtai == 4)
	{require_once('duijie/yile3.php');}
if ($pingtai == 5) {
                require_once 'duijie/jumeng.php';
            }
	
	
    //订单记录
	$_data2['dingdanhao'] = $danhao;
	$_data2['sid'] = $_GET['id'];
 	$_data2['sname'] = $s_name;
 	$_data2['hyid'] = $member_id;
 	$_data2['hyname'] = $member_name;
	
if ($keyname1!=''){	$_data2['keyname1'] = $keyname1; }
if ($keyname2!=''){	$_data2['keyname2'] =$keyname2; }
if ($keyname3!=''){	$_data2['keyname3'] = $$keyname3; }
if ($keyname4!=''){	$_data2['keyname4'] = $keyname4; }


 	$_data2['key1'] = $_POST[$key1];
 	$_data2['key2'] = $_POST[$key2];
 	$_data2['key3'] = $_POST[$key3];
 	$_data2['key4'] = $_POST[$key4];


  
	
 	$_data2['csnum'] =  0;
 	$_data2['num'] =  $_POST['num'];
 	$_data2['dqnum'] = 0;
	
 	$_data2['price'] =  $pay_price;
 	$_data2['zt'] = $s_zt;
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
					//供货增加收入开始
			if($gh!=0){
$sqlgh = 'select * from '.flag.'user  where   name like "%'.$gh.'%"   and zid = '.$zhu_id.' or  ID like "%'.$gh.'%"   and zid = '.$zhu_id.'   or  qq like "%'.$gh.'%"  and zid = '.$zhu_id.'   order by ID desc , ID desc';
$resultgh = mysql_query($sqlgh);
while ($row = mysql_fetch_array($resultgh)) {
    $point = $row['point'];
    $hyname = $row['name'];
    $xf_qje = $row['point'];
}
$xy = $point + $shop_price;
$_data1['hyid'] = $gh;
$_data1['hyname'] = $hyname;
$_data1['xf_qje'] = $point;
$_data1['xf_je'] = $shop_price;
$_data1['xf_hje'] = $xy;
$_data1['xf_date'] = $sj;
$_data1['xf_qk'] = '供货商品提成';
$_data1['zid'] = $zhu_id;
$_data1['xf_lx'] = 1;
$str1 = arrtoinsert($_data1);
$sql1g = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
mysql_query($sql1g);
$_data['point'] = $xy; 
$str = arrtoinsert($_data);
$sqlg = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$gh.'';
mysql_query($sqlg);
			}
			//供货增收入结束
if ($fen == 'true') {
    //分站增加收入
    $chajia = $jprice * $_POST['num'];
    $_fenzhanshouru['point'] = $site_point + $chajia;
    $fenzhanshourusql = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $fen_id . '';
    mysql_query($fenzhanshourusql);
    //分站资金积累
    $_fenzhanzjjl['zid'] = $zhu_id;
    $_fenzhanzjjl['fid'] = $fen_id;
    $_fenzhanzjjl['qje'] = $site_point;
    $_fenzhanzjjl['je'] = $chajia;
    $_fenzhanzjjl['hje'] = $site_point + $chajia;
    $_fenzhanzjjl['date'] = $sj;
    $_fenzhanzjjl['lx'] = 1;
    $_fenzhanzjjl['desc'] = '售出商品:' . $s_name;
    $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
    $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
    mysql_query($fenzhanzjjlsql);
    #上级提成
        if ($up_banben == 1) {
            $chajiaa = $chajia2*$_POST['num'];
            $_fenzhanshouru['point'] = $up_point + $chajiaa;
            $xy3 = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $up_id . '';
            if(!mysql_query($xy3))die('错误: ' . mysql_error());
            #die($xy3);
            //分站资金积累
            $_fenzhanzjjl['zid'] = $zhu_id;
            $_fenzhanzjjl['fid'] = $up_id;
            $_fenzhanzjjl['qje'] = $up_point;
            $_fenzhanzjjl['je'] = $chajiaa;
            $_fenzhanzjjl['hje'] = $up_point + $chajiaa;
            $_fenzhanzjjl['date'] = $sj;
            $_fenzhanzjjl['lx'] = 1;
            $_fenzhanzjjl['desc'] = '下级提成:' . $s_name;
            $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
            $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
            if(!mysql_query($fenzhanzjjlsql))die('错误: ' . mysql_error());
            # die($fenzhanzjjlsql);
        }
#上级结束
}
	
 
 
	
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
    <link rel="shortcut icon" href="https://07imgmini.eastday.com/mobile/20181121/20181121_f614e1628f81693ee40913b38463033b_wmk.jpeg"/>
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css">
        <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
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

                        <div class="list-group-item">账号：<?=$member_name?>[编号:<?=$member_id?>]</div>
                        <div class="list-group-item">等级：<?=$member_level?><?php if($mj_name){echo $mj_name;} ?>
                        <? if ($site_isktdl==1){?>
                          <span class="btn btn-xs btn-success" data-toggle="modal"
                                          data-target="#modal-power">升级</span>
<? }?>
                        </div>
                        <div class="list-group-item">
                            余额：<span id=""><?=get_xiaoshu($member_point,6)?></span> 元
                            <span class="pull-right">
                                 <a class="btn btn-xs btn-info" href="/index/home/pay/id/<?=$_GET['id']?>.html">充值</a>  </span>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            价格：<span id=""><?=$s_price?></span> 元 / <?=$s_unit?>             </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-blue">
                             单个下单
                        -  <a class="btn-xs btn-danger" onclick="layer.open({
  type: 2,
  area: ['360px', '500px'],
  skin: 'layui-layer-rim', //加上边框
  maxmin: true, //开启最大化最小化按钮
  content: ['http://tool.myqq520.com/', 'yes']
});">ID获取</a></div>
                        <div class="panel-body">
                    <form class="form-horizontal" id="orderForm" method="post">
                    <? if ($key1!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
        <input class="form-control app_input"  type="input-group-text"  name="<?=$key1?>"      placeholder="输入你的<?=$keyname1?>"  >
     </div>
      <? }?> 
      
       <? if ($key2!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="input-group-text"  name="<?=$key2?>"      placeholder="输入你的<?=$keyname2?>"  >
     </div>
      <? }?> 
      
      
       <? if ($key3!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="input-group-text"  name="<?=$key3?>"      placeholder="输入你的<?=$keyname3?>"  >
     </div>
      <? }?> 
      
       <? if ($key4!='') {?>
          <div class="form-group" style="margin-left: 0;margin-right: 0;">
 <input class="form-control app_input"  type="input-group-text"  name="<?=$key4?>"      placeholder="输入你的<?=$keyname4?>"  >
     </div>
      <? }?> 
              

 
</script>
                        <div class="form-group" style="margin-left: 0;margin-right: 0;">
					                                <div class="input-group"> <span class="input-group-prepend">
					                                              <span class="input-group-text">下单数量</span>
					                                    </span> <span class="input-group-prepend">
					                                        <span class="input-group-text" onclick="jian()">-</span>
					                                    </span>
					                                    <input name="num" id="num" type="number" class="form-control" onchange="$('#orderRmb').val(('<?=$s_price?>'*this.value).toFixed(6));" placeholder="输入购买数量(<?=$s_dnum?>-<?=$s_gnum?>)" value="<?=$s_dnum?>"> <span class="input-group-append">
					                                        <span class="input-group-text" onclick="jia()">+</span>
					                                    </span>
					                                </div>
					                            </div>
												<script>
function jian() {
    var i = parseInt(document.getElementById("num").valueOf().value) - 1;
    if (i <= 0) {
        i = 0;
    }
    document.getElementById("num").valueOf().value = i;
    price1 = <?=$s_price?> * i;
    document.getElementById("orderRmb").value=price1;
}
function jia() {
    var i = parseInt(document.getElementById("num").valueOf().value) + 1;
    document.getElementById("num").valueOf().value = i;
    price1 = <?=$s_price?> * i;
    document.getElementById("orderRmb").value=price1;
}
												</script>
  <div class="form-group">
                                <div class="col-xs-12">
                                        <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">需要</span>
                                    </span>
                                    <input class="form-control" value="0" id="orderRmb" disabled>
   <span class="input-group-append">
                                        <span class="input-group-text">元</span>
                                    </span>
                                  </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                            <input name="提交"  type="submit"  class="btn btn-block btn-info" id="提交" value="确认下单">
                          </div>
                        </div>
                    
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
							<input type="text" name="act" value="plpay" class="hidden" disabled>
							<input name="提交"  type="submit"  class="btn btn-block btn-info" id="提交" value="批量下单" <? if (strpos($site_qx,'批量下单') ==false) { echo "disabled"; }?> >
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
                      <form id="subform" name="subform"    action="/member/index.php" class="form-inline" role="form">
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
                            <script type="text/javascript" src="/js/adddate.js" ></script> 

                            <div class="form-group">
                                 <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
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
 if ($_GET['zt']==''  and    $_GET['date1']=='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'   and zid = '.$zhu_id.' order by ID desc , ID desc';}
//只看状态
elseif ($_GET['zt']!=''  and    $_GET['date1']=='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and zt = '.$_GET['zt'].' and zid = '.$zhu_id.'   order by ID desc , ID desc';}
//只看时间
elseif ($_GET['zt']==''  and    $_GET['date1']!='' and  $_GET['date2']!=''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and date >= "'.$_GET['date1'].'" and  date <= "'.$_GET['date2'].'"  and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //只看单个时间
elseif ($_GET['zt']==''  and    $_GET['date1']!='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and date <= "'.$_GET['date1'].'"   and zid = '.$zhu_id.'  order by ID desc , ID desc';}

 //看全部条件
elseif ($_GET['zt']!=''  and    $_GET['date1']!='' and  $_GET['date2']!=''      )	 
{	  $sql = 'select * from  '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'   and zt = '.$_GET['zt'].'   and date >= "'.$_GET['date1'].'"   and date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.' order by ID desc , ID desc';}

 
}
else

	{					  
//无任何条件搜索 
 if ($_GET['zt']==''  and    $_GET['date1']=='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'   and zid = '.$zhu_id.' and fid = '.$fen_id.'  order by ID desc , ID desc';}
//只看状态
elseif ($_GET['zt']!=''  and    $_GET['date1']=='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and zt = '.$_GET['zt'].' and zid = '.$zhu_id.'   and fid = '.$fen_id.'  order by ID desc , ID desc';}
//只看时间
elseif ($_GET['zt']==''  and    $_GET['date1']!='' and  $_GET['date2']!=''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and date >= "'.$_GET['date1'].'" and  date <= "'.$_GET['date2'].'"  and zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc , ID desc';}

 //只看单个时间
elseif ($_GET['zt']==''  and    $_GET['date1']!='' and  $_GET['date2']==''      )	 
{	  $sql = 'select * from '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  and date <= "'.$_GET['date1'].'"   and zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc , ID desc';}

 //看全部条件
elseif ($_GET['zt']!=''  and    $_GET['date1']!='' and  $_GET['date2']!=''      )	 
{	  $sql = 'select * from  '.flag.'order where hyid  ='.$member_id.' and sid ='.$_GET['id'].'   and zt = '.$_GET['zt'].'   and date >= "'.$_GET['date1'].'"   and date <= "'.$_GET['date2'].'"   and zid = '.$zhu_id.' and fid = '.$fen_id.' order by ID desc , ID desc';}

 
}



 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $dingdanhao=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['dingdanhao']);

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
				
			if ($_POST['power']==1)
			{
			$sjname = $site_level1_name;
			$sjprice = $site_level1_price; }
			if ($_POST['power']==2)
			{			
			$sjname = $site_level2_name;
			$sjprice = $site_level2_price; }
			if ($_POST['power']==3)
			{
		    $sjname = $site_level3_name;
			$sjprice = $site_level3_price; }
			if ($_POST['power']==4)
			{
			$sjname = $site_level4_name;
			$sjprice = $site_level4_price; }
			if ($_POST['power']==5)
			{
			$sjname = $site_level5_name;
			$sjprice = $site_level5_price; }
 				
				if ($_POST['power'] <= $m_level )
 					   { alert_href('升级失败:升级等级必须大于自己目前等级!',''); }	
    	 elseif ($_POST['power'] >5 )
 					   { alert_href('升级失败:等级不存在!',''); }	
    	 elseif ($_POST['power'] <1 )
 					   { alert_href('升级失败:等级不存在!',''); }	
     	 elseif ($member_point < $sjprice)
  					   { alert_href('升级失败:余额不足请充值!',''); }	
	 else
	 
	 $xfhje = $member_point-$sjprice;
    $_data['point'] = $xfhje; 
    $_data['level'] = $_POST['power']; 
   //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
 	$sql = 'update '.flag.'user set  '.arrtoupdate($_data).'  where id = '.$member_id.'';
	if(mysql_query($sql)){
  	
	$_data1['hyid'] = $member_id;
	$_data1['hyname'] = $member_name;
 	$_data1['xf_qje'] = $member_point;
 	$_data1['xf_je'] = $sjprice;
 	$_data1['xf_hje'] = $member_point-$sjprice;
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_qk'] ='在线升级:'.$sjname.'';  
  	$_data1['xf_lx'] =0; //0扣除 -增加  
  	$_data1['zid'] =$zhu_id; //  
    $str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);
	 
	 
 					  alert_href('升级成功!',''); }	
				else
 					 { alert_href('升级失败!',''); }	
				
				
				  }
				
				?>
                
          <div class="modal" id="modal-power">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>升级代理</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="powerForm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">选择升级代理</label>
                        <div class="col-lg-8">
                            <select name="power" class="form-control">
                      <option value="1"><?=$site_level1_name?>(<?=$site_level1_price?>元)</option>
                     <option value="2"><?=$site_level2_name?>(<?=$site_level2_price?>元)</option>
                     <option value="3"><?=$site_level3_name?>(<?=$site_level3_price?>元)</option>
                     <option value="4"><?=$site_level4_name?>(<?=$site_level4_price?>元)</option>
                     <option value="5"><?=$site_level5_name?>(<?=$site_level5_price?>元)</option>
                                                            </select>
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
 <? require_once('m_footer.php');?>
						<?php
																$result = mysql_query('select * from '.flag.'shoucang  where  sid ='.$_GET['id'].' and hyid = '.$member_id.' and zid = '.$zhu_id.' ');
																if ($row = mysql_fetch_array($result))
																{
																	?>
																	<script>
																	       $(document).ready(function () {
																		$("#getcollectdel").click(function () {
																			if(confirm("您确定要取消收藏商品《测试》？"))
																			 {
																				var vm = new Vue();
																				  		 vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: <?=$_GET['id']?>})
																				             .then(function (data) {
																					if (data.status === 0) {
																						vm.$message(data.message, 'success');
																						                $.pjax.reload('#pjax-container');
																					} else {
																						vm.$message(data.message, 'error');
																					}
																				}
																				);
																			}
																		}
																		);
																	}
																	);
																	function delcol($gid){
																		var vm = new Vue();
																		vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: $gid})
																		             .then(function (data) {
																			if (data.status === 0) {
																				vm.$message(data.message, 'success');
																				                $.pjax.reload('#pjax-container');
																			} else {
																				vm.$message(data.message, 'error');
																			}
																		}
																		);
																	}
																	</script>
																	<?php
																} else{
																	?>
																	 <script>
																	       $(document).ready(function () {
																		$("#getcollect").click(function () {
																			var vm = new Vue();
																			  		 vm.$post("/ajax.php?act=collect", {action: 'collect', gid: <?=$_GET['id']?>})
																			             .then(function (data) {
																				if (data.status == 0) {
																					vm.$message(data.message, 'success');
																					                $.pjax.reload('#pjax-container');
																				} else {
																					vm.$message(data.message, 'error');
																				}
																			}
																			);
																		}
																		);
																	}
																	);
																	function delcol($gid){
																		var vm = new Vue();
																		vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: $gid})
																		             .then(function (data) {
																			if (data.status === 0) {
																				vm.$message(data.message, 'success');
																				                $.pjax.reload('#pjax-container');
																			} else {
																				vm.$message(data.message, 'error');
																			}
																		}
																		);
																	}
																	</script>
																	<?php
																}
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
		$page_back = '<li class="page-item"><a class="page-link" href="/member/index.php?id='.$_GET['id'].'&page='.($page_current - 1).'" " title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a  href="/member/index.php?id='.$_GET['id'].'&page='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="/member/index.php?id='.$_GET['id'].'&page='.$page_sum.'"    class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="/member/index.php?id='.$_GET['id'].'&page='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
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
