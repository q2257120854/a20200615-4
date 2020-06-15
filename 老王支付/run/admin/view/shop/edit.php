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
        <li class="active">商品信息</li>
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
          修改商品信息
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

            
                
              <div class="form-group">
                  <label class="col-sm-2 control-label form-label">名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="shop_name"  placeholder="商品名称" value="<?php echo $result['name'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">描述</label>
                  <div class="col-sm-10">
                    <textarea rows="10" class="form-control form-control-line" name="description"  placeholder="商品描述"><?php echo $result['description'];?></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">单价</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="money"  placeholder="商品单价" value="<?php echo $result['money'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">成本</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="cost"  placeholder="商品成本价" value="<?php echo $result['cost'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">类型</label>
                  <div class="col-sm-10">
                   <select class="selectpicker" name="category" onchange="categoryUpdate(this);" disabled>
                      <optgroup label="请选择商品类型" >
                        <option value="1" <?php if ($result['category'] == 1) echo 'selected';?>>出售用户组</option>
                        <option value="2" <?php if ($result['category'] == 2) echo 'selected';?>>出售卡号卡密</option>
                        <option value="3" <?php if ($result['category'] == 3) echo 'selected';?>>出售商品货物</option>
                      </optgroup>
                    </select>                             
                  </div>
                </div>
                
                <?php if ($result['category'] == 1){?>
                <div class="form-group" id="bind_special">
                  <label class="col-sm-2 control-label form-label">出售</label>
                  <div class="col-sm-10">
                   <select class="selectpicker" name="bind_special">
                      <optgroup label="请选择要出售的用户组" >
                      <?php foreach ($group as $gr){?>
                        <option value="<?php echo $gr['id'];?>" <?php if ($result['bind_special'] == $gr['id']) echo 'selected';?>><?php echo $gr['name'];?></option>
                      <?php }?>
                      </optgroup>
                    </select>                             
                  </div>
                </div>
                <?php }?>
                
                
                <?php if ($result['category'] == 2 || $result['category'] == 3){?>
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">规则</label>
                  <div class="col-sm-10">
<textarea rows="6" class="form-control form-control-line" name="discount"  placeholder="批发优惠规则"><?php 
$discount = json_decode($result['discount'],true);
foreach ($discount as $dc){
    echo $dc['num'] . ',' . $dc['money'] .PHP_EOL;
}
?></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">限购</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="restriction"  placeholder="限制购买数量或次数" value="<?php echo $result['restriction'];?>">
                  </div>
                </div>
                <?php }?>
                
                <?php if ($result['category'] == 3){?>
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">库存</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="warehouse"  placeholder="库存数量" value="<?php echo $result['warehouse'];?>">
                  </div>
                </div>
                <?php }?>
                    
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/shop/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
  
    <script type="text/javascript">
			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/shop/edit',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success");
			              }else{
			            	  swal("操作提示", data.msg, "error");
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