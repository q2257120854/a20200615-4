<?php
namespace xh\run\admin\model;
use xh\library\mysql;

class variable{
    /**
     * 更改配置信息
     * @param string $name
     * @param array $Cog
     */
    public function update($name,$Cog){
        $mysql = new mysql();
        //写入数据库
        $Cogc = $mysql->query('variable',"name='{$name}'")[0];
        if (is_array($Cogc)) {
            //更改
            $mysql->update("variable", ['value'=>json_encode($Cog,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)],"id={$Cogc['id']}");
        }else{
            //插入
            $mysql->insert("variable", ['name'=>$name,'value'=>json_encode($Cog,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)]);
        }
    }
}