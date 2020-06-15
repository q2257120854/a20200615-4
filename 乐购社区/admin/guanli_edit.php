<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'guanli';
check_qx($site_qx,'管理权限');
$id=$_GET['id'];
if(isset($_POST['提交'])){
 $id1= implode(",",$_POST['qx']);
 $_data['qx'] = $id1;
	$_data['zt'] = $_POST['zt'];
	$_data['qq'] = $_POST['qq'];
	$_data['loginname'] = $_POST['user'];
	$_data['loginpassword'] = $_POST['pwd'];
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'guanli set '.arrtoupdate($_data).' where ID = '.$_GET['id'].' and zid = '.$zhu_id.'';
	#die($sql);
	if(mysql_query($sql)){
		alert_href('修改管理员成功!','guanli.php');
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
         <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <script src="assets/common/md5.min.js"></script>
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
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
 <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        修改管理员账号
                    </div>
 				<div class="panel-body">
						<form method="post" id="form">
							<input name="id" type="hidden" value="<?=$row['id']?>">
							<div class="form-group">                                <?php
					$result1 = mysql_query('select * from '.flag.'guanli where id = '.$id.' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
								<label class="col-lg-3 control-label">状态</label>
								<div class="col-lg-8">
									<select name="zt" id="zt" class="form-control">
										<option <?php if ($row['zt']==1) {echo "selected";}?>   value="1">启用</option>
										<option <?php if ($row['zt']==0) {echo "selected";}?> value="0">禁用</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">登录帐号</label>
								<div class="col-lg-8">
									<input name="user" type="text" id="user" placeholder="" readonly="readonly" value="<?=$row['loginname']?>" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">登录密码</label>
								<div class="col-lg-8">
									<input name="pwd" type="text" id="pwd" placeholder="" value="<?=$row['loginpassword']?>" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">QQ</label>
								<div class="col-lg-8">
									<input name="qq" type="text" id="qq" placeholder="" value="<?=$row['qq']?>" class="form-control">
								</div>
							</div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">权限</label>
                            <div class="col-sm-10">
                              
                              
                                    <label for="label2">权限管理：</label>
                          </dt>
						  <dd>
    <label>
        <input <?php if (strpos($row[ 'qx'], '公告管理') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="公告管理"><i>✓</i>公告管理</label>
    <label>
        <input <?php if (strpos($row[ 'qx'], '系统设置') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="系统设置"><i>✓</i>系统设置</label>
    <label>
        <input <?php if (strpos($row[ 'qx'], '站点装饰') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="站点装饰"><i>✓</i>站点装饰</label>
    <label>
        <input <?php if (strpos($row[ 'qx'], '客服管理') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="客服管理"><i>✓</i>客服管理</label>
    <label>
        <input <?php if (strpos($row[ 'qx'], '代理设置') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="代理设置"><i>✓</i>代理设置</label>
		
		<label>
        <input <?php if (strpos($row[ 'qx'], '克隆商品') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="克隆商品"><i>✓</i>克隆商品</label>
		<label>
        <input <?php if (strpos($row[ 'qx'], '幻灯图片') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="幻灯图片"><i>✓</i>幻灯图片</label>
    <label>
        <input <?php if (strpos($row[ 'qx'], '平台短信') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="平台短信"><i>✓</i>平台短信</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '分站短信') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="分站短信"><i>✓</i>分站短信</label>
</dd>
</dl>
<dl> <dt>
                            <label for="label2"></label>
                          </dt>
    <dd>
        <label>
            <input <?php if (strpos($row[ 'qx'], '商品管理') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="商品管理"><i>✓</i>商品管理</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '商品对接') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="商品对接"><i>✓</i>商品对接</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '商品被对接') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="商品被对接"><i>✓</i>商品被对接</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '分站管理') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="分站管理"><i>✓</i>分站管理</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '卡密管理') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="卡密管理"><i>✓</i>卡密管理</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '自由对接') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="自由对接"><i>✓</i>自由对接</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '自动发货') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="自动发货"><i>✓</i>自动发货</label>
        <label>
            <input <?php if (strpos($row[ 'qx'], '供货权限') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="供货权限"><i>✓</i>供货权限</label>
						<label>
            <input <?php if (strpos($row[ 'qx'], '管理权限') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="管理权限"><i>✓</i>管理权限</label>
    </dd>
</dl>
              
              	
                <dl style="display:none">
                          <dt>
                           </dt>
						  <dd>
 				<label><input  name="z_qx11" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx12" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx13" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx14" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx15" value="1"  type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx16" value="1"   type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx17" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx18" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx19" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx20" value="1" type="checkbox"><i>✓</i></label> 
             
                             </div>
                      </div>
					</div>
				</div><? }?>
				 <div class="panel-footer">
                        <input name="提交"  type="submit"  class="btn btn-info" id="提交" value="保存信息">
                    </div></form>
			</div>
		</div>
	</div>
</div>
<? include_once( 'footer.php'); ?>
 </body>
</html>
