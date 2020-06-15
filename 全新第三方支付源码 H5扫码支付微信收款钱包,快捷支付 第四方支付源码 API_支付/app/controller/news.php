<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class news extends Controller
{
    public function index()
    {
        $news = $this->model()->select()->from('arlist')->where(array('fields' => 'cid=? and is_state=?', 'values' => array(3, 1)))->orderby('id desc')->fetchAll();
        $this->put('news.php', array('title' => '行业动态', 'news' => $news));
    }
    public function view()
    {
        $id = isset($this->action[2]) ? intval($this->action[2]) : 0;
        $data = $this->model()->select()->from('arlist')->where(array('fields' => 'is_state=? and id=? ', 'values' => array(1, $id)))->fetchRow();
        $this->put('view.php', array('title' => $data['title'], 'data' => $data));
    }
}
?>