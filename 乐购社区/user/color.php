<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'color';
check_qx($site_qx,'站点装饰');
if(isset($_POST['提交'])){
	$_data['topcolor'] = $_POST['i_color'];
	$_data['endcolor'] = $_POST['i_color1'];
	$_data['moban'] = $_POST['s_skin'];
	$_data['moban1'] = $_POST['moban1'];
	$_data['sjmb'] = $_POST['sjmb'];
	$_data['moban2'] = $_POST['moban2'];
	$_data['moban_reg'] = $_POST['moban_reg'];
	$_data['moban_login'] = $_POST['moban3'];

	$_data['background'] = $_POST['s_bj'];
	$_data['ico'] = $_POST['ico'];
   $_data['dh'] = $_POST['dh'];
   
   	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$fen_id.'';
	$arrr = array('""' => "NULL");
    $sql = strtr($sql, $arrr);
	if(mysql_query($sql)){
		alert_href('操作成功!','');
	}else{
		alert_back('修改失败!');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>站点装饰</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    

 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_bj').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_bj').val(url);
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


 <script>
			KindEditor.ready(function(K) {
				var colorpicker;
				K('#colorpicker1').bind('click', function(e) {
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
							K('#i_color1').val(color);
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
        <script>
			KindEditor.ready(function(K) {
				var uploadbutton = K.uploadbutton({
					button : K('#upload-ico')[0],
					fieldName : 'imgFile',
					url : '../editor/php/ico.php?dir=file',
					afterUpload : function(data) {
						if (data.error === 0) {
							var url = K.formatUrl(data.url, 'absolute');
							K('#ico').val(url);
						} else {
							alert(data.message);
						}
					},
					afterError : function(str) {
						alert('自定义错误信息: ' + str);
					}
				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});
			});
		</script>

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-6">
            <div class="smart-widget widget-blue">
                <div class="panel-heading bg-gradient-vine">
                    站点装饰                    <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="#" class="widget-refresh-option">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    
                        
                    <div class="smart-widget-body">
                         <form class="form-horizontal"  method="post" >
                        
                            <div class="form-group">
                                <label class="col-lg-3 control-label">电脑首页模板选择</label>
                                <div class="col-lg-8">
                                  <?php $result1 = mysql_query('select * from '.flag.'template where t_lx = "首页"  order by ID desc ,ID desc');
                                    while($row1 = mysql_fetch_array($result1)){
                                  ?>
                                  <div>
                                      <span  class="an-custom-radiobox primary" style="float: left">                                           
                                        <img src="<?=$row1['t_pic']?>" width="100" height="100"><br>
                                        <div class="radio inline-block">
                                          <div class="custom-radio m-right-xs">
                                            <input type="radio" id="index_<?=$row1['t_path']?>" name="moban1"    value="<?=$row1['t_path']?>"   <? if ($site_moban1==$row1['t_path']) {echo "checked";}?>  />
                                            <label for="index_<?=$row1['t_path']?>"></label>
                                            </div>
                                            <div class="inline-block vertical-top"><?=$row1['t_name']?></div>
                                          </div>
                                        </div>
                                        <? }?>
                                 </div>
                              </div>
							  
							  
							  <div class="form-group">
                                <label class="col-lg-3 control-label">手机首页模板选择</label>
                                <div class="col-lg-8">
                                  <?php $result1 = mysql_query('select * from '.flag.'template where t_lx = "首页"  order by ID desc ,ID desc');
                                    while($row1 = mysql_fetch_array($result1)){
                                  ?>
                                  <div>
                                      <span  class="an-custom-radiobox primary" style="float: left">                                           
                                        <img src="<?=$row1['t_pic']?>" width="100" height="100"><br>
                                        <div class="radio inline-block">
                                          <div class="custom-radio m-right-xs">
                                            <input type="radio" id="sjmb_<?=$row1['t_path']?>" name="sjmb"    value="<?=$row1['t_path']?>"   <? if ($site_sjmb==$row1['t_path']) {echo "checked";}?>  />
                                            <label for="sjmb_<?=$row1['t_path']?>"></label>
                                            </div>
                                            <div class="inline-block vertical-top"><?=$row1['t_name']?></div>
                                          </div>
                                        </div>
                                        <? }?>
                                 </div>
                              </div>
 
 
  							<div class="form-group">
                                <label class="col-lg-3 control-label">内页模板选择</label>
                                <div class="col-lg-8">
                                
                                   <?php
					 
						$result1 = mysql_query('select * from '.flag.'template where t_lx = "内页"  order by ID desc ,ID desc');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                                              
   <div>
                                               <span  class="an-custom-radiobox primary" style="float: left"> 
                                                 <img src="<?=$row1['t_pic']?>" width="100" height="100"><br>
                                        <div class="radio inline-block">
                                            <div class="custom-radio m-right-xs">
                   <input type="radio" id="home_<?=$row1['t_path']?>" name="moban2"    value="<?=$row1['t_path']?>"   <? if ($site_moban2==$row1['t_path']) {echo "checked";}?>  />
                                                <label for="home_<?=$row1['t_path']?>"></label>
                                            </div>
                                            <div class="inline-block vertical-top"><?=$row1['t_name']?></div>
                                        </div>
                                    </div>
                                              <? }?>                        
                                                                      
                                                                             
                                                                    </div>
                            </div>

 
    <div class="form-group">
                                <label class="col-lg-3 control-label">注册页模板选择</label>
                                <div class="col-lg-8">
                                
                                   <?php
					 
						$result1 = mysql_query('select * from '.flag.'template where t_lx = "注册页"  order by ID desc ,ID desc');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
   <div>
                                               <span  class="an-custom-radiobox primary" style="float: left"> 
                                                 <img src="<?=$row1['t_pic']?>" width="100" height="100"><br>
                                        <div class="radio inline-block">
                                            <div class="custom-radio m-right-xs">
                   <input type="radio" id="reg_<?=$row1['t_path']?>" name="moban_reg"    value="<?=$row1['t_path']?>"   <? if ($site_regmb==$row1['t_path']) {echo "checked";}?>  />
                                                <label for="reg_<?=$row1['t_path']?>"></label>
                                            </div>
                                            <div class="inline-block vertical-top"><?=$row1['t_name']?></div>
                                        </div>
                                    </div>
                                              <? }?>                                                                                 
                                                                    </div>
                            </div>

      
  <div class="form-group">
                                <label class="col-lg-3 control-label">登录页模板选择</label>
                                <div class="col-lg-8">
                                   <?php
					 
						$result1 = mysql_query('select * from '.flag.'template where t_lx = "登录页"  order by ID desc ,ID desc');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                                              
   <div>
                                               <span  class="an-custom-radiobox primary" style="float: left"> 
                                                 <img src="<?=$row1['t_pic']?>" width="90" height="100"><br>
                                        <div class="radio inline-block">
                                            <div class="custom-radio m-right-xs">
                   <input type="radio" id="login_<?=$row1['t_path']?>" name="moban3"    value="<?=$row1['t_path']?>"   <? if ($site_moban3==$row1['t_path']) {echo "checked";}?>  />
                                                <label for="login_<?=$row1['t_path']?>"></label>
                                            </div>
                                            <div class="inline-block vertical-top"><?=$row1['t_name']?></div>
                                        </div>
                                    </div>
                                              <? }?>                        
                                                                                                                                            
                                                                    </div>
                            </div>


 
                      
                      
                            <div class="form-group">
                                <label class="col-lg-3 control-label">网站ICO</label>
                              <div class="col-lg-8">
                                    <input name="ico"  value="<?=$site_ico?>" id="ico" type="text" class="form-control" />   
                               <input name="按钮"  id="upload-ico" type="button"    value="浏览上传" />

                                </div>
                            </div>
                            
                            
                              <div class="form-group">
                                <label class="col-lg-3 control-label">网站背景</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input name="s_bj" id="s_bj" type="text" class="form-control" placeholder="输入背景图片地址"
                                               value="<?=$site_bj?>">
                                        <div class="input-group-btn">
                                            <button type="button" id="upload-image" data-id="bg_img"
                                                    class="btn btn-success no-shadow upload_btn">上传
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                                
                                   <div class="form-group">
                                <label class="col-lg-3 control-label">顶部颜色</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input name="i_color" id="i_color" type="text" class="form-control" placeholder="输入背景颜色代码"
                                               value="<?=$site_topcolor?>">
                                        <span class="input-group-addon btn btn-info picker"
                                             style="color:#FFF"  id="colorpicker">选择</span>
                                    </div>
                                </div>
                            </div>
                            
                                  <div class="form-group">
                                <label class="col-lg-3 control-label">底部颜色</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input name="i_color1" id="i_color1" type="text" class="form-control" placeholder="输入背景颜色代码"
                                               value="<?=$site_endcolor?>">
                                        <span class="input-group-addon btn btn-info picker"
                                             style="color:#FFF"  id="colorpicker1">选择</span>
                                    </div>
                                </div>
                            </div>
<div class="form-group">
                    <label class="col-sm-3 control-label">首页导航链接</label>
                    <div class="col-sm-9">
                        <textarea rows="5" name="dh" class="form-control"><?=$site_dh?></textarea> <pre>PS:一行一个，格式：链接文字|链接URL地址<br>举例： 百度一下|http://www.baidu.com</pre>
                    </div>
                </div>
                    </div>
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
                             <input name="提交"  type="submit" class="btn btn-purple" id="提交" value="保存修改">
                        </div>
                    </div>
                         </form>

                               </div>
            </div>
        </div>
    </div> </div> </div> </div>

 <? include('footer.php');
?>
 
<?  include('password.php');?>
 

 </body>
</html>
