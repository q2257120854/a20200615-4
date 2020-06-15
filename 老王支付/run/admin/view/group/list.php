<?php 
use xh\library\url;
use xh\library\model;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">管理组</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#addGroup" class="btn btn-light">添加权限组</a>
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
          用户组
        </div>
        <div class="panel-body table-responsive">
          <p>你可以在这里定义用户组权限，让你的员工能够更方便的帮助你管理系统。</p>

          <table class="table table-hover">
            <thead>
              <tr>
                <td>组ID</td>
                <td>权限组名称</td>
                <td>权限列表</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($group['result'] as $gr){?>
              <tr>
                <td><b><?php echo $gr['id'];?></b></td>
                <td><b><?php echo $gr['mgt_name'];?></b></td>
                <td><?php
                //每一行代码都是精髓，经过各种优化处理，让系统更加稳定安全
                //花生米，代码完结时间：2018年6月7日00:12:41
                if ($gr['authority'] == -1){ echo '全局禁止'; }elseif ($gr['authority'] == -2){echo '系统管理员';}else {
                    $authority = json_decode($gr['authority'],true);
                    if (is_array($authority)){
                        $mod_list = '';
                        $count = count($authority);
                        for ($i=0;$i<$count;$i++){
                            $mod = $mysql->query('mgt_module',"id={$authority[$i]}")[0];
                            if (is_array($mod)){
                                $mod_list .=  '<a href="' . url::s($mod['route']).'"><span style="color:green;"> [ ' . $mod['name'] . ' ] </span></a> ';
                            }else{
                                $mod_list .= '<span style="color:red;"> [ 未找到模块 ] </span>' . ' ';
                            }
                        }
                        echo $mod_list;
                    }else{
                        echo '权限分配错误';
                    }
                }?></td>
                <td>
                <?php if ($gr['authority'] != -1 && $gr['authority'] != -2) {?>
                <a href="<?php echo url::s('admin/power/viewEditGroup',"id=" . str_replace('=', '@', base64_encode($gr['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
                <a href="#" onclick="delGroup('<?php echo $gr['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>删除</a>
                <?php }else{ echo '系统内置';}?>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($group['info']['pageAll'], $group['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>
        </div>
        
         

      </div>
      
      
    </div>
    <!-- End Panel -->
    
    

 <!-- Modal -->
            <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <form class="form-horizontal" id="from" method="post" action="#">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加权限组</h4>
                  </div>
                  <div class="modal-body">
                  
                  
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="group_name"  placeholder="权限组名称">
                  </div>
                </div>
                
                  <div class="form-group">
                   <label class="col-sm-2 control-label form-label">权限</label>
                    <div class="col-sm-10">
                  <?php foreach ($modules as $mod){?>
                    <div class="checkbox checkbox-success ">
                        <input id="checkbox<?php echo $mod['id'];?>" type="checkbox" name="modules[]" value="<?php echo $mod['id'];?>">
                        <label for="checkbox<?php echo $mod['id'];?>">
                            <?php echo $mod['name'];?>（状态：<?php if ($mod['state'] == 1){echo '<span style="color:green;">开启</span>';}else{echo '<span style="color:red;">关闭</span>';}?>）
                        </label>
                    </div>
                   <?php }?>
                   </div>
                    </div>
                
               
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="addGroup()" class="btn btn-default">确认添加</button>
                  </div>
                </div>
                 </form>
              </div>
            </div>
            
            <script type="text/javascript">
			function addGroup(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/power/addGroup');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success")
			              	setTimeout(function(){location.href = '';},1500);
			              }else{
			            	  swal("操作提示", data.msg, "error")
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}

			function delGroup(id){
		              swal({
		                title: "危险提示", 
		                text: "你确定要删除该用户组，并将该用户组下的所有成员删除，并且无法恢复吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除它!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 

		                 $.get("<?php echo url::s('admin/power/delGroup','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success")
				              	setTimeout(function(){location.href = '';},1500);
				              }else{
				            	  swal("操作提示", result.msg, "error")
				              }
		                	    
		                	  });

						  
		              });		
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

</body>
</html>