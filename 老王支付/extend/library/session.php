<?php
namespace xh\library;
use xh\library\functions;
use xh\library\url;
use xh\library\mysql;
use xh\library\ip;
class session{
    //设置登录session
    static public function set($user){
        //查询用户组
        $mysql = new mysql();
        $find_group = $mysql->query("mgt_group","id={$user['group_id']}")[0];
        $_SESSION['USER_MGT'] = array(
            'time'=>time(),
            'uid' => $user['id'],
            'username' => $user['username'],
            'group_id' => $user['group_id'],
            'avatar' => $user['avatar'],
            'phone' => $user['phone'],
            'email' => $user['email'],
            'ip' => ip::get(),
            'view_module' => $user['view_module'],
            'token' => $user['token'],
            'group'=>$find_group
        );
        return $_SESSION['USER_MGT'];
    }
    
    //检测当前浏览器session是否正常状态，并自动更新session到最新
    static public function check($callType=''){
        $Loca_ip = ip::get();
        //判断数据是否存在
        if (!is_array($_SESSION['USER_MGT'])) {
            unset($_SESSION['USER_MGT']);
            if ($callType == 'json'){
                functions::json(403, '暂未登录,请登录后再访问',array('url'=>url::s('admin/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('admin/user/login'),'请登录后再访问!',3);
            }
        }
        //检测数据是否过期 30分钟无操作自动销毁所有数据
//        if (($_SESSION['USER_MGT']['time'] + 1800) < time()) {
//            unset($_SESSION['USER_MGT']);
//            if ($callType == 'json'){
//                functions::json(403, '会话已经过期,请重新登录',array('url'=>url::s('admin/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
//            }else{
//                url::address(url::s('admin/user/login'),'会话已经过期!',3);
//            }
//        }
        //检测ip是否异地登录（能够百分百防御XSS攻击）
        $mysql = new mysql();
        $find_user = $mysql->query('mgt',"id={$_SESSION['USER_MGT']['uid']}")[0];
        if (!is_array($find_user) || md5($Loca_ip) !== md5($_SESSION['USER_MGT']['ip']) || md5($Loca_ip) !== md5($find_user['ip'])) {
            unset($_SESSION['USER_MGT']);
            if ($callType == 'json'){
                functions::json(403, '账户异常,请重新登录',array('url'=>url::s('admin/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('admin/user/login'),'账户登录异常!',3);
            }
        }
        
        //检测用户组权限是否被banned
        if (!is_array($_SESSION['USER_MGT']['group']) || $_SESSION['USER_MGT']['group']['authority'] == -1){
            unset($_SESSION['USER_MGT']);
            if ($callType == 'json'){
                functions::json(403, 'BANNED',array('url'=>url::s('admin/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('admin/user/login'),'BANNED!',3);
            }
        }
        //自动更新会话
        self::set($find_user);
    }
    
    //检测当前是否已经登录
    static public function loginCheck($callType=''){
        $Loca_ip = ip::get();
        //判断数据是否存在
        if (is_array($_SESSION['USER_MGT'])) {
            //检测数据是否过期 30分钟无操作
            if (($_SESSION['USER_MGT']['time'] + 1800) > time()) {
                //检测ip是否异地登录（能够百分百防御XSS攻击）
                $mysql = new mysql();
                $find_user = $mysql->query('mgt',"id={$_SESSION['USER_MGT']['uid']}")[0];
                if (is_array($find_user) && md5($Loca_ip) === md5($_SESSION['USER_MGT']['ip']) && md5($Loca_ip) === md5($find_user['ip'])) {
                    if ($callType == 'json'){
                        functions::json(200, '您已经登录过了,无需重复登录',array('url'=>url::s('admin/index/home'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
                    }else{
                        url::address(url::s('admin/index/home'),'您已经登录过了!',3);
                    }
                }
            }
        }
    }
    
}