<?php
require_once 'system/inc.php';
function myTrim($str)
{
    $search = array(" ", "　", "\n", "\r", "\t");
    $replace = array("", "", "", "", "");
    return str_replace($search, $replace, $str);
}
function alert_json($t0, $t1, $t2)
{
    if ($t2 != '') {
        die('{"code":' . $t1 . ',"message":' . json_encode($t0) . ',"url":"","id":"' . $t2 . '"}');
    } else {
        die('{"code":' . $t1 . ',"message":' . json_encode($t0) . ',"url":""}');
    }
}
//空值返回
function null_alertjson($t0, $t1)
{
    if ($t0 == '') {
        alert_json($t1, '-1');
    }
}
$xiaoyewl_act=$_GET['act'];
switch ($xiaoyewl_act) {
	case 'collect':
	require_once 'data/member.php';
	$arr=array();
	$arr['status']=1;
$hyid=$member_id;
$hyname=$_SESSION['member_name'];
$sid=$_REQUEST['gid'];
if($hyid=='' or $hyname='' or $collect='')$arr['message']='错误，值不能为空';
/*
$get=urldecode(file_get_contents("php://input").'a=a');
$get=str_replace('=','":"',$get);
$get=str_replace('&','","',$get);
$get2='{"'.$get.'"}';
$get=json_decode($get2,true);
$collect=explode(",",$get['gid']);
if(is_array($collect)){
$i=0;
foreach($collect as $row1){
$sid=$collect[$i];
$result = mysql_query('select * from '.flag.'shoucang  where  sid ='.$sid.' and hyid = '.$member_id.' and zid = '.$zhu_id.' ');
if ($row = mysql_fetch_array($result))
{
	$scsql = 'delete from  '.flag.'shoucang where sid = '.$sid.' and zid = '.$zhu_id.''; 
	if(mysql_query($scsql)){
	$arr['status']=0;
	$arr['message']='取消收藏成功';goto scend;
	}else{
	$arr['message']='取消收藏失败'.mysql_error();goto scend;
	}
	}else{ 
 	$_scdate['zid'] = $zhu_id;
 	if($fen_id)$_scdate['fid'] = $fen_id;
 	$_scdate['hyid'] = $hyid;
 	$_scdate['hyname'] = $hyname;
 	$_scdate['sid'] = $sid;
 	$_scdate['date'] = $sj;
   	$scstr = arrtoinsert($_scdate);
	$scsql = 'insert into '.flag.'shoucang ('.$scstr[0].') values ('.$scstr[1].')';
	if(mysql_query($scsql)){
	$arr['status']=0;
	$arr['message']='收藏成功';goto scend;
	}else{
	$arr['message']='收藏失败'.mysql_error();goto scend;
	}
}
$i++;
}
}else
*/
if(1==1){
 $result = mysql_query('select * from '.flag.'shoucang  where  sid ='.$sid.' and hyid = '.$member_id.' and zid = '.$zhu_id.' ');
if ($row = mysql_fetch_array($result))
{
	$scsql = 'delete from  '.flag.'shoucang where sid = '.$sid.' and zid = '.$zhu_id.''; 
	if(mysql_query($scsql)){
	$arr['status']=0;
	$arr['message']='取消收藏成功';
	}else{
	$arr['message']='取消收藏失败';
	}
	}else{ 
 	$_scdate['zid'] = $zhu_id;
 	if($fen_id)$_scdate['fid'] = $fen_id;
 	$_scdate['hyid'] = $hyid;
 	$_scdate['hyname'] = $hyname;
 	$_scdate['sid'] = $sid;
 	$_scdate['date'] = $sj;
   	$scstr = arrtoinsert($_scdate);
	$scsql = 'insert into '.flag.'shoucang ('.$scstr[0].') values ('.$scstr[1].')';
	if(mysql_query($scsql)){
	$arr['status']=0;
	$arr['message']='收藏成功';
	}else{
	$arr['message']='收藏失败';
	}
}
}
scend:
	exit(json_encode($arr));
	break;
	
    case 'clean':
    $timestamp=strtotime('now');
    $flag=flag;
    $cron_lasttime = $DB->get_column("SELECT daily_lasttime FROM {$flag}set WHERE ID='1' limit 1");
    $date=date('Y-m-d H:i:s');
	if(time()-strtotime($cron_lasttime)<3600*12)exit('日常维护任务今天已执行过,当前时间'.$date.'');
	$DB->query("UPDATE {$flag}set SET `daily_lasttime` =  '".$date."' where ID = 1");
	$DB->query("DELETE FROM `{$flag}czjl` WHERE date<'".date("Y-m-d H:i:s",strtotime("-7 days"))."'");
	$sq1 = $DB->affected();
	$DB->query("DELETE FROM `{$flag}czjl` WHERE date<'".date("Y-m-d H:i:s",strtotime("-3 hours"))."' and zt=0");
	$sq2 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `{$flag}czjl`");
	$DB->query("DELETE FROM `{$flag}login_log` WHERE date<'".date("Y-m-d H:i:s",strtotime("-7 days"))."'");
	$sq3 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `{$flag}login_log`");
	$DB->query("DELETE FROM `{$flag}xfjl` WHERE xf_date<'".date("Y-m-d H:i:s",strtotime("-30 days"))."'");
	$sq4 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `{$flag}xfjl`");
	$DB->query("DELETE FROM `{$flag}fenzhanprice` WHERE date<'".date("Y-m-d H:i:s",strtotime("-30 days"))."'");
	$sq5 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `{$flag}fenzhanprice`");
	$DB->query("DELETE FROM `{$flag}edu` WHERE date<'".date("Y-m-d H:i:s",strtotime("-30 days"))."'");
	$sq6 = $DB->affected();
	$DB->query("OPTIMIZE TABLE `{$flag}edu`");
	$count = $sq1+$sq2+$sq3+$sq4+$sq5+$sq6;
	exit('日常维护任务已成功执行，本次共清理'.$count.'条数据,当前时间'.$date.'');
    break;
    case 'zidongfahuo':
        $spkucun = get_kmshop($_GET['id'], $zhu_id);
        null_alertjson($_POST['num'], '请输入购买数量');
        //  null_back($_POST['email'],'请输入接收邮箱');
        if ($_POST['email'] != '') {
            $jsemail = $_POST['email'];
        } else {
            $jsemail = $member_qq . "@qq.com";
        }
        if ($_POST['num'] < $s_dnum) {
            alert_href('购买失败:数量不能低于' . $s_dnum . '!', '-1');
        }
        if ($_POST['num'] > $s_gnum) {
            alert_href('购买失败:数量不能高于' . $s_gnum . '!', '-1');
        }
        if ($spkucun <= 0) {
            alert_href('购买失败:商品库存不足!', '-1');
        }
        if ($_POST['num'] > $spkucun) {
            alert_href('购买失败:商品库存不足!', '-1');
        }
        $pay_price = $s_price * $_POST['num'];
        //实际购买价格
        if ($member_point < $pay_price) {
            alert_href('购买失败:您的余额' . $member_point . '元不足以支付' . $pay_price . '元!', '-1');
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
                    $chajia = $jprice * $_POST['num'];
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
                alert_href('购买成功!', '0');
            } else {
                alert_href('购买失败!', '-1');
            }
        }
        break;
    //QQ登录绑定
    case 'qqlogin':
        null_alertjson($_POST['m_name'], '请输入用户名');
        null_alertjson($_POST['m_password'], '请输入用户密码');
        if ($zhu == 'true') {
            $sel = "select * from  " . flag . "user where name = '" . $_POST['m_name'] . "'  and  password = '" . md5($_POST['m_password']) . "' and zid = " . $zhu_id . "    ";
        } else {
            $sel = "select * from  " . flag . "user where name = '" . $_POST['m_name'] . "'  and  password = '" . md5($_POST['m_password']) . "' and zid = " . $zhu_id . " and fid = " . $fen_id . "    ";
        }
        $sl = @mysql_query($sel);
        $s = @mysql_fetch_array($sl);
        if (is_array($s)) {
            if ($s['qqid'] != '') {
                alert_href('绑定失败:该用户已被其他QQ绑定请重新输入!', '-1');
            } else {
                session_start();
                $_SESSION['login_name'] = $_POST['m_name'];
                $_SESSION['km_name'] = "";
                $_SESSION['login_time'] = time();
                //setcookie('member_name',$_POST['m_name']);
                $_data1['qqid'] = $_POST['qqid'];
                $sql1 = 'update ' . flag . 'user set ' . arrtoupdate($_data1) . ' where ID = ' . $s['ID'] . ' and zid  =' . $zhu_id . '';
                mysql_query($sql1);
                $data['hyname'] = $_POST['m_name'];
                $data['hyid'] = $s['ID'];
                $data['ip'] = xiaoyewl_ip();
                $data['date'] = date('y-m-d h:i:s', time());
                $data['qk'] = 'QQ登录绑定';
                $data['zid'] = $zhu_id;
                $data['desc'] = $shengfen . " " . $shi;
                $str = arrtoinsert($data);
                $sql = 'insert into ' . flag . 'login_log (' . $str[0] . ') values (' . $str[1] . ')';
                mysql_query($sql);
                alert_href('登录绑定成功!', '0');
            }
        } else {
            alert_href('登录失败:,用户名或密码不正确!', '-1');
        }
        break;
    //QQ登录注册绑定
    case 'qqreg':
        null_alertjson($_POST['m_name'], '请输入用户名');
        null_alertjson($_POST['m_password'], '请输入用户密码');
        null_alertjson($_POST['m_qq'], '请输入QQ');
        null_alertjson($_POST['m_key'], '请输入验证码');
        $pdyzm = "verifycode";
        if ($_SESSION[$pdyzm] != $_POST['m_key']) {
            alert_json('验证码不正确!', '-1');
        }
        $sel = "select * from  " . flag . "user where name = '" . $_POST['m_name'] . "'  and zid = " . $zhu_id . "   ";
        $sl = @mysql_query($sel);
        $s = @mysql_fetch_array($sl);
        if (is_array($s)) {
            alert_json('注册失败:' . $_POST['m_name'] . '已被注册!', '-1');
        } else {
            $_data['name'] = $_POST['m_name'];
            $_data['password'] = md5($_POST['m_password']);
            $_data['qq'] = $_POST['m_qq'];
            $_data['qqid'] = $_POST['qqid'];
            $_data['gonghuo'] = 0;
            $_data['gpoint'] = 0;
            $_data['point'] = 0;
            $_data['level'] = $site_mid;
            $_data['date'] = $sj;
            $_data['zid'] = $zhu_id;
            if ($zhu == 'true') {
                $_data['fid'] = 0;
            } else {
                $_data['fid'] = $fen_id;
            }
            $str = arrtoinsert($_data);
            $sql = 'insert into ' . flag . 'user (' . $str[0] . ') values (' . $str[1] . ')';
            if (mysql_query($sql)) {
                session_start();
                $_SESSION['login_name'] = $_POST['m_name'];
                $_SESSION['km_name'] = "";
                $_SESSION['login_time'] = time();
                //setcookie('member_name',$_POST['m_name']);
                $data['hyname'] = $_POST['m_name'];
                $data['hyid'] = mysql_insert_id();
                $data['ip'] = xiaoyewl_ip();
                $data['date'] = date('y-m-d h:i:s', time());
                $data['qk'] = 'QQ注册绑定';
                $data['zid'] = $zhu_id;
                $data['desc'] = $shengfen . " " . $shi;
                $str = arrtoinsert($data);
                $sql = 'insert into ' . flag . 'login_log (' . $str[0] . ') values (' . $str[1] . ')';
                mysql_query($sql);
                alert_json('注册绑定成功!!', '0');
            } else {
                alert_json('注册失败!', '-1');
            }
        }
        break;
		
		case 'pricejk':
		$api='http://api.skywl.cc/api.php?';
		$code=-1;
		$msg='修改失败';
		if($_GET['key']!=$site_jkms)$msg='监控密匙错误';
		$i=0;
		while($site_jkcid[$i]!=''){
		
		$cid=$site_jkcid[$i];
		$sql = 'select * from '.flag.'shop where cid = '.$site_jkcid[$i].'   and  zt = 1  and zid = ' . $zhu_id . ' ';
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
$s_duijie = $row['duijie'];//社区id
$s_duijiesid = $row['duijiesid'];//对接商品id
$ID=$row['ID'];
$sql = 'select * from ' . flag . 'duijie where id = ' . $s_duijie . ' and zid = ' . $zhu_id . ' ';
$result = mysql_query($sql);
if (!!($row = mysql_fetch_array($result))) {
    $pingtai = $row['pingtai'];
    $loginname = $row['loginname'];
    $loginpassword = $row['loginpassword'];
    $duijieurl = $row['url'];
	$price = $row['price'];
}else{$msg='找不到社区';}
            if ($pingtai == 1) {//同系统
             $sqlp = 'select * from '.flag.'shop where cid = '.$s_duijiesid.'  and  zt = 1';
$resultp = mysql_query($sqlp);
$pricep = $rowp['price'];
if($price!=$pricep)$price=$pricep;
$code=0;
	    $msg='修改成功';
            }
            if ($pingtai == 2) {//亿乐2.0
                
            }
            if ($pingtai == 3) {//95
            $arr=jiuwu_goodslist_details($duijieurl,$loginname,$loginpassword);
			if(is_array($arr)){
			$pricep = $arr[$s_duijiesid]['price'];
			if($price!=$pricep)$price=$pricep;
			$code=0;
	    $msg='修改成功';
			}
            }
			if ($pingtai == 4) {//亿乐3.0
            $time = strtotime('now');
        $params0 = array('api_token' => $loginname, 'gid' => $s_duijiesid, 'timestamp' => $time);
        $key0 = $loginpassword;
        $sign0 = getSign($params0, $key0);
        $post_data2 = array('api_token' => $loginname, 'gid' => $s_duijiesid, 'timestamp' => $time, 'sign' => $sign0);
        $list = yilepost('http://' . $duijieurl . '.api.94sq.cn/api/goods/info', $post_data2);
        $arr = json_decode($list, true);
		$pricep = $arr['data']['price'];
		if($price!=$pricep)$price=$pricep;
		$code=0;
	    $msg='修改成功';
            }
			if ($pingtai == 5) {//聚梦
    $time = strtotime('now');
    $params0 = array('username' => $loginname, 'time' => $time);
    $key0 = $loginpassword;
    $sign0 = getSign($params0, $key0);
    $post_data1 = array('username' => $loginname, 'time' => $time, 'sign' => $sign0);
	$post_data1 = http_build_query($post_data1 , '' , '&');
    $yileshoplist = getCurl('http://' . $pingtaiurl . '.api.jumsq.com/Api/UserApi/GoodsList.html', $post_data1);
    $list = getjmshop($yileshoplist);
    $query = json_decode($yileshoplist, true);
		$pricep = $arr['content']['Money'];
		if($price!=$pricep)$price=$pricep;
		$code=0;
	    $msg='修改成功';
            }
}else{$msg='找不到商品';}
    $_data['price'] = $price;
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'shop set '.arrtoupdate($_data).' where id = '.$ID.' and zid = '.$zhu_id.'';
if(!mysql_query($sql)){$msg='修改失败';}
$i=$i+1;
		}
		die('{"code":'.$code.',"message":"' .$msg. '"}');
		break;
}
?>