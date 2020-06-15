 <?
 
   
   $post_data = array(
 
);
  $jg=  send_post('http://'.$duijieurl.'/api/index.php?act=add&sid='.$s_duijiesid.'&user='.$loginname.'&password='.$loginpassword.'&'.$key1.'='.$_GET[$key1].'&'.$key2.'='.$_GET[$key2].'&'.$key3.'='.$_GET[$key3].'&'.$key4.'='.$_GET[$key1].'&num='.$_GET['num'].'', $post_data);
//  echo $jg;

 
	
	   			$s_duijiezt= $jg ;

  	 
//  echo $s_duijiezt;
  
 
 
 function send_post($url, $post_data) {

  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'GET',
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
 
 
 