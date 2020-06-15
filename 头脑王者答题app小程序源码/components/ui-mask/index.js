// components/fk-dialog/index.js
Component({
    /**
     * 组件的属性列表
     */
    properties: {
        customStyle: {
            type: String | Object
        },
        show: {
            type: Boolean,
            observer: function observer(val) {
                var _this = this;

                if (val) {
                    this.setData({
                        selfShow: true
                    });
                } else {
                    if (this.data.hideDelay) {
                        setTimeout(function() {
                            _this.setData({
                                selfShow: false
                            });
                        }, this.data.hideDelay);
                    } else {
                        this.setData({
                            selfShow: false
                        });
                    }
                }
            }
        },
        top: {
            type: Number | String,
            value: 0
        },
        effect: {
            type: String,
            value: 'scale-in'
        },
        hideDelay: {
            type: Number
        },
        showClose: {
            type: Boolean,
            value: true
        },
        hideOnTap: {
            type: Boolean,
            value: false
        },
        blur: {
            type: String
        }
    },

    /**
     * 组件的初始数据
     */
    data: {
        selfShow: false,
        isInTimeout: false,
        blurClass: ''
    },

    /**
     * 组件的方法列表
     */
    methods: {
        handleMaskTap() {
            if (this.data.hideOnTap) {
                this.triggerEvent('close');
                this.setData({
                    show: false
                });
            }
        },
        close() {
            this.triggerEvent('close');
            this.setData({
                show: false
            });
        }
    }
})