// components/ui-accordion/index.js
Component({
    /**
     * 组件的属性列表
     */
    properties: {
        headerHeight: {
            type: [String, Number],
            value: 50
        },
        state: {
            type: String,
            value: 'hide',
            observer: function observer(val) {
                this.data.selfState = val;
                if (this.data.selfState === 'show') {
                    this.data.selfState = 'hide';
                } else {
                    this.data.selfState = 'show';
                }
                this.setData({
                    buttonImageObj: this.buttonImageObjFunc(),
                    contentObj: this.contentObjFunc()
                });
            }
        },
        animate: {
            type: [String, Boolean],
            value: true
        },
        animateDuration: {
            type: [String, Number],
            value: 0.3
        },
        showArrow: {
            type: [String, Boolean],
            value: true
        }
    },

    /**
     * 组件的初始数据
     */
    data: {
        selfState: 'hide',
        triangleImg: './images/triangle.png',
        selfAnimateDuration: 0.3,
        buttonImageObj: {},
        contentObj: {},
        contentHidden: true
    },

    options: {
        multipleSlots: true // 在组件定义时的选项中启用多slot支持
    },

    ready: function ready() {
        var _this = this;

        this.data.selfAnimateDuration = this.properties.animateDuration;
        this.data.selfState = this.properties.state;
        this.data.slotHeight = this.data.headerHeight;
        this.setData({});

        wx.createSelectorQuery().in(this).select('.content').boundingClientRect(function(res) {
            _this.data.contentHeight = res.height;
        }).exec();

        this.setData({
            buttonImageObj: this.buttonImageObjFunc(),
            buttonImageStyle: this._objectToStyle(this.buttonImageStyleObj())
        });
    },

    /**
     * 组件的方法列表
     */
    methods: {
        _objectToStyle(obj) {
            var rstr = '@_@_@_@_@_@_@_';
            var str = JSON.stringify(obj);
            if (str) {
                var arr = str.match(/\(.*?\)/g);
                var newStr = str.replace(/\(.*?\)/g, '@_@_@_@_@_@_@_').replace(/"|{|}/g, '').replace(/,/g, ';');
                if (arr && arr.length) {
                    arr.forEach(function(item, index) {
                        newStr = newStr.replace('@_@_@_@_@_@_@_', item);
                    });
                }
                return newStr;
            } else {
                return '';
            }
        },
        touchStartHandler() {
            if (this.data.selfState === 'show') {
                this.data.selfState = 'hide';
            } else {
                this.data.selfState = 'show';
            }
            this.setData({
                contentHidden: !this.data.contentHidden,
                buttonImageObj: this.buttonImageObjFunc(),
            });
        },
        touchMoveHandler() {},
        touchEndHandler() {},
        buttonImageStyleObj() {
            var style = {};
            style.top = this.data.slotHeight / 2 - 4 + 'px';
            return style;
        },
        buttonImageObjFunc() {
            var style = {};
            style.top = 18 + 'px';
            if (this.data.animate) {
                style.transition = 'transform ' + this.data.selfAnimateDuration + 's';
            }
            if (this.data.selfState === 'hide') {
                style.transform = 'rotate(0deg)';
            } else {
                style.transform = 'rotate(180deg)';
            }
            return style;
        },
        contentObjFunc() {
            var style = {};
            if (this.data.animate) {
                style.transition = 'height ' + this.data.selfAnimateDuration + 's';
            }
            if (this.data.selfState === 'hide') {
                style.height = 0;
            } else {
                style.height = this.data.contentHeight;
            }
            return style;
        }
    }
})