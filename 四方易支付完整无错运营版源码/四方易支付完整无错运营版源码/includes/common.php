<?php
//error_reporting(E_ALL); ini_set("display_errors", 1);
error_reporting(0);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
date_default_timezone_set('Asia/Shanghai');
$date = date("Y-m-d H:i:s");

session_start();

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

if(is_file(SYSTEM_ROOT.'360safe/360webscan.php')){//360网站卫士
    require_once(SYSTEM_ROOT.'360safe/360webscan.php');
}

include_once(SYSTEM_ROOT."security.php");

require SYSTEM_ROOT.'../zhuolin_config/config.php';

if(!defined('SQLITE') && (!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']))
{
header('Content-type:text/html;charset=utf-8');
echo '你还没安装！<a href="../zhuolin_install/">点此安装</a>';
exit();
}

try {
    $DB = new PDO("mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};port={$dbconfig['port']}",$dbconfig['user'],$dbconfig['pwd']);
}catch(Exception $e){
    exit('链接数据库失败:'.$e->getMessage());
}

if($DB->query("select * from zz_pay_config where 1")==FALSE)
{
header('Content-type:text/html;charset=utf-8');
	echo ("<script language='javascript'>alert('检查到你未安装数据库！点击确定安装');window.location.href='../zhuolin_install';</script>");
exit();
}

$DB->exec("set names utf8");
include_once (SYSTEM_ROOT . "db.class.php");
$DB1 = new DB($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);


$rs=$DB->query("select * from zz_pay_config");
while($row=$rs->fetch()){ 
	$conf[$row['k']]=$row['v'];
}
if($conf['wxpay_api']==1){
    define('WX_API_APPID',  $conf['wx_api_appid']);
    define('WX_API_MCHID',  $conf['wx_api_mchid']);
    define('WX_API_KEY',  $conf['wx_api_key']);
    define('WX_API_APPSECRET',  $conf['wx_api_appsecret']);
}

if($conf['qqpay_api']==1){
    define('QQ_API_MCH_ID',  $conf['qq_api_mchid']);
    define('QQ_API_MCH_KEY',  $conf['qq_api_mchkey']);
}

/*
foreach ($conf as $k => $v){
    //echo $k."---".$v;
      $DB->query("insert into zz_pay_config set `k`='{$k}',`v`='{$v}' on duplicate key update `v`='{$v}'");
}
exit();
*/
if(!$conf['local_domain'])$conf['local_domain']=$_SERVER['HTTP_HOST'];
$password_hash='!@#%!s!0';
require_once(SYSTEM_ROOT."alipay/alipay_core.function.php");
require_once(SYSTEM_ROOT."alipay/alipay_md5.function.php");
include_once(SYSTEM_ROOT."function.php");
include_once(SYSTEM_ROOT."member.php");

if (!file_exists(ROOT . "zhuolin_install/zhuolin") && file_exists(ROOT . "zhuolin_install/index.php")) {sysmsg("<h2>检测到无 zhuolin 文件</h2><ul><font size=\"4\">如果您尚未安装本程序，请<a href=\"/zhuolin_install/\">前往安装</a></font><font size=\"4\">如果您已经安装本程序，请手动放置一个空的 zhuolin 文件到 /zhuolin_install 文件夹下，<b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>为什么必须建立 zhuolin 文件？</h4>它是程序的保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装程序。<br/><br/>", true);}

?>