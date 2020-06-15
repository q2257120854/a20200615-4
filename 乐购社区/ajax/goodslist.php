<?php require_once('../system/inc.php');
error_reporting(0);
header("Content-type:text/html;charset=utf-8");//字符编码设置  
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
						  ?>
