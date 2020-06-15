<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'gongdan';
 

 if(isset($_POST['提交'])){
	 if($_SESSION['gly'])alert_href('失败!你无权限删除','');
	 null_back($_POST['huifu'],'请回复工单内容');
	
	$_data['huifu'] = $_POST['huifu'];
	$_data['zhuangtai'] = '1';
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'gongdan set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('回复工单成功!','gongdan.php');
	}else{
		alert_back('回复工单失败!');
	}
}




 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>处理工单 - <?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
 
     <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	
	var editor = K.editor({
	allowFileManager : false,
	allowPreviewEmoticons : false				});
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

<div class="wrapper preload">
<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
<?php
					$result = mysql_query('select * from '.flag.'gongdan  where id = '.$_GET['id'].'  and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="Xiaoyewl_Form" name="Xiaoyewl_Form">
    <input name="id" type="hidden" value="<?=$row['id']?>">
         <div class="row">
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">处理工单</div>
                    <div class="smart-widget-inner">
                        <div class="smart-widget-hidden-section">
                        </div>
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                    
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">工单标题</label>
                                    <div class="col-lg-8">
                                      <input name="name" type="text" class="form-control" placeholder="工单标题"   value="<?=$row['name']?>" disabled="">

                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">工单内容</label>
                                    <div class="col-lg-8">
                                      <textarea name="neirong" type="text" class="form-control" placeholder="工单内容" disabled=""><?=$row['neirong']?></textarea>

                                    </div>
                                </div>
                                
                                
                                    
                                
                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">管理回复</label>
                                    <div class="col-lg-8">                                     
                                      <textarea name="huifu" type="text" class="form-control" placeholder="请处理工单内容信息"><?=$row['huifu']?></textarea>
                                    </div>
                                </div>
                                
 
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                                                                             <input name="提交"  onclick="javascript:history.back(-1);" type="submit"  class="an-btn an-btn-danger" id="提交" value="返回">

                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="save_btn" value="修改">



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
