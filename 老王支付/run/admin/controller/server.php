<?php
namespace xh\run\admin\controller;
use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;
use xh\unity\page;
use xh\unity\cog;
use xh\unity\userCog;

class server{
    //构造一个mysql请求
    private $mysql;
    
    //权限验证
    protected function powerLogin($Mid){
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }
    
    //权限ID: 22
    public function index(){
        $this->powerLogin(22);//权限验证
        new view('server/index',[
            'mysql'=>$this->mysql
        ]);
    }
    
    //result请求
    //权限ID：22
    public function result(){
        unset($_SESSION['server']);
        unset($_SESSION['serviceConfig']);
        $this->powerLogin(22);//权限验证
        $key = request::filter('post.key','','htmlspecialchars');//网站名称
        $service_phone = request::filter('post.service_phone','','htmlspecialchars');
        $list = [1,2,3];
        $serviceConfig = request::filter('post.serviceConfig','','htmlspecialchars');
        if (!in_array($serviceConfig, $list)) functions::json(-1, '轮训通道检测失败');
        //加入配置
        $server = [
            'key'=>$key,
            'service_phone'=>$service_phone
        ];
        //自动更新配置
        (new model())->load("system", "variable")->update('server',$server);
        userCog::update('serviceConfig', [
            'robin'=>$serviceConfig
        ], 0);
        functions::json(200, '服务端配置更新成功');
    }
}
