<?php
include_once('../system/inc.php');
include './check.php';
require_once('../data/member.php'); 
include('./shop.php');
 if ($member_name =='')
  { 	header('location: /app/login.php?act=login&gid=/'.$_GET['id']); }
$gid=$_GET['gid'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
    <title><?=$s_name?>- 在线下单</title>
    <style type="text/css">
        .geetest_holder {
    max-width: 100%;
}

.show {
    display: block;
}

.hide {
    display: none;
}
    </STYLE>
</head>

<body>
    <header class="aui-bar aui-bar-nav" id="aui-header">
        <div class="aui-pull-left aui-btn"> <span class="aui-iconfont aui-icon-left" onClick="window.location='home.php'"></span>
        </div>
        <div class="aui-title" onClick="window.location='home.php'"><?=$s_name?></div>
    </header>
	<?php
	if($_GET['act']=='orderlist'){
	?>
	<div id="vue">
    <div class="aui-content">
        <ul class="aui-list aui-media-list">
		<?php
		$sql = 'select * from ' . flag . 'order where hyid  =' . $member_id . ' and sid =' . $gid . '   and zid = ' . $zhu_id . ' order by ID desc , ID desc';
		$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
					$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
										while($row= mysql_fetch_array($result)){
											$dingdanhao=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['dingdanhao']);
		?>
            <li class="aui-list-item">
                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title">订单号:<?=$dingdanhao?></div>
                            <div class="aui-list-item-right"><span class="btn-xs btn-info"><?php if ($row[ 'zt']==0) { echo "<font color='red'>等待中</font>"; } ?>
<?php if ($row[ 'zt']==1) { echo "<font color='green'>进行中</font>"; } ?>
<?php if ($row[ 'zt']==2) { echo "<font color='blue'>退单中</font>"; } ?>
<?php if ($row[ 'zt']==3) { echo "<font color='blue'>已退单</font>"; } ?>
<?php if ($row[ 'zt']==4) { echo "<font color='pink'>异常中</font>"; } ?>
<?php if ($row[ 'zt']==5) { echo "<font color='blue'>补单中</font>"; } ?>
<?php if ($row[ 'zt']==6) { echo "<font color='blue'>已完成</font>"; } ?>
<?php if ($row[ 'zt']==7) { echo "<font color='red'>已退款</font>"; } ?>
<?php if ($row[ 'zt']==8) { echo "<font color='orange'>待补单</font>"; } ?>
<?php if ($row[ 'zt']==9) { echo "<font color='black'>退款中</font>"; } ?></span>
                            </div>
                        </div>
						<?php if ($key1 !='') { ?>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"><?=$keyname1?></div>
                            <div class="aui-list-item-right"><?=$keyname1?>|<?=$row['key1']?></div>
                        </div>
						<?php } ?>
						<?php if ($key2 !='') { ?>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"><?=$keyname2?></div>
                            <div class="aui-list-item-right"><?=$keyname2?>|<?=$row['key2']?></div>
                        </div>
						<?php } ?>
						<?php if ($key3 !='') { ?>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"><?=$keyname3?></div>
                            <div class="aui-list-item-right"><?=$keyname3?>|<?=$row['key3']?></div>
                        </div>
						<?php } ?>
						<?php if ($key4 !='') { ?>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"><?=$keyname4?></div>
                            <div class="aui-list-item-right"><?=$keyname4?>|<?=$row['key4']?></div>
                        </div>
						<?php } ?>
                        <div class="aui-list-item-text">
                            <div class="aui-row" style="width: 100%;">
                                <div class="aui-col-xs-4"><span class="text-title">数量:</span><?=$row['num']?></div>
                                <div class="aui-col-xs-4" style="text-align: center;"><span class="text-title">初始:</span><?=$csnum?></div>
                                <div class="aui-col-xs-4" style="text-align: right;"><span class="text-title">现在:</span><?=$dqnum?></div>
                            </div>
                        </div>
                        <div class="aui-info aui-margin-t-5" style="padding: 0px;">
                            <div class="aui-info-item">
                                <div class="aui-list-item-title">下单时间:</div>
                            </div>
                            <div class="aui-info-item"><?=$row['date']?></div>
                        </div>
                        <div class="aui-info aui-margin-t-5" style="padding: 0px;">
                            <div class="aui-info-item">
                                <div class="aui-list-item-title">操作:</div>
                            </div>
                            <div class="aui-info-item"></div>
                        </div>
                    </div>
                </div>
            </li>
	<?php } ?>
        </ul>
    </div>
</div>
<?php
	}else{
?>
    <div id="vue">
        <section class="aui-content">
            <div class="aui-content-padded"><!---->
                   <?=stripslashes($s_content
)?>
            </div>
            <div class="aui-content aui-margin-b-15">
                <ul class="aui-list aui-list-in">
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">单价</div>
                            <div class="aui-list-item-right"><?=$s_price?>元/<?=$s_unit?></div>
                        </div>
					</li>
					<li class="aui-list-item">
						<div class="aui-list-item-inner">
                            <div class="aui-list-item-title">你的余额</div>
                            <div class="aui-list-item-right" name='rmb'>{{ rmb }} 元</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="aui-content">
                <ul class="aui-list aui-form-list">
                    <form id="form-order" name="form-order" method="post">
                        <input type="hidden" name="action" value="order">
                        <input type="hidden" name="gid" value="<?=$gid?>">
                                                <!--- 接口类-->
                        
<? if ($s_xid == 0) { //发卡?>
<li class="aui-list-item">
<div class="aui-list-item-inner">
    <div class="aui-list-item-label">邮箱</div>
    <div class="aui-list-item-input">
        <input type="text" name="email" ID="email" class="form-control" placeholder="请输入邮箱" act="number" @change="checkInput">
    </div>
</div>
</li>
<? }?>
<? if ($key1!='' ) {?>
<li class="aui-list-item">
<div class="aui-list-item-inner">
    <div class="aui-list-item-label"><?=$key1?></div>
    <div class="aui-list-item-input">
        <input type="text" name="value1" ID="value1" class="form-control" placeholder="请输入<?=$keyname1?>" act="number" @change="checkInput">
    </div>
</div>
</li>
<? }?>
<? if ($key2!='' ) {?>
<li class="aui-list-item">
<div class="aui-list-item-inner">
    <div class="aui-list-item-label"><?=$key2?></div>
    <div class="aui-list-item-input">
        <input type="text" name="value2" ID="value2" class="form-control" placeholder="请输入<?=$keyname2?>" act="number" @change="checkInput">
    </div>
</div>
</li>
<? }?>
<? if ($key3!='' ) {?>
<li class="aui-list-item">
<div class="aui-list-item-inner">
    <div class="aui-list-item-label"><?=$key3?></div>
    <div class="aui-list-item-input">
        <input type="text" name="value3" ID="value3" class="form-control" placeholder="请输入<?=$keyname3?>" act="number" @change="checkInput">
    </div>
</div>
</li>
<? }?>
<? if ($key4!='' ) {?>
<li class="aui-list-item">
<div class="aui-list-item-inner">
    <div class="aui-list-item-label"><?=$key4?></div>
    <div class="aui-list-item-input">
        <input type="text" name="value4" ID="value4" class="form-control" placeholder="请输入<?=$keyname4?>" act="number" @change="checkInput">
    </div>
</div>
</li>
<? }?>
                        
<li class="aui-list-item">
    <div class="aui-list-item-inner">
        <div class="aui-list-item-label">下单数量</div>
        <div class="aui-list-item-input">
            <input type="number" v-model="num" name="num" placeholder="输入下单数量(<?=$s_dnum?>-<?=$s_gnum?>)">
        </div>
    </div>
</li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">需要</div>
                                <div class="aui-list-item-input">
                                    <input type="text" id="orderRmb" name="orderRmb" :value="('<?=$s_price?>'*num*mult+cost).toFixed(6)" disabled>
                                </div>
                                <div class="aui-list-item-icon">元</div>
                            </div>
                        </li>
                    </form>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner aui-list-item-center aui-list-item-btn">
                            <div class="aui-btn aui-btn-info aui-margin-r-5" @click="order('order')">确认下单</div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
	<?php
	}
?>
    <footer class="aui-bar aui-bar-tab">
        <div class="aui-bar-tab-item" onclick="window.location='?gid=<?=$gid?>'"> <i class="aui-iconfont icon"></i>
            <div class="aui-bar-tab-label" >开始下单</div>
        </div>
        <div class="aui-bar-tab-item" onclick="window.location='?gid=<?=$gid?>&act=orderlist'"> <i class="aui-iconfont icon"></i>
            <div class="aui-bar-tab-label" >下单记录</div>
        </div>
        <!--<div class="aui-bar-tab-item"> <i class="aui-iconfont icon"></i>
            <div class="aui-bar-tab-label" onClick="window.location='my.php'">会员中心</div>
        </div>-->
    </footer>
</body>
        <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/moment.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/daterangepicker.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/wow.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/perfect-scrollbar.jquery.min.js"
            type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/selectize.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/owl.carousel.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/Chart.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/circle-progress.min.js" type="text/javascript"></script>

    <!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   -->
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/customize-chart.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/scripts.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.pjax.min.js" type="text/javascript"></script>
   <script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
    <script src="http://assets.yilep.com/ylsq/js/admin/main.js?v=3.0.9"></script>
<script>
    new Vue({
        el: '#vue',
        data: {
            orderLock: false,
            num: parseInt('<?=$s_dnum?>'),
            mult: 1,
            rate: parseInt('<?=$s_dnum?>'),
            rmb: parseFloat('<?=get_xiaoshu($member_point,6)?>').toFixed(6),
            search: {
                page: 1,
                gid: "<?=$gid?>",
                value1: '',
                status: 'all',
                card: '',
                id: ''
            },
            ssPage: 1,
            data: {},
            goodsList: [],
            storeInfo: {},
            ssList: [],
            cardList: [],
            cost: parseFloat('<?=isset($s_ewcost)?$s_ewcost:0?>')
        },
        methods: {
            changeMoney: function() {
                var mult = 1;
                $("#form-order input[act='MULT']").each(function() {
                    mult = mult * parseInt($(this).val());
                });
                this.mult = mult;
            },
            checkDay: function(sDate1, day) {
                if (day < 1) return true;
                var dateSpan,
                    tempDate,
                    iDays;
                sDate1 = Date.parse(sDate1);
                sDate2 = Date.parse(new Date());
                dateSpan = sDate2 - sDate1;
                dateSpan = Math.abs(dateSpan);
                iDays = Math.floor(dateSpan / (24 * 3600 * 1000));
                return iDays <= day;
            },
            checkInput: function(e) {
                var vm = this;
                if (e === 'KSSPID' || e === 'DYSPID') {
                    var url = $("#form-order input[act='ATUO-" + e + "']").val();
                    if (url.indexOf('http') === -1) {
                        vm.$message("请输入正确的链接", 'error');
                    } else {
                        this.$post("/ajax.php", {
                            action: 'autoInput',
                            url: encodeURIComponent(url),
                            kind: e
                        }).then(function(data) {
                            if (data.status === 0) {
                                data.data.forEach(function(item) {
                                    $("#form-order input[act='" + item[0] + "']").val(item[1]);
                                });
                            } else {
                                vm.$message(data.message, 'error');
                            }
                        });
                    }
                } else {
                    var obj = $(e.target);
                    var url = obj.val();
                    var ret;
                    switch (obj.attr('act')) {
                        case 'XHSID':
                            var rule = /profile\/([a-z0-9]+)/i;
                            if ((ret = rule.exec(url)) !== null) {
                                obj.val(ret[1]);
                            }
                            break;
                        case 'XHSZPID':
                            var rule = /discovery\/item\/([a-z0-9]+)/i;
                            if ((ret = rule.exec(url)) !== null) {
                                obj.val(ret[1]);
                            }
                            break;
                        case 'WSID':
                            var rule = /personal\/(\d+)/i;
                            if ((ret = rule.exec(url)) !== null) {
                                obj.val(ret[1]);
                            }
                            break;
                        case 'WSZPID':
                            var rule = /weishi\/feed\/([^\/]+)/i;
                            if ((ret = rule.exec(url)) !== null) {
                                obj.val(ret[1]);
                            }
                            break;
                        case 'WBID':
                            var rule = /weibo.com\/(u\/)?(\d+)/i;
                            if ((ret = rule.exec(url)) !== null) {
                                obj.val(ret[2]);
                            }
                            break;
                        case 'QMGQID':
                            try {
                                obj.val(url.split('s=')[1].split('&')[0]);
                            } catch (e) {}
                            break;
                        case 'KSID':
                        case 'KSSPID':
                            try {
                                if (url.indexOf('userId=') > 0) {
                                    $("#form-order input[act='KSID']").val(url.split('userId=')[1].split('&')[0]);
                                } else {
                                    $("#form-order input[act='KSID']").val(url.split('photo/')[1].split('/')[0]);
                                }
                                if (url.indexOf('photoId=') > 0) {
                                    $("#form-order input[act='KSSPID']").val(url.split('photoId=')[1].split('&')[0]);
                                } else {
                                    $("#form-order input[act='KSSPID']").val(url.split('photo/')[1].split('/')[1].split('?')[0]);
                                }
                            } catch (e) {}
                            break;
                        case 'HSID':
                        case 'HSSPID':
                        case 'DYID':
                        case 'DYSPID':
                            try {
                                if (url.indexOf('video/') > 0) {
                                    obj.val(url.split('video/')[1].split('/')[0]);
                                } else if (url.indexOf('item/') > 0) {
                                    obj.val(url.split('item/')[1].split('/')[0]);
                                } else if (url.indexOf('user/') > 0) {
                                    obj.val(urlsplit('user/')[1].split('/')[0]);
                                } else {
                                    var rule = /\&uid=(\d{5,})/i;
                                    var rule2 = /\&share\_ht\_uid=(\d{5,})/i;
                                    if ((ret = rule.exec(url)) !== null) {
                                        obj.val(ret[1]);
                                    } else if ((ret = rule2.exec(url)) !== null) {
                                        obj.val(ret[1]);
                                    }
                                }
                            } catch (e) {}
                            break;
                    }
                }
            },
            status: function(id, status, type) {
                if (confirm("确定要申请" + type + "吗？")) {
                    var vm = this;
                    this.$post("/ajax/order.php", {
                        action: 'status',
                        id: id,
                        status: status
                    }).then(function(data) {
                        if (data.status === 0) {
                            vm.$message(data.message, 'success');
                            $.pjax.reload('#pjax-container');
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
                };
            },
            getSSList: function(page) {
                var vm = this;
                var uin = $("#form-order input[name='value1']").val();
                if (uin.length < 5) {
                    vm.$message("请输入正确QQ号码", 'error');
                } else if (page < 1) {
                    vm.$message("已经是第一页了", 'error');
                } else {
                    this.$post("/ajax.php", {
                        action: 'getSSList',
                        uin: uin,
                        page: this.ssPage
                    }).then(function(data) {
                        if (data.status === 0) {
                            vm.ssList = data.data;
                        } else {
                            vm.$message(data.message ? data.message : '获取说说失败，可能此QQ为开放所有人可访问！', 'error');
                        }
                    });
                }
            },
            selectSS: function(value) {
                $("#form-order input[name='" + value + "']").val($("#ssList").val());
            },
            power: function() {
                var vm = this;
                this.$post("/ajax/power.php", $("#form-power").serialize()).then(function(data) {
                    if (data.status === 0) {
                        $("#modal-power").modal('hide');
                        vm.$message(data.message, 'success');
                        $.pjax.reload('#pjax-container');
                    } else {
                        vm.$message(data.message, 'error');
                    }
                });
            },
            tousu: function() {
                var vm = this;
                this.$post("/ajax/tousu.php", $("#form-tousu").serialize()).then(function(data) {
                    if (data.status === 0) {
                        $("#modal-tousu").modal('hide');
                        vm.$message(data.message, 'success');
                        $.pjax.reload('#pjax-container');
                    } else {
                        vm.$message(data.message, 'error');
                    }
                });
            },
            form: function(form) {
                var vm = this;
                this.$post("/ajax/order.php", $("#form-" + form).serialize()).then(function(data) {
                    if (data.status === 0) {
                        vm.getList();
                        $("#modal-" + form).modal('hide');
                        vm.$message(data.message, 'success');
                        $.pjax.reload('#pjax-container');
                    } else {
                        vm.$message(data.message, 'error');
                    }
                });
            },
            order: function(form) {
                if (this.orderLock) return;
                this.orderLock = true;
                var vm = this;
                this.$post("/ajax/order.php?gid=<?=$gid?>", $("#form-" + form).serialize()).then(function(data) {
                    vm.orderLock = false;
                    if (data.status === 0) {
                        vm.rmb = data.rmb;
                        vm.$message(data.message, 'success');
                  vm.rmb = data.rmb;
                    } else {
                        if (data.message === '请先完成验证') {
                            $.pjax.reload('#embed-captcha');
                        }
                        vm.$message(data.message, 'error');
                    }
                });
            },
            changeGoods: function(e) {
                var gid = e.target.value;
                if (gid) {
                    $.pjax({
                        url: "/home/order/" + gid,
                        container: '#pjax-container'
                    });
                }
            },
        },
        mounted: function() {
            this.getAllGoods();
        }
    });
</script>

</html>