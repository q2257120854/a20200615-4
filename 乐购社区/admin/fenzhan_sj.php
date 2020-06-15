<?php 
$title='分站升级';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhan';
check_qx($site_qx,'分站管理');
if(isset($_POST['提交'])){
	 null_back($_POST['f_id'],'请选择要升级的版本');
  if ($_POST['f_id']=="1")
 {   $fen_edu = $site_fed1; }
 elseif ($_POST['f_id']=="2")
 {   $fen_edu = $site_fed2; } 
  elseif ($_POST['f_id']=="3")
 {   $fen_edu = $site_fed3; }

   if ($fen_edu <1)
 {		alert_back('升级失败:额度不足!'); }
 else {
 
 
 
 
  $_data['banben'] = $_POST['f_id']; 
 
  $str = arrtoinsert($_data);
  $sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and  zid = '.$zhu_id.'';
  if(mysql_query($sql)){
	  
	  
	  
		//额度记录
	$_data3['zid'] = $zhu_id;
 	$_data3['qsl'] = $fen_edu;	
	$_data3['sl'] = 1;
 	$_data3['hsl'] = $fen_edu-1;
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '升级'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';
 	$_data3['lx'] = 0; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	if ($_POST['f_id']==1)
   	{$_data4['fed1'] = $fen_edu-1;   }
	if ($_POST['f_id']==2)
   	{$_data4['fed2'] = $fen_edu-1;   }
	if ($_POST['f_id']==3)
   	{$_data4['fed3'] = $fen_edu-1;   }		
 	$str4 = arrtoinsert($_data4);
	$sql4 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data4).' where id = '.$zhu_id.'';
	  mysql_query($sql4);
 	  
   		alert_href('升级成功!','fenzhan.php');
	}else{
		alert_back('升级失败!');
	}
		}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>
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
					$result1 = mysql_query('select * from '.flag.'fenzhan where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form method="post" id="form">
                 <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        升级分站版本
                    </div>
                    <div class="panel-body">
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">当前版本</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="  <?=get_fenzhan_banben_name($row['banben'])?>" readonly>
   
                              </div>
                              </div>
             
               
                                 
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">升级版本</label>
                                    <div class="col-lg-8">
<select  name="f_id" class="form-control" id="lx" v-model="apiType">
                                                   <option    value="" >请选择要升级的版本</option>
<? if ($row['banben']==1) {?>
                                                   <option    value="2" ><?=get_fenzhan_banben_name(2)?> 剩余(<?=$site_fed2?>)个</option>
                                                <option    value="3" ><?=get_fenzhan_banben_name(3)?> 剩余(<?=$site_fed3?>)个</option>
                         <? }?>  
                         
                         <? if ($row['banben']==2) {?>
                                                 <option    value="3" ><?=get_fenzhan_banben_name(3)?> 剩余(<?=$site_fed3?>)个</option>
                         <? }?>  
                                          
                                             </select>
                                  </div>
                                </div>
              
              
                                                     
                             
                             
                              
                        </div>    </div>    </div>   
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回分站">
                    
                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="提交" value="升级分站">



</div>
                </div>
            </div>
        </div>
    </form>
 
 <? }?>
</div></div>
</div>
        </div>
    </div><!-- /main-container -->

 


 
  <? include_once('footer.php');
?></body>
</html>
