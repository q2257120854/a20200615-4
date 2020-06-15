<?php /* Smarty version 2.6.25, created on 2019-04-16 12:43:21
         compiled from index/taluo/jixu/find.tpl */ ?>
﻿<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>你和TA该继续吗？</title>
    <script src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/common/js/rem_tool.js"></script>

    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/css/common-v=1.4.css">
    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/css/result.css?v=1.8">
</head>
<body>

<section class="page">
    <section class="main-wrap flex-column">
        <div class="banner-wrap flex-center">
            <img class="banner" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/banner.png?v=1.0">
        </div>

        <div class="content-wrap flex-column">
            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img class="main-title" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/main_title.png?v=1.0">
                        <div class="top-wrap flex-column">
                            <div class="guide-wrap flex-column">
                                <div class="guide flex-column">
                                    <p class="guide-text first-line" id="first_line">亲爱的<em>测试者</em>：</p>
                                    <p class="guide-text" id="second_line">
                                        曾经亲密的人，心中还有你吗？你到底该放手还是该坚持？关于你们该不该继续，我将根据你所选择的4张牌，给予进一步指引...
                                    </p>
                                </div>
                            </div>
                            <div class="card-group flex-column">
                                <img class="card-wall"
                                     src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/card_wall2.png?v=1.0">
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
                                    </div>                            </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/nav_01.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/num_01.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['title']; ?>
                                        <em style="font-size: 14px;">
                                            (<?php if ($this->_tpl_vars['data']['data']['carinfo']['0']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                                                                </em>
                                    </span>
                                </div>
                                <div class="explan-box flex-column">
                                    <p class="explan-title">象征意义:</p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['des']; ?>
</p>
                                    <!--<p class="explan-title">牌面解释:</p>-->
                                    <!--<p class="explan-text">愚人是开悟前的智者，画面上是一位乐观的旅行者，他站在悬崖的边缘，似乎再往前一步就是危险，可是他却不以为意，他背对着阳光，象征他不顾威权，背后的行囊象征由经验所习得的智慧。他脚边吠叫的狗代表过去，那个要将他拉回去，不让他经历在当下的力量，手上的白玫瑰代表他充满天真和信任，相信生命是支持他的。愚人象征的是，在世界开始前，无始无终的永恒状态，充满着未知和生命力，愚人代表“可能性”。</p>-->
                                    <p class="explan-title">
                                        对方想法:                                                                                                                                                            </p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/nav_02.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/num_02.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['title']; ?>
                                        <em style="font-size: 14px;">
                                            (<?php if ($this->_tpl_vars['data']['data']['carinfo']['1']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                                                                </em>
                                    </span>
                                </div>
                                <div class="explan-box flex-column">
                                    <p class="explan-title">象征意义:</p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['des']; ?>
</p>
                                    <!--<p class="explan-title">牌面解释:</p>-->
                                    <!--<p class="explan-text">愚人是开悟前的智者，画面上是一位乐观的旅行者，他站在悬崖的边缘，似乎再往前一步就是危险，可是他却不以为意，他背对着阳光，象征他不顾威权，背后的行囊象征由经验所习得的智慧。他脚边吠叫的狗代表过去，那个要将他拉回去，不让他经历在当下的力量，手上的白玫瑰代表他充满天真和信任，相信生命是支持他的。愚人象征的是，在世界开始前，无始无终的永恒状态，充满着未知和生命力，愚人代表“可能性”。</p>-->
                                    <p class="explan-title">
                                                                                双方姻缘:                                                                                                                    </p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/nav_03.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/num_03.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['title']; ?>
                                        <em style="font-size: 14px;">
                                            (<?php if ($this->_tpl_vars['data']['data']['carinfo']['2']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                                                                </em>
                                    </span>
                                </div>
                                <div class="explan-box flex-column">
                                    <p class="explan-title">象征意义:</p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['des']; ?>
</p>
                                    <!--<p class="explan-title">牌面解释:</p>-->
                                    <!--<p class="explan-text">愚人是开悟前的智者，画面上是一位乐观的旅行者，他站在悬崖的边缘，似乎再往前一步就是危险，可是他却不以为意，他背对着阳光，象征他不顾威权，背后的行囊象征由经验所习得的智慧。他脚边吠叫的狗代表过去，那个要将他拉回去，不让他经历在当下的力量，手上的白玫瑰代表他充满天真和信任，相信生命是支持他的。愚人象征的是，在世界开始前，无始无终的永恒状态，充满着未知和生命力，愚人代表“可能性”。</p>-->
                                    <p class="explan-title">
                                                                                                                        感情阻碍:                                                                            </p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
                </div><div class="content-box flex-column">
                    <img class="border border-top"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                    <div class="content-panel">
                        <div class="content flex-column">
                            <img class="desc-subtitle"
                                 src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/nav_04.png?v=1.0">
                            <div class="tarot-box flex-column">
                                <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['img']; ?>
">
                                <div class="card-intro flex-center">
                                    <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/result/num_04.png">
                                    <span>
                                        <?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['title']; ?>
                                        <em style="font-size: 14px;">
                                            (<?php if ($this->_tpl_vars['data']['data']['carinfo']['3']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)                                                                                                                                </em>
                                    </span>
                                </div>
                                <div class="explan-box flex-column">
                                    <p class="explan-title">象征意义:</p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['des']; ?>
</p>
                                    <!--<p class="explan-title">牌面解释:</p>-->
                                    <!--<p class="explan-text">愚人是开悟前的智者，画面上是一位乐观的旅行者，他站在悬崖的边缘，似乎再往前一步就是危险，可是他却不以为意，他背对着阳光，象征他不顾威权，背后的行囊象征由经验所习得的智慧。他脚边吠叫的狗代表过去，那个要将他拉回去，不让他经历在当下的力量，手上的白玫瑰代表他充满天真和信任，相信生命是支持他的。愚人象征的是，在世界开始前，无始无终的永恒状态，充满着未知和生命力，愚人代表“可能性”。</p>-->
                                    <p class="explan-title">
                                                                                                                                                                塔罗指引:                                    </p>
                                    <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['content']; ?>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="border border-bot"
                         src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
                </div>
            

        </div>

        

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./index/taluo/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    </section>

    <div class="toast-wrap flex-center">
        <div class="toast-box flex-center">
            <span style="font-size: 14px;"></span>
        </div>
    </div>
</section>


<script type="text/javascript" src="/ffsm/statics/taluo/divine.cdn.h55u.com/platform/js/zwSdk.js?v=19041319"></script>

</body>
</html>