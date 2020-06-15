<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class users extends CheckAdmin
{
    public function index()
    {
        $is_state = $this->req->get('is_state');
        $kw = $this->req->get('kw');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $superid = $this->req->get('superid');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $cons = 'a.is_agent=?';
        $consOR = '';
        $consArr = array('0');
        if ($superid) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.superid=?';
            $consArr[] = $superid;
        }
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
        $pagesize = 15;
        $totalsize = $this->model()->select()->from('users a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('a.*,b.realname,b.phone,b.qq')->from('users a')->left('userinfo b')->on('b.userid=a.id')->join()->offset($offset)->limit($pagesize)->where(array('fields' => $cons, 'values' => $consArr))->orderby('a.id desc')->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&kw=' . $kw . '&fdate=' . $fdate . '&tdate=' . $tdate . '&p='));
        $data = array('title' => '用户列表', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('is_state' => $is_state, 'kw' => $kw, 'fdate' => $fdate, 'tdate' => $tdate));
        $this->put('users.php', $data);
    }



    public function tongdao()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);

       // $this->put('userstongdao.php', $data);


        $userprice = $this->model()->select('a.id,a.userid,a.uprice,a.is_state,b.name')->from('userprice a')->left('acc b')->on('a.channelid=b.id')->join()->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchAll();
        $data = array('title' => '我的费率', 'userprice' => $userprice,'user' => $user);
		
        $this->put('userstongdao.php', $data);




    }

	public function tongdao_edit()
    {
        $data = isset($_POST) ? $_POST : false;

		$id		=$data['id'];
		$userid		=$data['userid'];


		if ($id) {


			

            if ($data = $this->model()->select('is_state')->from('userprice')->where(array('fields' => 'userid=? and id=?', 'values' => array($userid, $id)))->fetchRow()) {

				

                $st = $data['is_state'] ? 0 : 1;

				
               
                $this->model()->from('userprice')->updateSet(array('is_state' => $st))->where(array('fields' => 'userid=? and id=?', 'values' => array($userid, $id)))->update();
                echo json_encode(array('status' => 1, 'st' => $st));
                exit;
              
            }
        }
        echo json_encode(array('status' => 0));
    }




    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        $data = array('user' => $user, 'userinfo' => $userinfo);
        $this->put('usersedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($data['superid'] && $data['is_agent']) {
            echo json_encode(array('status' => 0, 'msg' => '此用户不能设为代理'));
            exit;
        }
        $userpass = '';
        if ($data && $data['userpass']) {
            if (strlen($data['userpass']) < 6 || strlen($data['userpass']) > 20) {
                echo json_encode(array('status' => 0, 'msg' => '密码长度在6-20个字符之间'));
                exit;
            }
            $userpass = sha1($data['userpass']);
        }
        $newData = array();
        foreach ($data as $key => $val) {
            if ($key != 'userpass') {
                $newData[$key] = $val;
            }
        }
        if ($userpass) {
            $newData['userpass'] = $userpass;
        }
        $acc = $this->model()->select('id,uprice,gprice,is_state')->from('acc')->where(array('fields' => 'is_display=?', 'values' => array(0)))->fetchAll();
        if ($acc && !$this->model()->select()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($id)))->count()) {
            foreach ($acc as $key => $val) {
                $userprice = array('userid' => $id, 'channelid' => $val['id'], 'is_state' => $val['is_state'], 'uprice' => $val['uprice'], 'gprice' => $val['gprice']);
                $this->model()->from('userprice')->insertData($userprice)->insert();
            }
        }
        if ($this->model()->from('users')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', $this->dir . 'users/edit/' . $id));
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
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', $this->dir . 'users/edit/' . $id));
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
                $this->model()->from('payments')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                $this->model()->from('paylogs')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                $this->model()->from('orders')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
                $this->model()->from('orderinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
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
    public function resetapikey()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        if ($id) {
            $data = array('apikey' => sha1($this->res->getRandomString(40)));
            if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
                $this->put('woodyapp.php', array('msg' => '接入密钥已重新生成'));
                exit;
            }
        }
        $this->put('woodyapp.php', array('msg' => '接入密钥生成失败'));
        exit;
    }
    public function getbadata()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $cfoid = $this->req->get('cfoid');
        $user = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if ($cfoid) {
            $userinfo = $this->model()->select()->from('cfo')->where(array('fields' => 'id=?', 'values' => array($cfoid)))->fetchRow();
        } else {
            $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($id)))->fetchRow();
        }
        $data = array('user' => $user, 'userinfo' => $userinfo, 'cfoid' => $cfoid);
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
                $acc = $this->model()->select('name,acwid,uprice')->from('acc')->where(array('fields' => 'id=?', 'values' => array($val['channelid'])))->fetchRow();
                $userprice[$key]['name'] = $acc['name'];
                $userprice[$key]['acwid'] = $acc['acwid'];
                $userprice[$key]['uprice_default'] = $acc['uprice'];
            }
        }
        $this->put('getuserprice.php', array('data' => $userprice, 'userid' => $id));
    }
    public function saveprice()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $is_mod = false;
        $users = $this->model()->select('superid')->from('users')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if ($users['superid']) {
            $is_mod = true;
        }
        $this->model()->from('userprice')->where(array('fields' => 'userid=?', 'values' => array($id)))->delete();
        $uprice = isset($_POST) ? $_POST['uprice'] : false;
        $is_state = isset($_POST) ? $_POST['is_state'] : false;
        $channelid = isset($_POST) ? $_POST['channelid'] : false;
        if ($uprice && $is_state) {
            foreach ($uprice as $key => $val) {
                $data = array('uprice' => $val, 'is_state' => $is_state[$key], 'channelid' => $is_mod && $channelid[$key] != $key ? $key : $channelid[$key], 'userid' => $id);
                $this->model()->from('userprice')->insertData($data)->insert();
            }
        }
        $this->put('woodyapp.php', array('msg' => '设置保存成功'));
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
}