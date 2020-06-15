<?php	  if ($_POST['提交']=='确认购买'){
		  //die;
		 // echo "233";
		          $spkucun = get_kmshop($_GET['id'], $zhu_id);
null_back($_POST['num'],'请输入下单数量');
        //  null_back($_POST['email'],'请输入接收邮箱');
        if ($_POST['email'] != '') {
            $jsemail = $_POST['email'];
        } else {
            $jsemail = $member_qq . "@qq.com";
        }
        if ($_POST['num'] < $s_dnum) {
            alert_href('购买失败:数量不能低于' . $s_dnum . '!', '');
        }
        if ($_POST['num'] > $s_gnum) {
            alert_href('购买失败:数量不能高于' . $s_gnum . '!', '');
        }
        if ($spkucun <= 0) {
            alert_href('购买失败:商品库存不足!', '');
        }
        if ($_POST['num'] > $spkucun) {
            alert_href('购买失败:商品库存不足!', '');
        }
        $pay_price = $s_price * $_POST['num'];
        //实际购买价格
        if ($member_point < $pay_price) {
            alert_href('购买失败:您的余额' . $member_point . '元不足以支付' . $pay_price . '元!', '');
        } else {
            $xfhje = $member_point - $pay_price;
            $_data['point'] = $xfhje;
            //  $_data['s_date'] = $sj;
            $str = arrtoinsert($_data);
            $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $member_id . '';
			
            if (mysql_query($sql)) {
                //消费记录
                $_data1['hyid'] = $member_id;
                $_data1['hyname'] = $member_name;
                $_data1['xf_qje'] = $member_point;
                $_data1['xf_je'] = $pay_price;
                $_data1['xf_hje'] = $xfhje;
                $_data1['xf_date'] = $sj;
                $_data1['xf_qk'] = '购买商品:' . $s_name . '';
                $_data1['xf_lx'] = 0;
                //0扣除 -增加
                $_data1['zid'] = $zhu_id;
                //
                if ($zhu == 'true') {
                    $_data1['fid'] = 0;
                } else {
                    $_data1['fid'] = $fen_id;
                }
                $str1 = arrtoinsert($_data1);
                $sql1 = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                mysql_query($sql1);
                $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                //订单记录
                $_data2['dingdanhao'] = $danhao;
                $_data2['sid'] = $_GET['id'];
                $_data2['sname'] = $s_name;
                $_data2['hyid'] = $member_id;
                $_data2['hyname'] = $member_name;
                $_data2['keyname1'] = '';
                $_data2['key1'] = '';
                $_data2['num'] = $_POST['num'];
                $_data2['price'] = $pay_price;
                $_data2['zt'] = 6;
                // 	$_data2['duijiezt'] =  $s_duijiezt;
                $_data2['date'] = $sj;
                $_data2['zid'] = $zhu_id;
                if ($zhu == 'true') {
                    $_data2['fid'] = 0;
                } else {
                    $_data2['fid'] = $fen_id;
                }
                $str2 = arrtoinsert($_data2);
                $sql2 = 'insert into ' . flag . 'order (' . $str2[0] . ') values (' . $str2[1] . ')';
                mysql_query($sql2);
if ($fen == 'true') {
    //分站增加收入
    $chajia = $jprice * $_GET['num'];
    $_fenzhanshouru['point'] = $site_point + $chajia;
    $fenzhanshourusql = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $fen_id . '';
    mysql_query($fenzhanshourusql);
    //分站资金积累
    $_fenzhanzjjl['zid'] = $zhu_id;
    $_fenzhanzjjl['fid'] = $fen_id;
    $_fenzhanzjjl['qje'] = $site_point;
    $_fenzhanzjjl['je'] = $chajia;
    $_fenzhanzjjl['hje'] = $site_point + $chajia;
    $_fenzhanzjjl['date'] = $sj;
    $_fenzhanzjjl['lx'] = 1;
    $_fenzhanzjjl['desc'] = '售出商品:' . $s_name;
    $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
    $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
    mysql_query($fenzhanzjjlsql);
#上级提成
        if ($up_banben == 1) {
            $chajiaa = $chajia2*$_POST['num'];
            $_fenzhanshouru['point'] = $up_point + $chajiaa;
            $xy3 = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $up_id . '';
            if(!mysql_query($xy3))die('错误: ' . mysql_error());
            #die($xy3);
            //分站资金积累
            $_fenzhanzjjl['zid'] = $zhu_id;
            $_fenzhanzjjl['fid'] = $up_id;
            $_fenzhanzjjl['qje'] = $up_point;
            $_fenzhanzjjl['je'] = $chajiaa;
            $_fenzhanzjjl['hje'] = $up_point + $chajiaa;
            $_fenzhanzjjl['date'] = $sj;
            $_fenzhanzjjl['lx'] = 1;
            $_fenzhanzjjl['desc'] = '下级提成:' . $s_name;
            $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
            $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
            if(!mysql_query($fenzhanzjjlsql))die('错误: ' . mysql_error());
            # die($fenzhanzjjlsql);
        }
#上级结束
}
                //查询卡密并取出
                $result = mysql_query('select  *  from ' . flag . 'shopkm  where sid= ' . $_GET['id'] . ' and zt = 0 and zid = ' . $zhu_id . '    order by ID asc  limit ' . $_POST['num'] . ' ');
                $x = 0;
                while ($row = mysql_fetch_array($result)) {
                    $x++;
                    $kmsql = 'update  ' . flag . 'shopkm set zt = 1,hyid=' . $member_id . ',hyname="' . $member_name . '",pdate="' . $sj . '"  where ID = ' . $row['ID'] . ' ';
                    mysql_query($kmsql);
                    $kahao = $kahao . $row['kahao'] . "<br>";
                    //die (json1('发送成功,请检查邮箱!'));
                }
				//die('<script type="text/javascript">alert("购买成功");window.location.href="#"</script>');
                /*
$smtpserver = $site_smtp;
                //SMTP服务器
                $smtpserverport = 25;
                //SMTP服务器端口
                $smtpusermail = $site_emailuser;
                //SMTP服务器的用户邮箱
                $smtpemailto = $jsemail;
                //发送给谁
                $smtpuser = $site_emailuser;
                //SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
                $smtppass = $site_emailpassword;
                //SMTP服务器的用户密码
                $mailtitle = $site_name . "自动发货";
                //邮件主题
                $mailcontent = '尊敬的用户:' . $member_name . '<BR>您好,您的购买的商品《' . $s_name . '》，卡密内容为：<BR><font style="font-size:18px;color:#ff9900;"><b>' . $kahao . '</b></font><BR><span style="color:#999;">(该邮件自动发送,无需回复!)</span><br  />    </div>    <div style="border-bottom:1px dashed #CCC; margin:5px 0px; margin-bottom:15px;"></div><div  align="left"  style=";color:#005EAF; font-weight:bold;"> ' . $site_name . '<br/>' . date('Y-m-d H:i:s') . '</div> ';
                //邮件内容
                $mailtype = "HTML";
                //邮件格式（HTML/TXT）,TXT为文本邮件
                //************************ 配置信息 ****************************
                $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
                //这里面的一个true是表示使用身份验证,否则不使用身份验证.
                $smtp->debug = false;
                //是否显示发送的调试信息
                $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
                if ($state == "") {
                    alert_href('购买成功但发信失败!', '0');
                    exit;
                }
*/
                alert_href('购买成功!', '');
            } else {
				//die('<script type="text/javascript">alert("购买失败");window.location.href="#"</script>');
                alert_href('购买失败!', '');
            }
        }
	  }
	   $nav='pay';?>
 <!DOCTYPE html>
<html lang="en">
<head>
 <title><?=$s_name?>-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>" type="image/x-icon" />
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
    <link href="/template/01/assets/common/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="/template/01/assets/common/toastr/toastr.min.css">
      <!-- Jquery -->
    <script src="http://assets.19sky.cn/member/js/jquery-1.11.1.min.js"></script>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
     <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
     </script>
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

    <? require_once('m_left.php');?>



   <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div class="alert alert-success alert-custom ">
    <div><i class="fa fa-volume-up"></i><strong>说明：</strong></div>
  <?=$s_content?></div>
<div class="row">
    <div class="col-lg-6">
        <div class="smart-widget widget-blue" style="min-height: 265px">
            <div class="smart-widget-header">
                <?=$s_name?>                <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
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
                <div class="smart-widget-body">
                    <div class="list-group">
 
                        <div class="list-group-item">账号：<?=$member_name?>[编号:<?=$member_id?>]</div>
                        <div class="list-group-item">等级：<?=$member_level?>
                        <? if ($site_isktdl==1){?>
                          <span class="btn btn-xs btn-success" data-toggle="modal"
                                          data-target="#modal-power">升级</span>
<? }?>
                        </div>
                        <div class="list-group-item">
                            余额：<span id=""><?=get_xiaoshu($member_point,6)?></span> 元
                            <span class="pull-right">
                                 <a class="btn btn-xs btn-info" href="/home/pay/id/<?=$_GET['id']?>.html">充值</a>
                            </span>
                        </div>
                        
                        <div class="list-group-item list-group-item-success">
                            库存：<span id=""><?=get_kmshop($_GET['id'],$zhu_id) ?></span>/<?=$s_unit?>                        </div>
                            
                            <div class="list-group-item list-group-item-success">
                            价格：<span id=""><?=$s_price?></span> 元 / <?=$s_unit?>                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-lg-6">
        <div class="smart-widget widget-purple" style="min-height: 265px;">
            <div class="smart-widget-header">
                卡密购买专区
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
                <div class="smart-widget-body">
                    <form class="form-horizontal" id="orderForm" method="post">
                        
                         <div class="form-group">
                            <div class="col-xs-12">
                                <input name="num" type="number" class="form-control"
                                        onchange="$('#orderRmb').val(('<?=$s_price?>'*this.value).toFixed(6));"
                                       placeholder="输入购买数量(<?=$s_dnum?>-<?=$s_gnum?>)">
                            </div>
                        </div>
                        
                            <div class="form-group">
                            <div class="col-xs-12">
                                <input name="email" type="email" class="form-control"
                                     
                                    value="<?=$member_qq?>@qq.com"     placeholder="接收邮箱/不输入默认取当前QQ邮箱">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">价格</span>
                                    <input class="form-control" value="0" id="orderRmb" disabled>
                                    <span class="input-group-addon">元</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12"><input type="hidden" name="提交" value="确认购买">
                                <button     type="submit" id="order_btn" class="btn btn-success btn-block">确认购买</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-green">
                <div class="smart-widget-header">
                    购买记录
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
                      <form id="subform" name="subform"  method="post"    action="" class="form-inline"   >
                        <input name="id" type="hidden" value="<?=$_GET['id']?>">
                            <input type="text" class="hidden" disabled>
                         
                            <select class="form-control" onChange="MM_jumpMenu('parent',this,0)">
                                     <?php
					 
						$result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.'  order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option   <? if ($_GET['id']==$row['ID']) {echo "selected";}?>   value="/index/home/order/id/<?=$row['ID']?>.html"><?=$row['name']?></option>
                                                <? }?> 
                                    
                                     
                          </select>
                          
                          
                            <script type="text/javascript" src="/js/adddate.js" ></script> 

                            <div class="form-group">
                                 <input type="text"  value="<?=$_POST['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择购买时间">
                            </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_POST['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择购买时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>卡密信息</th>
                            <th>购买时间</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
						  
 					  
	{					  
//无任何条件搜索 
 if (    $_POST['date1']=='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'shopkm where hyid  ='.$member_id.' and sid ='.$_GET['id'].'  order by ID desc , ID desc';}
 //只看时间
elseif (   $_POST['date1']!='' and  $_POST['date2']!=''      )	 
{	  $sql = 'select * from '.flag.'shopkm where hyid  ='.$member_id.' and sid ='.$_POST['id'].'  and pdate >= "'.$_POST['date1'].'" and  pdate <= "'.$_POST['date2'].'"      order by ID desc , ID desc';}

 //只看单个时间
elseif (    $_POST['date1']!='' and  $_POST['date2']==''      )	 
{	  $sql = 'select * from '.flag.'shopkm where hyid  ='.$member_id.' and sid ='.$_POST['id'].'  and pdate <= "'.$_POST['date1'].'"     order by ID desc , ID desc';}

 
	}
 


 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $dingdanhao=str_replace($_POST['key'],"<font color=red> ".$_POST['key']."</font>",$row['dingdanhao']);

 							?>
                          <tr>
                           
                            <td> <?=$row['kahao']?></td>
                            <td> <?=$row['pdate']?></td>
                           </tr>
                          <? }?>
                        </tbody>
                      </table>
                      <div class="smart-widget-footer text-center">
                        <nav class="text-center">
                          <ul class="pagination" style="display: -webkit-inline-box;">
                            <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>
                          </ul>
                        </nav>
                      </div>
                  </div>
                     </div>
                      </div>
                       </div>
                        </div>
                         </div>
                          </div> </div>
                   
             
                
          <div class="modal" id="modal-power">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>升级代理</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="levelForm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">选择升级代理</label>
                        <div class="col-lg-8">
                            <select name="power" class="form-control">
                      <option value="1"><?=$site_level1_name?>(<?=$site_level1_price?>元)</option>
                     <option value="2"><?=$site_level2_name?>(<?=$site_level2_price?>元)</option>
                     <option value="3"><?=$site_level3_name?>(<?=$site_level3_price?>元)</option>
                     <option value="4"><?=$site_level4_name?>(<?=$site_level4_price?>元)</option>
                     <option value="5"><?=$site_level5_name?>(<?=$site_level5_price?>元)</option>
                                                            </select>
                        </div>
                    </div>
           
            </div>
            <div class="modal-footer">
 
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
<input name="确定"   class="btn btn-primary"  id="level_btn" type="button" value="提交">
             </div>
                   </form>
        </div>
    </div>
</div>


    
   
 <!-- /main-container -->

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
		$page_back = '<li class="page-item"><a class="page-link" href="/home/order/id/'.$_GET['id'].'-'.($page_current - 1).'.html"  title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a href="/home/order/id/'.$_GET['id'].'-'.($i).'.html" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="/home/order/id/'.$_GET['id'].'-'.($page_sum).'.html" class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="/home/order/id/'.$_GET['id'].'-'.($page_current + 1).'.html" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}

 
?> 

<script>
    $("#modal-dialog").modal("show");
</script>
 <script type="text/javascript">
    var action = 'login';
    $(document).ready(function () {
        $("#order_btn").click(function () {
            var data = $("#orderForm").serialize();
            $.klsf.ajax("/ajax.php?act=zidongfahuo&id=<?=$_GET['id']?>", data, function (json) {
                if (json.code === 0) {
                    $.klsf.showMessage(json.message,'success');
                    setTimeout(function () {
                        window.location.href = '';
                    }, 1500);
                } else {
                    $.klsf.showMessage(json.message,'error');
                }
            });
        });
		
	
		        $("#level_btn").click(function () {
            var data = $("#levelForm").serialize();
            $.klsf.ajax("/ajax.php?act=level", data, function (json) {
                if (json.code === 0) {
                    $.klsf.showMessage(json.message,'success');
                    setTimeout(function () {
                        window.location.href = '';
                    }, 1500);
                } else {
                    $.klsf.showMessage(json.message,'error');
                }
            });
        });
		
		
 
		
		
		       

 
    });
    $.klsf.keyup(13, function () {
        $("#" + action + "_btn").click();
    })
</script>

</body>
</html>