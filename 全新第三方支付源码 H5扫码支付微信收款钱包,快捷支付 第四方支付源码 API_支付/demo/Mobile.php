<?php
date_default_timezone_set('PRC'); 
function build_order_no(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

$amt				='1.00';
$userid				='10000';

$tijiao				="http://www.51card.cn/gateway/alipay/wap-alipay.asp";

$customerid			="10000";								//商户 ID 6 商户在网关系统上的商户号
$key				="7897062fc648ca140512b0c7bf66ff67009e1e86";	//key

$superid			="";								//商户上级ID





$sdcustomno			=build_order_no();						//商户流水号 60 订单在商户系统中的流水号
$ordermoney			="1";									//支付金额 20 订单支付金额（元）
$cardno				="52";									//付方式，网银支付，默认值： pc： 34 手机网页： 52
$faceno				="zap";									// 卡面值编号 8 pc： zfb； 手机网页： zap
$noticeurl			="http://www.baidu.com";				//通知商户 Url 120 在网关返回信息时通知商户的地址会不成功
$backurl			="http://www.baidu.com";				// 通知回调 Url 120 在网关返回信息时回调商户的地址不成功
$endcustomer		="turboet";								// 终端用户名 20 终端用户在商户系统的名称
$endip				="127.0.0.1";							//终端用户 IP 20 终端用户的 ip 地址
$remarks			="1";									//商品名称 60 商品名称
$mark				="2";									//商品描述 60 商品描述
$stype				="1";
//$ZFtype				="1";


/********************************************************************

获取支付宝提交URL

********************************************************************/

$sign				="customerid={$customerid}&sdcustomno={$sdcustomno}&ordermoney={$ordermoney}&cardno=52&faceno={$faceno}&noticeurl={$noticeurl}&key={$key}";

$sign				="customerid={$customerid}&sdcustomno={$sdcustomno}&ordermoney={$ordermoney}&cardno=52&faceno={$faceno}&noticeurl={$noticeurl}&endcustomer={$endcustomer}&endip={$endip}&remarks={$remarks}&mark={$mark}&key={$key}";


$sign				=strtoupper(md5($sign));


$tijiao=$tijiao."?customerid={$customerid}&sdcustomno={$sdcustomno}&ordermoney={$ordermoney}&cardno={$cardno}&faceno={$faceno}&noticeurl={$noticeurl}&endcustomer={$endcustomer}&endip={$endip}&remarks={$remarks}&mark={$mark}&sign={$sign}&backurl={$backurl}&superid={$superid}";



/********************************************************************

获取QQ钱包提交URL

********************************************************************/

$qqt				="http://www.51card.cn/gateway/qqpay/wap-qqpay.asp";

$cardno				="45";									//固定值。 45（手机 QQwap 支付） 36（手机 QQ 扫码支付）
$noticeurl			="http://www.baidu.com";				//通知商户 Url 120 在网关返回信息时通知商户的地址会不成功
$backurl			="http://www.baidu.com";				//通知回调 Url 120 在网关返回信息时回调商户的地址不成功


$Md5str="customerid={$customerid}&sdcustomno={$sdcustomno}&orderAmount={$ordermoney}&cardno={$cardno}&noticeurl={$noticeurl}&backurl={$backurl}{$key}";
$sign				=strtoupper(md5($Md5str));

$qq="{$qqt}?customerid={$customerid}&sdcustomno={$sdcustomno}&orderAmount={$ordermoney}&cardno={$cardno}&noticeurl={$noticeurl}&backurl={$backurl}&sign={$sign}&mark={$mark}";




/********************************************************************

获取网银提交URL

********************************************************************/

$bankt				="http://www.51card.cn/gateway/wap-wy_pay.asp";

$cardno				="99";									//固定值。 45（手机 QQwap 支付） 36（手机 QQ 扫码支付）
$noticeurl			="http://www.baidu.com";				//通知商户 Url 120 在网关返回信息时通知商户的地址会不成功
$backurl			="http://www.baidu.com";				//通知回调 Url 120 在网关返回信息时回调商户的地址不成功


$Md5str="customerid={$customerid}&sdcustomno={$sdcustomno}&orderAmount={$ordermoney}&cardno={$cardno}&noticeurl={$noticeurl}&backurl={$backurl}{$key}";
$sign				=strtoupper(md5($Md5str));


$bank="{$bankt}?customerid={$customerid}&sdcustomno={$sdcustomno}&orderAmount={$ordermoney}&cardno={$cardno}&faceno=CMB&noticeurl={$noticeurl}&backurl={$backurl}&sign={$sign}&endcustomer=sss&remarks=sss&mark={$mark}";


?>
<!DOCTYPE html>
<html>
<head>
<title>信达支付 在线支付DEMO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="data-spm" content="a2h1u">
<meta name="author" content="" />
<meta name="copyright" content="" />
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<!-- 启用360浏览器的极速模式(webkit) -->
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
<meta name="HandheldFriendly" content="true">
<!-- 微软的老式浏览器 -->
<meta name="MobileOptimized" content="320">
<!-- uc强制竖屏 -->
<meta name="screen-orientation" content="portrait">
<!-- QQ强制竖屏 -->
<meta name="x5-orientation" content="portrait">
<!-- UC强制全屏 -->
<meta name="full-screen" content="yes">
<!-- QQ强制全屏 -->
<meta name="x5-fullscreen" content="true">
<!-- UC应用模式 -->
<meta name="browsermode" content="application">
<!-- QQ应用模式 -->
<meta name="x5-page-mode" content="app">
<!--这meta的作用就是删除默认的苹果工具栏和菜单栏-->
<meta name="apple-mobile-web-app-capable" content="yes">
<!--网站开启对web app程序的支持-->
<meta name="apple-touch-fullscreen" content="yes">
<!--在web app应用下状态条（屏幕顶部条）的颜色-->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- windows phone 点击无高光 -->
<meta name="msapplication-tap-highlight" content="no">
<!--移动web页面是否自动探测电话号码-->
<meta http-equiv="x-rim-auto-match" content="none">
<!--移动端版本兼容 start -->
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" name="viewport" />
<!--移动端版本兼容 end -->
<link rel="stylesheet" type="text/css" href="tu/wap.css" />
<script type="text/javascript" src="tu/js/jquery.min.js?201705162128"></script>
<script src="https://account.youku.com/static-resources/js/loadFrame.js"></script>
<link rel="stylesheet" type="text/css" href="layer_mobile/need/layer.css" />
<script async src="layer_mobile/layer.js"></script>
</head>
<script type="text/javascript">
        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
           
        }else{
			//window.location.href = "index.htm";
		}


	function tijiao(str){


		if(str=='alipaywap'){


			url="pay.php?pd_FrpId=alipaywap";
			window.location.href = url;
		}
		else if(str=='1005'){


			url="pay.php?pd_FrpId=1005";
			window.location.href = url;
		
		
		}
		else if(str=='qqwallet')
		{
			url="pay.php?pd_FrpId=qqwallet";
			window.location.href = url;
		}else if(str=='wxgzh')
		{
			url="pay.php?pd_FrpId=wxgzh";
			window.location.href = url;
		}else if(str=='bank')
		{
			url="pay.php?pd_FrpId=bank";
			window.location.href = url;
		}
		else if(str=='yinlian')
		{
			url="pay.php?pd_FrpId=yinlian";
			window.location.href = url;
		}
		else if(str=='quickbank')
		{
			url="pay.php?pd_FrpId=quickbank";
			window.location.href = url;
		}
		else if(str=='jdpay')
		{
			url="pay.php?pd_FrpId=jdpay";
			window.location.href = url;
		}
		else{
		
			alert('通道维护中');
		}


			
	}



	function tijiao2(str){


		 $.get("get.php?",{amt:"<?php echo $amt;?>",uid:"<?php echo $userid;?>",type:3,bankcode:str},function(data,status){

			 if (data.code==1)
			 {
					window.location.href = data.url;
			 }
	
		},"json");

			
	}

 function xuanze(){

		//底部对话框
		layer.open({
		title: [
		'选择银行',
		'background-color:#8DCE16; color:#fff;'
		]
		,anim: 'up'
		,content: $("#yinhang").html()
		,btn: []
	});


  }


</script>


<body>


<div id="yinhang" style="display:none">


	    <dl class="order-pay-way" id="other-pay">
        <!--


		<dd class="other-pay-link"><a href="javascript:;" authorizedpayflag="N" dataname="tenpay" dataway="中国银行" onclick="tijiao2('1052')" datacode="00600110" datatoptips="" datasectips="" class="block-link">
		<b class="bank-icon icon-alipay"></b>中国银行<b class="to-right"></b></a>
		</dd>


		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="农业银行" onclick="tijiao2('1022')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>广大银行<b class="to-right"></b></a>
		</dd>



		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="浦发银行" onclick="tijiao2('1004')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>浦发银行<b class="to-right"></b></a>
		</dd>

       
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="工商银行" onclick="tijiao2('1002')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>工商银行<b class="to-right"></b></a>
		</dd>


		-->
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="建设银行" onclick="tijiao2('1004')" id="wePay" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b style="background: url(images/jianshe.png) no-repeat;" class="bank-icon icon-wechat"></b>建设银行<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>
        
       
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="兴业银行" onclick="tijiao2('1010')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/xingye.ico) no-repeat;" class="bank-icon icon-tenpay"></b>兴业银行<b class="to-right"></b></a>
		</dd>


		
		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="农业银行" onclick="tijiao2('1005')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/nongye.png) no-repeat;" class="bank-icon icon-tenpay"></b>农业银行<b class="to-right"></b></a>
		</dd>



		

		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="邮政银行" onclick="tijiao2('1006')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/youzheng.jpg) no-repeat;" class="bank-icon icon-tenpay"></b>邮政银行<b class="to-right"></b></a>
		</dd>

		<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="招商银行" onclick="tijiao2('1007')" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b style="background: url(images/zhaoshang.png) no-repeat;" class="bank-icon icon-tenpay"></b>招商银行<b class="to-right"></b></a>
		</dd>
                                   
         </dl>

</div>



<div class="pb-wrap">
                        <div class="order-content">
                            <div class="order-name t-e">信达支付 充值测试</div>
                            <div class="order-amount"><strong id="amount"><?php echo $amt?></strong><em>元</em></div>
                        </div>
                        <dl class="order-details" id="order-details">
                            <dt>商品名称：手机支付体验</dt>
                             
                        </dl>
                            <dl class="order-pay-way" id="other-pay">
        
		<dd class="other-pay-link"><a href="javascript:;" authorizedpayflag="N" name="pd_FrpId" dataway="支付宝" onclick="tijiao('alipaywap')" value="alipaywap" id="alipaywap" datacode="00600110" datatoptips="" datasectips="" class="block-link">
		<b class="bank-icon icon-alipay"></b>支付宝<b class="to-right"></b></a>
		</dd>
       
		<dd class="other-pay-link"><a href="javascript:;" name="pd_FrpId" dataway="微信支付" onclick="tijiao('1005')" value="1005" id="1005" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-wechat"></b>微信支付<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>
		
		<dd class="other-pay-link"><a href="javascript:;" name="pd_FrpId" dataway="QQ钱包" onclick="tijiao('qqwallet')"  value="qqwallet" id="qqwallet" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-tenpay"></b>QQ钱包<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>
		<dd class="other-pay-link"><a href="javascript:;" name="pd_FrpId" dataway="京东支付" onclick="tijiao('jdpay')"  value="jdpay" id="qqwallet" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-tenpay"></b>京东支付<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>

			<!--<dd class="other-pay-link"><a href="javascript:;" dataname="wePay" dataway="微信支付" onclick="tijiao('wxgzh')" id="wxgzh" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-wechat"></b>微信公众号<em class="otherTips"></em><b class="to-right"></b></a>
		</dd> !-->
		

		<!--<dd class="other-pay-link"><a href="javascript:;" dataname="pd_FrpId" dataway="快捷支付" onclick="tijiao('quickbank')"  value="quickbank" id="quickbank"" datatoptips="" datasectips="" datacode="02802006" class="block-link">
		<b class="bank-icon icon-tenpay"></b>快捷支付<em class="otherTips"></em><b class="to-right"></b></a>
		</dd>-->
        
       
		<!--<dd class="other-pay-link"><a href="javascript:;" dataname="tenpay" dataway="网银支付" onclick="xuanze()" datatoptips="" datasectips="" datacode="00903218" class="block-link">
		<b class="bank-icon icon-tenpay"></b>网银支付<b class="to-right"></b></a>
		</dd>-->
                           
                            </dl>
                                
                    <div class="wap-footer">©2016~2018 信达支付 版权所有.</div>
                </div>


</body>
</html>
