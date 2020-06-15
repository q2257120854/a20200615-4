<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class pay extends CheckUser
{
    public function index()
    {
		$payid=$_GET['payid'];
		$pay = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($payid)))->fetchRow();
		$data = array('title' => '支付','payzh'=>$pay);
    	$this->put('pay.php', $data);
    }
}
?>