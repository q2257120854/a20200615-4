<?php
namespace xh\run\index\controller;
use xh\library\view;
use xh\library\model;
use xh\library\mysql;

class doc{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    
    
    //扫码文档
    public function getQrcode(){
        new view("doc/getQrcode");
    }
    
    //签名算法
    public function sign(){
        new view("doc/sign");
    }
    
    //订单信息
    public function getOrder(){
        new view("doc/getOrder");
    }
    
    //获取订单状态
    public function orderStatus(){
        new view("doc/orderStatus");
    }
    
    //异步通知
    public function callback(){
        new view("doc/callback");
    }
    
    //视频教程
    public function video(){
        new view("doc/video");
    }
}
