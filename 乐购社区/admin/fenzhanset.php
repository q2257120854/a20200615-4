<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhanset';
   check_qx($site_qx,'分站管理');
if(isset($_POST['提交'])){
	 null_back($_POST['f1'],'请输入'.get_fenzhan_banben_name(1).'的价格');
	 null_back($_POST['f2'],'请输入'.get_fenzhan_banben_name(2).'的价格');
	 null_back($_POST['f3'],'请输入'.get_fenzhan_banben_name(3).'的价格');
  
   $_data['fprice1'] = $_POST['f1']; 
   $_data['fprice2'] = $_POST['f2']; 
   $_data['fprice3'] = $_POST['f3']; 
     $_data['fnotice'] = $_POST['fnotice']; 

   $sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where ID ='.$zhu_id.'';
  mysql_query($sql);

  
  		alert_href('设置成功!','');
	 
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
 
 					 	 
    <form class="form-horizontal" method="post" id="form">
          <div class="row">
            <div class="col-md-6">
                          <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        分站设置
                    </div>
                     <div class="panel-body">
                          
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">公告设置</label>
                                    <div class="col-lg-8">
                                      <textarea name="fnotice" class="form-control" placeholder="请输入公告"><?=$site_fnotice?></textarea>

                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(1)?>价格</label>
                                    <div class="col-lg-8">
                             <input name="f1" type="text" class="form-control"  placeholder="请输入<?=get_fenzhan_banben_name(1)?>价格"  value="<?=get_fenzhan_price($zhu_id,'fprice1')?>">

                                  </div>
                                </div>
              
              
                     <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(2)?>价格</label>
                                    <div class="col-lg-8">
                             <input name="f2" type="text" class="form-control"  placeholder="请输入<?=get_fenzhan_banben_name(2)?>价格"  value="<?=get_fenzhan_price($zhu_id,'fprice2')?>">

                                  </div>
                                </div>


                     <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(3)?>价格</label>
                                    <div class="col-lg-8">
                             <input name="f3" type="text" class="form-control"  placeholder="请输入<?=get_fenzhan_banben_name(3)?>价格"  value="<?=get_fenzhan_price($zhu_id,'fprice3')?>">

                                  </div>
                                </div>
              
              
              

               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回">
                    
                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="提交" value="修改">



</div>
                </div>
            </div>
        </div>
    </form>
 
  
</div>

        </div>
    </div><!-- /main-container -->


 
</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?></body>
</html>
