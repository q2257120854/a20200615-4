<?php
namespace WY\app\controller\mobile;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class cu extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tpl = 'view/mobile/';
        $this->userData = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($this->req->session('login_userid'))))->fetchRow();
        $this->userInfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->req->session('login_userid'))))->fetchRow();
    }
}
