<?php
@header('Content-Type: text/html; charset=UTF-8');
include("./includes/common.php");
$title="源码下载";
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
<?php
if(isset($_GET['url'])) {
$url=daddslashes($_GET['url']);
$qq=daddslashes($_GET['qq']);
$authcode=daddslashes($_GET['authcode']);
$row1=$DB->get_row("SELECT * FROM auth_site WHERE url='{$url}' limit 1");
$row2=$DB->get_row("SELECT * FROM auth_site WHERE uid='{$qq}' order by id desc limit 1");
$row3=$DB->get_row("SELECT * FROM auth_site WHERE authcode='{$authcode}' limit 1");
if($row1=='')exit("<script language='javascript'>alert('授权平台不存在该域名！');history.go(-1);</script>");
if($row2=='')exit("<script language='javascript'>alert('授权平台不存在该QQ！');history.go(-1);</script>");
if($row3=='')exit("<script language='javascript'>alert('授权平台不存在授权码！');history.go(-1);</script>");
if($row1['active']==0)exit("<script language='javascript'>alert('此域名授权已被封禁！');history.go(-1);</script>");
$authcode=$row1['authcode'];
$uid=$row1['uid'];
$sign=$row1['sign'];
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>源码下载</h4>
</div>
<div class="card-body">
<li class="list-group-item"><span class="fa fa-qq"></span> <b>授权ＱＱ：</b> <b>  <?=$uid?></b></li>
<li class="list-group-item"><span class="fa fa-cloud"></span> <b>授权域名：</b> <b>  <?=$url?></b></li>
<li class="list-group-item"><span class="fa fa-heart"></span> <b>授权代码：</b> <b>  <?=$authcode?></b></li>
<li class="list-group-item"><span class="fa fa-internet-explorer"></span> <b>特征代码：</b> <b>  <?=$sign?></b></li>
<li class="list-group-item"><span class="fa fa-bars"></span> <b>下载类型：</b> 
<a href="./includes/downfile.php?my=installer&authcode=<?=$authcode?>&sign=<?=$sign?>&r=<?=time()?>" class="btn btn-xs btn-success"><?=$name?>安装包</a>&nbsp;
<a href="./includes/downfile.php?my=updater&authcode=<?=$authcode?>&sign=<?=$sign?>&r=<?=time()?>" class="btn btn-xs btn-primary"><?=$name?>更新包</a>
</li>
</ul>
<div class="panel-footer">
<span class="fa fa-volume-down"></span> 新购用户请下载完整安装包！
</div>
</div>

<?php }else{?>

<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<ul class="nav nav-tabs page-tabs"><li> 
<a href="index.php">正版查询</a> </li>
<li> <a href="javascript:void(0)" onclick="dail()">代理查询</a> </li>
<li class="active"> <a href="#!">源码下载</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
<form action="./downfile.php" method="GET" class="form-horizontal" role="form">
	
<div class="form-group">
<label for="web_site_title">授权域名</label>
<input type="text" name="url" value="<?=@$_GET['url']?>" class="form-control" placeholder="授权的域名" autocomplete="off" autofocus="autofocus" required/>
</div>
<div class="form-group">
<label for="web_site_title">授权 Q Q</label>
<input type="text" name="qq" value="<?=@$_GET['qq']?>" class="form-control" placeholder="输入的QQ" autocomplete="off" autofocus="autofocus" required/>
</div>
<div class="form-group">
<label for="web_site_title">授权代码</label>
<input type="text" name="authcode" value="<?=@$_GET['authcode']?>" class="form-control" placeholder="输入授权码" autocomplete="off" autofocus="autofocus" required/>
</div>
<div class="form-group">
<button type="submit" id="check" class="btn btn-effect-ripple btn-primary">获取</button>
</div>
</div>
</form>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>使用教程</h4>
</div>
<div class="card-body">
</p>
1、如果需要全新搭建或之前未搭建过，请下载完整安装包；如果之前搭建过，请下载更新包直接覆盖，数据不会丢失。</p>
2、输入您的购买授权的QQ来获取下载即可，通过验证后即可下载更新包&安装包，或者你也可以联系客服获取源码。</p>
</div>
</div>
</div>

<?php }?>
<script src="/assets/LightYear/layui.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="./assets/LightYear/js/main.min.js"></script>
</body>
</html>