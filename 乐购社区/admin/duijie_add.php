<?php
$title = '时空云社区3.0';
include '../system/inc.php';
include './admin_config.php';
include './check.php';
check_qx($site_qx, '商品对接');
$nav = 'shop';
//商品信息
$result1 = mysql_query('select * from ' . flag . 'shop where id = ' . $_GET['id'] . ' and zid = ' . $zhu_id . '');
if ($row = mysql_fetch_array($result1)) {
    $xid = $row['xid'];
} else {
    die('非法操作');
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
    $jiuwu1 = $row['dkey1'];
    $jiuwu2 = $row['dkey2'];
    $jiuwu3 = $row['dkey3'];
    $jiuwu4 = $row['dkey4'];
    $yile1 = $row['yile1'];
    $yile2 = $row['yile2'];
    $yile3 = $row['yile3'];
    $yile4 = $row['yile4'];
}
if ($_GET['pingtai'] != '') {
    //账户查询
    $result1 = mysql_query('select * from  ' . flag . 'duijie where id = ' . $_GET['pingtai'] . ' and zid = ' . $zhu_id . ' ');
    if ($row = mysql_fetch_array($result1)) {
        $pingtai = $row['pingtai'];
        $pingtaiurl = $row['url'];
        $loginname = $row['loginname'];
        $loginpassword = $row['loginpassword'];
    }
    //亿乐
    if ($pingtai == 2) {
        $apiurl = 'http://' . $pingtaiurl . '/api/web/getGoodsList.html';
        $params = array();
        $paramsString = http_build_query($params);
        $content = @getCurl($apiurl);
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
        $params = array();
        $paramsString = http_build_query($params);
        $content = @getCurl($apiurl);
        $result = json_decode($content, true);
        $arr = json_decode($content, true);
        $data = call_user_func_array('array_merge_recursive', $arr['goods_rows']);
        //key为a的项所有值
        $sid = $data['id'];
        //商品ID
        $sname = $data['title'];
        //商品标题
        $goods_type = $data['goods_type'];
        //社区类型
        $goods_type_title = $data['goods_type_title'];
        //商品类型
        $unit = $data['unit'];
    }
    //商品单位
}
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
if (isset($_POST['提交'])) {
    //同系统查询商品模板
    if ($pingtai == 1) {
        $result1 = mysql_query('select * from  ' . flag . 'shop where ID = ' . $_POST['sid'] . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $xiadanid = $row['xid'];
        }
        //根据模板查询对接参数
        $result1 = mysql_query('select * from  ' . flag . 'moban where ID = ' . $xiadanid . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $zhuzhan1 = $row['key1'];
            $zhuzhan2 = $row['key2'];
            $zhuzhan3 = $row['key3'];
            $zhuzhan4 = $row['key4'];
        }
    }
    if ($_GET['pingtai'] == -1) {
        $dkey1 = $key1;
        $dkey2 = $key2;
        $dkey3 = $key3;
        $dkey4 = $key4;
        $_POST['duijie'] = -1;
        $_POST['sid'] = -1;
        goto a;
    } elseif ($pingtai == 1) {
        $dkey1 = $zhuzhan1;
        $dkey2 = $zhuzhan2;
        $dkey3 = $zhuzhan3;
        $dkey4 = $zhuzhan4;
    } elseif ($pingtai == 2) {
        $dkey1 = $yile1;
        $dkey2 = $yile2;
        $dkey3 = $yile3;
        $dkey4 = $yile4;
    } elseif ($pingtai == 3) {
        $jw = get95Post($_POST['sid'], $pingtaiurl, $loginname, $loginpassword);
        //print_r($jw);
        $j = $jw['post'];
        $j = explode(',', $j);
        //print_r($j);
        $dkey1 = $j['0'];
        $dkey2 = $j['1'];
        $dkey3 = $j['2'];
        $dkey4 = $j['3'];
        //die;
    } elseif ($pingtai == 4 or $pingtai == 5) {
        $dkey1 = $yile1;
        $dkey2 = $yile2;
        $dkey3 = $yile3;
        $dkey4 = $yile4;
    } else {
        $result1 = mysql_query('select * from  ' . flag . 'moban where ID = ' . $xiadanid . ' ');
        if ($row = mysql_fetch_array($result1)) {
            $zhuzhan1 = $row['key1'];
            $zhuzhan2 = $row['key2'];
            $zhuzhan3 = $row['key3'];
            $zhuzhan4 = $row['key4'];
        }
        $dkey1 = $zhuzhan1;
        $dkey2 = $zhuzhan2;
        $dkey3 = $zhuzhan3;
        $dkey4 = $zhuzhan4;
    }
    null_back($_POST['duijie'], '请选择对接账户!');
    null_back($_POST['sid'], '请输入对方商品ID!');
    if ($pingtai == 3) {
        null_back($_POST['sqlx'], '请输入社区类型!');
    }
    a:
    $_data['duijie'] = $_GET['pingtai'];
    $_data['duijiesid'] = $_POST['sid'];
    $_data['duijiekey1'] = $dkey1;
    $_data['duijiekey2'] = $dkey2;
    $_data['duijiekey3'] = $dkey3;
    $_data['duijiekey4'] = $dkey4;
    if ($_POST['fs'] != '') {
        $_data['duijiefs'] = $_POST['fs'];
    }
    $_data['duijiesqlx'] = $_POST['sqlx'];
    $_data['duijiecgzt'] = $_POST['duijiecgzt'];
	$_data['canshu'] = $_POST['canshu'];
    $str = arrtoinsert($_data);
    $sql = 'update ' . flag . 'shop set ' . arrtoupdate($_data) . ' where id = ' . $_GET['id'] . ' and zid = ' . $zhu_id . '';
    if (mysql_query($sql)) {
        alert_href('操作成功!', 'shop.php');
    } else {
        alert_back('对接失败!');
    }
}
//同系统查询主站ID
if ($pingtai == 1) {
    $result1 = mysql_query('select * from  ' . flag . 'zhuzhan_domain where name = "' . $pingtaiurl . '" ');
    if ($row = mysql_fetch_array($result1)) {
        $zhuzhanid = $row['zid'];
    }
}
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?=$site_ico?>"/> 
<script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_pic').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_pic').val(url);
				editor.hideDialog();
				}
			});
		});
	});
});
 </script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
 					<?php
					$resultshop = mysql_query('select * from  '.flag.'shop where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($resultshop)){
					?>
      <form method="post" id="form">
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading bg-gradient-vine">商品对接</div>
            <div class="panel-body">
                <div class="smart-widget-body">
                    <div class="form-horizontal">
					<input name="duijieid" id="duijieid" value="<?=$_GET['id']?>" placeholder="" class="form-control" type="hidden">
<input name="pingtai" id="pingtai" value="<?=$pingtai?>" placeholder="" class="form-control" type="hidden">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接账号</label>
                            <div class="col-lg-8">
                                <select name="duijie" id="duijie"  class="form-control" onchange="MM_jumpMenu('parent',this,0)">
                                    <option value="?id=<?=$_GET['id']?>">请选择对接账户</option>
                                    <?php $result1=mysql_query( 'select * from '.flag. 'duijie where zid = '.$zhu_id. '    order by ID asc '); while($row1=mysql_fetch_array($result1)){ ?>
                                    <option  pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>"  <?php if ($_GET['pingtai']==$row1['ID']){echo "selected";}?> value="?id=<?=$_GET['id']?>&pingtai=<?=$row1['ID']?>" value2="<?=$row1['ID']?>">    <?=$row1['name']?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php if ($_GET['pingtai']!='' ) {?>
                        <?php if ($pingtai==4) { ?>
                        <!-- 亿乐3.0-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接商品</label>
                            <div class="col-lg-8">
                                <select id="sid" class="form-control" onchange="ylshopcanshu()" name="sid">
                                    <option data-id=""><?=$message?>
                                    </option>
                                    <?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php }?>
						                        <?php if ($pingtai==5) { ?>
                        <!--聚梦-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接商品</label>
                            <div class="col-lg-8">
                                <select id="sid" class="form-control" onchange="jmshopcanshu()" name="sid">
                                    <option data-id=""><?=$message?>
                                    </option>
                                    <?php foreach($list as $key=>$val){ ?>
<option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" <?php  if($row['duijiesid']==$val['id'] ) {echo "selected";}?> data-id = "<?=$val['gid']?>" value="<?=$val['id']?>"> <?=$val['name']?>ID : [<?=$val['id']?>]</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php }?>
                        <?php if ($pingtai==1) { ?>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">对接商品</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <select class="form-control" name="sid" style="width:278px"><?php $result1=mysql_query( 'select * from '.flag. 'shop where zid = '.$zhuzhanid. '    order by ID asc '); while($row1=mysql_fetch_array($result1)){ ?><option <?php if($row['duijiesid']==$row1['ID'] ) {echo "selected";}?> value="<?=$row1['ID']?>">    <?=$row1['name']?></option><?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php if ($pingtai==2) { ?>
                        <!-- 亿乐-->
                        <div>
                            <div class="form-group" v-if="apiKind==='kyx'|| apiKind==='ksw' || apiKind==='klg'"></div>
                            <div class="form-group" v-else>
                                <label class="col-lg-3 control-label">对接商品</label>
                                <div class="col-lg-8">
                                    <select id="sid" class="form-control" onchange="aa()" name="sid"><?php for ($i=0 ; $i < sizeof($sid); $i++) { if ($api_status[$i]==1) ?><option <?php if($row['duijiesid']==$sid[$i] ) {echo "selected";}?>data-id="<?=$goods_type[$i]?>" value="    <?=$sid[$i]?>">        <?=$sname[$i]?></option><?php }?>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <?php if ($pingtai==3) { ?>
                            <!-- 玖伍-->
                            <div class="form-group">
                                <label class="col-lg-3 control-label">对接商品</label>
                                <div class="col-lg-8">
                                    <div class="input-group"><select id="sid" class="form-control" onchange="aa()" name="sid"><?php for ($i=0 ; $i < sizeof($sid); $i++) { if ($api_status[$i]==1) { $zt='<font  class="status4">完成</FONT>';} ?><option <?php if($row['duijiesid']==$sid[$i] ) {echo "selected";}?> data-id="<?=$goods_type[$i]?>" value="<?=$sid[$i]?>"><?=$sname[$i]?>ID:<?=$sid[$i]?>类型= <?=$goods_type[$i]?></option><?php }?></select>
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
                                    <select name="fs" class="form-control"><option <?php if ($row['duijiefs']==1) {echo "selected";}?> value="1">现金</option><option <?php if ($row['duijiefs']==0) {echo "selected";}?> value="0">卡密</option>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
							<div class="form-group">
<label class="col-lg-3 control-label">参数名</label>
<div class="col-lg-8">
<input name="canshu" id="canshu" class="form-control" value="<?=$row['canshu']?>" type="text"> <pre> <font color="green">对应输入框标题，多个参数请用|隔开!</font> </pre>
</div>
</div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">对接成功改变状态</label>
                                <div class="col-lg-8">
                                    <select name="duijiecgzt" class="form-control"><option <?php if ($row['duijiecgzt']==0) {echo "selected";}?> value="0">不改变</option><option <?php if ($row['duijiecgzt']==1) {echo "selected";}?> value="1">进行中</option><option <?php if ($row['duijiecgzt']==6) {echo "selected";}?> value="6">已完成</option>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            </form>
                        </div>
                    </div>
					</div>
                    <div class="panel-footer">
                        <input name="提交" class="btn btn-info pull-right" type="submit" id="提交" value="保存">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <?php }?>
</div>
<script type="text/javascript">
    function ylshopcanshu()
    {
        var vm = new Vue();
        var sid = $("#sid").find("option:selected").attr("value");
        var duijie = $("#duijie").find("option:selected").attr("value2");
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
        vm.$post("ajax.php?act=getyileGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data)
        {
            if (data.code === 0)
            {
				document.getElementById('canshu').value = data.canshu;
                vm.$message('成功获取参数', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<script type="text/javascript">
    function jmshopcanshu()
    {
        var vm = new Vue();
        var sid = $("#sid").find("option:selected").attr("value");
        var duijie = $("#duijie").find("option:selected").attr("value2");
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
        vm.$post("ajax.php?act=getjmGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data)
        {
            if (data.code === 0)
            {
				document.getElementById('canshu').value = data.canshu;
                vm.$message('成功获取参数', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<!-- 玖伍-->
<script type="text/javascript">
    function aa() {
        var vm = new Vue();
        var sid = $("#sid").find("option:selected").attr("value");
        var duijie = $("#duijie").find("option:selected").attr("value2");
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
		var sqlx = $("#sid").find("option:selected").attr("data-id");
		document.getElementById('sqlx').value = sqlx;
        vm.$post("ajax.php?act=getjiuwuGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data) {
            if (data.code === 0) {
				document.getElementById('canshu').value = data.post;
                vm.$message('成功获取参数', 'success');
            } else {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<?php include_once('footer.php');
?>
</body>
</html>