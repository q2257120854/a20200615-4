<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class acc extends CheckAdmin
{
    public function index()
    {
        $acp = $this->model()->select()->from('acp')->fetchAll();
        $lists = $this->model()->select()->from('acc')->orderby('sortid asc,id desc')->fetchAll();
        $data = array('title' => '通道列表', 'lists' => $lists, 'acp' => $acp);
        $this->put('acc.php', $data);
    }
    public function save()
    {
        $data = isset($_POST) ? $_POST : false;
        if ($data) {
            $acwid = $this->model()->select('acwid')->from('acl')->where(array('fields' => 'gateway=? and acpcode=?', 'values' => array($data['gateway'], $data['acpcode'])))->fetchRow();
            $data += $acwid;
            if ($this->model()->from('acc')->where(array('fields' => 'acwid=? and is_display=?', 'values' => array($acwid['acwid'], 0)))->count()) {
                $data['is_display'] = 1;
            }
            $acw = $this->model()->select('price')->from('acw')->where(array('fields' => 'id=?', 'values' => array($acwid['acwid'])))->fetchRow();
            if ($acw && $acw['price']) {
                $data += array('is_card' => 1);
            }
            if ($accid = $this->model()->from('acc')->insertData($data)->insert()) {
                if ($data['is_display'] == 0) {
                    $users = $this->model()->select('id')->from('users')->fetchAll();
                    if ($users) {
                        foreach ($users as $key => $val) {
                            $insertData = array('userid' => $val['id'], 'channelid' => $accid, 'uprice' => $this->req->post('uprice'), 'gprice' => $this->req->post('gprice'), 'is_state' => $this->req->post('is_state'));
                            $this->model()->from('userprice')->insertData($insertData)->insert();
                        }
                    }
                }
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acc'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $acp = $this->model()->select()->from('acp')->fetchAll();
        $acc = $this->model()->select()->from('acc')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        $acl = $this->model()->select('a.gateway,b.name')->left('acw b')->on('a.acwid=b.id')->join()->from('acl a')->where(array('fields' => 'a.acpcode=?', 'values' => array($acc['acpcode'])))->fetchAll();
        $data = array('title' => '编辑通道', 'data' => $acc, 'acp' => $acp, 'acl' => $acl);
        $this->put('accedit.php', $data);
    }
    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        $is_check = $this->req->post('is_check');
        $acwid = $this->model()->select('acwid')->from('acl')->where(array('fields' => 'gateway=? and acpcode=?', 'values' => array($data['gateway'], $data['acpcode'])))->fetchRow();
        $data += $acwid;
        if ($this->model()->from('acc')->where(array('fields' => 'acwid=? and is_display=? and id<>?', 'values' => array($acwid['acwid'], 0, $id)))->count()) {
            $data['is_display'] = 1;
        }
        $acw = $this->model()->select('price')->from('acw')->where(array('fields' => 'id=?', 'values' => array($acwid['acwid'])))->fetchRow();
        if ($acw && $acw['price']) {
            $data += array('is_card' => 1);
        }
        if ($data) {
            $newData = array();
            foreach ($data as $key => $val) {
                if ($key != 'is_check') {
                    $newData[$key] = $val;
                }
            }
        }
	
	//print_r($newData);

		//echo $this->model()->from('acc')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($id)))->update();


		
	
        if ($newData && $this->model()->from('acc')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
			//echo "22222222222222";
            if ($is_check) {
                $data = array('is_state' => $newData['is_state'], 'uprice' => $newData['uprice'], 'gprice' => $newData['gprice']);
                $this->model()->from('userprice')->updateSet($data)->where(array('fields' => 'channelid=?', 'values' => array($id)))->update();
                /*$users=$this->model()->select('id')->from('users')->fetchAll();if($users){foreach($users as $key=>$val){if(!$this->model()->from('userprice')->where(array('fields'=>'userid=? and channelid=?','values'=>array($val['id'],$id)))->count()){$insertData=array('is_state'=>$newData['is_state'],'uprice'=>$newData['uprice'],'gprice'=>$newData['gprice'],'userid'=>$val['id'],'channelid'=>$id,);$this->model()->from('userprice')->insertData($insertData)->insert();}}}*/
            }
            echo json_encode(array('status' => 1, 'msg' => '设置保存成功', 'url' => $this->dir . 'acc'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }
    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('acc')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                $this->model()->from('userprice')->where(array('fields' => 'channelid=?', 'values' => array($id)))->delete();
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }
    public function change()
    {
        $acpcode = isset($this->action[3]) ? $this->action[3] : false;
        if ($acpcode) {
            $cons = array('fields' => 'acpcode=?', 'values' => array($acpcode));
            $acl = $this->model()->select()->from('acl')->where($cons)->fetchAll();
            if ($acl) {
                foreach ($acl as $key => $val) {
                    $data = array('acpcode' => $val['acpcode'], 'gateway' => $val['gateway']);
                    $cons = array('fields' => 'acwid=?', 'values' => array($val['acwid']));
                    $this->model()->from('acc')->updateSet($data)->where($cons)->update();
                }
            }
        }
        $this->res->redirect($this->dir . 'acc');
    }
    public function getAcl()
    {
        $acpcode = $this->req->post('acpcode');
        $data = $this->model()->select('a.gateway,b.name')->left('acw b')->on('a.acwid=b.id')->join()->from('acl a')->where(array('fields' => 'a.acpcode=?', 'values' => array($acpcode)))->fetchAll();
        $str = '';
        if ($data) {
            foreach ($data as $key => $val) {
                $str .= '<option value="' . $val['gateway'] . '">' . $val['name'] . '</option>';
            }
        }
        echo $str;
    }
}