<?php
error_reporting(E_ALL & ~E_NOTICE); //过滤脚本提醒
date_default_timezone_set('PRC'); //时区设置 解决某些机器报错
//ob_clean(); //清空缓冲区 防止UTF-8 BOM头报错
header('Content-type:text/html;charset=utf-8');

$codepay_html='';

$api_url='http://api2.xiuxiu888.com/submit.php?';  

$timeout=5; //5秒超时

if (function_exists('curl_init')) { //如果开启了获取远程HTML函数 curl_init
        $ch = curl_init(); //使用curl请求
        curl_setopt($ch, CURLOPT_URL, $api_url.$_SERVER['QUERY_STRING']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        if(!empty($_POST)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        }
        $codepay_html = curl_exec($ch);
        curl_close($ch);
}else if (function_exists('file_get_contents')) {
        $context = array();
        if(!empty($_POST)){
            ksort($_POST);
            $context['http'] = array('timeout'=>$timeout,'method' => 'POST','content' => http_build_query($_POST, '', '&'));
        }else{
            $context['http'] = array('timeout'=>$timeout,'method' => 'GET'); 
        }   
        $codepay_html =file_get_contents($api_url.$_SERVER['QUERY_STRING'], false, stream_context_create($context));
}

if (!empty($codepay_html)) { //如果获取到了远程HTML 直接输出远程HTML
    echo $codepay_html;
    exit(0);
}
//如果是POST方式转为GET参数 并使用HTTPS 网关
$user_data["pay_url"]="https://api.xiuxiu888.com/submit.php?".(empty($_POST)?$_SERVER['QUERY_STRING']:http_build_query($_POST, '', '&')); 

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>扫码支付</title>
    <script src="https://codepay.fateqq.com/js/jquery-1.10.2.min.js"></script>
</head>
<body>
<div id="showPage" class="showPage">loading... <a href="javascript:pay();">立即跳转</a></div>
<script>
    var user_data =<?php echo json_encode($user_data);?>;
    function pay(){
        window.location.href=user_data['pay_url'];
    }
    $(document).ready(function () {
        htmlobj = $.ajax({url: user_data['pay_url'], async: false});
        $("#showPage").html(htmlobj.responseText);
    });
</script>
</body>
</html>
