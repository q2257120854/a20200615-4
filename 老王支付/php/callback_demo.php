<?php
//接收异步通知请求demo文件
//签名算法库
include ('sign.php');

//商户名称
$account_name  = $_POST['account_name'];
//支付时间戳
$pay_time  = $_POST['pay_time'];
//支付状态
$status  = $_POST['status'];
//支付金额
$amount  = $_POST['amount'];
//支付时提交的订单信息
$out_trade_no  = $_POST['out_trade_no'];
//平台订单交易流水号
$trade_no  = $_POST['trade_no'];
//该笔交易手续费用
$fees  = $_POST['fees'];
//签名算法
$sign  = $_POST['sign'];
//回调时间戳
$callback_time  = $_POST['callback_time'];
//支付类型
$type = $_POST['type'];
//商户KEY（S_KEY）
$account_key = $_POST['account_key'];


//第一步，检测商户KEY是否一致
if ($account_key != '你的商户KEY') exit('error:key');
//第二步，验证签名是否一致
if (sign('你的商户KEY', ['amount'=>$amount,'out_trade_no'=>$out_trade_no]) != $sign) exit('error:sign');

//下面就可以安全的使用上面的信息给贵公司平台进行入款操作

echo 'success';

//测试时，将来源请求写入到txt文件，方便分析查看
file_put_contents("callback_log.txt", json_encode($_POST));