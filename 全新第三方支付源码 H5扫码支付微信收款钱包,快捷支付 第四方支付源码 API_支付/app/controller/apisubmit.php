<?php
namespace WY\app\controller;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class apisubmit extends api
{
    public function index()
    {
	
        extract($this->params);
        if ($this->userData['is_verify_siteurl']) {
            $fromurl = $fromurl ? $fromurl : $this->req->server('HTTP_REFERER');
            $userinfo = $this->model()->select('siteurl')->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($this->userData['id'])))->fetchRow();


            if ($fromurl == '' || !strpos($fromurl, $userinfo['siteurl'])) {
                echo $this->ret->put('206', $cardnum ? true : false);
                exit;
            }
        }
        $signStr = 'version=' . $version . '&customerid=' . $customerid . '&total_fee=' . $total_fee . '&sdorderno=' . $sdorderno . '&notifyurl=' . $notifyurl . '&returnurl=' . $returnurl . '&' . $this->userData['apikey'];


        $mysign = md5($signStr);
        if ($sign != $mysign) {
            echo $this->ret->put('201', $cardnum ? true : false);
            exit;
        }
        switch ($paytype) {
            case 'bank':
			case 'qq':
            case 'alipay':
            case 'tenpay':
            case 'weixin':
            case 'qqrcode':
            case 'tenpaywap':
            case 'alipaywap':
            case 'wxh5':
			case 'Wxh5':
            case 'qqwallet':
            case 'gzhpay':
			case 'yinlian':
			case 'quickbank':
			case 'quickwap':
			case 'jdpay':
                $this->submit();
                break;
            default:
                echo $this->ret->put('106', $cardnum ? true : false);
                exit;
        }
    }
    protected function submit()
    {

        extract($this->params);
        $bankcode = $paytype == 'bank' ? $bankcode : $paytype;
        if ($this->model()->select()->from('orders')->where(array('fields' => 'userid=? and sdorderno=?', 'values' => array($this->userData['id'], $sdorderno)))->count()) {
            echo $this->ret->put('205', $cardnum ? true : false);
            exit;
        }
        $acw = $this->model()->select('id')->from('acw')->where(array('fields' => 'code=?', 'values' => array($paytype)))->fetchRow();
        if (!$acw) {
            echo $this->ret->put('500', $cardnum ? true : false);
            exit;
        }
		
        /*$acc=$this->model()->select()->from('acc')->where(array('fields'=>'acwid=? and is_state=?','values'=>array($acw['id'],0)))->fetchAll();if(!$acc){echo $this->ret->put('103',$cardnum ? true : false);exit;}$userprice=$this->model()->select()->from('userprice')->where(array('fields'=>' userid=?','values'=>array($customerid)))->fetchAll();if(!$userprice){echo $this->ret->put('101',$cardnum ? true : false);exit;}$is_state=$channelid=$acpcode=$gateway=$is_state_acc='';foreach($userprice as $key=>$val){foreach($acc as $key2=>$val2){if($val['channelid']==$val2['id']){$is_state=$val['is_state'];$channelid=$val['channelid'];$acpcode=$val2['acpcode'];$gateway=$val2['gateway'];$is_state_acc=$val2['is_state'];break;}}}if($acpcode=='' || $gateway==''){echo $this->ret->put('103',$cardnum ? true : false);exit;}if($is_state=='1'){echo $this->ret->put('100',$cardnum ? true : false);exit;}if($is_state_acc=='1'){echo $this->ret->put('102',$cardnum ? true : false);exit;}*/
        
		
		
		
		
		
		
		
		$acc = $this->model()->select('a.id,a.acpcode,a.gateway,a.is_state,b.is_state as is_state_acc,b.channelid')->from('acc a')->left('userprice b')->on('b.channelid=a.id')->join()->where(array('fields' => 'b.userid=? and a.acwid=?', 'values' => array($customerid, $acw['id'])))->fetchRow();




        if (!$acc) {
            echo $this->ret->put('103', $cardnum ? true : false);
            exit;
        }
        if ($acc['is_state'] == '1') {
			
            echo $this->ret->put('100', $cardnum ? true : false);
            exit;
        }
        if ($acc['is_state_acc'] == '1') {
            echo $this->ret->put('102', $cardnum ? true : false);
            exit;
        }
        $channelid = $acc['channelid'];
        $acpcode = $acc['acpcode'];
        $gateway = $acc['gateway'];
        $orderid = $this->res->getOrderID();
        $addtime = time();
        $orderinfo = array('userid' => $customerid, 'paytype' => $paytype, 'bankcode' => $bankcode, 'notifyurl' => $notifyurl, 'returnurl' => $returnurl, 'remark' => $remark, 'addtime' => $addtime);
        if (!($orderinfoid = $this->model()->from('orderinfo')->insertData($orderinfo)->insert())) {
            echo $this->ret->put('209', $cardnum ? true : false);
            exit;
        }
        $orderdata = array('userid' => $customerid, 'agentid' => $this->userData['superid'], 'orderid' => $orderid, 'sdorderno' => $sdorderno, 'total_fee' => $total_fee, 'channelid' => $channelid, 'addtime' => $addtime, 'lastime' => $addtime, 'is_paytype' => 0, 'orderinfoid' => $orderinfoid);
        if (!($orid = $this->model()->from('orders')->insertData($orderdata)->insert())) {
            echo $this->ret->put('210', $cardnum ? true : false);
            exit;
        }
        $ordernotify = array('orid' => $orid, 'addtime' => $addtime);
        if (!$this->model()->from('ordernotify')->insertData($ordernotify)->insert()) {
            echo $this->ret->put('211', $cardnum ? true : false);
            exit;
        }
        $url = 'http://' . $this->req->server('HTTP_HOST') . '/pay/' . $acpcode . '_' . $gateway . '/send.php';
        $url .= '?orderid=' . $orderid . '&price=' . $total_fee . '&bankcode=' . $bankcode . '&remark=' . $remark;
        $this->res->redirect($url);
    }
}
?>
