 <?
  
 $timestamp=strtotime('now');
  
 $params =  array(
  'api_token' => $loginname, //账户
  'timestamp' => $timestamp,//密码
  'gid' => $duijiesid,//商品ID
  'num' => $_POST[$numname],//下单数量
  $duijiekey1 => $_POST[$duijiekey1],
  $duijiekey2 => $_POST[$duijiekey2],
  $duijiekey3 => $_POST[$duijiekey3],
  $duijiekey4 => $_POST[$duijiekey4],
 
);
$key = $loginpassword;
$sign = getSign($params, $key);


 $post_data = array(
  'api_token' => $loginname, //账户
  'timestamp' => $timestamp,//密码
  'sign' =>$sign,//
  'gid' => $duijiesid,//商品ID
  'num' => $_POST[$numname],//下单数量
  $duijiekey1 => $_POST[$duijiekey1],
  $duijiekey2 => $_POST[$duijiekey2],
  $duijiekey3 => $_POST[$duijiekey3],
  $duijiekey4 => $_POST[$duijiekey4],
 
 
 );
 

  
 
  $jg=  yilepost('http://'.$pingtaiurl.'.api.94sq.cn/api/order', $post_data);
 	if ($query = json_decode($jg, true)) {$s_duijiezt= $query['message'] ;$duijiefanhuizt= $query['message'] ;}
 
 
 
 


 ?>