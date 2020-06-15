<?php
if ($_REQUEST['gid']) $sid = $_REQUEST['gid'];
if ($_REQUEST['id']) $sid = $_REQUEST['id'];
if ($_REQUEST['sid']) $sid = $_REQUEST['sid'];
if (!isset($sid) or $sid == 0) {
    $result = mysql_query('select * from ' . flag . 'shop where zt = 1 and zid = ' . $zhu_id . '  order by ID desc ,ID desc');
    while ($row = mysql_fetch_array($result)) {
        $sid = $row['ID'];
        break;
    }
}
    $sql = 'select * from ' . flag . 'shop where ID = ' . $sid . '  and  zt = 1  and zid = ' . $zhu_id . '';
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
	$s_id = $row['ID'];
 	$s_pid = $row['pid'];
 
 	$s_xid = $row['xid'];
 	$s_bd = $row['bd'];
 	$s_tk = $row['tk'];
 	$s_dnum = $row['minnum'];
 	$s_gnum = $row['maxnum'];

	$s_cid = $row['cid'];
 	$s_name = $row['name'];
 	$s_unit = $row['unit'];
 	$s_content = $row['content'];
	$s_pic = $row['pic'];
	$s_order = $row['sorder'];
	$s_date = $row['date'];
	$s_zt = $row['zt'];
	$s_duijie = $row['duijie'];
	$s_duijiesid = $row['duijiesid'];
	$s_duijiesqlx = $row['duijiesqlx'];
	$duijiefs = $row['duijiefs'];
	$duijiekey1 = $row['duijiekey1'];
	$duijiekey2 = $row['duijiekey2'];
	$duijiekey3 = $row['duijiekey3'];
	$duijiekey4 = $row['duijiekey4'];
				 $canshu=$row['canshu'];
				 $canshu=explode('|',$canshu);
				 $canshu1=$canshu[0];
				 $canshu2=$canshu[1];
				 $canshu3=$canshu[2];
				 $canshu4=$canshu[3];
	$gh  = $row['gh'];
if ($zhu=='true')	  //主站的商品价格
{	$shop_price = $row['price']; }

else
{	
		if($row['jj']==0) {//固定金额
        if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $row['fprice1'];
            $chajia2 = $row['fprice1'] - $row['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $row['fprice2'];
            $chajia2 = $row['fprice2'] - $row['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $row['fprice3'];
            $chajia2 = $row['fprice3'] - $row['fprice1'];
        }
		}elseif($row['jj']==1) {//倍数
		if ($dqbanben == 1) {
            //分站的商品价格
            $shop_price = $row['price']*$row['fprice1'];
            $chajia2 = $row['price']*$row['fprice1'] - $row['price']*$row['fprice1'];
        }
        if ($dqbanben == 2) {
            $shop_price = $row['price']*$row['fprice2'];
            $chajia2 = $row['price']*$row['fprice2'] - $row['price']*$row['fprice1'];
        }
        if ($dqbanben == 3) {
            $shop_price = $row['price']*$row['fprice3'];
            $chajia2 = $row['price']*$row['fprice3'] - $row['price']*$row['fprice1'];
        }
		}
}
 		
  } else {
	die ('参数:sid 商品ID不存在!');
}
 
 

 //获取下单模板
 $sql = 'select * from '.flag.'moban where id = '.$s_xid.' ';
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
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
    //查询价格模板
    $sql = 'select * from ' . flag . 'price where id = ' . $s_pid . ' ';
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
    $sql = 'select * from ' . flag . 'fshop where sid = ' . $s_id . ' ';
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
}
if ($m_level == 1) {
    $jprice = $p_level1;
}
if ($m_level == 2) {
    $jprice = $p_level2;
}
if ($m_level == 3) {
    $jprice = $p_level3;
}
if ($m_level == 4) {
    $jprice = $p_level4;
}
if ($m_level == 5) {
    $jprice = $p_level5;
}
if($m_level==6){
	$jprice = 0;
}
//查询对接信息
$sql = 'select * from ' . flag . 'duijie where id = ' . $s_duijie . ' and zid = ' . $zhu_id . ' ';
$result = mysql_query($sql);
if (!!($row = mysql_fetch_array($result))) {
    $pingtai = $row['pingtai'];
    $loginname = $row['loginname'];
    $loginpassword = $row['loginpassword'];
    $duijieurl = $row['url'];
}
if($kind==0){
$s_price1 = $shop_price + $jprice;
}elseif($kind==1){$s_price1 = $shop_price * (1 + $jprice);}
else{
$s_price1 = $shop_price + $jprice;
}

if($mj_name){
	if($mj_kind==1){
$s_price1 = $shop_price + $mj_rate;
}elseif($mj_kind==0){$s_price1 = $shop_price * (1 + $mj_rate);}
else{
$s_price1 = $shop_price + $mj_rate;
}
}

$s_price = get_xiaoshu($s_price1, 6);