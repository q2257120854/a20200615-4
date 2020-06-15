<?php
namespace xh\run\admin\controller;
use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;

class system{
    //构造一个mysql请求
    private $mysql;
    
    //权限验证
    protected function powerLogin($Mid){
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)){
            url::address(url::s('admin/index/home'),'您没有权限访问',3);
        }
        $this->mysql = new mysql();
    }
    
    //网站配置
    //权限ID：14
    public function webCog(){
        $this->powerLogin(14);//权限验证
        new view('system/webCog',[
            'mysql'=>$this->mysql
        ]);
    }
    
    //网站配置-result请求
    //权限ID：14
    public function webCogResult(){
        unset($_SESSION['webCog']);
        $this->powerLogin(14);//权限验证
        $webName = request::filter('post.webName','','htmlspecialchars');//网站名称
        $keywords = request::filter('post.keywords','','htmlspecialchars');//网站关键词
        $description = request::filter('post.description','','htmlspecialchars');//网站描述
        $open = intval(request::filter('post.open')) == 1 ? 1 : 2; //网站状态
        //加入配置
        $webCog = [
            'name'=>$webName,
            'keywords'=>$keywords,
            'description'=>$description,
            'open'=>$open
        ];
        //自动更新配置
        (new model())->load("system", "variable")->update('webCog',$webCog);
        functions::json(200, '网站配置更新成功');
    }
    
    //短信配置
    //权限ID：16
    public function smsCog(){
        $this->powerLogin(16);//权限验证
        new view('system/smsCog',[
            'mysql'=>$this->mysql
        ]);
    }
    
    //短信配置-result请求
    //权限ID：16
    public function smsCogResult(){
        unset($_SESSION['smsCog']);
        $this->powerLogin(16);//权限验证
        $accessKeyId = request::filter('post.accessKeyId','','htmlspecialchars');
        $accessKeySecret = request::filter('post.accessKeySecret','','htmlspecialchars');
        $SignName = request::filter('post.SignName','','htmlspecialchars');
        $TemplateCode = request::filter('post.TemplateCode','','htmlspecialchars');
        $TemplateErrorCode = request::filter("post.TemplateErrorCode",'','htmlspecialchars');
        $TemplateDefend = request::filter("post.TemplateDefend",'','htmlspecialchars');
        $open = intval(request::filter('post.open')) == 1 ? 1 : 2;
        //加入配置
        $smsCog = [
            'accessKeyId'=>$accessKeyId,
            'accessKeySecret'=>$accessKeySecret,
            'SignName'=>$SignName,
            'TemplateCode'=>$TemplateCode,
            'TemplateErrorCode'=>$TemplateErrorCode,
            'TemplateDefend'=>$TemplateDefend,
            'open'=>$open
        ];
        //自动更新配置
        (new model())->load("system", "variable")->update('smsCog',$smsCog);
        functions::json(200, '短信配置更新成功');
    }
    
    
    //通道开关
    //权限ID：18
    public function costCog(){
        $this->powerLogin(18);//权限验证
        new view('system/costCog',[
            'mysql'=>$this->mysql
        ]);
    }
    
    //通道开关-result请求
    //权限ID：18
    public function costCogResult(){
        unset($_SESSION['costCog']);
        $this->powerLogin(18);//权限验证
        //wechat
        
        $wechat_auto_open = request::filter('post.wechat_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
       $wechatdy_auto_open = request::filter('post.wechatdy_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
        $taobaodf_auto_open = request::filter('post.taobaodf_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
        //--
       
        $alipay_auto_open = request::filter('post.alipay_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
       $alipaygm_auto_open = request::filter('post.alipaygm_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      
        $alipayhongbao_auto_open = request::filter('post.alipayhongbao_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
        $dingding_auto_open = request::filter('post.dingding_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      
       $nxyswx_auto_open = request::filter('post.nxyswx_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
       $nxysalipay_auto_open = request::filter('post.nxysalipay_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
       $nxysyl_auto_open = request::filter('post.nxysyl_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
       $shouqianba_auto_open = request::filter('post.shouqianba_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      
      $pddgm_auto_open = request::filter('post.pddgm_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      $wechatbank_auto_open = request::filter('post.wechatbank_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      $wechatsj_auto_open = request::filter('post.wechatsj_auto_open','','htmlspecialchars') == 1 ? 1 : 2;

        //--
 
        $tenpay_auto_open = request::filter('post.tenpay_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
        //--

        $jdpay_auto_open = request::filter('post.jdpay_auto_open','','htmlspecialchars') == 1 ? 1 : 2;

        $bank_auto_open = request::filter('post.bank_auto_open','','htmlspecialchars') == 1 ? 1 : 2;
      
        $yunshanfu_auto_open = request::filter('post.yunshanfu_auto_open','','htmlspecialchars') == 1 ? 1 : 2;+
          
        $lakala_auto_open = request::filter('post.lakala_auto_open','','htmlspecialchars') == 1 ? 1 : 2;

        //--
        $service_auto = request::filter('post.service_auto','','htmlspecialchars') == 1 ? 1 : 2;
        
        //--
        $withdraw = request::filter('post.withdraw','','htmlspecialchars') == 1 ? 1 : 2;
        
        //--
        $shop = request::filter('post.shop','','htmlspecialchars') == 1 ? 1 : 2;
       

        //加入配置
        $costCog = [
            'wechat_auto'=>[
                'open'=>$wechat_auto_open
            ],
            'alipay_auto'=>[
                'open'=>$alipay_auto_open
            ],
          'alipaygm_auto'=>[
                'open'=>$alipaygm_auto_open
            ],
           'alipayhongbao_auto'=>[
                'open'=>$alipayhongbao_auto_open
            ],
            'bank_auto'=>[
                'open'=>$bank_auto_open
            ],
           'lakala_auto'=>[
                'open'=>$lakala_auto_open
            ],
          'nxyswx_auto'=>[
                'open'=>$nxyswx_auto_open
            ],
           'nxysalipay_auto'=>[
                'open'=>$nxysalipay_auto_open
            ],
           'nxysyl_auto'=>[
                'open'=>$nxysyl_auto_open
            ],
           'yunshanfu_auto'=>[
                'open'=>$yunshanfu_auto_open
            ],
           'shouqianba_auto'=>[
                'open'=>$shouqianba_auto_open
            ],
          'pddgm_auto'=>[
                'open'=>$pddgm_auto_open
            ],
           'wechatsj_auto'=>[
                'open'=>$wechatsj_auto_open
            ],
          'wechatdy_auto'=>[
                'open'=>$wechatdy_auto_open
            ],
           'wechatbank_auto'=>[
                'open'=>$wechatbank_auto_open
            ],
            'taobaodf_auto'=>[
                'open'=>$taobaodf_auto_open
            ],
            'service_auto'=>[
                'open'=>$service_auto
            ],
            'withdraw'=>[
                'open'=>$withdraw
            ],
            'shop'=>[
                'open'=>$shop
            ]
        ];
        
        //自动更新配置
        (new model())->load("system", "variable")->update('costCog',$costCog);
        functions::json(200, '汇率配置更新成功');
        
        
    }
    

}