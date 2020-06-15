<?php

namespace xh\run\index\controller;

use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\functions;
use xh\unity\page;
use xh\library\request;
use xh\unity\sms;
use xh\unity\userCog;
use xh\library\url;
use xh\library\ip;
use xh\unity\upload;

class member
{

    private $mysql;

    //初始化
    public function __construct()
    {
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }

    //注销登录
    public function logout()
    {
        //注销
        unset($_SESSION['MEMBER']);
        unset($_SESSION);
        url::address(url::s('index/user/login'), '安全注销成功!', 0);
    }

    //修改资料
    public function edit()
    {
        new view('user/edit');
    }

    //上传头像
    public function avatarUpload()
    {
        $id = $_SESSION['MEMBER']['uid'];
        $emp = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '您的账户异常,请重新登录后再尝试!');
        //上传文件到自己的空间
        $path = PATH_VIEW . 'upload/avatar/' . $id;
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg', 'png'), 1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是图片!');
        $this->mysql->update('client_user', array('avatar' => $upload['new']), "id={$id}");
        functions::json(200, '头像更换成功!', array('img' => $upload['new']));
    }

    //获取修改资料短信验证码
    public function getCode()
    {
        $code = mt_rand(100000, 999999);
        //检测是否已经有存活在线的验证码
        $now_time = time() - 90;
        $find_code = $this->mysql->query("client_code", "phone={$_SESSION['MEMBER']['phone']} and {$now_time}<get_time and state=1 and typec='edit'");
        if (is_array($find_code[0])) functions::json(-1, '验证码获取太频繁,请耐心等待几秒再尝试!');
        $in = $this->mysql->insert("client_code", [
            'phone'    => $_SESSION['MEMBER']['phone'],
            'codec'    => $code,
            'get_time' => time(),
            'state'    => 1,
            'typec'    => 'edit',
            'ip'       => ip::get()
        ]);
        if ($in > 0) {
            (new sms())->send($_SESSION['MEMBER']['phone'], $code);
            functions::json(200, '短信获取成功');
        }
        functions::json(-2, '短信发送失败');
    }


    //修改
    public function editResult()
    {
        //验证码
        $code = intval(request::filter('post.code', '', 'htmlspecialchars'));
        $now_time = time() - 300;
        $find_code = $this->mysql->query("client_code", "phone={$_SESSION['MEMBER']['phone']} and codec={$code} and {$now_time}<get_time and state=1 and typec='edit'")[0];
       // if (!is_array($find_code)) functions::json(-3, '短信验证码不正确');
        //初始化修改参数
        $edit = [];
        $renew = intval(request::filter('post.renew', '', 'htmlspecialchars'));
        if ($renew) {
            $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14));
            $edit['key_id'] = $key_id;
        }
        $pwd = request::filter('post.pwd', '', 'htmlspecialchars');
        if (!empty($pwd)) {
            if (strlen($pwd) < 6) functions::json(-1, '密码不能小于6位');
            $edit['pwd'] = functions::pwd($pwd, $_SESSION['MEMBER']['token']);
        }
        $bank_type = request::filter('post.bank_type', '', 'htmlspecialchars');
        if ($bank_type == 1) {
            //支付宝
            $alipay_name = request::filter('post.alipay_name', '', 'htmlspecialchars');
            //账号
            $alipay_content = request::filter('post.alipay_content', '', 'htmlspecialchars');
            if (empty($alipay_name) || empty($alipay_content)) functions::json(-1, '支付宝姓名或账号不能为空!');
            //写入
            $edit['bank'] = json_encode(['type' => 1, 'name' => $alipay_name, 'card' => $alipay_content]);
        }
        if ($bank_type == 2) {
            //姓名
            $bank_name = request::filter('post.bank_name', '', 'htmlspecialchars');
            //银行名称
            $bank = request::filter('post.bank', '', 'htmlspecialchars');
            //账号
            $card = request::filter('post.card', '', 'htmlspecialchars');
            if (empty($bank_name) || empty($bank) || empty($card)) functions::json(-1, '银行卡信息有误,请填写正确!');
            $edit['bank'] = json_encode(['type' => 2, 'name' => $bank_name, 'card' => $card, 'bank' => $bank]);
        }
        $bind_phone = intval(request::filter('post.bind_phone', '', 'htmlspecialchars'));
        $phone = trim(request::filter('post.phone', '', 'htmlspecialchars'));
        if ($bind_phone == 1 && $phone != $_SESSION['MEMBER']['phone']) {
            if (!functions::isMobile($phone)) functions::json(-1, '手机号码输入有误');
            //检测该手机是否已经绑定过了
            $find_phone = $this->mysql->query('client_user', "phone={$phone}")[0];
            if (is_array($find_phone)) functions::json(-2, '该手机已经被它人绑定,如果是您本人手机,请联系客服解决!');
            $edit['phone'] = $phone;
        }

        if (!is_array($edit)) functions::json(-3, '您没有做任何修改哟!');
        $this->mysql->update("client_user", $edit, "id={$_SESSION['MEMBER']['uid']}");
        $this->mysql->delete('client_code', "id={$find_code['id']}");
        functions::json(200, '您的资料已经修改成功啦!');
    }

    //提现
    public function withdraw()
    {
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        $where = "user_id={$_SESSION['MEMBER']['uid']}";

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and flow_no={$code}";
            }
        }
        $result = page::conduct('client_withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('user/withdraw', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ]
        ]);
    }

    //申请提现
    public function applyWithdraw()
    {
        if (!in_array($_SESSION['MEMBER']['bank']['type'], [1, 2])) exit('<span style="color:red;">您当前没有填写收款方式,请在个人设置里面添加银行卡或支付宝!</span>');
        new view('user/apply_withdraw', [
            'mysql' => $this->mysql
        ]);
    }

    //提现验证码
    public function applyCode()
    {
        $code = mt_rand(100000, 999999);
        //检测是否已经有存活在线的验证码
        $now_time = time() - 90;
        $find_code = $this->mysql->query("client_code", "phone={$_SESSION['MEMBER']['phone']} and {$now_time}<get_time and state=1 and typec='apply'");
        if (is_array($find_code[0])) functions::json(-1, '验证码获取太频繁,请耐心等待几秒再尝试!');
        $in = $this->mysql->insert("client_code", [
            'phone'    => $_SESSION['MEMBER']['phone'],
            'codec'    => $code,
            'get_time' => time(),
            'state'    => 1,
            'typec'    => 'apply',
            'ip'       => ip::get()
        ]);
        if ($in > 0) {
            (new sms())->send($_SESSION['MEMBER']['phone'], $code);
            functions::json(200, '短信获取成功');
        }
        functions::json(-2, '短信发送失败');
    }

    //申请提现

    //申请提现
    public function applyWithdrawResult()
    {
        //验证码
        $code = intval(request::filter('post.code', '', 'htmlspecialchars'));
        $now_time = time() - 300;
        $find_code = $this->mysql->query("client_code", "phone={$_SESSION['MEMBER']['phone']} and codec={$code} and {$now_time}<get_time and state=1 and typec='apply'")[0];
      //  if (!is_array($find_code)) functions::json(-39, '短信验证码不正确');
        //计算用户
        $user = $this->mysql->query("client_user", "id={$_SESSION['MEMBER']['uid']}")[0];
        //计算提现金额
        $amount = floatval(request::filter('post.amount', '', 'htmlspecialchars'));
        if ($amount < 1) functions::json(-1, '提现金额输入不正确,本支付平台最低提现1元人民币');
        //用户组
        $group = json_decode($_SESSION['MEMBER']['group']['authority'], true);
        //手续费
        $fees = floatval($group['withdraw']['cost']) * $amount;
        //计算减掉的金额
        $user_amount = $user['money'] - $amount;
        //判断是否有足够的金额提现
        if ($user_amount < 0) functions::json(-89, '余额不足');
        //更新用户账户信息
        if ($this->mysql->update("client_user", ['money' => $user_amount], "id={$user['id']}") > 0) {
            $in = $this->mysql->insert("client_withdraw", [
                'user_id'    => $_SESSION['MEMBER']['uid'],
                'old_amount' => $user['money'],
                'amount'     => $amount,
                'new_amount' => $user_amount,
                'types'      => 1,
                'content'    => '提现到账时间为2小时-24小时内到账',
                'apply_time' => time(),
                'deal_time'  => 0,
                'flow_no'    => date("YmdHis") . mt_rand(100000, 999999),
                'fees'       => $fees
            ]);
            functions::json(200, '您的提现已经提交成功!');

        } else {
            functions::json(-1, '系统正在维修,请稍后再提现!');
        }

    }

    //充值
    public function pay()
    {
        new view("user/pay");
    }

    //发起支付请求
    public function payResult()
    {
        new view("user/payResult");
    }


    //收款记录层
    public function record()
    {
        $where = "user_id={$_SESSION['MEMBER']['uid']}";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        if ($sorting == 'note') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and pay_note like '%{$code}%'";
            }
        }

        //查询所有的交易记录
        $result = page::conduct('client_pay_record', request::filter('get.page'), 20, $where, null, 'id', 'desc');

        new view('user/record', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'where'   => $where
        ]);
    }

    //我的代理
    public function agent()
    {
        $type = 1;
        $where = "level_id={$_SESSION['MEMBER']['uid']}";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $name = request::filter('get.name', '', 'htmlspecialchars');
        if (!empty($_REQUEST['type'])) {
            $type = 2;
        }
        if ($sorting == 'note') {
            if ($name != '') {
                $where .= " and username like '%{$name}%'";
            }
        }
        //查询所有的交易记录
        $result = page::conduct('client_user', request::filter('get.page'), 20, $where, null, 'id', 'desc');
        foreach ($result['result'] as $key => $value) {
            $where = 'user_id=' . $value['id'] . ' and status = 4';
            if ($type == 1) {
                $where_alipay = ' and types = 2';
                $where_wechat = ' and types = 1';
                $wechat_total = $this->mysql->query('service_order', $where . $where_wechat, 'sum(amount) as total,count(id) as order_wechat');
                $alipay_total = $this->mysql->query('service_order', $where . $where_alipay, 'sum(amount) as total,count(id) as order_alipay');
            } else {
                $wechat_total = $this->mysql->query('client_wechat_automatic_orders', $where, 'sum(amount) as total,count(id) as order_wechat');
                $alipay_total = $this->mysql->query('client_alipay_automatic_orders', $where, 'sum(amount) as total,count(id) as order_alipay');
            }
            $result['result'][$key]['total'] = $alipay_total[0]['total'] + $wechat_total[0]['total'];
            $result['result'][$key]['wechat_order'] = $wechat_total[0]['order_wechat'] ? $wechat_total[0]['order_wechat'] : 0;
            $result['result'][$key]['alipay_amount'] = $alipay_total[0]['total'] ? $alipay_total[0]['total'] : 0;
            $result['result'][$key]['alipay_order'] = $alipay_total[0]['order_alipay'] ? $alipay_total[0]['order_alipay'] : 0;
            $result['result'][$key]['wechat_amount'] = $wechat_total[0]['total'] ? $wechat_total[0]['total'] : 0;
            $rate_info = $this->mysql->query('agent_rate', 'uid = ' . $value['id'] . ' and parent_id = ' . $_SESSION['MEMBER']['uid']);
            $info = json_decode($rate_info[0]['authority'], true);
            $result['result'][$key]['rate'] = $info;
        }
        new view('user/agent', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'where'   => $where
        ]);
    }


    public function rate()
    {
        $uid = $_SESSION['MEMBER']['uid'];
        $where = 'uid = ' . $_REQUEST['id'] . ' and parent_id = ' . $uid;
        $info = $this->mysql->query('agent_rate', $where);
        if ($_REQUEST['type'] == 'edit') {
            $group_id = $_SESSION['MEMBER']['group_id'];
            $result = $this->mysql->query("client_group", "id={$group_id}")[0];
            $data = json_decode($result['authority'], true);
            $wechat_cost = $data['wechat_auto']['cost'];
            $alipay_auto = $data['alipay_auto']['cost'];
            $service_auto = $data['service_auto']['cost'];
            if ($_REQUEST['wechat_auto'] < $wechat_cost) {
                functions::json(400, "微信费率不能低于总平台的费率（总平台费率{$wechat_cost}）");
            }
            if ($_REQUEST['alipay_auto'] < $alipay_auto) {
                functions::json(400, "支付宝费率不能低于总平台的费率（总平台费率{$alipay_auto}）");
            }
            if ($_REQUEST['service_auto'] < $service_auto) {
                functions::json(400, "服务版费率不能低于总平台的费率（总平台费率{$service_auto}）");
            }
            $insert['wechat_auto'] = $_REQUEST['wechat_auto'];
            $insert['alipay_auto'] = $_REQUEST['alipay_auto'];
            $insert['service_auto'] = $_REQUEST['service_auto'];
            $json_encode_data = json_encode($insert);
            if (!$info) {
                $insert_data['parent_id'] = $uid;
                $insert_data['uid'] = $_REQUEST['id'];
                $insert_data['authority'] = $json_encode_data;
                $insert_data['create_time'] = time();
                //不存在新建
                $this->mysql->insert('agent_rate', $insert_data);
            } else {
                //存在就更新
                $update_data['authority'] = $json_encode_data;
                $update_data['update_time'] = time();
                $this->mysql->update('agent_rate', $update_data, $where);
            }
            functions::json(200, 'success');
        }
        $result = json_decode($info[0]['authority'], true);
        //查询所有的交易记录
        new view('user/agent', [
            'result' => $result,
            'mysql'  => $this->mysql,
        ]);
    }

    public function incomeLog()
    {

        set_time_limit(0);
        ini_set("memory_limit", "1024M");  // 根据电脑配置不够继续增加

        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        if (empty($start_time)) {
            $date = date('Y-m-d');
            $start_time = strtotime($date . ' 00:00:00');
            $end_time = time();
        }
        $where = '';
        if ($start_time && $end_time) {
            $where .= " and create_time BETWEEN " . $start_time . " AND " . $end_time;
        }
        $uid = $_SESSION['MEMBER']['uid'];
        $result = $this->mysql->query('agent_income_log', "uid = {$uid}" . $where);
        foreach ($result as $key => $value) {
            $user_info = $this->mysql->query('client_user', "id = {$value['uid']}");
            $result[$key]['username'] = $user_info[0]['username'];
            if ($value['type'] == 1) {
                $result[$key]['type'] = '微信';
                $wechat_order = $this->mysql->query('client_wechat_automatic_orders', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $wechat_order[0]['amount'];
                $result[$key]['trade_no'] = $wechat_order[0]['trade_no'];
            } elseif ($value['type'] == 2) {
                $result[$key]['type'] = '支付宝';
                $alipay_order = $this->mysql->query('client_alipay_automatic_orders', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $alipay_order[0]['amount'];
                $result[$key]['trade_no'] = $alipay_order[0]['trade_no'];
            } else {
                $result[$key]['type'] = '服务版';
                $service_order = $this->mysql->query('service_order', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $service_order[0]['amount'];
                $result[$key]['trade_no'] = $service_order[0]['trade_no'];
            }
            $result[$key]['create_time'] = date('Y-m-d H:i:s', $value['create_time']);
        }
        new view('user/income_log', [
            'result' => $result,
            'mysql'  => $this->mysql,
        ]);
    }

    /**
     * @param string $name
     * @param array  $expCellName
     * @param array  $expTableData
     *
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * 导出
     */
    public function export()
    {
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $where = "";
        if ($start_time && $end_time) {
            $where .= " and create_time BETWEEN {$start_time} AND {$end_time}";
        }
        $uid = $_SESSION['MEMBER']['uid'];
        $result = $this->mysql->query('agent_income_log', "uid = {$uid}" . $where);
        foreach ($result as $key => $value) {
            $user_info = $this->mysql->query('client_user', "id = {$value['uid']}");
            $result[$key]['username'] = $user_info[0]['username'];
            if ($value['type'] == 1) {
                $result[$key]['type'] = '微信';
                $wechat_order = $this->mysql->query('client_wechat_automatic_orders', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $wechat_order[0]['amount'];
                $result[$key]['trade_no'] = $wechat_order[0]['trade_no'];
            } elseif ($value['type'] == 2) {
                $result[$key]['type'] = '支付宝';
                $alipay_order = $this->mysql->query('client_alipay_automatic_orders', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $alipay_order[0]['amount'];
                $result[$key]['trade_no'] = $alipay_order[0]['trade_no'];
            } else {
                $result[$key]['type'] = '服务版';
                $service_order = $this->mysql->query('service_order', "id = {$value['order_id']}");
                $result[$key]['pay_money'] = $service_order[0]['amount'];
                $result[$key]['trade_no'] = $service_order[0]['trade_no'];
            }
            $result[$key]['create_time'] = date('Y-m-d H:i:s', $value['create_time']);
        }
        $name = '服务订单';
        $data_info = array(
            array('trade_no', '订单号'),
            array('username', '代理名称'),
            array('type', '类型'),
            array('pay_money', '支付金额/元'),
            array('money', '收益/元'),
            array('create_time', '收益时间'),
        );
        functions::commonExport($name, $data_info, $result);
    }

    /**
     * 添加代理
     */
    public function addAgent()
    {
        $level_id = $_SESSION['MEMBER']['uid'];
        $userId = $_REQUEST['userId'];
        if ($userId == $level_id) {
            functions::json(400, '不能绑定自己');
        }
        $where = "level_id = 0 and id = {$userId}";
        $agent_info = $this->mysql->query('client_user', $where);
        $user_info = $this->mysql->query('client_user', "id = {$level_id}");
        if (!$agent_info) {
            functions::json(400, '用户不存在或者已绑定其他上级');
        }
        if (!$user_info) {
            functions::json(400, '非法操作');
        }
        $where = 'id = ' . $userId;
        $data['level_id'] = intval($level_id);
        $res = $this->mysql->update('client_user', $data, $where);
        if ($res) {
            functions::json(200, '成功');
        } else {
            functions::json(400, '失败');
        }
    }
}