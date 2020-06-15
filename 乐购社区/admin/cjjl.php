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
                        转盘奖品设置 - <a data-toggle="modal" data-target="#modal-store" @click="storeInfo={}"
                                    class="btn-xs btn-danger">添加</a>
                    </div>
                    <div class="table-search-header">
                        <div class="form-inline">
                            <input type="text" disabled="disabled" class="hidden">
                            <div class="form-group">
                                <select v-model="search.pid" class="form-control">
                                    <option value="all">所有记录</option>
                                    <option value="-1" selected>所有中奖</option>
                                    <option value="-2">未中奖</option>
                                    <option v-for="(row,i) in prizeList" :key="i" :value="row.id">{{ row.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select v-model="search.status" class="form-control">
                                    <option value="all">所有</option>
                                    <option value="1">已发放</option>
                                    <option value="0">未发放</option>
                                </select>
                            </div>
                            <a class="btn btn-info" @click="getList(1)"><i class="iconfont">&#xe652;</i>搜索</a></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>用户</th>
                                    <th>奖品信息</th>
                                    <th>状态</th>
                                    <th>中奖时间</th>
                                    <th>发放时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(row,i) in data.data" :key="i">
                                    <td v-if="row.user">
                                        <a :href="'/admin/user/list?uid='+row.user.zuid" class="btn-xs btn-info"
                                           data-pjax>
                                            {{ row.user.user }}[编号:{{ row.user.zuid }}]
                                        </a>
                                    </td>
                                    <td v-else></td>
                                    <td>{{ row.prize?row.prize.name:'' }}</td>
                                    <td>
                                        <span class="text-warning" v-if="row.status===0">未发放</span>
                                        <span class="text-success" v-else>已发放</span>
                                    </td>
                                    <td>{{ row.created_at }}</td>
                                    <td>{{ row.status?row.updated_at:'' }}</td>
                                    <td>
                                        <span class="btn-xs btn-warning" @click="changeStatus(row.id,1)"
                                              v-if="row.status===0">已发放</span>
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
    </div>
            </div>
        </div>