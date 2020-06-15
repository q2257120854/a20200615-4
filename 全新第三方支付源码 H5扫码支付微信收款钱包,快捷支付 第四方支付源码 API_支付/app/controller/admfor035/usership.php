<?php

namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class usership extends CheckAdmin
{
    public function index()
    {
        $kw = $this->req->get('kw');
        $ship_type = $this->req->get('ship_type');
        $ship_cycle = $this->req->get('ship_cycle');
        $ship_type = isset($_GET['ship_type']) ? $ship_type : -1;
        $ship_cycle = isset($_GET['ship_cycle']) ? $ship_cycle : -1;
        $cons = 'a.is_state=? and a.is_agent=?';
        $consOR = '';
        $consArr = array('1', 0);
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
        if ($ship_type >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.ship_type=?';
            $consArr[] = $ship_type;
        }
        if ($ship_cycle >= 0) {
            $cons .= $cons ? ' and ' : '';
            $cons .= 'a.ship_cycle=?';
            $consArr[] = $ship_cycle;
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
        $totalsize = $this->model()->select()->from('users a')->where(array('fields' => $cons, 'values' => $consArr))->count();
        $lists = array();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select()->from('users a')->offset($offset)->limit($pagesize)->orderby($orderby)->where(array('fields' => $cons, 'values' => $consArr))->fetchAll();
            /*$cons.=' and b.is_state=? and b.is_ship=? and b.addtime<?';$consArr=array_merge($consArr,array(1,0,strtotime(date('Y-m-d'))));$lists=$this->model()->select('a.*,count(b.id) as total_unship_count,sum(b.realmoney*b.uprice) as income')->from('users a')->left('orders b')->on('a.id=b.userid')->join()->offset($offset)->limit($pagesize)->where(array('fields'=>$cons,'values'=>$consArr))->groupby('a.id')->orderby($orderby)->fetchAll();*/
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?ship_type=' . $ship_type . '&ship_cycle=' . $ship_cycle . '&kw=' . $kw . '&sort=' . $sort . '&by=' . $by . '&p='));
        $data = array('title' => '用户列表', 'lists' => $lists, 'pagelist' => $pagelist, 'search' => array('kw' => $kw, 'ship_type' => $ship_type, 'ship_cycle' => $ship_cycle), 'sort' => $sort, 'by' => $by);
        $this->put('usership.php', $data);
    }
    public function ship()
    {
        $bill = new Bill();
        $userid = isset($this->action[3]) ? $this->action[3] : 0;
        $users = $this->model()->select('unpaid')->from('users')->where(array('fields' => 'id=?', 'values' => array($userid)))->fetchRow();
        $newMoney = $users['unpaid'];
        $income = $bill->beforeUserIncome($userid, 0);
        if ($income > 0) {
            $newMoney += $income;
            $data = array('unpaid' => $newMoney);
            if ($this->model()->from('users')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($userid)))->update()) {
                $where = array('fields' => 'is_state=? and is_ship=? and userid=? and addtime<?', 'values' => array(1, 0, $userid, strtotime(date('Y-m-d'))));
                $this->model()->from('orders')->updateSet(array('is_ship' => 1))->where($where)->update();
                $data = array('userid' => $userid, 'is_agent' => 0, 'before_money' => $users['unpaid'], 'money' => $income, 'after_money' => $newMoney, 'ctype' => '结算', 'addtime' => time());
                $this->model()->from('paylogs')->insertData($data)->insert();
            }
        }
        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($userid)))->fetchRow();
        $userinfo += array('money' => $newMoney, 'fee' => $bill->fee($newMoney));
        $this->put('usershippay.php', $userinfo);
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
        $data += array('addtime' => time(), 'lastime' => time(), 'userid' => $userid);
        if ($this->model()->from('payments')->insertData($data)->insert()) {
            $newMoney = $users['unpaid'] - $data['money'];
            $data = array('userid' => $userid, 'is_agent' => 0, 'before_money' => $users['unpaid'], 'money' => $data['money'], 'after_money' => $newMoney, 'ctype' => '付款', 'addtime' => time());
            $this->model()->from('paylogs')->insertData($data)->insert();
            $newData = array('paid' => $users['paid'] + $data['money'], 'unpaid' => $newMoney);
            $this->model()->from('users')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($userid)))->update();
            $this->put('woodyapp.php', array('msg' => '付款记录已成功创建'));
            exit;
        }
        $this->put('woodyapp.php', array('msg' => '付款失败'));
        exit;
    }
    public function batch()
    {
        $this->put('usershipbatch.php');
    }
    public function batchsave()
    {
        $sim = $this->req->post('sim');
        $money = $this->req->post('money');
        if ($ship_cycle >= 0) {
            $users = $this->model()->select('id,paid,unpaid')->from('users')->where(array('fields' => 'is_agent=? and is_state=? and ship_type=? and ship_cycle=?', 'values' => array(0, 1, 0)))->fetchAll();
        } else {
            $users = $this->model()->select('id,paid,unpaid')->from('users')->where(array('fields' => 'is_agent=? and is_state=? and ship_type=?', 'values' => array(0, 1)))->fetchAll();
        }
        $i = 0;
        if ($users) {
            $bill = new Bill();
            foreach ($users as $key => $user) {
                $userid = $user['id'];
                $fromTime = strtotime(date('Y-m-d') . ' 23:59:59') - 60 * 60 * 24 * 1;
                $unpaid = $user['unpaid'];
                $income = $bill->getUserIncome($userid, $fromTime);
                $total_income = $unpaid + $income;
                if ($total_income > 0 && $sim == '1' ? $total_income > $money : $total_income < $money) {
                    $i++;
                    if ($this->model()->from('users')->updateSet(array('unpaid' => $total_income))->where(array('fields' => 'id=?', 'values' => array($userid)))->update()) {
                        $where = array('fields' => 'is_state=? and is_ship=? and userid=? and addtime<=?', 'values' => array(1, 0, $userid, $fromTime));
                        $this->model()->from('orders')->updateSet(array('is_ship' => 1))->where($where)->update();
                        $data = array('userid' => $userid, 'is_agent' => 0, 'before_money' => $unpaid, 'money' => $income, 'after_money' => $total_income, 'ctype' => '结算', 'addtime' => time());
                        $this->model()->from('paylogs')->insertData($data)->insert();
                        $userinfo = $this->model()->select()->from('userinfo')->where(array('fields' => 'userid=?', 'values' => array($userid)))->fetchRow();
                        $data = array('sn' => 'b' . time(), 'money' => $total_income, 'fee' => $bill->fee($total_income), 'realname' => $userinfo['realname'], 'batype' => $userinfo['batype'], 'baname' => $userinfo['baname'], 'addtime' => time(), 'lastime' => time(), 'userid' => $userid, 'remark' => '批量结算');
                        if ($this->model()->from('payments')->insertData($data)->insert()) {
                            $newMoney = 0;
                            $data = array('userid' => $userid, 'is_agent' => 0, 'before_money' => $total_income, 'money' => $total_income, 'after_money' => $newMoney, 'ctype' => '付款', 'addtime' => time());
                            $this->model()->from('paylogs')->insertData($data)->insert();
                            $newData = array('paid' => $user['paid'] + $total_income, 'unpaid' => $newMoney);
                            $this->model()->from('users')->updateSet($newData)->where(array('fields' => 'id=?', 'values' => array($userid)))->update();
                        }
                    }
                }
            }
        }
        $this->put('woodyapp.php', array('msg' => '批量结算完成(共结算' . $i . '个用户)', 'url' => $this->dir . 'userpay'));
    }
}