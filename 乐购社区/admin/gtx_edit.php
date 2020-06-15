<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kefu';
  

if(isset($_POST['客服'])){
	 null_back($_POST['remark'],'请输入备注');
 	
	
	$_data['desc'] = $_POST['remark'];
  	$_data['dates'] = $sj;
//$_data['c_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'suptx set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('操作成功!','gtx.php');
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
    <script src="assets/common/md5.min.js"></script>
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
					$result = mysql_query('select * from '.flag.'suptx where id = '.$_GET['id'].' and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
    <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        供应商提现
                    </div>
                     <div class="panel-body">
    <form  class="form-horizontal" method="post" id="form">
                 <div class="form-group">
                                  <label class="col-lg-3 control-label">备注</label>
                                    <div class="col-lg-8">
                             <input type="text" name="remark" placeholder="请输入备注" value="<?=$row['desc']?>" class="form-control">

                                    </div>
                                </div>
                                
                                        
                                
                           
                              
                              
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回管理">
                                                         <input name="客服"  type="submit"  class="btn btn-primary" id="客服" value="确定">



</div>



    </form>  </div>
    <? }?>
</div>

        </div>   </div>   </div>   </div>
    </div><!-- /main-container -->

   </div>   


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
