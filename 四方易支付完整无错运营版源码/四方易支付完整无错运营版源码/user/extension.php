<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='推广赚钱';
include './head.php';
?>
<?php

?>
   <div id="content" class="app-content" role="main"> 
   <div class="app-content-body "> 
    <div class="bg-light lter b-b wrapper-md hidden-print"> 
     <h1 class="m-n font-thin h3">推广赚钱</h1> 
    </div> 
<!-- 开始统计 -->
 <div class="wrapper"> 
   <div class="col-lg-6 col-md-6"> 
    <div class="panel b-a"> 
     <div class="panel-heading font-bold" style="background:#F5F5F5;">
      我的推广
     </div> 
     <div class="text-center m-b clearfix"> 
      <div class="thumb-lg avatar m-t-n-xl"> 
       <br />
       <img alt="image" class="b b-3x b-white" src="<?php echo ($userrow['qq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>" /> 
      </div> 
     </div> 
     <li class="list-group-item"> <span class="badge btn-default"><font color="#58666E"> 
        <?=$userrow['price']?><code>元</code></font></span> <i class="fa fa-money fa-fw text-muted"></i> 返利佣金  </li>
 <li class="list-group-item"> <span class="badge btn-default"><font color="#58666E"> 
        <?=$userrow['price']?><code>元</code></font></span> <i class="fa fa-check-square-o fa-fw text-muted"></i> 已提佣金  </li>      
     <li class="list-group-item"> <span class="badge btn-default"><font color="#58666E"> <?php 
                    $sth = $DB->query("select count(tid) as count from pay_user where tid='{$pid}'");
			        $num = $sth->fetchColumn();
					echo $num;?> <code>人</code></font></span> <i class="fa fa-users fa-fw text-muted"></i>成功推广</li> 
     <li class="list-group-item"> <span class="badge btn-default"><font color="#58666E"><a title="立即赚钱" target="_blank" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/user/reg.php?id='.$pid; ?>"><?php echo 'http://'.$_SERVER['HTTP_HOST'].'/user/reg.php?id='.$pid; ?></font></span> <i class="fa fa-link fa-fw text-muted"></i>推广链接</li>   
</div>
</div>
   <div class="col-lg-6 col-md-6"> 
    <div class="panel panel-dark"> 
     <div class="panel-heading font-bold" style="background:#F5F5F5;">
      推广成功佣金说明
     </div> 
     <div class="panel-body"> 
      <a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>推广返利正式上线</a> 
      <a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>须知：请勿刷注册，否则将清空推广佣金！</a> 
      <a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>返利：将您的推广链接分享给其他朋友、社区、论坛、博客或者赞助链接、每位通过您的推广链接成功注册的用户、您将获得<code>0.001-1</code>随机金额！推广返利数据统计都是实时的。</a> 
      <a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>说明：虽然显得微不足道，日夜累加，积少成多，您不需要做任何事情就有收入，动动手指就能赚到的钱还需要纠结？别犹豫赶快上车，</a> 
     </div> 
    </div> 
   </div> 
  </div>   


<?php include 'foot.php';?>