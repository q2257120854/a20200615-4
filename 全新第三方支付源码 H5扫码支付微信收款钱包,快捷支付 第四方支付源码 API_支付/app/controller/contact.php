<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class contact extends Controller
{
    public function index()
    {
        $data = array('title' => '联系我们');
        $this->put('contact.php', $data);
    }
}