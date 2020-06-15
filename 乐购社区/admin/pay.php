<?php 
$title='支付接口配置';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'pay';
check_qx($site_qx,'自由对接');
if(isset($_POST['提交'])){
	$_data['zfms'] = $_POST['zfmss'];
	$_data['shurl'] = $_POST['zfurl'];
 	$_data['shid'] = $_POST['shid'];
	$_data['shkey'] = $_POST['shkey'];
 
 	
  	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('配置成功！','pay.php');
	}else{
		//die($sql);
		alert_back('配置失败！');
	}
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
<div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">支付接口配置</div>
                    <div class="panel-body">
                        <form method="post">
						<div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">支付模式</label>
                                <div class="col-lg-9">
                                    <select name="zfmss" v-model="zfmss" class="form-control">
                                        <option <? if ($site_zfms==0) {echo "selected";}?> value="0">企业支付</option>
                                        <option <? if ($site_zfms==1) {echo "selected";}?> value="1">云易支付</option>
                                    </select>
                                </div>
                            </div>
                            <? if ($site_zfms==1) {?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">推荐列表</label>
                                <div class="col-lg-9">
                                    <select class="form-control" onchange="getzhifuurl()" name="zfms" id="zfms">
                                        <option data-url="<?=$site_shurl?>" value="">易支付推荐位置500/永久，120/一年</option>
                                        <?php $result=mysql_query( 'select * from '.flag. 'yzf   order by px desc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                        <option data-url="<?=$row['url']?>" value="<?=$row['url']?>"><?=$row[ 'name']?>(http://<?=$row[ 'url']?>/)</option>
                                        <? }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">商户地址</label>
                                <div class="col-lg-9">
                                    <input type="text" name="zfurl" id="zfurl" placeholder="请输入支付站的域名不加http" value="<?=$site_shurl?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">商户编号</label>
                                <div class="col-lg-9">
                                    <input name="shid" type="text" class="form-control" placeholder="请输入对接易支付ID" value="<?=$site_shid?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">商户密钥</label>
                                <div class="col-lg-9">
                                    <input name="shkey" type="text" class="form-control" placeholder="请输入对接易支付Key" value="<?=$site_shkey?>">
                                </div>
                            </div>
                            <? }?>
							</div>
                    </div>
                    <div class="panel-footer">
                                <input name="提交" type="submit" class="btn btn-info pull-right" id="提交" value="保存修改">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 <? include_once('footer.php');
?>
 <script language="javascript">
   function getzhifuurl(){
    var url = $("#zfms").find("option:selected").attr("data-url");
     document.getElementById('zfurl').value=url;
      }
	  
	  
	     function getjianglims(){
  if(document.getElementById('jlms').value=='0')
{document.getElementById('ms').style.display='none';}
else
{document.getElementById('ms').style.display='block';}
      }
	  
 </script>      
</body>
</html>
