<?php
namespace xh\run\index\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\functions;
use xh\library\request;
use xh\library\view;
use xh\unity\page;
use xh\library\url;
use xh\unity\encrypt;
use xh\unity\in;


class shop{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        (new model())->load('user', 'group')->review('shop');
        $this->mysql = new mysql();
    }
    
    //商品首页
    public function index(){
        $where = 'status=1';
        //查询正在销售的商品
        $result = page::conduct('shop',request::filter('get.page'),15,$where,null,'sort','desc');
        new view("shop/index",[
            'result'=>$result
        ]);
    }
    
    //购买商品
    public function buy(){
        $id = intval(request::filter('get.id'));
        $result = $this->mysql->query("shop","id={$id}")[0];
        if (!is_array($result)) exit('<b style="color:red;">商品不存在</b>');
        new view('shop/buy',[
            'result'=>$result,
            'mysql'=>$this->mysql
        ]);
    }
    
    //订单记录
    public function order(){
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');
        
        if ($sorting == 'status'){
            if (in_array($code, [0,1,2,3,4,5,6,7])){
                $where .= "status={$code} and ";
            }
        }
      
        $where = trim(trim($where),"and");
        $result = page::conduct('shop_order',request::filter('get.page'),15,$where,null,'id','desc');
        
        new view('shop/order',[
            'result'=>$result,
            'mysql'=>$this->mysql,
            'sorting'=>[
                'code'=>$code,
                'name'=>$sorting
            ],
            'where' => $where
        ]);
    }
    
    
    //关闭交易
    public function closeBuy(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        //检测交易是否不为未支付
        if ($findOrder['status'] != 0) functions::json(-2, '当前交易状态不可更改');
        $rc = $this->mysql->update("shop_order", ['status'=>7],"id={$id}");
        if ($rc > 0) functions::json(200, '当前订单关闭成功');
        functions::json(-5, '当前订单关闭失败');
    }
    
    //立即支付
    public function orderBuy(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        //检测交易是否不为未支付
        if ($findOrder['status'] != 0) functions::json(-2, '当前交易状态不可支付');
        //支付
        new view('shop/payResult',[
            'serial_no'=>$findOrder['serial_no'],
            'amount'=>$findOrder['amount'],
            'pay_type'=>$findOrder['pay_method']
        ]);
    }
    
    //申请退款
    public function applyRefund(){
        $id = in::get("id");//ID
        //退款原因
        $reason = trim(request::filter("post.reason",'','htmlspecialchars'));
        if (mb_strlen($reason) < 10) functions::json(-3, '退款理由不能低于10个字,请详细的叙述退款理由!');
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        //检测交易是否不为未支付
        if (!in_array($findOrder['status'], [1,2])) functions::json(-2, '当前交易状态无法申请退款');
 /*        //商品获取查询
        $shopInfo = $this->mysql->query("shop","id={$findOrder['shop_id']}")[0];
        //检测订单是否支持退款
        if (!is_array($shopInfo)) functions::json(-6, '当前商品无法在线申请退款,请联系客服申请退款!'); */
        
        //计算商品单价 由于总价是乘法，所以这里直接除法可以得到单价
        $price = $findOrder['amount'] / $findOrder['quantity'];
       
        //计算需退款的数量
        $refundNum = intval(request::filter("post.refundNum"));
        
        if ($refundNum < 0){
            $refundNum = 1;
        }
        if ($refundNum > $findOrder['quantity']){
            $refundNum = $findOrder['quantity'];
        }
        //申请退款
        $rc = $this->mysql->update("shop_order", [
            'status'=>4,
            'refund_amount'=>$refundNum*$price,
            'refund_quantity'=>$refundNum,
            'refund_feedback'=>json_encode([
                'reason'=>$reason,
                'time'=>time()
            ]),
            'refund_schedule'=>json_encode([
                ['time'=>time(),'info'=>'已经提交申请退款,等待平台审核']
            ])
        ],"id={$id}");
        
        if ($rc > 0) functions::json(200, '申请退款提交成功,请耐心等待审核');
        
        functions::json(-2, '申请退款提交失败,请联系客服!');
    }
    
    
    //取消申请退款
    public function cancelRefund(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        if ($findOrder['status'] != 4) functions::json(-2, '当前交易状态无法取消退款');
        //取消退款
        $refund_schedule = json_decode($findOrder['refund_schedule'],true);
        $refund_schedule[] = ['time'=>time(),'info'=>'会员已经取消退款'];
        
        $rc = $this->mysql->update("shop_order", [
            'status'=>2,
            'refund_feedback'=>json_encode([
                'reason'=>"用户取消退款",
                'time'=>time()
            ]),
            'refund_schedule'=>json_encode($refund_schedule)
        ],"id={$id}");
        
        if ($rc > 0) functions::json(200, '已经取消退款申请!');
        
        functions::json(-2, '取消退款失败,请联系客服!');
    }
    
    //确认收货
    public function receipt(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        if ($findOrder['status'] != 2) functions::json(-2, '当前交易状态无法收货');

        $rc = $this->mysql->update("shop_order", [
            'status'=>3
        ],"id={$id}");
        
        if ($rc > 0) functions::json(200, '您已经收货成功!');
        
        functions::json(-2, '收货失败,请联系客服!');
    }
    
    //查询物流或卡密
    public function logistics(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) exit('<b style="color:red;">当前交易订单不存在</b>');
        if (!in_array($findOrder['status'], [2,3])) exit('<b style="color:red;">当前交易订单状态不可查询</b>');
        //查询商品信息
        $shopInfo = $this->mysql->query("shop","id={$findOrder['shop_id']}")[0];
        new view('shop/logistics',[
            'result'=>$findOrder,
            'shop'=>$shopInfo
        ]);
    }
    
    //获得物流id
    public function express(){
        $id = in::get("id");//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) exit('<b style="color:red;">当前交易订单不存在</b>');
        if (!in_array($findOrder['status'], [2,3])) exit('<b style="color:red;">当前交易订单状态不可查询</b>');
        if (intval($findOrder['ship']) < 200) functions::json(-4, '当前订单暂未发货,请耐心等待..');
        $url_id = file_get_contents("http://www.kuaidi100.com/applyurl?key=5b42d3c815d963ec&com={$findOrder['express']}&nu={$findOrder['ship']}");
        return functions::json(200, '查询成功',['url_id'=>$url_id]);
    }
    
    //发起创建订单
    public function pay(){
        $id = intval(request::filter('post.id'));
        $num = intval(request::filter("post.num"));
        //收货人姓名
        $full_name = trim(request::filter("post.full_name",'','htmlspecialchars'));
        //手机号
        $phone = trim(request::filter("post.phone",'','htmlspecialchars'));
        //收货人地址
        $address = trim(request::filter("post.address",'','htmlspecialchars'));
        //支付方式
        $pay_type = intval(request::filter('post.pay_type'));
        
        $result = $this->mysql->query("shop","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('index/shop/index'), '该商品不存在', 3);
        if (!in_array($pay_type, [1,2,3,4]))  url::address(url::s('index/shop/index'), '支付方式有误，请重新购买', 3);
        //为了购物安全，直接拉数据库的member信息
        $findMember = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($findMember)) url::address(url::s('index/shop/index'), '当前购物环境异常，请重启电脑再试', 3);
        //创建本次流水交易号
        $serial_no = date("YmdHis") . mt_rand(1000,9999);
        //用户组折扣
        $groupc = json_decode($_SESSION['MEMBER']['group']['authority'],true)['shop'];
        //支付时间
        $pay_time = 0;
        //支付状态初始化
        $status = 0;
        
        //购买用户组
        if ($result['category'] == 1){
            //折扣金额
            $discount_money = $result['money'] * $groupc['cost'];
            //支付金额
            $amount = $result['money'] - $discount_money;
            //用户组购买
            //检测当前用户组是否和购买的一样
            if ($_SESSION['MEMBER']['group']['id'] == $result['bind_special']) url::address(url::s('index/shop/index'), '您已经是当前用户组了，无需重新购买', 3);
            //检测是否已经有该用户组的订单在列表了
            $findShopOrderGroup = $this->mysql->query("shop_order","shop_id={$result['id']} and status=0")[0];
            if (is_array($findShopOrderGroup)) url::address(url::s('index/shop/order'), '您已经有一个该用户组未支付的订单记录了', 3);
            //检测支付方式
            if ($pay_type == 3) {
                //余额购买
                $Balance = $findMember['balance'] - $amount;
                if ($Balance < 0) url::address(url::s('index/shop/index'), '余额不足', 1);
                //直接扣掉用户金额，并且更改用户组
                $buyMember = $this->mysql->update("client_user", ['balance'=>$Balance,'group_id'=>$result['bind_special']],"id={$findMember['id']}");
                if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                $status = 3;
                $pay_time = time();
                
            }
            if ($pay_type == 4){
                //盈利余额购买
                $money = $findMember['money'] - $amount;
                if ($money < 0) url::address(url::s('index/shop/index'), '盈利余额不足', 1);
                $buyMember = $this->mysql->update("client_user", ['money'=>$money,'group_id'=>$result['bind_special']],"id={$findMember['id']}");
                if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                $status = 3;
                $pay_time = time();
            }
            
            if ($pay_type == 1){
                //微信购买
                if ($amount > 15000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
            }
            
            if ($pay_type == 2){
                //支付宝购买
                if ($amount > 50000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
            }
            
            $rc = $this->mysql->insert("shop_order", [
                'shop_id'=>$result['id'],
                'amount'=>$amount,
                'discount'=>$discount_money,
                'quantity'=>1,
                'status'=>$status,
                'serial_no'=>$serial_no,
                'user_id'=>$findMember['id'],
                'address'=>0,
                'ship'=>0,
                'refund_amount'=>0,
                'refund_quantity'=>0,
                'refund_feedback'=>0,
                'refund_schedule'=>0,
                'pay_method'=>$pay_type,
                'add_time'=>time(),
                'pay_time'=>$pay_time
            ]);
            
            if ($status == 3){
                url::address(url::s('index/shop/order'), '购买成功!', 3);
            }

         }
         
         //检测购买数量，进行批量优惠
         $discount = json_decode($result['discount'],true);
         foreach ($discount as $dc){
             if ($num >= $dc['num']){
                 //更改价格
                 $result['money'] = floatval($dc['money']);
             }
         }

         //购买卡密
         if ($result['category'] == 2){
             //支付金额
             $amount = $result['money'] * $num;
             //折扣金额
             $discount_money = $amount * $groupc['cost'];
             $amount = $amount-$discount_money;
             //初始化卡密信息
             $cardInfo = '';
             //检测是否已经购买超出限制
             $findMemberOrderBuyNum = $this->mysql->select("select count(id) as count from " . DB_PREFIX ."shop_order where shop_id={$result['id']} and (status=1 or status=2 or status=3)")[0]['count'];
             if ($result['restriction'] != 0 && ($findMemberOrderBuyNum+$num) > $result['restriction']) url::address(url::s('index/shop/index'), '您购买的数量已经超过限制!', 3);
             
             //检测购买是否超出库存
             $stock = $this->mysql->select("select count(id) as count from ".DB_PREFIX."shop_card where shop_id={$result['id']} and status=0")[0]['count'];
             if ($num > $stock) url::address(url::s('index/shop/index'), '卡密库存不足以您本次购买', 3);
  
             //检测支付方式
             if ($pay_type == 3) {
                 //余额购买
                 $Balance = $findMember['balance'] - $amount;
                 if ($Balance < 0) url::address(url::s('index/shop/index'), '余额不足', 1);
                 //直接扣掉用户金额，并且更改用户组
                 $buyMember = $this->mysql->update("client_user", ['balance'=>$Balance],"id={$findMember['id']}");
                 if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                 $status = 2;
                 //抽出库存
                 $card_Find = $this->mysql->query("shop_card","shop_id={$result['id']} and status=0");
                 for ($i=0;$i<$num;$i++){
                     //取出卡密
                     $cardInfo[] = [
                         'card'=>$card_Find[$i]['card_no'],
                         'pwd'=>$card_Find[$i]['card_pwd']
                     ];
                     $this->mysql->update("shop_card", ['status'=>1,'sell_time'=>time(),'user_id'=>$findMember['id']],"id={$card_Find[$i]['id']}");
                 }
                 
                 $cardInfo = json_encode($cardInfo);
                 $pay_time = time();
             }
             if ($pay_type == 4){
                 //盈利余额购买
                 $money = $findMember['money'] - $amount;
                 if ($money < 0) url::address(url::s('index/shop/index'), '盈利余额不足', 1);
                 $buyMember = $this->mysql->update("client_user", ['money'=>$money],"id={$findMember['id']}");
                 if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                 $status = 2;
                 //抽出库存
                 $card_Find = $this->mysql->query("shop_card","shop_id={$result['id']} and status=0");
                 for ($i=0;$i<$num;$i++){
                     //取出卡密
                     $cardInfo[] = [
                         'card'=>$card_Find[$i]['card_no'],
                         'pwd'=>$card_Find[$i]['card_pwd']
                     ];
                     $this->mysql->update("shop_card", ['status'=>1,'sell_time'=>time(),'user_id'=>$findMember['id']],"id={$card_Find[$i]['id']}");
                 }
                 
                 $cardInfo = json_encode($cardInfo);
                 $pay_time = time();
             }
             
             if ($pay_type == 1){
                 //微信购买
                 if ($amount > 15000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
             }
             
             if ($pay_type == 2){
                 //支付宝购买
                 if ($amount > 50000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
             }
             
             $rc = $this->mysql->insert("shop_order", [
                 'shop_id'=>$result['id'],
                 'amount'=>$amount,
                 'discount'=>$discount_money,
                 'quantity'=>$num,
                 'status'=>$status,
                 'serial_no'=>$serial_no,
                 'user_id'=>$findMember['id'],
                 'address'=>0,
                 'ship'=>$cardInfo,
                 'refund_amount'=>0,
                 'refund_quantity'=>0,
                 'refund_feedback'=>0,
                 'refund_schedule'=>0,
                 'pay_method'=>$pay_type,
                 'add_time'=>time(),
                 'pay_time'=>$pay_time
             ]);
             
             if ($status == 2){
                 url::address(url::s('index/shop/order','id='.$rc), '购买成功!', 3);
             }
             
             
         }
         
         //购买货物
         if ($result['category'] == 3){
             //支付金额
             $amount = $result['money'] * $num;
             //折扣金额
             $discount_money = $amount * $groupc['cost'];
             $amount = $amount-$discount_money;
             //支付状态初始化
             $status = 0;
             //检测是否已经购买超出限制
             $findMemberOrderBuyNum = $this->mysql->select("select count(id) as count from " . DB_PREFIX ."shop_order where shop_id={$result['id']} and (status=1 or status=2 or status=3)")[0]['count'];
             if ($result['restriction'] != 0 && ($findMemberOrderBuyNum+$num) > $result['restriction']) url::address(url::s('index/shop/index'), '您购买的数量已经超过限制!', 3);
             //检测购买是否超出库存
             if ($num > $result['warehouse']) url::address(url::s('index/shop/index'), '当前商品库存不足以您本次购买', 3);
             //检测收货人姓名是否填写
             if (strlen($full_name) < 1) url::address(url::s('index/shop/index'), '收货人姓名填写不正确', 3);
             if (!functions::isMobile($phone)) url::address(url::s('index/shop/index'), '收货人手机号填写不正确', 3);
             if (mb_strlen($address,"utf-8") < 10) url::address(url::s('index/shop/index'), '收货地址不够详细', 3);
             //将收货地址永久写入cookies
             setcookie("FULL_INFO",json_encode(['full_name'=>$full_name,'phone'=>$phone,'address'=>$address]),time()+31104000,'/');
             //检测支付方式
             if ($pay_type == 3) {
                 //余额购买
                 $Balance = $findMember['balance'] - $amount;
                 if ($Balance < 0) url::address(url::s('index/shop/index'), '余额不足', 1);
                 //直接扣掉用户金额，并且更改用户组
                 $buyMember = $this->mysql->update("client_user", ['balance'=>$Balance],"id={$findMember['id']}");
                 if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                 $status = 1;
                 $ship = json_encode([
                     ['time'=>time(),'info'=>'订单等待支付'],
                     ['time'=>time(),'info'=>'已支付成功,等待平台发货']
                 ]);
                 $pay_time = time();
             }
             
             if ($pay_type == 4){
                 //盈利余额购买
                 $money = $findMember['money'] - $amount;
                 if ($money < 0) url::address(url::s('index/shop/index'), '盈利余额不足', 1);
                 $buyMember = $this->mysql->update("client_user", ['money'=>$money],"id={$findMember['id']}");
                 if ($buyMember == 0) url::address(url::s('index/shop/index'), '购买失败,请稍后再试', 3);
                 $status = 1;
                 $ship = json_encode([
                     ['time'=>time(),'info'=>'订单等待支付'],
                     ['time'=>time(),'info'=>'已支付成功,等待平台发货']
                 ]);
                 $pay_time = time();
             }
             
             if ($pay_type == 1){
                 //微信购买
                 if ($amount > 15000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
                 $ship = json_encode([
                     ['time'=>time(),'info'=>'订单等待支付']
                 ]);
             }
             
             if ($pay_type == 2){
                 //支付宝购买
                 if ($amount > 50000) url::address(url::s('index/shop/index'), '当前支付方式不支持本次支付交易，请使用余额购买', 5);
                 $ship = json_encode([
                     ['time'=>time(),'info'=>'订单等待支付']
                 ]);
             }
             
             $rc = $this->mysql->insert("shop_order", [
                 'shop_id'=>$result['id'],
                 'amount'=>$amount,
                 'discount'=>$discount_money,
                 'quantity'=>$num,
                 'status'=>$status,
                 'serial_no'=>$serial_no,
                 'user_id'=>$findMember['id'],
                 'address'=>json_encode([
                     'name'=>$full_name,
                     'phone'=>$phone,
                     'address'=>$address
                 ]),
                 'ship'=>$ship,
                 'refund_amount'=>0,
                 'refund_quantity'=>0,
                 'refund_feedback'=>0,
                 'refund_schedule'=>0,
                 'pay_method'=>$pay_type,
                 'add_time'=>time(),
                 'pay_time'=>$pay_time
             ]);
             
             
             if ($status == 1){
                 //减少库存
                 $this->mysql->update("shop", ['warehouse'=>($result['warehouse']-$num)],"id={$result['id']}");
                 url::address(url::s('index/shop/order','id='.$rc), '支付成功', 3);
             }
             
      
         }
         
         new view('shop/payResult',[
             'serial_no'=>$serial_no,
             'amount'=>$amount,
             'pay_type'=>$pay_type
         ]);

    }
}
