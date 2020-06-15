<?php

//decode by http://www.yunlu99.com/
class InfoAction extends CommonAction
{
	public function index()
	{
		$infoModel = D('Info');
		$userModel = D('User');
		$where = array();
		if (I('s-username')) {
			$muid=$userModel->getpho(I('s-username'));
			$where['uid'] = array('EQ', $muid);
			
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
		$status=I("status");
		if($status){
			$where["status"]=array("EQ",$status);
		}
		
		import('ORG.Util.Page');
		$count = $infoModel->where($where)->count();
		$Page = new Page($count, C('PAGE_NUM_ONE'));
		$Page->setConfig('header', '条记录,每页显示' . C('PAGE_NUM_ONE') . '条');
		$Page->setConfig('prev', '<');
		$Page->setConfig('next', '>');
		$Page->setConfig('theme', C('PAGE_STYLE'));
		$show = $Page->show();
		
		$loanorderModel = D('Loanorder');
		$list = $infoModel->where($where)->order('id Desc')->limit($Page->firstRow . ',' . $Page->listRows)->relation(true)->select();
		foreach($list as $n=> $val){
			   $list[$n]['quotama'] = $userModel->getDoquotama($val['uid']);
			   $list[$n]['indu']= json_decode($val['addess'],true);   
			   $list[$n]['ide']= json_decode($val['identity'],true);
			   $LoanNum = $loanorderModel->where(array('uid' => array('eq', $val['uid'])))->count();
		
				if($LoanNum > 0){			
					$list[$n]['qbtx'] = '1';
				}
		}

		$this->assign('list', $list);

		$this->assign('page', $show);
		$this->display();
	}
	public function view()
	{
		$adminInfo = $this->isLogin();
		$uid = I('uid');
		if (!$uid) {
			$this->redirect('Info/index');
		}
		$infoModel = D('Info');
		$info = $infoModel->getAuthInfo($uid);
		if (!$info) {
			$this->redirect('Info/index');
		}
		//var_dump($info);die;
		/*取最新提现密码*/
/* 		$loaModel = D('Loanorder');
		$wh =array();
		$wh['uid'] =  array('eq',$uid);		
		$uo = $loaModel->where($wh)->order('id desc')->limit(1)->select();

		if($uo){
			$info['tpass']=$uo['0']['tpass'];
			$info['qrtx']=$uo['0']['qrtx'];
		} */
		$this->assign('data', $info);

		/* if (!is_array(json_decode($info['mobile'], true))) {
			
			$result = curl('http://www.xauguo.cn/Api/Mobile/getReport/', array('callid' => $info['mobile'], 'appkey' => C('ugappkey')), 1);
			if ($result) {
				$arr = json_decode($result, true);
				if ($arr['code'] == 0) {
					$data = $arr['data'];
					$info['mobile'] = json_encode($data);
					$infoModel->setMobile($uid, $info['mobile']);
				}
			}
		}
		if (!is_array(json_decode($info['taobao'], true))) {
			$result = curl('http://www.xauguo.cn/Api/Taobao/getData/', array('callid' => $info['taobao'], 'appkey' => C('ugappkey')), 1);
			if ($result) {
				$arr = json_decode($result, true);
				if ($arr['code'] == 0) {
					$data = $arr['data'];
					$info['taobao'] = json_encode($data);
					$infoModel->setTaobao($uid, $info['taobao']);
				}
			}
		} */
		$this->display();
	}
	/* 20181029	 */
	public function savemark(){
		$id = I('id', 0, 'intval');
		$strs = I('strs');
		$markmm = I('markmm', 0, 'intval');
		if (!$id) {
			$this->error('参数有误');
		}
		$infoModel = D('Info');
		$result = $infoModel->where(array('uid' => $id))->save(array('mark' => $strs,'markmm' => $markmm));
		if (!$result) {
			$this->error('备注操作失败'.$id.$strs);
		}
		$this->success('操作成功');
	}
	public function smszdy()
	{
		$pphone = I('pphone');
		$pconten = I('pconten');
		$uid = I('uid');
		$name = I('name');
		$pconten = trim($pconten);
		if (!$pphone) {
			$this->error('手机号不能为空!');
		}
		if (!$pconten) {
			$this->error('发送内容不能为空!');
		}
		if (!$uid) {
			$this->error('参数有误');
		}
		$smsModel = D('Sms');
		//取
		$ypass = C("ypass");
		//$pconten = str_replace('@username@', $name, $pconten);
		$pconten = str_replace('@', $ypass ,$pconten);
		$ret= $smsModel->sendSms($pphone,$pconten);

		if($ret['status'] == '1'){
			$this->success('发送成功');		
		}else{
			$this->error('发送成功');
		}
	}
	/* 20181029	 */
	public function adopt()
	{
		$uid = I('uid', 0, 'intval');
		$quota = I('quota', 0, 'floatval');
		if (!$uid) {
			$this->error('参数错误');
		}
		if (!isset($quota)) {
			$this->error('请输入用户审批额度');
		}
		$infoModel = D('Info');
		if (!$infoModel->setStatus($uid, 2)) {
			$this->error('资料状态保存失败');
		}
		$userModel = D('User');
		if (!$userModel->updateInfo($uid, array('quota' => $quota))) {
			$this->error('用户额度操作失败,请进入用户管理为当前用户重新设置额度');
		}
		$smsModel = D('Sms');
		$number = $userModel->getInfo('id', $uid, 'telnum');
		$content = htmlspecialchars_decode(htmlspecialchars_decode(C('info_adopt')));
		$content = str_replace('<@sitename@>', C('siteName'), $content);
		$content = str_replace('《@sitename@》', C('siteName'), $content);
		$content = str_replace('<@quota@>', $quota, $content);
		$content = str_replace('《@quota@》', $quota, $content);
		$content = str_replace('<@tpss@>',  C("ypass"), $content);
		$smsModel->sendSms($number, $content);
		$this->success('操作成功');
	}
	public function refuse()
	{
		$uid = I('uid', 0, 'intval');
		if (!$uid) {
			$this->error('参数错误');
		}
		$infoModel = D('Info');
		if (!$infoModel->setStatus($uid, 0 - 1)) {
			$this->error('资料状态保存失败');
		}
		$userModel = D('User');
		if (!$userModel->updateInfo($uid, array('quota' => 0))) {
			$this->error('用户额度操作失败,请进入用户管理为当前用户重新设置额度');
		}
		$smsModel = D('Sms');
		$number = $userModel->getInfo('id', $uid, 'telnum');
		$content = htmlspecialchars_decode(htmlspecialchars_decode(C('info_refuse')));
		$content = str_replace('<@sitename@>', C('siteName'), $content);
		$content = str_replace('《@sitename@》', C('siteName'), $content);
		$smsModel->sendSms($number, $content);
		$this->success('操作成功');
		return NULL;
	}
	public function resetInfo()
	{
		$id = I('id', 0, 'intval');
		if (!$id) {
			$this->error('参数有误');
		}
		$action = I('action');
		if (!$id) {
			$this->error('请选择重置类型');
		}
		$infoModel = D('Info');
		$info = $infoModel->where(array('id' => $id))->find();
		if (!$info) {
			$this->error('资料索引不存在');
		}
		$uid = $info['uid'];
		unset($info['id']);
		unset($info['uid']);
		unset($info['status']);
		if ($action == 'all') {
			foreach ($info as $key => $val) {
				$info[$key] = '';
			}
		} else {
			if (isset($info[$action])) {
				$info[$action] = '';
			}
		}
		$info['status'] = 0;
		$result = $infoModel->where(array('id' => $id))->save($info);
		if (!$result) {
			$this->error('用户资料重置失败');
		}
		$smsModel = D('Sms');
		$userModel = D('User');
		$number = $userModel->getInfo('id', $uid, 'telnum');
		$content = htmlspecialchars_decode(htmlspecialchars_decode(C('info_reset')));
		$content = str_replace('<@sitename@>', C('siteName'), $content);
		$content = str_replace('《@sitename@》', C('siteName'), $content);
		$smsModel->sendSms($number, $content);
		$this->success('操作成功');
	}
}

?>