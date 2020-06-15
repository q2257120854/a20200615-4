<?php /* Smarty version 2.6.25, created on 2019-04-15 19:00:55
         compiled from index/taluo/anlian/find.tpl */ ?>
﻿<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>你暗恋的人喜欢你吗？</title>
    
    <script src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/common/js/rem_tool.js"></script>

    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/css/common-v=1.0.css">
    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/css/result.css?v=1.1">
</head>
<body>

<section class="page">
    <section class="main-wrap flex-column">
        <div class="banner-wrap flex-center">
            <img class="banner" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/banner.png?v=1.0">
        </div>

        <div class="content-wrap flex-column">
            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_top.png?v=1.0">
                <div class="content-panel">
                    <div class="content flex-column">
                        <div class="top-wrap flex-column">
                            <div class="guide-wrap flex-column">
                                <div class="guide flex-column">
                                    <p class="guide-text first-line" id="first_line">亲爱的<em>测试者</em>：</p>
                                    <p class="guide-text" id="second_line">
                                        你抽到的每张塔罗牌，都有着神圣且独特的意义！接下来，我将透过你所选择的<em>4张牌</em>，揭示你和暗恋的人最终能否牵手...
                                    </p>
                                </div>
                            </div>
                            <div class="card-group flex-column">
                                <img class="card-wall"
                                     src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/card_wall.png?v=1.0">
                                <div class="tarot-card tarot-card-1 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['0']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-2 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['1']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-3 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['2']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-4 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['3']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div>                              </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_bot.png?v=1.0">
            </div>

            <div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_top.png?v=1.0">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/nav_01.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/num_01.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['title']; ?>
                                        <em style="font-size: 14px;">
                                                                                        (<?php if ($this->_tpl_vars['data']['data']['carinfo']['0']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                    </em>
                                    </span>
                                </div>
                                <div class="explain-box flex-column">
                                    <p class="explain-title">
                                        对方想法:                                                                                                                                                            </p>
                                    <p class="explain-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_bot.png?v=1.0">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_top.png?v=1.0">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/nav_02.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/num_02.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['title']; ?>
                                        <em style="font-size: 14px;">
                                                                                        (<?php if ($this->_tpl_vars['data']['data']['carinfo']['1']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                    </em>
                                    </span>
                                </div>
                                <div class="explain-box flex-column">
                                    <p class="explain-title">
                                                                                当前阻碍:                                                                                                                    </p>
                                    <p class="explain-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_bot.png?v=1.0">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_top.png?v=1.0">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/nav_03.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/num_03.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['title']; ?>
                                        <em style="font-size: 14px;">
                                                                                        (<?php if ($this->_tpl_vars['data']['data']['carinfo']['2']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                    </em>
                                    </span>
                                </div>
                                <div class="explain-box flex-column">
                                    <p class="explain-title">
                                                                                                                        暗恋结果:                                                                            </p>
                                    <p class="explain-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_bot.png?v=1.0">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_top.png?v=1.0">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/nav_04.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/result/num_04.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['title']; ?>
                                        <em style="font-size: 14px;">
                                            (<?php if ($this->_tpl_vars['data']['data']['carinfo']['3']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                                                                </em>
                                    </span>
                                </div>
                                <div class="explain-box flex-column">
                                    <p class="explain-title">
                                                                                                                                                                塔罗指引:                                    </p>
                                    <p class="explain-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/secretpro/image/common/border_bot.png?v=1.0">
                </div>        </div>

        

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./index/taluo/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    </section>
</section>

    <script type="text/javascript" src="/ffsm/statics/taluo/divine.cdn.h55u.com/platform/js/zwSdk.js?v=19041319"></script>


</body>
</html>