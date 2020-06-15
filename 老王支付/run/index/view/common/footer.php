<?php
use xh\library\url;
?>
 <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START RIGHT SIDEBAR NAV-->


        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->
    
     <!-- jQuery Library -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist 
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.js"></script>   -->
    <!-- chartjs -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart-script.js"></script> -->
    <!-- sparkline -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/sparkline-script.js"></script>
    <!--jvectormap-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/vectormap-script.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
    <!-- Toast Notification -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>  
    <!-- layer -->
    <script src="<?php echo URL_STATIC . 'js/layer/layer.js';?>" charset="utf-8"></script>
    
  	<script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>
  	<?php if ($_SESSION['ADD_GATEWAY'] == 2) echo "<script>play(['" . FILE_CACHE . "/download/sound/多一条支付宝1.mp3']);</script>"; ?>
  	<?php if ($_SESSION['ADD_GATEWAY'] == 1) echo "<script>play(['" . FILE_CACHE . "/download/sound/多一条微信1.mp3']);</script>"; ?>
  	<?php if ($_SESSION['GATEWAY_LOGIN'] == 2) echo "<script>play(['" . FILE_CACHE . "/download/sound/支付宝登录成功1.mp3']);</script>"; ?>
  	<?php if ($_SESSION['GATEWAY_LOGIN'] == 1) echo "<script>play(['" . FILE_CACHE . "/download/sound/微信登录成功1.mp3']);</script>"; ?>
  	<?php unset($_SESSION['ADD_GATEWAY']);unset($_SESSION['GATEWAY_LOGIN']);?>
  	
  	<script type="text/javascript">
	//检测微信订单和支付宝订单并发送萌妹子通知
	function orderNotice(){
		$.get("<?php echo url::s('index/asyc/getOrder');?>", function(result){
	     	 if(result.code == '200'){
		     	 if(result.data != null){
			     		//第三方平台订单通知
		         	 if(result.data.average == '1'){
						//微信
						if(result.data.types == '1'){
							play(['<?php echo FILE_CACHE . "/download/sound/微信订单支付成功1.mp3";?>']);
						}
						//支付宝
						if(result.data.types == '2'){
							play(['<?php echo FILE_CACHE . "/download/sound/支付宝订单支付成功1.mp3";?>']);
						}
			         }else{
						//普通收款订单
				     }
			     }
	           }
	    });
	}
	setInterval("orderNotice()",1000);
	</script>
</body>

</html>
    