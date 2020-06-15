<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class acw extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '通用网关');
        $lists = $this->model()->select()->from('acw')->orderby('id asc')->fetchAll();
        $data += array('lists' => $lists);
        $this->put('acw.php', $data);
    }
    public function save()
    {
        $name = $this->req->post('name');
        $code = $this->req->post('code');
        $price = $this->req->post('price');
        $length = $this->req->post('length');
        $img = $this->req->post('img');
        if ($name == '' || $code == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        $data = array('name' => $name, 'code' => $code, 'price' => $price ? json_encode(explode('|', $price)) : '', 'length' => $length ? json_encode(explode('|', $length)) : '', 'img' => $img);
        if ($this->model()->from('acw')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acw'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = array('title' => '编辑通用网关');
        $acw = $this->model()->select()->from('acw')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $data += array('data' => $acw);
        $this->put('acwedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $name = $this->req->post('name');
        $code = $this->req->post('code');
        $price = $this->req->post('price');
        $length = $this->req->post('length');
        $img = $this->req->post('img');
        if ($name == '' || $code == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        $data = array('name' => $name, 'code' => $code, 'price' => $price ? json_encode(explode('|', $price)) : '', 'length' => $length ? json_encode(explode('|', $length)) : '', 'img' => $img);
        if ($this->model()->from('acw')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acw'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('acw')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}