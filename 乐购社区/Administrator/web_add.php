<?php
 require_once('admin_check.php');
require_once('admin_config.php');

// echo $zuixinzhuzhan;
 if (isset($_POST['提交'])){
  $w_name = $_POST['w_name']; 
  $w_password = $_POST['w_password']; 
  $w_url = $_POST['w_url']; 
 	null_back($_POST['w_title'],'请输入主站名称');
	null_back($_POST['w_url'],'请输入主站前缀');
	null_back($_POST['url1'],'请输入主站尾缀');
 	 
   	null_back($_POST['w_name'],'请输入登录账号');
	null_back($_POST['w_password'],'请输入登录密码');
 
 
	
	null_back($_POST['endTime'],'输入到期时间');
    //完整域名
	$zhu_url = $_POST['w_url'].".".$_POST['url1'];
	
	
		if ($zhu_url ==sysurl)
		alert_back('创建失败:'.$zhu_url.'域名 已经被绑定过了!!');
	


				$resultcx = mysql_query('select * from '.flag.'zhuzhan where url = "'.$_POST['w_url'].'"  ');
					if ($rowcx = mysql_fetch_array($resultcx)){
		alert_back('创建失败:'.$_POST['w_url'].'域名 已经被绑定过了!!');
					} 
		 
 		 
    $_data['zt'] = 1;//1开启
    $_data['banben'] = $_POST['w_bb'];
   	$_data['zname'] = $_POST['w_title'];

   	$_data['name'] = $_POST['w_title'];
   	$_data['point'] =0;
    $_data['url'] = $_POST['w_url'];
    $_data['url1'] = $_POST['url1'];
	$_data['czsxf'] = get_zhuzhan_banben('czsxf',$_POST['w_bb']);
 	$_data['txsxf'] = get_zhuzhan_banben('txsxf',$_POST['w_bb']);
    $_data['fed1'] =  get_zhuzhan_banben('fed1',$_POST['w_bb']);
    $_data['fed2'] = get_zhuzhan_banben('fed2',$_POST['w_bb']);
   	$_data['fed3'] = get_zhuzhan_banben('fed3',$_POST['w_bb']);
   	$_data['fprice1'] =  get_zhuzhan_banben('fprice1',$_POST['w_bb']);
   	$_data['fprice2'] =  get_zhuzhan_banben('fprice2',$_POST['w_bb']);
   	$_data['fprice3'] = get_zhuzhan_banben('fprice3',$_POST['w_bb']);
    $_data['loginname'] = $_POST['w_name'];
   	$_data['loginpassword'] = $_POST['w_password'];
   	$_data['txfs'] = $_POST['w_fs'];
    $_data['txxm'] = $_POST['w_xm'];
  	$_data['txzh'] = $_POST['w_zh'];
  	$_data['qq'] = $_POST['w_qq'];
  	$_data['date'] = date('Y-m-d H:i:s');
  	$_data['ddate'] = date('Y-m-d H:i:s',strtotime('+'.$_POST['sj'].'year'));
  	$_data['qq'] = $_POST['w_qq'];
    $_data['desc'] = $_POST['w_qk'];

  $_data['moban'] = $morenmoban; 
  $_data['background'] =$morenpic; 
      $_data['mid'] =1;
    $_data['level1_name'] ='普通会员';
    $_data['level2_name'] ='高级会员';
    $_data['level3_name'] ='贵宾会员';
    $_data['level4_name'] ='至尊会员';
    $_data['level5_name'] ='皇冠会员';

 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'zhuzhan ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
//查询主站ID
//为主站绑定域名		
	$resultcx = mysql_query('select * from '.flag.'zhuzhan where url = "'.$_POST['w_url'].'"  ');
	if ($rowcx = mysql_fetch_array($resultcx))
	{
   	$_bdym['zid'] = $rowcx['ID'];
  	$_bdym['name'] = $zhu_url;
  	$bdymstr = arrtoinsert($_bdym);
	$bdymsql = 'insert into '.flag.'zhuzhan_domain ('.$bdymstr[0].') values ('.$bdymstr[1].')';
	mysql_query($bdymsql);
} 

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
 
<!-- 表单元素 开始 --> 
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>


<!-- 时间元素 开始 -->
<link rel="stylesheet" href="file/main/css/jQueryUI/jquery-ui.css?" type="text/css" />
<script type="text/javascript" src="file/main/js/jQueryUI/jquery-ui.js"></script>
<script type="text/javascript" src="file/main/js/util/DateUtil.js"></script>
<!-- 时间元素 结束 -->

<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css?" type="text/css"></link>

<script type="text/javascript">
$(document).ready(function(){
	
	$.datepicker.setDefaults({
						dateFormat : "yy-mm-dd", // 日期格式
						buttonImageOnly : true,
						selectOtherMonths : true,
						defaultDate : +7,// 默认时间
						dayNamesMin : [ "日", "一", "二", "三", "四", "五", "六" ],
						monthNames : [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月",
								"9月", "10月", "11月", "12月" ],
						beforeShow : function(picker) { // 开始日期小于结束日期
						}
				});
			
	$("#startTime,#endTime").datepicker();
	$("#startTime").val($.formatDate(new Date(), 2, 0));
	$("#endTime").val($.formatDate(new Date(), 2, 1));
});
</script>

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
                  <input class="txt1" type="text" style="width:300px;" name="w_db" id="w_db"/>
                </dd>
		      </dl>
              
           	
              <dl  style="display:none">
                          <dt>
                            <label for="label2">站点开关：</label>
                          </dt>
						  <dd>
						    <label>
                            <select name="w_zt" id="w_zt"  style="height:25PX">
                              <option value="1">开启</option>
                              <option value="0">关闭</option>
  
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
                   
 						$result = mysql_query('select * from '.flag.'zhuzhan_banben    order by ID asc  ');
						while($row = mysql_fetch_array($result)){
						?>
                              <option value="<?=$row['ID']?>"><?=$row['name']?></option>
 <? }?>
                             </select>
                            </label>
                          </dd>
			  </dl>
               <dl>
                          <dt>
                            <label for="label2">搭建期限：</label>
                          </dt>
						  <dd>
						    <label>
                            <select name="sj" id=""  style="height:25PX">
                              <option value="1">1年</option>
                              <option value="2">2年</option>
                              <option value="3">3年</option>
                              <option value="5">5年</option>
                              <option value="10">10年</option>
                              <option value="20">20年</option>

                             </select>
                            </label>
                          </dd>
			  </dl>
              
 			  <dl>
                <dt>
                  <label for="label2">主站名称：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text" onBlur="w_db.value=($('#w_title').toPinyin());" onChange="w_db.value=($('#w_title').toPinyin())" onKeydown="w_db.value=($('#w_title').toPinyin())"  style="width:300px;" name="w_title" id="w_title"/>
                </dd>
		      </dl>
              
              <dl    >
                          <dt>
                            <label for="label2">主站域名：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:100px;" name="w_url" id="w_url"/>
                            
                            <select name="url1" id="url1"  style="height:25PX; width:195PX">
                            <?php
					 
						$result = mysql_query('select * from  '.flag.'domain  order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
                                                 <option    value="<?=$row['name']?>"><?=$row['name']?></option>
                                                <? }?>
    
                             </select>
                             
                          </dd>
			  </dl>
              
              
              
    
              
        		 
              
              
              
              
                        
              
             
 
              
              
              <dl>
                <dt>
                  <label for="label2">登录账号：</label>
                </dt>
			    <dd>
			      <input class="txt1" type="text" style="width:300px;" name="w_name" id="w_name"/>
			    </dd>
		      </dl>
			 
					 
						<dl>
                          <dt>
                            <label for="label2">登录密码：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;" name="w_password" id="w_password"/>
                          </dd>
			  </dl>
					 

	 
    		 
            
           <dl>
                          <dt>
                            <label for="label2">提现方式：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;" name="w_fs" id="w_fs"/>
                          </dd>
			  </dl>


					<dl>
                          <dt>
                            <label for="label2">提现姓名：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;" name="w_xm" id="w_xm"/>
                          </dd>
			  </dl>


						<dl>
                          <dt>
                            <label for="label2">提现账号：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;" name="w_zh" id="w_zh"/>
                          </dd>
			  </dl>

						 
						<dl>
                          <dt>
                            <label for="label2">QQ：</label>
                          </dt>
						  <dd>
                            <input class="txt1" type="text" style="width:300px;" name="w_qq" id="w_qq"/>
                          </dd>
			  </dl>
					 
						 
						<dl  style="display:none">
                          <dt>
                            <label for="label2">到期时间：</label>
                          </dt>
						  <dd>
                          	<span class="riqi" >
 					<input type="text" id="endTime"    class="txt1"   style="width:300px;"   readonly="readonly" name="endTime" value=""/>
  				</span>    
                
                          
                           </dd>
			  </dl>
              
              <dl>
                          <dt>
                            <label for="label2">备注：</label>
                          </dt>
						  <dd>
                            <textarea name="w_qk" class="txt1" id="" style="width:300px;"></textarea>
                          </dd>
			  </dl>
						<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" id="提交" name="提交" class="button03" value="确认添加"/>
								<input name="btn_back" type="button" class="btn-close" id="btn_back" onclick="MM_goToURL('self','web.php');return document.MM_returnValue" value="返回列表"/>
							</dd>
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

<script type="text/javascript">
		afterDay = function(t) {
			$("#startTime").val($.formatDate(new Date(), 2, t));
			$("#endTime").val($.formatDate(new Date(), 2, 1));
		};
		afterDay1 = function(t) {
			$("#startTime").val($.formatDate(new Date(), 2, t));
			$("#endTime").val($.formatDate(new Date(), 2, 0));
		};
		$("select[name='everyPageSelectLogin']").val("");
		var startTime = "";
		var endTime = "";
		
		if(startTime!=""){
			$("input[name='startTime']").val("");
		}
		
		if(endTime!=""){
			$("input[name='endTime']").val("");
		}
		if(""!=""){
			$("select[name='type']").val("");
		}
		
		if(""!=""){
			$("select[name='state']").val("");
		}
		
</script>

</html> 