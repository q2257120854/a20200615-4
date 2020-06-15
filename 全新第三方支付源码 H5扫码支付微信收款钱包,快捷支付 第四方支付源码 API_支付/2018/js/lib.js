;(function($){//延时hover插件
    $.fn.hoverDelay = function(options){
        var defaults = {
            hoverDuring: 200,
            outDuring: 200,
            hoverEvent: function(){
                $.noop();
            },
            outEvent: function(){
                $.noop();
            }
        };
        var sets = $.extend(defaults,options || {});
        var hoverTimer, outTimer;
        return $(this).each(function(){
            $(this).hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(sets.hoverEvent, sets.hoverDuring);
            },function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(sets.outEvent, sets.outDuring);
            });
        });
    }
})(jQuery);
$.fn.placeholder = function(){
    var i = document.createElement('input'),placeholdersupport ='placeholder' in i;
    if(!placeholdersupport){
        var inputs = $(this);
        inputs.each(function(){
            var input = $(this),
                text = input.attr('placeholder'),
                pdl = 0,height = input.outerHeight(),
                width = input.outerWidth(),
                placeholder = $('<span class="phTips">'+text+'</span>');
                try{
                    pdl = input.css('padding-left').match(/\d*/i)[0] * 1;
                }catch(e){
                    pdl = 5;
                }
                placeholder.css({
                    'margin-left': -(width-pdl),
                    'height':height,
                    'line-height':height+"px",
                    'position':'absolute',
                    'color': "#cecfc9",
                    'font-size' : "12px"
                });
                placeholder.click(function(){
                    input.focus();
                });
                if(input.val() != ""){
                    placeholder.css({display:'none'});
                }else{
                    placeholder.css({display:'inline'});
                }
                placeholder.insertAfter(input);
                input.keydown(function(e){
                    placeholder.css({display:'none'});
                });
                input.blur(function(e){
                	if(input.val() != ""){
                        placeholder.css({display:'none'});
                    }else{
                        placeholder.css({display:'inline'});
                    }
                });
                input.keyup(function(e){
                    if($(this).val() != ""){
                        placeholder.css({display:'none'});
                    }else{
                        placeholder.css({display:'inline'});
                    }
                });
            });
        }
    return this;
};
//以上placeholder兼容性插件
;(function ($) {
    $.fn.extend({
    	titletip:function(){
    		$(this).each(function(){
    			var tip,c=$(this),content=$(this).attr("title");
    			$(this).removeAttr("title");
    			$(this).hoverDelay({
    			    hoverEvent: function(){
    			    	var l=c.offset().left,t=c.offset().top,w=c.width(),h=c.height();
        				tip=$("<div class='title-tip'><b class='ui-arrow ui-arrowup'><em>◆</em><span>◆</span></b>"+content+"</div>").css({"left":l+w/2-47,"top":t+h+12}).appendTo("body");
    			    },
    			    outEvent: function(){
    			    	tip!=null?tip.remove():"";
    			    }
    			});
    		});
    	}
    });
})(jQuery);
//以上title  tip 插件
var ll={};
var ajaxSubmit=false;//防止重复提交
ll.common={
	//js 精确计算浮点数
	accMul:function(arg1,arg2){
			var m=0,s1=arg1.toString(),s2=arg2.toString();
			try{m+=s1.split(".")[1].length;}catch(e){}
			try{m+=s2.split(".")[1].length;}catch(e){}
			return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m);
	},
	accDiv:function(arg1,arg2){
			var t1=0,t2=0,r1,r2;
			try{t1=arg1.toString().split(".")[1].length;}catch(e){}
			try{t2=arg2.toString().split(".")[1].length;}catch(e){}
			with(Math){
				r1=Number(arg1.toString().replace(".",""));
				r2=Number(arg2.toString().replace(".",""));
				return (r1/r2)*pow(10,t2-t1);
			}
	},
	accAdd:function(arg1,arg2){
		var r1,r2,m;
		try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
		try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
		m=Math.pow(10,Math.max(r1,r2))
		return (arg1*m+arg2*m)/m
	},
	accSub:function(arg1,arg2){
	    var r1,r2,m,n;
	    try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
	    try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
	    m=Math.pow(10,Math.max(r1,r2));
	    //last modify by deeka
	    //动态控制精度长度
	    n=(r1>=r2)?r1:r2;
	    return ((arg1*m-arg2*m)/m).toFixed(n);
	},
	slideToggle:function(o,d,t,c){//点击显隐  o，触发对象，d,显隐对象,t:替换文本，c:触发后回调函数
	        o.click(function(){
	            d.toggle();
	            t==null?"":o.text()==t[0]?o.text(t[1]):o.text(t[0]);
	            c==null?"":c();
	        });
	},
    tab:function(h,b,index,callback){//tab切换  h,点击对象  b,切换对象 index:默认选中索引  callback：回调函数
    		if (typeof(index) !== "number") {
				index = 0;
			}
			h.eq(index).addClass("active");
			b.eq(index).addClass("active");
			
	        h.click(function(){
	            if($(this).hasClass("active")) return false;
	            var index=h.parent().find(h).index(this);
	            h.parent().find(h).removeClass("active");
	            $(this).addClass("active");
	            b.removeClass("active");
	            b.eq(index).addClass("active");
	            callback==null?"":callback();
	        });
    },
    radioChoose:function(o,r,c){//单选框选中  o:点击对象   r:单选框   c: callback
        var n=r.attr("name");
        o.click(function(){
            r.prop("checked",true).focusout();//针对表单验证加入focusout();
            c==null?"":c();
        });
        r.click(function(){o.click();});
    },
    picCenter:function(box){
    	box.each(function(){
    		var _this=$(this);
        	var bw=$(this).width();
        	var bh=$(this).height();
        	var src=$(this).find("img").attr("src");
        	var img=new Image();
        	img.onload=function(){
        		if(img.width/bw>img.height/bh){
            		_this.find("img").css({height:bh,width:(img.width*bh/img.height),marginLeft:-((img.width*bh/img.height)-bw)/2});
        		}else{
            		_this.find("img").css({width:bw,height:(img.height*bw/img.width),marginTop:-((img.height*bw/img.width)-bh)/2});
        		}
        	};
        	img.src=src;
    	});
    },
    checkChoose:function(o,r,c,d){//复选选中  o:点击对象   r:复选框   c: 选中回调函数   d:取消选中回调函数
        o.click(function(){
        	if(r.is(":checked")){
                r.prop("checked",false).focusout();//针对表单验证加入focusout();
                d==null?"":d(o);
        	}else{
                r.prop("checked",true).focusout();//针对表单验证加入focusout();
                c==null?"":c(o);
        	}
        });
        r.click(function(){o.click();});
    },
    loadPage:function(uri,params,place,loadtext,callback){//ajax参数，显示位置，加载中文本，回调函数。
        //判断url是否自带参数   2014-06-19 16:08 @author xuwei
    	var random=uri.indexOf("?")>-1?"&m="+Math.random():"?m="+Math.random();
        $.ajax({
            url: uri+random,
            data: params || {},
            dataType: 'html',
            type: "get",
            beforeSend:function(){
                place==null?"":place.html(loadtext||"加载中");
            },
            success: function(data) {
            	//解决页面过期ajax返回过期页面而非html代码段导致排版错乱问题  2014-06-19 16:18  xuwei
            	if(data.indexOf("<html>")>-1){
            		location.href=uri;                //暂时注释
                	return false;
            	};
                place==null?"":place.html(data);
                /*cb_data=data;//全局赋值ajax内容方便调用*/
                callback==null?"":callback(data);
            },
            error: function() {
                place==null?"":place.html("加载出了点问题");
            }
        });
    },
	emailDirect:function(email){//常用邮箱匹配
		var email=email || "null@null.com";
		var hash = {
			'qq.com': 'http://mail.qq.com',
			'gmail.com': 'http://mail.google.com',
			'sina.com': 'http://mail.sina.com.cn',
			'163.com': 'http://mail.163.com',
			'126.com': 'http://mail.126.com',
			'yeah.net': 'http://www.yeah.net/',
			'sohu.com': 'http://mail.sohu.com/',
			'tom.com': 'http://mail.tom.com/',
			'sogou.com': 'http://mail.sogou.com/',
			'139.com': 'http://mail.10086.cn/',
			'hotmail.com': 'http://www.hotmail.com',
			'live.com': 'http://login.live.com/',
			'live.cn': 'http://login.live.cn/',
			'live.com.cn': 'http://login.live.com.cn',
			'189.com': 'http://webmail16.189.cn/webmail/',
			'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
			'yahoo.cn': 'http://mail.cn.yahoo.com/',
			'eyou.com': 'http://www.eyou.com/',
			'21cn.com': 'http://mail.21cn.com/',
			'188.com': 'http://www.188.com/',
			'foxmail.com': 'http://www.foxmail.com',
			'outlook.com': 'http://www.outlook.com'
		}
		var _mail = email.split('@')[1].toLocaleLowerCase();    //获取邮箱域
		for (var j in hash){
			if(j == _mail){
				return hash[_mail];
			}
		}
		return false;
	},
	ajaxForm:function(json){//url  参数   回调函数
		ajaxSubmit=json.load?false:ajaxSubmit;
		if(ajaxSubmit){return;}//防止重复提交表单;
		var random=json.url.indexOf("?")>-1?"&m="+Math.random():"?m="+Math.random();
		var option = {
				type: json.type || 'POST',
				url: json.url+random || "",
				data: json.data || {},
				dataType: json.dataType || "json",
				beforeSend:json.beforeSend || function(){
					ajaxSubmit=true;
					if(json.obj!=null)json.obj.prepend("<i class='loading-ico'></i>").addClass("disabled");
				},
				success:function(data){
					ajaxSubmit=false;
					if(json.obj!=null){json.obj.removeClass("disabled");json.obj.find(".loading-ico").remove()};
					if(data.errorCode=="relogin"){
						window.location.reload();
						return;
					}
					json.success(data);
				},
				error:json.error || function(){
					ajaxSubmit=false;
					if(json.obj!=null){json.obj.removeClass("disabled");json.obj.find(".loading-ico").remove()};
					ll.common.tips("error","网络错误，请稍后再试！",2000);
				}
		};
		!!json.timeout && (option.timeout = json.timeout);
		$.ajax(option);
	},
	tips:function(type,text,timer){//type:normal|error|success|info|load
		var type=type || "normal";
		var text=text || "提示";
		var timer=timer || 3000;
		var m=parseInt(Math.random()*1000000);
		var typetext={'wait':'<i class="wait"></i>','success':'<i class="success"></i>','error':'<i class="error"></i>','info':'<i class="info"></i>'}[type] || "";
		$(".tips-dialog").animate({marginTop:"-=5",opacity:"-=.2"},200);
		var $tip=$("<div>").addClass("tips-dialog").attr("id","tips"+m).html(typetext+text).appendTo("body");
		var oh=$tip.outerHeight(true),ow=$tip.outerWidth(true), s = ll.common.screen();
    	var c = {top:(s.h-oh)/2,left:(s.w -ow)/2 + s.left};
    	$tip.is(":visible")?$tip.animate(c,100):$tip.css(c);
		$tip.fadeIn(200);
		setTimeout(function(){
			$("#tips"+m).fadeOut(200,function(){
				$("#tips"+m).remove();
			});
		},timer);
	},
	loading:{
		show:function(){
			ll.lock.show();
        	$("#loading-tip").size()?$("#loading-tip").show():$("<div id='loading-tip' class='loading-tip loading2'></div>").appendTo("body");
		},
		hide:function(){
			ll.lock.hide();
        	$("#loading-tip").hide();
		}
	},
    MformBeauty:function(obj){//表单美化
		if(obj!=null && obj.is("select")){
			setTimeout(function(){
				obj.each(function(){
					$(this).siblings("span").text($(this).find("option:selected").text());
					$(this).prop("disabled")?$(this).parent("div").addClass("disabled"):$(this).parent("div").removeClass("disabled");
				});
			},10);
			return;
		}
    	$(".x-select").each(function(){
            var _c=$(this);
            //if(_c.is(":hidden") || !_c.is("select")) return;//如果是隐藏的跳过
            _c.wrap('<div class="'+_c.attr("class")+'"></div>').before('<span>'+_c.find("option:selected").text()+'</span>');
            _c.removeAttr("class");
			if(_c.prop("disabled")){_c.parent("div").addClass("disabled");}
            _c.on("change",function(){
                _c.siblings("span").text(_c.find("option:selected").text());
            }).on("focus",function(){
                _c.parent().addClass("focus");
            }).on("blur",function(){
                _c.parent().removeClass("focus");
            });
        });
    	$(".x-file").each(function(){
    		var _c=$(this);
            //if(_c.is(":hidden") || !_c.is("input")) return;//如果是隐藏的跳过
            _c.wrap('<div class="'+_c.attr("class")+'"></div>').before('<span class="x-file-icon"></span><span class="x-file-text"></span><span class="x-file-btn">浏览...</span>');
            _c.removeAttr("class");
    		_c.siblings(".x-file-text").text(_c.val());
    		_c.on("change",function(){
                var _t=$(this).val(),_z="file";
                _c.siblings("i").remove();
                _c.siblings(".x-file-text").text("");
                if(_t==""){
                    return;
                }
                var t1 = _t.lastIndexOf("\\");
                var t2 = _t.lastIndexOf(".");
                if( t1 < t2 && t1 < _t.length){
                    _z =_t.substring(t2+1);
                    _t =_t.substring(t1 + 1);
                }
    			$("<i></i>").insertAfter(_c).addClass("i-"+_z);
    			_c.siblings(".x-file-text").text(_t);
    		}).on("focus",function(){
                _c.parent().addClass("focus");
            }).on("blur",function(){
                _c.parent().removeClass("focus");
            });
    	});
    	if(/msie 8\.0/i.test(navigator.userAgent.toLowerCase())) return;//如果是IE8 不修改单选复选框
        $(".x-radio").each(function(){
    		var _c=$(this);
            //if(_c.is(":hidden") || !_c.is("input")) return;//如果是隐藏的跳过
            _c.wrap('<div class="'+_c.attr("class")+'"></div>').after("<b></b>");
            _c.removeAttr("class");
            _c.parent().on("click",function(){
                _c.prop("checked",true);
                _c.siblings("b").addClass("checked");
                _c.focus();
            });
            _c.on("focus",function(){
                _c.parent().addClass("focus");
            }).on("blur",function(){
                _c.parent().removeClass("focus");
            });
        });
        $(".x-checkbox").each(function(){
    		var _c=$(this);
            //if(_c.is(":hidden") || !_c.is("input")) return;//如果是隐藏的跳过
            _c.wrap('<div class="'+_c.attr("class")+'"></div>').after("<b></b>");
            _c.removeAttr("class");
            _c.parent().on("click",function(){
                if(_c.prop("checked")){
                    _c.prop("checked",false);
                }else{
                    _c.prop("checked",true);
                }
                _c.focus();
            });
            _c.on("focus",function(){
                _c.parent().addClass("focus");
            }).on("blur",function(){
                _c.parent().removeClass("focus");
            });
        });
    },
    parseQuery: function (query) {//地址栏参数解析
 	   var parames = {};
 	   if ( ! query ) {return parames;}// return empty object
 	   var Pairs = query.split(/[;&]/);
 	   for ( var i = 0; i < Pairs.length; i++ ) {
 	      var KeyVal = Pairs[i].split('=');
 	      if ( ! KeyVal || KeyVal.length != 2 ) {continue;}
 	      var key = unescape( KeyVal[0] );
 	      var val = unescape( KeyVal[1] );
 	      val = val.replace(/\+/g, ' ');
 	      parames[key] = val;
 	   }
 	   return parames;
 	},
	screen : function(){
		var s={
		w:$(window).width(),
		h:$(window).height(),
		left:document.documentElement.scrollLeft || document.body.scrollLeft,
		top:document.documentElement.scrollTop || document.body.scrollTop,
		sw:document.documentElement.scrollWidth || document.body.scrollWidth,
		sh:document.documentElement.scrollHeight || document.body.scrollHeight
		};
		return s;
	},
    center:function(o,b){//居中
        var oh=o.outerHeight(true),ow=o.outerWidth(true), s = ll.common.screen();
        if(oh>s.h){
    		var c = {top:s.top+50,left:(s.w -ow)/2 + s.left,marginBottom:50};
        }else{
    		var c = {top:(s.h-oh)/2+s.top,left:(s.w -ow)/2 + s.left};
        };
        o.is(":visible") && !b ?o.animate(c,100): o.css(c);
		return c;
    },
    messageCode:function(o,sec){//点击倒计时，用于验证码再次发送等       o:点击对象  sec:秒数 (默认60)
        if(o.hasClass("disabled")) return;
        var sec=sec || 60;
        var dt=o.text();
		if (o.attr("disabled")){return false;}
        o.text(sec+"秒后重发").addClass("disabled");
		var timer = setInterval(function(){
			sec=sec-1;
			if(sec>0){
				o.text(sec+"秒后重发").addClass("disabled");
			}else{
				clearInterval(timer);
				o.text(dt).removeClass("disabled");
			}
		},1000);
    },
    getCurrentDate : function(){//获取今天日期
    	var objDate=new Date();
    	var year = objDate.getYear();
    	if(year < 1900){year = year + 1900;}
    	var month = objDate.getMonth() + 1;
    	var day = objDate.getDate();
    	month = month>=10?month:'0'+month;day = day>=10?day:'0'+day;
    	var date = year + "-" + month + "-" + day;return date;
    },
    getYesterDate : function(){//获取昨天日期
    	var objDate=new Date();
    	var year = objDate.getYear();
    	if(year < 1900){year = year + 1900;}
    	var month = objDate.getMonth() + 1;
    	var day = objDate.getDate() -1;month = month>=10?month:'0'+month;
    	day = day>=10?day:'0'+day;var date = year + "-" + month + "-" + day;
    	return date;
    },
    datepicker:function(option){//日历控件激活
		var base=Context.base;
		$.getScript(base+"/js/datepicker.js").done(function( script, textStatus ) {
            $(".date-picker").datepicker(option);
		}).fail(function( jqxhr, settings, exception ) {
			alert("加载日历控件失败");
		});
    },
    city:function(province,city,callback){//省市联动
		var base=Context.base;
        var _province=$("#"+province);
        var _provinceValue=_province.data("value")!=null?_province.data("value"):"";
        var _city=$("#"+city);
        var _cityValue=_city.data("value")!=null?_city.data("value"):"";
		$.getScript(base+"/js/city.js").done(function( script, textStatus ) {
            //初始化省市
            _province.empty();
            _city.empty();
            var provinceJson='<option value="">请选择省份</option>';
            var cityJson='<option value="">请选择城市</option>';
            for (var i=0;i<cityJsonData.length;i++){
                provinceJson+='<option data-index="'+i+'" value="'+cityJsonData[i].province+'">'+cityJsonData[i].province+'</option>';
            }
            _province.html(provinceJson);
			_city.html(cityJson);
			ll.common.MformBeauty(_province);
			ll.common.MformBeauty(_city);
            _province.on("change",function(){
                var ind=$(this).find("option:selected").data("index");
                if(ind==null){
                    cityJson='<option value="">请选择城市</option>';
                }else{
    				cityJson="";
                    for (var i=0;i<cityJsonData[ind].cities.length;i++){
                        cityJson+='<option data-code="'+cityJsonData[ind].cities[i].cityId+'" value="'+cityJsonData[ind].cities[i].cityName+'">'+cityJsonData[ind].cities[i].cityName+'</option>';
                    }
                }
                _city.html(cityJson);
				ll.common.MformBeauty(_city);
            });
            if(_provinceValue!=null){
            	_province.find("option[value='"+_provinceValue+"']").prop("selected",true);
				ll.common.MformBeauty(_province);
				_province.change();
                _city.find("option[value='"+_cityValue+"']").prop("selected",true);
				ll.common.MformBeauty(_city);
            }
		}).fail(function( jqxhr, settings, exception ) {
			alert("加载省市联动控件失败");
		});
    },
    date:function(year,month,day,date){//身份证日期联动  date 格式  2015-06-30
        var _year=$("#"+year),_month=$("#"+month),_day=$("#"+day);
        _year.empty();
        _month.empty();
        _day.empty();
        var YearJson='',MonthJson='',DayJson='';
        var nowYear=parseInt(date.split("-")[0]),nowMonth=parseInt(date.split("-")[1]),nowDay=parseInt(date.split("-")[2]);
        for (var i=0;i<=20;i++){YearJson+='<option value="'+(nowYear+i)+'">'+(nowYear+i)+'年</option>';}
        for (var i=0;i<12;i++){
        	var m=(i+1)>=10?(i+1):"0"+(i+1);
        	MonthJson+=nowMonth==(i+1)?'<option selected="selected" value="'+m+'">'+(i+1)+'月</option>':'<option value="'+m+'">'+(i+1)+'月</option>';}
        for (var i=0;i<31;i++){
        	var m=(i+1)>=10?(i+1):"0"+(i+1);
        	DayJson+=nowDay==(i+1)?'<option selected="selected" value="'+m+'">'+(i+1)+'日</option>':'<option value="'+m+'">'+(i+1)+'日</option>';}
        _year.html(YearJson);
        _month.html(MonthJson);
        _day.html(DayJson);
    },
    checkIdcard:function(idcard){ ///////身份证号码验证
		var returnData={status:true};
		var idcard,Y,JYM;
		var S,M;
		var idcard_array = new Array();
		idcard_array = idcard.split("");
		//地区检验
		if(ll.common.IdCardGetArea(idcard)==false){
			returnData={status:false,msg:"请输入正确的身份证号码"};
			return returnData;
		};
		//身份号码位数及格式检验
		switch(idcard.length){
		case 15:
		if ( (parseInt(idcard.substr(6,2))+1900) % 4 == 0 || ((parseInt(idcard.substr(6,2))+1900) % 100 == 0 && (parseInt(idcard.substr(6,2))+1900) % 4 == 0 )){
		ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/;//测试出生日期的合法性
		} else {
		ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/;//测试出生日期的合法性
		}
		if(ereg.test(idcard)){
			returnData={status:true};
			return returnData;
		}else{
			returnData={status:false,msg:"请输入正确的身份证号码"};
			return returnData;
		};
		break;
		case 18:
		//18位身份号码检测
		//出生日期的合法性检查
		if ( parseInt(idcard.substr(6,4)) % 4 == 0 || (parseInt(idcard.substr(6,4)) % 100 == 0 && parseInt(idcard.substr(6,4))%4 == 0 )){
		ereg=/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/;//闰年出生日期的合法性正则表达式
		} else {
		ereg=/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/;//平年出生日期的合法性正则表达式
		}
		if(ereg.test(idcard)){//测试出生日期的合法性
		//计算校验位
		S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7
		+ (parseInt(idcard_array[1]) + parseInt(idcard_array[11])) * 9
		+ (parseInt(idcard_array[2]) +parseInt(idcard_array[12])) * 10
		+ (parseInt(idcard_array[3]) + parseInt(idcard_array[13])) * 5
		+ (parseInt(idcard_array[4]) + parseInt(idcard_array[14])) * 8
		+ (parseInt(idcard_array[5]) + parseInt(idcard_array[15])) * 4
		+ (parseInt(idcard_array[6]) + parseInt(idcard_array[16])) * 2
		+ parseInt(idcard_array[7]) * 1
		+ parseInt(idcard_array[8]) * 6
		+ parseInt(idcard_array[9]) * 3 ;
		Y = S % 11;
		M = "F";
		JYM = "10X98765432";
		M = JYM.substr(Y,1);//判断校验位
		if(M == idcard_array[17]){
			returnData={status:true};
			return returnData;
		}else{
			returnData={status:false,msg:"请输入正确的身份证号码"};
			return returnData;
		};//检测ID的校验位
		}else{
			returnData={status:false,msg:"请输入正确的身份证号码"};
			return returnData;
		}
		break;
		default:
			returnData={status:false,msg:"请输入正确的身份证号码"};
			return returnData;
		break;
		}
		return true;
	},
	IdCardGetArea:function(idcard){ ///////身份证号码地区验证
		var area={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外" };
		var idcard,Y,JYM;
		var S,M;
		var idcard_array = new Array();
		idcard_array = idcard.split("");
		//地区检验
		if(area[parseInt(idcard.substr(0,2))]==null)
		   return false;
		else
		   return area[parseInt(idcard.substr(0,2))];
	},
  isArray:function(o){
      return Object.prototype.toString.call(o)=='[object Array]';
  }
};


//表单验证区块   @author xuwei 2015-06-15
ll.validate={
	reg : {
		userName:/^([a-z|A-Z]+|[ \u4e00-\u9fa5]+|[0-9]+|[_|_]+)+$/,//用户名
		unCN:/^([a-z|A-Z]+|[0-9]+|[_|_]+)+$/,//英文数字特殊字符
		passWord:/^[\@A-Za-z0-9~!@#$%^&*()_+`\-={}:";'<>?,.\/\\]{6,32}$/,//密码
		passWordGruop:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()_+`\-={}:";'<>?,.\/]).{0,10000}$/,//加强密码验证 必须包含特殊符号字母数字
		passWordStrong:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()_+`\-={}:";'<>?,.\/]).{6,32}$/,//加强密码验证 必须包含特殊符号字母数字
		CN:/^[\u4e00-\u9fa5]+$/,//中文
		realName:/^[\u2E80-\uFE4F](?:(•|·|\.|)[\u2E80-\uFE4F])+$/,// 支持中文姓名
		unNull:/^\S+$/,			//非空
		Mobile:/^1[0-9]{10}$/,	//手机
		bankCard:/^\d{15,19}$/, //银行卡
		bankCardCompany:/^\d{8,28}$/, //企业银行卡
		Number :/^[0-9]+$/,
		enNumber :/^[A-Za-z0-9]+$/, //英文数字
        Date:/^\d{4}(\-|\/|.)\d{1,2}\1\d{1,2}$/,
		idCard:/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/, //身份证号码
		Email:/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,//电子邮箱
		isFloat:/^\-?(-?\d*)\.?\d{1,2}$/, //正负保留两位小数
		isFloatPlus:/^(-?\d*)\.?\d{1,2}$/, //保留两位小数
		isFloatPlusThree:/^(-?\d*)\.?\d{1,3}$/,   //保留三位小数
		Price:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/, //  1.非负整数输入，如0、100等	2.两位小数的非负浮点数输入
		PriceThree:/^(([1-9]\d{0,9})|0)(\.\d{1,3})?$/, //  1.非负整数输入，如0、100等	2.三位小数的非负浮点数输入
		verCode:/^\d{6}$/,  //验证码
		Float:/^[0-9]{1,}([.]{1}[0-9]{1,4}){0,1}$/,
		login:/^(([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)|1[0-9]{10})$/
	},
    mark:"validate",
    check:{},//验证列表容器
    results:{},
    showtip:function(type,msg,obj){  //传参 消息类型（exp,error,success）,消息文本,验证对象或者显示位置
        if(obj.is("select,textarea,input") || obj.find("select,textarea,input").size()){
            if(obj.last().next(".x-tip").size()) obj.last().next(".x-tip").remove();
            $("<div>").addClass("x-tip").html("<span class='"+type+"'>"+msg+"</span>").insertAfter(obj.last());
        }else{
            obj.addClass("x-tip").html("<span class='"+type+"'>"+msg+"</span>");
        }
    },
    hidetip:function(obj){
        if(obj.is("select,textarea,input") || obj.find("select,textarea,input").size()){
            obj.last().next(".x-tip").remove();
        }else{
            obj.removeClass(".x-tip").html("");
        }
    },
    init:function(mark,list){//给list中的控件激活验证
        var parames = $.extend({
			type    : null,//默认非空
			reg    	: null,
			empty	: null,
			error	: null,
			hold	: false,
			success	: null,
			byte	: null,
			price	: null,
			place	: null,
			ext		: null,    //附加外部验证
            file    : [],    //文件类型允许上传的文件类型
			ajax	: null//异步判断  null 或者 异步参数   ajax 参数   {url:url,data:data,}
		},list.parames);
		var _self = this;
        var _mark=mark;
        var _input=list.obj.is("div")?list.obj.children("input,textarea,select") : list.obj;//为了兼容文本框美化后class转移到包含的div
		/*var _tip=parames.place==null?list.obj:parames.place;//容器 *///不兼容文本框美化
		var _tip=parames.place==null?list.obj.closest("[class^='x-']").size()?list.obj.closest("[class^='x-']"):list.obj:parames.place;//容器（兼容文本框美化）
        var _type=_input.is("select")?"select":_input.is("textarea")?"text":_input.attr("type");
        var _ident=parseInt(Math.random()*1000000000000);//标识
        if(typeof(_self.results[_mark])=="undefined") _self.results[_mark]={};
        _self.results[_mark][_ident]=false;
		if(_input.is(":hidden") || !_input.size() || !_input.is(":disabled")){_self.results[_mark][_ident]=true;}
        var value=null;
        switch(_type){
            case "checkbox":
            case "radio":
                if(parames.error==null){
                    _self.results[_mark][_ident]=true;
                    return;
                }
                _input.off("blur.validate").on("blur.validate",function(){
                	if(_input.is(":hidden")){
                		_self.results[_mark][_ident]=true;
                        return false;
                	}
                    value=_input.filter(":checked").val();
                    value=typeof(value)=="undefined"?"":value;
                    if(value==""){
                        _self.results[_mark][_ident]=false;
                        _self.showtip("error",parames.error,_tip);
                        return false;
                    }else{
                        _self.results[_mark][_ident]=true;
                        _self.hidetip(_tip);
                    }
        		});
                break;
            case "select":
                if(parames.error==null){
                    _self.results[_mark][_ident]=true;
                    return;
                }
                _input.off("blur.validate").on("blur.validate",function(){
                	if(_input.is(":hidden")){
                		_self.results[_mark][_ident]=true;
                        return false;
                	}
                    value=_input.val();
                    value=typeof(value)=="undefined"?"":value;
                    if(value==""){
                        _self.results[_mark][_ident]=false;
                        _self.showtip("error",parames.error,_tip);
                        return false;
                    }else{
                        _self.results[_mark][_ident]=true;
                        _self.hidetip(_tip);
                    }
        		});
                break;
            case "file":
                _input.off("change.validate blur.validate").on("change.validate blur.validate",function(){
                	if(_input.is(":hidden")){
                		_self.results[_mark][_ident]=true;
                        return false;
                	}
                    value=_input.val();
                    value=typeof(value)=="undefined"?"":value;
                    if(value.length==0 && parames.empty!=null){
                        _self.results[_mark][_ident]=false;
                        _self.showtip("error",parames.empty,_tip);
                        return false;
                    }
                    if(parames.error==null){
                        _self.results[_mark][_ident]=true;
                        return;
                    }
                    var t2 = value.lastIndexOf(".");
                    _z =value.substring(t2+1);
                    for(var i=0; i<parames.file.length; i++){
                        if(parames.file[i].toUpperCase()==_z.toUpperCase()){
                            _self.results[_mark][_ident]=true;
                            _self.hidetip(_tip);
                            return;
                        };
                    }
                    _self.results[_mark][_ident]=false;
                    _self.showtip("error",parames.error,_tip);
                    return false;
        		});
                break;
            default:
                _input.off("focus.validate blur.validate").on("focus.validate",function(){
                	parames.tips!=null?( parames.tips!="" && _self.showtip("exp",parames.tips,_tip) ):_self.hidetip(_tip);
                }).on("blur.validate",function(){
                	if(_input.is(":hidden")){
                		_self.results[_mark][_ident]=true;
                        return false;
                	}
                    //屏蔽非密码输入框前后空格
                	_input.not(":password").val(_input.val().replace(/(^\s*)|(\s*$)/g, ""));
                    value=_input.val();
                    value=typeof(value)=="undefined"?"":value;
                    //非空判断
                    if(parames.empty!=null){
                        if(value.length==0){
                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",parames.empty,_tip);
                            return false;
                        }
                    };
                    //字符长度验证
                    if(parames.byte!=null){
                        var min=parames.byte[0] || 0;
                        var max=parames.byte[1] || 1000;
                        var err=parames.byte[2] || parames.error;
                        if(value.replace(/[^\x00-\xff]/g,"***").length < min || value.replace(/[^\x00-\xff]/g, "***").length > max){
                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",err,_tip);
                            return false;
                        };
                    };
                    //外部函数判断
                    if(parames.ext!=null){
                        var ext=parames.ext(_input);
                        //example return {status:true|false,msg:"验证通过|不通过"}
                        if(!ext.status){
                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",ext.msg,_tip);
                            return false;
                        }
                    };
                    //type 正则验证
                    if(parames.type!=null){
                        var reg=_self.reg[parames.type];
                        if (reg==null) return;
                        if(!reg.test(value)){

                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",parames.error,_tip);
                            return false;
                        }
                        if(parames.type=="idCard"){//身份证验证
                            if(!ll.common.checkIdcard(value.replace(/\s+/g,"").replace("x","X")).status){
                                _self.results[_mark][_ident]=false;
                                _self.showtip("error",ll.common.checkIdcard(value.replace(/\s+/g,"")).msg,_tip);
                                return false;
                            }
                        }
                    };
                    //自定义正则验证
                    if(parames.reg!=null){
                        var reg= parames.reg;
                        if(!reg.test(value)){
                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",parames.error,_tip);
                            return false;
                        }
                    };
                    //金额判断
                    if(parames.price!=null){
                        var min=parames.price[0]*100 || 0;
                        var max=parames.price[1]*100 || 9999999999999999999999999;
                        var err=parames.price[2] || parames.error;
                        if(parseInt(value.replace(/[^0-9.]+/,''))*100< min || (value.replace(/[^0-9.]+/,''))*100 > max){
                            _self.results[_mark][_ident]=false;
                            _self.showtip("error",err,_tip);
                            return false;
                        };
                    };
                    //异步验证
                    if(parames.ajax!=null){
                    	var ajaxStatus=true;
                        var url=parames.ajax.url||"";
                        var data=parames.ajax.data|| {};
                        var zb="";
                        for(var key in data){
                            var value = data[key];
                            zb+=(zb==""?"":"&")+key+"="+value.val();
                        }
                        $.ajax({
                            url: url+"?m=" + Math.random(),
                            async: false,
                            dataType: 'json',
                            type:"POST",
                            data:zb,
                            beforeSend:function(){
                            	!parames.hold && _self.showtip("waiting","",_tip);
                            },
                            success: function(data) {
                                var err=data.retmsg || "验证不通过！";
                                if(data.retcode=="0000"){
                                	!parames.hold && _self.hidetip(_tip);
                                }else{
                                	ajaxStatus=false;
                                    _self.results[_mark][_ident]=false;
                                    _self.showtip("error",err,_tip);
                                    return false;
								}
                                //返回0000 通过
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                            	ajaxStatus=false;
                                _self.results[_mark][_ident]=false;
                                _self.showtip("error","服务器错误!",_tip);
                                return false;
                            }
                        });
                        if(!ajaxStatus) return false;//ajax不通过
                    };
                    parames.success!=null?_self.showtip("success",parames.success,_tip):(!parames.hold && _self.hidetip(_tip));
                    _self.results[_mark][_ident]=true;
                });
                break;
        }
    },
    add:function(option){//添加验证对象数组
        var _option=typeof (option) == "undefined"?{}:option;
        var _self=this;
        var _mark=_option.mark || _self.mark;
        for(var i=0;i<_option.list.length;i++){
            _self.check[_mark].push(_option.list[i]);
        }
        _self.results[_mark]={};//清空数组
        for(var i=0;i<_self.check[_mark].length;i++){
            _self.init(_mark,_self.check[_mark][i]);
        }
    },
    update:function(option){//更新验证对象数组
        var _option=typeof (option) == "undefined"?{}:option;
        var _self=this;
        var _mark=_option.mark || _self.mark;
        _self.check[_mark]=_option.list;
        _self.results[_mark]={};//清空数组
        for(var i=0;i<_self.check[_mark].length;i++){
            _self.init(_mark,_self.check[_mark][i]);
        }
    },
    destroy:function(option){
        var _option=typeof (option) == "undefined"?{}:option;
        var _self=this;
        var _mark=_option.mark || _self.mark;
        delete _self.check[_mark];
    },
	submit:function(option){//接受参数json
        var _option=typeof (option) == "undefined"?{}:option;
        var _self=this;
        var _mark=_option.mark || this.mark;
        _self.check[_mark]=_option.list;
        for(var i=0;i<_self.check[_mark].length;i++){
            _self.init(_mark,_self.check[_mark][i]);
        }
        var sEvent=_option.obj.is("form")?"submit":"click";
        _option.obj.on(sEvent,function(e){
            var status=true;
            for(var i=0;i<_self.check[_mark].length;i++){
                var _input=_self.check[_mark][i].obj.is("div")?_self.check[_mark][i].obj.children("input,textarea,select"):_self.check[_mark][i].obj;//为了兼容文本框美化后class转移到包含的div
                _input.blur();
            }
            for (var j in _self.results[_mark]){
	        	if(_self.results[_mark][j]==false){status=false;}
	        };
	        if (status && typeof (_option.callback) == "function") {
	            _option.callback();
		    } else if (!status){
              return false;
		    }
        });
	}
};


/* 对话框 */
/*自定义提示信息box
	 *@param type    提示框类型alert|confirm
	 *@param head    提示框是否显示
	 *@param title   提示框标题
	 *@param clazz   父元素增加样式类
	 *@param content 提示内容
	 *@param width   提示框宽度
	 *@param move    是否可以拖动true|false
	 *@param lock    是否锁屏true|false
	 *@param scroll  内容超出滚动
	 *@param before  加载之前事件回调
	 *@param load    加载中事件回调
	 *@param enterFunc    回车事件回调
	 *@param destroyFunc 销毁事件回调
	 *@param buttons array[
	 *@value   按钮文字
	 *@handle  当点击处理function]
*/
ll.dialog={
	boxs      : {},
	create   : function(op){
		op = $.extend({
			type    :   'box',
			head    :   'show',
			buttons :   []
		},op);
		if(this.boxs[op.type])return this.boxs[op.type];
		var config=this.boxs[op.type]={};
		var t1 = $('<label></label>');
		var t2 = $('<span></span>');
		var t=$('<div class="ll-dialog-hd"></div>').append(t1).append(t2);
		if(op.head=="hide") {
			t.hide();
		}
		var c = $('<div class="ll-dialog-bd"></div>');

        var o = $('<div class="ll-dialog '+op.clazz+'"></div>').append(t).append(c);
        if(op.buttons.length>0){
			var b = $('<div class="ll-dialog-bt"></div>');
			var buttons = [];
			$(op.buttons).each(function(i,v){
				buttons[i] = $('<input type="button" class="button" value="'+v+'">');
				b.append(buttons[i]);
				b.append(' ');
			});
			o.append(b);
			this.boxs[op.type]['buttons'] = buttons;
		}
		o.css("display","none").appendTo(document.body).focus();
		this.boxs[op.type].obj = $(o);
		this.boxs[op.type].title = t1;
		this.boxs[op.type].content = c;
		this.boxs[op.type].close = t2;
		this.boxs[op.type].option = op;
		return this.boxs[op.type];
	},
	simple : function(op){
		var self = this;
		op = $.extend({
			type    : 'BOX',
			head    : 'show',
			title   : '提示',
      clazz   : '',
			content : '',
			width   : 400,
			move    : false,
			lock    : false,
			scroll  : true,
			before  : $.noop,
			load    : $.noop,
			enterFunc : function(){ll.dialog.close(op.type);	},
			escFunc : function(){ll.dialog.close(op.type);},
      destroyFunc:function(){}
		},op);
		//call before function
		op.before();
		//create base box HTML
		var buttons = [],butFunc = [];
		$(op.buttons).each(function(i,n){
			buttons.push(n.value);
			butFunc.push(n.handle||$.noop);
		});

    var cloneOp = {};
    $.extend(true,cloneOp, op);
    cloneOp.buttons = buttons;
    var o = this.create(cloneOp);

		o.lock = op.lock;
		//update Info
		o.title.html(op.title);
		if(typeof(op.content)=='object'||op.content.indexOf('#')==0)
		{
			op.content=$(op.content);
			o.restore=op.content.clone(true);
			o.content.html(op.content.html());
			op.content.remove();
		}
		else
			o.content.html(op.content);
		o.obj.css('width',op.width);
		if(op.height){
			var mh = op.height - 40;
			if(!op.scroll){
				o.content.css({
					height    : mh,
					overflow  : 'hidden'
				});
			}else{
				o.content.css({
					height    : mh,
					maxHeight : mh+1,
					overflow  : 'auto'
				});
			}
		}
		//bind Event
		o.close.unbind('click');
		o.close.bind({
			click : function(){
				ll.dialog.close(op.type);
			}
		});
		$(o.buttons).each(function(i,n){
			n.unbind('click');
			n.click(function(){butFunc[i](o);});
		});
		if(o.buttons&&o.buttons.length>0){
			$(document.body).unbind('keydown');
			$(document.body).bind('keydown',function(event){
				if(event.keyCode==27){op.escFunc();ll.dialog.close(op.type);}
				if(event.keyCode==13){op.enterFunc();ll.dialog.close(op.type);}
			});
		}

		//align center
        ll.common.center(o.obj);
		if(op.move){if(!ll.draggable)return alert('ll.draggable 插件未加载');ll.draggable(o.obj.find('.ll-dialog-hd'),o.obj);}
		if(op.lock){if(!ll.lock)return alert('ll.lock 插件未加载');ll.lock.show();}
		o.obj.show();
		o.obj.focus();
		//call loaded function
		op.load(o);
	},
	close : function(op){
		var c = 0,op=typeof(op)=='string' ? this.boxs[op] : op;
		for(var k in this.boxs){
			if(this.boxs[k].lock){
				if(this.boxs[k].obj.is(":visible"))
					c++;
			}
		}
		if(op){op.obj.hide();}
		if(c<=1){ll.lock.hide();}
		if(op.restore){op.restore.appendTo(document.body);}
    if (op && op.option) {
      op.option.destroyFunc();
    }
	},
	alert : function(op){
		if(op.buttons){
			$(op.buttons).each(function(i,v){
				if(!v.handle){
					v.handle=function(o){ll.dialog.close(o);}
				}
			});
		}
		if(typeof(op)=='string'){
			this.simple({
				type      : 'alert',
				head      : 'show',
				title     : '提示',
				content   : '<div>'+op+'</div>',
				lock      : true,
				move	  : false,
				enterFunc : op.ok,
				escFunc   : op.ok,
        destroyFunc:op.destroyFunc,
				buttons   : op.buttons || [{
					value    :   '确定',
					handle   :    function(o){
						ll.dialog.close(o);
					}
				}]
			});
		}else{
			this.simple({
				type      : 'alert',
				head      : op.head,
				title     : op.title || '提示',
        content   : op.content,
         clazz    : op.clazz,
				width     : op.width,
				lock      : op.lock||true,
				move	  : op.move|| false,
				load      : op.load,
				enterFunc : op.ok,
				escFunc   : op.ok,
        destroyFunc:op.destroyFunc,
				buttons   : op.buttons || [{
					value    :  '确定',
					handle   :    function(o){
						op.ok&&op.ok(o);
						ll.dialog.close(o);
					}
				}]
			});
		}
	},
	confirm : function(op){
		if(op.buttons){
			$(op.buttons).each(function(i,v){
				if(!v.handle){
					v.handle=function(o){ll.dialog.close(o);}
				}
			});
		}
		this.simple({
			type      : 'confirm',
			head      : op.head,
			title     : op.title || '提示',
            content   : op.content,
			width     : op.width,
			lock      : op.lock||true,
			move	  : op.move|| false,
			load      : op.load,
			enterFunc : op.ok,
			escFunc   : op.cancel,
      destroyFunc:op.destroyFunc,
			buttons   : op.buttons || [{
				value    :   '确定',
				handle   :    function(o){
					op.ok&&op.ok(o);
					ll.dialog.close(o);
				}
			},{
				value    :   '取消',
				handle   :    function(o){
					op.cancel&&op.cancel(o);
					ll.dialog.close(o);
				}
			}]
		});
	}
};

/* 拖动 */
ll.draggable=function(obj,dragObj,box){
	dragObj = dragObj || obj;
	var obj = $(obj);
	var dragObj = $(dragObj);
	if(!dragObj)return;
	obj.css('cursor','move');
	var pos,h=this,o=$(document);
	var oh = dragObj.outerHeight();
	var ow = dragObj.outerWidth();
	obj.mousedown(function(event){
		if(h.setCapture)h.setCapture();
		pos = {
			top  : dragObj.position().top,
			left : dragObj.position().left
		};
		pos = {
			top   :	 event.clientY  - pos.top,
			left  :  event.clientX  - pos.left
		};
		o.mousemove(function(event){
			try{
				if (window.getSelection) {
					window.getSelection().removeAllRanges();
				} else {
					document.selection.empty();
				}
			}catch(e){}
			if(box==null){
				var s = ll.common.screen();
				var maxTop = s.sh;
				var maxLeft = s.sw;
				var top = Math.max(event.clientY-pos.top,0);
				var left = Math.max(event.clientX-pos.left,0);
			}else{
				var s = box;
				maxTop = s.height();
				maxLeft = s.width();
				top = Math.max(event.clientY-pos.top,0);
				left = Math.max(event.clientX-pos.left,0);
			}
			dragObj.css({top:Math.min(top,maxTop-oh),left:Math.min(left,maxLeft-ow)});
		});
		o.mouseup(function(event){
			if(h.releaseCapture)h.releaseCapture();
			o.unbind('mousemove');
			o.unbind('mouseup');
		});
	});
};
/* 锁屏 */
ll.lock={
	source     : null,
	initialize : function(op){
		var s = ll.common.screen();
		op = op || {w : s.sw,h : s.sh,t : 0,l : 0};
		if(!this.o){
			this.o = $(document.createElement("div"));
			this.o.attr('id','ll-mask');
            this.o.css({
					'background' : '#000',
					'top'        :   0,
					'left'       :   0,
					'bottom'     :   0,
					'right'      :   0,
					'position'   : 'fixed',
					'zIndex'     : 2000,
					'opacity'    : 0.5,
					'filter'     : 'Alpha(opacity=50)',
					'display'    : 'none'
			});
			this.o.appendTo(document.body);
			//$(window).resize(function(){if(this.o.isVisible())	{this.show(this.source);}}.bind(this));
		}else{
			this.o.css({
				width      : op.w,
				height     : op.h,
				top	       : op.t,
				left       : op.l
			});
		}
	},
	show : function(obj){
		this.source=obj;
		var op = !obj ? null : {
			w : $(obj).outerWidth(),
			h : $(obj).outerHeight(),
			t : $(obj).position().top,
			l : $(obj).position().left
		};
		this.initialize(op);
		this.o.show();
	},
	hide : function(){
		if(this.o)this.o.hide();
	}
};

/* 浏览器检测 */
ll.browser= {
  ua: function () {
      var u = navigator.userAgent;
      return { //移动终端浏览器版本信息
          trident: u.indexOf('Trident') > -1, //IE内核
          presto: u.indexOf('Presto') > -1, //opera内核
          webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
          gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
          mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
          iOS: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
          android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
          iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
          iPad: u.indexOf('iPad') > -1, //是否iPad
          webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
          weChat: u.indexOf('MicroMessenger') > -1,
          UC: u.indexOf('UCBrowser') > -1,
          u3: u.indexOf('U3') > -1,
          chrome: u.indexOf('Chrome') > -1,
          windowsPhone: u.indexOf("Windows Phone") > -1,
          samsung: u.indexOf("Samsung") > -1,
          QQ: u.indexOf("QQBrowser") > -1,
          llfx: u.indexOf("CBExchange") > -1,
      };
  }()
};

$(function(){
    "use strict";
	//IE8以下浏览器的升级提示
	if (window.navigator.appName == "Microsoft Internet Explorer") {
		if (!document.documentMode || document.documentMode < 8) {
			$("body").prepend('<div class="FUCKIE"><div class="bd"><a href="javascript:;" class="closeFUCKIE">&times;</a>您目前使用的是较低版本IE内核的浏览器，为了最佳的性能体验，建议您&nbsp;<a target="_blank" href="http://browsehappy.com">升级浏览器</a>&nbsp;或使用chrome浏览器。</div></div>');
			$(".closeFUCKIE").click(function(){
				$(".FUCKIE").remove();
			});
		}
	}
	//$('[placeholder]').placeholder({isUseSpan:true});
	$(".titletip").titletip();
	//模拟下拉框
	ll.common.MformBeauty();
	//对话框
	$("body").on("click",".llDialog",function(event){
		event.preventDefault();
		var url=$(this).attr("href");
		var queryString = url.replace(/^[^\?]+\??/,'');
		var parames = ll.common.parseQuery( queryString );
		var d_wid=parames['width']==null?'auto':(parames['width']*1) + 30;
		var d_hei=parames['height']==null?'auto':(parames['height']*1) + 40;
        var d_title=$(this).attr("title");
        ll.lock.show();
        $("#loading-tip").size()?$("#loading-tip").show():$("<div id='loading-tip' class='loading-tip loading2'></div>").appendTo("body");
        ll.common.loadPage(url,{},null,null,function(data){
            $("#loading-tip").remove();
            ll.dialog.simple({
                type    : 'llDialog',
                lock    : true,
                move    : true,
                title   : d_title,
                content : data,
                width   : $(data).width(),
                load	: function(){

                }
            });
        });
	});
	var resizeTimer = null;
    $(window).resize(function(){
    	if(resizeTimer){clearTimeout(resizeTimer)};
    	resizeTimer = setTimeout(function(){$(".ll-dialog").size?ll.common.center($(".ll-dialog")):"";}, 400);
    });

    $("body").on("keydown",function(event){
    	 if (event.keyCode==13 && $(".action-bar").find("a:first").size()){
    		 $(".action-bar").find("a:first").click();
    	 }
    });

});
//验证码
//@param IDs  array 默认“vali”
function refresh(IDs){
  var imgUrl = Context.base + "/captcha.htm?t="+new Date().getTime();
  if(IDs && IDs.length){
    $(IDs).each(function(i,id){
      document.getElementById(id).src=imgUrl;
    });
  }
  else {
    document.getElementById("vali").src=imgUrl;
  }
  //验证码结果
  $(".codeResult").hide();
}

//email autocomplate
function EmailAutoComplete(a){this.config={targetCls:".inputElem",parentCls:".parentCls",hiddenCls:".hiddenCls",searchForm:".jqtransformdone",hoverBg:"hoverBg",inputValColor:"black",mailArr:"@qq.com @163.com @126.com @189.com @sina.com @hotmail.com @gmail.com @sohu.com".split(" "),isSelectHide:!0,callback:null};this.cache={onlyFlag:!0,currentIndex:-1,oldIndex:-1};this.init(a)}EmailAutoComplete.prototype={constructor:EmailAutoComplete,init:function(a){this.config=$.extend(this.config,a||{});var d=this,c=d.config,b=d.cache;$(c.targetCls).each(function(a,f){$(f).keyup(function(a){var e=a.target,h=$.trim($(this).val()),m=a.keyCode,n=$(this).outerHeight(),p=$(this).outerWidth(),q=parseInt($(this).css("margin-top")),g=$(this).closest(c.parentCls);$(g).css({position:"relative"});""==h?($(f).attr({"data-html":""}),$(c.hiddenCls,g).val(""),b.currentIndex=-1,b.oldIndex=-1,$(".auto-tip",g)&&!$(".auto-tip",g).is(":hidden")&&$(".auto-tip",g).hide(),d._removeBg(g)):($(f).attr({"data-html":h}),$(c.hiddenCls,g).val(h),$(".auto-tip",g)&&$(".auto-tip",g).is(":hidden")&&$(".auto-tip",g).show(),d._renderHTML({keycode:m,e:a,target:e,targetVal:h,height:n,width:p,marginTop:q,parentNode:g}))})});$(c.searchForm).each(function(a,b){$(b).keydown(function(a){if(13==a.keyCode)return!1})});$(document).click(function(a){a.stopPropagation();a=a.target;var b=c.targetCls.replace(/^\./,"");$(a).hasClass(b)||$(".auto-tip")&&$(".auto-tip").each(function(a,b){!$(b).is(":hidden")&&$(b).hide()})})},_renderHTML:function(a){var d=this.config,c=this.cache,b,e=this._keyCode(a.keycode);$(".auto-tip",a.parentNode).is(":hidden")&&$(".auto-tip",a.parentNode).show();if(-1<e)this._keyUpAndDown(a.targetVal,a.e,a.parentNode);else{b=/@/.test(a.targetVal)?a.targetVal.replace(/@.*/,""):a.targetVal;if(c.onlyFlag){$(a.parentNode).append('\x3cinput type\x3d"hidden" class\x3d"hiddenCls"/\x3e');for(var e='\x3cul class\x3d"auto-tip"\x3e',f=0;f<d.mailArr.length;f++)e+='\x3cli class\x3d"p-index'+f+'"\x3e\x3cspan class\x3d"output-num"\x3e\x3c/span\x3e\x3cem class\x3d"em" data-html\x3d"'+d.mailArr[f]+'"\x3e'+d.mailArr[f]+"\x3c/em\x3e\x3c/li\x3e";e+="\x3c/ul\x3e";c.onlyFlag=!1;$(a.parentNode).append(e);$(".auto-tip",a.parentNode).css({position:"absolute",top:a.height+a.marginTop,width:a.width-2+"px",left:0,border:"1px solid #ccc","z-index":1E4})}$(".auto-tip li",a.parentNode).each(function(a,c){$(".output-num",c).html(b);!$(".output-num",c).hasClass(d.inputValColor)&&$(".output-num",c).addClass(d.inputValColor);var e=$.trim($(".em",c).attr("data-html"));$(c).attr({"data-html":b+""+e})});this._accurateMate({target:a.target,parentNode:a.parentNode});this._itemHover(a.parentNode);this._executeClick(a.parentNode)}},_accurateMate:function(a){var d=this.config,c=this.cache,b=$.trim($(a.target,a.parentNode).attr("data-html")),e=[];if(/@/.test(b)){var f=b.replace(/@.*/,""),l=b.replace(/.*@/,"");$.map(d.mailArr,function(a){(new RegExp(l)).test(a)&&e.push(a)});if(0<e.length){$(".auto-tip",a.parentNode).html("");$(".auto-tip",a.parentNode)&&$(".auto-tip",a.parentNode).is(":hidden")&&$(".auto-tip",a.parentNode).show();for(var b="",k=0,h=e.length;k<h;k++)b+='\x3cli class\x3d"p-index'+k+'"\x3e\x3cspan class\x3d"output-num"\x3e\x3c/span\x3e\x3cem class\x3d"em" data-html\x3d"'+e[k]+'"\x3e'+e[k]+"\x3c/em\x3e\x3c/li\x3e";$(".auto-tip",a.parentNode).html(b);$(".auto-tip li",a.parentNode).each(function(a,b){$(".output-num",b).html(f);!$(".output-num",b).hasClass(d.inputValColor)&&$(".output-num",b).addClass(d.inputValColor);var c=$.trim($(".em",b).attr("data-html"));$(b).attr("data-html","");$(b).attr({"data-html":f+""+c})});c.currentIndex=-1;c.oldIndex=-1;$(".auto-tip .output-num",a.parentNode).html(f);this._itemHover(a.parentNode);this._executeClick(a.parentNode)}else $(".auto-tip",a.parentNode)&&!$(".auto-tip",a.parentNode).is(":hidden")&&$(".auto-tip",a.parentNode).hide(),$(".auto-tip",a.parentNode).html("")}},_itemHover:function(a){var d=this.config;$(".auto-tip li",a).hover(function(a,b){!$(this).hasClass(d.hoverBg)&&$(this).addClass(d.hoverBg)},function(){$(this).hasClass(d.hoverBg)&&$(this).removeClass(d.hoverBg)})},_removeBg:function(a){var d=this.config;$(".auto-tip li",a).each(function(a,b){$(b).hasClass(d.hoverBg)&&$(b).removeClass(d.hoverBg)})},_keyUpAndDown:function(a,d,c){var b=this.cache;a=this.config;if($(".auto-tip li",c)&&0<$(".auto-tip li").length){var e=$(".auto-tip li",c).length;d=d.keyCode;b.oldIndex=b.currentIndex;38==d?(-1==b.currentIndex?b.currentIndex=e-1:(--b.currentIndex,0>b.currentIndex&&(b.currentIndex=e-1)),-1!==b.currentIndex&&(!$(".auto-tip .p-index"+b.currentIndex,c).hasClass(a.hoverBg)&&$(".auto-tip .p-index"+b.currentIndex,c).addClass(a.hoverBg).siblings().removeClass(a.hoverBg),b=$(".auto-tip .p-index"+b.currentIndex,c).attr("data-html"),$(a.targetCls,c).val(b),$(a.hiddenCls,c).val(b))):40==d?(b.currentIndex==e-1?b.currentIndex=0:(b.currentIndex++,b.currentIndex>e-1&&(b.currentIndex=0)),-1!==b.currentIndex&&(!$(".auto-tip .p-index"+b.currentIndex,c).hasClass(a.hoverBg)&&$(".auto-tip .p-index"+b.currentIndex,c).addClass(a.hoverBg).siblings().removeClass(a.hoverBg),b=$(".auto-tip .p-index"+b.currentIndex,c).attr("data-html"),$(a.targetCls,c).val(b),$(a.hiddenCls,c).val(b))):13==d&&(d=$(".auto-tip .p-index"+b.oldIndex,c).attr("data-html"),$(a.targetCls,c).val(d),$(a.hiddenCls,c).val(d),a.isSelectHide&&!$(".auto-tip",c).is(":hidden")&&$(".auto-tip",c).hide(),a.callback&&$.isFunction(a.callback)&&a.callback(),b.currentIndex=-1,b.oldIndex=-1)}},_keyCode:function(a){for(var d="17 18 38 40 37 39 33 34 35 46 36 13 45 44 145 19 20 9".split(" "),c=0,b=d.length;c<b;c++)if(a==d[c])return c;return-1},_executeClick:function(a){var d=this.config;$(".auto-tip li",a).unbind("mousedown");$(".auto-tip li",a).bind("mousedown",function(c){c=$(this).attr("data-html");$(d.targetCls,a).val(c);d.isSelectHide&&!$(".auto-tip",a).is(":hidden")&&$(".auto-tip",a).hide();$(d.hiddenCls,a).val(c);d.callback&&$.isFunction(d.callback)&&d.callback()})}};
