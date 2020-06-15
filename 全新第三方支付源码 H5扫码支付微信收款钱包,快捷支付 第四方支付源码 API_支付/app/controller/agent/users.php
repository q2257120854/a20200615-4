<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
use WY\app\model\Pushorder;
if (!defined('WY_ROOT')) {
    exit;
}
class users extends CheckUser
{
    public function index()
    {
        $uname = $this->req->get('uname');
        $cons = 'superid=?';
        $consArr = array($_SESSION['login_agentid']);
        if ($uname) {
            $cons .= $cons ? ' and ' : '';
            $cons .= '(id=? or username like ?)';
            $consArr[] = $uname;
            $consArr[] = '%' . $uname . '%';
        }
        $where = array('fields' => $cons, 'values' => $consArr);
        $lists = $this->model()->select()->from('users')->where($where)->fetchAll();
        $data = array('title' => '下级用户', 'lists' => $lists, 'search' => array('uname' => $uname));
        $this->put('users.php', $data);
    }
    public function setuserrate()
    {
        $userid = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $saveset = $this->req->post('saveset');
        if (!$userid) {
            $data = array('msg' => '商户不存在');
            $this->put('woodyapp.php', $data);
            exit;
        }
        $where = array('fields' => 'id=? and superid=?', 'values' => array($userid, $_SESSION['login_agentid']));
        if ($this->model()->select()->from('users')->where($where)->count()) {
            if (!($userprice = $this->model()->select()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($userid)))->fetchAll())) {
                $userprice = $this->model()->select('*,id as channelid')->from('acc')->where(array('fields' => 'is_display=?', 'values' => array(0)))->fetchAll();
            }
            $agentprice = $this->model()->select()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_agentid'])))->fetchAll();
            if ($userprice && $agentprice) {
                if ($saveset == '1') {
                    $newPrice = array();
                    $price = isset($_POST['uprice']) ? $_POST['uprice'] : false;
                    $accid = isset($_POST['accid']) ? $_POST['accid'] : false;
                    if ($price && $accid) {
                        foreach ($price as $key => $val) {
                            $uprice = $val > $agentprice[$key]['gprice'] ? $agentprice[$key]['gprice'] : $val;
                            $channelid = $accid[$key];
                            $this->model()->from('userprice')->updateSet(array('uprice' => $uprice))->where(array('fields' => 'userid=? and channelid=?', 'values' => array($userid, $channelid)))->update();
                        }
                        $data = array('msg' => '设置保存成功');
                        $this->put('woodyapp.php', $data);
                        exit;
                    }
                } else {
                    $data = array('userid' => $userid, 'userprice' => $userprice, 'agentprice' => $agentprice);
                    $this->put('userprice.php', $data);
                    exit;
                }
            }
        }
        $data = array('msg' => '没有找到相关信息');
        $this->put('woodyapp.php', $data);
        exit;
    }
}