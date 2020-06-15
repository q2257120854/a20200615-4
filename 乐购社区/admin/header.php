<html lang="zh-cn"><head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" id="mixia_vpid">
        <title><?=$site_name?></title>
                   <link href="http://static.xiaoyewl.net/yunyeka/assets/admin/css/animate.min.css" rel="stylesheet">
        <link href="http://static.xiaoyewl.net/yunyeka/assets/admin/css/vendor-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="http://static.xiaoyewl.net/yunyeka/assets/admin/css/styles.css">
        <link rel="stylesheet" href="http://static.xiaoyewl.net/yunyeka/assets/colpick/css/colpick.css">
        <link rel="stylesheet" href="http://static.xiaoyewl.net/yunyeka/assets/datepicker/datepicker.min.css">
        <link href="http://static.xiaoyewl.net/yunyeka/css/admin/main.css?v=3.0.9" rel="stylesheet">
         <link href="http://static.xiaoyewl.net/yunyeka/assets/umeditor/themes/default/_css/umeditor.css" type="text/css" rel="stylesheet">        
		   <style>.edui-editor-body {
                padding-top: 10px
            }
        </style>
<script type="text/javascript" language="javascript">
    function selectBox(selectType) {
        var checkboxis = document.getElementsByName("id[]");
        if (selectType == "reverse") {
            for (var i = 0; i < checkboxis.length; i++) {
                //alert(checkboxis[i].checked);
                checkboxis[i].checked =!checkboxis[i].checked;
            }
        } else if (selectType == "all") {
            for (var i = 0; i < checkboxis.length; i++) {
                //alert(checkboxis[i].checked);
                checkboxis[i].checked = true;
            }
        }
    }
</script>
</head>

<body style="">
    <div class="main-wrapper">
        <div class="an-loader-container">
            <img src="/images/loader.png">
        </div>
		<header class="an-header wow fadeInDown">
            <div class="an-topbar-left-part">
                <h3 class="an-logo-heading">
            <a class="an-logo-link" href="index">
                <i class="iconfont"></i><?=$site_name?>           </a>
        </h3>
                <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar"> <i class="icon-list"></i>
                </button>
            </div>
            <div class="an-topbar-right-part">
                <div class="an-profile-settings">
                    <div class="btn-group an-notifications-dropown  profile">
                        <button type="button" class="an-btn an-btn-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="an-profile-img" style="background-image: url('//q4.qlogo.cn/headimg_dl?dst_uin=<?=$a_qq?>&spec=100');"></span>
                            <span class="an-user-name"><?=$a_name?></span>
                            <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                        </button>
                        <div class="dropdown-menu">
                            <p class="an-info-count">个人资料</p>
                            <ul class="an-profile-list">
                                 <? if (!isset($_SESSION[ 'gly'])) { ?>
                                <li><a data-toggle="modal" data-target="#modal-profile"><i class="iconfont"></i>修改资料</a>
                                </li>
                                <? }?>
                                <li><a href="logout" onClick="return confirm('确认退出登录？')"><i class="icon-download-left"></i>退出登录</a>
                                </li>
                            </ul>
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
                        <li class="an-nav-item" <? if ($nav=='home'){ echo 'active';}?>>
                            <a href="admin_index"> <i class="iconfont" <? if ($nav=='home'){ echo 'class="active"';}?> ></i>
                                <span class="nav-title" <? if ($nav=='home'){ echo 'class="active"';}?> >管理首页</span>
                            </a>
                        </li>
                        <li class="an-nav-item" <? if ($nav=='home'){ echo 'active';}?> <? if ($nav=='fanghong'){ echo 'active';}?>
                            <? if ($nav=='kefu'){ echo 'active';}?>
                            <? if ($nav=='proxy'){ echo 'active';}?>
                            <? if ($nav=='template'or $nav=='banner'){ echo 'active';}?>
                            <? if ($nav=='pay'){ echo 'active';}?>
                           <? if ($nav=='daohang'){ echo 'active';}?>
                              <? if ($nav=='notice'){ echo 'active';}?>>
                            <a class="js-show-child-nav"> <i class="iconfont"></i>
                                <span class="nav-title">平台管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                                </span>
                            </a>
                            <ul class="an-child-nav js-open-nav" <?if ($nav=='fanghong'){ echo 'style="display: block;"';}   if ($nav=='notice'){ echo 'style="display: block;"';} if ($nav=='home'){ echo 'style="display: block;"';} if ($nav=='kefu'){ echo 'style="display: block;"';} if ($nav=='proxy'){ echo
                            'style="display: block;"';} if ($nav=='template'){ echo 'style="display: block;"';} if ($nav=='pay'){ echo 'style="display: block;"';} if ($nav=='banner'){ echo 'style="display: block;"';} if ($nav=='message'){ echo 'style="display: block;"';}?>>
                                <? if (strpos($site_qx, '系统设置')!==false) { ?>
                                <li <? if ($nav=='home'){ echo 'class="active"';}?>><a href="home" <? if ($nav=='home'){ echo 'class="active"';}?> ><span class="submenu-label">平台设置</span>
                        </a>
                                </li>
                                <? } if (strpos($site_qx, '站点装饰')!==false) { ?>
                                <li <? if ($nav=='template'){ echo 'class="active"';}?>><a href="template" <? if ($nav=='template'){ echo 'class="active"';}?> ><span class="submenu-label">平台装饰</span>
                        </a>
                                </li>
                                      <? } if (strpos($site_qx, '幻灯图片')!==false) { ?>
                                <li <? if ($nav=='banner'){ echo 'class="active"';}?>><a href="banner" <? if ($nav=='banner'){ echo 'class="active"';}?> ><span class="submenu-label">平台幻灯</span>
                        </a>
                                </li>
                               
                                <? } if (strpos($site_qx, '自由对接')!==false) { ?>
                                <li <? if ($nav=='pay'){ echo 'class="active"';}?>><a href="pay" <? if ($nav=='pay'){ echo 'class="active"';}?> ><span class="submenu-label">平台支付</span>
                        </a>
                                </li>                                     
                                   <? } if (strpos($site_qx, '公告管理')!==false) { ?>
                                <li <? if ($nav=='notice'){ echo 'class="active"';}?>><a href="notice" <? if ($nav=='notice'){ echo 'class="active"';}?> ><span class="submenu-label">平台公告</span>
                        </a>
                                </li>
                                                                <? } if (strpos($site_qx, '平台短信')!==false) { ?>
                                <li <? if ($nav=='message'){ echo 'class="active"';}?>><a href="message" <? if ($nav=='message'){ echo 'class="active"';}?> ><span class="submenu-label">平台短信</span>
                        </a>
                                </li>
                                <li <? if ($nav=='gongdan'){ echo 'class="active"';}?>><a href="gongdan">平台工单</a>
        </li>
                                <? } if (strpos($site_qx, '代理设置')!==false) { ?>
                                <li <? if ($nav=='proxy'){ echo 'class="active"';}?>><a href="proxy" <? if ($nav=='proxy'){ echo 'class="active"';}?> ><span class="submenu-label">平台代理</span>
                        </a>
                                </li>
                              
                                 <? } if (strpos($site_qx, '客服管理')!==false) { ?>
                                <li <? if ($nav=='kefu'){ echo 'class="active"';}?>><a href="kefu" <? if ($nav=='kefu'){ echo 'class="active"';}?> ><span class="submenu-label">平台客服</span>
                        </a>
                                </li>
                                <? }?>
                              <li <? if ($nav=='gongdan'){ echo 'class="active"';}?>><a href="gongdan" <? if ($nav=='gongdan'){ echo 'class="active"';}?> ><span class="submenu-label">平台工单</span>
                        </a>
                                </li>
                                 <li <? if ($nav=='app'){ echo 'class="active"';}?>><a href="app">平台APP</a>
        </li>
                              <li <? if ($nav=='fanghong'){ echo 'class="active"';}?>><a href="fanghongurl" <? if ($nav=='fanghong'){ echo 'class="active"';}?> ><span class="submenu-label">平台防洪</span>
                        </a></li>
                      <? if (strpos($site_qx, '管理权限')!==false) { ?>
                                <li <? if ($nav=='guanli'){ echo 'class="active"';}?>><a href="guanli"><span class="submenu-label">平台管理员</span> 
                                  </a></li><? }?>
                                  </ul>
                        </li>
                            <? if (strpos($site_qx, '供货权限')!==false) { ?>
                        <li class="an-nav-item"> <a class="js-show-child-nav " <? if ($nav=='supplier'){ echo 'active';} if ($nav=='gshop'){ echo 'active';} if ($nav=='gtx'){ echo 'active';} if ($nav=='guser'){ echo 'active';} if ($nav=='gzj'){ echo 'active';} if ($nav=='gorder'){ echo 'active';} ?> >
                        <i class="iconfont"></i>
                      <span class="nav-title">供货管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='supplier'){ echo 'style="display: block;"';}  if ($nav=='gshop'){ echo 'style="display: block;"';} if ($nav=='gtx'){ echo 'style="display: block;"';} if ($nav=='guser'){ echo 'style="display: block;"';} if ($nav=='gzj'){ echo 'style="display: block;"';} if ($nav=='gorder'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='supplier'){ echo 'class="active"';}?>><a href="supplier"><span class="submenu-label">供货配置</span></a>
								<li <? if ($nav=='gshop'){ echo 'class="active"';}?>><a href="gshop"><span class="submenu-label">供货商品列表</span></a>
								<li <? if ($nav=='gtx'){ echo 'class="active"';}?>><a href="gtx"><span class="submenu-label">供货余额提现</span></a>
								<li <? if ($nav=='guser'){ echo 'class="active"';}?>><a href="guser"><span class="submenu-label">供货用户列表</span></a>
								<li <? if ($nav=='gzj'){ echo 'class="active"';}?>><a href="gzj"><span class="submenu-label">供货余额明细</span></a>
								<li <? if ($nav=='gorder'){ echo 'class="active"';}?>><a href="gorder"><span class="submenu-label">订单统计</span></a>
                                </li>
                            </ul>
                        </li>
                        <? }?>
                               <li class="an-nav-item">
                        <a class="js-show-child-nav">
                            <i class="iconfont"></i>
                            <span class="nav-title">引流管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                        </a>
                    <ul class="an-child-nav js-open-nav">                                                                                               
                            <li><a href="irqqset">Q Q列表</a></li>
                            <li><a href="irinvite">邀请记录</a></li>
                            <li><a href="irpoint">积分明细</a></li>
                            <li><a href="iraward">奖品记录</a></li>
                            <li><a href="irhelp">使用教程</a></li>
                        </ul>
                    </li>
                              <li class="an-nav-item"> <a class="js-show-child-nav " <? if ($nav=='copy'){ echo 'active';} if ($nav=='cztj'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">克隆管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='xxx'){ echo 'style="display: block;"';} if ($nav=='copy'){ echo 'style="display: block;"';}?>>                        
                                <li <? if ($nav=='copy'){ echo 'class="active"';}?>><a href="copy" <? if ($nav=='copy'){ echo 'class="active"';}?> ><span class="submenu-label">克隆单商品</span>
                        </a>
                                </li>
                                <li <? if ($nav=='copy'){ echo 'class="active"';}?>><a href="copyc" <? if ($nav=='copy'){ echo 'class="active"';}?> ><span class="submenu-label">克隆多商品</span>
                        </a>
                                </li>
                                <li <? if ($nav=='copy'){ echo 'class="active"';}?>><a href="copysite" <? if ($nav=='copy'){ echo 'class="active"';}?> ><span class="submenu-label">克隆整站点</span>
                        </a>
                                </li>

                        </a>
                            </ul>
                        </li>                    
                                           <li class="an-nav-item">
                            <a class="js-show-child-nav" <? if ($nav=='shequjk'){ echo 'active';} if ($nav=='doking'){ echo 'active';}?>
                                <? if ($nav=='duijie'){ echo 'active';}?>
                                <? if ($nav=='copysq'){ echo 'active';}?>> <i class="iconfont"></i>
                                <span class="nav-title">对接设置
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                                </span>
                            </a>
                            <ul class="an-child-nav js-open-nav" <?php if ($nav=='shequjk'){ echo 'style="display: block;"';} if ($nav=='doking'){ echo 'style="display: block;"';} if ($nav=='duijie'){ echo 'style="display: block;"';} if ($nav=='copysq'
                            ){ echo 'style="display: block;"';} ?>>
                                <? if (strpos($site_qx, '商品对接')!==false) { ?>
                                <li <? if ($nav=='doking'){ echo 'class="active"';}?>><a <? if ($nav=='doking'){ echo 'class="active"';}?>  href="doking"><span class="submenu-label">对接推荐</span>
                        </a>
                                </li>
                                <li <? if ($nav=='duijie'){ echo 'class="active"';}?>><a <? if ($nav=='duijie'){ echo 'class="active"';}?>  href="duijie"><span class="submenu-label">对接配置</span>
                        </a>
                                </li>
                                        <li <? if ($nav=='price'){ echo 'class="active"';}?>><a <? if ($nav=='price'){ echo 'class="active"';}?>  href="price"><span class="submenu-label">对接加价</span>
                        </a>
                                </li>
                                <li <? if ($nav=='shequjk'){ echo 'class="active"';}?>><a <? if ($nav=='shequjk'){ echo 'class="active"';}?>  href="shequjk"><span class="submenu-label">对接监控</span>
                        </a>
                                </li>
                                <li <? if ($nav=='copysq'){ echo 'class="active"';}?>><a <? if ($nav=='copysq'){ echo 'class="active"';}?>  href="copysq"><span class="submenu-label">对接克隆</span>
                        </a>
                                </li>
                            <li <? if ($nav=='record'){ echo 'class="active"';}?>><a href="record">对接记录</a>
        </li>
                                     <? }?>
                            </ul>
                        </li>
                        <? if (strpos($site_qx, '商品管理')!==false) { ?>
                        <li class="an-nav-item">
                            <a class="js-show-child-nav" <? if ($nav=='shopchannel'){ echo 'active';}?>
                                <? if ($nav=='shop'){ echo 'active';} if ($nav=='kuaisudingjia_all'){ echo 'active';}?>
                                <? if ($nav=='shopkm'){ echo 'active';}?>
                                <? if ($nav=='shopadd'){ echo 'active';}?>
                                <? if ($nav=='kucun'){ echo 'active';}?>
                                <? if ($nav=='templates'){ echo 'active';}?>
                                <? if ($nav=='price'){ echo 'active';}?>
                                <? if ($nav=='kuaisudingjia'){ echo 'active';}?>
                                <? if ($nav=='templates_add'){ echo 'active';}?>> <i class="iconfont"></i>
                                <span class="nav-title">商品管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                                </span>
                            </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='shopchannel'){ echo 'style="display: block;"';} if ($nav=='kucun'){ echo 'style="display: block;"';}if ($nav=='kuaisudingjia_all'){ echo 'style="display: block;"';} if ($nav=='shop'){ echo 'style="display: block;"';} if ($nav=='shopadd'
                            ){ echo 'style="display: block;"';} if ($nav=='shopkm'){ echo 'style="display: block;"';} if ($nav=='templates'){ echo 'style="display: block;"';} if ($nav=='price'){ echo 'style="display: block;"';}if ($nav=='templates_add'
                            ){ echo 'style="display: block;"';}if ($nav=='kuaisudingjia'){ echo 'style="display: block;"';} ?>>
                        <li <? if ($nav=='kuaisudingjia'){ echo 'class="active"';}?>><a <? if ($nav=='kuaisudingjia'){ echo 'class="active"';}?>  href="kuaisudingjia"><span class="submenu-label">商品定价(单个)</span>
                        </a>
                                </li>
                               <li <? if ($nav=='kuaisudingjia_all'){ echo 'class="active"';}?>><a <? if ($nav=='kuaisudingjia_all'){ echo 'class="active"';}?>  href="kuaisudingjia_all"><span class="submenu-label">商品定价(所有)</span>
                        </a>
                                </li>
                                <li <? if ($nav=='shopchannel'){ echo 'class="active"';}?>><a <? if ($nav=='shopchannel'){ echo 'class="active"';}?>  href="shop_channel"><span class="submenu-label">商品分类</span>
                        </a>
                                </li>
                                <li <? if ($nav=='shop'){ echo 'class="active"';}?>><a <? if ($nav=='shop'){ echo 'class="active"';}?>  href="shop"><span class="submenu-label">商品列表</span>
                        </a>
                                </li>
                                <li <? if ($nav=='shopadd'){ echo 'class="active"';}?>><a <? if ($nav=='shopadd'){ echo 'class="active"';}?>  href="shop_add"><span class="submenu-label">商品添加</span>
                        </a>
                                </li>
                                     <li <? if ($nav=='templates'){ echo 'class="active"';}?>><a <? if ($nav=='templates'){ echo 'class="active"';}?>  href="templates"><span class="submenu-label">商品模型</span>
                        </a>
                                </li>
                                    </ul>
                        </li>                            
                                               <? if (strpos($site_qx, '自动发货')!==false) { ?>
                                   <li class="an-nav-item"> <a class="js-show-child-nav  "  > <i class="iconfont"></i>
                            <span class="nav-title">卡密商品
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" >
                                <li <? if ($nav=='kmshop'){ echo 'class="active"';}?>><a <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="shop_add?xid=0"><span class="submenu-label">卡密添加</span>
							</a>
                                </li>
                                <li <? if ($nav=='kmshop'){ echo 'class="active"';}?>><a <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="kmshop"><span class="submenu-label">卡密列表</span>
                        </a>
                                </li>
                                <li <? if ($nav=='kucun'){ echo 'class="active"';}?>><a <? if ($nav=='kucun'){ echo 'class="active"';}?>  href="kucun"><span class="submenu-label">卡密库存</span>
                        </a>
                                </li>
                                <? }?>
                                <li style="display:none" <? if ($nav=='shopkm'){ echo 'class="active"';}?>><a <? if ($nav=='shopkm'){ echo 'class="active"';}?>  href="shopkm"><span class="submenu-label">商品卡密列表</span>
                        </a>
                                </li>                           
                            </ul>
                        </li>
                        <? }?>                 
                        <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='Recharge'){ echo 'active';} if ($nav=='cztj'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">支付管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='Recharge'){ echo 'style="display: block;"';} if ($nav=='tongji'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='Recharge'){ echo 'class="active"';}?>><a href="Recharge"><span class="submenu-label">支付订单</span>
                        </a>
                                </li>
                                <li <? if ($nav=='tongji'){ echo 'class="active"';}?>><a href="tongji"><span class="submenu-label">充值统计</span>
                        </a>
                                </li>
                            </ul>
                        </li>
                        <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='member'){ echo 'active';} if ($nav=='jilu'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">用户管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='member'){ echo 'style="display: block;"';} if ($nav=='jilu'){ echo 'style="display: block;"';} if ($nav=='usermj'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='member'){ echo 'class="active"';}?>><a href="member" <? if ($nav=='member'){ echo 'class="active"';}?> ><span class="submenu-label">用户信息</span>
                        </a>
                                </li>
                                <li <? if ($nav=='jilu'){ echo 'class="active"';}?>><a href="jilu" <? if ($nav=='jilu'){ echo 'class="active"';}?> ><span class="submenu-label">用户余额</span>
                        </a>
                                </li>
                                <li <? if ($nav=='usermj'){ echo 'class="active"';}?>><a href="usermj" <? if ($nav=='usermj'){ echo 'class="active"';}?> ><span class="submenu-label">用户密价</span>
                        </a>
                                </li>
                            </ul>
                        </li>
                        <? if (strpos($site_qx, '分站管理')!==false) { ?>
                        <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='edu'){ echo 'active';} if ($nav=='fenzhan'){ echo 'active';} if ($nav=='fenzhan_add'){ echo 'active';} if ($nav=='fztx'){ echo 'active';} if ($nav=='fzzj'){ echo 'active';} if ($nav=='fzset'
                            ){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">分站管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='edu'){ echo 'style="display: block;"';} if ($nav=='fenzhan_add'){ echo 'style="display: block;"';} if ($nav=='fenzhan'){ echo 'style="display: block;"';} if ($nav=='fztx'){ echo
                            'style="display: block;"';} if ($nav=='fzzj'){ echo 'style="display: block;"';} if ($nav=='fenzhanset'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='fenzhanset'){ echo 'class="active"';}?>><a href="fenzhanset" <? if ($nav=='fenzhanset'){ echo 'class="active"';}?> ><span class="submenu-label">分站设置</span>
                        </a>
                                </li>
                                <li <? if ($nav=='fenzhan'){ echo 'class="active"';}?>><a href="fenzhan" <? if ($nav=='fenzhan'){ echo 'class="active"';}?> ><span class="submenu-label">分站管理</span>
                        </a>
                                </li>
                                <li <? if ($nav=='fztx'){ echo 'class="active"';}?>><a href="fztx" <? if ($nav=='fztx'){ echo 'class="active"';}?> ><span class="submenu-label">提现管理</span>
                        </a>
                                </li>
                                <li <? if ($nav=='fzzj'){ echo 'class="active"';}?>><a href="fzzj" <? if ($nav=='fzzj'){ echo 'class="active"';}?> ><span class="submenu-label">资金明细</span>
                        </a>
                                </li>
                                <li <? if ($nav=='edu'){ echo 'class="active"';}?>><a href="edu" <? if ($nav=='edu'){ echo 'class="active"';}?> ><span class="submenu-label">额度明细</span>
                        </a>
                                </li>
                            </ul>
                        </li>
                        <? }?>
                        <li class="an-nav-item"> <a class="js-show-child-nav" <?if ($nav=='count'){ echo 'active';} if ($nav=='order2'){ echo 'active';}  if ($nav=='order'){ echo 'active';} if ($nav=='order2'){ echo 'active';} if ($nav=='record'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">订单管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='count'){ echo 'style="display: block;"';}  if ($nav=='order'){ echo 'style="display: block;"';} if ($nav=='order2'){ echo 'style="display: block;"';} if ($nav=='record'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='order'){ echo 'class="active"';}?>><a href="order" <? if ($nav=='order'){ echo 'class="active"';}?> ><span class="submenu-label">订单处理</span>
                        </a>
                                </li>
                             <li <? if ($nav=='order1'){ echo 'class="active"';}?>><a href="order1">订单统计</a>
        </li>
                                <li <? if ($nav=='order2'){ echo 'class="active"';}?>><a href="order2" <? if ($nav=='order2'){ echo 'class="active"';}?> ><span class="submenu-label">订单销售</span>
                       </a>
                                 <li <? if ($nav=='order3'){ echo 'class="active"';}?>><a href="order3">订单导出</a>
        </li>
                      <li <? if ($nav=='count'){ echo 'class="active"';}?>><a href="count" <? if ($nav=='count'){ echo 'class="active"';}?> ><span class="submenu-label">数据统计</span>
                       </a>
                                </li>
                            </ul>
                        </li>
                        <? if (strpos($site_qx, '卡密管理')!==false) { ?>
                        <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='kami'){ echo 'active';} if ($nav=='card'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">社区卡密
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='kami'){ echo 'style="display: block;"';} if ($nav=='card'){ echo 'style="display: block;"';}?>>
                            <li <? if ($nav=='kami1'){ echo 'class="active"';}?>><a href="kami1">我的加款卡</a>
        </li>
                                     <li <? if ($nav=='kami'){ echo 'class="active"';}?>><a href="kami"><span class="submenu-label">全部加款卡</span>
                        </a>
                                </li>
                            </ul>
                        </li>
                        <? }?>
                                      <li class="an-nav-item"> <a class="js-show-child-nav"  > <i class="iconfont">&#xe9e;</i>
                            <span class="nav-title">加款机器
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" >
                                <li ><a href="qqjk"><span class="submenu-label">QQ加款机器人</span>
                        </a>
                                </li>
                              <li ><a   href="wxjk"><span class="submenu-label">微信加款机器人</span>
                        </a>
                                </li>
                               </ul>
                        </li>
                                   <li class="an-nav-item"> <a class="js-show-child-nav" <? if ($nav=='point'){ echo 'active';} if ($nav=='tx'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">财务管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='point'){ echo 'style="display: block;"';} if ($nav=='tx'){ echo 'style="display: block;"';}?>>
                                <li <? if ($nav=='tx'){ echo 'class="active"';}?>><a href="tx" <? if ($nav=='tx'){ echo 'class="active"';}?> ><span class="submenu-label">资金提现</span>
                        </a>
                                </li>
                                <li <? if ($nav=='point'){ echo 'class="active"';}?>><a href="point" <? if ($nav=='point'){ echo 'class="active"';}?> ><span class="submenu-label">资金明细</span>
                           </a>
                                </li>
                            </ul>
                        </li>
						<li class="an-nav-item">
    <a class="js-show-child-nav" <? if ($nav=='turntableset'){ echo 'class="active"';}?> <? if ($nav=='turntable_record'){ echo 'class="active"';}?>> <i class="iconfont"></i>
        <span class="nav-title">娱乐管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
    </a>
    <ul class="an-child-nav js-open-nav" <? if ($nav=='turntableset'){ echo 'style="display: block;"';} if ($nav=='turntable_record'){ echo 'style="display: block;"';} ?>>
        <li <? if ($nav=='turntableset'){ echo 'class="active"';}?>><a href="turntableset">抽奖设置</a>
        </li>
        <li <? if ($nav=='turntable_record'){ echo 'class="active"';}?>><a href="turntable_record">抽奖记录</a>
        </li>
    </ul>
</li>
						<li class="an-nav-item">
    <a class="js-show-child-nav"> <i class="iconfont">&#xe68c;</i>
        <span class="nav-title">其它功能
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
    </a>
    <ul class="an-child-nav js-open-nav" >
        <li><a onclick='layer.open({type:2,area:["360px","500px"],shade:!1,skin:"layui-layer-rim",maxmin:!0,content:["https://ps.gaoding.com/sources/21ae98f8e9dabe552b/index.html","yes"]})'>在线PS</a>
        </li>
<li><a onclick='layer.open({type:2,area:["360px","500px"],shade:!1,skin:"layui-layer-rim",maxmin:!0,content:["http://kindeditor.net/demo.php","yes"]})'>文本编辑</a></li>
<li><a onclick='layer.open({type:2,area:["360px","500px"],shade:!1,skin:"layui-layer-rim",maxmin:!0,content:["http://img.skywl.cc/","yes"]})'>高速图床</a></li>
    </ul>
</li>
                        <li class="an-nav-item"> <a class="js-show-child-nav  " <? if ($nav=='jisuan'){ echo 'active';} if ($nav=='log'){ echo 'active';}?> > <i class="iconfont"></i>
                            <span class="nav-title">安全管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" <? if ($nav=='jisuan'){ echo 'style="display: block;"';} if ($nav=='log'){ echo 'style="display: block;"';} if ($nav=='guanli'){ echo 'style="display: block;"';}?>>
                                 <li <? if ($nav=='tools'){ echo 'class="active"';}?>><a href="tools">安全计算</a>
        </li>
                                     <li <? if ($nav=='log'){ echo 'class="active"';}?>><a href="log"><span class="submenu-label">登录记录</span>   
                        </a>
                                     <li <? if ($nav=='cjjl'){ echo 'class="active"';}?>><a href="czjl">操作记录</a>
        </li>
                                   <li <? if ($nav=='logout'){ echo 'class="active"';}?>><a href="logout">安全退出</a>
        </li>
                                </li>
                        </li>
                        </ul>
                        </li>
                               <li class="an-nav-item"> <a class="js-show-child-nav  "  > <i class="iconfont"></i>
                            <span class="nav-title">版本记录
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                            </span>
                        </a>
                            <ul class="an-child-nav js-open-nav" >
                                                                <li ><a href="version"><span class="submenu-label">更新日志</span>                           </a>
                    </ul>
                </div>
            </div>