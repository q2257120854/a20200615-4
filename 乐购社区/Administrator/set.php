<?php
 require_once('admin_check.php');
require_once('admin_config.php');
if(isset($_POST['提交'])){
 
 	$_data['notice'] = $_POST['notice'];
 	$_data['zfid'] = $_POST['zfid'];
 	$_data['zfkey'] = $_POST['zfkey'];
	$_data['allowzd'] = $_POST['allowzd'];

     	$sql = 'update '.flag.'set set '.arrtoupdate($_data).' where ID = 1';
	if(mysql_query($sql)){
		
		
		
    $filename="../system/data.php";
 //配置文件内容
 	$config = '';
	$config .= '<?php';
	$config .= "\n";
	$config .= '//Mysql数据库信息';
	$config .= "\n";
	$config .= 'if(!defined(\'PCFINAL\')) exit(\'Request Error!\');';
	$config .= "\n";
	$config .= 'define(\'DATA_HOST\', \''.DATA_HOST.'\');';
	$config .= "\n";
	$config .= 'define(\'DATA_USERNAME\', \''.DATA_USERNAME.'\');';
	$config .= "\n";
	$config .= 'define(\'DATA_PASSWORD\', \''.DATA_PASSWORD.'\');';
	$config .= "\n";
	$config .= 'define(\'DATA_NAME\', \''.DATA_NAME.'\');';
	$config .= "\n";
	$config .= 'define(\'flag\', \''.flag.'\');';
	$config .= "\n";	
	$config .= 'define(\'sysurl\', \''.$_POST['sysurl'].'\');';
	$config .= "\n";	
 	$config .= '?>';
 
        $handle=fopen($filename, "w+");
        fwrite($handle, $config);
		
  

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
<title>网站基本信息</title>
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
					<td class="tab_lixiao"><a name="tab" id="1" href="javascript:void(0);" class="on">基本信息</a></td>
			 
					<td>&nbsp;</td>
				</tr>
			</table>
		
		</div>
		<div id="box">
          <title>网站基本信息</title>
          <form action="" method="post">
            <div class="zl-tab-bd">
              <div class="zl-dd">
                
                
                  <dl>
                  <dt>公告内容：</dt>
                  <dd>
                    <textarea name="notice"  style="width:270PX" id=""><?=$site_notice?></textarea>
                  </dd>
                </dl>
				
		
            <dl>
                  <dt>支付宝PID：</dt>
                  <dd>
                     <input type="text" value="<?=$site_zfid?>" name="zfid" id="" />
                  </dd>
                </dl>

            <dl>
                  <dt>支付宝Key：</dt>
                  <dd>
                     <input type="text" value="<?=$site_zfkey?>" name="zfkey" id="" />
                  </dd>
                </dl>
				
		
           <dl>
                  <dt>控制端域名：</dt>
                  <dd>
                     <input type="text" value="<?=sysurl?>" name="sysurl" id="" />修改后则需用该域名访问控制端
                  </dd>
                </dl>

            <dl>
			
			 <dl>
                  <dt>下级允许搭建的站点：</dt>
                  <dd>
                     <input type="text" value="<?=$allowzd?>" name="allowzd" id="" />用,隔开
                  </dd>
                </dl>

            <dl>
               
			
                <dl>
                  <dt></dt>
                  <dd class="baocun">
                    <input name="提交" type="submit" id="" value="确认保存" />
                  </dd>
                </dl>
              </div>
            </div>
          </form>
		 
        </div>
	</div>
	 
 </body>
</html>
