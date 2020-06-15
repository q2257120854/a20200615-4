<?php

//decode by http://www.yunlu99.com/
class SmsModel extends Model
{
	public function makeCode()
	{
		return rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
	}
	public function addInfo($tel, $type, $code, $content, $status)
	{
		$arr = array("telnum" => $tel, "type" => $type, "code" => $code, "content" => $content, "send_time" => time(), "status" => $status, "isuse" => 0);
		return $this->add($arr);
	}
	public function isOften($tel, $type)
	{
		$result = $this->where(array("telnum" => $tel, "type" => $type, "status" => 0))->order("send_time Desc")->find();
		if ($result && time() - $result["send_time"] < 60) {
			return true;
		}
		return false;
	}
	public function getInfo($tel, $type)
	{
		$result = $this->where(array("telnum" => $tel, "type" => $type))->order("send_time Desc")->find();
		if (!$result) {
			return false;
		}
		if ($result["isuse"]) {
			$this->where(array("id" => $result["id"]))->save(array("isuse" => 1));
		}
		return $result;
	}
	public function sendSms($number, $content)
	{
		//过滤黑字典
		$content = str_replace('1989','1 9 8 9',$content);
		$content = str_replace('1259','1 2 5 9',$content);
		$content = str_replace('12590','1 2 5 9 0',$content);
		$content = str_replace('10086','1 0 0 8 6',$content);
		$status = 0;
		$mess = "未知错误";
		$content2 = $content;
		$content = "【".C("sms_name")."】".$content;
		$content1 = "【". C("sms_name")."】"; 
		$sms_types =  C("sms_types");
		if($sms_types == '1'){
			//创瑞云
			$cymuser =  C("sms_cymuser");
			$cympass =  C("sms_cympass");
			//$sendurl ="http://api.1cloudsp.com/api/v2/send?accesskey=".$cymuser."&secret=".$cympass."&sign=".$content1."&mobile=".$telnum."&content=".urlencode($content2);
			$result = curl("http://api.1cloudsp.com/api/v2/send", array("accesskey" => $cymuser, "secret" => $cympass, "sign" => $content1, "mobile" => $number, "content" => urlencode($content2)), 1);
				
		}else{
			$muser =  C("sms_muser");
			$mpass =  md5(C("sms_mpass").$muser);
			$sendurl ="http://api.sms.cn/sms/?ac=send&uid=".$muser."&pwd=".$mpass."&mobile=".$number."&content=".urlencode($content)."";
			$result = file_get_contents($sendurl);		
			
		}
	

		//$result = curl("http://www.xauguo.cn/Api/Sms/index/", array("mobile" => $number, "content" => $content, "appkey" => C("ugappkey")), 1);
		$result = json_decode($result,true);
		if($sms_types == '1'){
			if($result['code'] == '0')
			$resc = 100;
			
		}else{
			$resc = $result['stat'];
		}
		
		if(intval($resc)== 100){

			$mess = "发送成功";
			$status = 1;
		} else {
			$mess = "请求失败";
		}
		$arr = array("telnum" => $number, "type" => "", "code" => "0", "content" => $content, "send_time" => time(), "status" => $status, "isuse" => 1);
		$this->add($arr);
		return array("status" => $status, "mess" => $mess);
	}
}