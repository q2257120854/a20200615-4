<?php 
$title='供货';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
  check_qx($site_qx,'供货权限');
$nav = 'supplier';
if(isset($_POST['提交'])){ 
  $gsys=$_POST['gsys'];
 $mintx=$_POST['mintx'];
 $sxf=$_POST['sxf'];
 $yjsys=$_POST['yjsys'];
 $yjje=$_POST['yjje'];
 $sptc=$_POST['sptc'];
 $tcbl=$_POST['tcbl'];
  $gonghuo=$gsys.",".$mintx.",".$sxf.",".$yjsys.",".$yjje.",".$sptc.",".$tcbl."," ;
 if ($gsys==1)
 { 	null_back($mintx,'请输入最低提现金额');	null_back($sxf,'请输入提现手续费'); }
 if ($yjsys==1)
 { 	null_back($yjje,'请输入押金金额');}
 if ($sptc==1)
 { 	null_back($tcbl,'请输入提成比例');}
 
  
	$_data['gh'] = $gonghuo;
  	
  	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	 
	if(mysql_query($sql)){
		alert_href('设置成功!','');
	}else{
		alert_back('修改失败!');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
     <script type="text/javascript">
 	<? if ($site_gonghuo[3]==0){$yjms='none';}else{$yjms='block';}?>
 	<? if ($site_gonghuo[5]==0){$sptc='none';}else{$sptc='block';}?>
	
  	window.onload =function() {document.getElementById('sp').style.display='<?=$sptc?>';document.getElementById('yjms').style.display='<?=$yjms?>';}
  
 

   function getsptc(){
  if(document.getElementById('sptc').value=='0')
{document.getElementById('sp').style.display='none';}
else
{document.getElementById('sp').style.display='block';}
      }
	  
	  
	     function getjianglims(){
  if(document.getElementById('yjms0').value=='0')
{document.getElementById('yjms').style.display='none';}
else
{document.getElementById('yjms').style.display='block';}
      }
	   </script>   

<div class="wrapper preload">

<div class="wrapper preload">
 
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
              <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
                                            <form class="form-horizontal" id="form-ghconfig" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        供货配置
                    </div>
                    <div class="panel-body">
                          <div class="form-group" >
                                      <label class="col-lg-3 control-label">供货说明</label>
                                        <div class="col-lg-8">
                                         <span class="btn btn-info">供货商后台地址:<a  style="color:#FFF"  href="/gonghuo/index" target="_blank"><?=$dq_url?>/gonghuo/index</a></span>
                                        </div>
                                </div>

                              <div class="form-group" >
                                <label class="col-lg-3 control-label">供货设置</label>
                                <div class="col-lg-8">
                                  <select class="form-control"     name="gsys" id="gsys">
                                    <option <? if ($site_gonghuo[0]==0){echo "selected";}?>   value="0">发布商品需要审核</option>
                                    <option data-url=""  <? if ($site_gonghuo[0]==1){echo "selected";}?>  value="1" >发布商品不需要审核</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label">最低提现</label>
                                <div class="col-lg-8">
                                  <div class="input-group">
                                    <input name="mintx" type="text"   style="width:277px" class="form-control" id="mintx" placeholder="请输入最低提现金额"   value="<?=$site_gonghuo[1]?>">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label">提现手续费</label>
                                <div class="col-lg-8">
                                  <div class="input-group">
                                    <input name="sxf" type="text"   style="width:277px" class="form-control" id="mintx" placeholder="请输入提现手续费"   value="<?=$site_gonghuo[2]?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="panel">
                            <div class="panel-heading bg-gradient-vine"> 其他设置 </div>
                            <div class="panel-body">
                              <div class="form-group" >
                                <label class="col-lg-3 control-label">押金设置</label>
                                <div class="col-lg-8">
                                  <select class="form-control"    name="yjsys"  onchange="getjianglims()"   id="yjms0"    >
                                    <option  data-name="0"  <? if ($site_gonghuo[3]==0){echo "selected";}?>   value="0">不需要押金</option>
                                    <option  data-name="1"  <? if ($site_gonghuo[3]==1){echo "selected";}?>   value="1">需要押金</option>
                                  </select>
                                </div>
                              </div>
                              <div id="yjms" >
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">押金金额</label>
                                  <div class="col-lg-8">
                                    <div class="input-group">
                                      <input name="yjje" type="text"   style="width:277px" class="form-control" id="mintx" placeholder=""   value="<?=$site_gonghuo[4]?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group" >
                                <label class="col-lg-3 control-label">商品提成</label>
                                <div class="col-lg-8">
                                  <select class="form-control"    name="sptc"  onchange="getsptc()"   id="sptc"    >
                                    <option  data-name="0"  <? if ($site_gonghuo[5]==0){echo "selected";}?>   value="0">关闭</option>
                                    <option  data-name="1"  <? if ($site_gonghuo[5]==1){echo "selected";}?>   value="1">开启</option>
                                  </select>
                                </div>
                              </div>
                              <div id="sp" >
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">提成比例</label>
                                  <div class="col-lg-8">
                                    <div class="input-group">
                                      <input name="tcbl" type="text"   style="width:277px" class="form-control"  placeholder=""   value="<?=$site_gonghuo[6]?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                                                          <input name="提交" class="btn btn-info pull-right" value="确定" type="submit">   </div>

                            </div>
                          
                        
                        </div>
                      </div>
                      </div>
                      </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
 


 
<? include_once( 'footer.php'); ?>
 </body>
</html>
