<?php
namespace WY\app\model;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class Payacp extends Controller
{
    public function get($acpcode)
    {
        $banklist = $this->model('email,userid,userkey')->select()->from('acp')->where(array('fields' => 'code=?', 'values' => array($acpcode)))->fetchRow();
        return $banklist;
    }
}
?>