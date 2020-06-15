 <?php 
require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
	$w_name = $_POST['w_name']; 
	$w_password = $_POST['w_password']; 
	$w_num = (int)($_POST['w_num']); 
	null_back($_POST['w_name'],'请输入登录账号');
  	//null_back($_POST['w_password'],'请输入登录密码');
	
	$_data['a_name'] = $w_name;
	if($_POST['w_password']){
		$_data['a_password'] = md5($w_password);
	}
    $_data['a_num'] = $w_num;
 
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'admin set '.arrtoupdate($_data).' where id = '.$_GET['id'].'  and upid = '.$a_ID.' ';
	if (mysql_query($sql)) {
  		alert_href('修改成功!','');
	} else {
		alert_back('修改失败!');
	}
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<script type="text/javascript" src="file/colorPicker/jquery.colorpicker.js"></script>
<style>  
label {font-size:12px;cursor:pointer;}  
label i {font-size:12px;font-style:normal;display:inline-block;width:12px;height:12px;text-align:center;line-height:12px;color:#fff;vertical-align:middle;margin:-2px 2px 1px 0px;border:#2489c5 1px solid;}  
input[type="checkbox"],input[type="radio"] {display:none;}  
input[type="radio"] + i {border-radius:7px;}  
input[type="checkbox"]:checked + i,input[type="radio"]:checked + i {background:#2489c5;}  
input[type="checkbox"]:disabled + i,input[type="radio"]:disabled + i {border-color:#ccc;}  
input[type="checkbox"]:checked:disabled + i,input[type="radio"]:checked:disabled + i {background:#ccc;}  
</style>  
   	<?php 
		$result = mysql_query('select * from '.flag.'admin where id = '.$_GET['id'].'');
		if ($row = mysql_fetch_array($result)){
	?>
	<form action="" method="post" class="form form-horizontal" >

      <body> 
<div id="body">
	<div class="zl-tab-bd">
		<div class="zl-dd">
 
          
             <dl>
                <dt>
                  <label for="label2">登录账号：</label>
                </dt>
 			    <dd>
                  <input class="txt1"  name="w_name" type="text" id="w_name"  value="<?=$row['a_name']?>"/>
                </dd>
		      </dl>
              
                <dl>
                <dt>
                  <label for="label2">登录密码：</label>
                </dt>
 			    <dd>
                  <input class="txt1"   type="text" name="w_password" type="text" id="w_password"  value="" placeholder="无修改不填写"/>
                                     </dd>
		      </dl>
              
                <dl>
                <dt>
                  <label for="label2">额度：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  name="w_num" id="w_num" value="<?=$row['a_num']?>"/>
               </dd>
		      </dl>
                        			  		<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" name="提交" type="submit" class="btn btn-primary radius" value="修改信息">
		  </div>
		</div>
	</form>
<?php }?>
</article>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:16
			},
			sex:{
				required:true,
			},
			mobile:{
				required:true,
				isMobile:true,
			},
			email:{
				required:true,
				email:true,
			},
			uploadfile:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>