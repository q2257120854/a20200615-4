<?php require_once 'header.php' ?>
 <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                             <?php echo $title ?>
                                </div>
                            </div>
                            <div class="panel-body">
        <?php if($this->
            userData['is_state']=='0'):?>
            <div class="alert alert-warning" style="margin-bottom:0">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                &nbsp;您当前的账号状态为
                <span class="label label-danger">
                    未审核
                </span>
                ，请继续完善注册信息然后联系客服以便审核。
            </div>
            <?php endif;?>
                <div class="content-box">
                    <?php if($this->userData['is_state']=='0'):?>
                        <div class="text-center">
                            <a href="/agent/userinfo" class="btn btn-warning">
                                <span class="glyphicon glyphicon-circle-arrow-right">
                                </span>
                                &nbsp;继续完善注册信息
                            </a>
                        </div>
                        <?php else:?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            通道名称
                                        </th>
                                        <th>
                                            结算费率
                                        </th>
                                        <th>
                                            当前状态
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($userprice):?>
                                        <?php foreach($userprice as $key=>
                                            $val):?>
                                            <tr>
                                                <td>
                                                    <?php echo $val['name']?>
                                                </td>
                                                <td>
                                                    <?php echo $val['gprice']?>
                                                </td>
                                                <td>
                                                   
															
															 <?php if($val[ 'is_state']=='0' ):?>
                                                        <a href="javascript:;" onclick="alert('通道开放中,请联系管理员关闭！')" class="btn btn-default btn-sm">
                                                            正常
                                                        </a>
                                                        <?php else:?>
                                                            <a href="javascript:;" onclick="alert('通道关闭中,请联系管理员打开！')" class="btn btn-default btn-sm">
                                                                维护中
                                                            </a>
                                                            <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                                <?php endif;?>
                                </tbody>
                            </table>
                            <?php endif;?>
                </div>
    </div></div>
    </div></div></div></div>
    <?php require_once 'footer.php' ?>