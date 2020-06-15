<?php 
$title='客服管理';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
<?php
					$result = mysql_query('select * from '.flag.'kefu where id = '.$_GET['id'].' and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
    <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        客服信息修改
                    </div>
                     <div class="panel-body">
    <form  class="form-horizontal" method="post" id="form">
                 <div class="form-group">
                                  <label class="col-lg-3 control-label">客服名称</label>
                                    <div class="col-lg-8">
                             <input type="text" name="k_name" placeholder="请输入客服名称" value="<?=$row['name']?>" class="form-control">

                                    </div>
                                </div>
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">客服QQ</label>
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
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回管理">
                                                         <input name="客服"  type="submit"  class="an-btn an-btn-success" id="客服" value="保存信息">



</div>



    </form>  </div>
    <? }?>
</div>

        </div>   </div>   </div>   </div>
    </div><!-- /main-container -->

   </div>   


 
  <? include_once('footer.php');
?></body>
</html>
