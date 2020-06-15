 <?
 
   
   $post_data = array(
  'api_user' => $loginname, //账户
  'api_pwd' => $loginpassword,//密码
  'goodsid' => $s_duijiesid,//商品ID
  'number' => $_GET['num'],//下单数量
  $duijiekey1 => $_GET[$key1],
  $duijiekey2 => $_GET[$key2],
  $duijiekey3 => $_GET[$key3],
  $duijiekey4 => $_GET[$key4],
 );
  $jg=  send_post('http://'.$duijieurl.'/api/web/order.html', $post_data);
// die ($jg);
	$query1=file_get_contents('http://'.$duijieurl.'/api/web/order.html');
	if ($query1 = json_decode($jg, true)) {
   			$s_duijiezt= $query1['message'] ;
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