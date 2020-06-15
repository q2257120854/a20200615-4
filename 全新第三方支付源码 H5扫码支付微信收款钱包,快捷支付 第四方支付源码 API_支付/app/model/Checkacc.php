<?php
namespace WY\app\model;

use WY\app\libs\Model;
if (!defined('WY_ROOT')) {
    exit;
}
class Checkacc extends Model
{
    public function isAccExist($userid, $code)
    {
        $data = $this->model()->select('a.id')->from('acc a')->left('acw b')->on('b.id=a.acwid')->join()->where(array('fields' => 'a.is_state=? and b.code=?', 'values' => array(0, $code)))->fetchAll();
        if ($data) {
            $userprice = $this->model()->select('channelid')->from('userprice')->where(array('fields' => 'is_state=? and userid=?', 'values' => array(0, $userid)))->fetchAll();
            foreach ($data as $key => $val) {
                foreach ($userprice as $key2 => $val2) {
                    if ($val['id'] == $val2['channelid']) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}