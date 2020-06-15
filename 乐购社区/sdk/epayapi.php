<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>在线支付</title>
</head>
<?php
/* *
 * 功能：即时到账交易接口接入页
 * 
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */
	session_start();
    $_SESSION['go']=$_SERVER['HTTP_HOST'];
 $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
require_once("epay.config.php");
require_once("lib/epay_submit.class.php");

/**************************请求参数**************************/
        $notify_url = "http://".$_SERVER['HTTP_HOST']."/sdk/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = "http://".$_SERVER['HTTP_HOST']."/sdk/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = $danhao;
        //商户网站订单系统中唯一订单号，必填


		//支付方式
        $type = $_POST['type'];
        //商品名称
        $name = "在线充值";

	 null_back($_POST['WIDtotal_fee'],'请输入充值金额');  
	 
	 $czsxf=$_POST['WIDtotal_fee']*($site_czsxf/100);
	 $czje = $_POST['WIDtotal_fee']+$czsxf;
	 
	 		//付款金额
        $money = $czje;
		//站点名称
        $sitename = $site_name;
        //必填

        //订单描述

if ($_POST['type']=='alipay')
{  $czfs='支付宝' ; }
if ($_POST['type']=='qqpay')
{  $czfs='QQ支付' ; }
if ($_POST['type']=='wxpay')
{  $czfs='微信支付' ; }

/************************************************************/

      //充值记录
      if($_POST['fid']=='')$_POST['fid']=0;
	$_data1['fid'] = $_POST['fid'];
	$_data1['zid'] = $_POST['zid'];
 	$_data1['hyid'] = $_POST['hyid'];
	$_data1['hyname'] = $_POST['hyname'];
 	$_data1['je'] = $_POST['WIDtotal_fee'];
 	$_data1['sxf'] = $czsxf;
 	$_data1['dingdanhao'] = $danhao;
 	$_data1['zt'] = 0;
  	$_data1['date'] =$sj;  
  	$_data1['type'] =$czfs;  
 
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'czjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);


#die($sql1);

//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"sitename"	=> $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

?>
</body>
</html>