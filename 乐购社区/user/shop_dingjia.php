<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shop';

 	$result1 = mysql_query('select * from '.flag.'fshop where sid = '.$_GET['id'].' and zid = '.$zhu_id.' and fid = '.$fen_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
			$pid =$row1['pid'];			
					}
					
					
					

if(isset($_POST['提交'])){
 

	 null_back($_POST['s_pid'],'请选择加价模板');
 
 
 	$_data['zid'] = $zhu_id;
 	$_data['fid'] = $fen_id;
 	$_data['cid'] = $_POST['cid'];
 	$_data['sid'] = $_GET['id'];
 	$_data['pid'] = $_POST['s_pid'];
   	$str = arrtoinsert($_data);
	
	if ($pid=='')
	{  	$sql = 'insert into '.flag.'fshop ('.$str[0].') values ('.$str[1].')'; }
	else
	{  $sql = 'update '.flag.'fshop set '.arrtoupdate($_data).' where sid = '.$_GET['id'].' and zid = '.$zhu_id.' and fid = '.$fen_id.''; }
	if(mysql_query($sql)){
		alert_href('商品定价成功!','shop.php');
	}else{
		//die($sql);
		alert_back('定价失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>商品定价</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
      
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../ui/ui.js"></script>
<script type="text/javascript" src="../js/admin.js"></script>


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
					
				 
						$result1 = mysql_query('select * from '.flag.'shop where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
					?>
      
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">Step① 商品设置</div>
                    <div class="smart-widget-inner">
                        
                            
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
 <form method="post" id="form">
      <input name="cid" type="hidden" value="<?=$row1['cid']?>">
                          
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">加价模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  name="s_pid">
                                                <option    value="">请选择加价模板</option>
												<option <? if(get_price(get_fshop($_GET['id'],'pid',$fen_id),$fen_id,$zhu_id)=='系统默认加价') {echo "selected";}?> value="<?=get_fshop($_GET['id'],'pid',$fen_id)?>">系统默认加价</option>
                                            <?php
					 
			 
						$result = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = '.$fen_id.' order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option  <? if($pid==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['p_name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
             
               <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">下单模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"   disabled  name="s_xid">
                                                <option    value="">请选择下单模板</option>
                                            <?php
					 
						$result = mysql_query('select * from  '.flag.'moban  order by ID asc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option     <? if($row1['xid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
             
             
                                        <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品分类</label>
                                        <div class="col-lg-8">
                                            <select disabled  class="form-control" v-model="apiType"  name="s_cid">
                                            <?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1 and zid = '.$zhu_id.'  order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option   <? if($row1['cid']==$row['ID']) {echo "selected";}?> value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
                                
     <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许补单</label>
                                        <div class="col-lg-8">
                                            <select  disabled name="s_bd" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['bd']==1) {echo "selected";}?> value="1">启用</option>

                                                <option  <? if($row1['bd']==0) {echo "selected";}?>  value="0">禁用</option>


                                             </select>
                                        </div>
                                </div>
                                
                                    <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许退款</label>
                                        <div class="col-lg-8">
                                            <select   disabled name="s_tk" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['tk']==1) {echo "selected";}?> value="1">启用</option>

                                                <option  <? if($row1['tk']==0) {echo "selected";}?>  value="0">禁用</option>


                                             </select>
                                        </div>
                                </div> 

                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">最低购买</label>
                                    <div class="col-lg-8">
                             <input type="text"  readonly name="s_dnum" placeholder="请输入最低购买数量" value="<?=$row1['minnum']?>" class="form-control">

                                    </div>
                                </div>
                                
                                  
                                  
                                  
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">最高购买</label>
                                    <div class="col-lg-8">
                             <input  readonly type="text" name="s_gnum" placeholder="请输入最高购买数量" value="<?=$row1['maxnum']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品状态</label>
                                        <div class="col-lg-8">
                                            <select  disabled  name="s_zt" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['zt']==1) {echo "selected";}?> value="1">启用</option>

                                                <option   <? if($row1['zt']==0) {echo "selected";}?> value="0">禁用</option>


                                             </select>
                                        </div>
                                </div>


                       
                                
                             
                               
                        </div>    </div> 
                        
                           </div>  
                        
                 </div>
            </div>
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                    <div class="panel-heading bg-gradient-vine">
                        Step② 商品信息
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
                        
                            
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                               
                               
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">图片地址</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input  readonly name="s_pic"   value="<?=$row1['pic']?>"  id="s_pic" type="text"
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
                             <input  readonly name="s_name" type="text" class="form-control" id="s_name" placeholder="请输入商品名称"  value="<?=$row1['name']?>" >

                                  </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品单位</label>
                                    <div class="col-lg-8">
                             <input  readonly type="text" name="s_unit" placeholder="请输入商品单位"  value="<?=$row1['unit']?>"  class="form-control">

                                    </div>
                                </div>
                                
                                
                                        <div class="form-group">
                                  <label class="col-lg-3 control-label">拿货价格</label>
                                    <div class="col-lg-8">
                             <input   readonly type="text" name="s_price" placeholder="请输入商品价格"  value="<? if($row1['jj']==0) {//固定金额
if ($dqbanben == 1) {
    echo $row1['fprice1'];
}
if ($dqbanben == 2) {
    echo $row1['fprice2'];
}
if ($dqbanben == 3) {
    echo $row1['fprice3'];
}
}elseif($row1['jj']==1) {//倍数
if ($dqbanben == 1) {
    $jg = $row1['price']*$row1['fprice1'];
}
if ($dqbanben == 2) {
    $jg = $row1['price']*$row1['fprice2'];
}
if ($dqbanben == 3) {
    $jg = $row1['price']*$row1['fprice3'];
}
echo get_xiaoshu($jg, 6);
}?>"  class="form-control">

                                    </div>
                                </div>
                                
                                
                                 
                                
                                
                                  
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品排序</label>
                                    <div class="col-lg-8">
                             <input  readonly name="s_order" type="text" class="form-control" id="s_order" placeholder="请输入分类排序"  value="<?=$row1['sorder']?>"  >

                                    </div>
                                </div>
                          
                                 
                                 
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">商品描述</label>
                                    <div class="col-lg-8">
                                 <textarea  readonly name="s_content" class="form-control" rows="3"
                                           placeholder="输入商品描述"><?=$row1['content']?></textarea>
                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning"
                                                                                             onclick="$('#form textarea[name=\'s_content\']').val($('#form textarea[name=\'s_content\']').val()+'<a href=\'链接网址\'>链接名称</a>');">添加链接</a>
                                        </div>
                                    </div>
                                     </div>
                                     </div>
                                     </div>
                                     </div>
                                     </div>
                                              </div>
                              
                            
 
                             
                    
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="定价">



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
