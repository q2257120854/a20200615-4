<?php
//官方群 414628263
error_reporting(0);
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('SYS_KEY', 'MoYu');

date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
session_start();

if(is_file(SYSTEM_ROOT.'360safe/360webscan.php')){//360网站卫士
    require_once(SYSTEM_ROOT.'360safe/360webscan.php');
}

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

require SYSTEM_ROOT.'config.php';

if(!defined('SQLITE') && (!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']))//检测安装
{
header('Content-type:text/html;charset=utf-8');
echo '你还没安装！<a href="install/">点此安装</a>';
exit();
}

//连接数据库
include_once(SYSTEM_ROOT."db.class.php");
$DB=new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);

if($DB->query("select * from auth_user where 1")==FALSE)//检测安装2
{
header('Content-type:text/html;charset=utf-8');
echo '<div class="row">你还没安装！<a href="install/">点此安装</a></div>';
exit();
}

include(SYSTEM_ROOT."cache.class.php");
$CACHE = new CACHE();
$conf = unserialize($CACHE->pre_fetch());//获取系统配置

if (empty($conf['version'])) {
    $conf = $CACHE->update();
}

$password_hash='!@#%!s!';
include SYSTEM_ROOT."SecretUtilTools.php";
include SYSTEM_ROOT."function.php";
include SYSTEM_ROOT."member.php";

if(!file_exists(ROOT."install/install.lock") && file_exists(ROOT."install/index.php")) {
	sysmsg("<h3>检测到无 install.lock 文件</h3></br><h3>点击重新安装<a href=\"./install/\"> (重新安装) </a><h3>", true);
}

/*目录配置*/
define('CACHE_DIR','includes/cache'); //下载缓存目录
define('PACKAGE_DIR','includes/download'); //程序安装包目录
?>