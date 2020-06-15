<?php
use xh\library\url;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">通道开关</li>
      </ol>
      
  </div>
  <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">
  
    <!-- Start Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-title">
         通道开关
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

               <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">微信固码（全自动版）</label>
                  <div class="col-sm-5">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="wechat_auto_open" name="wechat_auto_open" value="1" <?php if (cog::read('costCog')['wechat_auto']['open'] == 1) echo 'checked';?>>
                        <label for="wechat_auto_open"> 启动端口 </label>
                    </div>
                  </div>
                </div>




                  <hr>
                 <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">微信店员模式（全自动版）</label>
                  <div class="col-sm-5">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="wechatdy_auto_open" name="wechatdy_auto_open" value="1" <?php if (cog::read('costCog')['wechatdy_auto']['open'] == 1) echo 'checked';?>>
                        <label for="wechatdy_auto_open"> 启动端口 </label>
                    </div>
                  </div>
                </div>




                  <hr>
                
                  <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">微信商家固码（全自动版）</label>
                  <div class="col-sm-5">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="wechatsj_auto_open" name="wechatsj_auto_open" value="1" <?php if (cog::read('costCog')['wechatsj_auto']['open'] == 1) echo 'checked';?>>
                        <label for="wechatsj_auto_open"> 启动端口 </label>
                    </div>
                  </div>
                </div>




                  <hr>

                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">支付宝转账（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="alipay_auto_open" name="alipay_auto_open" value="1" <?php if (cog::read('costCog')['alipay_auto']['open'] == 1) echo 'checked';?>>
                              <label for="alipay_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>
                
                  <hr>
                
                 <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">支付宝固码（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="alipaygm_auto_open" name="alipaygm_auto_open" value="1" <?php if (cog::read('costCog')['alipaygm_auto']['open'] == 1) echo 'checked';?>>
                              <label for="alipaygm_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>
                
                  <hr>

                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">支付宝转红包（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="alipayhongbao_auto_open" name="alipayhongbao_auto_open" value="1" <?php if (cog::read('costCog')['alipayhongbao_auto']['open'] == 1) echo 'checked';?>>
                              <label for="alipayhongbao_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>
                  <hr>

                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">支付宝转银行卡（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="bank_auto_open" name="bank_auto_open" value="1" <?php if (cog::read('costCog')['bank_auto']['open'] == 1) echo 'checked';?>>
                              <label for="bank_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

             
               
                
                 <hr>
                
                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">微信转银行卡（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="wechatbank_auto_open" name="wechatbank_auto_open" value="1" <?php if (cog::read('costCog')['wechatbank_auto']['open'] == 1) echo 'checked';?>>
                              <label for="wechatbank_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

             
               
                
                 <hr>
                
                 <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">拼多多商家固码（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="pddgm_auto_open" name="pddgm_auto_open" value="1" <?php if (cog::read('costCog')['pddgm_auto']['open'] == 1) echo 'checked';?>>
                              <label for="pddgm_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

             
               
                
                 <hr>
                
                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">云闪付（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="yunshanfu_auto_open" name="yunshanfu_auto_open" value="1" <?php if (cog::read('costCog')['yunshanfu_auto']['open'] == 1) echo 'checked';?>>
                              <label for="yunshanfu_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

             
                <hr>
                
                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">拉卡拉（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="lakala_auto_open" name="lakala_auto_open" value="1" <?php if (cog::read('costCog')['lakala_auto']['open'] == 1) echo 'checked';?>>
                              <label for="lakala_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>
                
                 <hr>
                 
                  
                
                  <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">农信易扫微信（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="nxyswx_auto_open" name="nxyswx_auto_open" value="1" <?php if (cog::read('costCog')['nxyswx_auto']['open'] == 1) echo 'checked';?>>
                              <label for="nxyswx_auto_open"> 启动端口 </label>
                          </div>
                      </div>
                  </div>

                  <hr>
                 <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">农信易扫支付宝（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="nxysalipay_auto_open" name="nxysalipay_auto_open" value="1" <?php if (cog::read('costCog')['nxysalipay_auto']['open'] == 1) echo 'checked';?>>
                              <label for="nxysalipay_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

                  <hr>
                 <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">农信易扫银联（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="nxysyl_auto_open" name="nxysyl_auto_open" value="1" <?php if (cog::read('costCog')['nxysyl_auto']['open'] == 1) echo 'checked';?>>
                              <label for="nxysyl_auto_open"> 启动端口</label>
                          </div>
                      </div>
                  </div>

                   <hr>
                 <div class="form-group has-success">
                      <label class="col-sm-2 control-label form-label">收钱吧（全自动版）</label>
                      <div class="col-sm-9">
                          <div class="checkbox checkbox-success checkbox-inline">
                              <input type="checkbox" id="shouqianba_auto_open" name="shouqianba_auto_open" value="1" <?php if (cog::read('costCog')['shouqianba_auto']['open'] == 1) echo 'checked';?>>
                              <label for="shouqianba_auto_open"> 启动端口 </label>
                          </div>
                      </div>
                  </div>
                
                  <hr>
                
                
                <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">服务版（微信/支付宝 <?php echo SYSTEM_VERSION; ?>）</label>
                  <div class="col-sm-9">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="service_auto_open" name="service_auto" value="1" <?php if (cog::read('costCog')['service_auto']['open'] == 1) echo 'checked';?>>
                        <label for="service_auto_open"> 启动端口</label>
                    </div>
                  </div>
                </div>
                 <hr>
                 
                <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">用户提现（<?php echo SYSTEM_VERSION; ?>）</label>
                  <div class="col-sm-9">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="withdraw_open" name="withdraw" value="1" <?php if (cog::read('costCog')['withdraw']['open'] == 1) echo 'checked';?>>
                        <label for="withdraw_open"> 启动端口 </label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group has-success">
                  <label class="col-sm-2 control-label form-label">商城购物（<?php echo SYSTEM_VERSION; ?>）</label>
                  <div class="col-sm-9">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="shop_open" name="shop" value="1" <?php if (cog::read('costCog')['shop']['open'] == 1) echo 'checked';?>>
                        <label for="shop_open"> 启动商城 </label>
                    </div>
                  </div>
                </div>
                 
 				<hr>
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/index/home');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
  
    <script type="text/javascript">
			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/system/costCogResult');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success");
			              }else{
			            	  swal("操作提示", data.msg, "error");
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}
   </script>
  
</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<?php include_once (PATH_VIEW . 'common/footer.php');?>

</div>
<!-- End Content -->

<?php include_once (PATH_VIEW . 'common/chat.php');?>

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/plugins.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>

</body>
</html>