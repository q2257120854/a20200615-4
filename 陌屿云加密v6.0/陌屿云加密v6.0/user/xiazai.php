<?php
/*
Auat：陌屿
QQ：2763994904
Name：陌屿云加密系统
*/
if($_GET['my']=='xz') {
Header( "Content-type:   application/octet-stream "); 
Header( "Accept-Ranges:   bytes "); 
header( "Content-Disposition:   attachment;   filename=加密后.php "); 
header( "Expires:   0 "); 
header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 "); 
header( "Pragma:   public "); 
$filename = fopen("./instali/xiazai/jiami.txt", "r") or die("加密失败，请重试！");
echo fread($filename,filesize("./instali/xiazai/jiami.txt"));
fclose($filename);
exit();
}?>