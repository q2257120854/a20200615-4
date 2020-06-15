
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<meta name="renderer" content="webkit">
<title> <?php echo isset($title) ? $title. '-' : '' ?>
                <?php echo $this->config['sitename']?></title>
<!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
<link rel="shortcut icon" href="favicon.ico">
		<link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/static/common/css/font-awesome.min.css" rel="stylesheet">
        <link href="/static/member/jquery-ui.css" rel="stylesheet">
        <link href="/static/member/style.css" rel="stylesheet">
        <link href="/static/member/amazeui.min.css" rel="stylesheet">
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
<body class="full-height-layout gray-bg">


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

        <?php $current=isset($this->action[1]) ? $this->action[1] : '';?>
       <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
					                         <li class="nav-header">
                            <div class="dropdown profile-element text-center">
                                <span>
 <img alt="image" class="img-circle" src="/static/member/images/logo.png" style="width:120px;height:120px;border-radius:12px;">
                           <!--   -->
                                </span><br>
								<span class="clear">
                        <strong class="font-bold" style="color:#ffFFFF;"><?php echo  $_SESSION[ 'login_username'];?><br>(ID：<?php echo $_SESSION[ 'login_userid']?>)</strong>
                    </span>
                  

                            </div>
                            <div class="logo-element">
                             商户后台</div>
                        </li>
              <li<?php echo $current=='' ? ' class="active"' : ''?>>
                                    <a href="/member">
                                    <span class="nav-label">
                                    <i class="fa fa-home">
                                    </i>
                                    商户首页
                                </span></a>
								</li>
                                 <li<?php echo $current=='userinfo' ? ' class="active"' : ''?>>
                                        <a href="/member/userinfo">
                                     <span class="nav-label">
                                    <i class="fa fa-newspaper-o">
                                    </i>
                                商户资料
                                </span></a>
                                        </li>
                                       <li<?php echo $current=='userpwd' ? ' class="active"' : ''?>>
                                            <a href="/member/userpwd">
                                                                  <span class="nav-label">
                                    <i class="fa fa-unlock-alt">
                                    </i>
                                              修改密码
                                           </span></a>
                                            </li>
                                              <li<?php echo $current=='payments' ? ' class="active"' : ''?>>
                                                <a href="/member/payments">
                                                     <span class="nav-label">
                                    <i class="fa fa-calendar-check-o">
                                    </i>
                                    结算记录
                                </span>
                            </a>
                                                </li>
                                                 <li<?php echo $current=='orders' ? ' class="active"' : ''?>>
                                                    <a href="/member/orders">
                                                 <span class="nav-label">
										   <i class="fa fa-line-chart">
                                    </i>
												       交易记录
													</span>
														</a>
                                                 <li<?php echo $current=='count' ? ' class="active"' : ''?>>
                                                        <a href="/member/count">
                          
                                                          <span class="nav-label">
												<i class="fa fa-server"></i>
												收益统计
													</span>
														</a>
                                                        </li>
                                                         <li<?php echo $current=='ordersca' ? ' class="active"' : ''?>>
                                                            <a href="/member/ordersca">
                                                                     <span class="nav-label">
                                    <i class="fa fa-calculator">
                                    </i>
                                    通道统计
                                </span></a>
                                                     </li>
                                                            <li<?php echo $current=='takecash' ? ' class="active"' : ''?>>
                                                                    <a href="/member/takecash">
                                                                                        <span class="nav-label">
                                    <i class="fa fa-calendar-check-o">
                                    </i>
                                                                        申请提现
																		</span>
                                                                    </a>
                                                                    </li>
                                                                     <li<?php echo $current=='rates' ? ' class="active"' : ''?>>
                                                                            <a href="/member/rates">
                                                                                                    <span class="nav-label">
																				<i class="fa fa-map-signs">
																				</i>
																				我的费率
																			</span>
																		</a>
                                                                            </li>
                                                                           <li<?php echo $current=='api' ? ' class="active"' : ''?>>
                                                                                <a href="/member/api">
                                                                                                    <span class="nav-label">
																				<i class="fa fa-wrench">
																				</i>
                                                                                   接入信息
                                                                              	</span>
																		</a>
                                                                                </li>
                                                                               <li<?php echo $current=='userlogs' ? ' class="active"' : ''?>>
                                                                                    <a href="/member/userlogs">
                                                                                       <span class="nav-label">
																					<i class="fa fa-building-o">
																					</i>
																					登陆日志
																				</span>
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
                                </i>导航菜单
                            </a>
                        </div>
                      
						
					<ul style="margin-top:20px;margin-right:20px;text-align:right;"> <li class="layui-nav-item"> 
                               &nbsp; &nbsp; 
                                <span class="glyphicon glyphicon-user">
                                </span>
                                
                               <?php echo isset($title) ? $title. '' : '' ?>&nbsp;
                                    <i class="fa fa-sign-out">
                                    </i>
                                    <a href="/login/logout" style="text-decoration:none;">安全退出</a>
								
                            </a>
                                   
                        
                            </li>
                           
                        </ul>


                    </nav>
                </div>
