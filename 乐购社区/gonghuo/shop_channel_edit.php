<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shopchannel';
check_qx($site_qx,'商品管理');
 

if(isset($_POST['分类'])){
	 null_back($_POST['c_name'],'请输入分类名称');
  	non_numeric_back($_POST['c_order'],'排序必须是数字');
	
	
	$_data['name'] = $_POST['c_name'];
	$_data['corder'] = $_POST['c_order'];
 	$_data['zt'] = $_POST['c_zt'];
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop_channel set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改分类成功!','shop_channel.php');
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
					$result = mysql_query('select * from  '.flag.'shop_channel where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
         <div class="row">
                        <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                      商品分类
                    </div>
                     <div class="panel-body">
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">分类名称</label>
                                    <div class="col-lg-8">
                             <input type="text" name="c_name" placeholder="请输入分类名称" value="<?=$row['name']?>" class="form-control">

                                    </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">排序</label>
                                    <div class="col-lg-8">
                             <input type="text" name="c_order" placeholder="请输入分类排序" value="<?=$row['corder']?>" class="form-control">

                                    </div>
                                </div>
                          
                                  <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分类状态</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  name="c_zt">
                                                <option  <? if ($row['zt']==0) {echo "selected";}?> value="0">禁用</option>
                                                <option  <? if ($row['zt']==1) {echo "selected";}?> value="1">启用</option>
                                            </select>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
        
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                                                         <input name="分类"  type="submit"  class="btn btn-primary" id="分类" value="保存信息">



</div>
                </div>
            </div>
        </div>
    </form>
    <? }?>
</div>
</div>
          </div>
    </div></div></div>
        </div>
    </div><!-- /main-container -->



 <? include('footer.php');
?>
</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
