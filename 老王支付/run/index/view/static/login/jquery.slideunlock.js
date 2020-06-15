/**
 * jquery plugin -- jquery.slideunlock.js
 * Description: a slideunlock plugin based on jQuery
 * Version: 1.1
 * Author: Dong Yuhao
 * www.sucaijiayuan.com
 * created: March 27, 2016
 */

;(function ($,window,document,undefined) {
    function SliderUnlock(elm, options, success){
        var me = this;
        var $elm = me.checkElm(elm) ? $(elm) : $;
        success = me.checkFn(success) ? success : function(){};

        var opts = {
            successLabelTip:  "Successfully Verified",
            duration:  200,
            swipestart:  false,
            min:  0,
            max:  $elm.width(),
            index:  0,
            IsOk:  false,
            lableIndex:  0
        };

        opts = $.extend(opts, options||{});

        //$elm
        me.elm = $elm;
        //opts
        me.opts = opts;
        //鏄惁寮€濮嬫粦鍔�
        me.swipestart = opts.swipestart;
        //鏈€灏忓€�
        me.min = opts.min;
        //鏈€澶у€�
        me.max = opts.max;
        //褰撳墠婊戝姩鏉℃墍澶勭殑浣嶇疆
        me.index = opts.index;
        //鏄惁婊戝姩鎴愬姛
        me.isOk = opts.isOk;
        //婊戝潡瀹藉害
        me.labelWidth = me.elm.find('#label').width();
        //婊戝潡鑳屾櫙
        me.sliderBg = me.elm.find('#slider_bg');
        //榧犳爣鍦ㄦ粦鍔ㄦ寜閽殑浣嶇疆
        me.lableIndex = opts.lableIndex;
        //success
        me.success = success;
    }

    SliderUnlock.prototype.init = function () {
        var me = this;

        me.updateView();
        me.elm.find("#label").on("mousedown", function (event) {
            var e = event || window.event;
            me.lableIndex = e.clientX - this.offsetLeft;
            me.handerIn();
        }).on("mousemove", function (event) {
            me.handerMove(event);
        }).on("mouseup", function (event) {
            me.handerOut();
        }).on("mouseout", function (event) {
            me.handerOut();
        }).on("touchstart", function (event) {
            var e = event || window.event;
            me.lableIndex = e.originalEvent.touches[0].pageX - this.offsetLeft;
            me.handerIn();
        }).on("touchmove", function (event) {
            me.handerMove(event, "mobile");
        }).on("touchend", function (event) {
            me.handerOut();
        });
    };

    /**
     * 榧犳爣/鎵嬫寚鎺ヨЕ婊戝姩鎸夐挳
     */
    SliderUnlock.prototype.handerIn = function () {
        var me = this;
        me.swipestart = true;
        me.min = 0;
        me.max = me.elm.width();
    };

    /**
     * 榧犳爣/鎵嬫寚绉诲嚭
     */
    SliderUnlock.prototype.handerOut = function () {
        var me = this;
        //鍋滄
        me.swipestart = false;
        //me.move();
        if (me.index < me.max) {
            me.reset();
        }
    };

    /**
     * 榧犳爣/鎵嬫寚绉诲姩
     * @param event
     * @param type
     */
    SliderUnlock.prototype.handerMove = function (event, type) {
        var me = this;
        if (me.swipestart) {
            event.preventDefault();
            event = event || window.event;
            if (type == "mobile") {
                me.index = event.originalEvent.touches[0].pageX - me.lableIndex;
            } else {
                me.index = event.clientX - me.lableIndex;
            }
            me.move();
        }
    };

    /**
     * 榧犳爣/鎵嬫寚绉诲姩杩囩▼
     */
    SliderUnlock.prototype.move = function () {
        var me = this;
        if ((me.index + me.labelWidth) >= me.max) {
            me.index = me.max - me.labelWidth -2;
            //鍋滄
            me.swipestart = false;
            //瑙ｉ攣
            me.isOk = true;
        }
        if (me.index < 0) {
            me.index = me.min;
            //鏈В閿�
            me.isOk = false;
        }
        if (me.index+me.labelWidth+2 == me.max && me.max > 0 && me.isOk) {
            //瑙ｉ攣榛樿鎿嶄綔
            $('#label').unbind().next('#labelTip').
            text(me.opts.successLabelTip).css({'color': '#fff'});

            me.success();
        }
        me.updateView();
    };


    /**
     * 鏇存柊瑙嗗浘
     */
    SliderUnlock.prototype.updateView = function () {
        var me = this;

        me.sliderBg.css('width', me.index);
        me.elm.find("#label").css("left", me.index + "px")
    };

    /**
     * 閲嶇疆slide鐨勮捣鐐�
     */
    SliderUnlock.prototype.reset = function () {
        var me = this;

        me.index = 0;
        me.sliderBg .animate({'width':0},me.opts.duration);
        me.elm.find("#label").animate({left: me.index}, me.opts.duration)
            .next("#lableTip").animate({opacity: 1}, me.opts.duration);
        me.updateView();
    };

    /**
     * 妫€娴嬪厓绱犳槸鍚﹀瓨鍦�
     * @param elm
     * @returns {boolean}
     */
    SliderUnlock.prototype.checkElm = function (elm) {
        if($(elm).length > 0){
            return true;
        }else{
            throw "this element does not exist.";
        }
    };

    /**
     * 妫€娴嬩紶鍏ュ弬鏁版槸鍚︽槸function
     * @param fn
     * @returns {boolean}
     */
    SliderUnlock.prototype.checkFn = function (fn) {
        if(typeof fn === "function"){
            return true;
        }else{
            throw "the param is not a function.";
        }
    };

    window['SliderUnlock'] = SliderUnlock;
})(jQuery, window, document);