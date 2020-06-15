<?php 
$title='商品管理';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shop';

 check_qx($site_qx,'商品管理');

if(isset($_POST['提交'])){
	 null_back($_POST['s_name'],'请输入商品名称');
	 null_back($_POST['s_price'],'请输入商品价格');
	 null_back($_POST['s_unit'],'请输入商品单位');

	 null_back($_POST['s_pid'],'请选择加价模板');
	 null_back($_POST['s_xid'],'请选择下单模板');

	 null_back($_POST['jj'], '请选择分站加价方式');
   	 non_numeric_back($_POST['s_dnum'],'请输入最低购买数量');
   	 non_numeric_back($_POST['s_gnum'],'请输入最高购买数量');
   	 non_numeric_back($_POST['s_order'],'排序必须是数字');
   	 non_numeric_back($_POST['s_fprice1'],'请输入'.get_fenzhan_banben_name(1).'的价格');
   	 non_numeric_back($_POST['s_fprice2'],'请输入'.get_fenzhan_banben_name(2).'的价格');
   	 non_numeric_back($_POST['s_fprice3'],'请输入'.get_fenzhan_banben_name(3).'的价格');
	 
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
 	$_data['iscfxd'] = $_POST['iscfxd'];
 	$_data['zt'] = $_POST['s_zt'];
	$_data['jj'] = $_POST['jj'];
   // $_data['date'] = $sj;
   // $_data['zid'] = $zhu_id;
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('商品修改成功!','shop.php');
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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
 
 					<?php
					$result1 = mysql_query('select * from '.flag.'shop where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row1 = mysql_fetch_array($result1)){
					?>
      <form class="form-horizontal" method="post" id="form">
         <div class="row">
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                      商品设置
                    </div>
                     <div class="panel-body">
                            
 
 <div class="panel-body">
                          
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">加价模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="s_pid">
                                                <option    value="">请选择加价模板</option>
                                            <?php
					 
						$result = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = 0 order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option  <? if($row1['pid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['p_name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
			 <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站加价方式</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="jj">
                                                <option    value="">请选择分站加价方式</option>
                                                <option   <? if($row1['jj']==0) {echo "selected";}?> value="0">固定金额（写什么分站成本是什么）</option>
												<option  <? if($row1['jj']==1) {echo "selected";}?>  value="1">倍数（主站成本*倍数）</option>
                                             </select>
                                        </div>
     </div>
             
               <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">下单模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="s_xid">
                                                <option    value="">请选择下单模板</option>
												<option <?php if ($row1[ 'xid']=="0" ) {echo "selected";}?> value="0">自动发货(卡密)</option>
                                            <?php
					 
						$result = mysql_query('select * from  '.flag.'moban  order by ID asc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option  <? if($row1['xid']==$row['ID']) {echo "selected";}?>  value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
             
             
                                        <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品分类</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="s_cid">
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
                                      <label class="col-lg-3 control-label">重复下单</label>
                                        <div class="col-lg-8">
                                            <select  name="iscfxd" class="form-control" id="iscfxd" v-model="apiType">
                                                <option  <? if($row1['iscfxd']==1) {echo "selected";}?> value="1">允许</option>

                                                <option  <? if($row1['iscfxd']==0) {echo "selected";}?>  value="0">禁止</option>


                                             </select>
                                        </div>
                                </div>
                                
                                   <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许补单</label>
                                        <div class="col-lg-8">
                                            <select  name="s_bd" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['bd']==1) {echo "selected";}?> value="1">启用</option>

                                                <option  <? if($row1['bd']==0) {echo "selected";}?>  value="0">禁用</option>


                                             </select>
                                        </div>
                                </div>
                                
                                    <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">允许退款</label>
                                        <div class="col-lg-8">
                                            <select  name="s_tk" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['tk']==1) {echo "selected";}?> value="1">启用</option>

                                                <option  <? if($row1['tk']==0) {echo "selected";}?>  value="0">禁用</option>


                                             </select>
                                        </div>
                                </div> 

                                
                                   <div class="form-group">
                                  <label class="col-lg-3 control-label">最低购买</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_dnum" placeholder="请输入最低购买数量" value="<?=$row1['minnum']?>" class="form-control">

                                    </div>
                                </div>
                                
                                  
                                  
                                  
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">最高购买</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_gnum" placeholder="请输入最高购买数量" value="<?=$row1['maxnum']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品状态</label>
                                        <div class="col-lg-8">
                                            <select  name="s_zt" class="form-control" id="s_zt" v-model="apiType">
                                                <option  <? if($row1['zt']==1) {echo "selected";}?> value="1">启用</option>

                                                <option   <? if($row1['zt']==0) {echo "selected";}?> value="0">禁用</option>


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
                                            <input name="s_pic"   value="<?=$row1['pic']?>"  id="s_pic" type="text"
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
                             <input name="s_name" type="text" class="form-control" id="s_name" placeholder="请输入商品名称"  value="<?=$row1['name']?>" >

                                  </div>
                                </div>
                                
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品单位</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_unit" placeholder="请输入商品单位"  value="<?=$row1['unit']?>"  class="form-control">

                                    </div>
                                </div>
                                
                                
                                        <div class="form-group">
                                  <label class="col-lg-3 control-label">商品价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_price" placeholder="请输入商品价格"  value="<?=$row1['price']?>"  class="form-control">

                                    </div>
                                </div>
                                
                                
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(1)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice1" placeholder="请输入<?=get_fenzhan_banben_name(1)?>的拿货价格" value="<?=$row1['fprice1']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(2)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice2" placeholder="请输入<?=get_fenzhan_banben_name(2)?>的拿货价格" value="<?=$row1['fprice2']?>" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(3)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice3" placeholder="请输入<?=get_fenzhan_banben_name(3)?>的拿货价格" value="<?=$row1['fprice3']?>" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  
                                   <div class="form-horizontal">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品排序</label>
                                    <div class="col-lg-8">
                             <input name="s_order" type="text" class="form-control" id="s_order" placeholder="请输入分类排序"  value="<?=$row1['sorder']?>"  >

                                    </div>
                                </div>
                          
                                 
                                 
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">商品描述</label>
                                    <div class="col-lg-8">
                                 <textarea name="s_content" class="form-control" rows="3"
                                           placeholder="输入商品描述"><?=$row1['content']?></textarea>
                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning"
                                                                                             onclick="$('#form textarea[name=\'s_content\']').val($('#form textarea[name=\'s_content\']').val()+'<a href=\'链接网址\'>链接名称</a>');">添加链接</a>
                                        </div>
                                    </div>
                                     </div>
                              
                            
 
                             
                    
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                    
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="保存信息">



</div>
                </div>
            </div>
        </div>
    </form>
 
 
 <? }?>
</div>
</div></div></div></div></div></div>
        </div>
    </div><!-- /main-container -->


</div><!-- /wrapper -->


 
  <? include_once('footer.php');
?></body>
</html>
