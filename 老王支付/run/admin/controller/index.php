<?php
namespace xh\run\admin\controller;
use xh\library\session;
use xh\library\view;
use xh\library\mysql;

//管理员控制器，全程session会话验证，该方法下进行开发必须登录才可访问
class index{
    
    public function __construct(){
        session::check();
    }
    
    
    //控制面板主页
    public function home(){
         new view('index/main');
    }

}
