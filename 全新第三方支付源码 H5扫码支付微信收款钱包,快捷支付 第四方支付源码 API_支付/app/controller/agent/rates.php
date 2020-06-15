<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class rates extends CheckUser
{
    public function index()
    {
        $userprice = $this->model()->select('a.gprice,a.is_state,b.name')->from('userprice a')->left('acc b')->on('a.channelid=b.id')->join()->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_agentid'])))->fetchAll();
        $data = array('title' => '代理费率', 'userprice' => $userprice);
        $this->put('rates.php', $data);
    }
}