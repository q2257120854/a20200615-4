<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class login extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '管理登录');
        $this->put('login.php', $data);
    }
    public function sigin()
    {
        $username = $this->req->post('username');
        $password = $this->req->post('password');
        $chkcode = $this->req->post('chkcode');
        if ($username == '' || $password == '' || $chkcode == '') {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整'));
            exit;
        }
        if (!$this->session->get('chkcode') || $this->session->get('chkcode') != strtolower($chkcode)) {
            echo json_encode(array('status' => 1, 'msg' => '验证码填写错误'));
            exit;
        }
        if ($user = $this->model()->select()->from('admin')->where(array('fields' => 'adminname=?', 'values' => array($username)))->fetchRow()) {
            $ip = $this->req->server('REMOTE_ADDR');
            if ($user['is_limit_ip'] && strpos($user['limit_ip'], $ip) === false) {
                echo json_encode(array('status' => 1, 'msg' => '登录IP无效'));
                exit;
            }
            if ($user['adminpass'] == sha1($password)) {
                $this->session->set('login_adminname', $username);
                $data = array('adminid' => $user['id'], 'addtime' => time(), 'ip' => $ip);
                $this->model()->from('adminlogs')->insertData($data)->insert();
                echo json_encode(array('status' => 1, 'msg' => "欢迎管理员：[$username]\n您已经登录成功系统!", 'url' => $this->dir));
                exit;
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '账号或密码不正确'));
        exit;
    }
    public function logout()
    {
        if ($this->req->session('login_adminname')) {
            $_SESSION['login_adminname'] = '';
            unset($_SESSION['login_adminname']);
        }
        $this->res->redirect($this->dir);
    }
}