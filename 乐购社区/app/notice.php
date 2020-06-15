<?php
include_once('../system/inc.php');
include './check.php';
/*
if($_SESSION['url']==$dq_url){
}elseif($_GET['act']=='app' and $_SESSION['url']!=''){
	header('location: http://'.$_SESSION['url'].'/app/notice.php'); 
}elseif($_SESSION['url']!='' or $_SESSION['url']!=$dq_url){
	header('location: http://www.161sq.cn/app/domain_win.php?act=notice'); 
}
*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/css/aui-pull-refresh.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
    <link href="http://assets.yilep.com/ylsq/css/admin/main.css" rel="stylesheet">
    <link href="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="page">
    <header class="aui-bar aui-bar-nav" id="aui-header" style="position: fixed">
        <a class="aui-pull-left aui-btn" style="width: 0">
            <span class="aui-iconfont"></span>
        </a>
        <div class="aui-title">站点公告</div>
    </header>
	<br><br>
<div class="container" id="vue">
    <div class="row flex-xl-nowrap">
        <main class="col-12 bd-content" role="main">
            <div class="row">
                <div class="col-12" style="margin-top: 15px" v-cloak>
                    <div class="alert alert-primary" role="alert" v-for="(row,i) in data.data" :key="i"
                         @click="readNotice(row)">
                        <i class="fa fa-calendar-times-o"></i><font color="red" v-if="row.top">[置顶]</font>
                        <font color="#808080" v-if="readNoticeIds.indexOf(row.id+'')==-1">[未读]</font>
                        <font color="green" v-else>[已读]</font>
                        {{ row.title }}
                        <span class="label label-primary"
                              style="float: right">{{ row.created_at.substring(0,10) }}</span></a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal fade" id="modal-notice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">公告详情</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <b>{{ noticeInfo.title }}</b>
                    <p style="font-size: 8px">[发布于{{ noticeInfo.created_at }}]</p>
                    <hr>
                    <div v-html="noticeInfo.content"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/popper.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
  new Vue({
    el: '#vue',
    data: {
      search: {page: 1},
      data: {},
      readNoticeIds: [],
      noticeInfo: {}
    },
    methods: {
      getList: function (page) {
        var vm = this;
        vm.search.page = typeof page === 'undefined' ? vm.search.page : page;
        this.$post("/ajax.php?act=notice", vm.search, {action: 'notice'})
          .then(function (data) {
            if (data.status === 0) {
              vm.data = data.data
            } else {
              vm.$message(data.message, 'error');
            }
          });
      },
      readNotice: function (notice) {
        this.noticeInfo = notice;
        if (this.readNoticeIds.indexOf(notice.id + '') === -1) {
          this.readNoticeIds.push(notice.id + '');
          $.cookie('readNoticeIds', this.readNoticeIds.join(','), {expires: 15});
        }
        $("#modal-notice").modal('show');
      }
    },
    mounted: function () {
      this.getList();
      if ($.cookie('readNoticeIds')) {
        this.readNoticeIds = $.cookie('readNoticeIds').split(',');
      }
    }
  });
</script>

</html>
