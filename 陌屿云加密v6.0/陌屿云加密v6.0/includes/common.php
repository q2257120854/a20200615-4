<?php
@header("Content-type:text/html;charset=utf-8");
error_reporting(0);
define('IN_CRONLITE', true);
define('TYPE', '2');
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('CC_Defender', 0); //防CC攻击开关(1为session模式)
date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
session_start();
include_once SYSTEM_ROOT.'security.php';
require ROOT.'config.php';
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname'])//检测安装
{
header('Content-type:text/html;charset=utf-8');
echo '<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>站点提示信息</title>
        <style type="text/css">
html{background:#eee}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px "微软雅黑","Microsoft YaHei",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}
        </style>
    </head>
    <body id="error-page">
     <div class="panel-heading">
        <h3 class="panel-title">站点提示信息</h3>
        </div>
        <div class="panel-body">
      本站尚未安装！<a href="install/">点此安装</a> 
    </body>
    </html>';
exit();
}
setcookie("user",1);
//连接数据库
include_once(SYSTEM_ROOT."db.class.php");
$DB=new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);

if($DB->query("select * from moyu_config where 1")==FALSE)//检测安装2
{
header('Content-type:text/html;charset=utf-8');
exit("<script language='javascript'>alert('你还没安装！');window.location.href='./install/';</script>");
}
$rs=$DB->query("select * from moyu_config");
while($row=$DB->fetch($rs)){ 
	$conf[$row['k']]=$row['v'];
}
$password_hash='!@#%!s!0';
include_once(SYSTEM_ROOT."function.php");
if (!file_exists(ROOT."install/install.lock") && file_exists(ROOT."install/index.php")) {
	sysmsg("<h2>没有install.lock文件哦 你要重新安装<br/><br/>", true);
}
if($conf['txprotect'] == 1){
    include_once(SYSTEM_ROOT."txprotect.php");
}
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false && $conf['qqtz']==1){
    header("Content-Type: text/html; charset=utf-8");
    echo '<!DOCTYPE html>
    <html>
 <head>
  <title>请使用浏览器打开</title>
  <script src="https://open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
  <script type="text/javascript"> mqq.ui.openUrl({ target: 2,url: "'.$siteurl.'"}); </script>
 </head>
 <body>
 <body background="" lang="EN-US" link="white" vlink="white" style="tab-interval:.5in" alink="#cc0000" bgcolor="black" text="white">
<div style="text-align:center">
<style type="text/css">body,html {margin: 0;padding: 0;outline: 0;}.cont {text-decoration:none;color:rgb(F, F, F);font-family: Tahoma, Arial, sans-serif  ;font-size: 16px;text-shadow: 0px 0px 3px ;}</style>
<pre>
<div class="cont"><big> <div style="text-align:center"> <font style="FONT-FAMILY: Comic Sans MS; FONT-SIZE: 19px"><strong> 
<center><img src="../assets/img/hy.jpg">
<h4>陌屿唯一QQ 2763994904
<h4>战马关公身上纹，手铐送给大佬们
<h4>如果域名不跳转请手动将域名复制到浏览器打开
 </body>
</html>';
    exit;
}
include_once(SYSTEM_ROOT."member.php");
if(isset($_GET['hj'])){
if($_GET['hj']=='hj'){exit(hj());}
}
?>