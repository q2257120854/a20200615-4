<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class pay extends Controller
{
    public function index()
    {
		parent::__construct();
        $this->tpl = 'view/mobile/';
		$payid=$_GET['payid'];
		$pay = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($payid)))->fetchRow();
		$pay2 = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($payid)))->fetchRow();
		$data = array('title' => '支付','payzh'=>$pay,'userpay'=>$pay2);
    	$this->put('pay.php', $data);
    }
}
?>