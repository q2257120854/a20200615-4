<?php /* Smarty version 2.6.25, created on 2019-04-16 15:28:32
         compiled from index/zhanxing/find.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index/zhanxing/find.tpl', 183, false),)), $this); ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta charset="UTF-8">

    <title>本命星盘解析</title>

    <style>

        *{

            margin: 0;

            padding: 0;

            border: none;

            box-sizing: border-box;

            color: white;

            -webkit-tap-highlight-color: transparent;

        }

        html, body{

            width: 100%;

            height: 100%;

            max-width: 640px;

            margin: 0 auto;

            background-color: #0e003d;

            font-family: 'PingFang SC', 'Lantinghei SC', 'Helvetica Neue', 'Helvetica', 'Arial', 'Microsoft YaHei', '微软雅黑', 'STHeitiSC-Light', 'simsun', '宋体', 'WenQuanYi Zen Hei', 'WenQuanYi Micro Hei', 'sans-serif';

        }

    </style>

    <script type="text/javascript">

        (function(doc, win) {

            var docEl = doc.documentElement,

                    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',

                    recalc = function() {

                        var clientWidth = docEl.clientWidth > 640 ? 640: docEl.clientWidth;

                        if (!clientWidth) return;

                        docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';

                    };

            if (!doc.addEventListener) return;

            win.addEventListener(resizeEvt, recalc, false);

            doc.addEventListener('DOMContentLoaded', recalc, false);

            recalc();

        })(document, window);

    </script>

    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/css/result.css?v=1.1">

    <style>

        .title_box {

            margin-bottom: 28px;

        }

        img#horoscope {

            width: 75%;

            margin: 22px auto 0 auto;

        }

        img.newtitle {

            display: block;

            position: absolute;

            width: 50%;

            left: 25%;

            top: 0;

            transform: translateY(-50%);

            -webkit-transform: translateY(-50%);

        }

        .hasnewtitle {

            padding-top: 1rem;

            margin-top: 28px;

        }
		
		.paddingbox p{
			    position: relative;
				text-align: justify;
				font-size: 16px;
				line-height: 1.18rem;
				color: white;
				margin-bottom: 12px;
		}

        .sun_star_content, .moon_text, .up_star_text,.paddingbox p{

            color: #d3d2da;

            /*text-indent: 1.5em;*/

        }

        .moon_text, .up_star_text, .sun_star_content,.paddingbox p {

             margin-bottom: 10px;

        }

    </style>

</head>

<body>

    <div class="mainbox">

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/title.png" class="title_img">

        <div class="title_box">

                        <p class="maindesc"><span>太阳<?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
丨月亮<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
丨上升<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
</span></p>

            <img src="<?php echo $this->_tpl_vars['data']['img']; ?>
" id="horoscope">

        </div>



        <div class="contentbox">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle1.png" class="newtitle">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-top.png" class="content_border" style="position: absolute;width: calc(100% - 0.36rem - 0.36rem);display: block;margin: 0 auto;">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/star-<?php echo $this->_tpl_vars['data']['taiyang']['number']; ?>
.png" class="sun_star_img">

            <p class="sun_star_title">太阳星座-<?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
座</p>

            <p class="sun_star_desc"><?php echo $this->_tpl_vars['data']['taiyang']['title']; ?>
</p>

            <div class="paddingbox">

                <p class="sun_star_content">阳历生日<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['data']['birthdays'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m月%d日') : smarty_modifier_date_format($_tmp, '%m月%d日')); ?>
的你太阳星座是<?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
座，太阳星座对应你的“外在基础性格”，大约占你完整性格的三分之一。</p>

                <?php echo $this->_tpl_vars['data']['taiyang']['content']; ?>


                <!--<p class="sun_star_fixed_content">太阳星座代表了你此生想要变成的状态，追求的目标，以及需要迎接的挑战，是你人生性格的基础。</p>-->

            </div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-bottom.png" class="content_border">

        </div>



        <div class="contentbox">

            <div class="border_bg"></div>

            <div class="element_box">

                <div class="element_item">

                    <p class="element_item_title">星座属性</p>

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/<?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['icon']; ?>
.png" class="element_item_icon">

                    <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['title']; ?>
</p>

                </div>

                <div class="element_item">

                    <div class="element_splitline"></div>

                    <p class="element_item_title">星座模式</p>

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/<?php echo $this->_tpl_vars['data']['taiyang']['moshi']['icon']; ?>
.png" class="element_item_icon">

                    <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['moshi']['title']; ?>
</p>

                    <div class="element_splitline"></div>

                </div>

                <div class="element_item">

                    <p class="element_item_title">守护星</p>

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ruled-<?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['icon']; ?>
.png" class="element_item_icon">

                    <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['title']; ?>
</p>

                </div>

            </div>

            <div class="paddingbox">

                <p class="element_title">星座属性：<?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['title']; ?>
</p>

                <p class="element_desc"><?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
是三大<?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['title']; ?>
星座之一，<?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['content']; ?>
</p>



                <p class="element_title">星座模式：<?php echo $this->_tpl_vars['data']['taiyang']['moshi']['title']; ?>
</p>

                <p class="element_desc"><?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
的模式为<?php echo $this->_tpl_vars['data']['taiyang']['moshi']['title']; ?>
，<?php echo $this->_tpl_vars['data']['taiyang']['moshi']['content']; ?>
</p>



                <p class="element_title">守护星：<?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['title']; ?>
</p>

                <p class="element_desc"><?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
的守护星是<?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['title']; ?>
，<?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['content']; ?>
</p>

            </div>

        </div>



        <div class="contentbox hasnewtitle">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle2.png" class="newtitle">

            <div class="moon_star_header_box">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ruled-1.png" class="moon_star_img">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/icon-<?php echo $this->_tpl_vars['data']['yueliang']['number']; ?>
.png" class="moon_cons_img">

                <p class="moon_star_text">月亮星座-<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
座</p>

                <span class="moon_star_flag"><?php echo $this->_tpl_vars['data']['yueliang']['title']; ?>
</span>

            </div>

            <p class="moon_text">从星盘上看当你出生时，决定你潜意识情绪的本命月亮落在<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
星域的<span id="moondeg"></span>，因此你的月亮星座是<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
座。</p>

            <?php echo $this->_tpl_vars['data']['yueliang']['content']; ?>


            <!--<p class="moon_desc">月亮星座是出生时月亮的位置，表达了我们内心的本能和需求，描绘出情绪的变化，以及投射出你对“家”的幻想。</p>-->

        </div>



        <div class="contentbox hasnewtitle">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle3.png" class="newtitle">

            <div class="moon_star_header_box">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/Asc.png" class="moon_star_img">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/icon-10.png" class="moon_cons_img">

                <p class="moon_star_text">上升星座-<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
座</p>

                <span class="up_star_flag"><?php echo $this->_tpl_vars['data']['shangsheng']['title']; ?>
</span>

            </div>

            <p class="up_star_text">你出生的那一刻，地平线指向浩瀚星空中<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
星域的<span id="updeg"></span>，这一星象决定了你的上升星座为<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
座，在占星学中我们称上升星座为“人格面具”，代表了别人眼中的你是什么样子。</p>

            <?php echo $this->_tpl_vars['data']['shangsheng']['content']; ?>


            <!--<p class="up_star_desc">上升星座是出生时地平线所在的星座，人称“人格的面具”，是面对外界时的自我。</p>-->

        </div>



       <!-- <div class="contentbox">

            <div class="border_bg"></div>

            &lt;!&ndash; 命主星&ndash;&gt;

            <div class="Lagnadhipati_box">

                <div class="lagnadhipati_item">

                    <div class="lagnadhipati_img_box">

                        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/bigstar-7.png" class="lagnadhipati_bigstar_img">

                    </div>

                    <p class="lagnadhipati_name">命主星-天王星</p>

                    <p class="lagnadhipati_desc lagnadhipati_desc_first">你要掌握自己的人生，对生活的不满并不会挫败你，反倒会让你越挫越勇，达成逆转和突破。</p>

                </div>

                <div class="lagnadhipati_item">

                    <div class="lagnadhipati_split_line"></div>

                    <div class="lagnadhipati_img_box">

                        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/bigstar-7.png" class="lagnadhipati_smallstar_img">

                        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/arrow.png" class="lagnadhipati_smallstar_arrow">

                        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/big-10.png" class="lagnadhipati_smallstar_number">

                    </div>

                    <p class="lagnadhipati_name">命主星在第10宫</p>

                    <p class="lagnadhipati_desc lagnadhipati_desc_last">被社会承认或是获得社会地位是你内心的强烈需求，并不一定一步登天，你也可以以工作、社会服务等方式来传达你的意识形态。</p>

                </div>

            </div>

            <p class="up_star_desc">命主星是你上升星座的守护星，它的性质和位置代表了你面对外界时，你的天赋和面对的困难。</p>

        </div>-->



        <div class="contentbox hasnewtitle">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle4.png" class="newtitle">

            <!-- 象限分析-->

            <!--<p class="region_title">星盘象限分析</p>-->

            <div class="region_box">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/quadrant-<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxiannumber']; ?>
.png" class="region_bg">

            <div class="region_item region_item1">

                <div class="normal_region_box">
                
                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                
                

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-0.png" class="region_icon_items region_normalicon_1">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-1.png" class="region_icon_items region_normalicon_2">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-2.png" class="region_icon_items region_normalicon_3">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-6.png" class="region_icon_items region_normalicon_4">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-7.png" class="region_icon_items region_normalicon_5">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-8.png" class="region_icon_items region_normalicon_6"> -->
                </div>

            </div>

            <div class="region_item region_item2">

                <div class="normal_region_box">

                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                 
               </div>

            </div>

            <div class="region_item region_item3">

                <div class="normal_region_box">
                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                </div>

            </div>

            <div class="region_item region_item4">

                <div class="normal_region_box">

                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>  
                    
                </div>

            </div>

        </div>

            <p class="region_desc">能量最强在第<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxiannumber']; ?>
象限</p>

            <p class="region_main_title">星盘象限分析：<span><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['info']['title']; ?>
</span></p>

            <p class="up_star_text">每个人的性格成因都有迹可循，通过十大天体在星盘四象限中的分布情况，可以得出那些对你生活影响较大的性格是如何形成的。</p>
            <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['info']['content']; ?>


        </div>



        <div class="contentbox hasnewtitle">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle5.png" class="newtitle">

            <!-- 你的元素-->

            <p class="element_title">你的元素构成</p>

            <div class="element_title_box">

                <div class="element_title_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-fire.png" class="element_title_icon">

                    <span class="element_title_text">火</span>

                </div>

                <div class="element_title_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-soil.png" class="element_title_icon">

                    <span class="element_title_text">土</span>

                </div>

                <div class="element_title_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-wind.png" class="element_title_icon">

                    <span class="element_title_text">风</span>

                </div>

                <div class="element_title_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-water.png" class="element_title_icon">

                    <span class="element_title_text">水</span>

                </div>

            </div>

            <div class="element_histogram_box">

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['count']; ?>
%</span>

                    <div class="histogram histogram_1" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">

                    <?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['huo']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['huo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?>  
                            </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['count']; ?>
%</span>

                    <div class="histogram histogram_2" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
					<?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['tu']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['tu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 
                </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['count']; ?>
%</span>

                    <div class="histogram histogram_3" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
                
                <?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['feng']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['feng']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 

                                    </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['count']; ?>
%</span>

                    <div class="histogram histogram_4" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
						<?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['shui']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['shui']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 
                </div>

            </div>

            <div class="spliteline spliteline_1"></div>

            <div class="spliteline spliteline_2"></div>

            <div class="spliteline spliteline_3"></div>

        </div>

            <p class="histogram_main_title">你的元素属性为</p>

            <div class="histogram_main_result">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/earth.png" class="histogram_main_icon">

                <span class="histogram_main_span"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['max']; ?>
象</span>

            </div>

            <p class="up_star_text">占星学中有四种主要元素，分别是火，水，土，风，这四种元素有其特定的意义，古典占星术认为，如果一件事或一个人散发出热，活力以及强烈的独立个性，这些所对应的就是火元素特征，同理，如果一件事或一个人散发出固执，持久以及稳定的享受作风，那么就认为这些对应土元素的特质。</p><p class='up_star_text'>现代占星学提供了一条更为科学的解读理念，其来源于理论物理学，与古希腊的元素解读理念一一对应，这便是物质的四种状态，固态（土），液态（水），气态（风）和高能态（火）。</p>
            <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['maxcontent']; ?>

            
            



        </div>



        <div class="contentbox hasnewtitle">

            <div class="border_bg"></div>

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle6.png" class="newtitle">

            <!-- 行星能量-->

            <p class="planets_title">行星能量分析</p>

            <div class="planets_percentage_box">

            <div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-0.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                        <span class="planets_percentage_progress planets_percentage_progress_max" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['taiyang']['rem']; ?>
%;"></span>

                            

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-1.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['yueliang']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-2.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['shuixing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-3.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['jinxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-4.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['huoxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-5.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['muxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-6.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['tuxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-7.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['tianwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-8.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['haiwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-9.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['mingwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div>        </div>

            <p class="planets_desc">你的<?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['xz']; ?>
能量最强</p>

            <p class="planets_main_name">你是：<span><?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['xz']; ?>
</span></p>

            <p class="up_star_text">占星学中的十大天体会对我们产生各个方面的影响，每个天体的能量强弱，最终都会影响到我们的性格，在古代这些影响只有强弱之分，没有具体数值，而得益于现代天文学的蓬勃发展，我们可以得到精确到秒的天体运行轨迹，根据这些轨迹我们可以详细计算出每个天体的运行数据，然后再将这些数据通过现代占星学方式量化，抽象成文字解读。</p>

            <p class="up_star_text">你于<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['data']['birthdays'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y年%m月%d日') : smarty_modifier_date_format($_tmp, '%Y年%m月%d日')); ?>
出生于<?php echo $this->_tpl_vars['row']['data']['city']; ?>
，在这一刻，十大天体中对你产生最大影响的是<?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['xz']; ?>
。</p>

            <?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['content']; ?>




        </div>



        <!--<div class="contentbox comment_box"  >

            <div class="border_bg"></div>

           

            <div class="comment_box">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle7.png" class="comment_title">

                <div class="nickname_wrap">

                    <div class="input_group">

                        <label for="nickname">昵称:</label>

                        <input maxlength="6" class="nickname" name="nickname" id="nickname" value="" onblur="scrollToBottom()" type="text">

                    </div>

                    <span class="un_name_wrap">

                        <input type="checkbox" id="un_name" class="un_name">

                        匿名评价

                    </span>

                </div>

                <div class="satisfied_wrap">

                    <span class="pinfen">评分:</span>

                    <div id="star"></div>

                    <span class="emoji-wrap">

                        <img class="emoji" id="emoji" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/satisfieds.png">

                        <span class="emoji_desc" id="emoji_desc">非常满意</span>

                    </span>

                </div>

                <div class="edit_wrap">

                    <textarea placeholder="请在下方留下您真实的评价和建议，我们将在您的督促下不断提升服务品质。" onblur="scrollToBottom()" rows="5" id="comment_content"></textarea>

                </div>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/submit.png" class="submit_img" id="submit_img">

            </div>

        </div>-->
        
        <div class="contentbox comment_box public_hot_test">
        <div class="border_bg"></div>
	<div class="public_ht_title">
		热门测算
	</div>
<ul class="public_ht_ul">
		<li><a href="/?ac=bzjp"><img src="/ffsm/statics/tu/mip/bazi.png" alt="八字精批"><p>八字精批</p></a></li>
		<li><a href="/?ac=bzsy"><img src="/ffsm/statics/tu/mip/caiyun.png" alt="八字财运"><p>八字事业</p></a></li>
		<li><a href="/?ac=xmfx"><img src="/ffsm/statics/tu/mip/ming.png" alt="姓名详批"><p>姓名详批</p></a></li>
		<li><a href="/?ac=yuncheng"><img src="/ffsm/statics/tu/mip/2019.png" alt="2018流年运程"><p>2019运程</p></a></li>
		<li><a href="/?ac=yinyuan"><img src="/ffsm/statics/tu/mip/yinyuan.png" alt="姻缘分析"><p>姻缘分析</p></a></li>
		<li><a href="/?ac=zhanxing"><img src="/ffsm/statics/tu/mip/ziwei.png" alt="灵犀占星"><p>灵犀占星</p>
		<li><a href="/?ac=hehun"><img src="/ffsm/statics/tu/mip/hehun.png" alt="八字合婚"><p>八字合婚</p></a></li>
		<li><a href="/?ac=xmpd"><img src="/ffsm/statics/tu/mip/peidui.png" alt="姓名配对"><p>姓名配对</p></a></li>
	</ul>
</div>

<style type="text/css">

.public_ht_ul {
    position: relative;
    overflow: hidden;
    padding: 15px 0 0 0;
}
.public_ht_ul li {
	list-style-type:none;
    float: left;
    width: 25%;
    margin-bottom: 10px;
}
.public_ht_ul li a {
    display: block;
	text-decoration:none;
}
.public_ht_ul li p {
    line-height: 24px;
    height: 26px;
    font-size: 15px;
    text-align: center;
    overflow: hidden;
}
.public_ht_ul li img {
    display: block;
    width: 70%;
    margin: 0 auto;
}
.public_ht_title {
    height: 30px;
    line-height: 24px;
    padding: 10px;
    color: #FFF;
    font-weight: 800;
    text-align: center;
    font-size: 16px;
}

</style>

        <div style="height: 50px;"></div>

    </div>



    <div class="toastbox"></div>

    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/js/jquery-1.8.3.min.js"></script>

    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/js/jquery.raty.min.js"></script>

    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/js/check.js?v=1.70"></script>

    <script>

        var scores = 5;

        var ajaxstatus = true;



        $(function () {

            $.fn.raty.defaults.path = '/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment';

            $('#star').raty({

                score: 5,

                click: function (score, e) {

                    scores = parseInt(score);

                    if (scores == 1) {

                        $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/unsatisfieds.png");

                        $("#emoji_desc").text("失望");

                    } else if (scores == 2) {

                        $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/unsatisfied.png");

                        $("#emoji_desc").text("不满");

                    } else if (scores == 3) {

                        $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/general.png");

                        $("#emoji_desc").text("一般");

                    } else if (scores == 4) {

                        $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/satisfied.png");

                        $("#emoji_desc").text("满意");

                    } else if (scores == 5) {

                        $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/comment/satisfieds.png");

                        $("#emoji_desc").text("非常满意");

                    }

                }

            });

            //为昵称输入框添加边框

            $('#nickname').css({"border": "1px solid #F0F0F0"});

            var user_comment = "123123";

            user_comment = parseInt(user_comment);

            if(user_comment){

                $('.commentshow').hide();

            }

        });



        function checkNameData(n){

            if (!n){

                showtoast("您还没有填写姓名！");

                $('#name_input').focus();

                return false;

            }



            if(r(n)){

                showtoast("您填写的姓名属于敏感词汇");

                $('#name_input').focus();

                return false;

            }



            return true;

        }

        function checkCommentData(n){

            if (!n) {

                showtoast("您还没有填写评论！");

                return false;

            }



            if (r(n)) {

                showtoast("您填写的内容含有敏感词汇");

                return false;

            }



            return true;

        }

        var temp_name = "";

        $('#un_name').click(function (e) {

            var cn_name = $('#un_name').prop("checked");

            if (cn_name) {

                temp_name = $("#nickname").val();

                $("#nickname").val("匿名");

                $("#nickname").attr('readonly','readonly');

            } else {

                $("#nickname").val(temp_name);

                $("#nickname").removeAttr('readonly');

            }

        })

        $('#comment_content').keyup(function(event) {

            /* Act on the event */

            var maxLength = 50;

            var len = $('#comment_content').val().length;

            if(len>maxLength-1){

                var res = $(this).val().substring(0,50);

                $(this).val(res);

                showtoast("评论字数不超过50字");

            }

        });

        $('#submit_img').click(function () {

            var un_name = $('#un_name').prop("checked");

            var nickname = un_name ? '匿名' : $("#nickname").val();

            var comment = $.trim($("#comment_content").val());

            if (checkNameData(nickname) && checkCommentData(comment)) {

                if(ajaxstatus){

                    ajaxstatus = false;

                    $.post("/",{

                        comment: comment,

                        order_id: '19031709335975c46079284',

                        nickname: nickname,

                        score: scores

                    }, function () {

                        $('.comment_box').fadeOut(1000);

                        showtoast("感谢您的评价！");

                    });

                    

                }

            }



        });



    </script>

    

</body>

</html>