<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class about extends Controller
{
    public function index()
    {
        $data = array('title' => '公司介绍');
        $this->put('about.php', $data);
    }
}
?>