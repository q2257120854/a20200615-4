<?php
namespace xh\run\admin\controller;
use xh\library\view;
use xh\library\request;
use xh\library\mysql;
use xh\library\functions;
use xh\library\url;
use xh\library\ip;
use xh\library\session;
use xh\unity\upload;

class user{
    public function g(){
        session::check();
    }
    
    //登录
    public function login(){
        session::loginCheck();
        new view('user/login');
    }
    
    //result-登录
    public function loginResult(){
        url::check_csrf();
        session::loginCheck('json');
        $username = request::filter('post.username','','htmlspecialchars');
        $pwd = request::filter('post.pwd','','htmlspecialchars');
        $pwd_safe = request::filter('post.pwd_safe','','htmlspecialchars');
        if ($username == '' || $pwd == '' || $pwd_safe == '') functions::json(-1, '登录出错,账号或口令未填写');
        $mysql = new mysql();
        //验证账户是否存在
        $find_user = $mysql->query("mgt","username='{$username}'")[0];
        if (!is_array($find_user)) functions::json(-2, '登录出错,未找到该账号');
        //验证密码是否正确
        if (md5(functions::pwd($pwd, $find_user['token'])) !== md5($find_user['pwd'])) functions::json(-2, '登录出错,密码不正确');
        //验证口令是否正确
        if (md5(functions::pwd($pwd_safe, $find_user['token'])) !== md5($find_user['pwd_safe'])) functions::json(-2, '登录出错,安全令牌错误');
        //获取用户组
        $group = $mysql->query("mgt_group","id={$find_user['group_id']}")[0];
        if (!is_array($group) || intval($group['authority']) == -1) functions::json(403, '您暂时没有权限访问');
        //更改用户登录数据
        $mysql->update('mgt', array('ip'=>ip::get(),'login_time'=>time()), "id={$find_user['id']}");
        //设置会话
        session::set($find_user);
        functions::json(200, '登录成功');
    }
    
    //安全退出
    public function out(){
        unset($_SESSION['USER_MGT']);
        url::address(url::s('admin/user/login'),'安全注销成功',2);
    }
    
    //上传头像
    public function avatarUpload(){
        session::check('json');
        $id = $_SESSION['USER_MGT']['uid'];
        $mysql = new mysql();
        $emp = $mysql->query("mgt","id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '用户索引失败,请重试!');
        //上传文件到自己的空间
        $path = PATH_VIEW . 'upload/avatar/' . $id;
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg','png'),1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是图片!');
        $mysql->update('mgt', array('avatar'=>$upload['new']),"id={$id}");
        functions::json(200, '头像更换成功!',array('img'=>$upload['new']));
    }
    
    
    //修改资料-view视图
    public function editView(){
        session::check();
        $id = $_SESSION['USER_MGT']['uid'];
        $mysql = new mysql();
        $result = $mysql->query("mgt","id={$id}")[0];
        if (!is_array($result)){
            unset($_SESSION['USER_MGT']);
            url::address(url::s("admin/user/login"),'账户异常,请重新登录',2);
        }
        new view('user/edit',[
            'result'=>$result
        ]);
    }
    
    //修改密码-result请求
    public function edit(){
        $id = $_SESSION['USER_MGT']['uid'];
        $pwd = request::filter('post.pwd');
        $pwd_safe = request::filter('post.pwd_safe');
        $phone = request::filter('post.phone');
        $email = request::filter('post.email');
        $mysql = new mysql();
        //检测用户是否存在
        $Mgtd = $mysql->query('mgt',"id={$id}")[0];
        if (!is_array($Mgtd)) functions::json(-3, '未找到该用户的索引,请刷新后重试!');
        //判断密码
        if (!empty($pwd)) if (strlen($pwd) < 5) functions::json(-1, '密码不能为空且不能小于5位');
        //安全码
        if (!empty($pwd_safe))  if (strlen($pwd_safe) != 6 || !is_numeric($pwd_safe)) functions::json(-1, '安全口令必须为6位纯数字');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
        //邮箱
        if (!functions::isEmail($email)) functions::json(-1, '邮箱输入有误,请检查邮箱格式是否正确');
        $token = $Mgtd['token'];
        $editEmp = [
            'phone'=>$phone,
            'email'=>$email
        ];
        //检测密码和口令是否同时修改，同时修改重新生成token
        if (!empty($pwd) && !empty($pwd_safe)) {
            $token = substr(md5(mt_rand(10000,mt_rand(100000,9999999))), 0,9);
            $editEmp['token'] = $token;
        }
        if (!empty($pwd)) $editEmp['pwd'] = functions::pwd($pwd, $token); //更新密码
        if (!empty($pwd_safe)) $editEmp['pwd_safe'] = functions::pwd($pwd_safe, $token);//更新口令
        
        $mysql->update("mgt", $editEmp,"id={$id}");
        functions::json(200, '恭喜您的资料更新完毕!');
    }
    
}
