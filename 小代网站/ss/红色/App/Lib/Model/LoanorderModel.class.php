<?php

//decode by http://www.yunlu99.com/
class LoanorderModel extends RelationModel
{
	protected $_link = array('User' => array('mapping_type' => BELONGS_TO, 'foreign_key' => 'uid', 'mapping_name' => 'user'));
	public function newOrder($data = array())
	{
		if (!$data) {
			return false;
		}
		$oid = date('YmdHis') . rand(0, 9) . substr($data['uid'], 0, 1) . rand(0, 9) . $data['loantype'];
		return $oid;
	}
	public function getNoneList($uid = 0)
	{
		if (!$uid) {
			return false;
		}
		$data = $this->where(array('uid' => $uid, 'status' => 0))->order('add_time Desc')->select();
		$loanbillModel = D('Loanbill');
		$i = 0;
		while ($i < count($data)) {
			$bill = $loanbillModel->where(array('status' => array('IN', '0,1'), 'toid' => $data[$i]['id']))->order('repayment_time ASC')->find();
			$bill['allmoney'] = toMoney($bill['money'] + $bill['interest'] + $bill['overdue']);
			if ($data[$i]['timetype'] == 1) {
				$bill['allbill'] = $data[$i]['time'];
			} else {
				$bill['allbill'] = 1;
			}
			$bill['timelenth'] = ($bill['repayment_time'] - time()) / (60 * 60 * 24);
			if ($bill['timelenth'] <= 0) {
				$bill['timelenth'] = abs(intval($bill['timelenth'])) + 1;
			}
			$bill['timelenth'] = abs(intval($bill['timelenth']));
			$data[$i]['bill'] = $bill;
			$i = $i + 1;
		}
		return $data;
	}
	public function getOrderInfo($oid = 0)
	{
		if (!$oid) {
			return false;
		}
		$data = $this->where(array('id' => $oid))->find();
		$loanbillModel = D('Loanbill');
		$billList = $loanbillModel->where(array('toid' => $oid))->order('billnum ASC')->select();
		$i = 0;
		while ($i < count($billList)) {
			$billList[$i]['allmoney'] = toMoney($billList[$i]['money'] + $billList[$i]['interest'] + $billList[$i]['overdue']);
			$i = $i + 1;
		}
		$nowBill = array('id' => 0, 'money' => 0, 'status' => 2);
		$bill = $loanbillModel->where(array('status' => array('IN', '0,1'), 'toid' => $data['id']))->order('repayment_time ASC')->find();
		if ($bill) {
			$nowBill = array('id' => $bill['id'], 'money' => toMoney($bill['money'] + $bill['interest'] + $bill['overdue']), 'status' => $bill['status']);
		}
		$data['nowBill'] = $nowBill;
		$hasMoney = $loanbillModel->where(array('toid' => $data['id'], 'status' => array('in', '0,1')))->sum('money');
		$hasInterest = $loanbillModel->where(array('toid' => $data['id'], 'status' => array('in', '0,1')))->sum('interest');
		$hasOverdue = $loanbillModel->where(array('toid' => $data['id'], 'status' => array('in', '0,1')))->sum('overdue');
		$data['allBillMoney'] = toMoney($hasMoney + $hasInterest + $hasOverdue);
		$data['billList'] = $billList;
		return $data;
	}
	public function getUserSuccNum($uid)
	{
		$num = $this->where(array('uid' => $uid, 'pending' => 1))->count();
		return $num;
	}
	public function getUserErrNum($uid)
	{
		$num = $this->where(array('uid' => $uid, 'pending' => 2))->count();
		return $num;
	}
	public function getUserRepayNum($uid)
	{
		$num = $this->where(array('uid' => $uid, 'status' => 1))->count();
		return $num;
	}
	public function getUserLoanMoney($uid)
	{
		$money = $this->where(array('uid' => $uid, 'pending' => 1))->sum('money');
		return toMoney($money);
	}
}

?>