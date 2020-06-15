<?php

namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class rates extends CheckUser
{
    public function index()
    {
        $userprice = $this->model()->select('a.id,a.uprice,a.is_state,b.name')->from('userprice a')->left('acc b')->on('a.channelid=b.id')->join()->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_userid'])))->fetchAll();
        $data = array('title' => '我的费率', 'userprice' => $userprice);

		
        $this->put('rates.php', $data);
    }
    public function edit()
    {
        $id = $this->req->post('id');
        if ($id) {
            if ($data = $this->model()->select('is_state')->from('userprice')->where(array('fields' => 'userid=? and id=?', 'values' => array($_SESSION['login_userid'], $id)))->fetchRow()) {
                $st = $data['is_state'] ? 0 : 1;
                if ($st == '1') {
                    $this->model()->from('userprice')->updateSet(array('is_state' => $st))->where(array('fields' => 'userid=? and id=?', 'values' => array($_SESSION['login_userid'], $id)))->update();
                    echo json_encode(array('status' => 1, 'st' => $st));
                    exit;
                }
            }
        }
        echo json_encode(array('status' => 0));
    }
}