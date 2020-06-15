<?php
//php防注入和XSS攻击通用过滤.
//by QQ:619982330
/*
$_GET && SafeFilter($_GET);
$_POST && SafeFilter($_POST);
$_COOKIE && SafeFilter($_COOKIE);
function SafeFilter(&$arr)
{
    $ra = array('/([\\x00-\\x08,\\x0b-\\x0c,\\x0e-\\x19])/', '/script/', '/javascript/', '/vbscript/', '/expression/', '/applet/', '/meta/', '/xml/', '/blink/', '/link/', '/style/', '/embed/', '/object/', '/frame/', '/layer/', '/title/', '/bgsound/', '/base/', '/onload/', '/onunload/', '/onchange/', '/onsubmit/', '/onreset/', '/onselect/', '/onblur/', '/onfocus/', '/onabort/', '/onkeydown/', '/onkeypress/', '/onkeyup/', '/onclick/', '/ondblclick/', '/onmousedown/', '/onmousemove/', '/onmouseout/', '/onmouseover/', '/onmouseup/', '/onunload/');
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (!is_array($value)) {
                if (!get_magic_quotes_gpc()) {
                    //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
                    $value = addslashes($value);
                    //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                }
                $value = preg_replace($ra, '', $value);
                //删除非打印字符，粗暴式过滤xss可疑字符串
                $arr[$key] = htmlentities(strip_tags($value));
                //去除 HTML 和 PHP 标记并转换为 HTML 实体
            } else {
                SafeFilter($arr[$key]);
            }
        }
    }
}*/

//加入禁止IP
$time = time();
$fileforbid = "log/forbidchk.dat";
if (file_exists($fileforbid)) {
    if ($time - filemtime($fileforbid) > 60) {
        unlink($fileforbid);
    } else {
        $fileforbidarr = @file($fileforbid);
        if ($ip == substr($fileforbidarr[0], 0, strlen($ip))) {
            if ($time - substr($fileforbidarr[1], 0, strlen($time)) > 600) {
                unlink($fileforbid);
            } elseif ($fileforbidarr[2] > 600) {
                file_put_contents($fileht, $ip . "\r\n", FILE_APPEND);
                unlink($fileforbid);
            } else {
                $fileforbidarr[2]++;
                file_put_contents($fileforbid, $fileforbidarr);
            }
        }
    }
}
//防刷新
$str = "";
$file = "log/ipdate.dat";
if (!file_exists("log") && !is_dir("log")) {
    mkdir("log", 0777);
}
if (!file_exists($file)) {
    file_put_contents($file, "");
}
$allowTime = 60;
//防刷新时间
$allowNum = 10;
//防刷新次数
$uri = $_SERVER['REQUEST_URI'];
$checkip = md5($ip);
$checkuri = md5($uri);
$yesno = true;
$ipdate = @file($file);
foreach ($ipdate as $k => $v) {
    $iptem = substr($v, 0, 32);
    $uritem = substr($v, 32, 32);
    $timetem = substr($v, 64, 10);
    $numtem = substr($v, 74);
    if ($time - $timetem < $allowTime) {
        if ($iptem != $checkip) {
            $str .= $v;
        } else {
            $yesno = false;
            if ($uritem != $checkuri) {
                $str .= $iptem . $checkuri . $time . "1\r\n";
            } elseif ($numtem < $allowNum) {
                $str .= $iptem . $uritem . $timetem . ($numtem + 1) . "\r\n";
            } else {
                if (!file_exists($fileforbid)) {
                    $addforbidarr = array($ip . "\r\n", time() . "\r\n", 1);
                    file_put_contents($fileforbid, $addforbidarr);
                }
                file_put_contents("log/forbided_ip.log", $ip . "--" . date("Y-m-d H:i:s", time()) . "--" . $uri . "\r\n", FILE_APPEND);
                $timepass = $timetem + $allowTime - $time;
                die("提示:" . "<br>" . "您的刷新频率过快，请等待 " . $timepass . " 秒后继续使用!");
            }
        }
    }
}
if ($yesno) {
    $str .= $checkip . $checkuri . $time . "1\r\n";
}
file_put_contents($file, $str);

$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){
	if(is_array($StrFiltValue)){
		$StrFiltValue=implode($StrFiltValue);
	}
	if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
		print "非法操作!";
		exit();
	}
}
foreach($_GET as $key=>$value){
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){
	StopAttack($key,$value,$cookiefilter);
}

?>