<?php
namespace WY\app\controller\mobile;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class CheckUser extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tpl = 'view/mobile/';
        if (!$this->req->session('login_userid') || !$this->req->session('login_username')) {
            $this->res->redirect('/login');
        }
        if (!$this->verifyUser->verify()) {
            $this->res->redirect('/login/logout');
        }
        $this->userData = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($this->req->session('login_userid'))))->fetchRow();
        if (!$this->userData || $this->userData['is_state'] == '2') {
            $this->res->redirect('/login/logout');
        }
        $this->userInfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->req->session('login_userid'))))->fetchRow();
    }
}