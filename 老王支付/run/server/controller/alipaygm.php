<?php
namespace xh\run\server\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;
use xh\library\url;



//支付宝-全自动版-服务端
class alipaygm{
    
    private $mysql;
    
    public function __construct(){
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

  
  
  	public function chazt(){
		
	$find = $this->mysql->query("client_alipaygm_automatic_orders", "status=2");

    foreach($find as $val){
		
/**********************************************************************************************************************************************/
               $header="Cookie:".$val['wb_cookie'];
         
                //请求地址
                $url = "https://pay.sc.weibo.com/aj/pc/biz/list?biz_id=".$val['wb_order'];


                //headers请求头
                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $header,
                  ));
                $context = stream_context_create($context_options);

                //获取资源
                $paylist = file_get_contents($url,FALSE,$context);

				 $arr = json_decode($paylist, true);
				 $res=$arr['data']['biz'];
				 $amount=$res[0]['amount'];
				 $status=$res[0]['status'];
				 $out_pay_id=$res[0]['order_id'];
				 $status_desc=$res[0]['status_desc'];	

				 $status_name='交易成功';
                 $this->mysql->update('client_alipaygm_automatic_orders', ['aliorder' => $out_pay_id], "id={$val['id']}");
      
 file_put_contents("log/查单.txt", date('Y-m-d H:i:s')."|订单ID:|".$val['id'].'|'."|状态:|".$status_desc.'|'."|查单url:|".$out_pay_id.'|'."\n", FILE_APPEND);
      
				$a=$status;
				$b=2;
				if ($val['wb_order'] > 0 && $a == $b && $status_desc == $status_name ) { 

        		 $rea = callbacks::curl(URL_ROOT . '/server/alipaygm/uploadOrder', http_build_query(['uid' =>$val['uid'],'wb_order' => $out_pay_id,'id' => $val['id'],'money' => $val['amount']]));	
                  
        			
                  var_dump($rea);
        			file_put_contents("log/log.txt", date('Y-m-d H:i:s')."|回调信息:|".$rea.'|'."\n", FILE_APPEND);
					
					
				}
        		
    	
    	
    	
/**********************************************************************************************************************************************/    	
    	
    	
    	
    	
    	
    }

	
	
	
	//echo '执行成功';


		
	}





 public function update(){
		 
		
			
			 $NowTime = time() -600;
			 
			 $this->mysql->update("client_alipaygm_automatic_orders", [
                'status'=> 3
                
            ],"creation_time < {$NowTime} and status!=4");
			
			
			if($this){
				
				echo 'ok';
			}else{
				
				'no';
			}
             
	 }
    
		public function maxamount(){
		
	$find = $this->mysql->query("client_alipaygm_automatic_appid", "status=4");
   
    foreach($find as $val){
			
     $max_amount=$val['max_amount'];
     
     $time=time();
	
	$this->mysql->update("client_alipaygm_automatic_appid", ['status' => 1,'max_time'=>$time], "amount >={$max_amount}");
    
    	
    }

	echo 'ok';

	}
	
  public function clearamount(){

    $this->mysql->update("client_alipaygm_automatic_appid", ['status' => 4,'amount'=>0,'today_number'=>0], "status!=5");

	echo 'ok';


		
	}

    
    //上载订单通知
    public function uploadOrder(){
	
     file_put_contents("alipaygm_log32.txt", json_encode($_POST));
       	$order = intval(request::filter('post.id'));
        $uid = intval(request::filter('post.uid'));
        $orderid =intval(request::filter('post.wb_order'));


		$find_order = $this->mysql->query('client_alipaygm_automatic_orders', "id={$order} and status=2")[0];

        $id=$find_order['alipaygm_id'];
		$fid=$find_order['wb_uid'];
		$kuk=$find_order['wb_cookie'];
		
		  
        			file_put_contents("log/logcallback.txt", date('Y-m-d H:i:s')."|回调信息:|".json_encode($_POST).'|'."\n", FILE_APPEND);
	///接收过来再次查单以防错误回调
/**********************************************************************************************************************************************/		
               $header="Cookie:".$find_order['wb_cookie'];
                
                //请求地址
                $url = "https://pay.sc.weibo.com/aj/pc/biz/list?biz_id=".$find_order['wb_order'];

                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $header,
                  ));
                $context = stream_context_create($context_options);
                //获取资源
                $paylist = file_get_contents($url,FALSE,$context);
				 $arr = json_decode($paylist, true);
				 $res=$arr['data']['biz'];
				 $amount=$res[0]['amount'];
				 $status=$res[0]['status'];
				 $out_pay_id=$res[0]['order_id'];
				 $status_desc=$res[0]['status_desc'];		
				 $status_name='交易成功';
		file_put_contents("log/回调检测查单.txt", date('Y-m-d H:i:s')."|订单ID:|".$find_order['id'].'|'."|状态:|".$status_desc.'|'."|查单url:|".$url.'|'."\n", FILE_APPEND);
				 $a=$status;
				 $b=2;

				 
		if ($find_order['wb_order'] > 0 && $a == $b && $status_desc == $status_name) {		 
		//检测成功开始领包回调
/**********************************************************************************************************************************************/	


	
        //$find_appid = $this->mysql->query("client_alipay_automatic_appid", "status=4 and user_id={$find_order['user_id']} and weid={$find_order['alipay_id']} and amount<10000");
        $find_appid = $this->mysql->query("client_alipaygm_automatic_appid", "status=4 and user_id={$find_order['user_id']} and amount<10000");
          
        $count_alipay = count($find_appid);
   
        $find_appid = $find_appid[mt_rand(0, $count_alipay - 1)];
     
		$shouid=$find_appid['appid'];
		$cookieSeller=$find_appid['cookie'];
          
          
        if($syrmb<201){
        	
        	
           $find_ordera = $this->mysql->query('client_alipaygm_automatic_orders', "id={$order}")[0];
		

        	
		       
		        $iad=$find_appid['id']; 
		        $all_amount=$find_appid['all_amount'];   
		        $max_amount=$find_appid['max_amount'];
		        $jr_amount=$find_appid['amount'];
		        $today_number=$find_appid['today_number'];
		        $all_number=$find_appid['all_number'];
				$appid=$find_appid['appid']; //收包ID
        	
        	
/********************************************************************************************************************************************************/        	
   // 发红包信息至收款人     	
             $cookie='Cookie:'.$kuk;
             $msgid=$shouid;  //收包id
             $payercookie=$cookie; //发包人cookie
/********************************************************************************************************************************************************/ 
//先互相关注 在发包
//先关注发包人关注收包人微博 // 请注意 只能他妈电脑获取得cookie 否则无效！
                $addUrl = 'https://weibo.com/aj/f/followed?ajwvr=6';
                //post数据
                $addData = array(
                    'uid' => $msgid,
                    'f' => '1',
                    'refer_flag' => '1005050001_',
                    'location' => 'page_100505_home',
                    'oid' => $msgid,
                    'wforce' => '1',
                    'nogroup' => '1',
                    'refer_from' => 'profile_headerv6',
                    'template' => '7',
                    'special_focus' => '1',
                    'isrecommend' => '1',
                    'is_special' => '0',
                    'redirect_url' => '%2Fp%2F1005057345773101%2Fmyfollow%3Fgid%3D4444185002098079%23place',
                    '_t' => '0'
                );
                
                $refer='https://weibo.com/u/'.$msgid.'?is_hot=1&noscale_head=1';
               
			    $Referer='Referer:'.$refer;
                $addHeader = array('Host:weibo.com','Origin:https://weibo.com','Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36','X-Requested-With:XMLHttpRequest',$Referer,$payercookie);
                
                
                
                $addResult = $this->curl_post($addUrl, $addHeader, $addData);
                //file_put_contents("addpayResult.txt", $addResult);
                
                $addResData = json_decode($addResult, true);
                $addcode=$addResData['code'];

                //100000 代表成功 详情看日志 
                file_put_contents("log/paycode.txt", date('Y-m-d H:i:s')."|发包关注收包:|".$addcode.'|'."\n", FILE_APPEND);
                
                //file_put_contents("addResData.txt", $addResData);
                
///////////////////////////////然后收包人关注发包人


				if($addcode==100000){
                	
                	
                $Sellerookie='Cookie:'.$cookieSeller;	
                $aadfUrl = 'https://weibo.com/aj/f/followed?ajwvr=6';
                //post数据
                $aadfData = array(
                    'uid' => $fid,
                    'f' => '1',
                    'refer_flag' => '1005050001_',
                    'location' => 'page_100505_home',
                    'oid' => $fid,
                    'wforce' => '1',
                    'nogroup' => '1',
                    'refer_from' => 'profile_headerv6',
                    'template' => '7',
                    'special_focus' => '1',
                    'isrecommend' => '1',
                    'is_special' => '0',
                    'redirect_url' => '%2Fp%2F1005057345773101%2Fmyfollow%3Fgid%3D4444185002098079%23place',
                    '_t' => '0'
                );
                
                $refer='https://weibo.com/u/'.$fid.'?is_hot=1&noscale_head=1';
                
			    $Referer='Referer:'.$refer;
                $aadfHeader = array('Host:weibo.com','Origin:https://weibo.com','Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36','X-Requested-With:XMLHttpRequest',$Referer,$Sellerookie);
                
                
                
                $aadfResult = $this->curl_post($aadfUrl, $aadfHeader, $aadfData);
               // file_put_contents("aadfResult.txt", $aadfResult);
                
                $aadfResData = json_decode($aadfResult, true);
                $aadfcode=$aadfResData['code'];
                //100000 代表成功 详情看日志 
				file_put_contents("log/takeusercode.txt", date('Y-m-d H:i:s')."|收包关注发包:|".$aadfcode.'|'."\n", FILE_APPEND);
                }



/********************************************************************************************************************************************************/ 
                            
                $sUrl = 'https://mall.e.weibo.com/aj/redenvelope/sendmsg';
                
                $aData = array(
                    'msgid' => $msgid,
                    'msgtype' => '1',
                    'set_id'   => $orderid,
                    '_t'      => '0'
                );
                
                $aHeader = array('Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1))','X-Requested-With:XMLHttpRequest',$cookie);
                $sResult = $this->curl_post($sUrl, $aHeader, $aData);
                //file_put_contents("sResult.txt", $sResult);
                $aResData = json_decode($sResult, true);	
                $code=$aResData['code'];
/********************************************************************************************************************************************************/                
              
              
        		if($code==100000){
/********************************************************************************************************************************************************/	
//小于200金额得开始收包！

         	   $xheader="X-Requested-With:com.sina.weibo\r\nx-user-agent:HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1\r\nUser-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1)\r\nCookie:".$cookieSeller."\r\n";
                
                //请求地址
                $urla = "https://mall.e.weibo.com/h5/redenvelope/draw?set_id=".$orderid."&sinainternalbrowser=topnav&portrait_only=1&from=1097295010&weiboauthoruid=";
                //headers请求头
                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $xheader,
                  ));
                $contexta = stream_context_create($context_options);
                //获取资源
                $html = file_get_contents($urla,FALSE,$contexta);
                
//file_put_contents("html.txt", $html);

         	    $matches = array();
				preg_match_all('( <p class="red_amount">(.*)</p>)', $html, $matches);
				$money=$matches[1][0];
			
				$arry=empty($money);
				
			    
/********************************************************************************************************************************************************/
				
				if($arry==false){
					
				$rea = callbacks::curl(URL_ROOT . '/server/alipaygm/takelist', http_build_query(['id' => $order,'userid' => $find_order['user_id'],'amount' =>$money,'fid' => $fid,'seler_uid' => $appid,'set_id' => $orderid,'kuk' => $kuk]));
				
					
					
					
				$this->mysql->update("client_alipaygm_automatic_orders", [
                'syrmb'         => $find_ordera['syrmb']-$money,
            	 ], "id={$find_ordera['id']}");
				
				
        		 
        		 
              	$ins=$this->mysql->update("client_alipaygm_automatic_appid", [
		                'all_amount'         => $all_amount+$money,
		                'amount'             => $jr_amount+$money,
		                'today_number'        => $today_number+1,
		                'all_number'         => $all_number+1,
		            ], "id={$iad}");

			
	}    
		            
		}

                
                
        	
        }  


            
            

        
        
        

     
        if (is_array($find_order)) {
            $this->mysql->update("client_alipaygm_automatic_orders", [
                'status'        => 4,
                'pay_time'      => time(),
                'callback_from' => 'app',
            ], "id={$find_order['id']}");
            $remark = ' - 订单信息：' . $order;
            $average = 1;

        } else {
            $remark = ' - 该订单不是第三方交易订单';
            $average = 0;
        }
        //查询用户信息
        $find_uid = $this->mysql->query("client_alipaygm_automatic_account", "id={$id}")[0]['user_id'];
        
  
        
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'     => time(),
            'amount'       => $money,
            'user_id'      => $find_uid,
            'pay_note'     => '支付宝ID：' . $order . $remark,
            'types'        => 2,
            'version_code' => 'alipaygm_auto',
            'average'      => $average
        ]);
   
	    
		
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'=>time(),
            'amount'=>$money,
            'user_id'=>$find_uid,
            'pay_note'=>'[红包转账]ID：'.$id . $remark,
            'types'=>2,
            'version_code'=>'alipaygm_auto',
            'average'=>$average
        ]);
       // functions::json(200, ' ['.date("Y/m/d H:i:s",time()).']: 订单ID->' . $order_id . ' 订单处理完成');
		//  echo 'success';exit;
          
		 $result = callbacks::curl(URL_ROOT . '/server/alipaygm/callback', http_build_query(['id' => $id, 'orderid' => $order]));
          
        

        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 这里是支付宝回调-订单ID->' . $order . ' 订单处理完成' . $result);
        
	 
     }
    }
    
  
  public function takehb(){
  
    $find = $this->mysql->query('client_alipaygm_automatic_orders', "status = 4 ", 'id,wb_uid,wb_order,wb_cookie,user_id,aliorder,syrmb,alipaygm_id,pay_time');
     
//  var_dump($find);exit;
//	file_put_contents("find.txt", json_encode($find));

   
     foreach($find as $val){
	
	
	  if (($val['pay_time']+ 3599) > time()) {
                
			
 /********************************************************************************************************************************************************/               
            		
     $did=$val['id'];
     $uid=$val['wb_uid'];
     $order_id=$val['aliorder'];
     $cookie=$val['wb_cookie'];
     $kuk=$val['wb_cookie'];
     $user_id=$val['user_id'];
     $key_id=$val['key_id'];
     $syrmb=$val['syrmb'];
     $alipay_id=$val['alipaygm_id'];
     //收
     
     
           //$find_seller = $this->mysql->query("client_alipaygm_automatic_appid", "status=4 and user_id={$user_id} and weid={$alipay_id} and amount<10000");
           $find_seller = $this->mysql->query("client_alipaygm_automatic_appid", "status=4 and user_id={$user_id}  and amount<10000");
           $count_alipay = count($find_seller);
           //if ($count_alipay == 0) functions::str_json($type_content, -1, 'automatic->初始化失败,没有可用的通道');
           $find_seller = $find_seller[mt_rand(0, $count_alipay - 1)];
          
         
           
    		 $aid=$find_seller['id'];	
		     $cookieSeller=$find_seller['cookie'];
			 $shouid=$find_seller['appid'];     
			  //file_put_contents("shouid.txt", json_encode($shouid));
			 $all_amount=$find_seller['all_amount'];   
			 $max_amount=$find_seller['max_amount'];
			 $jr_amount=$find_seller['amount'];
			 $today_number=$find_seller['today_number'];
		     $all_number=$find_seller['all_number'];
			 



/********************************************************************************************************************************************************/


	        		$cookie='Cookie:'.$cookie;
            		$msgid=$shouid;
            		$payercookie=$cookie; //发包人cookie
            		
            
/********************************************************************************************************************************************************/ 
//先互相关注 在发包
//先关注发包人关注收包人微博 // 请注意 只能他妈电脑获取得cookie 否则无效！
                $addUrl = 'https://weibo.com/aj/f/followed?ajwvr=6';
                //post数据
                $addData = array(
                    'uid' => $msgid,
                    'f' => '1',
                    'refer_flag' => '1005050001_',
                    'location' => 'page_100505_home',
                    'oid' => $msgid,
                    'wforce' => '1',
                    'nogroup' => '1',
                    'refer_from' => 'profile_headerv6',
                    'template' => '7',
                    'special_focus' => '1',
                    'isrecommend' => '1',
                    'is_special' => '0',
                    'redirect_url' => '%2Fp%2F1005057345773101%2Fmyfollow%3Fgid%3D4444185002098079%23place',
                    '_t' => '0'
                );
                
                $refer='https://weibo.com/u/'.$msgid.'?is_hot=1&noscale_head=1';
                
			    $Referer='Referer:'.$refer;
                $addHeader = array('Host:weibo.com','Origin:https://weibo.com','Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36','X-Requested-With:XMLHttpRequest',$Referer,$payercookie);
                
                
                
                $addResult = $this->curl_post($addUrl, $addHeader, $addData);
                //file_put_contents("addpayResult.txt", $addResult);
                
                $addResData = json_decode($addResult, true);
                $addcode=$addResData['code'];
                //100000 代表成功 详情看日志 
                file_put_contents("log/DaEpaycode.txt", date('Y-m-d H:i:s')."|发包关注收包:|".$addcode.'|'."\n", FILE_APPEND);
                
                //file_put_contents("addResData.txt", $addResData);
                
///////////////////////////////然后收包人关注发包人


				if($addcode==100000){
                	
                	
                $Sellerookie='Cookie:'.$cookieSeller;	
                $aadfUrl = 'https://weibo.com/aj/f/followed?ajwvr=6';
                //post数据
                $aadfData = array(
                    'uid' => $uid,
                    'f' => '1',
                    'refer_flag' => '1005050001_',
                    'location' => 'page_100505_home',
                    'oid' => $uid,
                    'wforce' => '1',
                    'nogroup' => '1',
                    'refer_from' => 'profile_headerv6',
                    'template' => '7',
                    'special_focus' => '1',
                    'isrecommend' => '1',
                    'is_special' => '0',
                    'redirect_url' => '%2Fp%2F1005057345773101%2Fmyfollow%3Fgid%3D4444185002098079%23place',
                    '_t' => '0'
                );
                
                $refer='https://weibo.com/u/'.$uid.'?is_hot=1&noscale_head=1';
                
			    $Referer='Referer:'.$refer;
                $aadfHeader = array('Host:weibo.com','Origin:https://weibo.com','Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36','X-Requested-With:XMLHttpRequest',$Referer,$Sellerookie);
                
                
                
                $aadfResult = $this->curl_post($aadfUrl, $aadfHeader, $aadfData);
               // file_put_contents("aadfResult.txt", $aadfResult);
                
                $aadfResData = json_decode($aadfResult, true);
                $aadfcode=$aadfResData['code'];
                //100000 代表成功 详情看日志 
				file_put_contents("log/DaEtakeusercode.txt", date('Y-m-d H:i:s')."|收包关注发包:|".$aadfcode.'|'."\n", FILE_APPEND);
                }                           
/********************************************************************************************************************************************************/                            

                            // 发红包信息至收款人
                $sUrl = 'https://mall.e.weibo.com/aj/redenvelope/sendmsg';
                //post数据
                $aData = array(
                    'msgid' => $msgid,
                    'msgtype' => '1',
                    'set_id'   => $order_id,
                    '_t'      => '0'
                );
                
             // file_put_contents("aData.txt", $aData);
                
                $aHeader = array('Content-type:application/x-www-form-urlencoded','User-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1))','X-Requested-With:XMLHttpRequest',$cookie);
                
                
                
                $sResult = $this->curl_post($sUrl, $aHeader, $aData);
                
                $aResData = json_decode($sResult, true);	
                $code=$aResData['code'];
                
                
 /********************************************************************************************************************************************************/               
                
/********************************************************************************************************************************************************/



              //开始收包！
              
        		if($code==100000){
         	
         	   $header="X-Requested-With:com.sina.weibo\r\nx-user-agent:HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1\r\nUser-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1)\r\nCookie:".$cookieSeller."\r\n";
                
                $url = "https://mall.e.weibo.com/h5/redenvelope/draw?set_id=".$order_id."&sinainternalbrowser=topnav&portrait_only=1&from=1097295010&weiboauthoruid=";
                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $header,
                  ));
                $context = stream_context_create($context_options);
                $html = file_get_contents($url,FALSE,$context);
                file_put_contents("log/html.txt", date('Y-m-d H:i:s')."|html:|".$html.'|'."\n", FILE_APPEND);
				$matches = array();
				preg_match_all('( <p class="red_amount">(.*)</p>)', $html, $matches);
				$money=$matches[1][0];
				
				
				
				 file_put_contents("log/takemoney.txt", date('Y-m-d H:i:s')."|金额:|".$money.'|'."\n", FILE_APPEND);
				 
				$arry=empty($money);
				
				
/********************************************************************************************************************************************************/				
				
				if($arry==false){
				//echo "不为空";	
				 $this->mysql->update("client_alipaygm_automatic_orders", ['syrmb' => $syrmb-$money], "id={$did}");
				
				$this->mysql->update("client_alipaygm_automatic_appid", ['all_amount' => $all_amount+$money,'amount' => $jr_amount+$money,'today_number' => $today_number+1,'all_number' => $all_number+1], "id={$aid}");
					
				}
				 
			 
				 
				 
/********************************************************************************************************************************************************/			 
	//开始查单			
	$rea = callbacks::curl(URL_ROOT . '/server/alipaygm/takelist', http_build_query(['userid' => $user_id,'amount' =>$money,'fid' => $uid,'seler_uid' => $shouid,'set_id' => $order_id,'kuk' => $kuk]));	

/********************************************************************************************************************************************************/	        			
        		}

    
	  }	
    
     	
     }
  
  echo 'success';
  
  }	
	
  
  //takelist 接口
 public function takelist()
  {
    	
    $orderid= request::filter('post.id');
    $userid = request::filter('post.userid');
    $amount = request::filter('post.amount');
    $fid = request::filter('post.fid');
    $seler_uid = request::filter('post.seler_uid');
    $set_id = request::filter('post.set_id');
    $ida = request::filter('post.ida');
    $kuk = request::filter('post.kuk');
   
   

/********************************************************************************************************************************************************/				//查单

				
			     $header="X-Requested-With:com.sina.weibo\r\nx-user-agent:HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1\r\nUser-Agent:Mozilla/5.0 (Linux; Android 5.1.1; DUK-AL20 Build/LMY48Z) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/39.0.0.0 Safari/537.36 Weibo (HUAWEI-DUK-AL20__weibo__9.7.2.1__android__android5.1.1)\r\nCookie:".$kuk."\r\n";
				
                $url = "https://mall.e.weibo.com/h5/redenvelope/recvdetailowner?set_id=".$set_id."&uicode=";
                $context_options = array(
                 'http' =>
                  array(
                   'method' => "GET",
                   'header' => $header,
                  ));
                  
                $context = stream_context_create($context_options);
              
                $cxhtml = file_get_contents($url,FALSE,$context); 
                
               file_put_contents("cxhtml.txt", $cxhtml);
                 
                //发包人昵称
               	$fabao = array();
				preg_match_all('(<title>(.*)的群组红包</title>)', $cxhtml, $fabao);
				$get_name =$fabao[1][0];
				
             
               
				//收包人昵称
				$shoubao = array();
				preg_match_all('( <span class="username">(.*)</span>)', $cxhtml, $shoubao);
				
				$seler_name =$shoubao[1][0];
				
				
			//	$arry=empty($shoubao);
				
			//	file_put_contents("arry.txt", $seler_name);
				
				
			if (empty($seler_name)){
							
						$ian=$this->mysql->insert("client_take", [
		            'user_id'      => $userid,
		            'amount'       => $amount,
		            'get_name'     => $get_name,
		            'owner_uid'    => $fid,
		            'seler_uid '   => $seler_uid,
		            'set_id '      => $set_id
		        ]);  
							
			   }else{
							
			$ian=$this->mysql->insert("client_take", [
		            'user_id'      => $userid,
		            'amount'       => $amount,
		            'get_name'     => $get_name,
		            'seler_name'   => $seler_name,
		            'owner_uid'    => $fid,
		            'seler_uid '   => $seler_uid,
		            'set_id '      => $set_id
		        ]);  		
							
						}

			  //file_put_contents("aaa.txt", $ian);
/********************************************************************************************************************************************************/			
			  //写到领取记录
			     

		        
		        
		        
		    if($ian>0){
		    	
		    functions::json(200, '插入完成');	
		    	
		    	
		    }    
    	
    	
    	
    }


	
   
      //异步通知
    public function callback(){
       // $module_name = 'service_auto';
         $module_name = 'alipaygm_auto';
        $alipaygm_id = request::filter('post.id');
		$order_id = request::filter('post.orderid');
        if (empty($alipaygm_id)) functions::json(-1, 'ID错误');
        //服务信息
        $service = $this->mysql->query('client_alipaygm_automatic_account',"id={$alipaygm_id}")[0];
        if (!is_array($service)) functions::json(-1, '服务错误');
        // -------------------------
        // 获取需要回调的列表
       $order = $this->mysql->query('client_alipaygm_automatic_orders', "id={$order_id} and status=4 and callback_status=0");
      
        foreach ($order as $obj) {
            //检测是否为用户订单
            if ($obj['user_id'] != 0){
                //是用户
                $user = $this->mysql->query("client_user","id={$obj['user_id']}")[0];
                //得到该用户组
                $group = $this->mysql->query('client_group',"id={$user['group_id']}")[0];
                //解析数据
                $authority = json_decode($group['authority'],true)[$module_name];
                //判断用户组是否存在
                if (is_array($group) || $group['authority'] != -1 || $authority['open'] == 1) {
                  
											// 开始扣手续费
            $fees = $obj['amount'] * $authority['cost'];
            $user_balance = $user['balance'] - $fees; // 用户最终余额
            if ($user_balance >= 0) {
                // 扣除费用
                $deductionStatus = $this->mysql->update("client_user", [
                    'balance' => $user_balance
                ], "id={$user['id']}");
                if ($deductionStatus > 0 || $obj['amount'] < 1) {
                    $user['balance'] = $user_balance;
                    $callback_time = time();
                          
						 
                            // 手续费扣除成功，开始回调
                            $result = callbacks::curl($obj['callback_url'], http_build_query([
                                'account_name' => $user['username'],
                                'pay_time' => $pay_time,
                                'status' => 'success',
                                'amount' => $obj['amount'],
                                'out_trade_no' => $obj['out_trade_no'],
                                'trade_no' => $obj['trade_no'],
                                'fees' => $fees,
                                'sign' => functions::sign($user['key_id'], [
                               'amount' => $obj['amount'],
                               'out_trade_no' => $obj['out_trade_no']
                        ]),
                                'callback_time' => $callback_time,
                                'type'=>$obj['types'],
                                'account_key'=>$user['key_id'],
								'money'=>$obj['money']
                            ]));
                            //更新订单
                            $this->mysql->update("client_alipaygm_automatic_orders", [
                                'callback_time' => $callback_time,
                                'callback_status' => 1,
                                'callback_content' => $result,
                                'fees' => $fees,
                                'reached'=>1
                            ], "id={$obj['id']}");

                }
            }
        }
			}
		}
        $this->mysql->update("client_alipaygm_automatic_account", ['active_time'=>time()],"id={$alipaygm_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: ID->' . $alipaygm_id . ' 异步通知成功');
        //-----------------------------
    }
    
    /**%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9AMardan%20QQ:846865108%20%E4%BA%92%E7%AB%99%E5%BA%97%E9%93%BA%20%EF%BC%9Ahttps://www.huzhan.com/ishop8502/%20%20%20%E7%81%AB%E5%B1%B1%E7%BD%91%E7%BB%9C%E7%A7%91%E6%8A%80*/
   
    
}
