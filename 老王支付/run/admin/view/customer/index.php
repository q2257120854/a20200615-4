<?php 
use xh\library\url;
use xh\library\model;
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
        <li class="active">用户组</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#addGroup" class="btn btn-light">添加用户组</a>
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
          <p>你可以在这里自定义会员的用户组，让他们拥有更多的优惠和福利。</p>

          <table class="table table-hover">
            <thead>
              <tr>
                <td>组ID</td>
                <td>用户组名称</td>
                <td>优惠列表</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($group['result'] as $gr){?>
              <tr>
                <td><b><?php echo $gr['id'];?></b></td>
                <td><b><?php echo $gr['name'];?></b></td>
                <td><?php
                if ($gr['authority'] == -1){ echo '禁止登录，账号禁止'; }else {
                    $authority = json_decode($gr['authority'],true);
                    if (is_array($authority)){
                        foreach ($authority as $key => $value){
                            echo '[<span style="color:green;"> ' . $key . ' </span>] -> ' . ($value['open'] == 1 ? '<span style="color:green;">open</span>' : '<span style="color:red;">closed</span>') . ' -> <b>' . $value['cost']*100 . '%</b> -> <span style="color:green;">Gateway: ' . ($value['quantity']==0 ? 'unlimited' : $value['quantity']) . '</span>';
                            if ($key == 'service_auto'){
                                //查询服务信息
                                $count_service = count($value['gateway']);
                                if ($count_service > 0) echo ' -> ';
                                for ($i=0;$i<$count_service;$i++){
                                    $find_service = $mysql->query("service_account","id={$value['gateway'][$i]}")[0];
                                    echo ' [ <b style="color:red;">' . $find_service['key_id'] . '</b> / ' .$find_service['id'] .' ] ';
                                }
                            }
                            echo '<br>';
                        }
                    }else{
                        echo '系统分配错误';
                    }
                }?></td>
                <td>
                <?php if ($gr['authority'] != -1 && $gr['authority'] != -2) {?>
                <a href="<?php echo url::s('admin/customer/edit',"id=" . str_replace('=', '@', base64_encode($gr['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
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
                    <h4 class="modal-title">添加用户组</h4>
                  </div>
                  <div class="modal-body">
                  
                  
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="group_name"  placeholder="名称，如SVIP1">
                  </div>
                </div>
                
                  <div class="form-group">
                   <label class="col-sm-2 control-label form-label">优惠</label>
                    <div class="col-sm-10">
                  <?php foreach ($modules as $key => $value){?>
                  <!--  开始 -->
                  <div class="form-group">
                  <label class="col-sm-3 control-label form-label"><?php echo $key;?></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-line" name="<?php echo $key . '_cost';?>" placeholder="每笔费率" value="0.01">
                  </div>
                  
                  <?php if ($key != 'service_auto'){?>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-line" name="<?php echo $key . '_quantity';?>" placeholder="通道数量" value="5">
                  </div>
                  <?php }?>
                  <div class="col-sm-3" style="margin-top: 7px;">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" id="<?php echo $key. '_open';?>" name="<?php echo $key . '_open';?>" value="1">
                        <label for="<?php echo $key. '_open';?>"> 授权通道</label>
                    </div>
                  </div>
                 
                </div>
                
                
                <?php if ($key == 'service_auto'){?>
                     <div class="form-group">
                   <label class="col-sm-4 control-label form-label">service_auto->授权账号</label>
                    <div class="col-sm-7">
                  <?php foreach ($service as $srv){?>
                  <!--  开始 -->
                  <div class="form-group">
                  <div class="col-sm-12">
					<div class="checkbox checkbox-success">
                        <input id="checkbox<?php echo $srv['id'];?>" name="service_auto_aisle[]" type="checkbox" value="<?php echo $srv['id'];?>">
                        <label for="checkbox<?php echo $srv['id'];?>">
                           <?php if ($srv['types'] == 1) echo '微信'; if ($srv['types'] == 2) echo '支付宝';?> -> [ <span style="color: green;"><?php echo $srv['name'];?></span> ]
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
			          url: "<?php echo url::s('admin/customer/add');?>",
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
		                text: "你确定要删除该用户组，删除后，该用户组下的成员无法正常登录系统，并且无法恢复吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除它!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/customer/delete','id=');?>" + id, function(result){

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