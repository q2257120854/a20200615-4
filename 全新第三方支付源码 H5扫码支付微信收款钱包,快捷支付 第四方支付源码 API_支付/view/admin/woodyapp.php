<?php if(!defined( 'WY_ROOT'))exit;require 'header.php';?>
    <div class="panel panel-default" style="width:400px;margin:auto;margin-top:80px;">
        <div class="panel-heading">
            操作提示：
        </div>
        <div class="panel-body">
            <div style="text-align:center;margin-top:20px;font-size:1.2em" class="red">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                &nbsp;
                <?php echo isset($msg) ? $msg : '此页面不存在'; ?>
            </div>
            <div style="text-align:center;margin-top:20px;margin-bottom:20px">
                <a href="<?php echo $this->dir ?>">
                    管理首页
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
    <?php require 'footer.php'; ?>