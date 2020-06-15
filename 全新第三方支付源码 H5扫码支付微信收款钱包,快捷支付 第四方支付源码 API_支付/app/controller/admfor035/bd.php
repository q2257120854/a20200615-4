<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\model\Handleorder;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class bd extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '订单补发');
        $this->put('bd.php', $data);
    }
    public function save()
    {
        $orderid = $this->req->post('orderid');
        $price = $this->req->post('price');
        if ($orderid && $price) {
            $handle = new Handleorder($orderid, $price);
            $handle->updateUncard();
        }
        echo json_encode(array('status' => 1, 'msg' => '订单补发成功'));
    }
    public function notify()
    {
        $fdate = $this->req->post('fdate');
        $tdate = $this->req->post('tdate');
        $userid = $this->req->post('userid');
        if ($userid == '') {
            echo json_encode(array('status' => 0, 'msg' => '商户ID不能为空'));
            exit;
        }
        $cons = 'is_state=? and is_notify=?';
        $consArr = array(1, 1);
        if ($userid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'userid=?';
            $consArr[] = $userid;
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime>=?';
            $consArr[] = strtotime($fdate);
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime<=?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        $nums = 0;
        if ($cons) {
            $orders = $this->model()->select('orderid')->from('orders')->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
            if ($orders) {
                $nums = count($orders);
                foreach ($orders as $key => $val) {
                    $push = new Pushorder($val['orderid']);
                    $push->notify();
                }
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '批量通知完成，共通知' . $nums . '个订单'));
    }
}