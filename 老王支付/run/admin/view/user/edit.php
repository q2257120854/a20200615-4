<?php
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">仪表盘</a></li>
        <li class="active">个人资料</li>
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
          修改资料
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
                <div style="text-align: center;" class="form-group">
                  <img id="avatar" onclick="imgSelect();" style="width: 100px;border-radius:50%;margin: 0 auto;" alt="<?php echo $result['username'];?>" src="<?php echo URL_VIEW . '/upload/avatar/' . $result['id'] . '/' . $result['avatar'];?>"></td>
                  <input type="file" name="avatar" id="avatarImg"  style="display:none;" onchange="uploadPic();">
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd"  placeholder="用作于登录的密码，不修改请留空">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">口令</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd_safe"  placeholder="6位安全口令，不修改请留空">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">手机号</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码" value="<?php echo $result['phone'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">邮箱</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="email"  placeholder="邮箱账号" value="<?php echo $result['email'];?>">
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

    //选择头像
	function imgSelect(){
	        document.getElementById('avatarImg').click(); 
	}

	//上传头像
	function uploadPic(){
	    var pic = $('#avatarImg')[0].files[0];
	    var fd = new FormData();
	    fd.append('avatar', pic);
	    $.ajax({
	        url:"<?php echo url::s('admin/user/avatarUpload');?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.code == '200'){
	            	swal("操作提示", data.msg, "success");
	            	$('#avatar').attr('src','<?php echo URL_VIEW . '/upload/avatar/' . $result['id'] . '/';?>' + data.data.img);
	            }else{
	            	swal("操作提示", data.msg, "error");
	            }
	        }
	    });
	                    
	}

			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/user/edit');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success")
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