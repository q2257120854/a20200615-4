<?php /* Smarty version 2.6.25, created on 2019-01-30 23:25:33
         compiled from index/yuncheng/find.tpl */ ?>
﻿<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<title><?php echo $this->_tpl_vars['row']['des']; ?>
-2019运势</title>
	<meta name="keywords" content="<?php echo $this->_tpl_vars['row']['des']; ?>
-2019运势">
	<meta name="description" content="<?php echo $this->_tpl_vars['row']['des']; ?>
-2019运势">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
	<meta content="telephone=no" name="format-detection"/>
	<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
	<link href="/ffsm/statics/ffsm/aiqingyun/common.css" rel="stylesheet" type="text/css"/>
	<link href="/ffsm/statics/ffsm/aiqingyun/wap.min.css" rel="stylesheet" type="text/css"/>
	<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<div class="contents">
  <div class="wrap">
    <div class="top">
      <img src="/ffsm/statics/ffsm/aiqingyun/img/logo.png" alt="logo">
      <a href="/" class="acommon ahome"></a>
      <a href="/?ac=history" class="acommon atopmenu"></a>
    </div>
<div class="main" id="main">
  <div class="srzl-box yzfzl-box">
    <div class="main-title">
      <span class="csz"></span>
    </div>
    <div class="grxx-box">
      <p class="pinfro">
        <span>姓名:
          <em><?php echo $this->_tpl_vars['row']['data']['username']; ?>
</em></span>
        <span>性别:
          <em><?php if ($this->_tpl_vars['row']['data']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?></em></span>
      </p>
      <p class="pinfro">生辰:
        <em><?php echo $this->_tpl_vars['return']['user']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['return']['user']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['return']['user']['nianling']['d']; ?>
日 <?php if ($this->_tpl_vars['return']['data']['h'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['return']['data']['h']; ?>
<?php endif; ?>时（阳历）</em></p>
      <p class="pinfro">八字:
        <em><?php echo $this->_tpl_vars['return']['info']['nayin']['0']['jiazi']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['jiazi']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['jiazi']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['jiazi']; ?>
</em></p>
      <p class="pinfro">纳音:
        <em><?php echo $this->_tpl_vars['return']['info']['nayin']['0']['layin']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['layin']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['layin']; ?>
-<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['layin']; ?>
</em></p>  
        
    </div>
  </div>
  <div class="box">
    <div class="sec-title">2019爱情综合运势</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">
        
        <p class="ptxt" style="padding-top:25px;"><?php echo $this->_tpl_vars['return']['data']['zonghe']['zt']; ?>
</p></div>
    </div>
  </div>
  
  <div class="box">
    <div class="sec-title">流月运势</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">
        <p class="ptxt" style="padding-top:25px;"><?php echo $this->_tpl_vars['return']['data']['jianyi']['content']; ?>
</p></div>
    </div>
  </div>
  
  
  <div class="box">
    <div class="sec-title">事业运势</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">
        <p class="ptxt" style="padding-top:25px;"><?php echo $this->_tpl_vars['return']['data']['zonghe']['sy']; ?>
</p></div>
    </div>
  </div>
  <div class="box">
    <div class="sec-title">感情运势</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">
        <p class="ptxt" style="padding-top:25px;"><?php echo $this->_tpl_vars['return']['data']['zonghe']['gq']; ?>
</p></div>
    </div>
  </div>
  
  <div class="box">
    <div class="sec-title">健康运势</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">

        <p class="ptxt" style="padding-top:25px;">
        
        <strong style="color:#F00">疾病注意：</strong><?php echo $this->_tpl_vars['return']['data']['xiyongshen']['whbz']['wharr']['whjk']['jb']; ?>
<br>
        <strong style="color:#F00">生活规律：</strong><?php echo $this->_tpl_vars['return']['data']['xiyongshen']['whbz']['wharr']['whjk']['sh']; ?>
<br>
        <br>
        <?php echo $this->_tpl_vars['return']['data']['zonghe']['jk']; ?>
</p></div>
    </div>
  </div>
  <div class="box">
    <div class="sec-title">大师点评</div>
    <div class="borbox">
      <div class="borline"></div>
      <div class="jieguo-txt">
      	<div class="divimg" style="padding-top:20px;">
          <img src="/ffsm/statics/ffsm/aiqingyun/img/zhishu.png" alt=""></div>
      
        <p class="ptxt" style="padding-top:25px;"><?php echo $this->_tpl_vars['return']['data']['dianping']['content']; ?>
</p>
     	
        <strong style="color:#F00"><?php echo $this->_tpl_vars['return']['data']['zonghe']['xingyun']; ?>
</strong><br>   
        
     </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--塔罗占卜付费测算源码-->
</body>
</html>