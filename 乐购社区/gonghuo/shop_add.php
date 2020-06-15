<?php
include '../system/inc.php';
include './admin_config.php';
include './check.php';
$nav = 'shopadd';
check_qx($site_qx, '商品管理');
//同系统查询主站ID
if (isset($_POST['提交'])) {
    null_back($_POST['s_name'], '请输入商品名称');
    null_back($_POST['s_price'], '请输入商品价格');
    null_back($_POST['s_unit'], '请输入商品单位');
    null_back($_POST['s_pid'], '请选择加价模板');
    null_back($_POST['s_xid'], '请选择下单模板');
    non_numeric_back($_POST['s_dnum'], '请输入最低购买数量');
    non_numeric_back($_POST['s_gnum'], '请输入最高购买数量');
    non_numeric_back($_POST['s_order'], '排序必须是数字');
    non_numeric_back($_POST['s_fprice1'], '请输入' . get_fenzhan_banben_name(1) . '的价格');
    non_numeric_back($_POST['s_fprice2'], '请输入' . get_fenzhan_banben_name(2) . '的价格');
    non_numeric_back($_POST['s_fprice3'], '请输入' . get_fenzhan_banben_name(3) . '的价格');
		//同系统查询商品模板

        $result1 = mysql_query('select * from  ' . flag . 'shop where ID = ' . $_POST['duijiesid'] . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $xiadanid = $row['xid'];
        }
        //根据模板查询对接参数
        $result1 = mysql_query('select * from  ' . flag . 'moban where ID = ' . $xiadanid . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $zhuzhan1 = $row['key1'];
            $zhuzhan2 = $row['key2'];
            $zhuzhan3 = $row['key3'];
            $zhuzhan4 = $row['key4'];
        }
    	//账户查询
			$result1 = mysql_query('select * from  '.flag.'duijie where id = '.$_POST['duijieid'].' and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
				 $pingtai=$row['pingtai'];
				 $pingtaiurl=$row['url'];
				 $loginname=$row['loginname'];
				 $loginpassword=$row['loginpassword'];
			 }

    null_back($_POST['duijie'], '请选择对接账户!');
    /*null_back($_POST['sid'], '请输入对方商品ID!');
    if ($pingtai == 3) {
        null_back($_POST['sqlx'], '请输入社区类型!');
    }*/
				$result1 = mysql_query('select * from  '.flag.'moban where id = '.$_POST['s_xid'].' ');
			 if ($row = mysql_fetch_array($result1)){
				 $keyname1=$row['keyname1'];
				 $keyname2=$row['keyname2'];
				 $keyname3=$row['keyname3'];
				 $keyname4=$row['keyname4'];
				 $key1=$row['key1'];
				 $key2=$row['key2'];
				 $key3=$row['key3'];
				 $key4=$row['key4'];

				 $jiuwu1=$row['dkey1'];
				 $jiuwu2=$row['dkey2'];
				 $jiuwu3=$row['dkey3'];
				 $jiuwu4=$row['dkey4'];
 
				 $yile1=$row['yile1'];
				 $yile2=$row['yile2'];
				 $yile3=$row['yile3'];
				 $yile4=$row['yile4'];

	 }

//对接账户查询
			$result1 = mysql_query('select * from  '.flag.'duijie where id = '.$_POST['duijieid'].' and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
				 $dpingtai=$row['pingtai'];
 			 }
			 
		if ($dpingtai==1)
		
		 $result1 = mysql_query('select * from  '.flag.'shop where ID = '.$_POST['duijiesid'].' ');
 if ($row = mysql_fetch_array($result1)){
  $xiadanid=$row['xid'];
 	 }
	 if ($pingtai == 1) {
        $dkey1 = $zhuzhan1;
        $dkey2 = $zhuzhan2;
        $dkey3 = $zhuzhan3;
        $dkey4 = $zhuzhan4;
    }
elseif ($pingtai == 2) {
        $dkey1 = $yile1;
        $dkey2 = $yile2;
        $dkey3 = $yile3;
        $dkey4 = $yile4;
    }
elseif ($pingtai == 3) {
	$jw=get95Post($_POST['sid'],$pingtaiurl, $loginname, $loginpassword);
	//print_r($jw);
	$j=$jw['post'];
		$j=explode(',',$j);
				//print_r($j);
        $dkey1 = $j['0'];
        $dkey2 = $j['1'];
        $dkey3 = $j['2'];
        $dkey4 = $j['3'];
    }
elseif ($pingtai == 4) {
        $dkey1 = $yile1;
        $dkey2 = $yile2;
        $dkey3 = $yile3;
        $dkey4 = $yile4;
    }else{
		 $result1 = mysql_query('select * from  '.flag.'moban where ID = '.$xiadanid.' ');
 if ($row = mysql_fetch_array($result1)){
				 $zhuzhan1=$row['key1'];
				 $zhuzhan2=$row['key2'];
				 $zhuzhan3=$row['key3'];
				 $zhuzhan4=$row['key4'];
				  	 }
        $dkey1 = $zhuzhan1;
        $dkey2 = $zhuzhan2;
        $dkey3 = $zhuzhan3;
        $dkey4 = $zhuzhan4;
    }
    $_data['duijie'] = $_POST['duijieid'];
    $_data['duijiesid'] = $_POST['duijiesid'];
    $_data['duijiekey1'] = $dkey1;
    $_data['duijiekey2'] = $dkey2;
    $_data['duijiekey3'] = $dkey3;
    $_data['duijiekey4'] = $dkey4;
    if ($_POST['fs'] != '') {
        $_data['duijiefs'] = $_POST['fs'];
    }
    $_data['duijiesqlx'] = $_POST['sqlx'];
    $_data['duijiecgzt'] = $_POST['duijiecgzt'];
    $_data['minnum'] = $_POST['s_dnum'];
    $_data['maxnum'] = $_POST['s_gnum'];
    $_data['pid'] = $_POST['s_pid'];
    $_data['xid'] = $_POST['s_xid'];
    $_data['cid'] = $_POST['s_cid'];
    $_data['pic'] = $_POST['s_pic'];
    $_data['name'] = $_POST['s_name'];
    $_data['unit'] = $_POST['s_unit'];
    $_data['bd'] = $_POST['s_bd'];
    $_data['tk'] = $_POST['s_tk'];
    $_data['price'] = $_POST['s_price'];
    $_data['fprice1'] = $_POST['s_fprice1'];
    $_data['fprice2'] = $_POST['s_fprice2'];
    $_data['fprice3'] = $_POST['s_fprice3'];
    $_data['sorder'] = $_POST['s_order'];
    $_data['content'] = $_POST['s_content'];
    $_data['zt'] = 0;
    $_data['iscfxd'] = $_POST['iscfxd'];
    $_data['date'] = $sj;
    $_data['zid'] = $zhu_id;
    $_data['supid'] = $supid;
	  if ($_data['duijie']=='')$_data['duijie']='-1'; //unset($_data['duijie']);
if ($_data['duijiesid']=='')$_data['duijiesid']=''; unset($_data['duijiesid']);
if ($_data['duijiekey1']=='')$_data['duijiekey1']='NULL';
if ($_data['duijiekey2']=='')$_data['duijiekey2']='NULL';
if ($_data['duijiekey3']=='')$_data['duijiekey3']='NULL';
if ($_data['duijiekey4']=='')$_data['duijiekey4']='NULL';
if ($_data['duijiesqlx']=='')$_data['duijiesqlx']='NULL';
if ($_data['duijiecgzt']=='')$_data['duijiecgzt']='NULL';  
unset($_data['duijiecgzt']);
    $str = arrtoinsert($_data);
    $sql = 'insert into ' . flag . 'shop (' . $str[0] . ') values (' . $str[1] . ')';
    if (mysql_query($sql)) {
        alert_href('商品添加成功!', 'shop.php');
		
    } else {
		//die($sql);
        alert_back('添加失败!');
    }
}

	 
	 
	
	
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script> 
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


	 Ajax.post("zhushopp.php?act=add&url="+input.value,"xiaoyewl=true"+input.value, function(msg,obj,setting){ document.getElementById("ajaxResult_fy").innerHTML=msg;} );}
     
     
     
     
 


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
	Ajax.post("copyduijiec.php?id="+selectedOption.value,"id1="+selectedOption.value,
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
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
 					
    <form class="form-horizontal" method="post" id="form">
         <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        增加商品
                    </div>
                     <div class="panel-body">
                                    <div class="form-group">
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">加价模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  name="s_pid">
                                                <option    value="">请选择加价模板</option>
                                            <?php
					 
						$result = mysql_query('select * from '.flag.'price where zid = '.$zhu_id.'  and fid = 0 order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['p_name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
     </div>

               <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">下单模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  name="s_xid">
                                                <option    value="">请选择下单模板</option>
<option   <? if ($_GET['xid']=="0") {echo "selected";}?>  value="0">自动发货(卡密)</option>                                            <?php
					 
						$result = mysql_query('select * from '.flag.'moban  order by ID asc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
             
                                        <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品分类</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  name="s_cid">
                                            <?php
					 
						$result = mysql_query('select * from  '.flag.'shop_channel where zt = 1  and zid = '.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
                                

     <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">重复下单</label>
                                        <div class="col-lg-8">
                                            <select  name="iscfxd" class="form-control" id="iscfxd" v-model="apiType">
                                                <option   value="1">允许</option>

                                                <option    value="0">禁止</option>


                                             </select>
                                        </div>
                                </div>
                                
                                     <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许补单</label>
                                        <div class="col-lg-8">
                                            <select  name="s_bd" class="form-control" id="s_zt" v-model="apiType">
                                                <option   value="1">启用</option>

                                                <option    value="0">禁用</option>


                                             </select>
                                        </div>
                                </div>
                                
                                    <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许退款</label>
                                        <div class="col-lg-8">
                                            <select  name="s_tk" class="form-control" id="s_zt" v-model="apiType">
                                                <option   value="1">启用</option>

                                                <option    value="0">禁用</option>


                                             </select>
                                        </div>
                                </div> 

                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">最低购买</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_dnum" placeholder="请输入最低购买数量" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  
                                  
                                  
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">最高购买</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_gnum" placeholder="请输入最高购买数量" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品状态</label>
                                        <div class="col-lg-8">
                                            <select  name="s_zt" class="form-control" id="s_zt" v-model="apiType">
                                                <option   value="1">启用</option>

                                                <option    value="0">禁用</option>


                                             </select>
                                        </div>
                                </div>
               
                
                                
                             
                               
                        </div>    </div> 
                        
                           </div>  
                        
                        
                                          
                </div>

            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        商品信息
                    </div>
                     <div class="panel-body">
                               
                               
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">图片地址</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input name="s_pic"   id="s_pic" type="text"
                                                   class="form-control"
                                                   placeholder="输入图片地址">
                                            <div class="input-group-btn">
                                                <button type="button"  id="upload-image"
                                                        class="btn btn-success no-shadow upload_btn">上传
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
      
               
                            
                                
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">商品名称</label>
                                    <div class="col-lg-8">
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder="请输入商品名称" value="">

                                  </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品单位</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_unit" placeholder="请输入商品单位" value="" class="form-control">

                                    </div>
                                </div>
                                
                                
                                        <div class="form-group">
                                  <label class="col-lg-3 control-label">商品价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_price" placeholder="请输入商品价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(1)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice1" placeholder="请输入<?=get_fenzhan_banben_name(1)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(2)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice2" placeholder="请输入<?=get_fenzhan_banben_name(2)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(3)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice3" placeholder="请输入<?=get_fenzhan_banben_name(3)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品排序</label>
                                    <div class="col-lg-8">
                             <input name="s_order" type="text" class="form-control" id="s_order" placeholder="请输入分类排序" value="0">

                                    </div>
                                </div>
                          
                                 
                                 
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">商品描述</label>
                                    <div class="col-lg-8">
                                 <textarea name="s_content" class="form-control" rows="3"
                                           placeholder="输入商品描述"></textarea>
                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning"
                                                                                             onclick="$('#form textarea[name=\'s_content\']').val($('#form textarea[name=\'s_content\']').val()+'<a href=\'链接网址\' target=\'_blank\'>链接名称</a>');">添加链接</a>
                                        </div>
                                    </div>
                                     </div></div>
            </div></div></div></div>

                              
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
 											<option    selected="selected"     value="自营"  >自营</option>
            <?php
					 
						$result1 = mysql_query('select * from '.flag.'duijie where zid = '.$zhu_id.' and 2=5    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                   <option       value="<?=$row1['ID']?>"  ><?=$row1['name']?></option>
                                                   <? }?>                                  
                                                                  
                                                                  
                                                                                     </select>
                                    </div>
                                </div>
                            <font id="duijie_info">
                                 </font>
<? if ($_GET['pingtai']!='') {?>
                                 
                                 
                                 
                                     <? if ($pingtai==4) { ?>
            
                                 <!-- 亿乐3.0--> 
                              
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                                                      
   <select    id="sid"  class="form-control"  onchange="ylshopcanshu()"   name="sid" >
       <option    data-id=""   ><?=$message?> </option>

<?php
 					   foreach($list as $key=>$val){
   							?>
                  <option  <? if($row['duijiesid']== $val['id'] ) {echo "selected";}?>  data-id = "<?=$val['gid']?>"   value="<?=$val['id']?>"> <?=$val['name']?>  ID : [<?=$val['id']?>]</option>
   
				 <? }?>
                           </select>       
                                             

                                          </div>
                                    </div>
                                    
                                    
                                    
                                     
                                    <? }?>
                                    
                                  
                                  
                                  
                                    <? if ($pingtai==1) { ?>
                                         <div class="form-group" >
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <select class="form-control"  name="sid"  style="width:278px" >
    <?php
 						$result1 = mysql_query('select * from '.flag.'shop where zid = '.$zhuzhanid.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>                         
                              <option  <? if($row['duijiesid']== $row1['ID'] ) {echo "selected";}?>  value="<?=$row1['ID']?>"><?=$row1['name']?> </option>
  
				 <? }?>
                 
                  </select>
		 
                                           
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <? }?>
                                  <? if ($pingtai==2) { ?>
                                 <!-- 亿乐--> 
                                <div  >
                                     <div class="form-group" v-if="apiKind==='kyx'|| apiKind==='ksw' || apiKind==='klg'">
                                     </div>
                                    <div class="form-group" v-else>
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                                <select    id="sid"  class="form-control"  onchange="aa()"   name="sid" >
<?php
 						 for ($i = 0; $i < sizeof($sid); $i++) {  
						  if ($api_status[$i] ==1)
   							?>
                  <option  <? if($row['duijiesid']== $sid[$i] ) {echo "selected";}?>   data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"> <?=$sname[$i]?></option>
   
				 <? }?>
                           </select>                                       
                                         </div>
                                    </div>
                                    <? }?>
                                  
                                  
                                  <? if ($pingtai==3) { ?>
<!-- 玖伍-->
                                          <div class="form-group" >
                                        <label class="col-lg-3 control-label">对接商品</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <select    id="sid"  class="form-control"  onchange="aa()"   name="sid" >
                                               
			 	<?php
						
						 for ($i = 0; $i < sizeof($sid); $i++) {  
						  if ($api_status[$i] ==1)
 { $zt = '<font  class="status4">完成</FONT>';}
						 
 							?>
                         
                              <option   <? if($row['duijiesid']== $sid[$i] ) {echo "selected";}?>   data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"> <?=$sname[$i]?> ID:<?=$sid[$i]?> 类型=<?=$goods_type[$i]?> </option>
                            
 
				 <? }?>
                 
                  </select>
		 
                                           
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group"  >
                                        <label class="col-lg-3 control-label">社区类型</label>
                                        <div class="col-lg-8">
                           <input name="sqlx"   id="sqlx"  value="<?=$row['duijiesqlx']?>"  placeholder="请输入社区类型" class="form-control"  type="text">
                                         </div>
                                    </div>
                                    
                                      <div class="form-group"  >
                                        <label class="col-lg-3 control-label">支付方式</label>
                                        <div class="col-lg-8">
                                            <select  name="fs" class="form-control" >
                                                <option  <? if ($row['duijiefs']==1) {echo "selected";}?> value="1">现金</option>
                                                <option  <? if ($row['duijiefs']==0) {echo "selected";}?>  value="0">卡密</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <? }?>
                                 
                      
  <div class="form-group"  >
                                        <label class="col-lg-3 control-label">对接成功改变状态</label>
                                        <div class="col-lg-8">
                                            <select  name="duijiecgzt" class="form-control" >
                                                <option  <? if ($row['duijiecgzt']==0) {echo "selected";}?> value="0">不改变</option>
                                                <option  <? if ($row['duijiecgzt']==1) {echo "selected";}?>  value="1">进行中</option>
                                                 <option  <? if ($row['duijiecgzt']==6) {echo "selected";}?>  value="6">已完成</option>
                                            </select>
                                        </div>
                                    </div>
                           
                 <? }?> 

                                   
                                 </div>
                         
                        
                             
      
      
                                  </div>
                            
                                                  
                    </div>
 
                             
                    
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="添加商品">



</div>
                
        </div>
    </form>
 
</div>
            </div>
              </div>
                      </div>            </div>
</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
