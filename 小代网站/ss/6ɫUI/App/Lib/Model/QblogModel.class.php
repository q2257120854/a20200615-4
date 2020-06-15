<?php

class QblogModel extends Model
{

		public function addlog($uid , $money, $upimg)
	{
		
		return $this->add(array('uid' => $uid, 'money' => $money, 'status' => 0, 'add_time' => time(), 'pzimg' => $upimg ,'bz' => 1));
	}
		public function htaddlog($uid , $money)
	{
		$id = $this->add(array('uid' => $uid, 'money' => $money, 'status' => 1, 'add_time' => time(), 'isadmin' => 1 ,'bz' => 1));
		return $id;
	}
		public function outlog($uid , $money)
	{
		
		return $this->add(array('uid' => $uid, 'money' => $money, 'status' => 0, 'add_time' => time(), 'pzimg' => '' ,'bz' => 2));
	}
		public function hkoutlog($uid , $money)
	{
		
		return $this->add(array('uid' => $uid, 'money' => $money, 'status' => 1, 'add_time' => time(), 'isadmin' => 9 ,'bz' => 2));
	}
		public function updateQblog($uid = 0, $arr = array())
	{
		if (!$uid || !$arr) {
			return false;
		}
		return $this->where(array('uid' => $uid))->save($arr);
	}
	public function getQblogst($uid = 0){
		if (!$uid) {
			return false;
		}
		$rea =array();
		$rea['error'] = '0';
		$wh =array();
		$wh['uid'] =  array('eq',$uid);
		$wh['bz'] =  array('eq',1);			
		$jre = $this->where($wh)->order('id desc')->limit(1)->select();
		if($jre){
			$status =$jre['0']['status'];
			if($status == '0'){
				//有新待审核
				$rea =array();
				$rea['error'] = '1';
				$rea['money'] = $jre['0']['money'];
			}else{
				$rea =array();
				$rea['error'] = '2';
				$rea['money'] = $jre['0']['money'];
			}
		}
		
		return $rea;
	}
	
	public function getQblogtx($uid = 0){
		if (!$uid) {
			return false;
		}
		$rea =array();
		$rea['error'] = '0';
		$wh =array();
		$wh['uid'] =  array('eq',$uid);
		$wh['bz'] =  array('eq',2);			
		$jre = $this->where($wh)->order('id desc')->limit(1)->select();
		if($jre){
			$status =$jre['0']['status'];
			if($status == '0'){
				//有新待审核提现
				$rea =array();
				$rea['error'] = '1';
				$rea['money'] = $jre['0']['money'];
			}else{
				$rea =array();
				$rea['error'] = '2';
				$rea['money'] = $jre['0']['money'];
			}
		}
		
		return $rea;
	}
	public function getQbloglist($uid,$bz){
		if (!$uid) {
			return false;
		}
		$bz = intval($bz);
		$uid = intval($uid);
		$wh =array();
		$wh['uid'] =  array('eq',$uid);
		$wh['bz'] =  array('eq',$bz);
		$wh['isadmin'] =  array('lt','9');
		
		$qbList = $this->where($wh)->order('id desc')->select();
		
		return $qbList;
	}
	
	public function getQbbilllist($oid){
		if (!$oid) {
			return false;
		}
	
		$loanbillModel = D('Loanbill');
		$billList = $loanbillModel->where(array('toid' => $oid))->order('billnum ASC')->select();
				$i = 0;
		while ($i < count($billList)) {
			$billList[$i]['allmoney'] = toMoney($billList[$i]['money'] + $billList[$i]['interest'] + $billList[$i]['overdue']);
			$i = $i + 1;
		}
		
		return $billList;
	}
}
?>