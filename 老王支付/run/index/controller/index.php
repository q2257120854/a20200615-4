<?php

namespace xh\run\index\controller;


use xh\library\functions;
use xh\library\mysql;
use xh\library\redis;
use xh\library\request;
use xh\library\view;
use xh\unity\callbacks;

class index
{


    public function home()
    {

        new view("index/index");
    }

    function checkAlipayHeartbeat()
    {
        $mysql = new mysql();
        $mysql->query('service_account');
    }

    function callback()
    {
        echo 'success';
        exit;
    }


    public function redis()
    {

        error_reporting(E_ALL);

        $redis = redis::getInstance(functions::getRedisConfig());
        var_dump($redis);
        $range = $redis->zRange('alipay_10191', 0, -1, true);
        print_r($range);
        print_r(functions::getRobin('alipay_10191'));

        $redis->zAdd('alipay_1022', 1, 'AAAAA');
        $redis->zAdd('alipay_1022', 2, 'BBBBB');
        $redis->zAdd('alipay_1022', 3, 'CCCCC');
        $redis->zAdd('alipay_1023', 1, 'DDDDD');
        $range = $redis->zRevRange('alipay_1022', 0, 9, true);
        var_dump($range);
        $range = $redis->zRevRange('alipay_1022', 0, 0, true);
        var_dump($range);
        echo PHP_EOL;
        $redis->zIncrBy('alipay_1022', 5, 'AAAAA');
        $range = $redis->zRevRange('alipay_1022', 0, 0, true);
        var_dump($range);
        echo PHP_EOL;
        $score = $redis->zScore('alipay_1022', 'CCCCC');
        echo $score . PHP_EOL;
        $redis->zRem('alipay_1022', 'CCCCC');
        $score = $redis->zScore('alipay_1022', 'CCCCC');
        echo $score . PHP_EOL;

        $range = $redis->zRevRange('alipay_1022', 0, 9, true);
        var_dump($range);
    }

    function checkWechatHeartbeat()
    {

        $id = request::filter('get.id');
        $mysql = new mysql();
        $update = [
            'status'           => 1,
            'callback_time'    => 0,
            'callback_status'  => 0,
            'callback_content' => ' ',
            'callback_count'   => 0,
            'requset_data'     => ' ',
            'fees'             => 0
        ];
        echo $mysql->update("client_alipay_automatic_orders", $update, "id={$id}");

        $data = $mysql->query("client_alipay_automatic_orders", "id={$id}")[0];
        print_r($data);

    }

    function checkServiceHeartbeat()
    {

    }

    public function checkHeartbeat()
    {

    }

    public function test()
    {
        echo "-------------------curl_request-------------------" . "<br / >";
        $result = callbacks::curl_request('http://47.75.213.216/Home/user/p2gpayback', [
            'account_name'  => '中文名看看',
            'pay_time'      => time(),
            'status'        => 'success',
            'amount'        => 10.00,
            'out_trade_no'  => 20111111111111,
            'trade_no'      => 20111111111111,
            'fees'          => 1,
            'sign'          => functions::sign(1111, [
                'amount'       => floatval(10.00),
                'out_trade_no' => 20111111111111
            ]),
            'callback_time' => 1111,
            'type'          => 2,
            'account_key'   =>1111
        ]);
        var_dump($result);
        echo "-------------------curl-------------------" . "<br / ><br / ><br / >";
        $result = callbacks::curl('http://47.75.213.216/Home/user/p2gpayback', [
            'account_name'  => '中文名看看',
            'pay_time'      => time(),
            'status'        => 'success',
            'amount'        => 10.00,
            'out_trade_no'  => 20111111111111,
            'trade_no'      => 20111111111111,
            'fees'          => 1,
            'sign'          => functions::sign(1111, [
                'amount'       => floatval(10.00),
                'out_trade_no' => 20111111111111
            ]),
            'callback_time' => 1111,
            'type'          => 2,
            'account_key'   =>1111
        ]);
        var_dump($result);


        echo "-------------------curlPostRequest-------------------" . "<br / ><br / ><br / ><br / >";
        $result = functions::curlPostRequest('http://47.75.213.216/Home/user/p2gpayback', [
            'account_name'  => '中文名看看',
            'pay_time'      => time(),
            'status'        => 'success',
            'amount'        => 10.00,
            'out_trade_no'  => 20111111111111,
            'trade_no'      => 20111111111111,
            'fees'          => 1,
            'sign'          => functions::sign(1111, [
                'amount'       => floatval(10.00),
                'out_trade_no' => 20111111111111
            ]),
            'callback_time' => 1111,
            'type'          => 2,
            'account_key'   =>1111
        ]);
        var_dump($result);
        echo "-------------------curlPostRequest-------------------" . "<br / ><br / ><br / ><br / >";
        
    }
}
