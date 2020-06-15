<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class agent extends CheckAdmin
{
    public function index()
    {
        $is_state = $this->req->get('is_state');
        $kw = $this->req->get('kw');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $cons = 'a.is_agent=?';
        $consOR = '';
        $consArr = array('1');
        if ($is_state >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.is_state=?';
            $consArr[] = $is_state;
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'a.username like ?';
            $consArr[] = '%' . $kw . '%';
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'a.id = ?';
            $consArr[] = $kw;
        }
        if ($consOR) {
            $cons .= $cons ? ' and ' : '';
            $cons .= '(' . $consOR . ')';
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.addtime>=?';
            $consArr[] = strtotime($fdate);
        }
        if ($tdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.addtime<=?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->select()->from('users a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,b.realname,b.phone,b.qq')->from('users a')->left('userinfo b')->on('b.userid=a.id')->join()->offset($offset)->limit($pagesize)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&kw=' . $kw . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data = array('title' => '代理列表', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('is_state' => $is_state, 'kw' => $kw, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('agents.php', $data);
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);
        $this->put('agentedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        $userpass = '';
        if ($data && $data['userpass']) {
            if (strlen($data['userpass']) < 6 || strlen($data['userpass']) > 20) {
                echo json_encode(array('status' => 0, 'msg' => '密码长度在6-20个字符之间'));
                exit;
            }
            $userpass = sha1($data['userpass']);
        }
        foreach ($data as $key => $val) {
            if ($key != 'userpass') {
                $data[$key] = $val;
            }
        }
        if ($userpass) {
            $data['userpass'] = $userpass;
        }
        if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', $this->dir . 'agent/edit/' . $id));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function editsave2()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($data && $this->model()->from('userinfo')->updateSet($data)->where(array('fields' => 'userid=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', $this->dir . 'agent/edit/' . $id));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                $this->model()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                $this->model()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                $this->model()->from('userlogs')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
    public function getuserinfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);
        $this->put('getuserinfo.php', $data);
    }
    public function getapidata()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);
        $this->put('getapidata.php', $data);
    }
    public function getbadata()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);
        $this->put('getbadata.php', $data);
    }
    public function getuserprice()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        if (!($userprice = $this->model()->select()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($id)))->orderby('channelid asc')->fetchAll())) {
            $userprice = $this->model()->select()->from('acc')->where(array('fields' => 'is_display=?', 'values' => array(0)))->orderby('id asc')->fetchAll();
        } else {
            foreach ($userprice as $key => $val) {
                if (array_key_exists('channelid', $val)) {
                    $userprice[$key]['id'] = $val['channelid'];
                }
                $acc = $this->model()->select('name,gprice')->from('acc')->where(array('fields' => 'id=?', 'values' => array($val['channelid'])))->fetchRow();
                $userprice[$key]['name'] = $acc['name'];
                $userprice[$key]['gprice_default'] = $acc['gprice'];
            }
        }
        $this->put('getagentprice.php', array('data' => $userprice, 'userid' => $id));
    }
    public function resetprice()
    {
        $userid = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $this->model()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($userid)))->delete();
        $acc = $this->model()->select('id,uprice,gprice,is_state')->from('acc')->where(array('fields' => 'is_display=?', 'values' => array(0)))->fetchAll();
        if ($acc) {
            foreach ($acc as $key => $val) {
                $userprice = array('userid' => $userid, 'channelid' => $val['id'], 'is_state' => $val['is_state'], 'uprice' => $val['uprice'], 'gprice' => $val['gprice']);
                $this->model()->from('userprice')->insertData($userprice)->insert();
            }
        }
        $this->put('woodyapp.php', array('msg' => '用户分成比率重置成功！'));
    }
    public function saveprice()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $this->model()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
        $gprice = isset($_POST) ? $_POST['gprice'] : false;
        if ($gprice) {
            foreach ($gprice as $key => $val) {
                $data = array('channelid' => $key, 'gprice' => $gprice[$key], 'userid' => $id);
                $this->model()->from('userprice')->insertData($data)->insert();
            }
        }
        $this->put('woodyapp.php', array('msg' => '设置保存成功'));
    }
}