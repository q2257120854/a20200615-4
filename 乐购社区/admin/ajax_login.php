<?php 

include('../system/inc.php');
include('./admin_config.php');
 
$act = daddslashes($_POST['act']);
$type = daddslashes($_POST['type']);
$username = daddslashes($_POST['user']);
$password = daddslashes($_POST['pass']);
$sj = date("Y-m-d H:i:s",intval(time()));   
$ip =xiaoyewl_ip();
  if ($zhu=='flash')
 { alert_url('/'); }
 function gonghuologin2($t0, $t1, $t2)
{
    $result = mysql_query('select *   from  ' . flag . 'user where name ="' . $t0 . '" and password  ="' . md5($t1) . '"  and zid = ' . $t2 . '   and gh = 1   ');
    if (!!($row = mysql_fetch_array($result))) {
		$_SESSION['gh_check'] = $t0;
        return 0;
    } else {
        return 1;
    }
}
 if($act){
	 if($type==0){
		 unset($_SESSION['gly']);
		     if ($act == 'login' and $username == '') {
        $code=1; $msg='请输入用户名!';
    } elseif ($act == 'login' and $password == '') {
        $code=1; $msg='请输入用户密码!';
    } elseif ($act == 'login' and $username != $a_name) {
        $code=1; $msg='用户名不正确!';
    } elseif ($act == 'login' and $password != $a_password) {
       $code=1; $msg='用户密码不正确';
    } elseif ($act == 'login' and $username == $a_name and $password == $a_password) {
        $_SESSION['admin_check'] = $username;
        $data['hyname'] = $username;
	$data['hyid'] =0;
	$data['ip'] = xiaoyewl_ip();
	$data['date'] = date('y-m-d h:i:s',time());;
	$data['qk'] = '电脑端';
	$data['zid'] = $zhu_id;
	$str = arrtoinsert($data);
	$sql = 'insert into '.flag.'login_log ('.$str[0].') values ('.$str[1].')';
	mysql_query($sql);
        $code=0; $msg='admin_index.php';
    }
		 }elseif($type==1){
 	$result = mysql_query('select *  from '.flag.'guanli  where loginname = "'.$username.'"  and  loginpassword = "'.$password.'"  and zid = '.$zhu_id.'  ');
 	$row = mysql_fetch_array($result);
	if ($row) {
	$_SESSION['admin_id'] = $row['ID'];
	$_SESSION['admin_qq'] = $row['qq'];
	$_SESSION['admin_check'] = $row['loginname'];
	$_SESSION['gly'] = $username;
	$code=0; $msg='admin_index.php';
	}
	}elseif($type==2){
		if(gonghuologin2($username,$password,$zhu_id)==0){$code=0; $msg='/gadmin/Supplier_Index.php';}else{
			$code=1; $msg='登录失败';
		}
	}else{
		$code=1; $msg='用户名字或者密码不正确';
	}
	$result=array("status"=>$code,"message"=>"$msg","goods"=>$goods);
die(json_encode($result));
	}
?>