<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'messages';
check_qx($site_qx,'分站短信');
 

if(isset($_POST['提交'])){
  	
	 null_back($_POST['n_content'],'请输入公告内容');
 
   	non_numeric_back($_POST['n_order'],'排序必须是数字');
	
	
	$_data['content'] = $_POST['n_content'];
	$_data['name'] = $_POST['n_name'];
	$_data['norder'] = $_POST['n_order']; 	
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'messages set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('修改成功!','messages.php');
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
<link rel="shortcut icon" href="<?=$site_ico?>"/>  
  <script src="assets/common/md5.min.js"></script>
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
					$result = mysql_query('select * from '.flag.'messages  where id = '.$_GET['id'].'  and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
                   <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       修改公告
                    </div>
                     <div class="panel-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">短信标题</label>
                                    <div class="col-lg-8">
                                      <textarea name="n_name" class="form-control" placeholder="短信标题"><?=$row['name']?></textarea>

                                    </div>
                                </div>
                              
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">短信内容</label>
                                    <div class="col-lg-8">
                                      <textarea name="n_content" class="form-control" placeholder="短信内容"><?=$row['content']?></textarea>

                                    </div>
                                </div>
                                
                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">排序</label>
                                    <div class="col-lg-8">
                             <input type="text" name="n_order" placeholder="排序" value="<?=$row['norder']?>" class="form-control">

                                    </div>
                                </div>
                                

                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">发布时间</label>
                                    <div class="col-lg-8">
                             <input type="text" name="" placeholder="发布时间" value="<?=$row['date']?>" readonly class="form-control">

                                    </div>
                                </div>
                                
                              
                                </div>
                            </div>
                  <div class="panel-footer">                                                      
                    <input name="按钮" onclick="javascript:history.back(-1);" type="button" class="btn btn-success" id="提交" value="返回信息">

                    <input name="提交"  type="submit"  class="btn btn-info pull-righ" id="提交" value="修改公告">


</div>
</div>
                </div>
            </div>

    </form>
    <? }?>
</div>
                   </div>
                    </div>
                </div>
      
</div><!-- /wrapper -->


 
  </body>
</html>
