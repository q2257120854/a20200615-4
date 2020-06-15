<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class ordernotify extends CheckAdmin
{
    public function index()
    {
        $uname = $this->req->get('uname');
        $orderid = $this->req->get('orderid');
        $sdorderno = $this->req->get('sdorderno');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $cons = $consOr = '';
        $consArr = array();
        if ($uname) {
            $consOr .= $consOr ? ' or ' : '';
            $users = $this->model()->select('id')->from('users')->where(array('fields' => 'username=?', 'values' => array($uname)))->fetchRow();
            $consOr .= 'b.userid = ?';
            $consArr[] = $users['id'];
        }
        if ($uname) {
            $consOr .= $consOr ? ' or ' : '';
            $consOr .= 'b.userid = ?';
            $consArr[] = $uname;
        }
        $cons .= $cons ? ' and (' . $consOr . ')' : $cons;
        if ($orderid) {
            $cons .= $cons ? ' AND ' : '';
            $cons .= 'b.orderid=?';
            $consArr[] = $orderid;
        }
        if ($sdorderno) {
            $cons .= $cons ? ' AND ' : '';
            $cons .= 'b.sdorderno';
            $consArr[] = $sdorderno;
        }
        if ($fdate) {
            $cons .= $cons ? ' AND ' : '';
            $cons .= 'a.addtime >= ?';
            $consArr[] = strtotime($fdate);
        }
        if ($tdate) {
            $cons .= $cons ? ' AND ' : '';
            $cons .= 'a.addtime <= ?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $lists = array();
        $data = $this->model()->select()->from('ordernotify a')->left('orders b')->on('b.id=a.orid')->join()->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        $totalsize = count($data);
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,b.orderid')->from('ordernotify a')->limit($pagesize)->left('orders b')->on('b.id=a.orid')->join()->offset($offset)->orderby('a.id desc')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?uname=' . $uname . '&orderid=' . $orderid . '&sdorderno=' . $sdorderno . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data = array('title' => '通知记录', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('uname' => $uname, 'orderid' => $orderid, 'sdorderno' => $sdorderno, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('ordernotify.php', $data);
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('ordernotify')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}