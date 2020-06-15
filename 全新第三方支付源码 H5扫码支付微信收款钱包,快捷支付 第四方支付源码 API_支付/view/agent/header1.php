<!doctype html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>
            <?php echo isset($title) ? $title. '-' : '' ?>
                <?php echo $this->config['sitename']?>
        </title>
        <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/static/agent/app.css" type="text/css" rel="stylesheet">
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
        <section class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-8 logo">
                        <a href="/agent">
                            <img src="/static/default/images/tlogo.png">
                            &nbsp;&nbsp;
                            <span class="label label-danger">
                                代理中心
                            </span>
                        </a>
                    </div>
                    <div class="col-md-9 col-sm-6 col-xs-4 login-info">
                        <div class="dropdown hidden-xs hidden-sm" style="float:right">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user">
                                </span>
                                &nbsp;
                                <?php echo $_SESSION[ 'login_agentname']?>
                                    ，已登录&nbsp;
                                    <span class="caret">
                                    </span>
                            </a>
                            &nbsp;&nbsp;
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/agent/userinfo">
                                        <span class="glyphicon glyphicon-user">
                                        </span>
                                        &nbsp;代理资料
                                    </a>
                                </li>
                                <li>
                                    <a href="/agent/userpwd">
                                        <span class="glyphicon glyphicon-lock">
                                        </span>
                                        &nbsp;修改密码
                                    </a>
                                </li>
                                <li>
                                    <a href="/agent/userlogs">
                                        <span class="glyphicon glyphicon-time">
                                        </span>
                                        &nbsp;登陆日志
                                    </a>
                                </li>
                                <li role="separator" class="divider">
                                </li>
                                <li>
                                    <a href="/login/logout">
                                        <span class="glyphicon glyphicon-off">
                                        </span>
                                        &nbsp;安全退出
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:;" class="hidden-md hidden-lg" id="dropdownMenu" style="font-size:2em">
                            <span class="glyphicon glyphicon-th-large">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $('#dropdownMenu').click(function() {
                if ($('.main-content .left ul.nav').is(':visible')) {
                    $('.main-content .left ul.nav').addClass('hidden-sm hidden-xs').hide();
                } else {
                    $('.main-content .left ul.nav').removeClass('hidden-sm hidden-xs').show();
                }
            });
        </script>
        <?php $current=isset($this->action[1]) ? $this->action[1] : '';?>
            <section class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 left">
                            <ul class="nav hidden-sm hidden-xs">
                                <li<?php echo $current=='' ? ' class="current"' : ''?>
                                    >
                                    <a href="/agent">
                                        <span class="glyphicon glyphicon-home">
                                        </span>
                                        &nbsp;代理首页
                                    </a>
                                    </li>
                                    <li<?php echo $current=='userinfo' ? ' class="current"' : ''?>
                                        >
                                        <a href="/agent/userinfo">
                                            <span class="glyphicon glyphicon-user">
                                            </span>
                                            &nbsp;基本资料
                                        </a>
                                        </li>
                                        <li<?php echo $current=='userpwd' ? ' class="current"' : ''?>
                                            >
                                            <a href="/agent/userpwd">
                                                <span class="glyphicon glyphicon-lock">
                                                </span>
                                                &nbsp;修改密码
                                            </a>
                                            </li>
                                            <li<?php echo $current=='users' ? ' class="current"' : ''?>
                                                >
                                                <a href="/agent/users">
                                                    <span class="glyphicon glyphicon-menu-hamburger">
                                                    </span>
                                                    &nbsp;下级用户
                                                </a>
                                                </li>
                                                <li<?php echo $current=='payments' ? ' class="current"' : ''?>
                                                    >
                                                    <a href="/agent/payments">
                                                        <span class="glyphicon glyphicon-check">
                                                        </span>
                                                        &nbsp;结算记录
                                                    </a>
                                                    </li>
                                                    <li<?php echo $current=='orders' ? ' class="current"' : ''?>
                                                        >
                                                        <a href="/agent/orders">
                                                            <span class="glyphicon glyphicon-list">
                                                            </span>
                                                            &nbsp;用户订单
                                                        </a>
                                                        </li>
                                                        <li<?php echo $current=='count' ? ' class="current"' : ''?>
                                                            >
                                                            <a href="/agent/count">
                                                                <span class="glyphicon glyphicon-piggy-bank">
                                                                </span>
                                                                &nbsp;收入统计
                                                            </a>
                                                            </li>
                                                            <li<?php echo $current=='rates' ? ' class="current"' : ''?>
                                                                >
                                                                <a href="/agent/rates">
                                                                    <span class="glyphicon glyphicon-sort">
                                                                    </span>
                                                                    &nbsp;代理费率
                                                                </a>
                                                                </li>
                                                                <li class="hidden-md hidden-lg">
                                                                    <a href="/login/logout">
                                                                        <span class="glyphicon glyphicon-log-out">
                                                                        </span>
                                                                        &nbsp;安全登出
                                                                    </a>
                                                                </li>
                            </ul>
                        </div>