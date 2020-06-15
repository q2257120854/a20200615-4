<?php
include("./common.php");

$authcode=$_GET['authcode'];
$sign=$_GET['sign'];
if(!$authcode){exit();}

require_once(SYSTEM_ROOT.'pclzip.php');
$file_real=substr($authcode,0,16).'.zip';
$file=ROOT.CACHE_DIR."/{$file_real}";

if($_GET['my']=='installer') {
$file_path=ROOT.PACKAGE_DIR.'/release6000/';

//安装包
$file_str=file_get_contents(ROOT.PACKAGE_DIR.'/authcode.php');
$file_str=str_replace('1000000001',$authcode,$file_str);
file_put_contents($file_path.$conf['authfile'],$file_str);

$file_name='installer_'.rand(111111,999999).'.zip';

$DB->query("insert into `auth_down` (`type`,`authcode`,`sign`,`date`) values ('授权平台|安装包','".$authcode."','".$udata['uid']."','".$date."')");
}elseif($_GET['my']=='updater') {
$file_path=ROOT.PACKAGE_DIR.'/update6000/';

//更新包
$file_str=file_get_contents(ROOT.PACKAGE_DIR.'/authcode.php');
$file_str=str_replace('1000000001',$authcode,$file_str);
file_put_contents($file_path.$conf['authfile'],$file_str);

$file_name='updater_'.rand(111111,999999).'.zip';

$DB->query("insert into `auth_down` (`type`,`authcode`,`sign`,`date`) values ('授权平台|更新包','".$authcode."','".$udata['uid']."','".$date."')");
}
if(file_exists($file))unlink($file);
$zip = new PclZip($file);
$v_list = $zip->create($file_path ,PCLZIP_OPT_REMOVE_PATH,$file_path);

$file_size=filesize("$file");
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
readfile("$file");
?>