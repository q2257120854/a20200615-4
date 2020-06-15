<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fztx';

 

if($_POST['提交']=='异常'){
 		 null_back($_POST['tx_qk'],'请输入异常反馈');
     $_data['zt'] = 2;  
	$_data['desc'] = $_POST['tx_qk'];
   $_data['cdate'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhantx set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}

if($_POST['提交']=='已转账'){
 		 null_back($_POST['tx_qk'],'请输入转账反馈');
     $_data['zt'] = 1;  
	$_data['desc'] = $_POST['tx_qk'];
   $_data['cdate'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhantx set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.' ';
	if(mysql_query($sql)){
		alert_href('操作成功!','');
	}else{
		alert_back('操作失败!');
	}
}


if($_POST['提交']=='驳回'){
 		 null_back($_POST['tx_qk'],'请输入驳回反馈');
     $_data['zt'] = 3;  
	$_data['desc'] = $_POST['tx_qk'];
   $_data['cdate'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhantx set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('操作成功!','');
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
					$result1 = mysql_query('select * from '.flag.'fenzhantx where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form class="form-horizontal" method="post" id="form">
 
 
         <div class="row">
            <div class="col-lg-6">
                              <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        提现处理
                    </div>
                     <div class="panel-body">
                            
 
   <div class="form-group">
                                  <label class="col-lg-3 control-label">提现状态</label>
                                    <div class="col-lg-8">
<? if ($row['zt']==0){echo "<font  color='red'  >待处理</font>";}?>
                    <? if ($row['zt']==1){echo "<font color='green' >已转账</font>";}?>
                    <? if ($row['zt']==2){echo "<font color='#999999' >异常</font>";}?>
                    <? if ($row['zt']==3){echo "<font  color='blue' >已驳回</font>";}?>
                                  </div>
                                </div>
                                
                      
                            
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">分站名称</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=get_fenzhan('name',$row['fid'])?>">

                                  </div>
                                </div>
                                
                                
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label">分站编号:</label>
                                    <div class="col-lg-8">
                             <input name="oid" type="text" class="form-control"  placeholder=""   readonly value="<?=$row['fid']?>">

                                  </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">提现金额</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['je']?>">

                                  </div>
                                </div>
                                
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">提现手续费</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['sxf']?>">

                                  </div>
                                </div>



      <div class="form-group">
                                  <label class="col-lg-3 control-label">收款方式</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['txfs']?>">

                                  </div>
                                </div>



      <div class="form-group">
                                  <label class="col-lg-3 control-label">收款账号</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['txzh']?>">

                                  </div>
                                </div>




      <div class="form-group">
                                  <label class="col-lg-3 control-label">收款姓名</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['txxm']?>">

                                  </div>
                                </div>
                                
                                
      <div class="form-group">
                                  <label class="col-lg-3 control-label">申请时间</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['date']?>
">

                                  </div>
                                </div>
                                
                                
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">处理时间</label>
                                    <div class="col-lg-8">
                             <input  type="text" class="form-control"  placeholder=""   readonly value="<?=$row['cdate']?>
">

                                  </div>
                                </div>
                                
 

 
                                
                                      <div class="form-group">
                                  <label class="col-lg-3 control-label">反馈</label>
                                    <div class="col-lg-8">
                     <textarea name="tx_qk" class="form-control" id="tx_qk" placeholder=""><?=$row['desc']?></textarea>

                                    </div>
                                </div>
                       
                       
                                                  
                                
                                


                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                         
                 
                         <input name="提交"  onclick="return confirm('您确定执行《已转账操作》?')" type="submit"  class="btn btn-info" id="提交" value="已转账">
					 
                     
                        <input name="提交"  onclick="return confirm('您确定执行《异常操作》?')" type="submit"  class="btn btn-success" id="提交" value="异常">
					 
                       <input name="提交"  onclick="return confirm('您确定执行《驳回操作》?')" type="submit"   style="background-color:RED" class="btn btn-warning" id="提交" value="驳回">
					 
                     
                     
 
                    
 


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
