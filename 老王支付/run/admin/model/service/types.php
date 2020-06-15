<?php
namespace xh\run\admin\model;

class types{
    
    //获取类型
    public function get($type){
        if ($type == 1) return '微信';
        if ($type == 2) return '支付宝';
        if ($type == 3) return '银行卡账户';
      if ($type == 4) return '拉卡拉';
      if ($type == 5) return '云闪付';
      if ($type == 6) return '农信微信支付宝';
      if ($type == 7) return '农信支付宝';
      if ($type == 8) return '农信银联';
       if ($type == 9) return '微信店员';
       if ($type == 10) return '微信商户';
       if ($type == 11) return '微信转卡';
       if ($type == 12) return '拼多多固码';
       if ($type == 13) return '支付宝固码';
    }
    
}