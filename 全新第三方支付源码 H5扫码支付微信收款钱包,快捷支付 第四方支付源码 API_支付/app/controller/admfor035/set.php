<?php
namespace WY\app\controller\admfor035;
use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class set extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '系统设置');
        $this->put('set.php', $data);
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
            if ($this->req->get('t')) {
                $data['is_checkout_jump'] = isset($data['is_checkout_jump']) ? 1 : 0;
            }
            if ($this->model()->from('config')->updateSet($data)->update()) {
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
}