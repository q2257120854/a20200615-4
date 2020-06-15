<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>导出工具</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="//cdn.bootcss.com/layer/2.3/skin/layer.css" rel="stylesheet">
		<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//cdn.bootcss.com/layer/2.3/layer.js"></script>
		<script src="//cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
		<!--[if lt IE 9]>
			<script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
        <style type="text/css">
			[v-cloak] {
			  display: none;
			}
			body {
				margin: 0 auto;
			}
        </style>
	</head>
	<body>
		<main id="vue-app" v-cloak>
			<nav class="navbar navbar-fixed-top navbar-default">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">自助提取</a>
					</div>
				</div><!-- /.container -->
			</nav><!-- /.navbar -->
			<div class="container" style="padding-top:70px;">
				<div class="row" >
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">抖音ID（自动获取）+ 抖音用户ID（自动获取）自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											抖音链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="DYSP" placeholder="请输入抖音视频链接"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">快手ID（自动获取）+ 作品ID（自动获取）自动识别</div>
							<div class="panel-body">
							<form @submit.prevent>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											快手链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="KSSP" placeholder="请输入快手短视频链接"/>
									</div>
								</div>
								<div class="hidden" id="KSSP">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												用户ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												作品ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" onclick="$(this).parent().parent().addClass('hidden');$(this).parent().parent().prev().children().children('input').val('')">重新获取</button>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">微视ID（自动获取）+ 微视用户ID（自动获取） 自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											微视链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="WSSP" placeholder="请输入微视视频链接" />
									</div>
								</div>
								<div class="hidden" id="WSSP">
									<div class="form-group hidden">
										<div class="input-group">
											<span class="input-group-addon">
												作品ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group hidden">
										<div class="input-group">
											<span class="input-group-addon">
												用户ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" onclick="$(this).parent().parent().addClass('hidden');$(this).parent().parent().prev().children().children('input').val('')">重新获取</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">小红书ID（自动获取）+ 小红书用户ID（自动获取） 自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											小红书链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="XHS" placeholder="请输入小红书（视频|作者）的分享链接" />
									</div>
								</div>
								<div class="hidden" id="XHS">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" onclick="$(this).parent().parent().addClass('hidden');$(this).parent().parent().prev().children().children('input').val('')">重新获取</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">全民K歌ID（自动获取）+ 全民K歌用户ID（自动获取） 自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											K歌链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="QMKG" placeholder="请输入K歌（视频|作者）的分享链接" />
									</div>
								</div>
								<div class="hidden" id="QMKG">
									<div class="form-group hidden">
										<div class="input-group">
											<span class="input-group-addon">
												作品ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group hidden">
										<div class="input-group">
											<span class="input-group-addon">
												用户ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" onclick="$(this).parent().parent().addClass('hidden');$(this).parent().parent().prev().children().children('input').val('')">重新获取</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">微博作品ID（自动获取） 自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											微博链接
										</span>
										<input type="text" class="form-control" value="" @blur="checkInput" act="WB" placeholder="请输入微博链接" />
									</div>
								</div>
								<div class="hidden" id="WB">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												作品ID
											</span>
											<input type="text" class="form-control" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" onclick="$(this).parent().parent().addClass('hidden');$(this).parent().parent().prev().children().children('input').val('')">重新获取</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading">QQ空间说说获取 自动识别</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											ＱＱ号码
										</span>
										<input type="text" class="form-control" value="" ref="qq" placeholder="请输入ＱＱ号码" onkeyup="this.value = this.value.replace(/\D/g , '')"  onkeydown="if(event.keyCode==32){return false;}" maxlength="10"
										/>
									</div>
								</div>
								<div class="hidden" id="QZONE">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">说说列表</div>
											<input class="hide" type="number" value="1" id="shuo_page" disabled/>
											<div class="input-group" style="width: 100%">
												<div class="input-group-addon" @click="getShuo('prev')">
													<i class="fa fa-chevron-left"></i>
												</div>
												<select class="form-control" oninput="$('#ssid').val(event.target.value)">
													<option v-for="(row , index) in shuoList" :key="index" :value="row.tid">{{ row.content }}</option>
												</select>
												<div class="input-group-addon" @click="getShuo('next')">
													<i class="fa fa-chevron-right"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												说说ID
											</span>
											<input type="text" class="form-control" id="ssid" value="" disabled/>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-warning btn-block" onclick="$(this).parent().parent().addClass('hidden');$($(this).parent().parent().children('div')[1]).children().children('input').val('')">重新获取</button>
									</div>
								</div>
								<div class="form-group">
									<button class="btn btn-primary btn-block" @click="getShuo()">获取说说</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script type="text/javascript">
			const DY = {
				SPID : /video\/([0-9]+)/i,
				USERID : /user\/([0-9]+)/,
			};
			const WS = {
				SPID : /feed\/([a-zA-Z0-9]+)/,
				USERID : /personal\/([0-9]+)/
			};
			const KS = {
				SUID : /u\/([0-9a-zA-Z]+)\/([0-9a-zA-Z]+)/
			}
			const QMKG = {
				MUSICID : /node\/play\?s\=([0-9A-Za-z\-]+)/,
				USERID  : /personal\?uid\=([0-9a-zA-Z]+)/
			};
			const XHS = {
				SPID : /item\/([0-9a-zA-Z]+)/,
				USERID : /profile\/([0-9a-zA-Z]+)/
			};
			const WB = {
				wordId : /detail\/([0-9]+)/,
			}
			$(document).ready(function() {
				app = new Vue({
					el : '#vue-app',
					data : {
						shuoList : [],
					},
					methods : {
						checkInput : function(event) {
							var obj = $(event.target),url = $.trim(obj.val()),vm = this
							var ret;
							if (!url) return false;
							switch(obj.attr('act')) {
								case 'DYSP':
									try {
										if (url.indexOf('video/') > -1) {
											if ((ret = DY.SPID.exec(url)) !== null) {
												obj.prev().text('作品ID');
												obj.val(ret[1]);
											}
										} else if (url.indexOf('user/') > -1) {
											if ((ret = DY.USERID.exec(url)) !== null) {
												obj.prev().text('用户ID');
												obj.val(ret[1]);
											}
										} else {
											throw '请输入正确的链接';
										}
									} catch (e) {
										layer.alert(e.toString() , {icon : 2});
									}
								break;
								case 'KSSP':
									if (url.indexOf('u/') > -1 && (ret = KS.SUID.exec(url)) !== null) {
										childAll = $('#KSSP').children().children()
										childAll.each(function (i , v){
											$(childAll[i]).children('input').val(ret[i + 1]);
										});
										$('#KSSP').removeClass('hidden');
									} else {
										var index = layer.load();
										$.post('tools.php' , {url : url , act : 'KSSP'} , function() {
											layer.close(index);
										}).success(function(json) {
											if (json.status) {
												childAll = $('#KSSP').children().children()
												childAll.each(function (i , v){
													$(childAll[i]).children('input').val(json.data[i]);
												});
												$('#KSSP').removeClass('hidden');
											} else {
												layer.alert(json.message , {icon : 5});
											}
										}).error(function(){
											layer.alert('服务器内部错误' , {icon : 2});
										});
									}
								break;
								case 'WSSP':
									try {
										if (url.indexOf('feed/') > -1 && (ret = WS.SPID.exec(url)) !== null) {
											$('#WSSP').removeClass('hidden');
											$($('#WSSP').children('div')[0]).removeClass('hidden').children().children('input').val(ret[1])
											$($('#WSSP').children('div')[1]).addClass('hidden').children().children('input').val('')
										} else if (url.indexOf('personal/') > -1 && ((ret = WS.USERID.exec(url)) !== null)) {
											$('#WSSP').removeClass('hidden');
											$($('#WSSP').children('div')[0]).addClass('hidden').children().children('input').val('')
											$($('#WSSP').children('div')[1]).removeClass('hidden').children().children('input').val(ret[1])
										} else {
											throw '请输入正确的链接';
										}
									} catch (e) {
										layer.alert(e.toString() , {icon : 2});
									}
								break;
								case 'XHS':
									if (url.indexOf('item/') > -1) {
										$(obj.parent().parent().next().children().children().children('span')[0]).text('作品ID')
									} else if (url.indexOf('profile/') > -1) {
										$(obj.parent().parent().next().children().children().children('span')[0]).text('用户ID')
									}
									if (url.indexOf('item/') > -1 && (ret = XHS.SPID.exec(url)) !== null) {
										$('#XHS').removeClass('hidden');
										obj.parent().parent().next().children().children().children('input').val(ret[1]);
									} else if (url.indexOf('profile/') > -1 && (ret = XHS.USERID.exec(url)) !== null) {
										$('#XHS').removeClass('hidden');
										obj.parent().parent().next().children().children().children('input').val(ret[1]);
									} else {
										var index = layer.load();
										$.post('tools.php' , {url : url , act : 'XHS'} , function() {
											layer.close(index);
										}).success(function(json) {
											if (json.status) {
												$('#XHS').removeClass('hidden');
												$(obj.parent().parent().next().children().children().children('span')[0]).text('作品ID')
												obj.parent().parent().next().children().children().children('input').val(json.ret)
											} else {
												layer.alert(json.message , {icon : 5})
											}
										}).error(function(){
											layer.alert('服务器内部错误' , {icon : 2});
										});
									}
								break;
								case 'QMKG':
									try {
										if (url.indexOf('play?s=') > -1 && (ret = QMKG.MUSICID.exec(url)) !== null) {
											$('#QMKG').removeClass('hidden');
											$($('#QMKG').children('div')[0]).removeClass('hidden').children().children('input').val(ret[1])
											$($('#QMKG').children('div')[1]).addClass('hidden').children().children('input').val('')
										} else if (url.indexOf('personal?uid=') > -1 && ((ret = QMKG.USERID.exec(url)) !== null)) {
											$('#QMKG').removeClass('hidden');
											$($('#QMKG').children('div')[0]).addClass('hidden').children().children('input').val('')
											$($('#QMKG').children('div')[1]).removeClass('hidden').children().children('input').val(ret[1])
										} else {
											throw ('请输入正确的链接');
											return false;
										}
									} catch (e) {
										layer.alert(e.toString() , {icon : 2});
									}
								break;
								case 'WB':
									try {
										if (url.indexOf('detail') > -1 && (ret = WB.wordId.exec(url)) !== null) {
											obj.parent().parent().next().children().children().children('input').val(ret[1]);
											$('#WB').removeClass('hidden');
										} else {
											throw ('请输入正确的链接');
											return false;
										}
									} catch (e) {
										layer.alert(e.toString() , {icon : 2});
									}
								break;
							}
						},
						getShuo : function(to) {
							var vm = this;
							var qq = vm.$refs['qq'].value;
							var page = parseInt($('#shuo_page').val()) || 1;
							if (to === 'prev') {
								page--;
							} else if (to === 'next') {
								page++;
							} else {
								page = 1;
							}
							$('#shuo_page').val(page);
							try {
								if (/(^[1-9]{1})([0-9]{4})[0-9]{0,5}$/.exec(qq) !== null) {
									var index = layer.load(0);
									jQuery.post('tools.php' , {act : 'shuoshuo' , page : page , qq : qq} , function() {
										layer.close(index);
									} , 'JSON').success(function(data) {
										if (data.status) {
											vm.shuoList = data.data;
											$('#QZONE').removeClass('hidden');
										} else {
											$('#QZONE').addClass('hidden');
											layer.alert(data.message , {icon : 2});
										}
									}).error(function() {
										layer.alert('服务器内部错误' , {icon : 2});
									});
								} else {
									$('#QZONE').addClass('hidden');
									layer.alert('请输入正确的QQ号码' , {icon : 2});
								}
							} catch (e) {
								layer.alert(e.toString() , {icon : 2});
							}
						}
					}
				})
			});
		</script>
	</body>
</html>