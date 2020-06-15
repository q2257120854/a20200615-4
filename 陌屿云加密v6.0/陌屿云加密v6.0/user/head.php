<?php
/*
Auat：陌屿
QQ：2763994904
Name：陌屿云加密系统
*/
@header('Content-Type: text/html; charset=UTF-8');
include("../includes/common.php");
$mod='blank';
if($_SESSION['islogin']==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $conf["title"] ?> - 代理系统</title>
<meta name="description" content="<?php echo $conf['description']?>">
<meta name="keywords" content="<?php echo $conf['keywords']?>">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-transform"/>
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<link rel="stylesheet" href="../assets/static/user_style/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/static/user_style/css/plugins.css">
<link rel="stylesheet" href="../assets/static/user_style/css/main.css">
<link rel="stylesheet" href="../assets/static/user_style/css/themes.css">
<link rel="stylesheet" type="text/css" href="../assets/static/sweetalert/sweetalert.css"/>
<script src="../assets/static/user_style/js/vendor/modernizr-2.8.3.min.js"></script>
<link rel="shortcut icon" href="../assets/static/logo.png">
</head>
<script language="javascript">
function logout(){
if( confirm("你确实要退出吗？？")){
window.parent.location.href="login.php?logout";
}
else{
return;
}
}
</script>
<body>
<!-- Page Wrapper -->
<div id="page-wrapper" class="page-loading-off">
<!-- Preloader -->
<div class="preloader">
<div class="inner">
<!-- Animation spinner for all modern browsers -->
<div class="preloader-spinner themed-background hidden-lt-ie10"></div>
<!-- Text for IE9 -->
<h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
</div>
</div>
<!-- END Preloader -->

<!-- Page Container -->
<div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
<!-- Main Sidebar -->
<div id="sidebar">
<!-- Sidebar Brand -->
<div id="sidebar-brand" class="themed-background">
<a href="/" class="sidebar-title">
<i class="fa fa-thumbs-up"></i> <span class="sidebar-nav-mini-hide"><?php echo $conf["title"] ?></span>
</a>
</div>
<!-- END Sidebar Brand -->

<!-- Wrapper for scrolling functionality -->
<div id="sidebar-scroll">
<!-- Sidebar Content -->
<div class="sidebar-content">
<!-- Sidebar Navigation -->
<ul class="sidebar-nav">
<li>
<a id="user" href="./" class="<?php echo checkIfActive('index,')?>"><i class="gi gi-compass sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">用户中心</span></a>
</li>

<li>
<li>
<a id="phpjm" href="./phpjm.php" class="<?php echo checkIfActive('phpjm')?>"><i class="fa fa-table sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">单个加密</span></a>
</li>
<li>
<a id="jiami" href="./jiami.php" class="<?php echo checkIfActive('jiami')?>"><i class="fa fa-plus-square sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">批量加密</span></a>
</li>
<li>
<a id="base64" href="./base64.php" class="<?php echo checkIfActive('bade64')?>"><i class="fa fa-get-pocket sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">BASE64加密</span></a>
</li>
<li class="sidebar-separator">
<i class="fa fa-ellipsis-h"></i>
</li>
<a href="https://jq.qq.com/?_wv=1027&k=5nMrnCf"><i class="fa fa-shopping-cart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">官方群聊</span></a>
</li>
<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf["zzqq"] ?>&site=qq&menu=yes"><i class="fa fa-comments sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">联系站长</span></a>
</li>
</ul>
<!-- END Sidebar Navigation -->

</div>
<!-- END Sidebar Content -->
</div>
<!-- END Wrapper for scrolling functionality -->

<!-- Sidebar Extra Info -->
<div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
<div class="progress progress-mini push-bit">
<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div>
<div class="text-center">
<small class="hidden-xs"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf["zzqq"] ?>&site=qq&menu=yes" target="_blank">站长QQ：<?php echo $conf["zzqq"] ?></a><br></small>
<small><span id="year-copy"></span> &copy; <a href="/" target="_blank"><?php echo $conf["title"] ?></a>
</small>
</div>
</div>
<!-- END Sidebar Extra Info -->
</div>
<!-- END Main Sidebar -->

<!-- Main Container -->
<div id="main-container">
<!-- Header -->
<header class="navbar navbar-inverse navbar-fixed-top">
<!-- Left Header Navigation -->
<ul class="nav navbar-nav-custom">
<!-- Main Sidebar Toggle Button -->
<li>
<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
<i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
<i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>菜单
</a>
</li>
<li>
<a href="javascript:void(0)" onclick="javascript:history.go(-1);">
<i class="fa fa-reply fa-fw animation-fadeInRight"></i> 返回
</a>
</li>
<!-- END Main Sidebar Toggle Button -->
</ul>
<!-- END Left Header Navigation -->
				
<!-- Right Header Navigation -->
<ul class="nav navbar-nav-custom pull-right">
<!-- Search Form -->
<li>
<form action="./head.php?url=<?php echo $_POST['url'];?>" method="get" class="navbar-form-custom">
<input type="text" name="url" class="form-control" placeholder="陌屿云加密..." required/>
</form>
</li>
<!-- END Search Form -->

<!-- User Dropdown -->
<li class="dropdown">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $_SESSION['qq']?>&spec=100" alt="avatar">
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li class="dropdown-header">
<strong><?php echo $_SESSION['user']?></strong>
</li>
<li>
<a href="./set.php">
<i class="fa fa-inbox fa-fw pull-right"></i>
个人资料
</a>
</li>
<li>
<a href="./set.php">
<i class="fa fa-pencil-square fa-fw pull-right"></i>
密码修改
</a>
</li>
<li class="divider">
<li>
<li>
<a href="javascript:logout()">
<i class="fa fa-power-off fa-fw pull-right"></i>
注销登录
</a>
</li>
</ul>
</li>
<!-- END User Dropdown -->
</ul>
<!-- END Right Header Navigation -->
</header>
<!-- END Header -->
<!-- Page content -->
<div id="page-content">
<div class="content-header">
<div class="row">
<div class="col-sm-6">
<div class="header-section">
<h2><?php echo $title ?></h2>
</div>
</div>
</div>
</div>