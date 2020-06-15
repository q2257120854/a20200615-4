<?php
namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class userlogs extends CheckUser
{
    public function index()
    {
        $page = $this->req->get('p');
        $page = $page ? intval($page) : 1;
        $pagesize = 20;
        $offset = ($page - 1) * $pagesize;
        $where = array('fields' => 'userid=? and addtime>=?', 'values' => array($_SESSION['login_userid'], time() - 60 * 60 * 24 * 7));
        $lists = array();
        if ($totalsize = $this->model()->from('userlogs')->where($where)->count()) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $lists = $this->model()->select()->from('userlogs')->where($where)->limit($pagesize)->offset($offset)->orderby('id desc')->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?p='));
        $data = array('title' => '登录日志', 'lists' => $lists, 'pagelist' => $pagelist);
        $this->put('userlogs.php', $data);
    }
}