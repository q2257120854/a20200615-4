<?php
namespace WY\app\controller;

use WY\app\libs\Http;
use WY\app\model\Yimadai;
if (!defined('WY_ROOT')) {
    exit;
}
class testyimadai
{
    function __construct()
    {
        $this->pay = new Yimadai();
    }
    public function index()
    {
        $json = '{"id":"2","userid":"xxx","bankname":"交通银行","provice":"河南","city":"郑州","branchname":"文化路支行","accountname":"fasdf","cardno":"xxxx","addtime":"xxxx","sn":"xxxx","money":"1.00","notifyUrl":"http://www.7foo.com/pay/yimadai.php"}';
        $data = json_decode($json, true);
        $url = 'http://www.7foo.cn/pay/paybank2/send.php';
        $http = new Http($url, $data);
        $http->toUrl();
        $result = json_decode($http->getResContent(), true);
        var_dump($http->getResContent());
    }
    public function getRet($code)
    {
        return $this->pay->getRet($code);
    }
    public function test()
    {
        $url = 'https://gwapi.yemadai.com/transfer/transferapi';
        $data = array('transData' => 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/Pjx5ZW1hZGFpPiA8YWNjb3VudE51bWJlcj4yMjgyMDwvYWNjb3VudE51bWJlcj4gPG5vdGlmeVVSTD5odHRwOi8vd3d3LnpoaWZ1dS5jb20veWltYWRhaTwvbm90aWZ5VVJMPiA8dHQ+MDwvdHQ+IDx0cmFuc2Zlckxpc3Q+ICA8dHJhbnNJZD5iMTQ3NDg3Mzk5OTAwPC90cmFuc0lkPiAgPGJhbmtDb2RlPuS6pOmAmumTtuihjDwvYmFua0NvZGU+ICA8cHJvdmljZT7msrPljZc8L3Byb3ZpY2U+ICA8Y2l0eT7pg5Hlt548L2NpdHk+ICA8YnJhbmNoTmFtZT7mlofljJbot6/mlK/ooYw8L2JyYW5jaE5hbWU+ICA8YWNjb3VudE5hbWU+ZmFzZGY8L2FjY291bnROYW1lPiAgPGNhcmRObz5hc2RmMzIyMzwvY2FyZE5vPiAgPGFtb3VudD45LjAwPC9hbW91bnQ+ICA8cmVtYXJrPnRlc3Q8L3JlbWFyaz4gIDxzZWN1cmVDb2RlPkYzMzA2NDU0RjVGMjQxMTI2RjVBNDk3Mjk0MkQ5NThDPC9zZWN1cmVDb2RlPiA8L3RyYW5zZmVyTGlzdD48L3llbWFkYWk+');
        $http = new Http($url, $data, 1);
        $http->toUrl();
        echo base64_decode($http->getResContent());
    }
    public function notify()
    {
        $url = 'http://www.junpay.cn/pay/yimadai.php';
        $data = array('Amount' => '1.00', 'BillNo' => 'b147487399908', 'MerBillNo' => 'b147487399908', 'CardNo' => '123', 'result' => '1', 'Succeed' => 'ERR1012', 'SignInfo' => strtoupper(md5('MerNo=22820&MerBillNo=b147487399908&CardNo=123&Amount=1.00&Succeed=ERR1012&BillNo=b147487399908&OGdkk9F9adfl72kDk3')));
        $http = new Http($url, $data);
        $http->toUrl();
        echo $http->getResContent();
    }
}