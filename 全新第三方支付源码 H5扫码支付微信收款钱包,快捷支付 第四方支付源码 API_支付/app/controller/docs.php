<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class docs extends Controller
{
    public function index()
    {
        $data = array('title' => '集成文档');
        $this->put('docs.php', $data);
    }
}
?>