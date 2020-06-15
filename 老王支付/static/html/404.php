<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $msg;?></title>
<link href="<?php echo URL_STATIC;?>html/404/css/404.css" rel="stylesheet" type="text/css" />
<script src="<?php echo URL_STATIC;?>js/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		var h = $(window).height();
		$('body').height(h);
		$('.mianBox').height(h);
		centerWindow(".tipInfo");
	});
	function centerWindow(a) {
		center(a);
		$(window).bind('scroll resize',
				function() {
					center(a);
				});
	}
	function center(a) {
		var wWidth = $(window).width();
		var wHeight = $(window).height();
		var boxWidth = $(a).width();
		var boxHeight = $(a).height();
		var scrollTop = $(window).scrollTop();
		var scrollLeft = $(window).scrollLeft();
		var top = scrollTop + (wHeight - boxHeight) / 2;
		var left = scrollLeft + (wWidth - boxWidth) / 2;
		$(a).css({
			"top": top,
			"left": left
		});
	}
</script>
</head>
<body>
<div class="mianBox">
	<img src="<?php echo URL_STATIC;?>html/404/images/yun0.png" alt="" class="yun yun0" />
	<img src="<?php echo URL_STATIC;?>html/404/images/yun1.png" alt="" class="yun yun1" />
	<img src="<?php echo URL_STATIC;?>html/404/images/yun2.png" alt="" class="yun yun2" />
	<img src="<?php echo URL_STATIC;?>html/404/images/bird.png" alt="" class="bird" />
	<img src="<?php echo URL_STATIC;?>html/404/images/san.png" alt="" class="san" />
	<div class="tipInfo">
		<div class="in">
			<div class="textThis">
				<h2><?php echo $msg;?></h2>
				<p style="margin-left: -40px;"><span>请稍等,<a href="<?php echo $url;?>">立即跳转</a></span><span>等待<b id="wait"><?php echo $time;?></b>秒</span></p>
				<script type="text/javascript">                            (function() {
						var wait = document.getElementById('wait');
						var interval = setInterval(function() {
							var time = --wait.innerHTML;
							if (time <= 0) {
								clearInterval(interval);
								location.href = "<?php echo $url;?>";
							}
							;
						}, 1000);
					})();
				</script>
			</div>
		</div>
	</div>
</div>
</body>
</html>