<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class arlist extends CheckAdmin
{
    public function index()
    {
        $lists = array();
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->from('arlist')->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,c.cname')->from('arlist a')->limit($pagesize)->left('arclass c')->on('c.id=a.cid')->join()->offset($offset)->orderby('a.id desc')->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?p='));
        $class = $this->model()->select()->from('arclass')->fetchAll();
        $data = array('title' => '公告列表', 'lists' => $lists, 'class' => $class, 'pagelist' => $pagelist);
        $this->put('arlist.php', $data);
    }
    public function save()
    {
        $data = array();
        if (isset($_POST)) {
            foreach ($_POST as $key => $val) {
                if ($key == 'addtime') {
                    $data[$key] = strtotime($this->req->post($key));
                } else {
                    $data[$key] = $this->req->post($key);
                }
            }
        }
        if ($data) {
            if ($this->model()->from('arlist')->insertData($data)->insert()) {
                $this->res->redirect($this->dir . 'arlist');
            }
        }
        $this->res->redirect($this->dir . 'arlist');
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('arlist')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $class = $this->model()->select()->from('arclass')->fetchAll();
        $this->put('arlistedit.php', array('title' => '编辑公告', 'data' => $data, 'class' => $class));
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = array();
        if (isset($_POST)) {
            foreach ($_POST as $key => $val) {
                if ($key == 'addtime') {
                    $data[$key] = strtotime($this->req->post($key));
                } else {
                    $data[$key] = $this->req->post($key);
                }
            }
        }
        if ($id && $data) {
            $this->model()->from('arlist')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        }
        $this->res->redirect($this->dir . 'arlist');
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('arlist')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
}