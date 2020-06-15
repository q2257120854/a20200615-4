<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class arcate extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '公告分类');
        $lists = $this->model()->select()->from('arclass')->fetchAll();
        $data += array('lists' => $lists);
        $this->put('arclass.php', $data);
    }
    public function save()
    {
        $data = array();
        if (isset($_POST)) {
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->req->post($key);
            }
        }
        if ($data) {
            if ($this->model()->from('arclass')->insertData($data)->insert()) {
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'arcate'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('arclass')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $this->put('arclassedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $cname = $this->req->post('cname');
        if ($id && $cname) {
            $this->model()->from('arclass')->updateSet(array('cname' => $cname))->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        }
        $this->res->redirect($this->dir . 'arcate');
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('arclass')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}