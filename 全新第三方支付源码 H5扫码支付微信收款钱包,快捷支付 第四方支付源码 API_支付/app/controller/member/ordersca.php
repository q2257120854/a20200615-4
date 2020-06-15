<?php
namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class ordersca extends CheckUser
{
    public function index()
    {
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $sort = $this->req->get('sort');
        $by = $this->req->get('by');
        $orderby = 'channelid desc';
        if ($by) {
            $orderby = $sort ? $by . ' desc' : $by . ' asc';
        }
        $cons = 'channelid<>? and userid = ? and is_state<=?';
        $consOR = '';
        $consArr = array(0, $_SESSION['login_userid'], 1);
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
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $data = $this->model()->select('channelid')->from('orders')->groupby('channelid')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        $totalsize = count($data);
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('channelid,sum(total_fee) as total_fee,count(userid) as total_orders,sum(realmoney*uprice) as total_income')->from('orders')->offset($offset)->limit($pagesize)->groupby('channelid')->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $data = array('title' => '通道分析', 'lists' => $lists, 'search' => array('fdate' => $fdate, 'tdate' => $tdate), 'by' => $by, 'sort' => $sort);
        $this->put('ordersca.php', $data);
    }
}