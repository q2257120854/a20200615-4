<?php
include '../system/inc.php';
include './admin_config.php';
include './check.php';
//账户查询
$result1 = mysql_query('select * from  ' . flag . 'duijie where id = ' . $_GET['id'] . ' and zid = ' . $zhu_id . ' ');
if ($row = mysql_fetch_array($result1)) {
$pingtai = $row['pingtai'];
$pingtaiurl = $row['url'];
$loginname = $row['loginname'];
$loginpassword = $row['loginpassword'];
$_SESSION['yile_url'] = $row['url'];
$_SESSION['yile_id'] = $row['loginname'];
$_SESSION['yile_key'] = $row['loginpassword'];
}
if ($pingtai == 1) {
$result1 = mysql_query('select * from  ' . flag . 'zhuzhan_domain where name = "' . $pingtaiurl . '" ');
if ($row = mysql_fetch_array($result1)) {
$zhuzhanid = $row['zid'];
}
}
//亿乐
if ($pingtai == 2) {
$apiurl = 'http://' . $pingtaiurl . '/api/web/getGoodsList.html';
$params = array();
$paramsString = http_build_query($params);
$content = @file_get_contents($apiurl);
$result = json_decode($content, true);
$arr = json_decode($content, true);
$data = call_user_func_array('array_merge_recursive', $arr['list']);
//key为a的项所有值
$sid = $data['goodsid'];
//商品ID
$sname = $data['name'];
//商品标题
$modelid = $data['modelid'];
//模板ID
$goods_type_title = $data['goods_type_title'];
//商品类型
$image_url = $data['image_url'];
//商品图片
}
//玖伍
if ($pingtai == 3) {
        $apiurl = 'http://' . $pingtaiurl . '/index.php?m=home&c=api&a=get_goods_lists';
		$arr = json_decode(yilepost($apiurl),true);
		$goods = array();
	foreach ($arr["goods_rows"] as $_var_7) {
		$goods[] = array("id" => $_var_7["id"], "type" => $_var_7["goods_type"], "name" => $_var_7["title"], "shopimg" => "https://all-pt-upyun-cdn.95at.cn" . $_var_7["thumb"], "minnum" => $_var_7["minbuynum_0"], "maxnum" => $_var_7["maxbuynum_0"]);
	}
#$goods= jiuwu_goodslist_details($pingtaiurl,$loginname,$loginpassword);
}
//商品单位
//亿乐3.0
if ($pingtai == 4) {
    $time = strtotime('now');
    $params0 = array('api_token' => $loginname, 'timestamp' => $time);
    $key0 = $loginpassword;
    $sign0 = getSign($params0, $key0);
    $post_data1 = array('api_token' => $loginname, 'timestamp' => $time, 'sign' => $sign0);
    $post_data1 = http_build_query($post_data1 , '' , '&');
    $yileshoplist = yilepost('http://' . $pingtaiurl . '.api.94sq.cn/api/goods/list', $post_data1);
    $list = getyileshop($yileshoplist);
    $query = json_decode($yileshoplist, true);
    if ($query['status'] != 0) {
        $message = $query['message'];
    } else {
        $message = '请选择商品';
    }
}
//聚梦
if ($pingtai == 5) {
    $time = strtotime('now');
    $params0 = array('username' => $loginname, 'time' => $time);
    $key0 = $loginpassword;
    $sign0 = getSign($params0, $key0);
    $post_data1 = array('username' => $loginname, 'time' => $time, 'sign' => $sign0);
	$post_data1 = http_build_query($post_data1 , '' , '&');
    $yileshoplist = getCurl('http://' . $pingtaiurl . '.api.jumsq.com/Api/UserApi/GoodsList.html', $post_data1);
    $list = getjmshop($yileshoplist);
    $query = json_decode($yileshoplist, true);
    if ($query['status'] != 1) {
        $message = $query['content'];
    } else {
        $message = '请选择商品';
    }
}
 ?>
<input name="duijieid" id="duijieid" value="<?=$_GET['id']?>" placeholder="" class="form-control" type="hidden">
<input name="pingtai" id="pingtai" value="<?=$pingtai?>" placeholder="" class="form-control" type="hidden">
<?php  if ($pingtai==1) { ?>
<div class="form-group">
<label class="col-lg-3 control-label">对接商品</label>
<div class="col-lg-8">
<div class="input-group">
<select class="form-control" name="duijiesid" style="width:278px">
<?php $result1=mysql_query( 'select * from '.flag. 'shop_channel where zt= 1  and zid = '.$zhu_id. ' order by corder desc ,ID asc'); $x=1; while($row1=mysql_fetch_array($result1)){ ?>
<option value="<?=$row1['ID']?>"> <?=$row1['name']?>
</option>
<?php  } ?>
</select>
</div>
</div>
</div>
<?php  } ?>
<?php  if ($pingtai==2) { ?>
<!-- 亿乐-->
<div class="form-group">
<label class="col-lg-3 control-label">对接商品</label>
<div class="col-lg-8">
<select id="duijiesid" class="form-control" onchange="aa()" name="duijiesid">
<?php for ($i = 0; $i < sizeof($sid); $i++) {  
						  if ($api_status[$i] == 1) ?>
<option <?php  if($row['duijiesid']==$sid[$i] ) {echo "selected";}?> data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"> <?=$sname[$i]?>
</option>
<?php  }?>
</select>
</div>
</div>
<?php  } ?> <?php  if ($pingtai==3) { ?>
<div class="form-group">
<label class="col-lg-3 control-label">对接商品</label>
<div class="col-lg-8">
<div class="input-group">
<select id="duijiesid" class="form-control" onchange="jiuwu()" name="duijiesid">
<?php $i=0;
									
	while ($goods[$i]!=NULL) {
        $sid = $goods[$i]['id'];
        //商品ID
        $sname = $goods[$i]['name'];
        //商品标题
        $goods_type = $goods[$i]['type'];
        //社区类型
    if ($api_status[$i] == 1) {
        $zt = '<font  class="status4">完成</FONT>';
    }
	$i++;
	?><option <?php if ($_SEESION['duijiesid'] == $sid) {
        echo "selected";
    } ?> data-id="<?=$goods_type ?>" value="<?=$sid ?>"><?=$sname ?>ID:<?=$sid ?>类型= <?=$goods_type ?></option><?php
} ?>
</select>
</div>
</div>
</div>
<div class="form-group">
<label class="col-lg-3 control-label">社区类型</label>
<div class="col-lg-8">
<input name="sqlx" id="sqlx" value="<?=$row['duijiesqlx']?>" placeholder="请输入社区类型" class="form-control" type="text">
</div>
</div>
<div class="form-group">
<label class="col-lg-3 control-label">支付方式</label>
<div class="col-lg-8">
<select name="fs" class="form-control">
<option <?php  if ($row['duijiefs']==1) {echo "selected";}?> value="1">现金</option>
<option <?php  if ($row['duijiefs']==0) {echo "selected";}?> value="0">卡密</option>
</select>
</div>
</div>
<?php  } ?>
<?php  if ($pingtai==4) { ?>
<!-- 亿乐3.0-->
<div class="form-group">
<label class="col-lg-3 control-label">对接商品
<?=$list?>
</label>
<div class="col-lg-8">
<select id="duijiesid" class="form-control" onchange="ylshopcanshu()" name="duijiesid">
<option data-id="">请选择商品</option>
<?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
<?php  } ?>
</select>
</div>
</div>
<?php  } ?>
<?php  if ($pingtai==5) { ?>
<!-- 聚梦-->
<div class="form-group">
<label class="col-lg-3 control-label">对接商品
<?=$list?>
</label>
<div class="col-lg-8">
<select id="duijiesid" class="form-control" onchange="jmshopcanshu()" name="duijiesid">
<option data-id="">请选择商品</option>
<?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
<?php  } ?>
</select>
</div>
</div>
<?php  } ?>
	<?php  if ($pingtai!='') { ?> 
<div class="form-group">
<label class="col-lg-3 control-label">参数名</label>
<div class="col-lg-8">
<input name="canshu" id="canshu" class="form-control" value="<?=$cs?>" type="text"> <pre> <font color="green">对应输入框标题，多个参数请用|隔开!</font> </pre>
</div>
</div>
	<div class="form-group">
<label class="col-lg-3 control-label">对接成功改变状态</label>
<div class="col-lg-8">
<select name="duijiecgzt" class="form-control">
<option value="0">不改变</option>
<option value="1">进行中</option>
<option value="4">异常中</option>
<option value="8">待补单</option>
<option value="5">补单中</option>
<option value="6">已完成</option>
<option value="9">退款中</option>
<option value="7">已退款</option>
</select>
</div>
	<?php  } ?>
</div>