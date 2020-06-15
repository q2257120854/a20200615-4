<?php
require_once 'inc.php';
require_once 'alipay.config.php';
require_once 'lib/alipay_service.class.php';


//请与贵网站订单系统中的唯一订单号匹配
$out_trade_no = $_GET['orderid'];
//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
$subject      = $out_trade_no;
//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
$body         = $out_trade_no;
//订单总金额，显示在支付宝收银台里的“应付总额”里
$total_fee    = $_GET['price'];

//扩展功能参数——默认支付方式//
//默认支付方式，取值见“即时到帐接口”技术文档中的请求参数列表
$paymethod    = '';
//默认网银代号，代号列表见“即时到帐接口”技术文档“附录”→“银行列表”
$defaultbank  = '';

//扩展功能参数——防钓鱼//
//防钓鱼时间戳
$anti_phishing_key  = '';
//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
$exter_invoke_ip = $_SERVER['REMOTE_ADDR'];

//扩展功能参数——其他//
//商品展示地址，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
$show_url			="";
//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
$extra_common_param = 'pay';

//扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
$royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
$royalty_parameters	= "";

//构造要请求的参数数组
$parameter = array(
		"service"			=> "create_direct_pay_by_user",
		"payment_type"		=> "1",

		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
        "seller_email"		=> trim($aliapy_config['seller_email']),
        "return_url"		=> trim($aliapy_config['return_url']),
        "notify_url"		=> trim($aliapy_config['notify_url']),

		"out_trade_no"		=> $out_trade_no,
		"subject"			=> $subject,
		"body"				=> $body,
		"total_fee"			=> $total_fee,

		"paymethod"			=> $paymethod,
		"defaultbank"		=> $defaultbank,

		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,

		"show_url"			=> $show_url,
		"extra_common_param"=> $extra_common_param,

		"royalty_type"		=> $royalty_type,
		"royalty_parameters"=> $royalty_parameters
);

//构造即时到帐接口
$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->create_direct_pay_by_user($parameter);
echo $html_text;
?>
