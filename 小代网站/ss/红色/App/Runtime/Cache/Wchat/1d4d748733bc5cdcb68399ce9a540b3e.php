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
		<link href="__PUBLIC__/Wchat/css/MyCss.css" rel="stylesheet">
		<title>更多 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
		<div class="head_portrait">
			<div class="header">
				<img src="<?php
 $value = C("siteLogo"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
<?php $user = getUserInfo(); ?>
<?php if(empty($user)): ?><a href="<?php echo U('Index/login');?>">登录 / 注册</a>
<?php else: ?>
				<span><?php echo getViewPhone($user['telnum']);?></span><?php endif; ?>
			</div>
		</div>
		<div class="nav">
			<ul>
				<li class="col-xs-12 guanyu">
					<a href="<?php echo U('Page/about');?>">关于我们</a>
				</li>
				<li class="col-xs-12 fourqq"><span>在线客服</span>
					<a href="https://qfak60.kuaishang.cn/bs/im.htm?cas=116749___983298&fi=119508&ism=1" >点击联系</a>
				</li>
				<li class="col-xs-12 four" style="display:none;"><span>服务电话</span>
					<a href="tel:<?php echo ($tes); ?>"><?php
 $value = C("siteServicenum"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></a>
				</li>
			</ul>
		</div>
<p>	
    <a href="/index.php/Repay/index.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/b1.png" width="100%" alt="b1.png"/></a>
</p>		
<p>	
    <a href="/index.php/Repay/index.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/w1.png" width="100%" alt="w1.png"/></a>
</p>
<p>
    <a href="/index.php/Repay/index.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/w2.png" width="100%" alt="w2.png"/></a>
</p>
<p>
    <a href="/index.php/Repay/index.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/w3.png" width="100%" alt="w3.png"/></a>
</p>
<p>
    <a href="/index.php/Repay/index.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/gg1.png" width="100%" alt="gg1.png"/></a>
</p>

<?php if(!empty($user)): ?><div class="nav">
			<ul>
				<li class="col-xs-12 system">
					<a href="<?php echo U('Page/setting');?>">设置</a>
				</li>
			</ul>
		</div>
		<div class="anniu">
			<a href="javascript:;" onclick="logout();">退出登录</a>
		</div><?php endif; ?>
		<script>
			function logout(){
				layer.open({
					content: '您确定要退出系统吗？'
					,btn: ['确定','取消']
					,yes: function(index){
						window.location.href = "<?php echo U('Index/logout');?>";
					}
				});
			}
			function qqs(qq){
				  layer.open({
					title: [
					'qq在线客服',
					'background-color: #1776d4; color:#fff;'
					]
					,content: '如需帮助，请添加QQ客服：'+qq
					,btn: '关闭'
				});
			}
		</script>
<!--底部版权-->
<p style="text-align: center;">
    <span style="color: rgb(191, 191, 191); font-size: 14px;"><?php
 $value = C("siteServicenum"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></span>
</p>
<!--底部版权-->
<p>
    <br/>
</p>		
<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
<div class="foot">
	<ul>
		<li class="col-xs-4 index_sel">
			<a href="<?php echo U('Index/index');?>">首页</a>
		</li>
		<li class="col-xs-4 withdraw">
			<a href="<?php echo U('Repay/index');?>">借款</a>
		</li>
		<li class="col-xs-4 more_on">
			<a href="<?php echo U('Index/more');?>">我的</a>
		</li>
	</ul>
</div>
	</body>
</html>