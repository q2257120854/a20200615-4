<?php
$title='快速定价';
include '../system/inc.php';
include './admin_config.php';
include './check.php';
$nav = 'kuaisudingjia_all';
check_qx($site_qx, '商品管理');?>
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
    <link rel="stylesheet" href="../assets/layer/theme/default/layer.css" id="layuicss-layer">
<? include( 'header.php'); ?>


    <div class="wrapper preload">
        
        <div class="an-content-body" style="padding: 8px" id="pjax-container">
            <div id="vue">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading bg-gradient-vine">商品快速定价</div>
                            <div class="panel-body">
                                <form method="post" id="shop" name="shop">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">价格设置</label>
                                        <div class="col-lg-8">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td colspan="5">
                                                        <select name="pid" class="form-control" id="pid" style="width:100%">
                                                            <option value="">选择加价模板</option><option value="-1">原加价模板</option>
                                                            <?php
					 
						$result2 = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = 0 order by ID desc ,ID desc');
						while($row2 = mysql_fetch_array($result2)){
						?>
						
                                                <option  <? if($row['pid']==$row2['ID']) {echo "selected";}?>  value="<?=$row2['ID']?>"><?=$row2['p_name']?></option>
                                                <? }?>
                                                        </select>
														<select name="jj" class="form-control" id="jj" style="width:100%">
                                                          <option    value="">请选择分站加价方式</option>
                                                <option   <? if($row['jj']==0) {echo "selected";}?> value="0">固定金额（写什么分站成本是什么）</option>
												<option  <? if($row['jj']==1) {echo "selected";}?>  value="1">倍数（主站成本*倍数）</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="25%">
                                                        <input name="fprice1" id="fprice1" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(1)?>价格" value="">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="fprice2" id="fprice2" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(2)?>价格" value="">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="fprice3" id="fprice3" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(3)?>价格" value="">
                                                    </td>
                                                    <td width="16%">
                                                        <a class="btn btn-info pull-right" @click="save('')"> <i class="iconfont"></i> 确定</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="smart-widget-footer text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php   include( 'footer.php'); ?>

    <script language="javascript">
        new Vue({
            el: '#vue',
            data: {},
            methods: {
                save: function(id) {
                    var vm = this;
                    this.$post("ajax.php?act=upshopprice2", $("#shop").serialize()).then(function(data) {
                        if (data.code === 0) {
                            vm.$message(data.message, 'success');
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
                }
            },
            mounted: function() {}
        });
    </script>
    <!-- /wrapper -->

</body>

</html>