<?php

define('CORE', dirname(__FILE__));
require CORE.'/../../config/inc_config.php';

$config = array (
    //应用ID,您的APPID。
    'app_id' => ALIAPPID,

    //商户私钥
    //'merchant_private_key' => "GGcpyHnYhipcv2tucb8eNg==",
    'merchant_private_key' => ALIPRIVATE,
    //异步通知地址
    'notify_url' => URL."payment/alipay_wap/notify_url.php",

    //同步跳转
    'return_url' => URL."payment/alipay_wap/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => ALIPUBLIC,
);
