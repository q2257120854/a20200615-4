<?php
namespace WY\app\model;

use WY\app\libs\Model;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class Handleorder extends Model
{
    public function __construct($orderid, $money, $cardnum = '', $cardvalue = '', $cardstate = '')
    {
        parent::__construct();
        $this->orderid = $orderid;
        $this->money = number_format($money, 2, '.', '');
        $this->cardnum = $cardnum;
        $this->cardvalue = $cardvalue;
        $this->cardstate = $cardstate;
        if ($this->money <= 0) {
            return false;
        }
    }
    public function updateUncard()
    {
        $orders = $this->getOrder();
        if (!$orders || $orders['is_state'] > 0) {
            return false;
        }
        $rate = $this->getPrice($orders['userid'], $orders['channelid']);
        $data = array('realmoney' => $this->money, 'uprice' => $rate['uprice'], 'gprice' => $rate['gprice'], 'wprice' => $rate['wprice'], 'is_state' => 1, 'lastime' => time());
        $this->model()->from('orders')->updateSet($data)->where(array('fields' => 'orderid=?', 'values' => array($this->orderid)))->update();
        $push = new Pushorder($this->orderid);
        $push->notify();
    }
    public function updateCard()
    {
        $orders = $this->getOrder();
        if (!$orders || $orders['is_state'] > 0) {
            return false;
        }
        $rate = $this->getPrice($orders['userid'], $orders['channelid']);
        $data = array('realmoney' => $this->money, 'uprice' => $rate['uprice'], 'gprice' => $rate['gprice'], 'wprice' => $rate['wprice'], 'is_state' => 1, 'lastime' => time());
        $this->model()->from('orders')->updateSet($data)->where(array('fields' => 'orderid=?', 'values' => array($this->orderid)))->update();
        $push = new Pushorder($this->orderid);
        $push->notify();
    }
    private function getPrice($userid, $channelid)
    {
        $uprice = $gprice = $wprice = 0;
        if ($users = $this->model()->select('superid')->from('users')->where(array('fields' => 'id=?', 'values' => array($userid)))->fetchRow()) {
            if ($rate = $this->model()->select('gprice')->from('userprice')->where(array('fields' => 'userid=? and channelid=?', 'values' => array($users['superid'], $channelid)))->fetchRow()) {
                $gprice = $rate['gprice'];
            }
        }
        if ($rate = $this->model()->select('uprice')->from('userprice')->where(array('fields' => 'userid=? and channelid=?', 'values' => array($userid, $channelid)))->fetchRow()) {
            $uprice = $rate['uprice'];
        }
        if ($rate = $this->model()->select('wprice')->from('acc')->where(array('fields' => 'id=?', 'values' => array($channelid)))->fetchRow()) {
            $wprice = $rate['wprice'];
        }
        return array('uprice' => $uprice, 'gprice' => $gprice, 'wprice' => $wprice);
    }
    private function getOrder()
    {
        return $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($this->orderid)))->fetchRow();
    }
}