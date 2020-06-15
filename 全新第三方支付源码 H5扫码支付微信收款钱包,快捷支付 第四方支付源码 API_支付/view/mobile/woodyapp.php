<?php

if(!defined('WY_ROOT'))exit;require 'header.php';?>

   <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
									操作提示
									</div>
</div>									
									<div class="content-box">
									<div style="text-align:center;margin:20px 0;font-size:1.2em" class="red">
								  <i class="fa fa-info-circle "></i>&nbsp;<?php echo isset($msg) ? $msg : '此页面不存在'; ?></div>
									<div style="text-align:center;margin-top:40px"><a href="/member">用户中心</a>
									<span class="v-line">|</span>
									<a href="<?php echo isset($url) ? $url : $this->req->server('HTTP_REFERER') ?>">返回上页</a>
									</div>
									</div>
									</div>
									
									<?php require 'footer.php'; ?>