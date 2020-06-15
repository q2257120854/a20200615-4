<?php
namespace xh\run\admin\model;
//权限控制模型
class authority{
    
    /**
     * 注册模块权限控制
     * @param unknown $moduleId
     * @return boolean
     */
    public function moduleValidate($moduleId){
        //最高权限
        if ($_SESSION['USER_MGT']['group']['authority'] == -2) return true;
        //检测模块权限
        $group = json_decode($_SESSION['USER_MGT']['group']['authority'],true);
        if (in_array($moduleId, $group)) return true;
        return false;
    }
    
    /**
     * 验证是否拥有超级管理员的权限
     * @return boolean
     */
    public function superVerification(){
        //最高权限
        if ($_SESSION['USER_MGT']['group']['authority'] == -2) return true;
        return false;
    }
    
}