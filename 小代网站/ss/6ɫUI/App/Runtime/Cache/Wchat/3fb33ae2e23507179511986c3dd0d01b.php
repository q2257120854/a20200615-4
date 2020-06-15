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
		<link href="__PUBLIC__/Wchat/css/bankCss.css" rel="stylesheet">
		<script src="__PUBLIC__/Wchat/js/LArea.js"></script>
		<link type="text/css" href="__PUBLIC__/Wchat/css/LArea.css" rel="stylesheet">
		<script src="__PUBLIC__/Wchat/js/one_LArea.js"></script>
		<script src="__PUBLIC__/Wchat/js/LAreaData2.js"></script>
		<title>填写个人信息 - 信息认证 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
				<section class="ioc_list">
			<ul>
				<li class="col-xs-7 identityAuth"></li>
				<li class="col-xs-7 contactsAuth"></li>
				<li class="col-xs-7 bankAuth"></li>
				<li class="col-xs-7 addessAuth"></li>
			
			</ul>
		</section>
		<?php $actionName = ACTION_NAME; ?>
		<script>
			<?php if(is_array($auth)): $i = 0; $__LIST__ = $auth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?>var obj = $(".ioc_list li."+"<?php echo ($key); ?>"+"Auth");
					obj.removeClass("<?php echo ($key); ?>"+"Auth");
					obj.addClass("<?php echo ($key); ?>"+"AuthNow");
					obj.html("<span></span>");<?php endif; endforeach; endif; else: echo "" ;endif; ?>
			var actionName = "<?php echo ($actionName); ?>";
			var obj = $(".ioc_list li."+actionName);
			obj.removeClass(actionName);
			obj.addClass(actionName+"Now");
		</script>
		<form action="<?php echo U('Info/addessAuth');?>" method="post">
			<div class="row xinxi">
				<ul>

					<li class="col-xs-12">
						<label>预期金额</label>
						<input type="text" placeholder="请输入您预期的借贷额度" class="form-control" id="industry" name="industry" />
					</li>
					<li class="col-xs-12">
						<label>芝麻信用分</label>
						<input type="text" placeholder="（选填，无请放空）" class="form-control" name="mzmf" />
					</li>
				</ul>
			</div>
			<p class="changzhu">补充资料：请尽量填写完整,可增加通过几率和额度</p>
			<div class="row xinxi">
				<ul>		
					<li class="col-xs-12">
						<label>单位名称</label>
						<input type="text" placeholder="请输入工作单位的名称" class="form-control" name="mqq" />
					</li>
					<li class="col-xs-12">
						<label>职务</label>
						<input type="text" placeholder="请输入所在单位的职务" class="form-control" name="mwx" />
					</li>
					<li class="col-xs-12">
						<label>工作年龄</label>
						<input type="text" placeholder="请输入所在单位的工作时间" class="form-control" name="mzfb" />
					</li>
					<li class="col-xs-12">
						<label>月收入</label>
						<input type="text" placeholder="请输入现工作的月收入" class="form-control" name="madd1" />
					</li>
					<li class="col-xs-12">
						<label>单位电话</label>
						<input type="text" placeholder="区号加号码" class="form-control" name="madd2" />
					</li>					
					<li class="col-xs-12">
						<label>单位地址</label>
						<input type="text" placeholder="请输入工作地址具体到门牌号" class="form-control" name="madd3" />
					</li>					
					<li class="col-xs-12">
						<label>常住地址</label>
						<input type="text" placeholder="请输入居住地址具体到门牌号" class="form-control" name="addessMore" />
					</li>
				</ul>
			</div>
		</form>
		<div class="o-footer">
			<button class="but1" id="nextBtn">提交申请</button>
		</div>
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
<!--<div style="clear: both; height: 3.2rem;"></div>-->
<div class="foot">
	<ul>
    	<li class="col-xs-4 index_sel">
        	<a href="<?php echo U('Index/index');?>">首页</a>
        </li>
        <li class="col-xs-4 withdraw">
        	<a href="<?php echo U('Repay/index');?>">借款管理</a>
        </li>
        <li class="col-xs-4 more">
        	<a href="<?php echo U('Index/more');?>">客服/帮助</a>
        </li>
    </ul>
</div>
	</body>
	<script>
	
		$(function(){
			$("#nextBtn").on('click',function(){
				

				var industry = $("input[name='industry']").val();
		
				if(industry.length == 0){
					cvphp.msg({
	    				content: '请输入您预期的借贷额度'
	    			});
	    			return ;
				}

				if(industry <= 9999){
					cvphp.msg({
	    				content: '预期的借贷额度不能少于10000'
	    			});
	    			return ;
				}              
			
				cvphp.submit($("form"),function(data){
					if(data.status != 1){
						cvphp.msg({
		    				content: data.info
		    			});
						return false;
					}else{
						cvphp.msg({
		    				content: '保存成功'
		    			});
						layer.open({
						content: '您的资料已提交审核，请留意审核通知！'
						,btn: ['好的']
						});
		    			var url = data.url;
		    			if(url.length > 0){
		    				setTimeout(function(){
		    					window.location.href = url;
		    				},2000);
		    			}
					}
				});
			});
			
			
		});

		
	</script>	
</html>