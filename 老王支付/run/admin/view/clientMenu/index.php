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
        <li class="active">菜单管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#add" class="btn btn-light">添加菜单</a>
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
          菜单管理
        </div>
        <div class="panel-body table-responsive">
          <p>本菜单为客户端显示菜单，更方便的让客户更有体验感。</p>

          <table class="table table-hover">
            <thead>
              <tr>
                <td>菜单名称</td>
                <td>模块列表</td>
                <td>显示</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($menus['result'] as $mu){?>
              <tr>
                <td><b><?php echo strip_tags($mu['name']);?></b></td>
                <td><?php 
                //自动查询模块列表
                $modulec = $mysql->query("client_module","menuid={$mu['id']}");
                
                if (is_array($modulec[0])){
                    
                    foreach ($modulec as $modc){
                        echo '<a target="_blank" href=" '. url::s($modc['route']). '"><span style="color:green;"> [ ' . $modc['name'] .'  ] </span></a>';
                    }
                    
                }else{
                    echo '<span style="color:red;">菜单下没有模块</span>';
                }
                    

                ?></td>
                <td><?php echo $mu['hide'] == 1 ? '<span style="color:green;">显示</span>' : '<span style="color:red;">隐藏</span>';?></td>
                <td>
                <a href="<?php echo url::s('admin/clientMenu/viewEdit',"id=" . str_replace('=', '@', base64_encode($mu['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
                <a href="#" onclick="deletec('<?php echo $mu['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>删除</a>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($menus['info']['pageAll'], $menus['info']['page'], 10); ?>
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
                    <h4 class="modal-title">添加菜单</h4>
                  </div>
                  <div class="modal-body">
                  
                  
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">菜单名</label>
                  <div class="col-sm-10">
                  <textarea class="form-control form-control-line" rows="3"  name="menu_name"  placeholder="菜单名称，支持html" ></textarea>
                  </div>
                </div>
      
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">显示</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="hide" value="1" checked>
                        <label for="inlineRadio1"> 显示 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="hide" value="2">
                        <label for="inlineRadio2"> 隐藏 </label>
                    </div>
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
			          url: "<?php echo url::s('admin/clientMenu/add');?>",
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
		                text: "你确定要删除该菜单吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除它!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 

		                 $.get("<?php echo url::s('admin/clientMenu/delete','id=');?>" + id, function(result){

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