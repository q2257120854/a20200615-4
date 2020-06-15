<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class customers extends Controller
{
    public function index()
    {
        $data = array('title' => '消费者协议');
        $this->put('customers.php', $data);
    }
}
?>