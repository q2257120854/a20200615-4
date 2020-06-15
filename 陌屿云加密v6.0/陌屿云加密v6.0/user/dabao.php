<?php
//获取文件列表
function list_dir($dir){
   $result = array();
   if (is_dir($dir)){
   $file_dir = scandir($dir);
   foreach($file_dir as $file){
    if ($file == '.' || $file == '..'){
    continue;
    }
    elseif (is_dir($dir.$file)){
    $result = array_merge($result, list_dir($dir.$file.'/'));
    }
    else{
    array_push($result, $dir.$file);
    }
   }
   }
   return $result;
  }
 
//获取列表 
$datalist=list_dir('./instali/moyujm/');
$filename = "./instali/yasuo/bpk.zip"; //最终生成的文件名（含路径）  
if(!file_exists($filename)){  
//重新生成文件  
  $zip = new ZipArchive();//使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释  
  if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {  
    exit('无法打开文件，或者文件创建失败');
  }  
  foreach( $datalist as $val){  
    if(file_exists($val)){  
      $zip->addFile( $val, basename($val));//第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下  
    }  
  }  
  $zip->close();//关闭  
}  
if(!file_exists($filename)){  
  exit("无法找到文件"); //即使创建，仍有可能失败。。。。  
}  
header("Cache-Control: public"); 
header("Content-Description: File Transfer"); 
header('Content-disposition: attachment; filename='.basename($filename)); //文件名  
header("Content-Type: application/zip"); //zip格式的  
header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件  
header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小  
@readfile($filename);
?>