<?php
namespace xh\run\admin\controller;
use xh\library\model;
use xh\library\url;
use xh\library\view;
use xh\library\session;
use xh\library\mysql;
use xh\unity\page;
use xh\library\request;
use xh\library\functions;

//超级管理组，自动验证是否拥有超级管理员权限
class power{
    
    //构造一个mysql请求
    private $mysql;
    
    
    public function __construct(){
        session::check();
        if (!(new model())->load('user', 'authority')->superVerification()){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }

    //用户组管理
    public function group(){
        //管理组
        $group = page::conduct('mgt_group',request::filter('get.page'),15,null,null,'id','asc');
        //模块列表
        $modules = $this->mysql->query('mgt_module');

        new view('group/list',[
            'mysql'=>$this->mysql,
            'group'=>$group,
            'modules'=>$modules
        ]);
    }
    
    //添加用户组-result请求
    public function addGroup(){
        $group_name = request::filter('post.group_name');
        $modules = request::filter('post.modules');
        if (empty($group_name)) functions::json(-1, '权限组名称不能为空');
        if (!is_array($modules)) functions::json(-1, '请至少授权一个权限');
        $addResult = $this->mysql->insert('mgt_group', array(
            'authority'=>json_encode($modules),
            'mgt_name'=>$group_name
        ));
        if ($addResult > 0) {
            functions::json(200, '添加成功');
        }else{
            functions::json(-2, '添加失败,请重试');
        }
    }
    
    //修改用户组-view视图
    public function viewEditGroup(){
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
         //查询当前用户组是否存在
        $result = $this->mysql->query("mgt_group","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/power/group'),'当前用户组不存在',1);
        if ($result['authority'] == -1 || $result['authority'] == -2) url::address(url::s('admin/power/group'),'内置权限组无法修改',1);
        //模块列表
        $modules = $this->mysql->query('mgt_module');
        //加载视图
        new view('group/edit',[
            'mysql'=>$this->mysql,
            'modules'=>$modules,
            'result'=>$result
        ]);
    }
    
    //修改用户组-result请求
    public function editGroup(){
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("mgt_group","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前用户组不存在');
        if ($result['authority'] == -1 || $result['authority'] == -2) functions::json(-2, '内置权限组无法修改');
        $group_name = request::filter('post.group_name');
        $modules = request::filter('post.modules');
        if (empty($group_name)) functions::json(-1, '权限组名称不能为空');
        if (!is_array($modules)) functions::json(-1, '请至少授权一个权限');
        $this->mysql->update('mgt_group', array(
            'authority'=>json_encode($modules),
            'mgt_name'=>$group_name
        ),"id={$id}");
        functions::json(200, '更新成功');
    }
    
    //删除用户组-result请求
    public function delGroup(){
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("mgt_group","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前用户组不存在');
        if ($result['authority'] == -1 || $result['authority'] == -2) functions::json(-2, '内置权限组无法修改');
        //删除该用户组关联的所有用户
        $this->mysql->delete("mgt", "group_id={$id}");
        //删除用户组
        $this->mysql->delete("mgt_group", "id={$id}");
        functions::json(200, '您已经将该用户组移除,并将该用户组下的所有成员全部删除!');
    }

}