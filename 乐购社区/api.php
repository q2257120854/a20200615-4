<?php
require_once("system/inc.php"); 
$sql = 'select * from '.flag.'shop where ID = '.$_POST['sid'].' ';
if ($result = mysql_query($sql)) {
	$row = mysql_fetch_array($result);
	$key1 = $row['duijiekey1'];
	$key2 = $row['duijiekey2'];
	$key3 = $row['duijiekey3'];
	$key4 = $row['duijiekey4'];
	  }else{
$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?";
		  die(mysql_error());
	  }
if($key1!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['sid']."&api_user=".$_POST['user']."&api_pwd=".$_POST['pwd']."&num=".$_POST['num']."&".$key1."=".$_POST[$key1];}else
if($key2!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['sid']."&api_user=".$_POST['user']."&api_pwd=".$_POST['pwd']."&num=".$_POST['num']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2];}
if($key3!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['sid']."&api_user=".$_POST['user']."&api_pwd=".$_POST['pwd']."&num=".$_POST['num']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2]."&".$key3."=".$_POST[$key3];}
if($key4!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['sid']."&api_user=".$_POST['user']."&api_pwd=".$_POST['pwd']."&num=".$_POST['num']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2]."&".$key3."=".$_POST[$key3]."&".$key4."=".$_POST[$key4];}
print_r(file_get_contents($url));