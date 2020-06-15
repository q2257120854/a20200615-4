<?php 
$title='用户密价';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'usermj';
 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/common/md5.min.js"></script>
  <link rel="shortcut icon" href="<?=$site_ico?>"/>
<?
 include('header.php');
?>
    <div class="an-content-body" style="padding: 8px" id="pjax-container">
        <div id="vue">
            <div class="row">
                <div class="an-helper-block">
                    <div class="an-small-doc-blcok  warning">规则说明：
                        <br>一个用户只能有一个密价规则！
                        <br>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-vine">密价规则 - <a data-toggle="modal" data-target="#modal-store" @click="storeInfo={act:'mjStore'}" class="btn-xs btn-danger">添加</a>
                        </div>
                        <div class="table-search-header">
                            <div class="form-inline">
                                <input type="text" disabled="disabled" class="hidden">
                                <div class="form-group">
                                    <select v-model="search.gid" class="form-control">
                                        <option value="all">所有规则</option>
                                        <option v-for="(row,i) in goodsList" :key="i" :value="row.gid">{{ row.name }}</option>
                                    </select>
                                </div> <a class="btn btn-info" @click="getList(1)"><i class="iconfont"></i>搜索</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>用户信息</th>
                                            <th>密价方式</th>
                                            <th>设定值</th>
                                            <th>添加时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
    $sql = 'select * from ' . flag . 'mj  where zid = ' . $zhu_id . '    order by id desc , id desc';
$pager = page_handle('page', 20, mysql_num_rows(mysql_query($sql)));
$result = mysql_query($sql . ' limit ' . $pager[0] . ',' . $pager[1] . '');
while ($row = mysql_fetch_array($result)) {
$id=$row['id'];
$uid=$row['uid'];
$kind=$row['kind'];
$rate=$row['rate'];
$sj=$row['sj'];
$sql2 = 'select * from ' . flag . 'user  where ID = '.$uid.' and zid = ' . $zhu_id . ' ';
if($result2 = mysql_query($sql2)){
$row2 = mysql_fetch_array($result2);
    $m_name = $row2['name'];
}else{
	$m_name = mysql_error();
}
 							?>
								<tr>
                                            <td><span class="badge badge-info"><?=$m_name?> 编号:[<?=$uid?>]</td>
                                            <td> <span class='badge badge-warning'><?php if($kind==0){echo '成本价+百分比加价';}elseif($kind==1){echo '成本价+固定价格加价';} ?></span>
                                            </td>
                                            <td><span class="badge primary"><?=$kind?></td>
                                            <td><span class="badge bg-gradient-yellow"><?=$sj?></td>
                                            <td> <a @click="storeInfo={act:'updatemj',id:'<?=$id?>',uid:'<?=$uid?>',kind:<?=$kind?>,rate:'<?=$rate?>'}" data-toggle="modal" data-target="#modal-store" class="btn-xs btn-info">修改</a>
                                                <a class="btn-xs btn-warning" @click="del(<?=$id?>)"><i
                                                    class="iconfont"></i></a>
                                            </td>
                                        </tr>
                              <? }?>
                                        <tr>
                                            <td colspan="100" class="text-center">
                                                <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                    </ul></nav>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade primary" id="modal-store">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">密价规则修改/添加</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="form-store">
                                <input type="hidden" name="action" v-model="storeInfo.act" />
                                <template v-if="storeInfo.id">
                                    <input type="hidden" name="id" v-model="storeInfo.id" />
                                </template>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">所属用户</label>
                                    <div class="col-sm-9">
                                        <select name="uid" class="form-control" v-model="storeInfo.uid" @change="changeGoods">
                                            <option value="">请选择所属会员</option>
<?php
    $sql = 'select * from ' . flag . 'user  where zid = ' . $zhu_id . '    order by ID desc , ID desc';
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    $m_name = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['name']);
    $m_qq = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['qq']);
    $m_id = str_replace($_GET['key'], "<font color=red> " . $_GET['key'] . "</font>", $row['ID']);
 							?>
								<option value="<?=$row['ID']?>"><?=$m_name?> 编号[<?=$row['ID']?>]</option>
                              <? }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">密价方式</label>
                                    <div class="col-sm-9">
                                        <select name="kind" class="form-control" v-model="storeInfo.kind">
                                            <option value="0">成本价+百分比加价</option>
                                            <option value="1">成本价+固定价格加价</option>
                                            <option value="2">设置固定密价</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" v-html="storeInfo.kind==2?'固定密价':(storeInfo.kind==1?'固定加价':'加价百分比')"></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="rate" :placeholder="storeInfo.kind==2?'输入固定密价价格':(storeInfo.kind==1?'输入固定加价价格':'输入加价百分比(小于1的小数)')" v-model="storeInfo.rate">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">取消</button>
                            <button type="button" class="an-btn an-btn-success" @click="store">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 


 <!-- /wrapper -->
<? include_once 'footer.php'; ?>

 
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
<script>
      new Vue({
        el: '#vue',
        data: {
          search: {page: 1, uid: 0, gid: 'all'},
          data: {},
          goodsList: [],
          storeInfo: {},
          price: 100
        },
        methods: {
          
          mjPrice: function (row) {
            if (row.goods) {
              var kind = parseInt(row.kind);
              if (kind === 2) {
                return parseFloat(row.rate).toFixed(6);
              } else if (kind === 1) {
                return (parseFloat(row.goods.price) + parseFloat(row.rate)).toFixed(6);
              } else {
                return (parseFloat(row.goods.price) * (1 + parseFloat(row.rate))).toFixed(6);
              }
            } else {
              return '';
            }
          },
          getPrice: function () {
            var kind = parseInt(this.storeInfo.kind);
            if (kind === 2) {
              return parseFloat(this.storeInfo.rate).toFixed(6);
            } else if (kind === 1) {
              return (parseFloat(this.price) + parseFloat(this.storeInfo.rate)).toFixed(6);
            } else {
              return (parseFloat(this.price) * (1 + parseFloat(this.storeInfo.rate))).toFixed(6);
            }
          },
          changeGoods: function (e) {
            var i = e ? e.target.selectedIndex : 0;
            if (i > 0) {
              i = i - 1;
              this.price = this.goodsList[i].price;
            } else {
              this.price = 100;
            }
          },
     
          store: function () {
            var vm = this;
            this.$post("ajax.php?act=store", $("#form-store").serialize())
              .then(function (data) {
                if (data.status === 0) {
                 
                  $("#modal-store").modal('hide');
                  vm.$message(data.message, 'success');
				    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                   window.location.reload();//页面刷新
                      },2000);


                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },
          del: function (id) {
            var vm = this;
            this.$post("ajax.php?act=mjDelete", {action: 'mjDelete', id: id})
              .then(function (data) {
                if (data.status === 0) {
               
                  vm.$message(data.message, 'success');
				    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                   window.location.reload();//页面刷新
                      },2000);


                } else {
                  vm.$message(data.message, 'error');
                }
              });
          },
        },
        mounted: function () {
          var uid = $_GET('uid');
          if (uid.length < 1) {
     
          
          } else {
      
          
         
          }
        }
      });
    </script>
 </body>
</html>
