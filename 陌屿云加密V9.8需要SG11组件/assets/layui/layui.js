/*后台卡密*/
$("#km").click(function(){
	var count=$("input[name='count']").val();
	var money=$("input[name='money']").val();
	if(!count || !money){
        layer.msg('卡密输入不能为空！', function(){ });
		return false;
		}
});
/*加密注释*/
$("#wd").click(function(){
	var zhushi=$("input[name='zhushi']").val();
	if(!zhushi){
		layer.msg('注释输入不能为空哟 ！', function(){ });
		return false;
	}
});
/*代理界面卡密*/
$("#kms").click(function(){
	var km=$("input[name='km']").val();
	if(!km){
		layer.msg('卡密输入不能为空 ！',{icon:5});
		return false;
	}
});
/*代理退出登入*/
function logout(){
layer.confirm('主人别离开我~>_<~',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
		var ii = layer.load(3, {shade:[0.1,'#fff']});
		$.ajax({
			type : "get",
			url : "ajax.php?act=login&logout",
			dataType : 'json',
			success : function(data){
			layer.close(ii);
			if(data.code == 0){
			layer.msg(data.msg,{icon:1,time:2000,end:function(){window.location.href="./login.php"}});
				}
			}
		});
	},function(){});
};
/*在线充值*/
function dopay(type){
	var value=$("input[name='value']").val();
	if(value=='' || value==0){
	layer.msg('充值金额不能为空');
	return false;
	}else if(value[0]=='.'){
		layer.msg("金额不能以点开头，请重新填写！");
		return false;
	}
	$.get("ajax.php?act=recharge&type="+type+"&value="+value, function(data) {
		if(data.code == 0){
			window.location.href='../other/submit.php?type='+type+'&orderid='+data.trade_no;
		}else{
			layer.alert(data.msg);
		}
	}, 'json');
}
$("#buy_alipay").click(function(){
	dopay('alipay')
});
$("#buy_qqpay").click(function(){
	dopay('qqpay')
});
$("#buy_wxpay").click(function(){
	dopay('wxpay')
});
$("#buy_tenpay").click(function(){
	dopay('tenpay')
});
/*代理登陆*/
$("#MYlogin").click(function(){
	var user=$("input[name='user']").val();
	var pass=$("input[name='pass']").val();
	var geetest_challenge=$("input[name='geetest_challenge']").val();
	var geetest_validate=$("input[name='geetest_validate']").val();
	var geetest_seccode=$("input[name='geetest_seccode']").val();
	if(!user || !pass){
		layer.msg('账号或密码不能为空哟！', function(){ });
		return false;
	}
	load=layer.load(0);
	$.ajax({
		type:"post",
		url:"ajax.php?act=login",
		data : {"user":user,"pass":pass,"geetest_challenge":geetest_challenge,"geetest_validate":geetest_validate,"geetest_seccode":geetest_seccode},
		dataType:"json",
		success:function(data){
			layer.close(load);
			if(data.code==0){
				layer.msg(data.msg);
				$.ajax({
					type:"get",
					url:"index.php",
					dataType:"html",
					success:function(html){
						window.location.href="./index.php";
					}
				});
			}else{
				layer.msg(data.msg);
			}
		}
	});
});
function reg(){//商户注册 
     var user= $("#user").val();
     var pass= $("#pass").val();
     var pass_confirm= $("#pass_confirm").val();
     var qq= $("#qq").val();
	var geetest_challenge=$("input[name='geetest_challenge']").val();
	var geetest_validate=$("input[name='geetest_validate']").val();
	var geetest_seccode=$("input[name='geetest_seccode']").val();
		  	var ii = layer.load(3, {shade:[0.1,'#fff']});
		  	$.ajax({
				type : "POST",
				url : "ajax.php?act=reg",
				data : {"user":user,"pass":pass,"pass_confirm":pass_confirm,"qq":qq,"geetest_challenge":geetest_challenge,"geetest_validate":geetest_validate,"geetest_seccode":geetest_seccode},
				dataType : 'json',
				timeout:10000,
				success : function(data) {					  
					  layer.close(ii);
					  layer.msg(data.msg);
					  if(data.code==1){
						setTimeout(function () {
							location.href="./";
						}, 1000); //延时1秒跳转
					  }
				},
				error:function(data){
					layer.close(ii);
					layer.msg('服务器错误');
					}
			});
}