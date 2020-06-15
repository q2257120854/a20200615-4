<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'templates_add';

 

if(isset($_POST['提交'])){
 null_back($_POST['x_name'],'');
 	
 	
	$_data['name'] = $_POST['x_name'];
	$_data['key1'] = $_POST['key1'];
	$_data['key2'] = $_POST['key2'];
 	$_data['key3'] = $_POST['key3'];
 	$_data['key4'] = $_POST['key4'];
 	$_data['keyname1'] = $_POST['keyname1'];
 	$_data['keyname2'] = $_POST['keyname2'];
 	$_data['keyname3'] = $_POST['keyname3'];
 	$_data['keyname4'] = $_POST['keyname4'];
    $_data['zid'] = $zhu_id;
  	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'moban ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('模板添加成功!','');
	}else{
		alert_back('添加失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
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
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
    <form method="post" id="form">
            <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-yellow">
                        下单模板
                        </div>
                        <div class="smart-widget-body">
                          <div class="form-horizontal">
<p><p>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">模板名称</label>
                                    <div class="col-lg-8">
                             <input name="x_name" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数名称1</label>
                                    <div class="col-lg-8">
                             <input name="keyname1" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数1</label>
                                    <div class="col-lg-8">
                             <input name="key1" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数名称2</label>
                                    <div class="col-lg-8">
                             <input name="keyname2" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数2</label>
                                    <div class="col-lg-8">
                             <input name="key2" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数名称3</label>
                                    <div class="col-lg-8">
                             <input name="keyname3" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数3</label>
                                    <div class="col-lg-8">
                             <input name="key3" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数名称4</label>
                                    <div class="col-lg-8">
                             <input name="keyname4" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">参数4</label>
                                    <div class="col-lg-8">
                             <input name="key4" type="text" class="form-control" id="s_name" placeholder="" value="">

                                  </div>
                                </div>
                              
                              </div>
                            </div>
                        </div>    
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="添加模板">



</div>
                </div>
            </div>
        </div>
    </form>
 
</div>

        </div>
    </div><!-- /main-container -->



 <? include('footer.php');
?>
</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
