<?php

require_once 'inc.php';
use WY\app\model\Handleorder;
use WY\app\model\Pushorder;

require_once "config.php" ;

require_once 'wappay/service/AlipayTradeService.php';


$arr=$_GET;
$alipaySevice = new AlipayTradeService($config); 
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
if($result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = htmlspecialchars($_GET['out_trade_no']);

	//支付宝交易号

	$trade_no = htmlspecialchars($_GET['trade_no']);
		
	echo "验证成功<br />外部订单号：".$out_trade_no;
	
    $handle=new Handleorder($_GET['out_trade_no'],$_GET['total_amount']);
    $handle->updateUncard();
	
	$orderid=isset($_GET['out_trade_no']) ? $_GET['out_trade_no'] : '';
	$push=new Pushorder($orderid);
	$push->sync();

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "验证失败";
}
?>
<title>支付宝手机网站支付接口</title>
<meta charset="utf-8">
	</head>
    <body>
    </body>
</html>