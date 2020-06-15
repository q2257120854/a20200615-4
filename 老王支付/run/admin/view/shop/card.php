<?php
use xh\library\url;
use xh\library\model;
use xh\unity\cog;
use xh\library\request;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">卡密管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#addGroup" class="btn btn-light">添加卡密</a>
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
          Card list
        </div>
        <div class="panel-body table-responsive">
          <p>[ <a href="<?php echo url::s('admin/shop/card');?>">全部</a> ] 每页显示多少 <input onchange="show(this);" style="width: 80px;text-align:center;"  type="text" class="form-control-line" value="<?php echo $page_num;?>"> 条</p>
          <table class="table table-hover">
            <thead>
              <tr>
                <td><input onchange="card(this);" style="width: 160px;"  type="text" class="form-control-line" value="<?php echo request::filter('get.card');?>" placeholder="卡号"></td>
                <td><input onchange="card_pwd(this);" style="width: 160px;"  type="text" class="form-control-line" value="<?php echo request::filter('get.card_pwd');?>" placeholder="卡密"></td>
                <td>商品信息</td>
                <td>状态 <a href='<?php echo url::s('admin/shop/card',"sorting=status&code={$status}");?>'> <i class="fa fa-unsorted"></i></a></td>
                <td>添加时间</td>
                <td>出售时间</td>
                <td>操作 <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:7px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                    </div>
                </td>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($result['result'] as $ru){?>
              <tr>
                <td><b style="color: green;"><?php echo $ru['card_no'];?></b></td>
                <td><b style="color: green;"><?php echo $ru['card_pwd'];?></b></td>
                <td><?php $shopInfo = $mysql->query("shop","id={$ru['shop_id']}")[0]; echo $shopInfo['name'];?></td>
                <td><?php echo $ru['status'] == 0 ? '<span style="color:red;">未出售</span>' : '<span style="color:green;">已出售</span>' . " ( 商户ID：<a href='".url::s('admin/member/index','member_id=' . $ru['user_id'])."'>{$ru['user_id']}</a> ) ";?></td>
                <td><?php echo date("Y/m/d H:i:s",$ru['add_time']);?></td>
                <td><?php echo $ru['status'] == 0 ? '无数据': date("Y/m/d H:i:s",$ru['sell_time']);?></td>
                
                <td>
 				<p style="margin-top: -20px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选,操作该卡密!
                        </label>
                    </div></p>
   
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 20); ?>
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
                    <h4 class="modal-title">添加卡密</h4>
                  </div>
                  <div class="modal-body">
                  

                
                <div class="form-group" id="bind_special">
                  <label class="col-sm-2 control-label form-label">商品</label>
                  <div class="col-sm-10">
                   <select class="selectpicker" id="shop_id">
                      <optgroup label="请选择商品" >
                      <?php foreach ($shop as $sp){?>
                        <option value="<?php echo $sp['id'];?>"><?php echo $sp['name'];?></option>
                      <?php }?>
                      </optgroup>
                    </select>                             
                  </div>
                </div>
                
                <div class="form-group" id="card">
                  <label class="col-sm-2 control-label form-label">卡密列表</label>
                  <div class="col-sm-10">
						<textarea rows="20" class="form-control form-control-line" id="card_content"  placeholder="卡密信息，一行一个"></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">上传卡密</label>
                  <div class="col-sm-10">
						<input type="file" class="form-control form-control-line" id="card_file" name="card_file" onchange="uploadOnchange(this);" placeholder="如果卡密过多，可以上传txt" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">分隔符</label>
                  <div class="col-sm-10">
						<input type="text" class="form-control form-control-line" id="delimiter" placeholder="卡号和卡密的分隔符，如-----" value="----"/>
                  </div>
                </div>
                

                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-default">发布卡密</button>
                  </div>
                </div></div>
                 </form>
              </div>
            </div>
            
            <script type="text/javascript">

			//类型更改与显示
			function uploadOnchange(obj){
				var fileNum = $(obj).val();
				console.log(fileNum);
				if(fileNum != ''){
					$('#card').hide();
				}else{
					$('#card').show();
				}
			}

			function add(){
				var fileObj = document.getElementById("card_file").files[0]; // js 获取文件对象
				var formFile = new FormData();
				formFile.append("shop_id", $('#shop_id').val());
				formFile.append("card", $('#card_content').val());
				formFile.append("delimiter", $('#delimiter').val());
	            formFile.append("file", fileObj); //加入文件对象
	            var data = formFile; //$('#from').serialize()
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/shop/addCard');?>",
			          data: data,
	                  cache: false,//上传文件无需缓存
	                  processData: false,//用于对data参数进行序列化处理 这里必须false
	                  contentType: false, //必须
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success")
			              	  setTimeout(function(){location.href = '<?php echo url::get();?>';},1500);
			              }else{
			            	  swal("操作提示", data.msg, "error")
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}


			function show(obj){
				location.href="<?php echo url::s("admin/shop/card","page_num=")?>" + $(obj).val();
			}

			function card(obj){
				location.href="<?php echo url::s("admin/shop/card","card=")?>" + $(obj).val();
			}

			function card_pwd(obj){
				location.href="<?php echo url::s("admin/shop/card","card_pwd=")?>" + $(obj).val();
			}


			function deletes(){ 
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的卡密吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些卡密!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/shop/delCard','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '<?php echo url::get();?>';},1000);
				                	  });
				           });  
						  
		              });
		           
				}

			function showBtn(){
				var Inc = 0;
				$("input[name='items']:checkbox").each(function(){
                    if(this.checked){
                    	$('#deletes').show();
                    	$('#status').show();
                    	return true;
                    }
                    Inc++;
              });
	              if($("input[name='items']:checkbox").length == Inc){
	            	  $('#deletes').hide();
	            	  $('#status').hide();
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
<script type="text/javascript">
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