<?php
$aliapy_config['partner']      = $userid;
$aliapy_config['key']          = $userkey;
$aliapy_config['seller_email'] =$email;
$aliapy_config['return_url']   = 'http://'.$_SERVER['HTTP_HOST'].'/pay/alipay_bank/return_url.php';
$aliapy_config['notify_url']   = 'http://'.$_SERVER['HTTP_HOST'].'/pay/alipay_bank/notify_url.php';
$aliapy_config['sign_type']    = 'MD5';
$aliapy_config['input_charset']= 'utf-8';
$aliapy_config['transport']    = 'https';
?>
