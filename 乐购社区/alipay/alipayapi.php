<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付宝即时到账交易接口接口</title>
</head>
<?php
/* *
 * 功能：即时到账交易接口接入页
 * 版本：3.4
 * 修改日期：2016-03*08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*****************
 
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心（https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.KvddfJ&treeId=62&articleId=103740&docType=1）
 *2、商户帮助中心（https://cshall.alipay.com/enterprise/help_detail.htm?help_id=473888）
 *3、支持中心（https://support.open.alipay.com/alipay/support/index.htm）

 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
 **********************************************
 */


	session_start();
    $_SESSION['go']=$_SERVER['HTTP_HOST'];
	
require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");
 $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

 
/**************************请求参数**************************/
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $danhao;

        //订单名称，必填
        $subject = $_POST['hyid'];

        //付款金额，必填
        $total_fee = $_POST['WIDtotal_fee'];

        //商品描述，可空
        $body = $_POST['fid'];
        $hyname = $_POST['hyname'];

  
 	 null_back($total_fee,'请输入充值金额');  
	 
	 $czsxf=$total_fee*($site_czsxf/100);
	 $czje = $total_fee+$czsxf;

     //充值记录
	$_data1['fid'] = $_POST['fid'];
	$_data1['zid'] = $_POST['zid'];
 	$_data1['hyid'] = $_POST['hyid'];
	$_data1['hyname'] = $_POST['hyname'];
 	$_data1['je'] = $total_fee;
 	$_data1['sxf'] = $czsxf;
 	$_data1['dingdanhao'] = $danhao;
 	$_data1['zt'] = 0;
  	$_data1['date'] =$sj;  
  	$_data1['type'] ='支付宝';  
 
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'czjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service"       => $alipay_config['service'],
		"partner"       => $alipay_config['partner'],
		"seller_id"  => $alipay_config['seller_id'],
		"payment_type"	=> $alipay_config['payment_type'],
		"notify_url"	=> $alipay_config['notify_url'],
		"return_url"	=> $alipay_config['return_url'],
		
		"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
		"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $czje,
		"body"	=> $body,
		"m_name"	=> $hyname,

		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
        //如"参数名"=>"参数值"
		
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>