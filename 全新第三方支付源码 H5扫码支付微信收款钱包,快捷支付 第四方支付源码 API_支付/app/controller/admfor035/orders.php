<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class orders extends CheckAdmin
{
    public function index()
    {
        $is_state = $this->req->get('is_state');
        $is_ship = $this->req->get('is_ship');
        $kw = $this->req->get('kw');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $agentid = $this->req->get('agentid');
        $is_ship_agent = $this->req->get('is_ship_agent');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $is_ship = isset($_GET['is_ship']) ? $is_ship : -1;
        $is_ship_agent = isset($_GET['is_ship_agent']) ? $is_ship_agent : -1;
        $orderid = $this->req->get('orderid');
        $sdorderno = $this->req->get('sdorderno');
        $accid = $this->req->get('accid');
        $is_checkout = $this->req->get('is_checkout');
        $is_checkout = isset($_GET['is_checkout']) ? $is_checkout : -1;
        $is_notify = $this->req->get('is_notify');
        $is_notify = isset($_GET['is_notify']) ? $is_notify : -1;
        $cons = '';
        $consOR = '';
        $consArr = array();
        if ($agentid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.agentid=? and a.gprice>?';
            $consArr[] = $agentid;
            $consArr[] = 0;
        }
        if ($is_ship_agent >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_ship_agent=?';
            $consArr[] = $is_ship_agent;
        }
        if ($is_state >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_state=?';
            $consArr[] = $is_state;
        }
        if ($is_ship >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_ship=?';
            $consArr[] = $is_ship;
        }
        if ($is_checkout >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_paytype=?';
            $consArr[] = $is_checkout;
        }
        if ($kw) {
            $user = $this->model()->select('id')->from('users')->where(array('fields' => 'username like ?', 'values' => array($kw)))->fetchRow();
            if ($user) {
                $consOR .= $consOR ? ' or ' : '';
                $consOR .= 'a.userid = ?';
                $consArr[] = $user['id'];
            }
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'a.userid = ?';
            $consArr[] = $kw;
        }
        if ($consOR) {
            $cons .= $cons ? ' and ' : '';
            $cons .= '(' . $consOR . ')';
        }
        if ($is_notify >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_notify = ?';
            $consArr[] = $is_notify;
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.addtime>=?';
            $consArr[] = strtotime($fdate);
        }
        if ($tdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.addtime<=?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        if ($orderid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.orderid like ?';
            $consArr[] = '%' . $orderid . '%';
        }
        if ($sdorderno) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.sdorderno like ?';
            $consArr[] = '%' . $sdorderno . '%';
        }
        if ($accid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.channelid=?';
            $consArr[] = $accid;
        }
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->select()->from('orders a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = $total_count = array();
        $total_orders = $total_money = $total_success_orders = $total_success_money = $total_income_user = $total_income_dl = $total_income_pt = 0;
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,b.remark')->from('orders a')->left('orderinfo b')->on('b.id=a.orderinfoid')->join()->offset($offset)->limit($pagesize)->where(array('fields' => $cons, 'values' => $consArr))->orderby('a.id desc')->fetchAll();
            $total_orders = $this->model()->from('orders a')->where(array('fields' => $cons, 'values' => $consArr))->count();
            $total_money = $this->model()->select(array('money' => 'a.total_fee'))->from('orders a')->where(array('fields' => $cons, 'values' => $consArr))->sum();
            $cons2 = $cons . ' and a.is_state=?';
            $consArr2 = array_merge($consArr, array(1));
            $total_success_orders = $this->model()->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->count();
            $total_success_money = $this->model()->select(array('money' => 'a.realmoney'))->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->sum();
            $total_income_user = $this->model()->select(array('money' => 'a.realmoney*a.uprice'))->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->sum();
            $total_income_pt = $this->model()->select(array('money' => '(a.wprice-IF(a.gprice>0,a.gprice,a.uprice))*realmoney'))->from('orders a')->where(array('fields' => $cons2, 'values' => $consArr2))->sum();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&is_checkout=' . $is_checkout . '&is_notify=' . $is_notify . '&kw=' . $kw . '&orderid=' . $orderid . '&sdorderno=' . $sdorderno . '&accid=' . $accid . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $acc = $this->model()->select()->from('acc')->fetchAll();
        $data = array('title' => '订单列表', 'lists' => $lists, 'count' => array('total_orders' => $total_orders, 'total_money' => $total_money['money'], 'success_orders' => $total_success_orders, 'success_money' => $total_success_money['money'], 'income_user' => $total_income_user['money'], 'income_pt' => $total_income_pt['money']), 'pagelist' => $pagelist, 'search' => array('is_state' => $is_state, 'kw' => $kw, 'fdate' => $fdate, 'tdate' => $tdate, 'orderid' => $orderid, 'sdorderno' => $sdorderno, 'accid' => $accid, 'is_checkout' => $is_checkout, 'is_notify' => $is_notify), 'acc' => $acc);
        $this->put('orders.php', $data);
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            $orders = $this->model()->select('orderinfoid')->from('orders')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
            if ($this->model()->from('orders')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                $this->model()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->delete();
                $this->model()->from('ordernotify')->where(array('fields' => 'orid=?', 'values' => array($id)))->delete();
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
    public function getorderinfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $orderinfo = $this->model()->select()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->fetchRow();
        $ordernotify = $this->model()->select()->from('ordernotify')->where(array('fields' => 'orid=?', 'values' => array($id)))->orderby('id desc')->fetchRow();
        $data = array('orders' => $orders, 'orderinfo' => $orderinfo, 'ordernotify' => $ordernotify);
        $this->put('getorderinfo.php', $data);
    }
    public function notify()
    {
        $orderid = $this->req->post('orderid');
        $push = new Pushorder($orderid);
        $push->notify();
        $orders = $this->model()->select('id')->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($orderid)))->fetchRow();
        $orderinfo = $this->model()->select('retmsg')->from('ordernotify')->where(array('fields' => 'orid=?', 'values' => array($orders['id'])))->fetchRow();
        echo $orderinfo['retmsg'];
    }
    public function getnotify()
    {
        $str = '';
        $data = $this->model()->select('a.*,b.orderid')->from('ordernotify a')->left('orders b')->on('b.id=a.orid')->join()->orderby('a.id desc')->limit(10)->fetchAll();
        if ($data) {
            foreach ($data as $key => $val) {
                $retmsg = json_decode($val['retmsg'], true);
                $str .= '<tr><td>' . date('Y-m-d H:i:s', $val['addtime']) . '</td><td><a href="' . $this->dir . 'orders?orderid=' . $val['orderid'] . '" target="_blank">' . $val['orderid'] . '</a></td><td>' . $retmsg['code'] . '</td><td>' . $retmsg['content'] . '</td><td>' . $val['times'] . '</td><td><a href="javascript:;" onclick="pushOrder(\'' . $val['orderid'] . '\')"  data-toggle="tooltip" title="通知"><span class="glyphicon glyphicon-refresh"></span></a></td></tr>';
            }
        } else {
            $str = '<tr><td colspan="5">no data.</td></tr>';
        }
        echo $str;
    }
    public function getnotifyinfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $orderinfo = $this->model()->select()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->fetchRow();
        $ordernotify = $this->model()->select()->from('ordernotify')->where(array('fields' => 'orid=?', 'values' => array($id)))->fetchRow();
        $push = new Pushorder($orders['orderid']);
        $params = $push->getParams($orderinfo);
        $params = $push->saltData($params);
        $str = '';
        foreach ($params as $key => $val) {
            $str .= $str ? '&' : '';
            $str .= $key . '=' . $val;
        }
        $this->put('getnotifyinfo.php', array('orders' => $orders, 'orderinfo' => $orderinfo, 'ordernotify' => $ordernotify, 'params' => $str));
    }
    public function freeze()
    {
        $id = $this->req->get('id');
        $where = array('fields' => 'id=? and is_state>? and is_ship=?', 'values' => array($id, 0, 0));
        if ($orders = $this->model()->select('freeze')->from('orders')->where($where)->fetchRow()) {
            $freeze = $orders['freeze'] ? 0 : 1;
            if ($freeze) {
                $title = '还原订单';
                $msg = '还';
                $stateName = '冻结';
                $removeClass = 'label-success';
                $addClass = 'label-danger';
            } else {
                $title = '扣除订单';
                $msg = '扣';
                $stateName = '已付';
                $removeClass = 'label-danger';
                $addClass = 'label-success';
            }
            $data = array('freeze' => $freeze, 'is_state' => $freeze ? 2 : 1);
            if ($this->model()->from('orders')->updateSet($data)->where($where)->update()) {
                echo json_encode(array('status' => 1, 'title' => $title, 'msg' => $msg, 'stateName' => $stateName, 'removeClass' => $removeClass, 'addClass' => $addClass));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '操作失败'));
    }
}