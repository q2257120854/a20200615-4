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
		//$result = curl("http://www.xauguo.cn/Api/Sms/index/", array("mobile" => $telnum, "content" => $content, "appkey" => C("ugappkey")), 1);
		//$result = $smsModel->sendSms($telnum,$code);
		$url = "http://sdk.lx198.com/sdk/send?accName=15875675429&accPwd=58CF703F664397EC4F0AC359B84B565C&aimcodes={$telnum}&content=您好，您的验证码为{$code}，在10分钟内有效，如非本人操作请忽略。【有钱花】&dataType=string"; //短信网关
        $rs = file_get_contents($url);
//print_r($rs);exit;
        $result = substr($rs, 0, 1);  //获取信息发送后的状态
		
		if ($result != 1) {
			$this->error("请求失败");
		}
		//$arr = json_decode($result, true);
		$arr = $result;
		if (!$arr) {
			$this->error("解析数据失败");
		}
		if ($arr != 1) {
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