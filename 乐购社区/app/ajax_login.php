<?php 

include('../system/inc.php');
include('./admin_config.php');
 
$act = $_POST['act'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['pass'];
$sj = date("Y-m-d H:i:s",intval(time()));   
$ip =xiaoyewl_ip();
$dq_url = $_POST['domain'];
//根据域名查询主站
$result = mysql_query('select * from ' . flag . 'zhuzhan_domain  where  name = "' . $dq_url . '" ');
if ($row = mysql_fetch_array($result)) {
        $code=0;
        $_SESSION['url']=$dq_url;
		$msg="http://$dq_url/app/home.php";
} else {
       $result = mysql_query('select * from ' . flag . 'fenzhan_domain  where  name = "' . $dq_url . '" ');
    if ($row = mysql_fetch_array($result)) {
        $code=0;
        $_SESSION['url']=$dq_url;
		$msg="http://$dq_url/app/home.php";
    } else {
        $code=1;
		$msg="社区不存在";
    }
}
	$result=array("status"=>$code,"message"=>"$msg","goods"=>$goods);
die(json_encode($result));
?>