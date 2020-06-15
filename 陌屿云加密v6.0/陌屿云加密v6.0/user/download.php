<?php
/*
Auat：陌屿
QQ：2763994904
Name：陌屿云加密系统
*/
if($_GET['my']=='jm') {
$file = './instali/yasuo/bpk.zip'; // 要下载的文件
ob_clean();
header('Pragma: public');
header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control:no-store, no-cache, must-revalidate');
header('Cache-Control:pre-check=0, post-check=0, max-age=0');
header('Content-Transfer-Encoding:binary');
header('Content-Encoding:none');
header('Content-type:multipart/form-data');
header('Content-Disposition:attachment; filename="'.basename($file).'"'); //设置下载的默认文件名
header('Content-length:'. filesize($file));
$fp = fopen($file, 'r'); //读取数据，开始下载
while(connection_status() == 0 && $buf = @fread($fp, 8192)){
echo $buf;
}
fclose($fp);
@flush();
@ob_flush();
exit();
}?>