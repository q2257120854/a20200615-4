<?php
//更多资源请关注三岁半资源网-sansuib.com
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['transport']    = 'http';
$alipay_config['payment_type'] = "1";
$alipay_config['service'] = "create_direct_pay_by_user";
$alipay_config['anti_phishing_key'] = "";
$alipay_config['exter_invoke_ip'] = "";
?>