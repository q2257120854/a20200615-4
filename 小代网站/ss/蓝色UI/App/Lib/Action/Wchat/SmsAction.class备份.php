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
		$content = "【". C("sms_name")."】" . $tpl_cont;
		$content1 = "【". C("sms_name")."】"; 
		$content = str_replace("<@>", $code, $content);
		$content = str_replace("《@》", $code, $content);
				//过滤黑字典
		$content = str_replace('1989','1 9 8 9',$content);
		$content = str_replace('1259','1 2 5 9',$content);
		$content = str_replace('12590','1 2 5 9 0',$content);
		$content = str_replace('10086','1 0 0 8 6',$content);
		$content2 = str_replace($content1,'',$content);
		//$sendurl = "http://www.smsbao.com/sms?u=cyd888&p=".md5('abc@123456')."&m=".$telnum."&c=".urlencode($content)."";
		$sms_types =  C("sms_types");
		if($sms_types == '1'){
			//创瑞云
			$cymuser =  C("sms_cymuser");
			$cympass =  C("sms_cympass");
			//$sendurl ="http://api.1cloudsp.com/api/v2/send?accesskey=".$cymuser."&secret=".$cympass."&sign=".$content1."&mobile=".$telnum."&content=".urlencode($content2);
			$result = curl("http://api.1cloudsp.com/api/v2/send", array("accesskey" => $cymuser, "secret" => $cympass, "sign" => $content1, "mobile" => $telnum, "content" => urlencode($content2)), 1);
				
		}else{
			$muser =  C("sms_muser");
			$mpass =  md5(C("sms_mpass").$muser);
			$sendurl ="http://api.sms.cn/sms/?ac=send&uid=".$muser."&pwd=".$mpass."&mobile=".$telnum."&content=".urlencode($content)."";							
			$result = file_get_contents($sendurl);
		}
		
		if (!$result) {
			$this->error("请求失败");
		}
		$result = json_decode($result,true);
		if($sms_types == '1'){
			if($result['code'] == '0')
			$resc = 100;
			
		}else{
			$resc = $result['stat'];
		}
		
		if($resc == 100){

			$mess = "发送成功";
			$succ = 1;
		} else {
			$mess = "请求失败";
			$succ = 0;
		}

		$smsModel->addInfo($telnum, $type, $code, $content, $resc);
		if (!$succ) {
			$this->error($mess);
		}
		$this->success($mess);
	}
}