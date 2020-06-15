<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class agentship extends CheckAdmin
{
    public function index()
    {
        $kw = $this->req->get('kw');
        $cons = 'is_state=? and is_agent=?';
        $consOR = '';
        $consArr = array('1', 1);
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'username like ?';
            $consArr[] = '%' . $kw . '%';
        }
        if ($kw) {
            $consOR .= $consOR ? ' or ' : '';
            $consOR .= 'id = ?';
            $consArr[] = $kw;
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
        $pagesize = 20;
        $totalsize = $this->model()->select()->from('users')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select()->from('users')->offset($offset)->limit($pagesize)->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?kw=' . $kw . '&sort=' . $sort . '&by=' . $by . '&p='));
        $data = array('title' => '用户列表', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('kw' => $kw), 'sort' => $sort, 'by' => $by);
        $this->put('agentship.php', $data);
    }
    public function ship()
    {
        $bill = new Bill();
        $userid = isset($this->action[3]) ? $this->action[3] : 0;
        $users = $this->model()->select('unpaid')->from('users')->where(array('fields' => 'id=?', 'values' => array($userid)))->fetchRow();
        $newMoney = $users['unpaid'];
        $income = $bill->beforeAgentIncome($userid, 0);
        if ($income > 0) {
            $newMoney += $income;
            $data = array('unpaid' => $newMoney);
            if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($userid)))->update()) {
                $where = array('fields' => 'is_state=? and is_ship_agent=? and agentid=? and gprice>? and addtime<?', 'values' => array(1, 0, $userid, 0, strtotime(date('Y-m-d'))));
                $this->model()->from('orders')->updateSet(array('is_ship_agent' => 1))->where($where)->update();
                $data = array('userid' => $userid, 'is_agent' => 1, 'before_money' => $users['unpaid'], 'money' => $income, 'after_money' => $newMoney, 'ctype' => '结算', 'addtime' => time());
                $this->model()->from('paylogs')->insertData($data)->insert();
            }
        }
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($userid)))->fetchRow();
        $userinfo += array('money' => $newMoney, 'fee' => $bill->fee($newMoney));
        $this->put('agentshippay.php', $userinfo);
        exit;
    }
    public function savepay()
    {
        $userid = isset($this->action[3]) ? $this->action[3] : 0;
        $data = isset($_POST) ? $_POST : false;
        if (!$data || !$userid) {
            $this->put('woodyapp.php', array('msg' => '数据出现错误'));
            exit;
        }
        $users = $this->model()->select('paid,unpaid')->from('users')->where(array('fields' => 'id=?', 'values' => array($userid)))->fetchRow();
        if (!$users) {
            $this->put('woodyapp.php', array('msg' => '用户不存在'));
            exit;
        }
        if ($users['unpaid'] < $data['money'] || $data['money'] <= 0) {
            $this->put('woodyapp.php', array('msg' => '账户余额不足'));
            exit;
        }
        $data += array('addtime' => time(), 'lastime' => time(), 'userid' => $userid, 'is_agent' => 1);
        if ($this->model()->from('payments')->insertData($data)->insert()) {
            $newMoney = $users['unpaid'] - $data['money'];
            $data = array('userid' => $userid, 'is_agent' => 1, 'before_money' => $users['unpaid'], 'money' => $data['money'], 'after_money' => $newMoney, 'ctype' => '付款', 'addtime' => time());
            $this->model()->from('paylogs')->insertData($data)->insert();
            $newData = array('paid' => $users['paid'] + $data['money'], 'unpaid' => $newMoney);
            $this->model()->from('users')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($userid)))->update();
            $this->put('woodyapp.php', array('msg' => '付款记录已成功创建'));
            exit;
        }
        $this->put('woodyapp.php', array('msg' => '付款失败'));
        exit;
    }
}