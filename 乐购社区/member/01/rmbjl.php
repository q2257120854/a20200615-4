  <? $nav = 'rmbjl';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>余额明细-<?=$site_name?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://assets.19sky.cn/member/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="http://assets.19sky.cn/member/css/font-awesome.min.css" rel="stylesheet">

    <!-- ionicons -->
    <link href="http://assets.19sky.cn/member/css/ionicons.min.css" rel="stylesheet">

    <!-- Morris -->
    <link href="http://assets.19sky.cn/member/css/morris.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="http://assets.19sky.cn/member/css/datepicker.css" rel="stylesheet"/>

    <!-- Animate -->
    <link href="http://assets.19sky.cn/member/css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="http://assets.19sky.cn/member/css/owl.carousel.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Simplify -->
    <link href="http://assets.19sky.cn/member/css/simplify.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/bootstrap-switch.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="http://assets.19sky.cn/member/css/toastr.min.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!-- Jquery -->    

    <script src="http://assets.19sky.cn/member/js/jquery-1.11.1.min.js"></script>
 
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
    
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

    <? require_once('m_left.php');?>



     <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-green">
                <div class="smart-widget-header">
                    余额明细                    <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="widget-refresh-option load-data-btn">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                  <div class="smart-widget-hidden-section">
                        <ul class="widget-color-list clearfix">
                            <li style="background-color:#20232b;" data-color="widget-dark"></li>
                            <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                            <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                            <li style="background-color:#2baab1;" data-color="widget-green"></li>
                            <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                            <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                            <li style="background-color:#e36159;" data-color="widget-red"></li>
                            <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                            <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                            <li style="background-color:#fff;" data-color="reset"></li>
                        </ul>
                    </div>
                    
                     <div class="list-group-item bg-grey" style="overflow: hidden;">
                       <form id="subform" name="subform" class="form-inline"  method="post">
                            <input type="text" class="hidden" disabled>
                            <div class="form-group">
                                <select name="xf_lx"   class="form-control" id="xf_qk">
                                    <option  <? if ($_POST['xf_lx']=='') {echo "selected";}?> value="">所有</option>
                                     <option  <? if ($_POST['xf_lx']==1) {echo "selected";}?> value="1">增加</option>
                                    <option  <? if ($_POST['xf_lx']==2) {echo "selected";}?> value="0">扣除</option>
 
                                </select>
                            </div>
                          
 
 
<script type="text/javascript" src="js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                                <input type="text"  value="<?=$_POST['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择开始时间">
                            
                             </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_POST['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                        </form>
              
                    </div>

                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    
                    
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>ID</th>
                                <th>消费前余额</th>
                                <th>消费金额</th>
                                <th>消费后余额</th>
                                <th>消费时间</th>
                                <th>详细</th>
                                <th>动作</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
				if ($zhu=='true'){		 
if ($_POST['xf_lx']!='' and  $_POST['date1']!='' and  $_POST['date2']!=''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"   and  xf_lx ='.$_POST['xf_lx'].' and  xf_date >= "'.$_POST['date1'].'"   and  xf_date <= "'.$_POST['date2'].'"  and zid = '.$zhu_id.'   order by ID desc , ID desc';}
elseif ($_POST['xf_lx']=='' and  $_POST['date1']!='' and  $_POST['date2']!=''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"     and  xf_date >= "'.$_POST['date1'].'"   and  xf_date <= "'.$_POST['date2'].'" and zid = '.$zhu_id.'   order by ID desc , ID desc';}
elseif ($_POST['xf_lx']!='' and  $_POST['date1']=='' and  $_POST['date2']==''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"   and  xf_lx ='.$_POST['xf_lx'].'  and zid = '.$zhu_id.'    order by ID desc , ID desc';}
else
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"  and zid = '.$zhu_id.'  order by ID desc , ID desc';}
}
else
{
if ($_POST['xf_lx']!='' and  $_POST['date1']!='' and  $_POST['date2']!=''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"   and  xf_lx ='.$_POST['xf_lx'].' and  xf_date >= "'.$_POST['date1'].'"   and  xf_date <= "'.$_POST['date2'].'"  and zid = '.$zhu_id.' and fid = '.$fen_id.'   order by ID desc , ID desc';}
elseif ($_POST['xf_lx']=='' and  $_POST['date1']!='' and  $_POST['date2']!=''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"     and  xf_date >= "'.$_POST['date1'].'"   and  xf_date <= "'.$_POST['date2'].'" and zid = '.$zhu_id.'   and fid = '.$fen_id.'   order by ID desc , ID desc';}
elseif ($_POST['xf_lx']!='' and  $_POST['date1']=='' and  $_POST['date2']==''  )	 
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"   and  xf_lx ='.$_POST['xf_lx'].'  and zid = '.$zhu_id.'    and fid = '.$fen_id.'  order by ID desc , ID desc';}
else
{$sql = 'select * from '.flag.'xfjl where hyname = "'.$member_name.'"  and zid = '.$zhu_id.'  and fid = '.$fen_id.'   order by ID desc , ID desc';}

}
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                              <tr>
                                <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                                  <?=$row['ID']?>
                                </a></td>
                                <td><?=$row['xf_qje']?></td>
                                <td><?=$row['xf_je']?></td>
                                <td><?=$row['xf_hje']?></td>
                                <td><?=$row['xf_date']?></td>
                                <td><?=$row['xf_qk']?></td>
                                <td><? if ($row['xf_lx']==0) {echo "扣除";}?><? if ($row['xf_lx']==1) {echo "增加";}?></td>
 
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
