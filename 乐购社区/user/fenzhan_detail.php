<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhan';
check_qx($site_qx,'分站管理');
 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>分站资料</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
      
  


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
					$result1 = mysql_query('select * from '.flag.'fenzhan where id = '.$_GET['id'].' and zid ='.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form method="post" id="form">
 <input name="f_id" type="hidden" value="<?=$row['banben']?>">
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">【<?=$row['name']?>】分站资料</div>
                    <div class="smart-widget-inner">
                        
                            
                                
                                
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
 

                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站状态</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="<? if ($row['zt']==1) {echo '启用';} else {echo '停止';}?>" readonly>
   
                              </div>
                              </div>



                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站版本</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="  <?=get_fenzhan_banben_name($row['banben'])?>" readonly>
   
                              </div>
                              </div>
             
               
                                  
              
              
                                                           <div class="form-group">
                                  <label class="col-lg-3 control-label">分站域名</label>
                                   <div class="col-lg-8">
                            <input name="f_url" type="text"    readonly   class="form-control"  placeholder="请输入分站域名"  value="<?=$row['url']?>.<?=$row['url1']?>">
                              
                                

                                  </div>
                                </div>
              
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">站长QQ</label>
                                    <div class="col-lg-8">
                             <input name="f_qq" type="text" class="form-control"  readonly  placeholder="请输入站长QQ"  value="<?=$row['qq']?>">

                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">站点名称</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['name']?>">

                                  </div>
                                </div>
								
                    </div>    </div>    </div>   
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                    
                                                    



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
