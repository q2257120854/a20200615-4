<html lang="zh-cn"><head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" id="mixia_vpid">
        <title><?=$site_name?>-供货商系统</title>
     <link rel="shortcut icon" href="<?=$site_ico?>"/>
        <link href="/doc/file/vendor-styles.css" rel="stylesheet">
  <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
  <link rel="stylesheet" href="/doc/file/styles.css">
        <link href="/doc/file/main.css" rel="stylesheet">
            </head>
    <body>
    <div class="main-wrapper">
    <div class="an-loader-container">
            <img src="/assets/index/19lou/images/loader.png" >
        </div>
        <header class="an-header wow fadeInDown">
    <div class="an-topbar-left-part">
        <h3 class="an-logo-heading">
            <a class="an-logo-link" href="/">创梦社区供货商系统</a>
        </h3>
        <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar">
            <i class="icon-list"></i>
        </button>
    </div>


        <div class="an-profile-settings">
            <div class="btn-group an-notifications-dropown  profile">
                <button type="button" class="an-btn an-btn-icon dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="an-profile-img"
                          style="background-image: url('//q4.qlogo.cn/headimg_dl?dst_uin=<?=$a_qq?>&spec=100');"></span>
                    <span class="an-user-name"><?=$a_name?></span>
                </button>
                </div>
            </div>
        </div> <!-- end .AN-PROFILE-SETTINGS -->
    </div> <!-- end .AN-TOPBAR-RIGHT-PART -->
</header>        <div class="an-page-content">
                  <div class="an-sidebar-nav js-sidebar-toggle-with-click" data-pjax>
    <div class="an-sidebar-nav" style="padding: 0;">
        <ul class="an-main-nav">
            <li class="an-nav-item"<? if ($nav=='home'){ echo 'active';}?>>
                <a href="admin_index.php">
                    <i class="iconfont"<? if ($nav=='home'){ echo 'class="active"';}?>>&#xe60c;</i>
                    <span class="nav-title"<? if ($nav=='home'){ echo 'class="active"';}?>>管理首页</span>
                </a>
            </li>
         <li class="an-nav-item">
            <? if (strpos($site_qx,'商品管理') !==false) { ?>
                     <li class="an-nav-item"<? if ($nav=='shopchannel'){  echo 'active';}?>
                                       <? if ($nav=='shop'){  echo 'active';}?>
                                       <? if ($nav=='shopadd'){  echo 'active';}?>
                                       <? if ($nav=='templates'){  echo 'active';}?>
                                       <? if ($nav=='price'){  echo 'active';}?>
                                       <? if ($nav=='duijie'){  echo 'active';}?>>
                                       <? if ($nav=='templates_add'){  echo 'active';}?>
                    <a class="js-show-child-nav">
                        <i class="iconfont">&#xe61e;</i>
                        <span class="nav-title">商品管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                    <ul class="an-child-nav js-open-nav" <? if ($nav=='shopchannel'){  echo 'style="display: block;"';}?>
                                       <? if ($nav=='shop'){  echo 'style="display: block;"';}?>
                                       <? if ($nav=='shopadd'){  echo 'style="display: block;"';}?>
                                       <? if ($nav=='templates'){  echo 'style="display: block;"';}?>
                                       <? if ($nav=='price'){  echo 'style="display: block;"';}?>
                                       <? if ($nav=='duijie'){  echo 'style="display: block;"';}?>>
                                       <? if ($nav=='templates_add'){  echo 'style="display: block;"';}?>

                                                <li <? if ($nav=='price'){ echo 'class="active"';}?> ><a  <? if ($nav=='price'){ echo 'class="active"';}?>  href="price.php"><span class="submenu-label">销售配置</span>
                        </a></li> 
                        
                      
         <li <? if ($nav=='shopchannel'){ echo 'class="active"';}?> ><a  <? if ($nav=='shopchannel'){ echo 'class="active"';}?>  href="shop_channel.php"><span class="submenu-label">商品分类</span>
                        </a></li>

         <li <? if ($nav=='shop'){ echo 'class="active"';}?> ><a  <? if ($nav=='shop'){ echo 'class="active"';}?>  href="shop.php"><span class="submenu-label">商品列表</span>
                        </a></li>
         <li <? if ($nav=='shopadd'){ echo 'class="active"';}?> ><a  <? if ($nav=='shopadd'){ echo 'class="active"';}?>  href="shop_add.php"><span class="submenu-label">添加商品</span>
                        </a></li>  
                                                <li <? if ($nav=='kmshop'){ echo 'class="active"';}?> ><a  <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="shop_add.php?xid=0"><span class="submenu-label">添加商品(卡密)</span>
                         <li <? if ($nav=='kmshop'){ echo 'class="active"';}?> ><a  <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="kmshop.php"><span class="submenu-label">商品列表(卡密)</span>
                        </a></li>
                         <li <? if ($nav=='kucun'){ echo 'class="active"';}?> ><a  <? if ($nav=='kucun'){ echo 'class="active"';}?>  href="kucun.php"><span class="submenu-label">商品库存(卡密)</span>
                        </a></li> 
        <li <? if ($nav=='templates'){ echo 'class="active"';}?> ><a  <? if ($nav=='templates'){ echo 'class="active"';}?>  href="templates.php"><span class="submenu-label">充值模板</span>
                        </a></li>    
<li <? if ($nav=='templates_add'){ echo 'class="active"';}?> ><a  <? if ($nav=='templates_add'){ echo 'class="active"';}?>  href="templates_add.php"><span class="submenu-label">添加模板</span>
                        </a></li>   
                    </ul>
                </li>
                          <? }?>
            

<li class="an-nav-item">
                    <a class="js-show-child-nav"<? if ($nav=='order'){  echo 'active';}?>
             <? if ($nav=='order2'){  echo 'active';}?>
             <? if ($nav=='record'){  echo 'active';}?>
             >
                        <i class="iconfont">&#xe7ff;</i>
                        <span class="nav-title">订单管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                    <ul class="an-child-nav js-open-nav"<? if ($nav=='order'){  echo 'style="display: block;"';}?>
             <? if ($nav=='order2'){  echo 'style="display: block;"';}?>
             <? if ($nav=='record'){  echo 'style="display: block;"';}?>>
                       <li <? if ($nav=='order'){ echo 'class="active"';}?>><a href="order.php" <? if ($nav=='order'){ echo 'class="active"';}?>><span class="submenu-label">商品列表</span>
                        </a></li>   
                               <li <? if ($nav=='record'){ echo 'class="active"';}?>><a href="record.php" <? if ($nav=='record'){ echo 'class="active"';}?>  style="display:none"><span class="submenu-label">对接记录</span>
                        </a></li>   
                       <li <? if ($nav=='order2'){ echo 'class="active"';}?>><a href="order2.php" <? if ($nav=='order2'){ echo 'class="active"';}?>><span class="submenu-label">销售统计</span>
                       </a></li>
                           </ul>
                </li>
             <? if (strpos($site_qx,'卡密管理') !==false) { ?>
<li class="an-nav-item">
                    <a class="js-show-child-nav"<? if ($nav=='kami'){ echo 'active';}?><? if ($nav=='card'){ echo 'active';}?>>
                        <i class="iconfont">&#xe626;</i>
                        <span class="nav-title">卡密商品
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                    <ul class="an-child-nav js-open-nav" <? if ($nav=='kami'){ echo 'style="display: block;"';}?><? if ($nav=='card'){ echo 'style="display: block;"';}?>>
                                                        <li <? if ($nav=='kmshop'){ echo 'class="active"';}?> ><a  <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="shop_add.php?xid=0"><span class="submenu-label">添加商品(卡密)</span>
                         <li <? if ($nav=='kmshop'){ echo 'class="active"';}?> ><a  <? if ($nav=='kmshop'){ echo 'class="active"';}?>  href="kmshop.php"><span class="submenu-label">商品列表(卡密)</span>
                        </a></li>
                         <li <? if ($nav=='kucun'){ echo 'class="active"';}?> ><a  <? if ($nav=='kucun'){ echo 'class="active"';}?>  href="kucun.php"><span class="submenu-label">商品库存(卡密)</span>                      
                        </a></li>
                   
                                            </ul>
                </li>
        
        <? }?>
<li class="an-nav-item">
                    <a class="js-show-child-nav"<? if ($nav=='point'){ echo 'active';}?><? if ($nav=='tx'){ echo 'active';}?>>
                        <i class="iconfont">&#xe63e;</i>
                        <span class="nav-title">财务管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                    <ul class="an-child-nav js-open-nav" <? if ($nav=='point'){ echo 'style="display: block;"';}?><? if ($nav=='tx'){ echo 'style="display: block;"';}?> >
                         <li <? if ($nav=='tx'){ echo 'class="active"';}?>><a href="tx.php" <? if ($nav=='tx'){ echo 'class="active"';}?>><span class="submenu-label">资金提现</span>
                        </a></li>     
                            <li <? if ($nav=='point'){ echo 'class="active"';}?>><a href="point.php" <? if ($nav=='point'){ echo 'class="active"';}?>><span class="submenu-label">资金明细</span>
                           </a></li> 
                                            </ul>
                </li>
                <li class="an-nav-item">
                    <a class="js-show-child-nav  "<? if ($nav=='jisuan'){ echo 'active';}?><? if ($nav=='log'){ echo 'active';}?>>
                            <i class="iconfont">&#xe68b;</i>
                        <span class="nav-title">安全管理
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                  </span>
                    </a>
                    <ul class="an-child-nav js-open-nav" <? if ($nav=='jisuan'){ echo 'style="display: block;"';}?><? if ($nav=='log'){ echo 'style="display: block;"';}?> >
 <li ><a pjax="no" href="javascript:if(confirm('确实要退出吗?'))location='logout.php'">注销登录
    </a></li>
                                            </ul>
                </li>
    </div>
</div>
  <script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>
 		<script src="../assets/editoross/lang/zh_CN.js"></script>
 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	
	var editor = K.editor({
	allowFileManager : false,
	allowPreviewEmoticons : false				});
	K('#pic').click(function() {
 		editor.loadPlugin('image', function() {
 
			editor.plugin.imageDialog({
			imageUrl : K('#pic').val(),
 			
			clickFn : function(url, title, width, height, border, align) {
				K('#pic').val(url);
				editor.hideDialog();
				}
			});
		});
	});
 
});
 
 </script>	
  
            <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
                            <script src="/doc/file/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/doc/file/js/bootstrap.min.js" type="text/javascript"></script>  
    <script src="/doc/file/js/customize-chart.js" type="text/javascript"></script>
                          <script src="/doc/file/js/scripts.js" type="text/javascript"></script>
    <script src="/doc/file/js/jquery.pjax.min.js" type="text/javascript"></script>

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
        


    </script>
 
    </body>
    </html>

