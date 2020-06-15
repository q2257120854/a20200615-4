<?php /* Smarty version 2.6.25, created on 2019-04-24 11:07:27
         compiled from index/wx_gzh_pay.tpl */ ?>
<!DOCTYPE html>
 <html>
   <head>
     <meta charset="UTF-8">
     <title>塔罗占卜。。。</title>
     <script src="/ffsm/statics/jquery-3.2.1.min.js"></script>
   </head>
   <body>
     <script type="text/javascript">
     
     //return false;
     
       function onBridgeReady() {
         WeixinJSBridge.invoke('getBrandWCPayRequest', {
           "appId": "<?php echo $this->_tpl_vars['pay_info']['appId']; ?>
", //公众号名称，由商户传入
           "timeStamp": "<?php echo $this->_tpl_vars['pay_info']['timeStamp']; ?>
", //时间戳，自1970 年以来的秒数
           "nonceStr": "<?php echo $this->_tpl_vars['pay_info']['nonceStr']; ?>
", //随机串
           "package": "<?php echo $this->_tpl_vars['pay_info']['package']; ?>
",
           "signType": "<?php echo $this->_tpl_vars['pay_info']['signType']; ?>
", //微信签名方式:
           "paySign": "<?php echo $this->_tpl_vars['pay_info']['paySign']; ?>
" //微信签名
         }, function(res) {
           if(res.err_msg == "get_brand_wcpay_request:ok") {
                 // window.location.href = "<?php echo $this->_tpl_vars['row']['url']; ?>
";
				 inquiry();
           }
         });
       }
       if(typeof WeixinJSBridge == "undefined") {
         if(document.addEventListener) {
           document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
         } else if(document.attachEvent) {
           document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
           document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
         }
       } else {
         onBridgeReady();
       }
	   
	   
	   
    function inquiry() {
		
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['row']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                window.location = data.url;
            }
        }, 'json');
    }
	   
	   
	   
     </script>
   <!--天玄算命网付费测算源码-->
</body>
 </html>