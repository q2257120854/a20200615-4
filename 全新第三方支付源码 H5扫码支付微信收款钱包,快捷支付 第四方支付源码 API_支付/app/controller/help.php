<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class help extends Controller
{
    public function index()
    {
        $list = $this->model()->select()->from('arlist')->where(array('fields' => 'cid=? and is_state=?', 'values' => array(1, 1)))->fetchAll();
        $data = array('title' => '帮助中心', 'list' => $list);
        $this->put('help.php', $data);
    }
}