<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
use WY\app\libs\Http;
use WY\app\model\Pushorder;
use WY\app\model\Checkacc;
if (!defined('WY_ROOT')) {
    exit;
}
class checkout extends Controller
{
    public $paytpe = '';
    public $bankcode = '';
    public $sign = '';
    public $orders = '';
    function __construct()
    {
        parent::__construct();
        if ($this->config['is_checkout_state'] == 1) {
            $this->put('retmsg.php', array('msg' => '收银台暂时关闭，请联系客服！'));
            exit;
        }
        if ($this->config['is_checkout_jump'] && $this->config['checkout_jump_url'] && $this->config['checkout_jump_url'] != $this->req->server('HTTP_HOST') && isset($_REQUEST)) {
            $urlstr = '';
            foreach ($_REQUEST as $key => $val) {
                $urlstr .= $urlstr ? '&' : '';
                $urlstr .= $key . '=' . $val;
            }
            header('location:http://' . $this->config['checkout_jump_url'] . '/checkout?' . $urlstr);
            exit;
        }
        $this->checkacc = new Checkacc();
    }
    public function index()
    {
        $version = '1.0';
        $customerid = $this->req->request('customerid');
        $sdorderno = $this->req->request('sdorderno');
        $total_fee = $this->req->request('total_fee');
        $notifyurl = $this->req->request('notifyurl');
        $returnurl = $this->req->request('returnurl');
        $remark = $this->req->request('remark');
        $sign = $this->req->request('sign');
        if ($version == '' || $customerid == '' || $sdorderno == '' || $total_fee == '' || $notifyurl == '' || $returnurl == '' || $sign == '') {
            $ret['code'] = '200';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (strlen($sdorderno) > 50) {
            $ret['code'] = '203';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
//        if ($total_fee > 5000) {
//            $ret['code'] = '207';
//            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
//            $this->put('retmsg.php', $ret);
//            exit;
//        }
        if ($remark && strlen($remark) > 50) {
            $ret['code'] = '204';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $userData = $this->model()->select()->from('users')->where(array('fields' => 'id=?', 'values' => array($customerid)))->fetchRow();
        if (!$userData) {
            $ret['code'] = '001';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($userData['is_state'] == '0') {
            $ret['code'] = '002';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($userData['is_state'] == '2') {
            $ret['code'] = '003';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (!$userData['is_checkout']) {
            $ret['code'] = '105';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($userData['is_verify_siteurl']) {


            $userInfo = $this->model()->select('siteurl')->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($customerid)))->fetchRow();
            if ($userInfo) {
                $fromUrl = $this->req->server('HTTP_REFERER');
                if (strpos($fromUrl, $userInfo['siteurl']) === false) {
                    $ret['code'] = '206';
                    $ret['msg'] = $this->setConfig->retMsg($ret['code']);
                    $this->put('retmsg.php', $ret);
                    exit;
                }
            }
        }
        $total_fee = number_format($total_fee, 2, '.', '');
        $signStr = 'version=' . $version . '&customerid=' . $customerid . '&total_fee=' . $total_fee . '&sdorderno=' . $sdorderno . '&notifyurl=' . $notifyurl . '&returnurl=' . $returnurl . '&' . $userData['apikey'];
        $mysign = md5($signStr);
        if ($sign != $mysign) {
            $ret['code'] = '201';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($this->model()->select()->from('orders')->where(array('fields' => 'userid=? and sdorderno=?', 'values' => array($customerid, $sdorderno)))->count()) {
            $ret['code'] = '205';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $orderid = $this->res->getOrderID();
        $token = sha1($this->res->getRandomString(40));
        $addtime = time();
        $orderinfo = array('userid' => $customerid, 'notifyurl' => $notifyurl, 'returnurl' => $returnurl, 'remark' => $remark, 'addtime' => $addtime);
        if (!($orderinfoid = $this->model()->from('orderinfo')->insertData($orderinfo)->insert())) {
            $ret['code'] = '209';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $orderdata = array('userid' => $customerid, 'agentid' => $userData['superid'], 'orderid' => $orderid, 'sdorderno' => $sdorderno, 'total_fee' => $total_fee, 'addtime' => $addtime, 'lastime' => $addtime, 'is_paytype' => 1, 'orderinfoid' => $orderinfoid);
        if (!($orid = $this->model()->from('orders')->insertData($orderdata)->insert())) {
            $ret['code'] = '210';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $ordernotify = array('orid' => $orid, 'addtime' => $addtime);
        if (!$this->model()->from('ordernotify')->insertData($ordernotify)->insert()) {
            $ret['code'] = '211';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (!$this->model()->from('checkout')->insertData(array('orid' => $orid, 'token' => $token))->insert()) {
            $ret['code'] = '212';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $this->res->redirect('/checkout/pay?sign=' . $token);
    }
    public function pay()
    {
        $sign = $this->req->get('sign');
        if ($sign == '' || !($checkout = $this->model()->select()->from('checkout')->where(array('fields' => 'token=?', 'values' => array($sign)))->fetchRow())) {
            $ret['code'] = '213';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (!($orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->fetchRow())) {
            $ret['code'] = '214';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '1') {
            $ret['code'] = '215';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '3') {
            $ret['code'] = '216';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '0' && time() - $orders['addtime'] >= 60 * 30) {
            $this->model()->from('orders')->updateSet(array('is_state' => 3))->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->update();
            $ret['code'] = '217';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $orderinfo = $this->model()->select()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->fetchRow();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($orders['userid'])))->fetchRow();
        $banklist = $this->model()->select()->from('acb')->where(array('fields' => 'is_state=?', 'values' => array(0)))->fetchAll();
        $cardlist = array();
        $acc = $this->model()->select('acwid,id,gateway')->from('acc')->where(array('fields' => 'is_state=? and is_card=?', 'values' => array(0, 1)))->fetchAll();
        if ($acc) {
            $userprice = $this->model()->select('channelid')->from('userprice')->where(array('fields' => 'userid=? and is_state=?', 'values' => array($orders['userid'], 0)))->fetchAll();
            foreach ($acc as $key => $val) {
                foreach ($userprice as $key2 => $val2) {
                    if ($val['id'] == $val2['channelid']) {
                        $cardlist[] = array('acwid' => $val['acwid'], 'gateway' => $val['gateway']);
                    }
                }
            }
            $acw = $this->model()->select()->from('acw')->where(array('fields' => 'price<>?', 'values' => array('')))->fetchAll();
            if ($cardlist && $acw) {
                foreach ($cardlist as $key => $val) {
                    foreach ($acw as $key2 => $val2) {
                        if ($val['acwid'] == $val2['id']) {
                            $cardlist[$key]['img'] = $val2['img'];
                        }
                    }
                }
            }
        }
        $data = array('title' => '收银台', 'userinfo' => $userinfo, 'banklist' => $banklist, 'cardlist' => $cardlist, 'orders' => $orders, 'orderinfo' => $orderinfo, 'token' => $sign);
        if ($this->res->isMobile()) {
            $this->put('checkoutwap.php', $data);
            exit;
        }
        $this->put('checkout.php', $data);
    }
	    public function is_weixin() { 
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) { 
        return true; 
    } return false; 
}
    public function subpay()
    {
        $sign = $this->req->get('sign');
        $paytype = $this->req->post('paytype');
        $bankcode = $this->req->post('bankcode');
        $bankcode = $paytype == 'bank' || $paytype == 'card' ? $bankcode : $paytype;
        if ($sign == '' || $paytype == '' || $bankcode == '') {
            $ret['code'] = '208';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }

        if (!($checkout = $this->model()->select()->from('checkout')->where(array('fields' => 'token=?', 'values' => array($sign)))->fetchRow())) {
            $ret['code'] = '213';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (!($orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->fetchRow())) {
            $ret['code'] = '214';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '1') {
            $ret['code'] = '215';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '3') {
            $ret['code'] = '216';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($orders['is_state'] == '0' && time() - $orders['addtime'] >= 60 * 30) {
            $this->model()->from('orders')->updateSet(array('is_state' => 3))->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->update();
            $ret['code'] = '217';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $this->orders = $orders;
        $this->paytype = $paytype;
        $this->bankcode = $bankcode;
        $this->sign = $sign;
        if ($paytype == 'card') {
            $this->card();
        } else {
            $this->uncard();
        }
    }
    public function card()
    {
        $acc = $this->model()->select()->from('acc')->where(array('fields' => 'gateway=?', 'values' => array($this->bankcode)))->fetchRow();
        if (!$acc) {
            $ret['code'] = '103';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($acc['is_state'] == '1') {
            $ret['code'] = '102';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $userprice = $this->model()->select()->from('userprice')->where(array('fields' => 'channelid=? and userid=?', 'values' => array($acc['id'], $this->orders['userid'])))->fetchRow();
        if (!$userprice) {
            $ret['code'] = '101';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($userprice['is_state'] == '1') {
            $ret['code'] = '100';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $this->model()->from('orders')->updateSet(array('channelid' => $acc['id']))->where(array('fields' => 'id=?', 'values' => array($this->orders['id'])))->update();
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->orders['userid'])))->fetchRow();
        $orderinfo = $this->model()->select()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($this->orders['orderinfoid'])))->fetchRow();
        $acw = $this->model()->select()->from('acw')->where(array('fields' => 'id=?', 'values' => array($acc['acwid'])))->fetchRow();
        $data = array('title' => '收银台', 'userinfo' => $userinfo, 'orderinfo' => $orderinfo, 'cardvalue' => json_decode($acw['price']), 'cardname' => $acw['name'], 'cardlength' => json_decode($acw['length']), 'orders' => $this->orders, 'token' => $this->sign, 'acc' => $acc);
        $this->put('cards.php', $data);
        exit;
    }
    private function uncard()
    {
        $acw = $this->model()->select()->from('acw')->where(array('fields' => 'code=?', 'values' => array($this->paytype)))->fetchRow();
        if (!$acw) {
            $ret['code'] = '500';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        /*$acc=$this->model()->select()->from('acc')->where(array('fields'=>'acwid=?','values'=>array($acw['id'])))->fetchAll();if(!$acc){$ret['code']='103';$ret['msg']=$this->setConfig->retMsg($ret['code']);$this->put('retmsg.php',$ret);exit;}$userprice=$this->model()->select()->from('userprice')->where(array('fields'=>'userid=?','values'=>array($this->orders['userid'])))->fetchAll();if(!$userprice){$ret['code']='101';$ret['msg']=$this->setConfig->retMsg($ret['code']);$this->put('retmsg.php',$ret);exit;}$is_state=$channelid=$acpcode=$gateway=$is_state_acc='';foreach($userprice as $key=>$val){foreach($acc as $key2=>$val2){if($val['channelid']==$val2['id']){$is_state=$val['is_state'];$channelid=$val['channelid'];$acpcode=$val2['acpcode'];$gateway=$val2['gateway'];$is_state_acc=$val2['is_state'];break;}}}if($acpcode=='' || $gateway==''){$ret['code']='103';$ret['msg']=$this->setConfig->retMsg($ret['code']);$this->put('retmsg.php',$ret);exit;}if($is_state=='1'){$ret['code']='100';$ret['msg']=$this->setConfig->retMsg($ret['code']);$this->put('retmsg.php',$ret);exit;}if($is_state_acc=='1'){$ret['code']='102';$ret['msg']=$this->setConfig->retMsg($ret['code']);$this->put('retmsg.php',$ret);exit;}*/
        $acc = $this->model()->select('a.id,a.acpcode,a.gateway,a.is_state,b.is_state as is_state_acc,b.channelid')->from('acc a')->left('userprice b')->on('b.channelid=a.id')->join()->where(array('fields' => 'b.userid=? and a.acwid=?', 'values' => array($this->orders['userid'], $acw['id'])))->fetchRow();
        if (!$acc) {
            $ret['code'] = '103';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($acc['is_state'] == '1') {
            $ret['code'] = '100';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if ($acc['is_state_acc'] == '1') {
            $ret['code'] = '102';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $channelid = $acc['channelid'];
        $acpcode = $acc['acpcode'];
        $gateway = $acc['gateway'];
        $data = array('channelid' => $acc['id']);
        $this->model()->from('orders')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($this->orders['id'])))->update();
        $data = array('paytype' => $this->paytype, 'bankcode' => $this->bankcode, 'faceno' => '', 'cardnum' => '', 'cardpwd' => '');
        $this->model()->from('orderinfo')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($this->orders['orderinfoid'])))->update();
        $orderinfo = $this->model()->select()->from('orderinfo')->where(array('fields' => 'id=?', 'values' => array($this->orders['orderinfoid'])))->fetchRow();
        $url = 'http://' . $this->req->server('HTTP_HOST') . '/pay/' . $acpcode . '_' . $gateway . '/send.php';
        $url .= '?orderid=' . $this->orders['orderid'] . '&price=' . $this->orders['total_fee'] . '&bankcode=' . $this->bankcode . '&remark=' . $orderinfo['remark'];
        $this->res->redirect($url);
    }
    public function cardpay()
    {
        $sign = $this->req->post('sign');
        $cardvalue = $this->req->post('cardvalue');
        $cardnum = $this->req->post('cardnum');
        $cardpwd = $this->req->post('cardpwd');
        $accid = $this->req->post('accid');
        if ($sign == '' || $cardvalue == '' || $cardnum == '' || $cardpwd == '' || $accid == '') {
            echo json_encode(array('status' => 0, 'msg' => '选项填写不完整'));
            exit;
        }
        if (!($checkout = $this->model()->select()->from('checkout')->where(array('fields' => 'token=?', 'values' => array($sign)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '订单不存在'));
            exit;
        }
        if (!($orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '订单不存在'));
            exit;
        }
        if ($cardvalue * 100 < $orders['total_fee'] * 100) {
            echo json_encode(array('status' => 0, 'msg' => '卡面值金额不能小于订单金额'));
            exit;
        }
        if (!($acc = $this->model()->select()->from('acc')->where(array('fields' => 'id=? and is_state=?', 'values' => array($accid, 0)))->fetchRow())) {
            echo json_encode(array('status' => 0, 'msg' => '点卡通道不存在'));
            exit;
        }
        $acw = $this->model()->select()->from('acw')->where(array('fields' => 'id=?', 'values' => array($acc['acwid'])))->fetchRow();
        if ($acw['length']) {
            $cardLength = json_decode($acw['length'], true);
            if (strlen($cardnum) != $cardLength[0]) {
                echo json_encode(array('status' => 0, 'msg' => '充值卡号长度应为' . $cardLength[0] . '位'));
                exit;
            }
            if (strlen($cardpwd) != $cardLength[1]) {
                echo json_encode(array('status' => 0, 'msg' => '充值卡密长度应为' . $cardLength[1] . '位'));
                exit;
            }
        }
        $data = array('channelid' => $acc['id']);
        $this->model()->from('orders')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($orders['id'])))->update();
        $data = array('paytype' => $acc['acpcode'], 'bankcode' => $acc['gateway'], 'cardnum' => $cardnum, 'cardpwd' => $cardpwd, 'faceno' => $cardvalue);
        $this->model()->from('orderinfo')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->update();
        $url = 'http://' . $this->req->server('HTTP_HOST') . '/pay/' . $acc['acpcode'] . '_card/';
        $submitUrl = $url . 'send.php';
        $returnUrl = $url . 'returnUrl.php';
        $params = array('orderid' => $orders['orderid'], 'price' => $orders['total_fee'], 'cardnum' => $cardnum, 'cardpwd' => $cardpwd, 'cardvalue' => $cardvalue, 'gateway' => $acc['gateway']);
        $http = new Http($submitUrl, $params);
        $http->toUrl();
        $content = $http->getResContent();
        $code = $http->getResCode();
        $errinfo = $http->getErrInfo();
        $data = array('code' => $code, 'content' => $this->res->subString($content, 0, 50), 'info' => $errinfo);
        $this->model()->from('orderinfo')->updateSet(array('retmsg' => json_encode($data)))->where(array('fields' => 'id=?', 'values' => array($orders['orderinfoid'])))->update();
        if ($content == 'ok') {
            echo json_encode(array('status' => 1, 'msg' => '充值卡已提交成功，请稍候查看支付结果', 'url' => $returnUrl . '?orderid=' . $orders['orderid']));
            exit;
        }
        echo json_encode(array('status' => 0, 'msg' => '' . $content));
    }
    public function payresult()
    {
        $sign = $this->req->get('sign');
        if ($sign == '' || !($checkout = $this->model()->select()->from('checkout')->where(array('fields' => 'token=?', 'values' => array($sign)))->fetchRow())) {
            $ret['code'] = '213';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        if (!($orders = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($checkout['orid'])))->fetchRow())) {
            $ret['code'] = '214';
            $ret['msg'] = $this->setConfig->retMsg($ret['code']);
            $this->put('retmsg.php', $ret);
            exit;
        }
        $push = new Pushorder($orders['orderid']);
        $push->sync();
    }
}