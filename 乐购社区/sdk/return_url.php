<?php
/* * 
 * 功能：彩虹易支付页面跳转同步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见epay_notify_class.php中的函数verifyReturn
 */

require_once("epay.config.php");
require_once("lib/epay_notify.class.php");

//获取分站信息
	 function get_mpoint($t0)
{
	$result = mysql_query('select *  from  '.flag.'user where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['point'];
	} else {
		return 0;
	}
}

?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];


    if($_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }



 $sel="select * from ".flag."czjl where dingdanhao = '".$out_trade_no."'  and zt = 0    ";
  $sl=@mysql_query($sel);
  $s=@mysql_fetch_array($sl);
  if (is_array($s)){
  
  //改变订单状态
   $_data['zt'] = 1; 
   $_data['pdate'] = $sj; 
  $_data['jiaoyihao'] = $trade_no; 
   $str = arrtoinsert($_data);
  $sql = 'update '.flag.'czjl set '.arrtoupdate($_data).' where dingdanhao = "'.$out_trade_no.'"';
   mysql_query($sql);
 
 
 
  //消费记录
	
	$_data1['hyid'] = $s['hyid'];
	$_data1['hyname'] = $s['hyname'];
 	$_data1['xf_qje'] = get_mpoint($s['hyid']);
 	$_data1['xf_je'] = $s['je'];
 	$_data1['xf_hje'] = get_mpoint($s['hyid'])+$s['je'];
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_qk'] ='余额充值';  
  	$_data1['xf_lx'] =1; //0扣除 -增加  
  	$_data1['fid'] =$s['fid']; //  
  	$_data1['zid'] =$s['zid']; //  
 	$_data1['xf_ip'] = xiaoyewl_ip();
    	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);
  
 //增加自己余额

   $_data2['point'] = get_mpoint($s['hyid'])+$s['je']; 
   $sql2 = 'update '.flag.'user set '.arrtoupdate($_data2).' where ID = '.$s['hyid'].'';
   mysql_query($sql2);

 
//增加主站余额
/*
   $_data22['point'] = get_zhuzhan('point',$zhu_id)+$s['je']; 
   $sql22 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data22).' where ID = '.$zhu_id.'';
   mysql_query($sql22);
*/
   

		//余额记录
	$_data3['zid'] = $zhu_id;
	$_data3['qje'] = $site_point;
	$_data3['je'] = $s['je'];
 	$_data3['hje'] = $site_point+$s['je'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '用户充值';
 	$_data3['lx'] = 1;
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'zhuzhanpricejl ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);


 
  require_once("ajax.php");

 		alert_href('充值成功!','/');

  }
  else
  
  {
#die($sel);
 		alert_href('充值失败!','/');
   }
		


	echo "验证成功<br />";

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>彩虹易支付即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>