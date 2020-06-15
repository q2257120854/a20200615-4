<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class ordersha extends CheckAdmin
{
    public function index()
    {
        $kw = $this->req->get('kw');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $superid = $this->req->get('superid');
        $sort = $this->req->get('sort');
        $by = $this->req->get('by');
        $accid = $this->req->get('accid');
        $orderby = 'agentid desc';
        if ($by) {
            $orderby = $sort ? $by . ' desc' : $by . ' asc';
        }
        $cons = 'agentid<>?';
        $consOR = '';
        $consArr = array(0);
        if ($kw) {
            $user = $this->model()->select('id')->from('users')->where(array('fields' => 'username = ?', 'values' => array($kw)))->fetchRow();
            if ($user) {
                $consOR .= $consOR ? ' or ' : '';
                $consOR .= 'agentid=?';
                $consArr[] = $user['id'];
            }
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'agentid = ?';
            $consArr[] = $kw;
        }
        if ($consOR) {
            $cons .= $cons ? ' and ' : '';
            $cons .= '(' . $consOR . ')';
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
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $data = $this->model()->select('agentid')->from('orders')->groupby('agentid')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        $totalsize = count($data);
        $lists = $total_count = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('agentid,sum(total_fee) as total_fee,count(userid) as total_orders,sum(realmoney*(gprice-uprice)) as total_income,sum((wprice-IF(gprice>0,gprice,uprice))*realmoney) as pt_income')->from('orders')->offset($offset)->limit($pagesize)->groupby('agentid')->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
            $total_count = $this->model()->select('agentid,sum(total_fee) as total_fee,count(userid) as total_orders,sum(realmoney*(gprice-uprice)) as total_income,sum((wprice-IF(gprice>0,gprice,uprice))*realmoney) as pt_income')->from('orders')->groupby('agentid')->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?kw=' . $kw . '&accid=' . $accid . '&sort=' . $sort . '&by=' . $by . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $acc = $this->model()->select()->from('acc')->fetchAll();
        $data = array('title' => '通道分析', 'lists' => $lists, 'total_count' => $total_count, 'pagelist' => $pagelist, 'search' => array('kw' => $kw, 'fdate' => $fdate, 'tdate' => $tdate, 'accid' => $accid), 'by' => $by, 'sort' => $sort, 'acc' => $acc);
        $this->put('ordersha.php', $data);
    }
}