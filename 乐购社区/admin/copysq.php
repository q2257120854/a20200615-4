<?php
$title = '克隆社区单商品';
include '../system/inc.php';
include './admin_config.php';
include './check.php';
$nav = 'copysq';
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?
 include('header.php');
?>
 <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
        
                 <div class="an-helper-block">
                    <div class="an-small-doc-blcok  warning">
                        <font color="red">
                            友情提示：目前仅支持[乐购系统][亿乐3.0系统][聚梦系统] 的克隆商品及对接
     
                            
                         </font>
                    </div>
                </div>
                
                
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        跨系统批量对接
                    </div>
                    <div class="table-search-header">
                        <div class="form-inline">
                             <div class="form-group">
                             <form action=""  name="form-shequ"  id="form-shequ" >
                             <input name="action" type="hidden" value="selectGoods">
                                  <select name="jid" class="form-control"    id="jid" >
                                    <option value="">选择一个对接配置</option>
            <?php
					 
						$result1 = mysql_query('select * from '.flag.'duijie where zid = '.$zhu_id.'    order by ID asc ');
						while($row1 = mysql_fetch_array($result1)){
						?>
						
                   <option       <? if ($_GET['pingtai']==$row1['ID']){echo "selected";}?> value="<?=$row1['ID']?>"  ><?=$row1['name']?></option>
                                                   <? }?>  
                                                                     </select>
                                </form>
                            </div>
                           
                            <a class="btn btn-info" @click="getList(1)"><i class="iconfont">&#xe652;</i>获取商品</a>
                            <a href="#" class="btn btn-success" data-toggle="modal"
                               data-target="#modal-import">批量克隆并对接选中</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="an-custom-checkbox" style="margin: 0;line-height: 14px;">
                                            <input type="checkbox" id="checkboxAll" @change="selectAll()">
                                            <label for="checkboxAll">全选</label>
                                        </span>
                                    </th>
                                    <th>商品名称</th>
                                    <th>最低下单数</th>
                                    <th>最高下单数</th>
                                    <th>拿货价格</th>
                                </tr>
                                </thead>

            <tbody>
                <tr v-for="(row,i) in goodsList" :key="i">
                    <td> <span class="an-custom-checkbox" style="margin: 0;line-height: 14px;">
                                            <input type="checkbox" :id="'gid_'+row.id"
                                                   :value="row.id" v-model="gids">
                                            <label :for="'gid_'+row.id"></label>
                                        </span>

                    </td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.minnum }}</td>
                    <td>{{ row.maxnum }}</td>
                    <td>{{ row.price }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
<div class="modal fade primary" id="modal-import">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">批量对接选中</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-import">
                    <input type="hidden" name="action" value="importGoods" />
                    <input type="hidden" name="gids" v-model="gids" />
                    <input type="hidden" name="jids" id="jids" />
                    <div class="form-group">
                        <label class="col-sm-3 control-label">商品分组</label>
                        <div class="col-sm-9">
                            <select name="s_cid" class="form-control">
                                <?php $result=mysql_query( 'select * from  '.flag. 'shop_channel where zt = 1  and zid = '.$zhu_id. ' order by corder desc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                <option value="<?=$row['ID']?>">
                                    <?=$row[ 'name']?>
                                </option>
                                <? }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">加价模板</label>
                        <div class="col-sm-9">
                            <select name="s_pid" class="form-control">
                                <?php $result=mysql_query( 'select * from '.flag. 'price where zid = '.$zhu_id. '  and fid = 0 order by ID desc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                <option value="<?=$row['ID']?>">
                                    <?=$row[ 'p_name']?>
                                </option>
                                <? }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">对接成功后订单状态</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="duijiecgzt">
                                <option value="0">待处理</option>
                                <option value="1">处理中</option>
                                <option value="6">已完成</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">下单模板</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="s_xid">
                                <?php $result=mysql_query( 'select * from '.flag. 'moban  order by ID asc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                <option value="<?=$row['ID']?>">
                                    <?=$row[ 'name']?>
                                </option>
                                <? }?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">叠加拿货价格</label>
                        <div class="col-sm-9">
                            <select name="auto_price" class="form-control" v-model="autoPrice">
                                <option value="0">否</option>
                                <option value="1">是</option>
                            </select>
                        </div>
                    </div>
                    <template v-if="autoPrice>0">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">叠加价格加价方式</label>
                            <div class="col-sm-9">
                                <select name="join_price_type" class="form-control" v-model="joinPriceType">
                                    <option value="0">固定单价</option>
                                    <option value="1">倍数单价</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">获取价格加价值</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="join_price" :placeholder="joinPriceType>0?'输入加价倍数(0-100)':'输入加价价格'"> <pre>实际价格计算公式=主站成本*倍数</pre>
                            </div>
                        </div>
                    </template>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">取消</button>
                <button type="button" class="an-btn an-btn-success" @click="importGoods">确定</button>
            </div>
        </div>
    </div>
</div>
</div>
</div></div>
<? include_once( 'footer.php'); ?>
<script  type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#profile_btn").click(function() {
            var vm = new Vue();
            vm.$post("/profile/", $("#form-profile").serialize()).then(function(data) {
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
    var axiosAjax = axios.create({
        baseURL: '/', // <---- 这里使用 qs 转换参数 
        transformRequest: [
            function(data) { // 转换数据 
                data = Qs.stringify(data); // 通过Qs.stringify转换为表单查询参数
                return data;
            }
        ],
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
</script>
<script  type="text/javascript" language="javascript">
    new Vue({
        el: '#vue',
        data: {
            search: {
                page: 1,
                jid: 0,
                cid: 'all'
            },
            goodsList: [],
            classList: [],
            importClassList: [],
            joinList: [],
            priceList: [],
            gids: [],
            autoPrice: 0,
            joinPriceType: 0
        },
        methods: {
            getAllPrice: function() {
                var vm = this;
                this.$post("/admin/goods/price", {
                    action: 'all'
                }).then(function(data) {
                    if (data.status === 0) {
                        vm.priceList = data.data
                    }
                });
            },
            getAllClass: function() {
                var vm = this;
                this.$post("/admin/goods/class", {
                    action: 'all'
                }).then(function(data) {
                    if (data.status === 0) {
                        vm.classList = data.data
                    }
                });
            },
            selectAll: function () {
                    var vm = this;
                    vm.gids = [];
                    if ($("#checkboxAll").is(':checked')) {
                        vm.goodsList.forEach(function (item) {
                            vm.gids.push(item.gid);
                        })
                    }
                },

            getList: function(page) {
                var vm = this;
                vm.gids = [];
                vm.search.page = typeof page === 'undefined' ? vm.search.page : page;
                this.$post("ajax.php?act=shoplist", $("#form-shequ").serialize())
                //                    this.$post("ajax.php", vm.search, {action: 'selectGoods'})
                .then(function(data) {
                    if (data.status === 0) {　　
                        document.getElementById("jids").value = document.getElementById("jid").value;
                        vm.goodsList = data.goods;
                        vm.importClassList = data.class
                    } else {
                        vm.$message(data.message, 'error');
                    }
                });
            },
            getAllJoin: function() {
                var vm = this;
                this.$post("/admin/goods/join", {
                    action: 'all'
                }).then(function(data) {
                    if (data.status === 0) {
                        vm.joinList = data.data
                    }
                });
            },
            importGoods: function() {
                var vm = this;
                if (vm.gids.length < 1) {
                    vm.$message('请选择商品', 'error');
                } else {
                    this.$post("ajax.php?act=import", $("#form-import").serialize()).then(function(data) {
                        if (data.status == 0) {
                            $("#modal-import").modal('hide');
                            vm.$message(data.message, 'success');
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
                }
            }
        },
        mounted: function() {
            //this.getAllClass();
            //this.getAllPrice();
            //this.getAllJoin();
        }
    });
</script>
<!-- /wrapper -->

</body>

</html>