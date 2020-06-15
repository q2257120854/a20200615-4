<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class login extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if ($url = $this->verifyUser->verify()) {
            $this->res->redirect($url);
        }
        $data = array('title' => '商户登录');
        $this->put('login.php', $data);
    }
    public function sigin()
    {
        $username = $this->req->post('username');
        $password = $this->req->post('password');
        $chkcode = $this->req->post('chkcode');
        $keepLogin = $this->req->post('kl');
        if ($username == '' || $password == '' || $chkcode == '') {
            $this->put('woodyapp.php', array('msg' => '选项填写不完整'));
            exit;
        }
	 if (strtolower($chkcode) != $this->session->get('chkcode')) {
            $this->put('woodyapp.php', array('msg' => '验证码错误'));
            exit;
        }
		
        if (strpos($username, '@')) {
            $where = array('fields' => 'email=?', 'values' => array($username));
            if (!($userinfo = $this->model()->select('userid')->from('userinfo')->where($where)->fetchRow())) {
                $this->put('woodyapp.php', array('msg' => '邮箱账号未注册'));
                exit;
            }
            $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($userinfo['userid'])))->fetchRow();
            if (!$user || $user['userpass'] != sha1($password)) {
                $this->put('woodyapp.php', array('msg' => '邮箱账号或密码错误'));
                exit;
            }
        } else {
            $where = array('fields' => 'username=? and userpass=?', 'values' => array($username, sha1($password)));
            if (!($user = $this->model()->select()->from('users')->where($where)->fetchRow())) {
                $this->put('woodyapp.php', array('msg' => '用户名或密码错误'));
                exit;
            }
        }
        if ($user['is_state'] == '2') {
            $this->put('woodyapp.php', array('msg' => '账号已被停用，请联系客服。'));
            exit;
        }
        if ($user['is_agent']) {
            $this->session->set('login_agentid', $user['id']);
            $this->session->set('login_agentname', $user['username']);
        } else {
            $this->session->set('login_userid', $user['id']);
            $this->session->set('login_username', $user['username']);
        }
        if ($keepLogin == 'yes') {
            $this->verifyUser->setck($user['id'], $username, $user['userpass']);
        }
		$ip = $this->req->server('REMOTE_ADDR');
        $logData = array('userid' => $user['id'], 'addtime' => time(), 'ip' => $ip ,'address' => $this->res->getIPLoc($ip));
        $this->model()->from('userlogs')->insertData($logData)->insert();
        $url = $user['is_agent'] ? '/agent' : '/member';
        $this->res->redirect($url);
    }
    public function logout()
    {
        $this->session->set('login_userid', '');
        $this->session->set('login_username', '');
        $this->session->set('login_agentid', '');
        $this->session->set('login_agentname', '');
        unset($_SESSION['login_userid']);
        unset($_SESSION['login_username']);
        unset($_SESSION['login_agentid']);
        unset($_SESSION['login_agentname']);
        $this->verifyUser->unsetck();
        $this->res->redirect('/login');
    }
}
?>