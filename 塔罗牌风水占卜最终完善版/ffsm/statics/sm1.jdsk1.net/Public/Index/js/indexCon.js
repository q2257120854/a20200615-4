$(function() {
	var jsonLength = 0;
	if(localStorage['orders'] !== undefined) {
		dataread = JSON.parse(localStorage['orders']);
		for(var item in dataread) {
			jsonLength++;
		}
	}
	var url = "{:U('Home/Index/history')}";
	var html = '<a href="' + url + '"><img style=\'width:100%\' src=\'__IMG__/myorder.png\'></a>';
	if(jsonLength > 0) {
		$('#myorderlist').html(html);
	}
	$("#master a").click(function() {
		$("#master img").addClass('gray');
		$(this).find("img").removeClass('gray');
		master = ($(this).attr('name'));
	})
})
//五角星评分
function myScore(con, val) {
	if(con == '.manyi i'){
		var manyi_1 = '非常满意';
		var manyi_2 = '满意';
		var manyi_3 = '一般';
		var manyi_4 = '不满意';
		var manyi_5 = '非常不满意';
	}else{

		var manyi_1 = '非常准确';
		var manyi_2 = '准确';
		var manyi_3 = '一般';
		var manyi_4 = '不准确';
		var manyi_5 = '非常不准确';
	}
	$(con).each(function(index, element) {
		$(this).on('click', function() {
			var nFen = parseInt(index + 1);
			$(this).addClass('xxSeleNone').prevAll('i').addClass('xxSeleNone');
			$(this).nextAll('i').removeClass('xxSeleNone');
			$(val).val(parseInt(index + 1));
			if(nFen == 1){
	          	$(this).parent('div').siblings('em').html(manyi_5)
	        }else if(nFen == 2){
	          	$(this).parent('div').siblings('em').html(manyi_4)
	        }else if(nFen == 3){
	          	$(this).parent('div').siblings('em').html(manyi_3)
	        }else if(nFen == 4){
	          	$(this).parent('div').siblings('em').html(manyi_2)
	        }else{
	          	$(this).parent('div').siblings('em').html(manyi_1)
	        }
		})

	})
}
myScore('.manyi i', '#m_yi');
myScore('.zhunque i', '#z_que');

function empty() {
	$('.xxBoxBJ i').attr('class', '').siblings('input[type="hidden"]').val('').parent('.xxBoxBJ').siblings('em').html('');
	$('#xxPhoneCon,textarea[name="xxTextCon"]').val('');
}
//  ============ 
//  = 评论打分提交 = 
//  ============ 
$('.xxSubmit').on("click", function() {
	var manyi_star = $('#m_yi').val();
	var zhunque_star = $('#z_que').val();
	var order = '{$order_id}';
	var content = $('textarea[name="xxTextCon"]').val();
	var myPhone = $('#xxPhoneCon').val();
	if(manyi_star == '') {
		layer.msg('请给满意度评分');
	} else if(zhunque_star == '') {
		layer.msg('请给准确度评分')
	} else if(myPhone == '') {
		layer.msg('订单号不能为空');
	} else if(content == '') {
		layer.msg('请针对本次测算结果给出您宝贵的意见！！')
	} else {
		$.ajax({
			url: dafenUrl,
			type: "POST",
			data: {
				order_num: myPhone,
				content: content,
				star: manyi_star,
				star_two: zhunque_star,
				type: 1
			},
			success: function(msg) {
				if(msg.status == 1) {
					layer.msg('评价成功');
					$('textarea[name="xxTextCon"]').val('');
				} else {
					layer.msg(msg.info);
				}
			}
		});
		empty()
	}
})

$("#cs").click(function() {
	if($('#agree').prop('checked') === false) {
		$("#agreebox").addClass('shake');
		next = false;
		clearshake();
		return;
	}
	$("#smname").val($("#smname").val().replace(/[^\u4E00-\u9FA5]/g, ''));

	if($("#smname").val() == '' || $("#smname").val().length > 4) {
		$("#smname").addClass('shake');
		next = false;
		clearshake();
		return layer.msg('请输入姓名');
	}
	if($("#b_input").val() == '') {
		$("#birthday").addClass('shake');
		next = false;
		clearshake();
		return layer.msg('请选择您的生日');
	}
	var xm = $("#smname").val();
	var o = {};
	o.name = xm;
	o.gender = $("#gender").val();
	o.birthday = $("#b_input").val();
	o.xing = xm;
	o.ming = '';
	o.birthtime = $("#hour").val();
	o.birthmin = $("#minutes").val();
	o.phone = "";
	o.ver = $("#ver").val();
	console.log(o);
	var next = true;
	if(!next) {
		clearshake();
		return;
	}
	$(".form_c").submit();
})

function getRandomInt(min, max) {
	min = Math.ceil(min);
	max = Math.floor(max);
	return Math.floor(Math.random() * (max - min)) + min;
}

function clearshake() {
	setTimeout(function() {
		$(".shake").removeClass('shake');
	}, 2000)
}

//测算底部悬浮
(function() {
	var topShow = $(".J_testFixedShow");
	if(topShow.length) {
		var topShow = topShow.offset().top;
		var topNum = $(".J_testFixedTop").length > 0 ? ($(".J_testFixedTop").offset().top - 20) : 200;
		var testBtn = $("#testFixedBtn");
		$(window).scroll(function() {
			var wt = $(window).scrollTop();
			wt > topShow ? (testBtn.fadeIn(), $('.public_footer_servers').css('padding-bottom', '50px')) : (testBtn.fadeOut(), $('.public_footer_servers').css('padding-bottom', '20px'));
		});
		testBtn.add('.J_testScrollTop').on('click', function() {
			$('html,body').scrollTop(topNum)
		})
	}
})()
var formTop = $('.sm_form').eq(0);
var ft = formTop.offset().top;
formTop.css({
	'position': 'relative'
});
var hrefs = '<div style="width: 100%; height: 1px; overflow: hidden;position: absolute; left: 0; top: -0.75rem;" id="ceForm"></div>';
formTop.prepend(hrefs);
var hTop = $('#ceForm').offset().top;
var fiex = '' +
	'<div style=" width: 100%;position: fixed; left: 0; right: 0; bottom: 0; z-index: 99; background-color: rgba(0,0,0,0.5); display:none;" class="fix">' +
	'<a href="javascript:;" style=" background: #d23037;display: block;height: 34px;line-height: 34px;font-size: 18px;color: #fff;border-radius: 5px;-o-border-radius: 5px;-moz-border-radius: 5px;-ms-border-radius: 5px;-webkit-border-radius: 5px;margin:5px 5px;text-align:center">立即测算</a>' +
	'</div>';
var fixDiv = '<div style="width:100%; height:2rem;" class="fixDiv"></div>';
$('body').append(fiex).append(fixDiv);
$(window).scroll(function() {
	var docTop = $(this).scrollTop() - 20;
	if(docTop >= hTop) {
		$('.fixDiv').show();
		$('.fix').show();
	} else {
		$('.fixDiv').hide();
		$('.fix').hide();
	}
});
$('.fix').click(function() {
	var t = $('#ceForm').offset().top;
	$(window).scrollTop(t);
	$('.fixDiv').hide();
	$('.fix').hide();
});
$(function() {
	//首页描点
	var miaodian = $("#miaodian");
	$(".J_back_form").on('click', function() {
		$("body,html").scrollTop(miaodian.offset().top - 50)
	});
})

/*
 * --------------------------------------
 * -			底部资质 js				-
 * --------------------------------------
 */
var isObj={
	'url':'',
	'textarea':'',
	'iphone':'',
	'location':'',
	'order':''
},
	wentiBox=3;//1是支付页，0是结果页;

//提交
function issueInfo(){
	var txt=$('textarea[name="isTxt"]').val(),
		ch=/^[\u4e00-\u9fa5]/,
		phone=$.trim($('#isPhone').val());
	if(txt == "" || !ch.test(txt)){
		return layer.msg('请输入您的问题');
	}else if(phone == '' || !/^1[3,4,5,6,7,8,9][0-9]{9}$/.test(phone)){
		return layer.msg('请输入手机号');
	}else{
		isObj['textarea']=txt;
		isObj['iphone']=phone;
		isObj['url']=window.location.href;
		isObj['location']=wentiBox;
		$.ajax({
			type:"post",
			url:dbzzUrl,
			data:isObj,
			success:function(data){
                layer.msg(data.info);
                $('#isPhone').val('');
			}
		});
		$('.isPopup,.isPopBox').hide();
	}
	
}
//box show
function issueShow(){
	$('.isPopup').show();
	$('.isPopBox').show();
}
function issueHide(){
	$('.isPopup,.isPopBox').hide();
}

