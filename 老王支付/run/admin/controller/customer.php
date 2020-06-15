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

class customer{
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
    
    //用户组管理
    //权限ID：17
    public function index(){

        $this->powerLogin(17);
        //用户组列表
        $group = page::conduct('client_group',request::filter('get.page'),15,null,null,'id','asc');
        //得到服务列表
        $service = $this->mysql->query("service_account","status=4 and receiving=1");
        //项目列表
        $modules = cog::read('costCog');
        new view('customer/index',[
            'mysql'=>$this->mysql,
            'group'=>$group,
            'modules'=>$modules,
            'service'=>$service
        ]);
    }
    
    //添加用户组
    //权限ID：17
    public function add(){
        //接受数据
        $this->powerLogin(17);
        //项目列表
        $modules = cog::read('costCog');
        $group_array = [];
        foreach ($modules as $key => $value){
            $group_array[$key] = [
                'cost'=> $_POST[$key . '_cost'],
                'open'=> $_POST[$key . '_open'] == 1 ? 1 : 2,
                'quantity' => $_POST[$key . '_quantity']
            ];
            if ($key == 'service_auto'){
                $group_array[$key]['gateway'] = $_POST['service_auto_aisle'];
            }
        }
        $in = $this->mysql->insert("client_group", [
            'name'=>request::filter("post.group_name"),
            'authority'=>json_encode($group_array)
        ]);
        if (!$in > 0) functions::json(-3, '添加用户组失败');
        functions::json(200, '用户组添加成功');
        
    }
    
    //修改用户组-view视图
    //权限ID：17
    public function edit(){
        $this->powerLogin(17);
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_group","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/customer/index'),'当前用户组不存在',1);
        if ($result['authority'] == -1) url::address(url::s('admin/customer/index'),'内置用户组无法修改',1);
        //得到服务列表
        //$service = $this->mysql->query("service_account","status=4 and receiving=1");
        $service = $this->mysql->query("service_account");
        //模块列表

        $modules = cog::read('costCog');
        //加载视图
        new view('customer/edit',[
            'mysql'=>$this->mysql,
            'modules'=>$modules,
            'result'=>$result,
            'service'=>$service
        ]);
    }
    
    //修改用户组-result请求
    //权限ID：17
    public function editResult(){
        $this->powerLogin(17);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_group","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前用户组不存在');
        if ($result['authority'] == -1) functions::json(-2, '内置用户组无法修改');

        //项目列表
        $modules = cog::read('costCog');
        $group_array = [];
        foreach ($modules as $key => $value){
            $group_array[$key] = [
                'cost'=> $_POST[$key . '_cost'],
                'open'=> $_POST[$key . '_open'] == 1 ? 1 : 2,
                'quantity' => $_POST[$key . '_quantity']
            ];
            if ($key == 'service_auto'){
                $group_array[$key]['gateway'] = $_POST['service_auto_aisle'];
            }
        }
        $up = $this->mysql->update("client_group", [
            'name'=>request::filter("post.group_name"),
            'authority'=>json_encode($group_array)
        ],"id={$id}");
        functions::json(200, '用户组修改成功');
    }
    
    //删除用户组-result请求
    //权限ID：17
    public function delete(){
        $this->powerLogin(17);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_group","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前用户组不存在');
        if ($result['authority'] == -1) functions::json(-2, '内置权限组无法修改');
        //删除用户组
        $this->mysql->delete("client_group", "id={$id}");
        functions::json(200, '您已经将该用户组移除!');
    }
    
    
    //注册设置
    //权限ID：19
    public function registerCog(){
        $this->powerLogin(19);
        //用户组
        $group = $this->mysql->query("client_group");
        new view('customer/registerCog',[
            'mysql'=>$this->mysql,
            'group'=>$group
        ]);
    }
    
    //注册设置-result
    //权限ID：19
    public function registerCogResult(){
        $this->powerLogin(19);
        unset($_SESSION['registerCog']);
        //接受数据
        $integral = request::filter('post.integral','','htmlspecialchars');
        $scale = request::filter('post.scale','','htmlspecialchars');
        $scale_open = request::filter('post.scale_open','','htmlspecialchars') == 1 ? 1 : 2;
        $points = request::filter('post.points','','htmlspecialchars');
        $points_open = request::filter('post.points_open','','htmlspecialchars') == 1 ? 1 : 2;
        $group_id = intval(request::filter('post.group_id','','htmlspecialchars'));
        //构造配置信息
        $cog = [
            'integral' => $integral,
            'scale' => $scale,
            'scale_open' => $scale_open,
            'points' => $points,
            'points_open' => $points_open,
            'group_id' => $group_id
        ];
        //自动更新配置
        (new model())->load("system", "variable")->update('registerCog',$cog);
        functions::json(200, '注册配置更新成功');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}