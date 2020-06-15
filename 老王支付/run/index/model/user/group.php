<?php
namespace xh\run\index\model;
use xh\library\functions;
use xh\library\mysql;

class group{
    

    //检查是否支持当前通道
    public function review($check_name){
        $authority = json_decode($_SESSION['MEMBER']['group']['authority'],true)[$check_name];
        if ($authority['open'] != 1) functions::json('-3', '您好,你当前所在的用户组无法使用该通道!');
        $mysql = new mysql();
        //检测通道总开关
        $cog = json_decode($mysql->query("variable","name='costCog'")[0]['value'],true)[$check_name];
        if ($cog['open'] != 1) functions::json('-3', '该通道已经关闭或正在升级,请稍后再试!');
    }
    
    //获取当前通道的信息
    public function check($check_name){
        $authority = json_decode($_SESSION['MEMBER']['group']['authority'],true)[$check_name];
        if ($authority['open'] != 1) return false;
        $mysql = new mysql();
        //检测通道总开关
        $cog = json_decode($mysql->query("variable","name='costCog'")[0]['value'],true)[$check_name];
        if ($cog['open'] != 1) return false;
        return $authority;
    }
    
}