<?php
/**
 * @author: lion
 * @link: http://lionsay.com/codetoany.html
 */
$oid = $_GET['oid'];

define('CORE', dirname(__FILE__));





require './core/Authorize.php';

require './config/inc_config.php';



$appId = WXAPPID;
$authorize = new lion\weixin\library\Authorize($appId);
$redirectUrlConfig = [
	'demo1' => 'http://payment.huangoukeji.com/payment/zx/wxpay/payInterface_jsapi_wx/pay.html',
	'demo2' => 'http://payment.huangoukeji.com/payment/zx/wxpay/payInterface_jsapi_wx/pay.php',
	'demo3' => URL.'?ct=pay&ac=wxjsapi&oid='.$oid,
	'demo4' => 'http://payment.huangoukeji.com/?ct=user&ac=uuu&oid='.$money,
	'demo5' => 'market.huangoukeji.com/?ac=openidpush',
];
$authorize->authorizeCodeToUrl($redirectUrlConfig);
