<?php
namespace xh\unity;
//字典
class dictionary{
    
  
    
    //用户模块字典
    static public function userModule($module,$open,$cost,$quantity,$gateway=null){
        if ($module == 'wechat_auto') return '[ <span style="color:green;">微信公开版</span> ] [ ' . ($open == 1 ? '<span style="color:green;">已授权</span>' : '<span style="color:red;">未授权</span>') .' ] [ 费率:<b style="color:#f48fb1;">' . $cost*100 . '%</b> ] [ 通道:<b style="color:#26c6da;">' . ($quantity==0 ? '无限制' : $quantity) . '</b> ]';                                                      
        if ($module == 'alipay_auto') return '[ <span style="color:green;">支付宝公开版</span> ] [ ' . ($open== 1 ? '<span style="color:green;">已授权</span>' : '<span style="color:red;">未授权</span>') .' ] [ 费率:<b style="color:#f48fb1;">' . $cost*100 . '%</b>] [ 通道:<b style="color:#26c6da;">' . ($quantity==0 ? '无限制' : $quantity) . '</b> ]';   
        if ($module == 'service_auto') return '[ <span style="color:green;">服务版</span> ] [ ' . ($open == 1 ? '<span style="color:green;">已授权</span>' : '<span style="color:red;">未授权</span>') .' ] [ 费率:<b style="color:#f48fb1;">' . $cost*100 . '%</b>] [ 通道:<b style="color:#26c6da;">' . count($gateway) . '</b> ]';   
        if ($module == 'withdraw') return '[ <span style="color:green;">盈利提现</span> ] [ ' . ($open == 1 ? '<span style="color:green;">可提现</span>' : '<span style="color:red;">不可提现</span>') .' ] [ 提现手续费:<b style="color:#f48fb1;">' . $cost*100 . '%</b> ]';
        if ($module == 'shop') return '[ <span style="color:green;">商城购物</span> ] [ ' . ($open == 1 ? '<span style="color:green;">可购物</span>' : '<span style="color:red;">不可购物</span>') .' ] [ 购物折扣:<b style="color:#f48fb1;">' . $cost*100 . '%</b> ]';
        return false;
    }
    
    
}
