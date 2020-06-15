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
 $danhao = $_GET['dingdanhao'];
require_once("epay.config.php");
require_once("lib/epay_submit.class.php");



 $sel="select * from ".flag."czjl where dingdanhao = '".$danhao."'       ";
  $sl=@mysql_query($sel);
  $s=@mysql_fetch_array($sl);
  if (is_array($s)){
   if ($s['zt']!=0)
   { alert_href('非法操作!!','/');}
  $czje=$s['je']+$s['sxf'];
  $czfs=$s['type'];
  
  }
  
  if ($czfs=='支付宝')
{  $zffs='alipay' ; }
if ($czfs=='QQ支付')
{  $zffs='qqpay' ; }
if ($czfs=='微信支付')
{  $zffs='wxpay' ; }


/**************************请求参数**************************/
        $notify_url = "http://".$_SERVER['HTTP_HOST']."/other/epay/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = "http://".$_SERVER['HTTP_HOST']."/other/epay/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = $danhao;
        //商户网站订单系统中唯一订单号，必填
 
		//支付方式
        $type = $zffs;
        //商品名称
        $name = "在线充值";

 	 
	 		//付款金额
        $money = $czje;
		//站点名称
        $sitename = $site_name;
        //必填

        //订单描述


/************************************************************/
 


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