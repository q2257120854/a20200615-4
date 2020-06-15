 
<? $nav = 'log';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>登陆日志-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
       <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
	
	.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
	
    </style>
    <script>
function sum() {
	var n1 = document.getElementById("czje").value;
	var n2 = document.getElementById("sxf").value;
 
	document.getElementById("payInput").value = parseInt(n1)+parseInt(n1)*(parseInt(n2)/100);
}
</script>
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>
            <div class="an-content-body" style="padding: 8px" id="pjax-container">
          <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        登陆记录
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>ID</th>
                                <th>登录IP</th>
                                <th>登录时间</th>
                                <th>方式</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
									$sql = 'select * from '.flag.'login_log where hyname = "'.$member_name.'"   and zid ='.$zhu_id.' order by ID desc , ID desc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                              <tr>
                                <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                                  <?=$row['ID']?>
                                </a></td>
                                <td><?=$row['ip']?></td>
                                <td><?=$row['date']?></td>
                                <td><?=$row['qk']?></td>
                              </tr>
                              <? }?>
                             
                            </tbody>
                        </table>
                        </DIV>     </div>
                   <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> </div> </div> 
                       
                
                    
                </div>
            </div>
        </div>
    </div>	
 <? require_once('m_footer.php');?>

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


?> </body>
</html>
