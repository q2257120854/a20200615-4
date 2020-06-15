 <?php
$nav='turntable';
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>转盘抽奖-<?=$site_name?>  </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://07imgmini.eastday.com/mobile/20181121/20181121_f614e1628f81693ee40913b38463033b_wmk.jpeg"/>
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
<div class="wrapper">
    <? require_once('m_head.php');?>

            <div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
                    <div class="row">
					<?php if($cjzt==0){die('未开启抽奖');}; ?>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">转盘抽奖 - 我的余额：{{ rmb }} 元 <span class="pull-right"><?=$cjprice?> 元/次</span>
                                </div>
                                <div class="panel-body" id="turntable-panel">
                                    <turntable ref="turntable" @start="start" :prize="turntable.prizes" :width="turntable.width"></turntable>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">抽奖记录</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>奖品名称</th>
                                                    <th>状态</th>
                                                    <th>中奖时间</th>
                                                    <th>发放时间</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
						 /*
									$sql = 'select * from '.flag.'cjjl  where zid = '.$zhu_id.' order by corder desc , ID desc';
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								*/
								$sql = 'select * from '.flag.'cjjl  where zid = '.$zhu_id.' and userid = '.$member_id.' order by  ID desc';
								$result = mysql_query($sql);
							while($row= mysql_fetch_array($result)){
 							?>
                                                    <tr>
                                                        <td><?=$row['name']?></td>
                                                        <td><font color='green'>已发放</font></td>
                                                        <td><?=$row['zjtime']?></td>
                                                        <td><?=$row['fftime']?></td>
                                                    </tr>
							<? } ?>
                                                <tr>
                                                    <td colspan="100" class="text-center">
                                                        <pagination :data="data" v-on:pagination-change-page="getList" :limit="0"></pagination>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
    </div><!-- /main-container -->


 <? //require_once('m_footer.php');?>
        <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/moment.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/daterangepicker.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/wow.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/perfect-scrollbar.jquery.min.js"
            type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/selectize.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/owl.carousel.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/Chart.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/circle-progress.min.js" type="text/javascript"></script>

    <!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   -->
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/customize-chart.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/scripts.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.pjax.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/layer/layer.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/js/admin/main.js?v=3.0.9"></script>
<script>
        new Vue({
            el: '#vue',
            data: {
                rmb: '<?=$member_point?>',
                lock: false,
                turntable: {
                    prizes: [],
                    width: 600
                },
                search: {
                    page: 1,
                    action_: 0
                },
                data: {},
            },
            created() {
                this.$set(this.turntable, 'width', $("#turntable-panel").width() - 20);
            },
            methods: {
                getTurntable() {
                    let vm = this;
                    this.$post("/turntable.php?act=list", {
                        action: 'turntablePrize'
                    }).then(function(data) {
                        if (data.status === 0) {
                            vm.$set(vm.turntable, 'prizes', data.data);
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
                },
                start() {
                    let vm = this;
                    if (vm.lock) return;
                    vm.lock = true;
                    this.$post("/turntable.php?act=start", {
                        action: 'turntable'
                    }).then(function(data) {
                        if (data.status === 0) {
                            vm.rmb = data.rmb;
                            var prize = parseInt(data.prize);
                            vm.turntable.prizes.forEach(function(item, i) {
                                //if (item.id === prize) {
                                    vm.$refs.turntable.rotate(i, function() {
                                        vm.$message(data.message, 'error');
                                        vm.lock = false;
                                        vm.getList();
                                    });
                                //}
                            });
                        } else {
                            vm.lock = false;
                            vm.$message(data.message, 'error');
                        }
                    })
                }
            },
            mounted: function() {
                this.getTurntable();
                this.getList();
            }
        });
    </script>
  </body>
</html>
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