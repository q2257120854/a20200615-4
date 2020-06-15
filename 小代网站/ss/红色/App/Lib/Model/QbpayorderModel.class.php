<?php


class QbpayorderModel extends RelationModel
{
	
	protected $_link = array('User' => array('mapping_type' => BELONGS_TO, 'foreign_key' => 'uid', 'mapping_name' => 'user'));
	public function newOrders($uid, $money, $bill)
	{
		
		if (!$uid || !$money) {
			return false;
		}
		return $this->add(array('uid' => $uid, 'billlist' => json_encode($bill), 'money' => $money, 'status' => 0, 'add_time' => time(), 'pay_time' => 0));
	}
}