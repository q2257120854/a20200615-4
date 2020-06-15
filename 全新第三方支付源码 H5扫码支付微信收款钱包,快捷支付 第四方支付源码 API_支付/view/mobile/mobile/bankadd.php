<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class bankadd extends CheckUser
{
    public function index()
    {
		$data="";
    	$this->put('bankadd.php', $data);
    }
	public function savecfo(){
		$bankname = $this->req->post('bankname');
        $provice = $this->req->post('provice');
        $city = $this->req->post('city');
        $branchname = $this->req->post('branchname');
        $accountname = $this->req->post('accountname');
        $cardno = $this->req->post('cardno');
        if ($bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('userid' => $this->userData['id'], 'bankname' => $bankname, 'provice' => str_replace('省', '', $provice), 'city' => str_replace('市', '', $city), 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno, 'addtime' => time());
        if ($this->model()->from('cfo')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
	}
}
?>