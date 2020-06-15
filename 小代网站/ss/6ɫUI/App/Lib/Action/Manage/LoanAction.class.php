<?php

//decode by http://www.yunlu99.com/
class LoanAction extends CommonAction
{
	public function pending()
	{
		//$where = array('pending' => 0);
		$where = array('aus' => 1);
		$userModel = D('User');
		if (I('s-pho')) {
		
			$muid=$userModel->getpho(I('s-pho'));
			$where['uid'] = array('EQ', $muid);
			
		}
		if (I('s-timeStart')) {
			$where['add_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['add_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['add_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		$loanorderModel = D('Loanorder');
		import('ORG.Util.Page');
		$count = $loanorderModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$lix = C("lix");
		
		
		$list = $loanorderModel->where($where)->order('add_time Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$i = 0;
		$loanbillModel = D('Loanbill');
		$qblogModel = D('Qblog');
		while ($i < count($list)) {
						
			$bill = $loanbillModel->where(array('status' => array('IN', '0,1'), 'toid' => $list[$i]['id']))->order('repayment_time ASC')->find();

			$list[$i]['interest_money'] = toMoney($list[$i]['interest'] * $list[$i]['time'] * $list[$i]['money']);
			$list[$i]['lix_money'] = toMoney($lix * $list[$i]['money'] * 0.01);
			$list[$i]['pda'] =  json_decode($list[$i]['data'],true);
			$list[$i]['qbmoney'] =  $userModel->getQbmoney($list[$i]['uid']);
			if($bill){
			$list[$i]['quotama'] = toMoney($bill['money'] + $bill['interest'] + $bill['overdue']);	
			}
			$qbzx = $qblogModel->getQblogst($list[$i]['uid']);
			if($qbzx['error'] == '1'){			
				$list[$i]['qbzx'] = '1';
			}
			$qbtx = $qblogModel->getQblogtx($list[$i]['uid']);
			if($qbtx['error'] == '1'){			
				$list[$i]['qbtx'] = '1';
			}
			$i = $i + 1;
		}
		
		$this->assign('lix', $lix);
		$allsm = C("allsm");
		$this->assign('allsm', $allsm);
		$ypass = C("ypass");
		$this->assign('ypass', $ypass);
		$dbt = C("dbt");
		$this->assign('dbt', $dbt);
		$wxcodes = C("wxcodes");
		$this->assign('wxcodes', $wxcodes);
				$zfbcodes = C("zfbcodes");
		$this->assign('zfbcodes', $zfbcodes);
				$paybank = C('paybank');
				$payname = C('payname');
						$paysn = C('paysn');
								$paysm = C("paysm");
		$this->assign('paybank', $paybank);
$this->assign('payname', $payname);
$this->assign('paysn', $paysn);
$this->assign('paysm', $paysm);		
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
		public function savepayinfo()
	{
		$paybank = I('paybank');
				$payname = I('payname');
						$paysn = I('paysn');
								$paysm = I('paysm');
		if (!$paybank || !$payname || !$paysn) {
			$this->error('银行卡设置，前三参数不能为空!');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('paybank' => $paybank,'payname' => $payname,'paysn' => $paysn,'paysm' => $paysm);
		if (!save_config($dat, $file, true)) {
				$this->error('银行卡设置保存失败');
		}
		$this->success('保存成功');
	}
	
	public function saveypass()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('提现密码设置不能为空!');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('ypass' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('提现密码设置保存失败');
		}
		$this->success('保存成功');
	}
	public function savelix()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('利率不能为空');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('lix' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('预设利率保存失败');
		}
		$this->success('保存成功');
	}
	public function savestrs()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('内容不能为空');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('allsm' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('预设待审核状态说明保存失败');
		}
		$this->success('保存成功');
	}
		public function savewxcode()
	{
		$wxcode = I('wxcode');
		if (!$wxcode) {
			$this->error('请选择上传文件.');
		}
		$file = CONF_PATH . 'site.php';
		$wxcodes = array('wxcodes' => $wxcode);
		if (!save_config($wxcodes, $file, true)) {
				$this->error('保存微信二维码失败');
		}
		$this->success('保存微信二维码成功');
	}
		public function savezfbcode()
	{
		$zfbcode = I('zfbcode');
		if (!$zfbcode) {
			$this->error('请选择上传文件.');
		}
		$file = CONF_PATH . 'site.php';
		$zfbcodes = array('zfbcodes' => $zfbcode);
		if (!save_config($zfbcodes, $file, true)) {
				$this->error('保存支付宝二维码失败');
		}
		$this->success('保存支付宝二维码成功');
	}
	
	public function savedbtstrs()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('内容不能为空');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('dbt' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('预设大标题保存失败');
		}
		$this->success('保存成功');
	}
	public function saveindexstrs()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('内容不能为空');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('indexsm' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('预设订单说明保存失败');
		}
		$this->success('保存成功');
	}
	public function saveindexdbtstrs()
	{
		$strs = I('strs');
		if (!$strs) {
			$this->error('内容不能为空');
		}
		$file = CONF_PATH . 'site.php';
		$dat = array('indexdbt' => $strs);
		if (!save_config($dat, $file, true)) {
				$this->error('预设订单状态保存失败');
		}
		$this->success('保存成功');
	}
		
	public function overdue()
	{
		$where = array('pending' => 1, 'status' => 1);
		if (I('s-oid')) {
			$where['oid'] = I('s-oid');
		}
		if (I('s-timeStart')) {
			$where['repayment_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['repayment_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['repayment_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		$loanbillModel = D('Loanbill');
		import('ORG.Util.Page');
		$count = $loanbillModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $loanbillModel->where($where)->order('repayment_time Desc,billnum Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$i = 0;
		while ($i < count($list)) {
			$list[$i]['bill_money'] = toMoney($list[$i]['money'] + $list[$i]['interest']);
			$list[$i]['overdue_time'] = ceil((time() - $list[$i]['repayment_time']) / (24 * 60 * 60));
			$i = $i + 1;
		}
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function refuse()
	{
		$where = array('pending' => 2);
		if (I('s-oid')) {
			$where['oid'] = I('s-oid');
		}
		if (I('s-timeStart')) {
			$where['add_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['add_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['add_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		$loanorderModel = D('Loanorder');
		import('ORG.Util.Page');
		$count = $loanorderModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $loanorderModel->where($where)->order('add_time Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$i = 0;
		while ($i < count($list)) {
			$list[$i]['interest_money'] = toMoney($list[$i]['interest'] * $list[$i]['time'] * $list[$i]['money']);
			$i = $i + 1;
		}
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function index()
	{
		$where = array('pending' => 1,'aus' => 2, 'status' => 0);
		if (I('s-oid')) {
			$where['oid'] = I('s-oid');
		}
		if (I('s-timeStart')) {
			$where['add_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['add_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['add_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		$loanorderModel = D('Loanorder');
		import('ORG.Util.Page');
		$count = $loanorderModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $loanorderModel->where($where)->order('add_time Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$loanbillModel = D('Loanbill');
		$i = 0;
		while ($i < count($list)) {

			$list[$i]['interest_money'] = toMoney($list[$i]['interest'] * $list[$i]['time'] * $list[$i]['money']);
			$list[$i]['hasBillNum'] = $loanbillModel->where(array('toid' => $list[$i]['id'], 'status' => array('IN', '2,3')))->count();
			$list[$i]['BillNum'] = $loanbillModel->where(array('toid' => $list[$i]['id']))->count();
			$list[$i]['overdueBillNum'] = $loanbillModel->where(array('toid' => $list[$i]['id'], 'status' => 3))->count();
		
			$i = $i + 1;
		}
		$indexsm = C("indexsm");
		$this->assign('indexsm', $indexsm);
		$indexdbt = C("indexdbt");
		$this->assign('indexdbt', $indexdbt);
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function payoff()
	{
		$where = array('pending' => 1, 'status' => 1);
		if (I('s-oid')) {
			$where['oid'] = I('s-oid');
		}
		if (I('s-timeStart')) {
			$where['add_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['add_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['add_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		$loanorderModel = D('Loanorder');
		import('ORG.Util.Page');
		$count = $loanorderModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $loanorderModel->where($where)->order('add_time Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$loanbillModel = D('Loanbill');
		$i = 0;
		while ($i < count($list)) {
			$list[$i]['interest_money'] = toMoney($list[$i]['interest'] * $list[$i]['time'] * $list[$i]['money']);
			$list[$i]['BillNum'] = $loanbillModel->where(array('toid' => $list[$i]['id']))->count();
			$list[$i]['overdueBillNum'] = $loanbillModel->where(array('toid' => $list[$i]['id'], 'status' => 3))->count();
			$i = $i + 1;
		}
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function bill()
	{
		$where = array();
		$loanbillModel = D('Loanbill');
		import('ORG.Util.Page');
		$count = $loanbillModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $loanbillModel->where($where)->order('add_time Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function setPendingStatus()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$loanorderModel = D('Loanorder');
		$order = $loanorderModel->where(array('id' => $id))->find();
		if (!$order) {
			$this->error('订单不存在');
		}
/* 		if ($order['pending'] != 0) {
			$this->error('订单已审核');
		} */
		$status = I('status');
		$error = '';
		//if ($status == 2) {
			$error = I('error');
		//}

/* 		if ($status == 1) {
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
		} */
		$userModel = D('User');
		$number = $userModel->getInfo('id', $order['uid'], 'telnum');
		$smsModel = D('Sms');
		if ($status == 1) {
			$content = htmlspecialchars_decode(htmlspecialchars_decode(C('loan_adopt')));
			$content = str_replace('<@>', $order['oid'], $content);
			$content = str_replace('《@》', $order['oid'], $content);
		} else {
			$content = htmlspecialchars_decode(htmlspecialchars_decode(C('loan_refuse')));
			$content = str_replace('<@>', $order['oid'], $content);
			$content = str_replace('《@》', $order['oid'], $content);
			$content = str_replace('<@sitename@>', C('siteName'), $content);
			$content = str_replace('《@sitename@》', C('siteName'), $content);
		}
		$smsModel->sendSms($number, $content);
		$result = $loanorderModel->where(array('id' => $id))->save(array('pending' => $status,'aus' => '2', 'error' => $error));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
		public function czqxs()
	{
		$id = I('id');
		$bz = I('bz');
		$status = I('sts');
		if (!$id) {
			$this->error('参数有误');
		}
		$bzt ='';
		if($bz == 1){
			$bzt ='充值';
		}else if($bz == 2){
			$bzt ='取现';
		}
		$qblogModel = D('Qblog');	
		$qblog = $qblogModel->where(array('id' => $id))->find();
		if (!$qblog) {
			$this->error($bzt.'记录不存在');
		}

		$times=time();
		$retbz = 0;
		$retbz = $qblog['bz'];
		if($retbz == '1' || $retbz == '2'){

		}else{
			$this->error($bzt.'记录操作状态异常');
		}
		
		$result = $qblogModel->where(array('id' => $id))->save(array('status' => '1','qr_time' => $times));
		if (!$result) {
			$this->error($bzt.'记录操作失败');
		}
		$money = $qblog['money'];
		$uid = $qblog['uid'];
		
		$userModel = D('User');
		$usermoney = $userModel->updateQbmoney($uid, $money ,$retbz);
		if ($usermoney != 10) {
						//回滚记录
			$qblogModel->where(array('id' => $id))->save(array('status' => '0','qr_time' => $times));
			if ($usermoney == 2) {
				$this->error('用户钱包实际余额不足,取现操作确认失败');
			}else{
				$this->error('用户钱包操作失败');
			}
		}
		
		$this->success('操作成功');
			
	}
	public function xzt(){
		$id = I('id');
		$strc = I('strc');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$strc) {
			$this->error('修改状态不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'zt' => $strc));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
	public function dbtxg(){
		$id = I('id');
		$strc = I('strc');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$strc) {
			$this->error('修改大标题不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'dbt' => $strc));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
	
	public function savexgo(){
		$id = I('id');
		$color = I('color');
		$dbt = I('dbt');
		$xsm = I('xsm');
		$sms= I('sms');
		$xbzmark= I('xbzmark');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$color) {
			$this->error('颜色RGB代码不能为空');
		}
		if (!$dbt) {
			$this->error('订单状态不能为空');
		}
		if (!$xsm) {
			$this->error('订单说明不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'tco' => $color,'dbt' => $dbt,'error' => $xsm,'xbzmark' => $xbzmark));
		if (!$result) {
			$this->error('订单操作失败');
		}
		if ($sms) {
			//sms
		//取
	
		$loanorderModel = D('Loanorder');
		$infos = $loanorderModel->where(array('oid' => $id))->find();
		$username = $infos['name'];
		$userModel = D('User');
		$number = $userModel->getInfo('id', $infos['uid'], 'telnum');	
		$sms = str_replace('@username@', $username, $sms);
		$smsModel = D('Sms');
		$ret= $smsModel->sendSms($number,$sms);
			if($ret['status'] == '0'){
			}else{
			$this->error('发送失败');
			}		
		}
		$this->success('操作成功');
	}
	public function xsm(){
		$id = I('id');
		$strc = I('strc');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$strc) {
			$this->error('修改说明不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'error' => $strc));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
	public function delLoanOrder()
	{
		$id = I('id');
		if (!$id) {
			$this->error('订单参数有误');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('id' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		if ($info['pending'] > 2 ) {
			$this->error('该订单状态不可被删除');
		}

		$result = $loanorderModel->where(array('id' => $id))->delete();
		if (!$result) {
			$this->error('订单操作失败');
		}
				/*m0913*/
		$loanbillModel = D('Loanbill');
		$result2 = $loanbillModel->where(array('oid' => $info['oid']))->delete();
/* 		$qblogModel = D('Qblog');
		
		$result3 = $qblogModel->where(array('uid' => $info['uid']))->delete();
		if (!$result3) {
			$this->error('钱包记录删除作失败');
		} */
		$this->success('删除成功');
	}
		public function dellog()
	{
		$id = I('id');
		$bz = I('bz');
		if (!$id) {
			$this->error('记录参数有误1');
		}
		if (!$bz) {
			$this->error('记录参数有误2');
		}
		$bzt = '';
		if($bz == 1){
			$bzt = '充值';
		}else if($bz == 2){
		   $bzt = '取现';
		}
			
		$qblogModel = D('Qblog');

		$loginfo = $qblogModel->where(array('id' => $id))->find();
		if (!$loginfo) {
			$this->error($bzt.'该记录不存在');
		}
/* 		if ($loginfo['status'] > 2 ) {
			$this->error('该记录状态不可被删除');
		} */

		$result = $qblogModel->where(array('id' => $id))->delete();
		if (!$result) {
			$this->error($bzt.'订单操作失败');
		}

		$this->success($bzt.'删除成功');
	}
	public function smszdy()
	{
		$pphone = I('pphone');
		$pconten = I('pconten');
		$oid = I('oid');
		$pconten = trim($pconten);
		if (!$pphone) {
			$this->error('手机号不能为空!');
		}
		if (!$pconten) {
			$this->error('发送内容不能为空!');
		}
		if (!$oid) {
			$this->error('订单参数有误');
		}
		$smsModel = D('Sms');
		//取
		$loanorderModel = D('Loanorder');
		$ypass = C("ypass");
		$infos = $loanorderModel->where(array('oid' => $oid))->find();
		$username = $infos['name'];
		$pconten = str_replace('@username@', $username, $pconten);
		$pconten = str_replace('@ypass', $ypass ,$pconten);
		$ret= $smsModel->sendSms($pphone,$pconten);

		if($ret['status'] == '0'){
			$this->success('发送成功');		
		}else{
			$this->error('发送失败');
		}
	}
	
	public function viewContract()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数错误');
		}
		$loanorderModel = D('Loanorder');
		$loanInfo = $loanorderModel->where(array('id' => $id))->relation(true)->find();
		if (!$loanInfo) {
			$this->error('不存在的借款订单');
		}
		$this->assign('data', $loanInfo);
		$contractTpl = C('contractTpl');
		$contractTpl = empty($contractTpl) ? '' : htmlspecialchars_decode(htmlspecialchars_decode($contractTpl));
		$loanData = json_decode($loanInfo['data'], true);
		$timeType = $loanInfo['timetype'] == 1 ? '月' : '日';
		if ($timeType == '月') {
			$endTime = strtotime('+' . intval($loanInfo['time']) . ' Month', $loanInfo['start_time']);
		} else {
			$endTime = strtotime('+' . intval($loanInfo['time']) . ' Day', $loanInfo['start_time']);
		}
		$sign = '<img src=\'data:image/png;base64,' . $loanInfo['sign'] . '\' width=\'110px\' />';
		$infoModel = D('Info');
		$userInfo = $infoModel->getAuthInfo($loanInfo['uid']);
		$addessInfo = json_decode($userInfo['addess'], true);
		$contractTpl = str_replace('｛借款人名称｝', $loanInfo['name'], $contractTpl);
		$contractTpl = str_replace('｛借款人身份证号｝', $loanData['idcard'], $contractTpl);
		$contractTpl = str_replace('｛借款人手机号｝', $loanInfo['user']['telnum'], $contractTpl);
		$contractTpl = str_replace('｛借款金额大写｝', cny($loanInfo['money']), $contractTpl);
		$contractTpl = str_replace('｛借款金额小写｝', $loanInfo['money'], $contractTpl);
		$contractTpl = str_replace('｛借款期限类型｝', $timeType, $contractTpl);
		$contractTpl = str_replace('｛借款利息｝', floatval($loanInfo['interest']), $contractTpl);
		$contractTpl = str_replace('｛借款开始日｝', date('Y年m月d日', $loanInfo['start_time']), $contractTpl);
		$contractTpl = str_replace('｛借款结束日｝', date('Y年m月d日', $endTime), $contractTpl);
		$contractTpl = str_replace('｛借款人用户名｝', $loanInfo['user']['telnum'], $contractTpl);
		$contractTpl = str_replace('｛收款银行账号｝', $loanInfo['banknum'], $contractTpl);
		$contractTpl = str_replace('｛收款银行开户行｝', $loanInfo['bankname'], $contractTpl);
		$contractTpl = str_replace('｛逾期利息｝', floatval($loanInfo['overdue']), $contractTpl);
		$contractTpl = str_replace('｛借款人签名｝', $sign, $contractTpl);
		$contractTpl = str_replace('｛合同签订日期｝', date('Y 年 m 月 d 日', $loanInfo['add_time']), $contractTpl);
		$contractTpl = str_replace('｛借款人住所｝', $addessInfo['addess'] . $addessInfo['addessMore'], $contractTpl);
		$this->assign('tpl', $contractTpl);
		$this->display();
	}
	
		public function viewhd()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数错误');
		}
		$loanorderModel = D('Loanorder');
		$loanInfo = $loanorderModel->where(array('id' => $id))->relation(true)->find();
		if (!$loanInfo) {
			$this->error('不存在的借款订单');
		}
		$this->assign('data', $loanInfo);
	//	$loanData = json_decode($loanInfo['data'], true);
		$txtime = date('Y/m/d；H:i:s', $loanInfo['add_time']).'</p>';
		$view_hd  = '<div class="pp"><div class="tits">转账批次号：</div><div class="co">5015754555</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转出单位：</div><div class="co">度小满（北京）科技有限公司</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转出账户：</div><div class="co">19080104000789</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转出账号地区：</div><div class="co">北京市</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">收款人姓名：</div><div class="co">'. $loanInfo['name'].'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">收款银行：</div><div class="co">'. $loanInfo['bankname'].'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">收款账户：</div><div class="co">'. $loanInfo['banknum'].'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">币种：</div><div class="co">人民币元</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转账金额：</div><div class="co">'. toMoney($loanInfo['money']).'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转账时间：</div><div class="co">'. $txtime.'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">转账类型：</div><div class="co">签约金融企业--网贷放款预约转账</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">执行方式：</div><div class="co">实时到账</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">状态：</div><div class="co"><span style="color:#006600;">转账失败</span></div></div>';
		$view_hd .= '<div class="pp"><div class="tits">银行备注：</div><div class="co">'. $loanInfo['vicsv'].'</div></div>';
		$view_hd .= '<div class="pp"><div class="tits">处理结果：</div><div class="co"><span style="color:#E53333;">未处理</span></div></div>';
		$view_hd .= '<div class="pp"><div class="tits">用户备注：</div><div class="co"></div></div>';
		$this->assign('tpl', $view_hd);
		$this->display();
	}
		public function viewhdo()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数错误');
		}
		$loanorderModel = D('Loanorder');

		$loanInfo = $loanorderModel->where(array('id' => $id))->relation(true)->find();
		if (!$loanInfo) {
			$this->error('不存在的借款订单');
		}
		$this->assign('data', $loanInfo);
	//	$loanData = json_decode($loanInfo['data'], true);
		$txtime = date('Y/m/d；H:i:s', $loanInfo['add_time']).'</p>';
		$lix = C('lix');
		$l_money = $lix * $loanInfo['money'] * 0.01;
		$lix_money = toMoney($l_money);
		$lix_money_90 = toMoney($l_money * 0.9);
		$timeType = $loanInfo['timetype'] == 1 ? '月' : '日';
		if ($timeType == '月') {
			$endTime = strtotime('+' . intval($loanInfo['time']) . ' Month', $loanInfo['start_time']);
		} else {
			$endTime = strtotime('+' . intval($loanInfo['time']) . ' Day', $loanInfo['start_time']);
		}		
		//var_dump($loanInfo);die;
		$view_hd  = '<td align="center" bgcolor="#fff">金融网贷商业险</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">贷款订单号'. $loanInfo['oid'].'</br>贷款金额'. toMoney($loanInfo['money']).'元整</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">'. $loanInfo['name'].'</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">'. $lix_money.'元整</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">'. date('Y/m/d日', $loanInfo['start_time']).'至'.date('Y/m/d日', $endTime).'</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">未生效</td>';
		$view_hd .= '<td align="center" bgcolor="#fff">电子保单</td>';
		$view_hd .= '<td align="center" bgcolor="#fff"><span style="color:#003399;">贷款合同 已上传√</br>投保人资料 已上传√</span></td>';

		$smm = $loanInfo['vicsv'];
		$this->assign('smm', $smm);
		$this->assign('smm6', $lix_money_90);
		$this->assign('tpl', $view_hd);
		$this->display();
	}
		public function qbmx()
	{
		$uid = I('uid');
		$oid = I('oid');
		if (!$uid) {
			$this->error('参数错误');
		}
		if (!$oid) {
			$this->error('参数错误.');
		}
		$uid = intval($uid);
		$oid = intval($oid);
		$loanorderModel = D('Loanorder');
		$infos = $loanorderModel->where(array('id' => $oid))->find();
		$username = $infos['name'];
		/* 钱包 充值取现记录  还款记录 */
		$userModel = D('User');
		$qbmoney = $userModel->getInfo('id', $uid, 'qbmoney');			
		if (!$qbmoney) {
			$this->error('不存在的用户');
		}
		$qbmark = $userModel->getInfo('id', $uid, 'qbmark');
		$qblogModel = D('Qblog');
		//充值记录列表
		$qblogczlist = $qblogModel->getQbloglist($uid,'1');
		$this->assign('qblogczlist', $qblogczlist);
		//取现记录列表
		$qblogqxlist = $qblogModel->getQbloglist($uid,'2');
		$this->assign('qblogqxlist', $qblogqxlist);
		//还款记录列表
		$hklist =$qblogModel->getQbbilllist($oid);
		$this->assign('hklist', $hklist);
		
		$this->assign('qbmark', $qbmark);
		$this->assign('qbmoney', $qbmoney);
		$this->assign('uid', $uid);
		$this->assign('username', $username);
		$this->display();
	}
	public function infoo(){
		$id = I('oid');
		$strc = I('sm');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if($strc == '1'){
			$strc = '2';
		}else{
			$strc = '1';
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'infoo' => $strc));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
	public function savevic(){
		$id = I('oid');
		$vicsv = I('vicsv');
		if (!$id) {
			$this->error('订单参数有误');
		}

		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'vicsv' => $vicsv));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}	
	public function evbank(){
		$id = I('oid');
		$bankname = I('bankname');
		$banknum = I('banknum');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$bankname) {
			$this->error('修改银行名称不能为空');
		}
				if (!$banknum) {
			$this->error('修改卡号不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$infoModel = D('Info');
		$bankInfo = $infoModel->getAuthInfo($info['uid'], 'bank');
		$bankInfo = json_decode($bankInfo, true);	
		$bankInfo['bankNum'] = $banknum;
		$bankInfo['bankName'] = $bankname;

		$result = $infoModel->setBank($info['uid'], $bankInfo);
		if (!$result) {
				$this->error("认证信息保存失败");
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'banknum' => $banknum,'bankname' => $bankname));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
	}
	public function maddbalance(){
		
		$uid = I('uid');
		$money = I('czmoney', 0, 'floatval');
		if (!$uid) {
			$this->error('充值参数有误');
		}
		$qblogModel = D('Qblog');
		$money = toMoney($money);
		$ismo = floatval(999999.00);
		$ism = bcsub($ismo, $money, 2);
		if ($ism < 1){
			$this->error('提交失败,单笔充值金额不能大于999999');
		}
		
		$result = $qblogModel->htaddlog($uid , $money);

		if (!$result) {
			$this->error('充值订单提交失败,请重试');
		}
		
		$userModel = D('User');
		$usermoney = $userModel->updateQbmoney($uid, $money ,1);
		if ($usermoney != 10) {
			//回滚记录
			$qblogModel->where(array('id' => $result))->save(array('status' => '0','qr_time' => $times));
			$this->error('用户钱包充值失败');
		}
		$this->success('充值成功');
		exit(0);
		
	}
	public function mqbmark(){
		$uid = I('uid');
		$qbmark = I('qbmark');	
		$qbmark =trim($qbmark);
		if (!$uid) {
			$this->error('参数有误');
		}
		$userModel = D('User');
		if (!$userModel->updateInfo($uid, array('qbmark' => $qbmark))) {
			$this->error('钱包备注操作失败');
		}
		
		$this->success('成功');
		exit(0);	
		
	}
	
}