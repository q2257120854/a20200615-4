<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>商品支付</title>
    <style>
      @media screen and (max-width:680px){
        .tip-text{display:none!important}
        #btn-refresh{display:block!important}
      }
	  
	 .remainseconds {
  width: 140px;
  margin: 0 auto;
  height: 80px;
  padding: 10px 35px;
  text-align: center;//h
  
}
.remainseconds .time {
  width: 50px;
  height: 80px;//u
}
.remainseconds .time b {
  font-size: 32px;
  font-weight: 300;//o
}
.remainseconds .time b,
.remainseconds .time em {
  display: block;//s
}
.remainseconds .time em {
  font-style: normal;//h
  color: #888;//a
}
@media (max-width: 375px) {
  .container {
    padding: 0;//n
  }
  .remainseconds {
    padding: 0 35px 10px 35px;
    height: 80px;//z
  }
  .remainseconds .time {
    height: 100%;//h
  }
  .remainseconds .time b {
    font-size: 36px;//i
  }
}
@media (max-width: 320px) {
  .remainseconds {
    padding: 0 35px 10px 35px;
    height: 87px;//f
  }
  .remainseconds .time {
    height: 100%;//u
  }
  .remainseconds .time b {
    font-size: 36px;
  }
  .container {
    padding: 0;
  }
  .qrcode {
    width: 200px;
    height: 200px;
  }
  .realprice {
    font-size: 36px;
  }
}
.minutes {
  float: left;
}
.seconds {
  float: left;
}
.colon {
  float: left;
  width: 20px;
  font-size: 30px;
  line-height: 50px;
  font-family: Vernada, 'Microsoft Yahei';
}
.tips {
  border-top: 1px dotted #eee;
  background: #fff;
  padding: 15px 0;
  line-height: 25px;
  overflow: hidden;
  display: block;
  clear: both;
}
.help {
  line-height: 25px;
  padding: 15px 0;
  text-align: center;
  font-size: 14px;
}
.footer {
  height: 60px;
  line-height: 60px;
  text-align: center;
  font-size: 12px;
}
      .mod-ct .tip {
    margin-top: 20px;
    border-top: 1px dashed #e5e5e5;
    padding: 10px 0;
    position: relative;
}
.ico-scan {
    display: inline-block;
    width: 56px;
    height: 55px;
    background: url(/static/wechat-pay.png) 0 0 no-repeat;
    vertical-align: middle;
}
 .tip-text1 {
    display: inline-block;
    vertical-align: middle;
    text-align: left;
    margin-left: 23px;
    font-size: 16px;
    line-height: 28px;
}
    </style>
  <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
  <script type="text/javascript" src="/static/jquery.qrcode.js" ></script>
  <link href="/static/pay-simple.css?v=511" rel="stylesheet" media="screen" />
</head>
<body >
    <div id="main-container">
        <h1 class="mod-title"> <img class="ico_log"   src="/static/logo_alipay.jpg"> </h1>
<div class="order">
        </div>
        <div class="mod-ct">
		
   			 <div class="amount" id="money" style="padding-top:10px;margin:8px;">￥<?php echo $amount;?></div>
			
			
            <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
                <div class="qrcode-img-area" data-role="qrPayImg">
                    <div id="qrcode">
                    </div>
                </div>
            </div>
        
		  <div class="time-item" style="padding-top: 10px;">            
            <div class="time-item"><h1>订单:<?php echo $trade_no;?></h1> </div>
            
                            <!--其他手机浏览器+支付宝支付-->
                <div class="time-item" id="msg"><h1></h1><h1>支付完成后，请返回此页</h1></div>
             
        </div>
		  <div class="remainseconds">
            <div class="time minutes">
                <b></b>
                <em>分</em>
            </div>
            <div class="colon">:</div>
            <div class="time seconds">
                <b></b>
                <em>秒</em>
            </div>
 
      </div>
		  
         <div id="doDiv" style="">
                            <font size="3" color="red">打开支付宝 [扫一扫]  </font>
                    
                        </div>   
         
    </div>
<!--<div id="messages" hidden="hidden">123</div>-->
<div id="messages"  hidden="hidden"  >123</div>
<script type="text/javascript">
  
var ua = navigator.userAgent;

var ipad = ua.match(/(iPad).*OS\s([\d_]+)/),

isIphone =!ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/),

isAndroid = ua.match(/(Android)\s+([\d.]+)/),

isMobile = isIphone || isAndroid;

//判断


  
if(isMobile){
 
  window.location.href = "<?php echo $payurl; ?>";

}

  qrcode =  "<?php echo $payurl ?>";
  
  if(qrcode == ''){
   
 setTimeout('window.location.reload()', 1);
   }
    
  
  var url="http://qr.liantu.com/api.php?text="+encodeURIComponent(qrcode);
  

  
  console.log(qrcode);
	jQuery('#qrcode').qrcode({
		render: "canvas",
        text: qrcode,
        width: "256",               //二维码的宽度
        height: "256",              //二维码的高度
        background: "#ffffff",      //二维码的后景色
        foreground: "#000000",      //二维码的前景色
        src: './js/logo.png'             //二维码中间的图片
	});
	
	
	$(function () {
    var timer, minutes, seconds, ci, qi;
	//var intDiff = parseInt('<?php echo ($creation_time+300) - time();?>');//倒计时总秒数量
    timer = parseInt('<?php echo ($creation_time+300)- time();?>') - 1;
    ci = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $(".minutes b").text(minutes);
        $(".seconds b").text(seconds);
        if (--timer < 0) {
            $(".qrcode .expired").removeClass("hidden");
            $(".minutes b").text('00');
            $(".seconds b").text('00');
			 $(".help").html('订单已过期,请重新提交');
			 daoqi();
            clearInterval(ci);
    			
        }
    }, 1000);

	
	
});

   function daoqi(){
	   
	   layer.confirm("订单已过期,请重新提交", {
    			  icon: 2,
    			  title: '支付失败',
  				  btn: ['确认'] //按钮
  				}, function(){
  					location.href="<?php echo $error_url;?>";
  				});
        	setTimeout(function(){location.href="<?php echo $error_url;?>";},5000);
           
   }


     //订单监控  {订单监控}
    function order(){
    	$.get("<?php echo url::s('gateway/pay/automaticalipaygmQuery',"id={$id}");?>", function(result){
        	
    		//成功
    		if(result.code == '200'){
    			play(['<?php echo FILE_CACHE . "/download/sound/当前订单支付成功1.mp3";?>']);
				//回调页面
        		window.clearInterval(orderlst);
    			layer.confirm(result.msg, {
    			  icon: 1,
    			  title: '支付成功',
  				  btn: ['我知道了'] //按钮
  				}, function(){
  					location.href="<?php echo $success_url;?>";
  				});
    			setTimeout(function(){location.href="<?php echo $success_url;?>";},5000);
    		}

    		
       
    	  });
     }
    //周期监听
    var orderlst = setInterval("order()",1000);
	
	
	 
</script>
<script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>
<script type="text/javascript">play(['<?php echo FILE_CACHE . "/download/sound/请稍等1.mp3";?>']);</script>
</html>	 