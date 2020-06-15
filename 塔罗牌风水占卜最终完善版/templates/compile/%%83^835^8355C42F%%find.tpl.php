<?php /* Smarty version 2.6.25, created on 2019-03-02 13:35:37
         compiled from index/xmpd/find.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>姓名配对-天玄算命网</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css?v=0817" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/xmpeidui/2/style.min.css" rel="stylesheet" type="text/css"/>
<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">姓名配对</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="order_top">
	<img src="/ffsm/statics/ffsm/xmpeidui/2/images/banner_result.jpg" alt="">
	<div>
		订单号：<?php echo $this->_tpl_vars['row']['oid']; ?>

	</div>
</div>
<!--ads:550-->
<div class="order_info">
	<div class="oi_name">
		<div class="oi_left">
			<h4><?php echo $this->_tpl_vars['return']['one_arr']['name1']; ?>
</h4>
			<p>
				男主角
			</p>
		</div>
		<div class="oi_con">
			<b>VS</b>
			<p>
				配对
			</p>
		</div>
		<div class="oi_right">
			<h4><?php echo $this->_tpl_vars['return']['two_arr']['name2']; ?>
</h4>
			<p>
				女主角
			</p>
		</div>
	</div>
	<div class="oi_num">
		<p>
			匹配契合度
		</p>
		<div class="start_4_5">
		</div>
	</div>
</div>
<div class="order_grid">
	<div class="base_tit">
		男女姓名婚姻五格
	</div>
	<div class="og_tit">
		男主角：<?php echo $this->_tpl_vars['return']['one_arr']['name1']; ?>

	</div>
	<div class="og_con">
		<div class="og_name">
			<i class="l"></i><i class="c"></i><i class='r'></i>
			<div>
				<?php if ($this->_tpl_vars['return']['x2arr'] == ''): ?><span>1</span><?php else: ?><?php echo $this->_tpl_vars['return']['x1arr']['nxing1']; ?>
<?php endif; ?>
			</div>
			<div>
            
            <?php if ($this->_tpl_vars['return']['x2arr'] == ''): ?><?php echo $this->_tpl_vars['return']['x1arr']['nxing1']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['x2arr']['nxing2']; ?>
<?php endif; ?>
				
			</div>
			<div>
				<?php echo $this->_tpl_vars['return']['m1arr']['nming1']; ?>

			</div>
			<div>
				<?php if ($this->_tpl_vars['return']['m2arr']['nming2'] != ''): ?><?php echo $this->_tpl_vars['return']['m2arr']['nming2']; ?>
<?php else: ?><span>1</span><?php endif; ?>
			</div>
		</div>
		<div class="og_txt">
			<span>天格:<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['tiange1']; ?>
</span><span>人格:<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['renge1']; ?>
</span><span>地格:<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['dige1']; ?>
</span>
		</div>
		<div class="og_all">
			<span>外格:<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['waige1']; ?>
</span>
		</div>
		<div class="og_txt">
			<span>总格:<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['zhongge1']; ?>
</span>
		</div>
	</div>
	<div class="og_tit">
		女主角：<?php echo $this->_tpl_vars['return']['two_arr']['name2']; ?>

	</div>
	<div class="og_con og_con_2">
		<div class="og_name">
			<i class="l"></i><i class="c"></i><i class='r'></i>
			<div>
				<?php if ($this->_tpl_vars['return']['n2x2arr'] != ''): ?><?php echo $this->_tpl_vars['return']['n2x1arr']['n2xing1']; ?>
<?php else: ?><span>1</span><?php endif; ?>
			</div>
			<div>
				<?php if ($this->_tpl_vars['return']['n2x2arr'] != ''): ?><?php echo $this->_tpl_vars['return']['n2x2arr']['n2xing2']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['n2x1arr']['n2xing1']; ?>
<?php endif; ?>
			</div>
			<div>
				<?php echo $this->_tpl_vars['return']['n2m1arr']['n2ming1']; ?>

			</div>
			<div>
				<?php if ($this->_tpl_vars['return']['n2m2arr']['n2ming2'] != ''): ?><?php echo $this->_tpl_vars['return']['n2m2arr']['n2ming2']; ?>
<?php else: ?><span>1</span><?php endif; ?>
			</div>
		</div>
		<div class="og_txt">
			<span>天格:<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['ntiange1']; ?>
</span><span>人格:<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['nrenge1']; ?>
</span><span>地格:<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['ndige1']; ?>
</span>
		</div>
		<div class="og_all">
			<span>外格:<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['nwaige1']; ?>
</span>
		</div>
		<div class="og_txt">
			<span>总格:<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['nzhongge1']; ?>
</span>
		</div>
	</div>
</div>
<div class="bilateral_character">
	<div class="base_tit">
		双方性格
	</div>
	<div class="bc_box">
		<div class="bc_img">
			<img src="/ffsm/statics/ffsm/xmpeidui/2/images/wx_<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['yuanshen']['wh_']; ?>
.jpg" alt="">
			<p>
				元神：<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['yuanshen']['yuanshen']; ?>

			</p>
		</div>
		<div class="bc_tit">
			男主角：<?php echo $this->_tpl_vars['return']['data']['malexing']; ?>
<?php echo $this->_tpl_vars['return']['data']['malename']; ?>

		</div>
		<div class="bc_con">
        	<?php echo $this->_tpl_vars['return']['one_arr']['xg1']; ?>

		</div>
	</div>
	<div class="bc_box">
		<div class="bc_img">
			<img src="/ffsm/statics/ffsm/xmpeidui/2/images/wx_<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['yuanshen']['wh_']; ?>
.jpg" alt="">
			<p>
				元神：<?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['yuanshen']['yuanshen']; ?>

			</p>
		</div>
		<div class="bc_tit bc_tit2">
			女主角：<?php echo $this->_tpl_vars['return']['data']['femalexing']; ?>
<?php echo $this->_tpl_vars['return']['data']['femalename']; ?>

		</div>
		<div class="bc_con">
			<?php echo $this->_tpl_vars['return']['two_arr']['xg1xx']; ?>

		</div>
	</div>
</div>
<div class="love_fate">
	<div class="base_tit">
		双方爱情宿命
	</div>
	<div class="lf_male">
		<img src="/ffsm/statics/ffsm/xmpeidui/2/images/male_img.png" alt="">
		<div>
			男主角：<?php echo $this->_tpl_vars['return']['data']['malexing']; ?>
<?php echo $this->_tpl_vars['return']['data']['malename']; ?>

		</div>
		<p>
        	<?php echo $this->_tpl_vars['return']['tdrh_ge_arr']['yuanshen']['msg']; ?>

            
			「一旦认定对方，就会全心全意付出」这是你最迷人的地方。虽然不是最浪漫的情人，但是，绝对是最能带给伴侣安全感的好男人！
		</p>
	</div>
	<div class="lf_female">
		<img src="/ffsm/statics/ffsm/xmpeidui/2/images/female_img.png" alt="">
		<div>
			女主角：<?php echo $this->_tpl_vars['return']['data']['femalexing']; ?>
<?php echo $this->_tpl_vars['return']['data']['femalename']; ?>

		</div>
		<p>
        	
            <?php echo $this->_tpl_vars['return']['tdrh2_ge_arr']['yuanshen']['msg']; ?>

			你从不吝於向另一半表达心目中浓浓爱意。即使处在暧昧不明的暗恋阶段，你的心仪对象，也绝对逃不过你那热情放送的强力电波。面对爱情，你的态度勇敢而直接，走出失恋/苦恋阴霾的速度，往往快得吓人。
		</p>
	</div>
</div>
<div class="gua_as">
	<div class="base_tit">
		姓名相合卦象
	</div>
	<div class="ga_top">
		<table class="ga_male">
		<tr>
			<th rowspan="3">
				<?php echo $this->_tpl_vars['return']['x1arr']['nxing1']; ?>
<br><?php if ($this->_tpl_vars['return']['x2arr']['nxing2']): ?><?php echo $this->_tpl_vars['return']['x2arr']['nxing2']; ?>
<br/><?php endif; ?><?php echo $this->_tpl_vars['return']['m1arr']['nming1']; ?>
<br><?php echo $this->_tpl_vars['return']['m2arr']['nming2']; ?>

			</th>
			<td>
				<div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<span></span><span></span>
			</td>
		</tr>
		<tr>
			<td>
				<div>
				</div>
			</td>
		</tr>
		</table>
		<table class="ga_female">
		<tr>
			<th rowspan="3">
				<?php echo $this->_tpl_vars['return']['n2x1arr']['n2xing1']; ?>
<?php if ($this->_tpl_vars['return']['n2x2arr']['n2xing2']): ?><br><?php echo $this->_tpl_vars['return']['n2x2arr']['n2xing2']; ?>
<?php endif; ?><br/><?php echo $this->_tpl_vars['return']['n2m1arr']['n2ming1']; ?>
<br><?php echo $this->_tpl_vars['return']['n2m2arr']['n2ming2']; ?>

			</th>
			<td>
				<span></span><span></span>
			</td>
		</tr>
		<tr>
			<td>
				<span></span><span></span>
			</td>
		</tr>
		<tr>
			<td>
				<span></span><span></span>
			</td>
		</tr>
		</table>
		<div class="ga_gua">
			<img src="/ffsm/statics/ffsm/xmpeidui/2/images/gua_img.png" alt="">
			<table>
			<tr>
				<td>
					<?php echo $this->_tpl_vars['return']['gua']['title']; ?>

				</td>
			</tr>
			</table>
		</div>
	</div>
	<div class="ga_txt">
		姓名相合卦象：<?php echo $this->_tpl_vars['return']['gua']['title']; ?>
(<?php echo $this->_tpl_vars['return']['gua']['title_txt']; ?>
)
	</div>
	<div class="ga_txt">
		卦象等级：<?php echo $this->_tpl_vars['return']['gua']['guayi']; ?>
&emsp;<?php echo $this->_tpl_vars['return']['gua']['lv']; ?>

	</div>
	<div class="ga_num">
		评分：<span class="start_4_5"></span>
	</div>
	<div class="ga_txt">
		解析：<br/>
		<?php echo $this->_tpl_vars['return']['gua']['msg']; ?>

	</div>
</div>
<div class="base_block">
	<div class="base_tit">
		爱情危机
	</div>
	<div class="bb_con">
		<img src="/ffsm/statics/ffsm/xmpeidui/2/images/img_1.jpg" alt="">
		<?php if ($this->_tpl_vars['return']['gua']['weiji']): ?>
		<?php echo $this->_tpl_vars['return']['gua']['weiji']; ?>

		<?php else: ?>
		男生踏实稳重，女生直率爽朗，是互补型的组合，男生的踏实能给女生带来踏实安定的感觉，而女生的阳光率直也像阳光一样能让男生感觉到快乐和能量，然而两个人性格上的差异既是优点也是缺点，如果两人意见出现较大的分歧时，急惊风的女生一门心思的想要解决，而冷静的男生总是想要思虑周全之后再做沟通，解决矛盾两个人像带有时差一般，问题就那样横在彼此中间。
		<?php endif; ?>
	</div>
</div>
<div class="base_block">
	<div class="base_tit">
		爱情建议
	</div>
	<div class="bb_con">
		<img src="/ffsm/statics/ffsm/xmpeidui/2/images/img_2.jpg" alt="">
		<?php if ($this->_tpl_vars['return']['gua']['jianyi']): ?>
		<?php echo $this->_tpl_vars['return']['gua']['jianyi']; ?>

		<?php else: ?>
		一个温吞吞，一个急匆匆，如果两人真的走在一起，不妨像网球双打一样，一个补、一个攻，也许发展更为稳健，当然，大前提是是已经能完全理解和接受对方的特性。男生要更主动、加大追求力度。女生则要学习男生深思熟虑的处事态度，顺着这个趋势，相互补足，彼此迁就，共同进步，你们在生活上就不容易因为太过迥异的性格绊住脚步了。
		<?php endif; ?>
	</div>
</div>
	<!--ads:500-->
</div>
<div style=" height: 25px;">
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<!--塔罗占卜付费测算源码-->
</body>
</html>