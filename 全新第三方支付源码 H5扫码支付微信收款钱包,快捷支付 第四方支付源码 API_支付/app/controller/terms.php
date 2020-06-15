<?php
namespace WY\app\controller;
use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class terms extends Controller
{
    public function index()
    {
        $data = array('title' => '网站隐私条款');
        $this->put('terms.php', $data);
    }
}
?>