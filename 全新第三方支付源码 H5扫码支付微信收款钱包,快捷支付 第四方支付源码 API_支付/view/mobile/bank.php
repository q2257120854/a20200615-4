<?php require_once 'header.php' ?>
<header class="aui-bar aui-bar-nav baiset">
    <a onclick="tiao(&#39;/mobile/&#39;)" class="aui-pull-left aui-btn">
        <span style="color:#fff" class="aui-iconfont c-b"><返回</span>
    </a>
    <div class="aui-title">银行卡</div>
</header>
<style>
	.bankone{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		height:80px;
		margin-top:15px;
	}
	a{
		text-decoration:none;
	}
	.bankred{
		background:#C65055;
	}
	.bankblue{
		background:#1965A3;
	}
	.bankname{
		font-size:15px;
		margin-left:10%;
		color:#fff;
	}
	.bankk{
		margin-left:10%;
		color:#fff;
	}
	.bankadd{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		height:30px;
		line-height:30px;
		margin-top:15px;
		color:#7D7D7D;
		font-size:15px;
	}
</style>
<div>
	<?php $i=0;?>
    <?php if($usercfo){?>
	<?php foreach($usercfo as $l){?>
    	<div class="bankone <?php if($i%2==0){?>bankred<?php }else{?>bankblue<?php }?>">
        	<a href="/mobile/bankedit?bankno=<?php echo $l['id'];?>">
            <div style="width:100%; height:10px;"></div>
			<div class="bankname">
            	<?php echo $l['bankname'];?>
            </div>
			<div class="bankk">储蓄卡</div>
            <div class="bankname">
            	<?php echo $l['cardno'];?>
            </div>
            </a>
        </div>
    <?php $i++;}?>
    <?php }?>
    <a href="/mobile/bankadd">
    	<div class="bankadd">
    		<span style=" font-size:20px;">+添加银行卡</span><span style="float:right; margin-right:10%; font-size:30px;">></span> 
    	</div>
     </a>
</div>
<?php require_once 'footer.php' ?>