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

//菜单管理，自动验证是否拥有超级管理员权限
class menu{
    
    //构造一个mysql请求
    private $mysql;
    
    
    public function __construct(){
        session::check();
        if (!(new model())->load('user', 'authority')->superVerification()){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }
    
    //菜单
    public function index(){
        $menus = page::conduct('mgt_menu',request::filter('get.page'),15,null,null,'id','asc');
        new view('menu/index',[
            'mysql'=>$this->mysql,
            'menus'=>$menus
        ]);
    }
    
    //添加菜单-result请求
    public function add(){
        $menu_name = request::filter('post.menu_name');
        $opened = request::filter('post.opened') == 1 ? 1 : 2;
        $hide = request::filter('post.hide') == 1 ? 1 : 2;
        if (empty($menu_name)) functions::json(-1, '菜单名称不能为空');
        $addMenuResult = $this->mysql->insert('mgt_menu', [
            'menu_name'=>$menu_name,
            'opened'=>$opened,
            'hide'=>$hide
        ]);
        if ($addMenuResult > 0) functions::json(200, '菜单添加成功!');
        functions::json(-2, '菜单添加失败,索引错误!');
    }
    
    //修改菜单-view视图
    public function viewEdit(){
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("mgt_menu","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/menu/index'),'没找到当前菜单',1);
        //加载视图
        new view('menu/edit',[
            'result'=>$result
        ]);
    }
    
    //修改菜单-result请求
    public function edit(){
        $id = intval(request::filter('get.id'));
        $menu_name = request::filter('post.menu_name');
        $opened = request::filter('post.opened') == 1 ? 1 : 2;
        $hide = request::filter('post.hide') == 1 ? 1 : 2;
        if (empty($menu_name)) functions::json(-1, '菜单名称不能为空');
        $result = $this->mysql->query("mgt_menu","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '没找到当前菜单');
        $this->mysql->update('mgt_menu', [
            'menu_name'=>$menu_name,
            'opened'=>$opened,
            'hide'=>$hide
        ],"id={$id}");
        functions::json(200, '菜单信息更新成功!');
    }
    
    //删除菜单-result请求
    public function delete(){
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("mgt_menu","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前菜单不存在');
        //检测菜单下是否有模块，如果有模块将无法删除菜单
        $module = $this->mysql->query("mgt_module","menuid={$id}")[0];
        if (is_array($module)) functions::json(-3, '当前菜单下有模块,请删除模块后再删除菜单,否则无法删除该菜单!');
        //删除
        $this->mysql->delete("mgt_menu", "id={$id}");
        functions::json(200, '操作完成,您已经将该菜单成功移除!');
    }
}