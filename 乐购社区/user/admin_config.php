<?php
 if($fen_zz==$member_id){
		 $m_level=6;
		 $member_level='站长';
		 $_SESSION['user_check'] = $member_name;
	 }

 
 function admin_login($t0, $t1, $t2, $t3, $t4,$ip,$sj) {
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
		 session_start();
        $_SESSION['member_name'] = $t1;
 
	$_SESSION['user_check'] = $t1;
		alert_url('admin_index.php');
	}
	
	
	
	
	
}
  
  
   
 function admin_logout($t1) {
  	$_SESSION['user_check'] = '';
		alert_url('index.php');
	}
	
	
 	
 
  

  
   function admin_check($t0) {
	if ($t0 == '' ) {
		alert_href('非法操作!','index.php');
	}
	 
	
	
	
}
  
   
 
 
 
 
 
 
 



  
 ?>

 