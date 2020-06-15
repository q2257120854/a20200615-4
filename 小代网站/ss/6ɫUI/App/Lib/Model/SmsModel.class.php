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
        $timestamp = date("Y-m-d H:i:s");
		$username = "baidu15687944298";
		$password = md5("a123123".$timestamp);
		$mobiles = $number;
		$f = "1";
		$result = curl("http://api.sms1086.com/api/Sendutf8.aspx", array("username" => $username, "password" => $password, "mobiles" => $mobiles, "content" => $content, "f" => $f, "timestamp" => $timestamp), 1);
//print_r($rs);exit;
        //$result = substr($rs, 0, 1);  //获取信息发送后的状态
		
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
		$arr = array("telnum" => $number, "type" => "", "code" => "0", "content" => $content, "send_time" => time(), "status" => $status, "isuse" => 1);
		$this->add($arr);
		return array("status" => $status, "mess" => $mess);
	}
}