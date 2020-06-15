<?php 
$title='系统设置';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'home';
check_qx($site_qx,'系统设置');
if(isset($_POST['提交'])){
	$_data['name'] = $_POST['site_name'];
	$_data['sname'] = $_POST['site_sname'];
 	$_data['key'] = $_POST['site_key'];
	$_data['des'] = $_POST['site_des'];
	$_data['bqcontent'] = $_POST['site_content'];
	$_data['endcontent'] = $_POST['site_content1'];
	$_data['tcnotice'] = $_POST['site_gg'];
	$_data['notice'] = $_POST['sitenotice'];
	$_data['isktfz'] = $_POST['isktfz'];
	$_data['ispay'] = $_POST['ispay'];
	 
 	
  	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功！','home.php');
	}else{
		alert_back('修改失败！');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="assets/common/md5.min.js"></script>
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
    <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        基本设置
                    </div>
                     <div class="panel-body">
                        <form class="form-horizontal"  method="post" >
                      
                      
                         <div class="form-group">
                                <label class="col-lg-3 control-label">平台编号</label>
                                <div class="col-lg-8">
                                    <input class="form-control" value="<?=$zhu_id?>" disabled>
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <label class="col-lg-3 control-label">上级编号</label>
                                <div class="col-lg-8">
                                    <input class="form-control" value="0" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">开通时间</label>
                                <div class="col-lg-8">
                                    <input class="form-control" value="<?=$site_date?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">绑定域名</label>
                                <div class="col-lg-8">
                                  <textarea disabled class="form-control"><?php                                                                                
$result = mysql_query('select * from '.flag.'zhuzhan_domain  where zid ='.$zhu_id.'     order by ID asc  ');
						while($row = mysql_fetch_array($result)){
						echo $row['name'];	
						}
						?>
                                  </textarea>
                                </div>
                            </div>
                          

   <div class="form-group">
                                <label class="col-lg-3 control-label">自助分站</label>
                                <div class="col-lg-8">
                                    <select name="isktfz" v-model="isktfz" class="form-control">
                                        <option  <? if ($site_isktfz ==0) {echo "selected";}?> value="0">关闭用户自助开通分站</option>
                                        <option <? if ($site_isktfz ==1) {echo "selected";}?> value="1">开启用户自助开通分站</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">在线充值</label>
                                <div class="col-lg-8">
                                    <select name="ispay" v-model="ispay" class="form-control">
                                        <option <? if ($site_ispay ==0) {echo "selected";}?> value="0">关闭用户自助在线充值</option>
                                        <option <? if ($site_ispay ==1) {echo "selected";}?> value="1">开启用户自助在线充值</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-lg-3 control-label">平台标题</label>
                                <div class="col-lg-8">
                                    <input name="site_name" type="text" class="form-control"
                                           value="<?=$site_name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">平台副标题</label>
                                <div class="col-lg-8">
                                    <input name="site_sname" type="text" class="form-control"
                                           value="<?=$site_sname?>">
                                </div>
                            </div>
                            
                                                        <div class="form-group">
                                <label class="col-lg-3 control-label">弹出公告</label>
                                <div class="col-lg-8">
                                  <textarea name="site_gg" class="form-control"><?=$site_gg?></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">平台关键字</label>
                                <div class="col-lg-8">
                                  <textarea name="site_des" class="form-control"><?=$site_des?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">基本描述</label>
                                <div class="col-lg-8">
                                  <textarea name="site_key" class="form-control"><?=$site_key?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">前台公告</label>
                                <div class="col-lg-8">
                                  <textarea name="sitenotice" class="form-control"><?=$sitenotice?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">版权信息</label>
                                <div class="col-lg-8">
                                  <textarea name="site_content" class="form-control"><?=$site_content?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">底部信息</label>
                                <div class="col-lg-8">
                                  <textarea name="site_content1" class="form-control"><?=$site_content1?></textarea>
                                </div>
                            </div>
                          

                    
                    </div>
                               <div class="panel-footer">
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
                             <input name="提交"  type="submit" class="btn btn-info pull-right" id="提交"><i class="iconfont"></i>保存信息</a>
                        </div>
                    </div>
                         </form>
                </div>
            </div>
        </div>
    </div>

</div>     </div>

        </div>
 


 

 <? include_once('footer.php');
?></body>
</html>
