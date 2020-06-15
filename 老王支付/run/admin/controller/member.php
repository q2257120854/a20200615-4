<?php

namespace xh\run\admin\controller;

use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\unity\page;
use xh\library\request;
use xh\library\functions;
use xh\unity\upload;
use xh\unity\sms;


class member
{
    //构造一个mysql请求
    private $mysql;

    //权限验证
    protected function powerLogin($Mid)
    {
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)) {
            url::address(url::s('admin/index/home'), '您没有权限访问', 3);
        }
        $this->mysql = new mysql();
    }


    //用户列表
    //权限ID：20
    public function index()
    {
        $this->powerLogin(20);

        $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";

        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $groups = $this->mysql->query("client_group");
        new view('member/index', [
            'mysql'  => $this->mysql,
            'member' => $member,
            'groups' => $groups
        ]);
    }

    //权限ID：20
    public function add()
    {
        $this->powerLogin(20);
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $group_id = request::filter('post.group_id');
        $phone = request::filter('post.phone');
        $level_id = intval(request::filter('post.level_id'));
        $balance = floatval(request::filter('post.balance'));
        $money = floatval(request::filter('post.money'));
        if (strlen($username) < 5) functions::json(-1, '用户名不能为空或小于5位');
        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user)) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断手机是否存在
        $find_phone = $this->mysql->query("client_user", "phone={$phone}")[0];
        if (is_array($find_phone)) functions::json(-3, '当前手机已经存在,请更换重试');
        //判断密码
        if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
        //权限组
        $group = $this->mysql->query("client_group", "id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
        //生成密码盐值
        $token = substr(md5(mt_rand(10000, mt_rand(100000, 9999999))), 0, 9);
        //判断上级ID是否存在
        if ($level_id > 0) {
            $find_level = $this->mysql->query("client_user", "id={$level_id}")[0];
            if (!is_array($find_level)) functions::json(-3, '上级ID填写有误,没有找到该会员ID');
            //检测是否有上级
            if ($find_level['level_id'] != 0) functions::json(-3, '上级ID填写有误,该上级会员不支持直接在后台添加下级');
        }
        $Insert = $this->mysql->insert("client_user", [
            'username'   => $username,
            'phone'      => $phone,
            'pwd'        => functions::pwd($pwd, $token),
            'balance'    => $balance,
            'money'      => $money,
            'token'      => $token,
            'ip'         => '8.8.8.8',
            'group_id'   => $group_id,
            'level_id'   => $level_id,
            'login_time' => 0,
            'key_id'     => $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14)),
            'avatar'     => 0
        ]);

        if ($Insert > 0) functions::json(200, '添加成功!');

        functions::json(-3, '添加失败,请检查资料是否有误');
    }

    //上传头像
    //头像
    //权限ID：20
    public function avatarUpload()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('get.id'));
        $emp = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '用户索引失败,请重试!');
        //上传文件到自己的空间
        $path = str_replace('admin', 'index', PATH_VIEW) . 'upload/avatar/' . $id;
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg', 'png'), 1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是图片!');
        $this->mysql->update('client_user', array('avatar' => $upload['new']), "id={$id}");
        functions::json(200, '头像更换成功!', array('img' => $upload['new']));
    }

    //权限ID：20
    public function edit()
    {
        $this->powerLogin(20);
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/member/index'), '识别会员失败', 1);
        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('member/edit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    //权限ID：20
    public function editResult()
    {
        $this->powerLogin(20);
        $id = intval(request::filter("get.id"));
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $group_id = request::filter('post.group_id');
        $phone = request::filter('post.phone');
        $level_id = intval(request::filter('post.level_id'));
        $balance = floatval(request::filter('post.balance'));
        $money = floatval(request::filter('post.money'));
        if (strlen($username) < 5) functions::json(-1, '用户名不能为空或小于5位');
        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user) && $username != $user['username']) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断手机是否存在
        $find_phone = $this->mysql->query("client_user", "phone={$phone}")[0];
        if (is_array($find_phone) && $find_phone['phone'] != $phone) functions::json(-3, '当前手机已经存在,请更换重试');
        //权限组
        $group = $this->mysql->query("client_group", "id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');

        //判断上级ID是否存在
        if ($level_id > 0) {
            $find_level = $this->mysql->query("client_user", "id={$level_id}")[0];
            if (!is_array($find_level)) functions::json(-3, '上级ID填写有误,没有找到该会员ID');
        }

        $inArray = [
            'username' => $username,
            'phone'    => $phone,
            'balance'  => $balance,
            'money'    => $money,
            'group_id' => $group_id,
            'level_id' => $level_id,
        ];

        //判断密码
        if (!empty($pwd)) {
            if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
            //生成密码盐值
            $token = substr(md5(mt_rand(10000, mt_rand(100000, 9999999))), 0, 9);
            $inArray['pwd'] = functions::pwd($pwd, $token);
            $inArray['token'] = $token;
        }

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");

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
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前会员不存在');
        //删除
        $this->mysql->delete("client_user", "id={$id}");
        functions::json(200, '操作完成,您已经将该会员成功移除!');
    }

    //提现管理
    //权限ID：28
    public function withdraw()
    {
        $this->powerLogin(28);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where = "flow_no={$code}";
            }
        }

        //未处理
        if ($sorting == 'type') {
            if ($code != '') {
                $code = trim($code);
                $where = "types={$code}";
            }
        }


        $result = page::conduct('client_withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('member/withdraw', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ]
        ]);
    }

    //更新状态
    //权限ID：28
    public function updateWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        $type = request::filter('get.type', '', 'htmlspecialchars');
        $type_arr = [2, 3, 4];
        if (!in_array($type, $type_arr)) functions::json(-1, '当前更新的状态有误!');
        $msg = $type == 2 ? '提现已到账' : request::filter('get.msg', '', 'htmlspecialchars');
        $result = $this->mysql->query("client_withdraw", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前订单不存在');
        $this->mysql->update("client_withdraw", [
            'types'     => $type,
            'is_notice' => 1,
            'content'   => $msg,
            'deal_time' => time()
        ], "id={$id}");
        //钱款驳回
        if ($type == 3) {
            //将钱款退款给用户
            $find_user = $this->mysql->query("client_user", "id={$result['user_id']}")[0];
            if (is_array($find_user)) {
                $this->mysql->update("client_user", [
                    'money'       => $find_user['money'] + ($result['amount'])
                ], "id={$find_user['id']}");
            }
        }
        functions::json(200, '处理成功');
    }

    //删除提现
    public function deleteWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_withdraw", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前记录不存在');
        //删除
        $this->mysql->delete("client_withdraw", "id={$id}");
        functions::json(200, '操作完成,您已经将记录成功移除!');
    }


    //发送平台更新通知给用户
    public function notice()
    {
        $this->powerLogin(30);
        new view('member/notice');
    }

    //发送通知
    public function sendNotice()
    {
        $this->powerLogin(30);
        //检测安全令牌是否正确
        $pwd = request::filter('post.pwd');
        $user = $this->mysql->query('mgt', "id={$_SESSION['USER_MGT']['uid']}")[0];
        if (!is_array($user)) functions::json(-3, '管理员信息校验失败!');
        //验证pwd
        if (functions::pwd($pwd, $user['token']) != $user['pwd_safe']) functions::json(-6, '安全令牌输入错误');
        //$time 
        $time = request::filter('post.time');
        //$name
        $name = request::filter('post.update_name');
        //restore
        $restore = request::filter('post.restore');
        //content
        $content = request::filter('post.content');
        if ($content == '') functions::json(-2, '更新内容不能为空');
        //开始发送通知
        $result = $this->mysql->query("client_user");
        $sms = new sms();
        foreach ($result as $ru) {
            $sms->sendDefend($ru['phone'], $time, $name, $restore, $content);
        }
        functions::json(200, '短信通知发送完毕,共计发送:' . count($result) . '个');
    }


}