<?php

namespace xh\run\index\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\functions;
use xh\run\server\controller\callback;
use xh\unity\callbacks;
use xh\unity\page;
use xh\library\request;
use xh\unity\sms;
use xh\unity\userCog;

class alipaygm
{

    private $mysql;

    //初始化
    public function __construct()
    {
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }


    //全自动版
    public function automatic()
    {
        (new model())->load('user', 'group')->review('alipaygm_auto');
        $result = page::conduct('client_alipaygm_automatic_account', request::filter('get.page'), 10, "user_id={$_SESSION['MEMBER']['uid']}", null, 'id', 'asc');
        //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      
        new view('alipaygm/index', [
            'result' => $result,
            'areaStr' => $areaStr,
            'mysql'  => $this->mysql
        ]);
    }

    public function shoubao()
    {
       
        $result = page::conduct('client_alipaygm_automatic_appid', request::filter('get.page'), 10, "user_id={$_SESSION['MEMBER']['uid']}", null, 'id', 'asc');
        new view('alipaygm/shoubao', [
            'result' => $result,
            'mysql'  => $this->mysql
        ]);
    }
    
  public function shoubaoAdd()
    {
        (new model())->load("alipaygm", "features")->shoubaoAdd($this->mysql);
    }
    	//领取记录
       public function jilu()
    {
       
        $result = page::conduct('client_take', request::filter('get.page'), 10, "user_id={$_SESSION['MEMBER']['uid']}", null, 'id', 'asc');
        new view('alipaygm/jilu', [
            'result' => $result,
            'mysql'  => $this->mysql
        ]);
    }
    //添加-->OK
    public function automaticAdd()
    {
        (new model())->load("alipaygm", "features")->add($this->mysql);
    }

    //启动automatic轮训
    public function startAutomaticRb()
    {
        (new model())->load("alipaygm", "features")->startRb($this->mysql);
    }

    //启动网关
    public function startAutomaticGateway()
    {
        (new model())->load("alipaygm", "features")->startGateway($this->mysql);
    }

    //修改名称
    public function automaticEditName()
    {
        (new model())->load("alipaygm", "features")->editName($this->mysql);
    }

    //安全注销
    public function startAutomaticLogOut()
    {
        (new model())->load("alipaygm", "features")->startLogOut($this->mysql);
    }

    //请求登录
    public function startAutomaticLogin()
    {
        (new model())->load("alipaygm", "features")->startLogin($this->mysql);
    }

    //获取支付宝状态
    public function getAutomaticStatus()
    {
        (new model())->load("alipaygm", "features")->getStatus($this->mysql);
    }

    //删除支付宝
    public function automaticDelete()
    {
        (new model())->load("alipaygm", "features")->delete($this->mysql);
    }

   //删除支付宝
    public function shoubaoDelete()
    {
        (new model())->load("alipaygm", "features")->shoubaoDelete($this->mysql);
    }
public function startAutomaticzt()
    {
        (new model())->load("alipaygm", "features")->startAutomaticzt($this->mysql);
    }
    //全部订单
    public function automaticOrder()
    {
        (new model())->load("alipaygm", "features")->order($this->mysql);
    }

    //订单统计
    public function statisticOrder()
    {
        (new model())->load("alipaygm", "features")->statistic($this->mysql);
    }

    //手动补发
    public function automaticReissue()
    {
        (new model())->load("alipaygm", "features")->reissue($this->mysql);
    }

    //轮训通道测试
    public function robinTest()
    {
        new view('alipaygm/robinTest');
    }

    //单个支付宝测试
    public function gatewayTest()
    {
        new view('alipaygm/gatewayTest');
    }

    //支付宝配置
    public function automaticConfig()
    {
        new view('alipaygm/setting');

    }

    //支付宝配置result
    public function automaticConfigResult()
    {
        unset($_SESSION['alipaygmConfig']);
        $robin_arr = [1, 2, 3];
        $robin = intval(request::filter('get.robin'));
        if (!in_array($robin, $robin_arr)) functions::json(-1, '支付宝配置修改失败');
        userCog::update('alipaygmConfig', [
            'robin' => $robin
        ], $_SESSION['MEMBER']['uid']);
        functions::json(200, '支付宝配置更新成功!');
    }


    //后台批量补单
    function resetOrder()
    {

        if (empty($_SESSION['MEMBER']['uid'])) functions::json(500, '用户信息错误，请重新登陆');
        $order_ids = request::filter('post.order_ids');
        $order_ids = explode(",", trim($order_ids));

        if (!is_array($order_ids)) functions::json(500, '订单信息错误');
        $success = '';
        $successCount = 0;
        $error = '';
        $errorCount = 0;
        foreach ($order_ids as $val) {
            if (empty($val)) continue;
            $val = intval($val);

            $find_order = $this->mysql->query('client_alipaygm_automatic_orders', "id={$val}", 'id,alipaygm_id,status')[0];

            if (empty($find_order)) {
                $error .= ",{$val}订单不存在";
                $errorCount += 1;
                continue;
            }
            //查看该订单号是否属于该商户下的订单
            $account = $this->mysql->query('client_alipaygm_automatic_account', "id={$find_order['alipaygm_id']} AND user_id={$_SESSION['MEMBER']['uid']}", 'id')[0];
            if (empty($account)) {
                $error .= ",{$find_order['id']}不是您的订单ID";
                $errorCount += 1;
                continue;
            }

            if ($find_order['status'] == 4) {
                $success .= ",{$find_order['id']}";
                $successCount += 1;
                continue;
            }

            $id = $find_order['alipaygm_id'];
            $money = $find_order['money'];
            if (is_array($find_order)) {
                $update = $this->mysql->update("client_alipaygm_automatic_orders", [
                    'status'        => 4,
                    'pay_time'      => time(),
                    'callback_from' => 'index',
                ], "id={$find_order['id']}");
                $remark = ' - 订单信息：' . $find_order['id'];
                $average = 1;
                if ($update == false) {
                    $error .= ",{$find_order['id']}";
                    $errorCount += 1;
                    continue;
                }
                //查询用户信息
                $find_uid = $this->mysql->query("client_alipaygm_automatic_account", "id={$id}")[0]['user_id'];
                //写到交易记录
                $this->mysql->insert("client_pay_record", [
                    'pay_time'     => time(),
                    'amount'       => $money,
                    'user_id'      => $find_uid,
                    'pay_note'     => '[后台补单]支付宝ID：' . $find_order['id'] . $remark,
                    'types'        => 2,
                    'version_code' => 'alipaygm_auto',
                    'average'      => $average
                ]);
                callbacks::curl(URL_ROOT . '/server/callback/alipaygm', http_build_query(['id' => $id]));
                $successCount += 1;
                $success .= ",{$find_order['id']}";
            } else {
                $errorCount += 1;
                $error .= ",找不到订单信息";

            }

        }
        $success = ltrim($success, ',');
        $error = ltrim($error, ',');
        $returnMsg = '';
        if ($successCount > 0) {
            $returnMsg = "成功执行{$successCount}条,成功订单" . $success;
        }
        if ($errorCount > 0) {
            $returnMsg .= "\n失败执行{$errorCount}条，失败信息" . $error;
        }
        functions::json(200, $returnMsg);
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
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $where = "";
        if ($code) {
            $where .= " and code=" . $code;
        }
        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
        }

        if ($start_time == 'null' && $end_time = 'null' && !$code) {
            $list = $this->mysql->query("client_alipaygm_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}");
        } else {
            $list = $this->mysql->query("client_alipaygm_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}" . $where);
        }
        foreach ($list as $key => $value) {
            if ($value['status'] == 1) {
                $list[$key]['status'] = '等待下发支付二维码';
            } else if ($value['status'] == 2) {
                $list[$key]['status'] = '未支付';
            } else if ($value['status'] == 3) {
                $list[$key]['status'] = '订单超时';
            } else {
                $list[$key]['status'] = '已支付';
            }
            if ($value['pay_time']) {
                $list[$key]['pay_time'] = date('Y-m-d H:i:s', $value['pay_time']);
            } else {
                $list[$key]['pay_time'] = '无';
            }
            if ($value['callback_status'] == 1) {
                $list[$key]['callback_status'] = '已回调';
            } else {
                $list[$key]['callback_status'] = '未回调';
            }
            $list[$key]['creation_time'] = date('Y-m-d H:i:s', $value['creation_time']);
            $user_info = $this->mysql->query('client_user', 'id = ' . $value['user_id']);
            $list[$key]['user_name'] = $user_info[0]['username'];
            $list[$key]['phone'] = $user_info[0]['phone'];
            $list[$key]['percentage'] = $value['amount'] - $value['fees'];
        }
        $name = '支付宝订单';
        $data_info = array(
            array('id', '订单ID'),
            array('user_id', '商户ID'),
            array('user_name', '商户名称'),
            array('phone', '商户手机号'),
            array('trade_no', '交易订单号'),
            array('alipaygm_id', '支付宝ID'),
            array('amount', '金额'),
            array('percentage', '抽成'),
            array('status', '交易状态'),
            array('fees', '手续费'),
            array('pay_time', '异步通知时间'),
            array('callback_status', '异步通知状态'),
            array('callback_from', '异步通知'),
            array('callback_content', '回调信息'),
            array('creation_time', '订单创建时间'),
        );
        functions::commonExport($name, $data_info, $list);
    }

    /**
     * 修改最大金额
     */
    public function editMaxAmount()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $amount = request::filter('get.amount');
        //检查该微信
        $update['max_amount'] = $amount;
        $mysql->update("client_alipaygm_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    public function editMaxdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $dd = request::filter('get.dd');
        //检查该微信
        $update['max_dd'] = $dd;
        $mysql->update("client_alipaygm_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
   public function areaAdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $area = request::filter('get.area');
        //检查该微信
        $update['area'] = $area;
        $mysql->update("client_alipaygm_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
    /**
     * 修改备注
     */
    public function editNote()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $amount = request::filter('get.note');
        //检查该微信
        $update['note'] = $amount;
        $mysql->update("client_alipaygm_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    public function withdraw()
    {
        $key_id = request::filter('get.key_id');
        $type = request::filter('get.type');
        $pwd = intval(request::filter('get.pwd'));
        //检查该微信
        if ($pwd != '') {
            if (strlen($pwd) != 6) {
                functions::json(-1, '支付密码只能6位数');
            }
            $mysql = new mysql();
            $update_id = $mysql->update("client_alipaygm_automatic_account", ['receiving' => 2], "key_id='{$key_id}'");
            if ($update_id > 0) {
                \xh\library\gateway::withdraw($_SESSION['MEMBER']['uid'], $pwd, $key_id, 0, 'alipaygm');
                functions::json(200, '成功');

            }


        }
        functions::json(-1, '通道关闭失败');

    }
}