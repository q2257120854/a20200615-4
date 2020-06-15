<?php
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', __DIR__ . DS);
error_reporting(E_ERROR | E_PARSE);
@header('Content-Type: application/json; charset=UTF-8');
date_default_timezone_set('Asia/Shanghai');
set_error_handler(function ($errno, $errstr ,$errfile, $errline) {
	die(json_encode([
		'status' => false,
		'message' => $errstr,
	]));
});
register_shutdown_function(function () {
	if ($error = error_get_last()) {
		die(json_encode([
			'status' => false,
			'message' => '操作失败 : ' . $error['message'],
			'file'   => '错误行数: ' . $error['line'],
		]));
	}
});
/**
 * 远程访问
 * @param $url
 * @param int $post
 * @param int $referer
 * @param int $cookie
 * @param int $header
 * @param int $ua
 * @param int $nobaody
 * @return bool|string
 */
function Curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0 ,$headers = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $httpheader[] = "Accept: */*";
    $httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
    $httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
    $httpheader[] = "Connection: close";
	if (is_array($headers)) {
		foreach ($headers as $name => $val) {
			array_push($httpheader , $name . ':' . $val);
		}
	}
    curl_setopt($ch, CURLOPT_TIMEOUT, 35);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    if ($header) {
        curl_setopt($ch, CURLOPT_HEADER, fals);
    }
    if ($cookie) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if ($ua) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    } else {
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
    }
    if ($nobaody) {
        curl_setopt($ch, CURLOPT_NOBODY, 1);
    }
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}
function getRealUrl($url){
	$header = get_headers($url , 1);
	if (strpos($header[0] , '301') || strpos($header[0] , '302')) {
		if(is_array($header['Location'])) {
			return $header['Location'][count($header['Location'])-1];
		} else {
			return $header['Location'];
		}
	} else {
		return $url;
	}
}
$result = [
	'status' => false,
];
$act = isset($_REQUEST['act']) ? strtolower($_REQUEST['act']) : null;
if (is_null($act)) {
	$result['message'] = '操作错误';
} else if ($act === 'kssp') {
	$url = trim($_REQUEST['url']);
	if (!strpos($url , 'gifshow.com')) {
		$result['message'] = '请输入正确的快手短链接';
	} else {
		$ksspRealUrl = getRealUrl($url);
		if (strpos($ksspRealUrl , 'live.kuaishou.com')) {
			if (preg_match('#u\/([a-z0-9]+)\/([a-z0-9]+)\?#' , $ksspRealUrl , $arr)) {
				array_shift($arr);
				$result = [
					'status' => true,
					'message' => 'success',
					'data'   => $arr,
				];
			} else {
				$result['message'] = '获取失败，请输入快手作品的链接';
			}
		} else {
			$result['message'] = '匹配失败';
		}
	}
} else if ($act === 'xhs') {
	$url = trim($_REQUEST['url']);
	$url = strpos($url , 'xiaohongshu.com') ? $url : getRealUrl($url);
	if (strpos($url , 'xiaohongshu.com') && preg_match('#(item|profile)\/([0-9a-zA-Z]+)#i' , $url , $arr)) {
		$result = [
			'message' => 'success',
			'status'  => true,
			'ret'     => $arr[2]
		];
	} else {
		$result['message'] = '获取失败';
	}
} else if ($act === 'shuoshuo') {
	$qq = isset($_REQUEST['qq']) ? trim($_REQUEST['qq']) : null;
	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	if (!preg_match('/(^[1-9]{1})([0-9]{4})[0-9]{0,5}$/' , $qq)) {
		$result['message'] = '请输入正确的QQ号码';
	} else {
		$_p = [
			'qq' => $qq,
			'page' => $page,
			'act'  => 'shuoshuo',
		];
		$url = 'http://runsd.qqzzz.net/tools.php';
		$shuoList = Curl($url , http_build_query($_p) , $url , 0 , 0 , 0 , 0 , [
			'X-Requested-With' => 'XMLHttpRequest',
		]);
		if ($row = json_decode($shuoList , true)){
			/*if ($row['code'] == 1) {
				$result = [
					'message'  => 'success',
					'status'   => true,
					'data'     => $row['data'], // 说说列表
				];
			} else {
				$result['message'] = $row['msg'];
			}
			*/
			if ($row['status'] == 'true' && array_key_exists('data' , $row)) {
				$result = [
					'status'   => true,
					'message'  => 'success',
					'data'     => $row['data'],
				];
			} else {
				$result['message'] = $row['message'];
			}
		} else {
			$result['message'] = '获取说说失败';
		}
	}
} else {
	$result['message'] = '操作方法不存在';
}
echo (json_encode($result , JSON_UNESCAPED_UNICODE));