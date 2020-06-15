<?php require_once 'header.php' ?>
    <style>
        .form-ajax>.form-group>.col-md-6{color:#6B6D6E;font-size:0.9em;line-height:
        30px}.form-ajax>.form-group>.col-md-2{color:#6B6D6E;}
    </style>
    <h3>
        <span class="current">
            系统设置
        </span>
        &nbsp;/&nbsp;
        <span>
            提现设置
        </span>
        &nbsp;/&nbsp;
        <span>
            邮件服务器
        </span>
        &nbsp;/&nbsp;
        <span>
            跳转设置
        </span>       
		&nbsp;/&nbsp;
        <span>
            短信设置
        </span>
    </h3>
    <br>
    <div class="set set0">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="sitename" class="col-md-2 control-label">
                    站点名称：
                </label>
                <div class="col-md-6">
                    <input type="text" name="sitename" id="sitename" class="form-control"
                    value="<?php echo $this->config['sitename']?>">
                </div>
                <span class="col-md-4">
                    网站title
                </span>
            </div>
            <div class="form-group">
                <label for="siteinfo" class="col-md-2 control-label">
                    站点简介：
                </label>
                <div class="col-md-6">
                    <input type="text" name="siteinfo" id="siteinfo" class="form-control"
                    value="<?php echo $this->config['siteinfo']?>">
                </div>
                <span class="col-md-4">
                    显示在网站title后面
                </span>
            </div>
            <div class="form-group">
                <label for="siteurl" class="col-md-2 control-label">
                    站点网址：
                </label>
                <div class="col-md-6">
                    <input type="text" name="siteurl" id="siteurl" class="form-control" value="<?php echo $this->config['siteurl']?>">
                </div>
                <span class="col-md-4">
                    无需填写http://
                </span>
            </div>
            <div class="form-group">
                <label for="staticurl" class="col-md-2 control-label">
                    静态文件URL：
                </label>
                <div class="col-md-6">
                    <input type="text" name="staticurl" id="staticurl" class="form-control"
                    value="<?php echo $this->config['staticurl']?>">
                </div>
                <span class="col-md-4">
                    无需填写http://
                </span>
            </div>
            <div class="form-group">
                <label for="keyword" class="col-md-2 control-label">
                    网站关键字：
                </label>
                <div class="col-md-6">
                    <input type="text" name="keyword" id="keyword" class="form-control" value="<?php echo $this->config['keyword']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-md-2 control-label">
                    网站介绍：
                </label>
                <div class="col-md-6">
                    <textarea name="description" id="description" class="form-control" rows="5">
                        <?php echo $this->config['description']?>
                    </textarea>
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-2 control-label">
                    客服邮箱：
                </label>
                <div class="col-md-6">
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $this->config['email']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="tel" class="col-md-2 control-label">
                    客服电话：
                </label>
                <div class="col-md-6">
                    <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $this->config['tel']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="qq" class="col-md-2 control-label">
                    客服QQ：
                </label>
                <div class="col-md-6">
                    <input type="text" name="qq" id="qq" class="form-control" value="<?php echo $this->config['qq']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="address" class="col-md-2 control-label">
                    公司地址：
                </label>
                <div class="col-md-6">
                    <input type="text" name="address" id="address" class="form-control" value="<?php echo $this->config['address']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="icpcode" class="col-md-2 control-label">
                    ICP备案号：
                </label>
                <div class="col-md-6">
                    <input type="text" name="icpcode" id="icpcode" class="form-control" value="<?php echo $this->config['icpcode']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                    统计代码：
                </label>
                <div class="col-md-6">
                    <textarea name="stacode" id="stacode" class="form-control" rows="5">
                        <?php echo $this->config['stacode']?>
                    </textarea>
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    收银台开关：
                </label>
                <div class="col-md-6">
                    <select name="is_checkout_state" class="form-control">
                        <option value="0" <?php echo $this->config['is_checkout_state']=='0' ? ' selected' : ''?>>已开启
                        </option>
                        <option value="1" <?php echo $this->config['is_checkout_state']=='1' ? ' selected' : ''?>>已关闭
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-4">
                </span>
            </div>
        </form>
    </div>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label class="col-md-2 control-label">
                    功能开关：
                </label>
                <div class="col-md-6">
                    <select name="tx_state" class="form-control">
                        <option value="0" <?php echo $this->config['tx_state']=='0' ? ' selected' : ''?>>已关闭
                        </option>
                        <option value="1" <?php echo $this->config['tx_state']=='1' ? ' selected' : ''?>>已开启
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    允许提现时间：
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            从
                        </span>
                        <select name="tx_ftime" class="form-control">
                            <?php for($i=0;$i<24;$i++):?>
                                <option value="<?php echo $i?>" <?php echo $this->config['tx_ftime']==$i ? ' selected' : ''?>>
                                    <?php echo $i?>
                                        点
                                </option>
                                <?php endfor;?>
                        </select>
                        <span class="input-group-addon">
                            至
                        </span>
                        <select name="tx_etime" class="form-control">
                            <?php for($i=0;$i<24;$i++):?>
                                <option value="<?php echo $i?>" <?php echo $this->config['tx_etime']==$i ? ' selected' : ''?>>
                                    <?php echo $i?>
                                        点
                                </option>
                                <?php endfor;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    关闭提示：
                </label>
                <div class="col-md-6">
                    <textarea name="tx_closetip" class="form-control" rows="5">
                        <?php echo $this->config['tx_closetip']?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    天次数限制：
                </label>
                <div class="col-md-6">
                    <select name="tx_timelimit" class="form-control">
                        <?php for($i=1;$i<6;$i++):?>
                            <option value="<?php echo $i?>" <?php echo $this->config['tx_timelimit']==$i ? ' selected' : ''?>>
                                <?php echo $i?>
                                    次
                            </option>
                            <?php endfor;?>
                    </select>
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    超次数提示：
                </label>
                <div class="col-md-6">
                    <textarea name="tx_limittip" class="form-control" rows="5">
                        <?php echo $this->config['tx_limittip']?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    最低提现额：
                </label>
                <div class="col-md-6">
                    <input type="text" name="tx_minmoney" class="form-control" value="<?php echo $this->config['tx_minmoney']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    结算手续费率：
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="tx_fee" class="form-control" value="<?php echo $this->config['tx_fee']?>">
                        <span class="input-group-addon">
                            %
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    手续费上限：
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="tx_limit" class="form-control" value="<?php echo $this->config['tx_limit']?>">
                        <span class="input-group-addon">
                            元
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="set set2 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="smtp_server" class="col-md-2 control-label">
                    邮件服务器：
                </label>
                <div class="col-md-4">
                    <input type="text" name="smtp_server" id="smtp_server" class="form-control"
                    value="<?php echo $this->config['smtp_server']?>">
                </div>
                <span class="col-md-6">
                    以smtp开头
                </span>
            </div>
            <div class="form-group">
                <label for="smtp_email" class="col-md-2 control-label">
                    邮箱账号：
                </label>
                <div class="col-md-4">
                    <input type="text" name="smtp_email" id="smtp_email" class="form-control"
                    value="<?php echo $this->config['smtp_email']?>">
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="smtp_pwd" class="col-md-2 control-label">
                    邮箱密码：
                </label>
                <div class="col-md-4">
                    <input type="password" name="smtp_pwd" id="smtp_pwd" class="form-control"
                    value="<?php echo $this->config['smtp_pwd']?>">
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>
    <div class="set set3 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save?t=1"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="checkout_jump_url" class="col-md-2 control-label">
                    收银台跳转域名：
                </label>
                <div class="col-md-4">
                    <input type="text" name="checkout_jump_url" id="checkout_jump_url" class="form-control"
                    value="<?php echo $this->config['checkout_jump_url']?>">
                </div>
                <span class="col-md-6">
                    不带http://前缀
                </span>
            </div>
            <div class="form-group">
                <label for="api_jump_url" class="col-md-2 control-label">
                    API跳转域名：
                </label>
                <div class="col-md-4">
                    <input type="text" name="api_jump_url" id="api_jump_url" class="form-control"
                    value="<?php echo $this->config['api_jump_url']?>">
                </div>
                <span class="col-md-6">
                    不带http://前缀
                </span>
            </div>
            <div class="form-group">
                <label for="is_checkout_jump" class="col-md-2 control-label">
                    跳转开启：
                </label>
                <div class="col-md-4">
                    <input type="checkbox" name="is_checkout_jump" id="is_checkout_jump" value="1"
                    <?php echo $this->config['is_checkout_jump'] ? ' checked' : ''?>>&nbsp;
                    <label for="is_checkout_jump">
                        开启跳转
                    </label>
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div> 
	
	<div class="set set4 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
		            <div class="form-group">
                <label class="col-md-2 control-label">
                    切换接口：
                </label>
                <div class="col-md-4">
                    <select name="tx_state" class="form-control">
                        <option value="0" <?php echo $this->config['tx_state']=='0' ? ' selected' : ''?>>已关闭
                        </option>
                        <option value="1" <?php echo $this->config['tx_state']=='1' ? ' selected' : ''?>>已开启
                        </option>
                    </select>
                </div>
            </div>
		
            <div class="form-group">
                <label   class="col-md-2 control-label">
                   用户id：
                </label>
                <div class="col-md-4">
                    <input type="text" name="checkout_jump_url" id="checkout_jump_url" class="form-control"
                    value="<?php echo $this->config['checkout_jump_url']?>">
                </div>
                <span class="col-md-6">
                
                </span>
            </div>
            <div class="form-group">
                <label for="api_jump_url" class="col-md-2 control-label">
                   key：
                </label>
                <div class="col-md-4">
                    <input type="text" name="api_jump_url" id="api_jump_url" class="form-control"
                    value="<?php echo $this->config['api_jump_url']?>">
                </div>
                <span class="col-md-6">
               
                </span>
            </div>
             
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>
    <?php require_once 'footer.php' ?>