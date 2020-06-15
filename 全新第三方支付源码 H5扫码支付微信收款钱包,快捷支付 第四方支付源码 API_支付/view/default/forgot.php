<?php if(!defined( 'WY_ROOT'))exit; ?>
<!doctype html>
<html>
<head>
<meta name="description" content="<?php echo $this->config['description']?>">
<meta name="keywords" content="<?php echo $this->config['keyword']?>">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<!-- 启用360浏览器的极速模式(webkit) -->
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
<meta name="HandheldFriendly" content="true">
<!-- 微软的老式浏览器 -->
<meta name="MobileOptimized" content="320">
<!-- uc强制竖屏 -->
<meta name="screen-orientation" content="portrait">
<!-- QQ强制竖屏 -->
<meta name="x5-orientation" content="portrait">
<!-- UC强制全屏 -->
<meta name="full-screen" content="yes">
<!-- QQ强制全屏 -->
<meta name="x5-fullscreen" content="true">
<!-- UC应用模式 -->
<meta name="browsermode" content="application">
<!-- QQ应用模式 -->
<meta name="x5-page-mode" content="app">
<!--这meta的作用就是删除默认的苹果工具栏和菜单栏-->
<meta name="apple-mobile-web-app-capable" content="yes">
<!--网站开启对web app程序的支持-->
<meta name="apple-touch-fullscreen" content="yes">
<!--在web app应用下状态条（屏幕顶部条）的颜色-->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- windows phone 点击无高光 -->
<meta name="msapplication-tap-highlight" content="no">
<!--移动web页面是否自动探测电话号码-->
<meta http-equiv="x-rim-auto-match" content="none">
 <meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>智通付 - 找回密码</title>
<link rel="stylesheet" href="2018/css/base.css?t=0.0.39">
<link rel="stylesheet" href="2018/css/main.css?t=0.0.39">
<link rel="stylesheet" href="2018/css/video-js.css?t=0.0.39">
<script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
            </script>
            <script src="/static/common/bootstrap.min.js" type="text/javascript">
            </script>
            <script src="/static/default/app.js" type="text/javascript">
            </script>
<script type="text/javascript">
var pageName="index";
var serverTime; // 用于获取服务器时间和本地时间的 差值
var Context = {base : ""};
</script>

</head>
<body class="adaptive">
    <div class="header">
        <div class="container clearfix">
           <h1 class="logo1">
               <a href="/" title="首页"><img src="images/login2_02.png" alt="智通付首页" /></a>  <div class="service"><i class="phone"></i>170-4502-2182</div>
            </h1>
           <!-- <div class="nav">
                <ul>
                
              <li><a target="_blank" href="#">常见问题</a></li>
                
              
                </ul>
            </div> -->
        </div>
    </div>

    
<!-- 全站停服小黄条 -->
<div class="maintain_notice"><div class="container">亲爱的用户：受五一假期影响，您于4月25日至5月1日间发起的提现预计将于5月4日前到账，请提前做好资金安排，感谢您的理解与支持！</div></div>
<!-- 全站停服小黄条 END-->
<style type="text/css">
/*头部小黄条*/
.maintain_notice{display: none;width:100%;height:48px;background-color: #fff4aa;text-align: center;color:#6b6648;line-height: 48px;font-size: 14px;box-shadow: 0px 4px 4px #f2e8a1 inset;}
@media screen and (max-device-width: 600px) {
  .maintain_notice{
    height:auto;
  }
  .maintain_notice > .container{
    line-height: 20px;
    font-size: 12px;
    padding: 5px;
    min-width: auto;
    width: 13.8rem;
  }
}
/*头部小黄条 END*/
</style>


    <div class="h5_act clearfix">
      <h2>智通付商户中心</h2>
      <p>找回商户帐号</p>
    </div>
    <!--banner-->
    <div class="banner" id="bannerPa">
        <div class="banner-inner">
          <div class="bannerBox" id="banner">
            <!--<div class="banner_li attention f-pr">
              
              <div class="cnt">
                <div class="countDown f-pa" id="countDown">
                  <span>最后</span>
                  <span class="count">0</span>
                  <span>天</span>
                  <span class="count">0</span>
                  <span>时</span>
                  <span class="count">0</span>
                  <span>分</span>
                  <span class="count">0</span>
                  <span>秒</span>
                </div>
                <a href="/register/rule.htm" target="_blank" class="actLink f-pa" id="actLink" onclick="_paq.push(['trackEvent','seckill_index_btn']);">了解详情</a>
              </div>
            </div>-->
            <div class="banner_li banner_solgan">
              <div class="slogan_main">
                <h2>用户至上 互利共赢</h2>
                <h1>代收代付｜聚合支付</h1>
                <ul>
                    <li>三方支付通道 灵活选择</li>
                    <li>最快两天提现到账</li>
                    <li>仅手续费无其他费用</li>
					<li>银联自动清分结算</li>
                </ul>
               <!-- <div class="qr">
                    <div class="qrcode"></div>
                    <p>扫码关注微信公众号<br>更多活动第一时间知晓</p>
                </div> -->
              </div>
            </div>
          </div>
            <!--登录框-->
            <div class="login-box">
                <div id="login-box-tit" class="login-box-tit">
                   <span class="select f-f0">找回商户帐号</span>
                <span class="f-f0"><a href="/login" onclick="_paq.push(['trackEvent','h5_go_reg_btn']);" target="_top">商户登陆</a></span>
               </div>
               <div id="msg-tips" class="tips error" >
                   
                 </div>
               <ul id="login-box-con" class="login-box-con">
                   <li class="con">
            <form class="form-ajax" action="/forgot/send" method="post">
                     <ul class="login-form">
                         <li>
                             <input type="text" name="username" size="25" placeholder="请输入正确的商户帐号" maxlength="30" required autocomplete="false"/>
                         </li>
                          <li class="f-cb f-pr">
                             <input type="text" name="email"  size="25"   placeholder="填写注册时填写的邮箱账号" maxlength="30" required>
                         </li>
                         <li class="f-pr">
                             <input   type="text" size="10" name="chkcode" class="vcode" autocomplete="off" maxlength="5" required placeholder="验证码">
							 <div class="code">
                                 <div>
                                     <div>
                                         <img src="/chkcode" title="点击刷新验证码" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'">
										
                                     </div>
                                 </div>
                             </div>
                         </li>
                     </ul>
                     <div class="login-action">
                       <p class="h5_login_action_info">
                         <a href="/register" onclick="_paq.push(['trackEvent','h5_go_reg_btn']);" target="_top">注册智通付商户账户</a> |
                         <a href="/forgot" onclick="_paq.push(['trackEvent','h5_go_forget_btn']);" target="_top">忘记密码?</a>
                       </p>
						 <button type="submit">找 回 密 码</button>
                         <p><a tabindex="5" href="/forgot" onclick="_paq.push(['trackEvent','go_forget_btn']);" class="w" target="_top">忘记登录密码?</a>
                         </p>
                     </div>
                   </form>
                   </li>
				   
				   <!--
                 <li class="con">
                     <form action="/register/save" method="post">
        	                <ul class="registerForm clearfix">
        	                        <li class="row">
        	                            <input type="text" name="email" class="text" autocomplete="new-password" maxlength=30" placeholder="请输入正确的电子邮箱,接收激活邮件">
        	                        </li>
        	                        
        	                        <li class="f-pr">
                                        <input type="text" name="chkcode" maxlength="5" class="vcode" placeholder="验证码" size="10">
                                        <div id="code_tip" class="x-tip"></div>
                                        <div class="code fr">
                                              <div>
                                                  <div>
                                                      <img src="/chkcode" title="点击刷新验证码" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'">
                                                  </div>
                                              </div>
                                          </div>
                                    </li>
                                
        	                </ul>
        	                <div class="reg-action-bar">
        						    <div class="actions">     	                     
									<button type="submit" class="button">激活帐号,立刻注册</button>
            	                     <p class="tks f-cb">
            	                        	<input name="agree" type="checkbox" />
            	                        	我同意<a target="_blank" href="i/merchant_agreement.html" class="uline">智通付商户协议</a>
                                       
                                    </p>
                                   
        	                    </div>
        	                </div>
                        </form>
                   </li> -->
               </ul>

            </div>
            <!--登录框-->
        </div>
    </div>
    <!--banner-->
 <div class="h5_tel">在线客服QQ： <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=965732488&site=qq&menu=yes">965732488</a><br>©2016~2018 智通付 版权所有.<br>工信部备案号：陕ICP备18007495号</div>
    
        <div class="footer">
            <div class="container">
			<div class="footer-slogan">可信赖的支付伙伴</div>

                <div><p class="copy"><a href="javascript:void(0)">京东钱包</a>
        <span>|</span>
       <a href="javascript:void(0)">支付宝</a>
        <span>|</span>
        <a href="javascript:void(0)">网易钱包</a>
        <span>|</span>
        <a href="javascript:void(0)">微信支付</a>
        <span>|</span>
        <a href="javascript:void(0)">QQ钱包</a>
        <span>|</span>
       <a href="javascript:void(0)">百度钱包</a>
        <span>|</span>
        <a href="javascript:void(0)">银联在线</a>
        <span>|</span>
        <a href="i/contact.html" target="_blank">联系我们</a>
</p></div>
                <div><span class="in">权威认证</span>
                            <div class="authenticate">
                                <ul>
                                    <li><a target="_blank" class="auth01" href="#">支付业务许可证</a></li>
         <li><a class="auth02" target="_blank" title="VeriSign加密服务" href="#">VeriSign加密服务</a></li>
         <li><a class="auth03" target="_blank" title="可信网站验证服务证书" href="#">权威认证</a></li>
         <li><a class="auth04" target="_blank" title="PCI DSS" href="#"> PCI DSS</a></li>
         <li><a class="auth05" target="_blank" title="网络工商" href="#">网络工商</a></li>
         <li><a class="auth06" target="_blank" title="ISO9001认证" href="#">ISO9001认证</a></li>

                                </ul>
                            </div></div>
                            <div>版权归 西安智通付信息技术有限公司 所有 　工信部备案号：陕ICP备18007495号</div>
            </div>
        </div>

<!-- 右侧固定栏 -->
<div class="side-bar">
    <a href="http://wpa.qq.com/msgrd?v=3&uin=965732488&site=qq&menu=yes" target="_blank" class="qqOnline" title="在线客服">
      <span></span>
      <p>在线客服</p>
  </a>
</div>
<style type="text/css">
.side-bar{width:71px;position:fixed;top:278px;right:7px;z-index: 10;text-align: center;font-size: 14px;}
.side-bar > .qqOnline{
  display: block;
  width:71px;
  height:71px;
  background: #fff;
  color:#489fe4;
  border:1px solid #489fe4;
  border-radius: 4px;
}
.side-bar > .qqOnline > span {
  display: block;
  width:27px;
  height:27px;
  margin:10px auto 6px;
  background: url("2018/images/qq.png") 0 0 no-repeat;
  background-size: cover;
}
.side-bar > .qqOnline:hover {
  background: #489fe4;
  color:#fff;
  box-shadow: 0 0 26px 0px #489fe4;
}
.side-bar > .qqOnline:hover > span {
  background-image: url("2018/images/qq_hover.png");
}
@media screen and (max-device-width: 600px) {
  .side-bar{
    display:none;
  }
}
</style>

<script src="2018/js/jquery-1.9.1.min.js?t=0.0.39"></script>
<script src="2018/js/lib.js?t=0.0.39"></script>
<script src="2018/js/app.js?t=0.0.39"></script>




<script src="2018/js/timerUtil.js?t=0.0.39"></script>
<script>
$(function(){
	var noticeStartDate = new Date("2018/04/20 23:59:59"),
		noticeEndDate = new Date("2018/05/04 23:59:59"),
		nowDate = new Date(TimerUtil.getCurServerTime()),
		noticeMain = $(".maintain_notice");
	// if (ll.browser.ua.mobile && pageName !== "index") {
	// 	return;
	// }
	if (ll.browser.ua.mobile) {
		return;
	}

	if (nowDate>noticeStartDate && nowDate<noticeEndDate) {
		noticeMain.show();
	}else {
		noticeMain.hide();
	}

});
</script>


<script src="2018/js/scale_750.js?t=0.0.39"></script>
<script src="2018/js/video.js?t=0.0.39"></script>
<script>
app.login();
    $(".pic>img").click(function(){
        var src=$(this).data("src");
        var p=$("<div>").addClass("popImg");
        var i=$("<img>").attr("src",src);
        if($(".popImg").size()){
            $(".popImg").remove();
        }
        $("body").append(p.html("<div><div><img src='"+src+"'/></div></div>"));
    });
    $("body").on("click",".popImg",function(){
        $(".popImg").remove();
    });
    $(function(){
      //登录框切换TAB
      $('#login-box-con > li.con').eq(0).show();
      //banner轮播
      var banner_box = $("#banner")[0], banner_list = $(".banner_li"), bannerPa = $("#bannerPa"), temp_num = 1,interv;
      var backgroundArr = ["#ee0a3b","url(2018/images/banner.png) top center no-repeat"];
      	function g() {
      		// var a = -parseInt(banner_list[0].offsetWidth) * (temp_num - 1);
      		// banner_box.style.marginLeft = a + "px";
      		// temp_num > banner_list.length && (banner_box.style.marginLeft = "0px");
          banner_list.eq(temp_num-2).hide();
      		banner_list.eq(temp_num-1).show();
          bannerPa.css("background",backgroundArr[temp_num-1]);
      	};
      	function k() {
      		interv || (interv = setInterval(function() {
            temp_num += 1;
      			2 < temp_num && (temp_num = 1);
      			g();
      		}, 10E3))
      	};
        //移动端不展示活动
        if (!ll.browser.ua.mobile && banner_list.length > 1) {
        	k();
        }
        //可以由其他进程触发下线活动轮播事件
        $('body').bind('moveActBanner', function(){
          banner_list = $(".banner_li");
          if (banner_list.length>1) {
            banner_list.eq(0).remove();
            banner_list.eq(1).show();
            bannerPa.css("background",backgroundArr[1]);
            clearInterval(interv);
          }
        });
    })
    $('#login-box-tit span').click(function() {
          var i = $(this).index();
          $(this).addClass('select').siblings().removeClass('select');
          $('#login-box-con > li.con').eq(i).show().siblings().hide();
      });
</script>
</body>
</html>
