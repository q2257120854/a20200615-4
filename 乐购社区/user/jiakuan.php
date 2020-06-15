<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'member';

 

if(isset($_POST['提交'])){
	 null_back($_POST['point'],'请输入金额');
	 null_back($_POST['qk'],'请输入充值备注');
if ($_POST['lx']==1 and $site_point < $_POST['point'])
{		alert_back('加款失败:您的余额不足!');}

 if ($_POST['lx']==1)
 {    $xfhje =$_POST['m_point']+$_POST['point'];  }

 if ($_POST['lx']==0)
 {   $xfhje =$_POST['m_point']-$_POST['point'];   }
 $_data['point'] = $xfhje; 
   //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$_GET['id'].' ';
	if(mysql_query($sql)){
		
    $_data1['hyid'] = $_GET['id'];
	$_data1['hyname'] = $_POST['hyname'];
 	$_data1['xf_qje'] = $_POST['m_point'];
 	$_data1['xf_je'] = $_POST['point'];
 	$_data1['xf_hje'] = $xfhje;
 	$_data1['xf_date'] = $sj;
 	$_data1['xf_qk'] = $_POST['qk'];
 	$_data1['zid'] = $zhu_id;
 	$_data1['fid'] = $fen_id;

  if ($_POST['lx']==1)
 {  	$_data1['xf_lx'] = 1;  }

 if ($_POST['lx']==0)
 {  	$_data1['xf_lx'] =0;  }
	
  	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	
	//扣除自身余额
	$hpoint =$site_point-$_POST['point'];
	$_data2['point'] =$hpoint;  
  	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'fenzhan set '.arrtoupdate($_data2).' where id = '.$fen_id.' and zid = '.$zhu_id.'';
    mysql_query($sql2);
	
	
			//余额记录
	$_data3['zid'] = $zhu_id;
	$_data3['fid'] = $fen_id;
	$_data3['qje'] = $site_point;
	$_data3['je'] = $_POST['point'];
 	$_data3['hje'] = $site_point-$_POST['point'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '用户加款';
 	$_data3['lx'] = 0;
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'fenzhanpricejl  ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
  
  
  		alert_href('操作成功!','member.php');
	}else{
		alert_back('操作失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>余额充值</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
      
  


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
					$result1 = mysql_query('select * from '.flag.'user where ID = '.$_GET['id'].' and zid = '.$zhu_id.' and fid = '.$fen_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form method="post" id="form">
    <input name="m_point" type="hidden" value="<?=$row['point']?>">
    <input name="hyname" type="hidden" value="<?=$row['name']?>">
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">[<?=$row['name']?>]余额操作</div>
                    <div class="smart-widget-inner">
                        
                            
                                
                                
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
 
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">操作类型</label>
                                        <div class="col-lg-8">
                                            <select  name="lx" class="form-control" id="lx" v-model="apiType">
                                                <option    value="1">充值</option>
                                                <option    value="0">扣除</option>
                                            
                                             </select>
                              </div>
                              </div>
              
              
              
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">余额(元)</label>
                                    <div class="col-lg-8">
                             <input name="" readonly type="text" class="form-control" id="s_name" placeholder=""  value="<?=$row['point']?>">

                                  </div>
                                </div>
                                 
                                 
                                 
                                 
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">金额(元)</label>
                                    <div class="col-lg-8">
                             <input name="point" type="text" class="form-control" id="" placeholder="请输入金额"  value="">

                                  </div>
                                </div>
                                 
             
              
                            
                                 
                                 
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">操作备注</label>
                                    <div class="col-lg-8">
                             <input name="qk" type="text" class="form-control" id="" placeholder="请输入操作备注"  value="">

                                  </div>
                                </div>
                                 
                               
                          
                             
                              
                        </div>    </div>    </div>   
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="操作">



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
