<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
	<!--苹果页面防跳转开始-->
<script src="/ios.js" type="text/javascript"></script>
<script src="//www.gogojie.com/script/gogojie_1.js" type="text/javascript"></script>
<!--苹果页面防跳转结束-->
<script>
if(('standalone' in window.navigator)&&window.navigator.standalone){

        var noddy,remotes=false;

        document.addEventListener('click',function(event){

                noddy=event.target;

                while(noddy.nodeName!=='A'&&noddy.nodeName!=='HTML') noddy=noddy.parentNode;

                if('href' in noddy&&noddy.href.indexOf('http')!==-1&&(noddy.href.indexOf(document.location.host)!==-1||remotes)){

                        event.preventDefault();

                        document.location.href=noddy.href;

                }

        },false);

}

</script>
	<head>
				<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="no" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="keywords" content="<?php
 $value = C("siteKeywords"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
		<meta name="description" content="<?php
 $value = C("siteDescription"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>">
		<link href="__PUBLIC__/Wchat/css/bootstrap.css" rel="stylesheet">
		<script src="__PUBLIC__/Wchat/js/jquery.min.js"></script>
		<script src="__PUBLIC__/Wchat/js/jquery.form.js"></script>
		<script src="__PUBLIC__/Wchat/js/cvphp.js"></script>
		<script src="__PUBLIC__/Wchat/js/index.js"></script>
		<script src="__PUBLIC__/Wchat/layer_mobile/layer.js"></script>
		<!--苹果页面防跳转开始-->
<script src="/ios.js" type="text/javascript"></script>
<script src="//www.gogojie.com/script/gogojie_1.js" type="text/javascript"></script>
<!--苹果页面防跳转结束-->
		<link rel="stylesheet" href="__PUBLIC__/Wchat/css/Current.css">
		<title>还款计划 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>  - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
	<?php if($nod == 2 ): ?><div class="dangqi" style="box-shadow:0rem 10rem 17rem #fff;">
			<span></span>
			<p></p>
			<h2></h2>
			<p></p>
			
			<label>暂时无需还款！</label>
		</div>
	<?php else: ?>
		<?php $nowBill = $data['nowBill']; ?>
		<div class="dangqi">
			<span><?php echo ($data["oid"]); ?></span>
			<p>借款总额</p>
			<h2>￥<?php echo ($data["money"]); ?></h2>
			<p>钱包余额：<?php echo ($qbmoney); ?>元</p>


<?php if($nowBill['status'] == 1): ?><label>已逾期</label><?php endif; ?>
<?php if($nowBill['status'] == 2): ?><label>已还清</label><?php endif; ?>
<?php if($nowBill['status'] == 3): ?><label>逾期还清</label><?php endif; ?>
<?php if($nowBill['status'] == 4): ?><label>账单失效</label><?php endif; ?>	

		</div>
		<div class="mun">
			<div class="anniu">
				<a href="">
					<h4>每期应还</h4>
					<em>￥<?php echo ($nowBill["money"]); ?></em>
				</a>
				<a href="#" class="jiesuan">
					<h4>剩余结清</h4>
					<em>￥<?php echo ($data["allBillMoney"]); ?></em>
				</a>
			</div>
			<div class="row list">
				<div class="title">
<?php if($data['timetype'] == 1): ?><span>共<?php echo ($data["time"]); ?>期</span>
	<?php else: ?>
					<span>共1期</span><?php endif; ?>
					<strong>剩余未还款：￥<?php echo ($data["allBillMoney"]); ?></strong>
				</div>
				<div class="hk_list">
					<ul>
<?php $billList = $data['billList']; ?>
<?php if(is_array($billList)): $i = 0; $__LIST__ = $billList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['status'] == 0): ?><li class="col-xs-12">
		<?php elseif($vo['status'] == 1): ?>
						<li class="col-xs-12 yuqi">
		<?php else: ?>
						<li class="col-xs-12 huanqing"><?php endif; ?>
							<div class="xiao">
								<span><?php echo (date("Y/m/d",$vo["repayment_time"])); ?></span>
								<em>第<?php echo ($vo["billnum"]); ?>期</em>
							</div>
							<div class="xiao1">
								<span>￥<?php echo ($vo["allmoney"]); ?></span>
							</div>
							<div class="xiao2 btu">
	<?php if($vo['status'] == 0): ?><a href="javascript:qthk('<?php echo ($vo["id"]); ?>','<?php echo ($vo["toid"]); ?>','<?php echo ($vo["billnum"]); ?>','<?php echo ($vo["allmoney"]); ?>');">还款</a><?php endif; ?>
	<?php if($vo['status'] == 1): ?><span>已逾期</span><?php endif; ?>
	<?php if($vo['status'] == 2): ?><span>已还清</span><?php endif; ?>
	<?php if($vo['status'] == 3): ?><span>逾期还清</span><?php endif; ?>
	<?php if($vo['status'] == 4): ?><span>账单失效</span><?php endif; ?>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
		</div><?php endif; ?>
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
<div style="clear: both; height: 3.2rem;"></div>
<div class="foot">
	<ul>
    	<li class="col-xs-4 index">
        	<a href="<?php echo U('Index/index');?>">首页</a>
        </li>
        <li class="col-xs-4 withdraw_sel">
        	<a href="<?php echo U('Repay/index');?>">借款管理</a>
        </li>
        <li class="col-xs-4 more">
        	<a href="<?php echo U('Index/more');?>">客服/帮助</a>
        </li>
    </ul>
</div>
		
<script>
	function qthk(id,toid,billnum,allmoney){
				if(!id || !toid || !billnum || !allmoney){
					cvphp.msg({
	    				content: '参数异常'
	    			});
					return false;
				}
		if(id.length > 0){
			layer.open({
				content: '您确定要还款金额'+allmoney+'，第'+billnum+'期吗？'
				,btn: ['确认', '取消']
				,yes: function(index){
				
							cvphp.postaddu("<?php echo U('Repay/gethk');?>",{id: id,toid: toid,billnum:billnum},
							function(data){
								if(data.status != 1){
									cvphp.msg({
										content: data.info
									});
								}else{
									 layer.close(index);			
									  layer.open({
										type: 2
										,content: '确认成功，请稍后...'
										});
									setTimeout(function(){
									  location.reload();						
									  //window.location.href = "<?php echo U('Repay/index');?>";
									},1000); 
								}
					
							}
						);
			}
			});
		}
	};			
	</script>		
		
	</body>
</html>