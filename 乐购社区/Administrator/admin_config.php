<?php
 if ($dq_url != sysurl )
{   header("Location: 404");  }
    $result = mysql_query('select * from '.flag.'admin  where  ID = 1  ');
$row = mysql_fetch_array($result);
{
$admin_name = $row['a_name'];
$admin_password = $row['a_password'];
 

   }    
   
 
 	
  
?>

 
 