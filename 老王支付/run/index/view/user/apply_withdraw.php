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
    <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
</head>
<body>
    <!-- START CONTENT -->
      <section id="content">


        <!--start container-->
        <div class="container">

                <div class="col s12 m12 l12" style="margin-top: 8px;">
                  <div class="row">
                    <form class="col s12" id="from">
                  
                      <?php if ($_SESSION['MEMBER']['bank']['type'] == 1){?>
                      <div class="row">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" type="text" class="validate" value="<?php echo $_SESSION['MEMBER']['bank']['name'];?>" disabled>
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="支付宝账号"  type="text" class="validate" value="<?php echo $_SESSION['MEMBER']['bank']['card'];?>" disabled>
                          <label>支付宝账号</label>
                        </div>
                      </div>
                      <?php }?>
                      
                      <?php if ($_SESSION['MEMBER']['bank']['type'] == 2){?>
                      <div class="row">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" name="bank_name" type="text" class="validate" value="<?php echo $_SESSION['MEMBER']['bank']['name'];?>" disabled>
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder="银行" name="bank" type="text" class="validate" value="<?php echo $_SESSION['MEMBER']['bank']['bank'];?>" disabled>
                          <label>银行名称</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="银行卡号" name="card" type="text" class="validate" value="<?php echo $_SESSION['MEMBER']['bank']['card'];?>" disabled>
                          <label>银行卡号</label>
                        </div>
                      </div>
                      <?php }?>
                      
                      
                      <div class="row">
                         <div class="input-field col s3">
                          <input placeholder="需要提现的金额" id="amount" name="amount" type="text" class="validate" value="1000.00">
                          <label>金额</label>
                        </div>
                        <div class="input-field col s4" style="margin-top: 38px;">可提现余额： <b style="color: red;"><?php echo $_SESSION['MEMBER']['money'];?></b></div>
                      </div>
                      
                    
                      
                     
                      
                       <div class="row"><div class="input-field col s4">
                       <a class="btn waves-effect waves-light teal" onclick="apply();">确认提现</a></div></div>
                      
                      
                    </form>
                    
                    
                  </div>
                </div>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
      <script type="text/javascript">

      function apply(){
			$.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('index/member/applyWithdrawResult');?>",
		          data: $('#from').serialize(),
		          success: function (data) {
		              if(data.code == '200'){
		            	  play(['<?php echo FILE_CACHE . "/download/sound/提现成功1.mp3";?>']);
		            	  layer.msg(data.msg, {icon: 1});
		              }else{
		            	  if(data.code == "-39"){
			            	  play(['<?php echo FILE_CACHE . "/download/sound/验证码错误1.mp3";?>']);
				          }
			              if(data.code == "-89"){
			            	  play(['<?php echo FILE_CACHE . "/download/sound/提现余额不足1.mp3";?>']);
				          }
		            	  layer.msg(data.msg, {icon: 2});
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
		           }
		  });
		}

      //获取验证码
      function getCode(obj){
	  $.get("<?php echo url::s('index/member/applyCode');?>", function(result){
	       	 if(result.code == '200'){
		       		   play(['<?php echo FILE_CACHE . "/download/sound/验证码已发送1.mp3";?>']);
		       	       settime($(obj));
		       		   layer.msg(result.msg, {icon: 1});
		              }else{
		               layer.msg(result.msg, {icon: 2});
		         }
	   		});
  }

      var countdown=90;
      
      function settime(obj) { //发送验证码倒计时
    	    if (countdown == 0) { 
    	        obj.attr('disabled',false); 
    	        //obj.removeattr("disabled"); 
    	        obj.text("重新获取");
    	        countdown = 60;
    	        return;
    	    } else { 
    	        obj.attr('disabled',true);
    	        obj.text("重新获取(" + countdown + ")");
    	        countdown--;
    	    } 
    	setTimeout(function() { 
    	    settime(obj) }
    	    ,1000);
    	}

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   