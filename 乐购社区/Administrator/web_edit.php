<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
  $w_name = $_POST['w_name']; 
  $w_password = $_POST['w_password']; 
  $w_url = $_POST['w_url']; 
 	null_back($_POST['w_title'],'请输入主站名称');
//	null_back($_POST['w_url'],'请输入主站前缀');
//	null_back($_POST['url1'],'请输入主站尾缀');
 	null_back($_POST['w_fed'],'请输入'.get_fenzhan_banben_name(1).'分站额度');
	null_back($_POST['w_fed2'],'请输入'.get_fenzhan_banben_name(2).'分站额度');
	null_back($_POST['w_fed3'],'请输入'.get_fenzhan_banben_name(3).'分站额度');

   	null_back($_POST['w_name'],'请输入登录账号');
	null_back($_POST['w_password'],'请输入登录密码');
	null_back($_POST['w_czsxf'],'请输入充值手续费');
 	null_back($_POST['w_txsxf'],'请输入提现手续费');
 	null_back($_POST['w_xfprice'],'请输入'.get_fenzhan_banben_name(1).'续费价格');
 	null_back($_POST['w_xfprice2'],'请输入'.get_fenzhan_banben_name(2).'续费价格');
 	null_back($_POST['w_xfprice3'],'请输入'.get_fenzhan_banben_name(3).'续费价格');
	
	null_back($_POST['w_ddate'],'输入到期时间');
    $_data['zt'] = $_POST['w_zt'];
    $_data['banben'] = $_POST['w_bb'];
   	$_data['name'] = $_POST['w_title'];
   	$_data['point'] =$_POST['point'];
    $_data['url'] = $_POST['w_url'];
    $_data['url1'] = $_POST['url1'];
   	$_data['czsxf'] = $_POST['w_czsxf'];
   	$_data['txsxf'] = $_POST['w_txsxf'];
    $_data['fed1'] = $_POST['w_fed'];
    $_data['fed2'] = $_POST['w_fed2'];
   	$_data['fed3'] = $_POST['w_fed3'];	
   	$_data['fprice1'] = $_POST['w_xfprice'];
   	$_data['fprice2'] = $_POST['w_xfprice2'];
   	$_data['fprice3'] = $_POST['w_xfprice3'];
    $_data['loginname'] = $_POST['w_name'];
   	$_data['loginpassword'] = $_POST['w_password'];
   	$_data['txfs'] = $_POST['w_fs'];
    $_data['txxm'] = $_POST['w_xm'];
  	$_data['txzh'] = $_POST['w_zh'];
  	$_data['qq'] = $_POST['w_qq'];
  //	$_data['date'] = date('Y-m-d H:i:s');
  	$_data['ddate'] = $_POST['w_ddate'];
  	$_data['qq'] = $_POST['w_qq'];
    $_data['desc'] = $_POST['w_qk'];
 
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if (mysql_query($sql)) {
     
 
  		alert_href('修改成功!','');
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
<!--
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

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>

<script type="text/javascript" src="./js/pinyin.js"></script>


</head> 
<body> 
<div id="body">
	<div class="zl-tab-bd">
		<div class="zl-dd">
			<?php
					$result = mysql_query('select * from '.flag.'zhuzhan where id = '.$_GET['id'].'');
					if ($row = mysql_fetch_array($result)){
					$site_banben =get_zhuzhan_banben_name($row['banben']);
					?>
 			<form id="annForm" name="annForm" action="" method="post">
            
             <dl>
                          <dt>
                            <label for="label2">站点开关：</label>
                          </dt>
						  <dd>
						    <label>
                            <select name="w_zt" id="w_zt"  style="height:25PX">
                              <option  <? if ($row['zt']==1){echo "selected";}?> value="1">开启</option>
                              <option <? if ($row['zt']==0){echo "selected";}?>  value="0">关闭</option>
  
                             </select>
                            </label>
                          </dd>
			  </dl>
              
              
               	<dl>
                          <dt>
                            <label for="label2">搭建版本：</label>
                          </dt>
						  <dd>
						    <label>
                            <select name="w_bb" id="w_bb"  style="height:25PX">

<?php                                                                                
                   
 						$result1 = mysql_query('select * from '.flag.'zhuzhan_banben    order by ID asc  ');
						while($row1 = mysql_fetch_array($result1)){
						?>
                              <option  <? if ($row['banben']==$row1['ID'] || $site_banben==$row1['name']) {echo "selected";}?> value="<?=$row1['ID']?>"><?=$row1['name']?></option>
 <? }?>
                             </select>
                            </label>
                          </dd>
			  </dl>
              
           
           
    
 			  <dl>
                <dt>
                  <label for="label2">主站名称：</label>
                </dt>
 			    <dd>
                  <input name="w_title" type="text" class="txt1" id="w_title"  style="width:300px;" onBlur="w_db.value=($('#w_title').toPinyin());" onChange="w_db.value=($('#w_title').toPinyin())" onKeydown="w_db.value=($('#w_title').toPinyin())" value="<?=$row['name']?>"/>
                </dd>
		      </dl>
              
            
              
              
                            
              
              
      <dl>
                        <table width="45%" border="0" align="left" cellspacing="0" cellpadding="0">
  <tr align="right">
    <td width="329">  
                            <label for="label2">充值手续：</label>
                         </td>
    <td width="38" align="left">  <dd>
                            <input class="txt1" type="text"   value="<?=$row['czsxf']?>"   placeholder="" style="width:105px;" name="w_czsxf" id=""/>%
                          </dd></td>
    <td width="30"  align="left">   </td>
    <td width="160"  align="LEFT"><label for="label3">提现手续：</label></td>
    <td width="211"  align="LEFT"><dd>   <input class="txt1" type="text" style="width:117px;" name="w_txsxf"  value="<?=$row['txsxf']?>" id=""/>%</dd></td>
  </tr>
</table>

                          
			  </dl>
              
            
      	      <BR>		 
              
              
              
              
                        <dl>
                        <table width="45%" border="0" align="left" cellspacing="0" cellpadding="0">
  <tr align="right">
    <td width="329">  
                            <label for="label2"><?=get_fenzhan_banben_name(1)?>分站额度：</label>
                         </td>
    <td width="40" align="left">  <dd>
                            <input class="txt1" type="text" style="width:105px;"  value="<?=$row['fed1']?>" name="w_fed" id=""/>
                          </dd></td>
    <td width="30"  align="left">   </td>
    <td width="160"  align="LEFT"><label for="label3">续费价格：</label></td>
    <td width="211"  align="LEFT"><dd>   <input class="txt1" type="text"   value="<?=$row['fprice1']?>"  style="width:117px;" name="w_xfprice" id=""/></dd></td>
  </tr>
</table>

                          
			  </dl>
              
            
      	      <BR>	
              
              
                        <dl>
                        <table width="45%" border="0" align="left" cellspacing="0" cellpadding="0">
  <tr align="right">
    <td width="329">  
                            <label for="label2"><?=get_fenzhan_banben_name(2)?>分站额度：</label>
                         </td>
    <td width="40" align="left">  <dd>
                            <input class="txt1" type="text" style="width:105px;"  value="<?=$row['fed2']?>" name="w_fed2" id=""/>
                          </dd></td>
    <td width="30"  align="left">   </td>
    <td width="160"  align="LEFT"><label for="label3">续费价格：</label></td>
    <td width="211"  align="LEFT"><dd>   <input class="txt1" type="text"   value="<?=$row['fprice2']?>"  style="width:117px;" name="w_xfprice2" id=""/></dd></td>
  </tr>
</table>

                          
			  </dl>
              	 
              
                  
              <BR>
              
                        <dl>
                        <table width="45%" border="0" align="left" cellspacing="0" cellpadding="0">
  <tr align="right">
    <td width="329">  
                            <label for="label2"><?=get_fenzhan_banben_name(3)?>分站额度：</label>
                         </td>
    <td width="40" align="left">  <dd>
                            <input class="txt1" type="text" style="width:105px;"  value="<?=$row['fed3']?>" name="w_fed3" id=""/>
                          </dd></td>
    <td width="30"  align="left">   </td>
    <td width="160"  align="LEFT"><label for="label3">续费价格：</label></td>
    <td width="211"  align="LEFT"><dd>   <input class="txt1" type="text"   value="<?=$row['fprice3']?>"  style="width:117px;" name="w_xfprice3" id=""/></dd></td>
  </tr>
</table>

                          
			  </dl>
              
              <BR>
              
 			  <dl>
                <dt>
                  <label for="label2">登录账号：</label>
                </dt>
			    <dd>
			      <input name="w_name" type="text" class="txt1" id="w_name" style="width:300px;" value="<?=$row['loginname']?>"/>
			    </dd>
		      </dl>
			 
					 
						<dl>
                          <dt>
                            <label for="label2">登录密码：</label>
                          </dt>
						  <dd>
                            <input name="w_password" type="text" class="txt1" id="w_password" style="width:300px;" value="<?=$row['loginpassword']?>"/>
                          </dd>
			  </dl>
						
                    
                               
              
              
              
            
              
            
              
             
              
               
                <dl>
                          <dt>
                            <label for="label2">账户余额：</label>
                          </dt>
						  <dd>
                            <input name="point" type="text" class="txt1" id="point" style="width:300px;" value="<?=$row['point']?>"/>
                          </dd>
			  </dl>
              
              
               
                    
               
                 <dl>
                          <dt>
                            <label for="label2">提现方式：</label>
                          </dt>
						  <dd>
                            <input name="w_fs" type="text" class="txt1" id="w_fs" style="width:300px;" value="<?=$row['txfs']?>"/>
                          </dd>
			  </dl>
              
                <dl>
                          <dt>
                            <label for="label2">提现姓名：</label>
                          </dt>
						  <dd>
                            <input name="w_xm" type="text" class="txt1" id="w_xm" style="width:300px;" value="<?=$row['txxm']?>"/>
                          </dd>
			  </dl>
						<dl>
                          <dt>
                            <label for="label2">提现账号：</label>
                          </dt>
						  <dd>
                            <input name="w_zh" type="text" class="txt1" id="w_tel" style="width:300px;" value="<?=$row['txzh']?>"/>
                          </dd>
			  </dl>
						<dl>
                          <dt>
                            <label for="label2">QQ：</label>
                          </dt>
						  <dd>
                            <input name="w_qq" type="text" class="txt1" id="w_qq" style="width:300px;" value="<?=$row['qq']?>"/>
                          </dd>
			  </dl>
					 
                      
 					 
						<dl>
                          <dt>
                            <label for="label2">到期时间：</label>
                          </dt>
						  <dd>
                            <input name="w_ddate" type="text" class="txt1" id="w_ddate" style="width:300px;" value="<?=$row['ddate']?>"/>
                          </dd>
			  </dl>
              
              
                <dl>
                          <dt>
                            <label for="label2">备注：</label>
                          </dt>
						  <dd>
                            <textarea name="w_qk" class="txt1" id="" style="width:300px;"><?=$row['desc']?></textarea>
                          </dd>
			  </dl>
						<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" id="提交" name="提交" class="button03" value="修改"/>
								<input name="btn_back" type="button" class="btn-close" id="btn_back" onclick="MM_goToURL('self','web.php');return document.MM_returnValue" value="返回列表"/>
							</dd>
						</dl>
				
		  </form>
		  <? }?>
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