<?php
use xh\unity\cog;
use xh\library\url;

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

                <div class="col s12 m12 l12" style="margin-top: 8px;">
                  <div class="row">
                    <form class="col s12" id="from">
     
                      
                      <div class="row">
                        <div class="input-field col s6">
                          <input disabled value="<?php echo $_SESSION['MEMBER']['uid'];?>" id="disabled" type="text" class="validate">
                          <label for="disabled">商户ID</label>
                        </div>
                      </div>
                      
                      <div class="row">
                         <div class="input-field col s6">
                          <input placeholder="需要充值的金额" id="money" name="money" type="text" class="validate" value="1000.00">
                          <label for="money">金额</label>
                        </div>
                      </div>
                      
                      
                      <div class="row" id="input-select">
                       <div class="input-field col s6">
                       <label>支付方式</label>
                    <select id="type">
                      <option value="" disabled selected>请选择一个支付方式</option>
                      <option value="1" selected>微信支付</option>
                      <option value="2">支付宝支付</option>
                    </select>
                  </div></div>
                      
                       <div class="row"><div class="input-field col s4">
                       <a class="btn waves-effect waves-light teal" onclick="payc();">确认充值</a></div>
                      
                       </div>
                       
                       
                    </form>
                    
                    
                  </div>
                </div>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
      <script type="text/javascript">

      function payc(){
    	  window.open('<?php echo url::s("index/member/payResult");?>' + '?type=' + $('#type').val() +'&amount=' + $('#money').val());
		}

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   