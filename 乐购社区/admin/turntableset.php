<?php $title='抽奖设置' ; include '../system/inc.php'; include './admin_config.php'; include './check.php'; $nav='turntableset' ; //同系统查询主站ID 

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'cjjp where ID = '.$_GET['id'].' and  zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','turntableset.php');
	}else{
		alert_back('删除失败！');
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../editor/themes/default/default.css" />

    <style>
        th {
    text-align: center;
}

td {
    text-align: center;
}
    </style>


<div class="wrapper preload">
    <?php include( 'header.php'); ?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">抽奖配置</div>
                    <div class="panel-body">
                        <form id="form-config" class="form-horizontal">
                            <input type="hidden" name="action" value="config">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">抽奖功能</label>
                                <div class="col-sm-10">
                                    <select name="zt" class="form-control">
                                        <option <?php if($cjzt==0){echo 'selected="selected"';}?> value="0">关闭</option>
                                        <option <?php if($cjzt==1){echo 'selected="selected"';}?> value="1">开启</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">抽奖价格</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" value="<?=$cjprice?>" placeholder="输入抽奖价格(元/次)" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer"><a class="btn btn-info pull-right" @click="save('config')"><i class="iconfont"></i> 确定
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">转盘奖品设置 - <a data-toggle="modal" data-target="#modal-store" class="btn-xs btn-danger">添加</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="82">奖品名称</th>
                                        <th width="91">类型</th>
                                        <th width="95">剩余数量</th>
                                        <th width="82">红包金额</th>
                                        <th width="268">图标</th>
                                        <th width="98">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
						 /*
									$sql = 'select * from '.flag.'cjjl  where zid = '.$zhu_id.' order by corder desc , ID desc';
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								*/
								$sql = 'select * from '.flag.'cjjp  where zid = '.$zhu_id.' order by ID desc';
								$result = mysql_query($sql);
							while($row= mysql_fetch_array($result)){
 							?>
                                    <tr>
                                        <td><?=$row['name']?></td>
                                        <td><span class="text-success"><?php if($row['kind']==0){echo '谢谢参与';}elseif($row['kind']==1){echo '余额红包';}else{echo '其他奖品';}?></span>
                                        </td>
                                        <td><a data-toggle="modal" data-target="#modal-rest" onclick="getupdate(<?=$row['ID']?>,<?=$row['number']?>)" class="btn-xs btn-info"><?=$row['number']?></a></td>
                                        <td><?=$row['rmb']?></td>
                                        <td><?=$row['image']?></td>
                                        <td><a href="javascript:if(confirm(&#39;确实要删除吗?&#39;))location=&#39;?act=del&amp;id=<?=$row['ID']?>&#39;" class="btn-xs btn-warning"><i class="iconfont"></i></a>
                                        </td>
                                    </tr>
									<? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="smart-widget-footer text-center">
                    <nav class="text-center">
                        <ul class="pagination" style="display: -webkit-inline-box;">
                            <li class="active page-item"><a href="javascript:;" class="page-link">1</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div id="modal-store" class="modal fade primary" style="z-index: 9999;">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">奖品添加</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form-store" class="form-horizontal">
                            <input type="hidden" name="action" value="store">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">奖品名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" placeholder="输入奖品名称,长度不要超过12" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">奖品类型</label>
                                <div class="col-sm-9">
                                    <select name="kind" onchange="if(this.value == 99){$(&#39;#turntable-image&#39;).show();$(&#39;#turntable-rmb&#39;).hide();}else if(this.value == 1){$(&#39;#turntable-rmb&#39;).show();$(&#39;#turntable-image&#39;).hide();}else{$(&#39;#turntable-image&#39;).hide();$(&#39;#turntable-rmb&#39;).hide();}"
                                    class="form-control">
                                        <option value="0">谢谢参与</option>
                                        <option value="1">余额红包</option>
                                        <option value="99">其他奖品</option>
                                    </select>
                                </div>
                            </div>
                            <div id="turntable-image" class="form-group" style="display: none;">
                                <label class="col-sm-3 control-label">奖品图片</label>
                                <div class="col-sm-9">
                                    <div class="an-input-group right">
                                        <input name="image" id="image" type="text" placeholder="输入奖品图片地址" class="an-form-control"> <span id="upload-image" class="an-input-group-addon bg-gradient-green" style="font-size: 12px; color: white;">上传</span>
                                    </div> <pre>建议尺寸：48*48</pre>
                                </div>
                            </div>
                            <div id="turntable-rmb" class="form-group" style="display: none;">
                                <label class="col-sm-3 control-label">红包金额</label>
                                <div class="col-sm-9">
                                    <input type="text" name="rmb" placeholder="输入红包金额" class="form-control">
                                </div>
                            </div>
                            <div id="turntable-total" class="form-group">
                                <label class="col-sm-3 control-label">奖品数量</label>
                                <div class="col-sm-9">
                                    <input type="number" name="total" placeholder="输入奖品份数" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="an-btn an-btn-danger">取消</button>
                        <button type="button" class="an-btn an-btn-success" @click="form('store')">确定</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-rest" class="modal fade primary" style="display: none;">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">奖品数量修改</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form-rest" class="form-horizontal">
                            <input type="hidden" name="id" id="id" value="26">
                            <input type="hidden" name="snum" id="snum" value="4444436">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">操作类型</label>
                                <div class="col-sm-9">
                                    <select name="do" class="form-control">
                                        <option value="0">增加</option>
                                        <option value="1">减少</option>
                                    </select>
                                </div>
                            </div>
                            <div id="turntable-total" class="form-group">
                                <label class="col-sm-3 control-label">奖品数量</label>
                                <div class="col-sm-9">
                                    <input type="number" name="num" placeholder="输入奖品份数" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="an-btn an-btn-danger">取消</button>
                        <button type="button" class="an-btn an-btn-success" @click="upform('rest')">确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once( 'footer.php'); ?>
 <script language="javascript">
      $(document).ready(function () {
        $("#profile_btn").click(function () {
          var vm = new Vue();
          vm.$post("/profile/", $("#form-profile").serialize())
            .then(function (data) {
              if (data.status === 0) {
                $("#modal-profile").modal('hide');
                vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
            });
        });
      });
	  
      new Vue({
        el: '#vue',
        data: {
          search: {page: 1, name: ''},
          data: {},
          storeInfo: {}
        },
        methods: {
          save: function (id) {
            var vm = this;
            this.$post("ajax.php?act=turntableset", $("#form-" + id).serialize())
              .then(function (data) {
                if (data.status === 0) {
                  vm.$message(data.message, 'success');
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },
           
            
			  form: function (form) {
            var vm = this;
            this.$post("ajax.php?act=turntableadd", $("#form-" + form).serialize())
              .then(function (data) {
                if (data.status === 0) {
                  //vm.getList();
                  $("#modal-" + form).modal('hide');
                  vm.$message(data.message, 'success');
				  location.reload();
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },
		    upform: function (form) {
            var vm = this;
            this.$post("ajax.php?act=turntableupdate", $("#form-" + form).serialize())
              .then(function (data) {
                if (data.status === 0) {
                  //vm.getList();
                  $("#modal-" + form).modal('hide');
                  vm.$message(data.message, 'success');
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },

          del: function (id) {
            var vm = this;
            this.$post("/admin/turntable", {action: 'delete', id: id})
              .then(function (data) {
                if (data.status === 0) {
                  //vm.getList();
                  vm.$message(data.message, 'success');
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },
        },
        mounted: function () {
          this.getList();
        }
      });
	  
	   function getupdate($ID,$snum) 
  {document.getElementById("id").value = $ID; document.getElementById("snum").value = $snum; }


    </script>

        
 
        
</body>

</html>