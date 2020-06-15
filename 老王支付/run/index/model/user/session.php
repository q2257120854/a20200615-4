<?php
namespace xh\run\index\model;

use xh\library\mysql;
use xh\library\ip;
use xh\library\functions;
use xh\library\url;

class session{

    private $mysql;

    //预先加载
    public function __construct(){
        $this->mysql = new mysql();
    }

    //检测当前浏览器session是否正常状态，并自动更新session到最新
    public function check($callType=''){
        $Loca_ip = ip::get();
        //判断数据是否存在
        if (!is_array($_SESSION['MEMBER'])) {
            unset($_SESSION['MEMBER']);
            if ($callType == 'json'){
                functions::json(403, '暂未登录,请登录后再访问',array('url'=>url::s('index/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('index/user/login'),'请登录后再访问!',3);
            }
        }
        //检测数据是否过期 30分钟无操作自动销毁所有数据
        if (($_SESSION['MEMBER']['time'] + 1800) < time()) {
            unset($_SESSION['MEMBER']);
            if ($callType == 'json'){
                functions::json(403, '会话已经过期,请重新登录',array('url'=>url::s('index/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('index/user/login'),'会话已经过期!',3);
            }
        }

        //检测ip是否异地登录（能够百分百防御XSS攻击）
        $find_user = $this->mysql->query('client_user',"id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_user) || md5($Loca_ip) !== md5($_SESSION['MEMBER']['ip']) || md5($Loca_ip) !== md5($find_user['ip'])) {
           // unset($_SESSION['MEMBER']);
            if ($callType == 'json'){
               // functions::json(403, '账户异常,请重新登录',array('url'=>url::s('index/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                //url::address(url::s('index/user/login'),'账户登录异常!',3);
            }
        }

        //检测用户组权限是否被banned
        if (!is_array($_SESSION['MEMBER']['group']) || $_SESSION['MEMBER']['group']['authority'] == -1){
            unset($_SESSION['MEMBER']);
            if ($callType == 'json'){
                functions::json(403, 'BANNED',array('url'=>url::s('index/user/login'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
            }else{
                url::address(url::s('index/user/login'),'BANNED!',3);
            }
        }

        $this->set($find_user);

    }

    //设置session
    public function set($user){
        //查询用户组
        $find_group = $this->mysql->query("client_group","id={$user['group_id']}")[0];
        $_SESSION['MEMBER'] = [
            'time'=>time(),
            'uid' => $user['id'],
            'username' => $user['username'],
            'group_id' => $user['group_id'],
            'avatar' => $user['avatar'],
            'phone' => $user['phone'],
            'ip' => ip::get(),
            'token' => $user['token'],
            'group'=>$find_group,
            'balance'=>$user['balance'],
            'money'=>$user['money'],
            'key_id'=>$user['key_id'],
            'bank'=>json_decode($user['bank'],true)
        ];
        return $_SESSION['MEMBER'];
    }

    //检测当前是否已经登录
    static public function loginCheck($callType=''){
        $Loca_ip = ip::get();
        //判断数据是否存在

        if (is_array($_SESSION['MEMBER'])) {
            //检测数据是否过期 30分钟无操作
            if (($_SESSION['MEMBER']['time'] + 1800) > time()) {
                //检测ip是否异地登录（能够百分百防御XSS攻击）
                $mysql = new mysql();
                $find_user = $mysql->query('client_user',"id={$_SESSION['MEMBER']['uid']}")[0];
                if (is_array($find_user) && md5($Loca_ip) === md5($_SESSION['MEMBER']['ip']) && md5($Loca_ip) === md5($find_user['ip'])) {
                    if ($callType == 'json'){
                        functions::json(200, '您已经登录过了,无需重复登录',array('url'=>url::s('index/panel/home'),'time'=>date('Y/m/d H:i:s',time()),'ip'=>$Loca_ip));
                    }else{
                        url::address(url::s('index/panel/home'),'您已经登录过了!',3);
                    }
                }
            }
        }
    }

}