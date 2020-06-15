 <?
 
 
    $data = array('Api_UserName'=>$loginname,'Api_UserMd5Pass'=>md5($loginpassword),'goods_id'=>$s_duijiesid,'goods_type'=>$s_duijiesqlx,'need_num_0'=>$_POST['num'],$canshu1=>$_POST[$key1],$canshu2=>$_POST[$key2],$canshu3=>$_POST[$key3],$canshu4=>$_POST[$key4],'pay_type'=>$duijiefs);  //定义参数  
  
       $data = @http_build_query($data);  //把参数转换成URL数据  
  
       $aContext = array('http' => array('method' => 'POST',  
  
       'header'  => 'Content-type: application/x-www-form-urlencoded',  
  
         'content' => $data ));  
  
       $cxContext  = stream_context_create($aContext);  
  
       $sUrl = 'http://'.$duijieurl.'/index.php?m=home&c=order&a=add'; //此处必须为完整路径  
  
      $d = @file_get_contents($sUrl,false,$cxContext);  
    //  print_r($d); 
  
preg_match('|<p class="error">(.*?)<\/p>|i',$d,$m);

 if ( $m[1]!=''){
	 
$s_duijiezt= $m[1];

 }
 
 else
 
 {
 if ($query = json_decode($d, true)) {
   			$s_duijiezt= $query['info'] ;
   			$s_duijiedingdan= $query['order_id'] ;
   			$after_use_rmb= $query['after_use_rmb'] ;
   			$after_use_cardnum= $query['after_use_cardnum'] ;
 	}	 
	 
	 }
	 
	 
	//对接记录
 	
 	$_duijiedate['zid'] = $zhu_id;
 	$_duijiedate['sid'] = $_GET['id'];
 	$_duijiedate['dsid'] = $s_duijiesid;
 	$_duijiedate['dingdanhao'] = $danhao;
 	$_duijiedate['ddingdanhao'] = $s_duijiedingdan;
 	$_duijiedate['desc'] = $s_duijiezt;
 	$_duijiedate['je'] = $pay_price;
 	$_duijiedate['dje'] = $after_use_rmb;
 	$_duijiedate['date'] = $sj;
 	$_duijiedate['pingtai'] = $s_duijie;


  
   	$duijiestr2 = arrtoinsert($_duijiedate);
	$duijiejlsql = 'insert into '.flag.'duijiejl ('.$duijiestr2[0].') values ('.$duijiestr2[1].')';
    mysql_query($duijiejlsql);	
 	   
	   
  ?>