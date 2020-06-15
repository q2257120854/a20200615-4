<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class jobs extends Controller
{
    public function index()
    {
        $data = array('title' => '人才招聘');
        $this->put('jobs.php', $data);
    }
}