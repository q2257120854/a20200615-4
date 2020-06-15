<?php
@header('Content-Type: text/html; charset=UTF-8');
if($userrow['active']==0){
	sysmsg('由于你的商户违反相关法律法规与《'.$conf['web_name'].'用户协议》，已被禁用！');
}

$orders=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}")->fetchColumn();
$order_today['all']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today'")->fetchColumn();
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title><?php echo $title?> | <?php echo $conf['web_name']?></title>
 <link rel="shortcut icon" href="http://cctsz.cn/222.png">
<!-- Favicon-->
<link  rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Morris Chart Css-->
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/css/ecommerce.css">

<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">


<body class="theme-purple">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="Oreo"></div>
        <p>加载中...</p>        
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><span class="m-l-10"><?php echo $conf['web_name']?></span></a>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li></a>
        </li>
        <li class="hidden-sm-down">
            <div class="input-group">                
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-search"></i>
                </span>
            </div>
        </li>        
        <li class="float-right">
            <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
            <a href="login.php?logout" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a>
            <a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a>
        </li>
    </ul>
</nav>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home m-r-5"></i>主页</a></li>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#user"><i class="zmdi zmdi-account m-r-5"></i>我的</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight" id="dashboard">
            <div class="menu">
                <ul class="list">                    
                    <li class="header">home</li>
                    <li> <a href="index.php"><i class="zmdi zmdi-home"></i><span>商户中心</span></a>
                        
                    </li>
                    
                    
                    
                    <li class="header">导航</li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>账户安全</span> </a>
                        <ul class="ml-menu">
                            <li><a href="userinfo.php">修改资料</a> </li>
                            <li><a href="verification.php" onclick="alert('暂未开放');return false;">验证信息</a> </li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>消息公告</span> </a>
                        <ul class="ml-menu">                        
                            <li><a href="verification.php" onclick="alert('暂未开放');return false;">站内消息</a> </li>
                        </ul>
                    </li>            
                    
                    <li class="header">query</li>                    
                    <li> <a href="order.php"><i class="zmdi zmdi-assignment"></i><span>订单查询</span></a></li>
                    <li> <a href="settle.php"><i class="zmdi zmdi-lock"></i><span>结算查询</span></a></li>
                    <li> <a href="chajian.php"><i class="zmdi zmdi-archive"></i><span>插件下载</span></a></li>
                    <li class="header">帮助</li>
					<li> <a href="help.php"><i class="zmdi zmdi-assignment"></i><span>使用说明</span></a></li>
                    <li> <a href=""><i class="zmdi zmdi-lock"></i><span>加入QQ群</span></a></li>
                    <li>
                        <div class="progress-container progress-primary m-t-10">
                            <span class="progress-badge">Traffic this Month</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                                    <span class="progress-value">67%</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-container progress-info">
                            <span class="progress-badge">Server Load</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                    <span class="progress-value">86%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-pane stretchLeft active" id="user">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info m-b-20 p-b-15">
                            <div class="image"><a href="profile.html"><img src="<?php echo ($userrow['qq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/images/profile_av.jpg'?>"></a></div>
                            <div class="detail">
                                <h4><?php echo $pid?></h4>
                                <small><?php echo $userrow['username']?></small>                        
                            </div>
                            
                            <p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                            
                        </div>
                    </li>
                    <li>
                        <small class="text-muted">邮箱: </small>
                        <p><?php echo $userrow['email']?></p>
                        <hr>
						<small class="text-muted">名称: </small>
                        <p><?php echo $userrow['username']?></p>
                        <hr>
                        <small class="text-muted">电话: </small>
                        <p><?php echo $userrow['phone']?></p>
                        <hr>                 
                    </li>
                </ul>
            </div>
        </div>
    </div>    
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane slideRight active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>颜色</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple" class="active">
                            <div class="purple"></div>
                        </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>                    
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>                    
                        </li>
                    </ul>                    
                </div>
                <div class="card theme-light-dark">
                    <h6>左菜单</h6>
                    <button class="t-light btn btn-default btn-simple btn-round btn-block">Light</button>
                    <button class="t-dark btn btn-default btn-round btn-block">Dark</button>
					<button class="m_img_btn btn btn-primary btn-round btn-block">Sidebar Image</button>
                </div>                
            </div>                
        </div>       
    </div>
</aside>