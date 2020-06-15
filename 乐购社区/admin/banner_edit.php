<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'banner';
 

 if ($_POST['提交']=='修改')
{
	

	 null_back($_POST['name'],'请输入幻灯片标题');
	 null_back($_POST['url'],'请输入幻灯片链接');
	 null_back($_POST['pic'],'请上传幻灯片图片');
     null_back($_POST['border'],'排序必须是数字');
	
	$_data['name'] = $_POST['name'];
	$_data['url'] = $_POST['url'];
	$_data['pic'] = $_POST['pic'];
	$_data['border'] = $_POST['border'];
      $_data['zid'] = $zhu_id;
      $_data['fid'] = 0;

 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'banner set '.arrtoupdate($_data).' where id = '.$_POST['id'].' and zid ='.$zhu_id.' ';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_href('修改失败!','');
	}	
}

 


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
      <title>修改幻灯片</title>
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
					$result = mysql_query('select * from '.flag.'banner  where id = '.$_GET['id'].'  and zid = '.$zhu_id.'');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="Xiaoyewl_Form" name="Xiaoyewl_Form">
    <input name="id" type="hidden" value="<?=$row['ID']?>">
      <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">

                        修改幻灯
                    </div>
                    <div class="panel-body">                        <form class="form-horizontal" id="form-banner">
    <input name="id" type="hidden" value="20">
                            <div class="form-group">

                                  <label class="col-lg-3 control-label">幻灯片标题</label>
                                    <div class="col-lg-8">
                                      <input name="name" type="text" class="form-control" placeholder="幻灯片标题"   value="<?=$row['name']?>">

                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">幻灯片链接</label>
                                    <div class="col-lg-8">
                                      <input name="url" type="text" class="form-control" placeholder="幻灯片链接"   value="<?=$row['url']?>">

                                    </div>
                                </div>
                                
                               <div class="form-group">
                                    <label class="col-lg-3 control-label">图片地址</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input name="pic" id="s_pic"  value="<?=$row['pic']?>" type="text" class="form-control" placeholder="输入图片地址">
                                            <div class="input-group-btn">
                                                <button type="button" id="upload-image" class="btn btn-success no-shadow upload_btn">上传
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                    
                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">排序</label>
                                    <div class="col-lg-8">
                             <input type="text" name="border" placeholder="排序" value="<?=$row['border']?>" class="form-control">
                                    </div>
                                </div>
                                                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                                                                             <input name="提交"  onclick="javascript:history.back(-1);" type="submit"  class="an-btn an-btn-danger" id="提交" value="返回管理">
                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="" value="保存信息">
</div>
                </div>
            </div>
         
    </form>
    <? }?>
</div>

        </div>
    </div><!-- /main-container -->

 
  <? include_once('footer.php');
?></body>
</html>
