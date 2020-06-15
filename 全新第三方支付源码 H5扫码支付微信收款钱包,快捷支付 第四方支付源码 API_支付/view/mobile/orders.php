<?php require_once 'header.php' ?>
<style>
	body{
		background:#fff;
	}
	.bheader{
		height:20px;
		width:100%;
	}
	.bheader1{
		height:40px;
		background:#fff;
		width:100%;
		border-bottom:1px solid #ccc;
	}
	.bheader1l{
		margin-left:3%;
		float:left;
		width:25%;
	}
	.bheader1l a{
		font-size:20px;
		color:#06F;
		text-decoration:none;
	}
	.bheader1c{
		float:left;
		width:100px;
		margin-left:auto;
		margin-right:auto;
		width:44%;
		
	}
	.bheader1r{
		margin-right:3%;
		float:right;
		width:25%;
	}
	.bheader1r a{
		font-size:20px;
		color:#06F;
		text-decoration:none;
	}
	.bheader2{
		height:60px;
		background:#fff;
		width:100%;
	}
	.bheader3{
		height:30px;
		background:#eee;
		width:100%;
	}
	.bheader3l{
		height:30px;
		line-height:30px;
		margin-left:3%;
	}
</style>
<div class="bheader">
	<div class="bheader1">
    	<div class="bheader1l">
        	<a href="/mobile/"><返回</a>
        </div>
        <div class="bheader1c" align="center">
        	<b>账单</b>
        </div>
        <div class="bheader1r" align="right">
        	<a href="/mobile/">筛选</a>
        </div>
    </div>
    <div class="bheader2" align="center">
    	<div style="width:100%; height:5px;"></div>
    	<img src="/static/common/logo.jpg" width="200px" style="margin-left:auto; margin-right:auto;"/>
    </div>
    <div class="bheader3">
    	<div class="bheader3l">
        	本月
        </div>
    </div>
</div>
    <div class="aui-content aui-margin-b-15">
        <ul class="aui-list aui-media-list">
           <?php if($lists){?>
          	<?php foreach($lists as $key=>$val){?>
            <li class="aui-list-item aui-list-item-middle">
                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-media" style="width: 3rem;">
                        <img src="/static/common/ico.png" class="aui-img-round aui-list-img-sm">
                    </div>
                    <div class="aui-list-item-inner aui-list-item-arrow">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title aui-font-size-14">订单号	<?php echo $val['orderid'];?></div>
                            <div style="color:#000" class="aui-list-item-right aui-font-size-18">+<?php echo $val['realmoney'];?></div>
                        </div>
                        <div class="aui-list-item-text aui-font-size-12">
                           <?php echo date( 'm-d H:i:s',$val['addtime']);?>
                        </div>
                    </div>
                </div>
            </li>
			<?php }}?>

        </ul>
    </div>
<div style="width:100%; height:70px;"></div>
<?php require_once 'footer.php'; ?>