<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'usermj_add';

    
if(isset($_POST['提交'])){
	 null_back($_POST['uid'],'请输入用户UID');
	null_back($_POST['kind'],'请输入密价前缀');
	 null_back($_POST['rate'],'请输入选择密价内容');
	$uid=$_POST['uid'];
	$kind=$_POST['kind'];
	$rate=$_POST['rate'];
	$_data['uid'] = $uid; 
	$_data['kind'] = $kind; 
	$_data['rate'] = $rate; 
	$_data['sj'] = $sj;
	$_data['zid'] = $zhu_id; 
 	$str = arrtoinsert($_data);
	$sql1 = 'insert into '.flag.'mj ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql1)){
alert_href('创建成功!','usermj.php');
	}else{
		alert_back('创建失败!');
	}
}




 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>创建密价</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="assets/style/font-awesome_4.6.3/css/font-awesome.min.css?" rel="stylesheet">

    <!-- ionicons -->
    <link href="assets/style/css/ionicons.min.css?" rel="stylesheet">

    <!-- Morris -->
    <link href="assets/style/css/morris.css?" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="assets/style/css/datepicker.css?" rel="stylesheet"/>

    <!-- Animate -->
    <link href="assets/style/css/animate.min.css?" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="assets/style/css/owl.carousel.min.css?" rel="stylesheet">
    <link href="assets/style/css/owl.theme.default.min.css?" rel="stylesheet">

    <!-- Simplify -->
    <link href="assets/style/css/simplify.min.css?" rel="stylesheet">
    <link href="assets/common/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css?"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/common/toastr/toastr.min.css?">
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>

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

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
 					 
    <form method="post" id="form">
   
                     <div class="row">
                <div class="an-helper-block">
                    <div class="an-small-doc-blcok  warning">规则说明：
                        <br>一个用户只能有一个密价规则！
                        <br>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-vine">所属用户 </a>
               </ul>
               </div>
                           </div>
                               </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">所属用户</label>
                                    <div class="col-sm-9">
                                        <select name="uid" class="form-control" v-model="storeInfo.uid" @change="changeGoods">
                                            <option value="">请选择所属会员</option>
<?php
    $sql = 'select * from ' . flag . 'user  where zid = ' . $zhu_id . '    order by ID desc , ID desc';
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    $m_name = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['name']);
    $m_qq = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['qq']);
    $m_id = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['ID']);
 							?>
								<option value="<?=$row['ID']?>"><?=$m_name?> 编号[<?=$row['ID']?>]</option>
                              <? }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">密价方式</label>
                                    <div class="col-sm-9">
                                        <select name="kind" class="form-control" v-model="storeInfo.kind">
                                            <option value="0">成本价+百分比加价</option>
                                            <option value="1">成本价+固定价格加价</option>
                            </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" value="固定加价">密价价格</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="rate" :placeholder="输入固定密价价格（列如:0.1）">
                                    </div>
                                </div>
                              
                        </div>    </div>    </div>   
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="创建">



</div>
                </div>
            </div>
        </div>
    </form>
 
 
</div>

        </div>
    </div><!-- /main-container -->

<?  include('password.php');?>
  </body>
</html>
