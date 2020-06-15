<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
use xh\unity\userCog;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo cog::web()['description'];?>">
    <meta name="keywords" content="<?php echo cog::web()['keywords'];?>">
    <title>Fast payment platform - <?php echo cog::web()['name'];?></title>
    <!-- CORE CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
<body>
      <!-- START CONTENT -->
      <section id="content">


        <!--start container-->
        <div class="container">
          <div class="section">

            <!--Input Select-->
            <div class="section">
            
              <div id="input-select" class="row">
                
                <div class="col s12 m8 l9">
                  <div class="input-field col s12">
                    <label>支付宝收款轮训规则</label>
                    <select onchange="update(this);">
                      <option value="" disabled selected>请选择规则</option>
                      <option value="1" <?php if (userCog::read('alipayConfig', $_SESSION['MEMBER']['uid'])['robin'] == 1) echo 'selected';?>>随机支付宝 [<?php echo SYSTEM_VERSION; ?>] - 推荐</option>
                      <option value="2" <?php if (userCog::read('alipayConfig', $_SESSION['MEMBER']['uid'])['robin'] == 2) echo 'selected';?>>实时收款 [<?php echo SYSTEM_VERSION; ?>] - 按照少到多排序</option>
                      <option value="3" <?php if (userCog::read('alipayConfig', $_SESSION['MEMBER']['uid'])['robin'] == 6) echo 'selected';?>>顺序模式 [<?php echo SYSTEM_VERSION; ?>] - 自动顺序选择 - 不推荐</option>
                    </select>
                  </div>
                </div>
                <div class="col s12 m4 l3">
                  <p>
                  <b>轮训技术</b>：一般我们第三方收款对于支付宝都有很大的额度限制，所以我们开通了支付宝轮训技术，轮训能够让支付宝收款的持久能力大幅度增长，那么轮训是什么呢？就好比你有1个支付宝，
                  你每分每秒都有几十个订单在进行支付，这样你的支付宝可能就会被探测到异常收款，那么如果你有10个支付宝，
                  将这几十个订单分配给十个支付宝同时来分担支付任务，这样就可以让支付宝收款的压力得到分担。</p>
                </div>
              </div>
            </div>

        </div>

    </div>
  <!--end container-->

  </section>
  <!-- END CONTENT -->
  
  <script>
  function update(obj){
	  $.get("<?php echo url::s('index/alipay/automaticConfigResult',"robin=");?>" + $(obj).val(), function(result){
	       	 if(result.code == '200'){
		       		   play(['<?php echo FILE_CACHE . '/download/sound/配置更新完成1.mp3';?>']);
		       		   layer.msg(result.msg, {icon: 1});
		              }else{
		            	layer.msg(result.msg, {icon: 2});
		         }
	   		});
  }
  </script>

  <?php include_once (PATH_VIEW . 'common/footer.php');?>    