<?php $title='抽奖记录' ; include '../system/inc.php'; include './admin_config.php'; include './check.php'; $nav='turntable_record' ;  //同系统查询主站ID 

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'cjjl where ID = '.$_GET['id'].' and  zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','turntable_record.php');
	}else{
		alert_back('删除失败！');
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../editor/themes/default/default.css" />

    <style>
        th {
    text-align: center;
}

td {
    text-align: center;
}
    </style>


<div class="wrapper preload">
    <?php include( 'header.php'); ?>
    <div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">抽奖记录</div>
                                <div class="table-search-header">
                                    <div class="form-inline">
                                        <form id="subform" name="subform" class="form-inline" method="get">
                                            <div class="form-group">
                                                <select name="name" class="form-control">
                                                    <option selected value="">所有</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="zt" class="form-control">
                                                    <option selected value="">所有</option>
                                                    <option value="1">已发放</option>
                                                    <option value="0">未发放</option>
                                                </select>
                                            </div> <a class="btn btn-info" onclick="document.getElementById('subform').submit();return false"><i class="iconfont"></i>搜索</a>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <form action="" method="post">
                                            <input name="act" type="hidden" value="pl">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>用户</th>
                                                        <th>奖品信息</th>
                                                        <th>状态</th>
                                                        <th>中奖时间</th>
                                                        <th>发放时间</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												                            	<?php
						 /*
									$sql = 'select * from '.flag.'cjjl  where zid = '.$zhu_id.' order by corder desc , ID desc';
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								*/
								$sql = 'select * from '.flag.'cjjl  where zid = '.$zhu_id.' order by  ID desc';
								$result = mysql_query($sql);
							while($row= mysql_fetch_array($result)){
								$sql2 = 'select * from '.flag.'user  where zid = '.$zhu_id.' and id = '.$row['userid'].'  order by ID desc';
								$result2 = mysql_query($sql2);
								$row2= mysql_fetch_array($result2);
 							?>
                                                    <tr>
                                                        <td><?=$row2['name']?></td>
                                                        <td><?=$row['name']?></td>
                                                        <td><font color='green'>已发放</font>
                                                        </td>
                                                        <td><?=$row['zjtime']?></td>
                                                        <td><?=$row['fftime']?></td>
                                                        <td> <a href="javascript:if(confirm('确定要删除该记录吗?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-danger">删除</a> 
                                                        </td>
                                                        </td>
                                                    </tr>
							<? } ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="smart-widget-footer text-center">
                                        <nav class="text-center">
                                            <ul class="pagination" style="display: -webkit-inline-box;">
                                                <li class="active page-item"><a href="javascript:;" class="page-link">1</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 </div>
<?php include_once( 'footer.php'); ?>
</body>

</html>