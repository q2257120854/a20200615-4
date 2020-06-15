<?php /* Smarty version 2.6.25, created on 2019-02-16 18:21:26
         compiled from index/xmfx/find.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>姓名详批-天玄算命网</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css?v=0817" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/jieming/1/jieming_1.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">姓名详批</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_binding">
	<div class="pb_tit">
		绑定订单可以多次查看
	</div>
	<div class="pb_con">
    	<div>
			<span>产品名称：</span><?php echo $this->_tpl_vars['row']['des']; ?>

		</div>
		<div>
			<span>订单编号：</span><?php echo $this->_tpl_vars['row']['oid']; ?>

		</div>
	</div>
</div>
<div class="jieming_box J_payBottomShow ">
	<div class="jb_title relative">
		您的姓名测算结果
	</div>
	<div class="jb_content">
		<p class="n">
			<?php echo $this->_tpl_vars['return']['xingming']; ?>

		</p>
		<p>
			公历生日：<?php echo $this->_tpl_vars['return']['user']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['return']['user']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['return']['user']['nianling']['d']; ?>
日 <?php echo $this->_tpl_vars['return']['user']['nianling']['h']; ?>
时
		</p>
		<p>
			农历生日：<?php echo $this->_tpl_vars['return']['user']['jiuli']['y']; ?>
年<?php echo $this->_tpl_vars['return']['user']['jiuli']['m']; ?>
<?php echo $this->_tpl_vars['return']['user']['jiuli']['d']; ?>
日<?php echo $this->_tpl_vars['return']['user']['jiuli']['h']; ?>
时
		</p>
		<p>
			您的姓名三才五行组合：<?php echo $this->_tpl_vars['return']['info']['rssancai']['title']; ?>

		</p>
		<div class="jbc_gezi">
			<div class="jg_left left">
				<div class="g01 public_w">
					<p class="t">
						迁移宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['waige']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['waige_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						命宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['zhongge']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['zongge_sancai']; ?>
</span>
					</p>
				</div>
			</div>
			<span class="jg_line left"></span>
			<div class="jl_words left">
				<span><span style="color:#f2ac65"><?php if ($this->_tpl_vars['return']['xm_arr']['xing2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing1']; ?>
<?php else: ?>白<?php endif; ?></span></span><span><?php if ($this->_tpl_vars['return']['xm_arr']['xing2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing2']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing1']; ?>
<?php endif; ?></span><span><?php echo $this->_tpl_vars['return']['xm_arr']['ming1']; ?>
</span><span><?php if ($this->_tpl_vars['return']['xm_arr']['ming2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['ming2']; ?>
<?php else: ?>白<?php endif; ?></span>
			</div>
			<div class="jg_bihua left">
				<span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua2'] == ''): ?>1<?php else: ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua2']; ?>
<?php endif; ?></span><span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua2'] == ''): ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua1']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua1']; ?>
<?php endif; ?></span><span><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua3']; ?>
</span><span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua4']): ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua4']; ?>
<?php else: ?>1<?php endif; ?></span>
			</div>
			<div class="jg_line2 left">
				<span></span><span></span><span></span>
			</div>
			<div class="jg_right left">
				<div class=" public_w">
					<p class="t">
						父母宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['tiange']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['tian_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						疾厄宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['renge']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['ren_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						奴仆宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['dige']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['di_sancai']; ?>
</span>
					</p>
				</div>
			</div>
		</div>
		<!-- end -->
	</div>
</div>
<div class="jieming_box">
	<div class="jb_title relative">
		您的八字命盘
	</div>
	<div class="jb_bzmp">
		<p class="words">
			下列是您的八字命盘。您是<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx']; ?>
，出生于<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx']; ?>
年。日天干代表您，所以您是属<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['wh']; ?>
。
		</p>
		<div class="jb_bzmp_content">
			<dl>
				<dt class="ct">年（祖先）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['wh_py']; ?>
.png" alt="阴火"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx_py']; ?>
.png" alt="$report['sort']['year'][2]"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">月（父母）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['wh_py']; ?>
.png" alt="阴火"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">日（自己）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['wh_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">时（子孙）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['wh_py']; ?>
.png" alt="阳土"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
		</div>
		<p class="jb_bzmp_bottom">
			八字命盘从阴阳干支三合历取得。上排是天干由五行“金水木火土”轮流排列。下排是地支用十二生肖顺序排列。十二生肖可转换成五行八字姓名详批是依据文字的音、形、义、意、数的原理，综合姓氏文化、文字阴阳五行，并结合测算者的八字信息，解读你的姓名中所暗藏的各项运势，让你更好的了解自己，掌握命运。
		</p>
	</div>
</div>


<div class="jieming_box">

	<div class="pb_tit jb_title">
		您的性格特征
	</div>

	<div class="jb_bzmp">

		<p class="words">
			性格优缺点
		</p>


		<div class="jb_bzmp_bottom">

			<p>
				<b>优点:</b><?php if ($this->_tpl_vars['return']['data']['zonghe']['yx']): ?><?php echo $this->_tpl_vars['return']['data']['zonghe']['yx']; ?>
<?php else: ?>才智高且具优秀的头脑，行动活泼好动且伶俐。好竞争，手腕敏捷有侠义心情，反应快，能见机行事。社交手腕高明善解人意，很快与人打成一片，但不喜欢被人控制，喜爱追求新鲜事务。聪明、机智、创新有才华，能言善道，有极强的自我表现欲。非常适合演艺和推销工作猴年生的男性精力充沛身体健壮，常表现达观机智勇敢，对环境变化有很强的适应能力生性顽强不服输，拥有多项才能而能居主导地位。求知欲很强，记忆力超人，头脑灵活很有创造力。善于把握机会扩大发展，造成时势，成为大企业家。<?php endif; ?>
			</p>
			<p>
				<b>缺点:</b><?php if ($this->_tpl_vars['return']['data']['zonghe']['qd']): ?><?php echo $this->_tpl_vars['return']['data']['zonghe']['qd']; ?>
<?php else: ?>平常爱说大话，有时有反对人之意见虚语或伪诈行为。忽略必需遵守社会全体规范，有点不脚踏实地。生性爱玩缺乏耐心毅力，眼光看得不远，犯有今朝有酒今朝醉的毛病。依赖心很重，好夸张和爱慕虚荣且喜新厌旧，不管做任何事都不会持续太久。狡滑伪善，无耐心不忠实狂妄自大，过份乐观，自负心强喜投机。为了达成目的喜爱说谎骗人，尽管才智出众八面玲珑，却不能以德服人，是典型的机会主义者。猴年生人无论说话做事一定要诚实踏实，否则会一塌糊涂。有自以为是急就章的毛病，所以常导致错误失败。<?php endif; ?>
			</p>

		</div>

	</div>

</div>


<div class="jieming_box">

	<div class="pb_tit jb_title">
		您的事业职业分析
	</div>

	<div class="jb_bzmp">

		<p class="words">
			你的喜用神为:<b style="color: #ff4632"><?php echo $this->_tpl_vars['return']['data']['xiyongshen']['data']['xishen']; ?>
</b>
		</p>


		<div class="jb_bzmp_bottom">

			<p>
				<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['shiye']; ?>

			</p>

			<p class="public_title">
				三合贵人
			</p>
			<div class="public_con_word">
				<p>
					与三合贵人共事或者得到三合贵人的帮助有利于你的事业的发展，有利于你的三合生肖是:
				</p>
			</div>
			<ul class="zodiac_pic">
				<li style="float: left;text-align:center;"><a href="#"><img width="50" src="/ffsm/statics/img/<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhetu']['0']; ?>
.png" alt="<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['0']; ?>
"/>
						<p>
							<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['0']; ?>

						</p>
					</a></li>
				<li style="float: left; line-height: 100px;text-align:center;" class="zodiac_pic_center ">
					三合
				</li>
				<li style="float: left;text-align:center;" class="zodiac_img_fs "><a href="#"><img width="50" src="/ffsm/statics/img/<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhetu']['1']; ?>
.png" alt="<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['1']; ?>
"/>
						<p>
							<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['1']; ?>

						</p>
					</a></li>
				<li style="float: left;text-align:center;" class="zodiac_img_fs "><a href="#"><img width="60" src="/ffsm/statics/img/<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhetu']['2']; ?>
.png" alt="<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['2']; ?>
"/>
						<p>
							<?php echo $this->_tpl_vars['return']['data']['xiyongshen']['sanhe']['sanhe']['2']; ?>

						</p>
					</a></li>
			</ul>

		</div>

	</div>

</div>

<div class="jieming_box">

	<div class="pb_tit jb_title">
		命宫吉凶一生点评
	</div>

	<div class="jb_bzmp">

		<p class="words">
			<?php echo $this->_tpl_vars['return']['waigearr']['as']; ?>

		</p>


		<div class="jb_bzmp_bottom">

			<p>
				<?php echo $this->_tpl_vars['return']['waigearr']['content']; ?>

			</p>

		</div>

	</div>

</div>


<div class="jieming_box">

	<div class="pb_tit jb_title">
		您的健康运势解析
	</div>

	<div class="jb_bzmp">

		<p class="words">
			从中医养生上来说，五行<font color="#ff4632"><?php echo $this->_tpl_vars['return']['info']['tywh']['wh']; ?>
</font>旺人。
		</p>


		<div class="jb_bzmp_bottom">

			<p>
				<?php echo $this->_tpl_vars['return']['info']['tywh']['szwh']; ?>
<br>
				<?php echo $this->_tpl_vars['return']['info']['tywh']['skzhyj']; ?>
<br>
				<?php echo $this->_tpl_vars['return']['info']['tywh']['whzx']; ?>
<br>

			</p>

		</div>

	</div>

</div>

<div class="jieming_box">
	<div class="pb_tit jb_title">
		总格总结
	</div>
	<div class="jb_bzmp">
		<p class="words">
			三才总结：<span style="color: #ff4632"><?php echo $this->_tpl_vars['return']['rssancai']['yy']; ?>
</span>
		</p>
		<p class="jb_bzmp_bottom">
			<?php echo $this->_tpl_vars['return']['rssancai']['content']; ?>

		</p>
	</div>
</div>

<script>
    //底部悬浮
    ;(function($){
        $.fn.publicPopup=function(opt){
            var pp=$('#publicPayPopup');
            var ppClose=$('#publicPPClose');
            var topShow=$(".J_payBottomShow").length>0?$(".J_payBottomShow").offset().top:200;
            var ppShow=$(".J_payPopupShow").length>0?$(".J_payPopupShow"):'';
            return this.each(function(){
                var $this=$(this);
                $(window).scroll(function(){
                    var wt=$(window).scrollTop();
                    wt>topShow?$this.fadeIn():$this.fadeOut();
                });
                $this.on('click',function(){
                    pp.show();
                });
                ppClose.on('click',function(){
                    pp.hide();
                })
                ppShow?ppShow.on('click',function(){pp.show()}):'';
            });
        };
    })(jQuery);
    $("#publicPayBottom").publicPopup();
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './ffsm/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--天玄算命网付费测算源码-->
</body>
</html>