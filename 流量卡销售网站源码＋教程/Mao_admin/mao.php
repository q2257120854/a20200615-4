<?php
require '../Mao/common.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='login.php';</script>");
if( $_SERVER['HTTP_REFERER'] == "" ){
    exit('404');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $mao['title']?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="./layui/css/layui.css" media="all">
    <link rel="stylesheet" href="./css/admin.css" media="all">
    <style type="text/css">
        .longtext{overflow: hidden;text-overflow: ellipsis;white-space: nowrap}
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">
                    <fieldset class="layui-elem-field layui-field-title">
                        <legend>网站信息</legend>
                    </fieldset>
                </div>
                <div class="layui-card-body layui-text">
                    <table class="layui-table">
                        <colgroup>
                            <col width="100"><col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>网站名称</td>
                            <td>
                                <?php echo $mao['title']?>
                            </td>
                        </tr>
                        <tr>
                            <td>域名</td>
                            <td>
                                <?php echo $mao['url']?>
                            </td>
                        </tr>
                        <tr>
                            <td>客服QQ</td>
                            <td>
                                <?php echo $mao['qq']?>
                            </td>
                        </tr>
                        <tr>
                            <td>后台余额</td>
                            <td>
                                <?php echo $mao['price']?>
                            </td>
                        </tr>
                        <tr>
                            <td>到期时间</td>
                            <td><?php echo $mao['time']?>
							</td>
                        </tr>
						<tr>
                            <td>交流QQ群</td>
                            <td>831506349
							</td>
                        </tr>
                        <tr>
                            <td>作者QQ</td>
                            <td>7584004
							</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="layui-col-md8">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            <fieldset class="layui-elem-field layui-field-title">
                                <legend>数据统计</legend>
                            </fieldset>
                        </div>
                        <div class="layui-card-body">
                            <?php
							if($mao['id'] == 1){
								$rs2=$DB->query("SELECT * FROM mao_dindan where zt!='1'");
                                $price3=0;
                                while($res2 = $DB->fetch($rs2)){
                                    $price3+=$res2['price'];
                                }
                                $numrows_1 = $DB->count("SELECT count(*) from mao_dindan");
                                $numrows_2 = $DB->count("SELECT count(*) from mao_dindan WHERE zt='0'");
                                $numrows_3 = $DB->count("SELECT count(*) from mao_gd");
                                $numrows_4 = $DB->count("SELECT count(*) from mao_gd WHERE zt='1'");
                                $numrows_5 = $DB->count("SELECT count(*) from mao_data");
								$numrows_6 = $DB->count("SELECT count(*) from mao_dindan WHERE zt='2'");
								$numrows_7 = $DB->count("SELECT count(*) from mao_gd WHERE zt='0'");
							}else{
								$rs2=$DB->query("SELECT * FROM mao_dindan where M_id='{$mao['id']}' and zt!='1'");
                                $price3=0;
                                while($res2 = $DB->fetch($rs2)){
                                    $price3+=$res2['price'];
                                }
                                $numrows_1 = $DB->count("SELECT count(*) from mao_dindan WHERE M_id='{$mao['id']}' ");
                                $numrows_2 = $DB->count("SELECT count(*) from mao_dindan WHERE M_id='{$mao['id']}' and zt='0'");
                                $numrows_3 = $DB->count("SELECT count(*) from mao_gd WHERE M_id='{$mao['id']}' ");
                                $numrows_4 = $DB->count("SELECT count(*) from mao_gd WHERE M_id='{$mao['id']}' and zt='1'");
                                $numrows_5 = $DB->count("SELECT count(*) from mao_data WHERE Z_id='{$mao['id']}'");
								$numrows_6 = $DB->count("SELECT count(*) from mao_dindan M_id='{$mao['id']}' and WHERE zt='2'");
								$numrows_7 = $DB->count("SELECT count(*) from mao_gd WHERE M_id='{$mao['id']}' and zt='0'");
							}
                            ?>
                            <div class="layui-carousel layadmin-carousel layadmin-backlog">
                                <div>
                                    <ul class="layui-row layui-col-space10">
                                        <li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>订单数量</h3>
                                                <p><cite><?php echo $numrows_1?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>待处理订单</h3>
                                                <p><cite style="color: #ff0000;"><?php echo $numrows_2?></cite></p>
                                            </a>
                                        </li>
										<li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>已处理订单</h3>
                                                <p><cite style="color: #5FB878;"><?php echo $numrows_6?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>累计收入</h3>
                                                <p><cite style="color: #FF5722;"><?php echo number_format($price3,2,".","");?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>工单数量</h3>
                                                <p><cite style="color: #ff0000;"><?php echo $numrows_3?></cite></p>
                                            </a>
                                        </li>
										<li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>待处理工单</h3>
                                                <p><cite style="color: #ff0000;"><?php echo $numrows_4?></cite></p>
                                            </a>
                                        </li>
										<li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>已处理工单</h3>
                                                <p><cite style="color: #5FB878;"><?php echo $numrows_7?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs3">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>分站数量</h3>
                                                <p><cite style="color: #01AAED;"><?php echo $numrows_5?></cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<!--底部版权信息-->
					 <style type="text/css">
            body {
                padding: 0;
                margin: 0 auto;
            }

            #footer {
                height: 40px;
                line-height: 40px;
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                background: #f8f8f8;
                color: #1f1616;
                font-family: Arial;
                font-size: 12px;
                letter-spacing: 1px;
            }

            .content {
                height: 1800px;
                width: 100%;
                text-align: center;
            }
        </style>
    
       <div id="footer">Copyright © 2020. All rights reserved  <a href="" target="_blank">商城系统</a></div></div>
					<!--结束-->
    </div>
</div>
<script src="./layui/layui.js"></script>
<script>
    layui.config({
        base: './' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use('index');
</script>
</body>
</html>