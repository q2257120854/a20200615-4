<?php
namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class paytest extends Controller
{
    public function index()
    {
        $apikey =  $this->req->post('apikey') ? $this->req->post('apikey') : 'e9db316877bf8c7bf18c1e96faff815ad9eff685';
        $params['version'] = '1.0';
        $params['customerid'] = $this->req->post('customerid') ? $this->req->post('customerid') : '20080507';
        $params['sdorderno'] = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
        $params['notifyurl'] = 'http://' . $this->req->server('HTTP_HOST') . '/in/notify.php';
        $params['returnurl'] = 'http://' . $this->req->server('HTTP_HOST') . '/in/return.php';
        $params['remark'] = $this->req->post('remark') ? $this->req->post('remark') : '收银台';
        $params['total_fee'] = $this->req->post('total_fee') ? $this->req->post('total_fee') : '0.20';
        $params['total_fee'] = number_format($params['total_fee'], 2, '.', '');
        $params['sign'] = md5('version=' . $params['version'] . '&customerid=' . $params['customerid'] . '&total_fee=' . $params['total_fee'] . '&sdorderno=' . $params['sdorderno'] . '&notifyurl=' . $params['notifyurl'] . '&returnurl=' . $params['returnurl'] . '&' . $apikey);
        $data = array('title' => '正在跳转到收银台', 'data' => $params);
        $this->put('paytest.php', $data);
    }
}