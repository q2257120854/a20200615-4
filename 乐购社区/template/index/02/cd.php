 
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>订单查询-<?=$site_name?>-<?=$site_sname?></title>
    <meta name="keywords" content="<?=$site_key?>"/>
    <meta name="description" content="<?=$site_des?>"/>
    <!-- Bootstrap -->
    <link href="/template/01/assets//common/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/01/assets//common/font-awesome_4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template/01/assets//index/default/order.css" rel="stylesheet">
    <link href="/template/01/assets//common/toastr/toastr.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/template/01/assets//common/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/template/01/assets//common/respond.js/1.4.2/respond.min.js"></script>
    <link rel="shortcut icon" href="/template/01/assets//favicon.ico"/>
    <![endif]-->
        <link rel="shortcut icon" href="<?=$site_ico?>"/>

    <style>
        th, td {
            text-align: center;
        }
    </style>
</head>
<body style="background-size:cover;{ifcondition="config('web_bg_color')"}background:#3197e0;{/if}">
<div class="container" id="vue-page">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    订单查询
                </div>
                <div class="panel-body">
                    <form  class="form-inline"  name="subform" id="subform">
                        <input type="text" class="hidden">
                        <div class="form-group">
                            <select  name="sid" class="form-control">
                                <option value="">所有</option>
                                    <?php
					 
						$result = mysql_query('select * from '.flag.'shop where zt = 1 and zid = '.$zhu_id.' order by sorder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
                                                                <option   <? if ($_GET['sid']==$row['ID']) {echo 'selected="selected"';}?> value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                              <? }?>
                                                            </select>
                        </div>
                 
                        <div class="form-group">
                            <select name="zt" class="form-control load-data-input">
                                 <option  <? if ($_GET['zt']=='') {echo 'selected="selected"';}?> value="">所有</option>
                                  <option  <? if ($_GET['zt'] == '0' ) {echo "selected";}?>  value="0">等待中</option>
                                    <option  <? if ($_GET['zt']==1) {echo "selected";}?> value="1">进行中</option>
                                      <option  <? if ($_GET['zt']==4) {echo "selected";}?> value="4">异常中</option>
                                    <option  <? if ($_GET['zt']==2) {echo "selected";}?> value="8">待补单</option>
                                    <option  <? if ($_GET['zt']==5) {echo "selected";}?> value="5">补单中</option>
                                  <option  <? if ($_GET['zt']==6) {echo "selected";}?> value="6">已完成</option>
                                    <option  <? if ($_GET['zt']==9) {echo "selected";}?> value="9">退款中</option>
                                    <option  <? if ($_GET['zt']==7) {echo "selected";}?> value="7">已退款</option>
                            </select>
                        </div>
                        
                                <div class="form-group">
                            <input type="text" class="form-control"  name="key" placeholder="下单内容/订单号">
                        </div>
                        <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"><i
                                  ><i  class="fa fa-search"></i> 查询</a>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>订单号</th>
                            <th>商品名称</th>
                            <th>下单数量</th>
                            <th>下单金额</th>
                            <th>下单内容</th>
                            <th class="text-center">状态</th>
                            <th>下单时间</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
					 //所有条件
					 if ($_GET['sid']!='' and  $_GET['zt']!='' and  $_GET['key']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where sid = '.$_GET['sid'].'  and  zt = '.$_GET['zt'].'  and   dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.' or  key1 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.'  or key2 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.' or  key3 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.' or  key4 like "%'.$_GET['key'].'"  and zid = '.$zhu_id.'  order by ID desc ,ID desc');}
					//只看商品+搜索
					elseif ($_GET['sid']!='' and  $_GET['zt']=='' and  $_GET['key']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where sid = '.$_GET['sid'].'  and   dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.'  or  sid = '.$_GET['sid'].'  and key1 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.'  or  sid = '.$_GET['sid'].'  and key2 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.' or  sid = '.$_GET['sid'].'  and  key3 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.' or  sid = '.$_GET['sid'].'  and  key4 like "%'.$_GET['key'].'" and zid = '.$zhu_id.'    order by ID desc ,ID desc');}
					//只看状态+搜索
				elseif ($_GET['sid']=='' and  $_GET['zt']!='' and  $_GET['key']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where zt = '.$_GET['zt'].'  and   dingdanhao like "%'.$_GET['key'].'%"   and zid = '.$zhu_id.' or   zt = '.$_GET['zt'].'  and  key1 like "%'.$_GET['key'].'"  and zid = '.$zhu_id.'  or   zt = '.$_GET['zt'].'  and  key2 like "%'.$_GET['key'].'" or    zt = '.$_GET['zt'].'  and key3 like "%'.$_GET['key'].'"   and zid = '.$zhu_id.'   or    zt = '.$_GET['zt'].'  and key4 like "%'.$_GET['key'].'"    and zid = '.$zhu_id.'   order by ID desc ,ID desc');}		
					
				 
					
				//纯搜索
				elseif ($_GET['sid']=='' and  $_GET['zt']=='' and  $_GET['key']!='' ) 
					{	$result = mysql_query('select * from '.flag.'order where  dingdanhao like "%'.$_GET['key'].'%"  and zid = '.$zhu_id.'    or  key1  like "%'.$_GET['key'].'"  and zid = '.$zhu_id.' or key2  like "%'.$_GET['key'].'" and zid = '.$zhu_id.'  or  key3 like "%'.$_GET['key'].'" and zid = '.$zhu_id.'  or  key4 like "%'.$_GET['key'].'" and zid = '.$zhu_id.'    order by ID desc ,ID desc');}			
						while($row = mysql_fetch_array($result)){
						?>
                          <tr>
                            <td><?=$row['dingdanhao']?></td>
                            <td><?=get_shopname($row['sid'])?></td>
                            <td><?=$row['num']?></td>
                            <td><?=$row['price']?></td>
                            <td>
                            
                            <?  if ($row['key1']!='') {echo $row['keyname1'].":".$row['key1']; } ?>
                            <?  if ($row['key2']!='') {echo $row['keyname2'].":".$row['key2']; } ?>
                            <?  if ($row['key3']!='') {echo $row['keyname3'].":".$row['key3']; } ?>
                            <?  if ($row['key4']!='') {echo $row['keyname4'].":".$row['key4']; } ?>

                 
                   
                   </td>
                            <td>
                            
                       
							<? if ($row['zt'] ==0) {echo "<font color='red'>等待中</font>"; }?>
                              <? if ($row['zt'] ==1) {echo "<font color='green'>进行中</font>"; }?>
                              <? if ($row['zt'] ==2) {echo "<font color='blue'>退单中</font>"; }?>
                              <? if ($row['zt'] ==3) {echo "<font color='blue'>已退单</font>"; }?>
                              <? if ($row['zt'] ==4) {echo "<font color='pink'>异常中</font>"; }?>
 
                              <? if ($row['zt'] ==5) {echo "<font color='blue'>补单中</font>"; }?>
                              <? if ($row['zt'] ==6) {echo "<font color='blue'>已完成</font>"; }?>
                              <? if ($row['zt'] ==7) {echo "<font color='red'>已退款</font>"; }?>
                             <? if ($row['zt'] ==8) {echo "<font color='orange'>待补单</font>"; }?>
                               <? if ($row['zt'] ==9) {echo "<font color='black'>退款中</font>"; }?>
                             
                            </td>
                            <td><?=$row['date']?></td>
                          </tr>
                          <? }?>
                        </tbody>
                      </table>
                      <div class="col-xs-12 text-center alert alert-warning" v-if="isLoading">
                            <img src="/template/01/assets//common/images/ajax-loader-6.gif" title="加载中">
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
        <div class="navbar-collapse">
            <p class="navbar-text text-center" style="margin-right: 0;"><?=$site_content1?></p>
            <p class="navbar-text text-center navbar-right" style="margin-right: 0;"><a
                    href="/"><?=$site_name?></a></p>
        </div>
    </div>
</nav>
<script src="/template/01/assets//common/jquery.min.js"></script>
<script src="/template/01/assets//common/bootstrap-3.3.5/js/bootstrap.js"></script>
<script src="/template/01/assets//common/toastr/toastr.min.js"></script>
<script src="/template/01/assets//common/md5.min.js"></script>
<script src="/template/01/assets//common/layer_mobile/layer.js"></script>
<script src="/template/01/assets//common/vue.min.js"></script>
<script src="/template/01/assets//common/klsf.js?v=1"></script>
<script>
    new Vue({
        el: '#vue-page',
        data: {
            isLoading: false,
            search: {
                page: 1,
                pageSize: 10,
                goodsid: 0,
                column1: '',
                status: 99,
                api: 99,
            },
            order: {},
            total: 0,
            list: [],
            loadLock: false
        },
        methods: {
            pageChange: function (p) {
                this.search.page = p;
                this.loadRecordList();
            },
            loadRecordList: function () {
                var self = this;
                if (self.loadLock) return;
                self.loadLock = true;
                self.isLoading = true;
                $.klsf.ajax("/index.php/index/index_ajax/user/action/searchOrder.html", this.search, function (data) {
                    if (data.code === 0) {
                        self.total = data.total;
                        self.list = data.list;
                    } else {
                        $.klsf.showMessage(data.message, 'error');
                    }
                    self.isLoading = false;
                    self.loadLock = false;
                }, function () {
                    self.loadLock = false;
                })
            },
            showOrderStatus: function (status) {
                return $.klsf.showOrderStatus(status);
            }
        },
        mounted: function () {
        }
    });
</script>
 </body>
<?


//获取商品状态反馈
	 function get_shopzt($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['duijiecgzt'];
	} else {
		return '0';
	}
}
//获取商品状态反馈
	 function get_shopname($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['name'];
	} else {
		return '0';
	}
}


?>
</html>
 