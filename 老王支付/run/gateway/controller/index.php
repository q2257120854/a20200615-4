<?php

namespace xh\run\gateway\controller;


use xh\library\request;
use xh\library\mysql;
use xh\library\functions;
use xh\unity\cog;
use xh\library\ip;
use xh\library\url;
use xh\unity\encrypt;
use xh\unity\userCog;

class index
{

    private $mysql;
    private $redis;
    private $amount = 0;
    private $alipay_url = "alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO";
    private $apiDomainArray = ['http://getip2.1088web.com/', 'http://ip.taobao.com/service/getIpInfo.php'];  //获取地址接口数组
  

    public function __construct()
    {
        $this->mysql = new mysql();
        $this->redis = functions::getRedis();
    }

    public function getAndroidHeartbeatNow()
    {
        return functions::getAndroidHeartbeatNowTime();
    }


    //端口：automatic
    //网关关卡
    //通讯端口：80
    public function checkpoint()
    {
  

        $data = [];
        //网页类型
        $type = request::filter('post.content_type', '', 'htmlspecialchars');
        //商户ID
        $acc_id = intval(request::filter('post.account_id'));
        //通道
        $thoroughfare = request::filter('post.thoroughfare', '', 'htmlspecialchars');

        //检测是否轮训
        $data['robin'] = intval(request::filter('post.robin'));
       $data['use_city'] = intval(request::filter('post.use_city'));
        //callback_url
        $data['callback_url'] = request::filter('post.callback_url', '', 'htmlspecialchars');
        //success_url
        $data['success_url'] = request::filter('post.success_url', '', 'htmlspecialchars');
        //error_url
        $data['error_url'] = request::filter('post.error_url', '', 'htmlspecialchars');
        //out_trade_no
        $data['out_trade_no'] = request::filter('post.out_trade_no', '', 'htmlspecialchars');
        //trade_no -> 自动生成
        $data['trade_no'] = mt_rand(10000, 99999) . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 6);
        //amount
        $data['amount'] = floatval(request::filter('post.amount'));
        //type -> service_auto -> 专用类型
        $data['type'] = intval(request::filter('post.type'));
        //sign
        $sign = request::filter('post.sign', '', 'htmlspecialchars');
        if ($data['amount'] <= 0) functions::str_json($type, -1, '支付金额不正确');
        if (empty($data['callback_url']) || empty($data['success_url']) || empty($data['error_url'])) functions::str_json($type, -1, 'callback_url(异步通知)、success_url(成功跳转)、error_url(失败跳转), 等地址不能空参数');
        if (empty($data['out_trade_no'])) functions::str_json($type, -1, '没有交易信息,请检查参数是否正确');
        if (!is_array(cog::read('costCog')[$thoroughfare])) functions::str_json($type, -1, '当前通道不存在');
        $find_user = $this->mysql->query("client_user", "id={$acc_id}")[0];
        if (!is_array($find_user) && !is_array($_SESSION['SYSTEM_PAY_ID'])) functions::str_json($type, -1, '该商户不存在');
        //检测是否系统订单
        if (is_array($_SESSION['SYSTEM_PAY_ID'])) {
            $find_user['key_id'] = cog::read('server')['key'];
        }

        //验证签名
        if ($sign != functions::sign($find_user['key_id'], ['amount' => $data['amount'], 'out_trade_no' => $data['out_trade_no']])) functions::str_json($type, -3, '签名失败');
        //automatic 微信全自动版
        if ($thoroughfare == 'wechat_auto') {
            $this->automatic($find_user, $type, $data);
        }
        if ($thoroughfare == 'wechatsj_auto') {
            $this->wechatsj($find_user, $type, $data);
        }
       if ($thoroughfare == 'wechatdy_auto') {
            $this->wechatdy($find_user, $type, $data);
        }
        if ($thoroughfare == 'wechatbank_auto') {
            $this->wechatbank($find_user, $type, $data);
        }
        if ($thoroughfare == 'pddgm_auto') {
            $this->pddgm($find_user, $type, $data);
        }
        //支付宝版本
        if ($thoroughfare == 'alipay_auto') {
            $this->alipay($find_user, $type, $data);
        }
        //支付宝固码
        if ($thoroughfare == 'alipaygm_auto') {
            $this->alipaygm($find_user, $type, $data);
        }
       //支付宝转红包
        if ($thoroughfare == 'alipayhongbao_auto') {
            $this->alipayhongbao($find_user, $type, $data);
        }
        //支付宝银行卡转账版本
        if ($thoroughfare == 'bank_auto') {
            $this->bank($find_user, $type, $data);
        }
        //云闪付版本
        if ($thoroughfare == 'yunshanfu_auto') {
            $this->yunshanfu($find_user, $type, $data);
        }
       //拉卡拉版本
        if ($thoroughfare == 'lakala_auto') {
            $this->lakala($find_user, $type, $data);
        }
      
        //农信易扫微信
        if ($thoroughfare == 'nxyswx_auto') {
            $this->nxyswx($find_user, $type, $data);
        }
      //农信易扫支付宝
        if ($thoroughfare == 'nxysalipay_auto') {
            $this->nxysalipay($find_user, $type, $data);
        }
      //农信易扫银联
        if ($thoroughfare == 'nxysyl_auto') {
            $this->nxysyl($find_user, $type, $data);
        }
       //收钱吧
        if ($thoroughfare == 'shouqianba_auto') {
            $this->shouqianba($find_user, $type, $data);
        }
       //收钱吧
        if ($thoroughfare == 'shouqianba_auto') {
            $this->shouqianba($find_user, $type, $data);
        }
        //服务版本
        if ($thoroughfare == 'service_auto') {
            $this->service($find_user, $type, $data);
        }
    }

  
  
   /**
     * 获取用户真实 IP
     */
      public function getIP()
      {
        static $realip;
        if (isset($_SERVER)){
          if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
          } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
          } else {
            $realip = $_SERVER["REMOTE_ADDR"];
          }
        } else {
          if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
          } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
          } else {
            $realip = getenv("REMOTE_ADDR");
          }
        }
        return $realip;
      }

    /**
     * 获取 IP  地理位置
     * 淘宝IP接口
     * @Return: array
     */
      public  function getCity($ip = '')
      {
        //查询数据里面是否有数据 如果有数据则用数据库里面的数据
        $ipInfo = $this->getIpInfo($ip);
        if($ipInfo){
           return (array)$ipInfo->data;
        }
        //如果数据库没数据则用第三方接口
        if($ip == ''){
          $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
          $request = file_get_contents($url);
          $ipresult=json_decode($request,true);
          $data = $ipresult;
        }else{
          
          //随机选择获取ip信息接口
          $url = $this->apiDomainArray[rand(0,(count($this->apiDomainArray)-1))].'?ip='.$ip.'&token=0f4c38f064822242887fc5a8f7cac681';
          $request = file_get_contents($url);
          $ipresult=json_decode($request);
          if((string)$ipresult->code=='1'){
            return false;
          }
          $data = (array)$ipresult->data;
          if((string)$ipresult->code=='0'){
             //把接口请求到的数据存到数据库
             $this->setIpInfo($ip, $request);
          }  
        }
        
        return $data;
      }
  
  
    //获取数据库里面的IP信息
    public function getIpInfo($ip){
      $ipInfo = $this->mysql->query("ip_info", "ip = '".$ip."'");
      ///如果数据库没有IP数据
      if(count($ipInfo) == 0){
        return false;
      }
      return json_decode($ipInfo[0]['info']);
    }
  
    
    //新增IP信息
    public function setIpInfo($ip, $info){
      $data['ip'] = $ip;
      $data['info '] = $info;
      $data['create_time'] = time();
      return $this->mysql->insert('ip_info', $data);
    }
  
  
    

    //全自动版支付宝固码
    private function alipaygm($user, $type_content, $data)
    {

        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
        //查询用户组
        $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['alipaygm_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        //$now_time = $this->getAndroidHeartbeatNow();
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $find_alipaygm = functions::getRobin("alipaygm_{$user['id']}");
     $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法

          
          
          $find_alipaygm = $this->mysql->query("client_alipaygm_automatic_account", "status=4 and user_id={$user['id']} and training=1 and receiving=1 ");
           $count_alipaygm = count($find_alipaygm);
          if ($count_alipaygm == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
           $find_alipaygm = $find_alipaygm[mt_rand(0, $count_alipaygm - 1)];

        } else {
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_alipaygm = $this->mysql->query("client_alipaygm_automatic_account", "key_id='{$key_id}'")[0];
            if (!is_array($find_alipaygm)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            // print_r($find_alipaygm);
            //echo $now_time;
            if ($find_alipaygm['status'] != 4 || $user['id'] != $find_alipaygm['user_id'] || $find_alipaygm['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到alipaygm参数

        if (empty($find_alipaygm)) functions::str_json($type_content, -1, 'automatic->无可用通道,请联系客服');
      
   
      	
	
        $create_order = $this->mysql->insert('client_alipaygm_automatic_orders', [
            'alipaygm_id'     => $find_alipaygm['id'],
            'creation_time' => time(),
            'pay_time'      => 0,
            'status'        => 2,
            'amount'        =>$data['amount'],
            'ymoney'        =>$data['amount'],
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
          	'wb_uid'     		=> $find_alipaygm['uid'],
          	'wb_cookie'     	=> $find_alipaygm['cookie'],
          'key_id'     	=> $find_alipaygm['key_id'],
        ]);
        $qrcode = '';
        if ($create_order > 0) {
            $mark = $find_alipaygm['id'] . '|' . $create_order;
            if ($find_alipaygm['is_new_version'] == 1) {
                $qrcode ="http://".DOMAINS_URL."/gateway/pay/zzh5.do?id={$create_order}";     
               
                $this->mysql->update('client_alipaygm_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            }else{
                $qrcode ="http://".DOMAINS_URL."/gateway/pay/zzh5.do?id={$create_order}";     
                $this->mysql->update('client_alipaygm_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            } 

            if ($type_content == 'json') {
                if (!$find_alipaygm['is_new_version']) {
                    $qrcode = functions::syncRequest('alipaygm_' . intval($create_order), 50000);
                }

                $json_qrcode = "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipaygms://platformapi/startapp?appId=10000007&qrcode=" . url::s("gateway/pay/automaticalipaygm", "id={$create_order}"));

                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode, 'qrcode_url' => $qrcode, 'qrcode_url2' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/automaticalipaygm", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');
    }

    private function alipayhongbao($user, $type_content, $data)
    {

        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
        //查询用户组
        $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['alipay_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = $this->getAndroidHeartbeatNow();
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $find_alipay = functions::getRobin("alipay_{$user['id']}");
            $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_alipay = $this->mysql->query("client_alipay_automatic_account as c","c.status=4 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.is_hongbao=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_alipay_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.alipay_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_alipay_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.alipay_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_alipay = count($find_alipay);
                if ($count_alipay == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_alipay = $find_alipay[mt_rand(0,$count_alipay-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_alipay = $this->mysql->query("client_alipay_automatic_account as c","c.status=4 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
              and c.is_hongbao=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_alipay_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.alipay_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_alipay_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.alipay_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_alipay = count($find_alipay);
                if ($count_alipay == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_alipay = $find_alipay[mt_rand(0,$count_alipay-1)];
          }


        } else {
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_alipay = $this->mysql->query("client_alipay_automatic_account", "key_id='{$key_id}'")[0];
            if (!is_array($find_alipay)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            // print_r($find_alipay);
            //echo $now_time;
            if ($find_alipay['status'] != 4 || $user['id'] != $find_alipay['user_id'] || $find_alipay['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到alipay参数

        if (empty($find_alipay)) functions::str_json($type_content, -1, 'automatic->无可用通道,请联系客服');
    

        $create_order = $this->mysql->insert('client_alipay_automatic_orders', [
            'alipay_id'     => $find_alipay['id'],
            'creation_time' => time(),
            'pay_time'      => 0,
            'status'        => 2,
            'amount'        => $data['amount'],
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
           'app_user'=>$find_alipay['app_user']
        ]);
        $qrcode = '';
        if ($create_order > 0) {
            $mark = $find_alipay['id'] . '|' . $create_order;
          
                $qrcode ="https://ds.alipay.com/?from=mobilecodec&scheme=alipayqr%3A%2F%2Fplatformapi%2Fstartapp%3FsaId%3D10000007%26qrcode%3Dhttp%3a%2f%2f".DOMAINS_URL."%2fgateway%2fpay%2fhbh5.do%3fid%3d{$create_order}";              
                $this->mysql->update('client_alipay_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

           

            if ($type_content == 'json') {
                if (!$find_alipay['is_new_version']) {
                    $qrcode = functions::syncRequest('alipay_' . intval($create_order), 50000);
                }

                $json_qrcode = "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?appId=10000007&qrcode=" . url::s("gateway/pay/automaticAlipay", "id={$create_order}"));

                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode, 'qrcode_url' => $qrcode, 'qrcode_url2' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/automaticAlipay", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');
    }



    //服务版
    private function service($user, $type_content, $data)
    {

        //检测类型是否正确
        $pay_type = [1, 2, 3 ,4 ,5 ,6,7,8,9,10,11,12,13];
        if (!in_array($data['type'], $pay_type)) functions::str_json($type_content, -1, 'service->类型初始化失败!');
        if ($data['type'] == 1) {
            if ($data['amount'] > 15000) functions::str_json($type_content, -1, '支付金额不能大于15000元');
        }
        if ($data['type'] == 2) {
            if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
        }

        //系统where
        $where_system = '';
        $where_gateway = '';

        //检测是否系统订单
        if (is_array($_SESSION['SYSTEM_PAY_ID'])) {

            $user['id'] = 0;
            $where_system = 'and lord=1';
            if ($data['type'] == 3) $where_gateway =  ' lord=1 and ';
        } else {

            //不是系统订单，user信息生效
            //查询用户组
            $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['service_auto'];
            //判断用户组是否存在
            if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');


            //分割 or gateway
            $redis_data = functions::getRobin("service_{$user['group_id']}_{$data['type']}");

            if ($redis_data) {
                $group['gateway'][] = $redis_data;
            }
            $gateway_count = count($group['gateway']);
            for ($i = 0; $i < $gateway_count; $i++) {
                $where_gateway .= 'id=' . $group['gateway'][$i] . ' or ';
            }
            $where_gateway = '(' . trim(trim(trim($where_gateway), 'or')) . ') and ';


        }

        //现在的时间
        $now_time = $this->getAndroidHeartbeatNow();

        if ($data['type'] == 3) {
            $this->serviceBank($user, $type_content, $data ,$where_gateway);return;

        }

        //轮训
        if ($data['robin'] == 2) {

            //读取轮训算法ID
            // $find_service = functions::getRobin("service_{$user['group_id']}");
            // if (!is_array($find_service)) {
            //读取轮训算法ID
            $robin = userCog::read('serviceConfig', 0)['robin'];
            if (empty($robin)) $robin = 1;
           // $robin = 2;
            //随机算法 v1.2
             if ($data['robin'] == 2) {
                //随机算法
             //   $find_service = $this->mysql->query("service_account", "{$where_gateway}status=4 and training=1 and receiving=1 AND types={$data['type']} {$where_system}");
        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_service = $this->mysql->query("service_account as c","c.status=4 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.training=1 
              and c.receiving=1 
			  and c.types={$data['type']}
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_service_order as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.service_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_service_order as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.service_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_service = count($find_service);
                if ($count_service == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_service = $find_service[mt_rand(0,$count_service-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_service = $this->mysql->query("service_account as c","c.status=4 
              and c.training=1 
              and c.receiving=1 
			  and c.types={$data['type']}
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_service_order as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.service_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_service_order as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.service_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_service = count($find_service);
                if ($count_service == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_service = $find_service[mt_rand(0,$count_service-1)];
          }
           // }
          
            //顺序模式算法 v1.0
          //  if ($robin == 3) {
              //  $find_service = $this->mysql->query("service_account", "{$where_gateway}status=4 and training=1 and receiving=1  and types={$data['type']} {$where_system}", null, "id", "asc");
              //  $find_service = $find_service[0];
           // }
              }

        } else {
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_service = $this->mysql->query("service_account", "key_id='{$key_id}'")[0];

            if (!is_array($find_service)) functions::str_json($type_content, -1, 'service->请稍后,支付通道抢修中..');


            if ($find_service['status'] != 4 || $find_service['receiving'] != 1 ) {
                functions::str_json($type_content, -1, 'service->请稍后,支付通道抢修中..');
            }

        }


        // print_r($find_service);die;

        unset($_SESSION['SYSTEM_PAY_ID']);
        //已经得到参数
        if (empty($find_service)) functions::str_json($type_content, -1, 'automatic->无可用通道,请联系客服');
 
      if ($data['type'] == 1) {
      
       	
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=1 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else if($data['type'] == 4){
        
          $min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=4 and amount={$money} and service_id={$find_service['id']} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
      }else if($data['type'] == 8){
        
          $min=0.01;
		$max=0.09;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=8 and amount={$money}  and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
      }else if($data['type'] == 7){
        
          $min=0.01;
		$max=0.09;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=7 and amount={$money} and service_id={$find_service['id']} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
      }else if($data['type'] == 6){
        
          $min=0.01;
		$max=0.09;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=6 and amount={$money} and service_id={$find_service['id']} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
      }else if ($data['type'] == 9) {
      
       	
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=9 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else if ($data['type'] == 10) {
      
       	
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=10 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else if ($data['type'] == 11) {
     
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=11 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else if ($data['type'] == 12) {
      
       	
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=12 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else if ($data['type'] == 13) {
      
       	
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("service_order","status=2 and types=13 and amount={$money} and service_id={$find_service['id']}",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}

        }else {
      
        $money = $data['amount'];
      
      }
      
       if ($data['type'] == 11) {
      $bank_name = $this->mysql->query("bank_id", "bank_id='{$find_service['bank_id']}'")[0]['bank_name'];
       }else{
       $bank_name =0;
       }
        //生成订单
      if($data['type'] == 9){ $dyname=$find_service['dy_name']; }else{ $dyname= 0;}
        $create_order = $this->mysql->insert('service_order', [
            'service_id'    => $find_service['id'],
            'creation_time' => time(),
            'pay_time'      => 0,
            'status'        => 2,
            'amount'        => $money,
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
            'types'         => $find_service['types'],
           'nx_type'         => $find_service['nx_type'],
           'ymoney'         => $data['amount'],
           'dy_name'=>$find_service['dy_name'],
           'app_user'=>$find_service['app_user'],
           'bank_name'=>$bank_name
        ]);
        if ($create_order > 0) {


            $paytypes = ['1' => 'wechat', '2' => 'alipay', '3' => 'bank', '4' => 'lakala', '5' => 'yunshanfu', '6' => 'nxyswx', '7' => 'nxysalipay', '8' => 'nxysyl', '9' => 'wechatdy', '10' => 'wechatsj', '11' => 'wechatbank', '12' => 'pddgm', '13' => 'alipaygm'];
            $service = $this->mysql->query("service_account", "id={$find_service['id']}")[0];

            $mark = $find_service['id'] . '|' . $create_order;
            if ($find_service['is_new_version'] == 1 && $find_service['types'] == 2) {
                $qrcode = url::s("gateway/pay/szzh5", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ($find_service['is_hongbao'] == 1 && $find_service['types'] == 2) {
                $qrcode = url::s("gateway/pay/shbh5", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            } else  if ( $find_service['types'] == 1) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 4) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 5) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 6) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 7) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 8) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 9) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 10) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 11) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 12) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else  if ( $find_service['types'] == 13) {
                $qrcode = url::s("gateway/pay/service", "id={$create_order}");
                $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");
            }else {

                \xh\library\gateway::getQrCode(SERVER_BIND_UID, $mark, $data['amount'], $service['key_id'], $paytypes[$service['types']]);

            }

            if ($type_content == 'json') {
                if (!$find_service['is_new_version']) {

                    $qrcode = functions::syncRequest('service_' . intval($create_order), 50000);
                }

                if ($find_service['types'] == 1) {
                    functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $qrcode]);

                } else {
                    $json_qrcode = "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?appId=10000007&qrcode=" . url::s("gateway/pay/service", "id={$create_order}"));

                    functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode, 'qrcode_url' => $qrcode, 'qrcode_url2' => $json_qrcode]);
                }

            }

            url::address(url::s("gateway/pay/service", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'service->订单创建失败,请联系客服');
    }

  
  
  //拉卡拉
    //全自动版支付宝
    private function lakala($user,$type_content,$data){
		
		 if ($user['balance'] < 1) functions::str_json($type_content, -1, '接口余额不足1元，请充值后使用');
		
        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
		
        //查询用户组
		
			
			
        $group = json_decode($this->mysql->query('client_group',"id={$user['group_id']}")[0]['authority'],true)['lakala_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time()-20;
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $robin = userCog::read('lakalaConfig', $user['id'])['robin'];
            //随机算法 v1.2
            
                //随机算法
            //$find_lakala = $this->mysql->query("client_lakala_automatic_account","status=1 and user_id={$user['id']} and training=1 and receiving=1 ");
      $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_lakala = $this->mysql->query("client_lakala_automatic_account as c","c.status=1 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_lakala_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.lakala_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_lakala_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.lakala_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_lakala = count($find_lakala);
                if ($count_lakala == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_lakala = $find_lakala[mt_rand(0,$count_lakala-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_lakala = $this->mysql->query("client_lakala_automatic_account as c","c.status=1 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_lakala_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.lakala_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_lakala_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.lakala_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_lakala = count($find_lakala);
                if ($count_lakala == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_lakala = $find_lakala[mt_rand(0,$count_lakala-1)];
          }
       
            
        }else{
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId','','htmlspecialchars');
            $find_lakala = $this->mysql->query("client_lakala_automatic_account","key_id='{$key_id}'")[0];
            if (!is_array($find_lakala)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            if ($find_lakala['status'] != 1 || $user['id'] != $find_lakala['user_id'] || $find_lakala['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到lakala参数
        //生成订单
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_wechat_automatic_orders","status=2 and wechat_id={$find_wechat['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
	
        $create_order  = $this->mysql->insert('client_lakala_automatic_orders', [
            'lakala_id'=>$find_lakala['id'],
            'creation_time'=>time(),
			'expire_time' => time()+300,
            'pay_time'=>0,
            'status'=>2,
            'amount'=>$money,
            'callback_url'=>$data['callback_url'],
            'success_url'=>$data['success_url'],
            'error_url'=>$data['error_url'],
            'user_id'=>$user['id'],
            'callback_time'=>0,
            'out_trade_no'=>$data['out_trade_no'],
            'ip'=>ip::get(),
            'trade_no'=>$data['trade_no'],
           'app_user'=>$find_lakala['app_user']
			
        ]);
        if ($create_order > 0){
            if ($type_content == 'json'){
                functions::str_json($type_content, 200, 'success',["order_id"=>$create_order]);
            }
            url::address(url::s("gateway/pay/automaticlakala","id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服 846865108');
    }
  
  
   //农信易扫微信
    private function nxyswx($user,$type_content,$data){
		
		 if ($user['balance'] < 1) functions::str_json($type_content, -1, '接口余额不足1元，请充值后使用');
		
        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
		
        //查询用户组
		
			
			
        $group = json_decode($this->mysql->query('client_group',"id={$user['group_id']}")[0]['authority'],true)['nxyswx_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time()-20;
        //轮训
         if ($data['robin'] == 2) {
            //读取轮训算法ID
            $robin = userCog::read('nxysConfig', $user['id'])['robin'];
            //随机算法 v1.2
            
                //随机算法
             //   $find_nxys = $this->mysql->query("client_nxys_automatic_account","status=1 and user_id={$user['id']} and training=1 and receiving=1  and type=0");
         $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
          }
       
            
        }else{
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId','','htmlspecialchars');
            $find_nxys = $this->mysql->query("client_nxys_automatic_account","key_id='{$key_id}'")[0];
            if (!is_array($find_nxys)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            if ($find_nxys['status'] != 1 || $user['id'] != $find_nxys['user_id'] || $find_nxys['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到nxys参数
        //生成订单

      $min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_nxys_automatic_orders","status=2 and nxys_id={$find_nxys['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
     
	
        $create_order  = $this->mysql->insert('client_nxys_automatic_orders', [
            'nxys_id'=>$find_nxys['id'],
            'creation_time'=>time(),
			'expire_time' => time()+300,
            'pay_time'=>0,
            'status'=>2,
            'amount'=>$money,
            'callback_url'=>$data['callback_url'],
            'success_url'=>$data['success_url'],
            'error_url'=>$data['error_url'],
            'user_id'=>$user['id'],
            'callback_time'=>0,
            'out_trade_no'=>$data['out_trade_no'],
            'ip'=>ip::get(),
            'trade_no'=>$data['trade_no'],
           'app_user'=>$find_nxys['app_user'],
          'type'=>$find_nxys['type'],
           'qrcode'=>$find_nxys['qrcode']
			
        ]);
        if ($create_order > 0){
            if ($type_content == 'json'){
                functions::str_json($type_content, 200, 'success',["order_id"=>$create_order]);
            }
            url::address(url::s("gateway/pay/automaticnxys","id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服 846865108');
    }
  
  //农信易扫微信
    private function nxysalipay($user,$type_content,$data){
		
		 if ($user['balance'] < 1) functions::str_json($type_content, -1, '接口余额不足1元，请充值后使用');
		
        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
		
        //查询用户组
		
			
			
        $group = json_decode($this->mysql->query('client_group',"id={$user['group_id']}")[0]['authority'],true)['nxysalipay_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time()-20;
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $robin = userCog::read('nxysConfig', $user['id'])['robin'];
            //随机算法 v1.2
            
                //随机算法
              //  $find_nxys = $this->mysql->query("client_nxys_automatic_account","status=1 and user_id={$user['id']} and training=1 and receiving=1 and type=1");
            $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=1
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
          }
       
            
        }else{
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId','','htmlspecialchars');
            $find_nxys = $this->mysql->query("client_nxys_automatic_account","key_id='{$key_id}'")[0];
            if (!is_array($find_nxys)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            if ($find_nxys['status'] != 1 || $user['id'] != $find_nxys['user_id'] || $find_nxys['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到nxys参数
        //生成订单
    
      $min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_nxys_automatic_orders","status=2 and nxys_id={$find_nxys['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
     
	
        $create_order  = $this->mysql->insert('client_nxys_automatic_orders', [
            'nxys_id'=>$find_nxys['id'],
            'creation_time'=>time(),
			'expire_time' => time()+300,
            'pay_time'=>0,
            'status'=>2,
            'amount'=>$money,
            'callback_url'=>$data['callback_url'],
            'success_url'=>$data['success_url'],
            'error_url'=>$data['error_url'],
            'user_id'=>$user['id'],
            'callback_time'=>0,
            'out_trade_no'=>$data['out_trade_no'],
            'ip'=>ip::get(),
            'trade_no'=>$data['trade_no'],
           'app_user'=>$find_nxys['app_user'],
          'type'=>$find_nxys['type'],
           'qrcode'=>$find_nxys['qrcode']
			
        ]);
        if ($create_order > 0){
            if ($type_content == 'json'){
                functions::str_json($type_content, 200, 'success',["order_id"=>$create_order]);
            }
            url::address(url::s("gateway/pay/automaticnxys","id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服 846865108');
    }
  
  //农信易扫微信
    private function nxysyl($user,$type_content,$data){
		
		 if ($user['balance'] < 1) functions::str_json($type_content, -1, '接口余额不足1元，请充值后使用');
		
        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
		
        //查询用户组
		
			
			
        $group = json_decode($this->mysql->query('client_group',"id={$user['group_id']}")[0]['authority'],true)['nxysyl_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time()-20;
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $robin = userCog::read('nxysConfig', $user['id'])['robin'];
            //随机算法 v1.2
            
                //随机算法
             //   $find_nxys = $this->mysql->query("client_nxys_automatic_account","status=1 and user_id={$user['id']} and training=1 and receiving=1  and type=2 ");
            $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=2
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_nxys = $this->mysql->query("client_nxys_automatic_account as c","c.status=1 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and c.type=2
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_nxys_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.nxys_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_nxys = count($find_nxys);
                if ($count_nxys == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_nxys = $find_nxys[mt_rand(0,$count_nxys-1)];
          }
       
            
        }else{
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId','','htmlspecialchars');
            $find_nxys = $this->mysql->query("client_nxys_automatic_account","key_id='{$key_id}'")[0];
            if (!is_array($find_nxys)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            if ($find_nxys['status'] != 1 || $user['id'] != $find_nxys['user_id'] || $find_nxys['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到nxys参数
        //生成订单
     
		$min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_nxys_automatic_orders","status=2 and nxys_id={$find_nxys['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}
     
	
        $create_order  = $this->mysql->insert('client_nxys_automatic_orders', [
            'nxys_id'=>$find_nxys['id'],
            'creation_time'=>time(),
			'expire_time' => time()+300,
            'pay_time'=>0,
            'status'=>2,
            'amount'=>$money,
            'callback_url'=>$data['callback_url'],
            'success_url'=>$data['success_url'],
            'error_url'=>$data['error_url'],
            'user_id'=>$user['id'],
            'callback_time'=>0,
            'out_trade_no'=>$data['out_trade_no'],
            'ip'=>ip::get(),
            'trade_no'=>$data['trade_no'],
           'app_user'=>$find_nxys['app_user'],
          'type'=>$find_nxys['type'],
           'qrcode'=>$find_nxys['qrcode']
			
        ]);
        if ($create_order > 0){
            if ($type_content == 'json'){
                functions::str_json($type_content, 200, 'success',["order_id"=>$create_order]);
            }
            url::address(url::s("gateway/pay/automaticnxys","id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服 846865108');
    }
  
   //全自动版收钱吧
    private function shouqianba($user, $type_content, $data)
    {

        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
        //查询用户组
        $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['shouqianba_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        //$now_time = $this->getAndroidHeartbeatNow();
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $find_shouqianba = functions::getRobin("shouqianba_{$user['id']}");

        if($data['type'] == 10){
          $type = 1;
        }else if($data['type'] == 11){
          $type = 2;
        }
         
           
           
                    //随机算法
                  //  $find_shouqianba = $this->mysql->query("client_shouqianba_automatic_account", "status=4 and user_id={$user['id']} and training=1 and receiving=1 and type={$type}");
      $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                  //随机算法
          $use_city  = $data['use_city'];

          if($use_city == 1){
            
             $clientCityData = $this->getCity($this->getIP());
           if(!isset($clientCityData['city'])){
                 functions::str_json($type_content, -1, '没有获取到城市');
          }
              //随机算法
                $find_shouqianba = $this->mysql->query("client_shouqianba_automatic_account as c","c.status=4 and (c.area LIKE '".$clientCityData['city']."' or c.area LIKE '0')
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and type={$type}
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_shouqianba_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.shouqianba_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_shouqianba_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.shouqianba_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_shouqianba = count($find_shouqianba);
                if ($count_shouqianba == 0) functions::str_json($type_content, -1, '当前->('.$clientCityData['city'].')城市没有收款账号或者当天最大收款额度，当天最大收款订单数已满，请检查');
                $find_shouqianba = $find_shouqianba[mt_rand(0,$count_shouqianba-1)];
            
            
            
          }else{
          
          
                 //随机算法
                $find_shouqianba = $this->mysql->query("client_shouqianba_automatic_account as c","c.status=4 
              and c.user_id={$user['id']} 
              and c.training=1 
              and c.receiving=1 
			  and type={$type}
              and (c.max_amount > IFNULL(
                  (select sum(o.amount) as money from xh_client_shouqianba_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.shouqianba_id = c.id),0)+".$data['amount']." or c.max_amount = 0) 
              and (c.max_dd >IFNULL(
                  (select count(o.id) as count from xh_client_shouqianba_automatic_orders as o where o.creation_time > {$nowTime} and o.status IN (2,4) and o.user_id={$user['id']} and o.shouqianba_id = c.id),0) or c.max_dd = 0)") ;
            
                   $count_shouqianba = count($find_shouqianba);
                if ($count_shouqianba == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
                $find_shouqianba = $find_shouqianba[mt_rand(0,$count_shouqianba-1)];
          }

        } else {
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_shouqianba = $this->mysql->query("client_shouqianba_automatic_account", "key_id='{$key_id}'")[0];
            if (!is_array($find_shouqianba)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            // print_r($find_shouqianba);
            //echo $now_time;
            if ($find_shouqianba['status'] != 4 || $user['id'] != $find_shouqianba['user_id'] || $find_shouqianba['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到shouqianba参数

        if (empty($find_shouqianba)) functions::str_json($type_content, -1, 'automatic->无可用通道,请联系客服');
      
   

     

        $create_order = $this->mysql->insert('client_shouqianba_automatic_orders', [
            'shouqianba_id'     => $find_shouqianba['id'],
            'creation_time' => time(),
            'pay_time'      => 0,
            'status'        => 2,
            'amount'        =>$data['amount'],
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
          'app_user'=>$find_shouqianba['app_user'],
           'type'=>$find_shouqianba['type']
        ]);
        $qrcode = '';
        if ($create_order > 0) {
            $mark = $find_shouqianba['id'] . '|' . $create_order;
            if ($find_shouqianba['is_new_version'] == 1) {
                $qrcode ="http://".DOMAINS_URL."/gateway/pay/zzh5.do?id={$create_order}";     
               
                $this->mysql->update('client_shouqianba_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            }else{
                $qrcode ="http://".DOMAINS_URL."/gateway/pay/zzh5.do?id={$create_order}";     
                $this->mysql->update('client_shouqianba_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            } 

            if ($type_content == 'json') {
                if (!$find_shouqianba['is_new_version']) {
                    $qrcode = functions::syncRequest('shouqianba_' . intval($create_order), 50000);
                }

                $json_qrcode = "https://ds.shouqianba.com/?from=mobilecodec&scheme=" . urlencode("shouqianbas://platformapi/startapp?appId=10000007&qrcode=" . url::s("gateway/pay/automaticshouqianba", "id={$create_order}"));

                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode, 'qrcode_url' => $qrcode, 'qrcode_url2' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/automaticshouqianba", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');
    }

  
     //全自动版银行
    private function bank($user, $type_content, $data)
    {

        //查询用户组
        $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['bank_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time();

        /*
        //判断该用户的订单相同金额是否存在未付款
        $is_order = $this->mysql->query('client_bank_automatic_orders', "user_id={$user['id']} and amount={$data['amount']} and expire_time>{$now_time} and status=2")['0'];
        // print_r($is_order);die;
        if($is_order){
            url::address(url::s("gateway/pay/automaticBank", "id={$is_order['id']}"));die;
        }
        */

        //开启轮训 默认随机获取通道信息
        if ($data['robin'] == 2) {
            $find_bank = $this->mysql->query('client_bank_automatic_account', "user_id={$user['id']} and training=1 and receiving=1");

            $count_alipay = count($find_bank);

            $find_alipay = $find_bank[mt_rand(0, $count_alipay - 1)];
        } else {
            //指定银行账户号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_alipay = $this->mysql->query("client_bank_automatic_account", "key_id='{$key_id}' and receiving=1")[0];
        }

        if (!is_array($find_alipay)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');

        //轮训获取金额通道 默认超时为 10 分钟
        //1,判断该金额的订单数量，金额浮动不能超过 0.20 返回实际收款金额
       // $amountTrue=$this->amountRedis($find_alipay['id'],$data['amount'],$data['amount']);
        // echo $amountTrue.':';exit;
       // if($amountTrue=='00' || floatval($amountTrue)<=0){
          //  functions::str_json($type_content, -1, 'automatic->该金额通道已满');
    //    }

        $bank_name = $this->mysql->query("bank_id", "bank_id='{$find_alipay['bank_id']}'")[0]['bank_name'];
        //print_r($bank_name);die;
      
        $min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_bank_automatic_orders","status=2 and alipay_id={$find_bank['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}


        //通道获取成功
        $create_order = $this->mysql->insert('client_bank_automatic_orders', [
            'alipay_id'     => $find_alipay['id'],
            'creation_time' => time(),
            'expire_time' => time()+600,
            'pay_time'      => 0,
            'status'        => 1,
            'amount'        => $money,
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
            'bank_acount'   => $find_alipay['key_id'],
            'bank_id'       => $find_alipay['bank_id'],
            'gathering_name'   => $find_alipay['gathering_name'],
            'bank_name'    => $bank_name,
            'app_user'=>$find_alipay['app_user']
        ]);
        $qrcode = '';
        if ($create_order > 0) {

            $qrcode = url::s("gateway/pay/automaticBank", "id={$create_order}");


            $this->mysql->update('client_bank_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            if ($type_content == 'json') {

                $json_qrcode =url::s("gateway/pay/automaticBank", "id={$create_order}");

                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/automaticBank", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');
    }

  
    //全自动版银行
    private function wechatbank($user, $type_content, $data)
    {

        //查询用户组
        $group = json_decode($this->mysql->query('client_group', "id={$user['group_id']}")[0]['authority'], true)['wechatbank_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time();

        /*
        //判断该用户的订单相同金额是否存在未付款
        $is_order = $this->mysql->query('client_wechatbank_automatic_orders', "user_id={$user['id']} and amount={$data['amount']} and expire_time>{$now_time} and status=2")['0'];
        // print_r($is_order);die;
        if($is_order){
            url::address(url::s("gateway/pay/automaticwechatbank", "id={$is_order['id']}"));die;
        }
        */

        //开启轮训 默认随机获取通道信息
        if ($data['robin'] == 2) {
            $find_wechatbank = $this->mysql->query('client_wechatbank_automatic_account', "user_id={$user['id']} and training=1 and receiving=1");

            $count_alipay = count($find_wechatbank);

            $find_alipay = $find_wechatbank[mt_rand(0, $count_alipay - 1)];
        } else {
            //指定银行账户号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_alipay = $this->mysql->query("client_wechatbank_automatic_account", "key_id='{$key_id}' and receiving=1")[0];
        }

        if (!is_array($find_alipay)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');

        //轮训获取金额通道 默认超时为 10 分钟
        //1,判断该金额的订单数量，金额浮动不能超过 0.20 返回实际收款金额
       // $amountTrue=$this->amountRedis($find_alipay['id'],$data['amount'],$data['amount']);
        // echo $amountTrue.':';exit;
       // if($amountTrue=='00' || floatval($amountTrue)<=0){
          //  functions::str_json($type_content, -1, 'automatic->该金额通道已满');
    //    }

        $wechatbank_name = $this->mysql->query("bank_id", "bank_id='{$find_alipay['bank_id']}'")[0]['bank_name'];
        //print_r($wechatbank_name);die;
      
        $min=0.01;
		$max=0.19;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_wechatbank_automatic_orders","status=2 and alipay_id={$find_wechatbank['id']} and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}


        //通道获取成功
        $create_order = $this->mysql->insert('client_wechatbank_automatic_orders', [
            'alipay_id'     => $find_alipay['id'],
            'creation_time' => time(),
            'expire_time' => time()+600,
            'pay_time'      => 0,
            'status'        => 1,
            'amount'        => $money,
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
            'bank_acount'   => $find_alipay['key_id'],
            'bank_id'       => $find_alipay['bank_id'],
            'gathering_name'   => $find_alipay['gathering_name'],
            'bank_name'    => $wechatbank_name,
            'app_user'=>$find_alipay['app_user']
        ]);
        $qrcode = '';
        if ($create_order > 0) {

            $qrcode = url::s("gateway/pay/automaticwechatbank", "id={$create_order}");


            $this->mysql->update('client_wechatbank_automatic_orders', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            if ($type_content == 'json') {

                $json_qrcode =url::s("gateway/pay/automaticwechatbank", "id={$create_order}");

                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/automaticwechatbank", "id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');
    }

       //全自动版支付宝
    private function yunshanfu($user,$type_content,$data){
		
		 if ($user['balance'] < 1) functions::str_json($type_content, -1, '接口余额不足1元，请充值后使用');
		
        if ($data['amount'] > 50000) functions::str_json($type_content, -1, '支付金额不能大于50000元');
		
        //查询用户组
		
			
			
        $group = json_decode($this->mysql->query('client_group',"id={$user['group_id']}")[0]['authority'],true)['yunshanfu_auto'];
        //判断用户组是否存在
        if ($group['open'] != 1) functions::str_json($type_content, -1, 'service->您没有权限使用该通道!');
        //现在的时间
        $now_time = time()-20;
        //轮训
        if ($data['robin'] == 2) {
            //读取轮训算法ID
            $robin = userCog::read('yunshanfuConfig', $user['id'])['robin'];
            //随机算法 v1.2
            
                //随机算法
                $find_yunshanfu = $this->mysql->query("client_yunshanfu_automatic_account","status=1 and user_id={$user['id']} and training=1 and receiving=1 ");
                $count_yunshanfu = count($find_yunshanfu);
              
                $find_yunshanfu = $find_yunshanfu[mt_rand(0,$count_yunshanfu-1)];
       
            
        }else{
            //指定微信号 单条进入
            $key_id = request::filter('post.keyId','','htmlspecialchars');
            $find_yunshanfu = $this->mysql->query("client_yunshanfu_automatic_account","key_id='{$key_id}'")[0];
            if (!is_array($find_yunshanfu)) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道异常');
            if ($find_yunshanfu['status'] != 1 || $user['id'] != $find_yunshanfu['user_id'] || $find_yunshanfu['receiving'] != 1 ) functions::str_json($type_content, -1, 'automatic->初始化失败,当前支付通道不可使用');
        }
        //已经得到yunshanfu参数
        //生成订单
		
	
        $create_order  = $this->mysql->insert('client_yunshanfu_automatic_orders', [
            'yunshanfu_id'=>$find_yunshanfu['id'],
            'creation_time'=>time(),
			'expire_time' => time()+300,
            'pay_time'=>0,
            'status'=>2,
            'amount'=>$data['amount'],
            'callback_url'=>$data['callback_url'],
            'success_url'=>$data['success_url'],
            'error_url'=>$data['error_url'],
            'user_id'=>$user['id'],
            'callback_time'=>0,
            'out_trade_no'=>$data['out_trade_no'],
            'ip'=>ip::get(),
            'trade_no'=>$data['trade_no'],
           'app_user'=>$find_yunshanfu['app_user']
			
        ]);
        if ($create_order > 0){
            if ($type_content == 'json'){
                functions::str_json($type_content, 200, 'success',["order_id"=>$create_order]);
            }
            url::address(url::s("gateway/pay/automaticyunshanfu","id={$create_order}"));
        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服 846865108');
    }
    
   

    public function serviceBank($user, $type_content, $data ,$where_gateway){

        //开启轮训 默认随机获取通道信息
        if ($data['robin'] == 2) {
            $find_bank = $this->mysql->query('service_account', "{$where_gateway} training=1 and receiving=1 and types=3");
            //print_r($find_bank);die;
            $count_alipay = count($find_bank);

            $find_service = $find_bank[mt_rand(0, $count_alipay - 1)];
        } else {
            //指定银行账户号 单条进入
            $key_id = request::filter('post.keyId', '', 'htmlspecialchars');
            $find_service = $this->mysql->query("service_account", "key_id='{$key_id}' and receiving=1")[0];
        }


        //已经得到参数
        if (empty($find_service)) functions::str_json($type_content, -1, 'automatic->无可用通道,请联系客服');

        //轮询金额通道
      //  $amountTrue = $this->amountRedis($find_service['id'],$data['amount'],$data['amount']);

    //    if($amountTrue=='00' || floatval($amountTrue)<=0){
          //  functions::str_json($type_content, -1, 'automatic->该金额通道已满');
      //  }

        //银行名称
        $bank_name = $this->mysql->query("bank_id", "bank_id='{$find_service['bank_id']}'")[0]['bank_name'];
      
	    $min=0.01;
		$max=0.29;
		$money_ok = false;
		for($x=0; $x<=10; $x++){
			$money = round($data['amount'] + $min + mt_rand()/mt_getrandmax() * ($max-$min), 2);
			$existence_order = $this->mysql->query("client_service_order","status=2 and types=3 and amount={$money} ",null,"id","asc");
			if (count($existence_order) == 0){
				$money_ok = true;
				break;
			}
		}
		if($money_ok == false){
			functions::str_json($type_content, -1, '订单创建失败,请稍后重试');
		}


        //通道获取成功
        $create_order = $this->mysql->insert('service_order', [
            'service_id'     => $find_service['id'],
            'creation_time' => time(),
            'expire_time' => time()+600,
            'pay_time'      => 0,
            'status'        => 2,
            'amount'        => $money,
            'callback_url'  => $data['callback_url'],
            'success_url'   => $data['success_url'],
            'error_url'     => $data['error_url'],
            'user_id'       => $user['id'],
            'callback_time' => 0,
            'out_trade_no'  => $data['out_trade_no'],
            'ip'            => ip::get(),
            'trade_no'      => $data['trade_no'],
            'bank_acount'   => $find_service['key_id'],
            'bank_id'       => $find_service['bank_id'],
            'gathering_name'=> $find_service['gathering_name'],
            'bank_name'    => $bank_name,
            'types'        => 3,
            'ymoney'         => $data['amount'],
           'app_user'=>$find_service['app_user']
        ]);

        if($create_order > 0){

            $qrcode = url::s("gateway/pay/service", "id={$create_order}");
            $this->mysql->update('service_order', ['qrcode' => $qrcode, 'status' => 2], "id={$create_order}");

            if ($type_content == 'json') {
                $json_qrcode =url::s("gateway/pay/service", "id={$create_order}");

                // $json_qrcode = "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?appId=09999988&actionType=toCard&sourceId=bill&cardNo=".$find_service['key_id']."&bankAccount=".$find_service['gathering_name']."&money=".$amount_true."&amount=".$amountTrue."&bankMark=".$find_service['bank_id']."&bankName=".$bank_name);
                functions::str_json($type_content, 200, 'success', ["order_id" => $create_order, 'qrcode' => $json_qrcode]);
            }
            url::address(url::s("gateway/pay/service", "id={$create_order}"));

        }
        functions::str_json($type_content, -1, 'automatic->订单创建失败,请联系客服');

    }
}
