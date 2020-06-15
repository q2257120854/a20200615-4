<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kucun';

 check_qx($site_qx,'商品管理');

if(isset($_POST['提交'])){
	 null_back($_POST['kamicontent'],'请输入卡密内容');
 
 
 
 $array=$_POST['kamicontent'];
$array=explode("\n", $array); 
$s=[];
foreach($array as $v){
        if($v!=''){
                $v=explode('----',$v);
                if(isset($v[1])){
                        $s[]='("'.$v[0].'","'.$v[1].'")';
			 $kahao[]=$v[0];   
			 $desc[]=$v[1];  
			                 }
        }
}
 
   for ($i = 0; $i < sizeof($s); $i++) {  
    //插入卡密
     $_data['sid'] = $_GET['id'];
	$_data['zt'] =0;
	$_data['kahao'] = $kahao[$i];
 	$_data['kami'] =$desc[$i];
 	$_data['desc'] =$desc[$i];
 	$_data['date'] = $sj;
 	$_data['zid'] = $zhu_id;
 	/*$_data['hyid'] = NULL;
 	$_data['hyname'] = NULL;
 	$_data['pdate'] = NULL;
 	$_data['ID'] = NULL;
 */
  	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'shopkm ('.$str[0].') values ('.$str[1].')';
mysql_query($sql);
	 
 	     }
 	     #echo $sql; exit;

		 alert_href('成功插入'.sizeof($s).'条卡密!','');

 
  	 
 } 

 
 



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>添加卡密</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

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
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'shop where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
					?>
      <form method="post" id="form">
         <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
                   <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                  <div class="smart-widget-header">[<?=$row['name']?>] - 添加卡密</div>
                    <div class="smart-widget-inner">
                        <div class="smart-widget-hidden-section">
                          
                        </div>
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
     <div class="form-group">
                                    <label class="col-lg-3 control-label">卡密内容</label>
                                    <div class="col-lg-8">
                                 <textarea name="kamicontent" class="form-control"    style="height:150PX"  rows="3"
                                           placeholder="请输入卡密内容"></textarea>
                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning"
                                                                                             onclick="$('#form textarea[name=\'kamicontent\']').val($('#form textarea[name=\'kamicontent\']').val()+'卡密信息----备注\n');">插入格式</a>
  </div>
                                    </div>
                                     </div>
 
                          
                                
                                  </div>  </div>
                            
 
                             
                    
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="添加">



</div>
                </div>
        
    </form>
 </div></div></div></div></div></div>
 
 <? }?>
 

 <? include('footer.php');
?>
 


 
  </body>
</html>
