<?php

//decode by http://www.yunlu99.com/
class UserAction extends CommonAction
{
	public function index()
	{
		$userModel = D('User');
		$where = array();
		if (I('s-username')) {
			$where['telnum'] = array('LIKE', '%' . I('s-username') . '%');
		}
		if (I('s-timeStart')) {
			$where['reg_time'] = array('EGT', strtotime(I('s-timeStart')));
		}
		if (I('s-timeEnd')) {
			$where['reg_time'] = array('ELT', strtotime(I('s-timeEnd')));
		}
		if (I('s-timeStart') && I('s-timeEnd')) {
			$where['reg_time'] = array(array('EGT', strtotime(I('s-timeStart'))), array('ELT', strtotime(I('s-timeEnd'))));
		}
		import('ORG.Util.Page');
		$count = $userModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		$list = $userModel->where($where)->order('id Desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$loanorderModel = D('Loanorder');
		$infoModel = D('Info');
		$loanbillModel = D('Loanbill');
		$i = 0;
		while ($i < count($list)) {
			$uid = $list[$i]['id'];
			$userInfo = $infoModel->getAuthInfo($uid);
			$use = json_decode($userInfo['identity'], true);
			$list[$i]['name'] =  $use['name'];
			$list[$i]['succLoan'] = $loanorderModel->getUserSuccNum($uid);
			$list[$i]['errLoan'] = $loanorderModel->getUserErrNum($uid);
			$list[$i]['overdueNum'] = $loanbillModel->getUserOverdueNum($uid);
			$list[$i]['repayLoan'] = $loanorderModel->getUserRepayNum($uid);
			$list[$i]['loanMoney'] = $loanorderModel->getUserLoanMoney($uid);
			$list[$i]['overdueMoney'] = $loanbillModel->getUserOverdueMoney($uid);
			$list[$i]['notrepayMoney'] = $loanbillModel->getUserNotRepayMoney($uid);
			$i = $i + 1;
		}
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	public function resetPass()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$userModel = D('User');
		$newPass = rand(0, 99) . rand(0, 99) . rand(0, 99) . rand(0, 99);
		$r = $userModel->where(array('id' => $id))->save(array('password' => $userModel->str2pass($newPass)));
		if (!$r) {
			$this->error('重置失败');
		}
		$this->success($newPass);
	}
	public function resetTel()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$tel = I('tel');
		if (!$tel) {
			$this->error('请输入用户新手机号码');
		}
		if (!isMobile($tel)) {
			$this->error('手机号码不符合规范');
		}
		$userModel = D('User');
		$r = $userModel->where(array('id' => $id))->save(array('telnum' => $tel));
		if (!$r) {
			$this->error('修改失败');
		}
		$this->success('修改成功');
	}
	public function resetQuota()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$quota = I('quota', 0, 'intval');
		if (!isset($quota)) {
			$this->error('请输入用户新额度');
		}
		$userModel = D('User');
		$r = $userModel->where(array('id' => $id))->save(array('quota' => $quota));
		if (!$r) {
			$this->error('修改失败');
		}
		$this->success('修改成功');
	}
	public function resetStatus()
	{
		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$status = I('status', 1, 'intval');
		$userModel = D('User');
		$r = $userModel->where(array('id' => $id))->save(array('status' => $status));
		if (!$r) {
			$this->error('修改失败');
		}
		$this->success('修改成功');
		return NULL;
	}
	public function del()
	{

		$id = I('id');
		if (!$id) {
			$this->error('参数有误');
		}
		$loanbillModel = D('Loanbill');
		$t = $loanbillModel->where(array('uid' => $id, 'status' => array('IN', '0,1')))->count();
		if ($t) {
			$this->error('该用户有未还清账单,无法删除');
		}
		$loanorderModel = D('Loanorder');
		$t = $loanorderModel->where(array('uid' => $id, 'pending' => 0))->count();
		if ($t) {
			$this->error('该用户有未处理借款订单,无法删除');
		}

		$userModel = D('User');
		$info = $userModel->where(array('id' => $id))->find();
		if (!$info) {
			$this->error('该用户不存在');
		}
		$r = $loanbillModel->where(array('uid' => $id))->delete();
		if(!$r && $r != '0') {
			
			$this->error('账单删除失败');
		}

		$r = $loanorderModel->where(array('uid' => $id))->delete();
		if (!$r && $r != '0') {
			$this->error('订单删除失败');
		}
		$qblogModel = D('Qblog');	
		$r = $qblogModel->where(array('uid' => $id))->delete();
		if (!$r && $r != '0') {
			$this->error('钱包记录删除失败');
		}		
		$r = M('Info')->where(array('uid' => $id))->delete();

		if (!$r && $r != '0') {
			$this->error('资料删除失败');
		}
		$r = $userModel->where(array('id' => $id))->delete();
		if (!$r && $r != '0') {
			$this->error('用户删除失败');
		}
		
		
		$this->success('删除成功');
	}
}

?>