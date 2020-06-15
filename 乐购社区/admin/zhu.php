 <?
 
   
   $post_data = array(
 
);
  $jg=  send_post('http://'.$pingtaiurl.'/api/index.php?act=add&sid='.$duijiesid.'&user='.$loginname.'&password='.$loginpassword.'&'.$duijiekey1.'='.$_POST[$duijiekey1].'&'.$duijiekey2.'='.$_POST[$duijiekey2].'&'.$duijiekey3.'='.$_POST[$duijiekey3].'&'.$duijiekey4.'='.$_POST[$duijiekey4].'&num='.$_POST['num'].'', $post_data);
//  echo $jg;

 
	
	   			$duijiefanhuizt= $jg ;

  	 
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
 
 
 