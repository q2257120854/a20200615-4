            <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
    <style>
        .v-line{color:#999;font-size:12px;margin:0 10px}
    </style>
    <section class="main-info" style="padding-top:100px">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-info-sign">
                            </span>
                            &nbsp;操作提示
                        </div>
                        <div class="panel-body text-center" style="padding:50px 0">
                            <?php echo isset($msg) ? $msg : '未找到内容' ?>
							
                        </div>
                        <div class="panel-footer text-center">
                            <a href="/">
                                返回首页
                            </a>
                            <span class="v-line">
                                |
                            </span>
                            <a href="<?php echo isset($url) ? $url : $this->req->server('HTTP_REFERER') ?>">
                                返回上页
                            </a>
                        </div>
                    </div>
                </div>
				
				<div class="col-md-8 col-md-offset-2"><pre style="box-sizing: border-box;;overflow: auto; font-family: font-family:
                'Microsoft Yahei',微软雅黑; font-size: 13px; padding: 9.5px; margin-top:60px; margin-bottom: 10px; line-height: 1.42857; color: rgb(51, 51, 51); word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; background-color: rgb(245, 245, 245);">商户须知-重要提示:<br>
&nbsp;&nbsp;为提升平台质量，有以下情况的商户，平台有权在不提前告知情况下直接冻结或删除！<br>
&nbsp;&nbsp;&nbsp;&nbsp;1、注册信息严重有误、虚假联系方式,注册后3天内无任何操作、60天内无交易或没有实质商品。
&nbsp;&nbsp;&nbsp;&nbsp;2、云盘账号、虚假、无效、重复站点、客户投诉严重且没人及时处理。
&nbsp;&nbsp;&nbsp;&nbsp;3、商户负责人无法联系,或不回复信息,消极处理客户投诉。
&nbsp;&nbsp;&nbsp;&nbsp;4、淫秽色情、裸聊、诱导交友、欺诈钓鱼、期货金融等非法平台,一经发现直接冻结帐户，并上报相关部门！
&nbsp;&nbsp;&nbsp;&nbsp;5、未取得文网棋牌游戏等类别禁止注册,一经发现直接冻结帐户!<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;最终解释权归智通付所有</pre> </div>
            </div>
        </div>
    </section>
    </body>
    
    </html>