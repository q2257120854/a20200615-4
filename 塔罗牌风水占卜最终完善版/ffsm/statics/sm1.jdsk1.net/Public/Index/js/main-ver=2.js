$(function(){
    function shuffle(arr) { 
       var i, j, temp; 
       for (i = arr.length - 1; i > 0; i--) { 
            j = Math.floor(Math.random() * (i + 1)); 
            temp = arr[i]; 
            arr[i] = arr[j]; 
            arr[j] = temp; 
            } 
       return arr; 
    };
    Date.prototype.Format = function (fmt) { //author: meizz 
            var o = {
                "M+": this.getMonth() + 1, //月份 
                "d+": this.getDate(), //日 
                "h+": this.getHours(), //小时 
                "m+": this.getMinutes(), //分 
                "s+": this.getSeconds(), //秒 
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
                "S": this.getMilliseconds() //毫秒 
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        }
    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time =   hour + ':' + (min<10?"0"+min:min)   ;
        return time;
    }
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }
    var str=[
        '比我们这里的测算先生厉害，算得准，也有很好的开运建议。',
        '还不错，婚姻方面算的很好，推荐的择偶标准也是我想要的。',
        '事业方面实在是分析得太好了，悬着适合自己的工作很重要。',
        '婚姻方面真的准！提供很好的相处建议，对未来的婚姻有信心！',
        '感情内容非常准，希望17年能像大师所说的那样组建幸福家庭！',
        '超赞！分析得很好，大师真的超级厉害！',
        '说我的财运好，我在这一方面确实一直有好运！',
        ' 事业分析的很准，一直在纠结要不要自己创业，还是听大师的！',
        '大师分析的好准，非常感谢老师的建议指导。',
        '分析得好准，希望17年真如分析所说那样能当上主管。',
        '本来准备下半年结婚的，大师算我下半年结婚的，准！',
        '分析得很详细，比本地的测算先生还要准。',
        '婚姻和事业建议有帮助，值得一看！',
        '算我事业不太好，最近确实亏了不少钱，希望能有用！',
        '结果内容很好，也有很多建议，相信17年一定会更顺利！',
        '事业和财运算得好准，跳槽发展果然是适合我的好选择！',
        '分析还是很准的，对感情有帮助，明年应该就如大师说的结婚！',
        '感谢老师提供的事业建议，明年努力就能升职了！',
        '一生的情况分析的好准，算我17年就能找到女朋友。开心！',
        '分析得好准，非常感谢老师的建议指导！',
        ];

    var strname=[
        '黄先生 佛山 ',
        '王女士 宁波 ',
        '吴先生 南京 ',
        '郭先生 成都 ',
        '汤女士 沈阳 ',
        '汪女士 台湾 ',
        '黄先生 澳门 ',
        '苏女士 新加坡',
        '李先生 香港 ',
        '吴先生 广州 ',
        '李先生 湛江 ',
        '黄先生 广西 ',
        '胡先生 上海 ',
        '李先生 北京 ',
        '余先生 苏州 ',
        '刘女士 天津 ',
        '郭女士 重庆 ',
        '孟先生 杭州 ',
        '王先生 无锡 ',
        '亓女士 青岛 ',
        ];

    str=shuffle(str);
    strname=shuffle(strname);



    var td=(new Date()).Format("yyyy-MM-dd");
    var date= Math.round(  (+new Date(td) ) /1000 );
    var str2=[];
    for(var i=0;i<str.length;i++){
        date=date+getRandomInt(1000,3000);
        str2.push( '<li>'+" "+ strname[i]+" "+ str[i]+'</li>' );

    }
    $("#coll").html(str2.join(''));

    if($("#pinglun").length>0){
        str=shuffle(str);
        strname=shuffle(strname);
         var str3=[];
        for(var i=0;i<str.length;i++){
            date=date+getRandomInt(1000,3000);
            str3.push( '<li class="swiper-slide"><h4>'+strname[i]+'：</h4><p>'+str[i]+'</p></li>' );

        }
        $("#pinglun").html(str3.join(''));

    }

})
 



$(function(){
    //选项卡
    $('.public_tab li').on('click', function () {
        $(this).addClass('current');
        $('.public_tab_item').eq($(this).index()).show();
        $(this).siblings('li').removeClass('current');
        $('.public_tab_item').eq($(this).index()).siblings('.public_tab_item').hide();
    });
//  for(var i=0,max=$('.Js_date').length;i<max;i++){
//      var calendar1 = new ruiDatepicker().init('#'+$('.Js_date').eq(i).attr('id'));
//  }
    // 性别选择
    var sexCheckbox=$('.sm_form_sex');
    if(sexCheckbox.length){
        sexCheckbox.children('span').on('click', function () {
            $(this).addClass('cur');
            $(this).siblings('span').removeClass('cur');
            var value = $(this).data('value');
            $(this).parent().find('input').val(value);
        });
    }
    //新增页面 新闻滚动
	
	setTimeout(function(){
	
		//alert(1);
		if($('.srcollNew').length){
        var oS = $('.srcollNew');
        var aNewList = oS.find('li'),
            oUl = oS.find('ul');
        var w = 0;
        for(var i=0; i<aNewList.length; i++){
            //console.log(w)
            w+=$(aNewList[i]).width();
        }
        oUl.width(w);
        var t = null;
        var l = oUl.offset().left;
        t = setInterval(function(){
            l++;
            if(l==w){
                l=0;
            }
            oUl.css('left', -l);
        }, 30);
		}


	},1000)

    
});

