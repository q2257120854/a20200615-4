<?php
namespace WY\app\controller\mobile;
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
        $income = $bill->beforeUserIncome($_SESSION['login_userid'], 0);
        $unpaid = $income + $this->userData['unpaid'];
        $where = array('fields' => 'userid=? and is_state<? and addtime>=?', 'values' => array($_SESSION['login_userid'], 2, strtotime(date('Y-m-d'))));
        $today_orders = $this->model()->select()->from('orders')->where($where)->count();
        $today_income = $bill->todayUserIncome($_SESSION['login_userid'], 0);
        $unpaid += $today_income;
		$wherepay = array('fields' => 'userid=? and is_agent=?', 'values' => array($_SESSION['login_userid'], 0));
        $payments = $this->model()->select()->from('payments')->where($wherepay)->limit(5)->orderby('id desc')->fetchAll();
$page = $this->req->get('p');
        $page = $page ? intval($page) : 1;
        $pagesize = 5;
        $offset = ($page - 1) * $pagesize;
        $where = array('fields' => 'userid=? and addtime>=?', 'values' => array($_SESSION['login_userid'], time() - 60 * 60 * 24 * 7));
        $lists = array();
        if ($totalsize = $this->model()->from('userlogs')->where($where)->count()) {
            $totalpage = ceil($totalsize / $pagesize);
        
            $lists = $this->model()->select()->from('userlogs')->where($where)->limit($pagesize)->offset($offset)->orderby('id desc')->fetchAll();
        }

		
		        $data = array('title' => '用户中心', 'notice' => $notice, 'today_orders' => $today_orders, 'today_income' => $today_income, 'unpaid' => $unpaid, 'payments' => $payments, 'lists' => $lists);
		
   
    $this->put('index.php', $data);
    }
}