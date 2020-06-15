<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class register extends Controller
{
    public function index()
    {
        $data = array('title' => '用户注册', 'superid' => $this->req->get('id'));
        $this->put('register.php', $data);
    }
    public function save()
    {
        $email = $this->req->post('email');
        $chkcode = $this->req->post('chkcode');
        $id = $this->req->post('id');
        if ($email == '' || $chkcode == '') {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整', 'url' => '/register'));
            exit;
        }
        if (strtolower($chkcode) != $this->session->get('chkcode')) {
            echo json_encode(array('status' => 1, 'msg' => '验证码错误', 'url' => '/register'));
            exit;
        }
        if (!$this->res->isMail($email)) {
            echo json_encode(array('status' => 1, 'msg' => '邮箱格式错误', 'url' => '/register'));
            exit;
        }
        $userinfo = $this->model()->select('email')->from('userinfo')->where(array('fields' => 'email=?', 'values' => array($email)))->fetchRow();
        if ($userinfo) {
            echo json_encode(array('status' => 1, 'msg' => '邮箱' . $email . '已被注册', 'url' => '/register'));
            exit;
        }
        $superid = 0;
        if ($id && preg_match('/\\d/', $id)) {
            if ($this->model()->select()->from('users')->where(array('fields' => 'id=? and is_agent=?', 'values' => array($id, 1)))->count()) {
                $superid = $id;
            }
        }
        $data = array('email' => $email, 'token' => sha1($this->res->getRandomString(40)), 'superid' => $superid);
        if ($this->model()->from('register')->insertData($data)->insert()) {
            if ($mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '注册确认')))->fetchRow()) {
                $orginData = array('sitename' => $this->config['sitename'], 'url' => 'http://' . $this->config['siteurl'] . '/register/complete?email=' . $email . '&token=' . $data['token']);
                $newData = $this->res->replaceMailTpl($mailtpl, $orginData);
                $subject = array('title' => $newData['title'], 'email' => $email, 'content' => $newData['content']);
                $this->res->sendMail($subject, $this->config);
                echo json_encode(array('status' => 1, 'msg' => '注册邮件已发送，请登录您的邮箱查看', 'url' => '/login'));
                exit;
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '注册失败', 'url' => '/register'));
        exit;
    }
    public function complete()
    {
        $email = $this->req->get('email');
        $token = $this->req->get('token');
        if ($email == '' || $token == '') {
            $data = array('msg' => '来源错误，请返回重试');
            $this->put('woodyapp.php', $data);
            exit;
        }
        $where = array('fields' => 'email=? and token=?', 'values' => array($email, $token));
        if ($this->model()->select()->from('register')->where($where)->orderby('id desc')->fetchRow()) {
            $userinfo = $this->model()->select('email')->from('userinfo')->where(array('fields' => 'email=?', 'values' => array($email)))->fetchRow();
            if ($userinfo) {
                $data = array('msg' => '邮箱' . $email . '已被注册');
                $this->put('woodyapp.php', $data);
                exit;
            }
            $data = array('email' => $email, 'token' => $token);
            $this->put('regcomplete.php', $data);
            exit;
        }
        $data = array('msg' => '来源错误，请返回重试');
        $this->put('woodyapp.php', $data);
        exit;
    }
    public function savetwo()
    {
        $data = isset($_POST) ? $_POST : false;
        if (!$data) {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整'));
            exit;
        }
        foreach ($data as $key => $val) {
            ${$key} = $val;
        }
        if ($email == '' || $token == '' || $chkcode == '' || $username == '' || $userpass == '' || $cirmpwd == '' || $phone == '' || $qq == '' || $sitename == '' || $siteurl == '') {
            echo json_encode(array('status' => 1, 'msg' => '选项填写不完整'));
            exit;
        }
        if ($chkcode != $this->session->get('chkcode')) {
            echo json_encode(array('status' => 1, 'msg' => '验证码错误'));
            exit;
        }
        if (!preg_match('/[0-9a-z]{5,20}/', $username)) {
            echo json_encode(array('status' => 1, 'msg' => '用户名格式错误，请使用5-20位小写字母或数字组合'));
            exit;
        }
        if ($this->model()->select()->from('users')->where(array('fields' => 'username=?', 'values' => array($username)))->count()) {
            echo json_encode(array('status' => 1, 'msg' => '用户名已存在'));
            exit;
        }
        if ($userpass != $cirmpwd) {
            echo json_encode(array('status' => 1, 'msg' => '两次填写的密码不匹配'));
            exit;
        }
        if (!preg_match('/\\d{11}/', $phone)) {
            echo json_encode(array('status' => 1, 'msg' => '手机号码格式错误'));
            exit;
        }
        if (!preg_match('/\\d{5,12}/', $qq)) {
            echo json_encode(array('status' => 1, 'msg' => 'QQ号码格式错误'));
            exit;
        }
        $where = array('fields' => 'email=? and token=?', 'values' => array($email, $token));
        if (!($regdata = $this->model()->select()->from('register')->where($where)->orderby('id desc')->fetchRow())) {
            echo json_encode(array('status' => 1, 'msg' => '来源错误'));
            exit;
        }
        if ($this->model()->select('email')->from('userinfo')->where(array('fields' => 'email=?', 'values' => array($email)))->fetchRow()) {
            echo json_encode(array('status' => 1, 'msg' => '邮箱已被注册'));
            exit;
        }
        $data = array('username' => $username, 'userpass' => sha1($userpass), 'addtime' => time(), 'token' => sha1($this->res->getRandomString(40)), 'apikey' => sha1($this->res->getRandomString(40)), 'is_verify_email' => 1, 'superid' => $regdata['superid'], 'ship_type' => 1);
        if (!($userid = $this->model()->from('users')->insertData($data)->insert())) {
            echo json_encode(array('status' => 1, 'msg' => '注册失败-err01'));
            exit;
        }
        if (preg_match('/http[s]?:\\/\\/(.*)/', $siteurl, $match)) {
            $siteurl = $match[1];
        }
        $userinfo = array('userid' => $userid, 'sitename' => $sitename, 'siteurl' => $siteurl, 'email' => $email, 'phone' => $phone, 'qq' => $qq, 'addtime' => time(), 'lastime' => time());
        if (!$this->model()->from('userinfo')->insertData($userinfo)->insert()) {
            $this->model()->from('users')->where(array('fields' => 'id=?', 'values' => array($userid)))->delete();
            echo json_encode(array('status' => 1, 'msg' => '注册失败-err02'));
            exit;
        }
        $this->model()->from('register')->where(array('fields' => 'email=?', 'values' => array($email)))->delete();
        echo json_encode(array('status' => 1, 'msg' => '注册成功，请联系客服开通', 'url' => '/login'));
        exit;
    }
}
?>