<?php
include 'system/inc.php';
	 $smtpserver = $site_smtp;//SMTP服务器
	$smtpserverport = $site_port;//SMTP服务器端口
	$smtpusermail = $site_emailuser;//SMTP服务器的用户邮箱
	$smtpemailto = '3301200869@qq.com';//发送给谁
	$smtpuser = $site_emailuser;//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
	$smtppass = $site_emailpassword;//SMTP服务器的用户密码
	$mailtitle = $site_name."自动发货";//邮件主题
	$mailcontent = '尊敬的用户<BR>您好 ';//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
$mailtitle='hello';
	//************************ 配置信息 ****************************
	$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
 	if($state==""){
		echo "<a href='index.html'>点此返回</a>";
		exit();
	}
 die ('发送成功,请检查邮箱!');	