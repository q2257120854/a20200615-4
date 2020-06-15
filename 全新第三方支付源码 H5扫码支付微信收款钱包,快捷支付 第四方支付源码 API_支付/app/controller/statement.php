<?php
namespace WY\app\controller;
use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class statement extends Controller
{
    public function index()
    {
        $data = array('title' => '免责声明');
        $this->put('statement.php', $data);
    }
}
?>