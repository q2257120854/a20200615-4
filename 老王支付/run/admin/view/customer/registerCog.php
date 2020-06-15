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
        <li class="active">注册设置</li>
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
          注册设置
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">注册送积分</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control form-control-line" name="integral" placeholder="注册后送积分" value="<?php echo cog::read('registerCog')['integral'];?>">
                  </div>
                </div>
                
<!--                <div class="form-group">-->
<!--                  <label class="col-sm-2 control-label form-label">分销盈利比</label>-->
<!--                  <div class="col-sm-2">-->
<!--                    <input type="text" class="form-control form-control-line" name="scale" placeholder="分销盈利百分比" value="--><?php //echo cog::read('registerCog')['scale'];?><!--">-->
<!--                  </div>-->
<!--                </div>-->
                
                <div class="form-group">
                 <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="scale_open" value="1" <?php if (cog::read('registerCog')['scale_open'] == 1) echo 'checked';?>>
                        <label for="inlineRadio1"> 开启 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="scale_open" value="2" <?php if (cog::read('registerCog')['scale_open'] == 2) echo 'checked';?>>
                        <label for="inlineRadio2"> 关闭 </label>
                    </div>
                  </div>
                </div>
                
<!--                <div class="form-group">-->
<!--                  <label class="col-sm-2 control-label form-label">三级分销比</label>-->
<!--                  <div class="col-sm-2">-->
<!--                    <input type="text" class="form-control form-control-line" name="points" placeholder="三级分销比" value="--><?php //echo cog::read('registerCog')['points'];?><!--">-->
<!--                  </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                <label class="col-sm-2 control-label form-label"></label>-->
<!--                <div class="col-sm-8" style="margin-top: 7px;">-->
<!--                    <div class="checkbox checkbox-success checkbox-inline">-->
<!--                        <input type="checkbox" id="points_open" name="points_open" value="1" --><?php //if (cog::read('registerCog')['points_open'] == 1) echo 'checked';?><!-->
<!--                        <label for="points_open"> 开启三级分销</label>-->
<!--                    </div>-->
<!--                  </div>-->
<!--				</div>-->
				
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">注册默认用户组</label>
                  <div class="col-sm-5">
                    <select class="selectpicker" name="group_id">
                    <?php foreach ($group as $gp){?>
                        <option value="<?php echo $gp['id'];?>" <?php if ($gp['id'] == cog::read('registerCog')['group_id']) echo 'selected';?>><?php echo $gp['name'];?></option>
                    <?php }?>
                      </select>  
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
			          url: "<?php echo url::s('admin/customer/registerCogResult');?>",
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