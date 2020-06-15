<?php

namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class main extends CheckAdmin
{
    public function index()
    {
        $tx['tcount'] = $this->model()->select()->from('payments')->where(array('fields' => 'is_state=? and ship_type=? and addtime>=? and addtime<=?', 'values' => array(0, 1, strtotime(date('Y-m-d')), time())))->count();
        $tx['tmoney'] = $this->model()->select(array('money' => 'money'))->from('payments')->where(array('fields' => 'is_state=? and ship_type=? and addtime>=? and addtime<=?', 'values' => array(0, 1, strtotime(date('Y-m-d')), time())))->sum();
        $tx['ycount'] = $this->model()->select()->from('payments')->where(array('fields' => 'is_state=? and ship_type=? and addtime>=? and addtime<=?', 'values' => array(0, 1, strtotime(date('Y-m-d')) - 60 * 60 * 24, strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24)))->count();
        $tx['ymoney'] = $this->model()->select(array('money' => 'money'))->from('payments')->where(array('fields' => 'is_state=? and ship_type=? and addtime>=? and addtime<=?', 'values' => array(0, 1, strtotime(date('Y-m-d')) - 60 * 60 * 24, strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24)))->sum();
        $user['tcount'] = $this->model()->select()->from('users')->where(array('fields' => 'addtime>=? and addtime<=?', 'values' => array(strtotime(date('Y-m-d')), time())))->count();
        $user['ycount'] = $this->model()->select()->from('users')->where(array('fields' => 'addtime>=? and addtime<=?', 'values' => array(strtotime(date('Y-m-d')) - 60 * 60 * 24, strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24)))->count();
        $user['unverify'] = $this->model()->select()->from('users')->where(array('fields' => 'is_state=?', 'values' => array(0)))->count();
        $user['agent'] = $this->model()->select()->from('users')->where(array('fields' => 'is_agent=?', 'values' => array(1)))->count();
        $order['tcount'] = $this->model()->select()->from('orders')->where(array('fields' => 'addtime>=? and addtime<=?', 'values' => array(strtotime(date('Y-m-d')), time())))->count();
        $order['unpaid'] = $this->model()->select()->from('orders')->where(array('fields' => 'is_state=? and addtime>=? and addtime<=?', 'values' => array(0, strtotime(date('Y-m-d')), time())))->count();
        $order['paid'] = $this->model()->select()->from('orders')->where(array('fields' => 'is_state=? and addtime>=? and addtime<=?', 'values' => array(1, strtotime(date('Y-m-d')), time())))->count();
        $order['ycount'] = $this->model()->select()->from('orders')->where(array('fields' => 'addtime>=? and addtime<=?', 'values' => array(strtotime(date('Y-m-d')) - 60 * 60 * 24, strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24)))->count();
        $data = array('title' => '后台管理中心', 'tx' => $tx, 'user' => $user, 'order' => $order);
        $this->put('index.php', $data);
    }
}