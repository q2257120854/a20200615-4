<?php
require_once("../system/inc.php");
header("Content-type:text/html;charset=utf-8");//字符编码设置  
$servername = DATA_HOST;  
$username = DATA_USERNAME;  
$password = DATA_PASSWORD;  
$dbname = DATA_NAME;  
$sql = "select * from ".flag."moban where ID = ".$_GET["xid"]." ";
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
 	$name = $row["name"];
 	$keyname1 = $row["keyname1"];
 	$keyname2 = $row["keyname2"];
 	$keyname3 = $row["keyname3"];
 	$keyname4 = $row["keyname4"];
 	$key1 = $row["key1"];
 	$key2 = $row["key2"];
 	$key3 = $row["key3"];
 	$key4 = $row["key4"];
      
	  }  
if($_GET["xid"]=="0"){$key1='value1'; $keyname1="邮箱";}
	  $a=array("k1"=>"{$key1}","k2"=>"{$key2}","k3"=>"{$key3}","k4"=>"{$key4}","k1n"=>"{$keyname1}","k2n"=>"{$keyname2}","k3n"=>"{$keyname3}","k4n"=>"{$keyname4}");

echo json_encode($a);