<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'duijie';
check_qx($site_qx,'商品对接');
 

if(isset($_POST['分类'])){
	
	 null_back($_POST['c_name'],'请输入名称');
	 null_back($_POST['loginname'],'请输入登录账号');
	 null_back($_POST['loginpassword'],'请输入登录密码');
	 null_back($_POST['url'],'请输入网址');
 	
	
		 //检测主站域名
	 	$result = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$_POST['url'].'"  and zid ='.$zhu_id.' ');
					if ($row = mysql_fetch_array($result)){
		alert_back('操作失败:不可对接自身!!');
					}


	$_data['name'] = $_POST['c_name'];
	$_data['loginname'] = $_POST['loginname'];
 	$_data['loginpassword'] = $_POST['loginpassword'];
 	$_data['pingtai'] = $_POST['pingtai'];
 	$_data['url'] = $_POST['url'];

 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'duijie set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改对接账户成功!','duijie.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



<div class="wrapper preload">
 
<?
 include('header.php');
  include('left.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
<?php
					$result = mysql_query('select * from  '.flag.'duijie where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
       <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        社区对接信息
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-agent">

                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">社区名称</label>
                                    <div class="col-lg-8">
                             <input type="text" name="c_name" placeholder="请输入分类名称" value="<?=$row['name']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                                
                                  <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">对接平台</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="pingtai">
                                                <option  <? if ($row['pingtai']==1) {echo "selected";}?> value="1">同系统社区 </option>
                                                <option  <? if ($row['pingtai']==2) {echo "selected";}?> value="2">亿乐2.0社区</option>
                                                <option  <? if ($row['pingtai']==3) {echo "selected";}?> value="3">玖伍社区</option>
                                                   <option  <? if ($row['pingtai']==4) {echo "selected";}?> value="4">亿乐3.0社区</option>
												   <option  <? if ($row['pingtai']==5) {echo "selected";}?> value="5">聚梦社区</option>
                                            </select>
                                        </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">社区地址</label>
                                    <div class="col-lg-8">
                             <input type="text" name="url" placeholder="社区网站" value="<?=$row['url']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">登陆账号</label>
                                    <div class="col-lg-8">
                             <input type="text" name="loginname" placeholder="登陆账号或ID" value="<?=$row['loginname']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">登陆密码</label>
                                    <div class="col-lg-8">
                             <input type="text" name="loginpassword" placeholder="登陆密码或Key" value="<?=$row['loginpassword']?>" class="form-control">

                                    </div>
                                </div>
                                
                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回">
                                                         <input name="分类"  type="submit"  class="an-btn an-btn-success" id="分类" value="更新">



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
