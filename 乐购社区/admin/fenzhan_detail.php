<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhan';
check_qx($site_qx,'分站管理');
 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_pic').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_pic').val(url);
				editor.hideDialog();
				}
			});
		});
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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
 
 					 	<?php
					$result1 = mysql_query('select * from '.flag.'fenzhan where id = '.$_GET['id'].' and zid ='.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form class="form-horizontal" method="post" id="form">
 <input name="f_id" type="hidden" value="<?=$row['banben']?>">
         <div class="row">
            <div class="col-lg-6">
                                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        分站资料
                    </div>
                     <div class="panel-body">
                            
 
 

                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站状态</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="<? if ($row['zt']==1) {echo '启用';} else {echo '停止';}?>" readonly>
   
                              </div>
                              </div>



                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站版本</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="  <?=get_fenzhan_banben_name($row['banben'])?>" readonly>
                              </div>
                              </div>
                                                           <div class="form-group">
                                  <label class="col-lg-3 control-label">分站域名</label>
                                   <div class="col-lg-8">
                            <input name="f_url" type="text"    readonly   class="form-control"  placeholder="请输入分站域名"  value="<?=$row['url']?>.<?=$row['url1']?>">
                              
                                

                                  </div>
                                </div>
<div class="form-group">
                                <label class="col-sm-3 control-label">用户编号</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="zuid" placeholder="输入用户编号" value="<?=$row['uid']?>" readonly
                                           @change="getUid">
                                    <input type="hidden" name="uid" :value="uInfo.uid">
                                </div>
                            </div>

                          
                          
                                <!--<div class="form-group">
                                  <label class="col-lg-3 control-label">登录账号</label>
                                    <div class="col-lg-8">
                             <input name="f_user" type="text" class="form-control"  placeholder="请输入登录账号"  value="<?=$row['loginname']?>">

                                  </div>
                                </div>

                              
                                  
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">登录密码</label>
                                    <div class="col-lg-8">
                             <input name="f_password" type="text" class="form-control"  placeholder="请输入登录密码"  value="<?=$row['loginpassword']?>">

                                  </div>
                                </div>-->
                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">分站余额</label>
                                    <div class="col-lg-8">
                             <input name="f_point" type="text" class="form-control" readonly  placeholder=""  value="<?=$row['point']?>">

                                  </div>
                                </div>
              
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">QQ</label>
                                    <div class="col-lg-8">
                             <input name="f_qq" type="text" class="form-control"  readonly  placeholder="请输入站长QQ"  value="<?=$row['qq']?>">

                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">分站标题</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['name']?>">

                                  </div>
                                </div>
          
                                         <div class="form-group">
                                  <label class="col-lg-3 control-label">分站副标题</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['sname']?>">

                                  </div>
                                </div>
              
                             
                                                            <div class="form-group">
                                  <label class="col-lg-3 control-label">分站关键字</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['des']?>">

                                  </div>
                                </div>
          
          
                                         <div class="form-group">
                                  <label class="col-lg-3 control-label">分站描述</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['key']?>">

                                  </div>
                                </div>
          
          
                <div class="form-group">
                                  <label class="col-lg-3 control-label">分站公告</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['tcnotice']?>">

                                  </div>
                                </div>


                <div class="form-group">
                                  <label class="col-lg-3 control-label">版权信息</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['bqcontent']?>">

                                  </div>
                                </div>


                <div class="form-group">
                                  <label class="col-lg-3 control-label">底部信息</label>
                                    <div class="col-lg-8">
                             <input name="" type="text" class="form-control"  readonly    value="<?=$row['endcontent']?>">

                                  </div>
                                </div> 
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger id="提交" value="返回管理">
                     
</div>
                </div>
            </div>
        </div>
    </form>

 <? }?>
</div>

        </div>
    </div><!-- /main-container -->

</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?></body>
</html>
