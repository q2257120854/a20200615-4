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
		<link type="text/css" href="__PUBLIC__/Wchat/css/LArea.css" rel="stylesheet">
		<script src="__PUBLIC__/Wchat/js/one_LArea.js"></script>
		<script src="__PUBLIC__/Wchat/js/LAreaData2.js"></script>
		<title>联系人信息 - 信息认证 - <?php
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
		<form action="<?php echo U('Info/contactsAuth');?>" method="post">
			<div class="row xinxi">
				<ul>
					<li class="col-xs-12 hang">
						<label>直系亲属关系</label>
						   <select name="zhishuRelation" class="form-control duan" id="zhishu">
								<option value="-1">请选择</option>
								<option value="父母">父母</option>
								<option value="子女">子女</option>
								<option value="配偶">配偶</option>
							</select>
					</li>
					<li class="col-xs-12">
						<label>直系亲属姓名</label>
						<input type="text" placeholder="请输入" class="duan" name="zhishuName">
					</li>
					<li class="col-xs-12 hang1">
						<label>直系亲属电话</label>
						<input type="text" placeholder="请输入" class="duan dianhua" name="zhishuPhone">
					</li>
				</ul>
			</div>
			<div class="row xinxi">
				<ul>
					<li class="col-xs-12 hang">
						<label>紧急联系人关系</label>
							   <select name="jinjiRelation" class="form-control duan" id="jinji">
								<option value="-1">请选择</option>
								<option value="父母">父母</option>
								<option value="子女">子女</option>
								<option value="配偶">配偶</option>
								<option value="同事">同事</option>
								<option value="朋友">朋友</option>
								<option value="其他">其他</option>
							</select>
					</li>
					<li class="col-xs-12">
						<label>紧急联系人姓名</label>
						<input type="text" placeholder="请输入" class="duan" name="jinjiName">
					</li>
					<li class="col-xs-12 hang1">
						<label>紧急联系人电话</label>
						<input type="text" placeholder="请输入" class="duan dianhua" name="jinjiPhone">
					</li>
				</ul>
			</div>
					<li class="col-xs-12">请放心填写，我们只做登记，备用紧急联系，不会致电您的联系人。</li>
		</form>
		<div class="footer" style="bottom: 3.2rem;">
			<button class="but1" id="nextBtn">下一步</button>
		</div>
	
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
		<div class="foot">
			<ul>
				<li class="col-xs-4 index_sel">
					<a href="<?php echo U('Index/index');?>">首页</a>
				</li>
				<li class="col-xs-4 withdraw_on">
					<a href="<?php echo U('Repay/index');?>">借款</a>
				</li>
				<li class="col-xs-4 more">
					<a href="<?php echo U('Index/more');?>">我的</a>
				</li>
			</ul>
		</div>
	</body>
	<script>

		$(function(){
			$("#nextBtn").on('click',function(){
				var zhishuRelation = $("#zhishu").val();
				var zhishuName = $("input[name='zhishuName']").val();
				var zhishuPhone = $("input[name='zhishuPhone']").val();
				var jinjiRelation = $("#jinji").val();
				var jinjiName = $("input[name='jinjiName']").val();
				var jinjiPhone = $("input[name='jinjiPhone']").val();
				if(zhishuRelation.length == 0){
					cvphp.msg({
	    				content: '请选择直系亲属关系'
	    			});
	    			return ;
				}
				if(zhishuRelation == '-1'){
					cvphp.msg({
	    				content: '请选择直系亲属关系'
	    			});
	    			return ;
				}
				if(zhishuName.length == 0){
					cvphp.msg({
	    				content: '请输入直系亲属姓名'
	    			});
	    			return ;
				}
				if(!cvphp.ismobile(zhishuPhone)){
					cvphp.msg({
	    				content: '请输入规范的手机号'
	    			});
	    			return ;
				}
				if(jinjiRelation.length == 0){
					cvphp.msg({
	    				content: '请选择直系亲属关系'
	    			});
	    			return ;
				}
			  if(jinjiRelation == '-1'){
					cvphp.msg({
	    				content: '请选择直系亲属关系'
	    			});
	    			return ;
				}
				if(jinjiName.length == 0){
					cvphp.msg({
	    				content: '请输入直系亲属姓名'
	    			});
	    			return ;
				}
				if(!cvphp.ismobile(jinjiPhone)){
					cvphp.msg({
	    				content: '请输入规范的手机号'
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