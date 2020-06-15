<?php
require_once('../system/inc.php');
header("Content-type:text/html;charset=utf-8");//字符编码设置  
//获取商品状态反馈
	 function get_shopzt($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['duijiecgzt'];
	} else {
		return '0';
	}
}
$xiaoyewl_act=$_POST['action'];
switch ($xiaoyewl_act) {
	case 'getGoodsAndClass':
	$servername = DATA_HOST;  
$username = DATA_USERNAME;  
$password = DATA_PASSWORD;  
$dbname = DATA_NAME;  
// 创建连接  
$con =mysqli_connect($servername, $username, $password, $dbname);  
mysqli_set_charset($con, "utf8");
// 检测连接  
$sql = 'select ID ,name ,cid ,pic ,price from '.flag.'shop where   zt = 1 and zid = '.$zhu_id.'';  
#mysql_query('select ID ,name ,minnum ,maxnum ,xid ,pic from '.flag.'notice where zid = '.$zhu_id.' ');}
#
$result = mysqli_query($con,$sql); 
#$result = mysql_query($sql); 
/*print_r(mysqli_fetch_array($sql)); 
print_r($result); */
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$jarr = array();
while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
    $count=count($rows);
    for($i=0;$i<$count;$i++){  
        unset($rows[$i]); 
    }
    array_push($jarr,$rows);
}
$sort=0;
$sql = 'select * from '.flag.'shop_channel  where zid = '.$zhu_id.' order by corder desc , ID desc';
								$result = mysql_query($sql);
							while($row= mysql_fetch_array($result)){
								$class[]=array("cid"=>"{$row['ID']}","name"=>"{$row['name']}","sort"=>$sort);
$sort++;
							}
$sort=0;
foreach ($jarr as $v) {
$goods[]=array("gid"=>"{$v['ID']}",
"cid"=>"{$v['cid']}","money"=>"{$v['price']}","name"=>"{$v['name']}",
"image"=>"{$v['pic']}","sort"=>$sort);
$sort++;
}
$result=array("status"=>0,"message"=>"理论上没bug","data"=>array("goods"=>$goods,"class"=>$class));
die(json_encode($result));
break;

case 'searchOrder':
//所有条件
$code=1;
$msg='搜索失败';
$get=file_get_contents("php://input").'a=a';
$get=str_replace('=','":"',$get);
$get=str_replace('&','","',$get);
$get='{"'.$get.'"}';
if($get=json_decode($get,true)){
					 if ($get['gid']!='' and  $get['status']!='' and  $get['value1']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where sid = '.$get['gid'].'  and  zt = '.$get['status'].'  and   dingdanhao like "%'.$get['value1'].'%"   and zid = '.$zhu_id.' or  key1 like "%'.$get['value1'].'"   and zid = '.$zhu_id.'  or key2 like "%'.$get['value1'].'"   and zid = '.$zhu_id.' or  key3 like "%'.$get['value1'].'"   and zid = '.$zhu_id.' or  key4 like "%'.$get['value1'].'"  and zid = '.$zhu_id.'  order by ID desc ,ID desc');}
					//只看商品+搜索
					elseif ($get['gid']!='' and  $get['status']=='' and  $get['value1']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where sid = '.$get['gid'].'  and   dingdanhao like "%'.$get['value1'].'%"   and zid = '.$zhu_id.'  or  sid = '.$get['gid'].'  and key1 like "%'.$get['value1'].'"   and zid = '.$zhu_id.'  or  sid = '.$get['gid'].'  and key2 like "%'.$get['value1'].'"   and zid = '.$zhu_id.' or  sid = '.$get['gid'].'  and  key3 like "%'.$get['value1'].'"   and zid = '.$zhu_id.' or  sid = '.$get['gid'].'  and  key4 like "%'.$get['value1'].'" and zid = '.$zhu_id.'    order by ID desc ,ID desc');}
					//只看状态+搜索
				elseif ($get['gid']=='' and  $get['status']!='' and  $get['value1']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where zt = '.$get['status'].'  and   dingdanhao like "%'.$get['value1'].'%"   and zid = '.$zhu_id.' or   zt = '.$get['status'].'  and  key1 like "%'.$get['value1'].'"  and zid = '.$zhu_id.'  or   zt = '.$get['status'].'  and  key2 like "%'.$get['value1'].'" or    zt = '.$get['status'].'  and key3 like "%'.$get['value1'].'"   and zid = '.$zhu_id.'   or    zt = '.$get['status'].'  and key4 like "%'.$get['value1'].'"    and zid = '.$zhu_id.'   order by ID desc ,ID desc');}		
				//纯搜索
				elseif ($get['gid']=='' and  $get['status']=='' and  $get['value1']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where  dingdanhao like "%'.$get['value1'].'%"  and zid = '.$zhu_id.'    or  key1  like "%'.$get['value1'].'"  and zid = '.$zhu_id.' or key2  like "%'.$get['value1'].'" and zid = '.$zhu_id.'  or  key3 like "%'.$get['value1'].'" and zid = '.$zhu_id.'  or  key4 like "%'.$get['value1'].'" and zid = '.$zhu_id.'    order by ID desc ,ID desc');}	
						while($roww = mysql_fetch_array($result)){
						    $code=0;
$msg='搜索成功';
$goods=array("name"=>"".$roww['sname']."","gid"=>"".$roww['sid']."");
$array[]=array("id"=>$roww['dingdanhao'],"goods"=>$goods,"num"=>"{$roww['num']}","zt"=>$roww['zt'],"now_num"=>$roww['dpnum'],"start_num"=>$roww['csnum'],"price"=>$roww['price'],"value1"=>$roww['keyname1'].':'.$roww['key1'].'|'.$roww['keyname2'].':'.$roww['key2'].'|'.$roww['keyname3'].':'.$roww['key3'].'|'.$roww['keyname4'].':'.$roww['key4']);
}
						}else{
						    $msg='解析';
						}
	  $result=array("status"=>$code,"message"=>"$msg","data"=>$array);
die(json_encode($result));
break;
}
//获取商品状态反馈
	 function get_shopname($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['name'];
	} else {
		return '0';
	}
}