<?php require_once 'header.php' ?>
    <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
            &nbsp;
            <?php echo $title?>
        </div>
                            </div>
							<?php if($this->userData['is_state']=='0'):?>
        <div class="alert alert-warning" style="margin-bottom:0;">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                &nbsp;您当前的账号状态为
                <span class="label label-danger">
                    未审核
                </span>
                ，请继续完善以下信息然后联系客服以便审核。
            </div>
            <?php endif;?>
			<div class="panel-body">
                <div class="content-box">
                    <form class="form-ajax form-horizontal" action="/agent/userinfo/editsave"
                    method="post">
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                注册邮箱：
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?php echo $userinfo['email']?>"
                                disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                手机号码：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control" value="<?php echo $userinfo['phone']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                联系QQ：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="qq" class="form-control" value="<?php echo $userinfo['qq']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                真实姓名：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="realname" class="form-control" value="<?php echo $userinfo['realname']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                身份证号：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="idcard" class="form-control" value="<?php echo $userinfo['idcard']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                收款银行：
                            </label>
                            <div class="col-md-6">
                                <select name="batype" class="form-control">
                                    <?php foreach($this->setConfig->shipBank() as $bank):?>
                                        <option value="<?php echo $bank ?>" <?php echo $userinfo[ 'batype']==$bank
                                        ? ' selected' : ''?>
                                            >
                                            <?php echo $bank ?>
                                        </option>
                                        <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                收款账号：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="baname" class="form-control" value="<?php echo $userinfo['baname']?>"
                                placeholder="支付宝/财付通/银行卡" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                开户地址：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="baaddr" class="form-control" value="<?php echo $userinfo['baaddr']?>"
                                placeholder="省份/城市/分行名称" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                网站名称：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="sitename" class="form-control" value="<?php echo $userinfo['sitename']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                站点地址：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="siteurl" class="form-control" value="<?php echo $userinfo['siteurl']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-4">
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
    </div>  
	</div>
	   </div>
	   	   </div>
		   	   </div>
			    </div>
    <?php require_once 'footer.php' ?>