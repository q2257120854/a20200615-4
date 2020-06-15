<?php
define('SYSTEM_ROOT_E', dirname(DACEEFCBBFEED) . '/');
require './includes/common.php';
ksort($_POST);
reset($_POST);
$sign = '';
foreach ($_POST as $key => $val) {
    if ($val == '') {
        continue;
    }
    if ($key != 'sign') {
        if ($sign != '') {
            $sign .= "&";
            $urls .= "&";
        }
        $sign .= "{$key}={$val}";
        $urls .= "{$key}=" . urlencode($val);
    }
}
$type = isset($_POST['type']) ? $_POST['type'] : exit('No type!');
if ($type == '1') {
    $typepay = "alipay";
    $ua = "ali";
} elseif ($type == '2') {
    $type = "qqpay";
    $ua = "qq";
} else {
    $type = "wxpay";
    $ua = "wx";
}
if (!$_POST['param'] || md5($sign . $conf[$ua . '_codepay_api_key']) != $_POST['sign']) {
    exit('fail');
} else {
    $trade_no = $_POST['pay_no'];
    $out_trade_no = $_POST['param'];
    $money = $_POST['money'];
    $trade_status = $_POST['status'];
    if ($trade_status == 0) {
        $srow = $DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
if($srow['type']=='alipay'){
			$rate = $conf['alirate'];
		}elseif($srow['type']=='wxpay'){
			$rate = $conf['wxrate'];
		}elseif($srow['type']=='qqpay'){
			$rate = $conf['qqrate'];
		}
        if ($srow['status'] == 0 and $money == $srow['money']) {
            $DB->query("update `pay_order` set `status` ='1',`endtime` ='{$date}' where `trade_no`='{$out_trade_no}'");
            $addmoney = round($srow['money'] * $rate / 100, 2);
            $DB->query("update pay_user set money=money+{$addmoney} where id='{$srow['pid']}'");
            $url = creat_callback($srow);
            curl_get($url['notify']);
            proxy_get($url['notify']);
        }
        exit('ok');
    } else {
        exit('fail !status');
    }
}