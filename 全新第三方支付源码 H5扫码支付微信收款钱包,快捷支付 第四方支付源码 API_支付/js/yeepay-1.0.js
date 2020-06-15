/*
 此库做为易宝基本库，其后所有常用插件开发都基于此库，此库包含“YEEPAY”对象，在以后开发插件时不要再次声明该对象。
 开发日期：2012.11.30
 开发人：xiaying
 */
var YEEPAY = {
    addHandler       : function (element, type, handler) { //绑定事件
        if (element.addEventListener) {
            element.addEventListener(type, handler, false);
        } else if (element.attachEvent) {
            element.attachEvent("on" + type, handler);
        } else {
            element["on" + type] = handler;
        }
    },
    getEvent         : function (event) { //返回event对象
        return event ? event : window.event;
    },
    getTarget        : function (event) {
        return event.target || event.srcElement;
    },
    preventDefault   : function (event) { //取消默认行为
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    },
    stopPropagation  : function (event) { //取消冒泡
        if (event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }
    },
    removeHandler    : function (element, type, handler) { //删除事件
        if (element.removeEventListener) {
            element.removeEventListener(type, handler, false);
        } else if (element.detachEvent) {
            element.detachEvent("on" + type, handler);
        } else {
            element["on" + type] = null;
        }
    },
    browser          : function () { //判断浏览器
        var ua = navigator.userAgent.toLocaleLowerCase();
        if (ua.indexOf("msie") > -1) {
            return "ie";
        } else if (ua.indexOf("firefox") > -1) {
            return "firefox";
        } else if (ua.indexOf("chrome") > -1) {
            return "chrome";
        } else if (ua.indexOf("safari") > -1) {
            return "safari";
        } else if (ua.indexOf("opera") > -1) {
            return "opera";
        } else if (ua.indexOf("webkit") > -1) {
            return "webkit"
        }
    },
    enable           : function () { //可拖动
        var dragging = null,
            diffX = 0,
            diffY = 0;
        var that = this;

        function handler(event) { //拖动手柄
            event = that.getEvent(event);
            var target = that.getTarget(event);
            switch (event.type) {
                case "mousedown":
                    if (target.className.indexOf("drag") > -1) {
                        dragging = target;
                        diffX = event.clientX - target.offsetLeft;
                        diffY = event.clientY - target.offsetTop;
                    }
                    break;
                case "mousemove":
                    if (dragging !== null) {
                        dragging.style.left = (event.clientX - diffX) + "px";
                        if (parseInt(dragging.style.left) <= 0) { //只能在可视窗口内拖动，防止出现滚动条
                            dragging.style.left = "0px";
                        } else if (parseInt(dragging.style.left) >= (document.documentElement.clientWidth - dragging.offsetWidth)) {
                            dragging.style.left = document.documentElement.clientWidth - dragging.offsetWidth + "px";
                        }
                        ;
                        dragging.style.top = (event.clientY - diffY) + "px";
                        if (parseInt(dragging.style.top) <= 0) {
                            dragging.style.top = "0px";
                        } else if (that.browser() == "safari" || that.browser() == "chrome") {
                            if (parseInt(dragging.style.top) >= ((document.documentElement.clientHeight - dragging.offsetHeight) + document.body.scrollTop)) {
                                dragging.style.top = (document.documentElement.clientHeight - dragging.offsetHeight) + document.body.scrollTop + "px";
                            }
                        } else {
                            if (parseInt(dragging.style.top) >= ((document.documentElement.clientHeight - dragging.offsetHeight) + document.documentElement.scrollTop)) {
                                dragging.style.top = (document.documentElement.clientHeight - dragging.offsetHeight) + document.documentElement.scrollTop + "px";
                            }
                        }
                    }
                    ;
                    break;
                case "mouseup":
                    dragging = null;
                    break;
            }
        };
        this.addHandler(document, "mousedown", handler);
        this.addHandler(document, "mousemove", handler);
        this.addHandler(document, "mouseup", handler);
    },
    getViewport      : function () {
        if (document.compatMode == "BackCompat") {
            return {
                width : document.body.clientWidth,
                height: document.body.clientHeight
            }
        } else {
            return {
                width : document.documentElement.clientWidth,
                height: document.documentElement.clientHeight
            }
        }
    },
    popping          : function (id, boolean) { //弹出层
        try {
            var pop_obj = document.getElementById(id);
            pop_obj.style.display = "block";
            var pop_obj_h = pop_obj.offsetHeight,
                pop_obj_w = pop_obj.offsetWidth;
            if (boolean) { //设置遮罩
                mask = document.createElement("div");
                mask.id = "mask";
                mask.style.position = "fixed";
                mask.style.top = 0 + "px";
                mask.style.left = 0 + "px";
                mask.style.height = this.getViewport().height + "px";
                mask.style.width = this.getViewport().width + "px";
                document.body.appendChild(mask);
                var that = this;
                //this.addHandler(mask,"click",function(){that.closed(id)});
                if (!window.XMLHttpRequest) {
                    iframe = document.createElement("iframe");
                    iframe.id = "iframeMask";
                    iframe.className = "frame_mask";
                    mask.style.position = "absolute";
                    iframe.style.position = "absolute";
                    iframe.style.top = document.documentElement.scrollTop + "px";
                    mask.style.top = document.documentElement.scrollTop + "px";
                    iframe.style.left = 0 + "px";
                    iframe.style.height = this.getViewport().height + "px";
                    iframe.style.width = this.getViewport().width + "px";
                    iframe.setAttribute("frameborder", 0);
                    document.body.appendChild(iframe);
                    this.addHandler(window, "scroll", function () {
                        mask.style.top = document.documentElement.scrollTop + "px";
                        iframe.style.top = document.documentElement.scrollTop + "px";
                    });
                }
            }
            ;
            var that = this;

            function init() { //弹出初始化位置
                if (document.documentElement.clientHeight - pop_obj_h > 0 && document.documentElement.clientWidth - pop_obj_w > 0) {
                    pop_obj.style.left = (document.documentElement.clientWidth - pop_obj_w) / 2 + "px";
                    if (that.browser() == 'chrome' || that.browser() == 'safari') {
                        pop_obj.style.top = ((document.documentElement.clientHeight - pop_obj_h) / 2) + document.body.scrollTop + "px";
                    } else {
                        pop_obj.style.top = ((document.documentElement.clientHeight - pop_obj_h) / 2) + document.documentElement.scrollTop + "px";
                    }
                    ;
                } else {
                    pop_obj.style.left = (document.documentElement.clientWidth - pop_obj_w) / 2 + "px";
                    if (that.browser() == 'chrome' || that.browser() == 'safari') {
                        pop_obj.style.top = document.body.scrollTop + 20 + "px";
                    } else {
                        pop_obj.style.top = document.documentElement.scrollTop + 20 + "px";
                    }
                }

            }

            init();
            this.addHandler(window, "resize", function () {
                init();
            });
        } catch (e) {
            ///
        }
    },
    closed           : function (id) { //关闭弹出层
        tar = document.getElementById(id);
        tar.style.display = "none";
        if (typeof mask !== 'undefined') {
            document.body.removeChild(document.getElementById("mask"));
        }
        if (typeof iframe !== 'undefined') {
            document.body.removeChild(document.getElementById("iframeMask"));
        }
    },
    nextNode         : function (id) { //获取下一个节点
        var nod = document.getElementById(id) || id;
        if (nod.nextSibling.nodeType == 1) {
            return nod.nextSibling;
        } else {
            return nod.nextSibling.nextSibling;
        }
    },
    get              : function (node) {//获取DOM元素
        noed = typeof node == "string" ? document.getElementById(node) : node;
        return node;
    },
    getElementByClass: function (str, root, tag) { //第一个必选的class名，第二个参数是可选的父容器，缺省为body，第三个为DOM节点名
        if (root) {
            root = typeof root == "string" ? document.getElementById(root) : root;
        } else {
            root = document.body;
        }
        tag = tag || "*";
        var els = root.getElementsByTagName(tag),
            arr = [];
        for (var i = 0, n = els.length; i < n; i++) {
            for (var j = 0, k = els[i].className.split(" "), l = k.length; j < l; j++) {
                if (k[j] == str) {
                    arr.push(els[i]);
                    break;
                }
            }
        }
        return arr;
    },
    addClass         : function (node, str) {//添加class
        if (!new RegExp("(^|\\s+)" + str).test(node.className)) {
            node.className = node.className + " " + str;
        }
    },
    removeClass      : function (node, str) {//删除class
        node.className = node.className.replace(new RegExp("(^|\\s+)" + str), "");
    },
    hasClass         : function (node, selector) { //是否有指定class
        var className = " " + selector + " ";
        if (node.nodeType === 1 && (" " + node.className + " ").replace(/[\n\t\r]g/, " ").indexOf(className) > -1) {
            return true;
        }
        return false;
    },

    getText: function (element) { //返回内部文本
        if (typeof element == "object") {
            return text = element.textContent ? element.textContent : element.innerText;
        } else {
            if (typeof element == "string") {
                var element = document.getElementById(element);
                return text = element.textContent ? element.textContent : element.innerText;
            }
        }
    },
    setText: function (element, string) { //设置内部文本
        if (typeof element == "object") {
            if (typeof element.textContent == "string") {
                element.textContent = string;
            } else {
                element.innerText = string;
            }
        } else {
            if (typeof element == "string") {
                var element = document.getElementById(element);
                if (typeof element.textContent == "string") {
                    element.textContent = string;
                } else {
                    element.innerText = string;
                }
            }
        }
    }
};

function createXHR() { //创建XHR对象方法
    if (typeof XMLHttpRequest != "undefined") {
        createXHR = function () {
            return new XMLHttpRequest();
        };
    } else if (typeof ActiveXObject != "undefined") {
        createXHR = function () {
            var versions = ["MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp"];
            for (var i = 0,
                     len = versions.length; i < len; i++) {
                try {
                    var xhr = new ActiveXObject(versions[i]);
                    return xhr;
                } catch (e) {
                    //跳过
                }
            }
        };
    } else {
        createXHR = function () {
            throw new Error("XHR对象不可用！");
        }
    }
    return createXHR();
};
Array.prototype.unique = function () { //去除数组重复元素
    var ret = [];
    var o = {};
    var len = this.length;
    for (var i = 0; i < len; i++) {
        var v = this[i];
        if (!o[v]) {
            o[v] = 1;
            ret.push(v);
        }
    }
    return ret;
};

function addURLParam(url, name, value) { //URL编码
    url += (url.indexOf("?") == -1 ? "?" : "&");
    url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
    return url;
}

function getUrlData(name) { //返回指定的url参数值,name为key名称
    var newStr = document.location.search.slice(1);
    var array = newStr.split("&");
    var obj = {};
    for (var i = 0; i < array.length; i++) {
        var arr = array[i].split("=");
        var value = arr[0];
        if (!obj.hasOwnProperty(value)) {
            if (arr[1]) {
                obj[value] = arr[1];
            } else {
                obj[value] = null;
            }
        }
    }
    return obj[name];
}

function trim(str) { //去除字符串两边空白
    return str.replace(/^\s+|\s+$/g, "");
}

var Cookie = { //cookie对象
    //读取
    read: function (name) {
        var cookieStr = "; " + document.cookie + "; ";
        var index = cookieStr.indexOf("; " + name + "=");
        if (index != -1) {
            var s = cookieStr.substring(index + name.length + 3, cookieStr.length);
            return decodeURIComponent(s.substring(0, s.indexOf("; ")));
        } else {
            return null;
        }
    },
    //设置
    set : function (name, value, expires) {
        var expDays = expires * 24 * 60 * 60 * 1000;
        var expDate = new Date();
        expDate.setTime(expDate.getTime() + expDays);
        var expString = expires ? "; expires=" + expDate.toGMTString() : "";
        var pathString = ";path=/";
        document.cookie = name + "=" + encodeURIComponent(value) + expString + pathString;
    },
    //删除
    del : function (name) {
        var exp = new Date(new Date() - 1);
        var s = this.read(name);
        if (s != null) {
            document.cookie = name + "=" + s + ";expires=" + exp.toGMTString() + ";path=/";
        }
        ;
    }
}