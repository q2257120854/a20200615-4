<?php require_once 'header.php'; ?>
    <style>
        .index-content{padding:15px;}.index-content .left-border{border-left:0px
        solid #ddd}.index-content>.row>.col-sm-6{border: 1px solid #fff;padding:60px
        25px 50px 35px;min-height:210px;margin-left:-1px;margin-top:-1px}.index-content>.row>.col-sm-6:hover{background:
        #fafafa}.bf{font-size: 4em;color:#349EDC}.bf1{font-size: 1em;color:#999}.bf2{font-size:
        2em;overflow-x:auto;color:#333}.bf2 a{color:#333}
    </style>
  <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                          
            &nbsp;接入信息
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
                ，请继续完善注册信息然后联系客服以便审核。
            </div>
            <?php endif;?>
        	 <div class="panel-body">
                <div class="content-box">
                    <?php if($this->userData['is_state']=='0'):?>
    <div class="text-center">
                            <a href="/member/userinfo" class="btn btn-warning">
                                <span class="glyphicon glyphicon-circle-arrow-right">
                                </span>
                                &nbsp;继续完善注册信息
                            </a>
                        </div>
                        <?php else:?>
						

                            <div class="index-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col-sm-3">
                                  
											   <i class="fa fa-user bf"></i>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                                接入编号
                                            </p>
                                            <p class="bf2">
                                                <?php echo $_SESSION[ 'login_userid']?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 left-border">
                                        <div class="col-sm-3">
                                 <i class="fa fa-key bf"></i>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                                接入密钥
                                            </p>
                                            <p class="bf2">
                                                <a href="javascript:;" onclick="showContent('接入密钥','/member/api/show')">
                                                    点击获取
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-3">
                       <i class="fa fa-download bf "></i>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                               SDK开发文档
                                            </p>
                                            <p class="bf2">
                                                <a href="/upload/demo.rar">
                                                    立即下载
                                                </a>
                                            </p>
                                        </div>
                                    </div>
									
									 <div class="col-sm-6 left-border">
                                        <div class="col-sm-3">
                                            <span class="glyphicon glyphicon-file bf">
                                            </span>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                               网关提交地址
                                            </p>
                                            <p>
												http://<?php echo $this->config['siteurl']?>/apisubmit
												<br>
                                            </p>
                                        </div>
                                    </div> 
									
									<div class="col-sm-6">
                                        <div class="col-sm-3">
                                            <span class="glyphicon glyphicon-file bf">
                                            </span>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                               DEMO 测试页(手机自适应)
                                            </p>
											<p class="bf2">
                                               <a target="_blank" href="/demo">
                                                    立即测试
                                                </a>
                                            </p>
                                            
                                        </div>
                                    </div>
									
									
									
                            <!--        <div class="col-sm-6 left-border">
                                        <div class="col-sm-3">
                                            <span class="glyphicon glyphicon-file bf">
                                            </span>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="bf1">
                                                我的收银台
                                            </p>
                                            <p class="bf2">
                               <a href="javascript:;" onclick="showContent('配置收银台','/member/api/syt')">
                                         点击打开
                                                </a>
                                            </p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <?php endif;?>
                </div>
    </div></div></div></div></div></div>
    <?php require_once 'footer.php'; ?>