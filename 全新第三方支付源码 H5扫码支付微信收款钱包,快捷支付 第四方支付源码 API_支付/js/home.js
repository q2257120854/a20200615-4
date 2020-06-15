$(function(){
    
    //第一屏动画视差
    $('#scene').parallax();

    //案例展示--放大预览
    $('.fancybox').fancybox();

    //案例展示切换
    (function () {
        $(".caseTabs a").on("click",function(){
            var index = $(this).index();
            $(this).addClass("active").siblings().removeClass('active');
            $(".caseDisplay div").hide()
            $(".caseDisplay div").eq(index).fadeIn(600).removeClass('inview');
            
            setTimeout(function () {
                //再次开启特效。
                $(".caseDisplay div").eq(index).addClass('inview')
            },200);

            var num = index + 1;
            var tit = ''
            if(num == 1){
                tit='移动聚合支付'
            }else if(num == 2){
                tit='PC聚合支付'
            }else if(num == 3){
                tit='线下扫码支付'
            }

            $("#fancybox-manual-a").attr("href","/demo");
            $("#fancybox-manual-a").attr("title",tit);

        });
    })();

    //案例展示 - 飞入特效

    $('#case').waypoint(function(direction) {
        if(direction == 'down'){
            $(".cscd").addClass("inview");
            $(".cd2").addClass("inview");
        }else if(direction == 'up'){
            $(".cscd").removeClass("inview");
            $(".cd2").removeClass("inview");
        }
    }, { offset: '50%' });

    //融智付-标题
    $('#who_2').waypoint(function(direction) {
        if(direction == 'down'){
            $("#who_2").addClass("inview");
            $("#who_2 .parallax").addClass("inview");
        }else if(direction == 'up'){
            $("#who_2").removeClass("inview");
            $("#who_2 .parallax").removeClass("inview");
        }
    }, { offset: '50%' });

    //多种渠道展现
    $('#channels').waypoint(function(direction) {
        var ele = $('#channels');
        var oH2 = ele.find(".title h2");
        var oP = ele.find(".title p");

        if(direction == 'down'){
            oH2.addClass("inview");
            setTimeout(function () {
                oP.addClass("inview");
            },200)
        }else if(direction == 'up'){
            oH2.removeClass("inview");
            oP.removeClass("inview");
        }
    }, { offset: '70%' });

    $('#channels .media_list').waypoint(function(direction) {
        var ele = $($(this)[0].element);
        if(direction == 'down'){
            ele.addClass("inview");
        }else if(direction == 'up'){
            ele.removeClass("inview");
        }
    }, { offset: '80%' });

    //多种渠道展现-图片摆动
    (function () {
        var timer;
        $('#channels .media_list img').hover(function () {
            var _this = $(this);
            timer = setTimeout(function () {
                _this.addClass("active");
            },200)
        },function () {
            clearTimeout(timer);
            $(this).removeClass("active");
        });
    })();

    //多种支付方式-标题
    $('#solution .page_title').waypoint(function(direction) {
        var ele = $($(this)[0].element);
        var oH4=ele.find("h4");
        var oH5=ele.find("h5");
        if(direction == 'down'){
            oH4.addClass("inview");
            oH5.addClass("inview");
        }else if(direction == 'up'){
            oH4.removeClass("inview");
            oH5.removeClass("inview");
        }
    }, { offset: '70%' });

    //多种支付方式-展现
    $('#solution .solution_more').waypoint(function(direction) {
        var smore = $($(this)[0].element);
        var sbtn  = smore.find(".solution_btn");
        if(direction == 'down'){
            $('.solution_tab li').eq(0).trigger("mouseenter");
            $('.solution_line_l').animate({
                width:'100%'
            },600,function () {
                setTimeout(function () {
                    smore.addClass("inview");
                },600);
                setTimeout(function () {
                    sbtn.addClass("inview");
                },2000);
            })
        }else if(direction == 'up'){
            smore.removeClass("inview");
            sbtn.removeClass("inview");
            setTimeout(function () {
                $('.solution_line_l').animate({
                    width:'0%'
                },1000)
            },200)
        }
    }, { offset: '80%' });

    //多种支付方式-支付方式切换
    (function slTab(){
        $('.solution_tab li').bind('mouseenter',function(){
            var i = $(this).index(),
                v = $('.solution_tab li').eq(i).offset().left+$(this).width()/2 - $('.solution_line b').outerWidth()/2;
            $('.solution_line b').css('left',v);
            $('.solution_ct li').eq(i).addClass('show');
            $('.solution_ct li').each(function(){
                if($(this).index()!=i){
                    $(this).removeClass('show');
                }
            });
        });
    })();

    //接入方式-标题
    var canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        centerX = canvas.width/2,   //Canvas中心点x轴坐标
        centerY = canvas.height/2,  //Canvas中心点y轴坐标
        rad = Math.PI*2/100, //将360度分成100份，那么每一份就是rad度
        speed = 0.1; //加载的快慢

    $('#achievements').waypoint(function(direction) {
        var ele = $($(this)[0].element);
        var oWrap  =ele.find(".wrap");
        var oH4=ele.find("h4");
        var oH5=ele.find("h5");

        if(direction == 'down'){
            oH4.addClass("inview");
            oWrap.addClass("inview");
            //绘制进度条至90%
            var timer = setInterval(function () {
                speed += 0.8;
                if(speed > 90){
                    clearInterval(timer);
                    return false;
                }
                context.clearRect(0, 0, canvas.width, canvas.height);
                blueCircle();
                text(speed);
                whiteCircle(speed);
            },10);

            // $('.achievements_bg').css('transform','translateY('+(40)+'px)');
            // $('.aripple').css('transform','translateY('+(2000-(2000))+'%)');
        }else if(direction == 'up'){
            oH4.removeClass("inview");
            oWrap.removeClass("inview");
            //清除进度条。
            context.clearRect(0, 0, canvas.width, canvas.height);
            speed = 0.1;
        }
    }, { offset: '40%' });

    //绘制白色外圈
    function whiteCircle(n){
        context.save();
        context.strokeStyle = "#fff"; //设置描边样式
        context.lineWidth = 39; //设置线宽
        context.beginPath(); //路径开始
        context.arc(centerX, centerY, 114 , -Math.PI/2, -Math.PI/2 - n*rad, true); //用于绘制圆弧context.arc(x坐标，y坐标，半径，起始角度，终止角度，顺时针/逆时针)
        context.stroke(); //绘制
        context.closePath(); //路径结束
        context.restore();
    }
    //绘制蓝色内圈
    function blueCircle(){
        context.save();
        context.fillStyle="#4EC2EA";
        context.lineWidth=39;
        context.strokeStyle = "#81D5F1";
        context.beginPath();
        context.arc(centerX,centerY,114,0,2*Math.PI,false);//顺时针
        context.fill();
        context.stroke();
        context.restore();
    }
    //百分比文字绘制
    function text(n){
        context.save(); //save和restore可以保证样式属性只运用于该段canvas元素
        context.fillStyle = "#fff"; //设置描边样式
        // context.font = "54px Microsoft Yahei"; //设置字体大小和字体
        context.font = "62px arial"; //设置字体大小和字体
        //绘制字体，并且指定位置
        context.fillText(n.toFixed(0)+"%", centerX-53, centerY+20);
        context.restore();
    }

    //能力展示
    $('#ability').waypoint(function(direction) {
        var ele = $($(this)[0].element);
        var who1_driven=ele.find("#who1_driven");
        var rotate_back=ele.find(".rotate_back");
        if(direction == 'down'){
            who1_driven.addClass("inview");
            rotate_back.addClass("inview");
        }else if(direction == 'up'){
            who1_driven.removeClass("inview");
            rotate_back.removeClass("inview");
        }
    }, { offset: '40%' });

    //能力展示-旋转看4个特点。
    (function () {
         var timer;
        $(".rotate_back").hover(function () {
            var _this = $(this);
            timer =setTimeout(function () {
                _this.addClass('r360')
            },300);

        },function () {
            clearTimeout(timer);
            $(this).removeClass('r360');
        });
    })();

    //合作伙伴-标题
    $('#partner .page_title').waypoint(function(direction) {
        var ele = $($(this)[0].element);
        var oH4=ele.find("h4");
        if(direction == 'down'){
            oH4.addClass("inview");
        }else if(direction == 'up'){
            oH4.removeClass("inview");
        }
    }, { offset: '70%' });

    //合伙伙伴-滑动效果
    (function partner(){
        var l = $('.partner_list ul li').length,i = 0,itv;
        // alert(l)
        $('.partner_list ul').width(l*210);
        $('.partner_next').bind('mouseenter',function(){
            itv = setInterval(function(){
                if(i>-($('.partner_list ul').width() - 840)){
                    i--;
                }else{
                    clearInterval(itv);
                }
                $('.partner_list ul').css('left',i);
            },5);
        }).bind('mouseleave',function(){
            clearInterval(itv);
        });
        $('.partner_prev').bind('mouseenter',function(){
            itv = setInterval(function(){
                if(i<0){
                    i++;
                }else{
                    clearInterval(itv);
                }
                $('.partner_list ul').css('left',i);
            },5);
        }).bind('mouseleave',function(){
            clearInterval(itv);
        });
    })();
});

