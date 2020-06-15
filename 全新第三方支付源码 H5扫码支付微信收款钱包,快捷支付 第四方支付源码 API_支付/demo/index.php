<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="renderer" content="webkit" />
<title>支付测试 信达支付</title>
<link rel="stylesheet" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="css/pay.css">
<link type="text/css" href="css/keyPay.css" rel="stylesheet" />
</head>

<body>
<script type="text/javascript">

        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href = "Mobile.php";
        }

 </script>

<!-- header -->
<div class="header">
	<div class="wrap clearfix">
    	<div class="logo-box fl">
        	<a href="../" class="logo" title="信达支付官网"><img src="../picture/logo.png" alt="信达支付官网"/></a>
            <span class="sub-logo">支付测试</span>
        </div>
      
    </div>
</div>


	
	<form name='type' method="post" action="pay.php" target="_blank">
<input size="50" type="hidden" name="pd_Order" value="201603061147305643" />
<!-- 内容 begin  -->

<div style="margin-top:70px" id="content">



<div class="sb">



<div class="centersb" id="orderDetails">

<ul>

	<li style="font-size: 18px;"><strong>商品金额：</strong><span id="orderId" style="color:#F00">10元</span></li>

	<li><strong>商品名称：</strong><span id="goodsName">在线体验测试   不支持退款</span></li>

	<li><strong>商户信息：</strong>信达支付</li>



</ul>
</div>

<div class="rightsb">
<p><font color="#FF6600" size="+2" style="font-weight: bold;"
	id="countNum">&yen; 10.00</font>元</p>
<div style="background: #0590da; text-align: center; width: 90px; height: 26px; position: relative; top: 25px; left: 30px; color:#f5f5f5;"
	onClick="showMoreDetails();">订单详情</div>
</div>

</div>



<div class="">


<style type="text/css">
	  .credit-icon{background: url(images/credit.png) no-repeat; display:inline-block; width:13px; height:18px;position:absolute;  cursor:pointer;}
</style>
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">扫码快捷支付：</span>



    
    
    <!-- 支付类型 -->
    
    <div id="payTypeList" class="bankWrap" style="margin-top:50px">
    
    <ul>
    
    	<li>
            <label>
                <input type="radio" checked name="pd_FrpId"  value="alipay" id="alipay" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/alipay.png) no-repeat center center; margin-left:10px" title="支付宝扫码支付"></div>
           </label>
        </li>

    	<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="weixin" id="weixin" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/logo_wxpay.png) no-repeat center center; margin-left:10px" title="微信扫码支付"></div>
           </label>
        </li>
		<!--<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="1593" id="1593" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/logo_qq.png) no-repeat center center; margin-left:10px" title="QQ支付"></div>
           </label>
        </li>-->
        <li>
            <label>
                <input type="radio"  name="pd_FrpId" value="quickbank" id="quickbank"  style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/ylzx.png) no-repeat center center; margin-left:10px" title="快捷支付"></div>
           </label>
        </li>
		<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="jdpay" id="jdpay"  style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/jd.png) no-repeat center center; margin-left:10px;" title="京东支付"></div>
           </label>
        </li>
		<!--<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="1007" id="1007" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/yinliansm.png) no-repeat center center; margin-left:10px" title="银联扫码"></div>
           </label>
        </li> -->
    </ul>
    </div>
</div>
<div style="height:85px; width:100%"></div>


<div class="zhifu"><span id="payTitle" style="font-size: 17px;">网银支付OR信用卡支付：</span>



<!-- 支付类型 -->

<div id="payTypeList" class="bankWrap" style="margin-top:20px">

<ul>

    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="967" id="967"  style="margin-top:10px;float:left; height:13px;" />
            <div class="iw ICBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="工商银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="965" id="965" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="建设银行"></div>
	   </label>
       
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="964" id="964" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ABC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="农业银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="970" id="970" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBCHINA" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="招商银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="963" id="963" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="981" id="981" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOCO" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="交通银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="971" id="971" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw POST" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国邮政储蓄"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="986" id="986" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CEB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="光大银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId"value="985" id="985" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw GDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="广东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="972" id="972" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CIB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="兴业银行"></div>
	   </label>
	</li>
    
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="977" id="977" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SPDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海浦东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="980" id="980" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="民生银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="962" id="962" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ECITIC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中信银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="978" id="978" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw PINGANBANK" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="平安银行"></div>
            
	   </label>
	</li>
    <!--<li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SPABANK" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="深圳发展银行"></div>
            
	   </label>
	</li>  
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="BOS" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SHB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SRCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SRCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海农村商业银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="BJRCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BJRCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="北京农商银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HZCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HZBANK" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="杭州银行"></div
            
	   </label>
	</li>-
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="NBCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw NBCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="宁波银行"></div>
            
	   </label>
	</li>
    
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="CBHB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CBHB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="渤海银行"></div>
            
	   </label>
	</li>-->
	
<!--

    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="NJCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw NJCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="南京银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HKBEA" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HKBEA" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="东亚银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="HXB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HXB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="华夏银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SCCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SCCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="河北银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_FrpId" value="SDE" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SDE" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="顺德信用社"></div>
            
	   </label>
	</li>-->

</ul>

</div>

</div>
<table
	style="width: 900px; height: 50px; border: 0; margin-right: 10px; margin-left: 50px;">

	<tr style="background-color: #fff;border:0">

		<td style="background-color: #fff;border:0" align="right"><input type="image" id="btn_pay" src="images/pay.png" onClick="return pay();" /></td>

	</tr>

</table>

</div>

</div>


</form>

        
<!-- footer -->
<div class="footer">
	<div class="footer-nav">
    		<a href="javascript:void(0)">京东钱包</a>
        <span>|</span>
       <a href="javascript:void(0)">支付宝</a>
        <span>|</span>
        <a href="javascript:void(0)">网易钱包</a>
        <span>|</span>
        <a href="javascript:void(0)">微信支付</a>
        <span>|</span>
        <a href="javascript:void(0)">QQ钱包</a>
        <span>|</span>
       <a href="javascript:void(0)">百度钱包</a>
        <span>|</span>
        <a href="javascript:void(0)">银联在线</a>
        <span>|</span>
        <a href="../i/contact.html" target="_blank">联系我们</a>

    </div>
    <div class="icp">版权归 北京信达支付信息技术有限公司 所有 　工信部备案号：京ICP备18007495号</div>	
</div>

</body>
</html>
