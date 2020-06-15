<?php if($title=='' )$title='乐购社区3.0' ; ?>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" id="mixia_vpid">
    <title>
        <?=$site_name?>-
            <?=$title?>
    </title>
    <link rel="shortcut icon" href="<?=$site_ico?>" />
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css">
        <link href="http://assets.yilep.com/ylsq/assets/v3/css/main.css?v=3.0.8" rel="stylesheet">
</head>

<body>
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>
            <script type="text/javascript">
                KindEditor.ready(function(K) {
                    K.create('#i_content');
                    var editor = K.editor();
                    K('#upload-image').click(function() {
                        editor.loadPlugin('image', function() {
                            editor.plugin.imageDialog({
                                imageUrl: K('#s_pic').val(),
                                clickFn: function(url, title, width, height, border, align) {
                                    K('#s_pic').val(url);
                                    editor.hideDialog();
                                }
                            });
                        });
                    });
                });
            </script>
    <div class="main-wrapper">
        <div class="an-loader-container">
            <img src="/assets/index/19lou/images/loader.png">
        </div>
        <header class="an-header wow fadeInDown">
            <div class="an-topbar-left-part">
                <h3 class="an-logo-heading">
            <a class="an-logo-link" href="/">乐购社区系统V3.0 </a>
        </h3>
                <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar"> <i class="icon-list"></i>
                </button>
            </div>
            <div class="an-profile-settings">
                <div class="btn-group an-notifications-dropown  profile">
                    <button type="button" class="an-btn an-btn-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="an-profile-img" style="background-image: url('//q4.qlogo.cn/headimg_dl?dst_uin=<?=$a_qq?>&spec=100');"></span>
                        <span class="an-user-name"><?=$a_name?></span>
                    </button>
                </div>
            </div>
    </div>
    <!-- end .AN-PROFILE-SETTINGS -->
    </div>
    <!-- end .AN-TOPBAR-RIGHT-PART -->
    </header>
    <div class="an-page-content">
        <div class="an-sidebar-nav js-sidebar-toggle-with-click" data-pjax>
            <div class="an-sidebar-nav" style="padding: 0;">
                <ul class="an-main-nav">
                    <li class="an-nav-item" <? if ($nav=='home' ){ echo 'active';}?>>
                        <a href="admin_index.php"> <i class="iconfont" <? if ($nav=='home' ){ echo 'class="active"';}?> ></i>
                            <span class="nav-title" <? if ($nav=='home' ){ echo 'class="active"';}?> >管理首页</span>
                        </a>
                    </li>
                    <li class="an-nav-item" <? if ($nav=='sys'){ echo 'active';}?> <? if ($nav=='kefu'){ echo 'active';}?><? if ($nav=='daili'){ echo 'active';}?><? if ($nav=='color'){ echo 'active';}?>  <? if ($nav=='notice' ){ echo 'active';}?>>
                        <a class="js-show-child-nav"> <i class="iconfont"></i>
                            <span class="nav-title">平台管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='notice' ){ echo 'style="display: block;"';}  if ($nav=='sys'){ echo 'style="display: block;"';} if ($nav=='kefu'){ echo 'style="display: block;"';} if ($nav=='daili'){ echo 'style="display: block;"';} if ($nav=='color'){ echo 'style="display: block;"';} ?>>
                            <? if (strpos($site_qx,'公告管理') !==false) { ?>
                      <li <? if ($nav=='notice'){ echo 'class="active"';}?>><a href="notice.php" <? if ($nav=='notice'){ echo 'class="active"';}?>><span class="submenu-label">公告管理</span>
                        </a></li>    
                    <? }?>
					<? if (strpos($site_qx,'系统设置') !==false) { ?>

          <li <? if ($nav=='sys'){ echo 'class="active"';}?>><a href="sys.php" <? if ($nav=='sys'){ echo 'class="active"';}?>><span class="submenu-label">基本设置</span>
                        </a></li>
                        <? }?>
					 <? if (strpos($site_qx,'站点装饰') !==false) { ?>
                          <li <? if ($nav=='color'){ echo 'class="active"';}?>><a href="color.php" <? if ($nav=='color'){ echo 'class="active"';}?>><span class="submenu-label">平台装饰</span>
                        </a></li>
                        <? }?>
					 <? if (strpos($site_qx,'客服管理') !==false) { ?>
                        
                          <li <? if ($nav=='kefu'){ echo 'class="active"';}?>><a href="kefu.php" <? if ($nav=='sys'){ echo 'class="active"';}?>><span class="submenu-label">客服管理</span>
                        </a></li>
                        <? }?>
					 <? if (strpos($site_qx,'代理设置') !==false) { ?>
                
                                  <li <? if ($nav=='daili'){ echo 'class="active"';}?>><a href="daili.php" <? if ($nav=='daili'){ echo 'class="active"';}?>><span class="submenu-label">代理设置</span>
                        </a></li>
                        <? }?>
                     
                                  <li <? if ($nav=='banner'){ echo 'class="active"';}?>><a href="banner.php" <? if ($nav=='banner'){ echo 'class="active"';}?>><span class="submenu-label">幻灯管理</span>
                        </a></li>
                        </ul>
                    </li>
                    <li class="an-nav-item">
                        <a class="js-show-child-nav"  <? if ($nav=='shopchannel'){  echo 'active';} if ($nav=='shop'){  echo 'active';} if ($nav=='shopadd'){  echo 'active';} if ($nav=='xiadan'){  echo 'active';} if ($nav=='price'){  echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">商品管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='shopchannel'){  echo 'style="display: block;"';} if ($nav=='shop'){  echo 'style="display: block;"';} if ($nav=='shopadd'){  echo 'style="display: block;"';} if ($nav=='xiadan'){  echo 'style="display: block;"';} if ($nav=='price'){  echo 'style="display: block;"';}?> >
                            <li <? if ($nav=='price'){ echo 'class="active"';}?> ><a  <? if ($nav=='price'){ echo 'class="active"';}?>  href="price.php"><span class="submenu-label">加价模板</span>
                        </a></li> 
         <li <? if ($nav=='shop'){ echo 'class="active"';}?> ><a  <? if ($nav=='shop'){ echo 'class="active"';}?>  href="shop.php"><span class="submenu-label">商品列表</span>
                        </a></li>
                        </ul>
                    </li>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='czjl'){  echo 'active';}?><? if ($nav=='cztj'){  echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">支付管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav"<? if ($nav=='cztj'){  echo 'style="display: block;"';}?> <? if ($nav=='czjl'){  echo 'style="display: block;"';}?>>
                             <li <? if ($nav=='czjl'){ echo 'class="active"';}?>><a href="czjl.php"><span class="submenu-label">支付订单</span>
                        </a></li>
                        <li <? if ($nav=='cztj'){ echo 'class="active"';}?>><a href="cztj.php"><span class="submenu-label">支付统计</span>
                        </a></li>
                        </ul>
                    </li>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='member'){  echo 'active';}?>
                                                           <? if ($nav=='xfjl'){  echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">用户管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='member'){  echo 'style="display: block;"';}?>
                                                           <? if ($nav=='xfjl'){  echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='member'){ echo 'class="active"';}?>><a href="member.php" <? if ($nav=='member'){ echo 'class="active"';}?>><span class="submenu-label">用户列表</span>
                        </a></li>   
                        
                          <li <? if ($nav=='xfjl'){ echo 'class="active"';}?>><a href="xfjl.php" <? if ($nav=='xfjl'){ echo 'class="active"';}?>><span class="submenu-label">余额明细</span>
                        </a></li>   
                        </ul>
                    </li>
                    <? if (strpos($site_qx, '分站管理') !==false) { ?>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='edu'){ echo 'active';}?><? if ($nav=='fenzhan'){ echo 'active';}?><? if ($nav=='fenzhan_add'){ echo 'active';}?><? if ($nav=='fenzhan_add'){ echo 'active';}?><? if ($nav=='fenzhan_add'){ echo 'active';}?><? if ($nav=='fzset'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">分站管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav"  <? if ($nav=='edu'){ echo 'style="display: block;"';}?><? if ($nav=='fenzhan_add'){ echo 'style="display: block;"';}?><? if ($nav=='fenzhan'){ echo 'style="display: block;"';}?><? if ($nav=='fztx'){ echo 'style="display: block;"';}?><? if ($nav=='fzzj'){ echo 'style="display: block;"';}?><? if ($nav=='fenzhanset'){ echo 'style="display: block;"';}?>>
                           <!--<li <? if ($nav=='fenzhanset'){ echo 'class="active"';}?>><a href="fenzhanset.php" <? if ($nav=='fenzhanset'){ echo 'class="active"';}?>><span class="submenu-label">分站设置</span>-->
                        </a></li>   
                        
                              <li <? if ($nav=='fenzhan'){ echo 'class="active"';}?>><a href="fenzhan.php" <? if ($nav=='fenzhan'){ echo 'class="active"';}?>><span class="submenu-label">分站管理</span>
                        </a></li>   
                <li <? if ($nav=='fztx'){ echo 'class="active"';}?>><a href="fenzhan_add.php" <? if ($nav=='fenzhan_add'){ echo 'class="active"';}?>><span class="submenu-label">增加分站</span>
                        </a></li>       
                        </ul>
                    </li>
                    <? }?>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='order'){  echo 'active';}?>
             <? if ($nav=='order1'){  echo 'active';}?>
             <? if ($nav=='order2'){  echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">订单管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='order'){  echo 'style="display: block;"';}?>
             <? if ($nav=='order1'){  echo 'style="display: block;"';}?>
             <? if ($nav=='order2'){  echo 'style="display: block;"';}?>>
                             <li <? if ($nav=='order'){ echo 'class="active"';}?>><a href="order.php" <? if ($nav=='order'){ echo 'class="active"';}?>><span class="submenu-label">订单列表</span>
                        </a></li>   
                        
                                           <li <? if ($nav=='order1'){ echo 'class="active"';}?>><a href="order1.php" <? if ($nav=='order1'){ echo 'class="active"';}?>><span class="submenu-label">订单统计</span>
                        </a></li>     
                                                                 <li <? if ($nav=='order2'){ echo 'class="active"';}?>><a href="order2.php" <? if ($nav=='order2'){ echo 'class="active"';}?>><span class="submenu-label">销售统计</span>
                        </a></li>       
                        </ul>
                    </li>
                    <? if (strpos($site_qx, '卡密管理') !==false) { ?>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='kami'){ echo 'active';}?><? if ($nav=='kami1'){ echo 'active';}?>> <i class="iconfont"></i>
                            <span class="nav-title">社区卡密
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='kami'){ echo 'style="display: block;"';}?><? if ($nav=='kami1'){ echo 'style="display: block;"';}?>>
                        <li <? if ($nav=='kami'){ echo 'class="active"';}?>><a href="kami.php"><span class="submenu-label">我的社区一卡通</span>
                        </a>
                            </li>
                        </ul>
                    </li>
                    <? }?>
                    <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='point' ){ echo 'active';} if ($nav=='tx' ){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">财务管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='point' ){ echo 'style="display: block;"';} if ($nav=='tx' ){ echo 'style="display: block;"';}?>>
                            <li <? if ($nav=='tx'){ echo 'class="active"';}?>><a href="tx.php" <? if ($nav=='tx'){ echo 'class="active"';}?>><span class="submenu-label">资金提现</span>
                        </a></li>     

                                              <li <? if ($nav=='point'){ echo 'class="active"';}?>><a href="point.php" <? if ($nav=='point'){ echo 'class="active"';}?>><span class="submenu-label">资金明细</span>
                        </a></li>    
                        </ul>
                    </li>
                    <li class="an-nav-item"> <a class="js-show-child-nav  " <? if ($nav=='jisuan' ){ echo 'active';} if ($nav=='log' ){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">安全管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                        <ul class="an-child-nav js-open-nav" <? if ($nav=='jisuan' ){ echo 'style="display: block;"';} if ($nav=='log' ){ echo 'style="display: block;"';} if ($nav=='guanli' ){ echo 'style="display: block;"';}?>>
                            <li><a  href="/index/home/password/id/<?php $result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.'  order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){echo $row['ID']; goto aa;} aa: ?>.html" >个人资料</a>
                            </li>
                            <li><a pjax="no" href="javascript:if(confirm('确实要退出吗?'))location='logout.php'">注销登录
    </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
        <script type="text/javascript">
            KindEditor.ready(function(K) {
                K.create('#i_content');
                var editor = K.editor({
                    allowFileManager: false,
                    allowPreviewEmoticons: false
                });
                K('#pic').click(function() {
                    editor.loadPlugin('image', function() {
                        editor.plugin.imageDialog({
                            imageUrl: K('#pic').val(),
                            clickFn: function(url, title, width, height, border, align) {
                                K('#pic').val(url);
                                editor.hideDialog();
                            }
                        });
                    });
                });
            });
        </script>
          <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/moment.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/daterangepicker.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/wow.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/perfect-scrollbar.jquery.min.js"
            type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/selectize.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/owl.carousel.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/Chart.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/circle-progress.min.js" type="text/javascript"></script>

    <!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   -->
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/customize-chart.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/scripts.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.pjax.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/layer/layer.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/v3/js/vue.min.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/v3/js/main.js?v=3.0.8"></script>
    <script>
        new Vue({
            el: '#messages',
            data: {
                messageList: [],
                readMessages: [],
            },
            methods: {
                getNewMessage: function () {
                    var vm = this;
                    this.$post("/home", {action: 'message', type: 'new'})
                        .then(function (data) {
                            if (data.status === 0) {
                                if ($.cookie('readMessages')) {
                                    vm.readMessages = $.cookie('readMessages').split(',');
                                }
                                data.data.forEach(function (message) {
                                    if (message.top) {
                                        if (vm.readMessages.indexOf(message.id + '') === -1) {
                                            vm.messageInfo(message);
                                        }
                                    }
                                });
                                vm.messageList = data.data;
                            } else {
                                vm.$message(data.message, 'error');
                            }
                        });
                },
                messageInfo(row) {
                    if (this.readMessages.indexOf(row.id + '') === -1) {
                        this.readMessages.push(row.id + '');
                        $.cookie('readMessages', this.readMessages.join(','), {expires: 15});
                    }
                    layer.open({
                        title: row.title,
                        content: row.content + '<div style="float: right;\n' +
                            '    margin: 40px 0 -15px 0;\n' +
                            '    font-size: 8px;\n' +
                            '    color: grey;">发送于：' + row.created_at + '</div>'
                    });
                }
            },
            mounted: function () {
                this.getNewMessage();
            }
        });
    </script>
        <script>
        new Vue({
            el: '#vue',
            data: {
                search: {page: 1, kind: 0},
                data: {},
            },
            methods: {
                profile: function () {
                    var vm = this;
                    this.$post("/profile", $("#form-profile").serialize())
                        .then(function (data) {
                            if (data.status === 0) {
                                vm.$message(data.message, 'success');
                            } else {
                                vm.$message(data.message, 'error');
                            }
                        });
                },
                delBind: function (kind) {
                    var vm = this;
                    this.$post("/home", {action: 'delBind', kind: kind})
                        .then(function (data) {
                            if (data.status === 0) {
                                vm.$message(data.message, 'success');
                                $.pjax.reload('#pjax-container');
                            } else {
                                vm.$message(data.message, 'error');
                            }
                        });
                }
            },
            mounted: function () {
            }
        });
    </script>
    </body>
    </html>
