<?php

//decode by http://www.yunlu99.com/
class CommonAction extends Action
{
	protected function _initialize()
	{
		
		
		$action = strtoupper(MODULE_NAME);
		if ($action != 'INDEX' && !$this->isLogin()) {
			$this->redirect('Index/login');
			exit(0);
		}
	}
	protected function isLogin()
	{
		@($info = session('manage'));
		return empty($info) ? false : $info;
	}
	protected function setLogin($info)
	{
		if (empty($info)) {
			session('manage', NULL);
			return true;
		}
		if (!empty($info['password'])) {
			unset($info['password']);
		}
		session('manage', $info);
		return true;
	}
}

?>