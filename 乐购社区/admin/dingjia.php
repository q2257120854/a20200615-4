<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'member_level';

 

if(isset($_POST['分类'])){
	 null_back($_POST['l_price'],'请输入定价');
 	
	
	$_data['l_price'] = $_POST['l_price'];
 	$str = arrtoinsert($_data);
	$sql = 'update '.DATA_NAME.'.'.flag.'member_level set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('定价成功!','member_level.php');
	}else{
		alert_back('定价失败!');
	}
}



 ?>
 
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
<?php
					$result = mysql_query('select * from '.DATA_NAME.'.'.flag.'member_level where id = '.$_GET['id'].' ');
					if ($row = mysql_fetch_array($result)){
					?>
 					
    <form method="post" id="form">
        <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">用户定价
                        </div>
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">等级</label>
                                    <div class="col-lg-8">
                             <input type="text" name="l_name" placeholder="" readonly value="<?=$row['l_name']?>" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label">定价</label>
                                    <div class="col-lg-8">
                             <input name="l_price" type="text" class="form-control" id="l_price" placeholder="请输入定价"  value="<?=$row['l_price']?>">

                                    </div>
                                </div>
                                
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="分类"  type="submit"  class="btn btn-primary" id="分类" value="设置">



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


 
  <? include_once('footer.php');
?></body>
</html>
