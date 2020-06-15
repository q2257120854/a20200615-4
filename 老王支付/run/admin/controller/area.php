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

class area{
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

    
    //地区列表
    //权限ID：19
    public function list(){
        $this->powerLogin(19);
        //用户组
        $group = $this->mysql->query("city");
        new view('area/list',[
            'mysql'=>$this->mysql,
            'group'=>$group
        ]);
    }
    
   //权限ID：20
    public function add()
    {
        $this->powerLogin(19);
        $cityname = request::filter('post.cityname');
        $type = request::filter('post.type');
      
        //判断地区是否存在
        $city = $this->mysql->query("city", "cityname LIKE '{$cityname}'")[0];
        if (is_array($city)) functions::json(-3, '当前地区已经存在,请更换重试');
      
        $Insert = $this->mysql->insert("city", [
            'cityname'   => $cityname,
            'type'      => $type
           
        ]);

        if ($Insert > 0) functions::json(200, '添加成功!');

        functions::json(-3, '添加失败,请检查是否有误');
    }

    
    //权限ID：20
    public function edit()
    {
        $this->powerLogin(19);
        $id = intval(request::filter("get.id"));
        $result = $this->mysql->query("city", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/area/list'), '识别会员失败', 1);
        //权限查询
        $groups = $this->mysql->query("city");
        //加载视图
        new view('area/edit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    //权限ID：20
    public function editResult()
    {
        $this->powerLogin(19);
        $id = intval(request::filter("get.id"));
        $cityname = request::filter('post.cityname');
        $type = request::filter('post.type');

       
        //判断用户名是否存在
        $city = $this->mysql->query("city", "cityname='{$cityname}'")[0];
        if (is_array($city) && $cityname != $city['cityname']) functions::json(-3, '当前城市已经存在,请更换重试');
      
        $inArray = [
            'cityname' => $cityname,
            'type'    => $type, 
        ];

      

        $Insert = $this->mysql->update("city", $inArray, "id={$id}");

        if ($Insert > 0) functions::json(200, '修改成功!');

        functions::json(-3, '当前没有做任何修改!');
    }

    //删除会员
    //ID：20
    public function delete()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("city", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前地区不存在');
        //删除
        $this->mysql->delete("city", "id={$id}");
        functions::json(200, '删除成功!');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}