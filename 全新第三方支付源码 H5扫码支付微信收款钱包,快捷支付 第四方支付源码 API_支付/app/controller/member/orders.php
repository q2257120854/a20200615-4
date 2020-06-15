<?php
namespace WY\app\controller\member;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
error_reporting(0);
class orders extends CheckUser
{
    public function index()
    {
        $cons = 'userid=? and is_state<>?';
        $consArr = array($_SESSION['login_userid'], 2);
        $is_state = $this->req->get('is_state');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $sdpayno = $this->req->get('sdpayno');
        $sdorderno = $this->req->get('sdorderno');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $accid = $this->req->get('accid');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        if ($is_state >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'is_state=?';
            $consArr[] = $is_state;
        }
        if ($sdpayno) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'orderid like ?';
            $consArr[] = '%' . $sdpayno . '%';
        }
        if ($sdorderno) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'sdorderno like ?';
            $consArr[] = '%' . $sdorderno . '%';
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime>=?';
            $consArr[] = strtotime($fdate);
        }
        if ($tdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime<=?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        if ($accid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'channelid=?';
            $consArr[] = $accid;
        }
        $where = $cons ? array('fields' => $cons, 'values' => $consArr) : array();
        $page = $this->req->get('p');
        $page = $page ? intval($page) : 1;
        $pagesize = 20;
        $lists = $count = array();
        if ($totalsize = $this->model()->select()->from('orders')->where($where)->count()) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select()->from('orders')->limit($pagesize)->offset($offset)->orderby('id desc')->where($where)->fetchAll();
            $total_orders = $this->model()->from('orders a')->where(array('fields' => $cons, 'values' => $consArr))->count();
            $total_money = $this->model()->select(array('money' => 'a.total_fee'))->from('orders a')->where(array('fields' => $cons, 'values' => $consArr))->sum();
            $cons2 = $cons . ' and a.is_state=?';
            $consArr2 = array_merge($consArr, array(1));
            $total_success_orders = $this->model()->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->count();
            $total_success_money = $this->model()->select(array('money' => 'a.realmoney'))->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->sum();
            $total_income_user = $this->model()->select(array('money' => 'a.realmoney*a.uprice'))->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->sum();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&accid=' . $accid . '&sdpayno=' . $sdpayno . '&sdorderno=' . $sdorderno . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $acc = $this->model()->select()->from('acc')->fetchAll();
        $data = array('title' => '交易订单', 'lists' => $lists, 'count' => array('total_orders' => $total_orders, 'total_money' => $total_money['money'], 'success_orders' => $total_success_orders, 'success_money' => $total_success_money['money'], 'income_user' => $total_income_user['money']), 'pagelist' => $pagelist, 'search' => array('is_state' => $is_state, 'sdpayno' => $sdpayno, 'sdorderno' => $sdorderno, 'fdate' => $fdate, 'tdate' => $tdate, 'accid' => $accid), 'acc' => $acc);
        $this->put('orders.php', $data);
    }
    public function refresh()
    {
        $orderid = $this->req->post('sdpayno');
        $push = new Pushorder($orderid);
        $push->notify();
        $orders = $this->model()->select('id')->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($orderid)))->fetchRow();
        $ordernotify = $this->model()->select('retmsg')->from('ordernotify')->where(array('fields' => 'orid=?', 'values' => array($orders['id'])))->fetchRow();
        echo $ordernotify['retmsg'];
    }
}