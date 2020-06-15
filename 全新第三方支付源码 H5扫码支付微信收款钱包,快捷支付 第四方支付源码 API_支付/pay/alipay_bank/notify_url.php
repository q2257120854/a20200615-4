<?php
/* * 
 * TRADE_FINISHED(表示交易已经成功结束，为普通即时到帐的交易状态成功标识);
 * TRADE_SUCCESS(表示交易已经成功结束，为高级即时到帐的交易状态成功标识);
 */
require_once 'inc.php';
require_once 'alipay.config.php';
require_once 'lib/alipay_notify.class.php';
use WY\app\model\Handleorder;
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上用户的业务逻辑程序代
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取兑换宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    $out_trade_no	= $_POST['out_trade_no'];	    //获取订单号
    $trade_no		= $_POST['trade_no'];	    	//获取兑换宝交易号
    $total_fee		= $_POST['total_fee'];			//获取总价格

    if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {    //交易成功结束
		//判断该笔订单是否在用户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在用户网站的订单系统中查到该笔订单的详细，并执行用户的业务程序
			//如果有做过处理，不执行用户的业务程序
        
 $handle=@new Handleorder($out_trade_no,$total_fee);
		$handle->updateUncard();
		echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else {
        echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
file_put_contents( dirname( __FILE__ ).'/log_post.txt', var_export($_POST, true), FILE_APPEND );
file_put_contents( dirname( __FILE__ ).'/log_get.txt', var_export($_GET, true), FILE_APPEND );
file_put_contents( dirname( __FILE__ ).'/log_input.txt', file_get_contents("php://input"), FILE_APPEND );
	
}
?>