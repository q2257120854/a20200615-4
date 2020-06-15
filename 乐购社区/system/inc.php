<?php
#if($_REQUEST["value"])exit($_REQUEST["value"]);
ini_set("error_reporting", "E_ALL & ~E_NOTICE");
require_once ('jump.php');
require_once ('conn.php');
require_once ('library.php');
require_once ('function.php');
require_once ('config.php');
require_once ('djfunction.php');
require_once ('Smtp.class.php');
require_once ('safe.php');
//require_once('txprotect.php');
if (is_file('360safe/360webscan.php')) {
    require_once ('360safe/360webscan.php');
} //注意文件路径
include_once('db.class.php');
$DB=new DB(DATA_HOST,DATA_USERNAME,DATA_PASSWORD,DATA_NAME,3306);
$ym = '<a href="http://www.96ca.com">www.96ca.com</a>';
$ym2 = 'www.www.96ca.com';
$qq = '3301200869';
$name = $sqname;
$site_smtp = 'smtp.qq.com';
$site_emailuser = '3301200869@qq.com';
$site_emailpassword = 'xobzzeypcvrjbfba';
$site_port = '465';
//判断域名是否存在
if ($zhu == 'flash' and $fen == 'flash' and $dq_url != sysurl) {
    die('<html>
<head>
    <link href="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/common/css/style.css">
    <link rel="shortcut icon" href="/favicon.ico"/>
<meta http-equiv="Content-Type" content="textml; charset=utf-8">
<title>出错了</title>
<link rel="shortcut icon" type="image/x-icon" href="http://' . $ym2 . '/favicon.ico"/>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 微软雅黑,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size:14px;cursor:default; line-height:240%;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<div class="error-xs show-xs">
    <div class="error_info">
        <div style="padding-bottom: 100px">
            <h3>我们很抱歉！</h3>
            <h4 class="w3-agileits2">
                该域名 echo $_SERVER[‘SERVER_NAME’]; 尚未使用 可以搭建使用！<br></h4>
            <div>
                <a href="http://#" class="btn">跳转官网</a>
                <a href="http://#" class="btn">进入测试站</a>
            </div>
        </div>
    </div>
</div>
<div class="error hidden-xs">
    <div class="error_info">
        <div style="padding-bottom: 100px">
            <h3>我们很抱歉！</h3>
            <h4 class="w3-agileits2">
                
                            </h4>
            <div>
                <a href="http://#" class="btn">跳转官网</a>
                <a href="http://#" class="btn">进入测试站</a>
            </div>
        </div>
    </div>
    <div class="error_img">
        <div class="error_msg">
            <h1>405</h1>
            <h2>当前域名尚未使用可以搭建使用！</h2>
            <br> <br>
        </div>
    </div>
</div>
<script type="text/javascript">
      function url() {
        var s = document.getElementById("s").innerText;
        s = Number(s);
        s--;
        if (s < 1) {
            document.getElementById("url").click();
        } else {
            document.getElementById("s").innerText = s;
            document.getElementById("ss").innerText = s;
            setTimeout(url, 4000);
        }
    }


       url();
    </script>
</body>
<ml>');
}
//判断时间
if ($site_ddate < date('Y-m-d H:i:s') and $dq_url != sysurl) {
    die('<html>
<head>
<meta http-equiv="Content-Type" content="textml; charset=utf-8">
<title>平台到期！请联系客服续费</title>
<link rel="shortcut icon" type="image/x-icon" href="http://d#/favicon.ico"/>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 微软雅黑,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size:14px;cursor:default; line-height:240%;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<body>
<div class="ip-attack">
<dl>
<dt><h1> 该域名隶属乐购社区 平台到期！请联系客服续费 </h1>官网www.96ca.com 客服qq3301200869</dt>
</dl>
</div>
</body>
<ml>');
}
//判断站点状态
if ($site_zt == 0 and $dq_url != sysurl) {
    die('
<html>
<head>
<meta http-equiv="Content-Type" content="textml; charset=utf-8">
<title>平台被关闭！详情请联系上级QQ3301200869</title>
<link rel="shortcut icon" type="image/x-icon" href="http://d#/favicon.ico"/>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 微软雅黑,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size:14px;cursor:default; line-height:240%;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<body>
<div class="ip-attack">
<dl>
<dt><h1> 平台被关闭！详情请联系上级！qq3301200869 </h1>官网' . $ym . '  客服q' . $qq . '</dt>

</dl>
</div>
</body>
<ml>!');
}
