function check() {
	$("s");
	var htai = $("#url").val();
	if (htai == "") {
        layer.msg('请填写域名！', function(){ });
		$("s");
		layer.close(index);
	} else {
		 $.post("./ajax.php?act=check_url",
    {
        url:htai
    },
        function(tis){
			if (tis.code == "0") {
                layer.msg('正版授权域名！',{icon:6});
			} else {
                layer.msg('该域名尚未授权！',{icon:5});
				$("s");
			}
			$("s");
		})
	}
}
function dail(){
layer.prompt({
  formType: 3,
  value: '',
  title: '<font color=#5FB878>请输入代理QQ</font>'
}, function(value, index, elem){
  $.post("./ajax.php?act=check_dl",{qq:value},function(data){
  	if(data.code == "1"){
        layer.msg('该QQ不是正版授权商！',{icon:5});
  	}else{
        layer.msg('该是用户正版授权商！',{icon:6});
  	}
  });
  layer.close(index);
});
}

$("#check").click(function(){
	var url=$("input[name='url']").val();
	var qq=$("input[name='qq']").val();
	var authcode=$("input[name='authcode']").val();
	if(!url || !qq || !authcode){
        layer.msg('输入内容不能为空！', function(){ });
		return false;
		}
});

$(function(){ ReadyDashboard.init(); });
setTimeout("document.getElementById('ts').style.display = 'none';", 2000);

function sajmts()
{
window.location.href='/includes/download/download.php?my=hx';
}