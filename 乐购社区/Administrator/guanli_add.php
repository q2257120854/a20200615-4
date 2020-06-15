 <?php 
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){

  	$w_name = $_POST['w_name']; 
  	$w_password = $_POST['w_password']; 
  	$w_num = (int)($_POST['w_num']); 
		$b_num = (int)($_POST['b_num']); 
   	null_back($_POST['w_name'],'请输入登录账号');
	null_back($_POST['w_password'],'请输入登录密码');
 		 

   	$_data['a_name'] = $w_name;
   	$_data['a_password'] = md5($w_password);
    $_data['a_num'] = $w_num;
	$_data['b_num'] = $b_num;
	$_data['qx'] = $_POST['qx'];
	
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'admin ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
    	alert_href('添加成功!','');
	} else {
		alert_back('添加失败!');
	}

}

 ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="file/main/js/util/AjaxUtil.js"></script>
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<script type="text/javascript" src="file/main/js/util/CheckBoxUtil.js"></script>
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
 <link rel="stylesheet" href="../editor/themes/default/default.css" />
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../ui/ui.js"></script>
<script type="text/javascript" src="../js/admin.js"></script>
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>

 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#d_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#site_logo').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#site_logo').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	K('#slideshow').click(function() {
		editor.loadPlugin('multiimage', function() {
			editor.plugin.multiImageDialog({
				clickFn : function(urlList) {
					var tem_val = '';
					var tem_s = '';
					K.each(urlList, function(i, data) {
						tem_val = tem_val + tem_s + data.url;
						tem_s = '|';
					});
					K('#d_slideshow').val(tem_val);
					editor.hideDialog();
				}
			});
		});
	});
	K('#download1').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#download_url1').val(),
				clickFn : function(url, title) {
					K('#download_url1').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
	K('#download2').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#download_url2').val(),
				clickFn : function(url, title) {
					K('#download_url2').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
		K('#download3').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#download_url3').val(),
				clickFn : function(url, title) {
					K('#download_url3').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
		K('#download4').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#download_url4').val(),
				clickFn : function(url, title) {
					K('#download_url4').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
});
</script>	
<style type="text/css">
.tab_lixiao{height: 33px;white-space: nowrap;width:105px;}
.tab_lixiao a{display:block; padding:0 28px; color:#3975c0;height: 33px; line-height: 33px;float: left;margin-top:8px;z-index: 999;}
.tab_lixiao .on{border: 1px solid #b4d1f5;border-bottom:1px solid #f4f4f4;}
</style>
<body>
<div id="body">
		<div class="zl-tab-hd">
			<table width="100%"  cellpadding="0" cellspacing="0" id="mainTab">
				<tr>
					<td style="width:30px;">&nbsp;</td>
					<td class="tab_lixiao"><a name="tab" id="1" href="javascript:void(0);" class="on">下级配置</a></td>
			 
					<td>&nbsp;</td>
				</tr>
			</table>
		
		</div>
		<div id="box">
          <form action="" method="post">
            <div class="zl-tab-bd">
              <div class="zl-dd">
                
	<form action="" method="post" class="form form-horizontal" >
      
      
      
        <dl>
                <dt>
                  <label for="label2">登录账号：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  placeholder="登录账号信息"  name="w_name" id="w_name"/>
                </dd>
		      </dl>
              <dl>
			  
                <dt>
                  <label for="label2">登录密码：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  placeholder="登录密码信息" name="w_password" id="w_password"/>
                </dd>
		      </dl>
              
                <dl>
                <dt>
                  <label for="label2">主站额度：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  placeholder="搭建主站额度" name="w_num" id="w_num"/>
              </dd>
		      </dl>
			  
			  <dl>
                <dt>
                  <label for="label2">分销额度：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  name="b_num" id="b_num" value="<?=$row['b_num']?>"/>
               </dd>
		      </dl>
			  
			  <dl>
                          <dt>
                            <label for="label2">权限设置：</label>
                          </dt>
						  <dd>
						    <label>
                            <select name="qx" id="qx"  style="height:25PX">
							<option value="0">分销</option>
							<option value="1">外包</option>
                             </select>
                            </label>
                          </dd>
			  </dl>
             
			  		<dl>
							<dt></dt>
							<dd class="baocun"><input name="提交" type="submit" class="btn btn-primary radius" value="添加">
		  </div>
		</div>
	</form>

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