 
<? $nav='cz';
//if ($site_ispay==0) { die ('未开通'); }

 

if ($site_zfms==0)
{ $zfurl='/alipay/alipayapi.php';  }
else
{ $zfurl='/sdk/epayapi.php';  }


 
 
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>在线充值-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://assets.19sky.cn/member/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="http://assets.19sky.cn/member/css/font-awesome.min.css" rel="stylesheet">

    <!-- ionicons -->
    <link href="http://assets.19sky.cn/member/css/ionicons.min.css" rel="stylesheet">

    <!-- Morris -->
    <link href="http://assets.19sky.cn/member/css/morris.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="http://assets.19sky.cn/member/css/datepicker.css" rel="stylesheet"/>

    <!-- Animate -->
    <link href="http://assets.19sky.cn/member/css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="http://assets.19sky.cn/member/css/owl.carousel.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Simplify -->
    <link href="http://assets.19sky.cn/member/css/simplify.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/bootstrap-switch.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="http://assets.19sky.cn/member/css/toastr.min.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!-- Jquery -->
    <script src="http://assets.19sky.cn/member/js/jquery-1.11.1.min.js"></script>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
	
	.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
	
    </style>
    <script>
function sum() {
	var n1 = document.getElementById("czje").value;
	var n2 = document.getElementById("sxf").value;
 
	document.getElementById("payInput").value = parseInt(n1)+parseInt(n1)*(parseInt(n2)/100);
}
</script>
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

    <? require_once('m_left.php');?>



   <div class="main-container">
        <div class="padding-md" id="pjax-container">
           
<div  >
  <? if ($site_ispay==1) {?> 
    <div class="alert alert-success alert-custom ">
        <div class="text-danger"><i class="fa fa-volume-up"></i><strong>提示：充值有疑问请联系站长！QQ3301200869</strong></div>
    </div>
 
    		<form action="<?=$zfurl?>" class="alipayform" method="post"    name="subform" id="subform" target="_blank">
<input name="act" type="hidden" value="cz">

<input name="zid" type="hidden" value="<?=$zhu_id?>">
<input name="fid" type="hidden" value="<?=$fen_id?>">
<input name="hyid" type="hidden" value="<?=$member_id?>">
<input name="hyname" type="hidden" value="<?=$member_name?>">
<input name="sxf" id="sxf" type="hidden" value="<?=$site_czsxf?>">
 
    <div class="row">
                <div class="col-md-6">
            <div class="user-widget user-widget2">
                <div class="user-widget-body bg-success">
                    <img src="/images/rmb.jpg" alt="">
                    <div class="user-detail">
                        <div class="m-top-sm text-warning">在线余额充值</div>
                        <div class="small-text text-white">当前余额：<?=$member_point?> 元 充值手续费<?=$site_czsxf?>%</div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="input-group">
                            <span class="input-group-addon">充值</span>
                            <input name="WIDtotal_fee" type="number"    onchange="sum();"  id="czje" class="form-control" placeholder="输入充值金额"
                                   value=""   />
                            <span class="input-group-addon">元</span>
                        </div>
                    </div>
                    
                    <div class="list-group-item">
                        <div class="input-group">
                            <span class="input-group-addon">支付</span>
                            <input class="form-control" disabled id="payInput" value="">
                            <span class="input-group-addon">元</span>
                        </div>
                    </div>
                       <? if ($site_zfms==1) {?>
                          <div class="list-group-item">
                        <div class="input-group">
                            <span class="input-group-addon">方式</span>
                            <select  class="form-control"  name="type">
                              <option value="alipay"> 支付宝</option>
                              <option value="wxpay">微信支付</option>
                              <option value="qqpay">QQ支付</option>
                            </select>
                            
                        </div>
                    </div>
                    
                    <? }?>
                    
                    <div class="list-group-item">
                        <a class="btn btn-info btn-block" onClick="document.getElementById('subform').submit();return false">充值</a>
                    </div>
                </div>
            </div>
        </div>    
        </form>
        
		<? }?>
     <? if ($_POST['一卡通']=='充值')
 	 {
{	 null_back($_POST['km'],'请输入充值卡卡密'); }
 		 
 
 	  $sel="select * from ".flag."kami where kahao = '".$_POST['km']."'  and zt =0   and zid = ".$zhu_id."   ";
  $sl=@mysql_query($sel);
  $s=@mysql_fetch_array($sl);
  if (is_array($s)){
  
 
	$sql1 = 'update '.flag.'kami set zt=1,hyid='.$member_id.',hyname="'.$member_name.'",cdate="'.$sj.'" where ID = '.$s['ID'].' and  zid = '.$zhu_id.'  ';
	 mysql_query($sql1);
	 
  //增加余额
     $_data['point'] = $member_point+$s['point']; 
     //  $_data['s_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where id = '.$member_id.' and  zid = '.$zhu_id.' ';
	 mysql_query($sql);
	 
	   //增加消费记录
	$_data1['hyid'] = $member_id;
	$_data1['hyname'] = $member_name;
 	$_data1['xf_qje'] = $member_point;
 	$_data1['xf_je'] = $s['point'];
 	$_data1['xf_hje'] = $member_point+$s['point'];
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_qk'] ='使用充值卡充值';  
  	$_data1['xf_lx'] =1;  //0是扣除
  	$_data1['zid'] =$zhu_id;  //

if ($fen=='true')
  {	$_data1['fid'] =$fen_id; } //


   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	

  
	alert_href('充值成功','');  		
		  }
  
  else
  {
	     echo "<script language=\"javascript\"> alert ('充值失败:卡密不正确或已被充值!');</script>";
   }
		 
		 }?>
     <form method="post">
       <div class="col-md-6">
            <div class="user-widget user-widget2">
                <div class="user-widget-body bg-success" style="min-height: 89px;">
                    <img src="/images/ykt.jpg" alt="">
                    <div class="user-detail">
                        <div class="m-top-sm text-warning">社区一卡通充值</div>
                        <div class="small-text text-white"></div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <input name="km" type="text" class="form-control" placeholder="输入社区一卡通充值卡卡密" id="km">
                    </div>
                    <div class="list-group-item" style="min-height: 56px;line-height: 25px;text-align: center">
                        注意：社区一卡通卡密只能一次性充值！
                    </div>
                    <div class="list-group-item">
                         <input name="一卡通"  class="btn btn-info btn-block"  type="submit" value="充值">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


        <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="smart-widget-header">
                    在线支付订单列表
                    <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="widget-refresh-option load-data-btn">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-hidden-section">
                        <ul class="widget-color-list clearfix">
                            <li style="background-color:#20232b;" data-color="widget-dark"></li>
                            <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                            <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                            <li style="background-color:#2baab1;" data-color="widget-green"></li>
                            <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                            <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                            <li style="background-color:#e36159;" data-color="widget-red"></li>
                            <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                            <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                            <li style="background-color:#fff;" data-color="reset"></li>
                        </ul>
                    </div>
                    <div class="list-group-item bg-grey" style="overflow: hidden;">
                        <form id="subform1" class="form-inline"  method="post" name="subform1" role="form">
                            <div class="form-group">
                                  <select name="zt" class="form-control">
                                    <option <? if ($_GET['zt']==""){echo "selected";}?>  value="">所有</option>
                                    <option <? if ($_GET['zt']=="0"){echo "selected";}?> value="0">待支付</option>
                                    <option<? if ($_GET['zt']=="1"){echo "selected";}?>   value="1">已支付</option>
                                </select>
                            </div>
                          
                            <div class="form-group">
                                <input type="text" name="qk" class="form-control" v-model="search.orderid" placeholder="订单号">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="jyh"  placeholder="交易号">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform1').submit();return false"     ></i> 搜索</a>
                        </form>
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>充值金额</th>
                                <th>手续费</th>
                                <th>状态</th>
                                <th>交易号</th>
                                <th>支付时间</th>
                                <th>生成时间</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
if ($zhu=='true'){							  
//所有条件						 
  if ( $_POST['zt']!='' and   $_POST['qk']!='' and  $_POST['jyh']!=''   )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_POST['zt'].'  and  dingdanhao='.$_POST['qk'].'    and jiaoyihao ='.$_GET['jyh'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'  order by ID desc , ID desc';}
//只看状态
elseif ( $_POST['zt']!='' and   $_POST['qk']=='' and  $_POST['jyh']==''   )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_POST['zt'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'  order by ID desc , ID desc';}
//只看订单号
elseif ( $_POST['zt']=='' and   $_POST['qk']!='' and  $_POST['jyh']==''   )	 
{	  $sql = 'select * from '.flag.'czjl where   dingdanhao='.$_POST['qk'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'  order by ID desc , ID desc';}
//只看交易号
elseif ( $_POST['zt']=='' and   $_POST['qk']=='' and  $_POST['jyh']!=''   )	 
{	  $sql = 'select * from '.flag.'czjl where   jiaoyihao='.$_POST['jyh'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'  order by ID desc , ID desc';}
  //空						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']==''    and  $_GET['jyh']==''    )	 
{	  $sql = 'select * from '.flag.'czjl  where hyid = '.$member_id.'  and zid = '.$zhu_id.' order by ID desc , ID desc';}

}
else
{

//所有条件						 
  if ( $_POST['zt']!='' and   $_POST['qk']!='' and  $_POST['jyh']!=''   )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_POST['zt'].'  and  dingdanhao='.$_POST['qk'].'    and jiaoyihao ='.$_GET['jyh'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'  and fid = '.$fen_id.'   order by ID desc , ID desc';}
//只看状态
elseif ( $_POST['zt']!='' and   $_POST['qk']=='' and  $_POST['jyh']==''   )	 
{	  $sql = 'select * from '.flag.'czjl where   zt='.$_POST['zt'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'   and fid = '.$fen_id.' order by ID desc , ID desc';}
//只看订单号
elseif ( $_POST['zt']=='' and   $_POST['qk']!='' and  $_POST['jyh']==''   )	 
{	  $sql = 'select * from '.flag.'czjl where   dingdanhao='.$_POST['qk'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'   and fid = '.$fen_id.' order by ID desc , ID desc';}
//只看交易号
elseif ( $_POST['zt']=='' and   $_POST['qk']=='' and  $_POST['jyh']!=''   )	 
{	  $sql = 'select * from '.flag.'czjl where   jiaoyihao='.$_POST['jyh'].'  and   hyid = '.$member_id.' and  zid = '.$zhu_id.'   and fid = '.$fen_id.' order by ID desc , ID desc';}
  //空						 
  elseif ( $_GET['zt']=='' and   $_GET['qk']==''    and  $_GET['jyh']==''    )	 
{	  $sql = 'select * from '.flag.'czjl  where hyid = '.$member_id.'  and zid = '.$zhu_id.'  and fid = '.$fen_id.' order by ID desc , ID desc';}

}
  								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                            <tr v-for="record in list">
                                <td><?=$row['dingdanhao']?></td>
                                <td>￥<?=$row['je']?></td>
                                <td><?=$row['sxf']?></td>
                            <td>
                           <? if ($site_zfms=='yzf')
						      {$ercz="target='_blank' href='/sdk/pay.php?dingdanhao=".$row['dingdanhao']."'";}
							  
						   ?> 
                            
							<? if ($row['zt']==0) {echo "<a ".$ercz."  ><span class='text-info'>待支付</span></a>";}?><? if ($row['zt']==1) {echo "<span class='text-success'>已支付</span>";}?></td>

                                <td><?=$row['jiaoyihao']?></td>
                                <td><?=$row['pdate']?></td>
                                <td><?=$row['date']?></td>
                              </tr>
                            <? }?>
                            </tbody>
                        </table>
                        <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div></div>
                    <div class="smart-widget-footer text-center">
                        <pagination ref="pagination" :total="total" :current_page="search.page"
                                    :page_size="search.pageSize"
                                    @page-phange="pageChange"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
 
    <div class="modal" id="modal-pay">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onClick="clearInterval(paySh);"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>等待支付完成</h4></div>
                </div>
                <div class="modal-body">
                    <div class="panel panel-info">
                        <div class="panel-heading">请完成支付</div>
                        <div class="panel-body">
                            <div id="qrcode" class="text-center"></div>
                            <h3 class="text-success text-center"><i class="fa fa-rmb"></i> {{ pay.rmb }} 元
                            </h3>
                            <h6 class="text-danger text-center" style="display: none;" id="payInfo">
                                商品价格:{{ pay.price }} 元，支付手续费:{{ pay.sxf }}元，实际需支付:{{ pay.rmb }} 元。
                            </h6>
                            <h3 class="text-warning text-center">{{ pay.msg }}</h3>
                            <h5 class="text-info text-center">支付中<span id="payLoad"></span></h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal" onClick="clearInterval(paySh);">
                        关闭
                    </button>
                    <a class="btn btn-primary" :href="pay.url" id="go_to_pay" style="display: none;"
                       target="_blank">去支付</a>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div><!-- /main-container -->


 <? require_once('m_footer.php');?>
  <? 
				  function xiaoyewl_pape($t0, $t1, $t2, $t3) {
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
	$page_start = $page_current - $page_len;
	if ($page_start <= 0) {
		$page_start = 1;
		$page_end = $page_start + $page_end;
	}
	$page_end = $page_current + $page_len;
	if ($page_end > $page_sum) {
		$page_end = $page_sum;
	}
	$page_link = $_SERVER['REQUEST_URI'];
	$tmp_arr = parse_url($page_link);
	if (isset($tmp_arr['query'])){
		$url = $tmp_arr['path'];
		$query = $tmp_arr['query'];
		parse_str($query, $arr);
		unset($arr[$page_parameter]);
		if (count($arr) != 0){
			$page_link = $url.'?'.http_build_query($arr).'&';
		}else{
			$page_link = $url.'?';
		}
	}else{
		$page_link = $page_link.'?';
	}
	$page_back = '';
	$page_home = '';
	$page_list = '';
	$page_last = '';
	$page_next = '';
	$tmp = '';
	if ($page_current > $page_len + 1) {
		$page_home = ' <li class="disabled page-item"><a class="page-link" href="'.$page_link.$page_parameter.'=1" title="首页">首页</a></li>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<li class="page-item"><a class="page-link" href="'.$page_link.$page_parameter.'='.($page_current - 1).'" title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$page_sum.'"  class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="'.$page_link.$page_parameter.'='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


?> 
</body>
</html>
