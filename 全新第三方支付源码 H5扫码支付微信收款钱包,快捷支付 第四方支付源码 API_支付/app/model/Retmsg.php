<?php
namespace WY\app\model;

use WY\app\Config;
if (!defined('WY_ROOT')) {
    exit;
}
class Retmsg
{
    function __construct()
    {
        $this->setConfig = new Config();
    }
    public function put($code, $data_type = false)
    {
        return $data_type ? json_encode(array('status' => $code, 'msg' => $this->setConfig->retMsg($code))) : $code . ',' . $this->setConfig->retMsg($code);
    }
}