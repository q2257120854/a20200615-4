/**
 * Created by Nature on 16/1/22.
 */
var Wrapper = function () {
    var wrapper = document.getElementById("wrapper"),
        carousel = document.getElementById("carousel"),
        imgs = carousel.getElementsByTagName("li");
    var ul = document.createElement("ul");
    ul.id = "index";
    wrapper.appendChild(ul);

    for (var i = 0, ln = imgs.length; i < ln; i++) {
        var li = document.createElement("li");
        ul.appendChild(li);
        imgs[i].index = i;
    }
    var lis = ul.getElementsByTagName("li");
    var speed = 5000,
        timeId = null,
        delay = null;
    YEEPAY.addHandler(carousel, "mouseover", stop);
    YEEPAY.addHandler(carousel, "mouseout", auto);
    for (var i = 0, l = lis.length; i < l; i++) { //控制按钮绑定事件
        lis[i].index = i;
        YEEPAY.addHandler(lis[i], "mouseover", function (event) {
            stop();
            var target = YEEPAY.getTarget(event),
                _index = target.index;
            delay = setTimeout(function () {
                if (!hasClass(target, "cur")) {
                    run(_index);
                }
            }, 200);
        });
        YEEPAY.addHandler(lis[i], "mouseout", function () {
            auto();
            clearTimeout(delay);
        });
    }

    function auto() { //自动轮播
        timeId = setTimeout(function () {
            run();
            timeId = setTimeout(arguments.callee, speed);
        }, speed);
    }

    function stop() { //停止自动轮播
        clearTimeout(timeId);
    }

    function fadeIn(elem) { //渐显
        var i = 0;
        var timeId = setTimeout(function () {
            i += 0.1;
            if (i <= 1) {
                elem.style.opacity = i;
                elem.style.filter = "alpha(opacity=" + i * 100 + ")";
                timeId = setTimeout(arguments.callee, 100);
            } else {
                clearTimeout(timeId);
            }

        }, 0);

    }

    function fadeOut(elem) { //渐隐
        var i = 1;
        var timeId = setTimeout(function () {
            i -= 0.1;
            if (i >= 0) {
                elem.style.opacity = i;
                elem.style.filter = "alpha(opacity=" + i * 100 + ")";
                timeId = setTimeout(arguments.callee, 100);
            } else {
                clearTimeout(timeId);
            }

        }, 0);

    }

    function hasClass(node, selector) { //是否有指定class
        var className = " " + selector + " ";
        if (node.nodeType === 1 && (" " + node.className + " ").replace(/[\n\t\r]g/, " ").indexOf(className) > -1) {
            return true;
        }
        return false;
    }

    function run(index) {
        if (typeof index != "undefined") {
            for (var j = 0, l = lis.length; j < l; j++) {
                YEEPAY.removeClass(lis[j], "cur");
            }
            YEEPAY.addClass(lis[index], "cur");
            for (var i = 0, l = imgs.length; i < l; i++) {
                if(hasClass(imgs[i], "front")){
                    fadeOut(imgs[i]);
                    imgs[i].style.zIndex = -1;
                    YEEPAY.removeClass(imgs[i], "front");
                }
            }
            YEEPAY.addClass(imgs[index], "front");
            fadeIn(imgs[index]);
            imgs[index].style.zIndex = 1;
        } else {
            for (var i = 0, l = imgs.length; i < l; i++) {
                if (hasClass(imgs[i], "front") && imgs[i].index < imgs.length - 1) {
                    fadeOut(imgs[i]);
                    imgs[i].style.zIndex = -1;
                    YEEPAY.removeClass(imgs[i], "front");
                    YEEPAY.addClass(YEEPAY.nextNode(imgs[i]), "front");
                    fadeIn(YEEPAY.nextNode(imgs[i]));
                    YEEPAY.nextNode(imgs[i]).style.zIndex = 1;
                    for (var j = 0, l = lis.length; j < l; j++) {
                        YEEPAY.removeClass(lis[j], "cur");
                    }
                    YEEPAY.addClass(lis[YEEPAY.nextNode(imgs[i]).index], "cur");
                    break;
                } else if (hasClass(imgs[i], "front") && imgs[i].index === imgs.length - 1) {
                    fadeOut(imgs[imgs.length - 1]);
                    imgs[imgs.length - 1].style.zIndex = -1;
                    YEEPAY.removeClass(imgs[imgs.length - 1], "front");
                    YEEPAY.addClass(imgs[0], "front");
                    fadeIn(imgs[0]);
                    imgs[0].style.zIndex = 1;
                    for (var j = 0, l = lis.length; j < l; j++) {
                        YEEPAY.removeClass(lis[j], "cur");
                    }
                    YEEPAY.addClass(lis[0], "cur");
                    break;
                }
            }
        }
    }

    return {
        init: function () { //初始化
            for (var i = 0, l = imgs.length; i < l; i++) {
                if (hasClass(imgs[i], "front")) {
                    imgs[i].style.cssText = "opacity:1; z-index:1; filter:alpha(opacity=100);";
                } else {
                    imgs[i].style.cssText = "opacity:0; z-index:0; filter:alpha(opacity=0);";
                }
            }
            YEEPAY.addClass(lis[0], "cur");
            auto();
        }
    }
}();
Wrapper.init();