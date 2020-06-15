<?php
namespace WY\app\model;

use WY\app\libs\Model;
if (!defined('WY_ROOT')) {
    exit;
}
class Queryorder extends Model
{
    public function getOrder($orderid)
    {
        return $this->model()->select()->from('orders')->where(array('fields' => 'orderid=? and is_state=?', 'values' => array($orderid, 1)))->count();
    }
}
?>