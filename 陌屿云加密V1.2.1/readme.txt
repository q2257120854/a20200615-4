陌屿授权系统
V1.0
1.更新后台修改网站信息
2.源码全部优化重大优化
3.源码基本没漏洞和BUG
4.代码系统界面美化更新

授权代码(一般不用这个)：

if(!isset($_SESSION['authcode'])){
	$data["host"]=$_SERVER["HTTP_HOST"];
	$data["auth"]=authcode;
	$query_en = curl_get("http://地址/query.php?data=".base64_encode(des_enjson(json_encode($data))));
	$query=json_decode(des_dejson($query_en),true);
    if (is_array($query)) {
		if ($query["code"] == 1) {
			$_SESSION["authcode"] = authcode;
		}else{
			sysmsg("<h3>".$query["msg"]."</h3>", true);
		}
	}else{
		sysmsg("<h3>检测到客户端环境异常，授权服务器拒绝连接！</h3>", true);
	}
}

授权代码+更新代码：

if(!isset($_SESSION['authcode'])){
	$query = curl_get("http://域名/check.php?url=".$_SERVER["HTTP_HOST"]."&authcode=".authcode);
    if ($query = json_decode($query, true)) {
		if ($query["code"] == 1) {
			$_SESSION["authcode"] = authcode;
		}else{
			sysmsg("<h3>".$query["msg"]."</h3>", true);
		}
	}
}
function update_version()
{
	$query = curl_get("http://域名/check.php?url=".$_SERVER["HTTP_HOST"]."&authcode=".authcode."&ver=".VERSION);
	if ($query = json_decode($query,true)) {
		return $query;
	}
		return false;
}