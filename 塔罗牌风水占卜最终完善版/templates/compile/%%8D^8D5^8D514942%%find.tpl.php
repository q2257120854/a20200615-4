<?php /* Smarty version 2.6.25, created on 2019-04-16 15:29:22
         compiled from index/hehun/find.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title><?php echo $this->_tpl_vars['info']['username']; ?>
和<?php echo $this->_tpl_vars['info']['girl_username']; ?>
合婚测算结果-灵犀算名网</title>
<meta name="keywords" content="八字合婚,周易八字配对,在线八字合婚,八字合婚免费算命" />
<meta name="description" content="灵犀算名网提供婚姻测算八字合婚服务，解开婚姻与八字的姻缘关系，普渡每一个善信的有缘人，我们衷心祝愿您拥有幸福的婚姻生活。" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/bazihehun/1/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/bazihehun/1/bazihehun.min.css" rel="stylesheet" type="text/css"/>
<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">八字合婚</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/bazihehun/1/images/mainbg.jpg" alt="八字合婚"/>
</div>
<div class="order_wrapper">
	<div class="order_code">
		订单编号：<?php echo $this->_tpl_vars['row']['oid']; ?>

	</div>
	<div class="user_info">
		<div class="user_info_box left">
			<p class="tit"><?php echo $this->_tpl_vars['info']['username']; ?>
</p>
			<p><img src="/ffsm/statics/ffsm/bazihehun/1/images/big_man.jpg" alt="先生"/></p>
			<p><?php echo $this->_tpl_vars['info']['birthday']; ?>
</p>
		</div>
		<span class="icon_center"><img src="/ffsm/statics/ffsm/bazihehun/1/images/icon_hehun.png" alt="#"/></span>
		<div class="user_info_box right">
			<p class="tit"><?php echo $this->_tpl_vars['info']['girl_username']; ?>
</p>
			<p><img src="/ffsm/statics/ffsm/bazihehun/1/images/big_woman.jpg" alt="小姐"/></p>
			<p><?php echo $this->_tpl_vars['info']['birthday1']; ?>
</p>
		</div>
	</div>
</div>
<div class="pay_item">
	<div class="words">
		<span><?php echo $this->_tpl_vars['info']['username']; ?>
与<?php echo $this->_tpl_vars['info']['girl_username']; ?>
的合婚结果</span>
	</div>
    <div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第一：<?php echo $this->_tpl_vars['info']['username']; ?>
先生的命格</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list1 left">
			<p>生肖：<b><?php echo $this->_tpl_vars['data']['shengxiao1']; ?>
</b> 命宫：<b><?php echo $this->_tpl_vars['data']['m_n']; ?>
</b> 头胎：<?php echo $this->_tpl_vars['data']['erzi']; ?>
</p>
			<p>十神：<b><?php echo $this->_tpl_vars['data']['shishen1']; ?>
 | <?php echo $this->_tpl_vars['data']['shishen2']; ?>
</b> 日主：<b><?php echo $this->_tpl_vars['data']['rizhu1']; ?>
</b></p>
            <p>乾造：<b><?php echo $this->_tpl_vars['data']['qianzao1']; ?>
</b></p>
            <p>支十神：<b><?php echo $this->_tpl_vars['data']['zhishishen1']; ?>
</b></p>
            <p>十神：<?php echo $this->_tpl_vars['data']['shishen_for1']; ?>
</p>
		</div>
	</div>
    <div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第二：<?php echo $this->_tpl_vars['info']['girl_username']; ?>
小姐的命格</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list1 left">
			<p>生肖：<b><?php echo $this->_tpl_vars['data']['shengxiao2']; ?>
</b> 命宫：<b><?php echo $this->_tpl_vars['data']['m_v']; ?>
</b> 头胎：<?php echo $this->_tpl_vars['data']['erzi_a']; ?>
</p>
			<p>十神：<b><?php echo $this->_tpl_vars['data']['shishenb1']; ?>
 | <?php echo $this->_tpl_vars['data']['shishenb2']; ?>
</b> 日主：<b><?php echo $this->_tpl_vars['data']['rizhu1']; ?>
</b></p>
            <p>坤造： <b><?php echo $this->_tpl_vars['data']['qianzao2']; ?>
</b></p>
            <p>支十神：<b><?php echo $this->_tpl_vars['data']['zhishishen2']; ?>
</b></p>
            <p>十神：<?php echo $this->_tpl_vars['data']['shishen_for2']; ?>
</p>
		</div>
	</div>
    
    <div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第三：名师综合点评</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
			<p>二位命卦九宫落在宫位：'<?php echo $this->_tpl_vars['hehun']['lchh']['gong']; ?>
'，此为<?php echo $this->_tpl_vars['hehun']['lchh']['jx']; ?>
 ，(甲方命卦：<?php echo $this->_tpl_vars['data']['m_n']; ?>
（<?php echo $this->_tpl_vars['data']['m_na']; ?>
四命） 乙方命卦：<?php echo $this->_tpl_vars['data']['m_v']; ?>
（<?php echo $this->_tpl_vars['data']['m_va']; ?>
四命）)</p>
            <p><?php if ($this->_tpl_vars['hehun']['lchh']['jx'] == '上等婚'): ?><b style="color:#F00;">只要是上等婚，则对其它方面的事情，可以不再理睬，比如：属相相犯、命里相犯均可不予考虑。</b>
            <?php elseif ($this->_tpl_vars['hehun']['lchh']['jx'] == '下等婚'): ?><b style="color:#F00;">下等婚男女双方均有忧愁，如若属命又相犯，则可能一方早亡，可以讲：下等婚是不该和配的婚姻，这种婚姻的生活里是凶多吉少。说明一点：夫妻双方长期分居者，不受此限，但是，往往一旦长期合居，则有事情生发。合婚十全者寥寥，只要二命神煞相抵能中和，则足矣。（属相相生、五行找互补）。</b>
            <?php else: ?><b style="color:#F00;">中等婚，量轻量重言之，如若月家吉星多，凶星少，则可。就是说：中等婚在生活之中难免波折，但是，凶少吉多，如果属相相犯、命相犯，最好避之，如若已经婚配，则双方当需谨防破裂和家中其它事情生发。</b><?php endif; ?>
            
            </p>
            
			<p><?php echo $this->_tpl_vars['info']['girl_username']; ?>
与<?php echo $this->_tpl_vars['info']['username']; ?>
的<?php echo $this->_tpl_vars['hehun']['whwqcode']['title']; ?>
，<?php echo $this->_tpl_vars['hehun']['whwqcode']['info']; ?>
</p>
			<p>二位<?php echo $this->_tpl_vars['hehun']['shuxiang']['t']; ?>
。(男方属相：<?php echo $this->_tpl_vars['data']['shengxiao1']; ?>
 女方属相：<?php echo $this->_tpl_vars['data']['shengxiao2']; ?>
)</p>
            <p>男方喜用神：<?php echo $this->_tpl_vars['hehun']['nan']['xishen']['xishen']; ?>
（<?php echo $this->_tpl_vars['hehun']['nan']['xishen']['sjrs']; ?>
）<br> 女方喜用神：<?php echo $this->_tpl_vars['hehun']['nv']['xishen']['xishen']; ?>
（<?php echo $this->_tpl_vars['hehun']['nv']['xishen']['sjrs']; ?>
）</p>
		</div>
		<div class="right J_payPopupShow">
		</div>
	</div>
    
    
	<div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第三：（吕才合婚）命运合盘</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
        
        	<p><?php echo $this->_tpl_vars['hehun']['lchh']['beizhu']; ?>
</p>
        
			<p><?php echo $this->_tpl_vars['info']['girl_username']; ?>
与<?php echo $this->_tpl_vars['info']['username']; ?>
的命挂九宫落在宫位'<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['lchh']['gong']; ?>
</b>'</p>
			<p>此为<b style="color:#F00;"><?php echo $this->_tpl_vars['hehun']['lchh']['jx']; ?>
</b></p>
            <p><?php echo $this->_tpl_vars['hehun']['lchh']['txt']; ?>
</p>
            <p><?php echo $this->_tpl_vars['hehun']['lchh']['content']; ?>
</p>
            
		</div>
		<div class="right J_payPopupShow">
		</div>
	</div>
	<div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第四：命格五行属相情况</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
			<p><?php echo $this->_tpl_vars['info']['girl_username']; ?>
与<?php echo $this->_tpl_vars['info']['username']; ?>
的年支五行'<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['whkznianzhu']['wh1']; ?>
</b>'与'<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['whkznianzhu']['wh2']; ?>
</b>'</p>
			<p>年支五行配对：<?php echo $this->_tpl_vars['hehun']['whkznianzhu']['txt']; ?>
</p>
			<p><?php echo $this->_tpl_vars['info']['girl_username']; ?>
与<?php echo $this->_tpl_vars['info']['username']; ?>
的日支五行'<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['whkzrizhu']['wh1']; ?>
</b>'与'<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['whkzrizhu']['wh2']; ?>
</b>'</p>
			<p>日支五行配对：<?php echo $this->_tpl_vars['hehun']['whkzrizhu']['txt']; ?>
</p>
			<p>属相配对：<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['shuxiang']['jx']; ?>
</b></p>
			<p><?php echo $this->_tpl_vars['hehun']['shuxiang']['txt']; ?>
：<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['shuxiang']['t']; ?>
</b></p>
			<p><b style="color:#F00;"><?php echo $this->_tpl_vars['hehun']['shuxiang']['more']; ?>
</b></p>
            <p>【三合的生肖】，属上等婚配，也是因为双方彼此欣赏，有许多共同点，能产生共鸣，所以在一起相处，不论是朋友还是夫妻，大多都会相得益彰，相濡以沫。当然，三合里面又分生地半合与墓地半合，此两种半合的力度也是有大有小，也需要区别看待。

【六合的生肖】，属上上等婚配，之所以相合，是因为双方思维方式、思想观念极为相似，相互欣赏，一拍既合，迸出火花。属一见钟情，相见恨晚的那种，很多情人或知己好友还有好的合作伙伴，大多即属此种情况。

【相刑的生肖】，也属下等婚配。经常争吵，反目成仇，相互残害。其婚姻幸福的也极其少见。

【相害的生肖】，则属中下等婚配。一方得志，一方受气，一方欺负另一方。其实双方都不同程度地受到伤害，只不过有轻有重而已。受伤害重的一方，不得不委曲求全，寄人篱下，这种婚姻大多也难言幸福。

【而相冲的生肖】，就属下下等婚配了。之所以相冲，就是因为双方思维方式不同，价值观念也相悖，所以互不欣赏，甚至反感。大多最终导致反目成仇，劳燕纷飞。</p>
		</div>
	</div>
	<div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第五：配对64卦象</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
			<p>第<b style="color:#F00;"><?php echo $this->_tpl_vars['hehun']['gua']['gua']; ?>
</b>卦 - <b style="color:#F00;"><?php echo $this->_tpl_vars['hehun']['gua']['lv']; ?>
</b></p>
			<p>卦名：<?php echo $this->_tpl_vars['hehun']['gua']['title']; ?>
 - 卦义：<?php echo $this->_tpl_vars['hehun']['gua']['guayi']; ?>
</p>
			<p><?php echo $this->_tpl_vars['hehun']['gua']['msg']; ?>
</p>
		</div>
	</div>
	<div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第六：房子朝向建议</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
			<p>命宫:<b style="color:#00b98d;"><?php echo $this->_tpl_vars['hehun']['fangwei']['mg']; ?>
</b></p>
			<p><?php echo $this->_tpl_vars['hehun']['fangwei']['txt']; ?>
</p>
			<p>
            方位名称解释：<br>
             1、生气，为贪狼星，乃大吉之星。<br>
             2、延年，为武曲星，乃中吉之星。<br>
             3、天医，为巨门星，乃次吉之星。<br>
             4、伏位，为左辅星，乃小吉之星。<br>
             5、绝命，为破军星，乃大凶之星。<br>
             6、五鬼，为廉贞星，乃次凶之星。<br>
              7、祸害，为禄存星，乃中凶之星。<br>
              8、六煞，为文曲星，乃小凶之星。<br>
            </p>
            <p></p>
		</div>
	</div>
    
    
	<div class="public_bzhh_title J_payPopupShow">
		<span class="left"></span><span class="right"></span><span class="center">第七：（婚后生活）子女同步</span><i></i>
	</div>
	<div class="public_lock_content">
		<div class="list2 left">
			<p>双方命局子女信息，属于<?php if ($this->_tpl_vars['data']['erzi'] != $this->_tpl_vars['data']['erzi_a']): ?>不<?php endif; ?>同步，<?php if ($this->_tpl_vars['data']['erzi'] == $this->_tpl_vars['data']['erzi_a']): ?>儿孙满堂晚年享受儿孙之福。<?php else: ?>可通过后天的一些措施来补救。如工作行业、方位、颜色、饮食、兴趣、日常用品,平时生活需要注意多忍让对方等。<?php endif; ?></p>
            <p>命宫</p>
			<p><b style="color:#00b98d;">婚姻格言：</b></p>
			<p>婚姻就是把爱情落实到生活里，睁开一只眼看清楚对方的优点，闭上一只眼无视对方的缺点。在婚姻中学着做个合适的人，而不是去找个合适的人。</p>
			<p>夫妻相处之道是重视及感谢对方所做的一切，不要凡事视为当然。</p>
			<p>能有智慧'建立一个温馨美满家庭'的人，才算是一个真正成功的人。</p>
			<p>没有100分的另一半，只有50分的两个人。</p>
		</div>
	</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>