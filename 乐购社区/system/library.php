<?php
if(!defined('PCFINAL')) exit('Request Error!');
//对于关闭 magic_quotes_gpc 后的处理
if (!get_magic_quotes_gpc()){
	if (!empty($_GET)){
		$_GET = addslashes_deep($_GET);
	}
	if (!empty($_POST)){
		$_POST = addslashes_deep($_POST);
	}
	$_COOKIE = addslashes_deep($_COOKIE);
	$_REQUEST = addslashes_deep($_REQUEST);
}

function addslashes_deep($value) {
	if (empty($value)) {
		return $value;
	} else {
		return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
	}
}

//提示后返回
function alert_back($t0) {
	die('<script type="text/javascript">alert("'.$t0.'");window.history.back();</script>');
}
function alert($t0) {
	die('<script type="text/javascript">alert("'.$t0.'");window.history.back();</script>');
}

 

//提示后跳转
function alert_href($t0, $t1) {
	die('<script type="text/javascript">alert("'.$t0.'");window.location.href="'.$t1.'"</script>');
}


function alert_url($t0) {
	die('<script type="text/javascript">window.location.href="'.$t0.'"</script>');
}

//空值返回
function null_back($t0, $t1) {
	if ($t0 == '') {
		alert_back($t1);
	}
}

//非数字返回
function non_numeric_back($t0, $t1) {
	if (!is_numeric($t0) || $t0 < 0) {
		alert_back($t1);
	}
}

//分页初始化
//参数说明：1分页参数。2.每页显示多少。3.一共多少。
function page_handle($t0, $t1, $t2) {
	if (isset($_GET[$t0])) {
		$page_num = $_GET[$t0];
		if (empty($page_num) || $page_num < 1 || !is_numeric($page_num)) {
			$page_num = 1;
		} else {
			$page_num = intval($page_num);
		}
	} else {
		$page_num = 1;
	}
	if ($t2 == 0) {
		$page_sum = 1;
	} else {
		$page_sum = ceil($t2 / $t1);
	}
	if ($page_num > $page_sum) {
		$page_num = $page_sum;
	}
	$from_num = ($page_num - 1) * $t1;
	$tmp = array();
	$tmp[0] = $from_num;
	$tmp[1] = $t1;
	$tmp[2] = $page_sum;
	$tmp[3] = $page_num;
	$tmp[4] = $t0;
	return $tmp;
}

//返回翻页条
//参数说明：1.总页数。2.当前页。3.分页参数。4.分页半径。
function page_show($t0, $t1, $t2, $t3) {
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
	$page_start = $page_current - $page_len;
	if ($page_start <= 0) {
		$page_start = 1;
		$page_end = $page_start + $page_end;
	}
	$page_end = $page_current + $page_len;
	if ($page_end > $page_sum) {
		$page_end = $page_sum;
	}
	$page_link = $_SERVER['REQUEST_URI'];
	$tmp_arr = parse_url($page_link);
	if (isset($tmp_arr['query'])){
		$url = $tmp_arr['path'];
		$query = $tmp_arr['query'];
		parse_str($query, $arr);
		unset($arr[$page_parameter]);
		if (count($arr) != 0){
			$page_link = $url.'?'.http_build_query($arr).'&';
		}else{
			$page_link = $url.'?';
		}
	}else{
		$page_link = $page_link.'?';
	}
	$page_back = '';
	$page_home = '';
	$page_list = '';
	$page_last = '';
	$page_next = '';
	$tmp = '';
	if ($page_current > $page_len + 1) {
		$page_home = '<LI><a href="'.$page_link.$page_parameter.'=1" title="首页">1...</a><LI>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<LI><a href="'.$page_link.$page_parameter.'='.($page_current - 1).'" title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.'<li  class="active"><span   >'.$i.'</span></li>';
		} else {
			$page_list = $page_list.'<li><a href="'.$page_link.$page_parameter.'='.$i.'" title="第'.$i.'页">'.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li><a href="'.$page_link.$page_parameter.'='.$page_sum.'" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = '<LI><a href="'.$page_link.$page_parameter.'='.($page_current + 1).'" title="下一页">下一页</a></li>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}

function page_shows($t0, $t1, $t2, $t3) {
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
	$page_start = $page_current - $page_len;
	if ($page_start <= 0) {
		$page_start = 1;
		$page_end = $page_start + $page_end;
	}
	$page_end = $page_current + $page_len;
	if ($page_end > $page_sum) {
		$page_end = $page_sum;
	}

	$page_back = '';
	$page_home = '';
	$page_list = '';
	$page_last = '';
	$page_next = '';
	$tmp = '';
	if ($page_current > $page_len + 1) {
		$page_home = '<li ><a href="'.$page_parameter.'1.html" title="首页">1...</a></LI>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<li><a href="'.$page_parameter.($page_current - 1).'.html" title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.'<li  class="active"><span href="javascript:void(0)" >'.$i.'</span></li>';
		} else {
			$page_list = $page_list.'<li><a href="'.$page_parameter.$i.'.html" title="第'.$i.'页">'.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<LI><a href="'.$page_parameter.$page_sum.'.html" title="尾页">...'.$page_sum.'</a><LI>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = '<LI><a href="'.$page_parameter.($page_current + 1).'.html" title="下一页">>></a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


//截断字符串
function cut_str($str, $len = 10, $etc = '...') {
	$restr = '';
	$i = 0;
	$n = 0.0;
	$strlen = strlen($str);
	while (($n < $len) and ($i < $strlen)) {
		$temp_str = substr($str, $i, 1);
		$ascnum = ord($temp_str);
		if ($ascnum >= 252) {
			$restr = $restr . substr($str, $i, 6);
			$i = $i + 6;
			$n++;
		} else if ($ascnum >= 248) {
			$restr = $restr . substr($str, $i, 5);
			$i = $i + 5;
			$n++;
		} else if ($ascnum >= 240) {
			$restr = $restr . substr($str, $i, 4);
			$i = $i + 4;
			$n++;
		} else if ($ascnum >= 224) {
			$restr = $restr . substr($str, $i, 3);
			$i = $i + 3;
			$n++;
		} else if ($ascnum >= 192) {
			$restr = $restr . substr($str, $i, 2);
			$i = $i + 2;
			$n++;
		}
		else if ($ascnum >= 65 and $ascnum <= 90 and $ascnum != 73) {
			$restr = $restr . substr($str, $i, 1);
			$i = $i + 1;
			$n++;
		}
		else if (!(array_search($ascnum, array(37,38,64,109,119)) === FALSE)) {
			$restr = $restr . substr($str, $i, 1);
			$i = $i + 1;
			$n++;
		}
		else {
			$restr = $restr . substr($str, $i, 1);
			$i = $i + 1;
			$n = $n + 0.5;
		}
	}
	if ($i < $strlen) {
		$restr = $restr . $etc;
	}
	return $restr;
}

//获取当前页面的url

function get_url() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

//获取IP
function get_ip() {
	static $ip = NULL;
	if ($ip !== NULL) return $ip;
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos = array_search('unknown', $arr);
		if (false !== $pos) unset($arr[$pos]);
		$ip = trim($arr[0]);
	} else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} else if (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	//IP地址合法验证
	$ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
	return $ip;
}

//清理html
function clear_html($str) {
	$str = strip_tags($str);
	$str = trim($str);
	$str = preg_replace('/\s(?=\s)/', '', $str);
	$str = preg_replace('/[\n\r\t]/', ' ', $str);
	return $str;
}

//获取随机字符
function random_str($length = 6) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$random_str = '';
	for ($i = 0; $i < $length; $i++) {
		$random_str.= $chars[mt_rand(0, strlen($chars) - 1) ];
	}
	return $random_str;
}

//判断是否是移动设备
function ism() {
	$ismobile = false;
	if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
		$ismobile = true;
	}
	if (isset($_SERVER['HTTP_VIA'])) {
		$ismobile = (stristr($_SERVER['HTTP_VIA'], "wap") ? true : false);
	}
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
		if (preg_match('/(' . implode('|', $clientkeywords) . ')/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$ismobile = true;
		}
	}
	if (isset($_SERVER['HTTP_ACCEPT'])) {
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			$ismobile = true;
		}
	}
	if (isset($_COOKIE['ism'])) {
		if($_COOKIE['ism'] == 'y'){
			$ismobile = true;
		};
		if($_COOKIE['ism'] == 'n'){
			$ismobile = false;
		};
	}
	return $ismobile;
}

//将数组转换成供insert用的字符串
function arrtoinsert($arr){
	$key = '';
	$value = '';
	foreach($arr as $k=>$v){
		$tmp_key[] = '`'.$k.'`';
		$tmp_value[] = '"'.$v.'"';
	}
	$key .= implode(',',$tmp_key);
	$value .= implode(',',$tmp_value);
	$tmp[0] = $key;
	$tmp[1] = $value;
	return $tmp;
}

//将数组转换成供update用的字符串
function arrtoupdate($arr){
	$tmp = '';
	$s = '';
	foreach($arr as $k=>$v){
		$tmp .= $s.'`'.$k.'` = "'.$v.'"';
		$s = ',';
	}
	return $tmp;
}
?>
