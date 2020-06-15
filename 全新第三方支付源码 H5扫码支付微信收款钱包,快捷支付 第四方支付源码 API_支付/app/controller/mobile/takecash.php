<?php

namespace WY\app\controller\mobile;

use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class takecash extends CheckUser
{
    function __construct()
    {
        parent::__construct();
        $this->bill = new Bill();
			 if ($this->userData['is_verify_phone']==0) 
			 {
			             $this->put('woodyapp.php', array('msg' => '请绑定手机号码后操作提现'));
						    exit;
					 }	 
			 
        if (!$this->config['tx_state']) {
            $this->put('woodyapp.php', array('msg' => '平台提现功能暂时关闭'));
            exit;
        }
        if (!$this->userData['is_takecash']) {
            $this->put('woodyapp.php', array('msg' => '您的账号未开通提现功能'));
            exit;
        }
        if (date('H') < $this->config['tx_ftime'] || date('H') > $this->config['tx_etime']) {
            $this->put('woodyapp.php', array('msg' => $this->config['tx_closetip']));
            exit;
        }
        // if ($this->model()->select()->from('payments')->where(array('fields' => 'userid=? and ship_type=? and addtime>=? and addtime<?', 'values' => array($_SESSION['login_userid'], 1, strtotime(date('Y-m-d')), time())))->count() >= $this->config['tx_timelimit']) {
            // $this->put('woodyapp.php', array('msg' => $this->config['tx_limittip']));
            // exit;
        // }
        if ($this->userData['ship_cycle'] > 0) {
            $fromTime = strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24 * $this->userData['ship_cycle'];
        } else {
            $fromTime = strtotime(date('Y-m-d H:i'));
        }
        $income = $this->bill->getUserIncome($_SESSION['login_userid'], $fromTime);
        $newMoney = $this->userData['unpaid'];
        if ($income > 0) {
            $newMoney += $income;
            $data = array('unpaid' => $newMoney);
            if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($_SESSION['login_userid'])))->update()) {
                $where = array('fields' => 'userid=? and is_state=? and is_ship=? and addtime<=?', 'values' => array($_SESSION['login_userid'], 1, 0, $fromTime));
                $this->model()->from('orders')->updateSet(array('is_ship' => 1))->where($where)->update();
                $data = array('userid' => $_SESSION['login_userid'], 'is_agent' => 0, 'before_money' => $this->userData['unpaid'], 'money' => $income, 'after_money' => $newMoney, 'ctype' => '提现', 'addtime' => time());
                $this->model()->from('paylogs')->insertData($data)->insert();
            }
        }
        $this->unpaid = $newMoney;
        if ($newMoney < $this->config['tx_minmoney']) {
            $this->put('woodyapp.php', array('msg' => '您的账号余额不足，暂无法使用提现。当前系统最低提现额为：' . $this->config['tx_minmoney'] . '元'));
            exit;
        }
    }
    public function index()
    {
        $newMoney = $this->unpaid;
        $today_income = $this->bill->todayUserIncome($_SESSION['login_userid'], 0);
        $income = $this->bill->beforeUserIncome($_SESSION['login_userid'], 0);
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchRow();
        $usercfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchAll();
        $data = array('title' => '申请提现', 'income' => $today_income + $income, 'money' => $newMoney, 'fee' => $this->bill->fee($newMoney), 'userinfo' => $userinfo, 'usercfo' => $usercfo);
        $this->put('takecash.php', $data);
    }
    public function submit()
    {
        $txmoney = $this->req->post('txmoney');
        $ptype = $this->req->post('ptype');
        $cfoid = $this->req->post('cfoid');
		$Code= $this->req->post('verifycode');    //add
				if(strlen($Code)>1 and $Code!=$_SESSION["code"]){   //add
			echo json_encode(array('status' => 0, 'msg' => '验证码不正确！'));
            exit;
		}else{
		
		}
        if ($txmoney <= 0) {
            echo json_encode(array('status' => 0, 'msg' => '参数错误'));
            exit;
        }
        if ($txmoney < $this->config['tx_minmoney']) {
            $this->put('woodyapp.php', array('msg' => '当前系统最低提现额为：' . $this->config['tx_minmoney'] . '元'));
            exit;
        }
        if ($ptype == '1' and $cfoid == '') {
            echo json_encode(array('status' => 0, 'msg' => '代收银行信息不能为空'));
            exit;
        }
        if ($txmoney > $this->userData['unpaid']) {
            echo json_encode(array('status' => 0, 'msg' => '账户余额不足'));
            exit;
        }
        if ($cfoid && !($cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $cfoid)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '代收银行信息不存在'));
            exit;
        }
        $newMoney = $this->userData['unpaid'] - $txmoney;
        $data = array('paid' => $this->userData['paid'] + $txmoney, 'unpaid' => $newMoney);
        if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($this->userData['id'])))->update()) {
            $data = array('userid' => $this->userData['id'], 'is_agent' => 0, 'before_money' => $this->userData['unpaid'], 'money' => $txmoney, 'after_money' => $newMoney, 'ctype' => '提现', 'addtime' => time());
            $this->model()->from('paylogs')->insertData($data)->insert();
            if ($ptype == '0') {
                $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchRow();
                $realname = $userinfo['realname'];
                $batype = $userinfo['batype'];
                $baname = $userinfo['baname'];
				   $baaddr = $userinfo['baaddr'];
            } else {
                $realname = $cfo['accountname'];
				  $batype = $cfo['bankname'];
               // $batype = $this->setConfig->cfoBank($cfo['bankname']);
                $baname = $cfo['cardno'];
				$baaddr =$cfo['provice'].$cfo['city'].$cfo['branchname'];
			
            }
            $data = array('userid' => $this->userData['id'], 'money' => $txmoney, 'addtime' => time(), 'lastime' => time(), 'sn' => 'b' . time(), 'fee' => $this->bill->fee($txmoney), 'ptype' => $ptype, 'cfoid' => $ptype ? $cfoid : 0, 'ship_type' => 1, 'realname' => $realname, 'batype' => $batype, 'baname' => $baname, 'baaddr' => $baaddr);
            $this->model()->from('payments')->insertData($data)->insert();
	  echo json_encode(array('status' => 1, 'msg' => '申请提现成功', 'url' => '/member/payments'));

$sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
   $phone='18676665154';
	 $smsConf = array(
    'key'   => 'eb776c91955412a128177b0e06490438', //您申请的APPKEY
	 'mobile'    => $phone, //接受短信的用户手机号码
    'tpl_id'    => '37792', //您申请的短信模板ID，根据实际情况修改
 'tpl_value' =>'#username#='.$realname.'&#userid#='.$this->userData['id'].'&#money#='. $txmoney,//您设置的模板变量，根据实际情况修改
 //'tpl_value' =>'#username#=123&#userid#=10000&#money#=123',//您设置的模板变量，根据实际情况修改
);

  $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信
  
			unset($_SESSION['code']);
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '申请提现失败'));
			
    }
    public function getFee()
    {
        $money = $this->req->post('money');
        echo $this->bill->fee($money);
    }
	public function submit1(){ 
		$cfoid=$this->req->post('bankid');
		$txmoney=$this->req->post('txmoney');
		$ptype='1';
		if ($txmoney <= 0) {
            echo json_encode(array('status' => 0, 'msg' => '参数错误'));
            exit;
        }
        if ($txmoney < $this->config['tx_minmoney']) {
            $this->put('woodyapp.php', array('msg' => '当前系统最低提现额为：' . $this->config['tx_minmoney'] . '元'));
            exit;
        }
        if ($ptype == '1' and $cfoid == '') {
            echo json_encode(array('status' => 0, 'msg' => '代收银行信息不能为空'));
            exit;
        }
        if ($txmoney > $this->userData['unpaid']) {
            echo json_encode(array('status' => 0, 'msg' => '账户余额不足'));
            exit;
        }
        if ($cfoid && !($cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $cfoid)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '代收银行信息不存在'));
            exit;
        }
		if ($cfoid && !($cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'userid=? and id=?', 'values' => array($this->userData['id'], $cfoid)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '代收银行信息不存在'));
            exit;
        }
		$newMoney = $this->userData['unpaid'] - $txmoney;
        $data = array('paid' => $this->userData['paid'] + $txmoney, 'unpaid' => $newMoney);
		if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($this->userData['id'])))->update()) {
            $data = array('userid' => $this->userData['id'], 'is_agent' => 0, 'before_money' => $this->userData['unpaid'], 'money' => $txmoney, 'after_money' => $newMoney, 'ctype' => '提现', 'addtime' => time());
            $this->model()->from('paylogs')->insertData($data)->insert();
            if ($ptype == '0') {
                $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchRow();
                $realname = $userinfo['realname'];
                $batype = $userinfo['batype'];
                $baname = $userinfo['baname'];
				   $baaddr = $userinfo['baaddr'];
            } else {
                $realname = $cfo['accountname'];
				  $batype = $cfo['bankname'];
               // $batype = $this->setConfig->cfoBank($cfo['bankname']);
                $baname = $cfo['cardno'];
				$baaddr =$cfo['provice'].$cfo['city'].$cfo['branchname'];
			
            }
			$data = array('userid' => $this->userData['id'], 'money' => $txmoney, 'addtime' => time(), 'lastime' => time(), 'sn' => 'b' . time(), 'fee' => $this->bill->fee($txmoney), 'ptype' => $ptype, 'cfoid' => $ptype ? $cfoid : 0, 'ship_type' => 1, 'realname' => $realname, 'batype' => $batype, 'baname' => $baname, 'baaddr' => $baaddr);
            $this->model()->from('payments')->insertData($data)->insert();
			echo json_encode(array('status' => 1, 'msg' => '申请提现成功', 'url' => '/mobile/takecash'));
			exit;
		}
		echo json_encode(array('status' => 0, 'msg' => '申请提现失败'));
	}
    public  function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}
   
	
}