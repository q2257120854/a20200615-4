<?php

//decode by http://www.yunlu99.com/
class LoanAction extends CommonAction
{
	public function review()
	{
		$this->display();
	}
	public function refuse()
	{
		$this->display();
	}
	public function getConfirmInfo()
	{
		session('LoanInfo', NULL);
		$userInfo = $this->isLogin();
		if (!$userInfo) {
			$this->error('请先登录', U('Index/login'));
		}

		$money = I('money');
		$time = I('time');
		if (!$money || !$time) {
			$this->error('参数错误');
		}
		$MoneyScale = getMoneyScale();
		/*判断资料是否审核通过和可提现金额2*/
		$loaModel = D('Loanorder');
		$wh =array();
		$wh['uid'] =  array('eq',$userInfo['id']);		
		$jre = $loaModel->where($wh)->order('id desc')->limit(1)->select();
		if($jre){
			$pending =$jre['0']['pending'];
			if($pending == '0'){
				$this->error('您的借款已通过,请进个人账户>提现管理查看');	
			}
		$issta = $jre['0']['status'];
		if($issta != '1'){
		$this->error('借款账户异常冻结，请处理后重试！');	
		}
		}

		/*end*/
		if ($money < $MoneyScale['min'] || $money > $MoneyScale['max']) {
			$this->error('借款金额不符合规定');
		}
		
		$infoModel = D('Info');
		$infoStatus = $infoModel->getStatus($userInfo['id']);
		if ($infoStatus == 0) {
			$this->error('请完成资料评估', U('Info/check'));
		}
		if ($infoStatus == 0 - 1) {
			$this->error('您的资料未通过审核', U('Loan/refuse'));
		}
		if ($infoStatus == 1) {
			$this->error('您的资料正在审核,请耐心等待', U('Loan/review'));
		}
		if (!$userInfo['quota'] || $userInfo['quota'] == 0) {
			/**/
			$this->error('您目前没有信用额度,无法申请借款');
		}
	
		$userModel = D('User');
		$doquota = $userModel->getDoquota($userInfo['id']);
		if ($doquota < $money) {
			$this->error('您的信用额度不足,无法申请借款');
		}
		$DeadlineList = getDeadlineList();
		if (!$DeadlineList || !$DeadlineList['list']) {
			$this->error('系统出错,请联系管理员');
		}
		if (!is_array($DeadlineList['list'])) {
			$this->error('系统设置出错');
		}
		if (!in_array($time, $DeadlineList['list'])) {
			$this->error('借款期限不符合规定');
		}
		$infoModel = D('Info');
		if (!$infoModel->checkAllInfo($userInfo['id'])) {
			/**/
			$this->error('您的资料不完整,请补充', U('Info/check'));
		}

		$idcardInfo = $infoModel->getAuthInfo($userInfo['id'], 'identity');
		$idcardInfo = json_decode($idcardInfo, true);
		if (!$idcardInfo) {
			$this->error('身份信息获取失败');
		}
		$bankInfo = $infoModel->getAuthInfo($userInfo['id'], 'bank');
		$bankInfo = json_decode($bankInfo, true);
		if (!$bankInfo) {
			$this->error('收款银行卡获取失败');
		}
		$starttime = strtotime(date('Y-m-d'));
		if (C('Loan_TYPE')) {
			$endtime = strtotime('+' . $time . ' Month', $starttime);
			$repaymenttime = date('d', strtotime('+29 day', $starttime));
			$fastrepayment = strtotime('+29 day', $starttime);
		} else {
			$endtime = strtotime('+' . $time . ' day', $starttime);
			$repaymenttime = $endtime;
			$fastrepayment = $endtime;
		}
		$data = array('uid' => $userInfo['id'], 'name' => $idcardInfo['name'], 'idcard' => $idcardInfo['idcard'], 'money' => $money, 'time' => $time, 'bankname' => $bankInfo['bankName'], 'banknum' => substr($bankInfo['bankNum'], 0 - 4), 'loantype' => C('Loan_TYPE'), 'interest' => getInterest(), 'starttime_str' => date('Y/m/d', $starttime), 'starttime' => $starttime, 'endtime_str' => date('Y/m/d', $endtime), 'endtime' => $endtime, 'repaymenttime' => $repaymenttime, 'fastrepayment_str' => date('m/d', $fastrepayment), 'fastrepayment' => $fastrepayment, 'overdue' => C('Overdue'));
		session('LoanInfo', $data);


		$this->success($data);
	}
	public function signature()
	{
		// mmm 20190524 012
		$passtype = C('passtype');
		$this->assign('passtype', $passtype);
		// mmm 20190524
		if ($this->isPost()) {
			//$signature = I('signature');
			
			$signature = '';
			// if (!$signature) {
				// $this->error('合同签名失败');
			// }
		// mmm 20190524 012
		if($passtype != '2'){
			$tpass = I('tpass');
			if (!$tpass) {
				$this->error('请输入6位数提现密码');
			}
		}
		// mmm 20190524 012		
			$infoModel = D('Info');
			$userInfo = $this->isLogin();
			$bankInfo = $infoModel->getAuthInfo($userInfo['id'], 'bank');
			$bankInfo = json_decode($bankInfo, true);
			if (!$bankInfo) {
				$this->error('收款银行卡获取失败');
			}
			/*验证密码*/
			// mmm 20190524 012
		if($passtype != '2'){
			$btpass = $bankInfo['txpass'];
			if($passtype == '0' || $passtype == ''){
				 $ypass = C("ypass");
			}else{
				 $ypass = $btpass;
			}
			 
			if ($tpass != $ypass) {
				$this->error('提现密码错误');
			}
		}else{
				$tpass ='000000';


		}	
			// mmm 20190524 012
			$data = session('LoanInfo');
	
			if (!$data) {
				$this->error('借款信息提取失败');
			}
			$loanorderModel = D('Loanorder');
			$data['oid'] = $loanorderModel->newOrder($data);
			if (!$data['oid']) {
				$this->error('生成订单失败');
			}

			$arr = array('uid' => $data['uid'], 'oid' => $data['oid'], 'money' => $data['money'], 'time' => $data['time'], 'timetype' => $data['loantype'], 'name' => $data['name'], 'bankname' => $data['bankname'], 'banknum' => $bankInfo['bankNum'], 'interest' => $data['interest'], 'start_time' => $data['starttime'], 'overdue' => $data['overdue'], 'add_time' => time(), 'sign' => $signature, 'tpass' => $tpass, 'data' => json_encode($data), 'status' => 0, 'pending' => 0);
			$toid = $loanorderModel->add($arr);
			if (!$toid) {
				$this->error('订单保存失败');
			}

			/*开始生成分单 20181029*/
			$oid = $data['oid'];
			$order = $loanorderModel->where(array('oid' => $oid))->find();
			if (!$order) {
				$this->error('订单不存在');
			}
			if ($order['pending'] != 0) {
				$this->error('订单已审核');
			}

			$data = json_decode($order['data'], true);
			$loanbillModel = D('Loanbill');
			if ($order['timetype'] == 0) {
				$billData = array('uid' => $order['uid'], 'toid' => $order['id'], 'oid' => $order['oid'], 'billnum' => 1, 'money' => $order['money'], 'interest' => toMoney(floatval($order['money']) * floatval($order['interest']) * intval($order['time'])), 'overdue' => 0, 'repayment_time' => $data['fastrepayment'], 'status' => 0, 'add_time' => time());
				$loanbillModel->add($billData);
			} else {
				$i = 0;
				while ($i < intval($order['time'])) {
					$repayment_time = $data['fastrepayment'];
					if ($i > 0) {
						$repayment_time = strtotime('+' . $i . ' Month', $repayment_time);
					}
					$billData = array('uid' => $order['uid'], 'toid' => $order['id'], 'oid' => $order['oid'], 'billnum' => $i + 1, 'money' => toMoney($order['money'] / intval($order['time'])), 'interest' => toMoney(floatval($order['money']) * floatval($order['interest'])), 'overdue' => 0, 'repayment_time' => $repayment_time, 'status' => 0, 'add_time' => time());
					$loanbillModel->add($billData);
					$i = $i + 1;
				}
				$billMoney = intval($order['time']) * toMoney(floatval($order['money']) * floatval($order['interest'])) + intval($order['time']) * toMoney($order['money'] / intval($order['time']));
				$deviation = $billMoney - $order['money'];
				if ($deviation > 0) {
				}
				if ($deviation < 0) {
				}
			}	
			$result = $loanorderModel->where(array('oid' => $oid))->save(array('pending' => '1','aus' => '1'));
			if (!$result) {
				$this->error('订单分单失败');
			}
			/*结束生成分单 20181029*/			
			session('LoanInfo', NULL);
			$smsModel = D('Sms');
			$content = htmlspecialchars_decode(htmlspecialchars_decode(C('loan_submit')));
			$content = str_replace('<@>', $data['oid'], $content);
			$content = str_replace('《@》', $data['oid'], $content);
			$smsModel->sendSms($userInfo['telnum'], $content);
			$this->success('签约成功', U('Loan/signdone', array('oid' => $data['oid'])));
		}
		$data = session('LoanInfo');
		if (empty($data)) {
			$this->redirect('Index/index');
		}
		$this->display();
	}
	public function signdone()
	{
		$oid = I('oid');
		if (!$oid) {
			$this->redirect('Index/index');
		}
		$this->assign('oid', $oid);
		$this->display();
	}
	public function viewContract()
	{
		$contractTpl = C('contractTpl');
		$contractTpl = empty($contractTpl) ? '' : htmlspecialchars_decode(htmlspecialchars_decode($contractTpl));
		$this->assign('tpl', $contractTpl);
		$this->display();
	}
}