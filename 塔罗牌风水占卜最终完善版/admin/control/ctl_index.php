<?php

if (!defined('CORE'))   exit('Request Error!');
class ctl_index {

    /**
     * 主入口
     */
    public function index() {
        $t1 = microtime(true);
        $menu = preg_replace('/,$/', '', mod_admin_menu::parse_menu());
        tpl::assign('menu', $menu); 
        tpl::assign('user', cls_access::$accctl->get_userinfos());
        tpl::display('index.tpl');
        exit();
    }

    /**
     * 用户登录
     */
    public function login() {
        $accctl = cls_access::get_instance();
        $rs = 0;
        $errmsg = '';
        $gourl = req::item('gourl', '');
        if($accctl->fields['uid']){

            $jumpurl = empty($gourl) ? '?ct=index&ac=index' : $gourl;

            //cls_access::show_message('成功登录', '成功登录，正在重定向你访问的页面', $jumpurl);
            //exit();
        }

        if (req::item('username', '') != '' && req::item('password', '') != '') {
            try {
                $rs = $accctl->check_user(req::item('username'), req::item('password'));

                if ($rs == 1) {
                    $jumpurl = empty($gourl) ? '?ct=index&ac=index' : $gourl;
                    cls_access::show_message('成功登录', '成功登录，正在重定向你访问的页面', $jumpurl);
                    exit();
                }
            } catch (Exception $e) {
                $errmsg = 'Error：' . $e->getMessage();
            } 
        }
        tpl::assign('gourl', $gourl);
        tpl::assign('errmsg', $errmsg);
        tpl::display('login.tpl');
        exit();
    }

    

    /**
     * 系统消息
     */
    public function adminmsg() {
        $addjob = req::item('addjob', '');
        if ($addjob == 'del') {
            db::query("Update `users_admin_log` set `isread`=1  where `isalert`=1 ");
            exit('ok');
        } else {
            $row = db::get_one("Select count(*) as dd From `users_admin_log` where `isalert`=1 And `isread`=0 ");
            if (is_array($row) && $row['dd'] > 0) {
                exit($row['dd']);
            } else {
                exit('false');
            }
        }
    }

    /**
     * 退出
     */
    public function loginout() {
        $accctl = cls_access::get_instance();
        $accctl->loginout();
        cls_access::show_message('注销登录', '成功退出登录！', '/');
        exit();
    }

}
