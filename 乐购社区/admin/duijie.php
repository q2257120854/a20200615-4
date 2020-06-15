<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'duijie';
check_qx($site_qx,'商品对接');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'duijie where id = '.$_GET['id'].' and  zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		
			$sql = 'update  '.flag.'shop  set duijie  = 0,duijiesid=null,duijiekey1="",duijiekey2="",duijiekey3="",duijiekey4=""  where duijie = '.$_GET['id'].' and  zid = '.$zhu_id.'';
	  mysql_query($sql);
 		
		alert_href('删除成功!','duijie.php');
	}else{
		alert_back('删除失败！');
	}
}

 

if(isset($_POST['分类'])){
	 null_back($_POST['c_name'],'请输入名称');
	 if ($_POST['pingtai']==4)
	 { 
	 null_back($_POST['yileid'],'请输入TokenID');
	 null_back($_POST['yilekey'],'请输入亿乐密钥');
	 }elseif ($_POST['pingtai']==5)
	 { 
	 null_back($_POST['jmid'],'请输入用户id');
	 null_back($_POST['jmkey'],'请输入KEY');
	 }
	 else
	 	 { 
	 null_back($_POST['loginname'],'请输入登录账号');
	 null_back($_POST['loginpassword'],'请输入登录密码');
	 }
	 null_back($_POST['url'],'请输入域名');
 	
	 //检测主站域名
	 	$result = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$_POST['url'].'"  and zid ='.$zhu_id.' ');
					if ($row = mysql_fetch_array($result)){
		alert_back('操作失败:不可对接自身!!');
					}

 	
	
	$_data['name'] = $_POST['c_name'];
	$_data['loginname'] = $_POST['loginname'];
	if ($_POST['pingtai']==4)
	{
    $_data['loginname'] = $_POST['yileid'];
	$_data['loginpassword'] = $_POST['yilekey'];	}
	elseif ($_POST['pingtai']==5)
	{
    $_data['loginname'] = $_POST['jmid'];
	$_data['loginpassword'] = $_POST['jmkey'];	}
	else
 	{
    $_data['loginname'] = $_POST['loginname'];
	$_data['loginpassword'] = $_POST['loginpassword'];
	
	}
 	$_data['pingtai'] = $_POST['pingtai'];
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
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>
        <script type="text/javascript">
			
	window.onload =function() {document.getElementById('content2').style.display='none';document.getElementById('content3').style.display='none';}

   function getduijie(){
    var pingtai = $("#pingtai").find("option:selected").attr("data-url");
//     document.getElementById('zfurl').value=url;
 if(document.getElementById('pingtai').value=='4')
{document.getElementById('content3').style.display='none';
document.getElementById('content2').style.display='block';
document.getElementById('content1').style.display='none';}
else{
if(document.getElementById('pingtai').value=='5')
{document.getElementById('content3').style.display='block';
document.getElementById('content2').style.display='none';
document.getElementById('content1').style.display='none';}
else
{
document.getElementById('content2').style.display='none';
document.getElementById('content3').style.display='none';
document.getElementById('content1').style.display='block';}
}
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
<div class="wrapper preload">
 
  <div class="an-content-body" style="padding: 8px" id="pjax-container"    >
                    <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        社区列表 - <a href="#" data-toggle="modal" data-target="#modal-add"
                                    class="btn-xs btn-danger">添加</a>
                    </div>

                  
                    <div class="list-group-item bg-grey" style="overflow: hidden;">                     
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>对接平台</th>
                                <th>对接域名</th>
                                <th>账户</th>
                                <th>密码</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
									$sql = 'select * from '.flag.'duijie  where zid = '.$zhu_id.' order by id asc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $c_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                              <tr>
                                <td><span class="badge badge-info"> <?=$c_name?></td>
                                <td><a class="badge badge-success"> <? if ($row['pingtai']==1){echo '同系统社区';}?>
								<? if ($row['pingtai']==4){echo '亿乐3.0社区';}?>
								<? if ($row['pingtai']==2){echo '亿乐2.0社区';}?><? if ($row['pingtai']==3){echo '玖伍社区';}?><? if ($row['pingtai']==5){echo '聚梦社区';}?></a></td>
                                <td><span class="badge bg-gradient-yellow"><?=$row['url']?></td>
                                <td><span class="badge badge-primary"><?=$row['loginname']?></td>
                                <td><span class="badge badge-warning"><?=$row['loginpassword']?></td>
                                <td><a  href="duijie_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要删除该对接账户吗 删除后原有的商品对接将会被取消?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-warning">删除</a></td>
                              </tr>
                              <? }?>
                             
                            </tbody>
                        </table>
                  </DIV>
                  <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> </div> </div>  
                       
                       
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

   <div class="modal" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>添加对接平台</h4></div>
                </div>
                <div class="modal-body">
                    <form id="addForm"  method="post">
 
                              <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                  <input type="text" class="form-control" name="c_name" placeholder="输入对接名称">


                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
             <select class="form-control"   onchange="getduijie()"  name="pingtai" id="pingtai">
<option  <? if ($row['pingtai']==1) {echo "selected";}?> value="1">同系统社区 </option>
                                                <option  <? if ($row['pingtai']==2) {echo "selected";}?> value="2">亿乐2.0社区</option>
                                                <option  <? if ($row['pingtai']==3) {echo "selected";}?> value="3">玖伍社区</option>
                                                   <option  <? if ($row['pingtai']==4) {echo "selected";}?> value="4">亿乐3.0社区</option>
												   <option  <? if ($row['pingtai']==5) {echo "selected";}?> value="5">聚梦社区</option>
</select>

                            </div>
                        </div>



                         
                              <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                  <input type="text" class="form-control" name="url" placeholder="输入站点域名(不带http://)">


                            </div>
                        </div>
                          
                          
                              <div id="content1">
                              
                              
                              <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                  <input type="text" class="form-control" name="loginname" placeholder="请输入社区账户">


                            </div>
                        </div>
                        
                        
                            
                               <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                  <input type="text" class="form-control" name="loginpassword" placeholder="请输入社区密码">


                            </div>
                        </div>
                        
                        
                            
                          
              
              </div>
              
              
                   <div id="content2">
                   
                         <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
 <input type="text" class="form-control" name=""   value="<?=$_SERVER['SERVER_ADDR']?>" readonly>

                            </div>
                        </div>
                        
                                 <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
  <input type="text" class="form-control" name="yileid" id="yileid" placeholder="输入您的TokenID">
                            </div>
                        </div>
                        
                        
                        
                           <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
  <input type="text" class="form-control" name="yilekey" id="yilekey" placeholder="请输入您的亿乐社区密钥">
                            </div>
                        </div>
                </div>
				
				<div id="content3">
                   
                         <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
 <input type="text" class="form-control" name=""   value="<?=$_SERVER['SERVER_ADDR']?>" readonly>

                            </div>
                        </div>
                        
                                 <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
  <input type="text" class="form-control" name="jmid" id="jmid" placeholder="输入您的用户ID">
                            </div>
                        </div>
                        
                        
                        
                           <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
  <input type="text" class="form-control" name="jmkey" id="jmkey" placeholder="请输入您的KEY">
                            </div>
                        </div>
                </div>
              
              
                </div>
                <div class="modal-footer">
                
                  <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">关闭</button>
                                     <input name="分类"  type="submit"  class="an-btn an-btn-success" id="分类" value="增加">

                </div>
                       </form>
            </div>
            
            
        </div>
    </div >  
   
 

 <? include('footer.php');
?>
 <!-- /wrapper -->


 
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
 <? include_once('footer.php');
?></body>
</html>
