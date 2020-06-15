@guest
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title> - @yield('ttype')</title>
        <meta name="description" content="网站介绍">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}" type="image/vnd.microsoft.icon">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        @yield('styles')
    </head>
    <body>
        @yield('content')
    <script type="text/javascript">
        document.domain = 'edlm.cn';
    </script>
    </body>
</html>
@else
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Hello </title>
        <meta name="description" content="Hello,E客!欢迎回到 5G云资源网 www.yunziyuan.com.cn">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="apple-mobile-web-app-title" content="Edlm-Md"/>
        <meta name="renderer" content="webkit">
        <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}" type="image/vnd.microsoft.icon">
        <script src="//cdn.bootcss.com/echarts/3.3.2/echarts.min.js"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/amazeui.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/amazeui.datatables.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
        <script src="//libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    </head>
    <body data-type="index">
        <script src="{{ URL::asset('assets/js/theme.js') }}"></script>
        <div class="am-g tpl-g">
            <!-- 头部 -->
            <header>
                <!-- logo -->
                <div class="am-fl tpl-header-logo">
                    <a style="font-size: 25px;" href="javascript:;">Hello ！</a>
                </div>
                <!-- 右侧内容 -->
                <div class="tpl-header-fluid">
                    <!-- 侧边切换 -->
                    <div class="am-fl tpl-header-switch-button am-icon-list">
                        <span>
                    </span>
                    </div>
                    <!-- 搜索 -->
                    <div class="am-fl tpl-header-search">
                        <form class="tpl-header-search-form" action="javascript:;">
                            <button class="tpl-header-search-btn am-icon-search"></button>
                            <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                        </form>
                    </div>
                    <!-- 其它功能-->
                    <div class="am-fr tpl-header-navbar">
                        <ul>
                            <!-- 欢迎语 -->
                            <li class="am-text-sm tpl-header-navbar-welcome">
                                <a href="javascript:;">欢迎你, <span>{{ Auth::user()->name }}</span> </a>
                            </li>
                            <!-- 退出 -->
                            <li class="am-text-sm">
                                <a href="{{ route('logout') }}" onClick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <span class="am-icon-sign-out"></span> 退出
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <!-- 风格切换 -->
            <div class="tpl-skiner">
                <div class="tpl-skiner-toggle am-icon-cog">
                </div>
                <div class="tpl-skiner-content">
                    <div class="tpl-skiner-content-title">
                        选择主题
                    </div>
                    <div class="tpl-skiner-content-bar">
                        <span class="skiner-color skiner-white" data-color="theme-white"></span>
                        <span class="skiner-color skiner-black" data-color="theme-black"></span>
                    </div>
                </div>
            </div>
            <!-- 侧边导航栏 -->
            <div class="left-sidebar">
                <!-- 用户信息 --><center>
                <div class="tpl-sidebar-user-panel">
                    <div class="tpl-user-panel-slide-toggleable">
                        <div class="tpl-user-panel-profile-picture">
                            <img src="http://cdn.edlm.cn/images/eke.png" alt="">
                        </div>
                        <span class="user-panel-logged-in-text">
                            <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
                          {{ Auth::user()->name }}
                        </span>
                        <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                    </div>
                </div>
                </center>
                <!-- 菜单 -->
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-link">
                        <a href="{{ url('/') }}" {!! isset($home) ? "class='active'" : '' !!}>
                            <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="javascript:;" class="sidebar-nav-sub-title {!! isset($api) ? "active" : '' !!}">
                            <i class="am-icon-skyatlas sidebar-nav-link-logo"></i> API 服务
                            <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                        </a>
                        <ul class="sidebar-nav sidebar-nav-sub" {!! isset($api) ? "style='display: block;'" : '' !!}>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/api') }}" {!! isset($lpapi) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> Pays
                                </a>
                            </li>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/lps') }}" {!! isset($lpapis) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> Pays 财务/订单管理
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->type>=1)
                    <li class="sidebar-nav-link">
                        <a href="{{ url('/lpads') }}" {!! isset($lpads) ? "class='sub-active'" : '' !!}>
                            <i class="am-icon-spinner am-icon-spin"></i> 管理员后台
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- 内容区域 -->
            <div id="tpl-echarts">
            </div>
            @yield('content')
        </div>
        <script src="//cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js"></script>
        <script src="{{ URL::asset('assets/js/amazeui.datatables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    </body>
</html>
@endguest