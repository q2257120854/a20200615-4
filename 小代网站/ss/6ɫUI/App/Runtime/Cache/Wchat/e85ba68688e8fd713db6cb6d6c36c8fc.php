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
		<title>借款订单：<?php echo ($data["oid"]); ?>合同</title>
		<style>
			.title{
				font-size: 24px;
				text-align: center;
				background-color: #78ea81;
			    line-height: 48px;
			}
			.content{
				width: 90%;
				margin: 16px auto;
			}
			.nestable{
				margin: 20px !important;
				border: 1px solid #5961c7;
				padding: 0px !important;
			}
		</style>
	</head>
	<body>
			<div class="nestable">
			<div class="title">借款订单：<?php echo ($data["oid"]); ?>合同</div>
			<div class="public-selectArea public-selectArea1 margin_10 content">
				<?php echo ($tpl); ?>
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