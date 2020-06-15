<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class cog extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '系统设置');
        $this->put('cog.php', $data);
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
            $newdata = array('content' => json_encode($data));
            $this->model()->from('navcog')->delete();
            if ($this->model()->from('navcog')->insertData($newdata)->insert()) {
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'cog'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
}