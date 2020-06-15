 <?
 
   
   $post_data = array(
  'api_user' => $loginname, //账户
  'api_pwd' => $loginpassword,//密码
  'goodsid' => $duijiesid,//商品ID
  'number' => $_POST[$numname],//下单数量
  $duijiekey1 => $_POST[$duijiekey1],
  $duijiekey2 => $_POST[$duijiekey2],
  $duijiekey3 => $_POST[$duijiekey3],
  $duijiekey4 => $_POST[$duijiekey4],
 );
  $jg=  send_post('http://'.$pingtaiurl.'/api/web/order.html', $post_data);
// die ($jg);
	$query1=file_get_contents('http://'.$pingtaiurl.'/api/web/order.html');
	if ($query1 = json_decode($jg, true)) {
   			$duijiefanhuizt= $query1['message'] ;
 	}
 
  
 // die($s_duijiezt);
 
 
 function send_post($url, $post_data) {

  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

 ?>