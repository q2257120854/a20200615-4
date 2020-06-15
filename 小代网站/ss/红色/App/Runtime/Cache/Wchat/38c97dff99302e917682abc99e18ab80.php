<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
	<!--苹果页面防跳转开始-->
<script src="//ios.js" type="text/javascript"></script>
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
		<link rel="stylesheet" href="__PUBLIC__/Wchat/css/dhkCss.css" />
		<title>提现管理 - <?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>  - <?php
 $value = C("siteTitle"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?></title>
	</head>
	<body>
		<div class="hk_head">
			<p>信用额度￥<?php echo ($tojr); ?></p>
		</div>
		<div class="hk_list">
<?php $empty="<span style='text-align: center;display: block;margin-top: 1rem;'>暂时没有订单</span>"; ?>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['pending'] == 0 || $vo['aus'] == 1 ): ?><div class="one_hk">
				<div class="ON">
					<a href="javascript:;">借款订单号：<?php echo ($vo["oid"]); ?></a>
				</div>
				<div class="hk_con">
				<?php if($vo['tco']): ?><div class="con_left" style="background-color: #<?php echo ($vo["tco"]); ?>;">
					<?php else: ?>
					<div class="con_left" style="background-color: #3ed050;"><?php endif; ?>
						<h2><?php echo (($vo["dbt"])?($vo["dbt"]):"$dbt"); ?></h2>
						<span>￥<?php echo ($tojr); ?>元</span>
					</div>
					<div class="m_con_right">
			
		<h2><?php echo (date("Y.m.d",$vo["add_time"])); if($vo['infoo'] == '2'): ?><a href="javascript:yqm('<?php echo ($vo["oid"]); ?>','<?php echo ($vo["yqm"]); ?>');"><?php if($vo['yqm'] != ''): ?>保单号:<?php echo ($vo["yqm"]); else: ?>绑定保单<?php endif; ?></a><?php endif; ?></h2>
						<span><?php echo (($vo["error"])?($vo["error"]):"$allsm"); ?></span>
					</div>
				</div>
			</div>
	<?php elseif($vo['pending'] == 2): ?>
		<div class="one_hk">
			<div class="ON">
				<a href="javascript:;">借款订单号：<?php echo ($vo["oid"]); ?></a>
			</div>
			<div class="hk_con">
				<div class="con_left" style="background-color: #f54747;">
					<h2>未通过</h2>
					<span>申请驳回</span>
				</div>
				<div class="con_right">
					<h2><?php echo (date("Y.m.d",$vo["add_time"])); ?></h2>
					<span><?php echo ($vo["error"]); ?></span>
				</div>
			</div>
		</div>
	<?php else: ?>

			<div class="one_hk">
			<div class="ON">
				<a href="<?php echo U('Repay/viewbill',array('oid'=>$vo['id']));?>">借款订单号：<?php echo ($vo["oid"]); ?></a>
			</div>
			<div class="hk_con">
				<div class="con_left" >
					<h2><?php echo (($vo["zt"])?($vo["zt"]):"$indexdbt"); ?></h2>
					<span>￥<?php echo ($ojr); ?></span>
				</div>
				<div class="con_right">
					<h2><?php echo (date("Y.m.d",$vo["bill"]["add_time"])); ?></h2>

					<span><?php echo (($vo["error"])?($vo["error"]):"$indexsm"); ?></span>
				</div>
			</div>
		</div><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
		</div>
		<link href="__PUBLIC__/Wchat/css/footer.css" rel="stylesheet">
		<div class="foot">
			<ul>
				<li class="col-xs-4 index_sel">
					<a href="<?php echo U('Index/index');?>">首页</a>
				</li>
				<li class="col-xs-4 withdraw_on">
					<a href="<?php echo U('Repay/index');?>">借款</a>
				</li>
				<li class="col-xs-4 more">
					<a href="<?php echo U('Index/more');?>">我的</a>
				</li>
			</ul>
		</div>
	</body>
	<script src="/Public/Wchat/js/layer/layer.js"></script>
	<script src="/Public/Wchat/js/cv2.js"></script>
	<script>
	function yqm(oid,sm){
				if (sm == 'undefined' || sm == '' || sm == null)
				{
					var tit = '请输入保单号';
				}else{
					var tit = '请重新输入保单号';
				}
							layer.prompt(
							{
								title: tit,
								formType:0
							},
							function(str,index){
								
								layer.close(index);
								CvPHPm.post(
									"<?php echo U('Repay/yqm');?>",
									{
										strc:str,
										id:oid
									},
									function(data){
										if(data.status!=1){
											layer.msg(data.info);
										}else{								
											layer.msg("操作成功");
										setTimeout(function(){
											window.location.href = window.location.href;
										},1000);

										}
									}
								);
							}
						);
	}
	</script>
</html>