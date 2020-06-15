(function ($) {
    var path = document.scripts[document.scripts.length - 1].src;
    path = path.substring(0, path.lastIndexOf("/js/"));//当前JS文件路径
    function turnplate(selector, options) {
        var turnplate = new Object();
        turnplate.outsideRadius = 192;//大转盘外圆的半径
        turnplate.textRadius = 155;//大转盘奖品位置距离圆心的距离
        turnplate.insideRadius = 68;//大转盘内圆的半径
        turnplate.startAngle = 0;//开始角度
        if (selector == undefined) return;
        $.extend(turnplate, options);

        var id = new Date().getTime() + '' + Math.floor(Math.random() * 10);

        var isRun = false;
        var container = $(selector);
        var prizeList = [];//奖品数组
        var iconList = [];//图标数组 系统内置图标 0 未中奖 1 红包 2 奖品  或者自定义img DOM
        var _iconList = [];
        var click = null;
        //开关锁
        turnplate.lock = function (a) {
            a != undefined && a === true ? isRun = true : isRun = false;
        }
        //绘画转盘
        turnplate.draw = function (prize, icon) {
            prizeList = (typeof(prize) == 'object') ? prize : [];
            iconList = (typeof(icon) == 'object') ? icon : [];
            checkLoad(function () {
                drawRouletteWheel(document.getElementById("canvas_" + id));
            });
            return turnplate;
        };
        //抽奖开始
        turnplate.click = function (fun) {
            click = fun;
        };
        //开始转
        turnplate.start = function (item, fun) {
            //item 中奖奖品数组下标
            var angles = (item + 1) * (360 / prizeList.length) - (360 / (prizeList.length * 2));
            if (270 > angles) {
                angles = 270 - angles;
            } else {
                angles = 360 - angles + 270;
            }
            $("#canvas_" + id).stopRotate();
            $("#canvas_" + id).rotate({
                angle: 0,
                animateTo: angles + 1800,
                duration: 8000,
                callback: function () {
                    container.find(".pointer").attr('src', path + '/images/pointer.png');
                    isRun = !isRun;
                    (typeof (fun) == 'function') && fun(prizeList[item]);
                }
            });
        };

        //初始化
        function init() {
            container.html('<div class="turnplate_box"><canvas id="canvas_' + id + '" width="422px" height="422px"></canvas><img class="pointer" src="' + path + '/images/pointer.png"/></div>');
            container.find(".pointer").click(function () {
                if (isRun)return;
                $(this).attr('src', path + '/images/pointer-run.png');
                isRun = !isRun;
                (typeof (click) == 'function') && click();
            });
            loadStyle("style.css");
            _iconList.losing = turnplate.loadImg(path + '/images/losing.png');
            _iconList.money = turnplate.loadImg(path + '/images/money.png');
            _iconList.award = turnplate.loadImg(path + '/images/award.png');
        }

        //开始绘画转盘
        function drawRouletteWheel(canvas) {
            if (canvas.getContext) {
                //根据奖品个数计算圆周角度
                var arc = Math.PI / (prizeList.length / 2);
                var ctx = canvas.getContext("2d");
                //在给定矩形内清空一个矩形
                ctx.clearRect(0, 0, 422, 422);
                //strokeStyle 属性设置或返回用于笔触的颜色、渐变或模式
                ctx.strokeStyle = "#FFBE04";
                //font 属性设置或返回画布上文本内容的当前字体属性
                ctx.font = '16px Microsoft YaHei';
                for (var i = 0; prizeList.length > i; i++) {
                    var angle = turnplate.startAngle + i * arc;
                    ctx.fillStyle = (i & 1) ? "#FFFFFF" : "#FFF4D6";
                    ctx.beginPath();
                    //arc(x,y,r,起始角,结束角,绘制方向) 方法创建弧/曲线（用于创建圆或部分圆）
                    ctx.arc(211, 211, turnplate.outsideRadius, angle, angle + arc, false);
                    ctx.arc(211, 211, turnplate.insideRadius, angle + arc, angle, true);
                    ctx.stroke();
                    ctx.fill();
                    //锁画布(为了保存之前的画布状态)
                    ctx.save();

                    //----绘制奖品开始----
                    ctx.fillStyle = "#E5302F";
                    var text = prizeList[i];
                    var line_height = 17;
                    //translate方法重新映射画布上的 (0,0) 位置
                    ctx.translate(211 + Math.cos(angle + arc / 2) * turnplate.textRadius, 211 + Math.sin(angle + arc / 2) * turnplate.textRadius);

                    //rotate方法旋转当前的绘图
                    ctx.rotate(angle + arc / 2 + Math.PI / 2);

                    /** 下面代码根据奖品类型、奖品名称长度渲染不同效果，如字体、颜色、图片效果。(具体根据实际情况改变) **/
                    if (text.length > 6) {//奖品名称长度超过一定范围
                        text = text.substring(0, 6) + "||" + text.substring(6);
                        var texts = text.split("||");
                        for (var j = 0; texts.length > j; j++) {
                            ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 2, j * line_height);
                        }
                    } else {
                        //在画布上绘制填色的文本。文本的默认颜色是黑色
                        //measureText()方法返回包含一个对象，该对象包含以像素计的指定字体宽度
                        ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                    }

                    //添加对应图标
                    if (iconList.length > 0 && iconList[i] != undefined) {
                        var img = iconList[i];
                        if (typeof (img) == 'object') {
                            ctx.drawImage(img, -15, 30, 32, 32);
                        } else if (img == 0) {
                            ctx.drawImage(_iconList.losing, -15, 30, 32, 32);
                        } else if (img == 1) {
                            //红包
                            _iconList.money.onload = function () {
                                ctx.save();
                                ctx.drawImage(_iconList.money, -15, 30, 32, 32);
                                ctx.restore();
                            }
                            ctx.drawImage(_iconList.money, -15, 30, 32, 32);
                        } else {
                            //默认奖品
                            ctx.drawImage(_iconList.award, -15, 30, 32, 32);
                        }
                    } else {
                        ctx.drawImage(_iconList.award, -15, 30, 32, 32);
                    }

                    //把当前画布返回（调整）到上一个save()状态之前
                    ctx.restore();
                    //----绘制奖品结束----
                }
            }
        };
        //检测图标加载情况
        function checkLoad(fun) {
            var num = 0;
            var loadNum = 0;

            function check(img) {
                num++;
                if (img.complete) {
                    loadNum++;
                    checkFinish();
                } else {
                    img.onload = function () {
                        loadNum++;
                        checkFinish();
                    };
                    img.onerror = function () {
                        loadNum++;
                        checkFinish();
                    };
                }
            }

            function checkFinish() {
                if (loadNum >= num) {
                    typeof (fun) == 'function' && fun();
                }
            }

            for (var i = 0; iconList.length > i; i++) {
                var img = iconList[i];
                if (typeof (img) == 'object') {
                    check(img);
                }
            }
            check(_iconList.losing);
            check(_iconList.award);
            check(_iconList.money);
        }

        // 动态载入图片
        turnplate.loadImg = function (name) {
            var img = new Image();
            img.src = name;
            return img;
        };
        // 动态加载css文件
        function loadStyle(name) {
            var link = document.createElement("link");
            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = path + '/css/' + name;
            document.getElementsByTagName("head")[0].appendChild(link);
        }

        init();
        return turnplate;
    }

    $.turnplate = turnplate;
})(jQuery);