<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class payments extends CheckUser
{
    public function index()
    {
        $where = array('fields' => 'userid=? and is_agent=?', 'values' => array($_SESSION['login_agentid'], 1));
        $lists = $this->model()->select()->from('payments')->where($where)->orderby('id desc')->fetchAll();
        $data = array('title' => '代理结算记录', 'lists' => $lists);
        $this->put('payments.php', $data);
    }
}