<?php require_once 'header.php';
$url='http://' .$this-> config['siteurl'].'/register?id='.$this->session->get('login_agentid');?>
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
        <div class="alert alert-success" style="margin-bottom:0">
            邀请注册链接：
            <a href="<?php echo $url?>">
                <?php echo $url?>
            </a>
            &nbsp;
            <a href="javascript:;" data="<?php echo $url?>" class="zclipCopy blue">
                复制
            </a>
        </div><br>
        <div style="background:#fff;padding:20px 15px;border:1px solid #ddd">
            <form class="form-inline" action="" method="get">
                <input type="text" class="form-control" name="uname" placeholder="商户名/编号"
                value="<?php echo $search['uname']?>" size="15">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                    &nbsp;立即查询
                </button>
            </form>
        </div>
        <div class="content-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            商户编号
                        </th>
                        <th>
                            商户名
                        </th>
                        <th>
                            注册时间
                        </th>
                        <th>
                            账号状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>
                            $val):switch($val['is_state']){case 0: $state='
                            <span class="label label-warning">
                                待审核
                            </span>
                            '; break;case 1: $state='
                            <span class="label label-success">
                                已审核
                            </span>
                            '; break;case 2: $state='
                            <span class="label label-danger">
                                已停用
                            </span>
                            '; break;}?>
                            <tr>
                                <td>
                                    <?php echo $val[ 'id']?>
                                </td>
                                <td>
                                    <?php echo $val[ 'username']?>
                                </td>
                                <td>
                                    <?php echo date( 'Y-m-d H:i:s',$val[ 'addtime'])?>
                                </td>
                                <td>
                                    <?php echo $state?>
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="showContent('设置下级用户费率','/agent/users/setuserrate/<?php echo $val['id']?>')">
                                        <span class="glyphicon glyphicon-cog" data-toggle="tooltip" title="设置费率">设置费率
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            no data.
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div></div></div></div></div></div>
    <?php require_once 'footer.php' ?>