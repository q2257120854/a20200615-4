// components/ui-count-down/index.js
var moment = require('../../static/js/moment.js');
Component({
    /**
     * 组件的属性列表
     */
    properties: {
        time: {
            type: [Number, String],
            value: moment().add(1, 'days').format('YYYY/MM/DD HH:mm:ss'),
            observer(val) {
                if (val) {
                    this.initData();
                    this.startCountDown();
                }
            }
        },
        timetype: {
            type: String,
            value: 'datetime'
        },
        format: {
            type: String,
            value: '{%d}天{%h}时{%m}分{%s}秒'
        },
        doneText: {
            type: String,
            value: ''
        },
        numStyle: {
            type: String,
            value: ''
        },
        splitStyle: {
            type: [String, Object],
            value: '',
            observer(val) {
                this.setData({
                    selfSplitStyle: val
                });
            }
        },
        numberStyle: {
            type: [String, Object],
            value: '',
            observer(val) {
                this.setData({
                    selfNumberStyle: val
                });
            }
        }
    },

    /**
     * 组件的初始数据
     */
    data: {
        futureTimeStamp: undefined,
        itemArray: [],
        mode: 0,
        day: undefined,
        hour: undefined,
        minute: undefined,
        second: undefined,
        selfSplitStyle: '',
        selfNumberStyle: ''
    },

    attached() {
        this.setData({
            selfSplitStyle: this.data.splitStyle,
            selfNumberStyle: this.data.numberStyle
        });
        this.onPageShow();
    },

    detached() {
        this.onPageHide();
    },

    /**
     * 组件的方法列表
     */
    methods: {
        onPageHide() {
            if (this.data.interval) {
                clearInterval(this.data.interval);
            }
        },
        onPageShow() {
            this.initData();
            this.startCountDown();
        },
        initData() {
            var that = this;
            that.data.itemArray = [];
            if (this.data.timetype === 'second') {
                this.data.futureTimeStamp = Math.floor(moment().add(this.data.time, 'seconds').format('x') / 1000);
            } else {
                this.data.futureTimeStamp = Math.floor(moment(this.data.time).format('x') / 1000);
            }
            var tempArray = this.data.format.split(/(\{.*?\})/);
            tempArray.forEach(function(item) {
                var obj = {};
                if (item === '{%d}') {
                    obj.type = 'day';
                    obj.value = '';
                    that.data.day = obj;
                } else if (item === '{%h}') {
                    obj.type = 'hour';
                    obj.value = '';
                    that.data.hour = obj;
                } else if (item === '{%m}') {
                    obj.type = 'minute';
                    obj.value = '';
                    that.data.minute = obj;
                } else if (item === '{%s}') {
                    obj.type = 'second';
                    obj.value = '';
                    that.data.second = obj;
                } else {
                    obj.type = 'split';
                    obj.value = item;
                }
                that.data.itemArray.push(obj);
            });
        },
        startCountDown() {
            var that = this;
            this.data.interval = setInterval(function() {
                var diffSecond = Math.floor(moment(that.data.futureTimeStamp * 1000).diff(moment()) / 1000);
                that.data.timeUp = diffSecond < 0 ? true : false;
                if (that.data.timeUp) {
                    that.setData({
                        timeUp: that.data.timeUp
                    });
                    that.triggerEvent('timeup');
                    clearInterval(that.data.interval);
                } else {
                    if (that.data.day) {
                        that.data.day.value = Math.floor(diffSecond / (60 * 60 * 24));
                        diffSecond = diffSecond % (60 * 60 * 24);
                    }
                    if (that.data.hour) {
                        that.data.hour.value = Math.floor(diffSecond / (60 * 60));
                        diffSecond = diffSecond % (60 * 60);
                    }
                    if (that.data.minute) {
                        that.data.minute.value = Math.floor(diffSecond / 60);
                        diffSecond = diffSecond % 60;
                    }
                    if (that.data.second) {
                        that.data.second.value = Math.floor(diffSecond);
                    }
                    that.setData({
                        itemArray: that.data.itemArray
                    });
                }
            }, 1000);
        }
    }
})