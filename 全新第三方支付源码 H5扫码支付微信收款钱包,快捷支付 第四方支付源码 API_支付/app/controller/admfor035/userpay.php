<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\model\Paybank;
if (!defined('WY_ROOT')) {
    exit;
}
class userpay extends CheckAdmin
{
    public function index()
    {
        $kw = $this->req->get('kw');
        $fdate = $this->req->get('fdate');
        $tdate = $this->req->get('tdate');
        $is_state = $this->req->get('is_state');
        $is_state = isset($_GET['is_state']) ? $is_state : -1;
        $cons = 'is_agent=?';
        $consOR = '';
        $consArr = array(0);
        if ($kw) {
            $users = $this->model()->select('id')->from('users')->where(array('fields' => 'username like ?', 'values' => array('%' . $kw . '%')))->fetchRow();
            if ($users) {
                $consOR .= $consOR ? ' or ' : '';
                $consOR .= 'userid = ?';
                $consArr[] = $users['id'];
            }
        }
        if ($is_state >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'is_state=?';
            $consArr[] = $is_state;
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'userid = ?';
            $consArr[] = $kw;
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'sn = ?';
            $consArr[] = $kw;
        }
        if ($fdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime>=?';
            $consArr[] = strtotime($fdate);
        }
        if ($tdate) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'addtime<=?';
            $consArr[] = strtotime($tdate . ' 23:59:59');
        }
        if ($consOR) {
            $cons .= $cons ? ' and ' : '';
            $cons .= '(' . $consOR . ')';
        }
        $orderby = 'id desc';
        $sort = $this->req->get('sort');
        $sort = isset($_GET['sort']) ? $sort : 0;
        $by = $this->req->get('by');
        if ($by) {
            $sort2 = $sort ? ' desc' : ' asc';
            $orderby = $by . $sort2;
        }
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 15;
        $totalsize = $this->model()->select()->from('payments')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select()->from('payments')->offset($offset)->limit($pagesize)->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?is_state=' . $is_state . '&kw=' . $kw . '&fdate=' . $fdate . '&tdate=' . $tdate . '&sort=' . $sort . '&by=' . $by . '&p='));
        $data = array('title' => '付款记录', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('kw' => $kw, 'fdate' => $fdate, 'tdate' => $fdate, 'is_state' => $is_state), 'sort' => $sort, 'by' => $by);
        $this->put('payments.php', $data);
    }
    public function pay()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('payments')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
 
		$this->put('paymentsinfo.php', $data);
		
    }
    public function savepay()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($id && $data && $data['is_state'] == '1') {
            $payments = $this->model()->select()->from('payments')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
            $resCode = '';
            if ($payments['retmsg']) {
                $ret = json_decode($payments['retmsg'], true);
                $resCode = $ret['resCode'];
            }
            if ($data['ptype'] == '1' && $resCode != '0000') {
                $cfo = $this->model()->select()->from('cfo')->where(array('fields' => 'id=?', 'values' => array($data['cfoid'])))->fetchRow();
                if ($cfo) {
                    $money = number_format($data['money'] - $data['fee'], 2, '.', '');
                    $cfo += array('sn' => 'b' . time() + mt_rand(1000, 9999), 'money' => $money);
                    $paybank = new Paybank();
                    $ret = $paybank->put($cfo);
                    $this->model()->from('payments')->updateSet(array('retmsg' => json_encode($ret)))->where(array('fields' => 'id=?', 'values' => array($id)))->update();
                    if ($ret['resCode'] != '0000') {
                        $this->put('woodyapp.php', array('msg' => '代付接口返回：' . $ret['resContent'], 'url' => $this->dir . 'userpay'));
                        exit;
                    }
                }
            }
        }
        $data += array('lastime' => time());
        if ($this->model()->from('payments')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
            $this->put('woodyapp.php', array('msg' => '账单信息已保存成功', 'url' => $this->dir . 'userpay'));
        }
        $this->put('woodyapp.php', array('msg' => '账单信息已保存失败', 'url' => $this->dir . 'userpay'));
    }
    public function upset()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $this->model()->from('payments')->updateSet(array('is_state' => 1))->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        $this->res->redirect($this->req->server('HTTP_REFERER'));
    }
}