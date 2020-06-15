<?php 
use xh\library\mysql;
use xh\library\url;
$mysql = new mysql();
//菜单加载
$menu = $mysql->query("mgt_menu","hide=1");
$view_module = $_SESSION['USER_MGT']['view_module'] != 0 ? explode(',', $_SESSION['USER_MGT']['view_module']) : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title><?php echo WEB_NAME; ?> - 管理系统 v <?php echo SYSTEM_VERSION;?></title>
  <!-- ========== Css Files ========== -->
  <link href="<?php echo URL_VIEW;?>/static/console/css/root.css" rel="stylesheet">
  </head>
  <body>
  <!-- Start Page Loading
  <div class="loading"><img src="<?php echo URL_VIEW;?>/static/console/img/loading.gif" alt="loading-img"></div> -->
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
  <!-- START TOP -->
  <div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
      <a href="<?php echo url::s('admin/index/home');?>" class="logo"><?php echo WEB_NAME; ?></a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->


    <!-- Start Sidepanel Show-Hide Button -->
 
    <!-- End Sidepanel Show-Hide Button -->

    <!-- Start Top Right -->
    <ul class="top-right">
	<?php if (is_array($view_module)){ 
	    $view_module_num = count($view_module);
	?>
    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">快捷操作 <span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list">
    <?php for ($i = 0; $i<$view_module_num;$i++){?>
          <li><a href="#"><i class="fa falist fa-paper-plane-o"></i>快捷访问1</a></li>
    <?php }?>
        </ul>
    </li>
    <?php }?>

  <!--   <li class="link">
      <a href="#" class="notifications">6</a>
    </li> -->

    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><b><?php echo $_SESSION['USER_MGT']['username'];?></b><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
          <li role="presentation" class="dropdown-header">个人</li>
          <li><a href="<?php echo url::s('admin/user/editView');?>"><i class="fa falist fa-wrench"></i>修改资料</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="fa falist fa-lock"></i> 锁定账户</a></li>
          <li><a href="<?php echo url::s('admin/user/out');?>"><i class="fa falist fa-power-off"></i> 安全注销</a></li>
        </ul>
    </li>

    </ul>
    <!-- End Top Right -->

  </div>
  <script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>
  <script type="text/javascript">
      function withdrawNotice(){
          $.get("<?php echo url::s('index/notice/polling');?>", function(result){
              if(result.code == '200'){
                      //提现通知
                  playSound();
              }
          });
      }
      setInterval("withdrawNotice()",2000);
      function playSound()
      {
          var borswer = window.navigator.userAgent.toLowerCase();
          if ( borswer.indexOf( "ie" ) >= 0 )
          {
              //IE内核浏览器
              var strEmbed = '<embed name="embedPlay" src="<?php echo URL_STATIC . "media/withdraw111.mp3";?>" autostart="true" hidden="true" loop="false"></embed>';
              if ( $( "body" ).find( "embed" ).length <= 0 )
                  $( "body" ).append( strEmbed );
              var embed = document.embedPlay;

              //浏览器不支持 audion，则使用 embed 播放
              embed.volume = 100;
              //embed.play();
          } else
          {
              //非IE内核浏览器
              var strAudio = '<audio id="audioPlay" src="<?php echo URL_STATIC . "media/withdraw111.mp3";?>" hidden="true">';
              if ( $( "body" ).find( "audio" ).length <= 0 )
                  $( "body" ).append( strAudio );
              var audio = document.getElementById( "audioPlay" );

              //浏览器支持 audion
              audio.play();
          }
      }
  </script>
  <!-- END TOP -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 