<?php
include_once('../system/inc.php');
function curl_get($url)
{
	$ch = curl_init($url);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1");
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}
header("Content-type:text/html;charset=utf-8");
//字符编码设置  
$type=$_GET['c'];
$do=$_GET['a'];
$user=$_REQUEST['Api_UserName'];
$pwd=$_REQUEST['Api_UserMd5Pass'];
$id=$_REQUEST['id'];
$servername = DATA_HOST;
$username = DATA_USERNAME;
$password = DATA_PASSWORD;
$dbname = DATA_NAME;
// 创建连接  
$con =mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($con, "utf8");
if($type=='api' and $do=='get_goods_lists'){
	// 检测连接  
	$sql = 'select * from '.flag.'shop where   zt = 1 and zid = '.$zhu_id.'';
	$result = mysqli_query($con,$sql);
	if (!$result) {
		printf("Error: %sn", mysqli_error($con));
    exit();
}
$jarr = array();
while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
    $count=count($rows);
    for($i=0;$i<$count;$i++){  
        unset($rows[$i]); 
    }
    array_push($jarr,$rows);
}
$sort=0;
foreach ($jarr as $v) {
$goods[]=array("id"=>$v['ID'],"title"=>"{$v['name']}","thumb"=>"{$v['pic']}","streamline_title"=>"{$v['name']}","goods_type"=>$v['xid'],"goods_unitprice"=>"{$v['price']}",
"unit"=>"赞","minbuynum_0"=>"{$v['minnum']}","maxbuynum_0"=>"{$v['maxnum']}");
$sort++;
}
$result=array("status"=>1,"goods_rows"=>$goods);
die(json_encode($result));
}elseif($type=='api' and $do=='user_get_goods_lists_details'){
// 检测连接  
$sql = 'select * from '.flag.'shop where   zt = 1 and zid = '.$zhu_id.'';  
$result = mysqli_query($con,$sql); 
if (!$result) {
    printf("Error: %sn", mysqli_error($con));
    exit();
}
$jarr = array();
while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
    $count=count($rows);
    for($i=0;$i<$count;$i++){  
        unset($rows[$i]); 
    }
    array_push($jarr,$rows);
}
$sort=0;
if($user){
            $sel = "select * from " . flag . "user where name = '" . $user . "'  and zid =" . $zhu_id . "  ";
    $sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
    if (is_array($s)) {
        $api_member_id = $s['ID'];
        $api_member_point = $s['point'];
        $api_member_name = $s['name'];
        $m_level = $row['level'];
        if ($fen_zz == $api_member_id) {
        $m_level = 6;    }
	$sql = 'select * from ' . flag . 'mj where uid = "' . $api_member_id . '" and zid = ' . $zhu_id . ' ';
    $result = mysql_query($sql);
    if (!!$row = mysql_fetch_array($result)) {
		$mj_name='(密价)';
        $mj_rate = $row['rate'];
        $mj_kind = $row['kind'];
    }
    }
}
foreach ($jarr as $v) {
$sql = "select * from ".flag."moban where ID = ".$v['xid']." ";
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
 	$name = $row["name"];
 	$keyname1 = $row["keyname1"];
 	$keyname2 = $row["keyname2"];
 	$keyname3 = $row["keyname3"];
 	$keyname4 = $row["keyname4"];
 	$key1 = $row["key1"];
 	$key2 = $row["key2"];
 	$key3 = $row["key3"];
 	$key4 = $row["key4"];
	  }
	  if ($zhu == 'true') {
    //主站的商品价格
    $shop_price = $v['price'];
    //查询价格模板
    $sql = 'select * from ' . flag . 'price where id = ' . $v["xid"] . ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $p_level1 = $row['p_level1'];
        $p_level2 = $row['p_level2'];
        $p_level3 = $row['p_level3'];
        $p_level4 = $row['p_level4'];
        $p_level5 = $row['p_level5'];
        $kind = $row['kind'];
    }
} else {
    //查询分站定价模板
    $sql = 'select * from ' . flag . 'fshop where sid = ' . $v['ID'] . ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $sfpid = $row['pid'];
    }
    //查询分站价格模板
    $sql = 'select * from ' . flag . 'price where id = ' . $sfpid . ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $p_level1 = $row['p_level1'];
        $p_level2 = $row['p_level2'];
        $p_level3 = $row['p_level3'];
        $p_level4 = $row['p_level4'];
        $p_level5 = $row['p_level5'];
        $kind = $row['kind'];
    }
    if ($v['jj'] == 0) {
        //固定金额
        if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $v['fprice1'];
            $chajia2 = $v['fprice1'] - $v['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $v['fprice2'];
            $chajia2 = $v['fprice2'] - $v['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $v['fprice3'];
            $chajia2 = $v['fprice3'] - $v['fprice1'];
        }
    } elseif ($v['jj'] == 1) {
        //倍数
        if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $v['price'] * $v['fprice1'];
            $chajia2 = $v['price'] * $v['fprice1'] - $v['price'] * $v['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $v['price'] * $v['fprice2'];
            $chajia2 = $v['price'] * $v['fprice2'] - $v['price'] * $v['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $v['price'] * $v['fprice3'];
            $chajia2 = $v['price'] * $v['fprice3'] - $v['price'] * $v['fprice1'];
        }
    }
}
if ($user) {
    if ($kind == 0) {
        $s_price1 = $shop_price + $jprice;
    } elseif ($kind == 1) {
        $s_price1 = $shop_price * (1 + $jprice);
    } else {
        $s_price1 = $shop_price + $jprice;
    }
    if ($mj_name) {
        if ($mj_kind == 1) {
            $s_price1 = $shop_price + $mj_rate;
        } elseif ($mj_kind == 0) {
            $s_price1 = $shop_price * (1 + $mj_rate);
        } else {
            $s_price1 = $shop_price + $mj_rate;
        }
    }
    $s_price = get_xiaoshu($s_price1, 6);
}
$goods[]=array("id"=>"{$v['ID']}","user_unitprice"=>"{$v['price']}","title"=>"{$v['name']}",
"thumb"=>"{$v['pic']}","sort"=>$sort,"goods_type"=>0,"minbuynum_0"=>"{$v['minnum']}","maxbuynum_0"=>"{$v['maxnum']}","goods_status"=>0);
$sort++;
}
$result=array("status"=>true,"msg"=>"理论上没bug","user_goods_lists_details"=>$goods);
die(json_encode($result));
}elseif($type=='Goods' and $do='detail'){ 
    $user=$_COOKIE['api_userid'];
if($user){
            $sel = "select * from " . flag . "user where name = '" . $user . "'  and zid =" . $zhu_id . "  ";
    $sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
    if (is_array($s)) {
        $api_member_id = $s['ID'];
        $api_member_point = $s['point'];
        $api_member_name = $s['name'];
        $m_level = $row['level'];
        if ($fen_zz == $api_member_id) {
        $m_level = 6;    }
	$sql = 'select * from ' . flag . 'mj where uid = "' . $api_member_id . '" and zid = ' . $zhu_id . ' ';
    $result = mysql_query($sql);
    if (!!$row = mysql_fetch_array($result)) {
		$mj_name='(密价)';
        $mj_rate = $row['rate'];
        $mj_kind = $row['kind'];
    }
    }
}
$sql = 'select * from ' . flag . 'shop where ID = ' . $id . '  and  zt = 1 ';
$result = mysql_query($sql);
$v = mysql_fetch_array($result);
    $s_id = $v['ID'];
    $s_pid = $v['pid'];
    $s_xid = $v['xid'];
    $s_unit=$v['unit'];
    $s_min=$v['minnum'];
    $price=$v['price'];
	$sql = 'select * from ' . flag . 'moban where id = ' . $s_xid . ' ';
$result = mysql_query($sql);
if (!!($row = mysql_fetch_array($result))) {
    $name = $row['name'];
    $keyname1 = $row['keyname1'];
    $keyname2 = $row['keyname2'];
    $keyname3 = $row['keyname3'];
    $keyname4 = $row['keyname4'];
    $key1 = $row['key1'];
    $key2 = $row['key2'];
    $key3 = $row['key3'];
    $key4 = $row['key4'];
}
if ($zhu == 'true') {
    //主站的商品价格
    $shop_price = $price;
    //查询价格模板
    $sql = 'select * from ' . flag . 'price where id = ' . $s_xid. ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $p_level1 = $row['p_level1'];
        $p_level2 = $row['p_level2'];
        $p_level3 = $row['p_level3'];
        $p_level4 = $row['p_level4'];
        $p_level5 = $row['p_level5'];
        $kind = $row['kind'];
    }
} else {
    //查询分站定价模板
    $sql = 'select * from ' . flag . 'fshop where sid = ' . $s_id. ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $sfpid = $row['pid'];
    }
    //查询分站价格模板
    $sql = 'select * from ' . flag . 'price where id = ' . $sfpid . ' ';
    $result = mysql_query($sql);
    if (!!($row = mysql_fetch_array($result))) {
        $p_level1 = $row['p_level1'];
        $p_level2 = $row['p_level2'];
        $p_level3 = $row['p_level3'];
        $p_level4 = $row['p_level4'];
        $p_level5 = $row['p_level5'];
        $kind = $row['kind'];
    }
    if ($v['jj'] == 0) {
        //固定金额
        if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $v['fprice1'];
            $chajia2 = $v['fprice1'] - $v['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $v['fprice2'];
            $chajia2 = $v['fprice2'] - $v['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $v['fprice3'];
            $chajia2 = $v['fprice3'] - $v['fprice1'];
        }
    } elseif ($v['jj'] == 1) {
        //倍数
        if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $v['price'] * $v['fprice1'];
            $chajia2 = $v['price'] * $v['fprice1'] - $v['price'] * $v['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $v['price'] * $v['fprice2'];
            $chajia2 = $v['price'] * $v['fprice2'] - $v['price'] * $v['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $v['price'] * $v['fprice3'];
            $chajia2 = $v['price'] * $v['fprice3'] - $v['price'] * $v['fprice1'];
        }
    }
}
if ($user) {
    if ($kind == 0) {
        $s_price1 = $shop_price + $jprice;
    } elseif ($kind == 1) {
        $s_price1 = $shop_price * (1 + $jprice);
    } else {
        $s_price1 = $shop_price + $jprice;
    }
    if ($mj_name) {
        if ($mj_kind == 1) {
            $s_price1 = $shop_price + $mj_rate;
        } elseif ($mj_kind == 0) {
            $s_price1 = $shop_price * (1 + $mj_rate);
        } else {
            $s_price1 = $shop_price + $mj_rate;
        }
    }
}else{
    $s_price1 = $shop_price + $p_level1;
}
$s_price = get_xiaoshu($s_price1, 6);
	?><!--用户信息/卡信息-->
		<div class="col-md-4">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">
						用户信息
					</h2>
				</div>
				<div class="panel-body">
					<ul class="card_info" ajax_href="/index.php?m=Home&c=Card&a=cardinfo&id=25914&goods_type=215">
								<span>现金单价：</span><span  title=""><?php echo $s_min.$s_unit; ?>=<?=$s_price?>元</span>
 							</li>
					</ul>
				</div>
			</div>
				</div>
<form role="form" method="post" class="order_post_form" action="/index.php?m=home&c=order&a=ly_add&id=3206&goods_type=1">
<input type="hidden" name="goods_type" value="1">
						<ul>
                        					            	<? if ($key1!='') {?>
	<li><span class="fixed-width-right-80"><?=$keyname1?>：</span><input name="<?=$key1?>" type="text" placeholder=""/></li>
      <? }?>
       <? if ($key2!='') {?>
	<li><span class="fixed-width-right-80"><?=$keyname2?>：</span><input name="<?=$key2?>" type="text" placeholder=""/></li>
      <? }?> 
       <? if ($key3!='') {?>
	<li><span class="fixed-width-right-80"><?=$keyname3?>：</span><input name="<?=$key3?>" type="text" placeholder=""/></li>
      <? }?> 
       <? if ($key4!='') {?>
	<li><span class="fixed-width-right-80"><?=$keyname4?>：</span><input name="<?=$key4?>" type="text" placeholder=""/></li>
      <? }?>                        
									<li>
 										<div class="form-inline">
											<input id="pay_rmb" name="pay_type" type="radio" value="1" ><label class="font_weight_400" for="pay_rmb"></label>
										</div>
									</li>								
													</ul>
					</form>	
<?php
}elseif($type=='order' and $do=='add'){
$sql = 'select * from ' . flag . 'shop where ID = ' . $_POST['goods_id'] . '  and  zt = 1 ';
$result = mysql_query($sql);
if (!!($row = mysql_fetch_array($result))) {
    $s_id = $row['ID'];
    $s_pid = $row['pid'];
    $s_xid = $row['xid'];
}
$sql = "select * from " . flag . "moban where ID = " . $s_xid . " ";
$result = mysql_query($sql);
if (!!($row = mysql_fetch_array($result))) {
    $name = $row["name"];
    $keyname1 = $row["keyname1"];
    $keyname2 = $row["keyname2"];
    $keyname3 = $row["keyname3"];
    $keyname4 = $row["keyname4"];
    $key1 = $row["key1"];
    $key2 = $row["key2"];
    $key3 = $row["key3"];
    $key4 = $row["key4"];
}
if ($key1 != NULL) {
    $url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goods_id'] . "&api_user=" . $_POST['Api_UserName'] . "&api_pwd=" . $_POST['Api_UserMd5Pass'] . "&num=" . $_POST['need_num_0'] . "&" . $key1 . "=" . $_POST[$key1];
		}
		if ($key2 != NULL) {
			$url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goods_id'] . "&api_user=" . $_POST['Api_UserName'] . "&api_pwd=" . $_POST['Api_UserMd5Pass'] . "&num=" . $_POST['need_num_0'] . "&" . $key1 . "=" . $_POST[$key1] . "&" . $key2 . "=" . $_POST[$key2];
			    }
			if ($key3 != NULL) {
				$url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goods_id'] . "&api_user=" . $_POST['Api_UserName'] . "&api_pwd=" . $_POST['Api_UserMd5Pass'] . "&num=" . $_POST['need_num_0'] . "&" . $key1 . "=" . $_POST[$key1] . "&" . $key2 . "=" . $_POST[$key2] . "&" . $key3 . "=" . $_POST[$key3];
				        }
				if ($key4 != NULL) {
					$url = "http://{$_SERVER['HTTP_HOST']}/api/api.php?act=add&sid=" . $_POST['goods_id'] . "&api_user=" . $_POST['Api_UserName'] . "&api_pwd=" . $_POST['Api_UserMd5Pass'] . "&num=" . $_POST['need_num_0'] . "&" . $key1 . "=" . $_POST[$key1] . "&" . $key2 . "=" . $_POST[$key2] . "&" . $key3 . "=" . $_POST[$key3] . "&" . $key4 . "=" . $_POST[$key4];
					        }
					$lj = curl_get($url);
					$nr = trim(substr($lj, stripos($lj, '订单号:') + 1), '订单号:');
					if (strstr($lj, '下单成功!')) {
						echo '{"status":1,"info":' . json_encode("下单成功!") . ',"order_id":"' . $nr . '"}';
					} elseif (strstr($lj, '返回信息:')) {
						echo '{"status":1,"info":' . json_encode($lj) . ',"order_id":"' . $nr . '"}';
						    # echo $url;
					} elseif (strstr($lj, '订单号')) {
						echo '{"status":1,"info":' . json_encode("下单成功!没有返回信息") . ',"order_id":"' . $nr . '"}';
					} else {
						echo '{"status":-1,"info":' . json_encode("下单失败,返回信息:{$lj}") . '}';
						    #echo $url;
					}
				} elseif($type=='User' and $do=='login'){
					$_SEEION['1']=123123;
						if($_REQUEST['username']=='delete')$_REQUEST['username']=12345;
						if($_REQUEST['username_password']=='delete')$_REQUEST['username_password']=12345;
						setcookie("api_userid", $_REQUEST['username'], time() + 604800);
						setcookie("api_usertoken", $_REQUEST['username_password'], time() + 604800);
						?>
					登录成功!
						<?php
				}
				if($type and $do){
					die;
				}