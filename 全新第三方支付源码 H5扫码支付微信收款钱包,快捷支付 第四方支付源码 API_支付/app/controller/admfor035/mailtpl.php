<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class mailtpl extends CheckAdmin
{
    public function index()
    {
        $lists = $this->model()->select()->from('mailtpl')->fetchAll();
        $data = array('title' => '邮件模板', 'lists' => $lists);
        $this->put('mailtpl.php', $data);
    }
    public function save()
    {
        $cname = $this->req->post('cname');
        $title = $this->req->post('title');
        $content = $this->req->post('content');
        $is_state = $this->req->post('is_state');
        if ($cname && $title && $content) {
            $data = array('cname' => $cname, 'title' => $title, 'content' => $content, 'is_state' => $is_state, 'addtime' => time());
            if ($this->model()->from('mailtpl')->insertData($data)->insert()) {
                $this->put('woodyapp.php', array('msg' => '设置保存成功', 'url' => $this->dir . 'mailtpl'));
                exit;
            }
        }
        $this->put('woodyapp.php', array('msg' => '保存失败'));
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('mailtpl')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $data += array('title' => '模板编辑');
        $this->put('mailtpledit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $cname = $this->req->post('cname');
        $title = $this->req->post('title');
        $content = $this->req->post('content');
        $is_state = $this->req->post('is_state');
        if ($id && $cname && $title && $content) {
            $data = array('cname' => $cname, 'title' => $title, 'content' => $content, 'is_state' => $is_state);
            if ($this->model()->from('mailtpl')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
                $this->put('woodyapp.php', array('msg' => '设置保存成功', 'url' => $this->dir . 'mailtpl'));
                exit;
            }
        }
        $this->put('woodyapp.php', array('msg' => '保存失败'));
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('mailtpl')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}