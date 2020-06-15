<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='用户中心';
include './head.php';
?>
<?php
$orders=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}")->fetchColumn();

$lastday=date("Ymd",strtotime("-1 day")).'00000000000';
$today=date("Ymd").'00000000000';
$order_today['all']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today'")->fetchColumn();

$order_lastday['all']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today'")->fetchColumn();

$order_today['alipay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='alipay'")->fetchColumn();
$order_today['qqpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='qqpay'")->fetchColumn();
$order_today['wxpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='wxpay'")->fetchColumn();

$order_lastday['alipay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='alipay'")->fetchColumn();
$order_lastday['qqpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='qqpay'")->fetchColumn();
$order_lastday['wxpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='wxpay'")->fetchColumn();

$rs=$DB->query("SELECT * from pay_settle where pid={$pid} and status=1");
$settle_money=0;
$max_settle=0;
$chart='';
$i=0;
while($row = $rs->fetch())
{
  $settle_money+=$row['money'];
  if($row['money']>$max_settle)$max_settle=$row['money'];
  if($i<9)$chart.='['.$i.','.$row['money'].'],';
  $i++;
}
/*
结算记录
*/
$numrows=$DB->query("SELECT * from pay_settle WHERE pid={$pid}")->rowCount();
$pagesize=20;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$list=$DB->query("SELECT * FROM pay_settle WHERE pid={$pid} order by id desc limit $offset,$pagesize")->fetchAll();
/*
用户转账
*/
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='zhuan'){
$user=$_POST['id'];
$money=$_POST['money'];
$pass=$_POST['pass'];
if(md5($pass) != $userrow['zpass']){
	exit("<script language='javascript'>alert('支付密码错误！');history.go(-1);</script>");
}elseif($userrow['money'] < $money){
	exit("<script language='javascript'>alert('账户余额不足！');history.go(-1);</script>");
}else{
	$zhuan=$DB->query("update pay_user set money=money+{$money} where id='{$user}'");
	$zhuans=$DB->query("update pay_user set money=money-{$money} where id='{$pid}'");
	if($zhuan and $zhuans){
		exit("<script language='javascript'>alert('转账成功！');history.go(-1);</script>");
	}else{
		exit("<script language='javascript'>alert('转账失败！');history.go(-1);</script>");
	}
}
}

/*
支付方式设置
*/

?>  

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">官方公告</h4>
            </div>
            <div class="modal-body"><?php echo $conf['gg']?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">了解</button>
            </div>
        </div>
    </div>
</div>

<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2><?php echo $conf['web_name']?>
                <small>Welcome to Oreo</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i>主页</a></li>
                    <li class="breadcrumb-item active">商户中心</li>
                </ul>                
            </div>
        </div>
    </div>    
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xl-6 col-lg-7 col-md-12">
                <div class="card profile-header">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="profile-image float-md-right"> <img src="<?php echo ($userrow['qq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/images/profile_av.jpg'?>"> </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12">
                                <h4 class="m-t-0 m-b-0"><strong><?php echo $conf['web_name']?></strong></h4>
                                <span class="job_post">当前时间：<?php echo $showtime=date("Y-m-d H:i:s");?></span>
                                <p>795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                                <div>
                                    <button class="btn btn-primary btn-round"><?php echo $pid?></button>
                                    <button class="btn btn-primary btn-round btn-simple"><?php echo $userrow['username']?></button>
                                </div>
<div class="progress-container progress-primary">
                            <span class="progress-badge">当前:VIP1</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="progress-value">VIP2</span>
                                </div>
                            </div>
                        </div>
                                <p class="social-icon m-t-5 m-b-0">欢迎使用<?php echo $conf['web_name']?></p>
                            </div>                
                        </div>
                   				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label">账号绑定一键登入</label>
					<div class="col-sm-9">
					<?php if(empty($userrow['alipay_uid'])){?>
						<a href="oauth.php?bind=true" class="btn btn-lg btn-info item btn-block" target="_blank">绑定支付宝账号</a>
					<?php }else{?>
						已绑定支付宝UID:<?php echo $userrow['alipay_uid']?>&nbsp;<a href="oauth.php?unbind=true" class="btn btn-danger btn-xs" onclick="return confirm('解绑后将无法通过支付宝一键登录，是否确定解绑？');">解绑账号</a>
                                 <div>
					<?php }?>
					<?php if(empty($userrow['qq_uid'])){?>
						<a href="connect.php?bind=true" class="btn btn-lg btn-info item btn-block" target="_blank">绑定QQ账户</a>
					<?php }else{?>
						已绑定QQ互联Openid:<?php echo $userrow['qq_uid']?>&nbsp;<a href="connect.php?unbind=true" class="btn btn-danger btn-xs" onclick="return confirm('解绑后将无法通过QQ一键登录，是否确定解绑？');">解绑账号</a>
					<?php }?>
					</div>
				</div>
                    </div>                    
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-12">
                <div class="card">
                    <ul class="row profile_state list-unstyled">
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-assignment col-amber"></i>
                                <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo $orders?>" data-speed="1000" data-fresh-interval="700"></h5>
                                <small>订单总数</small>
                            </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-money col-blue"></i>
                                   <h5><?php echo round($order_today['all'],2)?></h5>
                             <!--   <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo round($order_today['all'],2)?>" data-speed="1000" data-fresh-interval="700"></h5> -->
                                <small>今日收入</small>
                            </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-comment-text col-red"></i>
                                <h5><?php echo round($order_lastday['all'],2)?></h5>
                           <!--     <h5 class="m-b-0 number count-to " data-from="0" data-to="<?php echo round($order_lastday['all'],2)?>" data-speed="1000" data-fresh-interval="700"></h5> -->
                                <small>昨日收入</small>
                            </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-account text-success"></i> 
                                <h5 class="m-b-0 number count-to" data-from="0" data-to="<?=$userrow['price']?>" data-speed="1000" data-fresh-interval="700"></h5>
                                <small>推广佣金总计</small>
                            </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-assignment text-info"></i>
                                 <h5><?php echo $settle_money?></h5>
                            <!--    <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo $settle_money?>" data-speed="1000" data-fresh-interval="700"></h5> -->
                                <small>已结算金额</small>
                            </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-6">
                            <div class="body">
                                <i class="zmdi zmdi-money text-warning"></i>
                                 <h5><?php echo $userrow['money']?></h5>
                           <!--     <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo $userrow['money']?>" data-speed="1000" data-fresh-interval="700"></h5> -->
                                <small>当前账户余额</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about">基本资料</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#friends">收入详细</a></li>                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane body active" id="about">
                            <small class="text-muted">邮箱: </small>
                            <p><?php echo $userrow['email']?></p>
                            <hr>
                            <small class="text-muted">QQ: </small>
                            <p><?php echo $userrow['qq']?></p>
                            <hr>
                            <small class="text-muted">姓名: </small>
                            <p><?php echo $userrow['username']?></p>
                            <hr>
                            <small class="text-muted">结算方式: </small>
                            <p class="m-b-0"><?php if ($userrow['settle_id']==1) {
                                echo "支付宝";
                            } elseif ($userrow['settle_id']==2) {
                                echo "微信";
                            }elseif ($userrow['settle_id']==3) {
                                echo "QQ";
                            }elseif ($userrow['settle_id']==4) {
                                echo "银行卡";
                            }
                            ?></p>
                        </div>
                        <div class="tab-pane body" id="friends">
                            <ul class="new_friend_list list-unstyled row">
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/alipay.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">今日</h6>
                                        <small class="join_date"><?php echo round($order_today['alipay'],2)?></small>
                                    </a>
                                </li>
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/qqpay.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">今日</h6>
                                        <small class="join_date"><?php echo round($order_today['qqpay'],2)?></small>
                                    </a>
                                </li>
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/wechat.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">今日</h6>
                                        <small class="join_date"><?php echo round($order_today['wxpay'],2)?></small>
                                    </a>
                                </li>
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/alipay.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">昨日</h6>
                                        <small class="join_date"><?php echo round($order_lastday['alipay'],2)?></small>
                                    </a>
                                </li>
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/qqpay.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">昨日</h6>
                                        <small class="join_date"><?php echo round($order_lastday['qqpay'],2)?></small>
                                    </a>
                                </li>
                                <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                    <a href="">
                                        <img src="./assets/icon/wechat.ico" class="img-thumbnail" alt="User Image">
                                        <h6 class="users_name">昨日</h6>
                                        <small class="join_date"><?php echo round($order_lastday['wxpay'],2)?></small>
                                    </a>
                                </li>                            
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mypost">使用须知</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">结算记录</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">用户转账</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pay">支付方式</a></li>
                         <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tg">推广赚钱</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="mypost">
                        <div class="card">
                    <div class="header">
                        <h2><strong><trans oldtip="Basic Table" newtip="<?php echo $conf['web_name']?>"><?php echo $conf['web_name']?></trans></strong> 使用须知<small><trans oldtip="Basic example without any additional modification classes" newtip="使用<?php echo $conf['web_name']?>前请您花一分钟阅读我" style="">使用<?php echo $conf['web_name']?>前请您花一分钟阅读我</trans></small> </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><trans oldtip="FIRST NAME" newtip="标题">标题</trans></th>
                                    <th><trans oldtip="LAST NAME" newtip="内容" style="">内容</trans></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><trans oldtip="Mark" newtip="123">123</trans></td>
                                    <td><trans oldtip="Otto" newtip="123">123</trans></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><trans oldtip="Jacob" newtip="123">123</trans></td>
                                    <td><trans oldtip="Thornton" newtip="123">123</trans></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="timeline">
                        <div class="card">
                    <div class="header">
                        <h2> <strong><trans oldtip="Striped" newtip="结算记录"><a href="settle.php">结算记录</a></trans></strong><small><trans oldtip=" to add zebra-striping to any table row within the ">这里将展示近期5条结算记录</trans></small> </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th><th>状态</th></tr></thead>
                            <tbody>
                            <?php
foreach($list as $res){
    echo '<tr><td>'.$res['id'].'</td><td>'.$res['account'].'</td><td>￥ <b>'.$res['money'].'</b></td><td>￥ <b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td></tr>';
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="usersettings">
                        <div class="card">
                            <div class="header">
                                <h2><strong>用户转账</strong></h2>
                            </div>
                            <div class="body">
                            	<form class="form-horizontal devform" action="./index.php?my=zhuan" method="POST">
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户ID" style="margin-top:5px" type="text" name="id" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="转账金额" style="margin-top:5px" type="text" name="money" value="" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="支付密码" style="margin-top:5px" type="text" name="pass" value="" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-info btn-round">确认转账</button>   
                                </form>                            
                            </div>
                            </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="tg">
                        <div class="card">
                            <div class="header">
                                <h2><strong>推广赚钱</strong></h2>
                            </div>
                            <div class="body">
                                <div class="form-group">
                                    <h2 class="card-inside-title">返利佣金   <code><?=$userrow['price']?>元</code></h2> 
                                    <h2 class="card-inside-title">成功推广   <code><?php 
                    $sth = $DB->query("select count(tid) as count from pay_user where tid='{$pid}'");
			        $num = $sth->fetchColumn();
					echo $num;?> 人</code></h2>
                                    <h2 class="card-inside-title">推广链接   <code><a title="立即赚钱" target="_blank" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/reg.php?id='.$pid; ?>"><?php echo 'https://'.$_SERVER['HTTP_HOST'].'/reg.php?id='.$pid; ?></a></code></h2>
                                </div>                   
                            </div>
                            </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="pay">
                        <div class="card">
                    <div class="header">
                        <h2><strong><trans>支付方式</trans></strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive social_media_table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><trans>#</trans></th>
                                        <th><trans>名称</trans></th>
                                        <th><trans>状态</trans></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="social_icon "><img src="../assets/icon/alipay.ico" class="img-thumbnail"></span>
                                        </td>
                                        <td><span class="list-name"><trans>支付宝</trans></span></td>
                                        <td><?php if ($userrow['alipay']==1) {
                                           echo "<button class='btn btn-primary btn-round btn-simple'>正常</button>";
                                        }else{
                                            echo "<button class='btn btn-primary btn-round btn-simple'>关闭</button>";
                                        }?>
                                        </td>
                                    <tr>
                                        <td><span class="social_icon"><img src="../assets/icon/qqpay.ico" class="img-thumbnail"></span>
                                        </td>
                                        <td><span class="list-name"><trans>QQ</trans></span>
                                        </td>
                                        <td><?php if ($userrow['qqpay']==1) {
                                           echo "<button class='btn btn-primary btn-round btn-simple'>正常</button>";
                                        }else{
                                            echo "<button class='btn btn-primary btn-round btn-simple'>关闭</button>";
                                        }?></td>
                                    </tr>
                                    <tr>
                                        <td><span class="social_icon"><img src="../assets/icon/wechat.ico" class="img-thumbnail"></span>
                                        </td>
                                        <td><span class="list-name"><trans>微信</trans></span>
                                        </td>
                                        <td><?php if ($userrow['wxpay']==1) {
                                           echo "<button class='btn btn-primary btn-round btn-simple'>正常</button>";
                                        }else{
                                            echo "<button class='btn btn-primary btn-round btn-simple'>关闭</button>";
                                        }?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    </div>

                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
	<?php include 'foot.php';?>
    <script>
$(document).ready(function(){
    $('#myModal').modal('show');
});
</script>