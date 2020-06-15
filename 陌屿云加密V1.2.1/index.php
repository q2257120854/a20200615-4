<?php
@header('Content-Type: text/html; charset=UTF-8');
include("./includes/common.php");
$title="正版查询";
if($conf['repair']==0){
	sysmsg("<h3>授权站更新维护中</h3></br><h3>源码不影响使用站点维护</h3></br><h3>授权站恢复静等通知谢谢合作</h3></br><h3>如果您有如何疑问请联系QQ <a href='http://wpa.qq.com/msgrd?v=3&uin=2763994904&site=qq&menu=yes'> 2763994904 </a><h3>");
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $conf['title']?> -  <?php echo $title ?></title>
<link rel="icon" href="./assets/LightYear/favicon.ico" type="image/ico">
<meta name="keywords" content="<?php echo $_POST['keywords']; ?>"/>
<meta name="description" content="<?php echo $conf['description']?>">
<meta name="author" content="yinqi">
<link href="./assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="./assets/LightYear/css/style.min.css" rel="stylesheet">
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
</head>
<body>
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">
      
      <!-- logo -->
      <div id="logo" class="sidebar-header">
        <a href="index.php"><img src="./assets/LightYear/images/logo.png" title="LightYear" alt="LightYear" /></a>
      </div>
      <div class="lyear-layout-sidebar-scroll"> 
        
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
            <li class="nav-item active"> 
            <a href="index.php">
            <i class="mdi mdi-home"></i> 首页</a> 
            </li>
            <li class="nav-item"> 
            <a href="javascript:void(0)" onclick="dail()">
            <i class="mdi mdi-account"></i> 代理查询</a> 
            </li>
            <li class="nav-item"> 
            <a href="downfile.php">
            <i class="mdi mdi-arrow-down-bold"></i> 源码下载</a> 
            </li>
            <li class="nav-item"> 
            <a href="./User/">
            <i class="mdi mdi-account-settings-variant"></i> 管理登陆</a> 
            </li>
          </ul>
        </nav>
        
        <div class="sidebar-footer">
          <p class="copyright">Copyright &copy; 2019. <a target="_blank" href="">陌屿加密系统</a></p>
        </div>
      </div>
      
    </aside>
    <!--End 左侧导航-->
    
    <!--头部信息-->
    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"> 后台首页 </span>
          </div>
          
          <ul class="topbar-right">
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <span>联系客服 <span class="caret"></span></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li> <a href="javascript:void(0)"><i class="mdi mdi-delete"></i> 清空缓存</a></li>
                <li class="divider"></li>
                <li> <a href="javascript:logout()"><i class="mdi mdi-comment-outline"></i> 联系客服</a> </li>
              </ul>
            </li>
    
          </ul>
          
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<ul class="nav nav-tabs page-tabs">
<li class="active"> <a href="#!">正版查询</a> </li>
<li> <a href="javascript:void(0)" onclick="dail()">代理查询</a> </li>
<li> <a href="downfile.php">源码下载</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
<div>
<div class="form-group">
<label for="type">查询系统</label>
<div class="form-controls">
 <select name="qqjump" class="form-control">
<option value="1">陌屿云加密</option>
</select>
</div>
</div>
<div class="form-group">
<label for="web_site_title">输入域名</label>
<input type="text" id="url" name="url" class="form-control" lay-verType="tips" placeholder="请输入授权时所填写的域名" required/></div>
<hr/>
<button type="submit" onclick="check()" class="btn btn-primary btn-block">点击查询</button>
<hr/>
<?php
echo '<div class="well">'.$conf['uplog'].'</div>';
?>
</div>
</div>    
</div>
</div>
<script src="/assets/LightYear/layui.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/main.min.js"></script>
</body>
</html>