<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'notice';
check_qx($site_qx,'公告管理');
 

if(isset($_POST['提交'])){
  	
	 null_back($_POST['n_content'],'请输入公告内容');
 
   	non_numeric_back($_POST['n_order'],'排序必须是数字');
	
	
	$_data['content'] = $_POST['n_content'];
	$_data['norder'] = $_POST['n_order']; 	
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'notice set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('修改成功!','notice.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>修改公告</title>
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
					$result = mysql_query('select * from '.flag.'notice  where id = '.$_GET['id'].'  and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">修改公告</div>
                    <div class="smart-widget-inner">
                        
                            
                                
                                
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">公告内容</label>
                                    <div class="col-lg-8">
                             <input type="text" name="n_content" placeholder="公告内容" value="<?=$row['content']?>" class="form-control">

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
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                                                                             <input name="提交"  onclick="javascript:history.back(-1);" type="submit"  class="btn btn-" id="提交" value="返回">

                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="修改">



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
</div><!-- /wrapper -->

<?  include('password.php');?>
 
  </body>
</html>
