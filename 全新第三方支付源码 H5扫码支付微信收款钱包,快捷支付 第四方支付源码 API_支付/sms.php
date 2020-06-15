<?php
error_reporting(E_ALL); 
ini_set('display_errors', '1'); 
session_start();

header('content-type:text/html;charset=utf-8');

    $phone=$_POST["Tel"];

    if(!preg_match('/^[0-9]{11,13}$/',$phone))
    {
    print("error");
    exit();
    }
  
    $randCode = '';
    $chars = '123456789';
    for ( $i = 0; $i < 4; $i++ ){
    	$randCode .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    if(empty($_SESSION['codetime'])){
    	$_SESSION['codetime'] = 0 ;
    }
    $time=time()-$_SESSION['codetime'];
    if($_SESSION['codetime']>0 and $time<=60){
    	exit("1分钟内只能获取一次验证码");
    }

    $_SESSION['code'] = strtolower($randCode);



    date_default_timezone_set("PRC");




    // tpl_id 短信模板id
    $tpl_id         = "TP18050813";
    // $appcode
    $appcode        = "16f4204906d94310a67efc470fad7187";


    $host = "http://dingxin.market.alicloudapi.com";
    $path = "/dx/sendSms";
    $method = "POST";
    $appcode = $appcode;
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "mobile=".$phone."&param=code%3A".$_SESSION['code']."&tpl_id=".$tpl_id;
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $jsonArray = curl_exec($curl);

    $jsonArray = json_decode($jsonArray,true);


    
     if($jsonArray['return_code'] == "00000"){
        echo "发送成功".$jsonArray['order_id'];
    }else{
        echo "发送失败,错误码：".$jsonArray['return_code'];
     }

	 // 提交完整资料链接：http://localhost:86/register/mobile?phone=18792434053&token=7ec1272055d5771806dea8d52d6214fa4c7a7a3f
	  // 提交完整资料链接：http://localhost:86/register/mobile?phone=手机号&token=token值
	 
	 
	 // stmp：mtp.189.cn,端口 25, 账户18792434053@189.cn, 密码wgc,.123
	 
// 错误码 错误信息    描述
// 10000   参数异常    必传参数有空值()
// 10001   手机号格式不正确    手机号应为11位手机号
// 10002   模板不存在   没有申请模板,或模板未通过审核
// 10003   模板变量不正确 模板中含有变量,但未将变量传入,变量传值格式错误
// 10004   变量中含有敏感词    变量中含有违法敏感词
// 10005   变量名称不匹配 申请的模板中含有变量名称,变量的名称与所传变量名称不匹配
// 10006   短信长度过长  签名+模板+变量长度超过70字,超过一条短信长度,如果有超长短信需求请联系客服
// 10007   手机号查询不到归属地  所传手机号查询不到归属地
// 10008   产品错误    系统错误,详情请联系客服
// 10009   价格错误    系统错误,详情请联系客服
// 10010   重复调用    由于网络原因重复调用接口
// 99999   系统错误    详情请联系客服
// 00000   调用成功    		   
?>