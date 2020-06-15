<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class agentlogs extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '代理登录日志');
        $uname = $this->req->get('uname');
        $ip = $this->req->get('ip');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $fdate = isset($_GET['fdate']) ? $fdate : date('Y-m-d');
        $tdate = isset($_GET['tdate']) ? $tdate : date('Y-m-d');
        $cons = 'c.is_agent=?';
        $consArr = array(1);
        if ($uname) {
            $cons .= $cons ? ' AND ' : '';
            if (preg_match('/\\d{8}/', $uname)) {
                $user['id'] = $uname;
            } else {
                $user = $this->model()->select('id')->from('users')->where(array('fields' => 'username=?', 'values' => array($uname)))->fetchRow();
            }
            $cons .= 'a.userid = ?';
            $consArr[] = $user['id'];
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
        $logs = $this->model()->select()->from('userlogs a')->left('users c')->on('c.id=a.userid')->join()->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        $totalsize = count($logs);
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,c.username')->from('userlogs a')->limit($pagesize)->left('users c')->on('c.id=a.userid')->join()->offset($offset)->orderby('a.id desc')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?uname=' . $uname . '&ip=' . $ip . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data += array('lists' => $lists, 'pagelist' => $pagelist, 'search' => array('uname' => $uname, 'ip' => $ip, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('userlogs.php', $data);
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('userlogs')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}