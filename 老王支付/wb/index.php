<?
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
//获取需要上传的文件目录
$temdir = $_GET["upfile"];
$key = $_GET["keyurl"];
$uploaddir = $key.'/'.$temdir;//设置文件保存目录 注意包含/

$imgsrc ="/wb/".$key."/".$temdir;

$dir = $key."/";
$type=array("txt");//设置允许上传文件的类型
$patch="/";//程序所在路径


if(!is_dir($dir))//判断目录是否存在
{
  mkdir ($dir,0777,true);//如果目录不存在则创建目录
	
};

//获取文件后缀名函数   
  function fileext($filename)   
{   
   return substr(strrchr($filename, '.'), 1);   
}   
//生成随机文件名函数       
function random($length)   
{   
  $hash = 'HS-';   
 $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';   
 $max = strlen($chars) - 1;   
 mt_srand((double)microtime() * 1000000);   
       for($i = 0; $i < $length; $i++)   
     {   
          $hash .= $chars[mt_rand(0, $max)];   
     }   
  return $hash;   
}   


$a=strtolower(fileext($_FILES['file']['name']));   
//判断文件类型   
if(!in_array(strtolower(fileext($_FILES['file']['name'])),$type))   
 {   
 $text=implode(",",$type);   
  
    exit("ERROR");
 }   
//生成目标文件的文件名       
else{   
$filename=explode(".",$_FILES['file']['name']);   

 do   
 {   
      //$filename[0]=random(10); //设置随机数长度   
     $name=implode(".",$filename);   
        //$name1=$name.".Mcncc";   
     $uploadfile=$uploaddir.$name;  
     $upimg=$imgsrc;
  }   
while(file_exists($uploadfile));   
 if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile)){ 
   	$msr=$filename=explode(".",$_FILES['file']['name']);   
   	$tbdd=$msr['0'];
      $arr=array("code"=>1,"msg"=>"上传成功","src"=>$upimg,"tdd"=>$tbdd);
       $myfile = fopen("file.txt", "w") or die("Unable to open file!");
     fwrite($myfile, $uploadfile);
      fclose($myfile);
   }
  else
   {
      
       $arr=array("code"=>0,"msg"=>"上传失败");

  } 
echo json_encode($arr);  
}    

?>