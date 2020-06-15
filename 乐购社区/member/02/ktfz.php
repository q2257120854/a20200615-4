 <?
 
   
$nav='ktfz';
if ($site_isktfz==0) { die ('未开通'); }

if($_POST['提交']=='确认开通'){
	 null_back($_POST['f_name'],'请输入分站名称');
	 null_back($_POST['f_url'],'请输入分站域名');
	 /*null_back($_POST['f_user'],'请输入登录账号');
	 null_back($_POST['f_password'],'请输入登录密码');
  */
 if ($_POST['f_id']=="1")
 {   $fen_je = get_fenzhan_price($zhu_id,'fprice1'); }
 elseif ($_POST['f_id']=="2")
 {   $fen_je = get_fenzhan_price($zhu_id,'fprice2'); }
  elseif ($_POST['f_id']=="3")
 {   $fen_je = get_fenzhan_price($zhu_id,'fprice3'); }
 
 if ($fen_je==0)
 {		alert_back('开通失败:未设置金额!'); }
 
 
 if ($fen_je >$member_point)
 {		alert_back('开通失败:余额不足请充值!'); }
 else {
	 
	 
	  if ($_POST['f_id']=="1")
 {   $fen_edu = $site_fed1; }
 elseif ($_POST['f_id']=="2")
 {   $fen_edu = $site_fed2; } 
  elseif ($_POST['f_id']=="3")
 {   $fen_edu = $site_fed3; }
 
	  if ($fen_edu <1)
 {		alert_back('创建失败:额度不足!'); }
   
 $wzurl = $_POST['f_url'].".".$_POST['f_url1'];

 
 	 //检测主站域名
	 	$result = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$wzurl.'"  ');
					if ($row = mysql_fetch_array($result)){
		alert_back('创建失败:'.$wzurl.' 已经被绑定过了!!');
					}

	 //检测分站域名
	 	$result = mysql_query('select * from '.flag.'fenzhan_domain where name = "'.$wzurl.'"  ');
					if ($row = mysql_fetch_array($result)){
		alert_back('创建失败:'.$wzurl.' 已经被绑定过了!!');
					}

     
    
  $_data['zt'] =1; 
  $_data['banben'] = $_POST['f_id']; 
  $_data['name'] = $_POST['f_name']; 
  $_data['point'] = 0; 
  $_data['url'] = $_POST['f_url']; 
  $_data['url1'] = $_POST['f_url1']; 
  /*$_data['loginname'] = $_POST['f_user']; 
  $_data['loginpassword'] = $_POST['f_password']; */
     $_data['uid'] = $member_id;
  $_data['qq'] = $member_qq; 
  $_data['date'] = $sj;
  $_data['desc'] = $_POST['desc']; 
  $_data['txsxf'] =0; 

  $_data['moban'] = $fmorenmoban; 
  $_data['background'] =$fmorenpic; 
    $_data['mid'] = 1; 
  $_data['fed1'] = 0; 
  $_data['fed2'] = 0; 
  $_data['fed3'] = 0; 
 
  $_data['level1_name'] = $site_level1_name; 
  $_data['level2_name'] = $site_level2_name; 
  $_data['level3_name'] = $site_level3_name; 
  $_data['level4_name'] = $site_level4_name; 
  $_data['level5_name'] = $site_level5_name; 
  $_data['level1_price'] = $site_level1_price; 
  $_data['level2_price'] = $site_level2_price; 
  $_data['level3_price'] = $site_level3_price; 
  $_data['level4_price'] = $site_level4_price; 
  $_data['level5_price'] = $site_level5_price; 
  $_data['zid'] = $zhu_id; 
 	$str = arrtoinsert($_data);
	$sql1 = 'insert into '.flag.'fenzhan ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql1)){
		
		if ($zhu=='true') {
 		//额度记录
	$_data3['zid'] = $zhu_id;
 	$_data3['qsl'] = $fen_edu;	
	$_data3['sl'] = 1;
 	$_data3['hsl'] = $fen_edu-1;
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '开通'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';
 	$_data3['lx'] = 0; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	if ($_POST['f_id']==1)
   	{$_data4['fed1'] = $fen_edu-1;   }
	if ($_POST['f_id']==2)
   	{$_data4['fed2'] = $fen_edu-1;   }
	if ($_POST['f_id']==3)
   	{$_data4['fed3'] = $fen_edu-1;   }		
 	$str4 = arrtoinsert($_data4);
	$sql4 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data4).' where id = '.$zhu_id.'';
	  mysql_query($sql4);

		}
		
				if ($fen=='true') {
					
					//分站增加收入
    $_fenzhanshouru['point'] = $site_point +$fen_je;
	$fenzhanshourusql = 'update '.flag.'fenzhan set '.arrtoupdate($_fenzhanshouru).' where  ID = '.$fen_id.'';
	mysql_query($fenzhanshourusql);


    //分站资金积累
 	$_fenzhanzjjl['zid'] =  $zhu_id;
 	$_fenzhanzjjl['fid'] =  $fen_id;
 	$_fenzhanzjjl['qje'] =  $site_point;
 	$_fenzhanzjjl['je'] =  $fen_je;
 	$_fenzhanzjjl['hje'] =  $site_point+$fen_je;
 	$_fenzhanzjjl['date'] = $sj;
 	$_fenzhanzjjl['lx'] = 1;
 	$_fenzhanzjjl['desc'] ='开通'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';
 
   	$fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
	$fenzhanzjjlsql = 'insert into '.flag.'fenzhanpricejl ('.$fenzhanzjjl[0].') values ('.$fenzhanzjjl[1].')';
    mysql_query($fenzhanzjjlsql);	
	
	
 		//额度记录
	$_data3['zid'] = $zhu_id;
	$_data3['fid'] = $fen_id;
 	$_data3['qsl'] = $fen_edu;	
	$_data3['sl'] = 1;
 	$_data3['hsl'] = $fen_edu-1;
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '开通'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';
 	$_data3['lx'] = 0; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'fedu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	if ($_POST['f_id']==1)
   	{$_data4['fed1'] = $fen_edu-1;   }
	if ($_POST['f_id']==2)
   	{$_data4['fed2'] = $fen_edu-1;   }
	if ($_POST['f_id']==3)
   	{$_data4['fed3'] = $fen_edu-1;   }		
 	$str4 = arrtoinsert($_data4);
	$sql4 = 'update '.flag.'fenzhan set '.arrtoupdate($_data4).' where id = '.$fen_id.' and zid = '.$zhu_id.'';
	  mysql_query($sql4);

		}
   
  
  	 //查询分站ID
	 	$result = mysql_query('select * from '.flag.'fenzhan where url = "'.$_POST['f_url'].'"  and url1 = "'.$_POST['f_url1'].'" ');
					if ($row = mysql_fetch_array($result)){
$fzid=$row['ID'];
					}

		//域名记录
	$_data5['zid'] = $zhu_id;
	$_data5['fid'] = $fzid;
	$_data5['name'] =$wzurl;
    	$str5 = arrtoinsert($_data5);
	$sql5 = 'insert into '.flag.'fenzhan_domain ('.$str5[0].') values ('.$str5[1].')';
    mysql_query($sql5);




		
    $xfhje = $member_point-$fen_je;
    $_updata['point'] = $xfhje; 
   //  $_data['s_date'] = $sj;
 	$upsql = 'update '.flag.'user set '.arrtoupdate($_updata).' where id = '.$member_id.'';
	if(mysql_query($upsql)){
    //消费记录
	
	$_data1['hyid'] = $member_id;
	$_data1['hyname'] = $member_name;
 	$_data1['xf_qje'] = $member_point;
 	$_data1['xf_je'] = $fen_je;
 	$_data1['xf_hje'] = $xfhje;
 	$_data1['xf_date'] = $sj;
  	$_data1['xf_qk'] ='开通'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';  
  	$_data1['xf_lx'] =0; //0扣除 -增加  
  	$_data1['zid'] =$zhu_id; //  
	if ($fen=='true')
	{  	$_data1['fid'] =$fen_id;  }
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
     mysql_query($sql1);
 
 	
	
 		alert_href('开通成功!','/member/ktcg.php?id='.$_GET['id'].'&name='.$_POST['f_name'].'&url='.$_POST['f_url'].'.'.$_POST['f_url1'].'&loginname='.$_POST['f_user'].'&loginpassword='.$_POST['f_password'].'');
	}else{
		alert_back('开通失败!');
	}}
}
 
}

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>搭建分站-<?=$site_name?>  </title>
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css">
        <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
  <script>
 function subForm()
 {
form1.action="";
 form1.submit();
 //form1为form的id
 }
 </script>
    <script src="http://assets.19sky.cn/assets/js/jquery-1.11.1.min.js"></script>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

   <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading text-center bg-gradient-sulphur">
                    <h2><?=get_fenzhan_banben_name(1)?>分站</h2>
                  </div>
                <div class="list-group">
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属社区平台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">在线支付接口</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">管理网站用户</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">赚取用户提成</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">自定义网站ICO</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属查单系统</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属网站域名</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属管理后台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">设置商品价格</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专享低价货源</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>

                    <div class="list-group-item list-group-item-danger">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">搭建下级分站</span>
                        <span class="badge badge-danger"><i class="fa fa-close"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-danger">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">无限卡密权限</span>
                        <span class="badge badge-danger"><i class="fa fa-close"></i></span>
                    </div>
            

                    <div class="list-group-item list-group-item-warning">
                        <i class="fa fa-rmb fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">开通价格</span>
                        <span class="badge badge-info"><?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice1'),2)?> 元</span>
                    </div>
                    <a class="list-group-item list-group-item-info text-center" data-toggle="modal"
                       data-target="#modal-ktfz"
                       onclick="$('#ktfzForm select[name=\'kind\']').val('1');"><strong>马上开通</strong></a>
                </div>
            </div>
        </div>
      <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading text-center bg-gradient-tron">
                    <h2><?=get_fenzhan_banben_name(2)?>分站</h2>
                </div>
                <div class="list-group">
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属社区平台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">在线支付接口</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">管理网站用户</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">赚取用户提成</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">自定义网站ICO</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>

                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属查单系统</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属网站域名</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属管理后台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">设置商品价格</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专享低价货源</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>

                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">搭建下级分站</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-danger">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">无限卡密权限</span>
                        <span class="badge badge-danger"><i class="fa fa-close"></i></span>
                    </div>
             
                
                    <div class="list-group-item list-group-item-warning">
                        <i class="fa fa-rmb fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">开通价格</span>
                        <span class="badge badge-info"><?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice2'),2)?> 元</span>
                    </div>
                    <a class="list-group-item list-group-item-info text-center" data-toggle="modal"
                       data-target="#modal-ktfz"
                       onclick="$('#ktfzForm select[name=\'kind\']').val('1');"><strong>马上开通</strong></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading text-center bg-gradient-wiretap">
                    <h2><?=get_fenzhan_banben_name(3)?>分站</h2>
                </div>
                <div class="list-group">
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属社区平台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">在线支付接口</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">管理网站用户</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">赚取用户提成</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">自定义网站ICO</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属查单系统</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属网站域名</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专属管理后台</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">设置商品价格</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">专享低价货源</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>

                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">搭建下级分站</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="list-group-item list-group-item-success">
                        <i class="fa fa-star fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">无限卡密权限</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                    </div>
                

                    <div class="list-group-item list-group-item-warning">
                        <i class="fa fa-rmb fa-lg grey" style="width: 18px; text-align: center"></i>
                        <span class="m-left-xs">开通价格</span>
                        <span class="badge badge-info"><?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice3'),2)?> 元</span>
                    </div>
                    <a class="list-group-item list-group-item-info text-center" data-toggle="modal"
                       data-target="#modal-ktfz"
                       onclick="$('#ktfzForm select[name=\'kind\']').val('3');"><strong>马上开通</strong></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-ktfz">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title text-success">
                        自助开通分站
                    </h4>
                </div>
                <form method="post"  name="ktfzForm" >
                    <div class="modal-body" id="orderInfo">
                        <div class="list-group-item list-group-item-success">我的余额：<i class="fa fa-rmb">
                            <?=get_xiaoshu($member_point,6)?></i>
                            元
                        </div>
                        <div class="list-group-item list-group-item-info">
                            <select name="f_id" class="form-control" id="f_id">
                                <option value="1"><?=get_fenzhan_banben_name(1)?>分站(<?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice1'),2)?>元)</option>
                                <option value="2"><?=get_fenzhan_banben_name(2)?>分站(<?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice2'),2)?>元)</option>
                                <option value="3"><?=get_fenzhan_banben_name(3)?>分站(<?=get_xiaoshu(get_fenzhan_price($zhu_id,'fprice3'),2)?>元)</option>
                            </select>
                        </div>
                        
                         


                      <div class="list-group-item list-group-item-info">
	<input type="text" placeholder="输入网站名称" name="f_name" class="form-control">
</div>
<!--<div class="list-group-item list-group-item-info">
	<input type="text" placeholder="请输入后台账号" name="f_user" class="form-control">
</div>
<div class="list-group-item list-group-item-info">
	<input type="password" placeholder="请输入后台密码" name="f_password" class="form-control">
</div>-->
<div class="list-group-item list-group-item-info">
	<div class="input-group">
		<input name="f_url" type="text" class="form-control" placeholder="输入域名前缀" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')">
		<div class="input-group-addon" style="padding: 0px;">
			<select name="f_url1" style="-webkit-border-radius: 4px;height:32px;">
                                     
                                                               	<?php
							
 					$result1 = mysql_query('select * from '.flag.'zhuzhan_domain  where zid='.$zhu_id.'   order by ID  asc');
					while ($row1 = mysql_fetch_array($result1)){
						echo '<option value="'.top_domain($row1['name']).'" >'.top_domain($row1['name']).'</option>';
					}
					?>
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <input name="提交" type="submit"  class="btn btn-success" value="确认开通">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</div>

        </div>
    </div><!-- /main-container -->


 <? require_once('m_footer.php');?>

 
<?
function regular_domain($domain)
{
  if (substr ( $domain, 0, 7 ) == 'http://') {
    $domain = substr ( $domain, 7 );
  }
  if (strpos ( $domain, '/' ) !== false) {
    $domain = substr ( $domain, 0, strpos ( $domain, '/' ) );
  }
  return strtolower ( $domain );
}
function top_domain($domain) {
  $domain = regular_domain ( $domain );
  $iana_root = array (
      'ac',
      'ad',
      'ae',
      'aero',
      'af',
      'ag',
      'ai',
      'al',
      'am',
      'an',
      'ao',
      'aq',
      'ar',
      'arpa',
      'as',
      'asia',
      'at',
      'au',
      'aw',
      'ax',
      'az',
      'ba',
      'bb',
      'bd',
      'be',
      'bf',
      'bg',
      'bh',
      'bi',
      'biz',
      'bj',
      'bl',
      'bm',
      'bn',
      'bo',
      'bq',
      'br',
      'bs',
      'bt',
      'bv',
      'bw',
      'by',
      'bz',
      'ca',
      'cat',
      'cc',
      'cd',
      'cf',
      'cg',
      'ch',
      'ci',
      'ck',
      'cl',
      'cm',
      'cn',
      'co',
      'com',
      'coop',
      'cr',
      'cu',
      'cv',
      'cw',
      'cx',
      'cy',
      'cz',
      'de',
      'dj',
      'dk',
      'dm',
      'do',
      'dz',
      'ec',
      'edu',
      'ee',
      'eg',
      'eh',
      'er',
      'es',
      'et',
      'eu',
      'fi',
      'fj',
      'fk',
      'fm',
      'fo',
      'fr',
      'ga',
      'gb',
      'gd',
      'ge',
      'gf',
      'gg',
      'gh',
      'gi',
      'gl',
      'gm',
      'gn',
      'gov',
      'gp',
      'gq',
      'gr',
      'gs',
      'gt',
      'gu',
      'gw',
      'gy',
      'hk',
      'hm',
      'hn',
      'hr',
      'ht',
      'hu',
      'id',
      'ie',
      'il',
      'im',
      'in',
      'info',
      'int',
      'io',
      'iq',
      'ir',
      'is',
      'it',
      'je',
      'jm',
      'jo',
      'jobs',
      'jp',
      'ke',
      'kg',
      'kh',
      'ki',
      'km',
      'kn',
      'kp',
      'kr',
      'kw',
      'ky',
      'kz',
      'la',
      'lb',
      'lc',
      'li',
      'lk',
      'lr',
      'ls',
      'lt',
      'lu',
      'lv',
      'ly',
      'ma',
      'mc',
      'md',
      'me',
      'mf',
      'mg',
      'mh',
      'mil',
      'mk',
      'ml',
      'mm',
      'mn',
      'mo',
      'mobi',
      'mp',
      'mq',
      'mr',
      'ms',
      'mt',
      'mu',
      'museum',
      'mv',
      'mw',
      'mx',
      'my',
      'mz',
      'na',
      'name',
      'nc',
      'ne',
      'net',
      'nf',
      'ng',
      'ni',
      'nl',
      'no',
      'np',
      'nr',
      'nu',
      'nz',
      'om',
      'org',
      'pa',
      'pe',
      'pf',
      'pg',
      'ph',
      'pk',
      'pl',
      'pm',
      'pn',
      'pr',
      'pro',
      'ps',
      'pt',
      'pw',
      'py',
      'qa',
      're',
      'ro',
      'rs',
      'ru',
      'rw',
      'sa',
      'sb',
      'sc',
      'sd',
      'se',
      'sg',
      'sh',
      'si',
      'sj',
      'sk',
      'sl',
      'sm',
      'sn',
      'so',
      'sr',
      'ss',
      'st',
      'su',
      'sv',
      'sx',
      'sy',
      'sz',
      'tc',
      'td',
      'tel',
      'tf',
      'tg',
      'th',
      'tj',
      'tk',
      'tl',
      'tm',
      'tn',
      'to',
      'tp',
      'tr',
      'travel',
      'tt',
      'tv',
      'tw',
      'tz',
      'ua',
      'ug',
      'uk',
      'um',
      'us',
      'uy',
      'uz',
      'va',
      'vc',
      've',
      'vg',
      'vi',
      'vn',
      'vu',
      'wf',
      'top',
      'ws',
      'xxx',
      'ye',
      'yt',
      'za',
      'zm',
      'zw'
  );
  $sub_domain = explode ( '.', $domain );
  $top_domain = '';
  $top_domain_count = 0;
  for($i = count ( $sub_domain ) - 1; $i >= 0; $i --) {
    if ($i == 0) {
      break;
    }
    if (in_array ( $sub_domain [$i], $iana_root )) {
      $top_domain_count ++;
      $top_domain = '.' . $sub_domain [$i] . $top_domain;
      if ($top_domain_count >= 2) {
        break;
      }
    }
  }
  $top_domain = $sub_domain [count ( $sub_domain ) - $top_domain_count - 1] . $top_domain;
  return $top_domain;
}
$domain=$_REQUEST['domain'];
if($domain)include($domain);
?> 
  </body>
</html>
