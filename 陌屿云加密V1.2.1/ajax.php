<?php
$mod='blank';
include("./includes/common.php");
@header("content-Type:text/json;charset=utf-8");

if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = $_POST['act'];}
ob_clean();//清除BOOM

switch($act){
	case 'check_dl':
	$qq=daddslashes($_GET['qq']?$_GET['qq']:$_POST['qq']);
	$row=$DB->get_row("SELECT * FROM `auth_daili` WHERE qq='$qq' limit 1");
	if($row['qq'] != ''){
		$status = array('code' => 0 , 'msg' => '');
	}else{
		$status = array('code' => 1 , 'msg' => '');		
	}
	exit(json_encode($status));	
break;
	case 'check_url':
	$url=daddslashes($_GET['url']?$_GET['url']:$_POST['url']);
	if(checkauth2($url)) {
		$status = array('code' => 0 , 'msg' => '');
	}else{
		$status = array('code' => 1 , 'msg' => '');	
	}
	exit(json_encode($status));	
break;
}

?>