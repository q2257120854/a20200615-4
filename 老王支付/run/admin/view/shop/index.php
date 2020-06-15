<?php 
use xh\library\url;
use xh\library\model;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">商品管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#addGroup" class="btn btn-light">添加商品</a>
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
          Product list
        </div>
        <div class="panel-body table-responsive">
          <p>商品管理</p>
          <table class="table table-hover">
            <thead>
              <tr>
                <td>商品信息</td>
                <td>价格</td>
                <td>类型</td>
                <td>状态</td>
                <td>规则</td>
                <td>排序</td>
                <td>操作 <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:7px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                        <button type="button" id="status" onclick="allStatus();" class="btn btn-warning btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-circle-o-notch"></i>停售/出售</button>
                        
                    </div>
                </td>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($result['result'] as $ru){?>
              <tr>
                <td><p><b>商品ID：</b><?php echo $ru['id'];?> <?php if ($ru['category'] == 2){?> [ <a href="<?php echo url::s("admin/shop/card","shop_id={$ru['id']}");?>">查看卡密</a> ]<?php }?> <?php 
                if ($ru['category'] == 3){ echo ' [ 库存：<b style="color:red;">' . $ru['warehouse'] . '</b> ] '; }
                if ($ru['category'] == 2){
                    //查询卡密库存
                    $cardWare = $mysql->select("select count(id) as count from {$fix}shop_card where shop_id={$ru['id']} and status=0")[0]['count'];
                    echo ' [ 库存：<b style="color:red;">' . $cardWare . '</b> ] '; 
                }
                ?></p><p><b>商品名：</b><?php echo $ru['name'];?></p></td>
                <td><p><b>单价：</b><span style="color: red;font-size:14px;"><?php echo $ru['money'];?> </span>元</p><p><b>成本：</b><?php echo $ru['cost'];?> 元</p></td>
                <td><p><b>类型：</b><?php if ($ru['category'] == 1) echo '会员等级'; if ($ru['category'] == 2) echo '卡密类'; if ($ru['category'] == 3) echo '商品货物类';?></p><p><b>限购：</b><?php echo $ru['restriction'];?> 个/次</p></td>
                <td><p><b>状态：</b><?php echo $ru['status'] == 1 ? '<span style="color:green;">正常销售</span>' : '<span style="color:red;">停止销售</span>';?> [ <?php if ($ru['status'] == 1) {?><a href="javascript:void(0);" style="color: red;" onclick="changeStatus('<?php echo $ru['id'];?>');">停止销售</a><?php }else{?><a href="javascript:void(0);" style="color: green;" onclick="changeStatus('<?php echo $ru['id'];?>');">开启销售</a><?php }?> ]</p><p><b>已售：</b><?php echo $ru['purchases'];?> 个/次</p></td>
                <td><?php 
                //批量购买规则
                if ($ru['category'] != 1){
                    $discount = json_decode($ru['discount'],true);
                    foreach ($discount as $dc){
                        echo '[ 数量: <span style="color:green;font-weight:bold;">' .$dc['num'] . '</span> 个起 ] / [ <span style="color:red;font-weight:bold;">' . floatval($dc['money']) . ' </span>元/单价 ]<br>';
                    }
                }else{ 
                    //echo '该商品无此功能';
                    //查询用户组
                    $groupc = $mysql->query("client_group","id={$ru['bind_special']}")[0];
                    if (is_array($groupc)){
                        $authority = json_decode($groupc['authority'],true);
                        if (is_array($authority)){
                            foreach ($authority as $key => $value){
                                echo '[<span style="color:green;"> ' . $key . ' </span>] -> ' . ($value['open'] == 1 ? '<span style="color:green;">open</span>' : '<span style="color:red;">closed</span>') . ' -> <b>' . $value['cost']*100 . '%</b> -> <span style="color:green;">Gateway: ' . ($value['quantity']==0 ? 'unlimited' : $value['quantity']) . '</span>';
                                if ($key == 'service_auto'){
                                    //查询服务信息
                                    $count_service = count($value['gateway']);
                                    if ($count_service > 0) echo ' -> ';
                                    for ($i=0;$i<$count_service;$i++){
                                        $find_service = $mysql->query("service_account","id={$value['gateway'][$i]}")[0];
                                        echo ' [ <b style="color:red;">' . $find_service['key_id'] . '</b> / ' .$find_service['name'] .' ] ';
                                    }
                                }
                                echo '<br>';
                            }
                        }else{
                            echo '系统分配错误';
                        }
                        
                    }else{
                        echo '商品异常(用户组不存在)';
                    }
                }
                ?></td>
                <td><p><b>商品排序：</b><input onchange="rule('<?php echo $ru['id'];?>',this);" style="width:100px;" type="text" class="form-control-line" placeholder="数值越小越靠前" value="<?php echo $ru['sort'];?>"></p><p><b>发布时间：</b><?php echo date("Y/m/d H:i:s",$ru['release_time']);?></p></td>
                
                <td>
 				<p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选,操作该商品!
                        </label>
                    </div></p>
                <p><a href="<?php echo url::s('admin/shop/updateView',"id=" . str_replace('=', '@', base64_encode($ru['id'])));?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改商品</a></p>
                <p><a href="#" onclick="del('<?php echo $ru['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除商品</a></p>
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
                    <h4 class="modal-title">添加商品</h4>
                  </div>
                  <div class="modal-body">
                  
                  
                  
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="shop_name"  placeholder="商品名称">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">描述</label>
                  <div class="col-sm-10">
                    <textarea class="form-control form-control-line" name="description"  placeholder="商品描述"></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">单价</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="money"  placeholder="商品单价">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">成本</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="cost"  placeholder="商品成本价">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">类型</label>
                  <div class="col-sm-10">
                   <select class="selectpicker" name="category" onchange="categoryUpdate(this);">
                      <optgroup label="请选择商品类型" >
                        <option value="1">出售用户组</option>
                        <option value="2">出售卡号卡密</option>
                        <option value="3">出售商品货物</option>
                      </optgroup>
                    </select>                             
                  </div>
                </div>
                
                <div class="form-group" id="bind_special">
                  <label class="col-sm-2 control-label form-label">出售</label>
                  <div class="col-sm-10">
                   <select class="selectpicker" name="bind_special">
                      <optgroup label="请选择要出售的用户组" >
                      <?php foreach ($group as $gr){?>
                        <option value="<?php echo $gr['id'];?>"><?php echo $gr['name'];?></option>
                      <?php }?>
                      </optgroup>
                    </select>                             
                  </div>
                </div>
                
                <div class="form-group" style="display: none;" id="discount">
                  <label class="col-sm-2 control-label form-label">规则</label>
                  <div class="col-sm-10">
<textarea rows="6" class="form-control form-control-line" name="discount"  placeholder="批发优惠规则">5,15.00
10,14.00
20,13.50</textarea>
                  </div>
                </div>
                
                <div class="form-group" style="display: none;" id="restriction">
                  <label class="col-sm-2 control-label form-label">限购</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="restriction"  placeholder="限制购买数量或次数">
                  </div>
                </div>
                
                <div class="form-group" style="display: none;" id="warehouse">
                  <label class="col-sm-2 control-label form-label">库存</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="warehouse"  placeholder="库存数量">
                  </div>
                </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-default">发布商品</button>
                  </div>
                </div></div>
                 </form>
              </div>
            </div>
            
            <script type="text/javascript">

			//类型更改与显示
			function categoryUpdate(obj){
				var category = $(obj).val();
				if(category == 2 || category == 3) {
					$('#discount').show();
					$('#restriction').show();
					$('#bind_special').hide();
				}else{
					$('#discount').hide();
					$('#restriction').hide();
					$('#bind_special').show();
					}

				if(category == 3){
					$('#warehouse').show();
					}else{
					$('#warehouse').hide();
					}
			}

            
			function add(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/shop/add');?>",
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

			function rule(id,obj){
				$.get("<?php echo url::s('admin/shop/rule','id=');?>" + id + "&no=" + $(obj).val(), function(result){
	               	 if(result.code == '200'){
			            	//swal("操作提示", result.msg, "success")
			              	//setTimeout(function(){location.href = '';},1500);
		               		location.href = "<?php echo url::get();?>"
			              }
	               	 });
			}

			function changeStatus(id){
				$.get("<?php echo url::s('admin/shop/changeStatus','id=');?>" + id, function(result){
	               	 if(result.code == '200'){
			            	//swal("操作提示", result.msg, "success")
			              	//setTimeout(function(){location.href = '';},1500);
		               		location.href = "<?php echo url::get();?>"
			              }
	               	 });
			}

			function del(id){
		              swal({
		                title: "危险提示", 
		                text: "你确定要删除该商品吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除它!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/shop/delete','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success")
				              	setTimeout(function(){location.href = '<?php echo url::get();?>';},1500);
				              }else{
				            	swal("操作提示", result.msg, "error")
				              }
		                	    
		                	  });
		              });		
			}

			function allStatus(){
				swal({
	                title: "警告提醒", 
	                text: "如果将这些商品全部停止销售，会员就无法购买这些商品，如果是已经停售过的会更改为正常出售状态，是否继续？", 
	                type: "warning", 
	                showCancelButton: true, 
	                confirmButtonColor: "#DD6B55", 
	                confirmButtonText: "是的,我要操作这些商品!", 
	                closeOnConfirm: false 
	              },
	              function(){
			           $("input[name='items']:checked").each(function(){
			        	 $.get("<?php echo url::s('admin/shop/changeStatus','id=');?>" + $(this).val(), function(result){
					            	swal("操作提示", '当前操作已经执行完毕!', "success");
					              	setTimeout(function(){location.href = '<?php echo url::get();?>';},1500);
			                	  });
			           });  
					  
	              });		
		}

			function deletes(){ 
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的商品吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些商品!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/shop/delete','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '<?php echo url::get();?>';},1500);
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