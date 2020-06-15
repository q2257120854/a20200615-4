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
		<link href="__PUBLIC__/Wchat/css/logincss.css" rel="stylesheet">
		<title>登录 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
		<div class="logo">
			<img src="<?php
 $value = C("siteLogo"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
			<p><?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></p>
	    </div>
	    <div class="login_res">
	     	<div class="tab">
	        	<ul>
	            	<li>
	                	<em></em>
	                    <em></em>
	                    <span>登录</span>
	                </li>
	                <li class="action">
	                	<em></em>
	                    <em></em>
	                    <span>注册</span>
	                </li>
	            </ul>
	       </div>
	        <div class="con">
	            <div class="login_con">
	            	<form action="<?php echo U('Index/ajaxLogin');?>" method="post" id="loginForm">
		            	<ul>
		                	<li>
		                		<input type="number" placeholder="请输入11位数字" class="user" name="username">
		                	</li>
		                    <li class="fu_pwd">
		                    	<input type="password" placeholder="请输入登录密码" class="pwd" name="password">
		                    	<a href="<?php echo U('Index/forgetpwd');?>">忘记密码？</a>
		                    </li>
		                </ul>
		                <button class="abut" type="button" id="loginBtn">登录</button>
	            	</form>
	            </div>
<p style="text-align: center;">
    <br/>
</p>
<p>
    <a href="/" target="_self"><img src="__PUBLIC__/Wchat/images/y2.png" width="100%" alt="y2.png"/></a>
</p>

	            <div class="res_con">
					<form action="<?php echo U('Index/ajaxReg');?>" method="post" id="regForm">
		            	<ul>
		                	<li>
		                		<input type="text" placeholder="请输入11位数字" class="user">
		                	</li>
		                    <li class="yz">
		                    	<input type="text" placeholder="请输入验证码" class="yzm">
		                    	<button type="button">发送验证码</button>
		                    </li>
		                    <li class="fu_pwd">
		                    	<input type="password" placeholder="请输入登录密码" class="pwd">
		                    </li>
		                </ul>
		                <p><img src="__PUBLIC__/Wchat/images/dj2.png">我以阅读并同意<a href="<?php echo U('Page/protocol');?>">《<?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>服务协议》</a></p>
		                <button class="abut1" type="button" id="regBtn" disabled="disabled">注册</button>
		                <div class="verify">
		                	<p>
		                		<img src="<?php echo U('Index/verify');?>" alt="看不清,换一张" />
		                	</p>
		                	<p>
		                		<input type="number" value="" placeholder="输入验证码" />
		                	</p>
		                	<p>
		                		<a class="btn" id="verifySendcode">确定</a>
		                		<a class="btn btnred" id="verifyClose">取消</a>
		                	</p>
		                </div>
					</form>
	            </div>
	        </div>
	    </div>
    
	    <div class="zhezhao"></div>
	    <div class="footer">
	    	<img src="__PUBLIC__/Wchat/images/logo_foot.png">
	       	<?php
 $value = C("siteCorporate"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>
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
	    <script>
	    	var resendTime = 0;
	    	var resendFun;
	    	$(function(){
	    		/*登录*/
	    		$("#loginBtn").on('click',function(){
	    			if(!cvphp.ismobile( $("#loginForm .user").val() )){
	    				cvphp.msg({
	    					content: '手机号码不符合规范'
	    				});
	    				return false;
	    			}
	    			if(! $("#loginForm .pwd").val() ){
	    				cvphp.msg({
	    					content: '请输入登录密码'
	    				});
	    				return false;
	    			}
	    			cvphp.submit($("#loginForm"),function(data){
	    				if(data.status != 1){
	    					cvphp.msg({
	    						content: data.info,
	    					});
	    				}else{
	    					cvphp.msg({
	    						content: '登录成功',
	    					});
	    					setTimeout(function(){window.location.href = data.url;},3000);
	    				}
	    			});
	    			return false;
	    		});
	    		/*注册*/
	    		$(".res_con .yz button").on('click',function(){
	    			if(!cvphp.ismobile( $("#regForm .user").val() )){
	    				cvphp.msg({
	    					content: '手机号码不符合规范'
	    				});
	    				return false;
	    			}
	    			$(".verify input").val('');
	    			var imgUrl = "<?php echo U('Index/verify',array('t','randTime'));?>";
	    			imgUrl = imgUrl.replace(/randTime/,Date.parse(new Date()));
	    			$(".verify img").attr('src',imgUrl);
	    			$(".verify").show();
	    			$(".zhezhao").show();
	    			$(".verify input").focus();
	    		});
	    		$("#verifyClose").on('click',function(){
	    			$(".verify").hide();
	    			$(".zhezhao").hide();
	    		});
	    		$(".verify img").on('click',function(){
	    			var imgUrl = "<?php echo U('Index/verify',array('t','randTime'));?>";
	    			imgUrl = imgUrl.replace(/randTime/,Date.parse(new Date()));
	    			$(".verify img").attr('src',imgUrl);
	    		});
	    		$("#verifySendcode").on('click',function(){
	    			$(".verify").hide();
	    			$(".zhezhao").hide();
	    			var code = $(".verify input").val();
	    			if(code.length != 4){
						cvphp.msg({
	    					content: '请输入正确的图形验证码',
	    				});
	    				return ;
	    			}
	    			cvphp.post(
	    				"<?php echo U('Sms/sendcode');?>",
	    				{
	    					verify:code,
	    					user:$("#regForm .user").val(),
	    					type:'reg'
	    				},
	    				function(data){
		    				if(data.status != 1){
		    					cvphp.msg({
		    						content: data.info,
		    					});
		    				}else{
		    					resendTime = 59;
		    					resendFun = setInterval(resend,1000);
				    			$(".verify").hide();
				    			$(".zhezhao").hide();
		    				}
	    				}
	    			);
	    		});
	    		$("#regForm .yzm").on('input',function(){
	    			var code = $(this).val();
	    			if(code.length == 4){
	    				$("#regBtn").removeAttr('disabled');
	    				$("#regBtn").removeClass('abut1');
	    				$("#regBtn").addClass('abut');
	    			}else{
	    				$("#regBtn").attr('disabled',"true");
	    				$("#regBtn").removeClass('abut');
	    				$("#regBtn").addClass('abut1');
	    			}
	    		});
	    		$("#regBtn").on('click',function(){
	    			if(!cvphp.ismobile( $("#regForm .user").val() )){
	    				cvphp.msg({
	    					content: '手机号码不符合规范'
	    				});
	    				return false;
	    			}
	    			if($("#regForm .yzm").val().length != 4){
	    				cvphp.msg({
	    					content: '请输入短信验证码'
	    				});
	    				return false;
	    			}
	    			if($("#regForm .pwd").val().length < 6 || $("#regForm .pwd").val().length > 18){
	    				cvphp.msg({
	    					content: '请输入6-18位登录密码'
	    				});
	    				return false;
	    			}
	    			cvphp.post(
	    				"<?php echo U('Index/ajaxReg');?>",
	    				{
	    					username:$("#regForm .user").val(),
	    					code:$("#regForm .yzm").val(),
	    					password:$("#regForm .pwd").val()
	    				},
	    				function(data){
		    				if(data.status != 1){
		    					cvphp.msg({
		    						content: data.info,
		    					});
		    				}else{
		    					cvphp.msg({
		    						content: '注册成功',
		    					});
		    					setTimeout(function(){window.location.href = data.url;},3000);
		    				}
	    				}
	    			);
	    		});
	    	});
	    	function resend(){
	    		if(resendTime == 1){
	    			$(".res_con .yz button").html('重新发送');
	    			clearInterval(resendFun);
	    			$(".res_con .yz button").removeAttr('disabled');
	    		}else{
	    			resendTime--;
	    			$(".res_con .yz button").html(resendTime + ' 秒重试');
	    			$(".res_con .yz button").attr('disabled',"true");
	    		}
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
	</body>
</html>