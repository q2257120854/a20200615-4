<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WEB_NAME; ?> - 3秒钟部署你的快捷支付通道!</title>
    <link href="/static/home/css/public.css" rel="stylesheet" />
    <link href="/static/home/css/Login.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/home/css/layui.css">
    <script src="/static/home/js/jquery-1.11.1.js"></script>
    <script src="/static/home/js/layui.js"></script>
    <script src="/static/home/js/jquery.cookie.js"></script>
      <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/jquery-1.9.1.js\"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/jquery.slideunlock.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/common.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/WdatePicker.js"></script>
    <style>
        .login_box input[type=text],.login_box input[type=password]{
            margin: 10px 0;
        }
        .loginHead .signin_btn:hover{
            border: 1px solid #587ffd; 
        }
    </style>


<body>
    <div class="head loginHead">
        <div class="head_c_w">
            <div class="logo"></div>
            <ul class="clear-a">
                <li class="a_btn signin_btn">
                    <a href="<?php echo url::s("index/user/register"); ?>"><span>注册</span></a>
                </li>
                <li class="login_btn">
                    <a href="<?php echo url::s("index/user/login"); ?>"><span>登录</span></a>
                </li>
            </ul>
        </div>
        
    </div>


    <div class="login_warp clear-a">
        <div class="loginBanner clear-a">
            <!-- <div class="loginBanner_mask"></div> -->
            <div class="loginBanner_content clear-a">
                <div class="loginBanner_text fl">
                    <p class="loginBanner_text_p1"><strong>老王支付</strong><span></span>您的贴身管家</p>
                    <p class="loginBanner_text_p2">优质的服务 &nbsp 账单一目了然 &nbsp 安全和高效</p>
                    <a href="<?php echo url::s("index/user/register"); ?>" class="sbm">我要注册</a>
                </div>
                <div class="login_box fr">
                    <h4>登录</h4>
                    <div>
                    <form id="loginForm" name="loginForm" action="<?php echo url::s('index/user/dologin');?>" method="post">
                    <label>
                        <input type="text" class="input_box" name="member_id" id="member_id" placeholder="请你输入用户名或邮箱"/>
                    </label>
                    <label>
                        <input type="password" name="pwd" id="pwd" placeholder="请你输入密码"/>
                    </label>
                    <label class="ckbox">
                        <input type="checkbox" class="ck" />
                        <span class="ck_font">记住密码</span>
                    </label>
                    <label>
                        <button id="loginBtn" class="sbm_btn login_btn_sbm">登录</button>
                    </label>
                    <div>
                       </form>
                        <div class="hr"></div>
                        <a onclick="tishi()" class="login_a">忘记密码？</a>
                    </div>
            
                    </div>
                </div>
            </div>
        </div>
        <div class="login_content">
            <div class="introduce_box">
                <div class="introduce1 clear-a">
                    <div class="introduce_width">
                        <ul class="clear-a">
                            <li class="efficient_box">
                                <div></div>
                                <h6>更高效</h6>
                                <p>金额快速到账</p>
                                <p>一键快速支付</p>
                            </li>
                            <li class="safety_box">
                                <div></div>
                                <h6>更安全</h6>
                                <p>用户支付账单</p>
                                <p>实时一目了然</p>
                            </li>
                            <li class="intimate_box">
                                <div></div>
                                <h6>更贴心</h6>
                                <p>资深大客户经理</p>
                                <p>一对一服务</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="introduce2 clear-a">
                    <div class="introduce_width">
                        <ul class="clear-a">
                            <li class="introduce2_left">
                                <h5>老王支付为您保驾护航</h5>
                                <p>一款专为个人和企业服务的产品，让在线交易更快，更简单！一次对接，全渠道聚合，多场景支持。</p>
                            </li>
                            <li class="introduce2_right">
                                <div>
                                    <p>提现报表：</p>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="introduce3">
                    <div class="introduce_width clear-a">
                        <ul>
                            <li><h5>选择老王支付的理由</h5></li>
                            <li>
                                <span><strong>15+</strong>万</span><span><strong>30+</strong>万</span>
                            </li>
                            <li><span>新用户</span><span>日成交额</span></li>
                            <li><p>一个账号，即可拥有无上限资金,无论是企业或个人将为你带来更强大、更安全可靠的储备金。</p></li>
                        </ul>
                    </div>
                    
                </div>
                <div class="introduce4">
                    <div class="introduce_width">
                        <h5>丰富的交易通道</h5>
                        <ul class="clear-a">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="introduce5">
                    <div class="introduce_width">
                        <ul>
                            <li><p><strong>携手共赢</strong></p></li>
                            <li><p>方便您的生活，为您提供优质的服务</p></li>
                            <li><p>是老王支付支付的初衷</p></li>
                            <li><a href="/index/user/register.do">立即注册</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="login_foot">
        <div>
            <ul class="clear-a">
                <li>关于</li>
                <li>|</li>
                <li>帮助</li>
               
            </ul>
            <div class="foot_lineae"></div>
            <p>隔壁老王 Copyright 2018-2019 Laowang All Rights Reserved</p>  
        </div>
    </div>

</body>
  
  <script >function tishi(){alert("请联系客服：846865108")}</script>
  <!-- jQuery Library -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>
<!--materialize js-->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/materialize.min.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--sweetalert -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
<script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>
</html>