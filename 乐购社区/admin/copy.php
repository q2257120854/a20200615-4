<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
 $nav = 'copy';

 

if($_POST['提交']=='克隆'){
	include('postcheck.php');

	 null_back($_POST['sid'],'请选择要克隆的商品');
	 null_back($_POST['s_pid'],'请选择加价模板');
	 null_back($_POST['s_cid'],'请选择商品分类');
	 null_back($_POST['s_price'],'请输入商品价格');
	 null_back($_POST['s_order'],'请输入商品排序');
  	 non_numeric_back($_POST['s_fprice1'],'请输入'.get_fenzhan_banben_name(1).'的价格');
   	 non_numeric_back($_POST['s_fprice2'],'请输入'.get_fenzhan_banben_name(2).'的价格');
   	 non_numeric_back($_POST['s_fprice3'],'请输入'.get_fenzhan_banben_name(3).'的价格');	 
	 	$result1 = mysql_query('select * from '.flag.'shop where id = '.$_POST['sid'].' and zid = '.$_POST['zid'].' ');
					if ($row1 = mysql_fetch_array($result1)){
						$xid=$row1['xid'];
						$iscfxd=$row1['iscfxd'];
						$isbd=$row1['bd'];
						$istk=$row1['tk'];
						$minnum=$row1['minnum'];
						$maxnum=$row1['maxnum'];
						$spic=$row1['pic'];
						$name=$row1['name'];
						$unit=$row1['unit'];
						$pic=$row1['pic'];
						$content=$row1['content'];
						$jj = $rowx['jj'];
						$dkey1 = $rowx['duijiekey1'];
            $dkey2 = $rowx['duijiekey2'];
            $dkey3 = $rowx['duijiekey3'];
            $dkey4 = $rowx['duijiekey4'];
						$canshu = $rowx['canshu'];
 					}
					
				
				else
				{ alert_href('商品不存在;',''); }
 
 	 
	
	$_data['minnum'] = $minnum;
	$_data['maxnum'] = $maxnum;
	$_data['pid'] = $_POST['s_pid'];
 	$_data['xid'] = $xid;
	$_data['cid'] = $_POST['s_cid'];
	$_data['pic'] = $spic;
 	$_data['name'] = $name;
 	$_data['unit'] = $unit;
	$_data['bd'] = $isbd;
	$_data['tk'] = $istk;
 	$_data['price'] = $_POST['s_price'];
 	$_data['fprice1'] = $_POST['s_fprice1'];
 	$_data['fprice2'] = $_POST['s_fprice2'];
 	$_data['fprice3'] = $_POST['s_fprice3'];
 	$_data['sorder'] = $_POST['s_order'];
 	$_data['content'] = addcslashes($content);
 	$_data['zt'] = 1;
 	$_data['iscfxd'] = $iscfxd;
    $_data['date'] = $sj;
    $_data['zid'] = $zhu_id;
	

   $_data['duijie'] = $_POST['duijieid'];
   $_data['duijiesid'] = $_POST['duijiesid'];
   $_data['duijiekey1'] = $dkey1;
   $_data['duijiekey2'] = $dkey2;
   $_data['duijiekey3'] = $dkey3;
   $_data['duijiekey4'] = $dkey4;
   $_data['duijiefs'] = $_POST['fs'];
   $_data['duijiesqlx'] = $_POST['sqlx'];
   
   $_data['duijiecgzt'] = $_POST['duijiecgzt'];
        $_data['jj'] = $jj;
		$_data['canshu'] = $canshu;

	
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'shop ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		$ID = mysql_insert_id();
 		alert_href('商品克隆成功!','shop.php');
	}else{
		alert_back('克隆失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
   <script type="text/javascript">
   function getdomain(){
    var url = $("#zhuzhan").find("option:selected").attr("data-url");
      document.getElementById('zhuurl').value=url;
      }
</script>


<!-- 玖伍-->
   <script type="text/javascript">
   function aa(){
    var sqlx = $("#duijiesid").find("option:selected").attr("data-id");
      document.getElementById('sqlx').value=sqlx;
      }
</script>

<script language="JavaScript" type="text/javascript" src="js/jo.ajax.js"></script>
<script language="javascript" type="text/javascript">

function testPost_fy()
 {
	   var input=document.getElementById("zhuurl");//通过id获取文本框对象
 //  alert (input.value);


	 Ajax.post("zhushop.php?act=add&url="+input.value,"xiaoyewl=true"+input.value, function(msg,obj,setting){ document.getElementById("ajaxResult_fy").innerHTML=msg;} );}
     
     
     
     
 


 function isEmpty(){   
    //form1是form中的name属性   
    var _form = document.form1;   

    if(trim(_form.sid.value)==""){   
        alert("商品不能为空!");           
        return false;   
    }   
    if(trim(_form.pwd.value)==""){   
        alert("密码不能为空!");          
        return false;   
    }  

    return true;

}

  
  </script>


<script language="javascript" type="text/javascript">
function duijie_post(value)
 {  var selectedOption=value.options[value.selectedIndex];   
 //alert(selectedOption.value);   
	Ajax.post("copyduijie.php?id="+selectedOption.value,"id1="+selectedOption.value,
    function(msg1,obj1,setting1){ document.getElementById("duijie_info").innerHTML=msg1;} );}
 </script>
 

       <script type="text/javascript">
			     function getcanshu(){
    var canshu = $("#duijiesid").find("option:selected").attr("data-id");
      document.getElementById('canshu').value=canshu;
      }
 	  
	   


 	      function ylshopcanshu(){
       var sid = $("#duijiesid").find("option:selected").attr("value");
 	   var data = $("#form1").serialize();
            $.klsf.ajax("ajax.php?act=getyileGoodsParam="+sid+"", data, function (json) {
                if (json.code === 0) {
                    $.klsf.showMessage(json.message,'success');
                    setTimeout(function () {
                    document.getElementById('canshu').value=data.param;
                    }, 1500);
                } else {
                    $(".code_img").click();
                    $.klsf.toastrError(json.message,'error');
                }
            });
			
			
 
        } 
</script>    

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
                 
    <form class="form-horizontal" method="post" id="form1" name="form1"> 
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        主站列表
                    </div>
                    <div class="panel-body">
                        
                            <input type="hidden" name="action" value="webConfig">
                             
                     
                              
                      
     <div class="form-group" >
                                      <label class="col-lg-3 control-label">主站列表</label>
                                        <div class="col-lg-8">
              <select class="form-control"onchange="getdomain()"    name="zhuzhan" id="zhuzhan">
                                             						   <?php                                                                                
 						$result = mysql_query('select * from '.flag.'zhuzhan   order by ID asc  ');
						while($row = mysql_fetch_array($result)){
							
								$result1 = mysql_query('select * from '.flag.'zhuzhan_domain where zid = '.$row['ID'].'    order by ID asc     ');
						while($row1 = mysql_fetch_array($result1)){
						?>
                                                <option    data-url="<?=$row1['name']?>"  value="0"><?=$row1['name']?></option>
                                                <? } }?>
                                                                                      
                                                                                             </select>
                                        </div>
                                </div>

 
     <div class="form-group">
                                    <label class="col-lg-3 control-label">主站域名</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                              <input name="zhuurl"   id="zhuurl" type="text"
                                                   class="form-control"
                                                   placeholder="请输入别人的主站域名">
                                            <div class="input-group-btn">
                                                <button type="button"   onclick="testPost_fy();" 
                                                        class="btn btn-success no-shadow upload_btn">获取
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
      <font id="ajaxResult_fy">
 
</font>
             
             

                            
                                                  
                    </div>
                    
                </div>
            </div>
       
        
        
        
           <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        商品对接
                    </div>
                    <div class="panel-body">
                             <div class="form-group">
                                    <label class="col-lg-3 control-label">对接账户</label>
                                    <div class="col-lg-8">
                           <select name="duijie"   class="form-control"   onClick="duijie_post(this)"  >
                                            <option   value="">请选择对接账户</option>
            <?php
					 
						$result1 = mysql_query('select * from '.flag.'duijie where zid = '.$zhu_id.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                   <option       value="<?=$row1['ID']?>"  ><?=$row1['name']?></option>
                                                   <? }?>                                  
                                                                  
                                                                  
                                                                                     </select>
                                    </div>
                                </div>
                            
                          
                                 
                                 <font id="duijie_info">
                                 </font>

                                   
                                 </div>
                         
                        
                             
      
      
                                  </div>
                            
                                                  
                    </div>
                    <div class="panel-footer">
                                                                               <input name="提交"  onclick="isEmpty()"   type="submit"  class="btn btn-info pull-right" id="提交" value="克隆">

                   



</div>
          </div>
    </form>
 
</div></div> </div>

                             
<!-- /wrapper -->


 
  <? include_once('footer.php');
?></body>
</html>
