<?php
include('../system/inc.php');
if($_GET['act']=='copys' and $_GET['copy_key']!=''){
  
  	$sql = 'SELECT * FROM `'.flag.'shop_channel` WHERE `zid` LIKE '.$zhu_id.'';
	$result1 = mysql_query($sql);
  	$mysqli_result = mysql_fetch_array($result1);
  	$rows1 = [];
  	while( $row = mysql_fetch_row($result1)){
	$rows1[] = $row;
	}
  
  	$sql2 = 'SELECT * FROM `'.flag.'shop` WHERE `zid` LIKE '.$zhu_id.'';
	$result2 = mysql_query($sql2);
  	$mysqli_result = mysql_fetch_array($result2);
  	$rows2 = [];
  	while( $row2 = mysql_fetch_row($result2)){
	$rows2[] = $row2;
	}
 // var_dump($rows2,'</br>');die;
  
	exit(json_encode(['code'=>1,'data'=>$rows1,'datas'=>$rows2]));


}


?>