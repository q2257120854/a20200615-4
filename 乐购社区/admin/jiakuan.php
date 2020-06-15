<?php 
$title='用户加款';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'member';

 

if(isset($_POST['提交'])){
	 null_back($_POST['point'],'请输入金额');
	 null_back($_POST['qk'],'请输入充值备注');

 if ($_POST['lx']==1)
 {    $xfhje =$_POST['m_point']+$_POST['point'];  }

 if ($_POST['lx']==0)
 {   $xfhje =$_POST['m_point']-$_POST['point'];   }
 $_data['point'] = $xfhje; 
   //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		
    $_data1['hyid'] = $_GET['id'];
	$_data1['hyname'] = $_POST['hyname'];
 	$_data1['xf_qje'] = $_POST['m_point'];
 	$_data1['xf_je'] = $_POST['point'];
 	$_data1['xf_hje'] = $xfhje;
 	$_data1['xf_date'] = $sj;
 	$_data1['xf_qk'] = $_POST['qk'];
 	$_data1['zid'] = $zhu_id;

  if ($_POST['lx']==1)
 {  	$_data1['xf_lx'] = 1;  }

 if ($_POST['lx']==0)
 {  	$_data1['xf_lx'] =0;  }
	
  	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
  		alert_href('操作成功!','member.php');
	}else{
		alert_back('操作失败!');
	}
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
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'user where ID = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form class="form-horizontal" method="post" id="form">
    <input name="m_point" type="hidden" value="<?=$row['point']?>">
    <input name="hyname" type="hidden" value="<?=$row['name']?>">
         <div class="row">
          <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                      用户加款
                    </div>
                     <div class="panel-body">
                            
 
 
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">操作类型</label>
                                        <div class="col-lg-8">
                                            <select  name="lx" class="form-control" id="lx" v-model="apiType">
                                                <option    value="1">充值</option>
                                                <option    value="0">扣除</option>
                                            
                                             </select>
                              </div>
                              </div>
              
              
              
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">余额(元)</label>
                                    <div class="col-lg-8">
                             <input name="" readonly type="text" class="form-control" id="s_name" placeholder=""  value="<?=$row['point']?>">

                                  </div>
                                </div>
                                 
                                 
                                 
                                 
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">金额(元)</label>
                                    <div class="col-lg-8">
                             <input name="point" type="text" class="form-control" id="" placeholder="请输入金额"  value="">

                                  </div>
                                </div>
                                 
             
              
                            
                                 
                                 
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">操作备注</label>
                                    <div class="col-lg-8">
                             <input name="qk" type="text" class="form-control" id="" placeholder="请输入操作备注"  value="">

                                  </div>
                                </div>
                                 
                               
                          
                             
                 
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回">
                    
                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="提交" value="加款">



</div>
                </div>
            </div>
        </div>
    </form>
 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->

</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?></body>
</html>
