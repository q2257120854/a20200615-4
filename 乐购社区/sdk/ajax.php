<?
 
  
	$query=file_get_contents('http://'.$site_shanghuurl.'/api.php?act=query&pid='.$site_shanghuid.'&key='.$site_shanghukey.'');
	if ($query = json_decode($query, true)) {
 		
 		$shanghu_money=	$query['money'] ;
 		$shanghu_zt=	$query['active'] ;
	}

 	$_data['shanghumoney'] = $shanghu_money;
 	$_data['shanghuzt'] = $shanghu_zt;
 
     	$sql = 'update '.flag.'set set '.arrtoupdate($_data).' where ID = 1';
	 mysql_query($sql);
  
	 
 

?>
