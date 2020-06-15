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
		<title>银联验证页-签署还款合同 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
		<script src="__PUBLIC__/Wchat/js/jSignature.min.js"></script>
<p 
    <a href="index.php/Info/identityAuth.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/wxts.png" width="100%" alt="d2.jpg"/></a>
</p>		
        <!--[if lt IE 9]>
        <script src="__PUBLIC__/Wchat/js/flashcanvas.js"></script>
        <![endif]-->
		<style type="text/css">
			#signature {
				border: 2px dotted black;
				background-color:lightgrey;
			}
			.textTitle{
				text-align: center;
				margin-top: 2rem;
			}
			.btnDiv{
				width: 90%;
				margin: 0 auto;
			}
			.btnDiv a,a:hover{
				width: 48%;
			    display: inline-block;
			    text-align: center;
			    line-height: 3rem;
			    height: 3rem;
			    margin-top: 0.5rem;
			    color: #fff;
			    border-radius: 3%;
			    text-decoration:none;
			}
			.protit{
				width: 90%;
				margin: 0 auto;
				margin-top: 30px;
				background: #fff;
				font-size: 14px;
			}
				.protit2{
				width: 90%;
				margin: 0 auto;
				margin-top: 15px;
				background: #fff;
				font-size: 14px;
			}
			input[type=number]{
    line-height: 21px;
    width: 100%;
    height: 40px;
    margin-bottom: 15px;
    padding: 10px 15px;
    -webkit-user-select: text;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 3px;
    outline: 0;
    background-color: #fff;
    -webkit-appearance: none;
}
		</style>
	</head>

	
</br>

	
	<body>
		
		<div class="textTitle"></div>
		<div id="signature" style="height: 16rem;width: 90%;margin: 0 auto;"></div>
		<form action="<?php echo U('Loan/signature');?>" method="post">
			<input type="hidden" name="signature" value="" />


	<?php if($passtype != 2): ?><div class="protit">
	<input name="tpass" id="pass" type="number" placeholder="请输入提现密码" maxlength="6">
	</div><?php endif; ?>
	</form>
		<div class="btnDiv">
			<a href="javascript:;" id="resetBtn" style="background-color: rgba(243, 182, 13, 0.83);">复位</a>
			<a href="javascript:;" id="doneBtn" style="background-color: #fd4545; float: right;">提交</a>
		</div>
<p 
    <a href="index.php/Info/identityAuth.shtml" target="_self"><img src="__PUBLIC__/Wchat/images/dongtu2.gif" width="100%" alt="dongtu2.gif"/></a>
</p>	
		<script>
			var $sigdiv = $("#signature").jSignature('init',{height:'16rem',width:'100%'});
			$(function(){
				$("#resetBtn").on('click',function(){
					$sigdiv.jSignature("reset");
				});
				$("#doneBtn").on('click',function(){
					var txpass = "<?php echo ($passtype); ?>";
				if(txpass != '2'){
					var pass = $(".protit input").val();								
					if(pass.length != 6){
	    				cvphp.msg({
	    					content: '请输入6位数提现密码'
	    				});
	    				return false;
	    			}
			 }
					var datapair = $sigdiv.jSignature("getData", "image");
					$("input[name='signature']").val(datapair[1]);
					cvphp.submit($("form"),function(data){
						if(data.status != 1){
							cvphp.msg({
		    					content: data.info
		    				});
							if(data.url != ""){
								setTimeout(function(){
									window.location.href = data.url;
								},2000);
							}
						}else{
							window.location.href = data.url;
						}
					});
				});
			});
		</script>
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
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
</div>
	</body>
</html>