<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class count extends CheckUser
{
    public function index()
    {
        $cons = 'agentid=? and is_state=?';
        $consArr = array($_SESSION['login_agentid'], 1);
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $day = $this->req->get('day');
        if ($day == '1') {
            $fdate = date('Y-m-d');
            $tdate = date('Y-m-d');
        }
        if ($day == '2') {
            $fdate = date('Y-m-d', time() - 60 * 60 * 24);
            $tdate = date('Y-m-d', time() - 60 * 60 * 24);
        }
        if ($day == '7') {
            $fdate = date('Y-m-d', time() - 60 * 60 * 24 * 6);
            $tdate = date('Y-m-d');
        }
        if ($day == '30') {
            $fdate = date('Y-m-d', time() - 60 * 60 * 24 * 29);
            $tdate = date('Y-m-d');
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
        $sumArr = array('total_money' => 'realmoney', 'user_money' => 'realmoney*uprice', 'agent_money' => 'IF(gprice>0,realmoney*(gprice-uprice),0)');
        $count = $this->model()->select($sumArr)->from('orders')->where($where)->sum();
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?day=' . $day . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data = array('title' => '收入统计', 'lists' => $lists, 'pagelist' => $pagelist, 'count' => $count, 'search' => array('fdate' => $fdate, 'tdate' => $tdate, 'day' => $day));
        $this->put('count.php', $data);
    }
}