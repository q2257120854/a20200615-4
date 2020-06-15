<?php
namespace xh\unity;

//内部通讯数据加密
class in{
    
    
    //获取数据
    static function get($param_name,$token=null){
        if ($token == null) $token = $_SESSION['MEMBER']['token'];
        return str_replace("-", "=", (new encrypt())->Decode($_REQUEST[$param_name], $token));
    }
    
    //设定数据
    static function set($data,$token=null){
        if ($token == null) $token = $_SESSION['MEMBER']['token'];
        return str_replace("=", "-", (new encrypt())->Encode($data, $token));
    }
    
}