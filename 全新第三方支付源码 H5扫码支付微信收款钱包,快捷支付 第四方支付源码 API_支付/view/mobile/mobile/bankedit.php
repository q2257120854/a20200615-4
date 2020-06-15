<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class bankedit extends CheckUser
{
    public function index()
    {
		$bankno=$_GET['bankno'];
		$bankcfo = $this->model()->select()->from('cfo')->where(array('fields' => 'id=?', 'values' => array($bankno)))->fetchRow();
   		$data = array('title' => '管理银行卡', 'bankcfo' => $bankcfo);
    	$this->put('bankedit.php', $data);
    }
	function editsavecfo(){
		$id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $bankname = $this->req->post('bankname');
        $provice = $this->req->post('provice');
        $city = $this->req->post('city');
        $branchname = $this->req->post('branchname');
        $accountname = $this->req->post('accountname');
        $cardno = $this->req->post('cardno');
        if ($id == '' && $bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('bankname' => $bankname, 'provice' => str_replace('省', '', $provice), 'city' => str_replace('市', '', $city), 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno);
        if ($this->model()->from('cfo')->updateSet($data)->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $id)))->update()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
	}
}
?>