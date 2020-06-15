<?php
/*
陌屿<2763994904@qq.com>
陌屿代码加密系统
QQ群：42103442
*/
include("./includes/common.php");
$count3=$DB->count("SELECT count(*) from moyu_daili WHERE 1");
?>
<!DOCTYPE html>
<html lang='zh'>
<head>
    <meta class="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $conf["title"] ?> - 对代码进行安全保护</title>
    <meta name="keywords" content="<?php echo $conf["title"] ?>,代码保护专家,高效快捷保护你的代码安全。"/>
    <meta name="description" content="<?php echo $conf["title"] ?>,虚拟主机,服务器都可以安全运行。！"/>
    <link rel='stylesheet' href='/static/css/style.min.css'/>
    <link rel="icon" href="../img/favicon.ico">
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar navbar-extended">
    <nav class="nav__mobile"></nav>
    <div class="container">
        <div class="navbar__inner">
            <a href="/index.php" class="navbar__logo"><?php echo $conf["title"] ?></a>
            <nav class="navbar__menu">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="/User/">登录</a></li>
                    <li><a href="/User/reg.php">注册</a></li>
                </ul>
            </nav>
            <div class="navbar__menu-mob"><a href="" id='toggle'>
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                              d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"
                              class=""></path>
                    </svg>
                </a></div>
        </div>
    </div>
</div>
<div class="hero">
    <div class="hero__overlay hero__overlay--gradient"></div>
    <div class="hero__mask"></div>
    <div class="hero__inner">
        <div class="container">
            <div class="hero__content">
                <div class="hero__content__inner" id='navConverter'>
                    <h1 class="hero__title"><?php echo $conf["title"] ?></h1>
                    <p class="hero__text"><center>快捷，安全，高效，的保护你的代码，目前已有<?php echo $count3?>个用户选择了我们</center></p>

                    <?php if($user!=""){?>
                        <a href="/User/" class="button button__accent">立即进入</a>
                    <?php }else{?>
                        <a href="/User/" class="button button__accent">登录</a>
                        <a href="/User/reg.php" class="button hero__button">注册</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hero__sub">
		<span id="scrollToNext" class="scroll">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class='hero__sub__down'
                 fill="currentColor" width="512px" height="512px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M256,298.3L256,298.3L256,298.3l174.2-167.2c4.3-4.2,11.4-4.1,15.8,0.2l30.6,29.9c4.4,4.3,4.5,11.3,0.2,15.5L264.1,380.9c-2.2,2.2-5.2,3.2-8.1,3c-3,0.1-5.9-0.9-8.1-3L35.2,176.7c-4.3-4.2-4.2-11.2,0.2-15.5L66,131.3c4.4-4.3,11.5-4.4,15.8-0.2L256,298.3z"/></svg>
		</span>
</div>
<div class="steps landing__section">
    <div class="container">
        <h2>为什么选择我们？</h2>
        <p>Why did you choose us?</p>
    </div>
    <div class="container">
        <div class="steps__inner">
            <div class="step">
                <div class="step__media">
                    <img src="/static/images/undraw_designer.svg" class="step__image">
                </div>
                <h4>快速高效</h4>
                <p class="step__text">威盾加密，在线双层加密，更有效的保护你的代码安全。</p>
            </div>
            <div class="step">
                <div class="step__media">
                    <img src="/static/images/undraw_responsive.svg" class="step__image">
                </div>
                <h4>稳定持久</h4>
                <p class="step__text">MZPHP加密超难反编译，值得您的信赖</p>
            </div>
            <div class="step">
                <div class="step__media">
                    <img src="/static/images/undraw_creation.svg" class="step__image">
                </div>
                <h4>快速高效</h4>
                <p class="step__text">混淆加密超级兼容，很多用户选择。</p>
            </div>
        </div>
    </div>
</div>
<div class="expanded landing__section">
    <div class="container">
        <div class="expanded__inner">
            <div class="expanded__media">
                <img src="/static/images/undraw_browser.svg" class="expanded__image">
            </div>
            <div class="expanded__content">
                <h2 class="expanded__title">超多加密方式</h2>
                <p class="expanded__text">业内最优质的加密系统，全力保障业务流畅，让加密更加简单方便.</p>
            </div>
        </div>
    </div>
</div>
<div class="expanded landing__section">
    <div class="container">
        <div class="expanded__inner">
            <div class="expanded__media">
                <img src="/static/images/undraw_frameworks.svg" class="expanded__image">
            </div>
            <div class="expanded__content">
                <h2 class="expanded__title">定制化加密解决方案</h2>
                <p class="expanded__text">支持不同业务场景的交易方式，免费在线一对一分析加密场景、梳理企业收款需求，提出接入建议、定制加密解决方案.</p>
            </div>
        </div>
    </div>
</div>
<div class="expanded landing__section">
    <div class="container">
        <div class="expanded__inner">
            <div class="expanded__media">
                <img src="/static/images/together.svg" class="expanded__image">
            </div>
            <div class="expanded__content">
                <h2 class="expanded__title">专业的全流程服务</h2>
                <p class="expanded__text">
                    支持个性化定制和私有化部署，全程跟进定制化业务需求，可部署企业本地服务器，数据安全可控，客户成功团队从接口联调、测试上线到后期系统运维、管理平台，使用等各方向全面提供 7*10 小时服务。</p>
            </div>
        </div>
    </div>
</div>
<div class="cta cta--reverse">
    <div class="container">
        <div class="cta__inner">
            <h2 class="cta__title">立即开启新时代</h2>
            <p class="cta__sub cta__sub--center"><?php echo $conf["title"] ?>，加密技术服务商，让加密简单、专业、快捷！</p>
            <a href="/User/" class="button button__accent">立即开启</a>
        </div>
    </div>
</div>
<div class="footer footer--dark">
    <font class="container">
        <center>
            <small>
                <font color="white"><center><?php echo $conf["title"] ?> - 对您的代码进行贴心保护</center></font><br/>
                <font color="white">Copyright © 2019 <?php echo $conf["title"] ?> 版权所有</font>
            </small>
        </center>
    </font>
</div>
<script src='/static/js/app.min.js'></script>
<script type="text/javascript">
layer.open({
  type: 1
  ,title: '系统公告'
  ,closeBtn: false
  ,area: '290px;'
  ,shade: 0.5
  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
  ,resize: false
  ,btn: ['注册', '确定']
  ,btnAlign: 'c'
  ,moveType: 0 //拖拽模式，0或者1
  ,content: '<div style="padding: 40px; line-height: 20px; background-color: #393D49; color: #fff; font-weight: 150;"><b><?php echo $conf['GongGao']?></b></div>'
  ,success: function(layero){
    var btn = layero.find('.layui-layer-btn');
    btn.find('.layui-layer-btn0').attr({
      href: '/User/reg.php'
      ,target: '_blank'
    });
  }
});
</script>
</body>
</html>
