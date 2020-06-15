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
		<title>身份证信息 - 信息认证 - <?php
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
		<div class="fileDiv row">
			<ul>
				<li class="col-xs-6">
					<img src="__PUBLIC__/Wchat/images/ic_commit_idcard_img_front.png">
					<span>本人身份证正面照</span>
					<div class="shangchuang">
						<form action="<?php echo U('Info/uploadImg');?>" method="post" enctype="multipart/form-data">
							<a href="javascript:;">点击上传</a>
							<input type="file" name="front" />
							<input type="hidden" name="fileName" value="front" />
						</form>
					</div>
				</li>
				<li class="col-xs-6">
					<img src="__PUBLIC__/Wchat/images/ic_dialog_id_back.png">
					<span>本人身份证反面照</span>
					<div class="shangchuang">
						<form action="<?php echo U('Info/uploadImg');?>" method="post" enctype="multipart/form-data">
							<a href="javascript:;">点击上传</a>
							<input type="file" name="back" />
							<input type="hidden" name="fileName" value="back" />
						</form>
					</div>
				</li>
			</ul>
		</div>
		<form action="<?php echo U('Info/identityAuth');?>" method="post" id="identity">
			<input type="hidden" name="front" />
			<input type="hidden" name="back" />
			<div class="row xinxi">
				<ul>
					<li class="col-xs-12">
						<label>本人姓名</label>
						<input type="text" placeholder="请输入真实姓名" class="form-control" name="realName">
					</li>
					<li class="col-xs-12">
						<label>本人身份证号码</label>
						<input type="text" placeholder="请输入身份证号码" class="form-control" name="idCard">
					</li>
				</ul>
			</div>
		</form>
		<div class="footer" style="bottom: 3.2rem;">
			<button class="but1" id="NextBtn">下一步</button>
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
		<!-- <link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
<!--<div style="clear: both; height: 3.2rem;"></div>-->
<div class="foot">
	<ul>
    	<li class="col-xs-4 index_sel">
        	<a href="<?php echo U('Index/index');?>">首页</a>
        </li>
        <li class="col-xs-4 withdraw">
        	<a href="<?php echo U('Repay/index');?>">借款</a>
        </li>
        <li class="col-xs-4 more">
        	<a href="<?php echo U('Index/more');?>">我的</a>
        </li>
    </ul>
</div> -->
	</body>
	<script>
		$(function(){
			$("input[type='file']").on('change',function(){
				var value = $(this).val();
				if(value.length == 0){
					cvphp.msg({
	    				content: '请选择文件'
	    			});
					return false;
				}
				//上传图片
				var obj = $(this).parent();
				var fileinputObj = this;

			layer.open({
						content: '正在保存...'
						,type: 2
						,time: 2		
						});
			setTimeout(function(){
		    			
						var imgUrl = "__PUBLIC__/Wchat/images/sc1.png";
						var nem= $(fileinputObj).attr('name');
						if(nem == 'back'){
							var imgUrl = "__PUBLIC__/Wchat/images/sc2.png";
						}
						
						$("#identity").find("input[name='"+$(fileinputObj).attr('name')+"']").val(imgUrl);
						$($($(obj).parent()).parent()).find("img").attr('src',imgUrl);
			},2000);
			
			});
			
			
			$("#NextBtn").on('click',function(){
				var realName = $("input[name='realName']").val();
				var idCard   = $("input[name='idCard']").val();
				var frontImg = $("#identity input[name='front']").val();
				var backImg = $("#identity input[name='back']").val();
				if(frontImg.length <= 0){
					cvphp.msg({
	    				content: '请上传身份证正面照'
	    			});
					return false;
				}
				if(backImg.length <= 0){
					cvphp.msg({
	    				content: '请上传身份证反面照'
	    			});
					return false;
				}
				if(realName.length < 2){
					cvphp.msg({
	    				content: '请输入真实的姓名'
	    			});
					return false;
				}
				if(idCard.length != 15 && idCard.length != 18){
					cvphp.msg({
	    				content: '请输入规范的身份证号码'
	    			});
					return false;
				}
				cvphp.submit($("#identity"),function(data){
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