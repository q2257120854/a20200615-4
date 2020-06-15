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
        <li class="active">短信配置</li>
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
          注册开关
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
               <!--<div class="form-group">
                  <label class="col-sm-2 control-label form-label">accessKeyId（用户ID）</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="accessKeyId" placeholder="阿里大鱼申请的accessKeyId" value="<?php echo cog::read('smsCog')['accessKeyId'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">accessKeySecret（用户密钥）</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="accessKeySecret" placeholder="阿里大鱼申请的accessKeySecret" value="<?php echo cog::read('smsCog')['accessKeySecret'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">SignName（签名名称）</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="SignName" placeholder="阿里大鱼申请的SignName" value="<?php echo cog::read('smsCog')['SignName'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">验证码模板CODE</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="TemplateCode" placeholder="阿里大鱼申请的TemplateCode，验证码" value="<?php echo cog::read('smsCog')['TemplateCode'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">异常通知模板CODE</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="TemplateErrorCode" placeholder="阿里大鱼申请的TemplateCode，短信异常" value="<?php echo cog::read('smsCog')['TemplateErrorCode'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">系统更新模板CODE</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="TemplateDefend" placeholder="阿里大鱼申请的TemplateCode，平台例行更新等通知" value="<?php echo cog::read('smsCog')['TemplateDefend'];?>">
                  </div>
                </div>

                -->
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">注册功能</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="open" value="1" <?php if (cog::read('smsCog')['open'] == 1) echo 'checked';?>>
                        <label for="inlineRadio1"> 开启 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="open" value="2" <?php if (cog::read('smsCog')['open'] == 2) echo 'checked';?>>
                        <label for="inlineRadio2"> 关闭 </label>
                    </div>
                  </div>
                </div>
                
 
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
			          url: "<?php echo url::s('admin/system/smsCogResult');?>",
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