<?php
require_once('../system/inc.php');
require_once('../system/safe.php');
$resultt = mysql_query('select * from '.flag.'zhuzhan  where  ID = '.$zhu_id.' ');
$roww = mysql_fetch_array($resultt);
$b_name = $roww['loginname'];
$b_password = $roww['loginpassword'];
 if (  $_GET['key'] !=''   )
					 {	$sql = 'select * from '.flag.'user  where   name like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.' or  ID like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'   or  qq like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.'   order by ID desc , ID desc';
					 $result = mysql_query($sql);}else{	exit('没用户id加款个屁');}
		while($row= mysql_fetch_array($result)){
		$point=$row['point'];
		$hyname = $row['name'];
 	$xf_qje = $row['point'];
		}
if($_GET['user']==$b_name && $_GET['pwd']==$b_password){
	$xy=$point+$_GET['point'];
   $_data1['hyid'] = $_GET['key'];
	$_data1['hyname'] = $hyname;
 	$_data1['xf_qje'] = $point;
 	$_data1['xf_je'] = $_GET['point'];
 	$_data1['xf_hje'] = $xy;
 	$_data1['xf_date'] = $sj;
 	$_data1['xf_qk'] = '机器人加款';
 	$_data1['zid'] = $zhu_id;
    $_data1['xf_lx'] = 1;  
  	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
if(!mysql_query($sql1)){echo mysql_error();}
 $_data['point'] = $xy; 
 	$str = arrtoinsert($_data);
#$sql='UPDATE `yika_user` SET `point` = "'.$xy.'" WHERE `yika_user`.`ID` = "'.$_GET['key'].'";';
$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$_GET['key'].'';
	if(mysql_query($sql)){echo "加款成功，剩余余额{$xy}";}else{
echo '加款失败联系管理员解决';
#echo mysql_error();
}
}else{exit('主站账号或者密码错误');}