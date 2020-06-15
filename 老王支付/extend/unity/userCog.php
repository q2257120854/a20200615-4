<?php
namespace xh\unity;

use xh\library\mysql;

class userCog {

    //读取配置
    static public function read($name,$userId){
        //检测缓存中是否有配置，如果没有自动读取
        if (is_array($_SESSION[$name])) return $_SESSION[$name];
        //读取数据库
        $mysql = new mysql();
        $Cog = json_decode($mysql->query("client_data","name='{$name}' and userid={$userId}")[0]['value'],true);
        if (is_array($Cog)) {
            $_SESSION[$name] = $Cog;
            return $Cog;
        }else {
            return false;
        }
    }
    
    //更新配置
    static public function update($name,$array,$userId){
        $mysql = new mysql();
        //查询
        $cog = $mysql->query('client_data',"name='{$name}' and userid={$userId}")[0];
        if (is_array($cog)){
            //如果查询到数据就更新
            $mysql->update('client_data', ['value'=>json_encode($array)],"id={$cog['id']}");
        }else {
            //开始建立字段
            $mysql->insert('client_data', [
                'name' => $name,
                'value' => json_encode($array),
                'userid' => $userId
            ]);
        }
        return true;
    }
    
}