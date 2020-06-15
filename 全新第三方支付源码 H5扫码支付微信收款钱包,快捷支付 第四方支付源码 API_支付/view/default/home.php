<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $this->config['sitename']?></title>

<meta name="keywords" content="<?php echo $this->config['sitename']?>,支付解决方案,移动互联网计费专家，一站式提供国内外专业的计费解决方案。手游计费，O2O计费，一键支付，聚合支付" />
<meta name="description" content="<?php echo $this->config['sitename']?>是由万智通付网络科技有限公司推出的电子支付平台，致力于提供安全、便捷、专业、简单的第四方在线支付服务" />

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/common.css?46d2f15adcb9adda01d7" rel="stylesheet">
<link href="css/polyPay.css?46d2f15adcb9adda01d7" rel="stylesheet">
</head>
<body>
 <script type="text/javascript">

        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href = "/mobile";
        }

 </script>

<div class="header pinned">
	<div class="header-main clearfix">
		
		<div class="nav-box">
			<ul class="nav" id="nav">
			<li> <a  href="/">万智通付</a> <div class="nav-line"></div> </li>
				<li class="more"><a href="#nogo">产品与服务</a>
				<div class="nav-line">
				</div>
				<div class="sub-nav product-list">
					<ul>
						<li><a href="javascript:void(0);">网银支付</a></li>
						<li><a href="javascript:void(0);" onclick="sa.track(&quot;activityClicks&quot;,{name:&quot;扫码支付&quot;,platformType:&quot;pc&quot;})">扫码支付</a></li>
						<li><a href="javascript:void(0);" onclick="sa.track(&quot;activityClicks&quot;,{name:&quot;现金罗盘&quot;,platformType:&quot;pc&quot;})">快捷支付</a></li>
						<li><a href="javascript:void(0);">QQ钱包</a></li>
					</ul>
				</div>
				</li>
				<li> <a  href="/demo">在线体验</a> <div class="nav-line"></div> </li>
				<li><a href="/i/merchant_agreement.html" onclick="sa.track(&quot;activityClicks&quot;,{name:&quot;服务协议&quot;,platformType:&quot;pc&quot;})">服务协议</a>  <div class="nav-line"></div> </li>

				
			</ul>
		</div>
		<div class="login-box">
			<div  class="phone-400">
				7X24 在线客服
			</div>
			<div class="no_login" style="display: block;">
				<a class="login-btn" href="/login">登录</a><a class="reg-btn" href="/register" onclick="sa.track(&quot;registerBtnClicks&quot;,{platformType:&quot;pc&quot;,position:&quot;头部右上角&quot;,pageUrl:location.href})">注册</a>
			</div>
			<div class="has_login clearfix" style="display: none;">
				<a class="app-btn" alt="应用中心" href="/appcenter">应用中心</a><a id="quit" class="quit-btn" alt="退出" href="javascript:void(0)">退出</a>
			</div>
		</div>
	</div>
</div>

<div class="polyPay product">
	<div class="banner polyPay_banner">
		<div class="main">
			<h1>万智通付 为创业者而生</h1>
			<h2>方便快捷的支付接入体验，让支付和收款更简单！</h2>
			<a href="/demo" class="btn">立即体验</a><a href="/login" class="btnr">注册登陆</a>
		</div>
		<ul class="key-word">
			<li>极速</li>
			<li>便捷</li>
			<li>安全</li>
			<li>稳定</li>
		</ul>
	</div>
	<div class="brand-introduce">
		<ul>
			<li><span>12</span>种支持终端</li>
			<li><span>24</span>种支付通道</li>
			<li><span>36</span>种支付产品</li>
		</ul>
	</div>
	<div class="mod all-scene">
		<h2>支持全部场景</h2>
		<p>
			提供支付接入方案，可在各种场景中流畅交易
		</p>
		


		<div class="main">
			<ul>
				<li><span>电商</span><br>
				E-Commerce<img data-original="images/index-pic-01.jpg" alt="电商" src="images/index-pic-01.jpg" style="display: inline;"></li>
				<li><span>零售</span><br>
				Retail<img data-original="images/index-pic-04.jpg" alt="零售" src="images/index-pic-04.jpg" style="display: inline;"></li>
				<li><span>票务</span><br>
				Tickets<img data-original="images/index-pic-03.jpg" alt="票务" src="images/index-pic-03.jpg" style="display: inline;"></li>
				<li><span>游戏</span><br>
				Games<img data-original="images/index-pic-02.jpg" alt="游戏" src="images/index-pic-02.jpg" style="display: inline;"></li>
				<li><span>金融</span><br>
				Finance<img data-original="images/index-pic-08.jpg" alt="金融" src="images/index-pic-08.jpg" style="display: inline;"></li>
				<li><span>教育</span><br>
				Education<img data-original="images/index-pic-07.jpg" alt="教育" src="images/index-pic-07.jpg" style="display: inline;"></li>
				<li><span>医疗</span><br>
				Medical<img data-original="images/index-pic-05.jpg" alt="医疗" src="images/index-pic-05.jpg" style="display: inline;"></li>
				<li><span>其他</span><br>
				Others<img data-original="images/index-pic-06.jpg" alt="其他" src="images/index-pic-06.jpg" style="display: inline;"></li>
			</ul>
		</div>






	</div>
	<div class="mod flow">
		<div class="flow-clock">
			<div class="hour">
			</div>
			<div class="minute">
			</div>
			<div class="second">
			</div>
		</div>
		<div class="flow-content">
			<h2>快速接入流程</h2>
			<p>
				只需4个步骤即可成功接入
			</p>
			<ul>
				<li>商户注册</li>
				<li>线上测试</li>
				<li>参数配置</li>
				<li>完成接入</li>
			</ul>
		</div>
	</div>
	<div class="pay_product polyPay_product">
		<div class="main">
			<div class="my_title">
				支付产品
			</div>
			<div class="describe">
				 让您在各个场景下轻松实现收款，涵盖手机APP、移动网页<br>
				 PC网页、微信公众号、手机扫码等场景, <a class="tast_href" href="/demo">立即体验</a>吧~
			</div>
			<div class="pay_list">
				
				<div class="tab_cont">
					<div class="pay_scene active all">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								移动支付
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								手机网站
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								即时到帐
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								当面付
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								声波支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								扫码支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								刷卡支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机控件
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								电脑支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								PC端
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left kq">
							<div class="pro_name">
								快钱
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene app">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								移动支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机控件
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene wap">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								手机网站
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene pcweb">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								即时到帐
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								电脑支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								PC端
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left kq">
							<div class="pro_name">
								快钱
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene wxpub">
						<ul class="clearfix">
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								易宝支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene scancode">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								当面付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								扫码支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								刷卡支付
							</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="deal">
		<div class="container clearfix">
			<div class="pic left">
				<img src="http://fuqianla.net/css/img/product-deal-pic-1.png?990c9c1882a882757cd1142c64a03c36">
			</div>
			<div class="deal_info right">
				<div class="title">
					交易管理
				</div>
				<div class="describe">
					强大的管理后台<br>
					让您轻松管理交易数据
				</div>
				<a href="/login" class="btn-taste experience">我要体验</a>
			</div>
		</div>
	</div>
	
	<div class="free-registration">
		<span class="des">科技让金融更简单</span><a href="/register" class="btn">免费注册</a>
	</div>

<div class="footer">
	<div class="main clearfix">



		<dl>
			<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;©2017 万智通付网络科技有限公司&nbsp;&nbsp;&nbsp;&nbsp;ICP备15020510号&nbsp;&nbsp;<img style="position:relative;margin-top:-4px;" src="http://www1.pconline.com.cn/footer/images/ft-ghs.png" alt="图片说明" /></dt>
			
		

		
	</div>
	
</div>






</div>

<script type="text/javascript" src="/js/common.js?46d2f15adcb9adda01d7"></script>
<script type="text/javascript" src="/js/polyPay.js?46d2f15adcb9adda01d7"></script>

</body>
</html>