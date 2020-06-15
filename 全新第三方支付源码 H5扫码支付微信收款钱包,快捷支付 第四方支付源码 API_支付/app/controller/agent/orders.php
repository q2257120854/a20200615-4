<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class orders extends CheckUser
{
    public function index()
    {
        $cons = 'agentid=? and is_state<>?';
        $consArr = array($_SESSION['login_agentid'], 2);
        $is_state = $this->req->get('is_state');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $sdpayno = $this->req->get('sdpayno');
        $sdorderno = $this->req->get('sdorderno');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        if ($is_state >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'is_state=?';
            $consArr[] = $is_state;
        }
        if ($sdpayno) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'orderid=?';
            $consArr[] = $sdpayno;
        }
        if ($sdorderno) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'sdorderno=?';
            $consArr[] = $sdorderno;
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
        $where = $cons ? array('fields' => $cons, 'values' => $consArr) : array();
        $page = $this->req->get('p');
        $page = $page ? intval($page) : 1;
        $pagesize = 20;
        $lists = array();
        if ($totalsize = $this->model()->select()->from('orders')->where($where)->count()) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select()->from('orders')->limit($pagesize)->offset($offset)->orderby('id desc')->where($where)->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&sdpayno=' . $sdpayno . '&sdorderno=' . $sdorderno . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data = array('title' => '交易订单', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('is_state' => $is_state, 'sdpayno' => $sdpayno, 'sdorderno' => $sdorderno, 'fdate' => $fdate, 'tdate' => $tdate));
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