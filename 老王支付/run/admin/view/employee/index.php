<?php 
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航

?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">员工管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#add" class="btn btn-light">雇佣新人</a>
        <a href="?verification=<?php echo mt_rand(1000,9999);?>" class="btn btn-light"><i class="fa fa-refresh"></i></a>
       
      </div>
    </div>
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          员工管理
        </div>
        <div class="panel-body table-responsive">
          <p>你可以在这里添加工人来帮助你管理本系统，权限可随意调整。</p>

          <table class="table table-hover">
            <thead>
              <tr>
                <td></td>
                <td>基本资料</td>
                <td>通讯方式</td>
                <td>账户</td>
                <td>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                        
                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($employee['result'] as $em){?>
              <tr>
                <td style="width: 86px;">
                <img id="<?php echo 'imgCode_' . $em['id'];?>" onclick="imgSelect('<?php echo 'img_' . $em['id'];?>');" style="width: 86px;border-radius:50%;" alt="<?php echo $em['username'];?>" src="<?php echo URL_VIEW . '/upload/avatar/' . $em['id'] . '/' . $em['avatar'];?>"></td>
                <input type="file" name="avatar" id="<?php echo 'img_' . $em['id'];?>"  style="display:none;" onchange="uploadPic('#<?php echo 'img_' . $em['id'];?>','<?php echo $em['id'];?>');">
                <td>
                    <p><b>工人ID：</b><?php echo $em['id'];?></p>
                    <p><b>用户名：</b><span style="color:red;"><?php echo $em['username'];?></span><?php if ($_SESSION['USER_MGT']['uid'] == $em['id']) echo ' ( <b>自己</b> )';?></p>
                    <p><b>权限组：</b><?php $group = $mysql->query("mgt_group","id={$em['group_id']}")[0]; echo is_array($group) ? '<span style="color:orange;"><b>'.$group['mgt_name'].'</b></span>' : '<span style="color:red;">未分配用户组</span>'; ?></p>
                </td>
                
                <td>
                    <p><b>手机号：</b><?php echo $em['phone'];?> ( <a onclick="copy('<?php echo $em['phone'];?>');" href="#" style="color: black;">复制</a> )</p>
                    <p><b>邮箱号：</b><?php echo $em['email'];?> ( <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo $em['email'];?>" style="color: blue;">发送邮件</a> )</p>
                    <p><b>IP地址：</b><?php echo $em['ip'];?> ( <a href="#" onclick="ipGet('<?php echo $em['ip'];?>',this);" style="color: green;">显示归属地</a> )</p>
                </td>
                
                
                 <td>
                    <p><b>员工备注：</b><?php echo $em['remarks'];?></p>
                    <p><b>安全口令：</b><?php echo substr($em['pwd_safe'], 0,12);?> ( <span style="color: green;">正常</span> )</p>
                    <p><b>登录时间：</b><?php echo date("Y/m/d H:i:s",$em['login_time']);?> ( 上次 )</p>
                </td>
               
                <td>
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $em['id'];?>" id="checkbox<?php echo $em['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $em['id'];?>">
                            勾选,准备移除该员工!
                        </label>
                    </div></p>
                <p><a href="<?php echo url::s('admin/employee/viewEdit',"id=" . str_replace('=', '@', base64_encode($em['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>更改资料</a></p>
                <p><a href="#" onclick="deletec('<?php echo $em['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除工人</a></p>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($modules['info']['pageAll'], $modules['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>
          
        </div>

      </div>
    </div>
    <!-- End Panel -->
    
    
    <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <form class="form-horizontal" id="from" method="post" action="#">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新增员工</h4>
                  </div>
                  <div class="modal-body">
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">用户名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="username"  placeholder="员工用作于登录的用户名">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd"  placeholder="员工用作于登录的密码">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">口令</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd_safe"  placeholder="6位安全口令,部功能操作需要安全口令认证">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">权限组</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="group_id">
                    <?php foreach ($groups as $gp){?>
                        <option value="<?php echo $gp['id'];?>"><?php echo $gp['mgt_name'];?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">手机号</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">邮箱</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="email"  placeholder="邮箱账号">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">备注</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="remarks"  placeholder="员工备注">
                  </div>
                </div>

          
               
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-default">确认添加</button>
                  </div>
                </div>
                 </form>
              </div>
            </div>
            
            <script type="text/javascript">
			//查询ip归属地
			function ipGet(ip,obj){
				$.get("<?php echo url::s('admin/employee/ipGet','ip=');?>" + ip, function(result){
	               	 if(result.code == '200'){
			            	//swal("操作提示", result.msg, "success")
			              	$(obj).html(result.data.city);
			              }else{
			            	  swal("操作提示", "查询失败,请重试", "error");
			              }
	               	    
	               	  });
			}
			//复制文本到粘贴板
			 function copy(str){
	                var save = function (e){
	                    e.clipboardData.setData('text/plain',str);//下面会说到clipboardData对象
	                    e.preventDefault();//阻止默认行为
	                }
	                document.addEventListener('copy',save);
	                document.execCommand("copy");//使文档处于可编辑状态，否则无效
	                swal("操作提示", "复制成功！", "success")
	         }
			
            //添加用户
			function add(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/employee/add');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
				          console.log(data);
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success");
			              	setTimeout(function(){location.href = '';},1500);
			              }else{
			            	  swal("操作提示", data.msg, "error");
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}

			//选择头像
			function imgSelect(id){
			        document.getElementById(id).click(); 
			}

			//上传头像
			function uploadPic(bid,id){
			    var pic = $(bid)[0].files[0];
			    var fd = new FormData();
			    fd.append('avatar', pic);
			    $.ajax({
			        url:"<?php echo url::s('admin/employee/avatarUpload','id=');?>" + id,
			        type:"post",
			        // Form数据
			        data: fd,
			        cache: false,
			        contentType: false,
			        processData: false,
			        success:function(data){
			            if(data.code == '200'){
			            	swal("操作提示", data.msg, "success");
			            	$('#imgCode_' + id).attr('src','<?php echo URL_VIEW . '/upload/avatar/';?>' + id + '/' + data.data.img);
			            }else{
			            	swal("操作提示", data.msg, "error");
			            }
			        }
			    });
			                    
			}

			function deletec(id){
		              swal({
		                title: "危险提示", 
		                text: "你确定要删除该员工吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除该员工!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/employee/delete','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success");
				              	setTimeout(function(){location.href = '';},1500);
				              }else{
				            	  swal("操作提示", result.msg, "error");
				              }
		                	    
		                	  });

						  
		              });		
			}


			function deletes(){
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的员工吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些员工!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/employee/delete','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1500);
				                	  });
				           });  
						  
		              });
		           
				}


			function showBtn(){
				var Inc = 0;
				$("input[name='items']:checkbox").each(function(){
                    if(this.checked){
                    	$('#deletes').show();
                    	return true;
                    }
                    Inc++;
              });
	              if($("input[name='items']:checkbox").length == Inc){
	            	  $('#deletes').hide();
		          }
			}

            </script>
            

<!-- End Moda Code -->
 
  </div>
  <!-- End Row -->
  
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
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

<script>


$(function(){
       //实现全选与反选  
       $("#checkboxAll").click(function() {
           if (this.checked){
               $("input[name='items']:checkbox").each(function(){   
                     $(this).prop("checked", true);
               });
               showBtn();
           } else {     
               $("input[name='items']:checkbox").each(function() {     
                     $(this).prop("checked", false);    
               });
               showBtn();
           }   
       });  
   });  
</script>

</body>
</html>