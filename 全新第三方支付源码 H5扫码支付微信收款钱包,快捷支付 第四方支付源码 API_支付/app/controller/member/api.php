<?php
namespace WY\app\controller\member;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class api extends CheckUser
{
    public function index()
    {
        $userprice = $this->model()->select('a.uprice,a.is_state,b.name')->from('userprice a')->left('acc b')->on('a.channelid=b.id')->join()->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_userid'])))->fetchAll();
        $data = array('title' => '接入信息', 'userprice' => $userprice);
        $this->put('apiinfo.php', $data);
    }
    public function show()
    {
        $this->put('apikey.php');
    }
	 public function syt()
    {
        $this->put('syt.php');
    }
}