<?php
namespace xh\unity;

use xh\library\mysql;

//自动识别数据，并返回分页数据
class cog{
    
    //网站信息自动读取
    //为了防止数据库频繁被刷新，这里采用session缓存机制
    static public function web(){
        //检测缓存中是否有网站配置信息，如果没有自动读取
        if (is_array($_SESSION['webCog'])) return $_SESSION['webCog'];
        //读取数据库
        $mysql = new mysql();
        $webCog = json_decode($mysql->query("variable","name='webCog'")[0]['value'],true);
        if (is_array($webCog)) {
            $_SESSION['webCog'] = $webCog;
            return $webCog;
        }else {
            return false;
        }
    }
    
    //读取配置
    static public function read($name){
        //检测缓存中是否有配置，如果没有自动读取
        if (is_array($_SESSION[$name])) return $_SESSION[$name];
        //读取数据库
        $mysql = new mysql();
        $Cog = json_decode($mysql->query("variable","name='{$name}'")[0]['value'],true);
        if (is_array($Cog)) {
            $_SESSION[$name] = $Cog;
            return $Cog;
        }else {
            return false;
        }
    }
    
}