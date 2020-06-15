<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>塔罗占卜未来运势揭秘</title>
<meta name="keywords" content="塔罗占卜未来运势揭秘" />
<meta name="description" content="塔罗占卜未来运势揭秘" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min-v=0817.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/index/1/index.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/index/swiper.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/index/huangli.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/ffsm/statics/ffsm/index/swiper.min.js"></script>
<script src="/ffsm/statics//jquery.min.js"></script>
</head>
<body>
<div class="CommonSwiper">
	<div class="swiper-container swiper-container-horizontal swiper-container-wp8-horizontal">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<a href="/?ac=hehun"><img src="/ffsm/statics/img/bzhehun_top_banner.png" class="index_img">
					<p class="img_title"></p>
				</a>
			</div>
			
			<div class="swiper-slide">
				<a href="/?ac=xmpd"><img src="/ffsm/statics/ffsm/index/xmpd.jpg" class="index_img">
					<p class="img_title"></p>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="/?ac=bzsy"><img src="/ffsm/statics/img/top_banner.png" class="index_img">
					<p class="img_title"></p>
				</a>
			</div>
			</div>
		<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
	</div>
</div>


<!--<div class="item">
	<dl class="item_pic clear">
		<dd style="margin-left:0px;"><a href="/" class="item_pic_t">5G云算命源码 付费5G云算命源码 付费测算分销源码</a>
		<p>开源 5G云算命源码 付费5G云算命源码 付费测算分销源码 php5G云算命源码 <br>
        qq www.010xr.com 付费自动测算结果精准！<br>
        <b style="color:#F00">算命结果均为系统测算出的结果，而不是固定的结果！！</b>
        
        </p>
		</dd>
      <a href="mqqwpa://im/chat?chat_type=wpa&amp;uin=www.010xr.com&amp;version=1&amp;src_type=web&amp;web_src=vip.yibeiyv.com" class="btn_rightnow">立即购买</a>
	</dl>
</div>-->


<div class="item">
	<dl class="item_pic clear">
    	<div class="title">塔罗占卜看未来运势大揭秘！</div>
    
		<dt><a href="/?ac=taluoyunshi"><img src="/ffsm/statics/img/zx3.png" alt="塔罗占卜未来运势揭秘">
		<p>
			已有<font>1288</font>人進行測算
		</p>
		</a></dt>
		<dd><a href="/?ac=taluoyunshi" class="item_pic_t">塔罗占卜运势大揭秘</a>
		<p>利用塔罗牌看脱单实际..你的命定之人合适出现、升职？加薪？何时到来？未来的你财运状况如何、当前工作的发展性如何？...</p>
		</dd>
      <a href="/?ac=taluoyunshi" class="btn_rightnow">塔罗占卜运势大揭秘</a>
	</dl>
</div>



<script>
	//图片轮播
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 1,
		autoplay: {
			delay: 2000,
			disableOnInteraction: false,
		},
		loop: true,
		pagination: {
			el: '.swiper-pagination',
			clickable: false,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	//TAB——Box
	var switchBox=$('.m-wrap'),
		switchTit=$('#tab>li');
	function xun(num){
		for(var i=0,len=switchBox.length;i<len;i++){
			if(num == i){
				switchBox[i].style.display="block";
			}else{
				switchBox[i].style.display='none';
			}
		}
	}
	for(var j=0;j<switchTit.length;j++){
		switchTit[j].setAttribute('data-num',j);
		switchTit[j].addEventListener('click',function(){
			var num=this.getAttribute('data-num');
			$(this).parents('ul').find('li').find('div').removeClass('select').siblings('span').removeClass('line');
			$(this).find('div').addClass('select').siblings('span').addClass('line');
			xun(num);
		})
	}
</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?760b8bd23f74ee69e74c03de22b67960";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


<footer class="public_footer">
<p><a href="/" class="public_footer_words">塔罗占卜</a></p>
<p>
	<a href="/?ac=about" class="public_footer_words">关于我们</a>
	<a href="/?ac=contact" class="public_footer_words">联系我们</a>
</p>
</footer>


</body>
</html>