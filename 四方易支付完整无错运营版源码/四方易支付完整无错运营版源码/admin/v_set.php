<?php
/**
 * 系统设置
**/
$title='后台管理中心';
include("../includes/common.php");
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
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
	
        
        <h3>发信邮箱配置</h3>
        <hr>
           <div class="form-group">
	  <label class="col-sm-2 control-label">开启申请结算:</label>
	  <div class="col-sm-10">
              <select  class="form-control" name="mail_cloud">
                  <option value="1" <?=$conf['mail_cloud']==1?"selected":""?> >sendcloud</option>
                   <option value="0" <?=$conf['mail_cloud']==0?"selected":""?> >SMTP发信</option>
              </select>
          </div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP地址:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_smtp" value="<?php echo $conf['mail_smtp']; ?>" class="form-control"/>
          
          </div>
   
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">SMTP端口:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_port" value="<?php echo $conf['mail_port']; ?>" class="form-control"/>
    
          </div>
	</div><br/>
        
        <div class="form-group">
	  <label class="col-sm-2 control-label">邮箱账号:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_name" value="<?php echo $conf['mail_name']; ?>" class="form-control"/>
       
          </div>
	</div><br/>
          <div class="form-group">
	  <label class="col-sm-2 control-label">邮箱密码:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_pwd" value="<?php echo $conf['mail_pwd']; ?>" class="form-control"/>
              <small>*（授权码）</small>
          </div>
	</div><br/>
          <div class="form-group">
	  <label class="col-sm-2 control-label">sendcloud API_USER:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_apiuser" value="<?php echo $conf['mail_apiuser']; ?>" class="form-control"/>
       
          </div>
	</div><br/>
             <div class="form-group">
	  <label class="col-sm-2 control-label">sendcloud API_KEY:</label>
	  <div class="col-sm-10">
              <input type="text" name="mail_apikey" value="<?php echo $conf['mail_apikey']; ?>" class="form-control"/>
       
          </div>
	</div><br/>
           <div class="form-group">
	  <label class="col-sm-2 control-label">短信验证码:</label>
	  <div class="col-sm-10">
              <input type="text" name="sms_appkey" value="<?php echo $conf['sms_appkey']; ?>" class="form-control"/>
              <small>* admin.978w.cn【我的接口】页面查看</small>
          </div>
	</div><br/>
          <div class="form-group">
	  <label class="col-sm-2 control-label">CAPTCHA_ID:</label>
	  <div class="col-sm-10">
              <input type="text" name="CAPTCHA_ID" value="<?php echo $conf['CAPTCHA_ID']; ?>" class="form-control"/>
              <small>* Geetest极限验证码配置</small>
          </div>
	</div><br/>
          <div class="form-group">
	  <label class="col-sm-2 control-label">PRIVATE_KEY:</label>
	  <div class="col-sm-10">
              <input type="text" name="PRIVATE_KEY" value="<?php echo $conf['PRIVATE_KEY']; ?>" class="form-control"/>
              <small>* Geetest极限验证码配置</small>
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