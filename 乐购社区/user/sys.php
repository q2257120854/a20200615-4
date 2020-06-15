<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'sys';
check_qx($site_qx,'系统设置');
if(isset($_POST['提交'])){
	$_data['name'] = $_POST['site_name'];
	$_data['sname'] = $_POST['site_sname'];
 	$_data['key'] = $_POST['site_key'];
	$_data['des'] = $_POST['site_des'];
//	$_data['s_logo'] = $_POST['site_logo'];
	$_data['bqcontent'] = $_POST['site_content'];
	//$_data['s_model'] = $_POST['site_model'];
	$_data['endcontent'] = $_POST['site_content1'];
	$_data['tcnotice'] = $_POST['site_gg'];
	$_data['isktfz'] = $_POST['isktfz'];
	$_data['ispay'] = $_POST['ispay'];
	 	
  	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$fen_id.'';
	if(mysql_query($sql)){
		alert_href('系统设置修改成功!','sys.php');
	}else{
		alert_back('修改失败!');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>系统设置</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    系统配置                    <span class="smart-widget-option">
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
                                <label class="col-lg-3 control-label">站点编号</label>
                                <div class="col-lg-8">
                                    <input class="form-control" value="<?=$fen_id?>" disabled>
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
                                    <input class="form-control" value="<?=$site_url1?>.<?=$site_url2?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">一级域名</label>
                                <div class="col-lg-8">
                                    <input class="form-control" name="extradomain" value="<?=$site_url2?>" disabled>
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
                                <label class="col-lg-3 control-label">网站标题</label>
                                <div class="col-lg-8">
                                    <input name="site_name" type="text" class="form-control"
                                           value="<?=$site_name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">网站副标题</label>
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
                                <label class="col-lg-3 control-label">网站关键字</label>
                                <div class="col-lg-8">
                                  <textarea name="site_des" class="form-control"><?=$site_des?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">网站描述</label>
                                <div class="col-lg-8">
                                  <textarea name="site_key" class="form-control"><?=$site_key?></textarea>
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
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
                             <input name="提交"  type="submit" class="btn btn-purple" id="提交" value="保存修改">
                        </div>
                    </div>
                         </form>
                </div>
            </div>
        </div>
    </div>

</div>

        </div>
    </div><!-- /main-container -->

 <? include('footer.php');
?>
 

<?  include('password.php');?>
 

 </body>
</html>
