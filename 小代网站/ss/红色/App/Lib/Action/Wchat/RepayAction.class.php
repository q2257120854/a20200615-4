<?php

class RepayAction extends CommonAction
{
	public function index()
	{
		$userModel = D('User');
		$userInfo = $this->isLogin();

		/*刷新额度*/
		$doquota = $userModel->getDoquota($userInfo['id']);
		$quota = $userModel->getDoquotama($userInfo['id']);
		$quohas =$userModel->getDoquohas($userInfo['id']);
		$qbmoney =$userModel->getQbmoney($userInfo['id']);
		
		$this->assign('qbmoney', $qbmoney);
		$this->assign('quohas', $quohas);
		$this->assign('doquota', $doquota);
		$this->assign('quota', $quota);
		$qblogModel = D('Qblog');
		$qbzx = $qblogModel->getQblogst($userInfo['id']);
		$qberror = 0;
		$qbshmoney = 0;
		if($qbzx['error'] == '1'){			
			$qberror = $qbzx['error'];
			$qbshmoney = $qbzx['money'];
		}
		
		$this->assign('qberror', $qberror);
		$this->assign('qbshmoney', $qbshmoney);
		$qbtx = $qblogModel->getQblogtx($userInfo['id']);
		$qbtxerror = 0;
		$qbtxmoney = 0;
		if($qbtx['error'] == '1'){			
			$qbtxerror = $qbtx['error'];
			$qbtxmoney = $qbtx['money'];
		}
		
		$this->assign('qbtxerror', $qbtxerror);
		$this->assign('qbtxmoney', $qbtxmoney);
		
		$tmpTime = strtotime('+29 day', time());
		$loanbillModel = D('Loanbill');
		$bill = $loanbillModel->where(array('uid' => $userInfo['id'], 'status' => array('IN', '0,1')))->order('repayment_time ASC')->find();
		
		$infoModel = D('Info');
		$bankInfo = $infoModel->getAuthInfo($userInfo['id'], 'bank');
		$bankInfo = json_decode($bankInfo, true);	
		$csn = $bankInfo['bankNum'];
		$csn =  substr($csn, 0, 4) . "******" . substr($csn, -4); 

		$tel =$userInfo['telnum'];
		
		$info = $infoModel->where(array('uid' => $userInfo['id']))->find();
		$mark = $info['mark'];
		$this->assign('mark', $mark);
		$markmm = $info['markmm'];
		$this->assign('markmm', $markmm);
		
		$qbmark =$userModel->getqbmark($userInfo['id']);
		$this->assign('qbmark', $qbmark);
		$this->assign('zfbcodes', C("zfbcodes"));
		$this->assign('wxcodes', C("wxcodes"));
		$this->assign('paybank', C("paybank"));
				$this->assign('payname', C("payname"));
						$this->assign('paysn', C("paysn"));
								$this->assign('paysm', C("paysm"));
		$this->assign('tel', $tel);
		$this->assign('csn', $csn);
		$loaModel = D('Loanorder');
		$wh =array();
		$wh['uid'] =  array('eq',$userInfo['id']);		
		$jres = $loaModel->where($wh)->order('id desc')->limit(1)->select();
		if($jres){
			$xbzmark =$jres['0']['xbzmark'];

			
		$this->assign('xbzmark', $xbzmark);
		}
		//$this->assign('money', toMoney($bill['money'] + $bill['interest'] + $bill['overdue']));
		//$this->assign('time', $bill['repayment_time']);
		$this->assign('billId', $bill['id']);
		$this->assign('toid', $bill['toid']);
		$this->display();
	}
	public function viewmm()
	{
		$userInfo = $this->isLogin();
		$infoModel = D('Info');
		$fuserInfo = $infoModel->getAuthInfo($userInfo['id']);
		$identityInfo = json_decode($fuserInfo['identity'], true);
		$this->assign('name', $identityInfo['name']);
		
		$this->display();
	}
		public function viewt()
	{	
		$userInfo = $this->isLogin();
		$loanorderModel = D('Loanorder');
		$loanInfo = $loanorderModel->where(array('uid' => $userInfo['id']))->relation(true)->find();
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
		$fuserInfo = $infoModel->getAuthInfo($userInfo['id']);
		$addessInfo = json_decode($fuserInfo['addess'], true);
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
	public function order()
	{
		$loanorderModel = D('Loanorder');
		$userInfo = $this->isLogin();
		$list = $loanorderModel->getNoneList($userInfo['id']);
		$loanbillModel = D('Loanbill');
		$hasMoney = $loanbillModel->where(array('uid' => $userInfo['id'], 'status' => array('in', '0,1')))->sum('money');
		$hasMoney = intval($hasMoney);
		$hasInterest = $loanbillModel->where(array('uid' => $userInfo['id'], 'status' => array('in', '0,1')))->sum('interest');
		$hasOverdue = $loanbillModel->where(array('uid' => $userInfo['id'], 'status' => array('in', '0,1')))->sum('overdue');
		$this->assign('noneMoney', toMoney($hasMoney + $hasInterest + $hasOverdue));
		$this->assign('ojr', toMoney($hasMoney));
		$this->assign('dbt', C('dbt'));
		$this->assign('allsm', C('allsm'));
		$this->assign('indexdbt', C('indexdbt'));
		$this->assign('indexsm', C('indexsm'));
			$userModel = D('User');
			$quota = $userModel->getDoquotama($userInfo['id']);
		$this->assign('tojr',$quota);
		//var_dump($hasMoney);die;
		$this->assign('list', $list);
		$this->display();
	}	
	public function viewbill()
	{
		$id = I('oid');
		$nod = 1 ;
		if (!$id) {
			$this->error('暂时无需还款！');
			$nod = 1;
		}else{
				$loanorderModel = D('Loanorder');
				$order = $loanorderModel->getOrderInfo($id);
				if (!$order) {
					$this->error('获取账单失败');
				}
				
				if ($order['pending'] != 1) {
					$this->error('订单状态有误');
				}	
			$this->assign('data', $order);
		}
		$userModel = D('User');
		$userInfo = $this->isLogin();
		$qbmoney =$userModel->getQbmoney($userInfo['id']);
		
		$this->assign('qbmoney', $qbmoney);
		$this->assign('nod', $nod);
		$this->display();
	}
	public function repayment()
	{
		$billId = I('id');
		if (!$billId) {
			$this->error('账单参数有误');
		}
		$payorderModel = D('Payorder');
		$loanbillModel = D('Loanbill');
		$bill = $loanbillModel->where(array('id' => $billId))->find();
		if (!$bill) {
			$this->error('账单不存在');
		}
		if ($bill['status'] == 2 || $bill['status'] == 3) {
			$this->error('当前账单已还款');
		}
		if ($bill['status'] == 4) {
			$this->error('当前账单已失效');
		}
		$userInfo = $this->isLogin();
		$billMoney = toMoney($bill['money'] + $bill['interest'] + $bill['overdue']);
		$order = $payorderModel->newOrder($userInfo['id'], $billMoney, array($billId));
		if (!$order) {
			$this->error('支付订单创建失败');
		}
		$this->redirect('Pay/alipay', array('order' => $order));
		exit(0);
	}
	
	public function yqm()
	{	

		$userModel = D('User');
		$userInfo = $this->isLogin();
		if (!$userInfo) {
			$this->error('登陆过期，请重新登陆！');
		}
		$id = I('id');
		$strc = I('strc');
		if (!$id) {
			$this->error('订单参数有误');
		}
		if (!$strc) {
			$this->error('邀请码不能为空');
		}
		$loanorderModel = D('Loanorder');
		$info = $loanorderModel->where(array('oid' => $id))->find();
		if (!$info) {
			$this->error('该订单不存在');
		}
		$result = $loanorderModel->where(array('oid' => $id))->save(array( 'yqm' => $strc));
		if (!$result) {
			$this->error('订单操作失败');
		}
		$this->success('操作成功');
		exit(0);
	}
	public function addbalance(){
		
		$this->display();		
	}
	public function getaddbalance(){
		$userModel = D('User');
		$userInfo = $this->isLogin();
		if (!$userInfo) {
			$this->error('登陆过期，请重新登陆！');
		}
		$uid = $userInfo['id'];
		$upimg = I("upimg");
		$money = I('money', 0, 'floatval');
		if (!$upimg) {
			$this->error("请上传转账记录截屏!");
		}
		$frontSuffix = substr(strrchr($upimg, "."), 1);
		$frontSuffix = strtolower($frontSuffix);
		$suffix = array("jpg", "png", "jpeg", "gif");
		if (!in_array($frontSuffix, $suffix)) {
			$this->error("截屏照片类型有误!");
		}
		if (!$money) {
			$this->error('请输入的充值金额!');
		}
		$qblogModel = D('Qblog');
		$money = toMoney($money);
		$ismo = floatval(999999.00);
		$ism = bcsub($ismo, $money, 2);
		if ($ism < 1){
			$this->error('提交失败,单笔充值金额不能大于999999');
		}
		if (!$qblogModel->addlog($uid , $money, $upimg)) {
			$this->error('提交失败,请重试');
		}
		
		$this->success('操作成功');
		exit(0);
	}
	
	public function getoutbalance(){
		$userModel = D('User');
		$userInfo = $this->isLogin();
		if (!$userInfo) {
			$this->error('登陆过期，请重新登陆！');
		}
		$uid = $userInfo['id'];
		$qxpass= I("qxpass");
		$qxmon = I('qxmon', 0, 'floatval');
		$qxmon = toMoney($qxmon);	
		if (!$qxpass) {
			$this->error("请输入6位数取现密码!");
		}
		$ypass = C("ypass");	 
		if ($qxpass != $ypass) {
			$this->error('取现密码错误');
		}
				$qblogModel = D('Qblog');
		/* 判断订单数 */
		$qbtx = $qblogModel->getQblogtx($uid);
		if($qbtx['error'] == '1'){			
			$this->error('提交取现失败，请等待上一笔取现订单审核通过');
		}
		
		$qbmoney =$userModel->getQbmoney($uid);
		$ism = bcsub($qbmoney, $qxmon, 2);
		if ($ism < 0){
			$this->error('提交失败！取现金额不能大于钱包余额');
			exit;
		}
		$qxmon = '-'.$qxmon;
		if (!$qblogModel->outlog($uid , $qxmon)) {
			$this->error('提交取现失败，请重试');
		}
		$this->success('操作成功');
		exit(0);	
	}
	
	public function gethk(){
		
		$userModel = D('User');
		$userInfo = $this->isLogin();
		if (!$userInfo) {
			$this->error('登陆过期，请重新登陆！');
		}
		$uid = $userInfo['id'];
		$toid = I('toid', 0, 'intval');
		$billnum = I('billnum', 0, 'intval');
		$billId = I('id');
		if (!$billId) {
			$this->error('账单参数有误1');
		}
		if ($toid < 1 || $billnum < 1 || $billId <1) {
			$this->error('账单参数有误2');
		}
		
		
		$loanbillModel = D('Loanbill');
		$bill = $loanbillModel->where(array('id' => $billId))->find();
		if (!$bill) {
			$this->error('账单不存在');
		}
		if ($bill['status'] == 2 || $bill['status'] == 3) {
			$this->error('当前账单已还款');
		}
		if ($bill['status'] == 4) {
			$this->error('当前账单已失效');
		}
		$billMoney = toMoney($bill['money'] + $bill['interest'] + $bill['overdue']);
		/*检测钱包余额*/
		$qbmoney =$userModel->getQbmoney($uid);
		$ism = bcsub($qbmoney, $billMoney, 2);
		if ($ism < 0){
			$this->error('还款失败！钱包余额不足，请及时充值！');
			exit;
		}

		$qbpayorderModel = D('Qbpayorder');
		$order = $qbpayorderModel->newOrders($uid, $billMoney, array($bill));
		if (!$order) {
			$this->error('支付订单创建失败');
		}
		
		$qblogModel = D('Qblog');
		$billMoneyog = '-'.$billMoney;
		$result = $qblogModel->hkoutlog($uid , $billMoneyog);
		if (!$result) {

			
			$this->error('钱包记录创建失败');
		}
		$usermoney = $userModel->updateQbmoney($uid, $billMoneyog ,2);
		if ($usermoney != 10) {
			//回滚记录
			$qblogModel->where(array('id' => $result))->save(array('status' => '0','qr_time' => $times));
		
			
			$this->error('用户钱包余额不足');
		}else{
			$id = $order;

			if ($qbpayorderModel->where(array('id' => $id))->save(array('status' => 1, 'pay_time' => time()))) {
				$loanorderModel = D('Loanorder');
				if ($bill['status'] != 2 && $bill['status'] != 3 && $bill['status'] != 4) {
					$tmp = array('status' => 2, 'repay_time' => time());
					if ($bill['status'] == 1) {
						$tmp['status'] = 3;
					}
					$loanbillModel->where(array('id' => $billId))->save($tmp);
					if (!$loanbillModel->where(array('toid' => $bill['toid'], 'status' => array('IN', '0,1')))->count()) {
						$loanorderModel->where(array('id' => $bill['toid']))->save(array('status' => 1));
					}
				}
			}else{
				//回滚记录
				$qblogModel->where(array('id' => $result))->save(array('status' => '0','qr_time' => $times));
			
				$usermoney = $userModel->updateQbmoney($uid, $billMoney ,1);
				$this->error('系统操作故障');
			}
		}
		$this->success('操作成功');
		exit(0);	
		
	}
}

?>