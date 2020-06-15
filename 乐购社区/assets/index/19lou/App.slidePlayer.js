/**
 * @Description: App.slidePlayer.js
 * @Version:     v3.0
 * @Author:      GaoLi
 */

(function(exports) {

    App.slidePlayer = exports.init;

})((function() {

    var exports = {};

    exports.name    = "slide.js";
    exports.version = "3.0";

    function Slide(object, options) {
        this.$object = $(object);
        this.options = $.extend({}, Slide.data.def, options);
    };

    /**
     * 数据
     * @type {Object}
     */
    Slide.data = {
        
        def: {
            time: "3000",
            page: 1
        }

    };

    /**
     * 取值
     * @param {String} key
     */
    Slide.prototype.get = function(key) {
        return this.options[key];
    };

    /**
     * 赋值
     * @param {String} key
     * @param {String | Number} val
     */
    Slide.prototype.set = function(key, val) {
        this.options[key] = val;
    };

    /**
     * 初始化
     */
    Slide.prototype.init = function() {
        var self    = this,
            $object = self.$object;

        $object.addClass("slide-player");
        $object.css({
            "width" : self.get("width")  || $object.width,
            "height": self.get("height") || $object.height
        });

        var $items = $object.find("li"),
            buffer = "";
            
        $items.addClass("slide-item");
        $items.each(function(i) {
            buffer += '<a href="javascript:;" title="">' + (i + 1) + '</a>';
        });

        this.$page  = $('<li class="slide-page">' + buffer + '</li>').appendTo($object);
        this.$pages = this.$page.find("a");
        this.$items = $items;
    };

    /**
     * 事件绑定
     */
    Slide.prototype.bind = function() {
        var self  = this,
            page  = self.get("page"),
            $page = self.$page;

        $page.delegate("a[class!=trigger]", "mouseenter", function() {
            self.fade(parseInt(this.innerHTML));
        });

        $page.hover(function() {
            self.auto(false);
        }, function() {
            self.auto(true);
        });

        self.fade(page);

        // 开启自动播放
        self.auto(true);
    };

    /**
     * 渐影效果
     * @param {Number} current
     */
    Slide.prototype.fade = function(current) {
        var self   = this,
            page   = self.get("page"),
            $pages = self.$pages,
            $items = self.$items;

        // 超出置零
        (current > $pages.length) ? current = 1 : "";

        // 重置翻页
        $pages.eq(page - 1).removeClass("trigger");
        $pages.eq(current - 1).addClass("trigger");

        // 重置幻灯
        $items.eq(page - 1).stop(true, true);
        $items.eq(page - 1).fadeOut(function() {
            $(this).css("zIndex", 1);
        });
        $items.eq(current - 1).css("zIndex", 3).fadeIn();

        // 记录页数
        self.set("page", current);
    };

    /**
     * 自动播放
     * @param {Boolean} toggle
     */
    Slide.prototype.auto = function(toggle) {
        var self = this,
            time = self.get("time");

        if (toggle) {
            self.t = setInterval(function() {
                self.fade(self.get("page") + 1);
            }, time);
        } else {
            clearInterval(self.t);
        }

    };

    /**
     * 对外接口
     */
    exports.init = function() {
        var args    = Array.prototype.slice.call(arguments),
            object  = args.shift(),
            options = args.shift(),
            slide   = new Slide(object, options);

        slide.init();
        slide.bind();
    };

    return exports;

})());