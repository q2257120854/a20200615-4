<?php
require_once '../system/inc.php';
include '../data/function.php';
//获取下单模板
function getmoban($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'moban where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '';
    }
}
function alert_json($t0, $t1)
{
    die('{"code":' . $t1 . ',"message":"' . $t0 . '","url":""}');
}
//空值返回
function null_alertjson($t0, $t1)
{
    if ($t0 == '') {
        alert_json($t1, -1);
    }
}
function non_numeric_alertjson($t0, $t1)
{
    if (!is_numeric($t0) || $t0 < 0) {
        alert_json($t1, -1);
    } else {
        return true;
    }
}
#开始要登录
include('./admin_config.php');
include('./check.php');
$xiaoyewl_act = $_GET['act'];
switch ($xiaoyewl_act) {
    case 'template':
	$arr=array();
	if($_POST['template']){
	$_data['moban1'] = $_POST['template'];
	$_data['sjmb'] = $_POST['m_template'];
	$_data['moban2'] = $_POST['moban2'];
	$_data['moban_reg'] = $_POST['moban3'];//$_POST['moban_reg'];
	$_data['moban_login'] = $_POST['moban3'];
   	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	$arrr = array('""' => "NULL");
    $sql = strtr($sql, $arrr);
	if(mysql_query($sql)){
		$arr['status']=0;
		$arr['message']='操作成功';
	}else{
		$arr['status']=1;
		$arr['message']='操作失败';
	}
	}else{
	$_data['topcolor'] = $_POST['i_color'];
	$_data['endcolor'] = $_POST['i_color1'];
	$_data['ico'] = $_POST['ico'];
	$_data['moban'] = $_POST['s_skin'];
	$_data['background'] = $_POST['s_bj'];
	$_data['dh'] = $_POST['dh'];
	$_data['css'] = $_POST['css'];
   	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	$arrr = array('""' => "NULL");
    $sql = strtr($sql, $arrr);
	if(mysql_query($sql)){
		$arr['status']=0;
		$arr['message']='操作成功';
	}else{
		$arr['status']=1;
		$arr['message']='操作失败';
	}
	}
	die(json_encode($arr));
	break;
    case 'fanghong'://防红
	$end=array();
$arr=getCurl("http://url.482ds.cn/dwz.php?longurl={$_POST['url']}&type={$_POST['type']}");
$arr=json_decode($arr,true);
if($arr['code']==1){
$end['status']=0;
$end['message']=$arr['url'];
}else{
$end['status']=1;
$end['message']=$arr['msg'];
}
die(json_encode($end));
	break;
    case 'getyileGoodsParam'://亿乐商品
	$code=-1;
        $loginname = $_GET['loginname'];
        $loginpassword = $_GET['loginpassword'];
        $url = $_GET['url'];
        $time = strtotime('now');
        $params0 = array('api_token' => $loginname, 'gid' => $_GET['id'], 'timestamp' => $time);
        $key0 = $loginpassword;
        $sign0 = getSign($params0, $key0);
        $post_data2 = array('api_token' => $loginname, 'gid' => $_GET['id'], 'timestamp' => $time, 'sign' => $sign0);
        $post_data2 = http_build_query($post_data2 , '' , '&');
        $list = getCurl('http://' . $url . '.api.94sq.cn/api/goods/info', $post_data2);
        $arr = json_decode($list, true);
		if($arr==''){
			$msg='获取失败'; $code=-1; goto a;
			}else{
			$code=$arr['status'];
		    $minnum = $arr['data']['limit_min'];
            $maxnum = $arr['data']['limit_max'];
            $spic = $arr['data']['image'];
            $name = $arr['data']['name'];
			$content = $arr['data']['desc'];
			$p1 = $arr['data']['price'];
		$msg = $arr['message'];
	if ($arr['data']['inputs'][0][2]!='')
	{   
    $canshu= "value1" ;  
	}
	if ($arr['data']['inputs'][1][2]!='')
	{   
    $canshu=  $canshu."|value2" ;  
	}
	if ($arr['data']['inputs'][2][2]!='')
	{   
    $canshu=  $canshu."|value3" ;  
	}
	if ($arr['data']['inputs'][3][2]!='')
	{   
    $canshu=  $canshu."|value4" ;  
	}
		}
		a:
			$array=array("code"=>$code,"image"=>"$spic","desc"=>"$content","min"=>"$minnum","max"=>"$maxnum","name"=>"$name","price"=>"$p1","message"=>"$msg","canshu"=>"$canshu");
            die(json_encode($array));
        break;
	case 'getjmGoodsParam'://聚梦商品
	$code=-1;
        $loginname = $_GET['loginname'];
        $loginpassword = $_GET['loginpassword'];
        $url = $_GET['url'];
        $time = strtotime('now');
        $params0 = array('username' => $loginname, 'goodsid' => $_GET['id'], 'time' => $time);
        $key0 = $loginpassword;
        $sign0 = getSign($params0, $key0);
        $post_data2 = array('username' => $loginname, 'goodsid' => $_GET['id'], 'time' => $time, 'sign' => $sign0);
		$post_data2 = http_build_query($post_data2 , '' , '&');
        $list = yilepost('http://' . $url . '.api.jumsq.com/Api/UserApi/GoodsInfo.html', $post_data2);
        $arr = json_decode($list, true);
		if($arr==''){
			$msg='获取失败'; $code=-1; goto jm;
			}else{
			$code=0;
		    $minnum = $arr['content']['OrderMin'];
            $maxnum = $arr['content']['OrderMax'];
            $spic = $arr['content']['Img_Url'];
			if(strpos($spic,'http')==false){
			if(substr($spic, 0, 1)!='/'){$spic="http://img.yilep.com/".$spic;}
			else
			{$spic="http://img.yilep.com".$spic;}
			}
            $name = $arr['content']['Name'];
			$content = base64_decode($arr['content']['Notice']);
			$p1 = $arr['content']['Money'];
		$msg = $arr['status'];
			if ($arr['content']['MubanInfo'][0]!='')
	{   
    $canshu= "input1" ;  
	}
	if ($arr['content']['MubanInfo'][1]!='')
	{   
    $canshu=  $canshu."|input2" ;  
	}
	if ($arr['content']['MubanInfo'][2]!='')
	{   
    $canshu=  $canshu."|input3" ;  
	}
	if ($arr['content']['MubanInfo'][3]!='')
	{   
    $canshu=  $canshu."|input4" ;  
	}
		}
		jm:
		$a=json_encode($arr);
			$array=array("code"=>$code,"image"=>"$spic","desc"=>"$content","min"=>"$minnum","max"=>"$maxnum","name"=>"$name","price"=>"$p1","message"=>"$msg","canshu"=>"$canshu","test"=>"$a");
            die(json_encode($array));
        break;
	case 'getjiuwuGoodsParam'://九五商品
	$code=-1;
	$msg='获取失败';
		$minnum = array();
            $maxnum = array();
            $spic = array();
            $name = array();
			$p1 =array();
        $loginname = $_GET['loginname'];
        $loginpassword = $_GET['loginpassword'];
        $url = $_GET['url'];
       // $list = get95sj($url,$loginname,$loginpassword);
                    $loginname = $_GET['loginname'];
                    $loginpassword = $_GET['loginpassword'];
                    $url = $_GET['url'];
                    $id2 = $_GET['id'];
                    $a = jiuwu_goodsparam($url, $id2, $loginname, $loginpassword);
                    if (!is_array($a['code'])) {
                        $msg = $a;
                    }
                    if ($a['code'] != 0) {
                        $msg = $a['msg'];
                    }
                    $post = $a['param'];
	   $list = jiuwu_goodslist_details($url,$loginname,$loginpassword);
	   //$list = getCurl("http://api.skywl.cc/api.php?url={$url}&user={$loginname}&pwd={$loginpassword}&type=jiuwu");
		if(!is_array($list)){
			$msg=$list; 
			$code=-1; 
			goto b;
		}else{
		foreach($list as $xy){
			$id = $xy['id'];
		    $minnum[$id] = $xy['minnum'];
            $maxnum[$id] = $xy['maxnum'];
            $spic[$id] = $xy['shopimg'];
            $name[$id] = $xy['name'];
			$p1[$id] = get_xiaoshu($xy['price'],8);
				$code=0; 
				$msg='获取成功';
		}
		}
		b:
			$array=array("code"=>$code,"image"=>"$spic[$id2]","min"=>"$minnum[$id2]","max"=>"$maxnum[$id2]","name"=>"$name[$id2]","price"=>"$p1[$id2]","message"=>"$msg","post"=>"$post");
            die(json_encode($array));
        break;
    case 'upshopprice'://修改商品价格
        $id = $_POST['id'];
        non_numeric_alertjson($_POST['pid'], '请输入定价模板');
        non_numeric_alertjson($_POST['price'], '请输入商品价格');
        non_numeric_alertjson($_POST['fprice1'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['fprice2'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['fprice3'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['jj'], '请输入分站加价方式');
        $_data['pid'] = $_POST['pid'];
        $_data['price'] = $_POST['price'];
        $_data['fprice1'] = $_POST['fprice1'];
        $_data['fprice2'] = $_POST['fprice2'];
        $_data['fprice3'] = $_POST['fprice3'];
        $_data['jj'] = $_POST['jj'];
        $str = arrtoinsert($_data);
        $sql = 'update ' . flag . 'shop set ' . arrtoupdate($_data) . ' where id = ' . $id . ' and zid = ' . $zhu_id . '';
        if (mysql_query($sql)) {
            $code = 0;
            $msg = '修改成功';
        } else {
            $code = -1;
            $msg = '修改失败';
        }
        die('{"code":' . $code . ',"message":"' . $msg . '"}');
        break;
    case 'upshopprice2'://修改商品价格
        #non_numeric_alertjson($_POST['pid'], '请输入定价模板');
        non_numeric_alertjson($_POST['fprice1'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['fprice2'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['fprice3'], '请输入商品分站价格');
        non_numeric_alertjson($_POST['jj'], '请输入分站加价方式');
		$_POST['pid']=intval($_POST['pid']);
        if($_POST['pid']!='' or $_POST['pid']!=-1  or $_POST['pid']!=NULL){
		if($_POST['pid']>0){
		$_data['pid'] = $_POST['pid'];
		}
		}
        $_data['fprice1'] = $_POST['fprice1'];
        $_data['fprice2'] = $_POST['fprice2'];
        $_data['fprice3'] = $_POST['fprice3'];
        $_data['jj'] = $_POST['jj'];
        $str = arrtoinsert($_data);
        $sql = 'update ' . flag . 'shop set ' . arrtoupdate($_data) . ' where zid = ' . $zhu_id . '';
        if (mysql_query($sql)) {
            $code = 0;
            $msg = '修改成功';
        } else {
            $code = -1;
            $msg = '修改失败'.mysql_error();
        }
        die('{"code":' . $code . ',"message":"' . $msg . '"}');
        break;
    case 'jiankong'://监控
        $pricejk = implode(',', $_POST['pricejk_cid']);
        $_data['pricejk'] = $pricejk;
        $_data['jkms'] = $_POST['code'];
        $str = arrtoinsert($_data);
        $xyd = 'update ' . flag . 'zhuzhan set ' . arrtoupdate($_data) . ' where id = ' . $zhu_id . '';
        if (mysql_query($xyd)) {
            $code = 0;
            $msg = '修改成功';
        } else {
            $code = -1;
            $msg = '修改失败';
        }
        die('{"code":' . $code . ',"message":"' . $msg . '"}');
        break;
    case 'addshop'://添加商品
        null_alertjson($_POST['s_name'], '请输入商品名称');
        non_numeric_alertjson($_POST['s_price'], '请输入商品价格');
        null_alertjson($_POST['s_unit'], '请输入商品单位');
        null_alertjson($_POST['s_pid'], '请选择加价模板');
        null_alertjson($_POST['s_xid'], '请选择下单模板');
        null_alertjson($_POST['jj'], '请选择分站加价方式');
        //数字
        non_numeric_alertjson($_POST['s_dnum'], '请输入最低购买数量');
        non_numeric_alertjson($_POST['s_gnum'], '请输入最高购买数量');
        non_numeric_alertjson($_POST['s_order'], '排序必须是数字');
        non_numeric_alertjson($_POST['s_fprice1'], '请输入' . get_fenzhan_banben_name(1) . '的价格');
        non_numeric_alertjson($_POST['s_fprice2'], '请输入' . get_fenzhan_banben_name(2) . '的价格');
        non_numeric_alertjson($_POST['s_fprice3'], '请输入' . get_fenzhan_banben_name(3) . '的价格');
		null_alertjson($_POST['duijie'], '请选择对接账户!');

        //账户查询
		if($_POST['duijieid']!='自营'){
        $result1 = mysql_query('select * from  ' . flag . 'duijie where id = ' . $_POST['duijieid'] . ' and zid = ' . $zhu_id . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $pingtai = $row['pingtai'];
            $pingtaiurl = $row['url'];
            $loginname = $row['loginname'];
            $loginpassword = $row['loginpassword'];
        }
		}else{
			$pingtai = -1;
		}
        /*null_alertjson($_POST['sid'], '请输入对方商品ID!');
          if ($pingtai == 3) {
              null_alertjson($_POST['sqlx'], '请输入社区类型!');
          }*/
        $result1 = mysql_query('select * from  ' . flag . 'moban where id = ' . $_POST['s_xid'] . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $keyname1 = $row['keyname1'];
            $keyname2 = $row['keyname2'];
            $keyname3 = $row['keyname3'];
            $keyname4 = $row['keyname4'];
            $key1 = $row['key1'];
            $key2 = $row['key2'];
            $key3 = $row['key3'];
            $key4 = $row['key4'];
            $jiuwu1 = $row['dkey1'];
            $jiuwu2 = $row['dkey2'];
            $jiuwu3 = $row['dkey3'];
            $jiuwu4 = $row['dkey4'];
            $yile1 = $row['yile1'];
            $yile2 = $row['yile2'];
            $yile3 = $row['yile3'];
            $yile4 = $row['yile4'];
            $zhuzhan1=$row['key1'];
			$zhuzhan2=$row['key2'];
			$zhuzhan3=$row['key3'];
			$zhuzhan4=$row['key4'];
        }
		/*
        //对接账户查询
        $result1 = mysql_query('select * from  ' . flag . 'duijie where id = ' . $_POST['duijieid'] . ' and zid = ' . $zhu_id . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $dpingtai = $row['pingtai'];
        }
        if ($dpingtai == 1) {
            $result1 = mysql_query('select * from  ' . flag . 'shop where ID = ' . $_POST['duijiesid'] . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $xiadanid = $row['xid'];
        }
		}
		*/
            $dkey1 = $zhuzhan1;
            $dkey2 = $zhuzhan2;
            $dkey3 = $zhuzhan3;
            $dkey4 = $zhuzhan4;
        $_data['duijie'] = $_POST['duijieid'];
        $_data['duijiesid'] = $_POST['duijiesid'];
        $_data['duijiekey1'] = $dkey1;
        $_data['duijiekey2'] = $dkey2;
        $_data['duijiekey3'] = $dkey3;
        $_data['duijiekey4'] = $dkey4;
        if ($_POST['fs'] != '') {
            $_data['duijiefs'] = $_POST['fs'];
        }
        $_data['duijiesqlx'] = $_POST['sqlx'];
        $_data['duijiecgzt'] = $_POST['duijiecgzt'];
        $_data['minnum'] = $_POST['s_dnum'];
        $_data['maxnum'] = $_POST['s_gnum'];
        $_data['pid'] = $_POST['s_pid'];
        $_data['xid'] = $_POST['s_xid'];
        $_data['cid'] = $_POST['s_cid'];
        $_data['pic'] = $_POST['s_pic'];
        $_data['name'] = $_POST['s_name'];
        $_data['unit'] = $_POST['s_unit'];
        $_data['bd'] = $_POST['s_bd'];
        $_data['tk'] = $_POST['s_tk'];
        $_data['price'] = $_POST['s_price'];
        $_data['fprice1'] = $_POST['s_fprice1'];
        $_data['fprice2'] = $_POST['s_fprice2'];
        $_data['fprice3'] = $_POST['s_fprice3'];
        $_data['sorder'] = $_POST['s_order'];
        $_data['content'] = $_POST['s_content'];
        $_data['zt'] = $_POST['s_zt'];
        $_data['iscfxd'] = $_POST['iscfxd'];
        $_data['jj'] = $_POST['jj'];
		 $_data['canshu'] = $_POST['canshu'];
        $_data['date'] = $sj;
        $_data['zid'] = $zhu_id;
        if ($_data['duijie'] == '' or $_data['duijie'] == '自营') {
            $_data['duijie'] = '-1';
        }
        //unset($_data['duijie']);
        if ($_data['duijiesid'] == '') {
            unset($_data['duijiesid']);
        }
        //unset($_data['duijiesid']);
        if ($_data['duijiekey1'] == '') {
            $_data['duijiekey1'] = 'NULL';
        }
        if ($_data['duijiekey2'] == '') {
            $_data['duijiekey2'] = 'NULL';
        }
        if ($_data['duijiekey3'] == '') {
            $_data['duijiekey3'] = 'NULL';
        }
        if ($_data['duijiekey4'] == '') {
            $_data['duijiekey4'] = 'NULL';
        }
        if ($_data['duijiesqlx'] == '') {
            $_data['duijiesqlx'] = 'NULL';
        }
        if ($_data['duijiecgzt'] == '') {
            $_data['duijiecgzt'] = 1;
        }
        $str = arrtoinsert($_data);
        $sql = 'insert into ' . flag . 'shop (' . $str[0] . ') values (' . $str[1] . ')';
		        $arrr = array('""' => "NULL");
        $sql = strtr($sql, $arrr);
        if (mysql_query($sql)) {
            $code = 0;
            $msg = '修改成功';
        } else {
            //die($sql);
            $code = -1;
            $msg = '修改失败' . mysql_error();
        }
        die('{"code":' . $code . ',"message":"' . $msg . '"}');
        break;
    case 'check'://检查克隆
        if ($_POST['url'] == '') {
            json(1, '请输入域名', 1);
        } elseif ($_POST['code'] == '') {
            json(1, '克隆密匙不得为空', 1);
        } elseif ($_POST['url'] == $_SERVER['HTTP_HOST']) {
            json(1, '不得克隆自己的站点', 1);
        }
        kelongapi($_POST['url'], $_POST['code']);
        json(0, '该站点可以连通!', 1);
        break;
    case 'copy':
        if ($_POST['price'] == '') {
            json(1, '价格叠加不得为空', 1);
        }
        if ($_POST['url'] == '') {
            json(1, '请输入域名', 1);
        } elseif ($_POST['code'] == '') {
            json(1, '克隆密匙不得为空', 1);
        } elseif ($_POST['url'] == $_SERVER['HTTP_HOST']) {
            json(1, '不得克隆自己的站点', 1);
        } elseif ($_POST['cid'] == '' and $_POST['pic'] == '') {
          //  json(1, '定价模板或商品分类不得为空!');
        }
        //判断是否已经对接提交的站点
        $sqldj1 = 'SELECT * FROM `' . flag . 'duijie` WHERE `zid` = ' . $zhu_id . ' AND `url` LIKE ';
        $sqldj2 = $_POST['url'];
        $sqldj = $sqldj1 . " " . "'{$sqldj2}'";
        $resultdj = mysql_query($sqldj);
        if (!($rowdj = mysql_fetch_array($resultdj))) {
         //   json(-1, '请先对接这个要克隆的站点');
        }
        kelongapi($_POST['url'], $_POST['code']);
        $data = get_curl("http://" . $_POST['url'] . "/api/kelongapi.php?copy_key={$_POST['code']}&act=copys");
        $json = json_decode($data, true);
        if ($json['code'] == 1) {
            $dataml = $json['data'];
            $datasp = $json['datas'];
            /* if ($dataml == ''){
                   json(-1,'获取目录数据失败');
               }*/
            if ($datasp == '') {
                json(-1, '获取商品数据失败');
            }
				$sql1 = 'delete from '.flag.'shop where zid = '.$zhu_id.'';
	mysql_query($sql1);     
	$sql1 = 'delete from '.flag.'shop_channel where zid = '.$zhu_id.'';
	mysql_query($sql1); 
            // foreach ($dataml as $datas){}
            //var_dump($dataml,$datasp);die;
			//循环写入商品
            foreach ($datasp as $datas1) {
                $_data['zid'] = $zhu_id;
                $_data['pid'] = $_POST['pid'];
                $_data['xid'] = $datas1['1'];
               // $_data['cid'] = $_POST['cid'];
                $_data['bd'] = $datas1['3'];
                $_data['tk'] = $datas1['4'];
                $_data['minnum'] = $datas1['5'];
                $_data['maxnum'] = $datas1['6'];
                $_data['zt'] = $datas1['7'];
                $_data['pic'] = $datas1['8'];
                $_data['name'] = $datas1['9'];
                $_data['unit'] = $datas1['10'];
                $_data['price'] = $datas1['11'] + $_POST['price'];
                $_data['fprice1'] = $datas1['12'] + $_POST['price'];
                $_data['fprice2'] = $datas1['13'] + $_POST['price'];
                $_data['fprice3'] = $datas1['14'] + $_POST['price'];
                $_data['sorder'] = $datas1['15'];
                $_data['content'] = addslashes($datas1['16']);
                $_data['date'] = $sj;
                $_data['duijie'] = $_POST['duijie'];
                $_data['duijiesid'] = $datas1['19'];
				if(!is_numeric($_data['duijiesid'])){unset($_data['duijiesid']);}
                $_data['duijiefs'] = $datas1['20'];
              $_data['duijiefs'] = 1;
                $_data['duijiesqlx'] = '0';
                $_data['duijiekey1'] = $datas1['22'];
                $_data['duijiekey2'] = $datas1['23'];
                $_data['duijiekey3'] = $datas1['24'];
                $_data['duijiekey4'] = $datas1['25'];
                $_data['duijiecgzt'] = $_POST['duijiecgzt'];
                $_data['iscfxd'] = $datas1['29'];
                //$_data['isplxd'] = $datas1['30'];
				$_data['jj'] = $_POST['jj'];
				$_data['canshu'] = $datas1['22'];
                $str = arrtoinsert($_data);
                $sql = 'insert into ' . flag . 'shop (' . $str[0] . ') values (' . $str[1] . ')';
		$arrr = array('""' => "NULL");
        $sql = strtr($sql, $arrr);
                if (mysql_query($sql)) {
                    $ID = mysql_insert_id();
                    $success++;
                } else {
                    $error++;
					$sql1 = 'delete from '.flag.'shop where zid = '.$zhu_id.'';
	mysql_query($sql1);     
	$sql1 = 'delete from '.flag.'shop_channel where zid = '.$zhu_id.'';
	mysql_query($sql1); 
					json(1, '商品克隆出错'.$sql.mysql_error());
                }
			}
			unset($_data);
			unset($str);
            //循环写入目录
              foreach ($dataml as $datas){
                      	$_data['zid'] = $zhu_id;
                      	$_data['name'] = $datas['1'];
                      	$_data['corder'] = $datas['2'];
                      	$_data['zt'] = $datas['3'];
                      	$_data['date'] = $datas['4'];
                      	$str = arrtoinsert($_data);
            			$sql = 'insert into '.flag.'shop_channel ('.$str[0].') values ('.$str[1].')';
                      	if(mysql_query($sql)){
            			$ID = mysql_insert_id();
             			$success1++;
            			}else{
                        $error1++;
						$sql1 = 'delete from '.flag.'shop where zid = '.$zhu_id.'';
	mysql_query($sql1);     
	$sql1 = 'delete from '.flag.'shop_channel where zid = '.$zhu_id.'';
	mysql_query($sql1); 
						json(1, '分类克隆出错'.$sql.mysql_error());
                        }
                    }
            json(0, '成功克隆' . $success . '条');
        } else {
            json(1, '获取数据失败');
        }
        break;
	
	case 'shoplist'://对接商品列表
	$code=-1;
	$msg='获取失败';
//账户查询
$result1 = mysql_query('select * from  ' . flag . 'duijie where id = ' . $_POST['jid'] . ' and zid = ' . $zhu_id . ' ');
if ($row = mysql_fetch_array($result1)) {
    $pingtai = $row['pingtai'];
    $pingtaiurl = $row['url'];
    $loginname = $row['loginname'];
    $loginpassword = $row['loginpassword'];
}else{
	$msg='获取对接失败';
}
if($pingtai==4){
$query=yile_goodslist($pingtaiurl,$loginname,$loginpassword);
/*
$time = strtotime('now');
$params0 = array('api_token' => $loginname, 'timestamp' => $time);
$key0 = $loginpassword;
$sign0 = getSign($params0, $key0);
$post_data1 = array('api_token' => $loginname, 'timestamp' => $time, 'sign' => $sign0);
$yileshoplist = yilepost('http://' . $pingtaiurl . '.api.94sq.cn/api/goods/list', $post_data1);
$list = getyileshop($yileshoplist);
$query = json_decode($yileshoplist, true);
$post_data2 = array('action' => 'getGoodsAndClass', 'collect' => '0');
$list2 = yilepost('http://' . $pingtaiurl . '/ajax', $post_data2);
$query2 = json_decode($list2, true);
*/
if (is_array($query)) {
	$code=0;
    $goods = $query;//['data'];
	#$class = $query2['class'];
	$msg='获取商品成功';
}else{
	$msg=$query;
}
}elseif($pingtai==5){
$query=jumeng_goodslist($pingtaiurl,$loginname,$loginpassword);
	/*
$time = strtotime('now');
$params0 = array('username' => $loginname,'time' => $time);
$key0 = $loginpassword;
$sign0 = getSign($params0, $key0);
$post_data1 = array('username' => $loginname, 'time' => $time, 'sign' => $sign0);
$yileshoplist = yilepost('http://' . $pingtaiurl . '.api.jumsq.com/Api/UserApi/GoodsList.html', $post_data1);
$list = getjmshop($yileshoplist);
$query = json_decode($yileshoplist, true);
*/
if (is_array($query)) {
	$code=0;
    $goods = $query;//['GoodsLit'];
	#$class = $query['ClassList'];
	$msg='获取商品成功';
}else{
	$msg=$query;
}
}else{
	$msg='暂时不支持批量对接';
}
$result=array("status"=>$code,"message"=>"$msg","goods"=>$goods,"class"=>$class);
die(json_encode($result));
	break;
	
	case 'import':

	$cod=-1;
	$get=urldecode(file_get_contents("php://input").'a=a');
$get=str_replace('=','":"',$get);
$get=str_replace('&','","',$get);
$get2='{"'.$get.'"}';
if(!$get=json_decode($get2,true)){json(-1, 'POSTjson解析失败了!');}
    non_numeric_alertjson($_POST['s_pid'], '请选择加价模板');
    non_numeric_alertjson($_POST['s_cid'], '请选择商品分类');
	non_numeric_alertjson($_POST['s_xid'], '请选择下单模板');
    non_numeric_alertjson($_POST['duijiecgzt'], '请输入商品状态');
	$msg='遍历失败';
	$spid=explode(",",$get['gids']);
	if($spid==''){json(-1, '获取商品id失败!');}
	$i=0;
	$xid = $_POST['s_xid'];
    foreach($spid as $row1){
		$msg='遍历成功';
	$s_duijiesid=$spid[$i];
	$time = strtotime('now');
			//账户查询
			$result1 = mysql_query('select * from  '.flag.'duijie where id = '.$_POST['jids'].' and zid = '.$zhu_id.' ');
			 if ($row = mysql_fetch_array($result1)){
				 $dpingtai=$row['pingtai'];
				 $pingtai=$dpingtai;
				 $duijieurl=$row['url'];
				 $loginname=$row['loginname'];
				 $loginpassword=$row['loginpassword'];
			 }else{$msg='获取对接账户失败';}
	if($pingtai==4){
        $params0 = array('api_token' => $loginname, 'gid' => $s_duijiesid, 'timestamp' => $time);
        $key0 = $loginpassword;
        $sign0 = getSign($params0, $key0);
        $post_data2 = array('api_token' => $loginname, 'gid' => $s_duijiesid, 'timestamp' => $time, 'sign' => $sign0);
		$post_data2 = http_build_query($post_data2 , '' , '&');
        $list = yilepost('http://' . $duijieurl . '.api.94sq.cn/api/goods/info', $post_data2);
        if(!$arr = json_decode($list, true)){json(-1, '社区json解析失败了!');}
		if($arr['status']!=0){json(-1, $arr['message']);}
            $xid = $_POST['s_xid'];
            $iscfxd = 0;
            $isbd = 0;
            $istk = 0;
            $minnum = $arr['data']['limit_min'];
            $maxnum = $arr['data']['limit_max'];
            $spic = $arr['data']['image'];
            $name = $arr['data']['name'];
            $unit = '个';
            $pic = $arr['data']['price'];
            $content = $arr['data']['desc'];
            $p1 = $arr['data']['price'];
            $jj = $get['join_price_type'];
            $type=$get['auto_price'];
	if ($arr['data']['inputs'][0][2]!='')
	{   
    $canshu= "value1" ;  
	}
	if ($arr['data']['inputs'][1][2]!='')
	{   
    $canshu=  $canshu."|value2" ;  
	}
	if ($arr['data']['inputs'][2][2]!='')
	{   
    $canshu=  $canshu."|value3" ;  
	}
	if ($arr['data']['inputs'][3][2]!='')
	{   
    $canshu=  $canshu."|value4" ;  
	}
	}
	if($pingtai==5){
        $params0 = array('username' => $loginname, 'goodsid' => $s_duijiesid, 'time' => $time);
        $key0 = $loginpassword;
        $sign0 = getSign($params0, $key0);
        $post_data2 = array('username' => $loginname, 'goodsid' => $s_duijiesid, 'time' => $time, 'sign' => $sign0);
		$post_data2 = http_build_query($post_data2 , '' , '&');
        $list = yilepost('http://' . $duijieurl . '.api.jumsq.com/Api/UserApi/GoodsInfo.html', $post_data2);
        if(!$arr = json_decode($list, true)){json(-1, '社区json解析失败了!');}
		if($arr['status']!=1){json(-1, $arr['content']);}
            $xid = $_POST['s_xid'];
            $iscfxd = 0;
            $isbd = 0;
            $istk = 0;
			$minnum = $arr['content']['OrderMin'];
            $maxnum = $arr['content']['OrderMax'];
            $pic = $arr['content']['Img_Url'];
			if(strpos($pic,'http')==false){
			if(substr($pic, 0, 1)!='/'){$pic="http://img.yilep.com/".$pic;}
			else
			{$pic="http://img.yilep.com".$pic;}
			}
			$spic=$pic;
            $name = $arr['content']['Name'];
			$content = base64_decode($arr['content']['Notice']);
			$p1 = $arr['content']['Money'];
		$msg = $arr['status'];
	if ($arr['content']['MubanInfo'][0]!='')
	{   
    $canshu= "input1" ;  
	}
	if ($arr['content']['MubanInfo'][1]!='')
	{   
    $canshu=  $canshu."|input2" ;  
	}
	if ($arr['content']['MubanInfo'][2]!='')
	{   
    $canshu=  $canshu."|input3" ;  
	}
	if ($arr['content']['MubanInfo'][3]!='')
	{   
    $canshu=  $canshu."|input4" ;  
	}
            $unit = '个';
            $jj = $get['join_price_type'];
            $type=$get['auto_price'];
	}
            if($jj==0 and $type==1){#固定
            $p2 = $p1+$_POST['join_price'];#旗舰
            $p3 = $p2+$_POST['join_price'];#专业
            $p4 = $p3+$_POST['join_price'];#普及
}elseif($jj==1 and $type==1){#倍数
    $p2 = $_POST['join_price'];#旗舰
            $p3 = $p2*$_POST['join_price'];#专业
            $p4 = $p3*$_POST['join_price'];#普及
}else{
    $p2=$p1;
    $p3=$p1;
    $p4=$p1;
}
        //模板查询
        $result1 = mysql_query('select * from  ' . flag . 'moban where id = ' . $xid . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $keyname1 = $row['keyname1'];
            $keyname2 = $row['keyname2'];
            $keyname3 = $row['keyname3'];
            $keyname4 = $row['keyname4'];
            $key1 = $row['key1'];
            $key2 = $row['key2'];
            $key3 = $row['key3'];
            $key4 = $row['key4'];
            $zhuzhan1 = $row['key1'];
            $zhuzhan2 = $row['key2'];
            $zhuzhan3 = $row['key3'];
            $zhuzhan4 = $row['key4'];
            $jiuwu1 = $row['dkey1'];
            $jiuwu2 = $row['dkey2'];
            $jiuwu3 = $row['dkey3'];
            $jiuwu4 = $row['dkey4'];
            $yile1 = $row['yile1'];
            $yile2 = $row['yile2'];
            $yile3 = $row['yile3'];
            $yile4 = $row['yile4'];
        }else{
			json(-1, '模板查询失败!'.mysql_error());
		}
        if ($dpingtai == 1) {
            $dkey1 = $zhuzhan1;
            $dkey2 = $zhuzhan2;
            $dkey3 = $zhuzhan3;
            $dkey4 = $zhuzhan4;
        }
        elseif ($dpingtai == 2 or $dpingtai == 4 or $dpingtai == 5) {
            $dkey1 = $yile1;
            $dkey2 = $yile2;
            $dkey3 = $yile3;
            $dkey4 = $yile4;
        }
        elseif ($dpingtai == 3) {
            $dkey1 = $jiuwu1;
            $dkey2 = $jiuwu2;
            $dkey3 = $jiuwu3;
            $dkey4 = $jiuwu4;
        }else{
			json(-1, '模板查询对接参数失败!');
		}
        $_data['minnum'] = $minnum;
        $_data['maxnum'] = $maxnum;
        $_data['pid'] = $_POST['s_pid'];
        $_data['xid'] = $xid;
        $_data['cid'] = $_POST['s_cid'];
        $_data['pic'] = $spic;
        $_data['name'] = $name;
        $_data['unit'] = $unit;
        $_data['bd'] = $isbd;
        $_data['tk'] = $istk;
        $_data['price'] = $p1;
        $_data['fprice1'] = $p4;#普及
        $_data['fprice2'] = $p3;#专业
        $_data['fprice3'] = $p2;#旗舰
        $_data['sorder'] = 0;
        $_data['content'] = addslashes($content);
        $_data['zt'] = 1;
        $_data['iscfxd'] = $iscfxd;
        $_data['date'] = $sj;
        $_data['zid'] = $zhu_id;
        $_data['duijie'] = $_POST['jids'];
        $_data['duijiesid'] = $s_duijiesid;
        $_data['duijiekey1'] = $dkey1;
        $_data['duijiekey2'] = $dkey2;
        $_data['duijiekey3'] = $dkey3;
        $_data['duijiekey4'] = $dkey4;
        $_data['duijiefs'] = 1;
        $_data['duijiesqlx'] = 1;
        $_data['duijiecgzt'] = $_POST['duijiecgzt'];
        $_data['jj'] = $jj;
        $str = arrtoinsert($_data);
        $sql = 'insert into ' . flag . 'shop (' . $str[0] . ') values (' . $str[1] . ')';
        $arrr = array('""' => "NULL");
        $sql = strtr($sql, $arrr);
        if (mysql_query($sql)) {
			$msg='商品克隆成功';
			$cod=0;
        }else{
			json(-1, '商品克隆失败!'.mysql_error());
		}
        $ID = mysql_insert_id();
		$i++;
    }
$result=array("status"=>$cod,"message"=>"$msg","date"=>$date);
die(json_encode($result));
	break;
	
	case 'checku'://检查用户
	$sel = "select * from  " . flag . "user where ID = '" . $_POST['zuid'] . "'  and zid = " . $zhu_id . " ";
	$sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
	if (is_array($s)) {
	$a_name = $s['name'];
	$a_password = $s['password'];
	$code=0;
	$msg='获取成功';
	$date=array('uid'=>$_POST['zuid'],'username'=>"$a_name");
	}else{
	$code=1;
	$msg='不存在该用户';
	}
	$result=array("status"=>$code,"message"=>"$msg","date"=>$date);
die(json_encode($result));
	break;
	
	case 'store'://密价
	$code=1;
	$msg='失败';
	$uid=$_POST['uid'];
	$kind=$_POST['kind'];
	$rate=$_POST['rate'];
	null_alertjson($_POST['uid'], '请输入用户uid');
	null_alertjson($_POST['uid'], '请输入加价方式');
	null_alertjson($_POST['rate'], '请输入内容');
	$sql = 'select * from ' . flag . 'mj where uid = "' . $uid . '" and zid = ' . $zhu_id . ' ';
    $result = mysql_query($sql);
    if ($row = mysql_fetch_array($result)) {
	$_data['uid'] = $uid; 
	$_data['kind'] = $kind; 
	$_data['rate'] = $rate; 
	$_data['sj'] = $sj;
	$_data['zid'] = $zhu_id; 
	$str = arrtoinsert($_data);
    $sql = 'update '.flag.'mj set '.arrtoupdate($_data).' where uid = '.$uid.' and zid = '.$zhu_id.'';
    if(mysql_query($sql)){
	  $code=0;
		$msg='修改成功';
	}else{
		$code=1;
		$msg='修改失败';
	}
	}else{
	$_data['uid'] = $uid; 
	$_data['kind'] = $kind; 
	$_data['rate'] = $rate; 
	$_data['sj'] = $sj;
	$_data['zid'] = $zhu_id; 
 	$str = arrtoinsert($_data);
	$sql1 = 'insert into '.flag.'mj ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql1)){
		$code=0;
		$msg='添加成功';
	}else{
		$code=1;
		$msg='添加失败'.mysql_error();
	}
	}
	$result=array("status"=>$code,"message"=>"$msg","date"=>$date);
	die(json_encode($result));
	break;
	
	case 'mjDelete':
	$sql = 'delete from '.flag.'mj where id = '.$_POST['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		$code=0;
		$msg='删除成功';
	}else{
		$code=1;
		$msg='失败';
	}
	$result=array("status"=>$code,"message"=>"$msg","date"=>$date);
	die(json_encode($result));
	break;
	
	case 'turntableset'://抽奖设置
	null_alertjson($_POST['zt'], '请输入状态');
	null_alertjson($_POST['price'], '请输入价格');
	$_data['cjzt'] = $_POST['zt']; 
	$_data['cjprice'] = $_POST['price'];
  	$sql1 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql1)){
	$code=0;
	$msg='修改成功';
	}else{
	$code=1;
	$msg='修改失败';
	}
	$result=array("status"=>$code,"message"=>"$msg");
die(json_encode($result));
	break;	
	
	case 'turntableadd'://抽奖添加
	null_alertjson($_POST['total'], '请输入数量');
	null_alertjson($_POST['name'], '请输入名称');
	null_alertjson($_POST['kind'], '请输入类型');
	$_data['name'] = $_POST['name']; 
	$_data['kind'] = $_POST['kind']; 
	$_data['number'] = $_POST['total']; 
	if($_POST['rmb'])$_data['rmb'] = $_POST['rmb']; 
	if($_POST['image'])$_data['image'] = $_POST['image']; 
	$_data['zid'] = $zhu_id; 
 	$str = arrtoinsert($_data);
	$sql1 = 'insert into '.flag.'cjjp ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql1)){
	$code=0;
	$msg='添加成功';
	}else{
	$code=1;
	$msg='添加失败'.mysql_error().$sql1;
	}
	$result=array("status"=>$code,"message"=>"$msg");
die(json_encode($result));
	break;
		
	case 'turntableupdate'://抽奖更新
	null_alertjson($_POST['do'], '请输入类型');
	null_alertjson($_POST['num'], '请输入奖品数量');
	$sql = 'select * from '.flag.'cjjp  where  id = '.$_POST['id'].' and zid = '.$zhu_id.'';
	$result = mysql_query($sql);
	$row= mysql_fetch_array($result);
	$num=$row['number'];
	if($_POST['do']==0){
	$_data['number'] = $num+$_POST['num']; 
	}else{
	$_data['number'] = $num-$_POST['num']; 	
	}
	$_data['zid'] = $zhu_id; 
 	$str = arrtoinsert($_data);
  	$sql1 = 'update '.flag.'cjjp set '.arrtoupdate($_data).' where id = '.$_POST['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql1)){
	$code=0;
	$msg='修改成功';
	}else{
	$code=1;
	$msg='修改失败';
	}
	$result=array("status"=>$code,"message"=>"$msg","date"=>$date);
die(json_encode($result));
	break;
}