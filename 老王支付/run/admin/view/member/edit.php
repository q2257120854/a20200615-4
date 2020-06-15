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
        <li><a href="<?php echo url::s('admin/member/index');?>">会员管理</a></li>
        <li class="active">修改</li>
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
          修改会员
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
                <div style="text-align: center;" class="form-group">
                  <img id="avatar" onclick="imgSelect();" style="width: 100px;border-radius:50%;margin: 0 auto;" alt="<?php echo $result['username'];?>" src="<?php echo strlen($result['avatar']) > 2 ? str_replace("admin", 'index', URL_VIEW) . 'upload/avatar/' . $result['id'] . '/' . $result['avatar'] : str_replace("admin", 'index', URL_VIEW) .'static/images/avatar.png';?>"></td>
                  <input type="file" name="avatar" id="avatarImg"  style="display:none;" onchange="uploadPic();">
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label form-label">会员名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="username"  placeholder="登录的用户名" value="<?php echo $result['username'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="pwd"  placeholder="登录的密码，不修改请留空">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">手机号</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码" value="<?php echo $result['phone'];?>">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">权限组</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="group_id">
                    <?php foreach ($groups as $gp){?>
                        <option value="<?php echo $gp['id'];?>" <?php if ($result['group_id'] == $gp['id']) echo 'selected';?>><?php echo $gp['name'];?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
   
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">上级ID</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="level_id"  placeholder="0" value="<?php echo $result['level_id'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">账户余额</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="balance"  placeholder="0.00" value="<?php echo $result['balance'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">账户金额</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="money"  placeholder="0.00" value="<?php echo $result['money'];?>">
                  </div>
                </div>
                
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/member/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
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
	        url:"<?php echo url::s('admin/member/avatarUpload','id=' . $result['id']);?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.code == '200'){
	            	swal("操作提示", data.msg, "success");
	            	$('#avatar').attr('src','<?php echo str_replace('admin', 'index', URL_VIEW) . '/upload/avatar/' . $result['id'] . '/';?>' + data.data.img);
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
			          url: "<?php echo url::s('admin/member/editResult',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success")
			              	setTimeout(function(){location.href = '<?php echo url::s('admin/member/index');?>';},1500);
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