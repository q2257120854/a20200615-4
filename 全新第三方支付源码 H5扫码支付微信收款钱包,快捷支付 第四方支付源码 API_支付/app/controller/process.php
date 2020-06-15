<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class process extends Controller
{
    public function index()
    {
        $data = array('title' => '接入流程');
        $this->put('process.php', $data);
    }
}
?>