 <?php
  $duijiekey1='value1';
  $duijiekey2='value2';
  $duijiekey3='value3';
  $duijiekey4='value4'; 
 $timestamp=strtotime('now');
  
 $params =  array(
  'api_token' => $loginname, //账户
  'timestamp' => $timestamp,//密码
  'gid' => $s_duijiesid,//商品ID
  'num' => $_REQUEST['num'],//下单数量
  $duijiekey1 => $_REQUEST[$key1],
  $duijiekey2 => $_REQUEST[$key2],
  $duijiekey3 => $_REQUEST[$key3],
  $duijiekey4 => $_REQUEST[$key4],
);
$key = $loginpassword;
$sign = getSign($params, $key);


 $post_data = array(
  'api_token' => $loginname, //账户
  'timestamp' => $timestamp,//密码
  'sign' =>$sign,//
  'gid' => $s_duijiesid,//商品ID
  'num' => $_REQUEST['num'],//下单数量
  $duijiekey1 => $_REQUEST[$key1],
  $duijiekey2 => $_REQUEST[$key2],
  $duijiekey3 => $_REQUEST[$key3],
  $duijiekey4 => $_REQUEST[$key4],
 );
$post_data = http_build_query($post_data , '' , '&');
$jg = yilepost('http://' . $duijieurl . '.api.94sq.cn/api/order', $post_data);
if ($query = json_decode($jg, true)) {
    $s_duijiezt = $query['message'];
    $duijiefanhuizt = $query['message'];
	$s_duijiedingdan=$query['id'];
}else{
	$s_duijiezt = $query;
}
 ?>