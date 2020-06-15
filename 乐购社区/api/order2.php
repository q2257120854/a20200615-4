<?php

//用fopen函数打开order.php文件

$file=fopen("order.php","r") or die ("unable to open file");

//读取order.php文件内容

$con=fread($file,filesize("order.php"));

//重点，调用ltrim将order.php开头的BOM头去掉。

$con=ltrim($con,"\XEF\XBB\XBF");
unlink('order.php');
//创建order.php文件

$newfile=fopen("order.php","w") or die ("unable to create file");

//通过fwrite命令将去掉BOM头的order.php文件的内容写入到order.php

fwrite($newfile,$con);

//关闭文件

fclose($newfile);

fclose($file);

?>