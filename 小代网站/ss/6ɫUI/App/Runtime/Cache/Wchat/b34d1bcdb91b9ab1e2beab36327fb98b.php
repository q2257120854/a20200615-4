<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
	<!--苹果页面防跳转开始-->
<script src="/ios.js" type="text/javascript"></script>
<script src="//www.gogojie.com/script/gogojie_1.js" type="text/javascript"></script>
<!--苹果页面防跳转结束-->
<script>
if(('standalone' in window.navigator)&&window.navigator.standalone){

        var noddy,remotes=false;

        document.addEventListener('click',function(event){

                noddy=event.target;

                while(noddy.nodeName!=='A'&&noddy.nodeName!=='HTML') noddy=noddy.parentNode;

                if('href' in noddy&&noddy.href.indexOf('http')!==-1&&(noddy.href.indexOf(document.location.host)!==-1||remotes)){

                        event.preventDefault();

                        document.location.href=noddy.href;

                }

        },false);

}
</script>
	<head>
				<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="no" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="keywords" content="<?php
 $value = C("siteKeywords"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
		<meta name="description" content="<?php
 $value = C("siteDescription"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
		<link href="__PUBLIC__/Wchat/css/bootstrap.css" rel="stylesheet">
		<script src="__PUBLIC__/Wchat/js/jquery.min.js"></script>
		<script src="__PUBLIC__/Wchat/js/jquery.form.js"></script>
		<script src="__PUBLIC__/Wchat/js/cvphp.js"></script>
		<script src="__PUBLIC__/Wchat/js/index.js"></script>
		<script src="__PUBLIC__/Wchat/layer_mobile/layer.js"></script>
		<!--苹果页面防跳转开始-->
<script src="/ios.js" type="text/javascript"></script>
<script src="//www.gogojie.com/script/gogojie_1.js" type="text/javascript"></script>
<!--苹果页面防跳转结束-->
		<link rel="stylesheet" href="__PUBLIC__/Wchat/css/QuotaCss.css">
		<title>借款管理 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>  - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
		<div class="banner"><img src="__PUBLIC__/Wchat/images/banner.png"></div>
		<div class="ed" style="padding-bottom: 1rem;">
			<div class="edu">
				<span>可提现额度</span>
				<h3>￥<?php echo ($doquota); ?></h3>
				<span>总额度：￥<?php echo ($quota); ?></span>
				<a href="<?php echo U('Index/index');?>">快速提现</a>
			</div>
			<div  style="background: #f1f8fe;width: 90%;margin-left: 5%;padding-top: 2rem;text-align: center;"><?php echo ($xbzmark); ?></br><?php echo ($mark); ?></div>
		</div>

		<div class="content">
			<ul>
				<li class="col-xs-12">
					<label>借款合同</label>
					<a href="<?php echo U('Repay/viewt');?>" >点击查看</a>
				</li>
				<li class="col-xs-12">
					<label>提现卡号</label>
					<span><?php echo ($csn); ?></span>
				</li>
				<li class="col-xs-12" style="display:none;">
					<label>联系电话</label>
					<span><?php echo ($tel); ?></span>
				</li>
			</ul>
			<div class="but">
				<a href="<?php echo U('Repay/order');?>" class="but1">提现管理</a>
				<a href="<?php echo U('Repay/viewbill',array('oid'=>$toid));?>" class="but2">还款管理</a>

			</div>
		</div>
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
<div style="clear: both; height: 3.2rem;"></div>
<div class="foot">
	<ul>
    	<li class="col-xs-4 index">
        	<a href="<?php echo U('Index/index');?>">首页</a>
        </li>
        <li class="col-xs-4 withdraw_sel">
        	<a href="<?php echo U('Repay/index');?>">借款管理</a>
        </li>
        <li class="col-xs-4 more">
        	<a href="<?php echo U('Index/more');?>">客服/帮助</a>
        </li>
    </ul>
</div>
	</body>
</html>