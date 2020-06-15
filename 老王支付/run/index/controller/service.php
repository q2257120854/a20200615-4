<?php
namespace xh\run\index\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\unity\page;
use xh\library\request;
use xh\library\functions;



class service{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        (new model())->load('user', 'group')->review('service_auto');
        $this->mysql = new mysql();
    }
    
    
    
    //订单首页
    public function order(){
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');
        $start_time = request::filter('get.start_time','','htmlspecialchars');
        $end_time = request::filter('get.end_time','','htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        //serviceID
        if ($sorting == 'service'){
            if ($code != '' && $_SESSION['SERVICE']['ORDER']['WHERE'] == ''){
                $code_arr = explode(",", $code);
                if (is_array($code_arr)){
                    $wecaht_where = '';
                    for ($i=0;$i<count($code_arr);$i++){
                        $wecaht_where .= ' or service_id=' . $code_arr[$i];
                    }
                    
                    $_SESSION['SERVICE']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where),'or') . ')';
                }
            }
            
            if ($_GET['code'] == 'closed'){
                unset($_SESSION['SERVICE']['ORDER']['WHERE']);
            }
        }
        
        
        //wechat
        if ($sorting == 'gateway'){
            if ($code == 'alipay'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=2";
          
            }
            
            if ($code == 'wechat'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=1";
                
            }
           if ($code == 'bank'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=3";
                
            }
           if ($code == 'lakala'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=4";
                
            }
           if ($code == 'yunshanfu'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=5";
                
            } if ($code == 'nxyswx'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=6";
                
            } if ($code == 'nxysalipay'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=7";
                
            } if ($code == 'nxysyl'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=8";
                
            }if ($code == 'wechatdy'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=9";
                
            }if ($code == 'wechatsj'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=10";
                
            }if ($code == 'wechatbank'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=11";
                
            }if ($code == 'pddgm'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=12";
                
            }if ($code == 'alipaygm'){
                $_SESSION['SERVICE']['ORDER']['WHERE'] =  "types=13";
                
            }
          
            
            if ($code == 'all'){
                unset($_SESSION['SERVICE']['ORDER']['WHERE']);
            }
        }

        $where = $where . $_SESSION['SERVICE']['ORDER']['WHERE'];
        $where = trim(trim($where),'and');
        
        //排序
        if ($sorting == 'status'){
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        
        //callback
        if ($sorting == 'callback'){
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no'){
            if ($code != '') {
                $code = trim($code);
                $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }

        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN ".$start_time ." AND ". $end_time;
        }

        $result = page::conduct('service_order',request::filter('get.page'),15,$where,null,'id','desc');
        
        new view('service/order',[
            'result'=>$result,
            'mysql'=>$this->mysql,
            'sorting'=>[
                'code'=>$code,
                'name'=>$sorting
            ],
            'where' => $where
        ]);
    }
    
    //轮训通道测试
    public function robinTest(){
        new view('service/robinTest');
    }

    /**
     * @param string $name
     * @param array $expCellName
     * @param array $expTableData
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * 导出
     */
    public function export(){
        $code = request::filter('get.code','','htmlspecialchars');
        $start_time = request::filter('get.start_time','','htmlspecialchars');
        $end_time = request::filter('get.end_time','','htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $where = "";
        if ($code) {
            $where .= " and id = ".$code;
        }
        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
        }
        if ($start_time == 'null' && $end_time = 'null' && !$code) {
            $list = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}");
        }else {
            $list = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}".$where);
        }
        foreach ($list as $key => $value) {
            if ($value['status'] == 1) {
                $list[$key]['status'] = '等待下发支付二维码';
            }else if ($value['status'] == 2) {
                $list[$key]['status'] = '未支付';
            }else if ($value['status'] == 3) {
                $list[$key]['status'] = '订单超时';
            }else {
                $list[$key]['status'] = '已支付';
            }
            if ($value['pay_time']) {
                $list[$key]['pay_time'] = date('Y-m-d H:i:s',$value['pay_time']);
            }else {
                $list[$key]['pay_time'] = '无';
            }
            if ($value['callback_status'] == 1) {
                $list[$key]['callback_status'] = '已回调';
            }else {
                $list[$key]['callback_status'] = '未回调';
            }
            $list[$key]['creation_time'] = date('Y-m-d H:i:s',$value['creation_time']);
            $user_info = $this->mysql->query('client_user','id = '.$value['user_id']);
            $list[$key]['user_name'] = $user_info[0]['username'];
            $list[$key]['phone'] = $user_info[0]['phone'];
            $list[$key]['percentage'] = $value['amount'] - $value['fees'];
            if ($value['types'] == 1) {
                $list[$key]['types'] = '微信';
            }else {
                $list[$key]['types'] = '支付宝';
            }
        }
        $name = '服务订单';
        $data_info = array(
            array('id' , '订单ID'),
            array('user_id' , '商户ID'),
            array('user_name' , '商户名称'),
            array('phone' , '商户手机号'),
            array('trade_no' , '交易订单号'),
            array('service_id' , '服务ID'),
            array('amount' , '金额'),
            array('percentage' , '抽成'),
            array('status' , '交易状态'),
            array('pay_time' , '支付时间'),
            array('fees' , '手续费'),
            array('pay_time' , '异步通知时间'),
            array('callback_status' , '异步通知状态'),
            array('callback_from' , '异步通知'),
            array('callback_content' , '回调信息'),
            array('creation_time' , '订单创建时间'),
            array('types' , '支付类型'),
        );
        functions::commonExport($name,$data_info,$list);
    }
    
}