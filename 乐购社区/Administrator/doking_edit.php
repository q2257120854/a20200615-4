<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if (isset($_POST['提交'])){
 
 
	null_back($_POST['px'],'请输入排序');
	null_back($_POST['name'],'请输入名称');
	null_back($_POST['url'],'请输入域名');
	null_back($_POST['xitong'],'请输入系统名称');
	null_back($_POST['money'],'请输入押金');
	null_back($_POST['qq'],'请输入客服QQ');
  
	 
    $_data['name'] = $_POST['name'];
   	$_data['px'] = $_POST['px'];
   	$_data['url'] = $_POST['url'];
   	$_data['xitong'] = $_POST['xitong'];
   	$_data['money'] = $_POST['money'];
   	$_data['qq'] = $_POST['qq'];
     
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'tuijian set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if (mysql_query($sql)) {
 
  
  		alert_href('修改成功!','');
	} else {
		alert_back('修改失败!');
	}
}

 ?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<script type="text/javascript" src="file/colorPicker/jquery.colorpicker.js"></script>
<style>  
label {font-size:12px;cursor:pointer;}  
label i {font-size:12px;font-style:normal;display:inline-block;width:12px;height:12px;text-align:center;line-height:12px;color:#fff;vertical-align:middle;margin:-2px 2px 1px 0px;border:#2489c5 1px solid;}  
input[type="checkbox"],input[type="radio"] {display:none;}  
input[type="radio"] + i {border-radius:7px;}  
input[type="checkbox"]:checked + i,input[type="radio"]:checked + i {background:#2489c5;}  
input[type="checkbox"]:disabled + i,input[type="radio"]:disabled + i {border-color:#ccc;}  
input[type="checkbox"]:checked:disabled + i,input[type="radio"]:checked:disabled + i {background:#ccc;}  
</style>  

</head> 
<body> 
<div id="body">
	<div class="zl-tab-bd">
		<div class="zl-dd">
        <?php
		
 
 


 
 

					$result = mysql_query('select * from '.flag.'tuijian where id = '.$_GET['id'].'  ');
					if ($row = mysql_fetch_array($result)){
					?>
 			<form id="annForm" name="annForm" action="" method="POST">
 			 
               
          
                <dl>
                <dt>
                  <label for="label2">系统名称：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  value="<?=$row['xitong']?>"  name="xitong" id="xitong"/>
                </dd>
		      </dl>
              <dl>
                
 			  <dl>
                <dt>
                  <label for="label2">社区名称：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"    value="<?=$row['name']?>" style="width:300px;" name="name" id="name"/>
                </dd>
		      </dl>
              
              
                <dl>
                <dt>
                  <label for="label2">平台域名：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"   value="<?=$row['url']?>" style="width:300px;" name="url" id="url"/>
                </dd>
		      </dl>
              
              <dl>
                <dt>
                  <label for="label2">上缴押金：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  value="<?=$row['money']?>" name="money" id="money"/>
                </dd>
		      </dl>
              
               <dl>
                <dt>
                  <label for="label2">客服QQ：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"  value="<?=$row['qq']?>"name="qq" id="qq"/>
                </dd>
		      </dl>
              
                          
                <dl>
                <dt>
                  <label for="label2">排名顺序：</label>
                </dt>
 			    <dd>
                  <input class="txt1" type="text"   value="<?=$row['px']?>" style="width:300px;" name="px" id="px"/>
                </dd>
		      </dl>
              
                    
           
						<dl>
							<dt></dt>
							<dd class="baocun"><input type="submit" id="提交" name="提交" class="button03" value="修改信息"/>
								<input type="button" id="btn_back" name="btn_back"  onclick="javascript:history.back(-1);" class="btn-close" value="返回列表"/></dd>
						</dl>	 
					 
						 
				
		  </form>
          <? }?>
		</div>
	</div>
	</div>