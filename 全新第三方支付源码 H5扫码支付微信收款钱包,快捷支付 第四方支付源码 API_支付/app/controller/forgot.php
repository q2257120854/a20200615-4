<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class forgot extends Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->req->session('login_userid')) {
            $this->res->redirect('/user');
        }
    }
    public function index()
    {
        $data = array('title' => '找回密码');
        $this->put('forgot.php', $data);
    }
    public function send()
    {
        $username = $this->req->post('username');
        $email = $this->req->post('email');
        $chkcode = $this->req->post('chkcode');
        if ($username == '' || $email == '' || $chkcode == '') {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整'));
            exit;
        }
        if (strtolower($chkcode) != $this->session->get('chkcode')) {
            echo json_encode(array('status' => 1, 'msg' => '验证码错误'));
            exit;
        }
        $info = array('fields' => 'email=?', 'values' => array($email));
        $where = array('fields' => 'username=?', 'values' => array($username));
        if (!($userinfo = $this->model()->select('userid')->from('userinfo')->where($info)->fetchRow() || !($user = $this->model()->select()->from('users')->where($where)->fetchRow()))) {
            echo json_encode(array('status' => 1, 'msg' => '用户名和邮箱账号不匹配'));
            exit;
        }
        $data = array('token' => sha1($this->res->getRandomString(40)));
        if ($mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '找回密码')))->fetchRow()) {
            $orginData = array('sitename' => $this->config['sitename'], 'username' => $username, 'url' => 'http://' . $this->config['siteurl'] . '/forgot/retpwd/' . $data['token']);
            $newData = $this->res->replaceMailTpl($mailtpl, $orginData);
            $subject = array('email' => $email, 'title' => $newData['title'], 'content' => $newData['content']);
            $this->res->sendMail($subject, $this->config);
            if ($this->model()->from('users')->updateSet($data)->where($where)->update()) {
                echo json_encode(array('status' => 1, 'msg' => '重置确认邮件已发送，请登录邮箱查收', 'url' => '/login'));
                exit;
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '重置失败，用户名和邮箱账号不匹配'));
        exit;
    }
    public function retpwd()
    {
        $token = isset($this->action[2]) ? $this->action[2] : '';
        if ($token == '' || !preg_match('/[0-9a-z]{40}/', $token)) {
            echo $this->put('woodyapp.php', array('msg' => '来源错误'));
            exit;
        }
        if (!($user = $this->model()->select()->from('users')->where(array('fields' => 'token=?', 'values' => array($token)))->fetchRow())) {
            echo $this->put('woodyapp.php', array('msg' => '无此用户记录'));
            exit;
        }
        $this->put('retpwd.php', $data = array('title' => '重置密码', 'token' => $token));
    }
    public function save()
    {
        $token = $this->req->post('token');
        $username = $this->req->post('username');
        $password = $this->req->post('password');
        $cirmpwd = $this->req->post('cirmpwd');
        $chkcode = $this->req->post('chkcode');
        if ($token == '' || $username == '' || $password == '' || $cirmpwd == '' || $chkcode == '') {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整'));
            exit;
        }
        if (strtolower($chkcode) != $this->session->get('chkcode')) {
            echo json_encode(array('status' => 1, 'msg' => '验证错误'));
            exit;
        }
        if (strlen($password) < 6 || strlen($password) > 20) {
            echo json_encode(array('status' => 1, 'msg' => '密码长度在6-20位长度之间'));
            exit;
        }
        if ($password != $cirmpwd) {
            echo json_encode(array('status' => 1, 'msg' => '两次填写的密码不匹配'));
            exit;
        }
        $where = array('fields' => 'username=? and token=?', 'values' => array($username, $token));
        if ($user = $this->model()->select('id')->from('users')->where($where)->fetchRow()) {
            $data = array('token' => sha1($this->res->getRandomString(40)), 'userpass' => sha1($password));
            if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($user['id'])))->update()) {
                echo json_encode(array('status' => 1, 'msg' => '密码重置成功', 'url' => '/login'));
                exit;
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '密码重置失败'));
        exit;
    }
}
?>