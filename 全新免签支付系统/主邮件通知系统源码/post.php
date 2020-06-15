<?php
// 引入PHPMailer的核心文件
error_reporting(0);
header('content-type:text/html;charset=utf-8');
require_once("./edlm.php");
$edlm = new Edlm;
if(isset($_POST['token'])){
	$token = $_POST['token'];
	if($token!=""){
		$token = $edlm->edd1('maddog',$token,0);
		if(strstr($token,"maddog")!=""){
			$sjr = $edlm->getSubstr($token,"sjr:","title:");
			if(!$sjr==""){
				$title = $edlm->getSubstr($token,"title:","content:");
				if(!$title==""){
					$content = $edlm->getSubstr($token,"content:","maddog");
					if(!$content==""){
						require_once("./class.phpmailer.php");
						require_once("./class.smtp.php");
						$mail = new PHPMailer();
						$mail->SMTPDebug = 1;
						$mail->isSMTP();
						$mail->SMTPAuth = true;
						$mail->Host = "smtp.qq.com";
						$mail->SMTPSecure = 'ssl';
						$mail->Port = 465;
						$mail->CharSet = 'UTF-8';
						$mail->FromName = "";//发件人
						$mail->Username = "admin@cn";//发信邮箱
						$mail->Password = "";//发信密码
						$mail->From = "admin@cn";//发信邮箱
						$mail->isHTML(true);
						$mail->addAddress($sjr);
						$mail->Subject = $title;
						$mail->Body = $content;
						$status = $mail->send();
					}else{
						exit("Content error".$token);
					}
				}else{
					exit("Title error".$token);
				}
			}else{
				exit("To error");
			}
		}else{
			exit("Plaes Out");
		}
	}
}else{
	exit("Plaes Out");
}
?>