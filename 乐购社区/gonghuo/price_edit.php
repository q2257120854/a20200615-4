<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'price';
check_qx($site_qx,'商品管理');
 

if(isset($_POST['提交'])){
 
	 null_back($_POST['name'],'请输入模板名称');
  	non_numeric_back($_POST['p1'],'请输入'.$site_level1_name.'加价');
  	non_numeric_back($_POST['p2'],'请输入'.$site_level2_name.'加价');
  	non_numeric_back($_POST['p3'],'请输入'.$site_level3_name.'加价');
  	non_numeric_back($_POST['p4'],'请输入'.$site_level4_name.'加价');
  	non_numeric_back($_POST['p5'],'请输入'.$site_level5_name.'加价');
	
	
	$_data['p_name'] = $_POST['name'];
	$_data['p_level1'] = $_POST['p1'];
 	$_data['p_level2'] = $_POST['p2'];
 	$_data['p_level3'] = $_POST['p3'];
 	$_data['p_level4'] = $_POST['p4'];
 	$_data['p_level5'] = $_POST['p5'];
    //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'price set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功!','price.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../ui/ui.js"></script>
<script type="text/javascript" src="../js/admin.js"></script>
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>

 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_pic').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_pic').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	 
 
	
	 
	
	 
	
	 
	
});

 </script>	

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'price where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
  <form id="addForm" method="post" class="form-horizontal"> 
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        修改定价
                    </div>
                     <div class="panel-body">


<div class="alert alert-success">此加价模板列表，是在你的拿货价格基础上进行加价！</div> <!----> 

 <div class="form-group"><label class="col-sm-3 control-label no-padding-right">模板名称</label> <div class="col-sm-9"><input type="text" name="name"   value="<?=$row['p_name']?>" placeholder="输入模板名称" class="form-control"></div></div> 
     
     
     <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level1_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">

     <input type="text" name="p1" placeholder="输入加价价格(元)" value="<?=$row['p_level1']?>" class="form-control">
     </div>
     </div>
     </div> 
       <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level2_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">

     <input type="text" name="p2" placeholder="输入加价价格(元)" value="<?=$row['p_level2']?>" class="form-control">
     </div>
     </div>
     </div> 
     
         <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level3_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     
     <input type="text" name="p3" placeholder="输入加价价格(元)" value="<?=$row['p_level3']?>"  class="form-control">
     </div>
     </div>
     </div> 
     
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level4_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">

     <input type="text" name="p4" placeholder="输入加价价格(元)" value="<?=$row['p_level4']?>" class="form-control">
     </div>
     </div>
     </div> 
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level5_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <input type="text" name="p5" placeholder="输入加价价格(元)" value="<?=$row['p_level5']?>"  class="form-control">
     </div>
     </div>
     </div>     
     
     
  
     
     
      </div><div class="modal-footer"><button type="button" data-dismiss="modal" onclick="javascript:history.back(-1);" class="btn btn-white">返回首页</button>
     
     <input name="提交" type="submit"  class="btn btn-primary" value="修改信息">  </div></div></div></div>
   



        </div></form>
 

 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->

   </div>
                      </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>

</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
