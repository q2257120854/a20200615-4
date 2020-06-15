<?php
/*
Auat：陌屿
QQ：2763994904
Name：陌屿云加密系统
*/
@header('Content-Type: text/html; charset=UTF-8');
include("../includes/common.php");
$mod='blank';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $conf['description']?>">
    <meta name="author" content="Mosaddek">
    <meta name="keywords" content="<?php echo $conf['keywords']?>">
    <link rel="shortcut icon" href="../favicon.ico" >

    <title><?php echo $conf['title']?> - 后台管理</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet" />
    <script src="../layer/vsvr/layer.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
      <script src="../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="展开导航栏" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a class="logo">用户<span>中心</span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle tu_zu" href="#">
                            <i class="icon-music"></i>
                        </a>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['zzqq']; ?>&amp;spec=100" style="width: 25px;">
                            <span class="username"><?php echo $conf['user']; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                              <div class="log-arrow-up"></div>
                              <li><a href="set.php"><i class=" icon-suitcase"></i>修改密码</a></li>
                              <li><a href="index.php"><i class="icon-cog"></i>系统帮助</a></li>
                              <li><a href="#"><i class="icon-bell-alt"></i> 最新公告</a></li>
                              <li><a href="./login.php?logout"><i class="icon-key"></i> 安全退出</a></li>
                          </ul>
                      </li>                
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="./">
                          <i class="icon-laptop"></i>
                          <span>首页</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-cog"></i>
                          <span>网站管理</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="set.php">网站设置</a></li>
                      </a>
                  </li>
              </ul><li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-user"></i>
                          <span>代理管理</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="./dllist.php">用户管理</a></li>                                                                 
                      </ul>
                  </li>
				  <li>                    
                      <a class="" href="notice.php" >
                          <i class="icon-th"></i>
                          <span>网站公告</span>
                      </a>

                  <li>
                      <a  href="login.php?logout">
                          <i class="icon-key"></i>
                          <span>安全退出</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!-- Modal_Extension -->
<?php 
include "foot.php";
?>
  