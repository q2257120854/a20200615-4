<?php /* Smarty version 2.6.25, created on 2019-03-19 10:26:29
         compiled from index/xingzuo/order.tpl */ ?>
<html lang="en" style="font-size: 18.75px;">
 <head> 
  <meta charset="utf-8" /> 
  <title>占星</title> 
  <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-touch-fullscreen" content="yes" /> 
  <meta name="keywords" content="" /> 
  <meta name="description" content="" /> 
  <noscript></noscript>
 </head>
 <body>
  <meta http-equiv="Pragma" content="no-cache" /> 
  <meta http-equiv="Cache-Control" content="no-cache" /> 
  <meta http-equiv="Expires" content="0" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="author" contect="linghit.fe, 1454416761@qq.com" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="renderer" content="webkit" /> 
  <link rel="stylesheet" href="/html/xingzuo/xingzuo1.css" /> 
  <script src="/ffsm/statics/cdn.12ystar.com/website/Scripts/home/jquery.min.js"></script>
  <!-- uc强制竖屏 --> 
  <meta name="screen-orientation" content="portrait" /> 
  <meta name="x5-orientation" content="portrait" />
  <!-- QQ强制竖屏 --> 
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <!-- 不让百度转码 -->   
  <div class="container" id="container"> 
   <div class="wrapper" id="wrapper"> 
    <section id="page-pay">
     <section data-reactroot="">
      <!-- react-empty: 99 -->
      <div class="banner">
       <img alt="banner" src="//s103.ggwan.com/zxcs/forecast/gerenzhanxing/gerenzhnaxing_no_master_banner_20181207.jpg" />
      </div>
      <div class="main">
       <div class="intro">
        <p>从浩瀚星图中，寻找属于你的潜在力量！目前已有768532名用户进行深度个人占星，有98%的用户给予好评，并更好地理解了人生各方面的根源和此生要修正的问题！</p>
       </div>
       <div>
        <div class="common-pay-info">
         <div class="item-name" style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">
          <!-- react-text: 10 -->付费项目：
          <!-- /react-text -->
          <!-- react-text: 100 -->在线付费_深度个人占星报告
          <!-- /react-text -->
         </div>
         <div class="item-base-price clear bor-none">
          <div class="price left">
           <strong class="time-price">
            <!-- react-text: 15 -->限时优惠￥
            <!-- /react-text -->
            <!-- react-text: 101 --><?php echo $this->_tpl_vars['form']['money']; ?>

            <!-- /react-text -->
            <!-- react-text: 17 -->元
            <!-- /react-text --></strong>
           <br />
           <span>
            <!-- react-text: 20 -->原价：￥
            <!-- /react-text -->
            <!-- react-text: 102 -->118
            <!-- /react-text --></span>
          </div>
          <div class="dis-time right">
           <!--<strong>距优惠结束</strong>
           <br />
           <span>01 : 37 : 53</span>
          </div>-->
         </div>
        </div>
        <div>
         <div id="common-pay-lists"></div>
         <div class="common-pay-lists">
          <div class="common-pay-title" style="color: rgb(255, 255, 255); background: rgb(46, 27, 79);">
           支付方式
          </div>
          <div class="common-item-box">
           <ul class="common-pay-item">
            <li class="show">
             <div class="right">
              <div class="pay-btn">
              <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">
               立即支付
               </a>
              </div>
             </div>
             <div class="auto">
              <span class="pay-icon wechat"></span>
              <span>微信支付</span>
             </div></li>
            <li class="show">
             <div class="right">
              <div class="pay-btn">
              <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2">
               立即支付
               </a>
              </div>
             </div>
             <div class="auto">
              <span class="pay-icon alipay"></span>
              <span>支付宝支付</span>
             </div></li>
            
           </ul>
           
          </div>
         </div>
         <p style="padding-bottom:6px; padding-left:26px;">订单号：<?php echo $this->_tpl_vars['form']['oid']; ?>
</p>
         <div id="pay-problem-icon"></div>
        </div>
       </div>
       <div class="unlock">
        <div class="unlock-main">
         <div class="unlock-tit" style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">
          支付完成后你将获得以下内容
         </div>
         <div class="com-unpaid-box">
          <div class="tit">
           <span style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">你的真实性格</span>
          </div>
          <div class="in">
           <div class="blur">
            点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击
           </div>
           <div class="show-text" style="border-color: rgb(46, 27, 79);">
            <p style="visibility: visible;">• 你的主要人格</p>
            <p style="visibility: visible;">• 你的思维模式</p>
            <p style="visibility: visible;">• 你的人生态度</p>
           </div>
          </div>
         </div>
         <div class="com-unpaid-box">
          <div class="tit">
           <span style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">你的职业生涯</span>
          </div>
          <div class="in">
           <div class="blur">
            点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击
           </div>
           <div class="show-text" style="border-color: rgb(46, 27, 79);">
            <p style="visibility: visible;">• 你的工作状态</p>
            <p style="visibility: visible;">• 你适合从事的工作</p>
            <p style="visibility: visible;">• 你的职业发展蓝图</p>
           </div>
          </div>
         </div>
         <div class="com-unpaid-box">
          <div class="tit">
           <span style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">你的财富潜能</span>
          </div>
          <div class="in">
           <div class="blur">
            点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击
           </div>
           <div class="show-text" style="border-color: rgb(46, 27, 79);">
            <p style="visibility: visible;">• 你的获财方式</p>
            <p style="visibility: visible;">• 你的财富运势</p>
            <p style="visibility: visible;">• 适合你的理财方式</p>
           </div>
          </div>
         </div>
         <div class="com-unpaid-box">
          <div class="tit">
           <span style="background-color: rgb(46, 27, 79); color: rgb(255, 255, 255);">你的感情姻缘</span>
          </div>
          <div class="in">
           <div class="blur">
            点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击支付后查看结果点击
           </div>
           <div class="show-text" style="border-color: rgb(46, 27, 79);">
            <p style="visibility: visible;">• 你的感情模式</p>
            <p style="visibility: visible;">• 你的伴侣特质</p>
            <p style="visibility: visible;">• 你的婚姻状况</p>
           </div>
          </div>
         </div>
        </div>
        <div class="com-unpaid-btn clear">
         <div class="left">
          你的原生家庭
         </div>
         <div class="right">
          <img src="//zxcs.ggwan.com/forecastimages/pay/unpaid_red_lock.png" alt="小锁图标" />
         </div>
        </div>
        <div class="com-unpaid-btn clear">
         <div class="left">
          你的身心健康
         </div>
         <div class="right">
          <img src="//zxcs.ggwan.com/forecastimages/pay/unpaid_red_lock.png" alt="小锁图标" />
         </div>
        </div>
        <div class="com-unpaid-btn clear">
         <div class="left">
          2019年发展指南
         </div>
         <div class="right">
          <img src="//zxcs.ggwan.com/forecastimages/pay/unpaid_red_lock.png" alt="小锁图标" />
         </div>
        </div>
       </div>
      </div>
      <div class="pay-popupBtn" id="pay-popupBtn" style="display: none; background-color: rgb(238, 214, 55); color: rgb(53, 16, 34); width: 375px;">
       付费解锁全部分析
      </div>
      <div>
       <div style="padding: 0.625rem 1.4375rem; background: #301b56; color: #c8b4e7; font-size: 0.75rem; text-align: center; line-height: 1.25rem;">
        <a href="/?ac=contact" style="color: #fff; display: block;">
         <!-- react-text: 379 -->如需帮助点此
         <!-- /react-text --><img src="https://s103.ggwan.com/zxcs/kefu_03.png" alt="" style="width: 1.25rem; margin: 0px 0.25rem; display: inline-block;" /><span style="color: #fff; text-decoration: underline;">请联系专属售后客服</span></a>
        <p>广东灵机文化传播有限公司版权所有 粤ICP备12312311号-1<br />塔罗占卜</p>
        <p><a href="javascript:;"><img style="width: 100%,display:block" src="https://s103.ggwan.com/zxcs/forecast/mllyuncheng/footer_icon.png" alt="诚信logo" /></a></p>
       </div>
      </div>
     </section>
    </section> 
   </div> 
  </div> 
  
  <script>
    
	var inquiry_lock = 0;
    $(function () {
        setInterval(function () {
            inquiry();
        }, 2000);
    });
    function inquiry() {
        if (inquiry_lock) {
            return;
        }
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                window.location = data.url;
            }
        }, 'json');
    }
    
    </script>
  
 </body>
</html>