
<header class="an-header wow fadeInDown" style="margin-top:-22">
    <div class="an-topbar-left-part">
        <h3 class="an-logo-heading">
            <a class="an-logo-link" href="/"><?=$site_name?> </a>
        </h3>
        <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar">
            <i class="icon-list"></i>
        </button>
    </div>
<?php
if ($is_shoucang==1)
{
$sc='getcollectdel';
}else{
$sc='getcollect';	
}
?>
    <div class="an-topbar-right-part">
	<a class="" id="<?=$sc?>" href="#"> <img src="http://skywl.oss-cn-shanghai.aliyuncs.com/shoucang.png" width="32"></a>
        <div class="an-messages" id="messages">
            <div class="btn-group an-notifications-dropown messages">
                <button type="button" class="an-btn an-btn-icon dropdown-toggle js-has-new-messages"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="ion-ios-email-outline"></i>
                </button>
                                <div class="dropdown-menu">
                    <p class="an-info-count">平台公告</p>
                    <div class="an-info-content notifications-info ps-container ps-theme-default">
                        
                        <div class="an-info-single unread" v-for="(row,i) in messageList" :key="i">

                                                    <a @click="messageInfo(row)">
                                <span class="user-img"
                                      style="background-image: url('//q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100')"></span>
                                <div class="info-content">
                                                      <h5 class="user-name">暂无标题</h5>
                                    <p class="content"><i class="icon-clock"></i>暂无内容</p>
                                </div>
                            </a>
                        </div>
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </div> <!-- end .AN-INFO-CONTENT -->
                    <div class="an-info-show-all-btn">
                        <a class="an-btn an-btn-transparent fluid rounded uppercase small-font" href="/index/home/message/id/<?=$_GET['id']?>.html"
                           data-pjax>查看所有</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="an-profile-settings">
            <div class="btn-group an-notifications-dropown  profile">
                <button type="button" class="an-btn an-btn-icon dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="an-profile-img"
                          style="background-image: url('//q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100');"></span>
                    <span class="an-user-name"><?=$member_qq?></span>
                    <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
                </button>
                <div class="dropdown-menu">
                    <p class="an-info-count">个人资料</p>
                    <ul class="an-profile-list">
					<?php if($member_level=='站长'){ ?><li><a href="/user/admin_index.php"><i class="iconfont"></i>控制面板</a></li><? } ?>
                        <li><a href="/index/home/password/id/<?=$_GET['id']?>.html" data-pjax><i class="icon-user"></i>修改资料</a></li>
                                                <li><a href="/index/home/duijie/id/<?=$_GET['id']?>.html" data-pjax><i class="iconfont">&#xe626;</i>代刷对接</a></li>
                                                 <li><a href="/index/home/logout.html" onclick="return confirm('确认退出登录？')"><i class="icon-download-left"></i>退出登录</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- end .AN-PROFILE-SETTINGS -->
    </div> <!-- end .AN-TOPBAR-RIGHT-PART -->
</header>        
<div class="an-page-content">
            <div class="an-sidebar-nav js-sidebar-toggle-with-click" data-pjax>
    <div class="an-sidebar-nav" style="padding: 0;">
        <ul class="an-main-nav">
            <li class="an-nav-item">
                <a href="/" pjax="no">
                    <i class="iconfont"></i>
                    <span class="nav-title">平台首页</span>
                </a>
            </li>
            <li class="an-nav-item" <? if ($nav=='pay'){echo "active";}  ?>>
                <a href="/index/home/order/id/<?=$_GET['id']?>.html" >
                    <i class="iconfont"></i>
                    <span class="nav-title">在线下单</span>
                </a>
            </li>
            <li class="an-nav-item" <? if ($nav=='cz'){echo "active";}  ?>>
                <a href="/index/home/pay/id/<?=$_GET['id']?>.html" >
                    <i class="iconfont"></i>
                    <span class="nav-title">余额充值</span>
                </a>
            </li>
            <li class="an-nav-item" <? if ($nav=='rmbjl'){echo "active";}  ?>>
                <a href="/index/home/rmb_record/id/<?=$_GET['id']?>.html">
                    <i class="iconfont"></i>
                    <span class="nav-title">余额明细</span>
                </a>
            </li>
            <li class="an-nav-item" <? if ($nav=='log'){echo "active";}  ?>>
                <a href="/index/home/login_record/id/<?=$_GET['id']?>.html">
                    <i class="iconfont"></i>
                    <span class="nav-title">登录记录</span>
                </a>
            </li>
			<li class="an-nav-item" <? if ($nav=='gongdan'){echo "active";}  ?>>
                <a href="/index/home/gongdan/id/<?=$_GET['id']?>.html">
                    <i class="iconfont"></i>
                    <span class="nav-title">工单记录</span>
                </a>
            </li>
                      <li class="an-nav-item" <? if ($nav=='log'){echo "active";}  ?>>
                <a href="/index/home/duijie/id/<?=$_GET['id']?>.html">
                    <i class="iconfont"></i>
                    <span class="nav-title">彩虹对接</span>
                </a>
            </li>
			 <li class="an-nav-item" <? if ($nav=='turntable'){echo "active";}  ?>>
                <a href="/index/home/turntable/id/<?=$_GET['id']?>.html"> <i class="iconfont"></i>
                                <span class="nav-title">幸运转盘</span>
                            </a>
                        </li>
                       <? if ($site_isktfz==1) {?>    
          <li class="an-nav-item" <? if ($nav=='ktfz'){echo "active";}  ?>>
                    <a href="/index/home/ktfz/id/<?=$_GET['id']?>.html">
                        <i class="iconfont"></i>
                        <span class="nav-title">搭建分站</span>
                    </a>
                </li>
                            <? }?>
                            <li class="an-nav-item" <? if ($nav=='collect'){echo "active";}  ?>>
                <a href="/index/home/collect/id/<?=$_GET['id']?>.html">
                    <i class="iconfont">&#xe60a</i>
                    <span class="nav-title">我的收藏</span>
                </a>
            </li>	
                         <li class="an-nav-item">
                <a onclick="layer.open({
  type: 2,
  area: ['360px', '500px'],
  skin: 'layui-layer-rim', //加上边框
  content: ['/idtools.php', 'yes']
});">
                    <i class="iconfont"></i>
                    <span class="nav-title">ID</span>
                </a>
            </li>	
</ul>
</ul>
    </div>
</div>

