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
        <li class="active">模块管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#add" class="btn btn-light">添加模块</a>
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
          模块管理
        </div>
        <div class="panel-body table-responsive">
          <p>你可以在这里添加您开发设计的模块或者导航，方便菜单栏的快捷访问。</p>

          <table class="table table-hover">
            <thead>
              <tr>
                <td>模块ID</td>
                <td>模块名称</td>
                <td>状态</td>
                <td>绑定菜单</td>
                <td>路径</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($modules['result'] as $mu){?>
              <tr>
                <td><?php echo $mu['id'];?></td>
                <td><b><?php echo $mu['name'];?></b></td>
                <td><?php echo $mu['state'] == 1 ? '<span style="color:green;">开启</span>' : '<span style="color:red;">关闭</span>';?></td>
                <td><?php 
                //查询绑定菜单
                $menuc = $mysql->query("mgt_menu","id={$mu['menuid']}");
                if (is_array($menuc[0])){
                    echo '<a href=" '. url::s("admin/menu/index"). '"><span style="color:green;"><b>' . strip_tags($menuc[0]['menu_name']) .'</b></span></a>';
                }else{
                    echo '<span style="color:red;">模块异常,未绑定菜单</span>';
                }
                ?></td>
                
                <td><?php echo '<a href=" '. url::s($mu['route']). '"><span style="color:gray;">' . $mu['route'] .'</span></a>';?></td>
                <td>
                <a href="<?php echo url::s('admin/module/viewEdit',"id=" . str_replace('=', '@', base64_encode($mu['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
                <a href="#" onclick="deletec('<?php echo $mu['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>删除</a>
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
                    <h4 class="modal-title">添加模块</h4>
                  </div>
                  <div class="modal-body">
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">模块名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="module_name"  placeholder="模块名称">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">状态</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="state" value="1" checked>
                        <label for="inlineRadio1"> 开启 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="state" value="2">
                        <label for="inlineRadio2"> 关闭 </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">菜单</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="menuid">
                    <?php foreach ($menus as $me){?>
                        <option value="<?php echo $me['id'];?>"><?php echo strip_tags($me['menu_name']);?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">路径</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="route"  placeholder="模块路径">
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
			function add(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/module/add');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
				          console.log(data);
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

			function deletec(id){
		              swal({
		                title: "危险提示", 
		                text: "你确定要删除该模块吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除它!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 

		                 $.get("<?php echo url::s('admin/module/delete','id=');?>" + id, function(result){

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
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

</body>
</html>