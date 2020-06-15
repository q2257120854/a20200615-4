<?php
namespace xh\run\index\model;
use xh\library\model;
use xh\library\functions;
use xh\library\request;
use xh\library\view;
use xh\unity\page;
use xh\unity\callbacks;
use xh\library\url;

class features{
    
    //自动验证
    public function __construct(){
        (new model())->load('user', 'group')->review('pddgm_auto');
    }

    public function add($mysql){
        //添加微信通道
        //检测当前拥有多少条通道
        $find_pddgm_auto_count = $mysql->select("select count(id) as count from " . DB_PREFIX . "client_pddgm_automatic_account where user_id={$_SESSION['MEMBER']['uid']}")[0]['count'];
        $swrc = (new model())->load('user', 'group')->check('pddgm_auto');
        
        if (!is_array($swrc)) functions::json(-3, '您暂时还不能添加通道,请稍后再试!');
        if ($swrc['quantity'] != 0){
            if ($find_pddgm_auto_count >= $swrc['quantity']) functions::json(-2, '您当前只有'.$swrc['quantity'].'条通道,无法再继续新增!');
        }
        //开始添加通道
        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000,9999)+mt_rand(1000,9999)),mt_rand(1000000,99999999))), 0, 18));
        $in = $mysql->insert("client_pddgm_automatic_account", [
            'name'=>0,
            'status'=>1,
            'login_time'=>0,
            'heartbeats'=>0,
            'active_time'=>0,
            'user_id'=>$_SESSION['MEMBER']['uid'],
            'key_id'=>$key_id,
            'training'=>2,
            'receiving'=>2,
            'android_heartbeat'=>0
        ]);
        
        if ($in>0) {
            $_SESSION['ADD_GATEWAY'] = 2;
            functions::json(200, '恭喜您新增了一条微信Automatic通道');
        }
        
        functions::json(-3, '新增微信Automatic通道失败,请联系客服!');
    }
    
    
   public function editName()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $app_user = request::filter('get.app_user');
        //检查该微信
        $update['app_user'] = $app_user;
        $mysql->update("client_pddgm_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
  
    public function startRb($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '更改异常,请联系客服!');
        $training = 2;
        if ($find_pddgm['training'] == 2) {
            //开启状态
            $training = 1;
            //检测账号是否异常
          //  if ($find_pddgm['status'] != 1) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $mysql->update("client_pddgm_automatic_account", [
            'training'=>$training
        ],"id={$id}");
        if ($update > 0) functions::json(200, '更改轮训成功!');
        functions::json(-2, '更改失败,请联系客服!');
    }
    
    
    public function startGateway($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '更改异常,请联系客服!');
        $receiving = 2;
        if ($find_pddgm['receiving'] == 2) {
            //开启状态
            $receiving = 1;
            //检测账号是否异常
            if ($find_pddgm['status'] != 1) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $mysql->update("client_pddgm_automatic_account", [
            'receiving'=>$receiving
        ],"id={$id}");
        if ($update > 0) functions::json(200, '更改网关成功!');
        functions::json(-2, '更改失败,请联系客服!');
    }
    
    public function startLogOut($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '当前微信出现异常,请联系客服!');
        if ($find_pddgm['status'] == 6 || $find_pddgm['status'] == 1) functions::json(-3, '当前微信账号已经安全注销过了!');
        $update = $mysql->update("client_pddgm_automatic_account", [
            'status'=>6
        ],"id={$id}");
        if ($update > 0) functions::json(200, '安全注销成功!');
        functions::json(-2, '注销失败,请联系客服!');
    }
    
    public function startLogin($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '当前微信出现异常,请联系客服!');
        if ($find_pddgm['status'] == 4 || $find_pddgm['status'] == 6) functions::json(-3, '当前微信账号状态无法进行登录,请稍后重试!');
        $update = $mysql->update("client_pddgm_automatic_account", [
            'status'=>2,
            'login_time'=>time()
        ],"id={$id}");
        functions::json(200, '正在获取登录信息..');
    }
    
    public function getStatus($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        //判断微信登录时间
        if ($find_pddgm['login_time'] + 120 < time() || $find_pddgm['status'] == 6 || $find_pddgm['status'] == 5 || $find_pddgm['status'] == 1) {
            $mysql->update("client_pddgm_automatic_account", ['status'=>1],"id={$id}");
            functions::json(-2, '微信登录超时!');
        }
        if ($find_pddgm['status'] == 2) functions::json(2, '正在获取登录信息..');
        if ($find_pddgm['status'] == 3) functions::json(3, '登录信息获取成功,准备登录..');
        if ($find_pddgm['status'] == 7) functions::json(7, '请扫码登录',['img'=>$find_pddgm['login_img']]);
        if ($find_pddgm['status'] == 4) {
            $_SESSION['GATEWAY_LOGIN'] = 2;
            functions::json(4, '登录成功');
        }
    }
    
    public function delete($mysql){
        $id = intval(request::filter('get.id'));
        $pwd = functions::pwd(request::filter('get.pwd'), $_SESSION['MEMBER']['token']);
        //查询用户信息
        $pwd_server = $mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0]['pwd'];
        if ($pwd != $pwd_server) functions::json(-1, '您的密码输入有误!');
        //检查该微信
        $find_pddgm = $mysql->query("client_pddgm_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_pddgm)) functions::json(-2, '删除该微信号时出现一个错误,请及时联系客服!');
        if ($find_pddgm['status'] == 6) functions::json(-2, '当前微信正在进行安全注销,请耐心等待注销完成后再进行删除!');
        if ($find_pddgm['status'] != 1) functions::json(-2, '请将微信安全下线后再进行删除!');
        $mysql->delete("client_pddgm_automatic_account", "id={$id} and user_id={$_SESSION['MEMBER']['uid']}");
        functions::json(200, '您成功的删除了该微信!');
    }
    
    public function order($mysql){
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');
        
        //pddgm
        if ($sorting == 'pddgm'){
            if ($code != '' && $_SESSION['pddgm']['ORDER']['WHERE'] == ''){
                $code_arr = explode(",", $code);
                if (is_array($code_arr)){
                    $wecaht_where = '';
                    for ($i=0;$i<count($code_arr);$i++){
                        $wecaht_where .= ' or pddgm_id=' . $code_arr[$i];
                    }
                    
                    $_SESSION['pddgm']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where),'or') . ')';
                }
            }
            
            if ($_GET['locking'] == 'closed'){
                unset($_SESSION['pddgm']['ORDER']['WHERE']);
            }
        }
        
        
        
        $where = $where . $_SESSION['pddgm']['ORDER']['WHERE'];
        $where = trim(trim($where),'and');
        
        //排序
        if ($sorting == 'status'){
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback'){
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no'){
            if ($code != '') {
                $code = trim($code);
                $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }
        
        //查询自己的所有微信
        $pddgm = $mysql->query("client_pddgm_automatic_account","name != '0' and user_id={$_SESSION['MEMBER']['uid']}");
        
        $result = page::conduct('client_pddgm_automatic_orders',request::filter('get.page'),15,$where,null,'id','desc');
        
        new view('pddgm/order',[
            'result'=>$result,
            'mysql'=>$mysql,
            'sorting'=>[
                'code'=>$code,
                'name'=>$sorting
            ],
            'pddgm' => $pddgm,
            'where' => $where
        ]);
    }
  
    public function statistic($mysql)
    {
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
//        $start_time = request::filter('get.start_time','','htmlspecialchars');
//        $end_time = request::filter('get.end_time','','htmlspecialchars');
        $start_time = strtotime($_GET['start_time']);;
        $end_time = strtotime($_GET['end_time']);
        //pddgm
        if ($sorting == 'pddgm') {
            if ($code != '' && $_SESSION['pddgm']['ORDER']['WHERE'] == '') {
                $code_arr = explode(",", $code);
                if (is_array($code_arr)) {
                    $wecaht_where = '';
                    for ($i = 0; $i < count($code_arr); $i++) {
                        $wecaht_where .= ' or pddgm_id=' . $code_arr[$i];
                    }

                    $_SESSION['pddgm']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where), 'or') . ')';
                }
            }

            if ($_GET['locking'] == 'closed') {
                unset($_SESSION['pddgm']['ORDER']['WHERE']);
            }
        }


        $where = $where . $_SESSION['pddgm']['ORDER']['WHERE'];
        $where = trim(trim($where), 'and');

        //排序
        if ($sorting == 'status') {
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback') {
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }
        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN " . $start_time . " AND " . $end_time;
        }
        //查询自己的所有微信
        $pddgm = $mysql->query("client_pddgm_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

        $result = page::conduct('client_pddgm_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('pddgm/statistic', [
            'result'  => $result,
            'mysql'   => $mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'pddgm'  => $pddgm,
            'where'   => $where
        ]);
    }
    
    public function reissue($mysql){
        $module_name = 'pddgm_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $mysql->query('client_pddgm_automatic_orders', "id={$order_id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($order)) functions::json(-2, '当前订单不存在');
        //检测订单是否为未支付
        if ($order['status'] != 4){
            $mysql->update("client_pddgm_automatic_orders", [
                'pay_time'=>time(),
                'status' => 4
            ], "id={$order['id']}");
        }
        //得到用户组
        $group = $mysql->query('client_group',"id={$_SESSION['MEMBER']['group_id']}")[0];
        //解析数据
        $authority = json_decode($group['authority'],true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');
            // 开始扣手续费
        $fees = $order['amount'] * $authority['cost'];
        $user_balance = $_SESSION['MEMBER']['balance'] - $fees; // 用户最终余额
        if ($user_balance >= 0 || $order['amount'] < 1) {
                // 扣除费用
                $deductionStatus = $mysql->update("client_user", [
                    'balance' => $user_balance
                ], "id={$_SESSION['MEMBER']['uid']}");
                if ($deductionStatus > 0 || $order['amount'] < 1) {
                    $_SESSION['MEMBER']['balance'] = $user_balance;
                    if ($order['pay_time'] == 0){
                        $pay_time = time();
                    }else {
                        $pay_time = $order['pay_time'];
                    }
                    // 手续费扣除成功，开始回调
                    $result = callbacks::curl($order['callback_url'], http_build_query([
                        'account_name' => $_SESSION['MEMBER']['username'],
                        'pay_time' => $pay_time,
                        'status' => 'success',
                        'amount' => $order['amount'],
                        'out_trade_no' => $order['out_trade_no'],
                        'trade_no' => $order['trade_no'],
                        'fees' => $fees,
                        'sign' => functions::sign($_SESSION['MEMBER']['key_id'], [
                            'amount' => $order['amount'],
                            'out_trade_no' => $order['out_trade_no']
                        ]),
                        'callback_time' => $callback_time,
                        'type'=>2,
                        'account_key' => $_SESSION['MEMBER']['key_id'],
						'money' => $order['money']
                    ]));
                    $mysql->update("client_pddgm_automatic_orders", [
                        'pay_time'=>$pay_time,
                        'callback_time' => $callback_time,
                        'callback_status' => 1,
                        'callback_content' => $result,
                        'fees' => $fees
                    ], "id={$order['id']}");
                }
            }
            functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
        //-----------------------------
    }
    
}