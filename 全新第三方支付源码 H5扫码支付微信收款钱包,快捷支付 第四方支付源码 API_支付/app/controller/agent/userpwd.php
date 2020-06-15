<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class userpwd extends CheckUser
{
    public function index()
    {
        $data = array('title' => '修改密码');
        $this->put('userpwd.php', $data);
    }
    public function editsave()
    {
        $oldpwd = $this->req->post('oldpwd');
        $newpwd = $this->req->post('newpwd');
        $cirpwd = $this->req->post('cirpwd');
        if ($oldpwd == '' || $newpwd == '' || $cirpwd == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        if (strlen($newpwd) < 6 || strlen($newpwd) > 20) {
            echo json_encode(array('status' => 0, 'msg' => '新密码格式长度在6至20位之间'));
            exit;
        }
        if ($newpwd != $cirpwd) {
            echo json_encode(array('status' => 0, 'msg' => '两次填写的密码不匹配'));
            exit;
        }
        if (sha1($oldpwd) != $this->userData['userpass']) {
            echo json_encode(array('status' => 0, 'msg' => '原密码填写错误'));
            exit;
        }
        $data = array('userpass' => sha1($newpwd));
        if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($_SESSION['login_agentid'])))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '密码修改成功，请重新登录', 'url' => '/login/logout'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '保存失败'));
        exit;
    }
}