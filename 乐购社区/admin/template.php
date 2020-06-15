<?php $title='站点装饰';include('../system/inc.php');include('./admin_config.php');include('./check.php');$nav = 'template';check_qx($site_qx,'站点装饰'); ?> <!DOCTYPE html><html lang="en"><head>    <meta charset="utf-8">    <style>        th {            text-align: center;        }        td {            text-align: center;        }    </style>	<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>
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
	K('#upload-image2').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#ico').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#ico').val(url);
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
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
            <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       平台装饰
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-index">
                         <div class="form-group">
                                <label class="col-lg-3 control-label">电脑首页模板选择</label>
                                <div class="col-lg-9">
								<?php $result1 = mysql_query('select * from '.flag.'template where t_lx = "首页"  order by ID desc ,ID desc');
                                    while($row1 = mysql_fetch_array($result1)){
								  if ($row1['t_path']==$site_moban1) {$check='selected';}
                                  $option.='<option value="'.$row1['t_path'].'" '.$check.'>'.$row1['t_name'].'</option>';
								  $img.='<img v-else-if="template=='."'".$row1['t_path']."'".'" src="'.$row1['t_pic'].'" width="100" height="100">';
								  unset($check);
								  }?>
								<select id="template" name="template" v-model="template" class="form-control">
								<?=$option?>
</select>
<div style="margin-top: 10px" v-cloak="">
	<p v-if="template=='null'">
	</p>
	<?=$img?>
</div>
                                 </div>
                              </div>
							  
							  
							  <div class="form-group">
                                <label class="col-lg-3 control-label">手机首页模板选择</label>
                                <div class="col-lg-9">
								<?php $result1 = mysql_query('select * from '.flag.'template where t_lx = "首页"  order by ID desc ,ID desc');
                                    while($row1 = mysql_fetch_array($result1)){
                                  if ($row1['t_path']==$site_sjmb) {$check2='selected';}
                                  $option2.='<option value="'.$row1['t_path'].'" '.$check2.'>'.$row1['t_name'].'</option>';
								  $img2.='<img v-else-if="m_template=='."'".$row1['t_path']."'".'" src="'.$row1['t_pic'].'" width="100" height="100">';
								  unset($check2);
								  }?>
								<select id="m_template" name="m_template" v-model="m_template" class="form-control">
								<?=$option2?>
</select>
<div style="margin-top: 10px" v-cloak="">
	<p v-if="m_template=='null'">
	</p>
	<?=$img2?>
</div>
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
 <?/*
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
*/
?>
      
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
              
                    </div>
					<div class="panel-footer"><input type='hidden' name='确定' id='确定' value='模板保存'><a class="btn btn-info pull-right" @click="save('index')">
                            <i class="iconfont"></i> 确定
                        </a></div>
                         </form>
                </div>
            </div>
			
<div class="col-md-6">
    <div class="panel">
        <div class="panel-heading bg-gradient-vine">首页装饰</div>
        <div class="panel-body">
            <form class="form-horizontal" id="form-index1">
                <input type="hidden" name="action" value="styleConfig">
                <input type="hidden" name="kind" value="1">
				   <div class="form-group">
                                <label class="col-lg-3 control-label">平台ICO图标</label>
                              <div class="col-lg-8">
                                    <input name="ico"  value="<?=$site_ico?>" id="ico" type="text" class="form-control" />   
                              <button type="button" id="upload-image2" data-id="ico"
                                                    class="btn btn-success no-shadow upload_btn">上传
                                            </button>
                                </div>
                            </div>
                            
                            
                              <div class="form-group">
                                <label class="col-lg-3 control-label">前台背景图</label>
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
                <div class="form-group">
                    <label class="col-sm-3 control-label">全局CSS样式</label>
                    <div class="col-sm-9">
                        <textarea rows="5" name="css" class="form-control"><?=$site_style?></textarea>
                    </div>
                </div>
            
        </div>
        <div class="panel-footer"><input type='hidden' name='确定' id='确定' value='其他保存'><a class="btn btn-info pull-right" @click="save('index1')">
                            <i class="iconfont"></i> 确定
                        </a></div>
		</form>
    </div>
</div>
			
        </div>
    </div> </div> </div> </div>
 <? include_once('footer.php');
?>
        <script>
        new Vue({
            el: '#vue',
            data: {
                template: "<?=$site_moban1?>",
                m_template: "<?=$site_sjmb?>"
            },
            methods: {
                save: function (id) {
                    var vm = this;
                    this.$post("/admin/ajax.php?act=template", $("#form-" + id).serialize())
                        .then(function (data) {
                            if (data.status == 0) {
                                vm.$message(data.message, 'success');
                            } else {
                                vm.$message(data.message, 'error');
                            }
                        });
                }
            },
            mounted: function () {
            }
        });
    </script>
</body>
</html>