<?php

namespace WY\app\controller\mobile;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class userinfo extends CheckUser
{
    public function index()
    {
       $where = array('fields' => 'id=?', 'values' => array($_SESSION['login_userid']));
		$users = $this->model()->select()->from('users')->where($where)->fetchRow();
		$where = array('fields' => 'userid=?', 'values' => array($_SESSION['login_userid']));
        $userinfo = $this->model()->select()->from('userinfo')->where($where)->fetchRow();
        $data = array('title' => '基本资料', 'userinfo' => $userinfo, 'users' => $users);
		$this->put('userinfo.php', $data);
	
    }
    public function editsave()
    {
	
// if ($this->userData['is_state'] == '1') {
 //	//add
//	if ($this->userData['is_verify_phone'] == '0') { //未认证
//	echo json_encode(array('status' => 0, 'msg' => '手机号码未验证，请先认证手机号码后修改资料'));		
//		  exit;
//		  }
  
   //    }
	   
	   
        $data = isset($_POST) ? $_POST : false;
	       
        if (!$data) {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
			         echo json_encode(array('status' => 0, 'msg' => $data));
            exit;
        }
        foreach ($data as $key => $val) {
            $data[$key] = $this->req->post($key);
		
		    }
			//	unset($data[verifycode]);
	//add
		$Code=$data['verifycode'];
	if ($this->userData['is_verify_phone'] == '1') { //是否认证
			if ($data['phone'] == '' ){			
			$data['phone'] = $this->userInfo['phone'];
						}
						
		if(strlen($Code)>1 and $Code!=$_SESSION["code"]){
		
					echo json_encode(array('status' => 0, 'msg' => '验证码不正确！'));
            exit;
		}else{
			unset($data[verifycode],$_SESSION['code']);
		}
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
			if (preg_match('/http[s]?:\\/\\/(.*)/', $data['siteurl'], $match)) {
				$data['siteurl'] = $match[1];
			}
	


			if ($this->model()->from('userinfo')->updateSet($data)->where(array('fields' => 'userid=?', 'values' => array($_SESSION['login_userid'])))->update()) {
				echo json_encode(array('status' => 1, 'msg' => '修改已保存'));
				exit;
			}
			
		
			echo json_encode(array('status' => 0, 'msg' => '保存失败或无更改'));
			exit;	
        
    }
	
   public function addsms()
   {
       $where = array('fields' => 'id=?', 'values' => array($_SESSION['login_userid']));
		$users = $this->model()->select()->from('users')->where($where)->fetchRow();
		$where = array('fields' => 'userid=?', 'values' => array($_SESSION['login_userid']));
        $userinfo = $this->model()->select()->from('userinfo')->where($where)->fetchRow();
        $data = array('title' => '手机验证', 'userinfo' => $userinfo, 'users' => $users);
		$this->put('addsms.php', $data);
    }
	  public function savesms()
    {

		$Code=$this->req->post('verifycode');

		if(strlen($Code)>1 and $Code==$_SESSION["code"]){

		$data = array('is_verify_phone' => 1);

  if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($this->userData['id'])))->update()) {
         	print( "<script>alert('验证成功') window.history.back();</script>");
            exit;
        }
			}else{
		print( "<script>alert('验证码不正确');window.history.back();  </script>");
           
            exit;
			}
		unset($_SESSION['code']);



       
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
        if ($bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('userid' => $this->userData['id'], 'bankname' => $bankname, 'provice' => str_replace('省', '', $provice), 'city' => str_replace('市', '', $city), 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno, 'addtime' => time());
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
        if ($id == '' && $bankname == '' || $provice == '' || $city == '' || $branchname == '' || $accountname == '' || $cardno == '') {
            echo json_encode(array('status' => 0));
            exit;
        }
        $data = array('bankname' => $bankname, 'provice' => str_replace('省', '', $provice), 'city' => str_replace('市', '', $city), 'branchname' => $branchname, 'accountname' => $accountname, 'cardno' => $cardno);
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
                $str .= '<p class="c' . $val['id'] . '"><label><input type="radio" name="cfoid" value="' . $val['id'] . '">&nbsp;' . $val['bankname'] . '/' . $val['cardno'] . '</label>&nbsp&nbsp;<a href="javascript:;" alt="编辑" onclick="showContent(\'编辑代收银行\',\'/member/userinfo/editcfo/' . $val['id'] . '\')" style="font-size:12px"><span class="fa fa-pencil-square-o"></span></a>&nbsp;<a href="javascript:;" alt="删除" onclick="del(' . $val['id'] . ')" style="font-size:12px"><span class="fa fa-trash"></span></a></p>';
            }
        }
        echo $str;
    }
}