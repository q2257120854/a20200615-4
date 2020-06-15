<?php
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
header("Content-type:text/html;charset=utf-8");//字符编码设置  
echo '[';
$url = "http://{$_SERVER['HTTP_HOST']}/api/shoplist.php";
		$ret = curl_get($url);
        #$ret=$a;
		if (!$ret = json_decode($ret, true)) {
print_r($ret);
			echo '打开对接网站失败';
		} elseif ($ret['status'] != 1) {
			echo ('炸了');
		} else {
			$list = array();
			$i=1;	
			foreach ($ret['goods_rows'] as $v) {
			$rett=curl_get("http://{$_SERVER['HTTP_HOST']}/api/spl.php?xid=".$v['xid']);
#$rett=$aa;
	$xy=json_decode($rett, true);
$jarr = array("Id"=>"{$v['ID']}","Name"=>"{$v['name']}",
"Img_Url"=>"{$v['pic']}","OrderMin"=>"{$v['minnum']}","OrderMax"=>"{$v['maxnum']}","AddStatus"=>0,"MoneyStatus"=>1,"Money"=>1);
$xy3=json_encode($jarr);
if($i!=1)echo ',';
echo $xy3;
$i=$i+1;
}
}
echo ']';
#$jar={"Id":"","Name":"","Img_Url":"","post":[{"param":""]};?>