<?php
include("./includes/common.php");
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">

<title><?php echo $conf['web_name']?> - 行业领先的免签约支付平台</title>
<meta name="keywords" content="行业领先的免签约支付平台">
<meta name="description" content="行业领先的免签约支付平台">
<link rel="stylesheet" type="text/css" href="assets/zhuolin_xinshouye/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/zhuolin_xinshouye/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/zhuolin_xinshouye/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/zhuolin_xinshouye/css/style.css">
</head>

<body>
<nav id="mainNav" class="navbar navbar-default navbar-full">
    <div class="container container-nav">
        <div class="navbar-header">
            <button aria-expanded="false" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="index.html">
                <img class="logo" src="assets/zhuolin_xinshouye/images/logo.png" alt="Hostino">
            </a>
        </div>
        <div style="height: 1px;" role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">
             <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">首页</a></li>
                                <li class="dropdown">
                </li>
                <li><a href="/SDK">在线测试</a></li>
                <li><a class="signin-button" href="doc.html">帮助文档</a></li>
                <li><a class="chat-button" href="user">商户中心</a></li>
            </ul>
        </div>
    </div>
</nav>
<div id="top-content" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="main-slider">
                                    <div class="slide info-slide1" title="Features">
                        <div class="image-holder"><img src="assets/zhuolin_xinshouye/images/main-slide-img1.png" alt=""></div>
                        <div class="text-holder">易支付<br>
给你全新一代的支付体验！</div>
                        <div class="button-holder"><a href="user/login.php" class="blue-button">马上登陆</a></div>
                    </div>
                    <div class="slide domainsearch-slide" title="Welcome ">
                        <div class="image-holder"><img src="assets/zhuolin_xinshouye/images/bg1.png" alt=""></div>
                        <div class="b-title">独家的开发文档，开发全过程！<br>
极致高超的防御技巧！</div>
                        <div class="domain-search-holder">
                            <form id="domain-search">

                        <div class="button-holder"><a href="doc.html" class="blue-button">开发文档</a></div>
                            </form>
                        </div>
                    </div>
                    <div class="slide info-slide2" title="Get started">
                        <div class="image-holder"><img src="assets/zhuolin_xinshouye/images/main-slide-img2.png" alt=""></div>
                        <div class="text-holder">强大的云端API接口服务<br>
极速快捷提现，服务态度极好的平台！</div>
                        <div class="button-holder"><a href="user/reg.php" class="blue-button">申请商户</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="info" class="container-fluid">
    <canvas id="infobg" data-paper-resize="true"></canvas>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">独家集成SDK官方文档
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info-text"><?php echo $conf['web_name']?>对接文档下载，ZIP内含多种对接文档，里面有详细说明，修改完成后，上传直接替换覆盖即可！</div>
                
                <a href="xiazai.html" class="white-green-shadow-button">下载文档</a>
            </div>
        </div>
    </div>
</div>
<div id="features" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">我想这些是你们都喜欢的！</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/clouds-light.png" alt=""></div>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="mfeature-title">自动秒结算</div>
                    <div class="mfeature-details">我们采用每天24小时自动结算，T+1结算方式！</div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="mfeature-box active">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/clouds-light.png" alt=""></div>
                        <i class="fa fa-ticket"></i>
                    </div>
                    <div class="mfeature-title">更多优惠活动</div>
                    <div class="mfeature-details">不定时发放福利，红包等多种福利活动！</div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/clouds-light.png" alt=""></div>
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <div class="mfeature-title">专业的技术人员</div>
                    <div class="mfeature-details">我们有专业的技术人员，可以帮助各位解决多种问题！</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a class="light-blue-button" href="#">赞助我们</a>
            </div>
        </div>    
    </div>
</div>

            
        
    

<div id="apps" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title" title="One-Click Install">我们目前为您提供以下支付服务！</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="apps-holder">
                    <div class="apps-links-holder">
                        <div class="app-icon-holder app-icon-holder1 opened" data-id="1">
                            <div class="app-icon"><img src="assets/zhuolin_xinshouye/images/wordpress.png" alt="wordpress"></div>
                            <div class="app-title">QQ支付</div>
                        </div>
                        <div class="app-icon-holder app-icon-holder2" data-id="2">
                            <div class="app-icon"><img src="assets/zhuolin_xinshouye/images/joomla.png" alt="joomla"></div>
                            <div class="app-title">微信支付</div>
                        </div>
                        <div class="app-icon-holder app-icon-holder3" data-id="3">
                            <div class="app-icon"><img src="assets/zhuolin_xinshouye/images/drupal.png" alt="drupal"></div>
                            <div class="app-title">支付宝</div>
                        </div>
                        <div class="app-icon-holder app-icon-holder4" data-id="4">
                            <div class="app-icon"><img src="assets/zhuolin_xinshouye/images/magento.png" alt="magento"></div>
                            <div class="app-title">财付通</div>
                        </div>
                    </div>
                    <div class="apps-details-holder">
                        <div class="app-details">
                            <div class="app-details1 show-details">
                                <div class="app-title">腾讯QQ支付 免签约服务</div>
                                <div class="app-text">我们的平台支持QQ支付，官方正品授权商！QQ支付，给你不一样的体验！赞助商-腾讯QQ</div>
                            </div>
                            <div class="app-details2">
                                <div class="app-title">微信支付 免签约支付服务</div>
                                <div class="app-text">我们的平台支持微信支付，并且支持微信H5跳转支付！微信支付，给你不一样的体验！赞助商-微信支付</div>
                            </div>
                            <div class="app-details3">
                                <div class="app-title">支付宝 免签约支付服务！</div>
                                <div class="app-text">我们的平台支持支付宝支付，官方正品授权商！支付宝，托依付！赞助商-支付宝.</div>
                            </div>
                            <div class="app-details4">
                                <div class="app-title">财付通 免签约支付服务！</div>
                                <div class="app-text">我们的平台支持财付通快捷支付和银联支付，官方正品授权！.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="testimonials" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row-title" title="Testimonials">一群富有朝气的青年</div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div id="testimonials-slider">
                    <div>
                        <div class="details-holder">
                            <img class="photo" src="https://q.qlogo.cn/g?b=qq&nk=319773591&s=100" alt="">
                            <h4>平台负责人</h4>
                            <h5>联系邮箱：<a href="mailto:319773591@qq.com" class="319773591@qq.com" data-cfemail="4223262f2b2c02242329232e6c212c">[319773591@qq.com]</a></h5>
                            <p>负责支付平台总控，远维！名副其实的帅比，也是一个称职的青年！</p>
                        </div>
                    </div>
                    <div>
                        <div class="details-holder">
                            <img class="photo" src="https://q.qlogo.cn/g?b=qq&nk=319773591&s=100" alt="">
                            <h4>平台客服[实习]</h4>
                            <h5>联系邮箱：<a href="mailto:319773591@qq.com" class="319773591@qq.com" data-cfemail="40727575737470707872740031316e232f2d">[319773591@qq.com]</a></h5>
                            <p>负责<?php echo $conf['web_name']?>客服服务，同样也是一个美丽的小姐姐！一个比较负责的青年。ớ ₃ờ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="more-features" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title" title="Great features">你为什么会选择我们的服务？</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature1.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">全球99.9% 覆盖率</div>
                    <div class="mfeature-details">服务器节点覆盖99.9%</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature2.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">自动监控</div>
                    <div class="mfeature-details">平台采用独家监控宝，每天24小时无漏点监控！</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature3.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">解决方案</div>
                    <div class="mfeature-details">我们有多种解决方案，帮助用户解决各种困难！</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature4.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">快速查询</div>
                    <div class="mfeature-details">平台快捷查询订单等多种，你想要的信息！</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature5.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">全新界面</div>
                    <div class="mfeature-details"><?php echo $conf['web_name']?>来啦，商户平台全新升级，一种全新的使用体验！</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <div class="icon-bg"><img src="assets/zhuolin_xinshouye/images/cloud-light.png" alt=""></div>
                        <div class="icon-img"><img src="assets/zhuolin_xinshouye/images/feature6.png" alt=""></div>
                    </div>
                    <div class="mfeature-title">资金回笼</div>
                    <div class="mfeature-details">支付平台商户资金每天24H自动结算，快捷到账！无需担心结算问题！</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="bluebg-info" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text">你还在等什么，加入我们吧！<br>
Come and join us.</div>
                <a href="" class="white-button">加入Q群</a>
            </div>
        </div>
    </div>
</div>
<div id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="footer-menu-holder">
                    <h4>网站首页</h4>
                    <ul class="footer-menu">
                        <li><a href="SDK">在线测试</a></li>
                        <li><a href="xiazai.html">文档下载</a></li>
                        <li><a href="doc.html">开发文档</a></li>
                        <li><a href="user">商户中心</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="footer-menu-holder">
                    <h4>产品中心</h4>
                    <ul class="footer-menu">
                        <li><a href="//izhuolin.cn/">卓林源码销售</a></li>
                        <li><a href="//mz.izhuolin.cn/">卓林秒赞</a></li>
                        <li><a href="./">暂无添加</a></li>
                        <li><a href="./">暂无添加</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="footer-menu-holder">
                    <h4>友情链接</h4>
                    <ul class="footer-menu">
                        <li><a href="">官方QQ群</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="address-holder">
                    <div class="phone"><i class="fa fa-phone"></i>＋086 - 1777 - 9889 - 705</div>
                    <div class="email"><i class="fa fa-envelope"></i> <a href="mailto:zpay@izhuolin.cn" class="zpay@izhuolin.cn" data-cfemail="5233363f3b3c12343339333e7c313c">[zpay@izhuolin.cn]</a></div>
                    <div class="address">
                        <i class="fa fa-map-marker"></i> 
                        <div>晓超云博客</div>
                        </div>
                    </div>
                </div>
            </div>
            Copyright 2017 - 2018 © 晓超云博客 All rights reserved. 
         </div>
            <a href="https://www.miitbeian.gov.cn/">陕ICP备18003512号</a>
                    </div>
                </div>
            
        
        
        
    

<script data-cfasync="false" src="assets/zhuolin_xinshouye/js/email-decode.min.js"></script><script src="assets/zhuolin_xinshouye/js/jquery.min.js"></script>
<script src="assets/zhuolin_xinshouye/js/bootstrap.min.js"></script>
<script src="assets/zhuolin_xinshouye/js/slick.min.js"></script>
<script src="assets/zhuolin_xinshouye/js/paper-full.min.js"></script>
<script type="text/paperscript" src="assets/zhuolin_xinshouye/js/metaball.js" data-paper-canvas="infobg"></script>
<script src="assets/zhuolin_xinshouye/js/main.js"></script>
</body>
</html>
