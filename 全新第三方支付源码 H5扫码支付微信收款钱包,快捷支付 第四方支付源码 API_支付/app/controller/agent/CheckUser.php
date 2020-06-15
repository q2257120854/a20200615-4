<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class CheckUser extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tpl = 'view/agent/';
        if (!$this->req->session('login_agentid') || !$this->req->session('login_agentname')) {
            $this->res->redirect('/login');
        }
        if (!$this->verifyUser->verify()) {
            $this->res->redirect('/login/logout');
        }
        $this->userData = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($this->req->session('login_agentid'))))->fetchRow();
        if (!$this->userData || $this->userData['is_state'] == '2' || $this->userData['is_agent'] == '0') {
            $this->res->redirect('/login/logout');
        }
    }
}