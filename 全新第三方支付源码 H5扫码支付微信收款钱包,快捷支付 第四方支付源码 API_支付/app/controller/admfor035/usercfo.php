<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class usercfo extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '代收款登记记录');
        $uname = $this->req->get('uname');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $cons = $consOr = '';
        $consArr = array();
        if ($uname) {
            $consOr .= $consOr ? ' or ' : '';
            $consOr .= 'a.userid =?';
            $consArr[] = $uname;
        }
        if ($uname) {
            $user = $this->model()->select('id')->from('users')->where(array('fields' => 'username=?', 'values' => array($uname)))->fetchRow();
            if ($user) {
                $consOr .= $consOr ? ' or ' : '';
                $consOr .= 'a.userid=?';
                $consArr[] = $user['id'];
            }
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
        $pagesize = 15;
        $lists = array();
        $totalsize = $this->model()->from('cfo a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,c.username')->from('cfo a')->limit($pagesize)->left('users c')->on('c.id=a.userid')->join()->offset($offset)->orderby('a.id desc')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?uname=' . $uname . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data += array('lists' => $lists, 'pagelist' => $pagelist, 'search' => array('uname' => $uname, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('usercfo.php', $data);
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('cfo')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        if ($data = $this->model()->select()->from('cfo')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow()) {
            $this->put('usercfoedit.php', $data);
        }
    }
    public function save()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $bankname = $this->req->post('bankname');
        $provice = $this->req->post('provice');
        $city = $this->req->post('city');
        $branchname = $this->req->post('branchname');
        $accountname = $this->req->post('accountname');
        $cardno = $this->req->post('cardno');
		$sfz = $this->req->post('sfz');
		$shouji = $this->req->post('shouji');
        if ($id == '' && $bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '' || $sfz == '' || $shouji == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('bankname' => $bankname, 'sfz' => $sfz, 'shouji' => $shouji, 'provice' => str_replace('省', '', $provice), 'city' => str_replace('市', '', $city), 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno);
        if ($this->model()->from('cfo')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
    }
}