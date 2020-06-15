<?php
/*360822198609284091*/
//decode by http://www.yunlu99.com/
class UserModel extends Model
{
	public function str2pass($str)
	{
		if (!$str) {
			return false;
		}
		return sha1(md5($str));
	}
	public function getInfo($par1, $par2 = null, $name = null)
	{
		$w = array();
		if (!$par1) {
			return false;
		}
		if (is_array($par1)) {
			$w = $par1;
			$info = $this->where($w)->find();
			if (!$info) {
				return false;
			}
			if ($name && isset($info[$name])) {
				return $info[$name];
			}
			if ($par2 && !is_array($par2) && isset($info[$par2])) {
				return $info[$par2];
			}
			return $info;
		}
		if (!$par2) {
			return false;
		}
		$w = array($par1 => $par2);
		$info = $this->where($w)->find();
		if (!$info) {
			return false;
		}
		if ($name && isset($info[$name])) {
			return $info[$name];
		}
		return $info;
	}
	public function addInfo($tel, $pass)
	{
		return $this->add(array('telnum' => $tel, 'password' => $pass, 'status' => 1, 'reg_time' => time(), 'reg_city' =>  'δ֪', 'reg_ip' => get_client_ip()));
	}
	public function updateInfo($id = 0, $arr = array())
	{
		if (!$id || !$arr) {
			return false;
		}
		return $this->where(array('id' => $id))->save($arr);
	}
	public function getDoquota($id = 0)
	{
		if (!$id) {
			return false;
		}
		$quota = $this->getInfo('id', $id, 'quota');
		if (!$quota) {
			return 0;
		}


		$loanbillModel = D('Loanbill');
		$has = $loanbillModel->where(array('uid' => $id, 'status' => array('in', '0,1')))->sum('money');

		return !(toMoney($quota - $has) >= 0) ? 0 : toMoney($quota - $has);
	}
		public function getDoquohas($id = 0)
	{
		if (!$id) {
			return false;
		}
		
		$loanbillModel = D('Loanbill');
		$has = $loanbillModel->where(array('uid' => $id, 'status' => array('in', '0,1')))->sum('money');

		return toMoney($has);
	}
		public function getDoquotama($id = 0)
	{
		if (!$id) {
			return false;
		}
		$quota = $this->getInfo('id', $id, 'quota');
		if (!$quota) {
			return 0;
		}
		$has = 0 ;
		return !(toMoney($quota - $has) >= 0) ? 0 : toMoney($quota - $has);
	}
		public function getQbmoney($id = 0)
	{
		if (!$id) {
			return false;
		}
		$qbma = $this->getInfo('id', $id, 'qbmoney');
		if (!$qbma) {
			$qbma = 0;
		}
		return toMoney($qbma);
	}
	
	
		public function updateQbmoney($id, $money , $bz)
	{
		$qbmo = 10;
		if (!$id || !$money) {
			return false;
		}
		if ($bz == '1'){
			//充值
			$qbst = $this->where(array('id' => $id))->setInc('qbmoney',$money); 
			if (!$qbst) {
				$qbmo = 1;
			}
		}elseif ($bz == '2'){
			//取
			$qbst = $this->where(array('id' => $id))->setInc('qbmoney',$money); 
			if (!$qbst) {
				$qbmo = 2;
			}
			
		}else{
			return false;
		}	
		
		return $qbmo;
	}
		public function getqbmark($id = 0)
	{
		if (!$id) {
			return false;
		}
		$qbmak = $this->getInfo('id', $id, 'qbmark');
		if (!$qbmak) {
			$qbmak = '';
		}
		return $qbmak;
	}
	
			public function getpho($telnum)
	{
		if (!$telnum) {
			return false;
		}
		$id = $this->getInfo('telnum', $telnum, 'id');
		if (!$id) {
			return 0;
		}

		return $id;
	}
	
}
?>