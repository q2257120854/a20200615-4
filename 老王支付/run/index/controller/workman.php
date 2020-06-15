<?php
namespace xh\run\index\controller;
use xh\library\model;
use xh\library\mysql;
use xh\library\functions;
class workman{
    private $mysql;
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    public function workman() {
         require_once (ROOT_PATH . '/extend/library/Workerman/Autoloader.php');
    }
}
