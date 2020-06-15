<?php    
//error_reporting(0);
    $orderuid = $_REQUEST["pay_id"];
   
     //校验key成功，是自己人。执行自己的业务逻辑：加余额，订单付款成功，装备购买成功等等。
$db = array(
    'dsn' => 'mysqli:host=localhost;dbname=sstlp_sql_cn',
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => 'sstlp_sql_cn',
    'username' => 'sstlp_sql_cn',
    'password' => 'ZGXJdzieXZeShtNp',
    'charset' => 'utf8',
);

//mysqli过程化风格

//建立连接:相比mysql_connect可以直接选择dbname、port
//$link = mysqli_connect($db['host'], $db['username'], $db['password'], $db['dbname'], $db['port']);
$link = mysqli_connect($db['host'], $db['username'], $db['password']) or die( 'Could not connect: '  .  mysqli_error ($link));
$addtime = time();
//选择数据库
mysqli_select_db($link, $db['dbname']) or die ( 'Can\'t use foo : '  .  mysqli_error ($link));

mysqli_set_charset($link, $db['charset']);


$result  = mysqli_query($link, "select * from ffsm_orders where oid='{$orderuid}' and status = 0");
$num_rows  =  mysqli_num_rows ( $result );

if($num_rows>0){
mysqli_query($link , "update ffsm_orders set status='1' where  oid='".$orderuid."'"); 
	       
	
echo "success";
}else{
	echo "fail";
}