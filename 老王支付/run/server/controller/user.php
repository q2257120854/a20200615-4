<?php
namespace xh\run\server\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;

//user客户端接受回调
class user{

    private $mysql;

    public function __construct(){
        $this->mysql = new mysql();
    }

 

    //回调充值给网站用户
    function pay(){
     //   $this->keyVerification();
        //用户id
        $user_id = intval(request::filter('post.out_trade_no','','htmlspecialchars'));
        //充值金额
        $amount = floatval(request::filter('post.amount','','htmlspecialchars'));
        //验证签名
        $sign = request::filter('post.sign','','htmlspecialchars');
      //  if ($sign != functions::sign(cog::read("server")['key'], ['amount'=>$amount,'out_trade_no'=>$user_id])) exit('error!');
        //写入数据库
        $find_user = $this->mysql->query("client_user","id={$user_id}")[0];
        if (is_array($find_user)){
            $update_array = ['balance'=>$find_user['balance']+$amount];
           
            $this->mysql->update("client_user", $update_array,"id={$user_id}");
            echo 'success';
        }else{
            echo 'false';
        }
    }


}