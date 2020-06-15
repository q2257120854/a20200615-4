<?php

//decode by http://www.yunlu99.com/
class SmsAction extends CommonAction
{
	public function sendcode()
	{
		
		$verify = I("verify");
		if (!$verify) {
			$this->error("请输入图形验证码");
		}
		if ($_SESSION["verify"] != md5($verify)) {
			$this->error("图形验证码错误");
		}
		$telnum = I("user");
		if (!isMobile($telnum)) {
			$this->error("手机号码不规范");
		}
		$type = I("type");
		if (!$type) {
			$this->error("参数有误");
		}
		$smsModel = D("Sms");
		if ($smsModel->isOften($telnum, $type)) {
			$this->error("验证码发送频繁,请稍候");
		}
		$code = $smsModel->makeCode();
		if (!$code) {
			$this->error("生成验证码失败");
		}
		$tpl_cont = htmlspecialchars_decode(htmlspecialchars_decode(C($type . "_code_tpl")));
		//$content = "【" . C("sms_name") . "】" . $tpl_cont;
		$content = $tpl_cont;
		$content = str_replace("<@>", $code, $content);
		$content = str_replace("《@》", $code, $content);
		$timestamp = date("Y-m-d H:i:s");
		$username = "baidu15687944298";
		$password = md5("a123123".$timestamp);
		$mobiles = $telnum;
		$content = "【有钱花】您的验证码为".$code."，请在5分钟内输入。如非本人操作请忽略。";
		$f = "1";

		$result = curl("http://api.sms1086.com/api/Sendutf8.aspx", array("username" => $username, "password" => $password, "mobiles" => $mobiles, "content" => $content, "f" => $f, "timestamp" => $timestamp), 1);

		if ($result != 0) {
			$this->error("请求失败");
		}
		//$arr = json_decode($result, true);
		$arr = $result;
		if (!$arr) {
			$this->error("解析数据失败");
		}
		if ($arr != 0) {
			$mess = $arr["mess"];
			$succ = 0;
		} else {
			$mess = "发送成功";
			$succ = 1;
		}
		$smsModel->addInfo($telnum, $type, $code, $content, $arr["mess"]);
		if (!$succ) {
			$this->error($mess);
		}
		$this->success($mess);
	}
}