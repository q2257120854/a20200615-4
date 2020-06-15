/*
 *@Description: App.component.js
 *@Version:	    v1.2
 *@Author:      GaoLi
 *@Update:      ghy(2012-06-1 16:30)
 */
(function (global, undefined) {// ��ֹundefined����Ⱦ
        var $ = global.$ || jQuery, app = {
        // browser
        ie: $.browser.msie,
        ie6: $.browser.msie && $.browser.version < 7,
        ie7: $.browser.msie && $.browser.version < 8,

        /**
         * Get cookie
         * @ param
         * @ return
         */
        getCookie: function(name) {
            var cookie_start = document.cookie.indexOf(name);
            var cookie_end = document.cookie.indexOf(";", cookie_start);
            return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
        },

        /**
         * Set cookie
         * @ param
         * @ return
         */
        setCookie: function(cookieName, cookieValue, seconds, path, domain, secure) {
            var expires = null;
            if (seconds != -1) {
                expires = new Date();
                expires.setTime(expires.getTime() + seconds);
            }
            document.cookie = [
                escape(cookieName),
                '=',
                escape(cookieValue),
                (expires ? '; expires=' + expires.toGMTString() : ''),
                (path ? '; path=' + path : '/'),
                (domain ? '; domain=' + domain : ''),
                (secure ? '; secure' : '')
            ].join("");
        },

        /**
         * hoverToggle
         * @ param jqueryObject
         * @ return
         */
        hoverToggle: function(object) {
            $.each(object, function(obj, name) {
                $(obj).hover(function() {
                    $(this).addClass(name);
                }, function() {
                    $(this).removeClass(name);
                })
            })
        },

        /**
         * string format
         * @ param  String
         * @ return
         */
        format:function (s) {
            var args = arguments,
                pattern = new RegExp('%([1-' + arguments.length + '])', 'g');
            return String(s).replace(pattern, function (match, index) {
                return args[index];
            })
        },

        /**
         * placeholder
         * @ param  config(json)
         * @ return
         */
        placeholder: function(options) {
            if (('placeholder' in document.createElement('input'))) return;
            if (typeof options === 'string'||options instanceof jQuery)  options = {obj:options }; //options
            options = $.extend({}, {obj:''}, options);
            var $placeholder;
            $placeholder = (!!options.obj) ? $(options.obj).filter('[placeholder]') : $('[placeholder]');
            $placeholder.focus(
                function () {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder'))input.removeClass('placeholder').val('');
                }).blur(
                function () {
                    var input = $(this);
                    if (input.val() == '' || input.val() == input.attr('placeholder'))input.addClass('placeholder').val(input.attr('placeholder'));
                }).blur();
            $placeholder.parents('form').submit(function () {
                $('[placeholder]', this).each(function () {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder'))input.val('');
                });
            });
        },

        /**
         * showFooter
         * @ param  String
         * @ return
         */
        showFooter:function(footStyle) {
            var footer = [
                '<div class="layout foot' + ((footStyle == "white") ? ' foot_white"' : "") + ">",
                '<div class="foot_link"><a href="http://corp.dukuai.com/corp/page/intro.html" title="" target="_blank" rel="nofollow">��˾���</a> | <a href="http://corp.dukuai.com/corp/page/news.html" title="" target="_blank" rel="nofollow">��˾��̬</a> | <a href="http://corp.dukuai.com/corp/page/partners.html" title="" target="_blank" rel="nofollow">�������</a> | <a href="http://corp.dukuai.com/corp/page/join.html" title="" target="_blank" rel="nofollow">��ƸӢ��</a> | <a href="http://corp.dukuai.com/corp/page/law.html" title="" target="_blank" rel="nofollow">��������</a> | <a href="http://corp.dukuai.com/corp/page/contact.html" title="" target="_blank" rel="nofollow">��ϵ����</a> | <a href="http://www.19lou.com/help.php" title="" target="_blank" rel="nofollow">��������</a> | <a href="http://www.19lou.com/misc/links/more.html" title="" target="_blank">��������</a></div><p class="foot_copyright">&copy;copyright2001-2009 ����ʮ��¥���紫ý���޹�˾ ��Ȩ����  ICP֤����B2-20070008</p></div>'
            ];
            document.write(footer.join(''));
        },
        getCache:function(key) {
            return this.cache.data(key);
        },
        setCache:function(key, value) {
            if (!app.cache)app.cache = $("<div>");
            this.cache.data(key, value);
            return value;
        },

        /**
         * default for dl-dt-dd
         * @param trig
         * @param options
         */
        selectBox:function(trig, options) {
            var target = trig.find("dd");
            var t = $.trim(target.html());
            options = $.extend({target:target, event:"hover", show:["show", "hide"], slide:["slideDown", "slideUp"], isSlide:false}, options);
            target = options.target;
            trig.each(function(index, callback) {
                var that = $(this);
                that.data("target", target.eq(index));
                if (options.isSlide)options.show = options.slide;
                if (options.event === "hover") {
                    that.hover(function() {
                        var _obj = that.find("dd"), _objWidth = that.width() + 8, _setWidth = _obj.width();
                        if (_objWidth > _setWidth) that.find("dd").width(_objWidth);
                        if ( t == "" ) {
                            showForSB(options, $(this), true);
                        }else {
                            showForSB(options, $(this), false);
                        }
                    }, function () {
                        showForSB(options, $(this), true);
                    });
                }
                if (options.fn) {
                    options.fn(that, that.data("target"));
                } else {
                    that.find("a").click(function (ev) {
                        that.find("dt").html(this.innerHTML);
                        showForSB(options, that, 1);
                        ev.stopPropagation();
                        return false;
                    });
                }
            });
            function showForSB(options, c, n) {
                c.data("target")[options.show[n ? 1 : 0]]();
            }
        },

        /**
         * Registers module
         * @param mods {Object}
         * @param cover {string}
         */
        add : function(mods, cover) {
            if (cover === undefined) cover = true;
            for (var i in mods) {
                if (cover || !(i in this)) this[i] = mods[i];
            }
            return this;
        }
    };

    /**
     * home
     */
    home = {
        board: {

        }
    };

    // App && home
    global.App = $.extend(global.App||{}, app);
    global.Home = home;

    // ready component
    for (var key in app) {
        AM.setMods(key, false);
    }
    
    // jquery len
    $.fn.extend({
        len:function(){
            var str = $.trim($(this).val());
            return str.length + str.replace(/[^\u4E00-\u9FA5]/g, '').length;
        }
    });
 })(window);
