<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shop';
//商品信息
		$result1 = mysql_query('select * from '.DATA_NAME.'.'.flag.'shop where id = '.$_GET['id'].' ');
			 if ($row = mysql_fetch_array($result1)){
				 $s_xid=$row['s_xid'];
 
			 }

//模板查询
			$result1 = mysql_query('select * from '.DATA_NAME.'.'.flag.'xiadan where id = '.$s_xid.' ');
			 if ($row = mysql_fetch_array($result1)){
           $x_name=$row['x_name'];
           $wen_1=$row['wen_1'];
           $wen_2=$row['wen_2'];
           $wen_3=$row['wen_3'];
           $wen_name1=$row['wen_name1'];
           $wen_name2=$row['wen_name2'];
           $wen_name3=$row['wen_name3'];
           $mima_1=$row['mima_1'];
           $mima_2=$row['mima_2'];
           $mima_3=$row['mima_3'];
           $mima_name1=$row['mima_name1'];
           $mima_name2=$row['mima_name2'];
           $mima_name3=$row['mima_name3'];		   
           $beizhu_1=$row['beizhu_1'];
           $beizhu_2=$row['beizhu_2'];
           $beizhu_3=$row['beizhu_3'];
           $beizhu_name1=$row['beizhu_name1'];
           $beizhu_name2=$row['beizhu_name2'];
           $beizhu_name3=$row['beizhu_name3'];			 }

 

if(isset($_POST['提交'])){
 	
if ($_POST['s_dzt'] ==1)
{ 
 	 null_back($_POST['s_durl'],'请输入对接平台域名!');

 	// null_back($_POST['s_dnumber'],'请输入对接的数量参数');
 	 non_numeric_back($_POST['s_dsid'],'请输入对接平台商品ID');
 	 null_back($_POST['s_dname'],'请输入平台登录账号');
 	 null_back($_POST['s_dpassword'],'请输入平台登录密码');
}	

if ($_POST['s_did'] ==2)
{ 
 	 null_back($_POST['s_dsqlx'],'请输入社区类型!');

 
}	
 
 
  
   $_data['s_dtype'] = $_POST['s_dtype'];

   $_data['s_durl'] = $_POST['s_durl'];
   $_data['s_dzt'] = $_POST['s_dzt'];
   $_data['s_did'] = $_POST['s_did'];
   $_data['s_dsid'] = $_POST['s_dsid'];
   $_data['s_dname'] = $_POST['s_dname'];
   $_data['s_dpassword'] = $_POST['s_dpassword'];
  // $_data['s_dnumber'] = $_POST['s_dnumber'];
   $_data['s_dwen_1'] = $_POST['wen_name1'];
   $_data['s_dwen_2'] = $_POST['wen_name2'];
   $_data['s_dwen_3'] = $_POST['wen_name3'];
   $_data['s_dmima_1'] = $_POST['mima_name1'];
   $_data['s_dmima_2'] = $_POST['mima_name2'];
   $_data['s_dmima_3'] = $_POST['mima_name3'];
   $_data['s_dbeizhu_1'] = $_POST['beizhu_name1'];
   $_data['s_dbeizhu_2'] = $_POST['beizhu_name2'];
   $_data['s_dbeizhu_3'] = $_POST['beizhu_name3'];
   $_data['s_dsqlx'] = $_POST['s_dsqlx'];
 
  	$str = arrtoinsert($_data);
	$sql = 'update '.DATA_NAME.'.'.flag.'shop set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('操作成功!','shop.php');
	}else{
		alert_back('对接失败!');
	}
}

 
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>新增对接</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="assets/style/font-awesome_4.6.3/css/font-awesome.min.css?" rel="stylesheet">

    <!-- ionicons -->
    <link href="assets/style/css/ionicons.min.css?" rel="stylesheet">

    <!-- Morris -->
    <link href="assets/style/css/morris.css?" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="assets/style/css/datepicker.css?" rel="stylesheet"/>

    <!-- Animate -->
    <link href="assets/style/css/animate.min.css?" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="assets/style/css/owl.carousel.min.css?" rel="stylesheet">
    <link href="assets/style/css/owl.theme.default.min.css?" rel="stylesheet">

    <!-- Simplify -->
    <link href="assets/style/css/simplify.min.css?" rel="stylesheet">
    <link href="assets/common/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css?"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/common/toastr/toastr.min.css?">
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
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
 
 					<?php
					$result1 = mysql_query('select * from '.DATA_NAME.'.'.flag.'shop where id = '.$_GET['id'].' ');
					if ($row = mysql_fetch_array($result1)){
					?>
      <form method="post" id="form">
         <div class="row">
             <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                    <div class="smart-widget-header">
                        Step① 商品信息
                        <span class="smart-widget-option">
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
                        
                            <ul class="widget-color-list clearfix">
                                <li style="background-color:#20232b;" data-color="widget-dark"></li>
                                <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                                <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                                <li style="background-color:#2baab1;" data-color="widget-green"></li>
                                <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                                <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                                <li style="background-color:#e36159;" data-color="widget-red"></li>
                                <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                                <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                                <li style="background-color:#fff;" data-color="reset"></li>
                            </ul>
                        </div>
                    
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 

    <div class="form-group">

                                  <label class="col-lg-3 control-label">注意事项</label>
                                    <div class="col-lg-8">
                                      <textarea name="" readonly class="form-control" id="s_name" placeholder="">对接参数若为空则不传递该参数过去</textarea>
                                   </div>
                              </div>
              
              
                  <div class="form-group">

                                  <label class="col-lg-3 control-label">商品名称</label>
                                    <div class="col-lg-8">
                             <input name="" type="text"  readonly  class="form-control" id="s_name" placeholder=""  value="<?=$row['s_name']?>" >

                                  </div>
                                </div>
                           


                                                                    <div class="form-group">
                                                                 <label class="col-lg-3 control-label">对接状态</label>
                                    <div class="col-lg-8">
   <select  name="s_dzt" class="form-control" id="s_dzt" v-model="apiType">
                                                <option  <? if ($row['s_dzt']==0) {echo "selected";}?>  value="0">禁用</option>
                                                 <option <? if ($row['s_dzt']==1) {echo "selected";}?>   value="1">启用</option>
                                               </select>

                                  </div>
                                </div>

                                                                    <div class="form-group">
                                                                 <label class="col-lg-3 control-label">对接平台</label>
                                    <div class="col-lg-8">
   <select  name="s_did" class="form-control" id="s_did" v-model="apiType">
                                                <option <? if ($row['s_did']==0) {echo "selected";}?>  value="0">超会系统</option>
                                                 <option  <? if ($row['s_did']==1) {echo "selected";}?>  value="1">亿乐系统</option>
                                                <option  <? if ($row['s_did']==2) {echo "selected";}?>  value="2">玖伍系统</option>
                                              </select>

                                  </div>
                                </div>
                                
                                
                                    
                             
 
                                <div class="form-group">
                                                                 <label class="col-lg-3 control-label">玖伍方式</label>
                                    <div class="col-lg-8">
   <select  name="s_dtype" class="form-control" id="s_dtype" >
                                                <option <? if ($row['s_dtype']==0) {echo "selected";}?>  value="0">卡密</option>
                                                 <option  <? if ($row['s_dtype']==1) {echo "selected";}?>  value="1">现金</option>
                                               </select>

                                  </div>
                                </div>
 
 
 
                                     
                                     <div class="form-group">
                                                                 <label class="col-lg-3 control-label">平台域名</label>
                                    <div class="col-lg-8">
                             <input name="s_durl" type="text"    class="form-control" id="" placeholder="请输入对接平台的域名"  value="<?=$row['s_durl']?>" >不需要加http://


                                  </div>
                                </div>
                                
                                <div class="form-group">
                                                                 <label class="col-lg-3 control-label">平台商品</label>
                                    <div class="col-lg-8">
                             <input name="s_dsid" type="text"    class="form-control" id="" placeholder="请输入对接平台的商品ID"  value="<?=$row['s_dsid']?>" >


                                  </div>
                                </div>
                                
                                


                                    <div class="form-group">
                                                                 <label class="col-lg-3 control-label">平台账号</label>
                                    <div class="col-lg-8">
                             <input name="s_dname" type="text"    class="form-control" id="s_dname" placeholder="请输入对接平台的登录账号"  value="<?=$row['s_dname']?>" >


                                  </div>
                                </div>



 
 
                                     <div class="form-group">
                                                                 <label class="col-lg-3 control-label">平台密码</label>
                                    <div class="col-lg-8">
                             <input name="s_dpassword" type="text"    class="form-control" id="s_dpassword" placeholder="请输入对接平台的登录密码"  value="<?=$row['s_dpassword']?>" >
                                  </div>
                                </div>
 

                    


                                        </div>    </div> 
                        
                           </div>  
                        
                        
                                          
                </div>
            </div>
  
                              
                                 
 
                               
                    
                    
                               <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                    <div class="smart-widget-header">
                        Step② 对接参数
                        <span class="smart-widget-option">
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
                        
                            <ul class="widget-color-list clearfix">
                                <li style="background-color:#20232b;" data-color="widget-dark"></li>
                                <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                                <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                                <li style="background-color:#2baab1;" data-color="widget-green"></li>
                                <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                                <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                                <li style="background-color:#e36159;" data-color="widget-red"></li>
                                <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                                <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                                <li style="background-color:#fff;" data-color="reset"></li>
                            </ul>
                        </div>
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                               
                                 
                                
                                    
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label">社区类型</label>
                                    <div class="col-lg-8">
                       <input name="s_dsqlx"  value="<?=$row['s_dsqlx']?>" type="text" class="form-control" id="s_dsqlx"  placeholder="95社区请输入"    />
                        
                                  </div>
                                </div>
                                
                                
                                <div class="form-group"  style="display:none">
                                  <label class="col-lg-3 control-label">数量参数</label>
                                    <div class="col-lg-8">
                       <input name="s_dnumber"  value="<?=$row['s_dnumber']?>" type="text" class="form-control" id="s_dnumber"  placeholder="请输入对方的数量参数"    />
                       亿乐一般为:number
                                  </div>
                                </div>
        
                                
                              

                                <? if ($wen_1==1) {?>
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$wen_name1?></label>
                                    <div class="col-lg-8">
                       <input name="wen_name1" type="text"  value="<?=$row['s_dwen_1']?>" class="form-control"  placeholder="请输入<?=$wen_name1?>的对接参数"    />
                                  </div>
                                </div>
        
                                
                                <? }?>
                                <? if ($wen_2==1) {?>
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$wen_name2?></label>
                                    <div class="col-lg-8">
                             <input name="wen_name2" type="text"    class="form-control"   placeholder="请输入<?=$wen_name2?>的对接参数"  value="<?=$row['s_dwen_2']?>"  />
                                  </div>
                                </div>
     

                                <? }?>
                                <? if ($wen_3==1) {?>

                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$wen_name3?></label>
                                    <div class="col-lg-8">
                             <input name="wen_name3" type="text"    class="form-control" id="" placeholder="请输入<?=$wen_name3?>的对接参数"   value="<?=$row['s_dwen_3']?>"  />
                                  </div>
                                </div>
     

                                <? }?>
                                <? if ($mima_1==1) {?>
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$mima_name1?></label>
                                    <div class="col-lg-8">
                             <input name="mima_name1" type="text"    class="form-control" id="" placeholder="请输入<?=$mima_name1?>的对接参数" value="<?=$row['s_dmima_1']?>"   />
                                  </div>
                             
        </div>

                                <? }?>
                                <? if ($mima_2==1) {?>

                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$mima_name2?></label>
                                    <div class="col-lg-8">
                             <input name="mima_name2" type="text"    class="form-control" id="" placeholder="请输入<?=$mima_name2?>的对接参数"  value="<?=$row['s_dmima_2']?>"     />
                                  </div>
                                </div>
     

                                <? }?>
                                <? if ($wen_3==1) {?>

                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$mima_name3?></label>
                                    <div class="col-lg-8">
                             <input name="mima_name3" type="text"    class="form-control" id="" placeholder="请输入<?=$mima_name3?>的对接参数"  value="<?=$row['s_dmima_3']?>"   />
                                  </div>
                                </div>
       
                                

                                <? }?>
                                <? if ($beizhu_1==1) {?>

                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$beizhu_name1?></label>
                                    <div class="col-lg-8">
                             <input name="beizhu_name1" type="text"    class="form-control" id="" placeholder="请输入<?=$beizhu_name1?>的对接参数"  value="<?=$row['s_dbeizhu_1']?>"  />
                                  </div>
          </div>

                                <? }?>
                                <? if ($beizhu_2==1) {?>
                                    <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$beizhu_name2?></label>
                                    <div class="col-lg-8">
                             <input name="beizhu_name2" type="text"    class="form-control" id="" placeholder="请输入<?=$beizhu_name2?>的对接参数" value="<?=$row['s_dbeizhu_2']?>"  />
                                  </div>
                                </div>
        
                                <? }?>
                                <? if ($beizhu_3==1) {?>

                                                <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=$beizhu_name3?></label>
                                    <div class="col-lg-8">
                             <input name="beizhu_name3" type="text"    class="form-control" id="" placeholder="请输入<?=$beizhu_name3?>的对接参数"  value="<?=$row['s_dbeizhu_3']?>"    />
                                  </div>
                                </div>
           
<? }?>
                               
                                
                          </div> </div>
                                 
                                 
                                
                              
                                     <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="提交"></div>
                    
                    
            </div> 
           
                              
                            
 
                             
                    
               
 
                    
                    
                    
                </div>
            </div>
        </div>
    </form>
 
 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->



 <? include('footer.php');
?>
</div><!-- /wrapper -->

<?  include('password.php');?>
 
  </body>
</html>
