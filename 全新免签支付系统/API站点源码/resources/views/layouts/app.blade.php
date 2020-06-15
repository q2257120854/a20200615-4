<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>API文档 - EDLM</title>
        <meta name="description" content="Hello,E客!欢迎来访由EDLM提供的在线文档，希望你要的这里都有!">
        <meta name="keywords" content="EDLM,E帝联盟,亿帝联盟,L Pays,API,DOCs,在线文档" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="apple-mobile-web-app-title" content="Edlm-Md"/>
        <meta name="renderer" content="webkit">
        <link rel="shortcut icon" href="logo图片地址" type="image/vnd.microsoft.icon">
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
                    <a style="font-size: 25px;" href="javascript:;">Edlm Docs</a>
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
                </div>
            </header>
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
                <!-- 菜单 -->
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-link">
                        <a href="{{ url('/doc') }}" {!! isset($index) ? "class='active'" : '' !!}>简介</a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="javascript:;" class="sidebar-nav-sub-title {!! isset($api) ? "active" : '' !!}">L Pays API 文档
                            <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                        </a>
                        <ul class="sidebar-nav sidebar-nav-sub" {!! isset($lpapi) ? "style='display: block;'" : '' !!}>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/doc/s') }}" {!! isset($lps) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 开始
                                </a>
                            </li>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/doc/new') }}" {!! isset($lpn) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 创建订单
                                </a>
                            </li>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/doc/on') }}" {!! isset($lpo) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查询订单
                                </a>
                            </li>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/doc/ok') }}" {!! isset($lpok) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 完成支付
                                </a>
                            </li>
                            <li class="sidebar-nav-link">
                                <a href="{{ url('/doc/go') }}" {!! isset($lpg) ? "class='sub-active'" : '' !!}>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 快速对接
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- 内容区域 -->
            <div id="tpl-echarts">
            </div>
            <div class="tpl-content-wrapper">
                <div class="row-content am-cf">
            @yield('content')
                </div>
            </div>
        </div>
        <script src="//cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js"></script>
        <script src="{{ URL::asset('assets/js/amazeui.datatables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    </body>
</html>