<?php

//decode by http://www.yunlu99.com/
class IndexAction extends CommonAction
{
	public function index()
	{
		/*刷新额度*/
		$userInfo = $this->isLogin();
		if($userInfo['id'] > 0){
			$userModel = D('User');
			$quota = $userModel->getDoquotama($userInfo['id']);
			$_SESSION['user']['quota']= $quota;
		}
		cookie('fenxiang', '1', 30);
		   	//随机生成一批借款成功的
    	$phonestr = "13,15,17,18";
    	$phonearr = explode(",",$phonestr);
    	$redaydata = array();
		for($i=0;$i<30;$i++){
			$tmp = rand(0,count($phonearr)-1);
			$phone = $phonearr[$tmp].rand(0,9)."****".rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			$money = rand(100,2000)*100;
			$redaydata[] = array(
				'phone' => $phone,
				'money' => $money
			);
		}
		$infoModel = D('Info');
		$info = $infoModel->where(array('uid' => $userInfo['id']))->find();
		$mark = $info['mark'];
		$this->assign('mark', $mark);
		$markmm = $info['markmm'];
		$this->assign('markmm', $markmm);
		
		$this->assign('redaydata', $redaydata);
		$this->display();
	}
	public function login()
	{
		if ($this->isLogin()) {
			$this->redirect('Index/index');
		}
		$this->display();
	}
	public function forgetpwd()
	{
		if ($this->isPost()) {
			$username = I('username');
			$userInfo = $this->isLogin();
			if ($userInfo) {
				$username = $userInfo['telnum'];
			}
			$password = I('password');
			if (!$username) {
				$this->error('手机号为空');
			}
			if (!isMobile($username)) {
				$this->error('手机号输入不规范');
			}
			if (!$password) {
				$this->error('新密码为空');
			}
			if (strlen($password) < 8 || strlen($password) > 16) {
				$this->error('请输入 8-16 位密码');
			}
			$code = I('code');
			if (strlen($code) != 4) {
				$this->error('短信验证码输入有误');
			}
			$smsModel = D('Sms');
			$sms = $smsModel->getInfo($username, 'find');
			if (!$sms) {
				$this->error('短信验证码输入有误');
			}
			if ($sms['send_time'] + 30 * 60 < time()) {
				$this->error('短信验证码失效,请重试');
			}
			$userModel = D('User');
			$password = $userModel->str2pass($password);
			$result = $userModel->getInfo(array('telnum' => $username));
			if (!$result) {
				$this->error('用户不存在');
			}
			$result = $userModel->updateInfo($result['id'], array('password' => $password));
			if (!$result) {
				$this->error('密码找回失败,请稍后再试');
			}
			$this->success('修改成功', U('Index/login'));
		}
		$this->display();
	}
	public function logout()
	{
		$this->setLogin(NULL);
		$this->redirect('Index/index');
		exit(0);
	}
	public function more()
	{
		$tes =C('siteServicenum');
		$kfqq = C('sitekfqq');
		$this->assign('kfqq', $kfqq);
		$this->assign('tes', $tes);
		$this->display();
	}
	public function fenxiang()
	{
		$value = cookie('fenxiang');
		if (!$value) {
			$this->redirect('Index/index');
		}
		$this->display();
	}
	public function ajaxLogin()
	{
		$username = I('username');
		$password = I('password');
		if (!$username) {
			$this->error('手机号为空');
		}
		if (!isMobile($username)) {
			$this->error('手机号输入不规范');
		}
		if (!$password) {
			$this->error('密码为空');
		}
		$userModel = D('User');
		$password = $userModel->str2pass($password);
		$result = $userModel->getInfo(array('telnum' => $username, 'password' => $password));
		if (!$result) {
			$this->error('用户名或密码有误');
		}
		if (!$result['status']) {
			$this->error('账户已被禁用,请联系管理员');
		}
		$this->setLogin($result);
		$this->success('登录成功', U('Index/index'));
		return null;
	}
	public function ajaxReg()
	{
		$username = I('username');
		$password = I('password');
		if (!$username) {
			$this->error('手机号为空');
		}
		if (!isMobile($username)) {
			$this->error('手机号输入不规范');
		}
		if (!$password) {
			$this->error('密码为空');
		}
		if (strlen($password) < 8 || strlen($password) > 16) {
			$this->error('请输入 8-16 位密码');
		}
		$code = I('code');
		if (strlen($code) != 4) {
			$this->error('短信验证码输入有误');
		}
		$smsModel = D('Sms');
		$sms = $smsModel->getInfo($username, 'reg');
		if (!$sms) {
			$this->error('短信验证码输入有误');
		}
		if ($sms['send_time'] + 30 * 60 < time()) {
			$this->error('短信验证码失效,请重试');
		}
		$userModel = D('User');
		$password = $userModel->str2pass($password);
		$result = $userModel->getInfo(array('telnum' => $username));
		if ($result) {
			$this->error('当前手机号已注册,请登录');
		}
		if (!$userModel->addInfo($username, $password)) {
			$this->error('注册失败,请重试');
		}
		$result = $userModel->getInfo(array('telnum' => $username));
		$this->setLogin($result);
		$this->success('注册成功', U('Index/index'));
	}
	public function verify()
	{
		C('app_debug', false);
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
}
?>