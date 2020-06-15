<?php

namespace xh\run\gateway\controller;

use xh\library\mysql;
use xh\library\request;
use xh\library\functions;
use xh\library\url;
use xh\library\view;
use xh\library\ip;

class pay
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

 
	public function curl_post($sUrl, $aHeader, $aData){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $sUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aData));
    $sResult = curl_exec($ch);
    if($sError=curl_error($ch)){
        die($sError);
    }
    curl_close($ch);
    return $sResult;
	}

  
    //全自动版支付宝 v1.0
    public function automaticalipaygm(){
        $type = request::filter('get.content_type','','htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_alipaygm_automatic_orders',"id={$id}")[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
        //查询微信信息
		$order['name'] = $this->mysql->query("client_alipaygm_automatic_account","id={$order['alipaygm_id']}")[0]['name'];
		$order['account'] = $this->mysql->query("client_alipaygm_automatic_account","id={$order['alipaygm_id']}")[0]['account'];
        $order['pid'] = $this->mysql->query("client_alipaygm_automatic_account","id={$order['alipaygm_id']}")[0]['pid'];
        $order['app_user'] = $this->mysql->query("client_alipaygm_automatic_account","id={$order['alipaygm_id']}")[0]['app_user'];
        $order['is_hongbao'] = $this->mysql->query("client_alipaygm_automatic_account","id={$order['alipaygm_id']}")[0]['is_hongbao'];
      

		
		
        //检测是否手机访问
        if (ip::isMobile()){
            $path = 'alipaygm/alipayMobile';
        }else{
            $path = 'alipaygm/alipay';
        }
             		if($order['wb_order']==0){
			
			
		$uid = $this->mysql->query("client_alipaygm_automatic_account", "id={$order['alipaygm_id']}")[0]['uid'];
		$kuk = $this->mysql->query("client_alipaygm_automatic_account", "id={$order['alipaygm_id']}")[0]['cookie'];



		            $cookie='Cookie:'.$kuk;
            		$msgid=$uid;
            	

            
            
                            // 第一步创建红包
                $sUrl = 'http://mall.e.weibo.com/aj/redenvelope/create';
                //post数据
                
                if($order['amount']>200){

                	$age=$order['amount']/200;
                	if(!is_numeric($age)||strpos($age,".")!==false){
					
					//不是整数
					$singalAmount='100';
					$count=$order['amount']/100;

					}else{
						
					//是整数	
					$singalAmount='200';
					$count=$order['amount']/200;

				   }
                	
                	
                     $aData = array(
                    'bag_type' => '1',
                    'puicode' => '10000073',
                    'msgtype' => '1',
                    'msgid'   => $msgid,
                    'singalAmount' =>$singalAmount,
                    'blessing' => '恭喜发财,大吉大利',
                    'count'   => $count,
                    'amount'  => $order['amount'],
                    '_t'      => '0'
                ); 	
                	
                	
                }else{
                	
                     $aData = array(
                    'bag_type' => '1',
                    'puicode' => '10000073',
                    'msgtype' => '1',
                    'msgid'   => $msgid,
                    'singalAmount' => $order['amount'],
                    'blessing' => '恭喜发财,今晚吃鸡',
                    'count'   => '1',
                    'amount'  => $order['amount'],
                    '_t'      => '0'
                );
                	
                	
                }
                

                $aHeader = array('Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1))','X-Requested-With:XMLHttpRequest',$cookie);
                $sResult = $this->curl_post($sUrl, $aHeader, $aData);
                $aResData = json_decode($sResult, true);
                $payurl=$aResData['data']['url'];
                $code=$aResData['code'];
                

                //开始第二步测试
                if($code==100000){
                
                $header="User-Agent:Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Mobile Safari/537.36\r\nCookie:".$kuk."\r\n";
                
                //请求地址
                $url = $payurl;
                //headers请求头
                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $header,
                  ));
                $context = stream_context_create($context_options);
                //获取资源
                $html = file_get_contents($url,FALSE,$context);
				
				$printhtml="/www/wwwroot/".DOMAINS_URL."/wb/html/".$order['id'];
				$fp = fopen ($printhtml . '.html',"w");
				 
				if (fwrite ($fp,$html)){
				
					
				fclose ($fp);
				
				
				
				} else { 
				fclose ($fp); 
				
				
				} 
				
				$pay_html="http://".DOMAINS_URL."/wb/html/".$order['id'].".html";
				
                $matches = array();
                
                preg_match_all('<input name="biz_content" type="hidden" value="(.*)"/>', $html, $matches);
                
                $json=$matches['1']['0'];
                $json=htmlspecialchars_decode($json);
                $arr = json_decode($json, true);    // 将获取到的 JSON 数据解析成数组
                
                $tradeId=$arr['out_trade_no'];
                
                $this->mysql->update('client_alipaygm_automatic_orders', ['wb_order' => $tradeId,'pay_url' => $pay_html], "id={$order['id']}");
                }else{
                    
                
                    functions::json(-1, '订单发起失败,请检查uid和cookie');
                }

}
       
        $pay_data = [
            'id' => $order['id'], 
            'wechat_name' => $order['wechat_name'],
            'ewmurl' => $order['ewmurl'],
            'creation_time' => $order['creation_time'],
            'status' => $order['status'],
            'amount' => $order['amount'],
            'success_url' => $order['success_url'],
            'error_url' => $order['error_url'],
            'out_trade_no' => $order['out_trade_no'],
            'trade_no' => $order['trade_no'],
            'payurl'         => $order['pay_url']
            
        ];
        //检测网页类型是否为json
        if ($type == 'json'){
            functions::json(200, 'success', $pay_data);
        }else{
            new view($path,$pay_data);
        }
    }

  
   //订单查询
    public function automaticalipaygmQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_alipaygm_automatic_orders', "id ={$id}", 'status,creation_time,qrcode,alipaygm_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 299) < time()) {
                $this->mysql->update('client_alipaygm_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            if (empty($order['qrcode'])) {

                $order['qrcode'] = functions::getOrderCode('alipaygm_' . intval($id));

            }

            $acc = $this->mysql->query("client_alipaygm_automatic_account", "id={$order['alipaygm_id']}", 'id,is_new_version')[0];
            if ($acc['is_new_version']) $order['qrcode'] = url::s("gateway/pay/automaticalipaygm", "id={$id}");
            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
    //服务版
    public function service()
    {
      
        $type = request::filter('request.content_type', 'text', 'htmlspecialchars');

        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('service_order', "id={$id}")[0];
        //print_r($order);die;
       // if (!is_array($order)) functions::json(-1, '当前交易号不存在');
       // if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
     //   if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
     //   if (($order['creation_time'] + 599) < time()) {
        //    $this->mysql->update('service_order', ['status' => 3], "id={$order['id']}");

        //    functions::json(-2, '当前订单已经过期,请重新发起支付');
    //    }
        $pay_url = '';
        $order['method'] = '';
        //查询服务信息
        $service = $this->mysql->query("service_account", "id={$order['service_id']}")[0];
        //检测是否手机访问
        if (ip::isMobile()) {
            if ($service['types'] == 1) $path = 'service/wechatMobile';
            if ($service['types'] == 4) $path = 'service/lakala';
           if ($service['types'] == 5) $path = 'service/yunshanfu';
          if ($service['types'] == 6) $path = 'service/nxys';
          if ($service['types'] == 7) $path = 'service/nxys';
          if ($service['types'] == 8) $path = 'service/nxysyl';
           if ($service['types'] == 9) $path = 'service/wechatdyMobile';
          if ($service['types'] == 10) $path = 'service/wechatsjMobile';
          if ($service['types'] == 11) $path = 'service/wechatbank';
          if ($service['types'] == 12) $path = 'service/pddgmMobile';
          if ($service['types'] == 13) $path = 'service/alipaygmMobile';
            if ($service['types'] == 2) {

                if ($service['is_new_version'] == 1) {

                    $mark =  $order['service_id'] . '|' . $order['id'];
                    $order['user_id'] = $service['alipay_pid'];
                    $order['mark'] =  $order['trade_no'];
                    $order['method'] = url::s('gateway/pay/serviceQuery', "id={$id}");
                    $pay_url = 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data={"s": "money","u": "' . $service['alipay_pid'] . '","a": "' . $order['amount'] . '","m": "' . $mark . '"}';
                         
                    $path = 'service/alipayMobile';
                  
                }else if ($service['is_hongbao']== 1) {
                    $mark =  $order['service_id'] . '|' . $order['id'];
                    $order['user_id'] = $service['alipay_pid'];
                    $order['mark'] = $order['trade_no'];
                    $order['method'] = url::s('gateway/pay/serviceQuery', "id={$id}");
                    $pay_url = 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data={"s": "money","u": "' . $service['alipay_pid'] . '","a": "' . $order['amount'] . '","m": "' . $mark . '"}';
                          if(strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') == true){
                           $path = 'service/alipayHongbao';
                           }else{
                            $path = 'service/alipay';
                           }
                   
                } 
            }
          
   
            if($service['types'] == 3){

                if($this->isInAlipayClient()){


                    $bankData = [
                        'account_no'     => trim($service['account_no']),
                        //'gathering_name' => urlencode(trim($service['gathering_name'])),
                        'gathering_name' => trim($service['gathering_name']),
                        'amount'         => $order['amount'],
                        'bank_id'        => $order['bank_id'],
                        'bank_name'      => urlencode($order['bank_name']),
                        'cardid'         => trim($service['cardid']),
                        'bank_acount'         => trim($order['bank_acount']),
                        'creation_time'=>$order['creation_time'],
                    ];
                    //$path = 'service/bankJs';
                    $path = 'service/bankH5';
                    new view($path, $bankData);exit;
                    // header("Location:".$location);
                }
                $path = 'service/bankMobile';
            }
        } else {
            if ($service['types'] == 1) $path = 'service/wechat';
          if ($service['types'] == 2 && $service['is_hongbao']== 1 ) $path = 'service/alipay';
            if ($service['types'] == 2) $path = 'service/alipay';
            if ($service['types'] == 3) $path = 'service/bank';
           if ($service['types'] == 4) $path = 'service/lakala';
           if ($service['types'] == 5) $path = 'service/yunshanfu';
          if ($service['types'] == 6) $path = 'service/nxys';
          if ($service['types'] == 7) $path = 'service/nxys';
          if ($service['types'] == 8) $path = 'service/nxysyl';
            if ($service['types'] == 9) $path = 'service/wechatdy';
          if ($service['types'] == 10) $path = 'service/wechatsj';
          if ($service['types'] == 11) $path = 'service/wechatbank';
          if ($service['types'] == 12) $path = 'service/pddgm';
          if ($service['types'] == 13) $path = 'service/alipaygm';

        }
      
        if (empty($order['qrcode'])) {

            $paytypes = ['1' => 'wechat', '2' => 'alipay'];

            $mark = $order['service_id'] . '|' . $order['id'];

            if ($service['is_new_version'] == 1 && $service['types'] == 2 ) {

                $order['qrcode'] = url::s("gateway/pay/payService", "id={$order['id']}");
                $this->mysql->update('service_order', ['qrcode' => $order['qrcode'], 'status' => 2], "id={$id}");
            } else if( $service['types'] < 3){
                \xh\library\gateway::getQrCode(SERVER_BIND_UID, $mark, $order['amount'], $service['key_id'], $paytypes[$service['types']]);

            }
        }

        $pay_data = [
            'id'            => $order['id'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'location_url'  => url::s("gateway/pay/service", "id={$order['id']}"),
            'pay_url'       => $pay_url,
            'method'        => $order['method'],
            'user_id'       => $service['alipay_pid'],
           'account'       => $service['account'],
           'ewmurl'       => $service['ewmurl'],
            'mark'          => $mark,
            'gathering_name'=> $service['gathering_name'],
           'app_user'=> $order['app_user'],
          'is_new_version'=>$service['is_new_version'],
           'is_hongbao'=>$service['is_hongbao'],
          'nx_type'=>$service['nx_type'],
            'account_no'     => trim($service['account_no']),
                        //'gathering_name' => urlencode(trim($service['gathering_name'])),
                        'gathering_name' => trim($service['gathering_name']),
                        'bank_id'        => $order['bank_id'],
                        'bank_name'      => $order['bank_name'],
                        'bank_acount'         => trim($order['bank_acount']),
        ];

        //检测网页类型是否为json
        if ($type == 'json') {
            if (empty($pay_data['qrcode'])) {

                $qrcode = functions::getOrderCode('service_' . intval($order['id']));
                $pay_data['qrcode'] = $qrcode;
            }
            functions::json(200, 'success', $pay_data);
        } else {
            //echo $path;die;
            new view($path, $pay_data);
        }

    }
  
   public function szzh5(){
        $type = request::filter('get.content_type','','htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('service_order',"id={$id}")[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
        //查询服务信息
        $service = $this->mysql->query("service_account","id={$order['service_id']}")[0];
      
      	$order['name'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['name'];
		$order['account'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['account'];
        $order['alipay_pid'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['alipay_pid'];

		
     
            if ($service['types'] == 2) $path = 'service/szzh5';
       
        $pay_data = [
            'id' => $order['id'],
         
			'name' => $order['name'],
            'account' => $order['account'],
			'pid' => $order['alipay_pid'],
            'service_name' => $service['alipay_name'],
            'creation_time' => $order['creation_time'],
            'status' => $order['status'],
            'amount' => $order['amount'],
            'success_url' => $order['success_url'],
            'error_url' => $order['error_url'],
            'out_trade_no' => $order['out_trade_no'],
            'trade_no' => $order['trade_no'],
            'qrcode' => $order['qrcode']
            
        ];
        //检测网页类型是否为json
        if ($type == 'json'){
            functions::json(200, 'success', $pay_data);
        }else{
            new view($path,$pay_data);
        }
    }

  
     public function shbh5(){
        $type = request::filter('get.content_type','','htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('service_order',"id={$id}")[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
        //查询服务信息
        $service = $this->mysql->query("service_account","id={$order['service_id']}")[0];
      
      	$order['name'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['name'];
		$order['account'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['account'];
        $order['pid'] = $this->mysql->query("service_account","id={$order['service_id']}")[0]['pid'];

		
     
            if ($service['types'] == 2) $path = 'service/shbh5';
       
        $pay_data = [
            'id' => $order['id'],
         
			'name' => $order['name'],
          'account' => $order['account'],
			'pid' => $order['pid'],
            'service_name' => $service['alipay_name'],
            'creation_time' => $order['creation_time'],
            'status' => $order['status'],
            'amount' => $order['amount'],
            'success_url' => $order['success_url'],
            'error_url' => $order['error_url'],
            'out_trade_no' => $order['out_trade_no'],
            'trade_no' => $order['trade_no'],
            'qrcode' => $order['qrcode']
            
        ];
        //检测网页类型是否为json
        if ($type == 'json'){
            functions::json(200, 'success', $pay_data);
        }else{
            new view($path,$pay_data);
        }
    }

    //订单查询
    public function serviceQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('service_order', "id ={$id}", 'status,creation_time,qrcode,service_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time()) {
                $this->mysql->update('service_order', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            if (empty($order['qrcode'])) {

                $order['qrcode'] = functions::getOrderCode('service_' . intval($id));

            }

            $acc = $this->mysql->query('service_account', "id={$order['service_id']}", 'id,is_new_version')[0];
            if ($acc['is_new_version']) $order['qrcode'] = url::s("gateway/pay/service", "id={$id}");
            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);

        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }

    function file_exists_S3($url)
    {
        $state = @file_get_contents($url, 0, null, 0, 1);//获取网络资源的字符内容
        if ($state) {
            $filename = date("dMYHis") . '.jpg';//文件名称生成
            ob_start();//打开输出
            readfile($url);//输出图片文件
            $img = ob_get_contents();//得到浏览器输出
            ob_end_clean();//清除输出并关闭
            $size = strlen($img);//得到图片大小
            $fp2 = @fopen($filename, "a");
            fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
            fclose($fp2);

            return $this->base64EncodeImage($filename);
        } else {
            return 0;
        }
    }

    /*图片转换为 base64格式编码*/
    function base64EncodeImage($image_file)
    {

        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));

        return $base64_image;
    }


    function pay_curl($url, $data = '')
    {
        $ch = curl_init($url);
        $header[] = 'Mozilla/5.0 (Linux; U; Android 7.1.2; zh-cn; GiONEE F100 Build/N2G47E) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30';
        if (!empty($data)) {
            curl_setopt($ch, 47, 1);
            curl_setopt($ch, 10015, $data);
        }
        curl_setopt($ch, 10023, $header);
        curl_setopt($ch, 64, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, 81, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, 19913, true);
        curl_setopt($ch, 19914, true);
        curl_setopt($ch, 52, 1);
        curl_setopt($ch, 13, 60);
        ob_start();
        @$data = curl_exec($ch);
        ob_end_clean();
        curl_close($ch);

        return $data;
    }

    public function pay()
    {
        //error_reporting(E_ALL);
        $order_id = intval(request::filter('request.id'));
        if (empty($order_id)) functions::str_json('json', -1, 'order_id不能为空');

        $order = $this->mysql->query("client_alipay_automatic_orders", "id={$order_id}", 'id,alipay_id,amount,status')[0];
        if (empty($order)) functions::str_json('json', -1, '找不到订单信息');
        if ($order['status'] != 2) functions::str_json('json', -1, '订单已支付成功或失效');
        $data = $this->mysql->query("client_alipay_automatic_account", "id={$order['alipay_id']}", 'account_user_id,gathering_name')[0];

        $mark = $order['alipay_id'] . '|' . $order['id'];
        if (empty($data['account_user_id'])) functions::str_json('json', -1, 'account_user_id不能为空');

        $pay_data = [
            'user_id' => $data['account_user_id'],
            'mark'    => $mark,
            'amount'  => $order['amount'],
        ];

        $pay_data = urlencode(json_encode($pay_data));
        $url = url::s("gateway/pay/automaticAlipayAlipay", "data={$pay_data}");
        header("Location:" . $url);

    }

    public function payService()
    {
        //error_reporting(E_ALL);
        $order_id = intval(request::filter('request.id'));

        $order = $this->mysql->query("service_order", "id={$order_id}", 'id,service_id,amount,status')[0];
        if (empty($order)) functions::str_json('json', -1, '找不到订单信息');
        if ($order['status'] != 2) functions::str_json('json', -1, '订单已支付成功或失效');
        $data = $this->mysql->query("service_account", "id={$order['service_id']}", 'account_user_id,gathering_name')[0];
        $order['alipay_id'] = $order['service_id'];

        if (empty($data['account_user_id'])) functions::str_json('json', -1, 'account_user_id不能为空');

        $mark = $order['service_id'] . '|' . $order['id'];

        $pay_data = [
            'user_id' => $data['account_user_id'],
            'mark'    => $mark,
            'amount'  => $order['amount'],
        ];

        $pay_data = urlencode(json_encode($pay_data));
        $url = url::s("gateway/pay/automaticAlipayAlipay", "data={$pay_data}");

        header("Location:" . $url);

    }

    public function locationAlipay()
    {
        $data = trim(request::filter('request.data'));

        $pay_data = json_decode(urldecode($data), true);
        if (empty($pay_data)) return '参数错误';
        if ($this->isInAlipayClient()) {

            $type = $this->get_device_type();
            if ($type == 'ios') {
                $path = 'alipay/scan';
            } else {
                $path = 'alipay/android';
            }
            new view($path, $pay_data);
        } else {

            header("Location:" . "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=" . url::s("gateway/pay/automaticAlipayAlipay", "data={$data}")));
        }

    }

    public function isInAlipayClient()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false) {
            return true;
        }

        return false;
    }


    function get_device_type()
    {
        //全部变成小写字母
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        $type = 'other';

        //分别进行判断

        if (strpos($agent, 'iphone') || strpos($agent, 'ipad')) {

            $type = 'ios';

        }


        if (strpos($agent, 'android')) {

            $type = 'android';

        }

        return $type;
    }

    function location()
    {
        $order_id = intval(request::filter('request.id'));

        if ($this->isInAlipayClient()) {

            $order = $this->mysql->query('client_alipay_automatic_orders', "id={$order_id}")[0];
            if (empty($order)) functions::str_json('json', -1, '找不到订单信息');
            if ($order['status'] != 2) functions::str_json('json', -1, '订单已支付成功或失效');

            $data = $this->mysql->query("client_alipay_automatic_account", "id={$order['alipay_id']}", 'account_user_id,gathering_name')[0];
            if (empty($data['account_user_id'])) functions::str_json('json', -1, 'account_user_id不能为空');
            $mark = '(=姓牛)' . $order['alipay_id'] . '|' . $order['id'];
            $order['user_id'] = $data['account_user_id'];
            $order['mark'] = $mark;
            $order['method'] = url::s('gateway/pay/automaticAlipayQuery', "id={$order_id}");

            $url = 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data={"s": "money","u": "' . $data['account_user_id'] . '","a": "' . $order['amount'] . '","m": "' . $mark . '"}';
            header("Location:" . $url);


            $png_name = "alipay_" . md5($mark) . '.png';
            if (file_exists(PATH_STATIC . "/qrcode/" . $png_name)) {
                $order['qrcode_img'] = URL_ROOT . "/static/qrcode/" . $png_name;
            } else {

                $url = "alipays://platformapi/startApp?appId=10000011&url=" . urlencode(url::s("gateway/pay/automaticAlipay", "id={$order_id}"));

                $order['qrcode_img'] = functions::png($url, $png_name);
            }

            new view('service/locationMobile', $order);
        } else {
            header("Location:" . "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=" . url::s("gateway/pay/automaticAlipay", "id={$order_id}")));
        }

    }

    public function locationService()
    {
        $order_id = intval(request::filter('request.id'));
        if ($this->isInAlipayClient()) {


            $order = $this->mysql->query('service_order', "id={$order_id}")[0];
            if (empty($order)) functions::str_json('json', -1, '找不到订单信息');
            if ($order['status'] != 2) functions::str_json('json', -1, '订单已支付成功或失效');
            $data = $this->mysql->query("service_account", "id={$order['service_id']}", 'account_user_id,gathering_name')[0];
            if (empty($data['account_user_id'])) functions::str_json('json', -1, 'account_user_id不能为空');

            $mark = '(=姓牛)' . $order['service_id'] . '|' . $order['id'];
            $order['user_id'] = $data['account_user_id'];
            $order['mark'] = $mark;

            $url = 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data={"s": "money","u": "' . $data['account_user_id'] . '","a": "' . $order['amount'] . '","m": "' . $mark . '"}';
            header("Location:" . $url);


            $order['method'] = url::s('gateway/pay/serviceQuery', "id={$order_id}");


            //生成二维码图片
            $png_name = "service_" . md5($mark) . '.png';
            if (file_exists(PATH_STATIC . "/qrcode/" . $png_name)) {
                $order['qrcode_img'] = URL_ROOT . "/static/qrcode/" . $png_name;
            } else {

                $url = "alipays://platformapi/startApp?appId=10000011&url=" . urlencode(url::s("gateway/pay/service", "id={$order_id}"));

                $order['qrcode_img'] = functions::png($url, $png_name);
            }

            // new view('service/locationMobile', $order);
        } else {
            header("Location:" . "https://ds.alipay.com/?from=mobilecodec&scheme=" . urlencode("alipays://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=" . url::s("gateway/pay/service", "id={$order_id}")));
        }
    }

    public function android()
    {
        $order_id = intval(request::filter('request.id'));
        $url = url::s("gateway/pay/automaticAlipay", "id={$order_id}");
        new view("service/location", ['location_url' => $url]);
    }


    public function androidService()
    {
        $order_id = intval(request::filter('request.id'));
        $url = url::s("gateway/pay/service", "id={$order_id}");
        new view("service/location", ['location_url' => $url]);
    }


    public function png()
    {
        functions::png('http://www.baidu.com/');

    }

    public function getRemark($amount)
    {
        $date = date("Y_m_d_H_i");
        if ($amount > 100 && $amount < 1000) {
            $remark = "(购买闲鱼书籍={$amount}_{$date})";
        } elseif ($amount > 10001 && $amount < 3000) {
            $remark = "(购买VR眼镜={$amount}_{$date})";
        } elseif ($amount > 30001 && $amount < 5000) {
            $remark = "(购买小米电视={$amount}_{$date})";
        } elseif ($amount > 50001 && $amount < 7000) {
            $remark = "(电视订金={$amount}_{$date})";
        } elseif ($amount > 20001 && $amount < 25000) {
            $remark = "(闲鱼电脑订金={$amount}_{$date})";
        } elseif ($amount > 70001 && $amount < 9000) {
            $remark = "(MacBook pro 8核16G={$amount}_{$date})";
        } elseif ($amount > 90001 && $amount < 15000) {
            $remark = "(MacBook pro 8核32G={$amount}_{$date})";
        } elseif ($amount > 15000 && $amount < 30000) {
            $remark = "(二手车本田首付={$amount}_{$date})";
        } else {
            $remark = "(机器人玩具套装={$amount}_{$date})";
        }

        return $remark;
    }

    //全自动版支付宝 v1.0
    public function automaticBank()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_bank_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


        if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
            $res = $this->mysql->update('client_alipay_automatic_orders', ['status' => 3], "id={$order['id']}");

            functions::json(-2, '当前订单已经过期,请重新发起支付');
        }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['alipay_name'] = $this->mysql->query("client_bank_automatic_account", "id={$order['alipay_id']}")[0]['name'];
        $find_alipay = $this->mysql->query('client_bank_automatic_account', "id={$order['alipay_id']}")[0];

 //检测是否手机访问
        if (ip::isMobile()){
            $path = 'bank/bank';
        }else{
             $path = 'bank/bank';
        }
       
           
      
        if (empty($order['qrcode'])) {

        }

        $pay_data = [
            'id'            => $order['id'],
            'alipay_name'   => $order['gathering_name'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'account_no'     => trim($find_alipay['account_no']),
            //'gathering_name' => urlencode(trim($service['gathering_name'])),
            'gathering_name' => trim($find_alipay['gathering_name']),
           'bank_id'        => $order['bank_id'],
           'bank_name'      => $order['bank_name'],
             'cardid'         => trim($find_alipay['cardid']),
            'bank_acount'         => trim($order['bank_acount']),
            'location_url'  => url::s("gateway/pay/automaticAlipay", "id={$order['id']}"),
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('alipay_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
  
     public function tobank()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_bank_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


        if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
            $res = $this->mysql->update('client_alipay_automatic_orders', ['status' => 3], "id={$order['id']}");

            functions::json(-2, '当前订单已经过期,请重新发起支付');
        }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['alipay_name'] = $this->mysql->query("client_bank_automatic_account", "id={$order['alipay_id']}")[0]['name'];
        $find_alipay = $this->mysql->query('client_bank_automatic_account', "id={$order['alipay_id']}")[0];


       
            $path = 'bank/tobank';
      
        if (empty($order['qrcode'])) {

        }

        $pay_data = [
            'id'            => $order['id'],
            'alipay_name'   => $order['gathering_name'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'account_no'     => trim($find_alipay['account_no']),
            //'gathering_name' => urlencode(trim($service['gathering_name'])),
            'gathering_name' => trim($find_alipay['gathering_name']),
           'bank_id'        => $order['bank_id'],
           'bank_name'      => urlencode($order['bank_name']),
             'cardid'         => trim($find_alipay['cardid']),
            'bank_acount'         => trim($order['bank_acount']),
            'location_url'  => url::s("gateway/pay/automaticAlipay", "id={$order['id']}"),
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('alipay_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
  
  
  
    public function automatiBankQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_bank_automatic_orders', "id ={$id}", 'status,creation_time,expire_time,qrcode,alipay_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time() || $order['expire_time'] < time()) {

                $this->mysql->update('client_bank_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
  
  
  
   public function automaticwechatbank()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_wechatbank_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


        if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
            $res = $this->mysql->update('client_alipay_automatic_orders', ['status' => 3], "id={$order['id']}");

            functions::json(-2, '当前订单已经过期,请重新发起支付');
        }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['alipay_name'] = $this->mysql->query("client_wechatbank_automatic_account", "id={$order['alipay_id']}")[0]['name'];
        $find_alipay = $this->mysql->query('client_wechatbank_automatic_account', "id={$order['alipay_id']}")[0];


       
            $path = 'wechatbank/wechatbank';
      
        if (empty($order['qrcode'])) {

        }

        $pay_data = [
            'id'            => $order['id'],
            'alipay_name'   => $order['gathering_name'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'account_no'     => trim($find_alipay['account_no']),
            //'gathering_name' => urlencode(trim($service['gathering_name'])),
            'gathering_name' => trim($find_alipay['gathering_name']),
           'bank_id'        => $order['bank_id'],
           'bank_name'      => $order['bank_name'],
             'cardid'         => trim($find_alipay['cardid']),
            'bank_acount'         => trim($order['bank_acount']),
            'location_url'  => url::s("gateway/pay/automaticAlipay", "id={$order['id']}"),
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('alipay_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
  
  
  
    public function automatiwechatbankQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_wechatbank_automatic_orders', "id ={$id}", 'status,creation_time,expire_time,qrcode,alipay_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time() || $order['expire_time'] < time()) {

                $this->mysql->update('client_wechatbank_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
  
  
  
    //全自动版云闪付
    public function automaticyunshanfu()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_yunshanfu_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
      //  if (!is_array($order)) functions::json(-1, '当前交易号不存在');
     //   if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
       // if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


      //  if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
         //   $res = $this->mysql->update('client_yunshanfu_automatic_orders', ['status' => 3], "id={$order['id']}");

  //       //   functions::json(-2, '当前订单已经过期,请重新发起支付');
    //    }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['yunshanfu_name'] = $this->mysql->query("client_yunshanfu_automatic_account", "id={$order['yunshanfu_id']}")[0]['name'];
        $find_yunshanfu = $this->mysql->query('client_yunshanfu_automatic_account', "id={$order['yunshanfu_id']}")[0];


      
            $path = 'yunshanfu/yunshanfu';
      

        $pay_data = [
            'id'            => $order['id'],
          'user_id'            => $order['user_id'],
           'yunshanfu_id' => $order['yunshanfu_id'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'location_url'  => url::s("gateway/pay/automaticyunshanfu", "id={$order['id']}"),
          'app_user'=> $find_yunshanfu['app_user']
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('yunshanfu_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
 public function automaticyunshanfuQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_yunshanfu_automatic_orders', "id ={$id}", 'status,creation_time,expire_time,qrcode,yunshanfu_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time() || $order['expire_time'] < time()) {

                $this->mysql->update('client_yunshanfu_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
  
  
   //全自动版云闪付
    public function automaticlakala()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_lakala_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
      //  if (!is_array($order)) functions::json(-1, '当前交易号不存在');
     //   if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
       // if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


      //  if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
         //   $res = $this->mysql->update('client_lakala_automatic_orders', ['status' => 3], "id={$order['id']}");

  //       //   functions::json(-2, '当前订单已经过期,请重新发起支付');
    //    }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['lakala_name'] = $this->mysql->query("client_lakala_automatic_account", "id={$order['lakala_id']}")[0]['name'];
        $find_lakala = $this->mysql->query('client_lakala_automatic_account', "id={$order['lakala_id']}")[0];


    
            $path = 'lakala/lakala';
      

        $pay_data = [
            'id'            => $order['id'],
           'lakala_id' => $order['lakala_id'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'location_url'  => url::s("gateway/pay/automaticlakala", "id={$order['id']}"),
           'app_user'=> $find_lakala['app_user']
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('lakala_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
 public function automaticlakalaQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_lakala_automatic_orders', "id ={$id}", 'status,creation_time,expire_time,qrcode,lakala_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time() || $order['expire_time'] < time()) {

                $this->mysql->update('client_lakala_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
   //全自动版云闪付
    public function automaticnxys()
    {
        $type = request::filter('get.content_type', '', 'htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_nxys_automatic_orders', "id={$id}")[0];


        //print_r($order);die;
      //  if (!is_array($order)) functions::json(-1, '当前交易号不存在');
     //   if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
       // if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');


      //  if (($order['creation_time'] + 599) < time()  || $order['expire_time'] < time()) {
         //   $res = $this->mysql->update('client_nxys_automatic_orders', ['status' => 3], "id={$order['id']}");

  //       //   functions::json(-2, '当前订单已经过期,请重新发起支付');
    //    }
        $pay_url = '';
        $order['method'] = '';
        //查询微信信息
        // $order['nxys_name'] = $this->mysql->query("client_nxys_automatic_account", "id={$order['nxys_id']}")[0]['name'];
        $find_nxys = $this->mysql->query('client_nxys_automatic_account', "id={$order['nxys_id']}")[0];


              if($find_nxys['type'] == 0){
                    $path = 'nxys/nxys';
             }else if($find_nxys['type'] == 1){
				 $path = 'nxys/nxys';
				}else{
				 $path = 'nxys/nxysyl';
				}

        $pay_data = [
            'id'            => $order['id'],
            'nxys_id' => $order['nxys_id'],
            'creation_time' => $order['creation_time'],
            'status'        => $order['status'],
            'amount'        => $order['amount'],
            'success_url'   => $order['success_url'],
            'error_url'     => $order['error_url'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'qrcode'        => $order['qrcode'],
            'location_url'  => url::s("gateway/pay/automaticnxys", "id={$order['id']}"),
            'app_user'=> $find_nxys['app_user'],
			'type'=>$order['type']
        ];

        //检测网页类型是否为json
        if ($type == 'json') {

            if (empty($pay_data['qrcode'])) {
                $qrcode = functions::getOrderCode('nxys_' . intval($id));
                $pay_data['qrcode'] = $qrcode;
            }

            functions::json(200, 'success', $pay_data);
        } else {
            new view($path, $pay_data);
        }
    }
	
 public function automaticnxysQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_nxys_automatic_orders', "id ={$id}", 'status,creation_time,expire_time,qrcode,nxys_id')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 599) < time() || $order['expire_time'] < time()) {

                $this->mysql->update('client_nxys_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode'], 'is_new_version' => intval($acc['is_new_version'])]);
        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }
  
   //收钱吧
    public function automaticshouqianba(){
        $type = request::filter('get.content_type','','htmlspecialchars');
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_shouqianba_automatic_orders',"id={$id}")[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 3) functions::json(-1, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
        //查询微信信息
		$order['name'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['name'];
		$order['account'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['account'];
        $order['pid'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['pid'];
        $order['app_user'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['app_user'];
        $order['is_hongbao'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['is_hongbao'];
       $order['type'] = $this->mysql->query("client_shouqianba_automatic_account","id={$order['shouqianba_id']}")[0]['type'];
      
		$order['qrcode'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

      	$path = 'shouqianba/sqb_alipay';
        $pay_data = [
            'id' => $order['id'],
			'name' => $order['name'],
			'account' => $order['account'],
			'pid' => $order['pid'],
            'creation_time' => $order['creation_time'],
            'status' => $order['status'],
            'amount' => $order['amount'],
            'success_url' => $order['success_url'],
            'error_url' => $order['error_url'],
            'out_trade_no' => $order['out_trade_no'],
            'trade_no' => $order['trade_no'],
            'qrcode' => $order['qrcode'],
           'app_user' => $order['app_user'],
           'is_hongbao' => $order['is_hongbao']
            
        ];
        //检测网页类型是否为json
        if ($type == 'json'){
            functions::json(200, 'success', $pay_data);
        }else{
           if (ip::isMobile()){
             
              if($order['type'] == 2){
                
              	$path = 'shouqianba/sqb_wechat';
                new view($path,$pay_data);
                exit;
              }
              $payurl = $pay_data['qrcode'];
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'Alipay') === false){
                  header("location: https://render.alipay.com/p/s/i?scheme=".urlencode("alipays://platformapi/startapp?saId=10000007&qrcode=".urlencode($payurl)));
              }else{
                if(!empty($order['pno'])){
                	$pay_data['tradeNo'] = $order['pno'];
      				$path = 'shouqianba/sqb_alipay_h5';
                }else{
                    $auth_code = $_GET['auth_code'];
                    if(empty($auth_code)){
                      header("location: https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=2019051064472036&scope=auth_base&redirect_uri=".urlencode($payurl)."&state=1");
                      exit;
                    }
                    $userid = file_get_contents("http://dd.qakmak.com/alipay_user.php?code=".$auth_code);
                    $url = 'https://qr.shouqianba.com/qr/api/pay?_='.time();
                  	$qrcodeId = $order['pid'];
                    $post = '{"amount":'.$order['amount'].',"qrCodeId":"'.$qrcodeId.'","remark":"'.$order['trade_no'].'"}';
                    $ch = curl_init(); 
                    curl_setopt($ch, CURLOPT_URL, $url); 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $header = array ();
                    $header [] = 'Host:qr.shouqianba.com';
                    $header [] = 'Accept: application/json';
                    $header [] = 'X-QRCODE-ID: '.$qrcodeId.'';
                    $header [] = 'X-Requested-With: XMLHttpRequest';
                    $header [] = 'Accept-Language: zh-cn';
                    $header [] = 'Accept-Encoding: br, gzip, deflate';
                    $header [] = 'Content-Type: application/json; charset=UTF-8';
                    $header [] = 'Origin: https://qr.shouqianba.com';
                    $header [] = 'User-Agent: '.$_SERVER['HTTP_USER_AGENT'];
                    $header [] = 'Content-Length: '.strlen($post);
                    $header [] = 'Referer: https://qr.shouqianba.com/'.$qrcodeId.'';
                    $header [] = 'Connection: keep-alive';
                    $header [] = 'X-OPEN-ID: '.$userid;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header );   
                    curl_setopt($ch, CURLOPT_POST, 1);  
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); 
                    $login = curl_exec($ch); 
                    curl_close($ch);
                    $resp = json_decode($login,true);
                    if($resp['code'] == 200 && !empty($resp['data']['wapPayRequest']['tradeNO'])){
                        $tradeNo = $resp['data']['wapPayRequest']['tradeNO'];
		                $fa = $this->mysql->update('client_shouqianba_automatic_orders', ['pno' => $tradeNo,'sqbno' => $resp['data']['sn']], "id={$order['id']}");
                        $pay_data['tradeNo'] = $tradeNo;
                        $path = 'shouqianba/sqb_alipay_h5';
                    }else{
                        $path = 'shouqianba/sqb_alipay_h5';
                    }
                }
            	new view($path,$pay_data);
              }
           }else{
             
              if($order['type'] == 2){
                
              	$path = 'shouqianba/sqb_wechat';
                new view($path,$pay_data);
                exit;
              }
             	new view($path,$pay_data);
           }
        }
    }
  
    //订单查询
    public function automaticshouqianbaQuery()
    {
        $id = intval(request::filter('get.id'));
        $order = $this->mysql->query('client_shouqianba_automatic_orders', "id ={$id}", 'status,creation_time,qrcode')[0];
        if (!is_array($order)) functions::json(-1, '当前交易号不存在');
        if ($order['status'] == 1) functions::json(1, '正在与网关连接中..');
        if ($order['status'] == 2) {
            if (($order['creation_time'] + 299) < time()) {
                $this->mysql->update('client_shouqianba_automatic_orders', ['status' => 3], "id={$order['id']}");

                functions::json(-2, '当前订单已经过期,请重新发起支付');
            }
            if (empty($order['qrcode'])) {

                $order['qrcode'] = functions::getOrderCode('shouqianba_' . intval($id));

            }

            functions::json(100, '请扫码支付', ['qrcode' => $order['qrcode']]);

        }
        if ($order['status'] == 3) functions::json(-2, '当前订单已经过期,请重新发起支付');
        if ($order['status'] == 4) functions::json(200, '当前订单已经支付成功!');
    }


}