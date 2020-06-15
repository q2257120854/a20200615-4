<?php 
include('../system/inc.php');
$url2='https://www.lanzous.com/i9ybz7g?t='.rand(10000,999999);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>APP下载 - <?=$site_name?></title>
    <meta name="keywords" content="卡密社区,时空,镜梦,镜梦社区,亿乐社区,镜梦社区系统,镜梦系统,19sky.cn,镜梦卡密社区系统(jmkmsq.cn)"/>
    <meta name="description" content="卡密社区,时空,镜梦,镜梦社区,亿乐社区,镜梦社区系统,镜梦系统,19sky.cn,镜梦卡密社区系统(jmkmsq.cn)"/>
    <link rel="stylesheet" type="text/css" href="http://assets.yilep.com/ylsq/assets/app/app.css">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9">
    <script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
</head>

<body class="appdownload-body">
<div class="mb-stars"></div>
<div class="page-bg-btm mobile"></div>

<div class="appdownload-wrap">
    <div class="appdownload-logo">
        <img src="http://assests.skywl.cc/app/image/logo.png" width="80" height="80">
        <p class="appname"><?=$site_name?></p>
    </div>
    <div class="appdownload-btns">
        <!--<a class="btn item-android" href="<?=$url?>" style="text-align: center">
            <span class="txt" style="float: none"> <i class="iconfont"></i> 安卓版(直连下载）</span>
        </a>-->
                <a class="btn item-android" href="<?=$url2?>" style="text-align: center">
            <span class="txt" style="float: none"> <i class="iconfont"></i> 安卓版</span>
        </a>
        <!--<a class="btn item-android" onclick="iosInstall()" style="text-align: center">
            <span class="txt" style="float: none"> <i class="iconfont"></i> 苹果版</span>
        </a>-->
    </div>
    <p style="text-align: center;color: white; width: 60%;margin: 0 auto">
        提示：下载不了点下面的非直连下载；打开APP后，提示输入社区域名时请输入： <?=$_SERVER['HTTP_HOST']?> 即可！</p>
    <p class="appdownload-copyright" style="color: white; width: 60%;margin: 0 auto">Copyright
        © <?=$site_name?> All Rights Reserved</p>
</div>
<div id="html_ios" style="display: none">
    <div style="font-size: 15px; font-weight: bold;text-align: center;color: green">正在安装，请按 Home 键在桌面查看</div>
    <div style="text-align: center;margin-top: 15px">说明：安装完成后，请打开苹果手机设置》通用》描述文件与设备管理找到并点击“REKA，PP”》点击 信任“REKA，PP” 即可。
    </div>
</div>
<script type="application/javascript">
    function iosInstall() {
                layer.alert('请用ios系统自带Safari浏览器打开本网页进行安装！');
            }
</script>
</body>
</html>
