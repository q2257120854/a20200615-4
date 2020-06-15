<?php
 require_once('admin_check.php');
require_once('admin_config.php');
if(isset($_POST['提交'])){

	null_back($_POST['a_name'],'请输入用户名');
if ($_POST['a_password']!= '')
{
$admin_password = md5($_POST['a_password']);
 }

else
{
$admin_password =$a_password;
}

	$_data['a_name'] = $_POST['a_name'];
	$_data['a_password'] = $admin_password;
      	$sql = 'update '.flag.'admin set '.arrtoupdate($_data).' where id = 1';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
}


 ?>
 


 




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密码修改</title>
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->

<!-- 选项卡元素 开始 -->
<script type="text/javascript" src="file/main/js/util/AjaxUtil.js"></script>
<!-- 选项卡元素 结束 -->

<!-- 表单元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->
<!-- 全选元素 开始 -->
<script type="text/javascript" src="file/main/js/util/CheckBoxUtil.js"></script>
<!-- 全选元素 结束 -->
<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<!-- 表单验证元素 结束 -->

<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
<!-- 弹窗元素 结束 -->

<!-- 对话框元素 开始 -->
<script src="/plugin/layer/layer.js"></script>
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


<!-- 对话框元素 结束 -->
<style type="text/css">
.tab_lixiao{height: 33px;white-space: nowrap;width:105px;}
.tab_lixiao a{display:block; padding:0 28px; color:#3975c0;height: 33px; line-height: 33px;float: left;margin-top:8px;z-index: 999;}
.tab_lixiao .on{border: 1px solid #b4d1f5;border-bottom:1px solid #f4f4f4;}
</style>
</head>

<body>
<div id="body">
		<div class="zl-tab-hd">
			<table width="100%" cellpadding="0" cellspacing="0" id="mainTab">
				<tr>
					<td style="width:30px;">&nbsp;</td>
					<td class="tab_lixiao"><a name="tab" id="99" href="javascript:void(0);" class="on">密码修改</a></td>
			 
					<td>&nbsp;</td>
				</tr>
			</table>
		
		</div>
		<div id="box">
          <title></title>
          <form id="generalInfForm" name="generalInfForm" action="" method="post">
            <div class="zl-tab-bd">
              <div class="zl-dd">
                <dl>
                  <dt>用户名：</dt>
                  <dd>
                     <input type="text" value="<?=$a_name?>"   class="input-text" name="a_name" id="a_name" />
                  </dd>
                </dl>
				
		
                <dl>
                  <dt>密码：</dt>
                  <dd>
                     <input type="text" value="" name="a_password" id="a_password" />
                     为空则不修改
                  </dd>
                </dl>
              
				
              
                <dl>
                  <dt></dt>
                  <dd class="baocun">
                    <input name="提交" type="submit" id="infsubmit" value="确认修改" />
                  </dd>
                </dl>
              </div>
            </div>
          </form>
		  <script type="text/javascript">
$(document).ready(function(){
	$("#generalInfForm").ajaxForm({
		url:"updateGeneralInf.html",
		type:"post",
		secureuri:false,
		success:function(data){
			var value = data.value;
			alert(value);
			$("#infsubmit").attr("disabled",false);
		}
	});

	$("#infsubmit").click(function(){
		$("#infsubmit").attr("disabled","disabled");
		if(!$("#generalInfForm").valid()){
			$("#infsubmit").attr("disabled",false);
		}
		
		if ($("#isVerifyPassword").val()=="true") {
			layer.prompt({
				title:"请输入后台管理密码"
			},function(value, index, elem){
				$("#verifyCode").val(value);
				layer.close(index);
			  	$("#generalInfForm").submit();
			});
		} else {
			$("#generalInfForm").submit();
		}
		$("#infsubmit").attr("disabled",false);
	});
});
        </script>
          <script type="text/javascript">
	$(document).ready(function(){
		 $("#generalInfForm").validate({
			rules: {	
				basicImgMess:{
					maxlength:300
				},
				basicOperator:{
					maxlength:300
				},
				basicIcpNumber:{
					maxlength:300
				},
				basicGANumber:{
					maxlength:100
				},
				basicSystemName:{
					maxlength:300
				},
				basicSystemShortName:{
					maxlength:10
				},
				basicCopyRight:{
					maxlength:300
				},
				basicLinkWe:{
					maxlength:300
				},
				basicSystemDescription:{
					maxlength:150
				},
				basicKeyWord:{
					maxlength:300
				}
			},
			messages:{
				basicImgMess:{
					maxlength:"字数不能超过300!"
				},
				basicOperator:{
					maxlength:"字数不能超过300!"
				},
				basicIcpNumber:{
					maxlength:"字数不能超过300!"
				},
				basicGANumber:{
					maxlength:"字数不能超过100!"
				},
				basicSystemName:{
					maxlength:"字数不能超过300!"
				},
				basicSystemShortName:{
					maxlength:"字数不能超过10!"
				},
				basicCopyRight:{
					maxlength:"字数不能超过300!"
				},
				basicLinkWe:{
					maxlength:"字数不能超过300!"
				},
				basicSystemDescription:{
					maxlength:"字数不能超过150!"
				},
				basicKeyWord:{
					maxlength:"字数不能超过300!"
				}
			},
			errorPlacement: function (error, element) {
				$(element).parent().children('span').html(error);
			}
		});
	});
        </script>
        </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		
			$.ajax({
				url:"generalInf.html",
				type:"post",
				dataType:"html",
				success:function(data){
					$("#box").html(data);
				}
				
			});
			
			$("a[name='tab']").click(function(){
				
				$("a[name='tab']").removeClass();
				$(this).addClass("on");
				var id=$(this).attr("id");
				var _url="generalInf.html";
				if(id==1){
					_url="generalInf.html";
				}else if(id==2){
					_url="generalStyle.html";
				}else if(id==3){
					_url="generalAdvert.html";
				}else if(id==4){
					_url="friendLink.html";
				}else if(id==5){
					_url="bankAccount.html";
				}else if(id==6){
					_url="generalKeFu.html";
				}else if(id==7){
					_url="generalJs.html";
				}
				$.ajax({
					url:_url,
					type:"post",
					dataType:"html",
					success:function(data){
						$("#box").html(data);
					}
					
				});
				
			});
			
		});
	</script>
 </body>
</html>
