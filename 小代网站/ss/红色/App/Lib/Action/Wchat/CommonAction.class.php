<?php

//decode by http://www.yunlu99.com/
class CommonAction extends Action
{
	protected function _initialize()
	{
		if (C('siteClose') == 1) {
			echo '<meta charset="utf-8" />';
			exit('网站维护中');
		}
		C('URL_MODEL', 3);
		$action = strtoupper(MODULE_NAME . '@' . ACTION_NAME);
		$oaction = strtoupper(MODULE_NAME . '@*');
		$allowlist = array('INDEX@*', 'SMS@*', 'PAGE@*', 'CALLBACK@*', 'PAY@*');
		if (!in_array($action, $allowlist) && !in_array($oaction, $allowlist) && !$this->isLogin()) {
			$this->redirect('Index/login');
			exit(0);
		}
/* 		$loanbillModel = D('Loanbill');
		$loanorderModel = D('Loanorder');
		$w = array('repayment_time' => array('LT', time()), 'status' => array('IN', '0,1'), 'overdue_settime' => array('LT', time() - 24 * 60 * 60));
		$overdueList = $loanbillModel->where($w)->select();
		$i = 0;
		while ($i < count($overdueList)) {
			$bill = $overdueList[$i];
			$order = $loanorderModel->where(array('id' => $bill['toid']))->find();
			if ($order) {
				$overdue_interest = $order['overdue'];
				$overdue_days = abs(intval(diffBetweenTwoDays(time(), $bill['repayment_time'])));
				$overdue_money = toMoney($bill['money'] * $overdue_interest * $overdue_days);
				$loanbillModel->where(array('id' => $bill['id']))->save(array('status' => 1, 'overdue' => $overdue_money, 'overdue_settime' => time()));
				$userModel = D('User');
				$number = $userModel->getInfo('id', $bill['uid'], 'telnum');
				$smsModel = D('Sms');
				$content = htmlspecialchars_decode(htmlspecialchars_decode(C('bill_overdue')));
				$content = str_replace('<@>', $bill['oid'], $content);
				$content = str_replace('《@》', $bill['oid'], $content);
				$content = str_replace('<@num@>', $bill['billnum'], $content);
				$content = str_replace('《@num@》', $bill['billnum'], $content);
				//$smsModel->sendSms($number, $content);
			}
			$i = $i + 1;
		}
		$hasNearTime = strtotime('+3 Day', time());
		$w = array('repayment_time' => array('LT', $hasNearTime), 'status' => 0, 'overdue_smsstatus' => 0);
		$overdueList = $loanbillModel->where($w)->select();
		$i = 0;
		while ($i < count($overdueList)) {
			$bill = $overdueList[$i];
			$userModel = D('User');
			$number = $userModel->getInfo('id', $bill['uid'], 'telnum');
			$smsModel = D('Sms');
			$content = htmlspecialchars_decode(htmlspecialchars_decode(C('bill_remind')));
			$content = str_replace('<@>', $bill['oid'], $content);
			$content = str_replace('《@》', $bill['oid'], $content);
			$content = str_replace('<@num@>', $bill['billnum'], $content);
			$content = str_replace('《@num@》', $bill['billnum'], $content);
			//$smsModel->sendSms($number, $content);
			$i = $i + 1;
		} */
		return NULL;
	}
	protected function isLogin()
	{
		@($userinfo = session('user'));
		return empty($userinfo) ? false : $userinfo;
	}
	protected function setLogin($userinfo)
	{
		if (empty($userinfo)) {
			session('user', NULL);
			return true;
		}
		if (!empty($userinfo['password'])) {
			unset($userinfo['password']);
		}
		session('user', $userinfo);
		return true;
	}
}