<?php
namespace xh\run\admin\controller;
use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\unity\page;
use xh\library\view;
use xh\library\request;
use xh\library\ip;
use xh\library\functions;
use xh\unity\upload;

//员工管理，自动验证是否拥有超级管理员权限
class employee{
    
    //构造一个mysql请求
    private $mysql;
    
    
    public function __construct(){
        session::check();
        if (!(new model())->load('user', 'authority')->superVerification()){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }
    
    //员工
    public function index(){
        $employee = page::conduct('mgt',request::filter('get.page'),15,null,null,'id','asc');
        //权限查询
        $groups = $this->mysql->query("mgt_group");
        new view('employee/index',[
            'mysql'=>$this->mysql,
            'employee'=>$employee,
            'groups'=>$groups
        ]);
    }
    
    //查询员工IP归属地
    public function ipGet(){
        $ip = request::filter('get.ip');
        $result = ip::locus($ip);
        functions::json(200, 'IP归属地查询完毕!',array('ip'=>$ip,'city'=>$result['data']['country'] . $result['data']['region'] . $result['data']['city'] . $result['data']['isp']));
    }
    
    //上传头像
    //头像
    public function avatarUpload(){
        $id = intval(request::filter('get.id'));
        //检测自己
        if ($_SESSION['USER_MGT']['uid'] == $id) functions::json(-2, '亲爱的超级管理员你好,以免出现不必要的错误,请勿给自己上传头像哦!');
        $emp = $this->mysql->query("mgt","id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '用户索引失败,请重试!');
        //上传文件到自己的空间
        $path = PATH_VIEW . 'upload/avatar/' . $id;
      
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg','png'),1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是图片!');
        
        $this->mysql->update('mgt', array('avatar'=>$upload['new']),"id={$id}");
        
        functions::json(200, '头像更换成功!',array('img'=>$upload['new']));
    }
    
    
    //添加员工-result请求
    public function add(){
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $pwd_safe = request::filter('post.pwd_safe');
        $group_id = request::filter('post.group_id');
        $phone = request::filter('post.phone');
        $email = request::filter('post.email');
        $remarks = request::filter('post.remarks');
        if (strlen($username) < 5) functions::json(-1, '用户名不能为空或小于5位');
        //判断用户名是否存在
        $user = $this->mysql->query("mgt","username='{$username}'")[0];
        if (is_array($user)) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断密码
        if (strlen($pwd) < 5) functions::json(-1, '密码不能为空且不能小于5位');
        //安全码
        if (strlen($pwd_safe) != 6 || !is_numeric($pwd_safe)) functions::json(-1, '安全口令必须为6位纯数字');
        //权限组
        $group = $this->mysql->query("mgt_group","id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
        //邮箱
        if (!functions::isEmail($email)) functions::json(-1, '邮箱输入有误,请检查邮箱格式是否正确');
        //生成密码盐值
        $token = substr(md5(mt_rand(10000,mt_rand(100000,9999999))), 0,9);
        
        $Insert = $this->mysql->insert("mgt", [
            'username'=>$username,
            'pwd'=>functions::pwd($pwd, $token),
            'pwd_safe'=>functions::pwd($pwd_safe, $token),
            'group_id'=>$group_id,
            'phone'=>$phone,
            'email'=>$email,
            'token'=>$token,
            'remarks'=>$remarks,
            'ip'=>'8.8.8.8'
        ]);
        
        if ($Insert > 0) functions::json(200, '新增成功,祝贺您又新增了一位员工!');
        
        functions::json(-3, '新增失败,当前索引未成功');
    }
    
    //修改员工-View视图
    public function viewEdit(){
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("mgt","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/employee/index'),'识别员工失败',1);
        //权限查询
        $groups = $this->mysql->query("mgt_group");
        //加载视图
        new view('employee/edit',[
            'result'=>$result,
            'groups'=>$groups
        ]);
    }
    
    //修改员工-result请求
    public function edit(){
        $id = intval(request::filter('get.id'));
        //检测是否修改自己的信息
        if ($_SESSION['USER_MGT']['uid'] == $id) functions::json(-2, '亲爱的超级管理员你好,以免出现不必要的错误,请勿修改自己的信息哦!');
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $pwd_safe = request::filter('post.pwd_safe');
        $group_id = request::filter('post.group_id');
        $phone = request::filter('post.phone');
        $email = request::filter('post.email');
        $remarks = request::filter('post.remarks');
        if (strlen($username) < 5) functions::json(-1, '用户名不能为空或小于5位');
        //检测用户是否存在
        $Mgtd = $this->mysql->query('mgt',"id={$id}")[0];
        if (!is_array($Mgtd)) functions::json(-3, '未找到该用户的索引,请刷新后重试!');
        //判断用户名是否存在
        $user = $this->mysql->query("mgt","username='{$username}'")[0];
        if (is_array($user) && $user['username'] != $username) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断密码
        if (!empty($pwd)) if (strlen($pwd) < 5) functions::json(-1, '密码不能为空且不能小于5位');
        //安全码
        if (!empty($pwd_safe))  if (strlen($pwd_safe) != 6 || !is_numeric($pwd_safe)) functions::json(-1, '安全口令必须为6位纯数字');
        //权限组
        $group = $this->mysql->query("mgt_group","id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
        //邮箱
        if (!functions::isEmail($email)) functions::json(-1, '邮箱输入有误,请检查邮箱格式是否正确');
        $token = $Mgtd['token'];
        $editEmp = [
            'username'=>$username,
            'group_id'=>$group_id,
            'phone'=>$phone,
            'email'=>$email,
            'remarks'=>$remarks
        ];
        //检测密码和口令是否同时修改，同时修改重新生成token
        if (!empty($pwd) && !empty($pwd_safe)) {
            $token = substr(md5(mt_rand(10000,mt_rand(100000,9999999))), 0,9);
            $editEmp['token'] = $token;
        }
        if (!empty($pwd)) $editEmp['pwd'] = functions::pwd($pwd, $token); //更新密码
        if (!empty($pwd_safe)) $editEmp['pwd_safe'] = functions::pwd($pwd_safe, $token);//更新口令
        
        $this->mysql->update("mgt", $editEmp,"id={$id}");
        functions::json(200, '当前员工资料更新成功!');
    }
    
    //删除员工-result请求
    public function delete(){
        $id = intval(request::filter('get.id'));
        //检测删除自己
        if ($_SESSION['USER_MGT']['uid'] == $id) functions::json(-2, '亲爱的超级管理员你好,以免出现不必要的错误,请勿删除自己哦!');
        //查询当前用户组是否存在
        $result = $this->mysql->query("mgt","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前员工不存在');
        //删除
        $this->mysql->delete("mgt", "id={$id}");
        functions::json(200, '操作完成,您已经将该员工成功移除!');
    }
    
  
}
