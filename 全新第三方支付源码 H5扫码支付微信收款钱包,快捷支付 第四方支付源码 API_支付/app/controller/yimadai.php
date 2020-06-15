<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
use WY\app\model\Paybank;
if (!defined('WY_ROOT')) {
    exit;
}
class yimadai extends Controller
{
    private $key = 'OGdkk9F9adfl72kDk3';
    public function index()
    {
        $data = isset($_POST) ? $_POST : false;
        if (!$data) {
            return;
        }
        extract($data);
        $sign = md5('MerNo=' . $MerNo . '&MerBillNo=' . $MerBillNo . '&CardNo=' . $CardNo . '&Amount=' . $Amount . '&Succeed=' . $Succeed . '&BillNo=' . $BillNo . '&' . $this->key);
        if ($sign == $SignInfo) {
            $paybank = new Paybank();
            $retmsg = json_encode(array('resCode' => $Succeed, 'resContent' => $paybank->getRet($Succeed)));
            $data = array('retmsg' => $retmsg, 'is_state' => $Succeed == '0000' ? '1' : 0);
            $this->model()->from('payments')->updateSet($data)->where(array('fields' => 'sn=?', 'values' => array($MerBillNo)))->update();
        }
    }
}
?>