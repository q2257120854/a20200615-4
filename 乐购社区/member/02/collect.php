<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>我的收藏-<?=$site_name?> </title>
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
<? require_once('m_head.php');?>

<div class="an-content-body"   id="pjax-container">

<div id="vue">
    <section id="class20" class="wraper mi-parts" style="margin-top:-50PX">
            <br/><br/><h2 class="m-hdL">我的收藏 (Collect)</h2>
        <section class="m-box line2">
            <div class="span16">
                <div class="m-slide">
                    <div class="m-slide-contain">
                        <div class="m-slide-item active">
                            <div class="row">
							<?php
							$sql = 'select * from '.flag.'shoucang where hyid = '.$member_id.' and zid ='.$zhu_id.' order by ID desc , ID desc';
							$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
								$pic=get_shop($row['sid'],'pic');
								$name=get_shop($row['sid'],'name')
							?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$name?></h3>
    </div>
    <div class="panel-body">
        <div title="取消收藏" onclick="delcol(<?=$row['sid']?>)" class="btn btn-default">已收藏</div>
		<div class="btn btn-default" onclick="window.open('/index/home/order/id/<?=$row['sid']?>.html')">立即购买</div>
    </div>
</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
<div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div>
</div>

        </div>
    </div><!-- /main-container -->

 <? require_once('m_footer.php');?>

<?php
$result = mysql_query('select * from '.flag.'shoucang  where  sid ='.$_GET['id'].' and hyid = '.$member_id.' and zid = '.$zhu_id.' ');
if ($row = mysql_fetch_array($result))
{
?>
<script>
       $(document).ready(function () {
        $("#getcollectdel").click(function () {
           if(confirm("您确定要取消收藏商品《测试》？"))
 {
          var vm = new Vue();
  		 vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: <?=$_GET['id']?>})
             .then(function (data) {
              if (data.status === 0) {
                 vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
       
            });  }
        });
      });
 
		   
		function delcol($gid){
   var vm = new Vue();
  		 vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: $gid})
             .then(function (data) {
              if (data.status === 0) {
                 vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
			  });  
			}
       </script>
<?php
}else{
?>
 <script>
       $(document).ready(function () {
        $("#getcollect").click(function () {
          var vm = new Vue();
  		 vm.$post("/ajax.php?act=collect", {action: 'collect', gid: <?=$_GET['id']?>})
             .then(function (data) {
              if (data.status == 0) {
                 vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
            });
        });
      });
	  	  
 
		   
		function delcol($gid){
   var vm = new Vue();
  		 vm.$post("/ajax.php?act=collect", {action: 'delcollect', gid: $gid})
             .then(function (data) {
              if (data.status === 0) {
                 vm.$message(data.message, 'success');
                $.pjax.reload('#pjax-container');
              } else {
                vm.$message(data.message, 'error');
              }
			  });  
			}
       </script>
<?php
}
?>
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
		$page_back = '<li class="page-item"><a class="page-link" href="/member/collect.php?id='.$_GET['id'].'&page='.($page_current - 1).'" " title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a  href="/member/collect.php?id='.$_GET['id'].'&page='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="/member/collect.php?id='.$_GET['id'].'&page='.$page_sum.'"    class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="/member/collect.php?id='.$_GET['id'].'&page='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


	 function get_shopzt($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['duijiecgzt'];
	} else {
		return '0';
	}
}

?>
  </body>
</html>
