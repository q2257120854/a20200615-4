<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class download extends Controller
{
    public function index()
    {
        $data = array('title' => '集成包下载');
        $this->put('download.php', $data);
    }
}
?>