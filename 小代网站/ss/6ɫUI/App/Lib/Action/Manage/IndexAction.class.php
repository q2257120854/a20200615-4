<?php

//decode by http://www.yunlu99.com/
class IndexAction extends CommonAction
{
	public function index()
	{

		$adminInfo = $this->isLogin();
		if (!$adminInfo) {
			$this->redirect('Index/login');
			exit(0);
		}
		$this->assign('adminInfo', $adminInfo);
		$this->display();
	}
	public function main()
	{
		if (!$this->isLogin()) {
			$this->redirect('Index/login');
			exit(0);
		}
		$userModel = D('User');
		$loanorderModel = D('Loanorder');
		$loanbillModel = D('Loanbill');
		$dayRegNum = $userModel->where(array('reg_time' => array('EGT', strtotime(date('Y-m-d')))))->count();
		$dayLoanNum = $loanorderModel->where(array('add_time' => array('EGT', strtotime(date('Y-m-d')))))->count();
		$dayAgreeOrderNum = $loanbillModel->group('oid')->where(array('add_time' => array('EGT', strtotime(date('Y-m-d')))))->select();
		$dayAgreeOrderMoney = $loanbillModel->where(array('add_time' => array('EGT', strtotime(date('Y-m-d')))))->sum('money');
		$agreeOrderNum = $loanbillModel->group('oid')->select();
		$agreeOrderMoney = $loanbillModel->sum('money');
		$waitOrderNum = $loanbillModel->group('oid')->where(array('status' => array('IN', '0,1')))->select();
		$waitOrderMoney = $loanbillModel->where(array('status' => array('IN', '0,1')))->sum('money');
		$overdueOrderNum = $loanbillModel->group('oid')->where(array('status' => 1))->select();
		$overdueOrderMoney = $loanbillModel->where(array('status' => 1))->sum('money');
		$this->assign('dayRegNum', $dayRegNum);
		$this->assign('dayLoanNum', $dayLoanNum);
		$this->assign('dayAgreeOrderNum', count($dayAgreeOrderNum));
		$this->assign('dayAgreeOrderMoney', toMoney($dayAgreeOrderMoney));
		$this->assign('agreeOrderNum', count($agreeOrderNum));
		$this->assign('agreeOrderMoney', toMoney($agreeOrderMoney / 10000));
		$this->assign('waitOrderNum', count($waitOrderNum));
		$this->assign('waitOrderMoney', toMoney($waitOrderMoney / 10000));
		$this->assign('overdueOrderNum', count($overdueOrderNum));
		$this->assign('overdueOrderMoney', toMoney($overdueOrderMoney));
		$this->display();
	}
	public function apidata()
	{
		if (!$this->isLogin()) {
			$this->error('登录状态有误,请刷新页面');
		}
		$userModel = D('User');
		$loanorderModel = D('Loanorder');
		$loanbillModel = D('Loanbill');
		$data = array();
		$cityRegNum = $userModel->field(array('reg_city' => 'name', 'count(reg_city)' => 'value'))->group('reg_city')->select();
		$cityLoanMoney = array();
		$cityRepayMoney = array();
		foreach ($cityRegNum as $val) {
			$Loanvalue = 0;
			$Repayvalue = 0;
			$tmpArr = $userModel->where(array('reg_city' => $val['name']))->select();
			$i = 0;
			while ($i < count($tmpArr)) {
				$uid = $tmpArr[$i]['id'];
				$tmpvalue = $loanorderModel->where(array('uid' => $uid, 'pending' => 1))->sum('money');
				$Loanvalue = toMoney($tmpvalue) + $Loanvalue;
				$tmpvalue = $loanbillModel->where(array('uid' => $uid, 'status' => array('IN', '2,3')))->sum('money');
				$Repayvalue = toMoney($tmpvalue) + $Repayvalue;
				$tmpvalue = $loanbillModel->where(array('uid' => $uid, 'status' => array('IN', '2,3')))->sum('interest');
				$Repayvalue = toMoney($tmpvalue) + $Repayvalue;
				$tmpvalue = $loanbillModel->where(array('uid' => $uid, 'status' => array('IN', '2,3')))->sum('overdue');
				$Repayvalue = toMoney($tmpvalue) + $Repayvalue;
				$i = $i + 1;
			}
			$cityLoanMoney[] = array('name' => $val['name'], 'value' => $Loanvalue);
			$cityRepayMoney[] = array('name' => $val['name'], 'value' => $Repayvalue);
		}
		$data['cityRegNum'] = empty($cityRegNum) ? json_encode(array()) : json_encode($cityRegNum);
		$data['cityLoanMoney'] = empty($cityLoanMoney) ? json_encode(array()) : json_encode($cityLoanMoney);
		$data['cityRepayMoney'] = empty($cityRepayMoney) ? json_encode(array()) : json_encode($cityRepayMoney);
		$this->success($data);
		return NULL;
	}
	public function captcha()
	{
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	public function login()
	{
		if ($this->isPost()) {
			$name = I('username');
			$pass = I('password');
			$captcha = I('captcha');
			if (!$name) {
				$this->error('请输入管理用户名');
			}
			if (!$pass) {
				$this->error('请输入管理登录密码');
			}
			if (!$captcha) {
				$this->error('请输入验证码');
			}
			if ($_SESSION['verify'] != md5($captcha)) {
				$this->error('验证码输入有误');
			}
			$adminModel = D('Admin');
			$info = $adminModel->where(array('username' => $name, 'password' => $adminModel->str2pass($pass)))->find();
			if (!$info) {
				$this->error('管理用户名或密码有误');
			}
			if (!$info['status'] && !$info['type']) {
				$this->error('您的账户已被禁用,请联系站点创始人');
			}
			$this->setLogin($info);
			$adminModel->where(array('id' => $info['id']))->save(array('last_ip' => get_client_ip(), 'last_time' => time()));
			$this->success('登录成功');
		}
		$this->display();
	}
	public function logout()
	{
		$this->setLogin(NULL);
		$this->redirect('Index/login');
	}
	public function changepass()
	{
		$adminInfo = $this->isLogin();
		if (!$adminInfo) {
			$this->error('您还没有登录,请先登录', U('Index/login'));
		}
		if ($this->isPost()) {
			$oldpass = I('oldpass');
			$password = I('password');
			$repass = I('repass');
			if (!$oldpass) {
				$this->error('请输入原密码');
			}
			if (!$password) {
				$this->error('请输入新密码');
			}
			if (strlen($password) < 6) {
				$this->error('密码长度必须大于 6 位');
			}
			if ($password != $repass) {
				$this->error('两次密码输入不一致');
			}
			$adminModel = D('Admin');
			$info = $adminModel->where(array('username' => $adminInfo['username']))->find();
			if (!$info) {
				$this->error('账户异常');
			}
			if ($info['password'] != $adminModel->str2pass($oldpass)) {
				$this->error('原密码输入有误');
			}
			$result = $adminModel->where(array('username' => $adminInfo['username']))->save(array('password' => $adminModel->str2pass($password)));
			if (!$result) {
				$this->error('新密码保存失败');
			}
			$this->success('修改成功');
		}
		$this->display();
	}
}

?>