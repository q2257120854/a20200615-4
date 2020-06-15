<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class main extends CheckUser
{
    public function index()
    {
        $where = array('fields' => 'is_state=? and cid=?', 'values' => array('1', '2'));
        $notice = $this->model()->select()->from('arlist')->limit(10)->where($where)->orderby('id desc')->fetchAll();
        $bill = new Bill();
        $income = $bill->beforeAgentIncome($_SESSION['login_agentid'], 0);
        $unpaid = $income + $this->userData['unpaid'];
        $where = array('fields' => 'agentid=? and is_state<? and addtime>=?', 'values' => array($_SESSION['login_agentid'], 2, strtotime(date('Y-m-d'))));
        $today_orders = $this->model()->select()->from('orders')->where($where)->count();
        $today_income = $bill->todayAgentIncome($_SESSION['login_agentid'], 0);
        $unpaid += $today_income;
        $data = array('title' => '代理首页', 'notice' => $notice, 'today_orders' => $today_orders, 'today_income' => $today_income, 'unpaid' => $unpaid);
        $this->put('index.php', $data);
    }
}