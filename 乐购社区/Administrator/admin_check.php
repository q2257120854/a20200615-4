<?php
require_once('../system/inc.php');
require_once('../system/safe.php');

if ($_SESSION['admin_check1'] =='')

{ 		alert_href('你想搞事情对不对！','index.php'); }  

   $result = mysql_query('select * from '.flag.'admin  where  ID = 1  ');
$row = mysql_fetch_array($result);
{
$a_name = $row['a_name'];
 $a_password = $row['a_password'];
 
   }     
 	
  
?>

 
 