<?php
#echo '{"code":-1,"message":"';
require_once("../system/inc.php");
#echo json_encode($_POST['api_user'].$_POST['api_pwd'].$_POST['number'].$_POST['goodsid']);
#echo '}﻿';
header("Content-type: text/html; charset=utf-8");
function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$httpheader[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 4.4.2; NoxW Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
$servername = DATA_HOST;  
$username = DATA_USERNAME;  
$password = DATA_PASSWORD;  
$dbname = DATA_NAME; 
 $sql = 'select * from '.flag.'shop where ID = '.$_POST['goodsid'].'  and  zt = 1 ';
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
	$s_id = $row['ID'];
 	$s_pid = $row['pid'];
 
 	$s_xid = $row['xid'];
 	$s_bd = $row['bd'];
 	$s_tk = $row['tk'];
 	$s_dnum = $row['minnum'];
 	$s_gnum = $row['maxnum'];

	$s_cid = $row['cid'];
 	$s_name = $row['name'];
 	$s_unit = $row['unit'];
 	$s_content = $row['content'];
	$s_pic = $row['pic'];
	$s_order = $row['sorder'];
	$s_date = $row['date'];
	$s_zt = $row['zt'];
	$s_duijie = $row['duijie'];
	$s_duijiesid = $row['duijiesid'];
	$s_duijiesqlx = $row['duijiesqlx'];
	$duijiefs = $row['duijiefs'];
	$duijiekey1 = $row['duijiekey1'];
	$duijiekey2 = $row['duijiekey2'];
	$duijiekey3 = $row['duijiekey3'];
	$duijiekey4 = $row['duijiekey4'];
if ($zhu=='true')	  //主站的商品价格
{	$shop_price = $row['price']; }

else
{	
 if ($dqbanben==1)   //分站的商品价格
{	$shop_price = $row['fprice1'];}
 if ($dqbanben==2)
{	$shop_price = $row['fprice2'];}
 if ($dqbanben==3)
{	$shop_price = $row['fprice3'];}
} 
}
$sql = "select * from ".flag."moban where ID = ".$s_xid." ";
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
 	$name = $row["name"];
 	$keyname1 = $row["keyname1"];
 	$keyname2 = $row["keyname2"];
 	$keyname3 = $row["keyname3"];
 	$keyname4 = $row["keyname4"];
 	$key1 = $row["key1"];
 	$key2 = $row["key2"];
 	$key3 = $row["key3"];
 	$key4 = $row["key4"];
      
	  }  
if($key1!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['goodsid']."&user=".$_POST['api_user']."&pwd=".$_POST['api_pwd']."&num=".$_POST['number']."&".$key1."=".$_POST[$key1];}else
if($key2!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['goodsid']."&user=".$_POST['api_user']."&pwd=".$_POST['api_pwd']."&num=".$_POST['number']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2];}else
if($key3!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['goodsid']."&user=".$_POST['api_user']."&pwd=".$_POST['api_pwd']."&num=".$_POST['number']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2]."&".$key3."=".$_POST[$key3];}
elseif($key4!=NULL){$url="http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=".$_POST['goodsid']."&user=".$_POST['api_user']."&pwd=".$_POST['api_pwd']."&num=".$_POST['number']."&".$key1."=".$_POST[$key1]."&".$key2."=".$_POST[$key2]."&".$key3."=".$_POST[$key3]."&".$key4."=".$_POST[$key4];}
$lj=get_curl($url);
$nr=trim(substr($lj,stripos($lj,'订单号:')+1),'订单号:');
if(strstr($lj,'下单成功!')){
echo '{"code":0,"message":'.json_encode("下单成功!").',"ddh":'.json_encode($nr).'}';
}elseif(strstr($lj,'返回信息:')){
echo '{"code":0,"message":'.json_encode($lj).',"ddh":'.json_encode($nr).'}';
# echo $url;
}elseif(strstr($lj,'订单号')){
echo '{"code":0,"message":'.json_encode("下单成功!没有返回信息").',"ddh":'.json_encode($nr).'}';
}
else{
echo '{"code":-1,"message":'.json_encode("下单失败,返回信息:".$lj).'}';
#echo $url;
}