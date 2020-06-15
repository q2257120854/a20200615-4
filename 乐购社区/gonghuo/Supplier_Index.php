<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
 
if ($_POST['域名'] =='购买')
{
	
	if ($_POST['peie']<=0)

{ 		alert_href('购买失败:购买数量不能低于1!',''); }

 	

		$fxfprice =$_POST['peie']*3;
		$yedu = $ymed;
	
	   	non_numeric_back($_POST['peie'],'请输入购买个数');
		
 		
if ($site_point < $fxfprice)

{ 		alert_href('购买失败:您的余额不足支付'.$fxfprice.'元请充值!',''); }

else
{
	
$_data['ymed'] =$ymed+$_POST['peie']  ;
 	$_data['point'] = $site_point-$fxfprice;

   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['qje'] = $site_point;
	$_data1['je'] = $fxfprice;
 	$_data1['hje'] = $site_point-$fxfprice;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'域名额度'.$_POST['peie'].'个';
 	$_data1['lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'zhuzhanpricejl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);


		//额度记录
	$_data3['zid'] = $zhu_id;
 	{$_data3['qsl'] = $yedu;}		
	$_data3['sl'] = $_POST['peie'];
 	$_data3['hsl'] = $yedu+$_POST['peie'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'域名额度'.$_POST['peie'].'个';
 	$_data3['lx'] = 1; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	
	//扣除余额
 	$_data2['point'] = $site_point-$fxfprice;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data2).' where id = '.$zhu_id.'';
     mysql_query($sql2);

 
		alert_href('购买成功!','');
	}else{
		alert_back('购买失败!');
	}
		}
}
 
 if ($_POST['域名'] =='绑定')
{
null_back($_POST['url1'],'请输入主站前缀');
	null_back($_POST['url2'],'请输入主站尾缀');
     //完整域名
	$zhu_url = $_POST['url1'].".".$_POST['url2'];
	if($_POST['url2']=='yj')$zhu_url = $_POST['url1'];
	if($ymed<=0){ 		alert_href('购买失败:无域名额度!',''); }
	//扣除额度
 	$_data2['ymed'] = $ymed-1;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data2).' where id = '.$zhu_id.'';
     mysql_query($sql2);
	if ($zhu_url ==sysurl)
		alert_back('创建失败:'.$zhu_url.'域名 已经被绑定过了!!');
	
				$resultcx = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$zhu_url.'"  ');
					if ($rowcx = mysql_fetch_array($resultcx)){
		alert_back('创建失败:'.$zhu_url.'域名 已经被绑定过了!!');
					} 
		 
 		 
    $_data['zid'] = $zhu_id;
    $_data['name'] = $zhu_url;
 
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'zhuzhan_domain ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
 
    		alert_href('绑定成功!','');
	} else {
		alert_back('绑定失败!');
	}
		}
 
if ($_POST['修改信息'] =='保存')
{
if($zhu_id=='11'){
alert_back('修改失败!测试站改你麻痹密码');
die;
}
 	$_data['qq'] = $_POST['qq'];
	if ($_POST['pwd']!= '')
	{$_data['loginpassword'] = $_POST['pwd'];}
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
	
}
 
if ($_POST['提交'] =='续费')
{
	
	
	
		if ($_POST['year']<=0)

{ 		alert_href('续费失败:续费时间不能低于1!',''); }

 
 
 
	$xfprice =$_POST['year']*$site_price;
	   	non_numeric_back($_POST['year'],'请输入续费时间');
if ($site_point < $site_price)

{ 		alert_href('续费失败:您的余额不足支付'.$xfprice.'元请充值!',''); }

else
{
	
	$a_time = strtotime($site_ddate);
	$b_time = strtotime('+'.$_POST['year'].' year',$a_time);
	$b = date('Y-m-d H:i:s',$b_time);
	
 	$_data['ddate'] =$b  ;
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['qje'] = $site_point;
	$_data1['je'] = $xfprice;
 	$_data1['hje'] = $site_point-$xfprice;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '站点续费';
 	$_data1['lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'zhuzhanpricejl  ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	
	//扣除余额
 	$_data2['point'] = $site_point-$xfprice;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data2).' where id = '.$zhu_id.'';
     mysql_query($sql2);

 
		alert_href('续费成功!','');
	}else{
		alert_back('修改失败!');
	}
		}
}


 

if ($_POST['分站'] =='购买')
{
	
	if ($_POST['peie']<=0)

{ 		alert_href('购买失败:购买数量不能低于1!',''); }

 	
	if ($_POST['fid']==1)
	{
		$fxfprice =$_POST['peie']*$site_zfprice1;
		$yedu = $site_fed1;
		}
	elseif ($_POST['fid']==2)
	{$fxfprice =$_POST['peie']*$site_zfprice2;
			$yedu = $site_fed2;
}
	elseif ($_POST['fid']==3)
	{$fxfprice =$_POST['peie']*$site_zfprice3;
			$yedu = $site_fed3;
}	
	
	   	non_numeric_back($_POST['peie'],'请输入购买个数');
		
 		
if ($site_point < $fxfprice)

{ 		alert_href('购买失败:您的余额不足支付'.$fxfprice.'元请充值!',''); }

else
{
	
 if ($_POST['fid']==1)	
 {	$_data['fed1'] =$site_fed1+$_POST['peie']  ;}
 elseif ($_POST['fid']==2)	
 {	$_data['fed2'] =$site_fed2+$_POST['peie']  ;}
 elseif ($_POST['fid']==3)	
 {	$_data['fed3'] =$site_fed3+$_POST['peie']  ;} 
 	$_data['point'] = $site_point-$fxfprice;

   	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['qje'] = $site_point;
	$_data1['je'] = $fxfprice;
 	$_data1['hje'] = $site_point-$fxfprice;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data1['lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'zhuzhanpricejl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);


		//额度记录
	$_data3['zid'] = $zhu_id;
 	{$_data3['qsl'] = $yedu;}		
	$_data3['sl'] = $_POST['peie'];
 	$_data3['hsl'] = $yedu+$_POST['peie'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data3['lx'] = 1; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	
	//扣除余额
 	$_data2['point'] = $site_point-$fxfprice;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data2).' where id = '.$zhu_id.'';
     mysql_query($sql2);

 
		alert_href('购买成功!','');
	}else{
		alert_back('购买失败!');
	}
		}
}


$nav='home'; 

function get_czje($t0)
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where zt = 1 and zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdczje($t0)
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where day(pdate) = day(now()) and zt =1   and zid='.$t0.'');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}


function get_ordersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from  '.flag.'order where zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_tdayordersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'order  where day(date) = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_membersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdaymembersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where day(date)  = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_fenzhansl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan  where zid ='.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdayfenzhan($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan  where day(date)  = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_orderje($t0)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where zid = '.$t0.'   ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdayorderje($t0)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where day(date)  =day(now())  and zid = '.$t0.'');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}


 
 ?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <title><?=$site_name?>-供货商系统3.0</title>
     <link rel="shortcut icon" href="<?=$site_ico?>"/>
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


<?
 include('header.php');
?>
 
                    
                    
                                        
 
                              网站后台公告
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                            <?=$site_notice?>
                            </div>
                        </div>
                    </div>
                </div>
 <div class="modal" id="modal-xf">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            
                    
        </div>
    </div><!-- /main-container -->

</div><!-- /wrapper -->

<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>

<div class="modal fade primary" id="modal-profile">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
     ="充值" />
          </div></form>
         </div>
        </div>
       </div> 
 </body>
</html>
