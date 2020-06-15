<?php /* Smarty version 2.6.25, created on 2019-02-20 13:46:00
         compiled from index/bzsy/find.tpl */ ?>
﻿<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<title>八字事业详批</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
	<meta content="telephone=no" name="format-detection"/>
	<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
	<link href="/ffsm/statics/ffsm/bzyy/bzyy2.css" rel="stylesheet" type="text/css"/>
	<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<img style="width:100%; height:auto; margin:0 auto; display:block;" src="/ffsm/statics/img/sy_banner.png" alt="点灯还愿">
<div class="container" id="topAnchor">
  <div class="wrapper" id="wrapper">
    <section id="page-result">
      <div data-reactroot="">
        <div>
          
          <div>
            <div class="li_title">个人信息</div>
            <ul class="user-info">
              <li>
                <div>姓名:<?php echo $this->_tpl_vars['cookies']['xingming']; ?>
</div></li>
              <li>
                <div>性别:<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?></div></li>
              <li>
                <div>公历:<?php echo $this->_tpl_vars['cookies']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['cookies']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['cookies']['nianling']['d']; ?>
日 <?php echo $this->_tpl_vars['form']['h']; ?>
时</div></li>
            </ul>
          </div>
          <div class="minp">
            <div class="li_title_top"></div>
            <div class="li_title">您的八字命盘</div>
            <table class="minp-tab">
              <tbody>
                <tr>
                  <td></td>
                  <td>年柱</td>
                  <td>月柱</td>
                  <td>日柱</td>
                  <td>时柱</td></tr>
                <tr>
                  <td>十神</td>
                  <td><?php echo $this->_tpl_vars['pp']['shishen1']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['shishen2']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['shishen3']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['shishen4']; ?>
</td></tr>
                <tr>
                  <td>天干</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['0']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['2']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['4']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['6']; ?>
</td></tr>
                <tr>
                  <td>地支</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['1']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['3']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['5']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['return']['user']['bazi']['7']; ?>
</td></tr>
                <tr>
                  <td>藏干</td>
                  <td><?php echo $this->_tpl_vars['pp']['zanggan1']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['zanggan2']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['zanggan3']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['zanggan4']; ?>
</td></tr>
                <tr>
                  <td>支神</td>
                  <td>伤官</td>
                  <td>食神
                    <br>偏财
                    <br>七杀</td>
                  <td>七杀
                    <br>伤官
                    <br>劫财</td>
                  <td>伤官</td></tr>
                <tr>
                  <td>纳音</td>
                  <td><?php echo $this->_tpl_vars['pp']['nayin1']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['nayin2']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['nayin3']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['pp']['nayin4']; ?>
</td></tr>
              </tbody>
            </table>
          </div>
          <div>
            <div class="part">
              <div class="li_title_top"></div>
              <div class="li_title">事业分析</div>
              <div class="part_det">
                <p class="part_tips"><?php echo $this->_tpl_vars['rglm']['syfx']; ?>
</p>
				<p class="part_tips"><?php echo $this->_tpl_vars['tywh']['hyhw']; ?>
</p>
             </div>
            </div>
          </div>
          <div>
            <div class="part">
              <div class="li_title_top"></div>
              <div class="li_title">财运分析</div>
              <div class="part_det">
                <p class="part_tips"><?php echo $this->_tpl_vars['rglm']['cyfx']; ?>
</p>
              </div>
            </div>
          </div>
          
           <div>
            <div class="part">
              <div class="li_title_top"></div>
              <div class="li_title">名师点评</div>
              <div class="part_det">
                <p class="part_tips"><?php echo $this->_tpl_vars['dianping']; ?>
</p>
              </div>
            </div>
          </div>
          
          <div>
            <div class="analysis">
              <div class="li_title_top"></div>
              <div class="li_title">属相情况</div>
              <ul>
                <p>
                  <span class="ana_type">三合生肖：</span><?php echo $this->_tpl_vars['return']['sxsk']['pei']['0']; ?>
、<?php echo $this->_tpl_vars['return']['sxsk']['pei']['1']; ?>
、<?php echo $this->_tpl_vars['return']['sxsk']['pei']['2']; ?>
</p>
                <p>
                  <span class="ana_type">相害生肖：</span><?php echo $this->_tpl_vars['return']['sxsk']['hai']; ?>
</p>
                <p>
                  <span class="ana_type">相冲生肖：</span><?php echo $this->_tpl_vars['return']['sxsk']['ke']; ?>
</p>
                <p>
                  <span class="ana_type">相刑生肖：</span><?php echo $this->_tpl_vars['return']['sxsk']['xing']; ?>
</p>
              </ul>
            </div>
          </div>
          
          
          <div>
            <div class="result_title">
              <div class="li_title_top"></div>
              <div class="li_title">综合点评</div>
              <ul>
                <li>
                  <h3>年度点评</h3>
                  <p><?php echo $this->_tpl_vars['return']['zonghe_yue']['zong']['sy']; ?>
</p>
                </li>
                
                 <li>
                  <h3>月度点评</h3>
                  <p><?php echo $this->_tpl_vars['return']['zonghe_yue']['yue']['content']; ?>
</p>
                </li>
                
              </ul>
            </div>
          </div>
          
          
          
          <div class="go-top-btn" id="go-top-btn" style="display: block;">
            <a href="#topAnchor"><img src="/ffsm/statics/ffsm/bzyy/images/go_top.png" alt="回到顶部"></a></div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--天玄算命网付费测算源码-->
</body>
</html>