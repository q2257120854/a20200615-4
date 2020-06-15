<?php
header('content-type:text/html;charset=utf-8');
session_start();
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

$_SESSION['code'] = strtolower($randCode);
$encode='UTF-8'; 
$username='wztf';  //用户名

$password_md5='dc483e80a7a0bd9ef71d8cf973673924';  //32位MD5密码加密，不区分大小写

$apikey='1be22b8ac3aa6b1b8f63fff34075e736';  //apikey秘钥（请登录 http://m.5c.com.cn 短信平台-->账号管理-->我的信息 中复制apikey）

$mobile= $phone;  //手机号,只发一个号码：13800000001。发多个号码：13800000001,13800000002,...N 。使用半角逗号分隔。

$content='您好，您的验证码是：'.$_SESSION['code'].'【万智通付】';  //要发送的短信内容，特别注意：签名必须设置，网页验证码应用需要加添加【图形识别码】。
//$content = iconv("GBK","UTF-8",$content);z

$contentUrlEncode = urlencode($content);//执行URLencode编码  ，$content = urldecode($content);解码

$result = sendSMS($username,$password_md5,$apikey,$mobile,$contentUrlEncode,$encode);  //进行发送

if(strpos($result,"success")>-1) {
	  echo "短信发送成功";
} else {
    echo "请求发送短信失败";
}
//echo $result;  //输出result内容，查看返回值，成功为success，错误为error，（错误内容在上面有显示）

//发送接口
function sendSMS($username,$password_md5,$apikey,$mobile,$contentUrlEncode,$encode)
{
    //发送链接（用户名，密码，apikey，手机号，内容）
    $url = "http://m.5c.com.cn/api/send/index.php?";  //如连接超时，可能是您服务器不支持域名解析，请将下面连接中的：【m.5c.com.cn】修改为IP：【115.28.23.78】
    $data=array
    (
        'username'=>$username,
        'password_md5'=>$password_md5,
        'apikey'=>$apikey,
        'mobile'=>$mobile,
        'content'=>$contentUrlEncode,
        'encode'=>$encode,
    );
    $result = curlSMS($url,$data);
    //print_r($data); //测试
    return $result;
}
function curlSMS($url,$post_fields=array())
{
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);//用PHP取回的URL地址（值将被作为字符串）
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//使用curl_setopt获取页面内容或提交数据，有时候希望返回的内容作为变量存储，而不是直接输出，这时候希望返回的内容作为变量
    curl_setopt($ch,CURLOPT_TIMEOUT,30);//30秒超时限制
    curl_setopt($ch,CURLOPT_HEADER,1);//将文件头输出直接可见。
    curl_setopt($ch,CURLOPT_POST,1);//设置这个选项为一个零非值，这个post是普通的application/x-www-from-urlencoded类型，多数被HTTP表调用。
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);//post操作的所有数据的字符串。
    $data = curl_exec($ch);//抓取URL并把他传递给浏览器
    curl_close($ch);//释放资源
    $res = explode("\r\n\r\n",$data);//explode把他打散成为数组
    return $res[2]; //然后在这里返回数组。
}
            
					   
			
?>

