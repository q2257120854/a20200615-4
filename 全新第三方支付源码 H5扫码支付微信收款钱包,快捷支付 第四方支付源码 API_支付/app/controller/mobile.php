<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class mobile extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        $data = array('title' => '手机网站');
        $this->put('mobile.php', $data);
    }
   
}
?>