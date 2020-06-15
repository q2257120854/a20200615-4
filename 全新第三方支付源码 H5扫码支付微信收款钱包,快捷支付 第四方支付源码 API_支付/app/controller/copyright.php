<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class copyright extends Controller
{
    public function index()
    {
        $data = array('title' => '版权声明');
        $this->put('copyright.php', $data);
    }
}