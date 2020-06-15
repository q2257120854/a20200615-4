<?php  
$title='克隆整站';
include '../system/inc.php';
include './admin_config.php';
include './check.php';
$nav='copy';
//check_qx($site_qx, '商品管理');
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
    <link rel="stylesheet" href="../assets/layer/theme/default/layer.css" id="layuicss-layer">
<?php  include( 'header.php'); ?>
        <div class="an-content-body" style="padding: 8px" id="pjax-container">
            <div id="vue-page">
                <div class="col-lg-14">
                    <div class="alert alert-danger" style="color: #999">使用此功能可一键克隆目标平台的商品数据（除社区账号密码外），方便站长快速丰富网站内容。
                        <br>启用对接后会自动将你这边的商品对接过去对方那里,首先需要在<a href="duijie.php">对接配置</a>里添加对方那边的账户信息
                        <br>克隆后将会清空本站及分站所有商品和分类数据，请谨慎操作！</div>
                </div>
            </div>
            <div id="vue">
                <div class="row">
                    <form class="form-horizontal" id="form-config">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">克隆平台</div>
                                <div class="panel-body">
                                    <input type="hidden" name="action" value="webConfig">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">主站列表</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" onchange="getdomain()" name="zhuzhan" id="zhuzhan">
                                                <option data-key="" data-url="" value="">请选择主站</option>
                                             <?php                                                                                  
 						$result = mysql_query('select * from '.flag.'zhuzhan   order by ID asc  ');
						while($row = mysql_fetch_array($result)){
							
								$result1 = mysql_query('select * from '.flag.'zhuzhan_domain where zid = '.$row['ID'].'    order by ID asc     ');
						while($row1 = mysql_fetch_array($result1)){
						?>
                                                <option    data-key="<?=$row['kelongkey']?>"  data-url="<?=$row1['name']?>"  value="0"><?=$row1['name']?></option>
                <?php  } }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">克隆域名</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <input class="form-control" onchange="getdomain1()" name="url" id="url" placeholder="请输入要克隆的平台域名如∶www.05sq.cn">
                                                <div class="input-group-btn">
                                                    <button type="button" id="check_domain" class="btn btn-success no-shadow upload_btn">检测</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">克隆密钥</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" name="code" id="code" placeholder="请输入要克隆的站点密钥">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">更多设置</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">定价模板</label>
                                        <div class="col-lg-8">
                                            <select name="pid" class="form-control" id="pid" style="width:100%">
                                                            <option value="">请选择定价模板</option>
                                                            <?php  
					 
						$result2 = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = 0 order by ID desc ,ID desc');
						while($row2 = mysql_fetch_array($result2)){
						?>
						
                                                <option  <?php  if($row['pid']==$row2['ID']) {echo "selected";}?>  value="<?=$row2['ID']?>"><?=$row2['p_name']?></option>
                                                <?php  }?>
                                                        </select>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-lg-3 control-label">分站加价方式</label>
                                        <div class="col-lg-8">
                                            <select name="jj" class="form-control" id="jj" style="width:100%">
                                                <option   <?php  if($row1['jj']==0) {echo "selected";}?> value="0">固定金额（写什么分站成本是什么）</option>
												<option  <?php  if($row1['jj']==1) {echo "selected";}?>  value="1">倍数（主站成本*倍数）</option>
                                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">价格叠加</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" name="price" id="price" placeholder="请输入商品叠加价格可为空">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">商品对接</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" onchange="getduijie()" id="duijiezt" name="duijiezt">
                                                <option data-zt='0' value="0">关闭</option>
                                                <option data-zt='1' value="1">启用</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="duijie">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">对接账户</label>
                                            <div class="col-lg-8">
                                                <select name="duijie" id="duijie" class="form-control">
                                                    <option value="">请选择对接账户</option>
            <?php  
					 
						$result1 = mysql_query('select * from '.flag.'duijie where zid = '.$zhu_id.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                  <option       <?php  if ($_GET['pingtai']==$row1['ID']){echo "selected";}?> value="<?=$row1['ID']?>"  ><?=$row1['name']?></option>
                                                   <?php  }?>   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">对接成功改变状态</label>
                                            <div class="col-lg-8">
                                                <select name="duijiecgzt" class="form-control">
                                                    <option value="0">不改变</option>
                                                    <option value="1">进行中</option>
                                                    <option value="4">异常中</option>
                                                    <option value="8">待补单</option>
                                                    <option value="5">补单中</option>
                                                    <option value="6">已完成</option>
                                                    <option value="9">退款中</option>
                                                    <option value="7">已退款</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </form>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-info pull-right" @click="save('config','copy')"> <i class="iconfont"></i> 确定</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php   include( 'footer.php'); ?>

        <script>
      $(document).ready(function () {
        $("#profile_btn").click(function () {
          var vm = new Vue();
          vm.$post("ajax.php?act=uppassword", $("#form-profile").serialize())
            .then(function (data) {
              if (data.code === 0) {
                $("#modal-profile").modal('hide');
                vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
            });
        });
      });
	  
	   $(document).ready(function () {
        $("#profile_btn1").click(function () {
          var vm = new Vue();
          vm.$post("ajax.php?act=uppassword1", $("#form-profile").serialize())
            .then(function (data) {
              if (data.code === 0) {
                $("#modal-profile").modal('hide');
                vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
            });
        });
      });
    </script>
        <script>
      new Vue({
        el: '#vue',
        data: {},
        methods: {
          save: function (id,act) {
			  
			  if(confirm("您确定要克隆对方站点吗？")){
            var vm = this;
            this.$post("ajax.php?act="+act+"", $("#form-" + id).serialize())
              .then(function (data) {
                if (data.code === 0) {
                  vm.$message(data.message, 'success');
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          }}
        },
        mounted: function () {
        }
      });
	  
	    $(document).ready(function () {
        $("#check_domain").click(function () {
          var vm = new Vue();
          vm.$post("ajax.php?act=check", $("#form-config").serialize())
            .then(function (data) {
              if (data.code === 0) {
             //document.getElementById("modal-update").style.display = "none";				
                vm.$message(data.message, 'success');
               //  $.pjax.reload('#pjax-container');
		     // window.location.href = 'http://zhuzhan.xiaoyewl.net/newadmin/kefu.php?';
		
              } else {
                vm.$message(data.message, 'error');
              }
            });
        });
      });

    </script>
	   <script type="text/javascript">
   	window.onload =function() {document.getElementById('duijie').style.display='none';}
 function getduijie(){
   if(document.getElementById('duijiezt').value=='0')
{document.getElementById('duijie').style.display='none';}
else
{document.getElementById('duijie').style.display='block';}
      }


   function getdomain(){
    var url = $("#zhuzhan").find("option:selected").attr("data-url");
    var key = $("#zhuzhan").find("option:selected").attr("data-key");
      document.getElementById('code').value=key;
      document.getElementById('url').value=url;
      document.getElementById('durl').value=url;
        }
	   
	   
	   function getdomain1(){
        document.getElementById('durl').value=document.getElementById('url').value;
        }
</script>
    <!-- /wrapper -->
</body>

</html>