 <?
 
 
    $data = array('Api_UserName'=>$loginname,'Api_UserMd5Pass'=>md5($loginpassword),'goods_id'=>$duijiesid,'goods_type'=>$duijiesqlx,'need_num_0'=>$_POST['num'],$canshu1=>$_POST[$duijiekey1],$canshu2=>$_POST[$duijiekey2],$canshu3=>$_POST[$duijiekey3],$canshu4=>$_POST[$duijiekey4],'pay_type'=>$duijiefs);  //定义参数  
  
       $data = @http_build_query($data);  //把参数转换成URL数据  
  
       $aContext = array('http' => array('method' => 'POST',  
  
       'header'  => 'Content-type: application/x-www-form-urlencoded',  
  
         'content' => $data ));  
  
       $cxContext  = stream_context_create($aContext);  
  
       $sUrl = 'http://'.$pingtaiurl.'/index.php?m=home&c=order&a=add'; //此处必须为完整路径  
  
      $d = @file_get_contents($sUrl,false,$cxContext);  
    //  print_r($d); 
  
preg_match('|<p class="error">(.*?)<\/p>|i',$d,$m);

 if ( $m[1]!=''){
	 
$duijiefanhuizt= $m[1];

 }
 
 else
 
 {
 if ($query = json_decode($d, true)) {
   			$duijiefanhuizt= $query['info'] ;
   			$s_duijiedingdan= $query['order_id'] ;
   			$after_use_rmb= $query['after_use_rmb'] ;
   			$after_use_cardnum= $query['after_use_cardnum'] ;
 	}	 
	 
	 }
 	   
	
 
 	      
  ?>