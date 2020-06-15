<?php
  
$result = mysql_query('select *   from  '.flag.'user where name ="'.$_SESSION['gadmin_check'].'"  and zid = '.$zhu_id.'   ');
 $grow = mysql_fetch_array($result);
 $supid=$grow['ID'];
 $suprmb=$grow['point'];
$supname=$grow['name'];

 
 function admin_login($t0, $t1, $t2, $t3, $t4,$ip,$sj,$zhu_id) {
	if ($t0 == 'login' and $t1=='') {
		alert_href('请输入用户名!','');
	}
	elseif ($t0 == 'login' and $t2=='') {
		alert_href('请输入用户密码!','');
	}
	
	elseif ($t0 == 'login' and $t1!=$t3) {
		alert_href('用户名不正确!','');
	}


	elseif ($t0 == 'login' and $t2!=$t4) {
		alert_href('用户密码不正确!','');
	}
	

	elseif ($t0 == 'login' and $t1==$t3  and $t2==$t4)
	
	 {
 
 
 
 $data['hyname'] = $t1;
	$data['hyid'] =$aid ;
	$data['ip'] = xiaoyewl_ip();
	$data['date'] = date('y-m-d h:i:s',time());;
	$data['qk'] = '电脑端';
	$data['zid'] = $zhu_id;

	$str = arrtoinsert($data);
	$sql = 'insert into '.flag.'login_log ('.$str[0].') values ('.$str[1].')';
	mysql_query($sql);


	

	$_SESSION['gadmin_check'] = $t1;
		alert_url('Supplier_Index.php');
	}
	
	
	
	
}
 
  
  
  
   
 function admin_logout($t1) {
  	$_SESSION['gadmin_check'] = '';
		alert_url('index.php');
	}
	
	
 	
 	

  
   function admin_check($t0) {
	if ($t0 == '' ) {
		alert_href('请重新登录！','/');
	}
	 
	
	
	
}
  
   
 
 
 
 
 
 
 



  
 ?>

 