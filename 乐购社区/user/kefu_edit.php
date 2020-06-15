<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kefu';
check_qx($site_qx,'客服管理');
 

if(isset($_POST['客服'])){
	 null_back($_POST['k_name'],'请输入客服名称');
	 null_back($_POST['k_qq'],'请输入客服QQ');
   	non_numeric_back($_POST['k_order'],'排序必须是数字');
	
	
	$_data['name'] = $_POST['k_name'];
	$_data['qq'] = $_POST['k_qq'];
 	$_data['k_order'] = $_POST['k_order'];
//$_data['c_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'kefu set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('修改客服成功!','kefu.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>修改客服</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
					$result = mysql_query('select * from '.flag.'kefu where id = '.$_GET['id'].' and zid = '.$zhu_id.'  and fid = '.$fen_id.' ');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">修改客服</div>
                    <div class="smart-widget-inner">
                        
                            
                                
                                
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">名称</label>
                                    <div class="col-lg-8">
                             <input type="text" name="k_name" placeholder="请输入客服名称" value="<?=$row['name']?>" class="form-control">

                                    </div>
                                </div>
                                
                                          <div class="form-group">
                                  <label class="col-lg-3 control-label">QQ</label>
                                    <div class="col-lg-8">
                             <input type="text" name="k_qq" placeholder="请输入客服QQ" value="<?=$row['qq']?>" class="form-control">

                                    </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">排序</label>
                                    <div class="col-lg-8">
                             <input type="text" name="k_order" placeholder="请输入客服排序" value="<?=$row['k_order']?>" class="form-control">

                                    </div>
                                </div>
                          
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                                                         <input name="客服"  type="submit"  class="btn btn-primary" id="客服" value="更新">



</div>
                </div>
            </div>
        </div>
    </form>
    <? }?>
</div>

        </div>
    </div><!-- /main-container -->



 <? include('footer.php');
?>
 

<?  include('password.php');?>
 
  </body>
</html>
