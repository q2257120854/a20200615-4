<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class pwd extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '修改管理员密码');
        $this->put('admpwd.php', $data);
    }
    public function save()
    {
        $oldpwd = $this->req->post('oldpwd');
        $newpwd = $this->req->post('newpwd');
        $cirpwd = $this->req->post('cirpwd');
        if ($oldpwd == '' || $newpwd == '' || $cirpwd == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        if (strlen($newpwd) < 6 || strlen($newpwd) > 20) {
            echo json_encode(array('status' => 0, 'msg' => '新密码长度为6-20位之间'));
            exit;
        }
        if ($newpwd !== $cirpwd) {
            echo json_encode(array('status' => 0, 'msg' => '两次输入的新密码不匹配'));
            exit;
        }
        $cons = array('fields' => 'adminname=?', 'values' => array($this->session->get('login_adminname')));
        $data = $this->model()->select('adminpass')->from('admin')->where($cons)->fetchRow();
        if ($data && $data['adminpass'] != sha1($oldpwd)) {
            echo json_encode(array('status' => 0, 'msg' => '原密码错误'));
            exit;
        }
        $data = array('adminpass' => sha1($newpwd));
        if ($this->model()->from('admin')->where($cons)->updateSet($data)->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'pwd'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
}
