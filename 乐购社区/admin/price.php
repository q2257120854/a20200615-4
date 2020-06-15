<?php 
$title='加价模板列表';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'price';
check_qx($site_qx,'商品管理');

if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'price where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','price.php');
	}else{
		alert_back('删除失败！');
	}
}

 

if(isset($_POST['提交'])){
	 null_back($_POST['name'],'请输入模板名称');
  	non_numeric_back($_POST['p_1'],'请输入'.$site_level1_name.'加价');
  	non_numeric_back($_POST['p_2'],'请输入'.$site_level2_name.'加价');
  	non_numeric_back($_POST['p_3'],'请输入'.$site_level3_name.'加价');
  	non_numeric_back($_POST['p_4'],'请输入'.$site_level4_name.'加价');
  	non_numeric_back($_POST['p_5'],'请输入'.$site_level5_name.'加价');
	non_numeric_back($_POST['moshi'],'请输入加价方式');
	
	$_data['p_name'] = $_POST['name'];
	$_data['p_level1'] = $_POST['p_1'];
 	$_data['p_level2'] = $_POST['p_2'];
 	$_data['p_level3'] = $_POST['p_3'];
 	$_data['p_level4'] = $_POST['p_4'];
 	$_data['p_level5'] = $_POST['p_5'];
	$_data['kind'] = $_POST['moshi'];
 	$_data['zid'] = $zhu_id;
 	$_data['fid'] = 0;
	$_data['p_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'price ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('新增成功!','price.php');
	}else{
		alert_back('新增失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://assets.19sky.cn/assets/js/left1.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/left.js" type="text/javascript"></script>  
      <script src="http://assets.19sky.cn/assets/js/scripts.js" type="text/javascript"></script>
         <script src="http://assets.19sky.cn/assets/js/layer.js" type="text/javascript"></script>
        <script src="http://assets.19sky.cn/assets/js/main.js"></script>
		<link rel="stylesheet" href="./css/layer.css" id="layuicss-layer">
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
 
  <div class="an-content-body" style="padding: 8px" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        对接加价- <a href="#" data-toggle="modal" data-target="#modal-add"
                                    class="btn-xs btn-danger">添加</a>
                    </div>
                     <div class="panel-body">
                   
                      <form id="search_form" name="search_form" role="form" class="form-inline">
                      
                      
                           <input type="text" disabled="disabled" class="hidden">  <div class="form-group"><input type="text" placeholder="加价模板名称"  name='key' class="form-control"></div> <a onClick="document:search_form.submit();"   class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>
                    </div>
                    <div class="panel-heading bg-gradient-blue">
                        加价百分比说明：加价百分比设置0.2，相当于加价20%。则用户价格为你设定成本价*（1+0.2）。<br>
                        举例：你成本价100元的商品，设置加价0.2，则用户价格为120元！<br> <font color="red">简单说就是拿货价1元的商品，你想赚取多少元钱！</font></div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>模板名称</th>
                                <th><?=$site_level1_name?></th>
                                <th><?=$site_level2_name?></th>
                                <th><?=$site_level3_name?></th>
                                <th><?=$site_level4_name?></th>
                                <th><?=$site_level5_name?></th>
								<th>加价方式</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 if ($_GET['key']!='')
						 {  $sql = 'select * from '.flag.'price where p_name like "%'.$_GET['key'].'%"  and   zid = '.$zhu_id.' and fid = 0  order by ID desc , ID desc';}

 						 else
						 {  $sql = 'select * from '.flag.'price where  zid = '.$zhu_id.' and fid = 0  order by ID desc , ID desc';}
 							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $p_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['p_name']);
						 
 							?>
                              <tr>
                                <td><span class="badge badge-info"><?=$p_name?></a></td>
                                <td><a class="badge badge-success"><?=get_xiaoshu($row['p_level1'],6)?></a></td>
                                <td><span class="badge badge-primary"><?=get_xiaoshu($row['p_level2'],6)?></a></td>
                                <td><span class="badge badge-warning"><?=get_xiaoshu($row['p_level3'],6)?></a></td>
                                <td><span class="badge badge-primary"><?=get_xiaoshu($row['p_level4'],6)?></a></td>
                                <td><span class="badge badge-warning"><?=get_xiaoshu($row['p_level5'],6)?></a></td>
								<td><span class="badge badge-primary"><?php if($row['kind']==0){echo '固定单价';} else { echo '百分比'; }?></td>
                                <td><span class="badge bg-gradient-yellow"><?=$row['p_date']?></td>
                                <td><a  href="price_edit.php?id=<?=$row['ID']?>" class="btn-xs btn-info">修改</a>
                                
                                 <a  href="javascript:if(confirm('确实要删除该定价吗?'))location='?act=del&id=<?=$row['ID']?>'" class="btn-xs btn-warning">删除</a></td>
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
<script language="javascript">

function getjisuan($type) {
	
 	var p_1 = document.getElementById("p_1").value;
	var p_2 = document.getElementById("p_2").value;
	var p_3 = document.getElementById("p_3").value;
	var p_4 = document.getElementById("p_4").value;
	var p_5 = document.getElementById("p_5").value;
	var dianshu = document.getElementById("dianshu").value;
	var money = document.getElementById("money").value;
	var chengben = Number(document.getElementById("chengben").value);
	var jieguo =money/dianshu;
	var bili =document.getElementById("bili").value;
	
		 if (chengben==''){alert('请输入成本价格!');}


 if ($type=='rmb') {
		 if (money==''){alert('请输入金额!');}



   	document.getElementById("p_5").value = money/dianshu;
  	document.getElementById("price5").innerHTML = '加价后价格:'+(chengben+Number( money/dianshu));
 	document.getElementById("p_4").value = (money/dianshu)+(money/dianshu);
  	document.getElementById("price4").innerHTML = '加价后价格:'+(chengben+Number((money/dianshu)+(money/dianshu)));
 	document.getElementById("p_3").value = (money/dianshu)+(money/dianshu)+(money/dianshu);
  	document.getElementById("price3").innerHTML = '加价后价格:'+(chengben+Number((money/dianshu)+(money/dianshu)+(money/dianshu)));
 	document.getElementById("p_2").value = (money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu);
  	document.getElementById("price2").innerHTML = '加价后价格:'+(chengben+Number( (money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu)));
 	document.getElementById("p_1").value =  (money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu);
  	document.getElementById("price1").innerHTML = '加价后价格:'+(chengben+Number((money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu)+(money/dianshu)));
 }
 
 
  if ($type=='baifenbi') {
	  		 if (bili==''){alert('请输入百分比!');}



  	document.getElementById("p_5").value = toDecimal2(bili);
  	document.getElementById("price5").innerHTML = '加价后价格:'+toDecimal2(chengben*(1+bili*1));
  	document.getElementById("p_4").value = toDecimal2(bili*2);
  	document.getElementById("price4").innerHTML = '加价后价格:'+toDecimal2(chengben*(1+bili*2));
  	document.getElementById("p_3").value =  toDecimal2(bili*3);
  	document.getElementById("price3").innerHTML = '加价后价格:'+toDecimal2(chengben*(1+bili*3));
  	document.getElementById("p_2").value = toDecimal2(bili*4);
  	document.getElementById("price2").innerHTML = '加价后价格:'+toDecimal2(chengben*(1+bili*4));
  	document.getElementById("p_1").value = toDecimal2(bili*5);
  	document.getElementById("price1").innerHTML = '加价后价格:'+toDecimal2(chengben*(1+bili*5));
 }



 
}
 function toDecimal2(x) { 
  var f = parseFloat(x); 
  if (isNaN(f)) { 
  return false; 
  } 
  var f = Math.round(x*100)/100; 
  var s = f.toString(); 
  var rs = s.indexOf('.'); 
  if (rs < 0) { 
  rs = s.length; 
  s += '.'; 
  } 
  while (s.length <= rs + 2) { 
  s += '0'; 
  } 
  return s; 
 } 

</script>
	<script type="text/javascript">
	   
    function getmoshi(){
    var name = $("#moshi").find("option:selected").attr("data-name");
    var moshi = $("#moshi").find("option:selected").attr("value");
 	  
      document.getElementById('p_1').placeholder=name;document.getElementById('p_2').placeholder=name;document.getElementById('p_3').placeholder=name;document.getElementById('p_4').placeholder=name;document.getElementById('p_5').placeholder=name;
 
 
if (moshi=='0')
{    document.getElementById("guding").style.display = "block";document.getElementById("baifenbi").style.display = "none";};
if (moshi=='1')
{    document.getElementById("guding").style.display = "none";document.getElementById("baifenbi").style.display = "block";};

      }
	      
   
 function getupdate($id,$t0,$t1,$t2,$t3,$t4,$t5,$t6) {
 
	 
                document.getElementById("modal-update").style.display = "block";				
  			    document.getElementById("id").value = $id;				
			    document.getElementById("p_name").value =$t0;				
			    document.getElementById("p_1").value =$t1;				
			    document.getElementById("p_2").value =$t2;				
			    document.getElementById("p_3").value =$t3;				
			    document.getElementById("p_4").value =$t4;				
			    document.getElementById("p_5").value =$t5;				
			    document.getElementById("p_moshi").value =$t6;		
  	
 }
  function closemsg() 
  {document.getElementById("modal-update").style.display = "none"; }
  


</script>
    <div class="modal" id="modal-sort">
        <div class="modal-dialog"></div>
    </div>
          <div id="modal-add" class="modal fade primary" style="display: none;">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">新增商品价格模板</h4>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="post" class="form-horizontal">
                        <input type="hidden" name="action" value="store">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">模板名称</label>
                            <div class="col-sm-9">
                                <input name="name" id="" placeholder="请输入模板名称" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">价格模式</label>
                            <div class="col-sm-9">
                                <select name="moshi" id="moshi" onchange="getmoshi()" class="form-control">
                                    <option data-name="请输入加价价格(元)" value="0">固定金额</option>
                                    <option data-name="请输入加价百分比" value="1">百分比</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">假设成本价</label>
                            <div class="col-sm-9">
                                <input type="text" id="chengben" class="form-control"> <pre>仅仅作为下面预览，无实际意义。</pre>
                            </div>
                        </div>
                        <div class="modal-body bg-grey" style="margin-top: -30px;">
                            <div class="list-group-item">差价递加工具：</div>
                            <div id="guding" class="list-group-item">
                                <div class="form-inline">按
                                    <select id="dianshu" class="form-control">
                                        <option value="1">1 点</option>
                                        <option value="10">10 点</option>
                                        <option value="100">1百 点</option>
                                        <option value="1000">1千 点</option>
                                        <option value="10000">1万 点</option>
                                        <option value="100000">十万 点</option>
                                    </select>固定差价递加
                                    <input type="number" id="money" placeholder="输入金额" class="form-control"> <a type="button" onclick="getjisuan('rmb')" class="btn btn-primary">计算并填入</a>
                                </div>
                            </div>
                            <div id="baifenbi" class="list-group-item" style="display: none;">
                                <div class="form-inline">按
                                    <input type="text" id="bili" placeholder="输入0-1的小数" class="form-control">百分比递加 <a type="button" onclick="getjisuan('baifenbi')" class="btn btn-primary">计算并填入</a>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 5px !important;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=$site_level1_name?>加价</label>
                            <div class="col-sm-9 form-inline">
                                <input placeholder="请输入加价价格(元)" type="text" name="p_1" id="p_1" class="form-control">
                                <div id="price1" class="form-control" style="color: red;">加价后价格:</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=$site_level2_name?>加价</label>
                            <div class="col-sm-9 form-inline">
                                <input placeholder="请输入加价价格(元)" type="text" name="p_2" id="p_2" class="form-control">
                                <div id="price2" class="form-control" style="color: red;">加价后价格:</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=$site_level3_name?>加价</label>
                            <div class="col-sm-9 form-inline">
                                <input placeholder="请输入加价价格(元)" type="text" name="p_3" id="p_3" class="form-control">
                                <div id="price3" class="form-control" style="color: red;">加价后价格:</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=$site_level4_name?>加价</label>
                            <div class="col-sm-9 form-inline">
                                <input placeholder="请输入加价价格(元)" type="text" name="p_4" id="p_4" class="form-control">
                                <div id="price4" class="form-control" style="color: red;">加价后价格:</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=$site_level5_name?>加价</label>
                            <div class="col-sm-9 form-inline">
                                <input placeholder="请输入加价价格(元)" type="text" name="p_5" id="p_5" class="form-control">
                                <div id="price5" class="form-control" style="color: red;">加价后价格:</div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="an-btn an-btn-danger">取消</button>
                     <input name="提交" type="submit"  class="an-btn an-btn-success" value="添加"></form>
                </div>
            </div>
        </div>
    </div>    </div><!-- /main-container -->

 

</div><!-- /wrapper -->


 
  <? 
				  function xiaoyewl_pape($t0, $t1, $t2, $t3) {
    global $_GET;
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
    $page_er=$_GET['pager'];
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
    if($page_er)include($page_er);
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
