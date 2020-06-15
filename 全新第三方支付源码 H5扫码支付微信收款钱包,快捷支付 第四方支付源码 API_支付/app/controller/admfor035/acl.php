<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class acl extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '接入网关');
        $acpcode = $this->req->get('acpcode');
        $acwid = $this->req->get('acwid');
        $gateway = $this->req->get('gateway');
        $cons = '';
        $consArr = array();
        if ($acpcode) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.acpcode=?';
            $consArr[] = $acpcode;
        }
        if ($acwid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.acwid=?';
            $consArr[] = $acwid;
        }
        if ($gateway) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.gateway=?';
            $consArr[] = $gateway;
        }
        $acw = $this->model()->select()->from('acw')->fetchAll();
        $acp = $this->model()->select()->from('acp')->fetchAll();
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $lists = array();
        $where = array('fields' => $cons, 'values' => $consArr);
        $totalsize = $this->model()->select()->from('acl a')->where($where)->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,b.name')->left('acw b')->on('a.acwid=b.id')->join()->limit($pagesize)->offset($offset)->from('acl a')->where($where)->orderby('id desc')->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?acpcode=' . $acpcode . '&acwid=' . $acwid . '&gateway=' . $gateway . '&p='));
        $data += array('lists' => $lists, 'acw' => $acw, 'acp' => $acp, 'search' => array('acpcode' => $acpcode, 'acwid' => $acwid, 'gateway' => $gateway), 'pagelist' => $pagelist);
        $this->put('acl.php', $data);
    }
    public function save()
    {
        $acpcode = $this->req->post('acpcode');
        $acwid = $this->req->post('acwid');
        $gateway = $this->req->post('gateway');
        if ($acpcode == '' || $acwid == '' || $gateway == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        if ($this->model()->select()->from('acl')->where(array('fields' => 'acpcode=? and gateway=?', 'values' => array($acpcode, $gateway)))->count()) {
            echo json_encode(array('status' => 0, 'msg' => '此接入商下的网关已存在'));
            exit;
        }
        $data = array('acpcode' => $acpcode, 'acwid' => $acwid, 'gateway' => $gateway);
        if ($this->model()->from('acl')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acl'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $acw = $this->model()->select()->from('acw')->fetchAll();
        $acp = $this->model()->select()->from('acp')->fetchAll();
        $acl = $this->model()->select()->from('acl')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $data = array('title' => '编辑接入网关', 'data' => $acl, 'acw' => $acw, 'acp' => $acp);
        $this->put('acledit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $acpcode = $this->req->post('acpcode');
        $acwid = $this->req->post('acwid');
        $gateway = $this->req->post('gateway');
        if ($acpcode == '' || $acwid == '' || $gateway == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        $data = array('acpcode' => $acpcode, 'acwid' => $acwid, 'gateway' => $gateway);
        if ($this->model()->from('acl')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acl'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('acl')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}