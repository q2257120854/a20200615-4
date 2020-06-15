<?php

namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class payments extends CheckUser
{
    public function index()
    {
        $where = array('fields' => 'userid=? and is_agent=?', 'values' => array($_SESSION['login_userid'], 0));
        $lists = $this->model()->select()->from('payments')->where($where)->orderby('id desc')->fetchAll();

        $data = array('title' => '结算记录', 'lists' => $lists);
        $this->put('payments.php', $data);
    }
}