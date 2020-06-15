<?php
require_once('../system/inc.php');
include('../data/function.php');
 

 //获取下单模板
 function getmoban($t0,$t1)
{
	$result = mysql_query('select *   from  '.flag.'moban where ID ='.$t1.'   ');
	if (!!($row = mysql_fetch_array($result)))
	 {return $row[$t0];} 
 	else 
 	{ return ''; }
}



 
$xiaoyewl_act=$_GET['act'];


switch($xiaoyewl_act){
 

case'getyileGoodsParam1':
$loginname=$_GET['loginname'];
$loginpassword=$_GET['loginpassword'];
$url=$_GET['url'];
 $time=strtotime('now');
 
 
  $params0 =  array(
  'api_token' => $loginname, 
  'gid' => $_GET['id'], 
  'timestamp' => $time,
 );
$key0 = $loginpassword;
$sign0 = getSign($params0, $key0);



     $post_data2 = array(
  'api_token' => $loginname, 
  'gid' => $_GET['id'], 
  'timestamp' => $time,
  'sign' => $sign0,  
 );
    $list=yilepost('http://'.$url.'.api.94sq.cn/api/goods/info',$post_data2);
    $arr = json_decode($list, true);
	   // $canshu= $arr['data']['inputs'][0][2]."|" ;  

	if ($arr['data']['inputs'][0][2]!='')
	{   
    $canshu= "value1|" ;  
	}
	if ($arr['data']['inputs'][1][2]!='')
	{   
    $canshu=  $canshu."value2|" ;  
	}
	if ($arr['data']['inputs'][2][2]!='')
	{   
    $canshu=  $canshu."value3|" ;  
	}

	if ($arr['data']['inputs'][3][2]!='')
	{   
    $canshu=  $canshu.$canshu.$canshu."value4|" ;  
	}

	if ($arr['data']['inputs'][4][2]!='')
	{   
    $canshu=  $canshu.$canshu.$canshu.$canshu."value5|" ;  
	}


 
 


//	echo $canshu;
if ($canshu=='|')
  	{ die ('{"code":0,"param":"'.$canshu.'","message":"'.$arr['message'].$loginname.'"}');}
else
  	{ die ('{"code":0,"param":"'.$canshu.'","message":""}');}
break;

  }

 
 ?>
 