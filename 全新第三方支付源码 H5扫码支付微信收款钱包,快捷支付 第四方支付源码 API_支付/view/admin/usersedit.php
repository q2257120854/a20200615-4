<?php require_once 'header.php' ?>
<style>
#DemoArea
{

width: 220px;
height: 150px;

}
#DemoArea .box-ribbon {
	color: #fff;
    position: absolute;
    line-height: 24px;
    text-align: center;
    top: 175px;
    right: 592px;
    width: 100px;
    height: 25px;
    padding: 1px;
	border-radius:2px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.13);

    background-color: #5DB9E4;
}

#DemoArea img{
	border-radius:10px;
	margin:0;
	padding:0;
	margin-left: 10px;
	background-color: #ffffff;
	border: 1px solid #c3c3c3;
   width:100%;
   height:100%;
}
</style>
<script type="text/javascript">
<!--
function test_demo_val(strValue)
{

var strId="DemoArea"

document.getElementById(strId).style.borderRadius=strValue;

document.getElementById("CodeValue").innerHTML=strValue;
}
//-->
</script>
    <h3>
        <span class="current">
            编辑用户信息
        </span>
    </h3>
    <br>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            基本信息
        </div>
        <div class="panel-body">
            <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>users/editsave/<?php echo $user['id']?>"
            method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        用户编号：
                    </label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?php echo $user['id']?>"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        用户名：
                    </label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?php echo $user['username']?>"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        登录密码：
                    </label>
                    <div class="col-md-4">
                        <input type="password" name="userpass" class="form-control">
                    </div>
                    <span class="col-md-4">
                        若不修改，请留空
                    </span>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        账号类型：
                    </label>
                    <div class="col-md-4">
                        <select name="is_agent" class="form-control">
                            <option value="1" <?php echo $user['is_agent']=='1' ? ' selected' :
                            ''?>
                                >代理账号
                            </option>
                            <option value="0" <?php echo $user['is_agent']=='0' ? ' selected' :
                            ''?>
                                >用户账号
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        开通提现：
                    </label>
                    <div class="col-md-4">
                        <select name="is_takecash" class="form-control">
                            <option value="1" <?php echo $user['is_takecash']=='1' ? ' selected'
                            : ''?>
                                >开通
                            </option>
                            <option value="0" <?php echo $user['is_takecash']=='0' ? ' selected'
                            : ''?>
                                >不开通
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        账号状态：
                    </label>
                    <div class="col-md-4">
                        <select name="is_state" class="form-control">
                            <option value="1" <?php echo $user['is_state']=='1' ? ' selected' :
                            ''?>
                                >已开通
                            </option>
                            <option value="0" <?php echo $user['is_state']=='0' ? ' selected' :
                            ''?>
                                >未开通
                            </option>
                            <option value="2" <?php echo $user['is_state']=='2' ? ' selected' :
                            ''?>
                                >已停用
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        结算类型：
                    </label>
                    <div class="col-md-4">
                        <select name="ship_type" class="form-control">
                            <?php foreach($this->setConfig->shipType() as $key=>$val):?>
                                <option value="<?php echo $key?>" <?php echo $user['ship_type']==$key
                                ? ' selected' : ''?>
                                    >
                                    <?php echo $val?>
                                </option>
                                <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        结算周期：
                    </label>
                    <div class="col-md-4">
                        <select name="ship_cycle" class="form-control">
                            <?php foreach($this->
                                setConfig->shipCycle() as $key=>$val):?>
                                <option value="<?php echo $key?>" <?php echo $user['ship_cycle']==$key
                                ? ' selected' : ''?>
                                    >
                                    <?php echo $val?>
                                </option>
                                <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        手机认证：
                    </label>
                    <div class="col-md-4">
                        <select name="is_verify_phone" class="form-control">
                            <option value="1" <?php echo $user['is_verify_phone']=='1' ?
                            ' selected' : ''?>
                                >已认证
                            </option>
                            <option value="0" <?php echo $user['is_verify_phone']=='0' ?
                            ' selected' : ''?>
                                >未认证
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        邮箱认证：
                    </label>
                    <div class="col-md-4">
                        <select name="is_verify_email" class="form-control">
                            <option value="1" <?php echo $user['is_verify_email']=='1' ?
                            ' selected' : ''?>
                                >已认证
                            </option>
                            <option value="0" <?php echo $user['is_verify_email']=='0' ?
                            ' selected' : ''?>
                                >未认证
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        接入密钥：
                    </label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?php echo $user['apikey']?>"
                        disabled>
                    </div>
                    <span class="col-md-4">
                        &nbsp;
                        <a href="<?php echo $this->dir?>users/resetapikey/<?php echo $user['id']?>">
                            <span class="glyphicon glyphicon-refresh" data-toggle="tooltip" title="重新生成密钥">
                            </span>
                        </a>
                    </span>
                </div>
               <!-- <div class="form-group">
                    <label class="col-md-2 control-label">
                        收银台功能：
                    </label>
                    <div class="col-md-4">
                        <select name="is_checkout" class="form-control">
                            <option value="1" <?php echo $user['is_checkout']=='1' ? ' selected'
                            : ''?>
                                >已开通
                            </option>
                            <option value="0" <?php echo $user['is_checkout']=='0' ? ' selected'
                            : ''?>
                                >未开通
                            </option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        API功能：
                    </label>
                    <div class="col-md-4">
                        <select name="is_paysubmit" class="form-control">
                            <option value="1" <?php echo $user['is_paysubmit']=='1' ? ' selected'
                            : ''?>
                                >已开通
                            </option>
                            <option value="0" <?php echo $user['is_paysubmit']=='0' ? ' selected'
                            : ''?>
                                >未开通
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        商户网址验证：
                    </label>
                    <div class="col-md-4">
                        <select name="is_verify_siteurl" class="form-control">
                            <option value="1" <?php echo $user['is_verify_siteurl']=='1' ?
                            ' selected' : ''?>
                                >验证
                            </option>
                            <option value="0" <?php echo $user['is_verify_siteurl']=='0' ?
                            ' selected' : ''?>
                                >不验证
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        代理编号：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="superid" class="form-control" value="<?php echo $user['superid']?>">
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
	
	<div class="panel panel-default">
        <div class="panel-heading">
           资质信息
        </div>
        <div class="panel-body">
            <form class="form-ajax form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        身份证正面：
                    </label>
                    <div class="col-md-4">
                        <?php 
						
						if (!$userinfo['shenfen']){
						
							echo "未上传";
						}else{
						
							echo "<div id='DemoArea'><a target='_blank' href='".$userinfo['shenfen']."'><img src='".$userinfo['shenfen']."' width=300 /></a></div>";
						
						}
						
						?>
                              
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        身份证反面：
                    </label>
                    <div class="col-md-4">
                         <?php 
						
						if (!$userinfo['fanbian']){
						
							echo "未上传";
						}else{
						
							echo "<div id='DemoArea'><a target='_blank' href='".$userinfo['fanbian']."'><img src='".$userinfo['fanbian']."' width=300 /></a></div>";
						
						}
						
						?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        营业执照：
                    </label>
                    <div class="col-md-4">
                           <?php 
						
						if (!$userinfo['yingye']){
						
							echo "未上传";
						}else{
						
							echo "<div id='DemoArea'><a target='_blank' href='".$userinfo['yingye']."'><img src='".$userinfo['yingye']."' width=300 /></a></div>";
						
						}
						
						?>
                    </div>
                   
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        开户许可证：
                    </label>
                    <div class="col-md-4">
                          <?php 
						
						if (!$userinfo['xuke']){
						
							echo "未上传";
						}else{
						
							echo "<div id='DemoArea'><a target='_blank' href='".$userinfo['xuke']."'><img src='".$userinfo['xuke']."' width=300 /></a></div>";
						
						}
						
						?>
                    </div>
                </div>
               
                
                
            </form>
        </div>
    </div>
	
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    联系信息
                </div>
                <div class="col-sm-6 text-right" style="font-size:0.9em;color:#999">
                    <?php echo '最后一次更新于：'.date( 'Y-m-d H:i:s',$userinfo['lastime'])?>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>users/editsave2/<?php echo $user['id']?>"
            method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        真实姓名：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="realname" class="form-control" value="<?php echo $userinfo['realname']?>"
                        required>
                    </div>
                    <label class="col-md-2 control-label">
                        收款银行：
                    </label>
                    <div class="col-md-4">
                        <select name="batype" class="form-control">
                            <?php foreach($this->setConfig->shipBank() as $val):?>
                                <option value="<?php echo $val?>" <?php echo $val==$userinfo['batype'] ? ' selected' : ''?>>
                                    <?php echo $val?>
                                </option>
                                <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        手机号码：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="phone" class="form-control" value="<?php echo $userinfo['phone']?>"
                        required>
                    </div>
                    <label class="col-md-2 control-label">
                        收款账号：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="baname" class="form-control" value="<?php echo $userinfo['baname']?>"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        注册邮箱：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="email" class="form-control" value="<?php echo $userinfo['email']?>"
                        required>
                    </div>
                    <label class="col-md-2 control-label">
                        开户地址：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="baaddr" class="form-control" value="<?php echo $userinfo['baaddr']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        联系QQ：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="qq" class="form-control" value="<?php echo $userinfo['qq']?>"
                        required>
                    </div>
                    <label class="col-md-2 control-label">
                        身份证号：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="idcard" class="form-control" value="<?php echo $userinfo['idcard']?>"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        网站名称：
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="sitename" class="form-control" value="<?php echo $userinfo['sitename']?>" required>
                    </div>
                    <label class="col-md-2 control-label">
                        站点地址：
                    </label>
                    <div class="col-md-4">
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
    <?php require_once 'footer.php' ?>