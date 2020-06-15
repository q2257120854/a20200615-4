 
<header class="top-nav">
    <div class="top-nav-inner">
        <div class="nav-header">
            <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleSM">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav-notification pull-right">
                <li>
    <a href="#" data-toggle="dropdown" class="load_message"><i class="fa fa-envelope fa-lg"></i></a>
    <span class="badge badge-danger bounceIn animation-delay1 active">1</span>
    <ul class="dropdown-menu message pull-right messageList">
        <li><a>仅保留最新5条消息</a></li>
        <li class="messageLoad" style="padding: 10px;text-align: center;"><img src="/images/ajax-loader-6.gif" title="加载中"></li>
    </ul>
</li>

                <li>
                    <a class="lucky_btn"> <img src="/images/lucky.jpg" width="15"></a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i></a>
                    <span class="badge badge-danger bounceIn">1</span>
                    <ul class="dropdown-menu dropdown-sm pull-right user-dropdown">
                        <li class="user-avatar">
                            <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100" alt="" class="img-circle">
                            <div class="user-content">
                                <h5 class="no-m-bottom"><?=$member_qq?></h5>
                                <div class="m-top-xs">
                                    <a href="/index/home/password/id/<?=$_GET['id']?>.html" class="m-right-sm">修改密码</a>
                                     <a  href="/index/home/logout.html" class="logout_btn">注销登录</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <a href="/" class="brand" style="color: red">
                <i class="fa fa-cloud"></i><span class="brand-name"><?=$site_name?></span>
            </a>
        </div>
        <div class="nav-container">
            <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav-notification"></ul>
            <div class="pull-right m-right-sm">
                <div class="user-block hidden-xs">
                    <a class="lucky_btn">
                        <img src="/images/lucky.jpg" alt="" class="img-circle inline-block user-profile-pic">
                    </a>
                </div>
                <div class="user-block hidden-xs">
                    <a href="#" id="userToggle" data-toggle="dropdown">
                        <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100" alt="" class="img-circle inline-block user-profile-pic">
                        <div class="user-detail inline-block">
                            <?=$member_qq?>                            <i class="fa fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="panel border dropdown-menu user-panel">
                        <div class="panel-body paddingTB-sm">
                            <ul>
                                <li>
                                    <a href="/index/home/password/id/<?=$_GET['id']?>.html">
                                        <i class="fa fa-edit fa-lg"></i><span class="m-left-xs">修改密码</span>
                                    </a>
                                </li>
                                                                <li>
                                    <a  onclick="return confirm('您确定要注销登录?');"    href="/index/home/logout.html" class="logout">
                                        <i class="fa fa-power-off fa-lg"></i><span class="m-left-xs">注销登录</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <ul class="nav-notification">
                    <li>
    <a href="#" data-toggle="dropdown" class="load_message"><i class="fa fa-envelope fa-lg"></i></a>
    <span class="badge badge-danger bounceIn animation-delay1 active">1</span>
    <ul class="dropdown-menu message pull-right messageList">
        <li><a>仅保留最新5条消息</a></li>
        <li class="messageLoad" style="padding: 10px;text-align: center;"><img src="/images/ajax-loader-6.gif" title="加载中"></li>
    </ul>
</li>

                </ul>

            </div>
        </div>
    </div><!-- ./top-nav-inner -->
</header>	