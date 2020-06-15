<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'price';

 

if(isset($_POST['提交'])){
 
	 null_back($_POST['name'],'请输入模板名称');
  	non_numeric_back($_POST['p1'],'请输入'.$site_level1_name.'加价');
  	non_numeric_back($_POST['p2'],'请输入'.$site_level2_name.'加价');
  	non_numeric_back($_POST['p3'],'请输入'.$site_level3_name.'加价');
  	non_numeric_back($_POST['p4'],'请输入'.$site_level4_name.'加价');
  	non_numeric_back($_POST['p5'],'请输入'.$site_level5_name.'加价');
	non_numeric_back($_POST['kind'],'请输入加价方式');
	
	$_data['p_name'] = $_POST['name'];
	$_data['p_level1'] = $_POST['p1'];
 	$_data['p_level2'] = $_POST['p2'];
 	$_data['p_level3'] = $_POST['p3'];
 	$_data['p_level4'] = $_POST['p4'];
 	$_data['p_level5'] = $_POST['p5'];
	$_data['kind'] = $_POST['kind'];
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
    <title>修改定价</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   
    <link rel="shortcut icon" href="assets/favicon.ico"/>
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
  include('left.php');
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'price where id = '.$_GET['id'].' and zid = '.$zhu_id.' and fid ='.$fen_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
  <form id="addForm" method="post" class="form-horizontal"> 
        <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">修改等级名称</div>
                    <div class="smart-widget-inner">
                        <div class="smart-widget-body">
                            <div class="form-horizontal">


<div class="alert alert-success">此加价模板列表，是在你的拿货价格基础上进行加价！</div> <!----> 

 <div class="form-group"><label class="col-sm-3 control-label no-padding-right">模板名称</label> <div class="col-sm-9"><input type="text" name="name"   value="<?=$row['p_name']?>" placeholder="输入模板名称" class="form-control"></div></div> 
     
     <div class="form-group">
                                <label class="col-sm-3 control-label">加价方式</label>
                                <div class="col-sm-9">
                                    <select name="kind" class="form-control" v-model="storeInfo.kind">
                                        <option value="0" <? if($row['kind']==0) {echo "selected";}?>>固定单价加价</option>
                                        <option value="1" <? if($row['kind']==1) {echo "selected";}?>>百分比加价</option>
                                    </select>
                                </div>
                            </div> 
     <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level1_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon">+</span> 
     <input type="text" name="p1" placeholder="输入加价价格(元)" value="<?=$row['p_level1']?>" class="form-control">
     </div>
     </div>
     </div> 
       <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level2_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon">+</span> 
     <input type="text" name="p2" placeholder="输入加价价格(元)" value="<?=$row['p_level2']?>" class="form-control">
     </div>
     </div>
     </div> 
     
         <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level3_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon">+</span> 
     <input type="text" name="p3" placeholder="输入加价价格(元)" value="<?=$row['p_level3']?>"  class="form-control">
     </div>
     </div>
     </div> 
     
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level4_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon">+</span> 
     <input type="text" name="p4" placeholder="输入加价价格(元)" value="<?=$row['p_level4']?>" class="form-control">
     </div>
     </div>
     </div> 
     
     
          <div class="form-group">
     <label class="col-sm-3 control-label no-padding-right"><?=$site_level5_name?>加价</label> 
     <div class="col-sm-9">
     <div class="input-group">
     <span class="input-group-addon">+</span> 
     <input type="text" name="p5" placeholder="输入加价价格(元)" value="<?=$row['p_level5']?>"  class="form-control">
     </div>
     </div>
     </div>     
     
     
  
     
     
      </div><div class="modal-footer"><button type="button" data-dismiss="modal" onclick="javascript:history.back(-1);" class="btn btn-white">返回</button>
     
     <input name="提交" type="submit"  class="btn btn-primary" value="修改">  </div></div></div></div>
   



        </div></form>
 

 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->

   </div>

 <? include('footer.php');
?>
</div><!-- /wrapper -->

<?  include('password.php');?>
 
  </body>
</html>
