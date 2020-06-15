<?php
/**
 * 系统设置
**/
$title='后台管理中心';
include("../includes/common.php");
include './head.php';
include 'nav.php';

?>

  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 
if(isset($_POST['submit'])) {
    foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into zz_pay_config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
    }
    showmsg('修改成功！',1);
    exit();
}

?>
      
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">网站配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">本站URL:</label>
	  <div class="col-sm-10"><input type="text" name="local_domain" value="<?php echo $conf['local_domain']; ?>" class="form-control" required/></div>
	</div><br/>
     
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称:</label>
	  <div class="col-sm-10"><input type="text" name="web_name" value="<?php echo $conf['web_name']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">客服QQ:</label>
	  <div class="col-sm-10"><input type="text" name="web_qq" value="<?php echo $conf['web_qq']; ?>" class="form-control"/></div>
	</div><br/>
        
        <h3>结算转账信息设置</h3>
        <hr>
        
	<div class="form-group">
	  <label class="col-sm-2 control-label">微信企业付款:</label>
	  <div class="col-sm-10">
              <input type="text" name="wxtransfer_desc" value="<?php echo $conf['wxtransfer_desc']; ?>" class="form-control"/>
              <small>* 付款说明</small> 
          </div>
   
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">付款方显示姓名:</label>
	  <div class="col-sm-10">
              <input type="text" name="payer_show_name" value="<?php echo $conf['payer_show_name']; ?>" class="form-control"/>
          <small>* 单笔转账到支付宝接口</small> 
          </div>
	</div><br/>
        
        <div class="form-group">
	  <label class="col-sm-2 control-label">支付宝应用APPID:</label>
	  <div class="col-sm-10">
              <input type="text" name="alipay_appid" value="<?php echo $conf['alipay_appid']; ?>" class="form-control"/>
       
          </div>
	</div><br/>
        
       <h3>支付及结算费率设置</h3>
        <hr>
         <div class="form-group">
	  <label class="col-sm-2 control-label">分成比例:</label>
	  <div class="col-sm-10">
              <input type="number" name="money_rate" value="<?php echo $conf['money_rate']; ?>" class="form-control"/>
         <small>* 默认支付分成比例（百分数） 例如：97 = 收取3%的费率</small> 
          </div>
	</div><br/>
      <div class="form-group">
	  <label class="col-sm-2 control-label">自动结算:</label>
	  <div class="col-sm-10">
              <input type="number" name="settle_money" value="<?php echo $conf['settle_money']; ?>" class="form-control"/>
         <small>* 每天满多少元自动结算</small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">结算费率:</label>
	  <div class="col-sm-10">
              <input type="text" name="settle_rate" value="<?php echo $conf['settle_rate']; ?>" class="form-control"/>
 <small>* 1 = 1%(100:1) </small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">手续费最小:</label>
	  <div class="col-sm-10">
              <input type="text" name="settle_fee_min" value="<?php echo $conf['settle_fee_min']; ?>" class="form-control"/>
  <small>* 结算手续费最小</small> 
          </div>
	</div><br/>
         <div class="form-group">
	  <label class="col-sm-2 control-label">手续费最大:</label>
	  <div class="col-sm-10">
              <input type="text" name="settle_fee_max" value="<?php echo $conf['settle_fee_max']; ?>" class="form-control"/>
  <small>* 结算手续费最大</small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">开启申请结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="settle_open">
                  <option value="1" <?=$conf['settle_open']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['settle_open']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开启用户中心手动申请结算</small> 
          </div>
	</div><br/>
        
        <h3>申请商户配置</h3>
        <hr>
        <div class="form-group">
	  <label class="col-sm-2 control-label">快捷登录设置:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="quicklogin">
                  <option value="1" <?=$conf['quicklogin']==1?"selected":""?> >支付宝快捷登陆</option>
                   <option value="2" <?=$conf['quicklogin']==2?"selected":""?> >QQ快捷登陆</option>
              </select>
  <small>* 开启前先进行相关配置</small> 
          </div>
	</div><br/>
        
          <div class="form-group">
	  <label class="col-sm-2 control-label">自助申请:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="is_reg">
                  <option value="1" <?=$conf['is_reg']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['is_reg']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开放自助申请商户</small> 
          </div>
	</div><br/>
        
           <div class="form-group">
	  <label class="col-sm-2 control-label">是否付费:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="is_payreg">
                  <option value="1" <?=$conf['is_payreg']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['is_payreg']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 自助申请商户是否付费</small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">申请验证方式:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="verifytype">
                  <option value="1" <?=$conf['verifytype']==1?"selected":""?> >手机验证</option>
                   <option value="0" <?=$conf['verifytype']==0?"selected":""?> >邮箱验证</option>
              </select>
  <small>* 自助申请商户时接收验证码的方式</small> 
          </div>
	</div><br/>
        
           <div class="form-group">
	  <label class="col-sm-2 control-label">支付宝结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="stype_1">
                  <option value="1" <?=$conf['stype_1']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['stype_1']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开启支付宝结算</small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">微信结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="stype_2">
                  <option value="1" <?=$conf['stype_2']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['stype_2']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开启微信结算</small> 
          </div>
	</div><br/>
        
        <div class="form-group">
	  <label class="col-sm-2 control-label">QQ钱包结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="stype_3">
                  <option value="1" <?=$conf['stype_3']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['stype_3']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开启QQ钱包结算</small> 
          </div>
	</div><br/>
        
         <div class="form-group">
	  <label class="col-sm-2 control-label">银行卡结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="stype_4">
                  <option value="1" <?=$conf['stype_4']==1?"selected":""?> >开启</option>
                   <option value="0" <?=$conf['stype_4']==0?"selected":""?> >关闭</option>
              </select>
  <small>* 是否开启银行卡结算</small> 
          </div>
	</div><br/>
        
           <div class="form-group">
	  <label class="col-sm-2 control-label">收款商户ID:</label>
	  <div class="col-sm-10">
              <input type="text" name="reg_pid" value="<?php echo $conf['reg_pid']; ?>" class="form-control"/>
  <small>* 付费申请收款商户ID</small> 
          </div>
	</div><br/>
           <div class="form-group">
	  <label class="col-sm-2 control-label">商户申请价格:</label>
	  <div class="col-sm-10">
              <input type="text" name="reg_price" value="<?php echo $conf['reg_price']; ?>" class="form-control"/>
  <small>* 商户申请价格</small> 
          </div>
	</div><br/>
        
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div>

    </div>
  </div>
