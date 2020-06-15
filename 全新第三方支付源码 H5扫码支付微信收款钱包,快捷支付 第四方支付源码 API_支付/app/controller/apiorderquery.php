<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class apiorderquery extends Controller
{
    public function index()
    {
        $customerid = $this->req->request('customerid');
        $sdorderno = $this->req->request('sdorderno');
        $reqtime = $this->req->request('reqtime');
        $sign = $this->req->request('sign');
        if ($customerid == '' || $sdorderno == '' || $reqtime == '' || $sign == '') {
            echo json_encode(array('status' => 0, 'msg' => '参数不完整'));
            exit;
        }
        if (!($users = $this->model()->select('apikey')->from('users')->where(array('fields' => 'id=? and is_state=1', 'values' => array($customerid)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '商户不存在'));
            exit;
        }
        $signstr = 'customerid=' . $customerid . '&sdorderno=' . $sdorderno . '&reqtime=' . $reqtime . '&' . $users['apikey'];
        $mysign = md5($signstr);
        if ($sign != $mysign) {
            echo json_encode(array('status' => 0, 'msg' => '签名验证失败'));
            exit;
        }
        $fdate = time() - 60 * 60 * 24 * 3;
        if (!($orders = $this->model()->select()->from('orders')->where(array('fields' => 'userid=? and sdorderno=? and addtime>=?', 'values' => array($customerid, $sdorderno, $fdate)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '订单不存在'));
            exit;
        }
        if ($orders['is_state'] == '1') {
            echo json_encode(array('status' => 1, 'msg' => '成功订单', 'sdorderno' => $sdorderno, 'total_fee' => $orders['realmoney'], 'sdpayno' => $orders['orderid']));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '失败订单'));
        exit;
    }
}
?>