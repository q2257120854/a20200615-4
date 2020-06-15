<?php 
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$authority = json_decode($result['authority'],true);
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/customer/index');?>">管理组</a></li>
        <li class="active">修改</li>
      </ol>
      
  </div>
  <!-- End Page Header -->
<!-- START CONTAINER -->
<div class="container-padding">
  
    <!-- Start Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-title">
          修改用户组
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

            	<div class="form-group">
                  <label class="col-sm-2 control-label form-label">名称</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-line" name="group_name"  placeholder="名称" value="<?php echo $result['name'];?>">
                  </div>
                </div>
                
                 <div class="form-group">
                   <label class="col-sm-2 control-label form-label">权限</label>
                 <div class="col-sm-10">
                 <?php 
                 $authority = json_decode($result['authority'],true);
                 foreach ($modules as $key => $value){?>
                  <!--  开始 -->
                  <div class="form-group">
                  <label class="col-sm-1 control-label form-label"><?php echo $key;?></label>
                  <div class="col-sm-1">
                    <input type="text" class="form-control form-control-line" name="<?php echo $key . '_cost';?>" placeholder="每笔费率" value="<?php echo $authority[$key]['cost'];?>">
                  </div>
                  <div class="col-sm-1">
                    <input type="text" class="form-control form-control-line" name="<?php echo $key . '_quantity';?>" placeholder="通道数量" value="<?php echo $authority[$key]['quantity'];?>">
                  </div>
                  <div class="col-sm-8" style="margin-top: 7px;">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="<?php echo $key. '_open';?>" name="<?php echo $key . '_open';?>" value="1" <?php if ($authority[$key]['open'] == 1) echo 'checked';?>>
                        <label for="<?php echo $key. '_open';?>"> 授权通道</label>
                    </div>
                  </div>
                </div>
                
                <?php if ($key == 'service_auto'){?>
                     <div class="form-group">
                   <label class="col-sm-3 control-label form-label">service_auto->授权账号</label>
                    <div class="col-sm-9">
                  <?php foreach ($service as $srv){?>
                  <!--  开始 -->
                  <div class="form-group">
                  <div class="col-sm-12">
					<div class="checkbox checkbox-success">
                        <input id="checkbox<?php echo $srv['id'];?>" name="service_auto_aisle[]" type="checkbox" value="<?php echo $srv['id'];?>" <?php if (in_array($srv['id'], $authority[$key]['gateway'])) echo 'checked';?>>
                        <label for="checkbox<?php echo $srv['id'];?>">
                           <?php if ($srv['types'] == 1) echo '微信'; if ($srv['types'] == 2) echo '支付宝';?> -> [ <span style="color: green;"><?php echo $srv['id'];?></span> ][ <span style="color: green;"><?php echo $srv['name'];?></span> ]

                        </label>
                    </div>
                  </div>
                </div>
                  <!-- 结束 -->
                   <?php }?>
                   </div>
                    </div>
                     <?php }?>
                  <!-- 结束 -->
                   <?php }?>
                   </div>
                    </div>
                    
                     
                    
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="editGroup()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/customer/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
  
    <script type="text/javascript">
			function editGroup(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/customer/editResult',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success")
			              	  setTimeout(function(){location.href = '<?php echo url::s('admin/customer/index');?>';},1500);
			              }else{
			            	  swal("操作提示", data.msg, "error")
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