<?php
namespace WY\app\model;

use WY\app\libs\Model;
if (!defined('WY_ROOT')) {
    exit;
}
class Bill extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->config = $this->model()->select()->from('config')->fetchRow();
    }
    public function fee($money = 0)
    {
        $fee = 0;
        if ($money > 0 && $this->config['tx_fee'] > 0) {
            $fee = number_format($this->config['tx_fee'] / 100 * $money, 2, '.', '');
            $fee = $fee < 1 ? 1 : $fee;
            $fee = $this->config['tx_limit'] > 0 && $fee >= $this->config['tx_limit'] ? $this->config['tx_limit'] : $fee;
        }
        return $fee;
    }
    public function todayUserIncome($userid, $is_ship = 0)
    {
        $where = array('fields' => 'userid=? and is_state=? and is_ship=? and addtime>=?', 'values' => array($userid, 1, $is_ship, strtotime(date('Y-m-d'))));
        $order_income = $this->model()->select(array('income' => 'realmoney*uprice'))->from('orders')->where($where)->sum();
        return $order_income['income'];
    }
    public function beforeUserIncome($userid, $is_ship = 0)
    {
        $where = array('fields' => 'userid=? and is_state=? and is_ship=? and addtime<?', 'values' => array($userid, 1, $is_ship, strtotime(date('Y-m-d'))));
        $order_income = $this->model()->select(array('income' => 'realmoney*uprice'))->from('orders')->where($where)->sum();
        return $order_income['income'];
    }
    public function getUserIncome($userid, $fromTime)
    {
        $where = array('fields' => 'userid=? and is_state=? and is_ship=? and addtime<=?', 'values' => array($userid, 1, 0, $fromTime));
        $order_income = $this->model()->select(array('income' => 'realmoney*uprice'))->from('orders')->where($where)->sum();
        return $order_income['income'];
    }
    public function todayAgentIncome($userid, $is_ship = 0)
    {
        $where = array('fields' => 'agentid=? and is_state=? and is_ship_agent=? and addtime>=?', 'values' => array($userid, 1, $is_ship, strtotime(date('Y-m-d'))));
        $order_income = $this->model()->select(array('income' => 'realmoney*(gprice-uprice)'))->from('orders')->where($where)->sum();
        return $order_income['income'];
    }
    public function beforeAgentIncome($userid, $is_ship = 0)
    {
        $where = array('fields' => 'agentid=? and is_state=? and is_ship_agent=? and addtime<? and gprice>?', 'values' => array($userid, 1, $is_ship, strtotime(date('Y-m-d')), 0));
        $order_income = $this->model()->select(array('income' => 'realmoney*(gprice-uprice)'))->from('orders')->where($where)->sum();
        return $order_income['income'];
    }
}
?>