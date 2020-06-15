<?php

namespace xh\run\admin\controller;

use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;
use xh\unity\page;
use xh\unity\cog;
use xh\unity\callbacks;

class service
{
    //构造一个mysql请求
    private $mysql;

    //权限验证
    protected function powerLogin($Mid)
    {
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)) {
            url::address(url::s('admin/index/home'), '您没有权限访问', 3);
        }
        $this->mysql = new mysql();
    }


    public function setLoginStatus()
    {

        $key_id = request::filter('post.key_id', '', 'trim');
        $status = request::filter('post.status', '', 'int');
        if (empty($key_id)) functions::json(-1, '请输入正确的数据进行修改');
        $this->mysql = new mysql();
        $editData = [
            'status'      => $status,
            'active_time' => time(),
        ];
        if ($status == 4) {
            $editData['login_time'] = time();
            $editData['android_heartbeat'] = time();
        }
        $status = $this->mysql->update('service_account', $editData, "key_id='{$key_id}'");
        echo $status;
    }


    //服务版
    //权限ID：27
    public function index()
    {
        $this->powerLogin(27);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        //只看微信
        if ($sorting == 'type') {
            $list = [1, 2,3];
            if (in_array($code, $list)) {
                $_SESSION['SERVICE_ACCOUNT']['WHERE'] = 'types=' . $code . ' ';
            } else {
                unset($_SESSION['SERVICE_ACCOUNT']['WHERE']);
            }
        }

        if ($sorting == 'status') {
            $list = [1, 2,3];
            if (in_array($code, $list)) {
                if ($code == 1) {
                    $_SESSION['SERVICE_ACCOUNT']['WHERE'] = 'status=4 ';
                } else {
                    $_SESSION['SERVICE_ACCOUNT']['WHERE'] = 'status!=4 ';
                }
            } else {
                unset($_SESSION['SERVICE_ACCOUNT']['WHERE']);
            }
        }

        $where = $_SESSION['SERVICE_ACCOUNT']['WHERE'];

        //服务id
        if ($sorting == 'service') {
            if ($code != '') {
                $code = intval($code);
                $where = "id={$code}";
            }
        }
        $result = page::conduct('service_account', request::filter('get.page'), 10, $where, null, 'id', 'asc');

        //支付宝转银行卡
        //获取银行id（简称）
        $bankList = $this->mysql->query('bank_id');
        //print_r($bankList);die;
        $bankStr = '';
        foreach($bankList as $bk=>$bv){
            $bankStr .= "<option value='".$bv['bank_id']."'>".$bv['bank_name']."</option>";
        }

       //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      

        new view('service/index', [
            'mysql'   => $this->mysql,
            'result'  => $result,
            'bankStr'  => $bankStr,
           'areaStr' => $areaStr,
            'signkey' => cog::read("server")['key'],
        ]);
    }

    //添加微信通道
    //权限ID：27
     public function addWechat()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 1,
            'ewmurl'    => $ewmurl
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
    public function addWechatdy()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 9,
            'ewmurl'    => $ewmurl
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
   public function addWechatsj()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 10,
            'ewmurl'    => $ewmurl
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
 
  
   public function addWechatbank()
    {
       $this->powerLogin(27);
        //开始添加通道
       $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $name = $key_id;
        $gathering_name = request::filter('get.gathering_name', '', 'htmlspecialchars');
        $bank_id = request::filter('get.bank_id', '', 'htmlspecialchars');
        $cardid = 0;
        $account_no = request::filter('get.account_no', '', 'htmlspecialchars');

        //echo $gathering_name;die;
        $in = $this->mysql->insert("service_account", [
            'name'              => $gathering_name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 11,
            'is_new_version'    => 1,
            'gathering_name'    => $gathering_name,
            'bank_id'           => $bank_id,
            'cardid'           => $cardid,
            'account_no'           => $account_no,
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条银行卡服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
   public function addpddgm()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 12,
            'ewmurl'    => $ewmurl
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
   public function addalipaygm()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 13,
            'ewmurl'    => $ewmurl
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
     //添加拉卡拉
   public function addlakala()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $lakala_account = request::filter('get.lakala_account', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 4,
            'lakala_account'    => $lakala_account
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
  
    //添加农信易扫
   public function addnxys()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $nxys_account = request::filter('get.nxys_account', ' ', 'htmlspecialchars');
      $nxys_type = request::filter('get.type', ' ', 'htmlspecialchars');
      $ewmurl = request::filter('get.ewmurl', ' ', 'htmlspecialchars');
     $types = request::filter('get.types', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => $types,
            'nxys_account'    => $nxys_account,
           'nx_type'    => $nxys_type,
           'ewmurl'    => $ewmurl,
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
  
  
      //添加云闪付
   public function addyunshanfu()
    {
       $this->powerLogin(27);
        //开始添加通道
      
       $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $yunshanfu_account = request::filter('get.yunshanfu_account', ' ', 'htmlspecialchars');

        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 5,
            'yunshanfu_account'    => $yunshanfu_account
       
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }
    //添加支付宝通道
    //权限ID：27
    public function addAlipay()
    {
       $this->powerLogin(27);
        //开始添加通道
        $is_new_version = request::filter('get.is_new_version', 0, 'intval');
        $name = request::filter('get.name', ' ', 'htmlspecialchars');
       $account = request::filter('get.account', ' ', 'htmlspecialchars');
       $pid = request::filter('get.pid', ' ', 'htmlspecialchars');
       $is_hongbao = request::filter('get.is_hongbao', ' ', 'htmlspecialchars');
        //开始添加通道

        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          => 1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 2,
            'is_new_version'    => $is_new_version,
            'is_hongbao'=>$is_hongbao,
            'account'    => $account,
            'alipay_pid'    =>$pid
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条支付宝服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }


    //添加支付宝通道
    //权限ID：27
    public function addAlipayBank()
    {
        $this->powerLogin(27);
        //开始添加通道

        $key_id = request::filter('get.account', '', 'htmlspecialchars');
        $name = $key_id;
        $gathering_name = request::filter('get.gathering_name', '', 'htmlspecialchars');
        $bank_id = request::filter('get.bank_id', '', 'htmlspecialchars');
        $cardid = request::filter('get.cardid', '', 'htmlspecialchars');
        $account_no = request::filter('get.account_no', '', 'htmlspecialchars');

        //echo $gathering_name;die;
        $in = $this->mysql->insert("service_account", [
            'name'              => $name,
            'status'            => 4,
            'login_time'        => 0,
            'heartbeats'        => 0,
            'active_time'       => 0,
            'key_id'            => $key_id,
            'training'          =>1,
            'receiving'         => 1,
            'android_heartbeat' => 0,
            'types'             => 3,
            'is_new_version'    => 1,
            'gathering_name'    => $gathering_name,
            'bank_id'           => $bank_id,
            'cardid'           => $cardid,
            'account_no'           => $account_no,
        ]);

        if ($in > 0) functions::json(200, '恭喜您新增了一条银行卡服务通道!');
        functions::json(-3, '添加失败,请联系管理员!');
    }

    //登录账号
    //权限ID：27
    public function login()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该账号
        $find = $this->mysql->query("service_account", "id={$id}")[0];
        if (!is_array($find)) functions::json(-3, '当前账号出现异常,请联系客服!');
        if ($find['status'] == 4 || $find['status'] == 6) functions::json(-3, '当前账号状态无法进行登录,请稍后重试!');
        $update = $this->mysql->update("service_account", [
            'status'     => 2,
            'login_time' => time()
        ], "id={$id}");
        functions::json(200, '正在获取登录信息..');
    }
    //获取登录装填
    //权限ID：27
    public function loginStatus()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该账号
        $find = $this->mysql->query("service_account", "id={$id}")[0];
        //判断账号
        if ($find['login_time'] + 120 < time() || $find['status'] == 6 || $find['status'] == 5 || $find['status'] == 1) {
            $this->mysql->update("service_account", ['status' => 1], "id={$id}");
            functions::json(-2, '登录服务超时!');
        }
        if ($find['status'] == 2) functions::json(2, '正在获取登录信息..');
        if ($find['status'] == 3) functions::json(3, '登录信息获取成功,准备登录..');
        if ($find['status'] == 7) functions::json(7, '请扫码登录', ['img' => $find['login_img']]);
        if ($find['status'] == 4) functions::json(4, '登录成功');
    }

    //启动轮训
    //权限ID: 27
    public function startRobin()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该服务
        $find = $this->mysql->query("service_account", "id={$id}")[0];
      //  if (!is_array($find)) functions::json(-3, '更改异常!');
        $training = 2;
        if ($find['training'] == 2) {
            //开启状态
            $training = 1;
            if($find['types']<3) {
                //检测账号是否异常
                //if ($find['status'] != 4) functions::json(-3, '更改失败,当前服务没有在线!');
            }
        }
        $update = $this->mysql->update("service_account", [
            'training' => $training
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改轮训成功!');
        functions::json(-2, '更改失败!');
    }

    //启动网关
    //权限ID: 27
    public function startGateway()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该服务
        $find_alipay = $this->mysql->query("service_account", "id={$id}")[0];
      //  if (!is_array($find_alipay)) functions::json(-3, '更改异常!');
        $receiving = 2;
        if ($find_alipay['receiving'] == 2) {
            //开启状态
            $receiving = 1;
            if($find_alipay['types']<3) {
                //检测账号是否异常
           //     if ($find_alipay['status'] != 4) functions::json(-3, '更改失败,当前服务没有在线!');
            }
        }
        $update = $this->mysql->update("service_account", [
            'receiving' => $receiving
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改网关成功!');
        functions::json(-2, '更改失败!');
    }

    //设置为主要系统收款账号
    public function setLord()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该服务
        $find_alipay = $this->mysql->query("service_account", "id={$id}")[0];
      //  if (!is_array($find_alipay)) functions::json(-3, '更改异常!');
        $lord = 1;
        if ($find_alipay['lord'] == 1) {
            //开启状态
            $lord = 0;
        }
        $update = $this->mysql->update("service_account", [
            'lord' => $lord
        ], "id={$id}");
        if ($update > 0) functions::json(200, '设置成功!');
        functions::json(-2, '更改失败!');
    }

    //安全注销
    //权限ID: 27
    public function startLogOut()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该服务
        $find_alipay = $this->mysql->query("service_account", "id={$id}")[0];
       // if (!is_array($find_alipay)) functions::json(-3, '当前支付宝出现异常!');
      //  if ($find_alipay['status'] == 6 || $find_alipay['status'] == 1) functions::json(-3, '当前服务已经安全注销过了!');
        $update = $this->mysql->update("service_account", [
            'status' => 1
        ], "id={$id}");
        if ($update > 0) functions::json(200, '安全注销成功!');
        functions::json(-2, '注销失败!');
    }

    //删除服务
    //权限ID: 27
    public function delete()
    {
        $this->powerLogin(27);
        $id = intval(request::filter('get.id'));
        //检查该服务
        $find_alipay = $this->mysql->query("service_account", "id={$id}")[0];
       // if (!is_array($find_alipay)) functions::json(-2, '删除该服务时出现一个错误!');
        //if ($find_alipay['status'] == 6) functions::json(-2, '当前服务正在进行安全注销,请耐心等待注销完成后再进行删除!');
        // if ($find_alipay['status'] != 1) functions::json(-2, '请将服务安全下线后再进行删除!');
        $this->mysql->delete("service_account", "id={$id}");
        functions::json(200, '您成功的删除了该服务!');
    }

    //订单管理
    //权限ID：26
    public function order()
    {
        $this->powerLogin(26);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        //只看微信
        if ($sorting == 'type') {
            $list = [1, 2 , 3 , 4 , 5,6,7,8];
            if (in_array($code, $list)) {
                $_SESSION['SERVICE']['WHERE'] = 'types=' . $code . ' ';
            } else {
                unset($_SESSION['SERVICE']['WHERE']);
            }
        }

        //锁定用户查找
        if ($sorting == 'user') {
            if (!empty($code)) {
                $_SESSION['SERVICE']['WHERE'] = 'user_id=' . $code . ' ';
            } else {
                unset($_SESSION['SERVICE']['WHERE']);
            }
        }

        //account
        if ($sorting == 'account') {
            $list = [1, 2];
            if (in_array($code, $list)) {
                if ($code == 1) {
                    $_SESSION['SERVICE']['WHERE'] = 'user_id=0';
                } else {
                    $_SESSION['SERVICE']['WHERE'] = 'user_id != 0';
                }

            } else {
                unset($_SESSION['SERVICE']['WHERE']);
            }
        }

        $where = $_SESSION['SERVICE']['WHERE'];

        //排序
        if ($sorting == 'status') {
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= 'and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback') {
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= 'and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }

        //订单号
        if ($sorting == 'trade_no') {
            if ($code != '') {
                $code = trim($code);
                $where = " trade_no='{$code}'";
            }
        }

        //服务id
        if ($sorting == 'service') {
            if ($code != '') {
                $code = intval($code);
                $where = "service_id={$code}";
            }
        }

        if ($start_time && $end_time) {
            if (!$code) {
                $where .= "creation_time BETWEEN {$start_time} AND {$end_time}";
            } else {
                $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
            }
        }
        $where = trim($where, 'and');
       // echo $where;die;
        $result = page::conduct('service_order', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('service/order', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'where'   => $where
        ]);
    }

    //手动回调管理员版
    //权限ID：26
    public function callback()
    {
        $this->powerLogin(26);
        $module_name = 'service_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $this->mysql->query('service_order', "id={$order_id}")[0];
        $fees = $order['fees'];
        if (!is_array($order)) functions::json(-2, '当前订单不存在');
        if ($order['user_id'] != 0) {
            //查询用户
            $user = $this->mysql->query("client_user", "id={$order['user_id']}")[0];
            if (!is_array($user)) functions::json(-2, '该订单的主用户不存在');
        } else {
            $user['username'] = "SYSTEM_CALLBACK";
            $user['key_id'] = cog::read('server')['key'];
        }

        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
            $authority = json_decode($group['authority'], true)[$module_name];
            $fees = $order['amount'] * $authority['cost'];
          
            $fees1 = $order['amount']-$fees;
            $user_money = $user['money'] + $fees1; // 用户最终余额

                // 扣除费用
                $deductionStatus = $this->mysql->update("client_user", [
                    'money' => $user_money
                ], "id={$user['id']}");
              
          
            $this->mysql->update("service_order", [
                'pay_time' => time(),
                'status'   => 4
            ], "id={$order['id']}");
        }
        if ($order['pay_time'] == 0) {
            $pay_time = time();
        } else {
            $pay_time = $order['pay_time'];
        }
        $callback_time = time();
        $result = callbacks::curl($order['callback_url'], http_build_query([
            'account_name'  => $user['username'],
            'pay_time'      => $pay_time,
            'status'        => 'success',
            'amount'        => $order['amount'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'fees'          => $fees,
            'sign'          => functions::sign($user['key_id'], [
                'amount'       => $order['amount'],
                'out_trade_no' => $order['out_trade_no']
            ]),
            'callback_time' => $callback_time,
            'type'          => $order['types'],
            'account_key'   => $user['key_id']

        ]));

        $this->mysql->update("service_order", [
            'pay_time'         => $pay_time,
            'callback_time'    => $callback_time,
            'callback_status'  => 1,
            'callback_content' => '后台手动回调',
            'fees'             => $fees
        ], "id={$order['id']}");
        $url = $_SERVER['SERVER_NAME'] . '/server/service/callback';
        $data = [];
        $data['id'] = $order['service_id'];
        functions::curlPostRequest($url, $data);
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
        //-----------------------------
    }


    //删除订单ID,管理员版
    //权限ID：26
    public function orderDelete()
    {
        $this->powerLogin(26);
        $id = intval(request::filter('get.id'));
        $this->mysql->delete("service_order", "id={$id}");
        functions::json(200, '您成功的删除了该订单!');
    }

    //通道测试
    //权限ID: 27
    public function robinTest()
    {
        $this->powerLogin(27);
        new view('service/robinTest');
    }

    //单通道测试
    public function gatewayTest()
    {
        $this->powerLogin(27);
        new view('service/gatewayTest');
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
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $where = "";
        $this->mysql = new mysql();
        if ($code != 'null' && !empty($code)) {
            $where .= "id = " . $code;
        }
        if ($start_time && $end_time) {
            if ($code) {
                $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
            } else {
                $where .= "creation_time BETWEEN {$start_time} AND {$end_time}";
            }
        }
        if ($start_time == 'null' && $end_time == 'null' && $code == 'null') {
            $list = $this->mysql->query("service_order", "1=1");
        } else {
            $list = $this->mysql->query("service_order", $where);
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
            if ($value['types'] == 1) {
                $list[$key]['types'] = '微信';
            } else {
                $list[$key]['types'] = '支付宝';
            }
        }
        $name = '服务订单';
        $data_info = array(
            array('id', '订单ID'),
            array('user_id', '商户ID'),
            array('user_name', '商户名称'),
            array('phone', '商户手机号'),
            array('trade_no', '交易订单号'),
            array('service_id', '服务ID'),
            array('amount', '金额'),
            array('percentage', '抽成'),
            array('status', '交易状态'),
            array('pay_time', '支付时间'),
            array('fees', '手续费'),
            array('pay_time', '异步通知时间'),
            array('callback_status', '异步通知状态'),
            array('callback_from', '异步通知'),
            array('callback_content', '回调信息'),
            array('creation_time', '订单创建时间'),
            array('types', '支付类型'),
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
        $mysql->update("service_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
    public function editdyname()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $amount = request::filter('get.amount');
        //检查该微信
        $update['dy_name'] = $amount;
        $mysql->update("service_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

     public function editMaxdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $dd = request::filter('get.dd');
        //检查该微信
        $update['max_dd'] = $dd;
        $mysql->update("service_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
   public function areaAdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $area = request::filter('get.area');
        //检查该微信
        $update['area'] = $area;
        $mysql->update("service_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
    /**
     * 修改备注
     */
    public function editAppuser()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $app_user = request::filter('get.app_user');
        //检查该微信
        $update['app_user'] = $app_user;
        $mysql->update("service_account", $update, "id={$id}");
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
            $update_id = $mysql->update("service_account", ['receiving' => 2], "key_id='{$key_id}'");
            if ($update_id > 0) {
                \xh\library\gateway::withdraw(SERVER_BIND_UID, $pwd, $key_id, 0, $type);
                functions::json(200, '成功');
            }

        }
        functions::json(-1, '通道关闭失败');

    }

    //订单管理
    //无匹配订单
    public function notOrder()
    {
        $this->powerLogin(26);
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $code = request::filter('get.code', '', 'htmlspecialchars');

        $where = '';

        if ($start_time && $end_time) {
            if (!$code) {
                $where .= "creation_time BETWEEN {$start_time} AND {$end_time}";
            } else {
                $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
            }
        }
        $where = trim($where, 'and');
         //echo $where;die;
        $result = page::conduct('service_order_no', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        //print_r($result);die;
        new view('service/notOrder', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
               // 'name' => $sorting
            ],
            'where'   => $where
        ]);
    }


    //手动回调管理员版
    //权限ID：26
    public function callbackNo()
    {
        $this->powerLogin(26);
        $module_name = 'service_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $this->mysql->query('service_order_no', "id={$order_id}")[0];

        $this->mysql->update("service_order_no", [
            'pay_time' => time(),
            'status'   => 1
        ], "id={$order['id']}");

        //-----------------------------
    }


}
