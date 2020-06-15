<?php

class SettingAction extends CommonAction
{
	public function index()
	{
		if ($this->isPost()) {
			$arr = I('post.');
			$file = CONF_PATH . 'site.php';
			if ($arr['fileSuffix']) {
				$str = str_replace('，', ',', $arr['fileSuffix']);
				$arr['fileSuffix'] = explode(',', $str);
				$arr['fileSuffix'] = array_values($arr['fileSuffix']);
			}
			if (!save_config($arr, $file, true)) {
				$this->error('配置保存失败');
			}
			$this->success('操作成功');
		}
		$this->display();
	}
	public function api()
	{
		// 创瑞云
		$cymuser =  C("sms_cymuser");
		$cympass =  C("sms_cympass");
		$crurl ="http://api.1cloudsp.com/query/account?accesskey=".$cymuser."&secret=".$cympass;
		$cyres = file_get_contents($crurl);
		$cyres = json_decode($cyres,true);
		$resmsg = $cyres['msg'];
		if($resmsg = 'SUCCESS'){
			$cynums =$cyres['data']['接口短信'];
			$this->assign('cynums', $cynums);
		}
		// 创瑞云end
		$muser =  C("sms_muser");
		$mpass =  md5(C("sms_mpass").$muser);
		$sendurl ="http://api.sms.cn/sms/?ac=number&uid=".$muser."&pwd=".$mpass."";
		$result = file_get_contents($sendurl);
		$result = json_decode($result,true);
		$resc = $result['stat'];
		if(intval($resc)== 100){
			$nums =$result['number'];
			$this->assign('nums', $nums);
		}
	
		if ($this->isPost()) {
			$arr = I('post.');
			$file = CONF_PATH . 'api.php';
			if (!save_config($arr, $file, true)) {
				$this->error('配置保存失败');
			}
			$this->success('操作成功');
		}
		
		$this->display();
	}
	public function loan()
	{
		if ($this->isPost()) {
			$arr = I('post.');
			$file = CONF_PATH . 'loan.php';
			if ($arr['Deadline_D']) {
				$arr['Deadline_D'] = str_replace('，', ',', $arr['Deadline_D']);
				$arr['Deadline_D'] = explode(',', $arr['Deadline_D']);
				$arr['Deadline_D'] = array_values($arr['Deadline_D']);
			}
			if ($arr['Deadline_M']) {
				$arr['Deadline_M'] = str_replace('，', ',', $arr['Deadline_M']);
				$arr['Deadline_M'] = explode(',', $arr['Deadline_M']);
				$arr['Deadline_M'] = array_values($arr['Deadline_M']);
			}
			if (!save_config($arr, $file, true)) {
				$this->error('配置保存失败');
			}
			$this->success('操作成功');
		}
		$this->display();
	}
	public function contract()
	{
		if ($this->isPost()) {
			$arr = I('post.');
			$file = CONF_PATH . 'contract.php';
			if (!save_config($arr, $file, true)) {
				$this->error('配置保存失败');
			}
			$this->success('操作成功');
		}
		$this->display();
	}
	public function other()
	{
	}
	public function uploadImg()
	{
		if ($this->isPost()) {
			$fileName = I('fileName');
			if (!$fileName) {
				$this->error('提交参数有误');
			}
			$fileModel = D('File');
			$File = $fileModel->getFile($fileName);
			if (!$File) {
				$this->error('文件上传出错');
			}
			if (!$File['status']) {
				$this->error($File['error']);
			}
			$this->success($File['url']);
		}
		$this->error('非法操作');
		return NULL;
	}
}
?>