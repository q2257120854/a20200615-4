 <?php
require_once('../system/inc.php');
?>
 <!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></title>
    <meta name="keywords" content="<?=$site_key?>,时空,时空云,时空云社区,亿乐社区,时空云社区系统,时空云系统,19sky.cn,时空云卡密社区系统(19sky.cn)"/>
    <meta name="description" content="<?=$site_des?>,时空,时空云,时空云社区,亿乐社区,时空云社区系统,时空云系统,19sky.cn,时空云卡密社区系统(19sky.cn)"/>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href=""/>
    <style></style>
    <style>
        body {
            background: #c73295;
        }

        .header {
            position: relative;
            text-align: center;
            background-color: #27ae60;
            color: #fff;
            margin-bottom: 0;
        }

        .search {
            -webkit-box-shadow: none;
            box-shadow: none;
            font-size: 16px;
            padding: 13px 30px;
            border-radius: 0;
            height: auto;
            text-align: center;
            border-color: transparent;
        }

        .search-wraper {
            margin-left: auto;
            margin-right: auto;
            max-width: 680px;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        td, th {
            text-align: center;
        }
    </style>
</head>
<body>
<div id="vue">
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark" style="color: white">
                <a class="navbar-brand" href="/"><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">首页</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-xs-12"><h1>订单查询</h1>
                <div class="search-wraper" role="search">
                    <div class="form-group">
                        <input class="form-control search clearable" placeholder="输入订单内容" v-model="search.value1">
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <select v-model="search.gid" class="form-control" style="width: 180px">
                                <option value="">所有商品</option>
                                <option v-for="(row,i) in goodsList" :key="i" :value="row.gid">
                                    {{ row.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 5px">
                            <select v-model="search.status" class="form-control">
                                <option     value="" >所有</option>
                           <option      value="0">等待中</option>
                              <option      value="1">进行中</option>
                               <option     value="3">已退单</option>

                               <option     value="4">异常中</option>
                               <option     value="8">待补单</option>
                              <option   value="5">补单中</option>
                              <option    value="6">已完成</option>
                              <option     value="9">退款中</option>
                              <option    value="7">已退款</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 5px">
                            <a class="btn btn-primary" @click="searchOrder"><i class="iconfont"></i> 查询</a>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>商品名称</th>
                    <th>下单内容</th>
                    <th>下单数量</th>
                    <th>下单金额</th>
                    <th   style="display:none">初始数量</th>
                    <th style="display:none">当前数量</th>
                    <th>状态</th>
                    <th>备注</th>
                    <th>下单时间</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(row,i) in data" :key="i">
                    <td>{{ row.id }}</td>
                    <td>{{ row.goods?row.goods.name:'' }}</td>
                    <td>{{ row.value1 }}</td>
                    <td>{{ row.num }}</td>
                    <td >{{ row.start_num }}</td>
                    <td style="display:none">{{ row.start_num }}</td>
                    <td  style="display:none" >{{ row.now_num }}</td>
                    <td style="min-width: 65px">
                    
                  
                              
                              
                        <span class="badge badge-info" v-if="row.status==0">待处理</span>
                        <span class="badge badge-info" v-else-if="row.status==1">处理中</span>
                        <span class="badge badge-warning" v-else-if="row.status==2">退单中</span>
                        <span class="badge badge-danger" v-else-if="row.status==4">有异常</span>
                        <span class="badge badge-primary" v-else-if="row.status==5">补单中</span>
                        <span class="badge badge-primary" v-else-if="row.status==8">待补单</span>
                        <span class="badge badge-success" v-else-if="row.status==6">已完成</span>
                        <span class="badge badge-warning" v-else-if="row.status==3">已退单</span>
                        <span class="badge badge-warning" v-else-if="row.status==7">已退款</span>
                        <span class="badge badge-primary" v-else>其他</span>
                    </td>
                    <td>{{ row.remark }}</td>
                    <td>{{ row.created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 <script type="text/javascript" src="http://assets.19sky.cn/assets/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="http://assets.19sky.cn/assets/js/main.js"></script>
<script src="http://assets.19sky.cn/assets/js/layer.js" type="text/javascript"></script>
<script>
  new Vue({
    el: '#vue',
    data: {
      goodsList: [],
      search: {
        gid: '',
        value1: '',
        status: ''
      },
      data: [],
    },
    methods: {
      getGoodsAndClass: function () {
        var vm = this;
        this.$post('ajax.php', {action: 'getGoodsAndClass'})
          .then(function (data) {
            if (data.status == 0) {
              vm.goodsList = data.data.goods;
            } else {
              layer.alert(data.message);
            }
          });
      },
      searchOrder: function () {
        var vm = this;
        if (vm.search.value1.length < 5) {
          layer.alert('请输入正确的下单内容');
          return;
        }
        this.$post('ajax.php', vm.search, {action: 'searchOrder'})
          .then(function (data) {
            if (data.status == 0) {
              vm.data = data.data;
            } else {
              layer.alert(data.message);
            }
          });
      }
    },
    mounted: function () {
      this.getGoodsAndClass();
    }
  });
</script>
</body>
</html>
