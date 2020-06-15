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
                       
							
							
       
        <?php if($this->
            userData['is_state']=='0'):?>
            <div class="alert alert-warning" style="margin-bottom:1;">
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
						     <div class="panel-body">

           	<div class="table-responsive">
                  <div class="alert alert-warning" style="margin-bottom:1;">
             
                            
                                <span class="glyphicon glyphicon-circle-arrow-right">
                                </span>
                                &nbsp;结算方式 <span class="label label-success">
                            <?php echo $this->setConfig->shipCycle($this->userData['ship_cycle'])?>
                        </span>
                            </a>
                        </div>
                 
                                   <table class="table table-bordered">
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
                                        <!--<th>
                                            操作
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($userprice):?>
                                        <?php foreach($userprice as $key=>$val):?>


										 <?php if($val[ 'is_state']=='0' ):?>

                                            <tr>
                                                <td>
                                                    <a href="javascript:;" onclick="alert('<?php echo $val[ 'name']?>     费率:<?php echo $val[ 'uprice']?>')" class="btn btn-default btn-sm"><?php echo $val[ 'name']?></a>
                                                </td>
                                                <td>
                                                   <a href="javascript:;" class="btn btn-default btn-sm"><?php echo $val[ 'uprice']?></a>
                                                </td>
                                                <td class="label<?php echo $val['id']?>">
                                                    <?php if($val[ 'is_state']=='0' ):?>
                                                        <span class="label label-success">
                                                  		           <i class="fa fa-check-circle"></i> 
                                                        </span><a href="javascript:;" onclick="alert('通道状态正常！')" class="btn btn-default btn-sm">
                                                            正常
                                                        </a>
                                                        <?php else:?>
                                                            <span class="label label-danger">
                                            		<i class="fa fa-times-circle"></i> <a href="javascript:;" onclick="alert('通道状态维护中！')" class="btn btn-default btn-sm">
                                                                维护中
                                                            </a>
                                                            </span>
                                                            <?php endif;?>
                                                </td>
                                                <!--<td class="btn<?php echo $val['id']?>">
                                                    <?php if($val[ 'is_state']=='0' ):?>
                                                        <a href="javascript:;" onclick="alert('通道状态正常！')" class="btn btn-default btn-sm">
                                                            正常
                                                        </a>
                                                        <?php else:?>
                                                            <a href="javascript:;" onclick="alert('通道状态维护中！')" class="btn btn-default btn-sm">
                                                                维护中
                                                            </a>
                                                            <?php endif;?>
                                                </td> -->
                                            </tr>



											<?php endif;?>



                                            <?php endforeach;?>
                                                <?php endif;?>
                                </tbody>
                            </table>
							</div>
                            <?php endif;?>
                </div>
    </div>  
	</div>
	   </div>
	   	   </div>
		   	   </div>
			    </div></div>
    <?php require_once 'footer.php' ?>
	



