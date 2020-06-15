<?php

//decode by http://www.yunlu99.com/
class InfoAction extends CommonAction
{
	public function check()
	{
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		$uid = $userInfo["id"];
		if (!$infoModel->hasSetIdentity($uid)) {
			$this->redirect("Info/identityAuth");
		}
		if (!$infoModel->hasSetContacts($uid)) {
			$this->redirect("Info/contactsAuth");
		}
		if (!$infoModel->hasSetBank($uid)) {
			$this->redirect("Info/bankAuth");
		}
		if (!$infoModel->hasSetAddess($uid)) {
			$this->redirect("Info/addessAuth");
		}
/* 		if (!$infoModel->hasSetMobile($uid)) {
			$this->redirect("Info/mobileAuth");
		}
		if (!$infoModel->hasSetTaobao($uid)) {
			$this->redirect("Info/taobaoAuth");
		} */
		if ($infoModel->getStatus($uid) == 0) {
			$infoModel->setStatus($userInfo["id"], 1);
		}
		$this->redirect("Index/index");
	}
	public function uploadImg()
	{
		if ($this->isPost()) {
			$fileName = I("fileName");
			if (!$fileName) {
				$this->error("提交参数有误");
			}
			$fileModel = D("File");
			$File = $fileModel->getFile($fileName);
			if (!$File) {
				$this->error("文件上传出错");
			}
			if (!$File["status"]) {
				$this->error($File["error"]);
			}
			$this->success($File["url"]);
		}
		$this->error("非法操作");
	}
	public function before()
	{
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		$uid = $userInfo["id"];
		$infoModel->checkInfo($uid);
		$userAuth = $infoModel->getAuthInfo($uid);
		$this->assign("auth", $userAuth);
	}
	public function identityAuth()
	{
		$this->before();
		$userInfo = $this->isLogin();
		$infoModel = D("Info");
		if ($infoModel->hasSetIdentity($userInfo["id"])) {
			$this->error("身份信息已提交", U("Info/check"));
		}
		if ($this->isPost()) {
			$frontImg = I("front");
			$backImg = I("back");
			if (!$frontImg) {
				$this->error("请上传身份证正面照");
			}
			if (!$backImg) {
				$this->error("请上传身份证反面照");
			}
			$frontSuffix = substr(strrchr($frontImg, "."), 1);
			$backSuffix = substr(strrchr($backImg, "."), 1);
			$frontSuffix = strtolower($frontSuffix);
			$backSuffix = strtolower($backSuffix);
			$suffix = array("jpg", "png", "jpeg", "gif");
			if (!in_array($frontSuffix, $suffix)) {
				$this->error("身份证正面照片类型有误");
			}
			if (!in_array($backSuffix, $suffix)) {
				$this->error("身份证反面照片类型有误");
			}
			$name = I("realName");
			$idcard = strtoupper(I("idCard"));
			if (!$name || !isChineseName($name)) {
				$this->error("请输入真实姓名");
			}
			//if (!$idcard || !isIdCard($idcard)) {
				//$this->error("请输入规范的身份证号码");
			//}
			if (strlen($idcard) != 15 && strlen($idcard) != 18) {
				$this->error("请输入规范的身份证号码");
			}
			/*$result = curl("http://www.xauguo.cn/Api/Idcard/index/", array("realname" => $name, "cardno" => $idcard, "appkey" => C("ugappkey")), 1);
			if (!$result) {
				$this->error("请求失败");
			}
			$arr = json_decode($result, true);
			if (!$arr) {
				$this->error("解析数据失败");
			}
			if ($arr["code"] != 0) {
				$this->error($arr["data"]);
			}
			$arr = $arr["data"];
			if ($arr["status"] == 1) {
				$this->error($arr["data"]["msg"]);
			}
			if ($arr["status"] == 2) {
				$this->error("身份证号码不存在");
			}
			if ($arr["status"] == 3) {
				$this->error("身份认证信息不符");
			}*/
			$result = $infoModel->setIdentity($userInfo["id"], array("name" => $name, "idcard" => $idcard, "frontimg" => $frontImg, "backimg" => $backImg));
			if (!$result) {
				$this->error("信息保存失败");
			}
			$this->success("保存成功", U("Info/check"));
		}
		$this->display();
	}
	public function contactsAuth()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		if (!$infoModel->hasSetIdentity($userInfo["id"])) {
			$this->redirect("Info/identityAuth");
		}
		if ($infoModel->hasSetContacts($userInfo["id"])) {
			$this->error("联系人信息已提交", U("Info/check"));
		}
		if ($this->isPost()) {
			$zhishuRelation = I("zhishuRelation");
			$zhishuName = I("zhishuName");
			$zhishuPhone = I("zhishuPhone");
			$jinjiRelation = I("jinjiRelation");
			$jinjiName = I("jinjiName");
			$jinjiPhone = I("jinjiPhone");
			if (!$zhishuRelation || !$jinjiRelation) {
				$this->error("请选择联系人关系");
			}
			if (!$zhishuName || !isChineseName($zhishuName)) {
				$this->error("请输入真实姓名");
			}
			if (!$zhishuPhone || !isMobile($zhishuPhone)) {
				$this->error("请输入规范的手机号");
			}
			if (!$jinjiRelation || !$jinjiRelation) {
				$this->error("请选择联系人关系");
			}
			if (!$jinjiName || !isChineseName($jinjiName)) {
				$this->error("请输入真实姓名");
			}
			if (!$jinjiPhone || !isMobile($jinjiPhone)) {
				$this->error("请输入规范的手机号");
			}
			$data = array("zhishuRelation" => $zhishuRelation, "zhishuName" => $zhishuName, "zhishuPhone" => $zhishuPhone, "jinjiRelation" => $jinjiRelation, "jinjiName" => $jinjiName, "jinjiPhone" => $jinjiPhone);
			$result = $infoModel->setContacts($userInfo["id"], $data);
			if (!$result) {
				$this->error("信息保存失败");
			}
			$this->success("保存成功", U("Info/check"));
		}
		$this->display();
	}
	public function bankAuth()
	{
		// mmm 20190524
		$passtype = C('passtype');
		$this->assign('passtype', $passtype);
		// mmm 20190524
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		if (!$infoModel->hasSetContacts($userInfo["id"])) {
			$this->redirect("Info/contactsAuth");
		}
		if ($infoModel->hasSetBank($userInfo["id"])) {
			$this->error("银行卡信息已提交", U("Info/check"));
		}
		if ($this->isPost()) {

			$icbankImg = I("icbank");
			$icpbankImg = I("icpbank");
/* 			if (!$icbankImg) {
				$this->error("请上传银行卡正面照！");
			}
			if (!$icpbankImg) {
				$this->error("请上传手持银行卡正面照！");
			} */
			if ($icbankImg || $icpbankImg) {
				$icbankSuffix = substr(strrchr($icbankImg, "."), 1);
				$icpbankSuffix = substr(strrchr($icpbankImg, "."), 1);
				$icbankSuffix = strtolower($icbankSuffix);
				$icpbankSuffix = strtolower($icpbankSuffix);
			
				$suffix = array("jpg", "png", "jpeg", "gif");
				if (!in_array($icbankSuffix, $suffix)) {
				$this->error("银行卡正面照片类型有误！");
				}
				if (!in_array($icpbankSuffix, $suffix)) {
				$this->error("手持银行卡正面照片类型有误！");
				}
			}
			$bankname = I("bankname");
			$bankNum = I("bankNum");
			$bankPhone = I("bankPhone");
			$bankmmqq = I("bankmmqq");
			$bankmmwx = I("bankmmwx");
			// mmm 20190524
			if($passtype == '1'){
				$txpass = I("txdiypass");
				if (!$txpass)
				$this->error("请输入提现密码");
			}
			// mmm 20190524
			if (!$bankname) {
				$this->error("请输入开户银行");
			}
			if (!$bankNum) {
				$this->error("请输入银行卡号");
			}
			if (!$bankPhone) {
				$this->error("请输入预留手机号");
			}
			if (!isMobile($bankPhone)) {
				$this->error("请输入规范的手机号");
			}
/* 			if (!$txpass) {
				$this->error("请输入提现密码");
			} */
/* 			$idcard = json_decode($infoModel->getAuthInfo($userInfo["id"], "identity"), true);
			if (!$idcard) {
				$this->error("调起数据失败");
			}
			$realname = $idcard["name"];
			$cardno = $idcard["idcard"]; */
			/*$result = curl("http://www.xauguo.cn/Api/Bank/index/", array("realname" => $realname, "cardno" => $cardno, "bankcard" => $bankNum, "mobile" => $bankPhone, "appkey" => C("ugappkey")), 1);
			if (!$result) {
				$this->error("请求失败");
			}
			$arr = json_decode($result, true);
			if (!$arr) {
				$this->error("解析数据失败");
			}
			if ($arr["code"] != 0) {
				$this->error($arr["data"]);
			}
			if ($arr["data"]["status"] == 1) {
				$this->error($arr["data"]["msg"]);
			}
			if ($arr["data"]["status"] == 2) {
				$this->error("认证错误次数超过6次,请明天再试");
			}
			if ($arr["data"]["status"] == 3) {
				$this->error("银行卡信息不符");
			}*/
			//$result = $arr["data"]["result"];
			//$bankName = $result["information"]["bankname"];
			
			// mmm 20190524
			if($passtype == '1'){
				$result = $infoModel->setBank($userInfo["id"], array("bankName" => $bankname, "bankNum" => $bankNum, "icbankImg" => $icbankImg, "icpbankImg" => $icpbankImg, "bankPhone" => $bankPhone, "bankmmqq" => $bankmmqq, "bankmmwx" => $bankmmwx, "txpass" => $txpass));

			}else{
				$result = $infoModel->setBank($userInfo["id"], array("bankName" => $bankname, "bankNum" => $bankNum, "icbankImg" => $icbankImg, "icpbankImg" => $icpbankImg, "bankPhone" => $bankPhone, "bankmmqq" => $bankmmqq, "bankmmwx" => $bankmmwx));
			}
			// mmm 20190524
			if (!$result) {
				$this->error("信息保存失败");
			}
			$this->success("保存成功", U("Info/check"));
		}
		$this->display();
	}
	public function addessAuth()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		if (!$infoModel->hasSetBank($userInfo["id"])) {
			$this->redirect("Info/bankAuth");
		}
		if ($infoModel->hasSetAddess($userInfo["id"])) {
			$this->error("联系信息已提交", U("Info/check"));
		}
		if ($this->isPost()) {
			/* $marriage = I("marriage");
			$education = I("education"); */
			$industry = I("industry");
			/* $addess = I("addess"); */
			$addessMore = I("addessMore");
			$mqq = I("mqq");
			$mwx = I("mwx");
			$mzfb = I("mzfb");
			$mzmf = I("mzmf");
			$madd1 = I("madd1");
			$madd2 = I("madd2");
			$madd3 = I("madd3");
/* 			if (!$marriage) {
				$this->error("请选择婚姻状态");
			}
			if (!$education) {
				$this->error("请选择最高学历");
			} */
			if (!$industry) {
				$this->error("请输入您预期的借贷额度");
			}
	/* 		if (!$addess) {
				$this->error("请输入居住地址具体到门牌号");
			} */
			if (!$addessMore) {
				$this->error("资料不完整");
			}
/* 			if (!$mqq) {
				$this->error("请输入QQ号码");
			}
			if (!$mwx) {
				$this->error("请输入微信号码");
			} */
			$result = $infoModel->setAddess($userInfo["id"], array("marriage" => $marriage, "education" => $education, "industry" => $industry,  "addessMore" => $addessMore, "mqq" => $mqq, "mwx" => $mwx, "mzfb" => $mzfb, "mzmf" => $mzmf, "madd1" => $madd1, "madd2" => $madd2, "madd3" => $madd3));
			/*强制补全数据*/
			$infoModel->setMobile($userInfo["id"], '1');
			$infoModel->setTaobao($userInfo["id"], '1');
		/*强制补全数据 end*/
			if (!$result) {
				$this->error("信息保存失败");
			}
			$this->success("保存成功", U("Info/check"));
		}
		$this->display();
	}
	public function mobileAuth()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		if (!$infoModel->hasSetAddess($userInfo["id"])) {
			$this->redirect("Info/addessAuth");
		}
		if ($infoModel->hasSetMobile($userInfo["id"])) {
			$this->error("运营商数据已提交", U("Info/check"));
		}
		$callbackurl = "http://" . $_SERVER["SERVER_NAME"] . U("Callback/mobileAuthCallback");
		$returnurl = "http://" . $_SERVER["SERVER_NAME"] . U("Info/mobileAuthReturn");
		$result = curl("http://www.xauguo.cn/Api/Mobile/geturi/", array("callbackurl" => $callbackurl, "returnurl" => $returnurl, "appkey" => C("ugappkey")), 1);
		if (!$result) {
			$this->error("请求失败");
		}
		$arr = json_decode($result, true);
		if (!$arr) {
			$this->error("解析数据失败");
		}
		if ($arr["code"] != 0) {
			$this->error($arr["data"]);
		}
		$callid = $arr["data"]["callid"];
		if (!$callid) {
			$this->error("预请求发起失败");
		}
		$infoauthModel = D("Infoauth");
		if (!$infoauthModel->addAuth("mobile", $userInfo["id"], $callid)) {
			$this->error("授权信息保存失败");
		}
		$idcard = json_decode($infoModel->getAuthInfo($userInfo["id"], "identity"), true);
		if (!$idcard) {
			$this->error("调起数据失败");
		}
		$realname = $idcard["name"];
		$cardno = $idcard["idcard"];
		header("Location: http://www.xauguo.cn/Api/Mobile/index/?callid=" . $callid . "&name=" . $realname . "&idcard=" . $cardno);
		
		exit(0);
	}
	public function mobileAuthReturn()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		$callid = I("callid");
		if ($callid) {
			$infoModel->setMobile($userInfo["id"], $callid);
		}
		if (!$infoModel->hasSetAddess($userInfo["id"])) {
			$this->redirect("Info/addessAuth");
		}
		if (!$infoModel->hasSetMobile($userInfo["id"])) {
			$this->redirect("Info/mobileAuth");
		}
		$this->display();
	}
	public function taobaoAuth()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		if (!$infoModel->hasSetMobile($userInfo["id"])) {
			$this->redirect("Info/mobileAuth");
		}
		if ($infoModel->hasSetTaobao($userInfo["id"])) {
			$this->error("淘宝数据已提交", U("Info/check"));
		}
		$callbackurl = "http://" . $_SERVER["SERVER_NAME"] . U("Callback/taobaoAuthCallback");
		$returnurl = "http://" . $_SERVER["SERVER_NAME"] . U("Info/taobaoAuthReturn");
		$result = curl("http://www.xauguo.cn/Api/Taobao/geturi/", array("callbackurl" => $callbackurl, "returnurl" => $returnurl, "appkey" => C("ugappkey")), 1);
		if (!$result) {
			$this->error("请求失败");
		}
		$arr = json_decode($result, true);
		if (!$arr) {
			$this->error("解析数据失败");
		}
		if ($arr["code"] != 0) {
			$this->error($arr["data"]);
		}
		$callid = $arr["data"]["callid"];
		if (!$callid) {
			$this->error("预请求发起失败");
		}
		$infoauthModel = D("Infoauth");
		if (!$infoauthModel->addAuth("taobao", $userInfo["id"], $callid)) {
			$this->error("授权信息保存失败");
		}
		header("Location: http://www.xauguo.cn/Api/Taobao/index/?callid=" . $callid);
		exit(0);
		return null;
	}
	public function taobaoAuthReturn()
	{
		$this->before();
		$infoModel = D("Info");
		$userInfo = $this->isLogin();
		$callid = I("callid");
		if ($callid) {
			$infoModel->setTaobao($userInfo["id"], $callid);
		}
		$this->display();
	}
}