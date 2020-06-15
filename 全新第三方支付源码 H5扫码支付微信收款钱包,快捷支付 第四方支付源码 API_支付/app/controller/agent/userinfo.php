<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class userinfo extends CheckUser
{
    public function index()
    {
        $where = array('fields' => 'userid=?', 'values' => array($_SESSION['login_agentid']));
        $userinfo = $this->model()->select()->from('userinfo')->where($where)->fetchRow();
        $data = array('title' => '基本资料', 'userinfo' => $userinfo);
        $this->put('userinfo.php', $data);
    }
    public function editsave()
    {
        if ($this->userData['is_state'] == '1') {
            echo json_encode(array('status' => 0, 'msg' => '已开通的账号若要修改资料，请联系客服'));
            exit;
        }
        $data = isset($_POST) ? $_POST : false;
        if (!$data) {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        foreach ($data as $key => $val) {
            $data[$key] = $this->req->post($key);
        }
        if ($data['phone'] == '' || $data['qq'] == '' || $data['realname'] == '' || $data['idcard'] == '' || $data['batype'] == '' || $data['baname'] == '' || $data['baaddr'] == '' || $data['sitename'] == '' || $data['siteurl'] == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        if (!preg_match('/\\d{11}/', $data['phone'])) {
            echo json_encode(array('status' => 0, 'msg' => '手机号码格式错误'));
            exit;
        }
        if (!preg_match('/\\d{5,12}/', $data['qq'])) {
            echo json_encode(array('status' => 0, 'msg' => 'QQ号码格式错误'));
            exit;
        }
        if (!preg_match('/[0-9X]{18}/', $data['idcard'])) {
            echo json_encode(array('status' => 0, 'msg' => '身份证号码格式错误'));
            exit;
        }
        $data['siteurl'] = str_replace('http://', '', $data['siteurl']);
        $data['siteurl'] = str_replace('http://', '', $data['siteurl']);
        $data['siteurl'] = str_replace('/', '', $data['siteurl']);
        if ($this->model()->from('userinfo')->updateSet($data)->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_agentid'])))->update()) {
            echo json_encode(array('status' => 1, 'msg' => '修改已保存，等待审核'));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '保存失败'));
        exit;
    }
    public function addcfo()
    {
        $this->put('addcfo.php', array());
    }
    public function savecfo()
    {
        $bankname = $this->req->post('bankname');
        $provice = $this->req->post('provice');
        $city = $this->req->post('city');
        $branchname = $this->req->post('branchname');
        $accountname = $this->req->post('accountname');
        $cardno = $this->req->post('cardno');
		$sfz = $this->req->post('sfz');
		$shouji = $this->req->post('shouji');
        if ($bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '' || $sfz == '' || $shouji == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('userid' => $this->userData['id'], 'bankname' => $bankname, 'sfz' => $sfz, 'shouji' => $shouji, 'provice' => $provice, 'city' => $city, 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno, 'addtime' => time());
        if ($this->model()->from('cfo')->insertData($data)->insert()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
    }
    public function editcfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        if ($id && ($cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $id)))->fetchRow())) {
            $this->put('editcfo.php', $cfo);
            exit;
        }
        $this->put('woodyapp.php', array('msg' => '出现错误'));
    }
    public function editsavecfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $bankname = $this->req->post('bankname');
        $provice = $this->req->post('provice');
        $city = $this->req->post('city');
        $branchname = $this->req->post('branchname');
        $accountname = $this->req->post('accountname');
        $cardno = $this->req->post('cardno');
		$sfz = $this->req->post('sfz');
		$shouji = $this->req->post('shouji');
        if ($id == '' && $bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '' || $sfz == '' || $shouji == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('bankname' => $bankname, 'sfz' => $sfz, 'shouji' => $shouji,  'provice' => $provice, 'city' => $city, 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno);
        if ($this->model()->from('cfo')->updateSet($data)->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $id)))->update()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
    }
    public function delcfo()
    {
        $id = intval($this->req->post('id'));
        if ($id && $this->model()->from('cfo')->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $id)))->delete()) {
            echo json_encode(array('status' => 1));
            exit;
        }
        echo json_encode(array('status' => 0));
    }
    public function getCfo()
    {
        $str = '';
        $cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchAll();
        if ($cfo) {
            foreach ($cfo as $key => $val) {
                $str .= '<p class="c' . $val['id'] . '"><label><input type="radio" name="cfoid" value="' . $val['id'] . '">&nbsp;' . $val['bankname'] . '/' . $val['cardno'] . '</label>&nbsp&nbsp;<a href="javascript:;" onclick="showContent(\'编辑代收银行\',\'/member/userinfo/editcfo/' . $val['id'] . '\')" style="font-size:12px"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="javascript:;" onclick="del(' . $val['id'] . ')" style="font-size:12px"><span class="glyphicon glyphicon-trash"></span></a></p>';
            }
        }
        echo $str;
    }
}