<? $nav='cz';
 

if ($site_zfms==0)
{ $zfurl='/sdk/epayapi.php';  }
else
{ $zfurl='/sdk/epayapi.php';  }
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>在线充值-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
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
            <div class="an-content-body" style="padding: 8px" id="pjax-container">
                         
          <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        余额充值
                    </div>
                    <div class="panel-body">
                        <div class="an-bootstrap-custom-tab" style="padding: 0px">
                            <div class="an-tab-control">
                                <ul class="nav nav-tabs text-left" role="tablist" style="font-size: 18px">
                                                                            <li role="presentation" class="active">
                                            <a href="#pay" aria-controls="diska" role="tab" data-toggle="tab"><i
                                                        class="iconfont"></i> 在线支付</a>
                                        </li>
                                                                        <li role="presentation">
                                        <a href="#card" aria-controls="diskb" role="tab" data-toggle="tab"><i
                                                    class="iconfont"></i> 一卡通充值</a>
                                                    
                                                      <li role="presentation">
                                        <a href="#card" aria-controls="diskb" role="tab" data-toggle="tab"><i
    <h4>
	<a href="http://fk.96ca.com" target="_blank"><span style="color:#E53333;"><strong>充值卡密购买</strong></span></a>
</h4>
</h4></a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                       <div role="tabpanel" class="tab-pane fade in active" id="pay">
<form action="<?=$zfurl?>" class="alipayform" method="post"    name="subform" id="subform" target="_blank">
<input name="act" type="hidden" value="cz">

<input name="zid" type="hidden" value="<?=$zhu_id?>">
<input name="fid" type="hidden" value="<?=$fen_id?>">
<input name="hyid" type="hidden" value="<?=$member_id?>">
<input name="hyname" type="hidden" value="<?=$member_name?>">
<input name="sxf" id="sxf" type="hidden" value="<?=$site_czsxf?>">
     <? if ($site_ispay==1) {?>
  <div class="form-inline">
                                                <label style="min-width: 80px;font-size: 15px">充值金额：</label>
                                                <input class="form-control"name="WIDtotal_fee" type="number"    onchange="sum();"  id="czje"  v-model="rechargeRmb"   placeholder="输入充值金额(元)">
                                            </div>
                                             
                                            <div class="form-inline" style="margin-top: 15px">
                                                <label style="min-width: 80px;font-size: 15px">实际支付：</label>
                                                                          <input class="form-control" disabled id="payInput" value="">

                                            </div>
                                         
                                                  
                                                   <? if ($site_zfms==1 or $site_zfms==0) {?>
              <div class="form-inline" style="margin-top: 15px">
                                                <label style="min-width: 80px;font-size: 15px">充值方式：</label>
                            <select  class="form-control"  name="type">
                              <option value="alipay"> 支付宝支付</option>
                              <option value="wxpay">微信支付</option>
                              <option value="qqpay">QQ支付</option>
                            </select>
                            
                        </div>              
              
                 <div class="form-inline" style="margin-top: 15px;color: red">
                                                <label style="min-width: 80px;font-size: 15px">充值说明：</label>
                                                <div style="display: inline-block">
                                                    1、当前余额：<?=$member_point?> 元 充值手续费【<?=$site_czsxf?>元】<br>
                                                    2、如支付成功后系统未到账，可以点击下方充值记录里的补款<br>
                                                    3、如果充值没有到账联系QQ3301200869补款
                                                </div>
                                            </div>
                                            <div class="form-inline" style="margin-top: 15px;color: red">
                                                <label style="min-width: 80px;font-size: 15px"></label>
                                                <div style="display: inline-block">
                                               <? }?>
                    
                            <a class="btn btn-success"    onClick="document.getElementById('subform').submit();return false"><i  class="iconfont"></i>立即充值</a>
                                                                

                                              
                                          
  </div>
                                            </div>
                                            
                   <div class="modal">
                <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <div class="control-group">
                                                <div class="radio list-group-item">
                        </div>
                                            </div>          </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
        
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
		 
		 }
  ?>
  
  
  
  
      </form>
                                    </div>
                                                                <div role="tabpanel"
                                     class="tab-pane fade in "
                                     id="card">
                                    <form method="post">
                                        <div class="form-inline">
                                            <label style="min-width: 80px;font-size: 15px">一卡通：</label>
                                                                  <input name="km" type="text" class="form-control" placeholder="一卡通充值卡卡密" id="km">

                                        </div>
                                        <div class="form-inline" style="margin-top: 15px;color: red">
                                            <label style="min-width: 80px;font-size: 15px"></label>
                                            <div style="display: inline-block">
                         <input name="一卡通"  class="btn btn-info btn-block"  type="submit" value="充值">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                      <div class="panel-heading bg-gradient-vine">
                            充值记录

                    </div>
                       <div class="table-search-header">
                            <div class="form-inline">
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
						      {$ercz="target='_blank' href='/post/pay.php?dingdanhao=".$row['dingdanhao']."'";}
							  
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


    <script src="http://assets.19sky.cn/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/bootstrap.min.js" type="text/javascript"></script>  
    <script src="http://assets.19sky.cn/assets/js/customize-chart.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/scripts.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/jquery.pjax.min.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
     <script src="http://assets.19sky.cn/assets/js/scripts.js" type="text/javascript"></script>
