<?php
 $result = mysql_query('select * from '.flag.'admin  where  a_name = "'.$_SESSION['admin_check2'].'"  ');
$row = mysql_fetch_array($result);
{
$a_name = $row['a_name'];
 $a_password = $row['a_password'];
 $a_ID = $row['ID'];
$admin_name = $row['a_name'];
$admin_password = $row['a_password'];
 $admin_ID = $row['ID'];
 $qx=$row['qx'];
$admin_num = (int)($row['a_num']);
$fx_num = (int)($row['b_num']);
   }    
?>

 
 