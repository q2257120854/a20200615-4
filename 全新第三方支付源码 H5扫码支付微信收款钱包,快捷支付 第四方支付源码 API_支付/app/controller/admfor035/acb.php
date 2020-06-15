<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class acb extends CheckAdmin
{
    public function index()
    {
        $lists = $this->model()->select()->from('acb')->orderby('sortid asc,id asc')->fetchAll();
        $data = array('title' => '网银列表', 'lists' => $lists);
        $this->put('acb.php', $data);
    }
    public function save()
    {
        $data = isset($_POST) ? $_POST : false;
        if ($data && $this->model()->from('acb')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acb'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $acb = $this->model()->select()->from('acb')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $data = array('title' => '编辑网银', 'data' => $acb);
        $this->put('acbedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($data && $this->model()->from('acb')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acb'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('acb')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}