<?php
if(!defined('IN_CRONLITE'))exit();

$my=isset($_GET['my'])?$_GET['my']:null;

$clientip=real_ip();

if(isset($_COOKIE["auth_token"]))
{
	$token=authcode(daddslashes($_COOKIE['auth_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$udata = $DB->get_row("SELECT * FROM auth_user WHERE user='$user' limit 1");
	$session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid) {
		$DB->query("UPDATE auth_user WHERE user = '$user'");
		$admin_user=$udata['user'];
		$islogin=1;
	}
}
if(isset($_COOKIE["auth_token2"]))
{
	$token=authcode(daddslashes($_COOKIE['auth_token2']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$udata = $DB->get_row("SELECT * FROM auth_daili WHERE user='$user' limit 1");
	$session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid) {
		$DB->query("UPDATE auth_daili SET last='$date',dlip='$clientip' WHERE user = '$user'");
		$islogins=1;
		$daili_id=$udata['uid'];
		$daili_name=$udata['user'];
		if($udata['active']==0){
        @header('Content-Type: text/html; charset=UTF-8');
        sysmsg("<h3>您的平台账号违规使用被禁封</p>有问题联系站长QQ：2763994904</h3>");
		}
	}
}
?>