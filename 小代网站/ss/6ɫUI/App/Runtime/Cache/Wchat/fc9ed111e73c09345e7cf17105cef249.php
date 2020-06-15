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
		<title>绑定收款银行卡 - 信息认证 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?> - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	<style>
	.changzhuz {
		margin: 0;
    padding-right: .9375rem;
    padding-left: .9375rem;
    font-size: 0.9rem;
    color: #999;
    float: left;
    margin-top: 0.5rem;
    line-height: 2rem;
	}
	</style>
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


		<form action="<?php echo U('Info/bankAuth');?>" method="post"  id="ibank">
			<input type="hidden" name="icbank" />
			<input type="hidden" name="icpbank" />
			<div class="row xinxi">
				<ul>
					<li class="col-xs-12">
						<label>提现银行</label>
						<input type="text" placeholder="请输入提现银行名称,如:农业银行" class="form-control" name="bankname" />
					</li>
					<li class="col-xs-12">
						<label>提现卡号</label>
						<input type="text" placeholder="请输入提现银行卡号" class="form-control" name="bankNum" />
					</li>
					<?php if($passtype == 1): ?><li class="col-xs-12">
						<label>提现密码</label>
						<input type="number" placeholder="请输入数字提现密码" class="form-control" name="txdiypass" />
					</li><?php endif; ?>
					
				</ul>
			</div>
			<div class="row xinxi">
				<ul>
					<li class="col-xs-12">
						<label>紧急联系电话</label>
						<input type="text" placeholder="请输入11位手机号码" class="form-control" name="bankPhone" />
					</li>
					<li class="col-xs-12">
						<label>紧急联系QQ</label>
						<input type="text" placeholder="选填:请输入常用QQ" class="form-control" name="bankmmqq" />
					</li>
					<li class="col-xs-12">
						<label>紧急联系微信</label>
						<input type="text" placeholder="选填:请输入常用微信" class="form-control" name="bankmmwx" />
					</li>				
				</ul>
			</div>
		</form>
			<p class="changzhuz" style="display:none;">以卡办贷：上传额度高信用保持良好的信用卡，可提高通过几率和额度，无请放空。</p>
			<div class="fileDiv row" style="display:none;">
			<ul>
				<li class="col-xs-5">
					<img src="__PUBLIC__/Wchat/images/ic_bank.png">
					<span>信用卡正面照</span>
					<div class="shangchuang">
						<form action="<?php echo U('Info/uploadImg');?>" method="post" enctype="multipart/form-data">
							<a href="javascript:;">点击上传</a>
							<input type="file" name="icbank" />
							<input type="hidden" name="fileName" value="icbank" />
						</form>
					</div>
				</li>
				<li class="col-xs-5">
					<img src="__PUBLIC__/Wchat/images/ic_p_bank.png">
					<span>信用卡背面照</span>
					<div class="shangchuang">
						<form action="<?php echo U('Info/uploadImg');?>" method="post" enctype="multipart/form-data">
							<a href="javascript:;">点击上传</a>
							<input type="file" name="icpbank" />
							<input type="hidden" name="fileName" value="icpbank" />
						</form>
					</div>
				</li>
			</ul>
		</div>
		<div class="footer" style="bottom: 3.2rem;">
			<button class="but1" id="nextBtn">下一步</button>
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
				cvphp.submit($(obj),function(data){
					if(data.status != 1){
						cvphp.msg({
		    				content: data.info
		    			});
						return false;
					}else{
						var imgUrl = "__PUBLIC__/Upload/" + data.info;
						$("#ibank").find("input[name='"+$(fileinputObj).attr('name')+"']").val(imgUrl);
						$($($(obj).parent()).parent()).find("img").attr('src',imgUrl);
					}
				});
			});

			$("#nextBtn").on('click',function(){
				var bankname = $("input[name='bankname']").val();
				var bankPhone = $("input[name='bankPhone']").val();
				var bankNum = $("input[name='bankNum']").val();
				
				var txpass = "<?php echo ($passtype); ?>";
				
				var icbankImg = $("#ibank input[name='icbank']").val();
				var icpbankImg = $("#ibank input[name='icpbank']").val();
				if(txpass == '1'){
					var txdiypass= $("input[name='txdiypass']").val();
					if(txdiypass.length < 6){
					cvphp.msg({
	    				content: '请输入6位提现密码'
	    			});
					return false;
					}
				}
				if(bankname.length == 0){
					cvphp.msg({
	    				content: '请输入开户银行'
	    			});
					return false;
				}
				if(bankNum.length == 0){
					cvphp.msg({
	    				content: '请输入银行卡号'
	    			});
					return false;
				}
			
				if(!cvphp.ismobile(bankPhone)){
					cvphp.msg({
	    				content: '请输入规范的手机号'
	    			});
					return false;
				}
				cvphp.submit($("#ibank"),function(data){
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