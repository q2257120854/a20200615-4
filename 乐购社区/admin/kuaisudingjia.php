<?php
$title='快速定价';
include '../system/inc.php';
include './admin_config.php';
include './check.php';
$nav = 'kuaisudingjia';
check_qx($site_qx, '商品管理');?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="../assets/layer/theme/default/layer.css" id="layuicss-layer">
<? include( 'header.php'); ?>


    <div class="wrapper preload">
        
        <div class="an-content-body" style="padding: 8px" id="pjax-container">
            <div id="vue">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading bg-gradient-vine">商品快速定价</div>
                            <div class="panel-body">
                               <?php $sql='select * from ' .flag. 'shop  where zid = '.$zhu_id. '   order by sorder desc , ID desc'; 
							   $pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
$s_name=$row[ 'name']; ?>
                                <form method="post" id="shop_<?=$row['ID']?>" name="shop_<?=$row['ID']?>">
                                    <input name="id" type="hidden" value="<?=$row['ID']?>">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">当前《
                                            <a target="_blank" href="shop_edit.php?id=<?=$row['ID']?>">
                                                <?=$s_name?>
                                            </a>》价格</label>
                                        <div class="col-lg-8">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td colspan="5">
                                                        <input readonly type="text" class="form-control" placeholder="<?=$row['price']?>" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <select name="pid" class="form-control" id="pid" style="width:100%">
                                                            <option value="">请选择定价模板</option>
                                                            <?php
					 
						$result2 = mysql_query('select * from '.flag.'price  where zid = '.$zhu_id.' and fid = 0 order by ID desc ,ID desc');
						while($row2 = mysql_fetch_array($result2)){
						?>
						
                                                <option  <? if($row['pid']==$row2['ID']) {echo "selected";}?>  value="<?=$row2['ID']?>"><?=$row2['p_name']?></option>
                                                <? }?>
                                                        </select>
														<select name="jj" class="form-control" id="jj" style="width:100%">
                                                          <option    value="">请选择分站加价方式</option>
                                                <option   <? if($row['jj']==0) {echo "selected";}?> value="0">固定金额（写什么分站成本是什么）</option>
												<option  <? if($row['jj']==1) {echo "selected";}?>  value="1">倍数（主站成本*倍数）</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="25%">
                                                        <input name="price" id="price" type="text" class="form-control" placeholder="新成本价格" value="<?=$row['price']?>">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="fprice1" id="fprice1" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(1)?>价格" value="<?=$row['fprice1']?>">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="fprice2" id="fprice2" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(2)?>价格" value="<?=$row['fprice2']?>">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="fprice3" id="fprice3" type="text" class="form-control" placeholder="新<?=get_fenzhan_banben_name(3)?>价格" value="<?=$row['fprice3']?>">
                                                    </td>
                                                    <td width="16%">
                                                        <a class="btn btn-info pull-right" @click="save('<?=$row['ID']?>')"> <i class="iconfont"></i> 确定</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                <?php }?>
                            </div>
                            <div class="smart-widget-footer text-center">
                                <nav class="text-center">
                                    <ul class="pagination" style="display: -webkit-inline-box;">
                                        <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php   include( 'footer.php'); ?>

    <script language="javascript">
        new Vue({
            el: '#vue',
            data: {},
            methods: {
                save: function(id) {
                    var vm = this;
                    this.$post("ajax.php?act=upshopprice", $("#shop_" + id).serialize()).then(function(data) {
                        if (data.code === 0) {
                            vm.$message(data.message, 'success');
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
                }
            },
            mounted: function() {}
        });
    </script>
    <!-- /wrapper -->
      <?php 
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