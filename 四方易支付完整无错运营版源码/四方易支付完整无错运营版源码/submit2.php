<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在为您跳转到支付页面，请稍候...</title>
    <style type="text/css">
        body {margin:0;padding:0;}
        p {position:absolute;
            left:50%;top:50%;
            width:330px;height:30px;
            margin:-35px 0 0 -160px;
            padding:20px;font:bold 14px/30px "宋体", Arial;
            background:#f9fafc url(../images/loading.gif) no-repeat 20px 26px;
            text-indent:22px;border:1px solid #c5d0dc;}
        #waiting {font-family:Arial;}
    </style>
<script>
function open_without_referrer(link){
document.body.appendChild(document.createElement('iframe')).src='javascript:"<script>top.location.replace(\''+link+'\')<\/script>"';
}
</script>
</head>
<body>
<?php 
$is_defend = true;
require './includes/common.php';
@header('Content-Type: text/html; charset=UTF-8');
$type = daddslashes($_GET['type']);
$money = daddslashes($_GET['money']);
$trade_no = daddslashes($_GET['trade_no']);
$row = $DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if (!$row) {
    exit('该订单号不存在，请返回来源地重新发起请求！');
}
$DB->query("update `pay_order` set `type` ='{$type}',`addtime` ='{$date}' where `trade_no`='{$trade_no}'");
if ($type == 'alipay') {
    if ($conf['alipay_api'] == 4) {
        exit($conf['ali_close_info']);
    } elseif ($conf['alipay_api'] == 3) {
        echo "<script>window.location.href='./msubmit.php?trade_no={$trade_no}&type={$type}&name={$name}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['alipay_api'] == 2) {
        echo "<script>window.location.href='./epay.php?trade_no={$trade_no}&type={$type}&name={$name}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['alipay_api'] == 1) {
        require_once SYSTEM_ROOT . "alipay/alipay.config.php";
        require_once SYSTEM_ROOT . "alipay/alipay_submit.class.php";
        if (checkmobile() == true) {
            $alipay_service = "alipay.wap.create.direct.pay.by.user";
        } else {
            $alipay_service = "create_direct_pay_by_user";
        }
        $parameter = array("service" => $alipay_service, "partner" => trim($alipay_config['partner']), "seller_id" => trim($alipay_config['partner']), "payment_type" => "1", "notify_url" => 'https://' . $conf['local_domain'] . '/alipay_notify.php', "return_url" => 'https://' . $_SERVER['HTTP_HOST'] . '/alipay_return.php', "out_trade_no" => $trade_no, "subject" => $row['name'], "total_fee" => $row['money'], "_input_charset" => strtolower('utf-8'));
        if (checkmobile() == true) {
            $parameter['app_pay'] = "Y";
        }
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "正在跳转");
        echo $html_text;
    } else {
        exit("本站还未配置有效的接口！");
    }
} elseif ($type == 'wxpay') {
    if ($conf['wxpay_api'] == 4) {
        exit($conf['wx_close_info']);
    } elseif ($conf['wxpay_api'] == 3) {
        echo "<script>window.location.href='./msubmit.php?trade_no={$trade_no}&type={$type}&name={$name}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['wxpay_api'] == 2) {
        echo "<script>window.location.href='./epay.php?trade_no={$trade_no}&type={$type}&name={$name}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['wxpay_api'] == 1) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            echo "<script>window.location.href='./wxjspay.php?trade_no={$trade_no}&d=1';</script>";
        } elseif (checkmobile() == true) {
            echo "<script>window.location.href='./wxwappay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        } else {
            echo "<script>window.location.href='./wxpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        }
    }
} elseif ($type == 'qqpay' || $type == 'tenpay') {
    $type = 'qqpay';
    if ($conf['qqpay_api'] == 4) {
        exit($conf['qq_close_info']);
    } elseif ($conf['qqpay_api'] == 3) {
        echo "<script>window.location.href='./msubmit.php?trade_no={$trade_no}&type={$type}&name={$name}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['qqpay_api'] == 2) {
        echo "<script>window.location.href='./epay.php?trade_no={$trade_no}&type={$type}&name={商户申请}&money={$money}&sitename={$sitename}';</script>";
    } elseif ($conf['qqpay_api'] == 1) {
        echo "<script>window.location.href='./qqpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
    }
} else {
    echo "<script>window.location.href='./default.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
}
?>
<p>正在为您跳转到支付页面，请稍候...</p>
</body>
</html>