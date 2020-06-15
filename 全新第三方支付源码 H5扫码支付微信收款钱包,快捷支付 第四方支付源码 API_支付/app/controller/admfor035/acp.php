<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class acp extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '接入商信息');
        $lists = $this->model()->select()->from('acp')->fetchAll();
        $data += array('lists' => $lists);
        $this->put('acp.php', $data);
    }
    public function save()
    {
        $name = $this->req->post('name');
        $code = $this->req->post('code');
        $email = $this->req->post('email');
        $userid = $this->req->post('userid');
        $userkey = $this->req->post('userkey');
        if ($name == '' || $code == '' || $userid == '' || $userkey == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        $data = array('name' => $name, 'code' => $code, 'email' => $email, 'userid' => $userid, 'userkey' => $userkey);
        if ($this->model()->from('acp')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acp'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($data) {
            foreach ($data as $key => $val) {
                $data[$key] = $this->req->post($key);
            }
            if ($this->model()->from('acp')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('acp')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}