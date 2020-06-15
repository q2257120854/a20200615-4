<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'member';

 

if(isset($_POST['提交'])){
 
	$_data['level'] = $_POST['m_level'];
	$_data['qq'] = $_POST['m_qq'];
	if ($_POST['m_password']!='') {
	$_data['password'] = md5($_POST['m_password']);
	}
   //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改会员成功!','member.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>修改会员</title>
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
					$result1 = mysql_query('select * from '.flag.'user where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form method="post" id="form">
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine"><?=$row['name']?>[编号:<?=$row['ID']?>]-用户详情</div>
                    <div class="smart-widget-inner">
                        
                            
                                
                                
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
 
                      
                            
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">编号</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['ID']?>">

                                  </div>
                                </div>
                                
                                
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label">用户名</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['name']?>">

                                  </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">注册时间</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder=""   readonly value="<?=$row['date']?>">

                                  </div>
                                </div>
                                
                                
                                   
                                
                                <div class="form-group">
                                <label class="col-lg-3 control-label">余额</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?=$row['point']?>" disabled="">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                                
                                
                                
                              
                                
                                  <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">用户等级</label>
                                        <div class="col-lg-8">
                                            <select  name="m_level" class="form-control" id="m_level" v-model="apiType">
     <option  <? if ($row['level']==1) {echo "selected";}?>   value="1"> <?=$site_level1_name?> </option>
     <option  <? if ($row['level']==2) {echo "selected";}?>   value="2"> <?=$site_level2_name?> </option>
     <option  <? if ($row['level']==3) {echo "selected";}?>   value="3"> <?=$site_level3_name?> </option>
     <option  <? if ($row['level']==4) {echo "selected";}?>   value="4"> <?=$site_level4_name?> </option>
     <option  <? if ($row['level']==5) {echo "selected";}?>   value="5"> <?=$site_level5_name?> </option>
                                         
 
 
                                             </select>
                                    </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">QQ</label>
                                    <div class="col-lg-8">
                             <input name="m_qq" type="text" class="form-control" id="s_name" placeholder=""    value="<?=$row['qq']?>">

                                  </div>
                                </div>
                       
                       
                                                        <div class="form-group">
                                  <label class="col-lg-3 control-label">密码</label>
                                    <div class="col-lg-8">
                             <input name="m_password" type="text" class="form-control" id="s_name" placeholder="不修改则为空"    value="">

                                  </div>
                                </div>
                       
                                
                                
                                
                                </div>
                                
                                
                                 
                                
                                
                            </div>
                        </div>     
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         
                                                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
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
