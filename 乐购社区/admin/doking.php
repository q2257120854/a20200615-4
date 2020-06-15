<?php
$title='货源推荐';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'doking';
if(isset($_POST['对接'])){
	 null_back($_POST['c_name'],'请输入名称');
	 null_back($_POST['url'],'请输入域名');
 	
	 //检测主站域名
	 	$result = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$_POST['url'].'"  and zid ='.$zhu_id.' ');
					if ($row = mysql_fetch_array($result)){
		alert_back('操作失败:不可对接自身!!');
					}
	$_data['name'] = $_POST['c_name'];
 	$_data['pingtai'] = 1;
 	$_data['url'] = $_POST['url'];
	$_data['zid'] = $zhu_id;
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'duijie ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('添加对接账户成功!','duijie.php');
	}else{
		alert_back('添加失败!');
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?=$site_ico?>"/>
  <script src="assets/common/md5.min.js"></script>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



<div class="wrapper preload">
<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
                 <div class="an-content-body" style="padding: 8px" id="pjax-container"    >
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        货源推荐
                    </div>
                 
                 
                    <div class="panel-body">
					如果以下社区有不添加商品，诈骗，跑路等行为请联系我们
                        <div class="table-responsive">
                         <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>排名</th>
                                <th>名称</th>
                                <th>货源域名</th>
                                <th>押金</th>
                                <th>客服</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                             
                              <?php
					 
 
		$result = mysql_query('select * from '.flag.'tuijian  order by px asc , px desc');
 

						while($row = mysql_fetch_array($result)){
						 
						?>
						 <form id="addForm"  method="post">
                            	                              <tr>
                                <td><span class="badge badge-info"><?=$row['px']?></td>
                                <td><a   class="badge badge-success" target="_blank" href="https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&rsv_idx=1&tn=baidu&wd=<?=$row['name']?>&oq=yp&rsv_pq=fc3467770004c3fe&rsv_t=3181YWc25vbLDGvu3lYmp0xqpJ8wLVzdIT6KgJH%2FRXP77p%2B1QNsWUjbG3MY&rqlang=cn&rsv_enter=0"><?=$row['name']?></a></td>
                                   <td> <span class="badge badge-primary"><a  target="_blank" href="http://<?=$row['url']?>"><?=$row['url']?></td>
                                <td><span class="badge bg-gradient-yellow"><?=$row['money']?></td>
                                                                <td><a class="badge badge-success"><?=$row['qq']?></td>
                                <td><input type="hidden" name="c_name" value="<?=$row['name']?>"><input type="hidden" name="url" value="<?=$row['url']?>"><input name="对接"  type="submit"  class="btn btn-primary" id="对接" value="立刻对接">
 </tr> </form> <? }?>
                                  
                                                          
                            </tbody>
                        </table>
                        </div>
                         <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                    <li class="active page-item"><a href="javascript:;" class="page-link"></a></li> 
                 
                    
                    </ul></nav></div>
                    
                    </div>
                </div>
            </div>
        </div>
        <? include_once('footer.php');
?><? include_once('footer.php');?>
</body>
</html>