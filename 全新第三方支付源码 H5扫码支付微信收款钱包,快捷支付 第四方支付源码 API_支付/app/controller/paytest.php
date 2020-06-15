<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class paytest extends Controller
{
    public function index()
    {
        $apikey = '5ead7cac31c5010b3749636e508c3a47987bcbfc';
        $params['version'] = '1.0';
        $params['customerid'] = '10870';
        $params['sdorderno'] = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
        $params['notifyurl'] = 'http://' . $this->req->server('HTTP_HOST') . '/test/notify.php';
        $params['returnurl'] = 'http://' . $this->req->server('HTTP_HOST') . '/test/return.php';
        $params['remark'] = '测试支付';
        $params['total_fee'] = $this->req->post('total_fee') ? $this->req->post('total_fee') : '1.00';
        $params['total_fee'] = number_format($params['total_fee'], 2, '.', '');
        $params['sign'] = md5('version=' . $params['version'] . '&customerid=' . $params['customerid'] . '&total_fee=' . $params['total_fee'] . '&sdorderno=' . $params['sdorderno'] . '&notifyurl=' . $params['notifyurl'] . '&returnurl=' . $params['returnurl'] . '&' . $apikey);
        $data = array('title' => '正在跳转到收银台', 'data' => $params);
        $this->put('paytest.php', $data);
    }
}