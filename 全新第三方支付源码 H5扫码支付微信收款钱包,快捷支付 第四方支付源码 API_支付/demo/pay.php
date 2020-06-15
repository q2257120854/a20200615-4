<?php
require_once 'inc.php';
$version='1.0';
$customerid=$userid;
$sdorderno=time()+mt_rand(1000,9999);
$total_fee="5.10";
$paytype=$_REQUEST['pd_FrpId'];


if ($paytype=='alipay' || $paytype=='qqwallet'||$paytype=='jdpay'||$paytype=='quickbank'|| $paytype=='yinlian'|| $paytype=='gzhpay'|| $paytype=='1005' || $paytype=='1007' || $paytype=='1593'  || $paytype=='1594'|| $paytype=='alipaywap'|| $paytype=='1009'){

	$bankcode="";
}
elseif ($paytype=='weixin'){

	$bankcode="";
}else{

	$paytype	="bank";
	$bankcode=$_REQUEST['pd_FrpId'];
}


$notifyurl='http://'.$_SERVER['HTTP_HOST'].'/demo/notify.php';
$returnurl='http://'.$_SERVER['HTTP_HOST'].'/demo/return.php';
$remark='';
$get_code="0";

$sign=md5('version='.$version.'&customerid='.$customerid.'&total_fee='.$total_fee.'&sdorderno='.$sdorderno.'&notifyurl='.$notifyurl.'&returnurl='.$returnurl.'&'.$userkey);

?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>正在转到付款页</title>
</head>
<body onLoad="document.pay.submit()">
    <form name="pay" action="/apisubmit" method="post">
        <input type="hidden" name="version" value="<?php echo $version?>">
        <input type="hidden" name="customerid" value="<?php echo $customerid?>">
        <input type="hidden" name="sdorderno" value="<?php echo $sdorderno?>">
        <input type="hidden" name="total_fee" value="<?php echo $total_fee?>">
        <input type="hidden" name="paytype" value="<?php echo $paytype?>">
        <input type="hidden" name="notifyurl" value="<?php echo $notifyurl?>">
        <input type="hidden" name="returnurl" value="<?php echo $returnurl?>">
        <input type="hidden" name="remark" value="<?php echo $remark?>">
        <input type="hidden" name="bankcode" value="<?php echo $bankcode?>">
        <input type="hidden" name="sign" value="<?php echo $sign?>">
        <input type="hidden" name="get_code" value="<?php echo $get_code?>">
    </form>
</body>
</html>
