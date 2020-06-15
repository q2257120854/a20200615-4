<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'guanli';
check_qx($site_qx,'管理权限');
if($_GET['act'] =='del'){
	if($_SESSION['gly'])alert_href('删除失败!你无权限删除','');
	$sql = 'delete from '.flag.'guanli where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','guanli.php');
	}else{
		alert_back('删除失败！');
	}
}


if ($_POST['提交']=='增加')
{
	

		null_back($_POST['qx'],'请选择一个权限');
		if($_SESSION['gly'])alert_href('添加失败!你无权限添加','');
	$qx= implode(",",$_POST['qx']);
    $_data['zt'] = 1;//1开启
	$_data['loginname'] = $_POST['loginname'];
	$_data['loginpassword'] = $_POST['loginpassword'];
	$_data['qq'] = $_POST['qq'];
      $_data['zid'] = $zhu_id;

      $_data['qx'] = $qx;

 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'guanli ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('添加成功!','');
	}else{
		alert_href('添加失败!','');
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
                        管理员列表 - <a href="#" data-toggle="modal" data-target="#modal-notice"
                            class="btn-xs btn-danger">添加</a>（权限已经完美开发好）
                    </div>
                                         <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>ID</th>
                            <th>管理员账号</th>
                            <th>管理员密码</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
//无任何条件搜索 
	  $sql = 'select * from '.flag.'guanli   where zid = '.$zhu_id.'  and fid = 0  order by border desc , ID desc';
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){ 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="badge badge-info">
                              <?=$row['ID']?>
                            </a></td>
                             <td><span class="badge badge-warning"> <?=$row['loginpassword']?></td>
                            <td><span class="badge badge-primary"><a  href="<?=$row['loginpassword']?>" target="_blank"><?=$row['loginpassword']?></a></td>
                            <td>             
           <a  href="guanli_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
              
            <a  href="javascript:if(confirm('确定要删除吗?'))location='?act=del&id=<?=$row['ID']?>'"  class="btn-xs btn-warning" >删除</a></td>
</td>
                          </tr>
                          <? }?>
                        </tbody>
                      </table>
                    </div> 
                  <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>                     
                    </ul></nav></div> </div> </div>  
                               </div>
        </div>
                    <div class="smart-widget-footer text-center">
                        <pagination ref="pagination" :total="total" :current_page="search.page"
                                    :page_size="search.pageSize"
                                    @page-phange="pageChange"></pagination>
                    </div>
          </div>
      </div>
  </div>
</div>

                
        <div class="modal fade primary" id="modal-notice">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">管理员</h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-horizontal" role="form" id="Form" method="post">
                            <input type="hidden" name="action" value="store"/>
                           

                       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">状态</label>
                            <div class="col-sm-10">

  <select  name="zt" class="form-control" id="zt" >
                                                <option   value="1">启用</option>

                                                <option    value="0">禁用</option>


                                          </select>
                                                                      </div>
                        </div>

                       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">登录账号</label>
                            <div class="col-sm-10">
                              <input name="loginname" type="text" class="form-control" id="loginname" placeholder="请输入登录账号" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">登录密码</label>
                            <div class="col-sm-10">
                              <input name="loginpassword" type="text" class="form-control" id="loginpassword" placeholder="请输入登录密码" value="">
                            </div>
                        </div>
                        
                           <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">QQ</label>
                            <div class="col-sm-10">
                              <input name="qq" type="text" class="form-control" id="qq" placeholder="请输入QQ号码" value="">
                            </div>
                        </div>
                        
                      <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">权限</label>
                            <div class="col-sm-10">
                              
                              
                                    <label for="label2">权限管理：</label>
                          </dt>
						  <dd>
    <label>
        <input name="qx[]" type="checkbox" value="公告管理"><i>✓</i>公告管理</label>
    <label>
        <input name="qx[]" type="checkbox" value="系统设置"><i>✓</i>系统设置</label>
    <label>
        <input name="qx[]" type="checkbox" value="站点装饰"><i>✓</i>站点装饰</label>
    <label>
        <input name="qx[]" type="checkbox" value="客服管理"><i>✓</i>客服管理</label>
    <label>
        <input name="qx[]" type="checkbox" value="代理设置"><i>✓</i>代理设置</label>
		
		<label>
        <input name="qx[]" type="checkbox" value="克隆商品"><i>✓</i>克隆商品</label>
		<label>
        <input name="qx[]" type="checkbox" value="幻灯图片"><i>✓</i>幻灯图片</label>
    <label>
        <input name="qx[]" type="checkbox" value="平台短信"><i>✓</i>平台短信</label>
        <label>
            <input name="qx[]" type="checkbox" value="分站短信"><i>✓</i>分站短信</label>
</dd>
</dl>
<dl> <dt>
                            <label for="label2"></label>
                          </dt>
    <dd>
        <label>
            <input name="qx[]" type="checkbox" value="商品管理"><i>✓</i>商品管理</label>
        <label>
            <input name="qx[]" type="checkbox" value="商品对接"><i>✓</i>商品对接</label>
        <label>
            <input name="qx[]" type="checkbox" value="商品被对接"><i>✓</i>商品被对接</label>
        <label>
            <input name="qx[]" type="checkbox" value="分站管理"><i>✓</i>分站管理</label>
        <label>
            <input name="qx[]" type="checkbox" value="卡密管理"><i>✓</i>卡密管理</label>
        <label>
            <input name="qx[]" type="checkbox" value="自由对接"><i>✓</i>自由对接</label>
        <label>
            <input name="qx[]" type="checkbox" value="自动发货"><i>✓</i>自动发货</label>
        <label>
            <input name="qx[]" type="checkbox" value="供货权限"><i>✓</i>供货权限</label>
			        <label>
            <input name="qx[]" type="checkbox" value="管理权限"><i>✓</i>管理权限</label>
    </dd>
</dl>
              
              	
                <dl style="display:none">
                          <dt>
                           </dt>
						  <dd>
 				<label><input  name="z_qx11" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx12" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx13" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx14" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx15" value="1"  type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx16" value="1"   type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx17" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx18" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx19" value="1" type="checkbox"><i>✓</i></label> 
				<label><input  name="z_qx20" value="1" type="checkbox"><i>✓</i></label> 
             
                             </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">取消</button>
                          
                                              <input name="提交"  type="submit"  class="an-btn an-btn-success" id="" value="增加">
                        </form>
    
    
            
        </div>
    </div>
    </div></div>


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


?><? include_once( 'footer.php'); ?>
 </body>
</html>
