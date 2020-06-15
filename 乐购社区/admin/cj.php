 <?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'cj';

 
 
 
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>抽奖</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="assets/style/font-awesome_4.6.3/css/font-awesome.min.css?" rel="stylesheet">

    <!-- ionicons -->
    <link href="assets/style/css/ionicons.min.css?" rel="stylesheet">

    <!-- Morris -->
    <link href="assets/style/css/morris.css?" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="assets/style/css/datepicker.css?" rel="stylesheet"/>

    <!-- Animate -->
    <link href="assets/style/css/animate.min.css?" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="assets/style/css/owl.carousel.min.css?" rel="stylesheet">
    <link href="assets/style/css/owl.theme.default.min.css?" rel="stylesheet">

    <!-- Simplify -->
    <link href="assets/style/css/simplify.min.css?" rel="stylesheet">
    <link href="assets/common/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css?"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/common/toastr/toastr.min.css?">
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>
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
                                 <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        抽奖配置
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-config">
                            <input type="hidden" name="action" value="config">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">抽奖功能</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control"
                                            :value="1">
                                        <option value="0">关闭</option>
                                        <option value="1">开启</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">抽奖价格</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price"
                                           value="9.990000"
                                           class="form-control"
                                           placeholder="输入抽奖价格(元/次)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">旗舰版站长提成</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sjtc"
                                           value="0.500000"
                                           class="form-control"
                                           placeholder="输入旗舰版分站用户抽奖站长每次提成价格(元/次)">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-info pull-right" @click="save('config')">
                            <i class="iconfont">&#xe688;</i> 确定
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        转盘奖品设置 - <a data-toggle="modal" data-target="#modal-store" @click="storeInfo={}"
                                    class="btn-xs btn-danger">添加</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>奖品名称</th>
                                    <th>类型</th>
                                    <th>总共</th>
                                    <th>剩余</th>
                                    <th>红包金额</th>
                                    <th>图标</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(row,i) in data.data" :key="i">
                                    <td>{{ row.name }}</td>
                                    <td>
                                        <span class="text-success" v-if="row.kind===0">谢谢参与</span>
                                        <span class="text-success" v-else-if="row.kind===1">余额红包</span>
                                        <span class="text-danger" v-else>其他奖品</span>
                                    </td>
                                    <td>{{ row.total }}</td>
                                    <td><a class="btn-xs btn-info" data-toggle="modal"
                                           data-target="#modal-rest" @click="storeInfo=row">{{ row.rest }}</a></td>
                                    <td>{{ row.rmb }}</td>
                                    <td>{{ row.image }}</td>
                                    <td>{{ row.created_at }}</td>
                                    <td>
                                        <a class="btn-xs btn-warning" @click="del(row.id)"><i
                                                    class="iconfont">&#xe632;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="100" class="text-center">
                                        <pagination :data="data" v-on:pagination-change-page="getList"
                                                    :limit="3"></pagination>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade primary" id="modal-store">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">奖品添加</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-store">
                            <input type="hidden" name="action" value="store"/>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">奖品名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="输入奖品名称,长度不要超过12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">奖品类型</label>
                                <div class="col-sm-9">
                                    <select name="kind" class="form-control"
                                            onchange="if(this.value == 99){$('#turntable-image').show();$('#turntable-rmb').hide();}else if(this.value == 1){$('#turntable-rmb').show();$('#turntable-image').hide();}else{$('#turntable-image').hide();$('#turntable-rmb').hide();}">
                                        <option value="0">谢谢参与</option>
                                        <option value="1">余额红包</option>
                                        <option value="99">其他奖品</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="turntable-image" style="display: none">
                                <label class="col-sm-3 control-label">奖品图片</label>
                                <div class="col-sm-9">
                                    <div class="an-input-group right">
                                        <input name="image" type="text" class="an-form-control"
                                               placeholder="输入奖品图片地址"
                                               id="turntable-image">
                                        <span class="an-input-group-addon bg-gradient-green"
                                              style="font-size: 12px;color: white"
                                              @click="uploadImage('turntable-image')">上传</span>
                                    </div>
                                    <pre>建议尺寸：48*48</pre>
                                </div>
                            </div>
                            <div class="form-group" id="turntable-rmb" style="display: none">
                                <label class="col-sm-3 control-label">红包金额</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="rmb" placeholder="输入红包金额">
                                </div>
                            </div>
                            <div class="form-group" id="turntable-total">
                                <label class="col-sm-3 control-label">奖品数量</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="total" placeholder="输入奖品份数">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="an-btn an-btn-success" @click="form('store')">确定</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade primary" id="modal-rest">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">奖品数量修改</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-rest">
                            <input type="hidden" name="action" value="rest"/>
                            <input type="hidden" name="id" :value="storeInfo.id"/>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">操作类型</label>
                                <div class="col-sm-9">
                                    <select name="do" class="form-control">
                                        <option value="0">增加</option>
                                        <option value="1">减少</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="turntable-total">
                                <label class="col-sm-3 control-label">奖品数量</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="num" placeholder="输入奖品份数">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="an-btn an-btn-success" @click="form('rest')">确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>