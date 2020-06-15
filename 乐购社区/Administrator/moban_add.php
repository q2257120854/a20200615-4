<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
 
	null_back($_POST['name'],'请输入模板名称');
	if ($_POST['keyname1']!='')
{	null_back($_POST['key1'],'请输入参数一');}
	if ($_POST['keyname2']!='')
{	null_back($_POST['key2'],'请输入参数二');}
	if ($_POST['keyname3']!='')
{	null_back($_POST['key3'],'请输入参数三');}

	if ($_POST['keyname4']!='')
{	null_back($_POST['key4'],'请输入参数四');}

 
	 
    $_data['name'] = $_POST['name'];
   	$_data['keyname1'] = $_POST['keyname1'];
   	$_data['keyname2'] = $_POST['keyname2'];
   	$_data['keyname3'] = $_POST['keyname3'];
   	$_data['keyname4'] = $_POST['keyname4'];
   	$_data['key1'] = $_POST['key1'];
   	$_data['key2'] = $_POST['key2'];
   	$_data['key3'] = $_POST['key3'];
   	$_data['key4'] = $_POST['key4'];
 	
   
  
   	$_data['dkey1'] = $_POST['dkey1'];
   	$_data['dkey2'] = $_POST['dkey2'];
   	$_data['dkey3'] = $_POST['dkey3'];
   	$_data['dkey4'] = $_POST['dkey4'];
	   

   	$_data['yile1'] = $_POST['yile1'];
   	$_data['yile2'] = $_POST['yile2'];
   	$_data['yile3'] = $_POST['yile3'];
   	$_data['yile4'] = $_POST['yile4'];
	   

  
	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'moban ('.$str[0].') values ('.$str[1].')';
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
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
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
 <!-- 编辑器元素 结束 -->
  
<style>  
label {font-size:12px;cursor:pointer;}  
label i {font-size:12px;font-style:normal;display:inline-block;width:12px;height:12px;text-align:center;line-height:12px;color:#fff;vertical-align:middle;margin:-2px 2px 1px 0px;border:#2489c5 1px solid;}  
input[type="checkbox"],input[type="radio"] {display:none;}  
input[type="radio"] + i {border-radius:7px;}  
input[type="checkbox"]:checked + i,input[type="radio"]:checked + i {background:#2489c5;}  
input[type="checkbox"]:disabled + i,input[type="radio"]:disabled + i {border-color:#ccc;}  
input[type="checkbox"]:checked:disabled + i,input[type="radio"]:checked:disabled + i {background:#ccc;}  
</style>  

</head> 
<body> 
<div id="body">
	<div class="zl-tab-bd">
		<div class="zl-dd">
 			<form id="annForm" name="annForm" action="" method="post">
 			  <dl style="display:none">
                <dt>
                  <label for="label2">表名：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text" name="w_db" id="w_db"/>
                </dd>
		      </dl>
              
              	 
              
 			  <dl>
                <dt>
                  <label for="label2">模板名称：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  placeholder="模板名称" name="name" id=""/>
                </dd>
		      </dl>
              
              <dl>
                          <dt>
                            <label for="label2">参数一信息：</label>
                          </dt>
						  <dd>
                            <input class="txt1" placeholder="参数一名称" style="width:150px"    type="text" name="keyname1" id=""/>
							<input class="txt1" placeholder="参数一"  style="width:135px"  type="text" name="key1" id=""/>
              <input class="txt1" placeholder="玖伍对接参数"   value=""  style="width:135px"  type="text" name="dkey1" id=""/>
                <input class="txt1" placeholder="亿乐对接参数"   value=""  style="width:135px"  type="text" name="yile1" id=""/> 


                          </dd>
			  </dl>
              
                  
           
		     <dl>
                          <dt>
                            <label for="label2">参数二信息：</label>
                          </dt>
						  <dd>
                            <input class="txt1" placeholder="参数二名称" style="width:150px"    type="text" name="keyname2" id=""/>
							<input class="txt1" placeholder="参数二"  style="width:135px"  type="text" name="key2" id=""/>
                                                               <input class="txt1" placeholder="对接参数"   value=""  style="width:135px"  type="text" name="dkey2" id=""/>
                <input class="txt1" placeholder="亿乐对接参数"   value=""  style="width:135px"  type="text" name="yile2" id=""/> 
                          </dd>
			  </dl>
              
			  
			    <dl>
                          <dt>
                            <label for="label2">参数三信息：</label>
                          </dt>
						  <dd>
                            <input class="txt1" placeholder="参数三名称" style="width:150px"    type="text" name="keyname3" id=""/>
							<input class="txt1" placeholder="参数三"  style="width:135px"  type="text" name="key3" id=""/>
                                                               <input class="txt1" placeholder="对接参数"   value=""  style="width:135px"  type="text" name="dkey3" id=""/>
                <input class="txt1" placeholder="亿乐对接参数"   value=""  style="width:135px"  type="text" name="yile3" id=""/> 

 
                          </dd>
			  </dl>
              
			  
			  
			    <dl>
                          <dt>
                            <label for="label2">参数四信息：</label>
                          </dt>
						  <dd>
                            <input class="txt1" placeholder="参数四名称" style="width:150px"    type="text" name="keyname4" id=""/>
							<input class="txt1" placeholder="参数四"  style="width:135px"  type="text" name="key4" id=""/>
                         <input class="txt1" placeholder="对接参数"   value=""  style="width:135px"  type="text" name="dkey4" id=""/>
                <input class="txt1" placeholder="亿乐对接参数"   value=""  style="width:135px"  type="text" name="yile4" id=""/> 

                          </dd>
			  </dl>
              
			  		<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" id="提交" name="提交" class="button03" value="确认添加"/>
								<input type="button" id="btn_back" name="btn_back" class="btn-close" value="返回列表"/></dd>
						</dl>	 
					 
						 
				
		  </form>
		</div>
	</div>
	</div>
	
 </body>
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