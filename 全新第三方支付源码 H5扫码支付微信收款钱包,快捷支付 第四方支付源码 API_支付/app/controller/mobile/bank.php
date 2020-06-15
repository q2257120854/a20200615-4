<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class bank extends CheckUser
{
    public function index()
    {
		$usercfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchAll();
   		$data = array('title' => '管理银行卡', 'usercfo' => $usercfo);
    	$this->put('bank.php', $data);
    }
}
?>