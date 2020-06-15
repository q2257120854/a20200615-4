<?php 
$title = '后台管理中心';
include "../includes/common.php";
include './head.php';
include 'nav.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-12 col-lg-12 center-block" style="float: none;">
<?php 
if (isset($_POST['submit'])) {
    foreach ($_POST as $k => $value) {
        if ($k == 'pwd') {
            continue;
        }
        $value = daddslashes($value);
        $DB->query("insert into zz_pay_config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
    }
    showmsg('修改成功！', 1);
    exit;
}
?>
        <div class="col-sm-12 col-md-6">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">支付宝接口配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">

           <div class="form-group">
	  <label class="col-sm-3 control-label">对接接口:</label>
	  <div class="col-sm-9">
              <select  class="form-control" name="alipay_api" onchange="api_qh('ali',this.value)">
                  <option value="1" <?php 
echo $conf['alipay_api'] == 1 ? "selected" : "";
?> >支付宝官方</option>
                   <option value="2" <?php 
echo $conf['alipay_api'] == 2 ? "selected" : "";
?> >易支付</option>
                    <option value="3" <?php 
echo $conf['alipay_api'] == 3 ? "selected" : "";
?> >码支付</option>
                     <option value="4" <?php 
echo $conf['alipay_api'] == 4 ? "selected" : "";
?> >关闭维护</option>
              </select>
          </div>
	</div><br/>
        
        <!--对接支付宝官方信息-->
        <div id="ali_gf_info" style="<?php 
echo $conf['alipay_api'] == 1 ? "" : "display: none;";
?>" >
	<div class="form-group">
	  <label class="col-sm-3 control-label">合作身份者id:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_api_partner" value="<?php 
echo $conf['ali_api_partner'];
?>" class="form-control"/>
              <small> * 合作身份者id，以2088开头的16位纯数字</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">收款支付宝账号:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_api_seller_email" value="<?php 
echo $conf['ali_api_seller_email'];
?>" class="form-control"/>
              <small> * 收款支付宝账号</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">安全检验码:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_api_key" value="<?php 
echo $conf['ali_api_key'];
?>" class="form-control"/>
              <small> * 安全检验码，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接支付宝官方信息-->
        
         <!--对接易支付信息-->
		 <!--推荐对接 www.c7e.cn-->
         <div id="ali_epay_info" style="<?php 
echo $conf['alipay_api'] == 2 ? "" : "display: none;";
?>">
	<div class="form-group">
	  <label class="col-sm-3 control-label">易支付地址:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_epay_api_url" value="<?php 
echo $conf['ali_epay_api_url'];
?>" class="form-control"/>
              <small> * 网站的URL地址 例如:https://www.c7e.cn/</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">易支付ID:</label>
	 	 <div class="col-sm-9">
              <input type="text" name="ali_epay_api_id" value="<?php 
echo $conf['ali_epay_api_id'];
?>" class="form-control"/>
              <small> * 易支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">易支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_epay_api_key" value="<?php 
echo $conf['ali_epay_api_key'];
?>" class="form-control"/>
              <small> * 密钥KEY，以数字和字母组成的32位字符</small>
          </div>
		  <a href="https://www.c7e.cn">轻云易支付</a>
	</div><br/>
        </div>   <!-- END 对接易支付信息-->
        
         <!--对接码支付信息-->
         <div id="ali_codepay_info" style="<?php 
echo $conf['alipay_api'] == 3 ? "" : "display: none;";
?>">
	
        <div class="form-group">
	  <label class="col-sm-3 control-label">码支付ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_codepay_api_id" value="<?php 
echo $conf['ali_codepay_api_id'];
?>" class="form-control"/>
              <small> * 码支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">码支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_codepay_api_key" value="<?php 
echo $conf['ali_codepay_api_key'];
?>" class="form-control"/>
              <small> * 码支付通信密钥(KEY)，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接码支付信息-->
        
         <!--关闭通道维护信息-->
         <div id="ali_close_info" style="<?php 
echo $conf['alipay_api'] == 4 ? "" : "display: none;";
?>">
	
      
         <div class="form-group">
	  <label class="col-sm-3 control-label">维护提示:</label>
	  <div class="col-sm-9">
              <input type="text" name="ali_close_info" value="<?php 
echo $conf['ali_close_info'];
?>" class="form-control"/>
              <small> * 维护通知</small>
          </div>
	</div><br/>
        </div>   <!-- END 关闭通道维护信息-->
        
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div></div>
        
         <div class="col-sm-12 col-md-6">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">微信支付接口配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">

           <div class="form-group">
	  <label class="col-sm-3 control-label">对接接口:</label>
	  <div class="col-sm-9">
              <select  class="form-control" name="wxpay_api" onchange="api_qh('wx',this.value)">
                  <option value="1" <?php 
echo $conf['wxpay_api'] == 1 ? "selected" : "";
?> >微信官方</option>
                  <option value="2" <?php 
echo $conf['wxpay_api'] == 2 ? "selected" : "";
?> >易支付</option>
                  <option value="3" <?php 
echo $conf['wxpay_api'] == 3 ? "selected" : "";
?> >码支付</option>
                  <option value="4" <?php 
echo $conf['wxpay_api'] == 4 ? "selected" : "";
?> >关闭维护</option>
              </select>
          </div>
	</div><br/>
        
        <!--对接微信官方信息-->
        <div id="wx_gf_info" style="<?php 
echo $conf['wxpay_api'] == 1 ? "" : "display: none;";
?>" >
	<div class="form-group">
	  <label class="col-sm-3 control-label">APPID:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_api_appid" value="<?php 
echo $conf['wx_api_appid'];
?>" class="form-control"/>
              <small> * 绑定支付的APPID（必须配置，开户邮件中可查看）</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">MCHID:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_api_mchid" value="<?php 
echo $conf['wx_api_mchid'];
?>" class="form-control"/>
              <small> * 商户号（必须配置，开户邮件中可查看）</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">商户支付密钥:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_api_key" value="<?php 
echo $conf['wx_api_key'];
?>" class="form-control"/>
              <small> * 商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置） <br>设置地址：https://pay.weixin.qq.com/index.php/account/api_cert</small>
          </div>
	</div><br/>
     
          <div class="form-group">
	  <label class="col-sm-3 control-label">APPSECRET:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_api_appsecret" value="<?php 
echo $conf['wx_api_appsecret'];
?>" class="form-control"/>
              <small> * 公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）<br>获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN</small>
          </div>
	</div><br/>
        </div>      
        <!-- END 对接支付宝官方信息-->
        
         <!--对接易支付信息-->
         <div id="wx_epay_info" style="<?php 
echo $conf['wxpay_api'] == 2 ? "" : "display: none;";
?>">
	<div class="form-group">
	  <label class="col-sm-3 control-label">易支付地址:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_epay_api_url" value="<?php 
echo $conf['wx_epay_api_url'];
?>" class="form-control"/>
              <small> * 网站的URL地址 例如:http://k.ydtdml.cn/</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">易支付ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_epay_api_id" value="<?php 
echo $conf['wx_epay_api_id'];
?>" class="form-control"/>
              <small> * 易支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">易支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_epay_api_key" value="<?php 
echo $conf['wx_epay_api_key'];
?>" class="form-control"/>
              <small> * 易支付商户密钥(KEY)，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接易支付信息-->
        
         <!--对接码支付信息-->
         <div id="wx_codepay_info" style="<?php 
echo $conf['wxpay_api'] == 3 ? "" : "display: none;";
?>">
	
        <div class="form-group">
	  <label class="col-sm-3 control-label">码支付ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_codepay_api_id" value="<?php 
echo $conf['wx_codepay_api_id'];
?>" class="form-control"/>
              <small> * 码支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">码支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_codepay_api_key" value="<?php 
echo $conf['wx_codepay_api_key'];
?>" class="form-control"/>
              <small> * 码支付通信密钥(KEY)，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接码支付信息-->
        
        <!--关闭通道维护信息-->
         <div id="wx_close_info" style="<?php 
echo $conf['wxpay_api'] == 4 ? "" : "display: none;";
?>">
	
      
         <div class="form-group">
	  <label class="col-sm-3 control-label">维护提示:</label>
	  <div class="col-sm-9">
              <input type="text" name="wx_close_info" value="<?php 
echo $conf['wx_close_info'];
?>" class="form-control"/>
              <small> * 维护通知</small>
          </div>
	</div><br/>
        </div>   <!-- END 关闭通道维护信息-->
        
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div></div>
        
        <div class="col-sm-12 col-md-6">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">QQ支付接口配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">

           <div class="form-group">
	  <label class="col-sm-3 control-label">对接接口:</label>
	  <div class="col-sm-9">
              <select  class="form-control" name="qqpay_api" onchange="api_qh('qq',this.value)">
                  <option value="1" <?php 
echo $conf['qqpay_api'] == 1 ? "selected" : "";
?> >QQ官方</option>
                  <option value="2" <?php 
echo $conf['qqpay_api'] == 2 ? "selected" : "";
?> >易支付</option>
                  <option value="3" <?php 
echo $conf['qqpay_api'] == 3 ? "selected" : "";
?> >码支付</option>
                  <option value="4" <?php 
echo $conf['qqpay_api'] == 4 ? "selected" : "";
?> >关闭维护</option>
              </select>
          </div>
	</div><br/>
        
        <!--对接QQ官方信息-->
        <div id="qq_gf_info" style="<?php 
echo $conf['qqpay_api'] == 1 ? "" : "display: none;";
?>" >
	<div class="form-group">
	  <label class="col-sm-3 control-label">MCH_ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_api_mchid" value="<?php 
echo $conf['qq_api_mchid'];
?>" class="form-control"/>
              <small> * QQ钱包商户号</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">MCH_KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_api_mchkey" value="<?php 
echo $conf['qq_api_mchkey'];
?>" class="form-control"/>
              <small> * QQ钱包商户平台(http://qpay.qq.com/)获取</small>
          </div>
	</div><br/>
        </div>      
        <!-- END 对接QQ官方信息-->
        
         <!--对接易支付信息-->
         <div id="qq_epay_info" style="<?php 
echo $conf['qqpay_api'] == 2 ? "" : "display: none;";
?>">
	<div class="form-group">
	  <label class="col-sm-3 control-label">易支付地址:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_epay_api_url" value="<?php 
echo $conf['qq_epay_api_url'];
?>" class="form-control"/>
              <small> * 网站的URL地址 例如:http://k.ydtdml.cn/</small>
          </div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-3 control-label">易支付ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_epay_api_id" value="<?php 
echo $conf['qq_epay_api_id'];
?>" class="form-control"/>
              <small> * 易支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">易支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_epay_api_key" value="<?php 
echo $conf['qq_epay_api_key'];
?>" class="form-control"/>
              <small> * 易支付商户密钥(KEY)，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接易支付信息-->
        
         <!--对接码支付信息-->
         <div id="qq_codepay_info" style="<?php 
echo $conf['qqpay_api'] == 3 ? "" : "display: none;";
?>">
	
        <div class="form-group">
	  <label class="col-sm-3 control-label">码支付ID:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_codepay_api_id" value="<?php 
echo $conf['qq_codepay_api_id'];
?>" class="form-control"/>
              <small> * 码支付商户ID</small>
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-3 control-label">码支付KEY:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_codepay_api_key" value="<?php 
echo $conf['qq_codepay_api_key'];
?>" class="form-control"/>
              <small> * 码支付通信密钥(KEY)，以数字和字母组成的32位字符</small>
          </div>
	</div><br/>
        </div>   <!-- END 对接码支付信息-->
        
        <!--关闭通道维护信息-->
         <div id="qq_close_info" style="<?php 
echo $conf['qqpay_api'] == 4 ? "" : "display: none;";
?>">
	
      
         <div class="form-group">
	  <label class="col-sm-3 control-label">维护提示:</label>
	  <div class="col-sm-9">
              <input type="text" name="qq_close_info" value="<?php 
echo $conf['qq_close_info'];
?>" class="form-control"/>
              <small> * 维护通知</small>
          </div>
	</div><br/>
        </div>   <!-- END 关闭通道维护信息-->
        
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div></div>

    </div>
  </div>
<script>
function api_qh(type,val){
    var alipay  = $("#"+type+"_gf_info");
    var epay =  $("#"+type+"_epay_info");
    var codepay =  $("#"+type+"_codepay_info");
    var cloes = $("#"+type+"_close_info");
    if(val == 1){
       $(alipay).show()
       $(epay).hide();
       $(codepay).hide();
       $(cloes).hide();
       
    }
    if(val == 2){
       $(alipay).hide()
       $(epay).show();
       $(codepay).hide();
       $(cloes).hide();
    }
    if(val == 3){
       $(alipay).hide()
       $(epay).hide();
       $(codepay).show();
       $(cloes).hide();
    }
      if(val == 4){
       $(alipay).hide()
       $(epay).hide();
       $(codepay).hide();
       $(cloes).show();
    }
}
    
</script>