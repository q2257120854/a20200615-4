<?php require_once 'header.php' ?>
    <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                             <?php echo $title ?> &nbsp;当前显示7天内的登录日志
                                </div>
                            </div>
					
   
			 <div class="panel-body">	
        <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead">
                <thead>
                    <tr>
                        <th>
                            登录日期
                        </th>
                        <th>
                            IP
                        </th>
						    <th>
                            地理位置
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>$val):?>
                            <tr>
                                <td>
                                    <?php echo date( 'Y-m-d H:i:s',$val[ 'addtime'])?>
                                </td>
                                <td>
                                    <?php echo $val[ 'ip']?>
                                </td>
								  <td>
                                    <?php echo $val[ 'address']?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="2">
                                            no data.
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
         
 </div> <?php if($lists):?>
           
                    <?php echo $pagelist ?>
       
                <?php endif;?>		
    </div></div></div></div></div></div>
	   
    <?php require_once 'footer.php' ?>