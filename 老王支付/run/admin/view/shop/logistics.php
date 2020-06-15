<?php
use xh\unity\cog;
use xh\library\url;
use xh\unity\dictionary;
$fix = DB_PREFIX;
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

              
                
     		
                  <?php if ($shop['category'] == 2){?>
                     
             
                          <textarea id="textarea" class="materialize-textarea" style="width:100%;height:760px;"><?php 
                          $list = json_decode($result['ship'],true);
                          $hwid = '';
                          foreach ($list as $card){
                              $hwid .= '卡号：' . $card['card'];
                              if (!empty($card['pwd'])){
                                  $hwid .= '----' . '卡密：' . $card['pwd'] . PHP_EOL;
                              }else {
                                  $hwid .= PHP_EOL;
                              }
                          }
                          echo trim($hwid,PHP_EOL);
                          ?></textarea>
                        
                   
                  <?php }?>
                    

     
        </div>
        <!--end container-->
      <script type="text/javascript">
      function changeFrameHeight(){
          var ifm= document.getElementById("mainiframe");
          ifm.height=document.documentElement.clientHeight-56;
      }
      window.onresize=function(){ changeFrameHeight();}
      $(function(){changeFrameHeight();});
      </script>
      </section>
      <!-- END CONTENT -->
    