// components/ui-ruler/index.js
var _objectToStyle = require('../libs/objectToStyle.js');
var styleHelper = require('../libs/styleHelper.js');

Component({

    /**
     * 组件的属性列表
     */
    properties: {
        width: {
            type: [Number, String]
        },
        value: {
            type: [Number, String]
        },
        min: {
            type: [Number, String],
            value: 0
        },
        max: {
            type: [Number, String],
            value: 1000
        },
        step: {
            type: [Number, String],
            value: 100
        },
        keyStep: {
            type: [Number, String],
            value: 500
        },
        pointerWidth: {
            type: [Number, String],
            value: 2
        },
        pointerColor: {
            type: String,
            value: 'red'
        },
        stepWidth: {
            type: [Number, String],
            value: 10
        },
        lineWidth: {
            type: [Number, String],
            value: 1
        },
        lineHeight: {
            type: [Number, String] // not don
        },
        keyLineHeight: { // not
            type: [Number, String]
        },
        height: {
            type: [Number, String],
            value: 50
        },
        showNumber: {
            type: Boolean,
            value: true
        },
        mode: {
            type: String, // not done
            value: 'bottom'
        },
        numberColor: {
            type: String, // no use
            value: '#E0E0E0'
        },
        color: { // no use
            type: String,
            value: '#E0E0E0'
        },
        numberSize: {
            type: [Number, String],
            value: 10
        },
        numberPadding: {
            type: Number,
            value: 5
        },
        valueStyle: {
            type: [String, Object],
            value: ''
        }
    },

    /**
     * 组件的初始数据
     */
    data: {
        padding: 0,
        currentTimeStamp: 0,
        leftForSure: 0,
        canMove: false,
        canEnd: false,
        selfValue: 0,
        oldValue: 0
    },

    ready() {
        if (this.data.value) {
            this.data.selfValue = Number(this.data.value) - this.data.selfMin;
        } else {
            this.data.selfValue = 0;
        }

        this.data.leftForSure = this.data.selfValue * (this.data.selfLineWidth + this.data.selfStepWidth);

        this.setData({
            selfValue: this.data.selfValue,
            leftForSure: this.data.leftForSure
        });
    },

    attached() {
        this.data.lineHeight = this.data.lineHeight || Number(this.data.height) / 4;
        this.data.keyLineHeight = this.data.keyLineHeight || Number(this.data.lineHeight) * 2;

        this.data.selfValueStyle = styleHelper.getPlainStyle(this.data.valueStyle);

        this.data.selfStepWidth = Number(this.data.stepWidth);
        this.data.selfLineWidth = Number(this.data.lineWidth);
        this.data.selfMin = Number(this.data.min);
        this.data.selfMax = Number(this.data.max);
        this.data.value = Number(this.data.value);
        this.data.step = Number(this.data.step);
        this.data.keyStep = Number(this.data.keyStep);
        this.data.pointerWidth = Number(this.data.pointerWidth);
        this.data.selfWidth = Number(this.data.width);
        if (this.data.width) {
            this.data.selfWidth = Number(this.data.width);
        } else {
            this.data.selfWidth = wx.getSystemInfoSync().windowWidth;
        }
        this.data.padding = this.data.selfWidth / 2;

        if (!this.data.numberPadding) {
            this.setData({
                numberPadding: this.data.numberSize / 2
            });
        } else {
            this.setData({
                numberPadding: this.data.numberPadding
            });
        }
        this.setData({
            lineHeight: this.data.lineHeight,
            keyLineHeight: this.data.keyLineHeight,
            selfValueStyle: this.data.selfValueStyle,
            selfStepWidth: this.data.selfStepWidth,
            selfLineWidth: this.data.selfLineWidth,
            selfMin: this.data.selfMin,
            selfMax: this.data.selfMax,
            value: this.data.value,
            step: this.data.step,
            keyStep: this.data.keyStep,
            pointerWidth: this.data.pointerWidth
        });
        this.setData({
            padding: this.data.padding,
            rulerWrapStyle: (0, _objectToStyle.default)(this.rulerWrapStyleObj()),
            rulerStyle: (0, _objectToStyle.default)(this.rulerStyleObj()),
            rulerPointerStyle: (0, _objectToStyle.default)(this.rulerPointerStyleObj()),
            scrollViewStyle: (0, _objectToStyle.default)(this.scrollViewStyleObj()),
            rulerPaddingStyle: (0, _objectToStyle.default)(this.rulerPaddingStyleObj()),
            numberPaddingStyle: (0, _objectToStyle.default)(this.numberPaddingStyleObj())
        });
    },

    /**
     * 组件的方法列表
     */
    methods: {
        touchStartHandler(e) {
            this.data.canMove = false;
        },
        touchEndHandler() {
            this.data.canMove = true;
            if (this.data.canEnd) {
                this.data.selfValue = Math.round(this.data.offsetValue / (this.data.selfStepWidth + this.data.selfLineWidth) * this.data.step);
                this.data.leftForSure = Math.round(this.data.offsetValue / (this.data.selfStepWidth + this.data.selfLineWidth) * this.data.step / this.data.step) * this.data.step / this.data.step * (this.data.selfStepWidth + this.data.selfLineWidth);
                this.setData({
                    selfValue: this.data.selfValue,
                    leftForSure: this.data.leftForSure
                });
            }
        },
        scrollHandler(e) {
            var _this = this;

            this.data.offsetValue = e.detail.scrollLeft;
            this.data.selfValue = Math.round(this.data.offsetValue / (this.data.selfStepWidth + this.data.selfLineWidth) * this.data.step);
            if (this.data.oldValue !== this.data.selfValue) {
                this.setData({
                    selfValue: this.data.selfValue
                });
            }
            this.data.oldValue = this.data.selfValue;
            setTimeout(function() {
                if (_this.data.offsetValue === e.detail.scrollLeft && _this.data.canMove) {
                    _this.data.leftForSure = Math.round(_this.data.offsetValue / (_this.data.selfStepWidth + _this.data.selfLineWidth) * _this.data.step / _this.data.step) * _this.data.step / _this.data.step * (_this.data.selfStepWidth + _this.data.selfLineWidth);
                    _this.setData({
                        selfValue: _this.data.selfValue,
                        leftForSure: _this.data.leftForSure
                    });
                    _this.data.canEnd = true;
                }
            }, 100);
            this.triggerEvent('change', this.data.selfValue);
        },
        rulerWrapStyleObj() {
            var style = {};
            style.height = this.data.height + 'px';
            style.width = this.data.padding * 2 + (this.data.selfStepWidth + this.data.selfLineWidth) * (this.data.selfMax - this.data.selfMin) / this.data.step + 'px';
            if (this.data.mode === 'bottom') {
                style['border-bottom'] = '1px solid ' + this.data.color;
            } else {
                style['border-top'] = '1px solid ' + this.data.color;
            }
            // style.width = this.data.selfWidth + 'px' // 待定
            return style;
        },
        numberPaddingStyleObj() {
            var style = {};
            if (this.data.mode === 'top') {
                style.top = Number(this.data.keyLineHeight) + Number(this.data.numberPadding) + 'px';
            } else {
                style.top = Number(this.data.height) - Number(this.data.keyLineHeight) - Number(this.data.numberPadding) - Number(this.data.numberSize) + 'px';
            }
            return style;
        },
        rulerStyleObj() {
            var style = {};
            style.height = this.data.height + 'px';
            style.width = this.data.selfWidth + 'px';
            return style;
        },
        scrollViewStyleObj() {
            var style = {};
            style.height = this.data.height + 'px';
            style.width = this.data.selfWidth + 'px';
            return style;
        },
        rulerPaddingStyleObj() {
            var style = {};
            style.width = this.data.padding;
            return style;
        },
        rulerPointerStyleObj() {
            var style = {};
            style.width = this.data.pointerWidth + 'px';
            style['background-color'] = this.data.pointerColor;
            style.height = this.data.height + 'px';
            style.left = this.data.padding + 'px';
            return style;
        }
    }
})