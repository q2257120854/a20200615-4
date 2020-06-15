<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class agreement extends Controller
{
    public function index()
    {
        $data = array('title' => '商户服务协议');
        $this->put('agreement.php', $data);
    }
}
?>