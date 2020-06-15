<?php

namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class logs extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '管理员登录日志');
        $uname = $this->req->get('uname');
        $ip = $this->req->get('ip');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $cons = '';
        $consArr = array();
        if ($uname) {
            $cons .= $cons ? ' AND ' : '';
            $admin = $this->model()->select('id')->from('admin')->where(array('fields' => 'adminname=?', 'values' => array($uname)))->fetchRow();
            $cons .= 'a.adminid = ?';
            $consArr[] = $admin['id'];
        }
        if ($ip) {
            $cons .= $cons ? ' AND ' : '';
            $cons .= 'a.ip like ?';
            $consArr[] = '%' . $ip . '%';
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
        $totalsize = $this->model()->from('adminlogs a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,c.adminname')->from('adminlogs a')->limit($pagesize)->left('admin c')->on('c.id=a.adminid')->join()->offset($offset)->orderby('a.id desc')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?uname=' . $uname . '&ip=' . $ip . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data += array('lists' => $lists, 'pagelist' => $pagelist, 'search' => array('uname' => $uname, 'ip' => $ip, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('admlogs.php', $data);
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('adminlogs')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}