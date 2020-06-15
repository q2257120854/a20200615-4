<?php
namespace xh\run\admin\controller;
use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\unity\page;
use xh\library\view;
use xh\library\request;
use xh\library\functions;

//模块管理，自动验证是否拥有超级管理员权限
class module{
    
    //构造一个mysql请求
    private $mysql;
    
    
    public function __construct(){
        session::check();
        if (!(new model())->load('user', 'authority')->superVerification()){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }
    
    //模块
    public function index(){
        $modules = page::conduct('mgt_module',request::filter('get.page'),15,null,null,'id','asc');
        //菜单查询
        $menus = $this->mysql->query('mgt_menu');
        new view('module/index',[
            'mysql'=>$this->mysql,
            'modules'=>$modules,
            'menus'=>$menus
        ]);
    }
    
    //添加模块-result请求
    public function add(){
        $module_name = request::filter('post.module_name');
        $state = request::filter('post.state') == 1 ? 1 : 2;
        $menuid = intval(request::filter('post.menuid'));
        $route = request::filter('post.route');
        if (empty($module_name)) functions::json(-1, '模块名称不能为空');
        //查询菜单是否存在
        $menuc = $this->mysql->query("mgt_menu","id={$menuid}")[0];
        if (!is_array($menuc)) functions::json(-3, '菜单有误,请刷新页面重新添加!');
        //路径识别
        if (count(explode("/", $route)) != 3) functions::json(-2, '模块路径填写有误!');
        $addModuleResult = $this->mysql->insert('mgt_module', [
            'name'=>$module_name,
            'state'=>$state,
            'menuid'=>$menuid,
            'route'=>$route
        ]);
        if ($addModuleResult > 0) functions::json(200, '模块添加成功!');
        functions::json(-2, '模块添加失败,索引错误!');
    }
    
    //修改模块-view视图
    public function viewEdit(){
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("mgt_module","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/module/index'),'没找到当前模块',1);
        //菜单查询
        $menus = $this->mysql->query('mgt_menu');
        //加载视图
        new view('module/edit',[
            'result'=>$result,
            'menus'=>$menus
        ]);
    }
    
    //修改模块-result请求
    public function edit(){
        $id = intval(request::filter('get.id'));
        $module_name = request::filter('post.module_name');
        $state = request::filter('post.state') == 1 ? 1 : 2;
        $menuid = intval(request::filter('post.menuid'));
        $route = request::filter('post.route');
        if (empty($module_name)) functions::json(-1, '模块名称不能为空');
        $result = $this->mysql->query("mgt_module","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '没找到当前模块');
        //查询菜单是否存在
        $menuc = $this->mysql->query("mgt_menu","id={$menuid}")[0];
        if (!is_array($menuc)) functions::json(-3, '菜单有误,请刷新页面重新添加!');
        //路径识别
        if (count(explode("/", $route)) != 3) functions::json(-2, '模块路径填写有误!');
        $addModuleResult = $this->mysql->update('mgt_module', [
            'name'=>$module_name,
            'state'=>$state,
            'menuid'=>$menuid,
            'route'=>$route
        ],"id={$id}");
        functions::json(200, '模块信息更新成功!');
    }
    
    //删除模块-result请求
    public function delete(){
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("mgt_module","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前模块不存在');
        //删除
        $this->mysql->delete("mgt_module", "id={$id}");
        functions::json(200, '操作完成,您已经将该模块成功移除!');
    }
    
}