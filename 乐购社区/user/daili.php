<?php 
 $title=''; 
 include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'daili';
check_qx($site_qx,'代理设置');


 

if(isset($_POST['提交'])){
	$_data['mid'] = $_POST['s_mid'];
	$_data['level1_price'] = $_POST['l_1'];
 	$_data['level2_price'] = $_POST['l_2'];
	$_data['level3_price'] = $_POST['l_3'];
	$_data['level4_price'] = $_POST['l_4'];
	$_data['level5_price'] = $_POST['l_5'];
	$_data['isktdl'] = $_POST['isktdl'];
  	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where ID = '.$fen_id.'';
	if(mysql_query($sql)){
		alert_href('设置成功!','daili.php');
	}else{
		alert_back('设置失败!');
	}
}


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>代理设置</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-blue">
                <div class="panel-heading bg-gradient-vine">
                    代理设置
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
                    <a href="#" class="widget-refresh-option">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    
                       
                    <div class="smart-widget-body">
                        <form class="form-horizontal" method="post" id="lotteryConfig">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户默认注册级别</label>
                                <div class="col-sm-10">
                                    <select name="s_mid" class="form-control" id="s_mid" v-model="is">

                                     <option <? if ($site_mid==1) {echo "selected";}?> value="1"><?=$site_level1_name?></option>
                                     <option <? if ($site_mid==2) {echo "selected";}?> value="2"><?=$site_level2_name?></option>
                                     <option <? if ($site_mid==3) {echo "selected";}?> value="3"><?=$site_level3_name?></option>
                                     <option <? if ($site_mid==4) {echo "selected";}?> value="4"><?=$site_level4_name?></option>
                                     <option <? if ($site_mid==5) {echo "selected";}?> value="5"><?=$site_level5_name?></option>
                        
                                    </select>
                                </div>
                            </div>
                            
                                                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户自助升级代理</label>
                                <div class="col-sm-10">
 <select name="isktdl" v-model="isktdl" class="form-control">
                                        <option  <? if ($site_isktdl==0) {echo "selected";}?> value="0">关闭自助开通</option>
                                        <option <? if ($site_isktdl==1) {echo "selected";}?> value="1">开启自助开通</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">开通<?=$site_level1_name?>价格</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" name="l_1" value="<?=$site_level1_price?>"
                                               class="form-control"
                                               placeholder="输入<?=$site_level1_name?>价格">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                                                        <div class="form-group">
                                <label class="col-sm-2 control-label">开通<?=$site_level2_name?>价格</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" name="l_2" value="<?=$site_level2_price?>"
                                               class="form-control"
                                               placeholder="输入<?=$site_level2_name?>价格">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                                                        <div class="form-group">
                                <label class="col-sm-2 control-label">开通<?=$site_level3_name?>价格</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" name="l_3" value="<?=$site_level3_price?>"
                                               class="form-control"
                                               placeholder="输入<?=$site_level3_name?>价格">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                                                        <div class="form-group">
                                <label class="col-sm-2 control-label">开通<?=$site_level4_name?>价格</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" name="l_4" value="<?=$site_level4_price?>"
                                               class="form-control"
                                               placeholder="输入<?=$site_level4_name?>价格">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                                                        <div class="form-group">
                                <label class="col-sm-2 control-label">开通<?=$site_level5_name?>价格</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" name="l_5" value="<?=$site_level5_price?>"
                                               class="form-control"
                                               placeholder="输入<?=$site_level5_name?>价格">
                                        <span class="input-group-addon">元</span>
                                    </div>
                                </div>
                            </div>
                            
                      
                    </div>
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
                        <input name="提交"   class="btn btn-purple"  value="保存" type="submit">
                         
                        </div>
                    </div>
                       </form>
                </div>
            </div>
        </div>
    </div>    </div> </div> </div>

 <? include('footer.php');
?>
 

<?  include('password.php');?>
 
 
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
