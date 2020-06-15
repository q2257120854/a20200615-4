<?php

//decode by http://www.yunlu99.com/
class PayAction extends CommonAction
{
	public function alipay()
	{
		$order = I('order');
		if (!$order) {
			$this->error('非法操作');
		}
		$payorderModel = D('Payorder');
		$info = $payorderModel->where(array('id' => $order))->find();
		if (!$info) {
			$this->error('订单不存在');
		}
		if ($info['status'] == 1) {
			$this->error('订单已支付,请勿重复支付');
		}
		if (isWchat()) {
			$this->display();
			exit(0);
		}
		$out_trade_no = $order;
		$subject = '订单' . $out_trade_no;
		$total_fee = $info['money'];
		require_once 'alipay.config.php';
		$parameter = array('service' => $alipay_config['service'], 'partner' => C('alipayPartner'), 'seller_id' => C('alipayPartner'), 'payment_type' => $alipay_config['payment_type'], 'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . U('Pay/notify_alipay'), 'return_url' => 'http://' . $_SERVER['HTTP_HOST'] . U('Repay/index'), 'anti_phishing_key' => $alipay_config['anti_phishing_key'], 'exter_invoke_ip' => $alipay_config['exter_invoke_ip'], 'out_trade_no' => $out_trade_no, 'subject' => $subject, 'total_fee' => round($total_fee, 2), 'body' => '', '_input_charset' => trim(strtolower($alipay_config['input_charset'])));
		import('@.Util.AlipaySubmit');
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
		header('Content-type:text/html;charset=utf-8');
		echo $html_text;
	}
	public function notify_alipay()
	{
		require_once 'alipay.config.php';
		import('@.Util.AlipayNotify');
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		if ($verify_result) {
			$id = $_POST['out_trade_no'];
			$payorderModel = D('Payorder');
			$info = $payorderModel->where(array('id' => $id))->find();
			if ($info && !$info['status']) {
				if ($payorderModel->where(array('id' => $id))->save(array('status' => 1, 'pay_time' => time()))) {
					$billList = json_decode($info['billlist'], true);
					if ($billList) {
						$loanbillModel = D('Loanbill');
						$loanorderModel = D('Loanorder');
						$i = 0;
						while ($i < count($billList)) {
							$bill = $loanbillModel->where(array('id' => $id))->find();
							if ($bill && $bill['status'] != 2 && $bill['status'] != 3 && $bill['status'] != 4) {
								$tmp = array('status' => 2, 'repay_time' => time());
								if ($bill['status'] == 1) {
									$tmp['status'] = 3;
								}
								$loanbillModel->where(array('id' => $id))->save($tmp);
								if (!$loanbillModel->where(array('toid' => $bill['toid'], 'status' => array('IN', '0,1')))->count()) {
									$loanorderModel->where(array('id' => $bill['toid']))->save(array('status' => 1));
								}
							}
							$i = $i + 1;
						}
					}
				}
			}
			echo 'success';
		} else {
			echo 'fail';
		}
	}
}