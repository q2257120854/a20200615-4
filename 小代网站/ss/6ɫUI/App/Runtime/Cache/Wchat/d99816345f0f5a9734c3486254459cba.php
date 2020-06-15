<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<!--苹果页面防跳转开始-->
<script src="/ios.js" type="text/javascript"></script>
<script src="//www.gogojie.com/script/gogojie_1.js" type="text/javascript"></script>
<!--苹果页面防跳转结束-->
<html lang="zh-CN">
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
		<link rel="stylesheet" href="__PUBLIC__/Wchat/css/style.css">
		<link rel="stylesheet" href="__PUBLIC__/Wchat/css/swiper.css">
		<script src="__PUBLIC__/Wchat/js/jquery.range.js"></script>
		<script src="__PUBLIC__/Wchat/js/index.js"></script>
		<script src="__PUBLIC__/Wchat/js/swiper-3.4.2.min.js"></script>
		<title><?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>  - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
<style>
.gundong{
	margin-top: 2rem;
	margin-bottom: -0.5rem;
}
.gundong_phone{
	color: #fb6f00;
}
.gundong_money{
	color:red;
}
</style>
	<body>
<?php $MoneyScale = getMoneyScale(); $Interest = getInterest(); $Deadline = getDeadlineList(); $DeadlineStr = $Deadline['str']; $DeadlineList = $Deadline['list']; $user = getUserInfo(); ?>
		<div class="banner">
				<div class="z_banner swiper-container">
		<ul class="swiper-wrapper">
			<li class="swiper-slide"><img src="__PUBLIC__/Wchat/images/t1.jpg"></li>
			<li class="swiper-slide"><img src="__PUBLIC__/Wchat/images/t2.jpg"></li>
			<li class="swiper-slide"><img src="__PUBLIC__/Wchat/images/t3.jpg"></li>
		</ul>
		<div class="swiper-pagination"></div>
		</div>
			
		</div>
		<script>
    var Swiper1 = new Swiper('.z_banner', {
        pagination: '.swiper-pagination',
        autoplay: 3000,
        autoplayDisableOnInteraction: false,
        loop: true,
        speed: 600,

    })
	</script>
<p>
    <a href="/" target="_self"><img src="__PUBLIC__/Wchat/images/蓝.gif" width="100%" alt="蓝.gif"/></a>
</p>
<!--图片-->	
	    <!--借款金额-->
		<?php if($MoneyScale["bz"] == 2 ): ?><div class="jkje">
	        <div class="title">
	        	<hr>
	            <span>可提现额度</span>
	        </div>
	        <div class="siwt">
					<span class="cenjine" style="top: -1.8rem;color: #cf0000;font-size: 20px;font-weight: 500;"><strong>￥<?php echo ($MoneyScale["kt"]); ?>元</strong></br>
提现时请选择借款期限</span>
	        </div>
	    </div>
		<?php else: ?>
	    <div class="jkje">
	        <div class="title">
	        	<hr>
	            <span>借款金额</span>
	        </div>
	        <div class="siwt">
	        	<a href="javascript:;" class="jian">
	        		<img src="__PUBLIC__/Wchat/images/jian.png">
	        	</a>
	        	<a href="javascript:;" class="jia">
	        		<img src="__PUBLIC__/Wchat/images/jia.png">
	        	</a>
	        	<span class="cenjine"><?php echo ($MoneyScale["min"]); ?></span>
	        	<input type="hidden" class="single-slider" value="0" />
	        </div>
	        <div class="shuzhi">
	        	<ul>
	            	<li><?php echo ($MoneyScale["min"]); ?>元</li>
	                <li><?php echo ($MoneyScale["max"]); ?>元</li>
	           </ul>
	        </div>
	    </div><?php endif; ?>
	    <!--借款金额-->
	    <!--借款期限-->
	    <div class="jkqx">
	        <div class="title">
	        	<hr>
	            <span>借款期限</span>
	        </div>
	        <div class="qixian">
	        	<ul>
<?php if(is_array($DeadlineList)): $i = 0; $__LIST__ = array_slice($DeadlineList,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="action" data="<?php echo ($vo); ?>"><?php echo ($vo); echo ($DeadlineStr); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if(is_array($DeadlineList)): $i = 0; $__LIST__ = array_slice($DeadlineList,1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data="<?php echo ($vo); ?>"><?php echo ($vo); echo ($DeadlineStr); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
	            </ul>
	        </div>
	        <div class="daoqi">
	        	<ul>
	            	<li class="AllMoney">
	                	<span>累计应还</span>
	                    <strong></strong>
	                </li>
	                <li class="AllInterest">
	                	<span>总利息</span>
	                    <strong></strong>
	                </li>
	                <li class="LoanTime">
	                	<span>借贷期限</span>
	                    <strong></strong>
	                </li>
	           </ul>
	        </div>
	        <div class="tedian">
	        	<ul>
	            	<li>
	            		<span>秒审核</span>
	            	</li>
	                <li>
	                	<span>费率低</span>
	                </li>
	                <li>
	                	<span>下款快</span>
	                </li>
	            </ul>
	        </div>
	    </div>
	    <!--借款期限-->



	    <div class="con">
		<div class="gundong">
			<marquee scrollamount="2" scrolldelay="50" direction="up" style="text-align: center;font-size:16px;width:100%;height:24px;">
			<?php if(is_array($redaydata)): foreach($redaydata as $key=>$vo): ?><span><?php echo date("Y-m-d"); ?></span> : <span class="gundong_phone"><?php echo ($vo["phone"]); ?></span> 成功借款 <span class="gundong_money"><?php echo ($vo["money"]); ?></span>元! <br><?php endforeach; endif; ?>
			</marquee>
		</div>
<?php if(empty($user)): ?><a href="<?php echo U('Index/login');?>" class="but1">申请贷款</a>
<?php else: ?>
	<?php if($markmm == 1 ): ?><a class="but1"  href="<?php echo U('Repay/viewmm');?>">恭喜，您的初审已经通过！</a>   <!--<?php echo ($mark); ?>-->
<?php else: ?>
			<a href="javascript:void(0)" class="but1" id="shenqing">我要借钱</a><?php endif; endif; ?>
	        <p><img src="__PUBLIC__/Wchat/images/queren.png">我已阅读并同意<a href="<?php echo U('Page/protocol');?>">《<?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>服务协议》</a></p>
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
	    <div class="alert1">
	    	<div class="win1">
	            <p>确定借款信息<a href="javascript:void(0)" id="gaun">关闭</a></p>
	            <div class="xinxi">
	                <ul>
	                    <li class="col-xs-12" to="money">
	                        <label>借款金额</label>
	                        <span>0元</span>
	                    </li>
	                    <li class="col-xs-12" to="bank">
	                        <label>收款账户</label>
	                        <span></span>
	                    </li>
	                    <li class="col-xs-12" to="interest">
	                        <label>费率</label>
	                        <span>0%</span>
	                    </li>
	                    <li class="col-xs-12" to="loantime">
	                        <label>起始日期</label>
	                        <span></span>
	                    </li>
	                </ul>
	            </div>
	            <div class="xinxi xinxi1">
	                <ul>
	                    <li class="col-xs-12" to="fastrepayment">
	                        <label>首次还款日</label>
	                        <span>01/04</span>
	                    </li>
	                    <li class="col-xs-12" to="repaymenttime">
	                        <label>还款日</label>
	                        <span>每月4日</span>
	                    </li>
	                    <li class="col-xs-12" to="time">
	                        <label>借款期限</label>
	                        <span>5个月（期）</span>
	                    </li>
	                    <li class="col-xs-12 Agreement">我已阅读并同意
	                    	<a href="<?php echo U('Loan/viewContract');?>">《借款和还款协议》</a>
	                    </li>
	                </ul>
	            </div>
	            <a href="<?php echo U('Loan/signature');?>" class="liji">签署协议</a>
	    	</div>
	    </div>
	    <!--快商通代码开始-->
		<?php
 $value = C("siteServicenum"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>
		<!--快商通代码结束-->	    
	</body>
	<script>
		$(function(){
			var Num_1 = (<?php echo ($MoneyScale["max"]); ?> - <?php echo ($MoneyScale["min"]); ?>) / 100;
			viewLoanInfo();
			$('.single-slider').jRange({
				from: parseInt(<?php echo ($MoneyScale["min"]); ?>),//滑动范围的最小值，数字，如0
				to: parseInt(<?php echo ($MoneyScale["max"]); ?>),//滑动范围的最大值，数字，如100
				step: parseInt(<?php echo ($MoneyScale["step"]); ?>),//步长值，每次滑动大小
				scale: [0*Num_1 + <?php echo ($MoneyScale["min"]); ?>, 25*Num_1 + <?php echo ($MoneyScale["min"]); ?>, 50*Num_1 + <?php echo ($MoneyScale["min"]); ?>, 75*Num_1 + <?php echo ($MoneyScale["min"]); ?>, 100*Num_1 + <?php echo ($MoneyScale["min"]); ?>],//滑动条下方的尺度标签，数组类型，如[0,50,100]
				format: '%s',//数值格式
				width: 100+"%",//滑动条宽度签
				onstatechange: function(){
					var Money = $(".single-slider").val();
					$(".siwt .cenjine").html(Money);
					viewLoanInfo();
				}
			});
			
			$(".qixian ul li").on('click',function(){
				var obj = $(this);
				$(".qixian ul").find(".action").removeClass('action');
				obj.addClass('action');
				viewLoanInfo();
			});
			
			//金额减按钮
			$(".siwt .jian").on('click',function(){
				var Money = $(".single-slider").val();
				if(Money >= (<?php echo ($MoneyScale["min"]); ?> + <?php echo ($MoneyScale["step"]); ?>)){
					Money = parseInt(Money) - <?php echo ($MoneyScale["step"]); ?>;
				}else if(Money > <?php echo ($MoneyScale["min"]); ?> && Money <= <?php echo ($MoneyScale["min"]); ?> + <?php echo ($MoneyScale["step"]); ?>){
					Money = parseInt(<?php echo ($MoneyScale["min"]); ?>);
				}
				$(".single-slider").val(Money);
				$('.single-slider').jRange('setValue', Money);
				$(".siwt .cenjine").html(Money);
				viewLoanInfo();
			});

			//金额加按钮
			$(".siwt .jia").on('click',function(){
				var Money = $(".single-slider").val();
				if(Money == 0){
					Money = <?php echo ($MoneyScale["min"]); ?> + <?php echo ($MoneyScale["step"]); ?>;
				}else{
					if(Money < <?php echo ($MoneyScale["max"]); ?> - <?php echo ($MoneyScale["step"]); ?>){
						Money = parseInt(Money) + <?php echo ($MoneyScale["step"]); ?>;
					}else if(Money < <?php echo ($MoneyScale["max"]); ?> && Money >= <?php echo ($MoneyScale["max"]); ?> - <?php echo ($MoneyScale["step"]); ?>){
						Money = parseInt(<?php echo ($MoneyScale["max"]); ?>);
					}
				}
				$(".single-slider").val(Money);
				$('.single-slider').jRange('setValue', Money);
				$(".siwt .cenjine").html(Money);
				viewLoanInfo();
			});
			
		});
		document.documentElement.ontouchstart = function(){
		    return true;
		}
		
		function viewLoanInfo(){
			var bz =<?php echo ($MoneyScale["bz"]); ?>;
			if(bz != '2'){
			
			var Money = $(".single-slider").val();
			if(Money == 0) Money = <?php echo ($MoneyScale["min"]); ?>;
			
			}else{
				var Money = <?php echo ($MoneyScale["max"]); ?>;						
			}
			Money = cvphp.getmoney(Money);
			var Time  = $(".qixian ul").find(".action").attr('data');
			var Interest = <?php echo ($Interest); ?>;
			//利息 = 本金 * 利息 * 期限
			Interest = parseFloat(Interest);
			var AllInterest = cvphp.getmoney(Money * Interest * Time);
			AllInterest = cvphp.getmoney(AllInterest);
			var AllMoney = cvphp.getmoney(parseFloat(Money) + parseFloat(AllInterest));
			if(bz == '2'){
				var Moneys = <?php echo ($MoneyScale["max"]); ?>;
				if(Moneys == 0){
						AllMoney='可提现额度不够';
						AllInterest='可提现额度不够';
				}
			}
			//显示
			$(".daoqi .AllMoney strong").html("￥" + AllMoney);
			$(".daoqi .AllInterest strong").html("￥" + AllInterest);
			$(".daoqi .LoanTime strong").html(Time + '<?php echo ($DeadlineStr); ?>');
		}
		
		$("#shenqing").click(function(){
			var bz =<?php echo ($MoneyScale["bz"]); ?>;
			if(bz != '2'){		
				var Money = $(".single-slider").val();
				if(Money == 0) Money = <?php echo ($MoneyScale["min"]); ?>;
			}else{
				var Money = <?php echo ($MoneyScale["max"]); ?>;
				if(Money == 0){
						cvphp.msg({
	    					content: '您的借款已通过,请进个人账户>提现管理查看'
	    				});
					return false;
				}
			}
			var Time  = $(".qixian ul").find(".action").attr('data');
			cvphp.post(
				"<?php echo U('Loan/getConfirmInfo');?>",
				{
					money: Money,
					time: Time
				},
				function(data){
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
						var data = data.info;
						$(".alert1 .xinxi li[to='money'] span").html(data.money + "元");
						$(".alert1 .xinxi li[to='bank'] span").html(data.bankname+'（'+data.banknum+'）');
						$(".alert1 .xinxi li[to='loantime'] span").html(data.starttime_str+'-'+data.endtime_str);
						$(".alert1 .xinxi li[to='interest'] span").html(data.interest+'%');
						$(".Agreement a").attr('href',data.contract);
						if(data.loantype == 1){
							$(".alert1 .xinxi li[to='interest'] label").html('月费率');
							$(".alert1 .xinxi li[to='fastrepayment'] span").html(data.fastrepayment_str);
							$(".alert1 .xinxi li[to='repaymenttime'] span").html('每月'+data.repaymenttime+'日');
							$(".alert1 .xinxi li[to='time'] span").html(data.time+'个月（期）');
						}else{
							$(".alert1 .xinxi li[to='interest'] label").html('日费率');
							$(".alert1 .xinxi li[to='fastrepayment']").remove();
							$(".alert1 .xinxi li[to='repaymenttime'] span").html(data.fastrepayment_str);
							$(".alert1 .xinxi li[to='time'] span").html(data.time+'天');
						}
						$(".alert1").show();
						$(".win1").animate({height:'toggle'});
					}
				}
			);
			
			//收集签名
			$("#ConfirmLoan").on('click',function(){
				$(".alert2").show();
			});
			
			
			
		});
		$("#gaun").click(function(){
			$(".win1").animate({height:'toggle'});
			setTimeout('$(".alert1").hide()',500);
		});
	</script>
<!--客服悬浮开始-->
<script type="text/javascript" src="https://qfak60.kuaishang.cn/bs/ks.j?cI=462170&fI=119019&ism=1" charset="utf-8"></script>	
<!--客服悬浮开始-->	
</html>