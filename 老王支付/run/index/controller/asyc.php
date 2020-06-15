<?php
namespace xh\run\index\controller;
use xh\library\model;
use xh\library\mysql;
use xh\library\functions;
class asyc{
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    
    //获取订单
    public function getOrder(){
        functions::json(200, '翻滚吧老王宝宝',[]);
        //订单查询
        $Task = $this->mysql->query("client_pay_record","user_id={$_SESSION['MEMBER']['uid']} and notice=0","id,amount,types,version_code,average")[0];
        //分配任务
        $this->mysql->update("client_pay_record", [
            'notice'=>1
        ],"id={$Task['id']}");
        //下发任务
        functions::json(200, 'success',$Task);
    }
}