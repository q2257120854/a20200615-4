<?php
namespace xh\run\index\controller;
use xh\library\model;
use xh\library\mysql;
use xh\library\view;

class panel{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    
    public function home(){
        
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        
        new view("panel/home",['mysql'=>$this->mysql,'service_order'=>$service_order,'withdrawal'=>$withdrawal]);
    }
    
    public function index(){
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");

        new view("panel/index",['mysql'=>$this->mysql,'service_order'=>$service_order,'withdrawal'=>$withdrawal]);
    }
}
 