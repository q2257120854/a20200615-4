<!doctype html>
<html lang="zh-CN">
    
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo isset($title) ? $title. '-' : '' ?>
                <?php echo $this->config['sitename']?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
        <meta name="renderer" content="webkit">

		<link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/static/common/css/font-awesome.min.css" rel="stylesheet">
        <link href="/static/member/jquery-ui.css" rel="stylesheet">
        <link href="/static/member/style.css" rel="stylesheet">
		<link href="/static/common/datetimepicker.min.css" type="text/css" rel="stylesheet">
        <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
        </script>
        <script src="/static/common/bootstrap.min.js" type="text/javascript">
        </script>
        <script src="/static/common/jquery.zclip.min.js" type="text/javascript">
        </script>
        <script src="/static/common/datetimepicker.min.js" type="text/javascript">
        </script>
        <script src="/static/member/app.js" type="text/javascript">
        </script>
		
    </head>
    
    <body>
	<div style="position:absolute;left:40%">
            <div class="woody-prompt">
                <div class="prompt-error alert alert-danger">
                </div>
            </div>
        </div>
	
        <div class="pace pace-inactive">
            <div class="pace-progress1" data-progress-text="100%" data-progress="99"
            style="transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner">
                </div>
            </div>
            <div class="pace-activity">
            </div>
        </div>
        <style type="text/css">
            .navbar-default .nav li{ border-top: 1px solid #37414b; border-bottom:
            1px solid #1f262d; border-left: 4px solid #2f4050;} .navbar-default .nav
            li a{ padding: 10px 45px; } .navbar-default .nav li a .fa { width: 1.2em;
            color: inherit; font-size: 14px; } .navbar-default .nav-heading{ padding:
            10px 25px; color: #A7B1C2; } .navbar-default .nav li:hover, .navbar-default
            .nav li:focus{ border-left: 4px solid #293846; } .navbar-default .nav li.active{
            border-left: 0; } .navbar-default .nav li.active a{ border-left: 4px solid
            #19aa8d; } .navbar-default .nav li.nav-heading:hover, .navbar-default .nav
            li.nav-heading:focus { border-left: 4px solid #2F4050; } body.mini-navbar
            .navbar-default .nav li.nav-heading{ display: none; } body.mini-navbar
            .navbar-static-side { width: 100px; } body.mini-navbar #page-wrapper { margin:
            0 0 0 100px;box-shadow: 4px 4px 4px #ddd;}
        </style>

        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
					 <?php $current=isset($this->action[1]) ? $this->action[1] : '';?>
                        <li class="nav-header">
                            <div class="dropdown profile-element text-center">
                                <span>
                                  <img alt="image"  src="/images/agentlogo.png">
                          
                                </span>
                            </div>
                            <div class="logo-element">
                               代理中心
                            </div>
                        </li> 




       

                                <li<?php echo $current=='' ? ' class="active"' : ''?>
                                    >
                                    <a href="/agent">
                                        <span class="glyphicon glyphicon-home">
                                        </span>
                                        &nbsp;代理首页
                                    </a>
                                    </li>
                                    <li<?php echo $current=='userinfo' ? ' class="active"' : ''?>
                                        >
                                        <a href="/agent/userinfo">
                                            <span class="glyphicon glyphicon-user">
                                            </span>
                                            &nbsp;基本资料
                                        </a>
                                        </li>
                                        <li<?php echo $current=='userpwd' ? ' class="active"' : ''?>
                                            >
                                            <a href="/agent/userpwd">
                                                <span class="glyphicon glyphicon-lock">
                                                </span>
                                                &nbsp;修改密码
                                            </a>
                                            </li>
                                            <li<?php echo $current=='users' ? ' class="active"' : ''?>
                                                >
                                                <a href="/agent/users">
                                                    <span class="glyphicon glyphicon-menu-hamburger">
                                                    </span>
                                                    &nbsp;下级用户
                                                </a>
                                                </li>
                                                <li<?php echo $current=='payments' ? ' class="active"' : ''?>
                                                    >
                                                    <a href="/agent/payments">
                                                        <span class="glyphicon glyphicon-check">
                                                        </span>
                                                        &nbsp;结算记录
                                                    </a>
                                                    </li>
                                                    <li<?php echo $current=='orders' ? ' class="active"' : ''?>
                                                        >
                                                        <a href="/agent/orders">
                                                            <span class="glyphicon glyphicon-list">
                                                            </span>
                                                            &nbsp;用户订单
                                                        </a>
                                                        </li>
                                                        <li<?php echo $current=='count' ? ' class="active"' : ''?>
                                                            >
                                                            <a href="/agent/count">
                                                                <span class="glyphicon glyphicon-piggy-bank">
                                                                </span>
                                                                &nbsp;收入统计
                                                            </a>
                                                            </li>
                                                            <li<?php echo $current=='rates' ? ' class="active"' : ''?>>
                                                                <a href="/agent/rates">
                                                                    <span class="glyphicon glyphicon-sort">
                                                                    </span>
                                                                    &nbsp;代理费率
                                                                </a>
                                                                </li>
																<li<?php echo $current=='userlogs' ? ' class="active"' : ''?>>
                                                        <a href="/agent/userlogs">
                                                            <span class="glyphicon glyphicon-list">
                                                            </span>
                                                            &nbsp;登录日志
                                                        </a>
                                                        </li>
														  <li<?php echo $current=='logout' ? ' class="active"' : ''?>
                                                                >
                                                                <a href="/login/logout">
                                                                    <span class="glyphicon glyphicon-sort">
                                                                    </span>
                                                                    &nbsp;安全退出
                                                                </a>
                                                                </li>







                                                                              
                    </ul>
                </div>
            </nav>
<div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);">
                                <i class="fa fa-bars">
                                </i>&nbsp;<?php echo $this->config['sitename']?>代理中心   代理商： <?php echo $_SESSION[ 'login_agentname']?>
                            </a>
                        </div>
                      
						
				

                    </nav>
                </div>
