<?php if(!defined( 'WY_ROOT'))exit;require 'header.php';?>
    <div class="col-md-8 col-md-offset-1 right">
        <div class="cb-title">
            <span class="glyphicon glyphicon-th-list">
            </span>
            &nbsp;操作提示
        </div>
        <div class="content-box">
            <div style="text-align:center;margin:20px 0;font-size:1.2em" class="red">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                &nbsp;
                <?php echo isset($msg) ? $msg : '此页面不存在'; ?>
            </div>
            <div style="text-align:center;margin-top:40px">
                <a href="/agent">
                     <?php echo $this->
            config['sitename']?>代理中心
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